<?php

$dev = true;
if ($dev) {
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
} else {
    ini_set("display_errors", 0);
    error_reporting(0);
}

function v($s) {
    var_dump($s);
    die;
}