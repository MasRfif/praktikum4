<?php
include "config.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "Register berhasil <a href='../tugas_praktimum/login.html'>Login</a>";
} else {
    echo "Gagal";
}
?>