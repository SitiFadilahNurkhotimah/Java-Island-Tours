<?php
// Mulai sesi
session_start();
include 'koneksi1.php'; // File koneksi database

// Proses menambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_data'])) {
    $id_destinasi = $_POST['id_destinasi'];
    $nama_destinasi = $_POST['nama_destinasi'];
    $kota = $_POST['kota'];
    $provinsi = $_POST['provinsi'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $id_provinsi = $_POST['id_provinsi'];

    if (!empty($id_destinasi) && !empty($nama_destinasi) && !empty($kota)) {
        $query = "CALL AD(?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssiss", $id_destinasi, $nama_destinasi, $kota, $provinsi, $id_kategori, $deskripsi, $id_provinsi);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Data destinasi berhasil ditambahkan.";
            } else {
                $_SESSION['message'] = "Gagal menambahkan data destinasi: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        $_SESSION['message'] = "Semua kolom wajib diisi!";
    }
}

// Proses menghapus data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_data'])) {
    $id_destinasi = $_POST['id_destinasi_delete'];

    if (!empty($id_destinasi)) {
        mysqli_begin_transaction($conn);
        try {
            $query = "DELETE FROM destinasi WHERE id_destinasi = ?";
            $stmt = mysqli_prepare($conn, $query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $id_destinasi);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_commit($conn);
                $_SESSION['message'] = "Data destinasi dengan ID $id_destinasi berhasil dihapus.";
            } else {
                throw new Exception("Gagal menghapus data destinasi: " . mysqli_error($conn));
            }
        } catch (Exception $e) {
            mysqli_rollback($conn);
            $_SESSION['message'] = $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "ID Destinasi tidak boleh kosong.";
    }
}

// Ambil data destinasi untuk ditampilkan
$query = "SELECT * FROM destinasi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Destinasi Wisata</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Kelola Destinasi Wisata</h1>
        <a href="admin_dashboard1.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info alert-dismissible">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Tambah Data Destinasi</div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id_destinasi">ID Destinasi:</label>
                    <input type="text" class="form-control" name="id_destinasi" id="id_destinasi" required>
                </div>
                <div class="form-group">
                    <label for="nama_destinasi">Nama Destinasi:</label>
                    <input type="text" class="form-control" name="nama_destinasi" id="nama_destinasi" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <input type="text" class="form-control" name="kota" id="kota" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi:</label>
                    <input type="text" class="form-control" name="provinsi" id="provinsi" required>
                </div>
                <div class="form-group">
                    <label for="id_kategori">ID Kategori:</label>
                    <input type="number" class="form-control" name="id_kategori" id="id_kategori" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="id_provinsi">ID Provinsi:</label>
                    <input type="text" class="form-control" name="id_provinsi" id="id_provinsi" required>
                </div>
                <button type="submit" class="btn btn-success" name="add_data">Tambah Destinasi</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-danger text-white">Hapus Data Destinasi</div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id_destinasi_delete">ID Destinasi:</label>
                    <input type="text" class="form-control" name="id_destinasi_delete" id="id_destinasi_delete" required>
                </div>
                <button type="submit" class="btn btn-danger" name="delete_data">Hapus Destinasi</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white">Daftar Destinasi</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Destinasi</th>
                        <th>Nama Destinasi</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>ID Kategori</th>
                        <th>Deskripsi</th>
                        <th>ID Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id_destinasi']; ?></td>
                            <td><?php echo $row['nama_destinasi']; ?></td>
                            <td><?php echo $row['kota']; ?></td>
                            <td><?php echo $row['provinsi']; ?></td>
                            <td><?php echo $row['id_kategori']; ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                            <td><?php echo $row['id_provinsi']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
