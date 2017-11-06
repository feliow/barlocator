<?php include("config.php");?>
<DOCTYPE! html>
<html>
	<head>
		<title>Barlocator</title>
		<link rel="stylesheet" type="text/css" href="css/barlocator.css">
		<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<meta charset="utf-8">
	</head>
<header>
	<div id="menu">
		<a class="<?php echo ($current_page == 'bars.php' || $current_page == '') ? 'active' : NULL ?>" href="bars.php"> BARS</a>
		<a class="<?php echo ($current_page == 'favorites.php' || $current_page == '') ? 'active' : NULL ?>" href="favorites.php">FAVORITES</a>
		<a class="<?php echo ($current_page == 'about.php' || $current_page == '') ? 'active' : NULL ?>" href="about.php">ABOUT US</a>
		<a class="<?php echo ($current_page == 'SQLinjections.php' || $current_page == '') ? 'active' : NULL ?>" href="SQLinjections.php">GALLERY</a>
		<a href="index.php"><div class="himg"><img src="img/logo.png"></div></a>
	</div>
</header>

	