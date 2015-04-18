<?php

require_once(__DIR__  . '/ClassLoader.php');

$classLoader = new \ClassLoader('Api', __DIR__ . '/src');
$classLoader->registerLoader();


$path = $_SERVER['PATH_INFO'];
if ($path == '/address') {
    $controller = new \Api\Controller\AddressController();
    $return = $controller->ex();
    echo $return;
}
