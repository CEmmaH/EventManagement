<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Group5 Event Planning</title>
    <link rel="stylesheet" href="/public/stylesheet/Style.css">
</head>
<body>
    <div class="container" role="main">
        <div class="card">
            <h2>Reset Password</h2>
            <form action="/reset-password" method="POST">
                <div class="form-group">
                    <label for="email">Enter your email address:</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your registered email">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit">Send Reset Link</button>
                </div>
                <div class="form-group" style="text-align: center; margin-top: 1rem;">
                    <a href="Login.php" style="color: var(--primary); text-decoration: none;">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>