-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 09:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiosku`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_type` varchar(191) NOT NULL,
  `id_pembelian` bigint(20) UNSIGNED DEFAULT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `activity_type`, `id_pembelian`, `id_produk`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Pembelian', 3, 1, 5.5, '2024-07-12 14:08:23', '2024-07-12 14:08:23'),
(2, 'Pembelian', 6, 1, 1, '2024-07-13 07:06:10', '2024-07-13 07:06:10'),
(3, 'Pembelian', 6, 2, 1, '2024-07-13 07:06:10', '2024-07-13 07:06:10'),
(4, 'Pengembalian', 6, 1, 1, '2024-07-13 07:24:53', '2024-07-13 07:24:53'),
(5, 'Pengembalian', 6, 2, 1, '2024-07-13 07:24:54', '2024-07-13 07:24:54'),
(6, 'Pembelian', 7, 1, 10, '2024-07-13 07:26:45', '2024-07-13 07:26:45'),
(7, 'Pembelian', 7, 2, 10, '2024-07-13 07:26:45', '2024-07-13 07:26:45'),
(8, 'Pembelian', 15, 1, 13, '2024-07-13 15:25:13', '2024-07-13 15:25:13'),
(9, 'Pembelian', 15, 1, 13, '2024-07-13 15:29:06', '2024-07-13 15:29:06'),
(10, 'Pembelian', 16, 2, 1, '2024-07-13 15:44:20', '2024-07-13 15:44:20'),
(11, 'Pembelian', 17, 1, 1.5, '2024-07-13 16:10:50', '2024-07-13 16:10:50'),
(12, 'Pembelian', 20, 1, 20, '2024-07-13 17:23:05', '2024-07-13 17:23:05'),
(13, 'Pembelian', 20, 2, 20, '2024-07-13 17:23:05', '2024-07-13 17:23:05'),
(14, 'Pembelian', 21, 1, 2, '2024-07-14 07:07:42', '2024-07-14 07:07:42'),
(15, 'Pembelian', 23, 1, 4, '2024-07-14 11:07:32', '2024-07-14 11:07:32'),
(16, 'Pembelian', 29, 1, 10, '2024-07-15 16:41:31', '2024-07-15 16:41:31'),
(17, 'Pembelian', 29, 2, 50, '2024-07-15 16:41:31', '2024-07-15 16:41:31'),
(18, 'Pembelian', 34, 1, 10, '2024-07-16 08:15:27', '2024-07-16 08:15:27'),
(19, 'Pembelian', 34, 2, 10, '2024-07-16 08:15:27', '2024-07-16 08:15:27'),
(20, 'Pembelian', 34, 1, 10, '2024-07-16 08:15:28', '2024-07-16 08:15:28'),
(21, 'Pembelian', 34, 2, 10, '2024-07-16 08:15:28', '2024-07-16 08:15:28'),
(22, 'Pembelian', 36, 9, 7, '2024-07-16 18:51:07', '2024-07-16 18:51:07'),
(23, 'Pembelian', 36, 11, 4, '2024-07-16 18:51:07', '2024-07-16 18:51:07'),
(24, 'Pembelian', 36, 14, 3, '2024-07-16 18:51:07', '2024-07-16 18:51:07'),
(25, 'Pembelian', 36, 17, 5, '2024-07-16 18:51:07', '2024-07-16 18:51:07'),
(26, 'Pembelian', 43, 2, 5, '2024-07-18 06:00:37', '2024-07-18 06:00:37'),
(27, 'Pembelian', 43, 13, 6.5, '2024-07-18 06:00:37', '2024-07-18 06:00:37'),
(28, 'Pembelian', 43, 15, 4, '2024-07-18 06:00:37', '2024-07-18 06:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Ikan', '2024-07-12 09:43:55', '2024-07-12 09:43:55'),
(2, 'Kerang', '2024-07-13 07:25:21', '2024-07-13 07:25:21'),
(6, 'Cumi', '2024-07-15 16:39:13', '2024-07-15 16:39:13'),
(7, 'Udang', '2024-07-16 18:22:39', '2024-07-16 18:22:39'),
(8, 'Kepiting', '2024-07-16 18:22:45', '2024-07-16 18:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(10) UNSIGNED NOT NULL,
  `kode_member` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `kode_member`, `nama`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, '00001', 'Saung Ikan Bakar', 'Kp. Bugis', '085893756594', '2024-07-12 10:12:46', '2024-07-16 18:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_06_20_095635_tambah_kolom_baru_to_users_table', 1),
