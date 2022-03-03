<?php 
require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';


$id = $_GET['id'];


$sql = "delete from roles where id = $id"; 
$op = mysqli_query($con,$sql);

if ($op){
    header("location: index.php"); 
} 


?>