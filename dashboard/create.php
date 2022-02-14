<?php

session_start();

require 'dbConnect.php';

function Clean($input,$flag = 0){

    $input =  trim($input);

    if($flag == 0){
    $input =  filter_var($input,FILTER_SANITIZE_STRING);   // <>>>>>
    }
    return $input;
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $title = Clean($_POST['title']);
    $content = Clean($_POST['content']);
   // $password = Clean($_POST['password']);

    $errors = [];

    // Validating Name 

    if(empty($title)){
        $errors['name'] = "Field Required"; 
    }

    // Validating Email

    if(empty($content)){
        $errors['email'] = "Field Required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors['Email']   = "Invalid Email";
    }

    //Validating Password 
    /*
    if(empty($password)){
        $errors['password'] = "Field Required";
    }elseif(strlen($password) < 6){
        $errors['Password'] = "Length Must be >= 6 chars";
    }
    */
    // Validate Image Uplading 

    if (!empty($_FILES['image']['name'])){

        $imgName = $_FILES['image']['name'];
        $imgSize = $_FILES['image']['size'];
        $imgTemp = $_FILES['image']['tmp_name'];
        $imgType = $_FILES['image']['type'];
        
        $imgExt = explode('.',$imgName);
        $imgExtension = strtolower(end($imgExt));
        $imgFinalName = time(). rand() .'.'. $imgExtension;

        $allowedExtensions = ['png','jpg','jpeg'];

        if(in_array($imgExtension,$allowedExtensions)){

            $path = 'uploads/'.$imgFinalName;
            if(move_uploaded_file($imgTemp,$path)){

               // echo 'Image Uploaded';
            }
            else{
                $errors['img'] = 'Uploading Error';
            }
        }
        else{
            $errors['Img'] = 'Invalid Extension';
        }

    }
    else {
        $errors ['Image'] = "Image Empty";
    }
    

    //Errors Check 

    if(count($errors) > 0){
        // print errors .... 

      echo 'The Numbers of Errors ' . (count($errors) . '<br>');

      foreach ($errors as $key => $value) {
          # code...
  
          echo '- '.$key.' : '.$value.'<br>';
      }

    }else{

        $password = md5($password);


        $sql = "insert into users (name,email,password) values ('$title','$content','$password')";

        $action  =  mysqli_query($conn,$sql);

        mysqli_close($conn);

        if($action){
            header("Location: index.php");
        }else{
            echo 'Error Try Again '.mysqli_error($con);
        } 

    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
      
    <div class="container">
        <h2>Blog</h2>

        <form action="<?php echo   htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">


        <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" required  id="exampleInputName" aria-describedby=""   name="title" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control"  required  id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="Enter Content" height="100px">
            </div>
            <!---
            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword1"   name="password" placeholder="Password">
            </div>
            --->
            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>

            


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <br>


</body>

</html>