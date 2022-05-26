<?php

use Tringuyen\CarForRent\Bootstrap\Application;
use Tringuyen\CarForRent\Controller\SiteController;
use Tringuyen\CarForRent\Database\DatabaseConnect;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

$conn = DatabaseConnect::getConnection();


$app = new Application(dirname(__DIR__));
include_once '../src/Route/routes.php';
$app->run();


