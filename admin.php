<?php
include("header.php");
include("config.php");
?>

<?php

if (isset($_POST['newbarname'])) {
    // This is the postback so add the book to the database
    # Get data from form
    $newbarname = trim($_POST['newbarname']);
    $newhomepage = trim($_POST['newhomepage']);
    $newagelimit = trim($_POST['newagelimit']);
    $newday = trim($_POST['newday']);
    $newimage = trim($_POST['newimage']);
    $newaddress = trim($_POST['newaddress']);

    if (!$newbarname || !$newhomepage || !$newagelimit || !$newday || !$newimage || !$newaddress) {
        printf("You must specify both a name and an location");
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    $newbarname = addslashes($newbarname);
    $newhomepage = addslashes($newhomepage);
    $newagelimit = addslashes($newagelimit);
    $newday = addslashes($newday);
    $newimage = addslashes($newimage);
    $newaddress = addslashes($newaddress);

    # Open the database using the "librarian" account
    $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    // Prepare an insert statement and execute it
    $stmt = $db->prepare("INSERT INTO Bars (name, homepage, agelimit, day, image, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $newbarname, $newhomepage, $newagelimit, $newday, $newimage, $newaddress);
    $stmt->execute();
    printf("<br>Bar Added!");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
}
?>
<h3>Add a new bar</h3>
<hr>
You must enter both a title and an author and other stuff you have in the database....
<form action="admin.php" method="POST">
    <table bgcolor="#ffffff" cellpadding="6">
        <tbody>
            <tr>
                <td>Bars name:</td>
                <td><INPUT type="text" name="newbarname" value=""></td>
            </tr>
            <tr>
                <td>Homepage:</td>
                <td><INPUT type="text" name="newhomepage" value=""></td>
            </tr>
            <tr>
                <td>agelimit:</td>
                <td><INPUT type="text" name="newagelimit" value=""></td>
            </tr>
            <tr>
                <td>day:</td>
                <td><INPUT type="text" name="newday" value=""></td>
            </tr>
            <tr>
                <td>add image:</td>
                <td><INPUT type="text" name="newimage" value=""></td>
            </tr>
            <tr>
                <td>address:</td>
                <td><INPUT type="text" name="newaddress" value=""></td>
            </tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Add Bars"></td>
            </tr>
        </tbody>
    </table>
</form>

