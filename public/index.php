<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Event Planning</title>
    <link rel="stylesheet" href="stylesheet/Style.css">
    <link rel="stylesheet" href="stylesheet/Style_2.css">
    <script src="scripts/Script.js" defer></script>
    <script src="scripts/Calendar.js" defer></script>
</head>
<body>
    <?php
        $activePage = isset($_GET['active']) ? $_GET['active'] : '';
        session_start();
    ?>

    <!-- Navigation Bar -->
    <header>
        <nav class="header">
            <div class="logo-container">
            <img src="images/eventPlanning.webp"  alt="Event Planning Logo" class="logo">
            </div>
            <h1>GroupFive - Event Planning</h1>
            <div class="nav-links">
                <a href="#" onclick="loadContent('/private/aboutus.html')" >About</a>
                <?php
                    if(isset($_SESSION['userid'])){
                        echo "<a href='/private/Logout.php' >Log Out</a>";
                    }else{
                        echo "<a href='#' onclick='loadContent(\"/private/Login.php\")'>Log in</a>";

                    }
                ?>
                <a href="#" onclick="loadContent('/private/events.php')">Events</a>              
                <a href="#" onclick="loadContent('/private/Submission.php')">Create Event</a>
                <a href="#" onclick="loadContent('/private/myevents.php')">My Event</a>
            </div>
        </nav>
    </header>

    <div id="content"></div>
</body>
</html>