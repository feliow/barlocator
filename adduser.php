<?php
include("config.php");
$title = "Add new User";
include("header.php");
?>

<?php
if (isset($_POST['newuser'])) {
    // This is the postback so add the book to the database
    # Get data from form
    $newuser = trim($_POST['newuser']);
    $newpass = trim($_POST['newpass']);
    $newpassHash = password_hash($newpass, PASSWORD_DEFAULT);
    if (!$newuser || !$newpass) {
        printf("You must specify both a username and an password");
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    $newuser = addslashes($newuser);
    $newpass = addslashes($newpass);

    # Open the database using the "barlocator" account
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    // Prepare an insert statement and execute it
    $stmt = $db->prepare("insert into user (username, userpass) values (?, ?)");
    $stmt->bind_param('ss', $newuser, $newpass);
    $stmt->execute();
    printf("<br>User Added!");
    printf("<br><a href=gallery.php>Watch gallery</a>");
    exit;
}

// Not a postback, so present the book entry form
?>

<h3>Sign Up</h3>
<hr>
You must enter both a title and an author and other stuff you have in the database....
<form action="adduser.php" method="POST">
    <table bgcolor="#ddd" cellpadding="6">
        <tbody>
            <tr>
                <td>Username:</td>
                <td><INPUT type="text" name="newuser"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><INPUT type="text" name="newpass"></td>
            </tr>
            <tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Add User"></td>
            </tr>
        </tbody>
    </table>
</form>