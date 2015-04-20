<?php

$path = $_SERVER['PATH_INFO'];
if ($path == '/address') {
    $controller = new \Controller();
    $return = $controller->ex();
    echo $return;
}

class Controller {

    private $addresses = [];

    function ex() {
        $this->rcd();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === FALSE | !isset($this->addresses[$id])) {
            return null;
        } else {
            $address = $this->addresses[$id];
            return json_encode($address);
        }
    }

    function rcd() {
        $file = fopen('example.csv', 'r');
        if ($file !== FALSE) {
            while (($line = fgetcsv($file)) !== FALSE) {
                $this->addresses[] = [
                    'id' =>$line[0],
                    'name' => $line[1],
                    'phone' => $line[2],
                    'street' => $line[3]
                ];
            }

            fclose($file);
        }
    }

}

?>