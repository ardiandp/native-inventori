-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 09, 2025 at 03:24 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u284292842_winkur`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `stok_awal` int(11) NOT NULL DEFAULT 0,
  `satuan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `kategori`, `stok_awal`, `satuan`, `created_at`, `updated_at`) VALUES
(2, 'Gelas', 'Dapur', 11, 'eum', '2024-10-18 14:58:05', '2024-10-21 16:02:24'),
(3, 'Kopi', 'Minuman', 9, 'commodi', '2024-10-18 14:58:05', '2024-10-21 16:02:35'),
(5, 'jas jus', 'eligendi', 1, 'et', '2024-10-18 14:58:05', '2024-10-21 16:02:57'),
(52, 'meja', 'Parabot', 1, 'pcs', NULL, NULL),
(53, 'Buku Gambar', 'ATK', 12, 'pcs', NULL, NULL),
(54, 'Penghapus', 'ATK', 10, 'pcs', NULL, NULL),
(55, 'Serutan', 'ATK', 10, 'pcs', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `barang_id`, `divisi_id`, `jumlah`, `tanggal_keluar`, `created_at`) VALUES
(5, 5, 33, 90, '2025-08-07', '2025-08-07 15:00:42'),
(6, 5, 33, 90, '2025-08-07', '2025-08-07 15:02:56'),
(7, 3, 4, 4, '2025-08-07', '2025-08-07 15:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_divisi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(4, 'Tukang Parki', '2024-10-18 14:58:05', '2024-10-18 14:58:05'),
(5, 'Tukang Masak', '2024-10-18 14:58:05', '2024-10-18 14:58:05'),
(6, 'Tukang Sapu', '2024-10-18 14:58:05', '2024-10-18 14:58:05'),
(7, 'OB [ Office Boy ]', '2024-10-18 14:58:05', '2025-08-09 03:08:14'),
(31, 'kurir', NULL, NULL),
(32, 'Bagian depan', NULL, NULL),
(33, 'Kurri', '2025-07-29 08:09:04', '2025-08-09 03:14:00'),
(34, 'Bagian Belakang', '2025-07-29 08:10:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `icon`, `url`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dashboard', 'fas fa-tachometer-alt', 'main.php?page=dashboard', 1, 1, '2025-07-26 23:29:54', '2025-08-06 11:07:12'),
(4, 2, 'Role', 'fas fa-user-tag', 'main.php?page=roles', 2, 1, '2025-07-26 23:29:54', '2025-08-06 11:07:03'),
(6, NULL, 'Laporan', 'fas fa-chart-bar', 'main.php?page=reports', 4, 1, '2025-07-26 23:29:54', '2025-08-06 10:52:28'),
(8, NULL, 'Menu', 'far fa-user nav-icon', 'main.php?page=menus', 6, 1, '2025-07-29 14:41:21', '2025-08-09 03:08:57'),
(9, NULL, 'Permisions', 'far fa-user nav-icon', '?page=permisions&role_id=1', 7, 1, '2025-07-29 14:42:19', '2025-08-09 03:08:59'),
(10, NULL, 'Divisi ', 'far fa-user nav-icon', 'main.php?page=divisi', 8, 1, '2025-07-29 14:57:35', '2025-08-09 03:09:00'),
(11, NULL, 'Master', NULL, NULL, 9, 1, '2025-07-29 15:15:02', '2025-08-09 03:09:02'),
(12, NULL, 'Barang', 'far fa-user nav-icon', 'main.php?page=barang', 10, 1, '2025-07-29 15:15:44', '2025-08-09 03:09:04'),
(13, NULL, 'Users', 'far fa-user nav-icon', 'main.php?page=users', 11, 1, '2025-07-29 15:22:56', '2025-08-09 03:09:05'),
(14, NULL, 'Request Barang', 'far fa-user nav-icon', 'main.php?page=request_barang', 12, 1, '2025-07-29 16:00:32', '2025-08-09 03:09:07'),
(15, NULL, 'User Request Barang', 'far fa-user nav-icon', 'main.php?page=user_request_barang', 13, 1, '2025-07-29 23:27:16', '2025-08-09 03:09:11'),
(16, NULL, 'Profile', 'far fa-user nav-icon', 'main.php?page=profile', 14, 1, '2025-07-29 23:44:47', '2025-08-09 03:09:13'),
(17, NULL, 'Barang Keluar', 'far fa-user nav-icon', 'main.php?page=barang_keluar', 15, 1, '2025-07-30 00:48:02', '2025-08-09 03:09:14'),
(18, NULL, 'Barang PA edit', 'far fa-user nav-icon', 'main.php?page=barang_pa', 16, 0, '2025-08-06 11:24:04', '2025-08-09 03:09:15'),
(19, NULL, 'Pengadaan Barang', 'far fa-user nav-icon', 'main.php?page=tampil_pengadaan_barang', 21, 1, '2025-08-07 17:16:34', '2025-08-09 03:09:31'),
(20, NULL, 'Input Pengadaan Barang', 'far fa-user nav-icon', 'main.php?page=input_pengadaan_barang', 17, 1, '2025-08-07 17:16:52', '2025-08-09 03:09:18'),
(21, NULL, 'Lap Persediaan Barang ', 'far fa-user nav-icon', 'main.php?page=laporan_persediaan_barang', 18, 1, '2025-08-07 22:07:00', '2025-08-09 03:09:20'),
(22, NULL, 'Lap Permintaan Barang', 'far fa-user nav-icon', 'main.php?page=laporan_permintaan_barang', 20, 1, '2025-08-07 22:07:32', '2025-08-09 03:09:26'),
(23, NULL, 'Lap Pengadaan Barang', 'far fa-user nav-icon', 'main.php?page=laporan_pengadaan_barang', 19, 1, '2025-08-07 22:07:59', '2025-08-09 03:09:22'),
(24, NULL, 'Pengadaan barang ', 'far fa-user nav-icon', 'main.php?page=laporan_pengadaan_barang', 22, 1, '2025-08-07 23:40:47', '2025-08-09 03:09:33'),
(25, NULL, 'Pengadaan barang - BU', 'far fa-user nav-icon', 'main.php?page=tampil_pengadaan_barang_bu', 23, 1, '2025-08-07 23:41:59', '2025-08-09 03:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `pd_detail`
--

CREATE TABLE `pd_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_barang`
--

CREATE TABLE `pengadaan_barang` (
  `id` int(11) NOT NULL,
  `barang_id` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `pengadaan_barang`
--

INSERT INTO `pengadaan_barang` (`id`, `barang_id`, `jumlah`, `satuan`, `tanggal_pengadaan`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 12, 'pcs', '2025-08-07', '1', 'disetujui', '2025-08-07 17:24:00', '2025-08-07 17:26:05'),
(2, '3', 100, 'pcs', '2025-08-07', 'penting', 'draft', '2025-08-07 22:04:28', '2025-08-07 22:04:28'),
(3, '2', 1, '1', '2025-08-07', '1', 'draft', '2025-08-07 23:15:10', '2025-08-07 23:15:10'),
(4, '55', 5, 'pcs', '2025-08-07', 'segera kirim', 'draft', '2025-08-07 23:18:02', '2025-08-07 23:18:02'),
(5, '54', 10, 'pcs', '2025-08-08', 'kirim besok ya ', 'draft', '2025-08-07 23:19:56', '2025-08-07 23:19:56'),
(6, '52', 3, 'pcs', '2025-08-06', 'kirim segera', 'draft', '2025-08-07 23:46:30', '2025-08-07 23:46:30'),
(7, '5', 3, 'pcs', '2025-08-07', 'kirim', 'draft', '2025-08-07 23:47:49', '2025-08-07 23:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT 0,
  `can_create` tinyint(1) NOT NULL DEFAULT 0,
  `can_edit` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `menu_id`, `can_view`, `can_create`, `can_edit`, `can_delete`, `created_at`, `updated_at`) VALUES
(117, 3, 16, 1, 1, 1, 1, '2025-07-30 00:10:09', '2025-07-30 00:10:09'),
(118, 3, 15, 1, 1, 1, 1, '2025-07-30 00:10:09', '2025-07-30 00:10:09'),
(119, 3, 1, 1, 0, 0, 0, '2025-07-30 00:10:09', '2025-07-30 00:10:09'),
(120, 3, 5, 1, 0, 0, 0, '2025-07-30 00:10:09', '2025-07-30 00:10:09'),
(121, 4, 16, 1, 1, 1, 1, '2025-07-30 00:10:22', '2025-07-30 00:10:22'),
(122, 4, 15, 1, 1, 1, 1, '2025-07-30 00:10:22', '2025-07-30 00:10:22'),
(123, 5, 16, 1, 1, 1, 1, '2025-07-30 00:10:32', '2025-07-30 00:10:32'),
(124, 5, 15, 1, 1, 1, 1, '2025-07-30 00:10:32', '2025-07-30 00:10:32'),
(125, 5, 14, 1, 1, 1, 1, '2025-07-30 00:10:32', '2025-07-30 00:10:32'),
(309, 33, 16, 1, 1, 1, 1, '2025-08-07 21:51:14', '2025-08-07 21:51:14'),
(310, 33, 15, 1, 1, 1, 1, '2025-08-07 21:51:14', '2025-08-07 21:51:14'),
(311, 33, 1, 1, 1, 1, 1, '2025-08-07 21:51:14', '2025-08-07 21:51:14'),
(328, 10, 23, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(329, 10, 21, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(330, 10, 22, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(331, 10, 13, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(332, 10, 12, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(333, 10, 10, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(334, 10, 1, 1, 1, 1, 1, '2025-08-07 23:26:20', '2025-08-07 23:26:20'),
(335, 12, 16, 1, 1, 1, 1, '2025-08-07 23:37:06', '2025-08-07 23:37:06'),
(336, 12, 19, 1, 1, 1, 1, '2025-08-07 23:37:06', '2025-08-07 23:37:06'),
(337, 12, 1, 1, 1, 1, 1, '2025-08-07 23:37:06', '2025-08-07 23:37:06'),
(338, 11, 25, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(339, 11, 17, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(340, 11, 21, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(341, 11, 22, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(342, 11, 23, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(343, 11, 14, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(344, 11, 1, 1, 1, 1, 1, '2025-08-07 23:42:32', '2025-08-07 23:42:32'),
(378, 1, 1, 1, 1, 1, 1, '2025-08-09 03:13:47', '2025-08-09 03:13:47'),
(379, 1, 6, 1, 1, 1, 1, '2025-08-09 03:13:47', '2025-08-09 03:13:47'),
(380, 1, 8, 1, 1, 1, 1, '2025-08-09 03:13:47', '2025-08-09 03:13:47'),
(381, 1, 9, 1, 1, 1, 1, '2025-08-09 03:13:47', '2025-08-09 03:13:47'),
(382, 1, 10, 1, 1, 1, 1, '2025-08-09 03:13:47', '2025-08-09 03:13:47'),
(383, 1, 11, 1, 1, 1, 1, '2025-08-09 03:13:47', '2025-08-09 03:13:47'),
(384, 1, 12, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(385, 1, 13, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(386, 1, 14, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(387, 1, 15, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(388, 1, 16, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(389, 1, 17, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(390, 1, 18, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(391, 1, 20, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(392, 1, 21, 1, 1, 1, 1, '2025-08-09 03:13:48', '2025-08-09 03:13:48'),
(393, 1, 23, 1, 1, 1, 1, '2025-08-09 03:13:49', '2025-08-09 03:13:49'),
(394, 1, 22, 1, 1, 1, 1, '2025-08-09 03:13:49', '2025-08-09 03:13:49'),
(395, 1, 19, 1, 1, 1, 1, '2025-08-09 03:13:49', '2025-08-09 03:13:49'),
(396, 1, 24, 1, 1, 1, 1, '2025-08-09 03:13:49', '2025-08-09 03:13:49'),
(397, 1, 25, 1, 1, 1, 1, '2025-08-09 03:13:49', '2025-08-09 03:13:49'),
(398, 1, 4, 1, 1, 1, 1, '2025-08-09 03:13:49', '2025-08-09 03:13:49'),
(399, 2, 1, 1, 1, 1, 1, '2025-08-09 03:19:31', '2025-08-09 03:19:31'),
(400, 2, 6, 1, 1, 1, 1, '2025-08-09 03:19:31', '2025-08-09 03:19:31'),
(401, 2, 8, 1, 1, 1, 1, '2025-08-09 03:19:31', '2025-08-09 03:19:31'),
(402, 2, 9, 1, 1, 1, 1, '2025-08-09 03:19:31', '2025-08-09 03:19:31'),
(403, 2, 10, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(404, 2, 11, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(405, 2, 12, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(406, 2, 13, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(407, 2, 14, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(408, 2, 15, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(409, 2, 16, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(410, 2, 17, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(411, 2, 18, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(412, 2, 20, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(413, 2, 21, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(414, 2, 23, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(415, 2, 22, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(416, 2, 19, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(417, 2, 24, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(418, 2, 25, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32'),
(419, 2, 4, 1, 1, 1, 1, '2025-08-09 03:19:32', '2025-08-09 03:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `order_id` int(11) NOT NULL,
  `supplier` varchar(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`order_id`, `supplier`, `order_date`, `total_amount`, `status`, `notes`) VALUES
(2, 'cv agus', '2025-08-01', 300000.00, 'wait', '-');

-- --------------------------------------------------------

--
-- Table structure for table `request_barang`
--

CREATE TABLE `request_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_barang`
--

INSERT INTO `request_barang` (`id`, `divisi_id`, `barang_id`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(1, 34, 5, 1, 'Ditolak', '2025-07-29 16:01:28', '2025-07-29 16:05:43'),
(2, 32, 5, 1, 'Disetujui', '2025-07-29 16:03:26', '2025-07-29 16:05:02'),
(3, 33, 5, 5, 'Pending', '2025-07-29 16:05:51', '2025-07-29 16:05:51'),
(4, 4, 5, 5, 'Pending', '2025-07-29 16:05:59', '2025-07-29 16:05:59'),
(8, 5, 5, 1, 'Disetujui', '2025-07-29 23:54:50', '2025-08-06 09:29:46'),
(9, 5, 2, 21, 'Ditolak', '2025-07-29 23:54:59', '2025-07-30 00:45:40'),
(10, 5, 2, 21, 'Ditolak', '2025-07-29 23:55:25', '2025-07-30 00:08:08'),
(11, 5, 52, 1, 'Disetujui', '2025-07-29 23:55:31', '2025-07-30 00:45:45'),
(12, 5, 5, 1111, 'Pending', '2025-07-29 23:56:33', '2025-07-29 23:56:33'),
(13, 5, 5, 1111, 'Disetujui', '2025-07-29 23:56:49', '2025-07-30 00:08:01'),
(14, 7, 2, 90, 'Disetujui', '2025-07-30 00:13:08', '2025-07-30 00:13:32'),
(15, 7, 52, 5, 'Ditolak', '2025-07-30 00:13:15', '2025-08-07 22:02:42'),
(17, 33, 5, 90, 'Disetujui', '2025-08-05 19:13:39', '2025-08-07 22:02:56'),
(22, 4, 3, 4, 'Diproses', '2025-08-07 21:55:40', '2025-08-09 02:55:24'),
(23, 5, 53, 1, 'Pending', '2025-08-09 03:02:07', '2025-08-09 03:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Memiliki semua hak akses', '2025-07-26 23:29:49', '2025-08-06 09:34:06'),
(2, 'Admin', 'Admin dengan hak akses terbatas', '2025-07-26 23:29:49', '2025-08-06 09:33:48'),
(10, 'Kepala Bagian Umum', 'yang bertugas meminta barang', '2025-08-06 09:20:25', '2025-08-07 21:26:24'),
(11, 'Bagian Umum', 'Bagian acc permintaan', '2025-08-06 09:20:37', '2025-08-07 21:26:09'),
(12, 'Bagian Pengadaan', 'bertugas mengadakan barang', '2025-08-06 09:20:56', '2025-08-06 09:20:56'),
(33, 'Pemohon', 'yang minta barang', '2025-08-07 21:27:03', '2025-08-07 21:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `contact_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `divisi_id` int(3) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role_id`, `divisi_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '$2y$10$2ds9nfClbFJ.z3k0CYY2tuJBNzdwURHk1WW7hVHwHS9mZmATGJh5G', 'superadmin@example.com', 'Super Administrator', 1, 4, 1, '2025-07-26 23:29:59', '2025-08-06 09:34:41'),
(3, 'admin', '$2y$10$2ds9nfClbFJ.z3k0CYY2tuJBNzdwURHk1WW7hVHwHS9mZmATGJh5G', 'admin@mail.com', 'admin aja', 2, 5, 1, '2025-07-29 14:30:20', '2025-07-29 15:29:30'),
(14, '14', '$2y$10$ThzfltuEHe6dE4NlKYjl4OcnLhYvZ1IAtf2lPBeZEEwPibncjRfbO', '14@mail.com', 'user aja', 5, 33, 1, '2025-08-04 19:10:59', '2025-08-04 19:10:59'),
(15, 'bagian', '$2y$10$msWmmAl7A.dGfGsPfIbU5.81ipqs6T1xK.pZxwoVCSXQjU3zM4PDe', 'bagian@mail.com', 'joni bagian 1', 10, 7, 1, '2025-08-06 09:22:35', '2025-08-06 09:22:35'),
(16, 'staff', '$2y$10$.xSGEdKzl5XLaC63rIZBwOObcPif5CpIup4M.JjJ9ptiYB7PSPCl2', 'staff@mail.com', 'Yuli Staff', 11, 32, 1, '2025-08-06 09:23:07', '2025-08-06 09:23:07'),
(17, '002', '$2y$10$TZ28VZmv3W/Z4EbRVUH0nO7/gBvmNUIjxf7kYDtDazWV7rNNax.TC', '002@mail.com', 'andi bagian pengadaan', 11, 34, 1, '2025-08-06 09:23:38', '2025-08-07 21:58:34'),
(18, '001', '$2y$10$vPiFR28ytFztRINpmEgeaOCuZiAE1gWX5TKnLUBEUYIGOfII4.DkK', '001@mail.com', 'nama pemohon 1', 33, 4, 1, '2025-08-07 21:50:30', '2025-08-07 21:55:53'),
(19, '003', '$2y$10$N1f4563esOwDOxiq/5tFcePa2givqWdHv2zenO4.UlRPBuh320TwW', '003@mail.com', '003 Kepala Bagian Umum', 10, 34, 1, '2025-08-07 23:22:12', '2025-08-07 23:22:12'),
(20, '004', '$2y$10$2f/Xw8cxCxHQBdatnDZ6quPGh6mJglShZaZyg6H57Q/Vr5dRtMF9.', '004@mail.com', '004 bagian Pengadaan', 12, 7, 1, '2025-08-07 23:30:43', '2025-08-07 23:30:43'),
(21, 'bagong', '$2y$10$UVEOn255TD3.78PWfprcaufwY2x/E3zeGZipD1Hv/tXbiO2qIqeQ.', 'bagong@mail.com', 'bagong aja', 33, 7, 1, '2025-08-09 03:12:33', '2025-08-09 03:12:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pd_detail`
--
ALTER TABLE `pd_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_menu` (`role_id`,`menu_id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `request_barang`
--
ALTER TABLE `request_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `divisi_id` (`divisi_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pd_detail`
--
ALTER TABLE `pd_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `request_barang`
--
ALTER TABLE `request_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`);

--
-- Constraints for table `pd_detail`
--
ALTER TABLE `pd_detail`
  ADD CONSTRAINT `pd_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `po` (`order_id`);

--
-- Constraints for table `request_barang`
--
ALTER TABLE `request_barang`
  ADD CONSTRAINT `request_barang_ibfk_1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`),
  ADD CONSTRAINT `request_barang_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
