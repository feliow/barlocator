<?php
include("config.php");
$title = "Add new User";
include("header.php");
?>
<div id="pagecontainer">
<?php
if (isset($_POST['newuser'])) {
    $newuser = trim($_POST['newuser']);
    $newpass = sha1($_POST['newpass']);

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
<div id="adduser">
<form action="adduser.php" method="POST">
    <table cellpadding="6">
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
                <td><INPUT type="submit" name="submit" value="Go!"></td>
            </tr>
        </tbody>
    </table>
</form>
</div>
</div>