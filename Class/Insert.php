<?php
require_once("DataBase.php");
require_once("config.php");


class Insert extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function queryInsert($key, $language, $values)
    {
        return 'INSERT INTO meaningQuery (query, typeLang, meaning) VALUES ("' . $key . '","' . $language . '","' . $values . '")';
    }
    protected function encrypt($data){
        $dataString = implode(" ", $data);
        return openssl_encrypt($dataString, CYPHER_ALGO,PASS_ENCRYPT);
    }

    public function insertData($key, $values)
    {

        $encodings = mb_list_encodings();
        $language = mb_detect_encoding($key, $encodings);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $valueCrypt = $this->encrypt($values);
        $result = $this->connection->query($this->queryInsert($key, $language, $valueCrypt));
        if (isset($result)) {
            return array(['STATUS' => true]);
        }
        return array(['STATUS' => false]);
    }
}