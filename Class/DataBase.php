<?php
require_once ("config.php");


class DataBase
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_error()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}