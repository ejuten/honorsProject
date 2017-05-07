<?php
    session_start();
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
                <title>Custom Calander - Edit Profile</title>
                <!--Heading-->
                <div class="jumbotron">
                   <h1><strong>Edit Your User Profile</strong></h1>
                </div>

<?php
    require_once('require_once/connectvars.php');

    $URL = 'viewProfile.php';
    
    //Error if not logged in
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="login">Please <a href="login.php>log in</a> to access this page.</p>';
        exit();
    }
?>  
    <div class=col-sm-12>
<?php
    require_once('require_once/navMenu.php');
?>
   
<?php
    
    //Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to database.');
    
    //Once submit is pressed, grab information entered by user       
    if (isset($_POST['submit'])) {
        $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
        $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $error = false;
    
        //Update the user information in the customcal_user table
        if (!$error) {
            if (!empty($first_name) && !empty($last_name) && !empty($email)) {
                $query = "UPDATE customcal_user SET firstName = '$first_name', " .
                        " lastName = '$last_name', email = '$email' WHERE user_id = '" .
                        $_SESSION['user_id'] . "'";
            
            mysqli_query($dbc, $query)
                    or die('Error querying database. EDIT PROFILE 1');
            
            header('Location: ' . $URL);
            
            exit();
            } else {
                echo '<p class="error">You must enter all of the profile data.</p>';
            }
        } 
    } else {
        $query = "SELECT firstName, lastName, email FROM customcal_user WHERE user_id = '" . 
                $_SESSION['user_id'] . "'";
        $data = mysqli_query($dbc, $query)
                or die('Error querying database. EDIT PROFILE 2');

        $row = mysqli_fetch_array($data);
        
            if ($row != NULL) {
                $first_name = $row['firstName'];
                $last_name = $row['lastName'];
                $email = $row['email'];
            } else {
                echo '<p class="error">There was a problem accessing your profile. </p>';
            }
    }    
    mysqli_close($dbc);
?>
<!-- Form to edit profile -->

<center>
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <div class="form-heading">
            <legend>Edit Your Personal Information</legend>
        </div>
        <div class="form-group">
            <label for="firstname">First name:</label>
                <input type="text" id="firstname" name="firstname" 
                        value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
        </div>
        <div class="form-group">
            <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname" 
                        value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
        </div>
        <div class="form-group">
            <label for="gender">Email:</label>
                <input type="text" id="email" name="email"
                        value="<?php if(!empty($email)) echo $email; ?>" /><br />
        </div>
    </fieldset>
    <button class="btn-info" type="submit" name="submit">Save Profile</button>
    <br />
</form>
</center>
<br />
            </div>
        </div>
    </body>
</html>