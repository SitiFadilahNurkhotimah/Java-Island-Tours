<?php
include 'koneksi1.php';

$query = "SELECT * FROM provinsi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Provinsi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #81BFDA;
        }
        nav a {
            color: black;
            padding: 14px 20px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #B1F0F7;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        footer {
            background-color: #81BFDA;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Daftar Provinsi</h1>
    </header>

    <nav>
        <a href="user_dashboard1.php">Dashboard User</a>
        <a href="provinsi.php">Provinsi</a>
        <a href="destinasi.php">Destinasi Wisata</a>
    </nav>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID Provinsi</th>
                    <th>Nama Provinsi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['id_provinsi']; ?></td>
                        <td>
                            <a href="destinasi.php?id_provinsi=<?php echo $row['id_provinsi']; ?>">
                                <?php echo $row['provinsi']; ?>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <footer>
        &copy; 2024 Java Island Tours. All rights reserved.
    </footer>
</body>
</html>