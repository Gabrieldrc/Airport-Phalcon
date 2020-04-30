<?php

use Phalcon\Mvc\View;
use Phalcon\Http\Message\Uri;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;

$container = new FactoryDefault();

$container->set(
    'db',
    function () use ($config) {
        return new Mysql(
            [
                'host'     => $config->database->host,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname'   => $config->database->name,
            ]
        );
    }
);

// Registering the view component
$container->set(
    'view',
    function () {
        $view = new View();

        $view->setViewsDir('../app/views/');

        return $view;
    }
);

$container->set(
    'router',
    function () {
        return include APP_PATH . '/app/config/routes.php';
    }
);

$container->set(
    'airplaneService',
    function () {
        return new AirplaneService();
    }
);

$container->set(
    'flightService',
    function () {
        return new FlightService();
    }
);

$container->set(
    'uri',
    function () {
        return new Uri();
    }
);