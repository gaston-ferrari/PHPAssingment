<?php

class AddressControllerTest extends PHPUnit_Framework_TestCase {

    public function testGetAddress() {
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);
        $addressModel->insertAddress(["john", "1234566", "fake street 1"]);

        $addressController = new Api\Controller\AddressController();
        $req = new \Api\Util\Request();
        $req->setData(['id' => $index]);
        $address = $addressController->showAddress($req);
        $this->assertEquals('john', $address['name']);

        $req->setData(['id' => "i"]);
        $threwException = false;
        try {
            $address = $addressController->showAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);
    }

    public function testInsertAddress() {
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);

        $addressController = new Api\Controller\AddressController();
        $req = new \Api\Util\Request();
        $addressJson = json_encode(['name' => 'bob', 'phone' => '1234354', 'street' => 'fake st 1']);
        $req->setData(['address' => $addressJson]);
        try {
            $addressController->addAddress($req);
        } catch (Exception $e) {
            $this->assertEquals("It didn't crash", "It crashed");
        }

        $address = $addressModel->getAddress($index);
        $this->assertEquals('bob', $address['name']);

        $addressJson = json_encode(['name' => 'bob', 'phone' => '1234354']);
        $req->setData(['address' => $addressJson]);
        $threwException = false;
        try {
            $addressController->addAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);

        $addressJson = json_encode(['phone' => '1234354', 'street' => 'fake st 1']);
        $req->setData(['address' => $addressJson]);
        $threwException = false;
        try {
            $addressController->addAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);

        $addressJson = json_encode(['name' => 'bob', 'street' => 'fake st 1']);
        $req->setData(['address' => $addressJson]);
        $threwException = false;
        try {
            $addressController->addAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);
    }

    public function testUpdateAddress() {
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);
        $addressModel->insertAddress(["scottie", "1234566", "fake street 1"]);

        $addressController = new Api\Controller\AddressController();
        $req = new \Api\Util\Request();
        $addressJson = json_encode(['name' => 'mike', 'phone' => '1234354', 'street' => 'fk st 2']);
        $req->setData(['address' => $addressJson, 'id' => $index]);
        try {
            $addressController->updateAddress($req);
        } catch (Exception $e) {
            $this->assertEquals("It didn't crash", "It crashed");
        }

        $address = $addressModel->getAddress($index);
        $this->assertEquals('mike', $address['name']);

        $addressJson = json_encode(['phone' => '1234354', 'street' => 'fake st 1']);
        $req->setData(['address' => $addressJson, 'id' => $index]);
        $threwException = false;
        try {
            $addressController->updateAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);

        $addressJson = json_encode(['name' => 'bob', 'street' => 'fake st 1']);
        $req->setData(['address' => $addressJson, 'id' => $index]);
        $threwException = false;
        try {
            $addressController->updateAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);

        $addressJson = json_encode(['name' => 'bob', 'phone' => '1234354']);
        $req->setData(['address' => $addressJson, 'id' => $index]);
        $threwException = false;
        try {
            $addressController->updateAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);

        $addressJson = json_encode(['name' => 'bob', 'phone' => '1234354', 'street' => 'fk st 2']);
        $req->setData(['address' => $addressJson]);
        $threwException = false;
        try {
            $addressController->updateAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);
    }

    public function testDeleteAddress() {
        $addressModel = new \Api\Model\AddressModel();
        $prevAddresses = $addressModel->getAllAddresses();
        $index = count($prevAddresses);
        $addressModel->insertAddress(["fred", "1234566", "fake street 1"]);

        $addressController = new Api\Controller\AddressController();
        $req = new \Api\Util\Request();
        $req->setData(['id' => $index]);
        try {
            $addressController->deleteAddress($req);
        } catch (Exception $e) {
            $this->assertEquals("It didn't crash", "It crashed");
        }
        $address = $addressModel->getAddress($index);
        $this->assertEquals(false, $address);

        $req->setData(['id' => "i"]);
        $threwException = false;
        try {
            $addressController->deleteAddress($req);
        } catch (Exception $e) {
            $threwException = true;
        }
        $this->assertEquals(true, $threwException);
    }

}
