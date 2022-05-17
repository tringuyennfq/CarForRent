<?php

use Tringuyen\CarForRent\bootstrap\Application;

require_once __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$testapp = new Application(dirname(__DIR__));
$testapp->router->get('/','home');
$testapp->router->get('/about','about');
$testapp->router->get('/contact', 'contact');

$testapp->run();


