<?php

use Tringuyen\CarForRent\bootstrap\Application;
use Tringuyen\CarForRent\controller\SiteController;
use Tringuyen\CarForRent\database\DatabaseConnect;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = DatabaseConnect::getConnection();

include_once '../src/Route/routes.php';
$app = new Application(dirname(__DIR__));


$app->run();


