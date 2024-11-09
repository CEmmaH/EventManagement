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
    <!-- Navigation Bar -->
    <header>
      <nav class="header">
          <h1>GroupFive - Event Planning</h1>
          <div class="nav-links">
              <a href="/public/index.html" class="active">About Us</a>
              <a href="Login.php">Login</a>
              <a href="Schedule.php">Show Your Schedule</a>
              <a href="Timeline.html">Timeline</a>
          </div>
      </nav>
  </header>

    <!-- Main content -->
    <div class="container" role="main">
        <div class="card">
            <h2>Submit Event</h2>
            <form class="form-group">
                <input type="text" placeholder="Event Name" required />
                <input type="date" placeholder="Event Date" required />
                <input type="time" placeholder="Event Time" required />
                <textarea placeholder="Event Description" required></textarea>
                <input type="text" placeholder="Location" required />
                <input type="number" placeholder="Maximum Participants" min="1" />
                <button type="submit"><a href="Schedule.html">Submit Event</a></button>
            </form>
        </div>
    </div>
</div>
</body>
</html>