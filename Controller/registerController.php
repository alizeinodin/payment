<?php
require_once '../Model/database.php';
require_once 'Controller.php';
require_once 'stnController.php';

session_start();

class registerController implements Controller
{
    private $arr = [];

    public function validation()
    {
        if ($_SESSION['csrf_token'] != $_POST['csrf_token']) {
            $_SESSION['ERROR.message'] = 'درخواست شما پذیرفته نشد!';
            $_SESSION['ERROR.type'] = 'csrf';
            header('location:../index.php');
            return false;
        }
        if (!$this->nameValidation()) {
            $_SESSION['ERROR.message'] = 'نام شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'name';
            header('location:../index.php');
            return false;
        }
        if (!$this->phoneValidation()) {
            $_SESSION['ERROR.message'] = 'تلفن شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'phone';
            header('location:../index.php');
            return false;
        }
        if (!$this->ssnValidation()) {
            $_SESSION['ERROR.message'] = 'شماره ملی شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'ssn';
            header('location:../index.php');
            return false;
        }
        if (!$this->stnValidation()) {
            $_SESSION['ERROR.message'] = 'شماره دانشجویی شما به درستی وارد نشده است!';
            $_SESSION['ERROR.type'] = 'stn';
            header('location:../index.php');
            return false;
        }
        return true;
    }

    public function prepare()
    {
        $_DB = new DB();

        unset($_SESSION['ERROR.message']);
        unset($_SESSION['ERROR.type']);

        if (!$this->validation()) {
            return false;
        }

        $prepare = $_DB->pdo->prepare("SELECT * FROM `user`, `payment` WHERE (ssn = '{$_POST['ssn']}' OR phone = '{$_POST['phone']}' OR stn = '{$_POST['stn']}') and payment.user_id = user.id and payment.status = 'accepted'");
        $prepare->execute();
        $result = $prepare->rowCount();

        if ($result != 0) {
            $_SESSION['ERROR.message'] = 'شما قبلا ثبت نام کرده اید';
            $_SESSION['ERROR.type'] = 'global';
            header('location:../index.php');
            return false;
        }

        $prepare = $_DB->pdo->prepare("SELECT * FROM `user` WHERE ssn = '{$_POST['ssn']}' OR phone = '{$_POST['phone']}' OR stn = '{$_POST['stn']}' ");
        $prepare->execute();
        $result = $prepare->rowCount();

        if ($result == 0) {
            $prepare = $_DB->pdo->prepare("INSERT INTO `user` (`name`, `ssn`, `phone`, `stn`)
            VALUES ('{$_POST['name']}', '{$_POST['ssn']}', '{$_POST['phone']}','{$_POST['stn']}')");
            $prepare->execute();
        }

        // bu ali computer student and check free register
        $stnCnt = new stnController();
        if($stnCnt->prepare()) {

        }

        $orderId = $this->makeOrder();
        $token = $this->tokenRequest($orderId);

        header("location:https://nextpay.org/nx/gateway/payment/{$token}");
        return true;
    }

    private function makeOrder()
    {
        $_DB = new DB();

        $prepare = $_DB->pdo->prepare("SELECT * FROM `user` WHERE ssn ='{$_POST['ssn']}'");
        $prepare->execute();
        $result = $prepare->fetchAll();
        $user = $result[0];

        $prepare = $_DB->pdo->prepare("INSERT INTO `payment` 
            (`amount`, `status`, `created_at`, `user_id`)
            VALUES ('20000', 'pending', now(), '{$user['id']}')");
        $prepare->execute();
        return $_DB->pdo->lastInsertId();
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
        if (isset($_POST['ssn']) and strlen($_POST['ssn']) == 10) {
            return true;
        }
        return false;
    }

    private function phoneValidation()
    {
        if (isset($_POST['phone']) and
            strlen($_POST['phone']) == 11) {
            return true;
        }
        return false;
    }

    private function stnValidation()
    {
        if (isset($_POST['stn'])) {
            if (is_string($_POST['stn']) and strlen($_POST['stn']) <= 11 and strlen($_POST['stn']) >= 10) {
                return true;
            }
            return false;
        } else {
            return true;
        }
    }
}

$r = new registerController();
$r->prepare();
