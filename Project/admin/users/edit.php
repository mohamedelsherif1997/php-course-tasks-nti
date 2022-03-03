<?php

require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

//require '../helpers/checkLogin.php';
//require '../helpers/checkAdmin.php';

# Logic ....... 
#############################################################################################

// Fetch User data .... 
$id = $_GET['id'];
$sql = "select * from users where id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch Roles ..... 
$sql = "select * from roles";
$role_op  = mysqli_query($con, $sql);


#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $role_id  = Clean($_POST['role_id']);

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


    # Validate Role_id  ... 
    if (!validate($role_id, 1)) {
        $errors['Role'] = " Role Required";
    } elseif (!validate($role_id, 4)) {
        $errors['Role'] = " Role Invalid";
    }
    #Validate Image ... 
    if (validate($_FILES['image']['name'], 1)) {

        if (!validate($_FILES['image']['name'], 5)) {
            $errors['Image']  = "Image : Invalid Extension";
        }
    }



    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 

        if (validate($_FILES['image']['name'], 1)) {

            $image = uploadFile($_FILES);

            if (!empty($image)) {
                unlink('./uploads/' . $UserData['image']);
            }
        } else {
            $image = $UserData['image'];
        }

        $sql = "update users  set name =  '$name' , email = '$email' , role_id = $role_id , image = '$image' where id = $id";
        $op  = mysqli_query($con, $sql);

        if ($op) {
            $message = ["Raw Updated"];
            $_SESSION['Message'] = $message;

            header("Location: index.php");
            exit();
        } else {
            $message = ["Error Try Again"];
            $_SESSION['Message'] = $message;
        }
    }
}



#############################################################################################

require '../design/header.php';
require '../design/sideNav.php';
require '../design/nav.php';
?>

<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Edit</h3>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Users Form</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate accept-charset="utf-8" action="edit.php?id=<?php echo  $UserData['id']; ?>" method="post" enctype="multipart/form-data">
                        <?php displayMessages(); ?>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $UserData['name']; ?>" required>
                                <small class="form-text text-muted">Enter your name.</small>

                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $UserData['email']; ?>" required>
                                <small class="form-text text-muted">Enter your email</small>
                            </div>
                        </div>

                        <!--
                        <div class="mb-6">
                        <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" >
                                <small class="form-text text-muted">Enter a valid password</small>
                        </div>
                        -->

                            <div class="mb-3 col-md-4">
                                <label for="role_id" class="form-label">Role</label>
                                <select name="role_id" class="form-select" required>
                                    <?php while($roleData = mysqli_fetch_assoc($role_op)){ ?>
                                    <option value="<?php echo $roleData['id']; ?>" <?php if($roleData['id'] == $UserData['role_id']){echo "selected";} ?>><?php echo $roleData['role_title']; ?></option>
                                    <?php  }?>
                                </select>
                            </div>
                            
                            <div class="mb-3 col-md-2">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" required>
                                <img src="uploads/<?php echo $UserData['image']; ?>" width="50px" height="50px" >
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