<?php

use Phalcon\Mvc\Router as MyRouter;

$router = new MyRouter();

$router->addGet(
    '/',
    [
        'controller' => 'home',
        'action'     => 'home',
    ]
);

$router->addPost(
    '/logIn',
    [
        'controller' => 'home',
        'action'     => 'logIn',
    ]
);

$router->addGet(
    '/signUp',
    [
        'controller' => 'signup',
        'action'     => 'register',
    ]
);

$router->addPost(
    '/signUp',
    [
        'controller' => 'signup',
        'action'     => 'newsignup',
    ]
);

$router->addGet(
    '/principal',
    [
        'controller' => 'principal',
        'action'     => 'principal',
    ]
);

$router->addGet(
    '/airplanes',
    [
        'controller' => 'airplanes',
        'action'     => 'list',
    ]
);

$router->addGet(
    '/airplanes/new',
    [
        'controller' => 'airplanes',
        'action'     => 'form',
    ]
);

$router->addPost(
    '/newAirplane',
    [
        'controller' => 'airplanes',
        'action'     => 'new',
    ]
);

return $router;