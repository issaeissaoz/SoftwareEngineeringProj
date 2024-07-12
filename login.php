<?php
//declaring variables
$username = $_POST['username'];
$password = $_POST['password'];

//Database connection
$conn = new mysqli('localhost','root','','swift');
//checking connection
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        echo "Login successful!";
        // You can also start a session here to store the user's login information
         session_start();
         $_SESSION['username'] = $username;
        // header('Location: dashboard.php'); // redirect to dashboard page
    }else{
        echo "Invalid username or password";
    }
    $stmt->close();
    $conn->close();
}
?>