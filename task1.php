<?php

    $bill = readline('Enter the amount: ');

    if ($bill >= 50){
        echo $bill*3.5 . " LE";
    }
    elseif(50 < $bill <= 150){
        echo $bill*4 . " LE";
    }
    else {
        echo $bill*6 . " LE";
    }
    
?>