(7, '2024_06_20_100739_buat_kategoti_table', 1),
(8, '2024_06_20_101205_buat_produk_tabel', 1),
(9, '2024_06_20_102647_buat_member_table', 1),
(10, '2024_06_20_103007_buat_supplier_table', 1),
(11, '2024_06_20_103730_buat_pengeluaran_table', 1),
(12, '2024_06_20_103943_buat_pembelian_table', 1),
(13, '2024_06_20_104013_buat_pembelian_detail_table', 1),
(14, '2024_06_20_104032_buat_penjualan_table', 1),
(15, '2024_06_20_104049_buat_penjualan_detail_table', 1),
(16, '2024_06_20_104113_buat_setting_table', 1),
(17, '2024_06_21_073652_create_sessions_table', 1),
(18, '2024_06_22_193401_tambah_foreign_key_to_produk_table', 1),
(19, '2024_06_23_194804_tambah_kode_produk_to_produk_table', 1),
(20, '2024_07_08_073937_tambah_foreign_key_to_pembelian_table', 1),
(21, '2024_07_08_074319_tambah_foreign_key_to_pembelian_detail_table', 1),
(22, '2024_07_10_162106_inventory_table', 1),
(23, '2024_07_11_080002_tambah_diskon_to_setting_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `total_item` double NOT NULL,
  `total_harga` double NOT NULL,
  `diskon` tinyint(4) NOT NULL DEFAULT 0,
  `bayar` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_supplier`, `total_item`, `total_harga`, `diskon`, `bayar`, `created_at`, `updated_at`) VALUES
(20, 1, 40, 680000, 0, 680000, '2024-07-13 17:22:44', '2024-07-13 17:23:05'),
(21, 1, 2, 60000, 0, 60000, '2024-07-14 07:06:42', '2024-07-14 07:07:42'),
(23, 1, 4, 120000, 0, 120000, '2024-07-14 11:07:19', '2024-07-14 11:07:32'),
(29, 1, 60, 500000, 0, 500000, '2024-07-15 16:39:38', '2024-07-15 16:41:31'),
(34, 1, 20, 340000, 0, 340000, '2024-07-16 08:15:02', '2024-07-16 08:15:27'),
(36, 2, 19, 756000, 0, 756000, '2024-07-16 18:47:50', '2024-07-16 18:51:07'),
(43, 2, 15.5, 218000, 0, 218000, '2024-07-18 05:59:46', '2024-07-18 06:00:37'),
(47, 2, 0, 0, 0, 0, '2024-07-19 14:47:50', '2024-07-19 14:47:50'),
(48, 1, 0, 0, 0, 0, '2024-07-20 09:35:29', '2024-07-20 09:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_pembelian_detail` int(10) UNSIGNED NOT NULL,
  `id_pembelian` int(10) UNSIGNED NOT NULL,
  `id_produk` int(10) UNSIGNED NOT NULL,
  `harga_beli` double NOT NULL,
  `jumlah` double NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelian_detail`, `id_pembelian`, `id_produk`, `harga_beli`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(13, 20, 1, 30000, 20, 600000, '2024-07-13 17:22:50', '2024-07-13 17:22:57'),
(14, 20, 2, 4000, 20, 80000, '2024-07-13 17:22:53', '2024-07-13 17:23:01'),
(15, 21, 1, 30000, 2, 60000, '2024-07-14 07:06:55', '2024-07-14 07:07:07'),
(16, 23, 1, 30000, 4, 120000, '2024-07-14 11:07:25', '2024-07-14 11:07:29'),
(19, 29, 1, 30000, 10, 300000, '2024-07-15 16:39:51', '2024-07-15 16:41:06'),
(20, 29, 2, 4000, 50, 200000, '2024-07-15 16:41:12', '2024-07-15 16:41:23'),
(26, 34, 1, 30000, 10, 300000, '2024-07-16 08:15:09', '2024-07-16 08:15:22'),
(27, 34, 2, 4000, 10, 40000, '2024-07-16 08:15:11', '2024-07-16 08:15:25'),
(28, 36, 9, 30000, 7, 210000, '2024-07-16 18:48:13', '2024-07-16 18:48:38'),
(29, 36, 11, 45000, 4, 180000, '2024-07-16 18:48:21', '2024-07-16 18:49:11'),
(30, 36, 14, 47000, 3, 141000, '2024-07-16 18:48:33', '2024-07-16 18:49:14'),
(31, 36, 17, 45000, 5, 225000, '2024-07-16 18:49:01', '2024-07-16 18:51:02'),
(32, 43, 2, 4000, 5, 20000, '2024-07-18 05:59:54', '2024-07-18 06:00:13'),
(33, 43, 13, 20000, 6.5, 130000, '2024-07-18 06:00:02', '2024-07-18 06:00:27'),
(34, 43, 15, 17000, 4, 68000, '2024-07-18 06:00:10', '2024-07-18 06:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(10) UNSIGNED NOT NULL,
  `deskripsi` text NOT NULL,
  `nominal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `deskripsi`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 'Seblak', 30000, '2024-07-16 17:00:00', '2024-07-14 11:43:41'),
