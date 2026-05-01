<?php
session_start();
include 'koneksi1.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];

    // Ambil data pelanggan berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $pelanggan = $result->fetch_assoc();

    if ($pelanggan && password_verify($password, $pelanggan['password'])) {
        // Simpan ID pelanggan ke session
        $_SESSION['pelanggan'] = $pelanggan['id_pelanggan'];

        // Arahkan ke dashboard
        header("Location: user_dashboard1.php");
        exit;
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
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
    <h1>Selamat Datang!</h1>    
    <p>Mau berwisata kemana hari ini?</p>
    </header>

    <nav>
        <a href="user_dashboard.php">Dashboard</a>
        <a href="provinsi.php">Provinsi</a>
        <a href="destinasi_list.php">Destinasi Wisata</a>
        <a href="paket.php">Paket Wisata</a>
        <a href="bookingpayment.php">Pemesanan</a>
    </nav>

    <div class="dashboard">
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

        <div class="card">
            <h3>Kelola Pemesanan</h3>
            <ul>
                <li><a href="pembayaran.php">Lihat Pemesanan Anda</a></li>
                <li><a href="status_pembayaran.php">Status Pembayaran</a></li>
            </ul>
        </div>

        <div class="card">
            <h3>Info Paket Wisata</h3>
            <p>Fitur ini dapat digunakan untuk melihat paket wisata yang tersedia dan melakukan pemesanan.</p>
            <a href="paket.php">Lihat Paket Wisata</a>
        </div>

        <div class="card">
            <h3>Destinasi Wisata</h3>
            <p>Temukan berbagai destinasi wisata yang menarik untuk dikunjungi.</p>
            <a href="provinsi.php">Lihat Destinasi Wisata yang Tersedia</a>
        </div>
        <div class="card">
            <h3>Rencanakan Wisata</h3>
            <p>Rencanakan perjalanan wisatamu</p>
            <a href ="pembayaran.php">Rencanakan Perjalanan</a>
        <div class="card">
            <h3>Informasi Pembayaran</h3>
            <p>Lihat informasi pembayaranmu</p>
            <a href="pembayaran.php">Lihat Pembayaran</a>
        </div>
        </div>
    </div>

    <footer>
        &copy; Java Island Tours. All rights reserved.
    </footer>
</body>
</html>