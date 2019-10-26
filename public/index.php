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
        echo "<pre>";
        print_r($request->getParsedBody());
        echo "</pre>";
        die;
    }

    return $this->view->render($response, 'order/create.php', [
        'params' => $params
    ]);

})->setName('order.create');

$app->run();