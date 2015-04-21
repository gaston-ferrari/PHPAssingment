<?php

require_once(__DIR__  . '/bootstrap.php');
require_once(__DIR__  . '/Routes.php');

$req = new \Api\Util\Request();
$routes = new Routes();

$addressController = new \Api\Controller\AddressController();

$routes->get("/address", array($addressController, 'showAddress'));
$routes->post("/address", array($addressController, 'addAddress'));
$routes->del("/address", array($addressController, 'deleteAddress'));
$routes->put("/address", array($addressController, 'updateAddress'));

try{
    $handler = $routes->getHandler($req->getPath(), $req->getType());
    call_user_func($handler, $req);
} catch (Exception $ex) {
    http_response_code(500);
    echo $ex->getMessage();
}
