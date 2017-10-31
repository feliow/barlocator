<!DOCTYPE html>
<html>
<head>

</head>
<body id="gallery" >
<?php include("header.php"); ?>
<?php
                echo "Upload a picture: ";
                echo '<a class="return" href="SQLInjections.php">click here</a>';
                echo '<br/>';

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
             echo '<img class="bild" src="'.$image .'" alt="Random image" width="320px"/>';
            } else {
                continue;
            }
          }
       ?>
</body>
</html>