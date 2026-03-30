<?php
session_start();
include "config.php";

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE email=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['user'] = $result->fetch_assoc();
    header("Location: admin_dashboard.php");
} else {
    echo "Login gagal!";
}

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>