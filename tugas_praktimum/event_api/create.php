<?php
include "../config.php";

$title = $_POST['title'];
$date = $_POST['date'];
$organizer = $_POST['organizer'];
$status = $_POST['status'];

$sql = "INSERT INTO events (title, date, organizer, status) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $title, $date, $organizer, $status);

$stmt->execute();

header("Location: ../pages/admin_dashboard.php");
?>