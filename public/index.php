<?php

use Tringuyen\CarForRent\Bootstrap\Application;
use Tringuyen\CarForRent\Controller\SiteController;
use Tringuyen\CarForRent\Database\DatabaseConnect;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

$conn = DatabaseConnect::getConnection();

include_once '../src/Route/routes.php';
$app = new Application(dirname(__DIR__));


$app->run();


