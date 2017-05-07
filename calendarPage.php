<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<?php
  require_once('require_once/linking.html');
?>    
</head>
<body>
  <div class="container">
    <title>Make Your Calendar</title>
    <div class="jumbotron">
      <h1><strong>Create Your Calendar!</strong></h1>
    </div>
<!--Navagation-->
<?php
  require_once('require_once/navMenu.php');

  $URL = 'calendarPage.php';
?>
  <!--Full Calendar add in-->
  <div id='calendar'></div>

  <!--MODAL-->
  <center>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Fill Out Event Information</h4>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
              <div class="form-heading">
                  <legend>Event Info</legend>
              </div>
              <div class="form-group">
                <label>Event Title:</label>
                  <input type="text" id="title" name="title" value="<?php if (!empty($title)) echo $title; ?>" /><br />
              </div>
              <div class="form-group">
                <label>Start Date:</label>
                  <input type="date" id="start_date" name="start_date" value="<?php if (!empty($start_date)) echo $start_date; ?>" /><br />
              </div>
              <div class="form-group">
                <label>End Date:</label>
                  <input type="date" id="end_date" name="end_date" value="<?php if (!empty($end_date)) echo $end_date; ?>" /><br />
              </div>
              <div class="form-group">
                <label>Start Time:</label>
                  <input type="time" id="start_time" name="start_time" value="<?php if (!empty($start_time)) echo $start_time; ?>" /><br />
              </div>
              <div class="form-group">
                <label>End Time:</label>
                  <input type="time" id="end_time" name="end_time" value="<?php if (!empty($end_time)) echo $end_time; ?>" /><br />
              </div>
              <div class="form-group">
                <label>Location:</label>
                  <input type="text" id="location" name="location" value="<?php if (!empty($location)) echo $location; ?>" /><br />
              </div>
              <div class="form-group">
                <label>Event Details:</label>
                  <input type="text" id="details" name="details" value="<?php if(!empty($details)) echo $details; ?>" /><br />
              </div>
            </fieldset>
            <fieldset>
              <div class="form-heading">
                <legend>Pick a Sticker</legend>
              </div>
              <div class="form-group">
              <input type="radio" name="sticker" value="backpack"><img src="images/icons/backpack.png" class="event-icon"/>
              <input type="radio" name="sticker" value="books"><img src="images/icons/books.png" class="event-icon"/>
              <input type="radio" name="sticker" value="bottle"><img src="images/icons/bottle.png" class="event-icon"/>
              <input type="radio" name="sticker" value="cat1"><img src="images/icons/cat1.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="cat2"><img src="images/icons/cat2.png" class="event-icon"/>
              <input type="radio" name="sticker" value="coffee"><img src="images/icons/coffee.png" class="event-icon"/>
              <input type="radio" name="sticker" value="doctor"><img src="images/icons/doctor.png" class="event-icon"/>
              <input type="radio" name="sticker" value="dog1"><img src="images/icons/dog1.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="dog2"><img src="images/icons/dog2.png" class="event-icon"/>
              <input type="radio" name="sticker" value="eye"><img src="images/icons/eye.png" class="event-icon"/>
              <input type="radio" name="sticker" value="film"><img src="images/icons/film.png" class="event-icon"/>
              <input type="radio" name="sticker" value="gas"><img src="images/icons/gas.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="gift"><img src="images/icons/gift.png" class="event-icon"/>
              <input type="radio" name="sticker" value="golf"><img src="images/icons/golf.png" class="event-icon"/>
              <input type="radio" name="sticker" value="grocery"><img src="images/icons/grocery.png" class="event-icon"/>
              <input type="radio" name="sticker" value="health"><img src="images/icons/health.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="horse"><img src="images/icons/horse.png" class="event-icon"/>
              <input type="radio" name="sticker" value="laundry"><img src="images/icons/laundry.png" class="event-icon"/>
              <input type="radio" name="sticker" value="lightbulb"><img src="images/icons/lightbulb.png" class="event-icon"/>
              <input type="radio" name="sticker" value="nature"><img src="images/icons/nature.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="pizza"><img src="images/icons/pizza.png" class="event-icon"/>
              <input type="radio" name="sticker" value="plate"><img src="images/icons/plate.png" class="event-icon"/>
              <input type="radio" name="sticker" value="rx"><img src="images/icons/rx.png" class="event-icon"/>
              <input type="radio" name="sticker" value="scissors"><img src="images/icons/scissors.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="tent"><img src="images/icons/tent.png" class="event-icon"/>
              <input type="radio" name="sticker" value="tooth"><img src="images/icons/tooth.png" class="event-icon"/>
              <input type="radio" name="sticker" value="weights"><img src="images/icons/weights.png" class="event-icon"/>
              <input type="radio" name="sticker" value="weights2"><img src="images/icons/weights2.png" class="event-icon"/><br />
              <input type="radio" name="sticker" value="wine"><img src="images/icons/wine.png" class="event-icon"/>
              </div>
            </fieldset>
            <button class="btn-info" type="submit" name="submit">Save Event</button>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  </form>
  </center>
  <!--END MODAL-->
