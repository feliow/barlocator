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
			  <input type="text" name="barname" value="">
			  <br><br>
			  Location:<br>
			  <input type="text" name="location" value="">
			  <br><br>
			  <input type="submit" value="Submit">
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

				@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

				if ($db->connect_error) {
				    echo "could not connect: " . $db->connect_error;
				    printf("<br><a href=index.php>Return to home page </a>");
				    exit();
				}

				$query = "SELECT barID, name, area, day, favorite
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

				$stmt = $db->prepare($query);
				$stmt->bind_result($barID, $name, $area, $day, $favorite);
				$stmt->execute();
				echo '<table>';
				echo '<tr><b><td>barID</td><td>Barname</td><td>Location</td> <td>Openhours</td><td>Your fav...?</td><td>Make it your favorite!</td></b> </tr>';
				while ($stmt->fetch()) {
					if ($favorite == 0) {
						$favorite = "NO";
					}
					else {
						$favorite = "YES";
				}

				    echo "<tr>";
				    echo "<td> $barID </td><td> $name </td><td> $area </td><td> $day </td><td>$favorite </td>";
				   	echo '<td><a href="favbars.php?barID=' . urlencode($barID) . '"> Favorite </a></td>';
				    echo "</tr>";
				}
				echo "</table>";
			?>

			</div>

	</div>
</body>
</html>