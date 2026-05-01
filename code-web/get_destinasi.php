<?php
include 'koneksi1.php';

if (isset($_POST['id_provinsi'])) {
    $id_provinsi = $_POST['id_provinsi'];
    $query = "SELECT id_destinasi, nama_destinasi FROM destinasi WHERE id_provinsi = '$id_provinsi'";
    $result = mysqli_query($conn, $query);

    echo '<option value="">Pilih Destinasi</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id_destinasi'] . '">' . $row['nama_destinasi'] . '</option>';
    }
}
?>