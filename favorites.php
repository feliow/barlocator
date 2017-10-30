<?include ("header.php");?>
<?include ("config.php");?>
<div id="pagecontainer">
		<div id="">
	<?php

				$barname = "";
				$location = "";

				if (isset($_POST) && !empty($_POST)) {
				    $barname = trim($_POST['barname']);
				    $location = trim($_POST['location']);
				}

				$barname = addslashes($barname);
				$location = addslashes($location);

				@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

				if ($db->connect_error) {
				    echo "could not connect: " . $db->connect_error;
				    printf("<br><a href=favorites.php>Return to home page </a>");
				    exit();
				}

				$query ="SELECT name, area, day, favorite
           				FROM Location, Bars, BLO
           				WHERE favorite is true";
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
				$stmt->bind_result($name, $area, $day, $favorite);
				$stmt->execute();
				echo '<table>';
				echo '<tr><b><td>Barname</td><td>Location</td> <td>Openhours</td><td>Your fav...?</td><td>No more fav!</td></b> </tr>';
				while ($stmt->fetch()) {
					if ($favorite == 1) {
						$favorite = "YES";
					}
	
				    echo "<tr>";
				    echo "<td> $name </td><td> $area </td><td> $day </td><td>$favorite </td>";
				   	echo '<td><a href="index.php?barID=' . urlencode($barID) . '"> favorite </a></td>';
				    echo "</tr>";
				}
				echo "</table>";
			?>
		</div>

	</div>
</body>
</html>