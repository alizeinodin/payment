<?php
require_once 'Controller.php';

class payment
{
    private $callback_uri = "https://ssces.barfenow.ir/Controller/paymentController.php";
    public function tokenRequest($orderId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://nextpay.org/nx/gateway/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "api_key=65d94dfb-19d8-4357-bcf4-cf570abcf251&amount=20000&callback_uri={$this->callback_uri}&order_id={$orderId}",
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response);
        if ($res['code'] == -1) {
            return $res['trans_id'];
        }
        header("location:../index.php");
    }

    public function redirectToBank($token)
    {
        header("location:https://nextpay.org/nx/gateway/payment/{$token}");
    }

    public function ()
    {

    }
}
