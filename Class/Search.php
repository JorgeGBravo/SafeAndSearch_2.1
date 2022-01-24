<?php
require_once("DataBase.php");
require_once("config.php");


class Search extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function querySearch($string, $language)
    {
        return "SELECT * FROM meaningQuery WHERE query ='" . $string . "'AND typeLang ='" . $language . "'";
    }
    public function decrypt($data)
    {
        return openssl_decrypt($data, CYPHER_ALGO, PASS_ENCRYPT);
    }
    public function getSearch($string)
    {
        $encodings = mb_list_encodings();
        $language = mb_detect_encoding($string, $encodings);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $result = $this->connection->query($this->querySearch($string, $language));
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}