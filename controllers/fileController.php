<?php


function readVariable(){
    $openVar = fopen("variable.txt", "r");
    $idUserEncrypt = fgets($openVar);
    $idUser = (new Encryption)->decrypt($idUserEncrypt);
    return intval($idUser);
}

function deleteVariable(){
    $varNull = "";
    $openVar = fopen("variable.txt", "w+");
    fwrite($openVar, $varNull);
    fclose($openVar);
}

function writeVariable($idUser){
    $idUser = (new Encryption)->encrypt($idUser);
    $openVar = fopen("variable.txt", "w+");
    fwrite($openVar, $idUser);
    fclose($openVar);
}