<?php
session_start();
include 'koneksi1.php'; // Pastikan file koneksi sesuai

// Tambah data menggunakan Stored Procedure
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_data'])) {
    $id_paket = $_POST['id_paket'];
    $nama_paket = $_POST['nama_paket'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $id_provinsi = trim($_POST['id_provinsi']);
    $durasi = $_POST['durasi'];
    $id_fasilitas = $_POST['id_fasilitas'];

    // Cek apakah id_provinsi valid
    $sql = "CALL paket(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdss", $id_paket, $nama_paket, $deskripsi, $harga, $id_provinsi, $durasi, $id_fasilitas);
    $stmt->execute();
    if ($stmt->error) {
        $_SESSION['message'] = "Error: " . $stmt->error;
    } else {
        $_SESSION['message'] = "Paket wisata berhasil ditambahkan.";
    }

    header("Location: manage_paket_wisata.php");
    exit();
}

// Hapus data menggunakan Transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_data'])) {
    $id_paket = $_POST['id_paket_delete'];

    if (!empty($id_paket)) {
        // Mulai transaksi
        $conn->begin_transaction();

        $sql = "DELETE FROM paket_wisata WHERE id_paket = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_paket);

        if ($stmt->execute()) {
            $conn->commit();
            $_SESSION['message'] = "Paket wisata berhasil dihapus.";
        } else {
            $conn->rollback();
            $_SESSION['message'] = "Error: " . $stmt->error;
        }
    } else {
        $_SESSION['message'] = "ID Paket tidak boleh kosong.";
    }
    header("Location: manage_paket_wisata.php");
    exit();
}

// Ambil semua data paket wisata
$sql = "SELECT * FROM paket_wisata";
$result = $conn->query($sql);

// Ambil data provinsi untuk dropdown
$provinsi_query = "SELECT id_provinsi, provinsi FROM provinsi";
$provinsi_result = $conn->query($provinsi_query);

// Ambil data fasilitas untuk dropdown
$fasilitas_query = "SELECT id_fasilitas, nama_fasilitas FROM fasilitas";
$fasilitas_result = $conn->query($fasilitas_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket Wisata</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Kelola Paket Wisata</h1>
            <a href="admin_dashboard1.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>

        <!-- Pesan Informasi -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Form Menambah Data -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2>Tambah Paket Wisata</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="id_paket">ID Paket:</label>
                        <input type="text" name="id_paket" id="id_paket" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_paket">Nama Paket:</label>
                        <input type="text" name="nama_paket" id="nama_paket" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" step="0.01" name="harga" id="harga" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="id_provinsi">Provinsi:</label>
                        <select name="id_provinsi" id="id_provinsi" class="form-control" required>
                            <option value="">Pilih Provinsi</option>
                            <?php while ($provinsi = $provinsi_result->fetch_assoc()): ?>
                                <option value="<?php echo $provinsi['id_provinsi']; ?>">
                                    <?php echo $provinsi['provinsi']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="durasi">Durasi:</label>
                        <input type="text" name="durasi" id="durasi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="id_fasilitas">Fasilitas:</label>
                        <select name="id_fasilitas" id="id_fasilitas" class="form-control" required>
                            <option value="">Pilih Fasilitas</option>
                            <?php while ($fasilitas = $fasilitas_result->fetch_assoc()): ?>
                                <option value="<?php echo $fasilitas['id_fasilitas']; ?>">
                                    <?php echo $fasilitas['nama_fasilitas']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" name="add_data" class="btn btn-success">Tambah Paket</button>
                </form>
            </div>
        </div>

        <!-- Form Menghapus Data -->
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h2>Hapus Paket Wisata</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="id_paket_delete">ID Paket:</label>
                        <input type="text" name="id_paket_delete" id="id_paket_delete" class="form-control" required>
                    </div>
                    <button type="submit" name="delete_data" class="btn btn-danger">Hapus Paket</button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Paket Wisata -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h2>Daftar Paket Wisata</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Paket</th>
                            <th>Nama Paket</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>ID Provinsi</th>
                            <th>Durasi</th>
                            <th>ID Fasilitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_paket']; ?></td>
                                <td><?php echo $row['nama_paket']; ?></td>
                                <td><?php echo $row['deskripsi']; ?></td>
                                <td><?php echo $row['harga']; ?></td>
                                <td><?php echo $row['id_provinsi']; ?></td>
                                <td><?php echo $row['durasi']; ?></td>
                                <td><?php echo $row['id_fasilitas']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
