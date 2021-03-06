<?php
	session_start();
	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
		header('index.php');
		exit();
	}
    include('conn.php');
    $event_id = $_GET['eventid'];
    $query=mysqli_query($conn,"select * from `link` where userid='".$_SESSION['id']."' && eventid='".$event_id."'");
    if (mysqli_num_rows($query) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($query)) {
            $userid = $row["userid"];
            $eventid = $row["eventid"];
		}
    }
    $result = mysqli_query($conn, "select * from `events` where eventid='$eventid'");
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($eventrow = mysqli_fetch_assoc($result)) {
            $eventName = $eventrow["eventName"];
            $eventLocation = $eventrow["eventLocation"];
            $eventDate= $eventrow["eventDate"];
            $eventTime = $eventrow["eventTime"];
            $eventDescription = $eventrow["eventDescription"];
        }
    }

    if (isset($_GET['updateEvent'])){
        $eventid = $_GET['eventid'];
        $updateEvent = $_GET['updateEvent'];
        echo $eventid;
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/nav_styles.css" />
    <meta name="author" content="Annie Phongphouthai & Yueying Pan">

    <title>UInvite</title>
    <script type="text/javascript">
        function setFocus(){
            document.getElementById("person").focus();
        }
    </script>
</head>

<style>
    /*align left is for the button to be left aligned on the jumbotron*/
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
        overflow-x: hidden;
    }
    /*this is to have the actual white container after the jumbotron*/
    .container {
        margin: 0 auto;
        width: 100%;
        padding-left: 30px;
        padding-right: 30px;
    }
    /*help splits the screen into two to have event on one side and the invite guests on the other*/
    .column {
        float: left;
        width: 47%;
        padding: 10px;
    }
    /*help splits the screen into two to have event on one side and the invite guests on the other*/
    .column-right{
        float: right;
        width: 50%;
        padding: 10px;
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
    /* line*/
    hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #ccc;
    }
    /*this is the event box*/
    .item {
        grid-column: 1 / span 2;
        grid-row: 1 / span 20;
        background-color: orange;
        justify-self: left;
    }
    /*for a responsive table*/
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }
</style>
<!--jumbotron hover is for pseudo-->
<body onload="setFocus();">
    <nav class="navbar navbar-expand-md bg-company-blue navbar-dark">
        <a class="navbar-brand" href="#"><h3 class = "nav-logo-orange">UInvite</h3></a>
        <!--hamburger-->
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
    <!--jumbo tron for the invite guest title-->
    <div class="jumbotron">
        <div class="form-group">
            <input class="btn btn-primary align-left" type="button" value="Back" onclick="goBack()">
            <h2 class = "center">Invite Guests</h2>
        </div>
    </div>

    <!--grid on the right to show the user the event they are looking at-->
    <section class="content-row row">
        <div class="grid">
            <!--left of the event -->
            <div class="column" style="background-color:#FF8425; position:fixed; text-align: left;">
                <label>Event:</label>
                <?php echo $eventName;?>
                <br>
                <label>Event Location: </label>
                <?php echo $eventLocation;?>
                <br>
                <label>Event Date:</label>
                <?php echo $eventDate;?>

                <br>
                <label>Event Time:</label>
                <?php echo $eventTime;?>

                <br>
                <label>Event Description:</label>
                <?php echo $eventDescription;?>
                <form method = "GET" action="updateEvent.php">
                        <input type="hidden" name="eventid" value="<?php echo $eventid;?>">
                        <input type="hidden" name="update" value="True">
                        <input class="btn btn-primary" type="submit" value="Update Event" id="updateEvent">
                </form>
            </div>
            <!--table of the people they would like to invite-->
            <div class="column-right" style="color: black; overflow-x: auto;">
                <div class="form-group">
                    <label>Send Invitation To: </label>
                    <input name="person" id="person">
                    <input class="btn btn-primary" type="submit" value="Add" id="addperson" onClick="addPerson()">
                    <br>
                    <span class="error" id="person-note"></span>
                    <span class="error" id="send-note"></span>
                </div>
                <form method="POST" action="guests_added.php">
                    <hr>
                    <div id ="invite">
                        <table id ="inviteTable" class = "table" style = "color:black;">
                            <thead>
                                <th>Invitee</th>
                                <th>(Remove)</th>
                            </thead>
                        </table>
                    </div>
                    <hr>
                    <input class="btn btn-primary" type="submit" value="Send Invites" id="sendInvites" onClick="sendInvites()">
                <?php
                    function tdrows($elements)
                    {
                        $str = "";
                        foreach ($elements as $element) {
                            $str .= $element->nodeValue . ", ";
                        }

                        return $str;
                    }

                    /*function getdata()
                    {
                        $contents = "<table><tr><td>Row 1 Column 1</td><td>Row 1 Column 2</td></tr><tr><td>Row 2 Column 1</td><td>Row 2 Column 2</td></tr></table>";
                        $DOM = new DOMDocument;
                        $DOM->loadHTML($contents);

                        $items = $DOM->getElementsByTagName('tr');

                        foreach ($items as $node) {
                            echo tdrows($node->childNodes) . "<br />";
                        }
                    }

                    getdata();*/
                ?>
            </div>
        </div>
    </section>
    <script>
        /*back buttons have functionality*/
        function goBack() {
            window.history.back();
        }
        /*script to add a person onto the table*/
        function addPerson(){
            var invitee = document.getElementById("person").value;
            var removeoption = "<input type=button value=' X ' onClick='deletePerson()'>";
            if (invitee===''){
                document.getElementById("person").focus();
                document.getElementById("person-note").innerHTML = "You did not enter anything";
            }
            else{
                document.getElementById("person-note").innerHTML = "";
                var rowdata =[invitee, removeoption];
                document.getElementById("person").value = "";
                var tableRef = document.getElementById("inviteTable");
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.onmouseover = function() {
                    tableRef.clickedRowIndex = this.rowIndex;
                };
                var newCell = "";
                var i = 0;
                // insert new cells (<td> elements) at the 1st, 2nd, 3rd, 4th position of the new <tr> element
                // using insertCell(method) method
                while (i < 2)
                {
                    newCell = newRow.insertCell(i);
                    newCell.innerHTML = rowdata[i];
                    newCell.onmouseover = this.rowIndex;
                    i++;
                }
            }
            document.getElementById("person").focus();
            document.getElementById("send-note").innerHTML = "";
        }
        /*delete person*/
        function deletePerson(){
            // since deletion action is unrecoverable, add hesitation to minimize/avoid user error 
            if (confirm("Press OK to delete. This action is unrecoverable.") == true)   
                document.getElementById("inviteTable").deleteRow(document.getElementById("inviteTable").clickedRowIndex);
            document.getElementById("person").focus();

        }
        /*check if the table is empty and does not have people*/
        function sendInvites(){
            var invitees = document.getElementById("inviteTable");
            if (invitees.rows.length==1){
                document.getElementById("send-note").innerHTML = "No one to send invitations to. Please add a person.";
                document.getElementById("person-note").innerHTML = "";

            }
            else{
                document.getElementById("send-note").innerHTML = "Invitations Sent";
                document.getElementById("person-note").innerHTML = "";
            }
        }
    </script>
    <!--footer at the bottom-->
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
