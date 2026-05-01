<?php
session_start();
require 'koneksi1.php'; // Menghubungkan ke database

// Memeriksa apakah data POST ada
if (isset($_POST['id_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];

    // Memulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Memanggil stored procedure
        $stmt = $conn->prepare("CALL DeletePelanggan(?)");
        $stmt->bind_param("i", $id_pelanggan);
        
        // Eksekusi stored procedure
        if ($stmt->execute()) {
            // Commit transaksi jika berhasil
            mysqli_commit($conn);
            echo '<script>alert("Data pelanggan berhasil dihapus."); location.href="daftar_pelanggan.php";</script>';
        } else {
            // Rollback transaksi jika gagal
            mysqli_rollback($conn);
            echo '<script>alert("Gagal menghapus data pelanggan."); location.href="daftar_pelanggan.php";</script>';
        }

        $stmt->close();
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($conn);
        echo '<script>alert("Terjadi kesalahan: ' . $e->getMessage() . '"); location.href="daftar_pelanggan.php";</script>';
    }
} else {
    echo '<script>alert("ID pelanggan tidak ditemukan."); location.href="daftar_pelanggan.php";</script>';
}
?>