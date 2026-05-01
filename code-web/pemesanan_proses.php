<?php
include 'koneksi1.php';
session_start(); // Mulai sesi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $id_paket = $_POST['id_paket'];
    $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
    $tanggal_wisata = $_POST['tanggal_wisata'];
    $jumlah_peserta = $_POST['jumlah_peserta'];

    // Ambil harga paket
    $queryHarga = "SELECT harga FROM paket_wisata WHERE id_paket = ?";
    $stmtHarga = $conn->prepare($queryHarga);
    $stmtHarga->bind_param("s", $id_paket);
    $stmtHarga->execute();
    $resultHarga = $stmtHarga->get_result();
    
    if ($resultHarga->num_rows > 0) {
        $rowHarga = $resultHarga->fetch_assoc();
        $harga_paket = $rowHarga['harga'];
        $total_biaya = $harga_paket * $jumlah_peserta;

        // Panggil stored procedure untuk menambah pemesanan
        $stmt = $conn->prepare("CALL tambah_pemesanan(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siissd", $id_pelanggan, $id_paket, $nama_pemesan, $tanggal_wisata, $jumlah_peserta, $total_biaya);

        if ($stmt->execute()) {
            // Simpan ID Pemesanan untuk halaman pembayaran
            $_SESSION['id_pemesanan'] = $conn->insert_id; // Dapatkan ID terakhir
            $_SESSION['total_biaya'] = $total_biaya;

            // Redirect ke halaman pembayaran
            header("Location: pembayaran.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Harga paket tidak ditemukan.";
    }
    $stmtHarga->close();
}

$conn->close();
?>
