<?php
//declaring variables
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

//Database connection
$conn = new mysqli('localhost','root','','swift');
//checking connection
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        // Redirect to login page
        header("Location: login.html");
        exit();
    } else {
        echo "Registration failed: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
