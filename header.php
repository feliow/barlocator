<?php include("config.php");?>
<DOCTYPE! html>
<html>
	<head>
		<title>Barlocator</title>
		<link rel="icon" type="image/png" href="css/icon.png"/>
		<link rel="stylesheet" type="text/css" href="css/barlocator.css">
		<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
		<meta charset="utf-8">
	</head>
<header>

	<div>
		  <span id="burger"> &#9776;</span>
	</div>

	<div id="mySidenav" class="sidenav">
		  <a id="closebtn">&times;</a>
		<a class="<?php echo ($current_page == 'bars.php' || $current_page == '') ? 'active' : NULL ?>" href="bars.php"> BARS</a>
		<a class="<?php echo ($current_page == 'favorites.php' || $current_page == '') ? 'active' : NULL ?>" href="favorites.php">FAVORITES</a>
		<a class="<?php echo ($current_page == 'SQLInjections.php' || $current_page == '') ? 'active' : NULL ?>" href="SQLInjections.php">MY GALLERY</a>
		<a class="<?php echo ($current_page == 'about.php' || $current_page == '') ? 'active' : NULL ?>" href="about.php">ABOUT US</a>
	</div>


	<div id="menu">
		<a class="<?php echo ($current_page == 'bars.php' || $current_page == '') ? 'active' : NULL ?>" href="bars.php"> ALL BARS</a>
		<a class="<?php echo ($current_page == 'favorites.php' || $current_page == '') ? 'active' : NULL ?>" href="favorites.php">FAVORITES</a>
		<a class="<?php echo ($current_page == 'about.php' || $current_page == '') ? 'active' : NULL ?>" href="about.php">ABOUT US</a>
		<a class="<?php echo ($current_page == 'SQLinjections.php' || $current_page == '') ? 'active' : NULL ?>" href="SQLinjections.php">MY GALLERY</a>
		<a href="index.php"><div class="himg"><img src="img/logo.png"></div></a>
	</div>

	<script>
	document.getElementById("burger").onclick = function(){openNav()}
	document.getElementById("closebtn").onclick = function(){closeNav()}

	function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(255,255,255)";opacity:0.5;
	}

	function closeNav() {
	    document.getElementById("mySidenav").style.width = "0";
	    document.getElementById("main").style.marginLeft= "0";
	    document.body.style.backgroundColor = "white";
	}

	</script>
</header>


	