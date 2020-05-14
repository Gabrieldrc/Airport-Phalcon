<?php

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

define(
    'APP_PATH',
    realpath('..') . '/app/'
);

$config = new ConfigIni(
    APP_PATH.'config/config.ini'
);

//Uso exclusivo para encontrar errores, de otra forma, eliminar del codigo
// $debug = new \Phalcon\Debug();
// $debug->listen();
//

require APP_PATH.'config/loader.php';

require APP_PATH.'config/services.php';

$application = new Application($container);

try {
    $response = $application->handle(
        $_SERVER['REQUEST_URI']
    );

    $response->send();
} catch (\Exception $e) {
    echo get_class($e), ': ', $e->getMessage(), '\n';
    echo ' File=', $e->getFile(), '\n';
    echo ' Line=', $e->getLine(), '\n';
    echo $e->getTraceAsString();
}