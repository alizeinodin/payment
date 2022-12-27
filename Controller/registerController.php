<?php
require_once '../Model/database.php';

class registerController implements Controller
{
    private $arr = [];

    public function validation()
    {
        if ($_SESSION['csrf_token'] != $_POST['csrf_token']) {
            $_SESSION['ERROR.message'] = 'درخواست شما پذیرفته نشد!';
            $_SESSION['ERROR.type'] = 'csrf';
        }
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

    private function phoneValidation()
    {
        if (isset($_POST['phone']) and
            preg_match("09([0-9][0-9])-?[0-9]{3}-?[0-9]{4}", $_POST['phone'])) {
            return true;
        }
        return false;
    }
}

