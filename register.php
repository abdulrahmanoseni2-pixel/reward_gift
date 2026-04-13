<?php include "config.php"; ?>

<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // VALIDATION
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } else {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $email, $hashed);

        if ($stmt->execute()) {
            $_SESSION['user'] = $stmt->insert_id;

            echo "<script>
                alert('🎁 You have been gifted!');
                window.location='claim.php';
            </script>";
            exit();
        } else {
            $error = "Email already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4);
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
    border-color: #ff758c;
    outline: none;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #ff758c;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #e84363;
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

<h2>📝 Create Account</h2>

<?php if (!empty($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">
<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email Address" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Register</button>
</form>

</div>

</body>
</html>