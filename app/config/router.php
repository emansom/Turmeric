<?php

$router = $di->getRouter();

// Define your routes here
$router->add('/login', [
    'namespace'  => 'Turmeric\Controllers',
    'controller' => 'authentication',
    'action'     => 'login'
])->setName("login");

$router->add('/logout', [
    'namespace'  => 'Turmeric\Controllers',
    'controller' => 'authentication',
    'action'     => 'logout'
])->setName("logout");

$router->add('/', [
    'namespace'  => 'Turmeric\Controllers',
    'controller' => 'dashboard',
    'action'     => 'index'
])->setName("dashboard");

$router->handle();
