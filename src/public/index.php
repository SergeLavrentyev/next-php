<?php

declare(strict_types=1);
define('APP_ROOT', __DIR__ . '/../app');

use App\Core\App;
use App\Core\Container\Container;
use App\Core\Request\RequestFactory;
use App\Core\Router\Router;

require __DIR__ . '/../vendor/autoload.php';

$request = (new RequestFactory())->createFromGlobals();
$router = new Router();
$container = new Container();

(new App(
    $request,
    $router,
    $container
))->run();