-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2023 pada 22.04
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_kupang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(15) NOT NULL,
  `id_kafe` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode_alternatif`, `id_kafe`, `rank`, `total`, `created_at`, `updated_at`) VALUES
(1, 'A1', 30, 2, 7, '2023-04-12 01:16:17', '2023-04-12 01:16:17'),
(2, 'A2', 31, 3, 0, '2023-04-12 23:26:22', '2023-04-12 23:26:22'),
(3, 'A3', 33, 1, 12, '2023-04-12 23:26:28', '2023-04-12 23:26:28'),
(4, 'A4', 34, 4, 0, '2023-04-12 23:28:36', '2023-04-12 23:28:36'),
(5, 'A5', 35, 0, 0, '2023-10-27 17:37:49', '2023-10-27 17:37:49'),
(6, 'A6', 36, 0, 0, '2023-10-27 17:38:13', '2023-10-27 17:38:13'),
(7, 'A7', 37, 0, 0, '2023-10-27 17:38:26', '2023-10-27 17:38:26'),
(8, 'A8', 38, 0, 0, '2023-10-27 17:38:42', '2023-10-27 17:38:42'),
(9, 'A9', 39, 3, 25, '2023-10-27 17:38:57', '2023-10-27 17:38:57'),
(10, 'A10', 41, 0, 0, '2023-10-27 17:39:33', '2023-10-27 17:39:33'),
(11, 'A11', 40, 2, 25, '2023-10-27 17:40:04', '2023-10-27 17:40:04'),
(12, 'A12', 42, 0, 0, '2023-10-27 17:40:46', '2023-10-27 17:40:46'),
(13, 'A13', 43, 0, 0, '2023-10-27 17:41:01', '2023-10-27 17:41:01'),
(14, 'A14', 45, 0, 0, '2023-10-27 17:41:51', '2023-10-27 17:41:51'),
(15, 'A15', 44, 4, 23, '2023-10-27 17:42:11', '2023-10-27 17:42:11'),
(16, 'A16', 46, 2, 26, '2023-10-27 17:42:29', '2023-10-27 17:42:29'),
(17, 'A17', 47, 1, 28, '2023-10-27 17:42:45', '2023-10-27 17:42:45'),
(18, 'A18', 48, 3, 24, '2023-10-27 17:43:06', '2023-10-27 17:43:06'),
(19, 'A19', 49, 0, 0, '2023-10-27 17:43:21', '2023-10-27 17:43:21'),
(20, 'A20', 50, 0, 0, '2023-10-27 17:43:39', '2023-10-27 17:43:39'),
(21, 'A10', 51, 0, 0, '2023-12-10 16:13:02', '2023-12-10 16:13:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`) VALUES
(1, 'auth.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kafe`
--

CREATE TABLE `kafe` (
  `id_kafe` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nama_kafe` varchar(50) NOT NULL DEFAULT '-',
  `telp` char(12) NOT NULL DEFAULT '+62',
  `alamat` varchar(100) NOT NULL,
  `id_status` int(2) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kafe`
--

INSERT INTO `kafe` (`id_kafe`, `id_user`, `image`, `nama_kafe`, `telp`, `alamat`, `id_status`, `created_at`, `updated_at`) VALUES
(30, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2822787437.jpg', 'Bondi Cafe', ' 08123980752', 'VJ27+CRH, Klp. Lima, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim', 1, '2023-04-10 17:59:42', '2023-04-13 02:46:32'),
(31, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/171781922.jpg', 'Paradox', '081239199995', 'Jl. W.J. Lalamentik, Oebufu, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85111', 1, '2023-04-10 17:59:56', '2023-04-13 02:46:32'),
(33, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/1015937908.jpg', 'La Cove Beach Resto &amp; Bar', '08113811022', 'Lasiana, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim.', 1, '2023-04-10 18:05:45', '2023-04-10 18:05:45'),
(34, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/3479194790.jpg', 'Tebing Bar &amp; Cafe', '081233331115', 'Alak, City,, Alak, Kupang, Kota Kupang, Nusa Tenggara Tim.', 1, '2023-04-12 23:28:21', '2023-04-12 23:28:21'),
(35, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2769100892.jpg', 'Kedai Kopi Petir', '081339118347', 'Fatululi, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim.', 1, '2023-10-26 17:05:49', '2023-10-26 17:05:49'),
(36, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/395339982.jpeg', 'The Kings', '081237729374', 'Jl. M Praja No.88, Namosain, Kec. Alak, Kota Kupang, Nusa Tenggara Tim. 85224', 1, '2023-10-26 17:17:11', '2023-10-26 17:17:11'),
(37, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2067708491.jpeg', 'Royal Cafe', '081246615557', 'Jl. Bund. PU Kelurahan No.10, Tuak Daun Merah, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85228', 1, '2023-10-26 17:57:54', '2023-10-26 17:57:54'),
(38, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/1799723781.jpeg', 'Kedai Kopi Kulo', '082311932949', 'Bank Christa Jaya, Jl. Frans Seda No.16, Fatululi, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 8511', 1, '2023-10-26 18:15:14', '2023-10-26 18:15:14'),
(39, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2959239662.jpeg', 'Ja\'o Coffee Bar', '085239942215', 'Jl. Frans Seda No.105A, Fatululi, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85111', 1, '2023-10-26 18:19:41', '2023-10-26 18:19:41'),
(40, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/1093983035.jpeg', 'Cafe Teras Petuk', '081338167788', 'Unnamed Road, Kolhua, Kec. Maulafa, Kota Kupang, Nusa Tenggara Tim.', 3, '2023-10-26 18:25:23', '2023-12-08 12:35:15'),
(41, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/4173204211.jpg', 'My Kopi - O Cafe', '081138221888', 'Jl. Samratulangi No.9b, Oesapa Bar., Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim. 85228', 1, '2023-10-27 16:11:37', '2023-10-27 16:11:37'),
(42, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/3951095021.jpeg', 'Kopi Kembo', '082122766741', 'Jl. Timor Raya No.1b, Klp. Lima, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim. 85228', 1, '2023-10-27 16:14:27', '2023-10-27 16:14:27'),
(43, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2675610487.jpg', 'Suka Roti', '081236098011', 'VM22+8J5, Oesapa, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim.', 1, '2023-10-27 16:16:34', '2023-10-27 16:16:34'),
(44, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/1766222178.jpg', 'Capital Cafe', '081239911919', 'Jl. Bund. PU No.106, Tuak Daun Merah, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85111', 3, '2023-10-27 16:18:26', '2023-12-08 12:35:15'),
(45, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/238561112.jpg', 'Excelso', '03808800167', 'Jl. Bund. PU No.1, Tuak Daun Merah, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85228', 1, '2023-10-27 16:21:17', '2023-10-27 16:21:17'),
(46, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2644877310.jpg', 'Beta Punk Cafe &amp; Resto', '082145191909', 'Kayu Putih, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim', 1, '2023-10-27 16:23:27', '2023-10-27 16:23:27'),
(47, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/1139166659.jpg', 'Beta Cafe', '08245191909', 'RHQM+WM9, Merdeka, Kec. Kota Lama, Kota Kupang, Nusa Tenggara Tim.', 3, '2023-10-27 16:49:11', '2023-12-10 15:44:56'),
(48, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/2224224314.jpg', 'Cafe Coklat', '085253374511', 'Jl. Garuda, RT.03/RW.06, Liliba, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim', 3, '2023-10-27 16:55:31', '2023-12-10 15:44:57'),
(49, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/3397997195.jpg', 'Rumah Pohon Cafe Shop ', '081337727771', 'Jl. Polisi Militer No.3, Oebobo, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85111', 1, '2023-10-27 17:00:28', '2023-10-27 17:00:28'),
(50, 1, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/3132667357.jpg', 'Muca Cafe', '081353934470', 'Jl. Gunung Mutis No.31, Merdeka, Kec. Kota Lama, Kota Kupang, Nusa Tenggara Tim.', 1, '2023-10-27 17:02:16', '2023-10-27 17:02:16'),
(51, 2, 'http://127.0.0.1:1010/apps/tugas/cafe_kupang/assets/images/kafe/892540704.jpg', 'OCD Kafe', '08114353343', 'Lasiana Beach', 1, '2023-12-10 16:03:07', '2023-12-10 16:03:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(15) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`, `created_at`, `updated_at`) VALUES
(15, 'C1', 'fasilitas', 80, '2023-04-11 19:40:56', '2023-04-11 19:40:56'),
(17, 'C2', 'harga', 85, '2023-10-25 13:13:07', '2023-10-25 13:13:07'),
(18, 'C3', 'lokasi', 75, '2023-10-26 15:29:23', '2023-10-26 15:29:23'),
(19, 'C4', 'variasi menu', 60, '2023-10-26 15:29:51', '2023-10-26 15:29:51'),
(20, 'C5', 'waktu operasional', 75, '2023-10-26 15:30:17', '2023-10-26 15:30:17'),
(21, 'C6', 'rating', 80, '2023-10-26 15:30:42', '2023-10-26 15:30:42'),
(22, 'C7', 'Pelayanan', 95, '2023-10-26 17:49:45', '2023-10-26 17:49:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id_nilai_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id_nilai_alternatif`, `id_kriteria`, `id_alternatif`, `nilai`) VALUES
(188, 15, 5, 0),
(189, 17, 5, 0),
(190, 18, 5, 0),
(191, 19, 5, 0),
(192, 20, 5, 0),
(193, 21, 5, 0),
(194, 22, 5, 0),
(195, 15, 6, 0),
(196, 17, 6, 0),
(197, 18, 6, 0),
(198, 19, 6, 0),
(199, 20, 6, 0),
(200, 21, 6, 0),
(201, 22, 6, 92),
(202, 15, 7, 0),
(203, 17, 7, 0),
(204, 18, 7, 0),
(205, 19, 7, 0),
(206, 20, 7, 0),
(207, 21, 7, 0),
(208, 22, 7, 0),
(209, 15, 8, 0),
(210, 17, 8, 30),
(211, 18, 8, 25),
(212, 19, 8, 0),
(213, 20, 8, 0),
(214, 21, 8, 0),
(215, 22, 8, 0),
(216, 15, 9, 45),
(217, 17, 9, 25),
(218, 18, 9, 15),
(219, 19, 9, 20),
(220, 20, 9, 20),
(221, 21, 9, 25),
(222, 22, 9, 25),
(223, 15, 10, 0),
(224, 17, 10, 0),
(225, 18, 10, 0),
(226, 19, 10, 0),
(227, 20, 10, 0),
(228, 21, 10, 0),
(229, 22, 10, 0),
(230, 15, 11, 45),
(231, 17, 11, 25),
(232, 18, 11, 25),
(233, 19, 11, 25),
(234, 20, 11, 20),
(235, 21, 11, 20),
(236, 22, 11, 15),
(237, 15, 12, 0),
(238, 17, 12, 0),
(239, 18, 12, 0),
(240, 19, 12, 0),
(241, 20, 12, 0),
(242, 21, 12, 0),
(243, 22, 12, 0),
(244, 15, 13, 0),
(245, 17, 13, 0),
(246, 18, 13, 0),
(247, 19, 13, 0),
(248, 20, 13, 0),
(249, 21, 13, 0),
(250, 22, 13, 0),
(251, 15, 14, 30),
(252, 17, 14, 25),
(253, 18, 14, 25),
(254, 19, 14, 20),
(255, 20, 14, 20),
(256, 21, 14, 15),
(257, 22, 14, 10),
(258, 15, 15, 20),
(259, 17, 15, 25),
(260, 18, 15, 25),
(261, 19, 15, 20),
(262, 20, 15, 30),
(263, 21, 15, 20),
(264, 22, 15, 20),
(265, 15, 16, 30),
(266, 17, 16, 25),
(267, 18, 16, 30),
(268, 19, 16, 35),
(269, 20, 16, 30),
(270, 21, 16, 25),
(271, 22, 16, 15),
(272, 15, 17, 40),
(273, 17, 17, 20),
(274, 18, 17, 20),
(275, 19, 17, 30),
(276, 20, 17, 35),
(277, 21, 17, 25),
(278, 22, 17, 25),
(279, 15, 18, 40),
(280, 17, 18, 25),
(281, 18, 18, 20),
(282, 19, 18, 20),
(283, 20, 18, 25),
(284, 21, 18, 20),
(285, 22, 18, 20),
(286, 15, 19, 0),
(287, 17, 19, 0),
(288, 18, 19, 0),
(289, 19, 19, 0),
(290, 20, 19, 0),
(291, 21, 19, 0),
(292, 22, 19, 0),
(293, 15, 20, 0),
(294, 17, 20, 0),
(295, 18, 20, 0),
(296, 19, 20, 0),
(297, 20, 20, 0),
(298, 21, 20, 0),
(299, 22, 20, 0),
(309, 15, 21, 0),
(310, 17, 21, 0),
(311, 18, 21, 0),
(312, 19, 21, 0),
(313, 20, 21, 0),
(314, 21, 21, 0),
(315, 22, 21, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `overview`
--

CREATE TABLE `overview` (
  `id` int(11) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `overview`
--

INSERT INTO `overview` (`id`, `judul`, `konten`) VALUES
(1, 'Cafe', '<p><strong>Lorem ipsum</strong>, dolor sit amet consectetur adipisicing elit. Voluptatibus atque ea vero, tempore ducimus maiores rem saepe amet vitae facere dignissimos iure similique reprehenderit quo enim rerum repudiandae, impedit cumque? Error perspiciatis nesciunt explicabo consectetur fugiat minima nisi, molestias suscipit beatae ullam. Sed dolorum fugiat ipsam ex vitae quos, adipisci blanditiis accusantium corrupti sint quas nam ullam ab. Facilis nisi a dolores iure dicta maxime quam repellat? Cum fuga facilis vero optio? Itaque porro hic laudantium cumque minima mollitia quo libero deserunt maiores beatae, obcaecati ut veritatis, quod ratione, eaque temporibus. Voluptatem minus voluptatum reprehenderit possimus soluta? Tenetur, quas. Necessitatibus?</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_kafe`
--

CREATE TABLE `status_kafe` (
  `id_status` int(11) NOT NULL,
  `status_kafe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_kafe`
--

INSERT INTO `status_kafe` (`id_status`, `status_kafe`) VALUES
(1, 'Belum Jelas'),
(2, 'Kafe Tidak Direkomendasi'),
(3, 'Kafe Direkomendasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(50) NOT NULL,
  `nilai_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `nilai_sub`) VALUES
(55, 18, 'pusat kota', 100),
(56, 18, 'tengah kota', 100),
(57, 18, 'pinggir kota', 100),
(58, 17, 'Di bawah Rp. 25.000', 100),
(59, 17, 'Rp. 26.000 - Rp. 40.000', 100),
(60, 17, 'Rp. 41.000 - Rp. 60.000', 100),
(61, 15, 'Sangat Lengkap', 100),
(62, 15, 'Lengkap', 100),
(63, 15, 'Kurang Lengkap', 100),
(64, 19, 'Sangat Banyak', 100),
(65, 19, 'Banyak', 100),
(66, 19, 'Sedikit', 100),
(67, 20, '08.00 - 21.00', 100),
(68, 20, '09.00 - 22.00', 100),
(69, 20, '15.00 - 23.00', 100),
(70, 21, 'Sangat baik', 100),
(71, 21, 'Cukup Baik', 100),
(72, 21, 'Buruk', 100),
(73, 22, 'Sangat Ramah', 100),
(74, 22, 'Cukup Ramah', 100),
(75, 22, 'Buruk', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2023-12-09 21:54:17', '2023-12-09 21:54:17'),
(2, 3, 1, '2y10KY6Ldm9HvMifNEgb42q04uaQF7o9zflCdHYFXsQwrKY2BPAFaNMu', '991820', 'OCD Cafe', 'default.svg', 'putriraki240800@gmail.com', '$2y$10$cSq62RBpCqDaEuWdVuv5Ke7jNQYA/su3tZMM6g7W9EPX9Rikt/lJe', '2023-12-10 15:53:41', '2023-12-10 15:54:12');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `insert_users` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.id_role = (
        SELECT id_role
        FROM `user_role`
        ORDER BY id_role DESC
        LIMIT 1
    )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 3, 7),
(15, 3, 10),
(16, 3, 11),
(17, 3, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`) VALUES
(1, 'User Management'),
(2, 'Menu Management'),
(3, 'SMART');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Owner'),
(3, 'Admin Kafe'),
(4, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`, `icon`) VALUES
(1, 1, 1, 'Users', 'users', 'fas fa-users'),
(2, 1, 1, 'Role', 'role', 'fas fa-user-cog'),
(3, 2, 1, 'Menu', 'menu', 'fas fa-fw fa-folder'),
(4, 2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-folder-open'),
(5, 2, 1, 'Menu Access', 'menu-access', 'fas fa-user-lock'),
(6, 2, 1, 'Sub Menu Access', 'sub-menu-access', 'fas fa-user-lock'),
(7, 3, 1, 'Kafe', 'kafe', 'fas fa-list-ul'),
(8, 3, 1, 'Kriteria', 'kriteria', 'fas fa-list-ul'),
(9, 3, 1, 'Sub Kriteria', 'sub-kriteria', 'fas fa-list-ul'),
(10, 3, 1, 'Alternatif', 'alternatif', 'fas fa-list-ul'),
(11, 3, 1, 'Nilai Alternatif', 'nilai-alternatif', 'fas fa-list-ul'),
(12, 3, 1, 'Pemilihan Kafe', 'pemilihan-kafe', 'fas fa-list-ul');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_user` (`id_kafe`);

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kafe`
--
ALTER TABLE `kafe`
  ADD PRIMARY KEY (`id_kafe`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id_nilai_alternatif`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `overview`
--
ALTER TABLE `overview`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_kafe`
--
ALTER TABLE `status_kafe`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `sub_kriteria_ibfk_1` (`id_kriteria`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kafe`
--
ALTER TABLE `kafe`
  MODIFY `id_kafe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id_nilai_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT untuk tabel `overview`
--
ALTER TABLE `overview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `status_kafe`
--
ALTER TABLE `status_kafe`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_kafe`) REFERENCES `kafe` (`id_kafe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kafe`
--
ALTER TABLE `kafe`
  ADD CONSTRAINT `kafe_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status_kafe` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kafe_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
