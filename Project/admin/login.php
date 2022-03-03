<?php 

  require './helpers/dbconnect.php';
  require './helpers/functions.php'; 


  if (isset($_SESSION['User'])){
      header("Location: index.php");
  }else{


     if($_SERVER['REQUEST_METHOD'] == "POST"){


        $password = Clean($_POST['password'], 1);
        $email    = Clean($_POST['email']);
    
    
        # Validate ...... 
    
        $errors = [];
    
      # Validate Email .... 
    if (!validate($email, 1)) {
        $errors['Email'] = " Email Required";
    } elseif (!validate($email, 2)) {
        $errors['Email'] = " Email Invalid Field";
    }

    # Validate Password 
    if (!validate($password, 1)) {
        $errors['Password'] = " Password Required";
    } elseif (!validate($password, 3)) {
        $errors['Password'] = " Password Length Must be >= 6 Chars";
    }


    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...
          $_SESSION['Message'] = $errors;
        }
    }else{



        # Login code ...... 
  
        $password = md5($password); 

        $sql = "select * from users where email = '$email' and password = '$password'";

        $result  = mysqli_query($con,$sql); 

          
     
        if( mysqli_num_rows($result) == 1){

          $data = mysqli_fetch_assoc($result); 

          $_SESSION['User'] = $data; 

          header("Location: index.php");


        }else{
            $_SESSION['message'] = ['Error In Email || Password Try Again  '];
        }



    }
    
    
    
    
    
     }


?>



<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Bootstrap Simple Admin Template</title>
    <link href="http://localhost/Project/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Project/assets/css/auth.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img class="brand" src="http://localhost/Project/assets/img/bootstraper-logo.png" alt="bootstraper logo">
                    </div>
                    <h6 class="mb-4 text-muted">Login to your account</h6>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email adress</label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Login</button>
                    </form>            
                </div>
            </div>
        </div>
    </div>
    <script src="http://localhost/Project/assets/vendor/jquery/jquery.min.js"></script>
    <script src="http://localhost/Project/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php

    } 

?>