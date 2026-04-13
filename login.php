<?php include "config.php"; ?>

<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "All fields are required!";
    } else {

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid login!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: linear-gradient(135deg, #667eea, #764ba2);
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
h2 {
    margin-bottom: 20px;
}

/* Inputs */
input {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    transition: 0.3s;
}

input:focus {
    border-color: #667eea;
    outline: none;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #667eea;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #5a67d8;
}

/* Error */
.error {
    color: red;
    margin-bottom: 10px;
}

/* Responsive */
@media (max-width: 500px) {
    .container {
        margin: 15px;
        padding: 25px;
    }

    h2 {
        font-size: 20px;
    }
}
</style>

</head>
<body>

<div class="container">

<h2>🔐 Login</h2>

<?php if (!empty($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>

</div>

</body>
</html>