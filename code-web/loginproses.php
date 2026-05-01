<?php
session_start();
require 'koneksi1.php'; // Menghubungkan ke database

// Memeriksa apakah data POST ada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Menghindari SQL injection dengan mysqli_real_escape_string
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query untuk memeriksa username dan password
        $query_sql = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'");

        if (mysqli_num_rows($query_sql) > 0) {
            $data = mysqli_fetch_assoc($query_sql);
            
            // Menyimpan data pelanggan ke session
            $_SESSION['pelanggan'] = $data;

            // Data log yang akan diperbarui
            $action = "Login";
            $description = "User  '" . mysqli_real_escape_string($conn, $data['username']) . "' berhasil login.";
            
            // Query INSERT log_table
            $insert_log_sql = "
                INSERT INTO log_table (action, description) 
                VALUES (?, ?)
            ";

            // Menggunakan prepared statement untuk log
            $log_stmt = $conn->prepare($insert_log_sql);
            $log_stmt->bind_param("ss", $action, $description);

            // Eksekusi query INSERT
            if ($log_stmt->execute()) {
                // Redirect ke halaman user_login1.php
                echo '<script>
                        alert("Selamat Datang, ' . htmlspecialchars($data['username']) . '");
                        location.href="user_login1.php";
                      </script>';
            } else {
                die("Error pada query log: " . $log_stmt->error);
            }
        } else {
            // Jika username/password salah
            echo '<script>alert("Username atau Password tidak sesuai."); location.href="login.html";</script>';
        }
    } else {
        // Jika form tidak lengkap
        echo '<script>alert("Harap isi username dan password."); location.href="login.html";</script>';
    }
} else {
    // Jika bukan metode POST
    echo '<script>alert("Harap isi username dan password."); location.href="login.html";</script>';
}
?>