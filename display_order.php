<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swift";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get order_id from the query string
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Fetch the order details from the database
$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
} else {
    echo "Order not found.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Order Confirmation</h2>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Your order has been placed successfully!</h4>
            <p>Thank you for ordering with us. Here are your order details:</p>
            <hr>
            <p><strong>City:</strong> <?php echo htmlspecialchars($order['city']); ?></p>
            <p><strong>Restaurant:</strong> <?php echo htmlspecialchars($order['restaurant']); ?></p>
            <p><strong>Pizza Size:</strong> <?php echo htmlspecialchars($order['pizza_size']); ?></p>
            <p><strong>Pizza Type:</strong> <?php echo htmlspecialchars($order['pizza_type']); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
            <?php if ($order['payment_method'] == 'mpesa') { ?>
                <p><strong>Mpesa Phone Number:</strong> <?php echo htmlspecialchars($order['mpesa_phone']); ?></p>
            <?php } elseif ($order['payment_method'] == 'paypal') { ?>
                <p><strong>PayPal Email:</strong> <?php echo htmlspecialchars($order['paypal_email']); ?></p>
            <?php } elseif ($order['payment_method'] == 'card') { ?>
                <p><strong>Card Number:</strong> <?php echo htmlspecialchars($order['card_number']); ?></p>
                <p><strong>Expiry Date:</strong> <?php echo htmlspecialchars($order['card_expiry']); ?></p>
                <p><strong>CVC:</strong> <?php echo htmlspecialchars($order['card_cvc']); ?></p>
            <?php } ?>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
            <p><strong>Total Price:</strong> $<?php echo htmlspecialchars($order['total_price']); ?></p>
        </div>
        <a href="index.html" class="btn btn-primary">Back to Homepage</a>
    </div>
</body>
</html>
