-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.1.0.4886
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for sawerigading
CREATE DATABASE IF NOT EXISTS `sawerigading` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sawerigading`;


-- Dumping structure for table sawerigading.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `tanggal` date DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `id_fingerprint` int(11) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  UNIQUE KEY `tanggal_id_divisi_id_fingerprint` (`tanggal`,`id_divisi`,`id_fingerprint`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.absensi: ~315 rows (approximately)
DELETE FROM `absensi`;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` (`tanggal`, `id_karyawan`, `id_divisi`, `id_fingerprint`, `jam_masuk`) VALUES
	('2014-08-01', 1, 1, 11, '08:01:17'),
	('2014-08-02', 1, 1, 11, '08:00:34'),
	('2014-08-04', 1, 1, 11, '08:03:40'),
	('2014-08-05', 1, 1, 11, '08:02:26'),
	('2014-08-06', 1, 1, 11, '08:01:25'),
	('2014-08-07', 1, 1, 11, '07:58:52'),
	('2014-08-08', 1, 1, 11, '08:04:29'),
	('2014-08-09', 1, 1, 11, '08:03:11'),
	('2014-08-12', 1, 1, 11, '08:03:20'),
	('2014-08-13', 1, 1, 11, '07:58:54'),
	('2014-08-14', 1, 1, 11, '07:56:25'),
	('2014-08-15', 1, 1, 11, '08:04:13'),
	('2014-08-16', 1, 1, 11, '07:56:38'),
	('2014-08-17', 1, 1, 11, '08:01:24'),
	('2014-08-20', 1, 1, 11, '08:05:58'),
	('2014-08-21', 1, 1, 11, '08:00:10'),
	('2014-08-22', 1, 1, 11, '08:02:18'),
	('2014-08-23', 1, 1, 11, '08:05:47'),
	('2014-08-25', 1, 1, 11, '08:04:45'),
	('2014-08-26', 1, 1, 11, '08:03:27'),
	('2014-08-27', 1, 1, 11, '08:08:28'),
	('2014-08-28', 1, 1, 11, '08:06:51'),
	('2014-08-29', 1, 1, 11, '07:53:12'),
	('2014-08-30', 1, 1, 11, '08:04:47'),
	('2014-08-01', 2, 1, 12, '07:57:27'),
	('2014-08-02', 2, 1, 12, '07:57:16'),
	('2014-08-04', 2, 1, 12, '08:00:26'),
	('2014-08-05', 2, 1, 12, '08:47:28'),
	('2014-08-06', 2, 1, 12, '07:55:03'),
	('2014-08-07', 2, 1, 12, '08:04:20'),
	('2014-08-08', 2, 1, 12, '08:16:57'),
	('2014-08-09', 2, 1, 12, '08:04:04'),
	('2014-08-11', 2, 1, 12, '08:03:40'),
	('2014-08-12', 2, 1, 12, '08:04:30'),
	('2014-08-13', 2, 1, 12, '07:52:30'),
	('2014-08-14', 2, 1, 12, '07:57:44'),
	('2014-08-15', 2, 1, 12, '07:50:56'),
	('2014-08-16', 2, 1, 12, '08:07:25'),
	('2014-08-17', 2, 1, 12, '07:48:46'),
	('2014-08-20', 2, 1, 12, '08:01:47'),
	('2014-08-21', 2, 1, 12, '07:58:45'),
	('2014-08-22', 2, 1, 12, '08:01:56'),
	('2014-08-23', 2, 1, 12, '08:02:12'),
	('2014-08-25', 2, 1, 12, '08:00:26'),
	('2014-08-26', 2, 1, 12, '07:51:36'),
	('2014-08-27', 2, 1, 12, '07:59:51'),
	('2014-08-28', 2, 1, 12, '07:56:22'),
	('2014-08-29', 2, 1, 12, '07:39:00'),
	('2014-08-30', 2, 1, 12, '07:59:00'),
	('2014-08-01', 3, 1, 14, '07:56:08'),
	('2014-08-02', 3, 1, 14, '07:50:03'),
	('2014-08-04', 3, 1, 14, '07:52:23'),
	('2014-08-05', 3, 1, 14, '08:12:31'),
	('2014-08-06', 3, 1, 14, '07:50:05'),
	('2014-08-07', 3, 1, 14, '07:51:37'),
	('2014-08-08', 3, 1, 14, '07:52:21'),
	('2014-08-09', 3, 1, 14, '07:38:00'),
	('2014-08-11', 3, 1, 14, '07:57:51'),
	('2014-08-12', 3, 1, 14, '07:58:53'),
	('2014-08-13', 3, 1, 14, '07:55:37'),
	('2014-08-14', 3, 1, 14, '07:54:26'),
	('2014-08-15', 3, 1, 14, '07:50:37'),
	('2014-08-16', 3, 1, 14, '07:50:28'),
	('2014-08-18', 3, 1, 14, '08:02:29'),
	('2014-08-19', 3, 1, 14, '08:02:01'),
	('2014-08-20', 3, 1, 14, '07:50:36'),
	('2014-08-21', 3, 1, 14, '07:59:07'),
	('2014-08-22', 3, 1, 14, '07:18:11'),
	('2014-08-23', 3, 1, 14, '06:40:03'),
	('2014-08-25', 3, 1, 14, '08:00:33'),
	('2014-08-26', 3, 1, 14, '07:58:22'),
	('2014-08-27', 3, 1, 14, '07:42:18'),
	('2014-08-28', 3, 1, 14, '07:57:06'),
	('2014-08-29', 3, 1, 14, '07:53:15'),
	('2014-08-30', 3, 1, 14, '07:50:53'),
	('2014-08-01', 4, 1, 16, '07:58:29'),
	('2014-08-02', 4, 1, 16, '07:57:27'),
	('2014-08-04', 4, 1, 16, '07:55:13'),
	('2014-08-05', 4, 1, 16, '07:54:28'),
	('2014-08-06', 4, 1, 16, '07:57:04'),
	('2014-08-07', 4, 1, 16, '07:56:28'),
	('2014-08-08', 4, 1, 16, '08:01:25'),
	('2014-08-09', 4, 1, 16, '07:47:38'),
	('2014-08-11', 4, 1, 16, '07:57:45'),
	('2014-08-12', 4, 1, 16, '07:57:06'),
	('2014-08-13', 4, 1, 16, '07:55:00'),
	('2014-08-14', 4, 1, 16, '07:49:46'),
	('2014-08-15', 4, 1, 16, '07:55:16'),
	('2014-08-16', 4, 1, 16, '07:57:27'),
	('2014-08-17', 4, 1, 16, '07:43:40'),
	('2014-08-20', 4, 1, 16, '07:58:12'),
	('2014-08-21', 4, 1, 16, '07:58:51'),
	('2014-08-22', 4, 1, 16, '07:59:31'),
	('2014-08-23', 4, 1, 16, '07:47:23'),
	('2014-08-25', 4, 1, 16, '08:01:39'),
	('2014-08-26', 4, 1, 16, '08:00:39'),
	('2014-08-27', 4, 1, 16, '07:53:01'),
	('2014-08-28', 4, 1, 16, '08:05:36'),
	('2014-08-29', 4, 1, 16, '08:01:42'),
	('2014-08-30', 4, 1, 16, '08:02:12'),
	('2014-08-01', 5, 1, 18, '07:47:22'),
	('2014-08-02', 5, 1, 18, '07:39:02'),
	('2014-08-04', 5, 1, 18, '07:43:59'),
	('2014-08-05', 5, 1, 18, '07:48:19'),
	('2014-08-06', 5, 1, 18, '07:51:00'),
	('2014-08-07', 5, 1, 18, '07:44:31'),
	('2014-08-08', 5, 1, 18, '07:50:45'),
	('2014-08-09', 5, 1, 18, '07:39:58'),
	('2014-08-11', 5, 1, 18, '07:58:06'),
	('2014-08-12', 5, 1, 18, '07:38:55'),
	('2014-08-13', 5, 1, 18, '07:52:24'),
	('2014-08-14', 5, 1, 18, '07:43:47'),
	('2014-08-15', 5, 1, 18, '07:45:01'),
	('2014-08-16', 5, 1, 18, '07:47:56'),
	('2014-08-17', 5, 1, 18, '08:13:49'),
	('2014-08-20', 5, 1, 18, '07:08:18'),
	('2014-08-21', 5, 1, 18, '07:59:50'),
	('2014-08-22', 5, 1, 18, '07:43:57'),
	('2014-08-23', 5, 1, 18, '07:43:27'),
	('2014-08-25', 5, 1, 18, '08:01:34'),
	('2014-08-26', 5, 1, 18, '07:46:15'),
	('2014-08-27', 5, 1, 18, '07:42:26'),
	('2014-08-28', 5, 1, 18, '07:39:29'),
	('2014-08-29', 5, 1, 18, '07:37:41'),
	('2014-08-30', 5, 1, 18, '07:37:54'),
	('2014-08-02', 6, 1, 23, '07:58:57'),
	('2014-08-07', 6, 1, 23, '07:59:42'),
	('2014-08-08', 6, 1, 23, '08:00:50'),
	('2014-08-09', 6, 1, 23, '08:00:06'),
	('2014-08-10', 6, 1, 23, '09:51:04'),
	('2014-08-11', 6, 1, 23, '07:57:20'),
	('2014-08-12', 6, 1, 23, '07:29:45'),
	('2014-08-13', 6, 1, 23, '08:03:10'),
	('2014-08-14', 6, 1, 23, '08:01:27'),
	('2014-08-15', 6, 1, 23, '08:04:31'),
	('2014-08-16', 6, 1, 23, '08:02:20'),
	('2014-08-17', 6, 1, 23, '09:56:31'),
	('2014-08-18', 6, 1, 23, '08:02:23'),
	('2014-08-19', 6, 1, 23, '08:02:06'),
	('2014-08-20', 6, 1, 23, '08:02:48'),
	('2014-08-21', 6, 1, 23, '08:01:40'),
	('2014-08-22', 6, 1, 23, '08:01:47'),
	('2014-08-23', 6, 1, 23, '07:55:55'),
	('2014-08-24', 6, 1, 23, '09:53:53'),
	('2014-08-25', 6, 1, 23, '08:03:48'),
	('2014-08-26', 6, 1, 23, '08:02:01'),
	('2014-08-27', 6, 1, 23, '07:56:38'),
	('2014-08-28', 6, 1, 23, '08:03:21'),
	('2014-08-29', 6, 1, 23, '08:02:39'),
	('2014-08-30', 6, 1, 23, '08:02:14'),
	('2014-08-31', 6, 1, 23, '08:59:14'),
	('2014-08-01', 7, 1, 33, '08:04:08'),
	('2014-08-02', 7, 1, 33, '08:02:16'),
	('2014-08-04', 7, 1, 33, '08:01:46'),
	('2014-08-05', 7, 1, 33, '08:00:46'),
	('2014-08-06', 7, 1, 33, '08:03:06'),
	('2014-08-07', 7, 1, 33, '07:59:53'),
	('2014-08-08', 7, 1, 33, '07:58:29'),
	('2014-08-09', 7, 1, 33, '07:57:51'),
	('2014-08-11', 7, 1, 33, '08:01:26'),
	('2014-08-12', 7, 1, 33, '07:56:30'),
	('2014-08-13', 7, 1, 33, '08:00:11'),
	('2014-08-14', 7, 1, 33, '07:51:09'),
	('2014-08-15', 7, 1, 33, '07:49:24'),
	('2014-08-16', 7, 1, 33, '07:57:11'),
	('2014-08-20', 7, 1, 33, '07:59:33'),
	('2014-08-21', 7, 1, 33, '07:58:54'),
	('2014-08-22', 7, 1, 33, '07:49:45'),
	('2014-08-23', 7, 1, 33, '06:39:53'),
	('2014-08-25', 7, 1, 33, '08:01:25'),
	('2014-08-26', 7, 1, 33, '07:58:01'),
	('2014-08-27', 7, 1, 33, '07:44:55'),
	('2014-08-28', 7, 1, 33, '07:58:33'),
	('2014-08-29', 7, 1, 33, '08:02:46'),
	('2014-08-30', 7, 1, 33, '08:06:00'),
	('2014-08-01', 8, 1, 40, '08:05:44'),
	('2014-08-02', 8, 1, 40, '08:08:49'),
	('2014-08-04', 8, 1, 40, '08:03:25'),
	('2014-08-05', 8, 1, 40, '08:05:00'),
	('2014-08-06', 8, 1, 40, '08:05:29'),
	('2014-08-07', 8, 1, 40, '08:01:46'),
	('2014-08-08', 8, 1, 40, '08:05:24'),
	('2014-08-09', 8, 1, 40, '08:06:12'),
	('2014-08-11', 8, 1, 40, '08:05:10'),
	('2014-08-12', 8, 1, 40, '08:00:33'),
	('2014-08-13', 8, 1, 40, '08:04:47'),
	('2014-08-14', 8, 1, 40, '07:56:21'),
	('2014-08-15', 8, 1, 40, '08:04:59'),
	('2014-08-16', 8, 1, 40, '08:01:37'),
	('2014-08-17', 8, 1, 40, '08:04:57'),
	('2014-08-20', 8, 1, 40, '08:06:49'),
	('2014-08-21', 8, 1, 40, '07:58:41'),
	('2014-08-22', 8, 1, 40, '08:03:48'),
	('2014-08-23', 8, 1, 40, '08:00:29'),
	('2014-08-25', 8, 1, 40, '08:03:43'),
	('2014-08-26', 8, 1, 40, '08:00:49'),
	('2014-08-27', 8, 1, 40, '08:04:27'),
	('2014-08-28', 8, 1, 40, '07:59:39'),
	('2014-08-29', 8, 1, 40, '08:01:14'),
	('2014-08-30', 8, 1, 40, '08:01:27'),
	('2014-08-11', 9, 1, 52, '21:32:56'),
	('2014-08-01', 10, 1, 55, '08:02:16'),
	('2014-08-02', 10, 1, 55, '08:04:24'),
	('2014-08-04', 10, 1, 55, '08:05:29'),
	('2014-08-05', 10, 1, 55, '08:04:18'),
	('2014-08-06', 10, 1, 55, '08:25:21'),
	('2014-08-08', 10, 1, 55, '08:04:18'),
	('2014-08-09', 10, 1, 55, '08:04:38'),
	('2014-08-11', 10, 1, 55, '08:09:17'),
	('2014-08-12', 10, 1, 55, '08:03:04'),
	('2014-08-13', 10, 1, 55, '08:02:05'),
	('2014-08-14', 10, 1, 55, '08:04:42'),
	('2014-08-15', 10, 1, 55, '08:05:18'),
	('2014-08-16', 10, 1, 55, '08:00:39'),
	('2014-08-17', 10, 1, 55, '07:48:19'),
	('2014-08-20', 10, 1, 55, '08:00:37'),
	('2014-08-21', 10, 1, 55, '08:00:35'),
	('2014-08-22', 10, 1, 55, '08:02:59'),
	('2014-08-23', 10, 1, 55, '08:04:13'),
	('2014-08-25', 10, 1, 55, '08:01:50'),
	('2014-08-26', 10, 1, 55, '08:02:43'),
	('2014-08-27', 10, 1, 55, '08:00:32'),
	('2014-08-28', 10, 1, 55, '08:02:42'),
	('2014-08-29', 10, 1, 55, '08:02:44'),
	('2014-08-30', 10, 1, 55, '08:02:46'),
	('2014-08-01', 11, 1, 57, '08:04:30'),
	('2014-08-02', 11, 1, 57, '08:07:10'),
	('2014-08-04', 11, 1, 57, '09:49:10'),
	('2014-08-05', 11, 1, 57, '09:23:14'),
	('2014-08-06', 11, 1, 57, '08:05:13'),
	('2014-08-08', 11, 1, 57, '08:02:45'),
	('2014-08-09', 11, 1, 57, '08:07:47'),
	('2014-08-11', 11, 1, 57, '08:13:15'),
	('2014-08-12', 11, 1, 57, '07:00:28'),
	('2014-08-13', 11, 1, 57, '07:36:18'),
	('2014-08-14', 11, 1, 57, '07:30:21'),
	('2014-08-15', 11, 1, 57, '08:16:04'),
	('2014-08-16', 11, 1, 57, '07:48:08'),
	('2014-08-20', 11, 1, 57, '03:49:08'),
	('2014-08-21', 11, 1, 57, '08:11:38'),
	('2014-08-22', 11, 1, 57, '07:18:37'),
	('2014-08-23', 11, 1, 57, '08:05:10'),
	('2014-08-25', 11, 1, 57, '08:01:05'),
	('2014-08-27', 11, 1, 57, '09:22:35'),
	('2014-08-28', 11, 1, 57, '06:35:33'),
	('2014-08-29', 11, 1, 57, '08:09:07'),
	('2014-08-30', 11, 1, 57, '07:36:55'),
	('2014-08-01', 12, 1, 61, '07:33:45'),
	('2014-08-02', 12, 1, 61, '07:56:24'),
	('2014-08-03', 12, 1, 61, '09:59:16'),
	('2014-08-04', 12, 1, 61, '07:43:40'),
	('2014-08-05', 12, 1, 61, '07:48:10'),
	('2014-08-06', 12, 1, 61, '07:50:19'),
	('2014-08-07', 12, 1, 61, '07:58:00'),
	('2014-08-08', 12, 1, 61, '07:56:50'),
	('2014-08-09', 12, 1, 61, '07:30:19'),
	('2014-08-11', 12, 1, 61, '07:57:23'),
	('2014-08-24', 12, 1, 61, '09:56:48'),
	('2014-08-25', 12, 1, 61, '08:00:59'),
	('2014-08-26', 12, 1, 61, '08:05:17'),
	('2014-08-27', 12, 1, 61, '07:51:47'),
	('2014-08-28', 12, 1, 61, '07:44:26'),
	('2014-08-29', 12, 1, 61, '07:43:24'),
	('2014-08-30', 12, 1, 61, '07:44:30'),
	('2014-08-07', 13, 1, 62, '16:34:38'),
	('2014-08-01', 14, 1, 63, '08:06:39'),
	('2014-08-02', 14, 1, 63, '07:53:08'),
	('2014-08-04', 14, 1, 63, '08:00:57'),
	('2014-08-05', 14, 1, 63, '07:58:45'),
	('2014-08-06', 14, 1, 63, '08:00:02'),
	('2014-08-07', 14, 1, 63, '08:00:02'),
	('2014-08-11', 14, 1, 63, '08:02:16'),
	('2014-08-12', 14, 1, 63, '08:00:20'),
	('2014-08-13', 14, 1, 63, '08:01:19'),
	('2014-08-14', 14, 1, 63, '07:59:57'),
	('2014-08-15', 14, 1, 63, '07:58:48'),
	('2014-08-16', 14, 1, 63, '08:00:36'),
	('2014-08-18', 14, 1, 63, '08:03:37'),
	('2014-08-19', 14, 1, 63, '08:01:55'),
	('2014-08-20', 14, 1, 63, '08:01:57'),
	('2014-08-21', 14, 1, 63, '08:06:21'),
	('2014-08-22', 14, 1, 63, '08:01:03'),
	('2014-08-23', 14, 1, 63, '07:26:49'),
	('2014-08-25', 14, 1, 63, '08:03:29'),
	('2014-08-26', 14, 1, 63, '07:46:22'),
	('2014-08-27', 14, 1, 63, '08:08:36'),
	('2014-08-28', 14, 1, 63, '07:56:57'),
	('2014-08-29', 14, 1, 63, '08:01:10'),
	('2014-08-30', 14, 1, 63, '07:57:08'),
	('2014-08-29', 15, 1, 8, '06:54:37'),
	('2014-08-01', 16, 1, 9, '08:01:44'),
	('2014-08-02', 16, 1, 9, '08:04:08'),
	('2014-08-04', 16, 1, 9, '07:54:07'),
	('2014-08-05', 16, 1, 9, '07:57:23'),
	('2014-08-06', 16, 1, 9, '07:57:25'),
	('2014-08-07', 16, 1, 9, '07:47:57'),
	('2014-08-08', 16, 1, 9, '07:46:13'),
	('2014-08-09', 16, 1, 9, '07:41:11'),
	('2014-08-11', 16, 1, 9, '07:59:52'),
	('2014-08-12', 16, 1, 9, '07:46:55'),
	('2014-08-13', 16, 1, 9, '07:59:48'),
	('2014-08-14', 16, 1, 9, '07:53:27'),
	('2014-08-15', 16, 1, 9, '07:58:52'),
	('2014-08-16', 16, 1, 9, '07:58:24'),
	('2014-08-17', 16, 1, 9, '07:55:06'),
	('2014-08-20', 16, 1, 9, '07:58:57'),
	('2014-08-21', 16, 1, 9, '08:02:26'),
	('2014-08-22', 16, 1, 9, '07:37:31'),
	('2014-08-23', 16, 1, 9, '07:59:13'),
	('2014-08-25', 16, 1, 9, '08:00:54'),
	('2014-08-26', 16, 1, 9, '07:57:09'),
	('2014-08-27', 16, 1, 9, '07:58:08'),
	('2014-08-28', 16, 1, 9, '07:53:07'),
	('2014-08-29', 16, 1, 9, '07:55:48'),
	('2014-08-30', 16, 1, 9, '07:55:24');
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;


