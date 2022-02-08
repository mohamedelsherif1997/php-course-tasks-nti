<?php
    if ($_SERVER['REQUEST_METHOD']=='POST'){

        $error = [];

        if (!empty($_POST['name'])){
            $name = $_POST['name'];
            if(filter_var($name , FILTER_VALIDATE_STRING) == true) {
                echo 'Name Validated <br>';
            }else{
                echo 'Invalid Name <br>';
            }
        }else {
            echo 'Name Field Is Empty <br>';
        }

        if (!empty($_POST['email'])){
            $email = $_POST['email'];
            if(filter_var($email , FILTER_VALIDATE_EMAIL) == true) {
                echo 'Email Validated <br>';
            }else{
                echo 'Invalid Email<br>';
            }
        }else {
            echo 'email Field Is Empty <br>';
        }


        if (!empty($_POST['password'])){
            $password = $_POST['password'];
            if(strlen($password) <= 6) {
                echo 'Password Is Too Short <br>';
            }else{
                echo ' Good Password <br>';
            }
        }else {
            echo 'Password Field Is Empty <br>';
        }

        if (!empty($_POST['password'])){
            $address = $_POST['address'];
            if(strlen($address) <= 10) {
                echo 'Adress Is Too Short <br>';
            }else{
                echo ' Good Address <br>';
            }
        }else {
            echo 'Address Field Is Empty <br>';
        }


        if (!empty($_POST['url'])){
            $url = $_POST['url'];
            if(filter_var($url , FILTER_VALIDATE_URL) == true) {
                echo 'Linkedin URL Is  Valid <br>';
            }else{
                echo 'Invalid URL  <br>';
            }
        }else {
            echo 'URL Field Is Empty <br>';
        }



    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>
      
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"  >


            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="name" placeholder="Enter Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Email</label>
                <input type="email" class="form-control" id="exampleInputName" aria-describedby=""   name="email" placeholder="Enter Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Password</label>
                <input type="password" class="form-control" id="exampleInputName" aria-describedby=""   name="password" placeholder="Enter Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Address</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="address" placeholder="Enter Name">
            </div>
            
            <div class="form-group">
                <label for="exampleInputName">Linkedin URL</label>
                <input type="url" class="form-control" id="exampleInputName" aria-describedby=""   name="url" placeholder="Enter Name">
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>