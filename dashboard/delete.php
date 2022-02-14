<?php 

require 'dbConnect.php';

 $id = $_GET['id'];
 
 $sql = "DELETE FROM users WHERE id = $id";

 $action = mysqli_query($conn,$sql);

 if($action){
    $Message =  'DELETED';
 }else{
    $Message = 'Error Try Again';
 }
  $_SESSION['Message'] = $Message;


   header("location: index.php");


?>