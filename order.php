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

// Sanitize and validate form data
$city = $conn->real_escape_string($_POST['city']);
$restaurant = $conn->real_escape_string($_POST['restaurant']);
$pizza_size = $conn->real_escape_string($_POST['pizza_size']);
$pizza_type = $conn->real_escape_string($_POST['pizza_type']);
$payment_method = $conn->real_escape_string($_POST['payment_method']);
$mpesa_phone = isset($_POST['mpesa_phone']) ? $conn->real_escape_string($_POST['mpesa_phone']) : null;
$paypal_email = isset($_POST['paypal_email']) ? $conn->real_escape_string($_POST['paypal_email']) : null;
$card_number = isset($_POST['card_number']) ? $conn->real_escape_string($_POST['card_number']) : null;
$card_expiry = isset($_POST['card_expiry']) ? $conn->real_escape_string($_POST['card_expiry']) : null;
$card_cvc = isset($_POST['card_cvc']) ? $conn->real_escape_string($_POST['card_cvc']) : null;
$address = $conn->real_escape_string($_POST['address']);
$total_price = $conn->real_escape_string($_POST['total_price']);

// Insert data into the database
$sql = "INSERT INTO orders (city, restaurant, pizza_size, pizza_type, payment_method, mpesa_phone, paypal_email, card_number, card_expiry, card_cvc, address, total_price)
VALUES ('$city', '$restaurant', '$pizza_size', '$pizza_type', '$payment_method', '$mpesa_phone', '$paypal_email', '$card_number', '$card_expiry', '$card_cvc', '$address', '$total_price')";

if ($conn->query($sql) === TRUE) {
    // Redirect to a page to display the completed order
    header("Location: display_order.php?order_id=" . $conn->insert_id);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
