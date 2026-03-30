<?php
include "config.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];

$sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nim, $nama, $jurusan);

if ($stmt->execute()) {
    echo "Data berhasil ditambahkan <a href='index.php'>Lihat Data</a>";
} else {
    echo "Gagal";
}
?>