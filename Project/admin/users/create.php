<?php

require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';



// Fetch Roles Data

$sql = "select * from roles";
$rolesOp  = mysqli_query($con, $sql);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $role_id  = Clean($_POST['role']);

    # Validate Input ... 

    $errors = [];
    # Validate Name ... 
    if (!validate($name, 1)) {
        $errors['Name'] = " Title Required";
    }


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


    # Validate Role_id  ... 
    if (!validate($role_id, 1)) {
        $errors['Role'] = " Role Required";
    } elseif (!validate($role_id, 4)) {
        $errors['Role'] = " Role Invalid";
    }

    #Validate Image ... 
    if (!validate($_FILES['image']['name'], 1)) {
        $errors['Image']  = "Image Required";
    } elseif (!validate($_FILES['image']['name'], 5)) {
        $errors['Image']  = "Image : Invalid Extension";
    }



 


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 

        $image = uploadFile($_FILES);

        if (empty($image) ) {
            $_SESSION['Message'] = ["Error In Uploading File Try Again"];
        } else {

            $password = md5($password);
            $sql = "insert into users (name,email,password,role_id,image) values ('$name' , '$email' ,'$password',$role_id,'$image')";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again"];
            }

            $_SESSION['Message'] = $message;
        }
    }
}



require '../design/header.php';
require '../design/sideNav.php';
require '../design/nav.php';


?>
<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Register</h3>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Users Form</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate accept-charset="utf-8" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        
                        <?php displayMessages(); ?>


                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                <small class="form-text text-muted">Enter your name.</small>

                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                                <small class="form-text text-muted">Enter your email</small>
                            </div>
                        </div>
                        <div class="mb-6">
                        <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" >
                                <small class="form-text text-muted">Enter a valid password</small>
                        </div>
                            <div class="mb-3 col-md-4">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <?php while($data = mysqli_fetch_assoc($rolesOp)){; ?>
                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['role_title']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            
                            <div class="mb-3 col-md-2">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
















<?php

require '../design/footer.php';

?>