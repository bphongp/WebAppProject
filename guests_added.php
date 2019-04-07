<?php
	session_start();
    include('conn.php');
    $event_id = $_GET['eventid'];
    echo $event_id;
?>