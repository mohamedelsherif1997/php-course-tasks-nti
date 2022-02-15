<?php

    require "dbconnect.php";
    $id = $_GET['id'];

    $sql = "select image from tasks where id='$id'";
    $op = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($op);

    $sql2 = "delete from tasks where id='$id'";

    $op = mysqli_query($con,$sql2);

    if($op){
        unlink('./uploads/'.$data['image']);
    }else {
        echo "ERROR TRY AGAIN";
    }

    header("Location: index.php");

?> 