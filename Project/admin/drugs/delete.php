<?php 
require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';


$id = $_GET['id'];

$sql = "select image from drugs where id = $id";
$op  = mysqli_query($con,$sql);
$userData = mysqli_fetch_assoc($op);


$sql = "delete from drugs where id = $id"; 
$op = mysqli_query($con,$sql);

if($op){

     # Remove Image Of User 
     unlink('./uploads/'.$userData['image']);

    $message = ["Raw Removed"];
}else{
    $message = ["Error Try Again"];
}

   $_SESSION['Message'] = $message;
   unset($_SESSION['Message']);

   header("location: index.php"); 


?>