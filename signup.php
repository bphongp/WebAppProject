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
	//will read the createanevent
	readfile("signup.html");

	//if there the get form has been entered it will follow these form
	//where we will get the event information that has been entered
	//and it will insert the event into the event table and link it to the current user
	//this is so we can refer back to it later
	if(isset($_GET['username'])) {
		$username=$_GET['username'];
		$pw=$_GET['password'];
		$email = $_GET['email'];
		$gender = $_GET['gender'];
		$sql = "INSERT INTO user (username, pw,email, gender)
			VALUES ('$username', '$pw', '$email', '$gender');";
		if (mysqli_query($conn, $sql)) {
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$thisuser = "SELECT userid, username FROM users";
		$result = mysqli_query($conn, $thisuser);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($userrow = mysqli_fetch_assoc($result)) {
				$userid = $userrow["userid"];
			}
		}

		$_SESSION['userid'] = $userid;
    }
    $query=mysqli_query($conn,"select * from user where userid='".$_SESSION['id']."'");
	if (mysqli_num_rows($query) > 0) {
		// output data of each row
		while($urow = mysqli_fetch_assoc($query)) {
			$userid = $urow["userid"];
		}
	}
?>