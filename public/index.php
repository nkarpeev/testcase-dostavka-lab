<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;

require '../vendor/autoload.php';

defined('ROOT') or define('ROOT', dirname(__DIR__));

//echo "<pre>";
//print_r(phpinfo());
//echo "</pre>";
//die;

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($config);
$app = new \Slim\App($c);

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(ROOT . '/src/views', [
        'debug' => true, // This line should enable debug mode
        'cache' => false,
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$app->any('/', function (Request $request, Response $response, array $args) {
    $params = $args;
    $orders = [];

    R::setup('mysql:host=localhost;dbname=testcase_dostavka_lab',
        'user_dostavka_lab', '123456');

    if (!R::testConnection()) {
        exit ('Нет соединения с базой данных');
    }

    R::useFeatureSet('novice/latest');

    R::ext('xdispense', function ($table_name) {
        return R::getRedBean()->dispense($table_name);
    });

    $addServices = R::findAll('additional_services_dictionary');

    if ($request->isPost()) {
        $gump = new GUMP();
        $post = $gump->sanitize($request->getParsedBody());

//        $post = [
//            'orders'          => [
//                'from'          => 'from example',
//                'destination'   => 'destination example',
//                'delivery_date' => '2019-10-27 14:00:00',
//                'name'          => 'name example',
//                'phone'         => '+79872705566',
//            ],
//            'geo_coordinates' => [
//                'longitude' => '56.84845',
//                'latitude'  => '35.15484'
//            ],
//            'add_services'    => [2, 3]
//        ];


        $gump->validation_rules([
            'from' => 'required|max_len,100|min_len,5',
            'destination' => 'required|max_len,100|min_len,5',
            'delivery_date' => 'required',
            'name' => 'required|valid_name|max_len,30|min_len,2',
            'phone' => 'required',
        ]);

        $gump->filter_rules([
            'from'          => 'trim|sanitize_string',
            'destination'   => 'trim|sanitize_string',
            'delivery_date' => 'trim|sanitize_string',
            'name'          => 'trim|sanitize_string',
            'phone'         => 'trim|sanitize_string',
        ]);

        $validated_data = $gump->run($post['orders']);

        if ($validated_data === false) {
            echo "<pre>";
            print_r($gump->get_readable_errors());
            echo "</pre>";
        } else {

            R::begin();
            try {
                $dataProvide = $post;
                $dataProvide['orders']['_type'] = 'orders';
                $dataProvide['geo_coordinates']['_type'] = 'geo_coordinates';

                $order = R::dispense($dataProvide['orders']);
                $geoCoordinates = R::xdispense('geo_coordinates');

                $geoCoordinates->longitude = $dataProvide['geo_coordinates']['longitude'];
                $geoCoordinates->latitude = $dataProvide['geo_coordinates']['latitude'];

                $orderID = R::store($order);
                $geoCoordinates->order_id = $orderID;

                $addServicesForOrders = [];
                foreach ($dataProvide['add_services'] as $serviceID) {
                    $bean = R::xdispense('additional_services_for_orders');
                    $bean->order_id = $orderID;
                    $bean->additional_service_id = $serviceID;
                    $addServicesForOrders[] = $bean;
                }

                $addServicesForOrdersID = R::storeAll($addServicesForOrders);
                $geoCoordinatesID = R::store($geoCoordinates);

                $orders = R::load('orders', $orderID);
//                $geoCoordinates = R::load('geo_coordinates', $geoCoordinatesID);
//                $addServicesForOrders = R::loadAll('additional_services_for_orders', $addServicesForOrdersID);
                R::commit();

            } catch (Exception $e) {
                R::rollback();

                echo "<pre>";
                print_r('transaction rollback');
                echo "</pre>";
                echo $e->getMessage();
            }
        }
    }

    return $this->view->render($response, 'order/create.php', [
        'orders'          => $post['orders'],
        'addServicesData' => $addServices
    ]);

})->setName('order.create');

$app->run();