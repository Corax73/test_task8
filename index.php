<?php
namespace Models;

require 'vendor/autoload.php';
session_start();
include 'config/const.php';

$router = new Router();
$router->run();
