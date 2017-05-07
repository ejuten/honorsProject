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
                <title>Custom Calander - Sign Up</title>
                <!--Heading-->
                <div class="jumbotron">
                    <h1><strong>Sign Up for Custom Calendar</strong></h1>
                </div>
<!--Navagation-->
<?php
    require_once('require_once/navMenu.php');
    
    require_once('require_once/connectvars.php');

    $URL = 'signIn.php';
    
    //Connect to DB
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to the database.');
            
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
        
        //Check for duplicate username
        if (!empty($username) && !empty($password1) && !empty($password2)
                && ($password1 == $password2)) {
            $query = "SELECT * FROM customcal_user WHERE username = '$username'";
            $data = mysqli_query($dbc, $query)
                    or die('Error querying database. 1');
            if (mysqli_num_rows($data) == 0) {
                // The username is unique, so insert the data into the database
                $query = "INSERT INTO customcal_user (username, password) VALUES ('$username', SHA('$password1'))";
                $result = mysqli_query($dbc, $query);
                    if(!$result)
                    {
                      printf("Errormessage: %s\n", mysqli_error($dbc));
                    }
                
                // Confirm success with the user
                header('Location: ' . $URL);
                
                exit();
            } else {
                //Account already exists error
                echo '<p class="error">An account already exists for this username.' .
                        ' Please use a different username.</p>';
                $username = "";
            }
        } else {
            //Not all data entered error
            echo '<p class="error">You must enter all of the sign-up data, ' .
                    'including the desired password twice.</p>';
        }
    }
    
    mysqli_close($dbc);
?>
<center>
<!--Sign up form for new users-->
<p>Please enter your username and desired password to sign up for Custom Calendar.</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <div class="form-header">
            <legend>Registration Information</legend>
            </div>
                <div class="form-group">
                <label for="username">Username:</label>
                    <input type="text" id="username" name="username"
                            value="<?php if (!empty($username)) echo $username; ?>">
                </div>
                <div class="form-group">
                <label for="password1">Password:</label>
                    <input type="password" id="password1" name="password1" />
                </div>
                <div class="form-group">
                <label for="password2">Retype Password:</label>
                    <input type="password" id="password2" name="password2" />
                </div>
        </fieldset>
            <!--Submit button-->
            <button class="btn-info" type="submit" name="submit">Sign Up</button>
    </form>
</center>
<br />
</div>
</body>
</html>
