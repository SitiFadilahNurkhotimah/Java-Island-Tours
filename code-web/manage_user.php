<?php
session_start();
include 'koneksi1.php';

// Proses Tambah Data Pelanggan
if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "INSERT INTO pelanggan (username, password, email) VALUES ('$username', '$password', '$email')";
    mysqli_query($conn, $query);
    header("Location: manage_user.php");
    exit;
}

// Proses Update Data Pelanggan
if (isset($_POST['ubah'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE pelanggan SET username='$username', password='$password', email='$email' WHERE id_pelanggan=$id_pelanggan";
    } else {
        $query = "UPDATE pelanggan SET username='$username', email='$email' WHERE id_pelanggan=$id_pelanggan";
    }

    mysqli_query($conn, $query);
    header("Location: manage_user.php");
    exit;
}

// Proses Hapus Data Pelanggan
if (isset($_GET['hapus'])) {
    $id_pelanggan = $_GET['hapus'];
    $query = "DELETE FROM pelanggan WHERE id_pelanggan=$id_pelanggan";
    mysqli_query($conn, $query);
    header("Location: manage_user.php");
    exit;
}

// Ambil Data Pelanggan
$data_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f3f4f6;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #81BFDA;
            color: white;
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

        .actions a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #81BFDA;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .back-button:hover {
            background-color: #B1F0F7;
        }
    </style>
</head>
<body>
    <h1>Kelola User</h1>

    <!-- Tombol Kembali -->
    <a href="admin_dashboard1.php" class="back-button">Kembali ke Dashboard</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($data_pelanggan)): ?>
                <tr>
                    <td><?php echo $row['id_pelanggan']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td class="actions">
                        <a href="edit_user.php?id=<?php echo $row['id_pelanggan']; ?>">Edit</a>
                        <a href="manage_user.php?hapus=<?php echo $row['id_pelanggan']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="form-container">
        <h2>Tambah User</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="tambah">Tambah User</button>
        </form>
    </div>
</body>
</html>

