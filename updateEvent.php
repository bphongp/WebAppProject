<?php
/*CREATE TABLE `events` (
  `eventid` INT(11) NOT NULL AUTO_INCREMENT,
  `eventName` VARCHAR(30) NOT NULL,
  `eventLocation` VARCHAR(30) NOT NULL,
  `eventDate` VARCHAR(10) NOT NULL,
  `eventTime` VARCHAR(10) NOT NULL,
  `eventDescription` VARCHAR(200) NOT NULL,
PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `link` (
  `linkid` INT(11) NOT NULL AUTO_INCREMENT,
  `eventid` INT(11) NOT NULL,
  `userid` INT(11) NOT NULL,
PRIMARY KEY (`linkid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/
	session_start();
	ob_start();

	include('conn.php');
	//this will get the current user that is signed in.
	$query=mysqli_query($conn,"select * from user where userid='".$_SESSION['id']."'");
	if (mysqli_num_rows($query) > 0) {
		// output data of each row
		while($urow = mysqli_fetch_assoc($query)) {
			$userid = $urow["userid"];
		}
	}
	//will read the createanevent
	//readfile("updateEvent.html");
    $event_id = $_GET['eventid'];

	//if there the get form has been entered it will follow these form
	//where we will get the event information that has been entered
	//and it will insert the event into the event table and link it to the current user
	//this is so we can refer back to it later
	if(isset($_POST['eventName'])) {
		$eventName=$_POST['eventName'];
		$eventLocation=$_POST['eventLocation'];
		$eventDate = $_POST['eventDate'];
		$eventTime = $_POST['eventTime'];
        $eventDescription = $_POST['eventDescription'];
        if ($eventName !=''){
            $sql = "UPDATE events SET `eventName`='".$eventName."' WHERE eventid= $event_id;";
            if (mysqli_query($conn, $sql)) {

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        if ($eventLocation !=''){
            $sql = "UPDATE events SET `eventLocation`='".$eventLocation."' WHERE eventid= $event_id;";
            if (mysqli_query($conn, $sql)) {

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        if ($eventDate !=''){
            $sql = "UPDATE events SET `eventDate`='".$eventDate."' WHERE eventid= $event_id;";
            if (mysqli_query($conn, $sql)) {

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        if ($eventTime !=''){
            $sql = "UPDATE events SET `eventTime`='".$eventTime."' WHERE eventid= $event_id;";
            if (mysqli_query($conn, $sql)) {

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        if ($eventDescription !=''){
            $sql = "UPDATE events SET `eventDescription`='".$eventDescription."' WHERE eventid= $event_id;";
            if (mysqli_query($conn, $sql)) {

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        header('location:invite_guests.php?eventid='.$event_id);
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Annie Phongphouthai & Yueying Pan">
    <meta name="description" content="This is the page for users to create an event.">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/nav_styles.css" />

    <title>UInvite</title>

    <!--This is an arrow function that checks the users' date input-->
    <script>
        dateFormat=() =>{
            var date_value, text;
            date_value = document.getElementById("date").value;
            if (!date_value.match(/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/)) {
              msg = "Input should be in the form of MM/DD/YYYY";
            }else{
              msg= " ";
            }
            document.getElementById("errorMessage1").innerHTML = msg;
        }

        // This is an anonymous function that checks the users' time input
        timeFormat=function() {
            var time_value = document.getElementById("time").value;
            if (!time_value.match(/^[0-9]{2}:[0-9]{2}$/)) {
                msg = "Input should be in the form of HH:MM";
            } else {
                msg=" ";
            }
            document.getElementById("errorMessage2").innerHTML = msg;
        }


    </script>

</head>
<style>
    .align-left{
        float:left !important;
    }
    /*this will center the text on the jumbo tron*/
    .center {
        text-align: center;
        margin-right:5%;
    }
    /*this is to make the text on the jumbotron align with the back button*/
    h2{
        display: inline-block;
        margin:0;
        vertical-align: middle;
    }
    /*grid is used to have the container after the jumbotron*/
    .grid{
        margin: 0 auto;
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        text-align: center;
    }
    *{
        box-sizing:border-box;
    }
    /*the entire page will be this color so the bottom footer looks full and
    won't have white spaces on it when user scrolls*/
    body {
        background: #16529E;
        color: white;
        overflow-x:hidden;
    }
    /*this is to have the actual white container after the jumbotron*/
    .container {
        margin: 0 auto;
        width: 100%;
        padding-left: 30px;
        padding-right: 30px;
    }
    /*change the color of the jumbotron*/
    .jumbotron{
        background: black;
        color:white;
        text-align: center;
    }
    /*pseudo style when use hovers over the jumbotron*/
    .jumbotron:hover {
        background-color: #16529E;
    }
</style>
<body>
  <!--this is for the navbar at the top-->
    <nav class="navbar navbar-expand-md bg-company-blue navbar-dark">
        <a class="navbar-brand" href="#"><h3 class = "nav-logo-orange">UInvite</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Me</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="login_success.php">Profile</a>
                        </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Invitations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--this is for the Jumbotron-->
    <div class="jumbotron">
        <div class="form-group">
            <input class="btn btn-primary align-left" type="button" value="Back">
            <h2 class = "center">Update Event</h2>
        </div>
    </div>
    <!--this is the container for the form that users enter-->
    <form method="POST" action="">
        <section class="content-row row">
            <div class="grid" style= "color: black; text-align: left;">
                <!--name of the event is a required field-->
                <div class="form-group">
                    <label class="col-sm-2"><b>Name of Event</b></label>
                    <div class="col-sm-5">
                        <input type="text" name="eventName" class="form-control" autofocus>
                    </div>
                </div>
              <!--location of the event is a required field-->
                <div class="form-group">
                    <label class="col-sm-2"><b>Location</b></label>
                    <div class="col-sm-5">
                        <input type="text" name="eventLocation" class="form-control">
                    </div>
                </div>
                <!--date of the event and will check it is in the correct format for date-->
                <!--gives an error message if it is not in the correct format-->
                <div class="form-group">
                    <label class="col-sm-2"><b>Date</b></label>
                    <div class="col-sm-5">
                        <input type="text" name="eventDate" class="form-control" placeholder="MM/DD/YYYY" id="date" >
                        <p id="errorMessage1" style="color:red"></p>
                    </div>
                </div>
                <!--this will check the time and make sure it is in the correct format, if not it will give an error message-->
                <div class="form-group">
                    <label class="col-sm-2"><b>Time</b></label>
                    <div class="col-sm-5">
                        <input type="text" name="eventTime" min="00:00" max="24:00" class="form-control" placeholder="HH:MM" id="time" >
                        <p id="errorMessage2" style="color:red"></p>
                    </div>
                </div>
                <!--descriptions are required for the form.-->
                <div class="form-group">
                    <label class="col-sm-2"><b>Description</b></label>
                    <div class="col-sm-5">
                        <textarea class="form-control" rows="5" name="eventDescription" ></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-2">
                        <input class="btn btn-primary" type="submit" value="Update Event" onclick="dateFormat();timeFormat();">
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!--footer for teh bottom of the screen-->
    <footer class="primary-footer container">
        <small class="copyright">&copy; Phongphouthai & Pan</small>
        <nav class="nav-footer">
            <ul>
                <li><a href="index.html" title="may or may not need, depending on design">Me</a></li>
                <li><a href="software.html" title="software or tool you have involved or created">Events</a></li>
                <li><a href="research.html" title="research you have involved">Invitations</a></li>
                <li><a href="contact.html" title="either email or form">Contact Us</a></li>
            </ul>
        </nav>
      </footer>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
