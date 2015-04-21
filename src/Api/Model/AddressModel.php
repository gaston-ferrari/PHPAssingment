<?php

namespace Api\Model;

class AddressModel {

    private $dataFile = '/../../../example.csv';

    private function readFile() {
        $content = [];
        $file = fopen(__DIR__ . $this->dataFile, 'r');
        if ($file !== FALSE) {
            while (($line = fgetcsv($file)) !== FALSE) {
                if (isset($line[2])) {
                    $content[] = [
                        'id' => $line[0],
                        'name' => $line[1],
                        'phone' => $line[2],
                        'street' => $line[3]
                    ];
                }else{
                    $content[] = [
                        'id' => $line[0],
                        'deleted' => $line[1]
                    ];
                }
            }

            fclose($file);
        }
        return $content;
    }

    private function saveToFile($addresses) {
        $file = fopen(__DIR__ . $this->dataFile, 'w');
        foreach ($addresses as $address) {
            $results[] = fputcsv($file, $address);
        }
        fclose($file);

        if (!in_array(false, $results)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAddress($id) {
        $addresses = $this->readFile();

        foreach ($addresses as $address) {
            if ($address['id'] == $id && !isset($address['deleted'])) {
                return $address;
            }
        }

        return false;
    }

    public function insertAddress($address) {
        $addresses = $this->readFile();
        $nextId = count($addresses);
        array_unshift($address, $nextId);
        $file = fopen(__DIR__ . $this->dataFile, 'a');
        $length = fputcsv($file, $address);
        fclose($file);
        return $length;
    }

    public function deleteAddress($id) {
        return $this->updateAddress($id, [$id, 'deleted']);
    }

    public function updateAddress($id, $data) {
        $addresses = $this->readFile();
        $newAddresses = [];
        $found = false;
        foreach ($addresses as $address) {
            if ($address['id'] == $id) {
                if(isset($address['deleted'])){
                    throw new \Exception("Address not found");
                }
                $found = true;
                $newAddresses[] = $data;
            } else {
                $newAddresses[] = $address;
            }
        }

        if ($found) {
            return $this->saveToFile($newAddresses);
        } else {
            return false;
        }
    }
    
    public function getAllAddresses(){
        $addresses = $this->readFile();
        return $addresses;
    }

}
