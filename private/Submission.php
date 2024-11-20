<!-- Submission.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Event - Event Planning</title>
    <link rel="stylesheet" href="../public/stylesheet/Style.css">
    <link rel="stylesheet" href="../public/stylesheet/style_2.css">
    <script src="../public/scripts/Script.js" defer></script>
</head>
<body>
    <?php
        session_start();
        $userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
   
        if (empty($userid)) {

            echo "<h1 class='error'>Please Log in first.</h1>";
            exit();

            exit();
        }
    ?>
    <!-- Main content -->
    <div class="container" role="main">
        <div class="card">
            <h2>Submit Event</h2>
            <form id="createEventForm" class="form-group" action="/EventManagement/private/config/create_event_process.php" method="POST">
                <input hidden type="text" name="userid" id="userid" value="<?php echo $userid; ?>"/>        
                <input type="text" name="name" id="name" placeholder="Event Name" />
                <span id="nameSpan"></span>
                <input type="date" name="date" id="date" placeholder="Event Date" />
                <span id="dateSpan"></span>
                <input type="time" name="time" id="time" placeholder="Event Time" />
                <span id="timeSpan"></span>
                <textarea name="description" id="description" placeholder="Event Description"></textarea>
                <span id="descriptionSpan"></span>
                <input type="text" name="location" id="location" placeholder="Location" />
                <span id="locationSpan"></span>
                <input type="number" name="max_attendees" id="max_attendees" placeholder="Maximum Participants" min="1" />
                <button type="button" onclick="validate()">Submit Event</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>