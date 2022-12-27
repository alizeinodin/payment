<?php
require_once '../Model/database.php';

class registerController implements Controller
{
    private $arr = [];

    public function validation()
    {

    }

    public function prepare()
    {
        $this->validation();
    }
}