(2, 'Es batu', 100000, '2024-07-15 17:00:00', '2024-07-16 05:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(10) UNSIGNED NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `total_item` double NOT NULL,
  `total_harga` double NOT NULL,
  `diskon` tinyint(4) NOT NULL DEFAULT 0,
  `bayar` double NOT NULL DEFAULT 0,
  `diterima` double NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_member`, `total_item`, `total_harga`, `diskon`, `bayar`, `diterima`, `id_user`, `created_at`, `updated_at`) VALUES
(43, NULL, 15.5, 470000, 0, 470000, 480000, 1, '2024-07-13 17:23:58', '2024-07-13 17:24:55'),
(45, 1, 3, 30000, 5, 28500, 30000, 1, '2024-07-14 11:03:44', '2024-07-14 11:05:05'),
(51, NULL, 15, 600000, 0, 600000, 600000, 1, '2024-07-15 11:10:39', '2024-07-15 11:12:56'),
(59, NULL, 2, 20000, 0, 20000, 20000, 2, '2024-07-15 12:30:32', '2024-07-15 12:30:58'),
(84, NULL, 1, 40000, 0, 40000, 50000, 1, '2024-07-15 19:32:21', '2024-07-15 19:32:32'),
(89, NULL, 33, 420000, 0, 420000, 450000, 1, '2024-07-15 19:36:03', '2024-07-15 19:37:01'),
(95, NULL, 10, 100000, 0, 100000, 100000, 2, '2024-07-16 08:31:02', '2024-07-16 08:31:20'),
(105, 1, 8.5, 280000, 5, 266000, 270000, 2, '2024-07-16 18:52:14', '2024-07-16 18:54:17'),
(106, NULL, 7, 320000, 0, 320000, 350000, 2, '2024-07-16 18:54:32', '2024-07-16 18:55:06'),
(107, NULL, 0, 0, 0, 0, 0, 1, '2024-07-17 04:02:25', '2024-07-17 04:02:25'),
(109, 1, 18, 420000, 5, 399000, 400000, 2, '2024-07-17 04:03:29', '2024-07-17 04:04:48'),
(113, NULL, 1.5, 60000, 0, 60000, 100000, 1, '2024-07-17 06:29:16', '2024-07-17 06:29:59'),
(116, NULL, 2, 80000, 0, 80000, 100000, 1, '2024-07-17 17:17:44', '2024-07-17 17:18:39'),
(117, NULL, 12, 180000, 0, 180000, 200000, 1, '2024-07-18 06:15:49', '2024-07-18 07:17:22'),
(118, NULL, 0, 0, 0, 0, 0, 1, '2024-07-19 13:33:15', '2024-07-19 13:33:15'),
(121, NULL, 5, 110000, 0, 110000, 120000, 2, '2024-07-19 14:41:19', '2024-07-19 14:42:30'),
(122, NULL, 0, 0, 0, 0, 0, 1, '2024-07-20 10:05:55', '2024-07-20 10:05:55'),
(124, NULL, 3.5, 72500, 0, 72500, 100000, 1, '2024-07-21 17:18:41', '2024-07-21 17:19:26'),
(127, 1, 3, 115000, 10, 103500, 120000, 1, '2024-07-22 06:41:13', '2024-07-22 06:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_penjualan_detail` int(10) UNSIGNED NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` double NOT NULL,
  `diskon` tinyint(4) NOT NULL DEFAULT 0,
  `diterima` double NOT NULL DEFAULT 0,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_penjualan_detail`, `id_penjualan`, `id_produk`, `harga_jual`, `jumlah`, `diskon`, `diterima`, `subtotal`, `created_at`, `updated_at`) VALUES
