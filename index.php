<?php

require_once(__DIR__  . '/bootstrap.php');
require_once(__DIR__  . '/Routes.php');

$req = new \Api\Util\Request();
$routes = new Routes();

$routes->get("/address", array('Api\Controller\AddressController', 'showAddress'));
$routes->post("/address", array('Api\Controller\AddressController', 'addAddress'));
$routes->del("/address", array('Api\Controller\AddressController', 'deleteAddress'));
$routes->put("/address", array('Api\Controller\AddressController', 'updateAddress'));

try{
    $handler = $routes->getHandler($req->getPath(), $req->getType());
    $controller = new $handler[0];
    $res = $controller->$handler[1]($req);
    echo json_encode($res);
} catch (Exception $ex) {
    http_response_code(500);
    echo $ex->getMessage();
}
