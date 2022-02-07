<?php

   function nextChar ($char) {

    if ($char != 'z'){

        echo (chr(ord($char)+1));
    }
    else {

        echo 'a';
    }

} 
    nextChar('y');

 ?>