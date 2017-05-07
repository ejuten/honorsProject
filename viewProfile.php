<?php
	session_start();
    
    require_once('require_once/connectvars.php');
?>
<!DOCTYPE html>

<html>
    <head>
        <!--Bootstrap-->
        <?php
            require_once('require_once/linking.html');
        ?>
    </head>
    <body>
        <div class="container">
            <title>Custom Calander - View Profile</title>
            <!--Heading-->
            <div class="jumbotron">
                <h1><strong>View Your User Profile</strong></h1>
            </div>
<?php
    require_once('require_once/navMenu.php');

    //Error if not logged in
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
        exit();
    }
?>
    <div class=col-sm-12>    
<?php
    //Connecting to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to the database. VIEW PROFILE 1');
    
    //Grab information from the customcal_user table
    if (!isset($_GET['user_id'])) {
        $query = "SELECT user_id, username, firstName, lastName, email FROM customcal_user WHERE user_id = '" .
            $_SESSION['user_id'] . "'";
    } else {
        $query = "SELECT user_id, username, firstName, lastName, email FROM customcal_user WHERE user_id = '" .
                    $_GET['user_id'] . "'";
    }
    
    $data = mysqli_query($dbc, $query)
        or die('Error querying database VIEW PROFILE 2');
?>
<br /><br />
<h3>Your Profile Information:</h3>

<?php    
    //Create output table of user information       
    if (mysqli_num_rows($data) == 1) {
        $row = mysqli_fetch_array($data);
        echo '<table class="table"><div class="col-6">';
            if (!empty($row['firstName'])) {
                echo '<tr><td> First Name: </td><td>' . $row['firstName'] 
                        . '</td></tr>';
            } 
            if (!empty($row['lastName'])) {
                echo '<tr><td> Last Name: </td><td>' . $row['lastName'] 
                        . '</td></tr>';
            }
            if (!empty($row['email'])) {
                echo '<tr><td> Email: </td><td>' . $row['email']
                    . '</td></tr>';
            }
            
        echo '</td></tr>';
        echo '</table></div>';
    }
        mysqli_close($dbc);
?>

		</div>
	</div>
	</body>
</html>
