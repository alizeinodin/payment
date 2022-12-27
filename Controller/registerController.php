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

    private function nameValidation()
    {
        if (isset($_POST['name']) and is_string($_POST['name'])) {
            return true;
        }
        return false;
    }

    private function ssnValidation()
    {
        if (isset($_POST['ssn']) and strlen($_POST['ssn'] == 10)) {
            return true;
        }
        return false;
    }
}

