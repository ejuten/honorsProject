<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="index.php">CustomCalendar</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
<?php
    //if logged in, show all pages available
    if(isset($_SESSION['username'])) {
?>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="calendarPage.php">View/Edit Calendar</a></li>
            <li><a href="viewProfile.php">View Profile</a></li>
            <li><a href="editProfile.php">Edit Profile</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="signOut.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
        </ul>
<?php
    } else {
?>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="signUp.php"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
            <li><a href="signIn.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
        </ul>
        </div> 
<?php
    }
?> 
    </div>
</nav>