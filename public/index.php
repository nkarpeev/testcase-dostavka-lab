<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

defined('ROOT') or define('ROOT', dirname(__DIR__));

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
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$app->any('/', function (Request $request, Response $response, array $args) {
    $params = $args;

    if($request->isPost()) {
        $gump = new GUMP();
        $post = $gump->sanitize($request->getParsedBody());

        $gump->validation_rules([
            'from' => 'required|max_len,100|min_len,5',
            'destination' => 'required|max_len,100|min_len,5',
            'delivery_date' => 'required',
            'name' => 'required|valid_name|max_len,30|min_len,2',
            'phone' => 'required',
        ]);

        $gump->filter_rules([
            'from' => 'trim|sanitize_string',
            'destination' => 'trim|sanitize_string',
            'delivery_date' => 'trim|sanitize_string',
            'name' => 'trim|sanitize_string',
            'phone' => 'trim|sanitize_string',
        ]);

        $validated_data = $gump->run($post);

        if($validated_data === false) {
            echo "<pre>";
            print_r($gump->get_readable_errors());
            echo "</pre>";
        } else {
            print_r($validated_data); // validation successful
        }

        return $this->view->render($response, 'order/create.php', [
            'from' => $post['from'],
            'destination' => $post['destination'],
            'delivery_date' => $post['delivery_date'],
            'name' => $post['name'],
            'phone' => $post['phone'],
        ]);
    }

    return $this->view->render($response, 'order/create.php');

})->setName('order.create');

$app->run();