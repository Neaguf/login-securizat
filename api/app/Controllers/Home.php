<?php

namespace App\Controllers;
use stdClass;

class Home extends BaseController
{
    public function index()
    {
        $obj = new stdClass();
        $obj->logat = $this->verifica();

        echo json_encode($obj);
    }
}
