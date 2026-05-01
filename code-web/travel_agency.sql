-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 12, 2024 at 08:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` int(11) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
(1, 'Oki Ramadhan', 1234, 'okiramadhan@gmail.com'),
(2, 'Alfachino  Maulana', 2345, 'alfachinomaulana@gmail.com'),
(3, 'Siti Fadilah', 3456, 'sitifadilah@gmail.com'),
(4, 'Ayda Syifa', 4567, 'aydasyifa@gmail.com'),
(5, 'Septiani Amalia', 5678, 'septianiamalia@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id_destinasi` varchar(200) NOT NULL,
  `nama_destinasi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `id_kategori` int(200) NOT NULL,
  `kategori` varchar(200) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `id_provinsi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`id_destinasi`, `nama_destinasi`, `kota`, `provinsi`, `id_kategori`, `kategori`, `deskripsi`, `id_provinsi`) VALUES
('1', 'Taman Mini Indonesia Indah', 'Jakarta', 'DK Jakarta', 1, 'Wisata Budaya', 'Taman Mini Indonesia Indah (TMII) adalah sebuah taman wisata budaya yang terletak di Jakarta Timur. TMII merupakan representasi kekayaan budaya Indonesia yang mencakup berbagai aspek kehidupan masyarakat dari 34 provinsi. Setiap provinsi diwakili oleh anjungan yang menampilkan rumah adat, pakaian tradisional, seni, dan budaya khas daerah tersebut.', 'DKJ'),
('10', 'Masjid Istiqlal', 'Jakarta', 'DK Jakarta', 4, 'Wisata Religius', 'Masjid Istiqlal adalah masjid terbesar di Asia Tenggara dan salah satu simbol penting bagi umat Muslim di Indonesia. Terletak di pusat Jakarta, Masjid Istiqlal didirikan sebagai lambang kemerdekaan Indonesia dan sebagai tempat ibadah untuk umat Muslim yang dapat menampung ribuan jemaah.', 'DKJ'),
('11', 'Gereja Katedral Jakarta', 'Jakarta', 'DK Jakarta', 4, 'Wisata Religius', 'Gereja Katedral Jakarta adalah gereja Katolik Roma yang terletak di pusat Kota Jakarta tepatnya di Jalan Katedral, Jakarta Pusat. Gereja ini merupakan salah satu landmark bersejarah dan simbol penting bagi umat Kristiani di Indonesia, terutama di Jakarta. Gereja ini memiliki arsitektur bergaya Gotik yang memukau, dengan menara tinggi yang menjadi ciri khas bangunannya.', 'DKJ'),
('12', 'Klenteng Jin De Yuan', 'Jakarta', 'DK Jakarta', 4, 'Wisata Religius', 'Klenteng Jin De Yuan adalah salah satu klenteng Tionghoa yang terkenal di Jakarta. Terletak di daerah Glodok, Jakarta Barat, klenteng ini memiliki nilai sejarah dan budaya yang sangat penting, terutama bagi komunitas Tionghoa di Indonesia. Klenteng Jin De Yuan juga dikenal sebagai Vihara Dharma Bhakti dan menjadi tempat ibadah bagi umat Buddha dan pengunjung yang ingin mengenal lebih dalam tradisi dan kebudayaan Tionghoa. Nama \"Jin De Yuan\" secara harfiah berarti \"Kuil Keberuntungan dan Kemakmur', 'DKJ'),
('2', 'Museum Fatahillah', 'Jakarta', 'DK Jakarta', 1, 'Wisata Budaya', 'Museum Fatahillah, yang juga dikenal sebagai Museum Sejarah Jakarta, adalah salah satu destinasi wisata budaya dan edukasi terkenal di Jakarta. Museum ini terletak di kawasan Kota Tua, Jakarta Barat, dan berada dalam bangunan bersejarah yang dahulu digunakan sebagai Balai Kota Batavia (Stadhuis).', 'DKJ'),
('3', 'Gedung Kesenian Jakarta', 'Jakarta', 'DK Jakarta', 1, 'Wisata Budaya', 'Gedung Kesenian Jakarta (GKJ) adalah sebuah gedung seni yang terletak di kawasan Kota Tua, Jakarta Barat. Dikenal sebagai salah satu pusat seni dan budaya di Jakarta, Gedung Kesenian Jakarta memiliki nilai historis dan budaya yang tinggi. Gedung ini telah menjadi saksi berbagai pertunjukan seni, baik tradisional maupun modern, serta berbagai acara budaya lainnya.', 'DKJ'),
('4', 'Pulau Tidung', 'Jakarta', 'DK Jakarta', 2, 'Wisata Alam', '\r\nPulau Tidung adalah salah satu destinasi wisata yang terletak di Kepulauan Seribu, Jakarta. Pulau ini dikenal sebagai tujuan wisata yang menyuguhkan keindahan alam, terutama pantai dan laut yang jernih, serta suasana yang tenang dan asri. Pulau Tidung menjadi tempat yang ideal untuk wisatawan yang ingin menikmati keindahan alam tropis dan beragam aktivitas luar ruang.', 'DKJ'),
('5', 'Pulau Pramuka', 'Jakarta', 'DK Jakarta', 2, 'Wisata Alam', 'Pulau Pramuka adalah salah satu pulau yang terletak di Kepulauan Seribu, Jakarta. Pulau ini menjadi salah satu destinasi wisata populer yang sering dikunjungi oleh wisatawan yang ingin menikmati keindahan alam tropis, suasana yang tenang, serta berbagai aktivitas laut seperti snorkeling, diving, dan menjelajahi alam. Pulau Pramuka juga dikenal sebagai pusat administrasi dari Kepulauan Seribu.', 'DKJ'),
('6', 'Kebun Binatang Ragunan', 'Jakarta', 'DK Jakarta', 2, 'Wisata Alam', 'Kebun Binatang Ragunan adalah salah satu tempat wisata dan edukasi terkenal di Jakarta yang terletak di Jakarta Selatan. Kebun binatang ini merupakan salah satu kebun binatang tertua di Indonesia, yang didirikan pada tahun 1864. Ragunan memiliki berbagai koleksi satwa dari seluruh dunia dan menjadi salah satu destinasi utama bagi wisatawan yang ingin belajar lebih banyak tentang fauna serta menikmati keindahan alam.', 'DKJ'),
('7', 'Jet Ski Kepulauan Seribu', 'Jakarta', 'DK Jakarta', 3, 'Wisata Petualangan', 'Jet Ski di Kepulauan Seribu adalah salah satu aktivitas air yang sangat populer di kawasan ini. Kepulauan Seribu, yang terletak di utara Jakarta, menawarkan berbagai pulau indah dengan pemandangan laut yang jernih dan air yang tenang, menjadikannya tempat yang ideal untuk olahraga air seperti jet ski.', 'DKJ'),
('8', 'Pandora Experience Escape Adventure', 'Jakarta', 'DK Jakarta', 3, 'Wisata Petualangan', 'Pandora Experience Escape Adventure adalah salah satu jenis permainan escape room yang terkenal dan menawarkan pengalaman petualangan imersif. Permainan ini menggabungkan unsur teka-teki, petualangan, dan cerita yang menarik, di mana peserta akan \"terperangkap\" di dalam sebuah ruangan dan harus memecahkan berbagai tantangan untuk bisa keluar dalam batas waktu tertentu.', 'DKJ'),
('9', 'Paintball Ancol ', 'Jakarta', 'DK Jakarta', 3, 'Wisata Petualangan', 'Paintball Ancol adalah salah satu aktivitas seru yang bisa dinikmati di kawasan Taman Impian Jaya Ancol, Jakarta. Ancol memiliki fasilitas paintball yang sangat populer di kalangan pengunjung yang suka tantangan dan petualangan. Aktivitas ini biasanya dilakukan dalam kelompok, dan mengedepankan kerjasama tim, strategi, serta ketepatan dalam menggunakan senjata paintball untuk memenangkan pertandingan.', 'DKJ');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(200) NOT NULL,
  `kategori` varchar(200) NOT NULL,
  `deskripsi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `deskripsi`) VALUES
(1, 'Wisata Budaya', 'Wisata Budaya merupakan salah satu kategori wisata yang fokusnya untuk mengeskplorasi kekayaan budaya suatu tempat. Hal itu dapat mencakup sejarah, seni, dan tradisi lokal. Melalui Wisata Budaya, wisatawan dapat merasakan nuansa lokal serta belajar tentang warisan budata yang kaya dalam perjalanan mereka.'),
(2, 'Wisata Alam', 'Wisata Alam merupakan salah satu kategori wisata yang berfokus pada eksplorasi keindahan alam. Hal ini mencakup destinasi seperti pegunungan, pantai, hutan, dan taman nasional. Melalui Wisata Alam, wisatawan dapat menikmati pemandangan yang menakjubkan sekaligus berpartisipasi dalam berbagai aktivitas luar ruangan yang menyegarkan.'),
(3, 'Wisata Petualangan', 'Wisata Petualangan merupakan salah satu kategori wisata yang berfokus pada kegiatan penuh tantangan dan adrenalin. Hal ini mencakup aktivitas seperti hiking, selancar, menyelam, bersepeda gunung, dan lainnya. Melalui Wisata Petualangan, wisatawan dapat menikmati pengalaman mendebarkan yang memacu semangat serta menantang batas kemampuan mereka.'),
(4, 'Wisata Religius', 'Wisata Religius merupakan salah satu kategori wisata yang berfokus pada perjalanan ke tempat-tempat suci dan bersejarah dalam konteks agama. Hal ini mencakup kunjungan ke lokasi-lokasi yang memiliki makna spiritual, di mana wisatawan dapat merasakan kedalaman nilai-nilai agama serta memperdalam pengalaman spiritual mereka.');

-- --------------------------------------------------------

--
-- Table structure for table `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id_paket` int(200) NOT NULL,
  `nama_paket` varchar(200) DEFAULT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `lokasi` varchar(200) DEFAULT NULL,
  `kategori` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(200) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(200) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(200) DEFAULT NULL,
  `tanggal_pembayaran` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `jumlah_pembayaran` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(200) NOT NULL,
  `id_paket` int(200) DEFAULT NULL,
  `id_pelanggan` int(200) NOT NULL,
  `tanggal_pemesanan` timestamp(6) NULL DEFAULT current_timestamp(6),
  `jumlah_peserta` int(200) DEFAULT NULL,
  `total_biaya` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` varchar(200) NOT NULL,
  `provinsi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `provinsi`) VALUES
('BNT', 'Banten'),
('DKJ', 'Daerah Khusus Jakarta'),
('JBR', 'Jawa Barat'),
('JTG', 'Jawa Tengah'),
('JTM', 'Jawa Timur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id_destinasi`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(200) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD CONSTRAINT `destinasi_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`),
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `id_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `id_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
