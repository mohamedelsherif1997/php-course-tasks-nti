<?php

require 'dbconnect.php';
require 'helpers.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $password = Clean($_POST['password']);

    $errors = [];

    // Name Validation 

    if(empty($name)){
        $errors['Name'] = "Name Field Is Required";
    }

    //Email Validation 

    if(empty($email)){
        $errors['Email'] = "Email Field Is Required"; 
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['Email'] = "Invalid Email";
    }

    // Password Validation 

    if(empty($password)){
        $errors['Password'] = "Password Field Is Required";
    }elseif(strlen($password)< 6){
        $errors['Password'] = "Password Is Too Short";
    }

    if(count($errors) > 0){
        foreach ($errors as $key => $error){
            echo "----> ". $key . " : " . $error ."<br>";
        }

    }
    else {

        $password = md5($password);

        $sql = "insert into users (name,email,password) values ('$name', '$email','$password')";

        $op = mysqli_query($con , $sql);

        mysqli_close($con);

        if($op){
            echo "Done <br> <br>New user was insrted <br>";
            echo "Click <a href='login.php'>here</a> to go to login page<br><br> ";
        }
        else{
            echo "Error Try Again";
        }
    }

}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action = " <?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div>
                <label for="input">Name</label>
                <input type="text" name = "name" placeholder="Enter Your Name">
            </div>

            <div>
                <label for="input">Email</label>
                <input type="email" name = "email" placeholder="Enter Your Email">
            </div>

            <div>
                <label for="input">Password</label>
                <input type="password" name = "password" placeholder="Enter Your Password">
            </div>

            <div>
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
    
</body>
</html>