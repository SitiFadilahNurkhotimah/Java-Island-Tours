<?php
// Konfigurasi database
include 'koneksi1.php'; // Pastikan file koneksi database sudah benar


// Ambil data dari form
$id_pemesanan = $_POST['id_pemesanan'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];
$jumlah_pembayaran = $_POST['jumlah_pembayaran'];
$proof = $_FILES['proof']['name'];

// Lokasi folder untuk menyimpan bukti pembayaran
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["proof"]["name"]);

// Pindahkan file bukti pembayaran ke folder tujuan
if (move_uploaded_file($_FILES["proof"]["tmp_name"], $target_file)) {
    // Simpan data pembayaran ke database
    $sql = "INSERT INTO pembayaran (id_pemesanan, metode_pembayaran, tanggal_pembayaran, jumlah_pembayaran, bukti_pembayaran) 
            VALUES ('$id_pemesanan', '$metode_pembayaran', '$tanggal_pembayaran', '$jumlah_pembayaran', '$proof')";

    if ($conn->query($sql) === TRUE) {
        echo "Pembayaran berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Terjadi kesalahan saat mengunggah bukti pembayaran.";
}

// Tutup koneksi
$conn->close();
?>
