<?php
require_once("DataBase.php");
require_once("Encryption.php");
require_once("config.php");
require_once("controllers/controller.php");
require_once("controllers/fileController.php");


class Login extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function queryLogin($username, $password)
    {
        return "SELECT id FROM users WHERE userName ='" . $username . "'AND password ='" . $password . "'";
    }

    public function queryInsertLogged($idUser, $timeLogged, $nameComputer)
    {
        return 'INSERT INTO logged (idUser, timeLogged, nameComputer) VALUES ("' . $idUser . '","' . $timeLogged . '","' . $nameComputer . '")';
    }

    public function queryLoggedTime()
    {
        return "SELECT idUser, timeLogged FROM logged WHERE nameComputer ='" . NANE_TERMINAL . "'ORDER BY timeLogged DESC ";
    }

    public function queryLoggedTimeUpdate($timeLogged, $idUser)
    {
        return "UPDATE logged SET timeLogged = '" . $timeLogged . "' WHERE  id = (SELECT MAX(id) FROM logged) AND idUser = '" . $idUser . "'";
    }

    public function login($username, $password)
    {
        $timeLogged = date('Y-m-d H:i:s');
        $passwordEncrypt = (new Encryption)->encrypt($password);
        $result = $this->connection->query($this->queryLogin($username, $passwordEncrypt));
        $assocResult = $result->fetch_all(MYSQLI_ASSOC);
        if (count($assocResult) == 0) {
            echo "The username or password do not match";
            exit;
        }
        $idUserAuth = strval($assocResult[0]['id']);
        writeVariable($idUserAuth);
        $this->connection->query($this->queryInsertLogged($idUserAuth, $timeLogged, NANE_TERMINAL));
        echo "logged \n";
        exit;
    }

    public function isLogged()
    {
        $timeNow = date('Y-m-d H:i:s');
        $result = $this->connection->query($this->queryLoggedTime())->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0){
            echo "You are not logged in.";
            exit;
        }
        $difference = dateDifference($timeNow, $result[0]['timeLogged']);
        if ($difference >= 5) {
            deleteVariable();
            echo "You are not logged in.";
            exit;
        }
        $this->updateSession();
        return true;
    }

    public function updateSession()
    {
        $idUserAuth = readVariable();
        $timeNow = date('Y-m-d H:i:s');
        $this->connection->query($this->queryLoggedTimeUpdate($timeNow, $idUserAuth));
    }
}