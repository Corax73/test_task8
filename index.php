<?php

session_start();
include 'config/const.php';

spl_autoload_register();

$router = new Models\Router;
$router->run();
