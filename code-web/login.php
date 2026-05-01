<?php
session_start();
include 'koneksi1.php'; // Pastikan file koneksi database ada dan sesuai dengan pengaturan Anda

// Cek jika form dipost
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Jika login sebagai admin
    if (isset($_POST['login_as_admin'])) {
        header("Location: admin_login1.php");
        exit();
    // Jika login sebagai pelanggan
    } elseif (isset($_POST['login_as_user'])) {
        header("Location: user_login1.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Nusantara Tour</title>
    <style>
        /* Gaya untuk body dengan latar belakang gambar */
        body {
            font-family: Arial, sans-serif;
            background-image: url('bromo.jpg'); /* Menambahkan gambar latar belakang */
            background-size: cover; /* Gambar akan memenuhi seluruh layar */
            background-position: center; /* Menempatkan gambar di tengah */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white; /* Menambahkan teks berwarna putih agar terlihat di atas gambar */
        }

        /* Kontainer login yang memiliki latar belakang transparan */
        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Background putih transparan */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .input-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 32px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        /* Styling untuk judul dan pilihan login */
        .login-options {
            text-align: center;
        }

        .login-options h2 {
            color: white;
        }

        .login-options button {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            padding: 15px;
            width: 250px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }

        .login-options button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body></body>

    <!-- Pilihan login -->
    <div class="login-options">
        <h2>Pilih Login Sebagai:</h2>
        <form method="POST" action="">
            <button type="submit" name="login_as_admin">Login sebagai Admin</button>
            <button type="submit" name="login_as_user">Login sebagai Pelanggan</button>
        </form>
    </div>

</body>
</html>
