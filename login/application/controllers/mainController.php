<?php

require '../application/core/Controller.php';
require '../application/core/BD.php';
require '../application/models/User.php';

class Main extends Controller {
    public function index() {
        $this->view('mainview');
    }

    public function searchForUsers($string = '') {
        $bd = new DB;

        $result = User::emailMatching($bd->getConnection(), $string);
        header('Content-type: application/json');
        $response = array('response' => $result);

        echo json_encode($response);
    }
}