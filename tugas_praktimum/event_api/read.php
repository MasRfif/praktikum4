<?php
include "../config.php";

$result = $conn->query("SELECT * FROM events");

if ($result->num_rows == 0) {
    echo "<tr><td colspan='5'>Data kosong</td></tr>";
}

while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['date']}</td>
        <td>{$row['organizer']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='../event_api/delete.php?id={$row['id']}'>Hapus</a>
        </td>
    </tr>";
}
?>