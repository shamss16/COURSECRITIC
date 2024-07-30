<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="left-side">
            <img src="images/login.jpg" alt="Login Image">
        </div>
        <div class="right-side">
            <div class="login-box">
                <img src="images/logo.png" alt="Logo" class="logo">
                <h1>Login</h1>
                <?php
                session_start();
                if (isset($_SESSION['error_message'])) {
                    echo '<div id="error-message" class="error-message">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']);
                }
                ?>
                <form action="login.php" method="POST" id="login-form">
                    <input type="text" name="email_or_regno" id="email_or_regno" placeholder="Email or Registration Number" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="register.html">Click here to register</a></p>
            </div>
        </div>
    </div>
</body>

</html>