-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ms_contact`;
CREATE TABLE `ms_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lokasi` text NOT NULL,
  `maps` text NOT NULL,
  `telepon` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_contact` (`id`, `lokasi`, `maps`, `telepon`) VALUES
(1,	' Bandung',	'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347864115!2d107.57311661900951!3d-6.903444341618845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1664371109928!5m2!1sid!2sid',	89621478832);

DROP TABLE IF EXISTS `ms_customer`;
CREATE TABLE `ms_customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_customer` (`id`, `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `no_telp`, `email`, `password`) VALUES
(2,	'Luthfi',	'Laki-Laki',	'2022-10-18',	'41241',	'luthfirrahman696@gmail.com',	''),
(3,	'Luthfi',	'Laki-Laki',	'2022-10-01',	'123',	'admin@admin.com',	'e10adc3949ba59abbe56e057f20f883e'),
(4,	'tes',	'Laki-Laki',	'2022-11-10',	'123',	'wr3wr@fesfesf',	'ba9f0cbaec8fe8e948aa55e4b2282106'),
(5,	'Muhamad Luthfirrahman',	'Laki-Laki',	'3333-12-31',	'123444',	'root',	'6359135db9728b5039aebc1cc3ee6a55'),
(6,	'Luthfi',	'Laki-Laki',	'2022-11-04',	'123412412',	'412412',	'25d55ad283aa400af464c76d713c07ad'),
(7,	'Luthfi',	'Laki-Laki',	'0000-00-00',	'4124124124',	'4124124',	'2eea139dcac72254ed99b2b6df740624'),
(8,	'Muhamad Luthfirrahman',	'Laki-Laki',	'4122-04-12',	'4124214',	'34124124',	'238686a1f2a004b4ffa3e6b60e770c92');

DROP TABLE IF EXISTS `ms_karyawan`;
CREATE TABLE `ms_karyawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ms_karyawan` (`id`, `nama_lengkap`, `email`, `password`, `no_telp`, `jenis_kelamin`, `tanggal_lahir`) VALUES
(2,	'Muhamad Luthfirrahman',	'luthfirrahman696@gmail.com',	'',	'081312566813',	'Laki-Laki',	'1998-08-09');

DROP TABLE IF EXISTS `ms_kategori`;
CREATE TABLE `ms_kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_kategori` (`id`, `gambar`, `kategori`) VALUES
(10,	'1_BFO9W.jpeg',	'Weeding'),
(11,	'2_E2MWF.jpg',	'Motion'),
(12,	'4_5ET19.jpg',	'Kids');

DROP TABLE IF EXISTS `ms_login`;
CREATE TABLE `ms_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ms_login` (`id`, `username`, `password`, `nama`, `id_role`) VALUES
(7,	'admin@admin.com',	'0192023a7bbd73250516f069df18b500',	'Super Admin',	1),
(9,	'luthfirrahman696@gmail.com',	'202cb962ac59075b964b07152d234b70',	'Muhamad Luthfirrahman',	1);

DROP TABLE IF EXISTS `ms_parameter`;
CREATE TABLE `ms_parameter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `param_variable` varchar(50) NOT NULL,
  `param_id` varchar(50) NOT NULL,
  `param_value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ms_parameter` (`id`, `param_variable`, `param_id`, `param_value`) VALUES
(5,	'ROLE',	'1',	'Admin');

DROP TABLE IF EXISTS `ms_product`;
CREATE TABLE `ms_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_kategori` int NOT NULL,
  `desc` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` varchar(50) NOT NULL DEFAULT '0',
  `rbt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_product` (`id`, `nama`, `judul`, `id_kategori`, `desc`, `gambar`, `harga`, `rbt`) VALUES
(4,	'tes',	'tes',	6,	'pexelsfesffes pixabay 326058 K6KIP jpg eaw ewae awe aweawdawdawdawdaw rawr awrtawrawrawr',	'pexels-pixabay-326058_K6KIP.jpg',	'5432424',	'2022-10-09 16:57:53'),
(5,	'Testing 2',	'Testing 2',	10,	'init testing',	'4_OLN65.jpg',	'20000',	'2022-10-23 05:31:09'),
(6,	'Testing 3',	'Testing 3',	11,	'Testing 3',	'2_I97UR.jpg',	'40000',	'2022-10-23 05:31:37'),
(7,	'Testing 4',	'Testing 4',	12,	'Tesing 4fefsfesfes',	'1_6H305.jpeg',	'50000',	'2022-10-23 05:32:06');

DROP TABLE IF EXISTS `ms_slider`;
CREATE TABLE `ms_slider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ms_slider` (`id`, `judul`, `gambar`) VALUES
(2,	'Weeding',	'1_K9HO3.jpeg'),
(3,	'Motion',	'2_S6X00.jpg'),
(4,	'Kids',	'4_1AL1S.jpg');

DROP TABLE IF EXISTS `tr_log`;
CREATE TABLE `tr_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_customer` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tr_log` (`id`, `id_product`, `id_customer`, `status`, `tgl_transaksi`) VALUES
(1,	5,	3,	'PENDING',	'2022-10-24 09:19:42'),
(2,	4,	3,	'PENDING',	'2022-10-24 09:31:02'),
(3,	4,	3,	'CANCEL',	'2022-10-24 09:32:40');

-- 2022-12-07 21:07:11
