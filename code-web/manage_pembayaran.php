<?php
session_start();
include 'koneksi1.php';

// Proses Tambah Pemesanan
if (isset($_POST['tambah'])) {
    $id_paket = mysqli_real_escape_string($conn, $_POST['id_paket']);
    $id_pelanggan = (int) $_POST['id_pelanggan'];
    $tanggal_wisata = mysqli_real_escape_string($conn, $_POST['tanggal_wisata']);
    $jumlah_peserta = (int) $_POST['jumlah_peserta'];
    $total_biaya = (float) $_POST['total_biaya'];

    $query = "INSERT INTO pemesanan (id_paket, id_pelanggan, tanggal_wisata, jumlah_peserta, total_biaya)
              VALUES ('$id_paket', $id_pelanggan, '$tanggal_wisata', $jumlah_peserta, $total_biaya)";
    mysqli_query($conn, $query);
    header("Location: manage_pembayaran.php");
    exit;
}

// Proses Hapus Pemesanan
if (isset($_GET['hapus'])) {
    $id_pemesanan = $_GET['hapus'];
    $query = "DELETE FROM pemesanan WHERE id_pemesanan=$id_pemesanan";
    mysqli_query($conn, $query);
    header("Location: manage_pembayaran.php");
    exit;
}

// Ambil Data Pemesanan
$data_pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pemesanan</title>
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
    </style>
</head>
<body>
    <h1>Kelola Pemesanan</h1>

    <table>
        <thead>
            <tr>
                <th>ID Pemesanan</th>
                <th>ID Paket</th>
                <th>ID Pelanggan</th>
                <th>Tanggal Pemesanan</th>
                <th>Tanggal Wisata</th>
                <th>Jumlah Peserta</th>
                <th>Total Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($data_pemesanan)): ?>
                <tr>
                    <td><?php echo $row['id_pemesanan']; ?></td>
                    <td><?php echo $row['id_paket']; ?></td>
                    <td><?php echo $row['id_pelanggan']; ?></td>
                    <td><?php echo $row['tanggal_pemesanan']; ?></td>
                    <td><?php echo $row['tanggal_wisata']; ?></td>
                    <td><?php echo $row['jumlah_peserta']; ?></td>
                    <td><?php echo number_format($row['total_biaya'], 2, '.', ','); ?></td>
                    <td class="actions">
                        <a href="edit_booking.php?id=<?php echo $row['id_pemesanan']; ?>">Edit</a>
                        <a href="manage_pembayaran.php?hapus=<?php echo $row['id_pemesanan']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="form-container">
        <h2>Tambah Pemesanan</h2>
        <form method="POST">
            <input type="text" name="id_paket" placeholder="ID Paket" required>
            <input type="number" name="id_pelanggan" placeholder="ID Pelanggan" required>
            <input type="datetime-local" name="tanggal_wisata" placeholder="Tanggal Wisata" required>
            <input type="number" name="jumlah_peserta" placeholder="Jumlah Peserta" required>
            <input type="number" step="0.01" name="total_biaya" placeholder="Total Biaya" required>
            <button type="submit" name="tambah">Tambah Pemesanan</button>
        </form>
    </div>
</body>
</html>
