<?php
require 'koneksi1.php'; // Koneksi ke database

// Periksa apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_destinasi = mysqli_real_escape_string($conn, $_POST['nama_destinasi']);

    // Proses upload file
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "destinasi/"; // Folder penyimpanan
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Buat folder jika belum ada
        }

        // Ambil nama file dan tentukan path penyimpanan
        $gambar_name = basename($_FILES["gambar"]["name"]);
        $gambar_temp = $_FILES["gambar"]["tmp_name"];
        $target_file = $target_dir . time() . "_" . $gambar_name; // Hindari duplikasi nama file

        // Validasi ekstensi file
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($file_extension, $allowed_extensions)) {
            die("Format file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diizinkan.");
        }

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($gambar_temp, $target_file)) {
            // Simpan data ke database
            $query = "INSERT INTO destinasi (nama_destinasi, gambar) VALUES ('$nama_destinasi', '$target_file')";
            if (mysqli_query($conn, $query)) {
                echo "Data berhasil disimpan!";
            } else {
                die("Error: " . mysqli_error($conn));
            }
        } else {
            die("Gagal mengunggah file.");
        }
    } else {
        die("Harap pilih file gambar yang akan diunggah.");
    }
} else {
    die("Metode request tidak valid.");
}
?>
