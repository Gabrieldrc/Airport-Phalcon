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
    '/airplanes/{pag}',
    [
        'controller' => 'airplanes',
        'action'     => 'list',
    ]
);

$router->addGet(
    '/airplanes/new',
    [
        'controller' => 'newplane',
        'action'     => 'form',
    ]
);

$router->addPost(
    '/airplanes',
    [
        'controller' => 'newplane',
        'action'     => 'new',
    ]
);
//================
$router->addGet(
    '/flights',
    [
        'controller' => 'flights',
        'action'     => 'list',
    ]
);

$router->addGet(
    '/flights/{pag}',
    [
        'controller' => 'flights',
        'action'     => 'list',
    ]
);

$router->addGet(
    '/flights/new',
    [
        'controller' => 'newflight',
        'action'     => 'form',
    ]
);

$router->addPost(
    '/flights',
    [
        'controller' => 'newflight',
        'action'     => 'new',
    ]
);

return $router;