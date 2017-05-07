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
                <title>Custom Calander</title>
                <!--Heading-->
                <div class="jumbotron">
                    <h1><strong>Welcome to Custom Calendar</strong></h1>
                </div>
                <!--Navagation-->
                <?php
                    require_once('require_once/navMenu.php');
                ?>
                <section>
                    <article>
                        <h2>What Does Custom Calendar Do?</h2>
                        <h5><p>Custom Calendar is an interactive calendar that uses
                        stickers as a visual indicator of user events.</p>
                        <p>Users can create a profile, view and edit the profile
                        as well as add various events to their own personal calendar.</p>
                        <p>The individual calendar is saved with the user's account and
                        can only be viewed by the user through their unique sign in.</p></h5>
                    </article>
                </section>

                <br />
                <br />
                <div id="customCalCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#customCalCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#customCalCarousel" data-slide-to="1"></li>
                    <li data-target="#customCalCarousel" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="images/calendarView.png" alt="Calendar View">
                    </div>

                    <div class="item">
                      <img src="images/eventFormView.png" alt="Event Form">
                    </div>

                    <div class="item">
                      <img src="images/editProfileView.png" alt="Edit Profile">
                    </div>
                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#customCalCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#customCalCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>

                <?php
                    //Connect to the database
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or die('Error connecting to database.');
                ?>
            </div>
        </body>
</html>


