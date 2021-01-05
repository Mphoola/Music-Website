<?php

namespace App\Services;

class zachangu{
    var $success_url='http://wgithost.xyz/za/success.php';
    var $error_url='http://wgithost.xyz/za/error.php';
    var $service_cost=100;
    var $zachangu_api_key='G0cMSD5NxjJ29OZqYfEm';
    var $base='https://zachangu.xyz/api';

    function getPaymentProviders(){
        $payload['providers'] = array(
            'merchant_key'	=>$this->zachangu_api_key, // Merchant api key
            'fetch_type'	=>'null', // path,base64,null
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base.'/providers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "".json_encode($payload).""
            ),
        ));
        $response = curl_exec($curl);
        if(curl_error($curl)){
            $j=false;
        } else{
            //echo $response;
            $j = json_decode($response);
        }
        curl_close($curl);
        return $j;
    }

    function paid($invoiceId){
        if(!isset($invoiceId))return;
        $base  = 'https://ussd.wgithost.xyz/api/checkstatus';
        $query = "invoiceNo=".$invoiceId;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $base);
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $json = json_decode($server_output,true);
        return $json;
    }

    function dump($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }

    function randomId($length=20){
        $keys = range(0,9);
        $key='';
        for($i=0; $i < $length; $i++){
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

}