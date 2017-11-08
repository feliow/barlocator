<?include ("header.php");?>
<?include ("config.php");?>
<body>
	<div id="pagecontainer">
		<div id="search">
			<h2>Lost your bar compass?</h2>
			<h1>Well, you've found the right place:</h1>
			<form action="bars.php" method="POST">
			<input type="text" name="barname" placeholder="Search for the perfect bar for you...">
			</form>
		</div>


	<?php

				$barname = "";
				$location = "";

				if (isset($_POST) && !empty($_POST)) {
				    $barname = trim($_POST['barname']);
				    $location = trim($_POST['location']);
				}

				$barname = addslashes($barname);
				$location = addslashes($location);

				$barname = htmlentities($barname);
				$location = htmlentities($location);

				$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

				if ($db->connect_error) {
				    echo "could not connect: " . $db->connect_error;
				    printf("<br><a href=index.php>Return to home page </a>");
				    exit();
				}

				$query = "SELECT b.barID, name, area, day, favorite
	            FROM Location AS l, Bars AS b, BLO AS blo
	            WHERE b.barID = blo.barID AND blo.locationID = l.locationID";
				if ($barname && !$location) { // name search only
				    $query = $query . " AND name like '%" . $barname . "%'";
				}
				if (!$barname && $location) { // location search only
				    $query = $query . " AND area like '%" . $location . "%'";
				}
				if ($barname && $location) { // name and location and openhours search
				    $query = $query . " AND name like '%" . $barname . "%' and area like '%" . $location . "%'";
				}

			?>

			</div>

	</div>
</body>
</html>