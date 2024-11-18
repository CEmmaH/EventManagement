<?php
    require "events_process.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userid = $_POST['userid'];
        $eventid = $_POST['eventid'];
        
        deleteEvent($eventid);
        header("Location: /EventManagement/public/index.php?active=events");
        exit();
    }


?>
