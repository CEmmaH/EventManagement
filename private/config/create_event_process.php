<?php
        require "events_process.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "create evetn.";
            $userid = $_POST['userid'];
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $location = $_POST['location'];
            $description = $_POST['description'];
            $maxattendees = $_POST['max_attendees'];
            createEvent($userid, $name, $date, $time, $location, $description, $maxattendees);
            echo "create evetn.";
            header("Location: /public/index.php?active=events");
            exit();
        }
?>