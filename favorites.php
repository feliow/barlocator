<?include ("header.php");?>
<?include ("config.php");?>

<div id="pagecontainer">
		<div id="">
	<?php
				$barname = "";
				$location = "";
				$barID = "";

				if (isset($_POST) && !empty($_POST)) {
				    $barname = trim($_POST['barname']);
				    $location = trim($_POST['location']);
				}

				$barname = addslashes($barname);
				$location = addslashes($location);

				$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

				if ($db->connect_error) {
				    echo "could not connect: " . $db->connect_error;
				    printf("<br><a href=favorites.php>Return to home page </a>");
				    exit();
				}

				$query ="SELECT Bars.barID, name, area, day, favorite
           				FROM Bars, Location, BLO
           				WHERE Bars.favorite = 1 AND Bars.barID = BLO.barID AND Location.locationID = BLO.locationID";
           				
				if ($barname && !$location) { // name search only
				    $query = $query . " where name like '%" . $barname . "%'";
				}
				if (!$barname && $location) { // location search only
				    $query = $query . " where area like '%" . $location . "%'";
				}
				if ($barname && $location) { // name and location and openhours search
				    $query = $query . " where name like '%" . $barname . "%' and area like '%" . $location . "%'";
				}

				$stmt = $db->prepare($query);
				$stmt->bind_result( $barID, $name, $area, $day, $favorite);
				$stmt->execute();
				echo '<table>';
				echo '<tr><b><td>Barname</td><td>Location</td> <td>Openhours</td><td>Your fav...?</td><td>No more fav!</td></b> </tr>';
				while ($stmt->fetch()) {
					if ($favorite == 1) {
						$favorite = "YES";
					}
	
				    echo "<tr>";
				    echo "<td> $name </td><td> $area </td><td> $day </td><td>$favorite </td>";
				   	echo '<td><a href="nofavorite.php?barID=' . ($barID) . '"> no favorite </a></td>';
				    echo "</tr>";
				}
				echo "</table>";
			 // kod som tidigare låg i favbars.php

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