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
        'action'     => 'signup',
    ]
);

$router->addGet(
    '/principal',
    [
        'controller' => 'distribution',
        'action'     => 'principal',
    ]
);

$router->addGet(
    '/menu/{id}',
    [
        'controller' => 'signup',
        'action'     => 'signup',
    ]
);
return $router;