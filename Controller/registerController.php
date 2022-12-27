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
        if (!$this->nameValidation()) {
            $_SESSION['ERROR.message'] = 'نام شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'name';
        }
        if (!$this->phoneValidation()) {
            $_SESSION['ERROR.message'] = 'تلفن شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'phone';
        }
        if (!$this->ssnValidation()) {
            $_SESSION['ERROR.message'] = 'شماره ملی شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'ssn';
        }
        if (!$this->stnValidation()) {
            $_SESSION['ERROR.message'] = 'شماره دانشجویی شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'stn';
        }
    }

    public function prepare()
    {
        unset($_SESSION['ERROR.message']);
        unset($_SESSION['ERROR.type']);

        $this->validation();

        $prepare = $_DB->prepare("SELECT * FROM `user` WHERE ssn = {$_POST['ssn']} OR phone = {$_POST['phone']} OR stn = {$_POST['stn']}");
        $prepare->execute();
        $result = $prepare->fetchAll();

        if (count($result) != 0) {
            $_SESSION['ERROR.message'] = 'شما قبلا ثبت نام کرده اید';
            $_SESSION['ERROR.type'] = 'global';
        }

        $prepare = $_DB->prepare("INSERT INTO `user` (`name`, `ssn`, `phone`, `stn`) 
            VALUES ({$_POST['name']}, {$_POST['ssn']}, {$_POST['phone']},'{$_POST['stn']}')");
        $prepare->execute();
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

    private function stnValidation()
    {
        if (isset($_POST['stn'])) {
            if (is_string($_POST['stn'])) {
                return true;
            }
            return false;
        } else {
            return true;
        }
    }
}

