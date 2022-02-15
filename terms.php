<?php
include_once("Class/Search.php");
include_once("Class/Insert.php");
include_once("Class/User.php");
include_once("Class/Login.php");

function condition($argc)
{
    if ($argc == 1) {
        echo "Use:  php Search.php --help.\n",
        "      php Search.php [query].\n",
        "      php Search.php [newUser] [user] [password] [admin].\n",
        "      php Search.php [Login] [user] [password].\n",
        "      php Search.php [word].\n",
        "      php Search.php introduce [word] [context].\n",
        exit;
    }
}

function terms($string)
{
    switch ($string) {
        case "--help":
            echo "      
This application is used to locate information or insert it into a database.            
The command line is simple:

    - /php Search.php [newUser] [user] [password] [admin]
Create a new user only if they are registered as an authorized administrator. Just use 'admin' to create an admin user.

    - /php Search.php [Login] [user] [password] 
This sentence is for logging.
       
    - /php Search.php [word]
The sequence will search for the requested word and return the added value.
        
    - /php Search.php introduce [word] [context]
As your word says, it enters the information corresponding to that word into the database.        
        ";
            exit;
        default:
    }
}


function searchAndIntroduceQuery($argv)
{
    $key = $argv[1];
    switch ($key) {
        case "introduce":
            $data = [];
            $key = $argv[2];
            for ($i = 3; $i < count($argv); $i++) {
                array_push($data, $argv[$i]);
            }
            $insert = new Insert();
            $result = $insert->insertData($key, $data);
            if ($result[0]['STATUS'] == 'false') {
                echo "New record created successfully";
                exit;
            }
            exit;

        case "newUser":
            $username = $argv[2];
            $password = $argv[3];
            $isAdmin = $argv[4];
            $adminBool = false;
            if ($isAdmin === "admin") {
                $adminBool = true;
            }
            (new User)->createUser($username, $password, $$adminBool);
            exit;

        case "Login":
            echo "in login";
            $username = $argv[2];
            $password = $argv[3];
            (new Login)->login($username, $password);
            exit;


        default:
            $search = new Search();
            $result = $search->getSearch($key);
            if (!$result) {
                die('This record does not exist in the database');
            }
            echo "Your search is as follows: \n";
            if (count($result) > 1) {
                foreach ($result as $value) {
                    $valueDecrypt = (new Encryption)->decrypt($value['meaning']);
                    echo "{$result[0]['query']} : {$valueDecrypt}       ->from: {$result[0]['userName']}\n";
                }
                exit;
            }
            $valueDecrypt = (new Encryption)->decrypt($result[0]['meaning']);
            echo "{$result[0]['query']} : {$valueDecrypt}       ->from: {$result[0]['userName']}";
            exit;
    }

}
