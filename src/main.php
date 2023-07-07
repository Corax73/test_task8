<?php

session_start();
include 'config/const.php';

spl_autoload_register(function ($class_name) {
    include 'models/' . $class_name . '.php';
});

$router = new Router;
$router->run();
