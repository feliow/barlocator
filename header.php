<DOCTYPE! html>
<html>
	<head>
		<title>Barlocator</title>
		<link rel="icon" type="image/png" href="css/icon.png"/>
		<link rel="stylesheet" type="text/css" href="css/barlocator.css">
		<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<meta charset="utf-8">
	</head>
<header>
	<div class="menu">
			<a class="menu <?php echo $current_page == 'index.php'? 'active': NULL?>" href="index.php">BARS</a>
			<a class="menu <?php echo $current_page == 'favorites.php'? 'active': NULL?>" href="favorites.php" class="fav">FAVORITES</a>
			<a class="menu <?php echo $current_page == 'about.php'? 'active': NULL?>" href="about.php" class="abo">ABOUT US</a>
			<a class="menu <?php echo $current_page == 'SQLinjections.php'? 'active': NULL?>" href="SQLinjections.php">GALLERY</a>
			<div class="himg"><img src="img/logo.png"></div>
	</div>
</header>