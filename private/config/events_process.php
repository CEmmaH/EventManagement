<?php
    require_once 'db_connection.php'; 

    function listAllEvents(){
        global $conn;
        $sql = "SELECT * FROM event ORDER BY date desc, time desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $events;
    }
    /*
        Check how many attendees have booked for an event.
    */
    function getAttendees($eventId){
        global $conn;
        $sql = "SELECT COUNT(*) FROM event_attendees where event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $eventId);  
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_row();
        $stmt->close();
        return $row[0];
    }

    function hasUserBookEvent($userId, $eventId){
        global $conn;
        $sql = "SELECT * FROM event_attendees where event_id = ? and user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $eventId,$userId);  
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_row();
        $stmt->close();
        return $row==null?0:$row[0];
    }

    function registerEvent($userid, $eventid){
        global $conn;
        $sql = "INSERT INTO event_attendees (user_id, event_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param('ii', $userid, $eventid);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: /EventManagement/public/index.php?active=events");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    function cancelEvent($userid, $eventid){
        global $conn;
        $sql = "DELETE FROM event_attendees WHERE user_id = ? and event_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param('ii', $userid, $eventid);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: /EventManagement/public/index.php?active=events");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    function createEvent($userid, $name, $date, $time, $location, $description, $maxattendees){
        global $conn;
        $sql = "INSERT INTO event (user_id, event_name, date, time, location, description, max_attendees) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param('isssssi',$userid, $name, $date, $time, $location, $description, $maxattendees);
        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: /EventManagement/public/index.php?active=events");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    function listMyPostEvents($userid){
        global $conn;
        $sql = "SELECT * FROM event WHERE user_id = ? ORDER BY date, time";

  //      $debug_sql = "SELECT * FROM event WHERE user_id = $userid ORDER BY date, time";
  //      echo "Debug SQL: $debug_sql<br>";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $events;

    }

    function listMyEvents($userid){
        global $conn;
        $sql = "SELECT * FROM event e INNER JOIN event_attendees ea ON e.id = ea.event_id 
                WHERE ea.user_id = ? ORDER BY date, time";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = $result->fetch_all(MYSQLI_ASSOC);  // get serval records to a two dimentional array
        $stmt->close();

        return $events;

    }

    function debug_sql($sql, $params) {
        foreach ($params as $param) {
            $sql = preg_replace('/\?/', "'" . $param . "'", $sql, 1);
        }
        return $sql;
    }

    function updateEvent($eventid, $name, $date, $time, $location, $description, $maxattendees){
        global $conn;
        $sql = "UPDATE event SET event_name=?, date=?, time=?, location=?, description=?, max_attendees=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssii',$name, $date, $time, $location, $description, $maxattendees, $eventid);
        $stmt->execute();
        $stmt->close();
    }

    function getEventById($eventid){
        global $conn;
        $sql = "SELECT * FROM event WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i',$eventid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); // get 1 record to an array
        $stmt->close();
        return $row==null?0:$row;
    }

    function searchEventByName($searchName){
        global $conn;
        $searchTerm = "%" . $searchName . "%";
        $sql = "SELECT * FROM event WHERE event_name LIKE ? ORDER BY date, time";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = $result->fetch_all(MYSQLI_ASSOC);  // get serval records to a two dimentional array
        $stmt->close();
        return $events;
    }

    function searchEventByNameAndLocation($searchName,$location){
        global $conn;
        $nameTerm = "%" . $searchName . "%";
        $locationTerm = "%" . $location . "%";
        $sql = "SELECT * FROM event WHERE event_name LIKE ? AND location lIKE ?  ORDER BY date, time";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss',$nameTerm, $locationTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = $result->fetch_all(MYSQLI_ASSOC);  // get serval records to a two dimentional array
        $stmt->close();
        return $events;
    }

    function searchEventByLocation($location){
        global $conn;
        $locationTerm = "%" . $location . "%";
        $sql = "SELECT * FROM event WHERE location lIKE ?  ORDER BY date, time";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $locationTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = $result->fetch_all(MYSQLI_ASSOC);  // get serval records to a two dimentional array
        $stmt->close();
        return $events;
    }
?>