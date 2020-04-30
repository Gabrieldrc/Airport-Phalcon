<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Session\Adapter\Files as Session;

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
    function () use ($config){
        $view = new View();

        $view->setViewsDir(APP_PATH . $config->application->viewsDir);

        return $view;
    }
);

$container->set(
    'router',
    function () {
        return include APP_PATH . 'app/config/routes.php';
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
    'session',
    function () {
        $session = new Session();

        $session->start();

        return $session;
    }
);

$container->set(
    'dispatcher',
    function () {
        // Create an events manager
        $eventsManager = new EventsManager();

        // Listen for events produced in the dispatcher using the Security plugin
        $eventsManager->attach(
            'dispatch:beforeExecuteRoute',
            new SecurityPlugin()
        );

        // Handle exceptions and not-found exceptions using NotFoundPlugin
        // $eventsManager->attach(
        //     'dispatch:beforeException',
        //     new NotFoundPlugin()
        // );

        $dispatcher = new Dispatcher();

        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
);