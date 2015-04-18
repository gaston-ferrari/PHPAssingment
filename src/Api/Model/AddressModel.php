<?php

namespace Api\Model;

class AddressModel {
    
    private $addresses = [];
    
    public function __construct() {
        $file = fopen(__DIR__.'/../../../example.csv', 'r');
        if ($file !== FALSE) {
            while (($line = fgetcsv($file)) !== FALSE) {
                $this->addresses[] = [
                    'name' => $line[0],
                    'phone' => $line[1],
                    'street' => $line[2]
                ];
            }

            fclose($file);
        }
    }
    
    public function getAddress($id) {
        if (!isset($this->addresses[$id])) {
            return null;
        } else {
            return $this->addresses[$id];
        }
    }
}
