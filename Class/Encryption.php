<?php
require_once("DataBase.php");
require_once("config.php");
require_once("Encryption.php");


class Encryption
{
    public function encrypt($data){
        if(is_array($data)){
            $dataString = implode(" ", $data);
            return openssl_encrypt($dataString, CYPHER_ALGO,PASS_ENCRYPT);
        }
        return openssl_encrypt($data, CYPHER_ALGO,PASS_ENCRYPT);
    }

    public function decrypt($data)
    {
        return openssl_decrypt($data, CYPHER_ALGO, PASS_ENCRYPT);
    }
}