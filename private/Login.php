<!-- Login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Event Planning</title>
    <link rel="stylesheet" href="/public/stylesheet/Style.css">
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
    <div class="container" role="main">
        <div class="card">
            <h2>Login</h2>
            <div class="form-group">
                <input type="text" placeholder="Username" />
                <input type="password" placeholder="Password" />
                <button type="submit"><a href="Submission.php">Login</a></button>
                <p><a href="PasswordReset.php">Forgot Password</a></p>
                <p><a href="sign-up.php">Please Sign-Up Here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
