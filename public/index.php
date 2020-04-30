<?php

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

define(
    'APP_PATH',
    realpath('..') . '/'
);

$config = new ConfigIni(
    APP_PATH.'app/config/config.ini'
);

require APP_PATH.'app/config/loader.php';

require APP_PATH.'app/config/services.php';

$application = new Application($container);

try {
    $response = $application->handle(
        $_SERVER['REQUEST_URI']
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Shit '.$e->getMessage();
}