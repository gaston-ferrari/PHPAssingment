<?php

require_once(__DIR__  . '/bootstrap.php');
require_once(__DIR__  . '/Routes.php');

$routes = new Routes();

$addressController = new \Api\Controller\AddressController();

$routes->get("/address", array($addressController, 'showAddress'));
$routes->post("/address", array($addressController, 'addAddress'));
$routes->del("/address", array($addressController, 'deleteAddress'));
$routes->put("/address", array($addressController, 'updateAddress'));

$path = $_SERVER['PATH_INFO'];
$method = $_SERVER['REQUEST_METHOD'];

try{
    $handler = $routes->getHandler($path, $method);
    call_user_func($handler);
} catch (Exception $ex) {
    http_response_code(500);
    echo $ex->getMessage();
}
