<?php
include "config.php";

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    $sql = "UPDATE mahasiswa SET nim=?, nama=?, jurusan=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nim, $nama, $jurusan, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    }
}
?>

<form method="POST">
    NIM: <input type="text" name="nim" value="<?= $data['nim'] ?>"><br>
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
    Jurusan: <input type="text" name="jurusan" value="<?= $data['jurusan'] ?>"><br>

    <button type="submit" name="submit">Update</button>
</form>