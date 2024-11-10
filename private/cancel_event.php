<?php
    require "config/events_process.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userid = $_POST['userid'];
        $eventid = $_POST['eventid'];
        
        cancelEvent($userid, $eventid);
        header("Location: /public/index.php?active=events");
        exit();
    }
?>