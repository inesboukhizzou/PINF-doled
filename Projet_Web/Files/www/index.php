<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new App\Router(dirname(__DIR__) . DIRECTORY_SEPARATOR .'private' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
$router->get('/', 'index', 'Accueil')
    ->run();
