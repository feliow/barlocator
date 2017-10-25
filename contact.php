<?include ("header.php");?>s
<body>
	<div id="pagecontainer">
		<div class="contact">
			<?php
		                echo "Upload a picture: ";
		                echo '<a class="return" href="SQLInjection.php">click here</a>';
		                echo '<br/>';
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
		             echo '<img class="upimg" src="'.$image .'" alt="Random image" width="200px" />';
		            } else {
		                continue;
		            }
		          }
		       ?>
		</div>
	</div>
</body>
</html>