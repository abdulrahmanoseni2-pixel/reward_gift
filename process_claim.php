<?php include "config.php"; ?>

<?php
if (!isset($_SESSION['user'])) {
    $error = "Unauthorized access!";
} else {

    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $type = $_POST['reward_type'] ?? '';

    if (empty($phone) || empty($address) || empty($type)) {
        $error = "All fields are required!";
    } else {

        $extra = "";

        if ($type == "bitcoin") {
            $wallet = trim($_POST['wallet'] ?? '');
            if (empty($wallet)) {
                $error = "Bitcoin wallet is required!";
            } else {
                $extra = "Wallet: " . $wallet;
            }
        }

        if ($type == "giftcard") {
            $gift = trim($_POST['giftcard_type'] ?? '');
            if (empty($gift)) {
                $error = "Gift card type is required!";
            } else {
                $extra = "Giftcard: " . $gift;
            }
        }

        if ($type == "money") {
            $method = $_POST['method'] ?? '';
            if (empty($method)) {
                $error = "Select payment method!";
            } else {
                $extra = "Method: " . $method;
            }
        }

        // If no error → save
        if (!isset($error)) {

            $stmt = $conn->prepare(
                "INSERT INTO claims (id, phone, address, method, info) VALUES (?,?,?,?,?)"
            );

            $user_id = $_SESSION['user'];
            $method = $type;

            $stmt->bind_param("issss", $user_id, $phone, $address, $method, $extra);

            if ($stmt->execute()) {
                $success = "✅ Claim submitted successfully!";
            } else {
                $error = "Something went wrong. Try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Claim Status</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: linear-gradient(135deg, #43e97b, #38f9d7);
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

/* Messages */
.success {
    color: green;
    margin-bottom: 15px;
}

.error {
    color: red;
    margin-bottom: 15px;
}

/* Button */
a {
    display: inline-block;
    padding: 10px 20px;
    background: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    margin-top: 10px;
}

/* Responsive */
@media (max-width: 500px) {
    .container {
        margin: 15px;
        padding: 25px;
    }
}
</style>

</head>
<body>

<div class="container">

<h2>📩 Claim Status</h2>

<?php if (isset($success)) { ?>
    <p class="success"><?php echo $success; ?></p>
<?php } ?>

<?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<!-- <a href="dashboard.php">Go to Dashboard</a> -->

</div>

</body>
</html>