<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule - Event Planning</title>
    <link rel="stylesheet" href="/public/stylesheet/Style.css">
    <script src="/public/scripts/calendar.js" defer></script>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="header">
            <div class="logo-container">
            <img src="/public/images/eventPlanning.webp"  alt="Event Planning Logo" class="logo">
            </div>
            <h1>GroupFive - Event Planning</h1>
            <div class="nav-links">
                <a href="/public/index.html" class="active">About</a>
                <a href="Login.php">Login</a>
                <a href="Plan.php">PlanNow</a>
                <a href="Timeline.html">Timeline</a>
            </div>
        </nav>
    </header>

    <!-- Main content -->

    <div class="container">
        <div class="calendar-controls">
            <button class="month-nav" id="prevMonth">&lt;</button>
            <div class="current-date">
                <span id="currentMonth">September</span>
                <span id="currentYear">2024</span>
            </div>
            <button class="month-nav" id="nextMonth">&gt;</button>
        </div>
        <div class="calendar-grid">
        <div class="card">
            <h2>Event Calendar</h2>
            <div class="calendar">
                <!-- Calendar header -->
                <div class="calendar-header">
                    <span>Sun</span>
                    <span>Mon</span>
                    <span>Tue</span>
                    <span>Wed</span>
                    <span>Thu</span>
                    <span>Fri</span>
                    <span>Sat</span>
                </div>
                <!-- Calendar grid -->
                <div class="calendar-grid" id="calendar-days"></div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Event</h2>
            <form id="eventForm" class="form-group">
                <input type="hidden" id="eventDate">
                <div class="form-field">
                    <h5>Event Name：</h5>
                    <input type="text" id="eventName" placeholder="Event Name" required>
                </div>
                <div class="form-field">
                    <h5>Date：</h5>
                    <input type="Date" id="eventDate" required>
                </div>
                <div class="form-field">
                    <h5>Time：</h5>
                    <input type="time" id="eventTime" required>
                </div>
                <div class="form-field">
                    <h5>Description：</h5>
                    <textarea id="eventDescription" placeholder="Event Description"></textarea>
                </div>
                <div class="form-field">
                    <h5>Location：</h5>
                    <input type="text" id="eventLocation" placeholder="Location">
                </div>
                <div class="form-field">
                    <h5>Maximum Participants：</h5>
                    <input type="number" id="maxParticipants" placeholder="Maximum Participants">
                </div>
                <button type="submit" class="submit-btn">Submit Event</button>
            </form>
        </div>
    </div>

   
</body>
</html>