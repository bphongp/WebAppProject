<?php
	session_start();
	readfile("logged_in.html");

	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
		header('index.php');
		exit();
	}
	include('conn.php');
	$query=mysqli_query($conn,"select * from user where userid='".$_SESSION['id']."'");
	$row=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>UInvite</title>
</head>
<style>
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
	<!--this is for the Jumbotron-->
		<div class="jumbotron">
        <div class="form-group">
            <input class="btn btn-primary align-left" type="button" value="Back">
			<h2 class ="center"><?php echo $row['firstname'] . " ".  $row['lastname']; ?></h2>
        </div>
	</div>
	<section class="content-row row">
		<div class="grid" style= "color: black; text-align: left;">
			<h3>About me: </h3><br>
				<?php echo $row['aboutme'];?>
			<h3><?php echo $row['firstname'] . "'s Events"; ?></h3>
        </div>
	</section>
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