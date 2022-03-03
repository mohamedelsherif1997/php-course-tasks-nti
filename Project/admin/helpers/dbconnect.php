<?php

session_start();

$server   = "localhost";
$userName = "root";
$pass     = "";
$dbName   = "pharmacy";


$con = mysqli_connect($server,$userName,$pass,$dbName);

if(!$con){
    echo "Not Connected";
}

?>