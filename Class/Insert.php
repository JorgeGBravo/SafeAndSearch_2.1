<?php
require_once("DataBase.php");
require_once("config.php");
require_once("Encryption.php");
require_once("Login.php");


class Insert extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function queryInsert($key, $language, $values, $idUser)
    {
        $createdAt = date('Y-m-d H:i:s');
        return 'INSERT INTO meaningQuery (query, typeLang, meaning, lastUserWhoModifiedTheField, createdAt ) VALUES ("' . $key . '","' . $language . '","' . $values . '","' . $idUser . '""' . $createdAt . '")';
    }


    public function insertData($key, $values)
    {
        (new Login)->isLogged();
        (new Login)->updateSession();
        $idUser = readVariable();
        $encodings = mb_list_encodings();
        $language = mb_detect_encoding($key, $encodings);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $valueCrypt = Encryption::encrypt($values);
        $result = $this->connection->query($this->queryInsert($key, $language, $valueCrypt, $idUser));
        if (isset($result)) {
            return array(['STATUS' => true]);
        }
        return array(['STATUS' => false]);
    }
}