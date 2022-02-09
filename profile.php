<?php

    session_start();

    if(count($_SESSION) > 0){

        echo $_SESSION['Message'].'<br>';
        echo $_SESSION['user']['name'] . '<br>';
        echo $_SESSION['user']['email'] . '<br>';
        echo $_SESSION['user']['address'] . '<br>';
        echo $_SESSION['user']['Linkedin'] . '<br>';
        
        }else{
            
          echo ' No Session <br> ';
        }
      

?>
