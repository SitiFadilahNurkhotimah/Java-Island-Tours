<?php
session_start();
include 'koneksi1.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login1.php");
    exit;
}

$id_admin = $_SESSION['admin'];
$query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }

        header {
            background-image: url('dieng.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.7); 
            padding: 20px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #81BFDA;
        }

        nav a {
            color: black;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }

        nav a:hover {
            background-color: #B1F0F7;
        }

        .dashboard {
            padding: 20px;
        }

        .card {
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .card h3 {
            margin: 0 0 15px;
        }

        .card a {
            display: block;
            color: #007bff;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .card a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #81BFDA;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .logout {
            text-align: right;
            padding: 10px;
        }

        .logout a {
            color: #ff0000;
            text-decoration: none;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, <?php echo $_SESSION['admin']; ?>!</p>
    </header>

    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_provinsi.php">Provinsi</a>
        <a href="manage_destinasi.php">Destinasi</a>
        <a href="manage_paket_wisata.php">Paket Wisata</a>
        <a href="manage_user.php">User</a>
        <a href="manage_pembayaran.php">Pembayaran</a>
        <a href="manage_pemesanan.php">Pemesanan</a>
    </nav>

    <div class="dashboard">
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

        <div class="card">
            <h3>Kelola Tabel</h3>
            <ul>
                <li><a href="manage_provinsi.php">Kelola Provinsi</a></li>
                <li><a href="manage_destinasi.php">Kelola Destinasi</a></li>
                <li><a href="manage_paket_wisata.php">Kelola Paket Wisata</a></li>
                <li><a href="manage_user.php">Kelola User</a></li>
                <li><a href="manage_pembayaran.php">Kelola Pembayaran</a></li>
                <li><a href="manage_pemesanan.php">Kelola Pemesanan</a></li>
            </ul>
        </div>

        <div class="card">
            <h3>Statistik</h3>
            <p>Fitur ini dapat digunakan untuk menampilkan statistik data seperti jumlah pemesanan, user terdaftar, dan lainnya.</p>
            <a href="#">Lihat Statistik</a>
        </div>
    </div>

    <footer>
        &copy; 2024 Java Island Tours. All rights reserved.
    </footer>
</body>
</html>