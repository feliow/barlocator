<?include ("header.php");?>
<?include ("config.php");?>

<?php

$barID = trim($_GET['barID']);
echo '<INPUT type="hidden" name="barID" value=' . $barID . '>';

$barID = trim($_GET['barID']);      // From the hidden field
$barID = addslashes($barID);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo "You are reserving book with the ID:"           .$barID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE Bars SET favorite=1 WHERE barID = '?'");
    $stmt->bind_param('s', $barID);
    $stmt->execute();
    printf("<br>Book Reserved!");
    printf("<br><a href=index.php>Search and Book more Books </a>");
    printf("<br><a href=favorites.php>Go to My Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
?>s