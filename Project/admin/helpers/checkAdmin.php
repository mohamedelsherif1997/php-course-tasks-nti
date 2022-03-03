<?php 

   if($_SESSION['User']['role_id'] != 1){

    header("Location: ".url('index.php'));
   
}



?>
