<!-- Login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Event Planning</title>
    <link rel="stylesheet" href="../public/stylesheet/Style.css">
</head>
<body>
    <?php
        session_start();   
    ?>
    <!-- Main content -->
     <form action="/EventManagement/private/config/login_process.php" method="POST">
        <div class="container" role="main">
            <div class="card">
                <h2>Login</h2>
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="Username" 
                    value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>"/>
                    <input type="password" name="password" id="password"  placeholder="Password" />
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']);  // clean error message
                        }
                    ?>
                    <button type="submit">Login</button>
                    <p><a href="#" onclick="loadContent('/EventManagement/private/PasswordReset.php')">Forgot Password</a></p>
                    <p><a href="#" onclick="loadContent('/EventManagement/private/sign-up.php')">Please Sign-Up Here</a></p>
                </div>
            </div>
        </div>
     </form>
    
</body>
</html>
