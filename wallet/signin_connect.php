<?php
session_start();
ini_set("display_errors", "1");
error_reporting();
$email = $_POST['email'];
$pass = $_POST['password'];
$conn = new mysqli("localhost:3306", "root", "", "wallet");

if ($conn->connect_error) {
    die("Failed to Connect : " . $conn->connect_error);
} else {
    $stmt1 = "select * from user_details where email='$email'";
    $result1 = $conn->query($stmt1);
    if (!$result1) {
        die("Invalid query: " . $conn->error);
    }
    while ($rows = $result1->fetch_assoc()) {
        $email_id = $rows['email'];
        $password = $rows['password'];
        if ($email_id == $email) {
            if ($password == $pass) {
                $_SESSION["email"] = $email;
                // echo "Login Successfull!!";
                header("location: user/wallet_page.php");
            } else {
                echo "Email or Password did not match.";
            }
        } else {
            echo "Email or Password did not match.";
        }
    }
}
