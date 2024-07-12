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
    $stmt = $conn->prepare("insert into users(username,email,password) values(?,?,?)");
    $stmt->bind_param("sss",$username,$email,$password);
    $stmt->execute();
    echo "Registration successfull...";
    $stmt->close();
    $conn->close();
}
?>