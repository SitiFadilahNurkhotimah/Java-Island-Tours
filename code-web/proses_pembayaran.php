<?php
include 'koneksi1.php'; // Pastikan file koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form pembayaran
    $id_pemesanan = $_POST['id_pemesanan'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
    $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
    $bukti_pembayaran = $_FILES['proof'];

    // Validasi file bukti pembayaran
    $target_dir = "uploads/";
    $file_name = basename($bukti_pembayaran['name']);
    $target_file = $target_dir . time() . "_" . $file_name; // Nama unik
    $upload_ok = 1;

    // Cek tipe file
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Hanya file gambar (JPG, JPEG, PNG, GIF) yang diperbolehkan.";
        $upload_ok = 0;
    }

    // Simpan file
    if ($upload_ok && move_uploaded_file($bukti_pembayaran["tmp_name"], $target_file)) {
        // Pastikan ID Pemesanan valid
        $queryCekPemesanan = "SELECT * FROM pemesanan WHERE id_pemesanan = ?";
        $stmtCek = $conn->prepare($queryCekPemesanan);
        $stmtCek->bind_param("i", $id_pemesanan);
        $stmtCek->execute();
        $resultCek = $stmtCek->get_result();

        if ($resultCek->num_rows > 0) {
            // Simpan data pembayaran ke tabel pembayaran
            $queryPembayaran = "INSERT INTO pembayaran (id_pemesanan, metode_pembayaran, tanggal_pembayaran, jumlah_pembayaran, bukti_pembayaran) VALUES (?, ?, ?, ?, ?)";
            $stmtPembayaran = $conn->prepare($queryPembayaran);
            $stmtPembayaran->bind_param("issds", $id_pemesanan, $metode_pembayaran, $tanggal_pembayaran, $jumlah_pembayaran, $target_file);

            if ($stmtPembayaran->execute()) {
                // Update status pemesanan
                $queryUpdate = "UPDATE pemesanan SET status = 'Lunas' WHERE id_pemesanan = ?";
                $stmtUpdate = $conn->prepare($queryUpdate);
                $stmtUpdate->bind_param("i", $id_pemesanan);
                $stmtUpdate->execute();
            }

            $stmtPembayaran->close();
            $stmtUpdate->close();
        } else {
            echo "ID Pemesanan tidak ditemukan.";
        }

        $stmtCek->close();
    } else {
        echo "Gagal mengunggah bukti pembayaran.";
    }
}

// Tutup koneksi
$conn->close();
?>