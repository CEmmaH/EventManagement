
<?php
    require "events_process.php";
    session_start();
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $searchName = $_POST['searchName'];
        $location = $_POST['location'];
        if(!empty($searchName) && !empty($location)){
            $events = searchEventByNameAndLocation($searchName,$location);
            $_SESSION['events'] = $events;
            header("Location: /EventManagement/public/index.php?active=events");
        }else if(!empty($searchName)){
            $events = searchEventByName($searchName);
            $_SESSION['events'] = $events;
            header("Location: /EventManagement/public/index.php?active=events");
        }else if(!empty($location)){
            $events = searchEventByLocation($location);
            $_SESSION['events'] = $events;
            header("Location: /EventManagement/public/index.php?active=events");
        }else{
            $_SESSION['error'] = "You must enter one search condition.";
            header("Location: /EventManagement/public/index.php?active=search");
            exit();
        }        
    }
?>
 