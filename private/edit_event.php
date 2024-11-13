<!-- Submission.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Event Planning</title>
    <link rel="stylesheet" href="../public/stylesheet/Style.css">
</head>
<body>
    <?php
        require_once 'config/events_process.php';
        session_start();

        $data = json_decode(file_get_contents("php://input"), true);
        if ($data) {
            $eventid = $data['eventid'];
            $event = getEventById($eventid);
        }else{
            header('Location: /EventManagement/private/events.php');
        }
       
    ?>
    <!-- Main content -->
    <div class="container" role="main">
        <div class="card">
            <h2>Submit Event</h2>
            <form class="form-group" action="/EventManagement/private/config/update_event_process.php" method="POST">
                
                <input hidden type="text" name="eventid" id="eventid" value="<?php echo $event['id']; ?>"/>
                <lable for="name">name</lable>
                <input type="text" name="name" id="name" placeholder="Event Name" value="<?php echo $event['event_name']; ?>" required />
                <lable for="date">date</lable>
                <input type="date" name="date" id="date" placeholder="Event Date" value="<?php echo $event['date']; ?>" required />
                <lable for="time">time</lable>
                <input type="time" name="time" id="time" placeholder="Event Time" value="<?php echo $event['time']; ?>" required />
                <lable for="description">description</lable>
                <textarea name="description" id="description" placeholder="Event Description" required><?php echo $event['description']; ?></textarea>
                <lable for="location">location</lable>
                <input type="text" name="location" id="location" placeholder="Location" value="<?php echo $event['location']; ?>" required />
                <lable for="max_attendees">max attendees</lable>
                <input type="number" name="max_attendees" id="max_attendees" placeholder="Maximum Participants" min="1" value="<?php echo $event['max_attendees']; ?>"/>
                <button type="submit">Update Event</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>