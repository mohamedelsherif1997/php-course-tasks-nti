<?php

    session_start();

    function Clean($input, $flag = 0)
{

    $input =  trim($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING); 
    }
    return $input;
}





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $adress   = Clean($_POST['address']);
    $url      = Clean($_POST['url']);


    # Validate ...... 

    $errors = [];

    # validate name .... 
    if (empty($name)) {
        $errors['name'] = "Field Required";
    }


    # validate email 
    if (empty($email)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email']   = "Invalid Email";
    }


    # validate password 
    if (empty($password)) {
        $errors['password'] = "Field Required";
    } elseif (strlen($password) < 6) {
        $errors['Password'] = "Length Must be >= 6 chars";
    }


    if (empty($adress)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_URL)) {
        $errors['url']   = "Invalid URL";
    }


    if (empty($email)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email']   = "Invalid Email";
    }


    if (!empty($_FILES['image']['name'])) {

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];
        $imgType  = $_FILES['image']['type'];  

        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));


        $imgFinalName = time() . rand() . '.' . $imgExtension;


        $allowedExt = ['png', 'jpg'];

        if (in_array($imgExtension, $allowedExt)) {
            //  code .....  

            $disPath = 'uploads/' . $imgFinalName;

            if (move_uploaded_file($imgTemp, $disPath)) {
                echo 'File Uploaded';
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            $errors['Images'] = 'InValid Image Extension';
        }
    } else {

        $errors['Image'] ='Image Required';
    }


    if (count($errors) > 0) {

        foreach ($errors as $key => $value) { 
            # code...

            echo  $key . ' : ' . $value . '<br>';
        }
    } else {

        $_SESSION['user'] = ["name" => $name , "email" => $email , "address" => $adress , "Linkedin" => $url , "image"  = $disPath];

        $_SESSION['Message']    = "Welcome to php Course .... ";
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

            <div class="form-group">
                <label for="exampleInputName">Male</label>
                <input type="radio"  name="male" >
                <br>
                <label for="exampleInputName">Female</label>
                <input type="radio"   name="female"> 
            </div>

            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" class="form-control" id="exampleInputName" aria-describedby=""   name="url" placeholder="Enter Name">
            </div>





            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>