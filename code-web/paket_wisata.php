<?php
include 'koneksi1.php';

// Cek jika request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_provinsi = $_POST['id_provinsi'];

    // Query untuk mengambil paket wisata berdasarkan provinsi
    $query_paket = "SELECT id_paket, nama_paket, harga FROM paket_wisata WHERE id_provinsi = '$id_provinsi'";
    $result_paket = mysqli_query($conn, $query_paket);

    $options = "<option value=''>Pilih Paket</option>";
    while ($row = mysqli_fetch_assoc($result_paket)) {
        $options .= "<option value='{$row['id_paket']}' data-harga='{$row['harga']}'>{$row['nama_paket']}</option>";
    }

    echo $options;
    exit;
}
?>
