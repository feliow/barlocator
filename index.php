<?include ("header.php");?>
<?include ("config.php");?>
<body>
	<div id="pagecontainer">
		<div id="search">
			<h1></h1>
			<input type="text" name="search" placeholder="Search for the perfect bar for you...">
		</div>
		<div id="browse">
			<form action="index.php" method="POST">
			  Bar-name:<br>
			  <input type="text" name="barname" value="name">
			  <br><br>
			  Location:<br>
			  <input type="text" name="location" value="location">
			  <br><br>
			  Openhours:<br>
			  <input type="text" name="open" value="open">
			  <br><br>
			  <input type="submit" value="Submit">
			</form>  
		</div>


	<?php
				# This is the mysqli version


				$barname = "";
				$location = "";
				$open = "";

				if (isset($_POST) && !empty($_POST)) {
				# Get data from form
				    $barname = trim($_POST['barname']);
				    $location = trim($_POST['location']);
					$open = trim($_POST['open']);
				}

				$barname = addslashes($barname);
				$location = addslashes($location);
				$open = addslashes($location);


				$barname = htmlentities($barname);
				$location = htmlentities($location);
				$open = htmlentities($location);

				# Open the database
				@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

				if ($db->connect_error) {
				    echo "could not connect: " . $db->connect_error;
				    printf("<br><a href=index.php>Return to home page </a>");
				    exit();
				}

				# Build the query. Users are allowed to search on title, author, or both

				$query = "SELECT b.barID, name, favorite, area, day 
            FROM Location AS l, Bars AS b, Openhours AS o, BLO AS blo
            WHERE blo.barID = b.barID AND blo.locationID = l.locationID AND blo.openID = o.openID";
				if ($barname && !$location && !$open) { // name search only
				    $query = $query . " where b.name like '%" . $barname . "%'";
				}
				if (!$barname && $location && !$open) { // location search only
				    $query = $query . " where l.area like '%" . $location . "%'";
				}
				if (!$barname && !$location && $open) { // openhours search only
				    $query = $query . " where o.day like '%" . $open . "%'";
				}
				if ($barname && $location && $open) { // name and location and openhours search
				    $query = $query . " where b.name like '%" . $barname . "%' and l.area like '%" . $location . "%' and o.day like '%" . $open . "%' ";
				}

				$stmt = $db->prepare($query);
				$stmt->bind_result($name, $favorite, $area, $day);
				$stmt->execute();
				echo '<table>';
				echo '<tr><b><td>Barname</td><td>Location</td> <td>Openhours</td><td>Your fav...?</td><td>Make it your favorite!</td></b> </tr>';
				while ($stmt->fetch()) {
					if ($favorite == 0) {
						$favorite = "NO";
					}
					else {
						$favorite = "YES";
				}

				    echo "<tr>";
				    echo "<td> $name </td><td> $location </td><td>$openhours </td><td> $favorite </td>";
				    echo '<td><a href="favorites.php?barID=' . urlencode($barID) . '"> Favorite </a></td>';
				    echo "</tr>";
				}
				echo "</table>";
			?>

			</div>

	</div>
</body>
</html>