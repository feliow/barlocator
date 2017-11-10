<?php include ("header.php") ?>
<?php include ("config.php") ?>

<script>
    
    $(document).ready( function() {
                    
                    function redirect(){
                        window.location = "favorites.php?action=DoThis";
                    }

                    setTimeout(redirect, 1000);

                } );
</script>


     <?php

            $barID = "";

            $barID = trim($_GET['barID']);
            echo '<INPUT type="hidden" name="barID" value=' . $barID . '>';

            $barID = trim($_GET['barID']);      // From the hidden field
            $barID = addslashes($barID);

            $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

                if ($db->connect_error) {
                    echo "could not connect: " . $db->connect_error;
                    printf("<br><a href=index.php>Return to home page </a>");
                    exit();
                }

                $stmt = $db->prepare("UPDATE Bars SET favorite=1 WHERE barID = ?");
                $stmt->bind_param('i', $barID);
                $stmt->execute();
                exit;
    ?>

