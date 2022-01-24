<?php
include ("Class/Search.php");
include ("Class/Insert.php");

function condition($argc){
    if($argc == 1) {
        echo "Use:  php Search.php [query].\n",
             "      php Search.php --help.\n",
        exit;
    }
}

function terms($string)
{
    switch ($string) {
        case "--help":
            echo"      
This application is used to locate information or insert it into a database.            
The command line is simple:
    
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
    if ($key === "introduce") {
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
    }
    $search = new Search();
    $result = $search->getSearch($key);
    if (!$result) {
        die('This record does not exist in the database');
    }
    echo "Your search is as follows: \n";
    if (count($result) > 1) {
        foreach ($result as $value) {
            $valueDecrypt = Search::decrypt($value['meaning']);
            echo "{$value['query']} : {$valueDecrypt}\n";
        }
        exit;
    }
    $valueDecrypt = Search::decrypt($result[0]['meaning']);
    echo "{$result[0]['query']} : {$valueDecrypt}";
    exit;
}
