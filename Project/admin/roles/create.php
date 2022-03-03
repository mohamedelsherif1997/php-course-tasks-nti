<?php

require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';




if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    
    # Validate Input ... 

    $errors = [];
    # Validate Name ... 
    if (!validate($name, 1)) {
        $errors['Name'] = " Title Required";
    }


   


    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 

        

            $sql = "insert into roles (role_title) values ('$name')";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again"];
            }

            $_SESSION['Message'] = $message;
        }
    
}



require '../design/header.php';
require '../design/sideNav.php';
require '../design/nav.php';


?>
<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Add Role</h3>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Roles Form</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate accept-charset="utf-8" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        
                        <?php displayMessages(); ?>


                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Role Title</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                <small class="form-text text-muted">Enter Role Title.</small>

                            </div>
    
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> ADD</button>
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