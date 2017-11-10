
<?php include("header.php"); ?>
<?php include("config.php"); ?>
<div id="pagecontainer" >
               <div id="form">
                   
                   <form  id="upload" action="" method="POST" enctype="multipart/form-data">
                       <input type="file" name="upload"/><input type="submit" value="add" />
                   </form>                 
               </div>




<?php

if (isset($_FILES['upload'])){
    $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
    $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
    $error = array ();


    if(in_array($extension, $allowedextensions) === false){
        $error[] = 'This is not an image, upload is allowed only for images.';        
    }
    if($_FILES['upload']['size'] > 10000000){
        
        $error[]='The file exceeded the upload limit';
    }
    if(empty($error)){

        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
    }
    
}

                   if (isset($error)){
                       if (empty($error)){
                           echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '">';

                           setcookie('showpic', $_FILES['upload']['name'] , time() + 48 * 3600);
                           
                       } else {
                           #else, if there was an error, then it simply goes through the error array
                           #it prints out ALL errors in the array.
                           #you can have one or more errors. 
                           #e.g. File too big, AND not supported!
                           foreach ($error as $err){
                               echo $err;
                           }
                           
                       }
                   }
                   


#the following code is from stackowerflow and modified url: 
     $files = glob("uploadedfiles/*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
             echo '<div id="pic"> <img class="bild" src="'.$image .'" alt="Random image" width="300px"/></div>';
            } else {
                continue;
            }
          }
       ?>


</div>
