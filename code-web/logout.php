<?php
session_start(); // Memulai sesi
session_unset(); // Menghapus semua data sesi
session_destroy(); // Menghancurkan sesi

// Redirect ke halaman login atau dashboard setelah logout
header("Location: login.php"); // Ganti 'login.php' dengan nama file login atau dashboard Anda
exit;
?>
