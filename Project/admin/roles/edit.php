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
$sql = "select * from roles where id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
        

        $sql = "update roles  set role_title = '$name'  where id = $id";
        $op  = mysqli_query($con, $sql);

        if ($op) {
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
            <h3>Edit Role</h3>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Roles Form</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate accept-charset="utf-8" action="edit.php?id=<?php echo  $UserData['id']; ?>" method="post" enctype="multipart/form-data">
                        <?php displayMessages(); ?>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $UserData['role_title']; ?>" required>
                                <small class="form-text text-muted">Enter your name.</small>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Edit</button>
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