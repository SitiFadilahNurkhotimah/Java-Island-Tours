<?php
// koneksi ke database
include 'koneksi1.php';

// Query untuk mengambil data dari tabel paket_wisata
$query = "SELECT id_paket, nama_paket, deskripsi, harga FROM paket_wisata";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Tampilkan data dalam tabel HTML
    echo "<h2>Daftar Paket Wisata</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID Paket</th>";
    echo "<th>Nama Paket</th>";
    echo "<th>Deskripsi</th>";
    echo "<th>Harga</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop untuk menampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_paket']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama_paket']) . "</td>";
        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
        echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>Tidak ada paket wisata yang tersedia.</p>";
}

// Tutup koneksi
$conn->close();
?>
