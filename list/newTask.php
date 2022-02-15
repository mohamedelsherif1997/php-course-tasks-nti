<?php

require "helpers.php";
require 'dbconnect.php';


if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $title = $_POST['title'];
    $content = $_POST['content'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $errors = [] ;

    // Validate Title 

    if(empty($title)){
        $errors['Title'] = "Title Required";
    }

    // Validate Content 

    if(empty($content)){
        $errors['Content'] = "Content Required";
    }  

    // Validate Image

    if (empty($_FILES['img']['name'])) {
       
        $errors['Image']   = "Image Required";
   
    }else{

       $imgName  = $_FILES['img']['name'];
       $imgTemp  = $_FILES['img']['tmp_name'];

       $nameArray =  explode('.', $imgName);

       $imgExtension =  strtolower(end($nameArray));
       $imgFinalName = time() . rand() . '.' . $imgExtension;
       $allowedExt = ['png', 'jpg','jpeg'];

       if (!in_array($imgExtension, $allowedExt)) {

           $errors['Image']   = "Not Allowed Extension";
       }

   }

   if(count($errors) > 0){

    foreach ($errors as $key => $value) {

        echo ' --->  ' . $key . ' : ' . $value . '<br>';
    }

   }else {

        $disPath = 'uploads/' . $imgFinalName;
        
        if(move_uploaded_file($imgTemp,$disPath)){

        $sql = "insert into tasks (title,content,start,end,image) values ('$title','$content','$start','$end','$imgFinalName')";

        $op  =  mysqli_query($con,$sql);

        mysqli_close($con);

        if($op){
            echo 'Raw Inserted';
        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }
     }else {
         echo "ERORR TRY AGAIN";
     }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">

    <h1>New Task</h1>

    <div>
    <label>Title</label>
    <input type="text" required name="title" placeholder="Enter Title">
    </div>

    <div>
    <label>content</label>
    <input type="text" required name="content" placeholder="Type Your Content" height="80px">
    </div>

    <div>
    <label>Start Date</label>
    <input type="date" required name="start" value="2022-2-15" min = "2022-2-15" max = "3000-3-15">
    </div>

    <div>
    <label>End Date</label>
    <input type="date" required name="end" value="2022-2-15" min = "2022-2-15" max = "3000-3-15">
    </div>

    <div>
    <label>Image</label>
    <input type="file" name="img" >
    </div>


    <input type="submit" value="submit" >

    </form>
    
</body>
</html>