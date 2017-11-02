<!DOCTYPE html>
<html>
<head>

    <title>Book Club</title>    
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Raleway:300,400,600,700,800" rel="stylesheet">
</head>
<body>


<?php

include("header.php");

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
    
   echo $barID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE books SET favorite=0 WHERE ISBN = ?");
    $stmt->bind_param('i', $barID);
    $stmt->execute();
    printf("<br>Succesfully returned!");
    printf("<br><a class='return' href=browsebooks.php>Search and Book more Books </a>");
    printf("<br><a class='return' href=mybooks.php>Return to Reserved Books </a>");
    printf("<br><a class='return' href=index.php>Return to home page </a>");
    exit;

?>

</div>
            <?php include("footer.php"); ?>

        </div>
        
</body>
</html>
    



    


