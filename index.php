<?include ("header.php");?>
<?include ("config.php");?>
<body>
	<div id="pagecontainer">
		<div id="search">
			<h1></h1>
			<form action="index.php" method="POST">
			<input type="text" name="barname" placeholder="Search for the perfect bar for you...">
			</form>
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

				$stmt = $db->prepare($query);
				$stmt->bind_result($barID, $name, $area, $day, $favorite);
				$stmt->execute();
				echo '<table>';
				echo '<tr><b><td>Barname</td><td>Location</td> <td>Openhours</td><td>Favorite!</td></b> </tr>';
				while ($stmt->fetch()) {
					if ($favorite == 0) {
						$favorite = "NO";
					}
					else {
						$favorite = "YES";

				}

				    echo "<tr>";
				    echo "<td> $name </td><td> $area </td><td> $day </td>";
				   	echo '<td><a href="favorites.php?barID= ' . ($barID) . '">✔</a></td>';
				    echo "</tr>";
				}
				echo "</table>";
			?>

			<?php // kod som tidigare låg i favbars.php

			$barID = trim($_GET['barID']);
			echo '<INPUT type="hidden" name="barID" value=' . $barID . '>';

			$barID = trim($_GET['barID']);      // From the hidden field
			$barID = addslashes($barID);

			$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

			    if ($db->connect_error) {
			        echo "could not connect: " . $db->connect_error;
			        printf("<br><a href=index.php>Return to home page </a>");
			        exit();
			    }

			    $stmt = $db->prepare("UPDATE Bars SET favorite=1 WHERE barID = ?");
			    $stmt->bind_param('i', $barID);
			    $stmt->execute();
			    exit;
			?>
			</div>

	</div>
</body>
</html>