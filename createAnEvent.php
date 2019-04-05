<?php
/*CREATE TABLE `events` (
  `eventid` INT(11) NOT NULL AUTO_INCREMENT,
  `eventName` VARCHAR(30) NOT NULL,
  `eventLocation` VARCHAR(30) NOT NULL,
  `eventDate` VARCHAR(10) NOT NULL,
  `eventTime` VARCHAR(10) NOT NULL,
  `eventDescription` VARCHAR(200) NOT NULL,
PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;*/
	session_start();
	include('conn.php');
	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
		header('index.php');
		exit();
	}
	$query=mysqli_query($conn,"select * from user where userid='".$_SESSION['id']."'");
	$userrow=mysqli_fetch_assoc($query);
	readfile("createAnEvent.html");
	if(isset($_GET['eventName'])) {
		$eventName=$_GET['eventName'];
		$eventLocation=$_GET['eventLocation'];
		$eventDate = $_GET['eventDate'];
		$eventTime = $_GET['eventTime'];
		$eventDescription = $_GET['eventDescription'];
		$sql = "INSERT INTO events (eventName, eventLocation,eventDate, eventTime, eventDescription)
			VALUES ('$eventName', '$eventLocation', '$eventDate', '$eventTime','$eventDescription');";
		if (mysqli_query($conn, $sql)) {
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$thisevent = "SELECT eventid, eventName FROM events";
		$result = mysqli_query($conn, $thisevent);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($eventrow = mysqli_fetch_assoc($result)) {
				$eventid = $eventrow["eventid"];
			}
		}

		$db = "INSERT INTO link (eventid, userid)
			VALUES ('$eventid', '$userrow');";
		mysqli_query($conn, $db);
	}
?>