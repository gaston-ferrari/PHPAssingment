<?php

namespace Api\Controller;

class AddressController {

    private $addressModel;

    public function __construct() {
        $this->addressModel = new \Api\Model\AddressModel();
    }

    function showAddress($request) {
        $reqData = $request->getData();
        $id = filter_var($reqData['id'], FILTER_VALIDATE_INT);
        if ($id === FALSE) {
            throw new \Exception("Invalid input.");
        }
        $address = $this->addressModel->getAddress($id);
        if($address!==FALSE){
            return $address;
        }else{
            throw new \Exception("Address not found");
        }
    }

    function addAddress($request) {
        $reqData = $request->getData();
        $json = isset($reqData['address'])? $reqData['address'] : FALSE;
        if ($json === FALSE) {
            throw new \Exception("Invalid input.");
        }
        $address = json_decode($json, true);
        if (!isset($address["name"]) || !isset($address["phone"]) || !isset($address["street"])) {
            throw new \Exception("Invalid address.");
        }
        $res = $this->addressModel->insertAddress([$address["name"], $address["phone"], $address["street"]]);
        if ($res) {
            return "Address added successfully";
        } else {
            throw new \Exception("There was an error inserting the address.");
        }
    }

    function deleteAddress($request) {
        $reqData = $request->getData();
        $id = filter_var($reqData['id'], FILTER_VALIDATE_INT);
        if ($id === FALSE) {
            throw new \Exception("Invalid input.");
        }
        if ($this->addressModel->deleteAddress($id)) {
            return "Address deleted successfully.";
        } else {
            throw new \Exception("No address to delete.");
        }
    }

    function updateAddress($request) {
        $reqData = $request->getData();
        $id = filter_var($reqData['id'], FILTER_VALIDATE_INT);
        $json = isset($reqData['address'])? $reqData['address'] : FALSE;
        
        if ($json === FALSE || $id === FALSE) {
            throw new \Exception("Invalid input.");
        }
        $address = json_decode($json, true);
        
        if (!isset($address["name"]) || !isset($address["phone"]) || !isset($address["street"])) {
            throw new \Exception("Invalid address.");
        }
        $res = $this->addressModel->updateAddress($id,[$id, $address["name"], $address["phone"], $address["street"]]);
        if ($res) {
            return "Address updated successfully";
        } else {
            throw new \Exception("There was an error updating the address.");
        }
    }

}