<?php
  require_once('require_once/connectvars.php');

  //Connect to DB
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
          or die('Error connecting to the database.');
  
  $user_id = $_SESSION['user_id'];

  //Once submit is pressed, grab information entered by user       
    if (isset($_POST['submit'])) {
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $start_date = mysqli_real_escape_string($dbc, trim($_POST['start_date']));
        $end_date = mysqli_real_escape_string($dbc, trim($_POST['end_date']));
        $start_time = mysqli_real_escape_string($dbc, trim($_POST['start_time']));
        $end_time = mysqli_real_escape_string($dbc, trim($_POST['end_time']));
        $location = mysqli_real_escape_string($dbc, trim($_POST['location']));
        $details = mysqli_real_escape_string($dbc, trim($_POST['details']));
        $sticker = mysqli_real_escape_string($dbc, trim($_POST['sticker']));
        $error = false;
      
        //Update the user information in the customcal_user table
        if (!$error) {
            if (!empty($title) && !empty($start_date) && !empty($end_date) && !empty($start_time) 
                && !empty($end_time) && !empty($location) && !empty($details) && !empty($sticker)) {
                $query = "INSERT INTO customcal_event(user_id, title, start_date, end_date, start_time, end_time, location, details, sticker) VALUES ('$user_id', '$title', '$start_date', '$end_date', '$start_time', '$end_time', '$location', '$details', '$sticker')";
            
            mysqli_query($dbc, $query)
                    or die('Error querying database. ADDING EVENT');
            
            echo "<meta http-equiv='refresh' content='0'>";
            
            exit();
            } else {
                echo '<p class="error">You must enter all of the event data.</p>';
            }
        } 
    } else {
        $query = "SELECT title, start_date, end_date, start_time, end_time, location, details, sticker FROM customcal_event WHERE user_id = '" . $_SESSION['user_id'] . "'";
        $data = mysqli_query($dbc, $query)
                or die('Error querying database. ADDING EVENT 2');

        $events = mysqli_fetch_all($data, MYSQLI_ASSOC);
?>
<script>
    var eventArray = [];
<?php
        foreach($events as $row) {
          $title = $row['title'];
          $start_date = $row['start_date'];
          $end_date = $row['end_date'];
          $start_time = $row['start_time'];
          $end_time = $row['end_time'];
          $location = $row['location'];
          $details = $row['details'];
          $sticker = $row['sticker'];
?>
          eventArray.push({
                          title: '<?php echo $title; ?>',
                          start: '<?php echo $start_date; ?>',
                          end: '<?php echo $end_date; ?>',
                          start_time: '<?php echo $start_time; ?>',
                          end_time: '<?php echo $end_time; ?>',
                          location: '<?php echo $location; ?>',
                          details: '<?php echo $details; ?>',
                          imageurl: '<?php echo $sticker; ?>',
                          backgroundColor: '#e5e5e5',
                          borderColor: '#0c3152'
                         });            
<?php
        }
    }    
    mysqli_close($dbc);
?>
initiateFullCalendar(eventArray);
</script>
  </div>
</body>
</html>