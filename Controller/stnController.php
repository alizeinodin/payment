<?php
require_once 'Controller.php';
require_once '../Model/database.php';

class stnController implements Controller
{

    public function validation()
    {
        // TODO: Implement validation() method.
    }

    public function prepare()
    {
        // TODO: Implement prepare() method.
    }

    private function notRegister()
    {
        $_DB = new DB();

        $prepare = $_DB->pdo->prepare("SELECT * FROM `user` WHERE 'stn' = '{$_POST['stn']}");
        $prepare->execute();

        $result = $prepare->fetchAll();

        if (count($result) == 0) {
            return true;
        }
        return false;
    }

    private function isSSCESStudent()
    {
        $stn = $_POST['stn'];
        if (strlen($stn) == 11) {
            if (preg_match("/^(4\d\d)12358\d\d\d/gm", $stn)) {
                return true;
            }
            return false;
        } else if (strlen($stn) == 10) {
            if (preg_match("/^(\d\d)12358\d\d\d/gm", $stn)) {
                return true;
            }
            return false;
        }
        return false;

    }
}
