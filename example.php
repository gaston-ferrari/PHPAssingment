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
        if (!$id | !isset($this->addresses[$id])) {
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
                    'name' => $line[0],
                    'phone' => $line[1],
                    'street' => $line[2]
                ];
            }

            fclose($file);
        }
    }

}

?>