<?php
include 'koneksi1.php';

if (isset($_POST['submit_pemesanan'])) {
    $id_provinsi = $_POST['id_provinsi'];
    $id_paket = $_POST['id_paket'];
    $jumlah_peserta = $_POST['jumlah_peserta'];
    $total_biaya = $_POST['total_biaya'];

    // Query untuk menyimpan data pemesanan
    $query_insert = "INSERT INTO pemesanan (id_provinsi, id_paket, jumlah_peserta, total_biaya)
                     VALUES ('$id_provinsi', '$id_paket', '$jumlah_peserta', '$total_biaya')";
    if (mysqli_query($conn, $query_insert)) {
        echo "<script>alert('Pemesanan berhasil!'); window.location='pembayaran.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
