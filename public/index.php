<?php

use DI\Container;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Selective\BasePath\BasePathMiddleware;

session_start();

const APP_ROOT = __DIR__ . '/../';

require APP_ROOT . 'vendor/autoload.php';

date_default_timezone_set('Asia/Manila');

$container = new Container();

$containerBuilder = new ContainerBuilder();
$settings = require APP_ROOT . 'dependencies/container.php';
$settings($containerBuilder);

$container = $containerBuilder->build();

AppFactory::setContainer($container);

//$containerBuilder->enableCompilation(APP_ROOT . '/cache');

$app = AppFactory::create();

// Configure Twig view renderer
$twig = Twig::create(APP_ROOT . 'public/views/', ['cache' => false, 'debug' => true]);

$app->add(TwigMiddleware::create($app, $twig));
$app->add(new BasePathMiddleware($app));
$app->add(\Slim\Views\TwigMiddleware::create($app,$container->get('view')));

$routes = require APP_ROOT . 'routes/routes.php';
$routes($app);

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Get the default error handler and register my custom error renderer.
$errorHandler = $errorMiddleware->getDefaultErrorHandler();

$app->run();