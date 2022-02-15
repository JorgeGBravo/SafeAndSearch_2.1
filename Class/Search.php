<?php
require_once("DataBase.php");
require_once("config.php");
require_once("Login.php");


class Search extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function querySearch($string, $language)
    {
        return "SELECT * FROM meaningQuery INNER JOIN users ON meaningQuery.lastUserWhoModifiedTheField = users.id WHERE meaningQuery.query ='" . $string . "'AND meaningQuery.typeLang ='" . $language . "'";
    }

    public function getSearch($string)
    {
        (new Login)->isLogged();
        (new Login)->updateSession();
        $encodings = mb_list_encodings();
        $language = mb_detect_encoding($string, $encodings);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $result = $this->connection->query($this->querySearch($string, $language));
        (new Login)->updateSession();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}