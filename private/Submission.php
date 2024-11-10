<!-- Submission.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Event - Event Planning</title>
    <link rel="stylesheet" href="/public/stylesheet/Style.css">
</head>
<body>
    <?php
        session_start();
        $userid = $_SESSION['userid'];
    ?>
    <!-- Main content -->
    <div class="container" role="main">
        <div class="card">
            <h2>Submit Event</h2>
            <form class="form-group" action="/private/config/create_event_process.php" method="POST">
                <input hidden type="text" name="userid" id="userid" value="<?php echo $userid; ?>"/>
                <input type="text" name="name" id="name" placeholder="Event Name" required />
                <input type="date" name="date" id="date" placeholder="Event Date" required />
                <input type="time" name="time" id="time" placeholder="Event Time" required />
                <textarea name="description" id="description" placeholder="Event Description" required></textarea>
                <input type="text" name="location" id="location" placeholder="Location" required />
                <input type="number" name="max_attendees" id="max_attendees" placeholder="Maximum Participants" min="1" />
                <button type="submit">Submit Event</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>