<?php
include ("terms.php");

$valorString = $argc;
condition($valorString);
$string = $argv[1];
terms($string);
searchAndIntroduceQuery($argv);
