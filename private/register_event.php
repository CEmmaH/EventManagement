<?php
    require "config/events_process.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userid = $_POST['userid'];
        $eventid = $_POST['eventid'];
        
        registerEvent($userid, $eventid);
        header("Location: /public/index.php?active=events");
        exit();
    }
?>
