<?include ("header.php");?>s
<body>
	<div id="pagecontainer">
		<div class="contact">
<<<<<<< HEAD
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
=======
			<img src="img/aboutpic.jpg"/>
			<h2>CONTACT</h2>
			<P>ELLET 073-5986774</P>
			<P>stinisen 073-5986774</P>
			<P>elin 073-5986774</P>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rutrum quis arcu in molestie. 
				Nulla vehicula a justo a vestibulum. </p>
>>>>>>> 7b9532ac9a793d072f247a8518674a7edb035623
		</div>
	</div>
</body>
</html>