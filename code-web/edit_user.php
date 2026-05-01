<?php
session_start();
include 'koneksi1.php';

// Ambil data pelanggan berdasarkan ID
if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];
    $query = "SELECT * FROM pelanggan WHERE id_pelanggan=$id_pelanggan";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    header("Location: manage_user.php");
    exit;
}

// Proses update data pelanggan
if (isset($_POST['ubah'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE pelanggan SET username='$username', password='$password_hashed', email='$email' WHERE id_pelanggan=$id_pelanggan";
    } else {
        $query = "UPDATE pelanggan SET username='$username', email='$email' WHERE id_pelanggan=$id_pelanggan";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: manage_user.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f3f4f6;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container form input, .form-container form button {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container form button {
            background-color: #81BFDA;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container form button:hover {
            background-color: #B1F0F7;
        }

        .back-link {
            text-align: center;
            margin-top: 10px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit User</h2>
        <form method="POST">
            <input type="text" name="username" value="<?php echo $data['username']; ?>" placeholder="Username" required>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password Baru (kosongkan jika tidak diubah)">
            <button type="submit" name="ubah">Simpan Perubahan</button>
        </form>
        <div class="back-link">
            <a href="manage_user.php">Kembali</a>
        </div>
    </div>
</body>
</html>
