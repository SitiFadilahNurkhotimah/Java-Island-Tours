<?php
include 'koneksi1.php';

if (isset($_POST['id_provinsi'])) {
    $id_provinsi = $_POST['id_provinsi'];
    $query = "SELECT id_paket, nama_paket FROM paket_wisata WHERE id_provinsi = '$id_provinsi'";
    $result = mysqli_query($conn, $query);

    echo '<option value="">Pilih Paket</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id_paket'] . '">' . $row['nama_paket'] . '</option>';
    }
}
?>