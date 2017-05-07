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
                <title>Custom Calander - Sign In</title>
                <!--Heading-->
                <div class="jumbotron">
                    <h1><strong>Sign In to Custom Calendar</strong></h1>
                </div>
            
<?php
	require_once('require_once/connectvars.php');

    $URL = 'index.php';

	$error_msg = "";
    
    //Attempt logging user in
    if (!isset($_SESSION['user_id'])) {
        if (isset($_POST['submit'])) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('Error connecting to the database.');
                
            //Get user log in data
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
            
            if (!empty($user_username) && !empty($user_password)) {
                $query = "SELECT user_id, username FROM customcal_user WHERE username = '$user_username' AND password = SHA('$user_password')";
                $data = mysqli_query($dbc, $query)
                        or die('Error querying database.');
                
                if (mysqli_num_rows($data) == 1) {
                    //Log in is good
                    $row = mysqli_fetch_array($data);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    /*setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));
                    setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30)); 
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php'; 
                    header('Location: ' . $home_url); */
                } else {
                    //Incorrect username/password error
                    $error_msg = 'Sorry, you must enter a valid username and' .
                            ' password to log in.';
                } 
            } else {
                //Username/password blank error
                $error_msg = 'Sorry, you must enter a username and' .
                        ' password to log in.';
            }
        }   
    }
    
    //Check for empty session
    if (empty($_SESSION['user_id'])) {
        echo '<p class="error">' . $error_msg . '</p>';
?>

    <!--Log in form-->
    <center>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <div class="form-heading">
                <legend>Sign In</legend>
            </div>
            <div class="form-group">
            <label for="username">Username:</label>
                <input type="text" name="username" 
                        value="<?php if (!empty($user_username)) echo $user_username; ?>"/> <br />
            </div>
            <div class="form-group">
            <label for="password">Password:</label>
                <input type="password" name="password" />
            </div>
        </fieldset>
        <!--Submit button-->
        <button class="btn-info" type="submit" name="submit">Log In</button>
    </form>
    </center>

<?php
    } else {
        //Confirm log in 
        header('Location: ' . $URL);
    }

?>
    <br />

        </div>
</body>
</html>