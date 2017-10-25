<?include ("header.php");?>
<?include ("config.php");?>
<body>
	<div id="pagecontainer">
		<div id="search">
			<h1></h1>
			<input type="text" name="search" placeholder="Search for the perfect bar for you...">
		</div>
		<div id="browse">
			<form action="index.php">
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
				}

				$barname = addslashes($barname);
				$location = addslashes($location);


				$barname = htmlentities($barname);
				$location = htmlentities($location);

				# Open the database
				@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

				if ($db->connect_error) {
				    echo "could not connect: " . $db->connect_error;
				    printf("<br><a href=index.php>Return to home page </a>");
				    exit();
				}

				# Build the query. Users are allowed to search on title, author, or both

				$query = "select * from Bars ";
				if ($barname && !$location) { // Title search only
				    $query = $query . " where title like '%" . $barname . "%'";
				}
				if (!$barname && $location) { // Author search only
				    $query = $query . " where author like '%" . $searchauthor . "%'";
				}
				if ($barname && $location) { // Title and Author search
				    $query = $query . " where title like '%" . $barname . "%' and author like '%" . $location . "%'"; // unfinished
				}

				$stmt = $db->prepare($query);
				$stmt->bind_result($barID, $name, $homepage, $phone, $agelimit, $favorite);
				$stmt->execute();
				echo '<table>';
				echo '<tr><b><td>Barname</td><td>Location</td> <td>Openhours</td><td>Make it your favorite!</td></b> </tr>';
				while ($stmt->fetch()) {
					if ($favorite == 0) {
						$favorite = "NO";
					}
					else {
						$favorite = "YES";
				}

				    echo "<tr>";
				    echo "<td> $name </td><td> $location </td><td>$openhours </td><td> $favorite </td>";
				    echo '<td><a href="favorites.php?bookid=' . urlencode($bookid) . '"> Favorite </a></td>';
				    echo "</tr>";
				}
				echo "</table>";
			?>

			</div>

	</div>
</body>
</html>