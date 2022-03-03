<?php

require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';


# Logic ....... 
#############################################################################################

#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name    = Clean($_POST['name']);
    $details = Clean($_POST['details']);
    $date    = Clean($_POST['expire']);
    $price   = Clean($_POST['price']);


    # Validate Input ... 

    $errors = [];
    # Validate title ... 
    if (!validate($name, 1)) {
        $errors['Name'] = " Title Required";
    }


    # Validate Email .... 
    if (!validate($details, 1)) {
        $errors['Details'] = " Content Required";
    }

    # Validate Role_id  ... 
    if (!validate($price, 1)) {
        $errors['Price'] = " Price Required";
    } elseif (!validate($price, 4)) {
        $errors['Price'] = " Price Invalid";
    }

    # Validate Date .... 
    if (!validate($date, 1)) {
        $errors['date'] = " date Required";
    } elseif (!validate($date, 6)) {
        $errors['date'] = " date Invalid";
    } elseif (!validate($date, 7)) {
        $errors['date'] = " date must be > current time ";
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

        if (empty($image)) {
            $_SESSION['Message'] = ["Error In Uploading File Try Again"];
        } else {

            $date = date('Y-m-d',strtotime($date));

            $user_id = $_SESSION['User']['id'];
            $sql = "insert into drugs (name,details,expire_date,price,image) values ('$name' , '$details','$date' ,$price,'$image')";
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
            <h3>Add New Drug</h3>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Drugs Form</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate accept-charset="utf-8" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        
                        <?php  displayMessages(); ?>


                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                <small class="form-text text-muted">Enter your name.</small>

                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Details</label>
                                <input type="text" class="form-control" name="details" placeholder="Details"  required>
                                <small class="form-text text-muted">Enter your drug details</small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Price" required>
                                <small class="form-text text-muted">Enter your drug price</small>
                            </div>
                        </div>
                        <div class="mb-6">
                        <label for="date" class="form-label">Expire Date</label>
                                <input type="date" class="form-control" name="expire" >
                                <small class="form-text text-muted">Enter a valid date</small>
                        </div>
                        <!--
                            <div class="mb-3 col-md-4">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <?php /*while($data = mysqli_fetch_assoc($rolesOp)){; ?>
                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['role_title']; ?></option>
                                    <?php } */?>
                                </select>
                            </div>
                        -->
                            
                            <div class="mb-3 col-md-2">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>
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