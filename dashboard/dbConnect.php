<?php 
    $server = "localhost";
    $db = "myDB";
    $dbUser = "root";
    $dbPass = "";

    $conn = mysqli_connect($server,$dbUser,$dbPass,$db);

    if(!$conn){
        die ("Error: " . mysqli_connect_error());
    }
?>