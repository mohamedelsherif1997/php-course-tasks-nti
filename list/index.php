<?php

session_start();
if (isset($_SESSION['user'])){

require 'dbconnect.php';

$user_id = $_SESSION['user']['id'];

$sql = "select * from tasks where user_id = '$user_id'";

$data = mysqli_query($con, $sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
        border: 1px solid;
        }
    </style>

</head>
<body>

    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
<?php
    while($result = mysqli_fetch_assoc($data)){
 ?>

            <tr>
                <td> <?php echo $result['id']; ?> </td>
                <td> <?php echo $result['title']; ?> </td>
                <td> <?php echo $result['content']; ?> </td>
                <td> <?php echo $result['start']; ?> </td>
                <td> <?php echo $result['end']; ?> </td>
                <td> <img src="<?php echo 'uploads/'.$result['image']; ?>" width ="50px" height="50px" ></td>
                <td> <a href='delete.php?id=<?php  echo $result['id'];  ?>'>Delete</a>  </td>

            </tr>
<?php }?>
        </table>

        <div>
        <a href = 'newTask.php' >Add New Task</a>
        </div>

        <div>
        <a href="logout.php"> Logout </a>
        </div>

    </div>
    
</body>
</html>
<?php
}
else {
    header("Location: login.php");
}
?>