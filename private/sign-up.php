<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - GroupFive Event Planning</title>
    <link rel="stylesheet" href="/public/stylesheet/Style.css">
</head>
<body>
    <div class="container" role="main">
        <div class="card">
            <h2>Create Account</h2>
            
            <form class="form-group" action="/signup" method="POST">
                <div class="form-field">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required
                        placeholder="Enter your username"
                    >
                </div>

                <div class="form-field">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        placeholder="Enter your email"
                    >
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        placeholder="Enter your password"
                    >
                </div>

                <div class="form-field">
                    <label for="confirmPassword">Confirm Password</label>
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        name="confirmPassword" 
                        required
                        placeholder="Confirm your password"
                    >
                </div>

                <button type="submit">Sign Up</button>

                <div style="text-align: center; margin-top: 16px; color: var(--text);">
                    Already have an account? 
                    <a href="Login.php" style="color: var(--primary); text-decoration: none;">
                        Login here
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>