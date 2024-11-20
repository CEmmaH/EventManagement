<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - GroupFive Event Planning</title>
    <link rel="stylesheet" href="../public/stylesheet/Style.css">
    <link rel="stylesheet" href="../public/stylesheet/style_2.css">
    <script src="../public/scripts/Script.js" defer></script>
</head>
<body>
    <div class="container" role="main">
        <div class="card">
            <h2>Create Account</h2>
            <?php
            session_start();  // start a session
            ?>
            <form id="signupForm" class="form-group" action="/EventManagement/private/config/signup_process.php" method="POST">
                <div class="form-field">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>"
                        placeholder="Enter your username"
                    >
                    <span id="usernameSpan"></span>
                </div>

                <div class="form-field">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"
                        placeholder="Enter your email"
                    >
                    <span id="emailSpan"></span>
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                    >
                    <span id="passwordSpan"></span>
                </div>

                <div class="form-field">
                    <label for="confirmPassword">Confirm Password</label>
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        name="confirmPassword"                         
                        placeholder="Confirm your password"
                    >
                    <span id="confirmPasswordSpan"></span>
                </div>
                <?php
                // check if there is an error in the session
                if (isset($_SESSION['error'])) {
                    echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);  // clean error message
                }
                ?>
                <button type="button" onclick="signupValidate()">Sign Up</button>

                <div style="text-align: center; margin-top: 16px; color: var(--text);">
                    Already have an account? 
                    <a href="/EventManagement/public/index.php?active=login" style="color: var(--primary); text-decoration: none;">
                        Login here
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>