<?php
require 'koneksi1.php'; // Menghubungkan ke database

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

 // Menyimpan data ke database
$query_sql = "INSERT INTO pelanggan (Username, Email, Password) VALUES ('$username', '$email', '$password')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: login.html"); // Arahkan ke halaman dashboard
} else {
    // Tangani kesalahan
    echo "Error: " . mysqli_error($conn); // Menampilkan pesan kesalahan jika query gagal
}
?>