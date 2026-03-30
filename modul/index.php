<?php
include "config.php";
$result = $conn->query("SELECT * FROM mahasiswa");
?>

<h2>Data Mahasiswa</h2>

<a href="form.html">Tambah Data</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>NIM</th>
    <th>Nama</th>
    <th>Jurusan</th>
    <th>Aksi</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['nim'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['jurusan'] ?></td>
    <td>
        <a href="update.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $row['id'] ?>">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>