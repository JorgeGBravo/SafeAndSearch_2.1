<?php
require_once("DataBase.php");
require_once("config.php");
require_once("Encryption.php");
require_once("Login.php");

class User extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertUserQuery($name, $password, $isAdmin)
    {
        return 'INSERT INTO users (userName, password, isAdmin) VALUES ("' . $name . '","' . $password . '","' . $isAdmin . '")';
    }

    protected function queryExistName($name)
    {
        return "SELECT * FROM users WHERE userName ='" . $name ."'";
    }

    protected  function queryIsAdmin($idUser)
    {
        return "SELECT isAdmin FROM users WHERE id ='" . $idUser ."'";
    }

    public function existUser($name)
    {
        $result = $this->connection->query($this->queryExistName($name));
        if(isset($result)){
            echo 'Username is already in use';
        }
    }

    public function isAdmin()
    {
        $isLogin = (new Login)->isLogged();
        if ($isLogin != true) {
            echo "You are not registered";
            exit;
        }
        $idUser = readVariable();
        $result = $this->connection->query($this->queryIsAdmin($idUser));
        if ($result == false)
        {
            echo "This user no is admin";
            exit;
        }

    }

    public function createUser($username, $password, $isAdmin)
    {
        $this->isAdmin();
        $this->existUser($username);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $passwordEncrypt = (new Encryption)->encrypt($password);
        $result = $this->connection->query($this->insertUserQuery($username, $passwordEncrypt, $isAdmin));
        if(isset($result)){
            echo "User: {$username} \n",
                 "Password: {$password} \n",
                 "This user the user has been inserted.";
            exit;
        }
    }


}