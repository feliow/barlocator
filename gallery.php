<!DOCTYPE html>
<html>
<head>

</head>
<body id="gallery" >
<?php include("header.php"); ?>
<div class="background">
<?php

if (isset($_FILES['upload'])){
    
    #let's first make a whitelist of allowed extensions
    $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
    
    #now if the user uplaoded an allowed format, we want to know what format that was
    #the following variable will store the extension, all in lower-case
    #substr() is a function that takes only a portion of a string - we need only what comes after the dot
    #we need to get everything after the LAST dot, looking for the extension
    #strrpos returns the position of the last occurrence of a substring in a string
    #we use the file name and a dot to find the extension: strrpos($_FILES['upload']['name'], '.')
    #but we also need to add one space to ignore the dot, so we write +1 at the end.
    #strtolower function changes all capital letters to lower-string so JPG becomes jpg and it fits your whitelist
    #you should take the entire string and put it in 'strtolower'
    $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
    
    
    #we create an array called 'error' to store all our errors, so we can later use them.
    $error = array ();
    
    #here we do our first check, we basically want it to pass so we can upload.
    #if it does not pass, then we give an error.
    #we say, check to see if "externsions" can be found in our array "allowedextensions"
    #if the extension is NOT in the array, we return the error message (we actually add it into the array)
    if(in_array($extension, $allowedextensions) === false){
        
        #add a new array entry
        $error[] = 'This is not an image, upload is allowed only for images.';        
    }
    
    #it is also good to think about the size of the file you want to accept.
    #this is for images, so how big of an image would you like to accept?
    #this is in bytes, and 1000000 is actually 1 mb which is now our limit
    if($_FILES['upload']['size'] > 10000000){
        
        $error[]='The file exceeded the upload limit';
    }
    
    
    #now you do the 'final check' to see if there are no errors in the array.
    #if they array is empty = no errors have been written in it.
    #if there is something in the array 'errors' that means an error has occured and we should not upload
    
    if(empty($error)){
        
        #this is our starding point, in order to upload we need to move the file (uploaded file)
        #all the way to the location we want to store it.
        #But, before we do so it will be good to do all of the ABOVE written first
        #We check for errors that might disturb our code, and try to avoid them
        #if there are no errrors move the file to the desired file location
        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
    }
    
}


?>


<html>
    <head>
        <title>Security - Upload</title>
           </head>
           
           <body>
               <div>
                   <?php 
                   
                   #Now we want to either upload the file or type an error
                   #what we do is basically  check if there's an array named 'error'
                   #and we check if it's empty. If it's empty that means no errors we found
                   #we should proceed with the upload.
                   if (isset($error)){
                       if (empty($error)){
                           
                           #here we give the user the chance to check the file right away. 
                           #this is just for testing purposes so we can see the file is there
                           #when the user clicks, it will open the folder "uploadedfiles" and look for filename
                           echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '">Check file';
                           
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
                   
                   ?>
               </div>
               <div >
                   
                   <form  id="upload" action="" method="POST" enctype="multipart/form-data">
                       <input type="file" name="upload"/><input type="submit" value="add" />
                   </form>                 
               </div>

<?php
/*
following code is from overstack flow and modified
*/

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
</body>
</html>