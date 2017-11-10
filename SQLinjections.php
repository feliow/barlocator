
<?php include("header.php"); ?>
<?php include("config.php"); ?>

<?php

$db = new mysqli('localhost', 'root', '', 'barlocator');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

if (isset($_POST['username'], $_POST['userpass'])) {
    $uname = mysqli_real_escape_string($db, $_POST['username']);
    
    $upass = sha1($_POST['userpass']);

    
    
    $query = ("SELECT * FROM user WHERE username = '{$uname}' "."AND userpass = '{$upass}'"."AND name = '{$uname}'");

       
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result(); 
    $totalcount = $stmt->num_rows();
       
        
     if (isset($totalcount)) {
            if ($totalcount == 0) {
             echo '<h2>You got it wrong. Try again</h2>';
         } else { 
            echo '<div id="checkout"><a href="gallery.php">Continue to the GALLERY and upload your own amazing memories! </br>⟶ </a></div>';
         }
            }

    
}
?>

        
        <h3>LOG IN</h3>
        <hr>
        <div id="login" >
        <form method="POST" action="">
            <input type="text" name="username">
            <input type="password" name="userpass"></br></br>
            <input type="submit" value="Go" ><a href="adduser.php">don't have an account?</a>
        </form>
        </div>