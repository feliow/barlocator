<? include("header.php");?>
<? include ("config.php");?>
<body>
	<div id="pagecontainer">
		<div id="browse">
			<form action="bars.php" method="POST">
			  NAME OF BAR<br>
			  <input type="text" name="barname" value="">
			  <br><br>
			  OR, YOUR LOCATION<br>
			  <input type="text" name="location" value="">
			  <br><br>
			  <input class="submit" type="submit" value="Submit">
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
				echo '<div>';
				while ($stmt->fetch()) {
					if ($favorite == 0) {
						$favorite = "NO";
					}
					else {
						$favorite = "YES";

				}

				    echo "<div id='bardiv'>";
				    echo "<h3> $name </h3><p><b>Where?</b></br> $area </p><p><b>When?</b></br> $day </p>";
				   	echo '<a href="favorites.php?barID=' . ($barID) . '">✔</a>';
				    echo "</div>";

				}
				echo "</div>";
			?>
<?php


$barID = trim($_GET['barID']);
echo '<INPUT type="hidden" name="barID" value=' . $barID . '>';

//$barID = trim($_GET['barID']);      // From the hidden field
//$barID = addslashes($barID);

//$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo $barID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE Bars SET favorite=0 WHERE barID = ?");
    $stmt->bind_param('i', $barID);
    $stmt->execute();
  	header("favorites.php");
			    

?>
			</div>


	</div>
</body>
</html>
