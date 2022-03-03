<?php
require '../helpers/dbconnect.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';


$sql = "select * from drugs";
$op  = mysqli_query($con, $sql);





require '../design/header.php';
require '../design/sideNav.php';
require '../design/nav.php';
?>
            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Drugs
                            <a href="create.php" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-user-shield"></i> Add Drug</a>
                        </h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Price</th>
                                        <th>Expire Date</th>
                                        <th>Image</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                while($data=mysqli_fetch_assoc($op)){
                                
                                ?>
                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['details']; ?></td>
                                        <td><?php echo $data['price']; ?></td>
                                        <td><?php echo $data['expire_date']; ?></td>
                                        <td><img src="uploads/<?php echo $data['image']; ?>" width="50px" height="50px"></td>
                                        <td class="text-end">
                                            <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                            <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php 
   
   require '../design/footer.php';
   
   ?>