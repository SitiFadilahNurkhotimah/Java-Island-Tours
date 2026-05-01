<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "travel_agency";

$conn = mysqli_connect($host, $user, $pass, $db, 3307);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


