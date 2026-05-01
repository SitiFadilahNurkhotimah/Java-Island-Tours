<?php
// Mulai sesi
session_start();
include 'koneksi1.php';

// Tambah provinsi baru
if (isset($_POST['add_provinsi'])) {
    $id_provinsi = $_POST['id_provinsi'];
    $provinsi = $_POST['provinsi'];

    if (!empty($id_provinsi) && !empty($provinsi)) {
        $query = "CALL tambah_provinsi(?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $id_provinsi, $provinsi);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Provinsi baru berhasil ditambahkan.";
            } else {
                $_SESSION['message'] = "Gagal menambahkan provinsi: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['message'] = "Query gagal dipersiapkan.";
        }
    } else {
        $_SESSION['message'] = "ID Provinsi dan Nama Provinsi tidak boleh kosong.";
    }
}

// Hapus provinsi
if (isset($_POST['delete_provinsi'])) {
    $id_provinsi = $_POST['id_provinsi_delete'];

    if (!empty($id_provinsi)) {
        mysqli_begin_transaction($conn);
        $query = "DELETE FROM provinsi WHERE id_provinsi = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $id_provinsi);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_commit($conn);
                $_SESSION['message'] = "Provinsi berhasil dihapus.";
            } else {
                mysqli_rollback($conn);
                $_SESSION['message'] = "Gagal menghapus provinsi: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            mysqli_rollback($conn);
            $_SESSION['message'] = "Query gagal dipersiapkan.";
        }
    } else {
        $_SESSION['message'] = "ID provinsi tidak valid.";
    }
}

$query = "SELECT * FROM provinsi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Provinsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
            display: inline-block;
        }
        .button-danger {
            background-color: #f44336;
        }
        .button-back {
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
        }
        .message {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Provinsi</h1>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='message'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
    }
    ?>

    <a href="admin_dashboard1.php" class="button-back">&larr; Kembali ke Dashboard</a>

    <form method="POST" action="">
        <label for="id_provinsi">ID Provinsi:</label>
        <input type="text" name="id_provinsi" id="id_provinsi" required>
        <label for="provinsi">Nama Provinsi:</label>
        <input type="text" name="provinsi" id="provinsi" required>
        <button type="submit" name="add_provinsi" class="button">Tambah Provinsi</button>
    </form>

    <form method="POST" action="">
        <label for="id_provinsi_delete">ID Provinsi untuk Dihapus:</label>
        <input type="text" name="id_provinsi_delete" id="id_provinsi_delete" required>
        <button type="submit" name="delete_provinsi" class="button button-danger">Hapus Provinsi</button>
    </form>

    <h2>Daftar Provinsi</h2>
    <table>
        <thead>
            <tr>
                <th>ID Provinsi</th>
                <th>Nama Provinsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id_provinsi']}</td>";
                    echo "<td>{$row['provinsi']}</td>";
                    echo "<td>
                            <form method='POST' action='' style='display:inline-block;'>
                                <input type='hidden' name='id_provinsi_delete' value='{$row['id_provinsi']}'>
                                <button type='submit' name='delete_provinsi' class='button button-danger' onclick='return confirm(\"Anda yakin ingin menghapus provinsi ini?\")'>Hapus</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada provinsi.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