(28, 43, 1, 40000, 10.5, 0, 0, 420000, '2024-07-13 17:24:06', '2024-07-13 17:24:13'),
(29, 43, 2, 10000, 5, 0, 0, 50000, '2024-07-13 17:24:10', '2024-07-13 17:24:30'),
(31, 45, 2, 10000, 3, 5, 0, 30000, '2024-07-14 11:04:05', '2024-07-14 11:05:05'),
(36, 51, 1, 40000, 15, 0, 0, 600000, '2024-07-15 11:10:46', '2024-07-15 11:10:48'),
(37, 59, 2, 10000, 2, 0, 0, 20000, '2024-07-15 12:30:39', '2024-07-15 12:30:42'),
(39, 67, 2, 10000, 1, 0, 0, 10000, '2024-07-15 19:09:20', '2024-07-15 19:09:20'),
(43, 82, 1, 40000, 1, 0, 0, 40000, '2024-07-15 19:31:17', '2024-07-15 19:31:17'),
(44, 83, 1, 40000, 1, 0, 0, 40000, '2024-07-15 19:32:00', '2024-07-15 19:32:00'),
(45, 84, 1, 40000, 1, 0, 0, 40000, '2024-07-15 19:32:26', '2024-07-15 19:32:26'),
(46, 89, 1, 40000, 3, 0, 0, 120000, '2024-07-15 19:36:10', '2024-07-15 19:36:51'),
(47, 89, 2, 10000, 30, 0, 0, 300000, '2024-07-15 19:36:14', '2024-07-15 19:36:46'),
(50, 95, 2, 10000, 10, 0, 0, 100000, '2024-07-16 08:31:08', '2024-07-16 08:31:11'),
(51, 105, 2, 10000, 3, 5, 0, 30000, '2024-07-16 18:52:23', '2024-07-16 18:54:17'),
(52, 105, 1, 40000, 2, 5, 0, 80000, '2024-07-16 18:52:26', '2024-07-16 18:54:17'),
(53, 105, 11, 60000, 1.5, 5, 0, 90000, '2024-07-16 18:53:14', '2024-07-16 18:54:17'),
(54, 105, 9, 40000, 2, 5, 0, 80000, '2024-07-16 18:53:28', '2024-07-16 18:54:17'),
(55, 106, 17, 60000, 2, 0, 0, 120000, '2024-07-16 18:54:43', '2024-07-16 18:54:45'),
(56, 106, 1, 40000, 5, 0, 0, 200000, '2024-07-16 18:54:52', '2024-07-16 18:54:54'),
(57, 109, 9, 40000, 3, 5, 0, 120000, '2024-07-17 04:03:56', '2024-07-17 04:04:48'),
(58, 109, 2, 10000, 10, 5, 0, 100000, '2024-07-17 04:04:19', '2024-07-17 04:04:48'),
(59, 109, 1, 40000, 5, 5, 0, 200000, '2024-07-17 04:04:31', '2024-07-17 04:04:48'),
(61, 113, 1, 40000, 1.5, 0, 0, 60000, '2024-07-17 06:29:47', '2024-07-17 06:29:51'),
(62, 116, 1, 40000, 2, 0, 0, 80000, '2024-07-17 17:18:02', '2024-07-17 17:18:09'),
(63, 117, 2, 10000, 10, 0, 0, 100000, '2024-07-18 07:16:55', '2024-07-18 07:17:00'),
(64, 117, 1, 40000, 2, 0, 0, 80000, '2024-07-18 07:17:11', '2024-07-18 07:17:14'),
(65, 121, 1, 40000, 2, 0, 0, 80000, '2024-07-19 14:41:42', '2024-07-19 14:41:58'),
(66, 121, 2, 10000, 3, 0, 0, 30000, '2024-07-19 14:41:47', '2024-07-19 14:42:06'),
(67, 124, 13, 35000, 1.5, 0, 0, 52500, '2024-07-21 17:18:53', '2024-07-21 17:18:57'),
(68, 124, 2, 10000, 2, 0, 0, 20000, '2024-07-21 17:19:05', '2024-07-21 17:19:09'),
(69, 127, 1, 40000, 2, 10, 0, 80000, '2024-07-22 06:41:24', '2024-07-22 06:42:27'),
(70, 127, 13, 35000, 1, 10, 0, 35000, '2024-07-22 06:41:34', '2024-07-22 06:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `kode_produk` varchar(191) NOT NULL,
  `nama_produk` varchar(191) NOT NULL,
  `jenis` varchar(191) DEFAULT NULL,
  `harga_beli` double NOT NULL,
  `diskon` tinyint(4) NOT NULL DEFAULT 0,
  `harga_jual` double NOT NULL,
  `stok` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `kode_produk`, `nama_produk`, `jenis`, `harga_beli`, `diskon`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
(1, 1, 'IKA0001', 'Bawal Merah', 'Sedang', 30000, 0, 40000, 5, '2024-07-12 09:46:58', '2024-07-22 06:42:27'),
(2, 2, 'KER0002', 'Kerang Ijo', 'Kecil', 4000, 0, 10000, 17, '2024-07-12 16:23:57', '2024-07-21 17:19:26'),
(4, 6, 'CUM0003', 'Cumi', 'Sedang', 40000, 0, 60000, 0, '2024-07-16 18:32:56', '2024-07-16 18:32:56'),
(9, 6, 'CUM0004', 'Cumi Kecil', 'Kecil', 30000, 0, 40000, 2, '2024-07-16 18:39:51', '2024-07-17 04:04:48'),
(10, 6, 'CUM0005', 'Cumi Besar', 'Besar', 55000, 0, 75000, 0, '2024-07-16 18:40:21', '2024-07-16 18:40:21'),
(11, 1, 'IKA0002', 'Kakap Merah', 'Sedang', 45000, 0, 60000, 2.5, '2024-07-16 18:40:59', '2024-07-16 18:54:17'),
(12, 8, 'KEP0001', 'Rajungan', 'Sedang', 50000, 0, 65000, 0, '2024-07-16 18:41:48', '2024-07-16 18:41:48'),
(13, 6, 'CUM0006', 'Gurita', 'Sedang', 20000, 0, 35000, 4, '2024-07-16 18:42:42', '2024-07-22 06:42:27'),
(14, 1, 'IKA0003', 'Kerapu', 'Sedang', 47000, 0, 55000, 3, '2024-07-16 18:43:37', '2024-07-16 18:51:07'),
(15, 1, 'IKA0004', 'Teri', 'Kecil', 17000, 0, 25000, 4, '2024-07-16 18:45:27', '2024-07-18 06:00:37'),
(16, 1, 'IKA0005', 'Pari Bintik', 'Sedang', 26000, 0, 35000, 0, '2024-07-16 18:45:52', '2024-07-16 18:45:52'),
(17, 1, 'IKA0006', 'Kakap Putih', 'Sedang', 45000, 0, 60000, 3, '2024-07-16 18:46:26', '2024-07-16 18:55:06'),
(18, 1, 'IKA0007', 'Tenggiri', 'Besar', 60000, 0, 80000, 0, '2024-07-16 18:47:10', '2024-07-16 18:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2ITQsHpj3FCDorO4KPLOQTRNg3e9XvXVrcOPCIMS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicEJRd0xIU1JMY3hZQUd6TFYxT3FmN1RaSHozQmpyT3p4SUdtMTJ1TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxMjoiaWRfcGVuanVhbGFuIjtpOjEyNzt9', 1721631063);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(191) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(191) NOT NULL,
  `tipe_nota` tinyint(4) DEFAULT NULL,
  `diskon` smallint(6) NOT NULL DEFAULT 0,
  `path_logo` varchar(191) NOT NULL,
  `path_kartu_member` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_perusahaan`, `alamat`, `telepon`, `tipe_nota`, `diskon`, `path_logo`, `path_kartu_member`, `created_at`, `updated_at`) VALUES
(1, 'Putri Seafood', 'Jalan Pelelangan Ikan Karangantu Pasar Hasil Tangkapan Laut', '085883381332', NULL, 5, '/img/logo-20240715165859.png', '', NULL, '2024-07-15 09:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Gono', 'Kp Baru Bugis, Jalan Pelelangan Ikan Karangantu', '08585331352', '2024-07-12 09:47:11', '2024-07-16 18:20:42'),
(2, 'Sarip', 'Lemah Abang', '087772557156', '2024-07-16 18:21:46', '2024-07-16 18:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `foto` varchar(191) DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `foto`, `level`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Fatikin', 'fatikin@gmail.com', NULL, '$2y$12$U/ftEnc0GeY0AjZg1dbZz.pN0SVpWdiUmosK/cYB/3.bZsRNA5FtC', '/img/logo-20240717102239.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-12 08:32:21', '2024-07-17 04:01:06'),
(2, 'Jaya', 'kasir1@gmail.com', NULL, '$2y$12$y9xaGekQEQYiNr1Ds/nLSuL9fufoJdFDX8bEgr0z/40SHILXzS2/i', '/img/logo-20240719214009.JPG', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-14 16:07:31', '2024-07-19 14:40:09'),
(4, 'Hendra', 'kasir2@gmail.com', NULL, '$2y$12$ALehfqWmbLzVPdVi2wAV1ePnPnhtSGbWc6ypq2CcGcuuKn6V7QXJC', '/lte/dist/img/user1-128x128.jpg', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-17 07:50:09', '2024-07-17 07:50:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kategori_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `member_kode_member_unique` (`kode_member`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `pembelian_id_supplier_foreign` (`id_supplier`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian_detail`),
  ADD KEY `pembelian_detail_id_pembelian_foreign` (`id_pembelian`),
  ADD KEY `pembelian_detail_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `produk_nama_produk_unique` (`nama_produk`),
  ADD UNIQUE KEY `produk_kode_produk_unique` (`kode_produk`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_pembelian_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_penjualan_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_id_pembelian_foreign` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `pembelian_detail_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
