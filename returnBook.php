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

$bookid = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $bookid . '>';

$bookid = trim($_GET['bookid']);      // From the hidden field
$bookid = addslashes($bookid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo $bookid;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE books SET onloan=0 WHERE ISBN = ?");
    $stmt->bind_param('i', $bookid);
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
    



    


