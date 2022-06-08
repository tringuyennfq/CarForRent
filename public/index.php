<?php

use Tringuyen\CarForRent\Bootstrap\Application;
use Tringuyen\CarForRent\Database\DatabaseConnect;

require_once __DIR__.'/../vendor/autoload.php';


session_start();

$conn = DatabaseConnect::getConnection();

$app = new Application(dirname(__DIR__));
include_once '../src/Route/routes.php';
$app->run();




