<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agency</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        header {
            background-image: url('purabali1.jpg');
            background-size: cover;
            background-position: center;
            color: black;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.7); 
            padding: 30px;
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
            text-align: center;
        }
        nav a:hover {
            background-color: #B1F0F7;
        }
        .section {
            display: none;
            padding: 20px;
            margin: 20px;
            background-color: #F5F0CD;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section.active {
            display: block;
        }
        footer {
            background-color: #81BFDA;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Nusantara Tours</h1>
    </header>
    <nav>
        <a href="#" onclick="showSection('home')">Home</a>
        <a href="#" onclick="showSection('about')">About</a>
        <a href="#" onclick="showSection('paket')">Paket Wisata</a>
        <a href="#" onclick="showSection('login')">Login</a>
    </nav>

    <div id="home" class="section active">
        <h1>Selamat Datang di Nusantara Tours</h1>
        <p>Mau liburan tapi ngga mau ribet? Kami hadir untuk mewujudkan liburan impianmu tanpa kerepotan! Jelajahi berbagai destinasi dan paket menarik hanya dengan beberapa klik.</p>
    </div>

    <div id="about" class="section">
        <h2>Tentang Kami</h2>
        <p>Kami adalah tim yang berdedikasi untuk memberikan solusi inovatif bagi pelanggan kami dengan fokus pada kualitas dan kepuasan.</p>
        <h3>Visi Kami</h3>
        <p>Menjadi pemimpin dalam industri pariwisata dengan layanan berkualitas tinggi.</p>
        <h3>Misi Kami</h3>
        <p>Menyediakan pengalaman liburan yang tak terlupakan dengan harga terjangkau.</p>
    </div>

    <div id="paket" class="section">
        <h2>Paket Wisata</h2>
        <p>Kami menawarkan berbagai paket wisata menarik, mulai dari wisata alam, budaya, hingga petualangan seru di seluruh Nusantara.</p>
    </div>

    <div id="login" class="section">
        <h2>Login</h2>
        <form action="#">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" placeholder="Masukkan username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="#">Daftar di sini</a></p>
    </div>

    <footer>
        &copy; 2024 Nusantara Tours. All rights reserved.
    </footer>

    <script>
        function showSection(sectionId) {
            // Sembunyikan semua section
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));

            // Tampilkan section yang dipilih
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.add('active');
            }
        }
    </script>
</body>
</html>
