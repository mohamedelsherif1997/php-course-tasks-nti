<?php

session_start();

if(!isset($_SESSION['user'])){

    require "dbconnect.php";
    require "helpers.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = Clean($_POST['email']);
        $password = Clean($_POST['password']);

        $errors = [];

        // Email Validation 

        if (empty($email)) {
            $errors['email'] = "Field Required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['Email']   = "Invalid Email";
        }

        // Password Validation 

        if (empty($password)) {
            $errors['password'] = "Field Required";
        } elseif (strlen($password) < 6) {
            $errors['Password'] = "Length Must be >= 6 chars";
        }

        if(count($errors) > 0){
            foreach($errors as $key => $error){
                echo "----> " . $key . " : " . $error . "<br>";
            }

        }else {

        $password = md5($password);

        $sql = "select * from users where email = '$email' and password ='$password'";
        
        $op = mysqli_query($con,$sql);
        
        
        if(mysqli_num_rows($op) == 1){

            $result = mysqli_fetch_assoc($op);

            $_SESSION['user'] = $result;
            
            header('Location: index.php');
        }else {
            echo "Not A valid Data";
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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
           <div> 
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter Your Email">
           </div>

           <div>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Your Password">
           </div>
           
           <input type="submit" value="Login" >

        </form>

        <div>
            <a href="register.php">Reqister</a>
        </div>
    </div>
    
</body>
</html>

<?php
}
else {
     header("Location: index.php");
}

 ?>