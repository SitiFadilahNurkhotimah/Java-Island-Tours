<?php
require 'koneksi1.php';

$query = "SELECT * FROM destinasi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Destinasi</title>
</head>
<body>
    <h2>Daftar Destinasi</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Destinasi</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
        </tr>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($data['nama_destinasi']) . "</td>";
            echo "<td>" . htmlspecialchars($data['kota']) . "</td>";
            echo "<td>" . htmlspecialchars($data['provinsi']) . "</td>";
            echo "<td>" . htmlspecialchars($data['id_kategori']) . "</td>";
            echo "<td>" . htmlspecialchars($data['deskripsi']) . "</td>";
            echo "<td><img src='" . $data['gambar'] . "' width='150' alt='Gambar Destinasi'></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
