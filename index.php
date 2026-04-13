<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Reward Platform</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Card */
.container {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 100%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

/* Title */
h1 {
    margin-bottom: 10px;
}

p {
    color: #666;
    font-size: 14px;
    margin-bottom: 25px;
}

/* Buttons */
.btn {
    display: block;
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    text-decoration: none;
    color: white;
    border-radius: 6px;
    transition: 0.3s;
}

/* Button colors */
.register {
    background: #28a745;
}

.register:hover {
    background: #1e7e34;
}

.login {
    background: #007bff;
}

.login:hover {
    background: #0056b3;
}

/* Responsive */
@media (max-width: 500px) {
    .container {
        margin: 15px;
        padding: 25px;
    }

    h1 {
        font-size: 22px;
    }
}
</style>

</head>
<body>

<div class="container">

<h1>🎁 Reward Platform</h1>
<p>Sign up to receive your reward and claim your benefits.</p>

<a href="register.php" class="btn register">Create Account</a>
<a href="login.php" class="btn login">Login</a>

</div>

</body>
</html>