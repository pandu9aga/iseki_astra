-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 11:00 AM
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
-- Database: `iseki_astra`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `Id_Area` int(11) NOT NULL,
  `Name_Area` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`Id_Area`, `Name_Area`) VALUES
(1, 'Engine'),
(2, 'Main Line Start'),
(3, 'Main Line End'),
(4, 'Mower Collector');

-- --------------------------------------------------------

--
-- Table structure for table `area_photos`
--

CREATE TABLE `area_photos` (
  `Id_Area_Photo` int(11) NOT NULL,
  `Id_Area` int(11) NOT NULL,
  `Id_Photo_Angle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `area_photos`
--

INSERT INTO `area_photos` (`Id_Area_Photo`, `Id_Area`, `Id_Photo_Angle`) VALUES
(35, 1, 1),
(36, 1, 2),
(37, 1, 3),
(38, 1, 4),
(39, 1, 5),
(40, 1, 6),
(41, 1, 7),
(42, 1, 8),
(43, 2, 1),
(44, 2, 2),
(45, 2, 3),
(46, 2, 4),
(47, 2, 5),
(48, 2, 6),
(49, 2, 7),
(50, 2, 8),
(51, 2, 9),
(52, 2, 10),
(53, 2, 11),
(54, 2, 12),
(55, 2, 13),
(56, 2, 14),
(57, 2, 15),
(58, 3, 1),
(59, 3, 2),
(60, 3, 3),
(61, 3, 4),
(62, 3, 5),
(63, 3, 6),
(64, 3, 7),
(65, 3, 8),
(66, 3, 9),
(67, 3, 10),
(68, 4, 1),
(69, 4, 2),
(70, 4, 3),
(71, 4, 4),
(72, 4, 5),
(73, 4, 6),
(74, 4, 7),
(75, 4, 8),
(76, 4, 9),
(77, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_angles`
--

CREATE TABLE `photo_angles` (
  `Id_Photo_Angle` int(11) NOT NULL,
  `Name_Photo_Angle` varchar(100) NOT NULL,
  `Icon_Photo_Angle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `photo_angles`
--

INSERT INTO `photo_angles` (`Id_Photo_Angle`, `Name_Photo_Angle`, `Icon_Photo_Angle`) VALUES
(1, 'Kanan Depan', 'north_east'),
(2, 'Kanan Belakang', 'south_east'),
(3, 'Belakang', 'south'),
(4, 'Kiri Belakang', 'south_west'),
(5, 'Kiri Depan', 'north_west'),
(6, 'Depan', 'north'),
(7, 'Sudut Bebas 1', 'zoom_out_map'),
(8, 'Sudut Bebas 2', 'zoom_out_map'),
(9, 'Sudut Bebas 3', 'zoom_out_map'),
(10, 'Sudut Bebas 4', 'zoom_out_map'),
(11, 'Sudut Bebas 5', 'zoom_out_map'),
(12, 'Sudut Bebas 6', 'zoom_out_map'),
(13, 'Sudut Bebas 7', 'zoom_out_map'),
(14, 'Sudut Bebas 8', 'zoom_out_map'),
(15, 'Sudut Bebas 9', 'zoom_out_map');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
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
('FKhjjvolW1kA0M97TdAJmJG7jbZPJLg0k1aqQazQ', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidTBGN1U0aEtMdUdhOFFkcTBlRXlncnFZNmZzWE1icnlFaFJ3NWRFViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvaXNla2lfYXN0cmEvcHVibGljL2NoZWNrbGlzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoiSWRfVXNlciI7aToxO3M6MTI6IklkX1R5cGVfVXNlciI7aToyO3M6MTM6IlVzZXJuYW1lX1VzZXIiO3M6NToiYWRtaW4iO30=', 1751271067),
('RmmQlgSvh7yI4WozjYvt3CJ1tuoqzwWMzncYAGEW', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZkFmRldPTWZRRzdjYmlZWER1cGo5Vk5XN0ticjVWNlgwUW9yTHFQeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvaXNla2lfYXN0cmEvcHVibGljL3RyYWNrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJJZF9Vc2VyIjtpOjY7czoxMjoiSWRfVHlwZV9Vc2VyIjtpOjE7czoxMzoiVXNlcm5hbWVfVXNlciI7czoxNToibW93ZXIgY29sbGVjdG9yIjt9', 1751271085);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `Id_Track` int(11) NOT NULL,
  `Id_User` int(11) NOT NULL,
  `Id_Type` varchar(100) NOT NULL,
  `Id_Area` int(11) NOT NULL,
  `Time_Track` timestamp NULL DEFAULT NULL,
  `Status_Track` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`Id_Track`, `Id_User`, `Id_Type`, `Id_Area`, `Time_Track`, `Status_Track`) VALUES
(67, 2, '3963;20250630;SXG327S5H2S;100020', 1, '2025-06-30 05:55:05', 1),
(68, 2, '3956;20250630;MF2E50HVRE3;S-2702', 1, '2025-06-30 05:56:45', 1),
(69, 2, '3962;20250630;NT548FSE1;103232', 1, '2025-06-30 05:57:42', 1),
(70, 4, '3963;20250630;SXG327S5H2S;100020', 2, '2025-06-30 05:59:25', 1),
(71, 4, '3956;20250630;MF2E50HVRE3;S-2702', 2, '2025-06-30 06:01:12', 1),
(72, 4, '3962;20250630;NT548FSE1;103232', 2, '2025-06-30 06:02:37', 1),
(73, 5, '3963;20250630;SXG327S5H2S;100020', 3, '2025-06-30 06:04:11', 1),
(74, 5, '3956;20250630;MF2E50HVRE3;S-2702', 3, '2025-06-30 06:05:55', 1),
(75, 5, '3962;20250630;NT548FSE1;103232', 3, '2025-06-30 06:06:56', 1),
(77, 6, '3963;20250630;SXG327S5H2S;100020', 4, '2025-06-30 07:17:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `track_photos`
--

CREATE TABLE `track_photos` (
  `Id_Track_Photo` int(11) NOT NULL,
  `Id_Track` int(11) NOT NULL,
  `Name_Photo_Angle` varchar(100) NOT NULL,
  `Icon_Photo_Angle` varchar(100) NOT NULL,
  `Path_Track_Photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `track_photos`
--

INSERT INTO `track_photos` (`Id_Track_Photo`, `Id_Track`, `Name_Photo_Angle`, `Icon_Photo_Angle`, `Path_Track_Photo`) VALUES
(298, 67, 'Kanan Depan', 'north_east', 'uploads/track/jsYto2IIabcr0HAFgn6VimnyO9Ac5RGY6p7asg3e.jpg'),
(299, 67, 'Kanan Belakang', 'south_east', 'uploads/track/vXPXCcBN6nMwXDQ4lzkq7XaPmBKtewm9SxIKjAIK.jpg'),
(300, 67, 'Belakang', 'south', 'uploads/track/5aFcMByQTooLSWeDjTkmAHgHK8QACbGcslpLwWj7.jpg'),
(301, 67, 'Kiri Belakang', 'south_west', 'uploads/track/Og25hRJVvu9Um9jVMmqF2rOItoQEy9QklvW9Axt7.jpg'),
(302, 67, 'Kiri Depan', 'north_west', 'uploads/track/jhPUDbsbAGXexAvTTyUrnkrvGOsgzQhW5RcHwTNh.jpg'),
(303, 67, 'Depan', 'north', 'uploads/track/HohbmE6JB84WB6qLqD0Yjyw06oWBUsjpjEVgbGdg.jpg'),
(304, 67, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/ibsjkeuKlFY2vTaBLFWjLFTS4tezSZHfcbGEUiAa.jpg'),
(305, 67, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/XtKiNovAjYdIZjlr4mpWySRFI3PygxhrzuozItyw.jpg'),
(306, 68, 'Kanan Depan', 'north_east', 'uploads/track/Jsxz3zBzIiRicD0cB6yIRJhX4LtajgSgUoWbyDHt.jpg'),
(307, 68, 'Kanan Belakang', 'south_east', 'uploads/track/ddV74YcCz1TQc1UnRTKduCD1umjkecMhps0YNgQq.jpg'),
(308, 68, 'Belakang', 'south', 'uploads/track/ry1i7zYfkNFCqQuoGrgqCJwgYjNd2zHEGEfGQWIw.jpg'),
(309, 68, 'Kiri Belakang', 'south_west', 'uploads/track/y7uZ57mHEoqVc9fJIBaVtZTrd1b244lrH7xrtWbo.jpg'),
(310, 68, 'Kiri Depan', 'north_west', 'uploads/track/6LTPu2upwlFsoMljDCmFw6w0lswBcKq7DYqn0Pbg.jpg'),
(311, 68, 'Depan', 'north', 'uploads/track/Kms3jp0KTQgExxz3D3ASRJkfnDBHVmXTvh18WPb0.jpg'),
(312, 68, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/Gamhq1FHlwvjDFSE8UH7EtcMuwV21IUQJUmrL8d0.jpg'),
(313, 68, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/HWBwrFQjPK2AIUt0illqf0rfFHUvNJDiFF7tNbce.jpg'),
(314, 69, 'Kanan Depan', 'north_east', 'uploads/track/83kLNMiv0iEF5ZkzhQVLQpOomCxwqRnUfd8rFEet.jpg'),
(315, 69, 'Kanan Belakang', 'south_east', 'uploads/track/C8mB7YoCOAHyrsdhuUSR7BKe6b5lkeeHLOfwkVSW.jpg'),
(316, 69, 'Belakang', 'south', 'uploads/track/M5slMJPLTPaSARC4d8MGubtOmy4cu0XDfrofveH0.jpg'),
(317, 69, 'Kiri Belakang', 'south_west', 'uploads/track/gDwUEDmUYB02wgNmgowKNgHqwdK3c6Vkm3dL4ZD3.jpg'),
(318, 69, 'Kiri Depan', 'north_west', 'uploads/track/78yAAZDq6e18DF2EiHrvcMj8h01DWsoRTJkBpUcC.jpg'),
(319, 69, 'Depan', 'north', 'uploads/track/lJ1Y6NLS1O8jtF0rf7ScfGfAa47wEM7H5pizPZKH.jpg'),
(320, 69, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/26fD8XC4rX7tQCavseBAS9ainYVX8peAQDzj9JXC.jpg'),
(321, 69, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/VCVQJ9WPxFMlVgq8T4NkpwfJYDFg8yc7tFjWxKxt.jpg'),
(322, 70, 'Kanan Depan', 'north_east', 'uploads/track/D1nBGYQnfj1G2BUSABrxJH3Fv0JQiZT61qSsmkw7.jpg'),
(323, 70, 'Kanan Belakang', 'south_east', 'uploads/track/cHWHOiDwBSzFzUhr8P5wuWnns080GX3kJXSIkN2Q.jpg'),
(324, 70, 'Belakang', 'south', 'uploads/track/v0GpOIOtTPVpeNoSxVaJxTxbtF9y89Cr4GCCEUNF.jpg'),
(325, 70, 'Kiri Belakang', 'south_west', 'uploads/track/fwc8kbmTmhlT7aHoBasid7ur1QQArkblfS4sS1Cx.jpg'),
(326, 70, 'Kiri Depan', 'north_west', 'uploads/track/PTS6s5vTUW7WxPj9NRTDqif1ihckcveFGgYwvVhN.jpg'),
(327, 70, 'Depan', 'north', 'uploads/track/nVOmT09nUrdlTG3ZKBeVSymOGWzf2d75xvuutf9M.jpg'),
(328, 70, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/ICZnOOxw1CuYu4BrnhFoTlsQDrRalSrCm1SRckOg.jpg'),
(329, 70, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/E1qsZuwrQ1X0GcB2qa9DBWYL843c9vSZ1IguPgKM.jpg'),
(330, 70, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/wdetv2nNDRqw7j10e2LH3P2yHnWBOD2frWja3D72.jpg'),
(331, 70, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/LyAtek4k9uwQwEfBSFuwhEs2CVnWkQwQ2BCVcO8H.jpg'),
(332, 70, 'Sudut Bebas 5', 'zoom_out_map', 'uploads/track/nZoaGnVgbvauhix2DtjYEMqWJLSHEdbBOXzeSfDa.jpg'),
(333, 70, 'Sudut Bebas 6', 'zoom_out_map', 'uploads/track/Qs9nXFNncq5tCRIuWLFljexAdmLvPCC9ZGVIzAfZ.jpg'),
(334, 70, 'Sudut Bebas 7', 'zoom_out_map', 'uploads/track/UxBW6fu5ukB3LcqXJpfndK9zb2Kxn6nY1muDhZdF.jpg'),
(335, 70, 'Sudut Bebas 8', 'zoom_out_map', 'uploads/track/SsnRd4369XNgdKgXsdCW37yRLymDgCRxtUvnTuMc.jpg'),
(336, 70, 'Sudut Bebas 9', 'zoom_out_map', 'uploads/track/LkvUUK3NsB5EiLx528zEuTVo5pF8UyEq7kzibN31.jpg'),
(337, 71, 'Kanan Depan', 'north_east', 'uploads/track/MvNz7rHvhetk3NGLgomlxJqu9LoPHfxbUEHcThAz.jpg'),
(338, 71, 'Kanan Belakang', 'south_east', 'uploads/track/BUrg1KGx6GCel1bDlxkLAHTi97kzLeXVoLd5scXR.jpg'),
(339, 71, 'Belakang', 'south', 'uploads/track/JC0rUOZH7hYQFBXgm99QTlnL1XfmDDbLPt011Mcm.jpg'),
(340, 71, 'Kiri Belakang', 'south_west', 'uploads/track/mJ7OPMcuEr4isJzz9kiPoV9F7UYUUysoOR52kaSe.jpg'),
(341, 71, 'Kiri Depan', 'north_west', 'uploads/track/jH36r14As0OP8h3rkSU0UYErokcNJDKDMO4FdMPD.jpg'),
(342, 71, 'Depan', 'north', 'uploads/track/i7IbczZPOvF523mQ43HIwH80AeZzOmOzs2akVzNt.jpg'),
(343, 71, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/ahn0k2o15AjhcfqAUcnRlxNW0LWk8NCVY6PiDEte.jpg'),
(344, 71, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/xP8iAlixW0za0QsSUldQvvsGBLStn4vjyBxPeYpL.jpg'),
(345, 71, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/BbGlaLEjfDMAkVzfmoWafjwNyPuYJis7kaJFNEOe.jpg'),
(346, 71, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/9s1RWx4iHFtIEezBZ1HiPPgznl2N7LeLSbX8WFPc.jpg'),
(347, 71, 'Sudut Bebas 5', 'zoom_out_map', 'uploads/track/JKlQTU04KrVAB2cujeLbz9kGDRgYOR5J8vgWWc64.jpg'),
(348, 71, 'Sudut Bebas 6', 'zoom_out_map', 'uploads/track/YeKO9qMci6uzg8Ro8QnM2qCGxfo2WJUbQDWyQSPU.jpg'),
(349, 71, 'Sudut Bebas 7', 'zoom_out_map', 'uploads/track/6Xacbmxn2omkQXJPX6esF6f43lSw41wtrNPYKRUx.jpg'),
(350, 71, 'Sudut Bebas 8', 'zoom_out_map', 'uploads/track/eHFTyo8MwT3N7cook8JB5ormdKyeudomDwQErQdw.jpg'),
(351, 71, 'Sudut Bebas 9', 'zoom_out_map', 'uploads/track/erxCzUUXHWpG58Uy8b0QrWaHbjP3eug3lriKot00.jpg'),
(352, 72, 'Kanan Depan', 'north_east', 'uploads/track/jBa6t3PA2yDIlxjdN6Kwt6mYd1bR4djICSDMOosl.jpg'),
(353, 72, 'Kanan Belakang', 'south_east', 'uploads/track/5v0kkrz8pmbTa6DjpJxLwLEfYVyfgu8ln2PNM2cx.jpg'),
(354, 72, 'Belakang', 'south', 'uploads/track/7KDTYlBTmpIjMCkB7Cg56UkKUpjowmbxOmVVYG2x.jpg'),
(355, 72, 'Kiri Belakang', 'south_west', 'uploads/track/XXCAvjiWGHNeYQAmeWiEhDWPp4t78KRgu9e7nPbM.jpg'),
(356, 72, 'Kiri Depan', 'north_west', 'uploads/track/nA24v61eBdLAJgUCfLEQ0tdamF2rNXdijeW7pH48.jpg'),
(357, 72, 'Depan', 'north', 'uploads/track/8tHQ1M9peiSYJHAqSnKvSJ48yiHSfcZXJwI93XHo.jpg'),
(358, 72, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/5BqmVYmFHQ8NN7WBnOcqGarxCJarJUken6GRZyuX.jpg'),
(359, 72, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/mtqiszGWUSLLqTrgXyzIcERRxiDXYtOAxC9x2rSu.jpg'),
(360, 72, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/Prt7IWYPRQrP1IKEinKdbip1xHxbj1Ep64k165iW.jpg'),
(361, 72, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/a0v2wSfIOUHrTh88pvpqh8TPYKySn89JaZlapsII.jpg'),
(362, 72, 'Sudut Bebas 5', 'zoom_out_map', 'uploads/track/DovpBbYsMmN8xTox7HQcKBze0fFsnouJEaftDTCI.jpg'),
(363, 72, 'Sudut Bebas 6', 'zoom_out_map', 'uploads/track/ttwhZuJJKXMTk42Jt0Zmf2t0vkwmlBO9LaPgFG3i.jpg'),
(364, 72, 'Sudut Bebas 7', 'zoom_out_map', 'uploads/track/wemYabXe47eD2B7zdkgKPhLNv3vwMma9MPQ7SW6j.jpg'),
(365, 72, 'Sudut Bebas 8', 'zoom_out_map', 'uploads/track/8QGlxuCEsW0tbaDx5k84gsAnsLrdKmXlCLO0vgvO.jpg'),
(366, 72, 'Sudut Bebas 9', 'zoom_out_map', 'uploads/track/qC477bUniVJdXQIRPN3kq15wGZIKN47EIxtUFArj.jpg'),
(367, 73, 'Kanan Depan', 'north_east', 'uploads/track/AuAVeCojqz59uz8Ow3DlzM0ctFK5zJWMHDP2NNs7.jpg'),
(368, 73, 'Kanan Belakang', 'south_east', 'uploads/track/6Fa2WGxTTbiBoGWF6ZXalS0VPR8Ex4YWxl8XyuRW.jpg'),
(369, 73, 'Belakang', 'south', 'uploads/track/uxw2y4kQkU6zhozTgPgRBsDFbvuOBVZOT3jpNPmy.jpg'),
(370, 73, 'Kiri Belakang', 'south_west', 'uploads/track/2jUvmPLq0xWGk5rzUVO7O3ZkUaBo3yvY2yzr5RMB.jpg'),
(371, 73, 'Kiri Depan', 'north_west', 'uploads/track/ByXK9WntY7GGIMSRXNV2Jt0FaTTB5H3eweOOcSwo.jpg'),
(372, 73, 'Depan', 'north', 'uploads/track/dKcLVbHNRe0mKFwWQZ9wgE33tll6Lkx7SewjHhV2.jpg'),
(373, 73, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/9k529CF7aBlUe7QkcAaN9WFM6I6trFCkOSgGlnbB.jpg'),
(374, 73, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/e2NCWO57WGwZx5yndpeEYo5v9iOh3QURJjSHhgn7.jpg'),
(375, 73, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/eOuznIeEFFVAypnOkXfCnnxAklloCsl6TIdQtnW4.jpg'),
(376, 73, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/05I6gu5mR2zfQZt9BGyqA99Y6wUjuD56fmBGopFh.jpg'),
(377, 74, 'Kanan Depan', 'north_east', 'uploads/track/CVmuDZCNAHf57ehKh5kjpAMYIQbJE6kAjZqotJkM.jpg'),
(378, 74, 'Kanan Belakang', 'south_east', 'uploads/track/H9oUrdVovqJdz1GGrJFOTopg88aWaz9y1jmlXQol.jpg'),
(379, 74, 'Belakang', 'south', 'uploads/track/RIsdbQCS0uWpYD8idARbAJDl8rsXUxPzBpqkLEBC.jpg'),
(380, 74, 'Kiri Belakang', 'south_west', 'uploads/track/7vjF5AKrrYkzPYht44P10gRANAMaz7AWMmZCYaij.jpg'),
(381, 74, 'Kiri Depan', 'north_west', 'uploads/track/nKhF6ztqFjhQ0MvGL3yj3EcCB31SHZvgIRCyvLBb.jpg'),
(382, 74, 'Depan', 'north', 'uploads/track/L5ioJ3cwqWMuCHxVEYQiahzpHTQNZbXFkyIWgnkO.jpg'),
(383, 74, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/CmEKz0VHvDXpIMDoMt6dGcOlQ7kMKe3HqXWfpWim.jpg'),
(384, 74, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/Lwb3nGWnhlhvjujdB3Xmh7XGH74ufCddc8EhSNt2.jpg'),
(385, 74, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/0pplUEAPch6vteb3g7jIfbjB2Zb67eifn9WRHwYz.jpg'),
(386, 74, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/iuVcDbSzuCELZuAEreJnKqrkpbMCS73nXasLje3r.jpg'),
(387, 75, 'Kanan Depan', 'north_east', 'uploads/track/XnBi2Tu6X8JhpOGe0pVLXAdUIGRpdAWTZWwXA261.jpg'),
(388, 75, 'Kanan Belakang', 'south_east', 'uploads/track/Sxc6uJVDIoycrFwhVdQuuxoS8W9UblkBjmWNMzQh.jpg'),
(389, 75, 'Belakang', 'south', 'uploads/track/QUdocffBIpcTNFA6wYkF1B6hiSdRLZiaYaJ7XG0i.jpg'),
(390, 75, 'Kiri Belakang', 'south_west', 'uploads/track/xJZkTiPf2ckQwErJqfCwxrNTnfHHJYEwMltJljmD.jpg'),
(391, 75, 'Kiri Depan', 'north_west', 'uploads/track/JoRmVtesWhiZiwk7Kfcf1skzV9bNwPo0nh8zUknj.jpg'),
(392, 75, 'Depan', 'north', 'uploads/track/of5npjo7roadZdKi27BmLA3oyAHECRpsk07KDXQM.jpg'),
(393, 75, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/8PqpAne8fK3mvjp3XeiFYAnMvSQlMf1Y8nGIyePc.jpg'),
(394, 75, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/gKjpLlWRLu0ExDxOGrtIcaxmGgadOrlw65rVR9Nv.jpg'),
(395, 75, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/92Wor3lC6fKrY3KFFedpPuAvBIxc0BBuyazDTju0.jpg'),
(396, 75, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/vHMJxbNnxAytC7p2mkbNBOfU6T43GNjYLFRVrpEa.jpg'),
(407, 77, 'Kanan Depan', 'north_east', 'uploads/track/Bq9ipmmpZ0QkWh5VKvhIuy31zkscZTsGhTmSucDc.jpg'),
(408, 77, 'Kanan Belakang', 'south_east', 'uploads/track/KaewgtaPUo618cxwjID9vTlI4THorXj7SNJKPuXk.jpg'),
(409, 77, 'Belakang', 'south', 'uploads/track/o3lliowhxSmE7fOsohxZ9Gmlq2T1xpdg7YMdxKwh.jpg'),
(410, 77, 'Kiri Belakang', 'south_west', 'uploads/track/igMhCGOKFLydVTRuIxgiGYk6gzLVst1Xsd1niIMP.jpg'),
(411, 77, 'Kiri Depan', 'north_west', 'uploads/track/RxG6HdgNCQCFU0mmEOx8eia2XmV9VMzEYlZi02u3.jpg'),
(412, 77, 'Depan', 'north', 'uploads/track/gM4BKY5CkTp3zZcvE8uBLWqE0NeVwXkmSSyPVrEF.jpg'),
(413, 77, 'Sudut Bebas 1', 'zoom_out_map', 'uploads/track/0ABsmcP1WnSrKrO5n2vbiaWrNULNkCtPs0Is58SR.jpg'),
(414, 77, 'Sudut Bebas 2', 'zoom_out_map', 'uploads/track/kcv8T4zrFiZe4mCekzqB2NrMN41JUefjFqdzGNKf.jpg'),
(415, 77, 'Sudut Bebas 3', 'zoom_out_map', 'uploads/track/vwVJFTFDNEgKkCIFyeJWVZtWlCD32ld1BuCOh97y.jpg'),
(416, 77, 'Sudut Bebas 4', 'zoom_out_map', 'uploads/track/dD8BC7crBXFcdScyoOzIXdkOUqppcg5t1ARJh5Hl.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `Id_Type` int(11) NOT NULL,
  `Name_Type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`Id_Type`, `Name_Type`) VALUES
(1, 'NT DAI'),
(2, 'SXG 2'),
(3, 'SXG 3'),
(4, 'NT 544'),
(5, 'TLE');

-- --------------------------------------------------------

--
-- Table structure for table `type_users`
--

CREATE TABLE `type_users` (
  `Id_Type_User` int(11) NOT NULL,
  `Name_Type_User` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `type_users`
--

INSERT INTO `type_users` (`Id_Type_User`, `Name_Type_User`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id_User` int(11) NOT NULL,
  `Name_User` varchar(100) NOT NULL,
  `Username_User` varchar(100) NOT NULL,
  `Password_User` varchar(100) NOT NULL,
  `Id_Type_User` int(11) NOT NULL,
  `Id_Area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id_User`, `Name_User`, `Username_User`, `Password_User`, `Id_Type_User`, `Id_Area`) VALUES
(1, 'Admin', 'admin', 'admin', 2, 1),
(2, 'Member Engine', 'engine', '123456', 1, 1),
(4, 'Member Main Line Start', 'main line start', '123456', 1, 2),
(5, 'Member Main Line End', 'main line end', '123456', 1, 3),
(6, 'Member Mower Collector', 'mower collector', '123456', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`Id_Area`);

--
-- Indexes for table `area_photos`
--
ALTER TABLE `area_photos`
  ADD PRIMARY KEY (`Id_Area_Photo`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `photo_angles`
--
ALTER TABLE `photo_angles`
  ADD PRIMARY KEY (`Id_Photo_Angle`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`Id_Track`);

--
-- Indexes for table `track_photos`
--
ALTER TABLE `track_photos`
  ADD PRIMARY KEY (`Id_Track_Photo`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Id_Type`);

--
-- Indexes for table `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`Id_Type_User`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `Id_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `area_photos`
--
ALTER TABLE `area_photos`
  MODIFY `Id_Area_Photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photo_angles`
--
ALTER TABLE `photo_angles`
  MODIFY `Id_Photo_Angle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `Id_Track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `track_photos`
--
ALTER TABLE `track_photos`
  MODIFY `Id_Track_Photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `Id_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type_users`
--
ALTER TABLE `type_users`
  MODIFY `Id_Type_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
