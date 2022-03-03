<?php 

function Clean($input, $flag = 0)
{

    $input =  trim($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING);   
    }
    return $input;
}


function validate($input,$flag){
   
    $status = true;

      switch ($flag) {
          case 1:
              # code...
               if(empty($input)){
                  $status = false;
               }

              break;

        case 2: 
            # Code ... 
            if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                $status = false;
            }
            break;


        case 3: 
            # Code .... 
            if(strlen($input)<6){
                $status = false;
            }    
            break;

        case 4: 
            # Code .... 
            if(!filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
            }    
            break;

        case 5: 
            # Code .... 
            
            
            $nameArray =  explode('.', $input);
            $imgExtension =  strtolower(end($nameArray));
      
            $allowedExt = ['png', 'jpg','jpeg'];
    
            if (!in_array($imgExtension, $allowedExt)) {
                $status = false;
            }
          break;

       case 6: 
        # code ... 
        $date = explode('-',$input);
    
        if(!checkdate($date[1],$date[2],$date[0])){
          $status = false;
        }

        break;


        case 7: 
            # code .... 
            $date = strtotime($input);

            if($date <= time()){
                $status = false;
            }
            break;








}

return $status;
}





function displayMessages(){

    if(isset($_SESSION['Message'])){
        if($_SESSION['Message'] == ["Raw Inserted"]){
            echo "<div class='alert alert-success'>";
            echo "<h5 class='alert-title'><i class='fas fa-ckeck'></i> Success</h5>";
            echo "<ul>";
            echo "<li> ---- > Raw Inserted</li>";
            echo "</ul>";
            echo "</div>";
            unset($_SESSION['Message']);

        }else{

            echo "<div class='alert alert-danger'>";
            echo "<h5 class='alert-title'><i class='fas fa-exclamation-triangle'></i> Error</h5>";
            echo "<ol>";
            foreach ($_SESSION['Message'] as $key => $value) {
                
                echo ' <li> ---->  '.$value.'</li><br>';
            }
            echo "</ol>";
            echo "</div>";
            unset($_SESSION['Message']);
    }

    }
}





function uploadFile($input){

    $result = '';

    $imgName  = $input['image']['name'];
    $imgTemp  = $input['image']['tmp_name'];

    $nameArray =  explode('.', $imgName);
    $imgExtension =  strtolower(end($nameArray));
    $imgFinalName = time() . rand() . '.' . $imgExtension;

     
    $disPath = 'uploads/' . $imgFinalName;

    if (move_uploaded_file($imgTemp, $disPath)) {
      $result =  $imgFinalName ;
       }

      return $result;  
      
  
}




function url($input){

    return "http://".$_SERVER['HTTP_HOST']."/Project/admin/".$input;
}