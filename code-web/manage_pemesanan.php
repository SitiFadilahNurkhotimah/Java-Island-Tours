<?php
session_start();
include 'koneksi1.php';

// Proses Tambah Pemesanan
if (isset($_POST['tambah'])) {
    $id_paket = mysqli_real_escape_string($conn, $_POST['id_paket']);
    $id_pelanggan = (int) $_POST['id_pelanggan'];
    $nama_pemesan = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $tanggal_wisata = mysqli_real_escape_string($conn, $_POST['tanggal_wisata']);
    $jumlah_peserta = (int) $_POST['jumlah_peserta'];

    // Ambil harga paket
    $queryHarga = "SELECT harga FROM paket_wisata WHERE id_paket = '$id_paket'";
    $resultHarga = mysqli_query($conn, $queryHarga);

    if ($resultHarga && mysqli_num_rows($resultHarga) > 0) {
        $rowHarga = mysqli_fetch_assoc($resultHarga);
        $harga_paket = $rowHarga['harga'];
        $total_biaya = $harga * $jumlah_peserta;

        $stmt = $conn->prepare("CALL tambah_pemesanan(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siissd", $id_paket, $id_pelanggan, $nama_pemesan, $tanggal_wisata, $jumlah_peserta, $total_biaya);

        if ($stmt->execute()) {
            echo "<script>alert('Pemesanan berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Gagal mengambil harga paket atau harga tidak ditemukan.');</script>";
    }
}

// Proses Hapus Pemesanan
if (isset($_GET['hapus'])) {
    $id_pemesanan = $_GET['hapus'];
    $query = "DELETE FROM pemesanan WHERE id_pemesanan=$id_pemesanan";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pemesanan berhasil dihapus.'); window.location.href='manage_pemesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pemesanan: " . mysqli_error($conn) . "');</script>";
    }
}

// Ambil Data Pemesanan
$data_pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan");
if (!$data_pemesanan) {
    die("Error mengambil data pemesanan: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pemesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manajemen Pemesanan</h2>
        <form method="POST" class="mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_paket" class="form-label">ID Paket</label>
                    <input type="text" name="id_paket" id="id_paket" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                    <input type="number" name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_wisata" class="form-label">Tanggal Wisata</label>
                    <input type="date" name="tanggal_wisata" id="tanggal_wisata" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" required>
                </div>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah Pemesanan</button>
        </form>

        <h3>Daftar Pemesanan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pemesanan</th>
                    <th>ID Paket</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Wisata</th>
                    <th>Jumlah Peserta</th>
                    <th>Total Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($data_pemesanan) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($data_pemesanan)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_pemesanan']); ?></td>
                            <td><?= htmlspecialchars($row['id_paket']); ?></td>
                            <td><?= htmlspecialchars($row['id_pelanggan']); ?></td>
                            <td><?= htmlspecialchars($row['nama_pemesan']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_wisata']); ?></td>
                            <td><?= htmlspecialchars($row['jumlah_peserta']); ?></td>
                            <td><?= htmlspecialchars($row['total_biaya']); ?></td>
                            <td>
                                <a href="manage_pemesanan.php?hapus=<?= $row['id_pemesanan']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Tidak ada data pemesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
