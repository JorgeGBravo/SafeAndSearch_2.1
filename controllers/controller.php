<?php

function dateDifference($date_1 , $date_2)
{
    $explodeTime1 = explode(' ', $date_1);
    $explodeTime2 = explode(' ', $date_2);
    $timeNow = strtotime($explodeTime1[1]);
    $dateTimeLogin = strtotime($explodeTime2[1]);
    return round(abs($timeNow -$dateTimeLogin) / 60.2);
}

