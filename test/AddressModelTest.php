<?php

class AddressModelTest extends PHPUnit_Framework_TestCase {
    
    public function testInsertionAndDeletion (){
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);
        $addressModel->insertAddress(["john", "1234566", "fake street 1"]);
        $insertedAddress = $addressModel->getAddress($index);
        $this->assertEquals('john', $insertedAddress['name']);
        $index++;
        $addressModel->insertAddress(["paul", "5633200", "fake street 2"]);
        $insertedAddress = $addressModel->getAddress($index);
        $this->assertEquals('paul', $insertedAddress['name']);
        $addressModel->deleteAddress($index);
        $index--;
        $addressModel->deleteAddress($index);
        
        $this->assertEquals(false, $addressModel->getAddress($index));
        $index++;
        $this->assertEquals(false, $addressModel->getAddress($index));
    }
    
    public function testUpdate (){
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);
        $addressModel->insertAddress(["john", "1234566", "fake street 1"]);
        $addressModel->updateAddress($index, [$index, "johnny", "1234566", "fake street 1"]);
        $insertedAddress = $addressModel->getAddress($index);
        $this->assertEquals('johnny', $insertedAddress['name']);
        $addressModel->deleteAddress($index);
        $this->assertEquals(false, $addressModel->getAddress($index));
    }
    
    public function testUpdateAndDeletion (){
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);
        $addressModel->insertAddress(["john", "1234566", "fake street 1"]);
        $index++;
        $addressModel->insertAddress(["paul", "5633200", "fake street 2"]);
        $addressModel->updateAddress($index, [$index, "paulie", "5633200", "fake street 2"]);
        $index--;
        $addressModel->deleteAddress($index);
        $index++;
        $insertedAddress = $addressModel->getAddress($index);
        $this->assertEquals('paulie', $insertedAddress['name']);
        $addressModel->deleteAddress($index);
    }
}
