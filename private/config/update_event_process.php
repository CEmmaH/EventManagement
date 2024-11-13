<?php
    require "events_process.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $eventid = $_POST['eventid'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $maxattendees = $_POST['max_attendees'];
        updateEvent($eventid, $name, $date, $time, $location, $description, $maxattendees);
        echo "update evetn.";
        header("Location: /EventManagement/public/index.php?active=events");
        exit();
    }
?>