-- Dumping structure for table sawerigading.absensi_ijin
CREATE TABLE IF NOT EXISTS `absensi_ijin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `status` enum('sakit','ijin-lain') DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='berisi ijin dari karyawan untuk tidak masuk kerja';

-- Dumping data for table sawerigading.absensi_ijin: ~0 rows (approximately)
DELETE FROM `absensi_ijin`;
/*!40000 ALTER TABLE `absensi_ijin` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi_ijin` ENABLE KEYS */;


-- Dumping structure for table sawerigading.calendar
CREATE TABLE IF NOT EXISTS `calendar` (
  `tanggal` date NOT NULL,
  `jenis` enum('kerja','libur','libur-besar','besar') DEFAULT NULL,
  `nama_hari` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.calendar: ~61 rows (approximately)
DELETE FROM `calendar`;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` (`tanggal`, `jenis`, `nama_hari`) VALUES
	('2014-08-01', 'kerja', 'Friday'),
	('2014-08-02', 'kerja', 'Saturday'),
	('2014-08-03', 'libur', 'Sunday'),
	('2014-08-04', 'kerja', 'Monday'),
	('2014-08-05', 'kerja', 'Tuesday'),
	('2014-08-06', 'kerja', 'Wednesday'),
	('2014-08-07', 'kerja', 'Thursday'),
	('2014-08-08', 'kerja', 'Friday'),
	('2014-08-09', 'kerja', 'Saturday'),
	('2014-08-10', 'libur', 'Sunday'),
	('2014-08-11', 'kerja', 'Monday'),
	('2014-08-12', 'kerja', 'Tuesday'),
	('2014-08-13', 'kerja', 'Wednesday'),
	('2014-08-14', 'kerja', 'Thursday'),
	('2014-08-15', 'kerja', 'Friday'),
	('2014-08-16', 'kerja', 'Saturday'),
	('2014-08-17', 'libur', 'Sunday'),
	('2014-08-18', 'kerja', 'Monday'),
	('2014-08-19', 'kerja', 'Tuesday'),
	('2014-08-20', 'kerja', 'Wednesday'),
	('2014-08-21', 'kerja', 'Thursday'),
	('2014-08-22', 'kerja', 'Friday'),
	('2014-08-23', 'kerja', 'Saturday'),
	('2014-08-24', 'libur', 'Sunday'),
	('2014-08-25', 'kerja', 'Monday'),
	('2014-08-26', 'kerja', 'Tuesday'),
	('2014-08-27', 'kerja', 'Wednesday'),
	('2014-08-28', 'kerja', 'Thursday'),
	('2014-08-29', 'kerja', 'Friday'),
	('2014-08-30', 'kerja', 'Saturday'),
	('2014-08-31', 'libur', 'Sunday'),
	('2014-11-01', 'kerja', 'Saturday'),
	('2014-11-02', 'libur', 'Sunday'),
	('2014-11-03', 'kerja', 'Monday'),
	('2014-11-04', 'kerja', 'Tuesday'),
	('2014-11-05', 'kerja', 'Wednesday'),
	('2014-11-06', 'kerja', 'Thursday'),
	('2014-11-07', 'kerja', 'Friday'),
	('2014-11-08', 'kerja', 'Saturday'),
	('2014-11-09', 'libur', 'Sunday'),
	('2014-11-10', 'kerja', 'Monday'),
	('2014-11-11', 'kerja', 'Tuesday'),
	('2014-11-12', 'kerja', 'Wednesday'),
	('2014-11-13', 'kerja', 'Thursday'),
	('2014-11-14', 'kerja', 'Friday'),
	('2014-11-15', 'kerja', 'Saturday'),
	('2014-11-16', 'libur', 'Sunday'),
	('2014-11-17', 'kerja', 'Monday'),
	('2014-11-18', 'kerja', 'Tuesday'),
	('2014-11-19', 'kerja', 'Wednesday'),
	('2014-11-20', 'kerja', 'Thursday'),
	('2014-11-21', 'kerja', 'Friday'),
	('2014-11-22', 'kerja', 'Saturday'),
	('2014-11-23', 'libur', 'Sunday'),
	('2014-11-24', 'kerja', 'Monday'),
	('2014-11-25', 'kerja', 'Tuesday'),
	('2014-11-26', 'kerja', 'Wednesday'),
	('2014-11-27', 'kerja', 'Thursday'),
	('2014-11-28', 'kerja', 'Friday'),
	('2014-11-29', 'kerja', 'Saturday'),
	('2014-11-30', 'libur', 'Sunday');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;


-- Dumping structure for table sawerigading.calendar_exception
CREATE TABLE IF NOT EXISTS `calendar_exception` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` enum('kerja','libur-besar','besar') DEFAULT 'kerja',
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='kerja = masuk\r\nlibur = tidak_masuk\r\nbesar = masuk';

-- Dumping data for table sawerigading.calendar_exception: ~0 rows (approximately)
DELETE FROM `calendar_exception`;
/*!40000 ALTER TABLE `calendar_exception` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendar_exception` ENABLE KEYS */;


-- Dumping structure for table sawerigading.divisi
CREATE TABLE IF NOT EXISTS `divisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.divisi: ~11 rows (approximately)
DELETE FROM `divisi`;
/*!40000 ALTER TABLE `divisi` DISABLE KEYS */;
INSERT INTO `divisi` (`id`, `nama`, `sort`, `deleted`) VALUES
	(1, 'XL Banyuwangi', 1, 'N'),
	(2, 'XL Jember', 1, 'N'),
	(3, 'XL Situbondo', 1, 'N'),
	(4, 'XL Bondowoso', 1, 'N'),
	(5, 'OUTLET', 1, 'N'),
	(6, 'OFFICE', 1, 'N'),
	(7, 'L2 RELOAD', 1, 'N'),
	(8, 'RSO', 1, 'N'),
	(9, 'RGS', 1, 'N'),
	(10, 'MANAGEMENT', 1, 'N'),
	(11, 'XL Server', 0, 'N');
/*!40000 ALTER TABLE `divisi` ENABLE KEYS */;


-- Dumping structure for procedure sawerigading.fill_calendar
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_calendar`(IN `start_date` DATE)
BEGIN
  DECLARE crt_date DATE;  
  DECLARE end_date DATE;
  DECLARE hari_kerja VARCHAR(50);
  DECLARE jenis_hari VARCHAR(50);
  DECLARE jam_hr_kerja TIME;
  DECLARE jam_hr_besar TIME;
  
  SELECT value INTO hari_kerja FROM settings WHERE name='hari_kerja';
  
  SET crt_date=start_date;
  SET end_date = LAST_DAY(start_date);
  
  WHILE crt_date <= end_date DO
    /*DELETE FROM calendar WHERE tanggal = crt_date;*/
    IF((SELECT tanggal FROM calendar_exception WHERE tanggal = crt_date) IS NOT NULL) THEN
    	
		SELECT jenis INTO jenis_hari FROM calendar_exception WHERE tanggal = crt_date;
    	
		IF(jenis_hari = 'kerja') THEN
		
  	    	INSERT INTO calendar(tanggal,jenis,nama_hari) 
			VALUES(crt_date,'kerja',DAYNAME(crt_date))
			ON DUPLICATE KEY UPDATE jenis='kerja';
			
    	ELSEIF(jenis_hari = 'libur-besar') THEN
    	
  	    	INSERT INTO calendar(tanggal,jenis,nama_hari) 
			VALUES(crt_date,'libur-besar',DAYNAME(crt_date))						
			ON DUPLICATE KEY UPDATE jenis='libur-besar';
  	    	
    	ELSEIF(jenis_hari = 'besar') THEN
    	
  	    	INSERT INTO calendar(tanggal,jenis,nama_hari) 
			VALUES(crt_date,'besar',DAYNAME(crt_date))
			ON DUPLICATE KEY UPDATE jenis='besar';
			
    	END IF;

    ELSE
    
    	IF(hari_kerja LIKE CONCAT('%',DAYNAME(crt_date),'%')) THEN
    	
	    	INSERT INTO calendar(tanggal,jenis,nama_hari) 
			VALUES(crt_date,'kerja',DAYNAME(crt_date))
			ON DUPLICATE KEY UPDATE jenis='kerja';
	    	
	   ELSE
		 	
			INSERT INTO calendar(tanggal,jenis,nama_hari) 
			VALUES(crt_date,'libur',DAYNAME(crt_date))
			ON DUPLICATE KEY UPDATE jenis='libur';
			 
		END IF; 	
		
	 END IF; 
    
    SET crt_date = ADDDATE(crt_date, INTERVAL 1 DAY);
  END WHILE;
END//
DELIMITER ;


-- Dumping structure for table sawerigading.gaji
CREATE TABLE IF NOT EXISTS `gaji` (
  `id` varchar(50) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `sewa_motor` double NOT NULL,
  `bensin` double NOT NULL,
  `service` double NOT NULL,
  `voucher` double NOT NULL,
  `kpi` float NOT NULL DEFAULT '100',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `jml_hr_kerja` tinyint(4) NOT NULL,
  `jml_hr_absen` tinyint(4) NOT NULL,
  `jml_telat_hr_biasa` tinyint(4) NOT NULL,
  `jml_telat_hr_besar` tinyint(4) NOT NULL,
  `denda_telat_hr_biasa` double NOT NULL,
  `denda_telat_hr_besar` double NOT NULL,
  `potongan_barang` double NOT NULL DEFAULT '0',
  `potongan_hutang` double NOT NULL DEFAULT '0',
  `id_hutang_bayar` int(11) DEFAULT NULL,
  `potongan_lain` double NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bulan_tahun_id_karyawan` (`bulan`,`tahun`,`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='id_hutang_bayar di isi jika update gaji mencantumkan potongan_hutang > 0\r\n++if gaji.id_hutang_bayar == NULL\r\n++++ then update_gaji -> insert_hutang_bayar -> get_id_hutang_bayar -> update gaji.id_hutang_bayar\r\n++++ else update_gaji-> update_hutang_bayar(id_hutang_bayar)\r\n++endif';

-- Dumping data for table sawerigading.gaji: ~16 rows (approximately)
DELETE FROM `gaji`;
/*!40000 ALTER TABLE `gaji` DISABLE KEYS */;
INSERT INTO `gaji` (`id`, `bulan`, `tahun`, `id_karyawan`, `jabatan`, `id_divisi`, `divisi`, `gaji_pokok`, `sewa_motor`, `bensin`, `service`, `voucher`, `kpi`, `bonus`, `jml_hr_kerja`, `jml_hr_absen`, `jml_telat_hr_biasa`, `jml_telat_hr_besar`, `denda_telat_hr_biasa`, `denda_telat_hr_besar`, `potongan_barang`, `potongan_hutang`, `id_hutang_bayar`, `potongan_lain`, `created_at`) VALUES
	('2014-1-9', 1, 2014, 9, '\'Manager\'', 1, '\'XL Banyuwangi\'', 1500000, 500000, 0, 0, 0, 100, 0, 31, 0, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-1', 8, 2014, 1, '\'Fronliner\'', 1, '\'XL Banyuwangi\'', 1240000, 0, 0, 0, 0, 50, 0, 29, 5, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-10', 8, 2014, 10, '\'Canvasser\'', 1, '\'XL Banyuwangi\'', 1240000, 350000, 150000, 100000, 100000, 100, 0, 26, 5, 2, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-11', 8, 2014, 11, '\'Supervisor\'', 1, '\'XL Banyuwangi\'', 2170000, 350000, 0, 100000, 0, 100, 0, 27, 4, 9, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-12', 8, 2014, 12, '\'Fronliner\'', 1, '\'XL Banyuwangi\'', 1240000, 0, 0, 0, 0, 100, 0, 19, 12, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-13', 8, 2014, 13, '\'Supervisor\'', 1, '\'XL Banyuwangi\'', 2170000, 350000, 0, 100000, 0, 100, 0, 6, 25, 1, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-15', 8, 2014, 15, '\'Marchandiser\'', 1, '\'XL Banyuwangi\'', 1240000, 350000, 0, 100000, 100000, 150, 200000, 3, 28, 0, 0, 30000, 50000, 50000, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-16', 8, 2014, 16, '\'Fronliner\'', 1, '\'XL Banyuwangi\'', 1240000, 0, 0, 0, 0, 100, 0, 27, 4, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-2', 8, 2014, 2, '\'Fronliner\'', 1, '\'XL Banyuwangi\'', 1240000, 0, 0, 0, 0, 100, 0, 27, 4, 3, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-3', 8, 2014, 3, '\'Marchandiser\'', 1, '\'XL Banyuwangi\'', 1240000, 350000, 0, 100000, 100000, 100, 0, 28, 3, 1, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-4', 8, 2014, 4, '\'Canvasser\'', 1, '\'XL Banyuwangi\'', 1240000, 350000, 150000, 100000, 100000, 100, 0, 27, 4, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-5', 8, 2014, 5, '\'Task Force\'', 1, '\'XL Banyuwangi\'', 1240000, 0, 0, 0, 50000, 100, 0, 27, 4, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-6', 8, 2014, 6, '\'Supervisor\'', 1, '\'XL Banyuwangi\'', 2170000, 350000, 0, 100000, 0, 100, 0, 27, 4, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-7', 8, 2014, 7, '\'Manager\'', 1, '\'XL Banyuwangi\'', 1500000, 500000, 0, 0, 0, 100, 0, 31, 0, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-8', 8, 2014, 8, '\'RY\'', 1, '\'XL Banyuwangi\'', 1240000, 350000, 0, 100000, 100000, 100, 0, 27, 4, 3, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40'),
	('2014-8-9', 8, 2014, 9, '\'Manager\'', 1, '\'XL Banyuwangi\'', 1500000, 500000, 0, 0, 0, 100, 0, 31, 0, 0, 0, 30000, 50000, 0, 0, NULL, 0, '2014-11-26 09:23:40');
/*!40000 ALTER TABLE `gaji` ENABLE KEYS */;


-- Dumping structure for procedure sawerigading.gen_gaji
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `gen_gaji`(IN `id_karyawan` INT, IN `tahun` INT, IN `bulan` INT, IN `in_jabatan` VARCHAR(50), IN `in_id_divisi` INT, IN `in_divisi` VARCHAR(50), IN `in_gaji_pokok` DOUBLE, IN `in_sewa_motor` DOUBLE, IN `in_bensin` DOUBLE, IN `in_service` DOUBLE, IN `in_voucher` DOUBLE)
BEGIN
	
	DECLARE ganti_absen VARCHAR(5);
	/*********************/
	
	DECLARE int_karyawan INT;
	DECLARE int_tahun INT;
	DECLARE int_bulan INT;
	DECLARE vc_jabatan VARCHAR(50);
	DECLARE int_id_divisi INT;
	DECLARE vc_divisi VARCHAR(50);
	DECLARE dbl_gaji_pokok DOUBLE;
	DECLARE dbl_bensin DOUBLE;
	DECLARE dbl_sewa_motor DOUBLE;
	DECLARE dbl_service DOUBLE;
	DECLARE dbl_voucher DOUBLE;
	
	/*********************/
	
	DECLARE denda_telat_biasa DOUBLE;
	DECLARE denda_telat_besar DOUBLE;
	DECLARE jam_masuk_biasa TIME;
	DECLARE jam_masuk_besar TIME;	
	/*********************/
	
	DECLARE v_status_absen VARCHAR(50);
	DECLARE v_jumlah INT;	
	/*********************/
	
	DECLARE v_jml_status_kerja_ok INT;
	DECLARE v_jml_status_kerja_telat INT;
	
	DECLARE v_jml_status_absen INT;/*tidak masuk*/
	DECLARE v_jml_status_sakit INT;
	DECLARE v_jml_status_ijin_lain INT;
	
	/*DECLARE v_jml_status_kerja_hari_libur_ok INT;
	DECLARE v_jml_status_kerja_hari_libur_telat INT;*/
	
	DECLARE v_jml_status_besar_ok INT;
	DECLARE v_jml_status_besar_telat INT;
	
	DECLARE v_jml_status_libur INT;
	DECLARE v_jml_status_libur_besar INT;
	
	DECLARE done INT;	
	/**********************/
	
	DECLARE int_jml_hr_kerja INT;
	DECLARE int_jml_hr_absen INT;
	DECLARE int_jml_telat_kerja INT;
	DECLARE int_jml_telat_besar INT;
	/*********************/
	
	DECLARE str_jabatan_no_cekclock VARCHAR(100);
	DECLARE str_jabatan_normal_absensi VARCHAR(100);	
	/*********************/
	
	DECLARE jumlah_hari INT;
	
	DECLARE cur1 CURSOR FOR 
			SELECT IF(c.id IS NOT NULL,
				 		c.status,
				 		IF(b.id_karyawan IS NULL,
				 				IF(a.jenis = 'libur-besar','libur-besar',IF(a.jenis = 'libur','libur','absen')), 
								IF(a.jenis = 'kerja',
									 			IF(b.jam_masuk > jam_masuk_biasa,'kerja-telat','kerja-ok'),
 											   IF(b.jam_masuk > jam_masuk_besar,'besar-telat','besar-ok')
									)
							)
					) as status_absensi,
					COUNT(a.tanggal) as jumlah
			FROM calendar a
			LEFT JOIN absensi b ON a.tanggal = b.tanggal AND b.id_karyawan = int_karyawan
			LEFT JOIN absensi_ijin c ON a.tanggal = c.tanggal AND c.id_karyawan = int_karyawan
			WHERE YEAR(a.tanggal) = int_tahun AND MONTH(a.tanggal) = int_bulan 
			GROUP BY status_absensi ;
			
	DECLARE CONTINUE HANDLER FOR NOT found SET done=1;	
	
	SELECT value INTO ganti_absen FROM settings WHERE name='kerja_hari_libur_ganti_absen';
	SELECT value INTO denda_telat_biasa FROM settings WHERE name='denda_telat_biasa';
	SELECT value INTO denda_telat_besar FROM settings WHERE name='denda_telat_besar';
	
	SELECT value INTO jam_masuk_biasa FROM settings WHERE name='jam_masuk_biasa';
	SELECT value INTO jam_masuk_besar FROM settings WHERE name='jam_masuk_besar';
	SELECT value INTO str_jabatan_no_cekclock FROM settings WHERE name='no_checkclock';
	SELECT value INTO str_jabatan_normal_absensi FROM settings WHERE name='jabatan_normal_absensi';
	
	SET int_karyawan = id_karyawan;
	SET int_tahun = tahun;
	SET int_bulan = bulan;
	SET vc_jabatan = in_jabatan;
	SET int_id_divisi = in_id_divisi;
	SET vc_divisi = in_divisi;
	SET dbl_gaji_pokok =  in_gaji_pokok;
	SET dbl_sewa_motor = in_sewa_motor;
	SET dbl_bensin = in_bensin;
	SET dbl_service = in_service;
	SET dbl_voucher = in_voucher;
	
	/*
	
	DECLARE dbl_gaji_pokok DOUBLE;
	DECLARE dbl_sewa_motor DOUBLE;
	DECLARE dbl_service DOUBLE;
	DECLARE dbl_voucher DOUBLE;
	
	*/
	
	SET done = 0;
  	SET v_jml_status_kerja_ok  = 0;
	SET v_jml_status_kerja_telat  = 0;
	
	SET v_jml_status_absen  = 0;
	
   SET v_jml_status_sakit  = 0;
   SET v_jml_status_ijin_lain  = 0;
   
	/*
	SET v_jml_status_kerja_hari_libur_ok  = 0;
	SET v_jml_status_kerja_hari_libur_telat  = 0;
	*/
	
	SET v_jml_status_besar_ok = 0 ;
	SET v_jml_status_besar_telat = 0 ;
	
	SET v_jml_status_libur = 0;
	SET v_jml_status_libur_besar = 0;
	
	SET jumlah_hari = DAY(LAST_DAY(CONCAT(int_tahun,'-',int_bulan,'-01')));

	OPEN cur1;   
	mainloop:LOOP    
   	FETCH cur1 INTO v_status_absen,v_jumlah;
   	IF done = 1 THEN LEAVE mainloop; END IF;   	
   	
   	IF (v_status_absen = 'kerja-ok') THEN
   	
   	  SET v_jml_status_kerja_ok = v_jumlah;
   	  
  	   ELSEIF (v_status_absen = 'kerja-telat') THEN
   	
   	  SET v_jml_status_kerja_telat = v_jumlah;
   	  
   	ELSEIF (v_status_absen = 'sakit')  THEN
   	
   	  SET v_jml_status_sakit = v_jumlah;
   	  
   	ELSEIF (v_status_absen = 'ijin-lain')  THEN
   	
   	  SET v_jml_status_ijin_lain = v_jumlah;  
   	  
   	ELSEIF (v_status_absen = 'absen')  THEN
   	
   	  SET v_jml_status_absen = v_jumlah;
   	/*  
	   ELSEIF (v_status_absen = 'kerja-hari-libur-ok')  THEN
	   
   	  SET v_jml_status_kerja_hari_libur_ok = v_jumlah;
   	  
	   ELSEIF (v_status_absen = 'kerja-hari-libur-telat')  THEN
	   
   	  SET v_jml_status_kerja_hari_libur_telat = v_jumlah;
   	*/  
		ELSEIF (v_status_absen = 'besar-ok')  THEN
		
   	  SET v_jml_status_besar_ok = v_jumlah;
   	  
		ELSEIF (v_status_absen = 'besar-telat')  THEN
		
   	  SET v_jml_status_besar_telat = v_jumlah;
   	  
		ELSEIF (v_status_absen = 'libur')  THEN
		
   	  SET v_jml_status_libur = v_jumlah;  
   	  
   	ELSEIF (v_status_absen = 'libur-besar')  THEN
		
   	  SET v_jml_status_libur_besar = v_jumlah;  
   	END IF;
   	
	END LOOP mainloop;
	CLOSE cur1;
	
	IF(str_jabatan_no_cekclock LIKE CONCAT('%',vc_jabatan,'%')) THEN
		
		SET int_jml_hr_kerja = jumlah_hari;
		SET int_jml_hr_absen = 0;
		SET int_jml_telat_kerja = 0;
		SET int_jml_telat_besar = 0;
		
		/*
			SET vc_jabatan = in_jabatan;
			SET vc_divisi = in_divisi;
			SET dbl_gaji_pokok =  in_gaji_pokok;
			SET dbl_sewa_motor = in_sewa_motor;
			SET dbl_service = in_service;
			SET dbl_voucher = in_voucher;

		*/
		INSERT INTO gaji(id,tahun,bulan,id_karyawan,
							  jabatan,id_divisi,divisi,gaji_pokok,sewa_motor,bensin,service,voucher,	
							  jml_hr_kerja,jml_hr_absen,
							  denda_telat_hr_biasa,denda_telat_hr_besar,
							  jml_telat_hr_biasa,jml_telat_hr_besar) 						  						  
		VALUES(CONCAT(int_tahun,'-',int_bulan,'-',int_karyawan),int_tahun,int_bulan,int_karyawan,
		       REPLACE(vc_jabatan,"'",""),int_id_divisi,REPLACE(vc_divisi,"'",""),dbl_gaji_pokok,dbl_sewa_motor,dbl_bensin,dbl_service,dbl_voucher,		        
				 int_jml_hr_kerja,int_jml_hr_absen,
				 denda_telat_biasa,denda_telat_besar,
				 int_jml_telat_kerja,int_jml_telat_besar)				 
	   ON DUPLICATE KEY UPDATE jabatan = vc_jabatan,
	   								id_divisi = int_id_divisi,
										divisi = vc_divisi,
										gaji_pokok = dbl_gaji_pokok,
										sewa_motor = dbl_sewa_motor,
										bensin = dbl_bensin,
										service = dbl_service,
										voucher = dbl_voucher,	   								
										jml_hr_kerja = int_jml_hr_kerja,
	   								jml_hr_absen = int_jml_hr_absen,
	   								denda_telat_hr_biasa = denda_telat_biasa,
	   								denda_telat_hr_besar = denda_telat_besar,
	   								jml_telat_hr_biasa = int_jml_telat_kerja,
	   								jml_telat_hr_besar = int_jml_telat_besar,
										created_at=NOW();
		
	ELSEIF (str_jabatan_normal_absensi LIKE CONCAT('%',vc_jabatan,'%')) THEN
	   
		SET int_jml_hr_kerja = v_jml_status_kerja_ok + v_jml_status_kerja_telat +
								  	  v_jml_status_sakit + 	
                            /*  v_jml_status_ijin_lain + */		 						 	  
								     v_jml_status_libur + v_jml_status_libur_besar +
							        v_jml_status_besar_ok + v_jml_status_besar_telat;
							     
		SET int_jml_hr_absen = v_jml_status_absen;
	
		SET int_jml_telat_kerja = v_jml_status_kerja_telat;
		SET int_jml_telat_besar = v_jml_status_besar_telat;
		
		INSERT INTO gaji(id,tahun,bulan,id_karyawan, 
							  jabatan,id_divisi,divisi,gaji_pokok,sewa_motor,bensin,service,voucher,	 						  
							  jml_hr_kerja,jml_hr_absen,
							  denda_telat_hr_biasa,denda_telat_hr_besar,
							  jml_telat_hr_biasa,jml_telat_hr_besar) 						  						  
		VALUES(CONCAT(int_tahun,'-',int_bulan,'-',int_karyawan),int_tahun,int_bulan,int_karyawan,
				 REPLACE(vc_jabatan,"'",""),int_id_divisi,REPLACE(vc_divisi,"'",""),dbl_gaji_pokok,dbl_sewa_motor,dbl_bensin,dbl_service,dbl_voucher,		       
				 int_jml_hr_kerja,int_jml_hr_absen,
				 denda_telat_biasa,denda_telat_besar,
				 int_jml_telat_kerja,int_jml_telat_besar)				 
	   ON DUPLICATE KEY UPDATE jabatan = vc_jabatan,
	   								id_divisi = int_id_divisi,	
										divisi = vc_divisi,
										gaji_pokok = dbl_gaji_pokok,
										sewa_motor = dbl_sewa_motor,
										bensin = dbl_bensin,
										service = dbl_service,
										voucher = dbl_voucher,	 
										jml_hr_kerja = int_jml_hr_kerja,
	   								jml_hr_absen = int_jml_hr_absen,	   								
	   								denda_telat_hr_biasa = denda_telat_biasa,
	   								denda_telat_hr_besar = denda_telat_besar,
	   								jml_telat_hr_biasa = int_jml_telat_kerja,
	   								jml_telat_hr_besar = int_jml_telat_besar,
										created_at=NOW();
	ELSE
	/*lainnya*/	
	
		SET int_jml_hr_kerja = v_jml_status_kerja_ok + v_jml_status_kerja_telat + 		                        
		                       v_jml_status_libur_besar + v_jml_status_sakit + 
 						           v_jml_status_besar_ok + v_jml_status_besar_telat;
 		
 		IF(int_jml_hr_kerja < jumlah_hari) THEN
 			SET int_jml_hr_kerja = (v_jml_status_kerja_ok + v_jml_status_kerja_telat + 		                        
		                       v_jml_status_libur_besar + v_jml_status_sakit + 
 						           v_jml_status_besar_ok + v_jml_status_besar_telat) + 2;		 
 		END IF;
 		
 		SET int_jml_hr_absen = jumlah_hari - (int_jml_hr_kerja); 
      	
		SET int_jml_telat_kerja = v_jml_status_kerja_telat;
		SET int_jml_telat_besar = v_jml_status_besar_telat;		
		
		INSERT INTO gaji(
		              id, 
						  tahun,
						  bulan,
						  id_karyawan,  
						  jabatan,
						  id_divisi,
						  divisi,
						  gaji_pokok,
						  sewa_motor,
						  bensin,
						  service,
						  voucher,							  						  	
						  jml_hr_kerja,
						  jml_hr_absen,
						  denda_telat_hr_biasa,
						  denda_telat_hr_besar,
						  jml_telat_hr_biasa,
						  jml_telat_hr_besar) 						  						  
		VALUES(
		      CONCAT(int_tahun,'-',int_bulan,'-',int_karyawan),
				int_tahun,
				int_bulan,
				int_karyawan,
				REPLACE(vc_jabatan,"'",""),
				int_id_divisi,
				REPLACE(vc_divisi,"'",""),
				dbl_gaji_pokok,
				dbl_sewa_motor,
				dbl_bensin,
				dbl_service,
				dbl_voucher,		       		      
				int_jml_hr_kerja,
				int_jml_hr_absen,
				denda_telat_biasa,
				denda_telat_besar,
				int_jml_telat_kerja,
				int_jml_telat_besar)				 
	   ON DUPLICATE KEY UPDATE jabatan = vc_jabatan,
	   								id_divisi = int_id_divisi,
										divisi = vc_divisi,
										gaji_pokok = dbl_gaji_pokok,
										sewa_motor = dbl_sewa_motor,
										bensin = dbl_bensin,
										service = dbl_service,
										voucher = dbl_voucher,	
										jml_hr_kerja = int_jml_hr_kerja,
	   								jml_hr_absen = int_jml_hr_absen,	   								
	   								denda_telat_hr_biasa = denda_telat_biasa,
	   								denda_telat_hr_besar = denda_telat_besar,
	   								jml_telat_hr_biasa = int_jml_telat_kerja,
	   								jml_telat_hr_besar = int_jml_telat_besar,
										created_at=NOW();						
										
	END IF;
	
END//
DELIMITER ;


-- Dumping structure for table sawerigading.hutang
CREATE TABLE IF NOT EXISTS `hutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `besar` double NOT NULL DEFAULT '0',
  `status` enum('aktif','lunas') NOT NULL DEFAULT 'aktif',
  `tgl_lunas` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='data hutang karyawan\r\nmax_';

-- Dumping data for table sawerigading.hutang: ~0 rows (approximately)
DELETE FROM `hutang`;
/*!40000 ALTER TABLE `hutang` DISABLE KEYS */;
INSERT INTO `hutang` (`id`, `id_karyawan`, `tanggal`, `besar`, `status`, `tgl_lunas`) VALUES
	(3, 15, '2014-07-24', 100000, 'lunas', '2014-11-25');
/*!40000 ALTER TABLE `hutang` ENABLE KEYS */;


-- Dumping structure for table sawerigading.hutang_bayar
CREATE TABLE IF NOT EXISTS `hutang_bayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hutang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` enum('manual','potong-gaji') DEFAULT 'manual',
  `besar` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='data bayar hutang karyawan';

-- Dumping data for table sawerigading.hutang_bayar: ~0 rows (approximately)
DELETE FROM `hutang_bayar`;
/*!40000 ALTER TABLE `hutang_bayar` DISABLE KEYS */;
INSERT INTO `hutang_bayar` (`id`, `id_hutang`, `tanggal`, `jenis`, `besar`) VALUES
	(15, 3, '2014-11-24', 'potong-gaji', 100000);
/*!40000 ALTER TABLE `hutang_bayar` ENABLE KEYS */;


-- Dumping structure for table sawerigading.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_divisi` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `sewa_motor` double DEFAULT '0',
  `bensin` double DEFAULT '0',
  `service` double DEFAULT '0',
  `voucher` double DEFAULT '0',
  `deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.jabatan: ~8 rows (approximately)
DELETE FROM `jabatan`;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id`, `id_divisi`, `nama`, `gaji_pokok`, `sewa_motor`, `bensin`, `service`, `voucher`, `deleted`) VALUES
	(1, 1, 'Manager', 1500000, 500000, 0, 0, 0, 'N'),
	(2, 11, 'General Manager', 7440000, 0, 0, 0, 0, 'N'),
	(3, 1, 'Supervisor', 2170000, 350000, 0, 100000, 0, 'N'),
	(4, 1, 'Canvasser', 1240000, 350000, 150000, 100000, 100000, 'N'),
	(5, 1, 'Marchandiser', 1240000, 350000, 0, 100000, 100000, 'N'),
	(6, 1, 'Fronliner', 1240000, 0, 0, 0, 0, 'N'),
	(7, 1, 'Task Force', 1240000, 0, 0, 0, 50000, 'N'),
	(8, 1, 'RY', 1240000, 350000, 0, 100000, 100000, 'N');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;


-- Dumping structure for table sawerigading.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) NOT NULL DEFAULT '0',
  `id_fingerprint` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tgl_masuk_kerja` date NOT NULL DEFAULT '0000-00-00',
  `status` enum('aktif','resign') NOT NULL DEFAULT 'aktif',
  `tgl_resign` date NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `img_badan` varchar(50) NOT NULL DEFAULT 'default_avatar.jpg',
  `img_ktp` varchar(50) NOT NULL DEFAULT 'default_avatar.jpg',
  `bank_rekening` varchar(100) NOT NULL,
  `deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.karyawan: ~17 rows (approximately)
DELETE FROM `karyawan`;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `id_jabatan`, `id_fingerprint`, `nik`, `nama_lengkap`, `tgl_masuk_kerja`, `status`, `tgl_resign`, `no_telp`, `alamat`, `img_badan`, `img_ktp`, `bank_rekening`, `deleted`) VALUES
	(1, 6, 11, '1234567890', 'ANSORI', '2014-11-09', 'aktif', '0000-00-00', '666-777', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(2, 6, 12, '', 'EKO', '2014-11-09', 'aktif', '0000-00-00', '1234567890', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(3, 5, 14, '', 'SUNARDI', '2014-11-09', 'aktif', '0000-00-00', '1234567890', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(4, 4, 16, '', 'IWAN CVS', '2014-11-09', 'aktif', '0000-00-00', '1234567890', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(5, 7, 18, '', 'RAMLI', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(6, 3, 23, '', 'NANIK', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(7, 1, 33, '', 'ARUL', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(8, 8, 40, '', 'FERI', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(9, 1, 52, '', 'ANTON SP', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(10, 4, 55, '', 'KAFFI', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(11, 3, 57, '', 'IWAN SPV', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(12, 6, 61, '', 'TIKA', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(13, 3, 62, '', 'APRILIA', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(14, 4, 63, '1234567890', 'ABI', '2004-12-12', 'resign', '2014-12-12', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(15, 5, 8, '666', 'ADIT', '2014-11-09', 'aktif', '0000-00-00', '-', '', '134cc79396ce6b5c7e4434b31bf968b9.jpg', 'a2b941d532de6d5ae4fa3516c66f43da.jpeg', '', 'N'),
	(16, 6, 9, '', 'SAMSUL', '2014-11-09', 'aktif', '0000-00-00', '-', '', 'default_avatar.jpg', 'default_avatar.jpg', '', 'N'),
	(17, 2, 666, '666', 'Devil its self', '2014-11-10', 'aktif', '0000-00-00', '-', '', '5a08452d99e4c0220787e5f8cc6f0c16.jpeg', 'dcb690e277fcc39ef8f05c3741f6d673.jpg', '', 'N');
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;


-- Dumping structure for table sawerigading.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `web_title` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `href` varchar(50) DEFAULT NULL,
  `has_sub` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.menu: ~15 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `id_parent`, `web_title`, `title`, `icon`, `href`, `has_sub`) VALUES
	(2, 0, 'Master Data', 'Master Data', 'fa fa-database', '#', 'Y'),
	(3, 2, 'Master Data | Divisi', 'Divisi', '-', 'data/divisi', 'N'),
	(4, 2, 'Master Data | Jabatan', 'Jabatan', '-', 'data/jabatan/default', 'N'),
	(5, 2, 'Master Data | Web User', 'Web User', '-', 'data/user', 'N'),
	(6, 2, 'Master Data | Karyawan', 'Karyawan', '-', 'data/karyawan/default', 'N'),
	(7, 0, 'Hutang Karyawan', 'Hutang Karyawan', 'fa fa-tags', 'hutang/index/default', 'N'),
	(8, 0, 'Absensi & Tanggal', 'Absensi & Tanggal', 'fa fa-check', '#', 'Y'),
	(9, 8, 'Absensi | Tanggal Istimewa', 'Tanggal Istimewa', '-', 'absensi/day_off/default', 'N'),
	(10, 8, 'Absensi | Ijin Karyawan', 'Ijin Karyawan', '-', 'absensi/ijin_karyawan/default', 'N'),
	(11, 8, 'Absensi | Upload', 'Upload File Absensi', '-', 'absensi', 'N'),
	(12, 0, 'Penggajian Karyawan', 'Penggajian', 'fa fa-money', 'penggajian/index/default', 'N'),
	(13, 0, 'Laporan', 'Laporan', 'fa fa-file-text-o', '#', 'Y'),
	(14, 13, 'Laporan Denda', 'Laporan Denda', '-', 'laporan/denda/default', 'N'),
	(15, 13, 'Laporan KPI', 'Laporan KPI', '-', 'laporan/kpi/default', 'N'),
	(16, 0, 'Settings', 'Settings', 'fa fa-gears', 'settings', 'N');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for procedure sawerigading.procedure_gaji
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_gaji`(IN `id_divisi` INT, IN `tahun` INT, IN `bulan` INT)
BEGIN	
	DECLARE int_id_divisi INT;
	DECLARE int_tahun INT;
	DECLARE int_bulan INT; 

	/*------------------*/
	DECLARE done INT;
	DECLARE v_id INT;
	DECLARE v_jabatan VARCHAR(50);
	DECLARE var_divisi INT;
	DECLARE v_divisi VARCHAR(50);
	DECLARE dbl_gaji_pokok DOUBLE;
	DECLARE dbl_sewa_motor DOUBLE;
	DECLARE dbl_bensin DOUBLE;
	DECLARE dbl_service DOUBLE;
	DECLARE dbl_voucher DOUBLE;		
	
	DECLARE cur1 CURSOR FOR 
        SELECT a.id, 
		         b.nama as nama_jabatan,
		         c.id as id_divisi,
		         c.nama as nama_divisi,
		         b.gaji_pokok as gaji_pokok,
		         b.sewa_motor as sewa_motor,
		         b.bensin as bensin,
		         b.service as service,
		         b.voucher as voucher
		  FROM karyawan a       
		  LEFT JOIN jabatan b ON a.id_jabatan = b.id
		  LEFT JOIN divisi c ON b.id_divisi = c.id
		  WHERE c.id = int_id_divisi AND a.`status` = 'aktif';
   
	DECLARE CONTINUE HANDLER FOR NOT found SET done=1;	

	SET int_id_divisi = id_divisi;
	SET int_tahun = tahun;
	SET int_bulan = bulan;
	
	SET done = 0;
   
	OPEN cur1;   
	mainloop:LOOP    
   	FETCH cur1 INTO v_id,v_jabatan,var_divisi,v_divisi,dbl_gaji_pokok,dbl_sewa_motor,dbl_bensin,dbl_service,dbl_voucher;
   	IF done = 1 THEN LEAVE mainloop; END IF;
   	CALL gen_gaji(v_id,int_tahun,int_bulan,QUOTE(v_jabatan),var_divisi,QUOTE(v_divisi),dbl_gaji_pokok,dbl_sewa_motor,dbl_bensin,dbl_service,dbl_voucher);
	END LOOP mainloop;
	CLOSE cur1;
	
END//
DELIMITER ;


-- Dumping structure for table sawerigading.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.settings: ~7 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `name`, `title`, `value`) VALUES
	(1, 'jam_masuk_biasa', 'Jam Masuk Hari Biasa ', '08:05:59'),
	(2, 'jam_masuk_besar', 'Jam Masuk Hari Besar ', '12:00:59'),
	(3, 'denda_telat_biasa', 'Denda Telat Hari Biasa', '30000'),
	(4, 'denda_telat_besar', 'Denda Telat Hari Besar', '50000'),
	(5, 'hari_kerja', 'Hari Kerja', 'Monday-Tuesday-Wednesday-Thursday-Friday-Saturday'),
	(6, 'divisi_management', 'Divisi Management', 'MANAGEMENT'),
	(7, 'no_checkclock', 'Jabatan Tanpa Jadwal Absensi', '\'Manager\'-\'General Manager\''),
	(8, 'jabatan_normal_absensi', 'Jabatan Dengan Jadwal Absensi Normal', '\'Sales\'-\'Supervisor\'');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table sawerigading.template_level
CREATE TABLE IF NOT EXISTS `template_level` (
  `nama` varchar(50) DEFAULT NULL,
  `granted_menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.template_level: ~2 rows (approximately)
DELETE FROM `template_level`;
/*!40000 ALTER TABLE `template_level` DISABLE KEYS */;
INSERT INTO `template_level` (`nama`, `granted_menu`) VALUES
	('manager', '2,4,6,7,8,9,10,11,12,13,14,15'),
	('accounting', '7,12,13,14,15'),
	('management', '2,3,4,5,6,7,8,9,10,11,12,13,14,15,16');
/*!40000 ALTER TABLE `template_level` ENABLE KEYS */;


-- Dumping structure for table sawerigading.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(50) NOT NULL,
  `level` enum('full access','manager','accounting','custom') NOT NULL DEFAULT 'custom',
  `id_divisi` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `img_badan` varchar(50) DEFAULT 'default_avatar.jpg',
  `granted_menu` varchar(50) DEFAULT NULL,
  `deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sawerigading.user: ~4 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `nik`, `nama_lengkap`, `username`, `userpass`, `level`, `id_divisi`, `email`, `img_badan`, `granted_menu`, `deleted`) VALUES
	(1, '005', 'Manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager', 1, 'manager@gmail.com', '1615eb7536c35d631a0f067f182ebeb1.jpeg', '2,4,6,7,8,9,10,11,12,13,14,15', 'N'),
	(2, '006', 'Accounting', 'accounting', 'd4c143f004d88b7286e6f999dea9d0d7', 'accounting', 1, 'accounting@gmail.com', '', '7,12,13,14,15', 'N'),
	(3, '007', 'Management', 'management', 'd10af457daa1deed54e2c36b5f295e7e', 'full access', 10, 'management@gmail.com', '7c242b6ca0d359f2bb4cbc50733a00ef.jpg', '2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 'N'),
	(4, '12233445566', 'management tambahan', 'management_tambahan', 'b688f4240ee7581666bb989304ca828b', 'full access', 10, 'management_tambahan@gmail.com', 'default_avatar.jpg', '2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 'N');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for trigger sawerigading.gaji_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `gaji_after_update` BEFORE UPDATE ON `gaji` FOR EACH ROW BEGIN
	DECLARE int_id_hutang INT;
	DECLARE int_last_id_hutang_bayar INT;
	DECLARE sisa_hutang DOUBLE;
	/*
		cek apakah id_hutang_bayar is null
		jika Y
		jika N
	*/	
	IF(OLD.id_hutang_bayar IS NULL) THEN
		
		SELECT IFNULL(a.besar - IFNULL(SUM(b.besar),0),0) as sisa_hutang INTO sisa_hutang
		FROM hutang a
		LEFT JOIN hutang_bayar b ON a.id = id_hutang
		WHERE a.status = 'aktif' AND a.id_karyawan = OLD.id_karyawan
		GROUP BY a.id;	
		
		IF(NEW.potongan_hutang > 0) THEN
		
			SELECT id INTO int_id_hutang FROM hutang
			WHERE status='aktif' AND id_karyawan = OLD.id_karyawan;
			
			INSERT INTO hutang_bayar(id_hutang,tanggal,jenis,besar) 
			VALUES(int_id_hutang,CURDATE(),'potong-gaji',NEW.potongan_hutang);
			
			SELECT MAX(id) INTO int_last_id_hutang_bayar FROM hutang_bayar
			WHERE id_hutang = int_id_hutang;
			
			SET NEW.id_hutang_bayar = int_last_id_hutang_bayar;
			
			IF(NEW.potongan_hutang >= sisa_hutang) THEN
				UPDATE hutang SET status='lunas' WHERE id = int_id_hutang;
			END IF;	
				
		END IF;
		
	ELSE
		
		SELECT id_hutang INTO int_id_hutang FROM hutang_bayar
		WHERE id = OLD.id_hutang_bayar;
		
		SELECT IFNULL(a.besar - IFNULL(SUM(b.besar),0),0) as sisa_hutang INTO sisa_hutang
		FROM hutang a
		LEFT JOIN hutang_bayar b ON a.id = id_hutang
		WHERE a.id = int_id_hutang
		GROUP BY a.id;		
			
		UPDATE hutang_bayar
		SET besar =  NEW.potongan_hutang
		WHERE id = OLD.id_hutang_bayar;		

		IF(NEW.potongan_hutang >= sisa_hutang) THEN
			UPDATE hutang SET status='lunas' ,tgl_lunas = CURDATE() 
			WHERE id = int_id_hutang;
		ELSE
			UPDATE hutang SET status='aktif' ,tgl_lunas = '0000-00-00' 
			WHERE id = int_id_hutang;
		END IF;	
		
		
	END IF;	
	


END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
