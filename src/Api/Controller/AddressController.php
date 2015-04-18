<?php

namespace Api\Controller;

class AddressController {

    private $addresses = [];
    private $addressModel;
    
    public function __construct() {
        $this->addressModel = new \Api\Model\AddressModel();
    }

    function ex() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id===FALSE){
            return null;
        }
        $address = $this->addressModel->getAddress($id);
        return json_encode($address);
    }
}
