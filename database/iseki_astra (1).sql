-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 05:49 AM
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
('mZ7kN38EoV6dJZcY2Kl6AutwZ5BHyfWtYKIZ4y94', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNGlGRVVkRGtsYVRQNzd2Z1prQUlFY3ZHMXFmVVJDcDFoZnBUNzUxdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2hlY2tsaXN0L3N1Ym1pdD9UaW1lX1RyYWNrPTIwMjUtMDYtMTgmX3Rva2VuPTRpRkVVZERrbGFUUDc3dmdaa0FJRWN2RzFxZlVSQ3AxaGZwVDc1MXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6IklkX1VzZXIiO2k6MTtzOjEyOiJJZF9UeXBlX1VzZXIiO2k6MjtzOjEzOiJVc2VybmFtZV9Vc2VyIjtzOjU6ImFkbWluIjt9', 1750218313),
('QsXD0krypJ6umFRcELE1z8Dv3u7WnOnSLnM9fm82', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQ1FyNkRlS0xuQld6ZXhmY2k5QXpSd0h2Z3htenNQa2ZjdEdrT2JUcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyX3JlcG9ydCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoiSWRfVXNlciI7aTo1O3M6MTI6IklkX1R5cGVfVXNlciI7aToxO3M6MTM6IlVzZXJuYW1lX1VzZXIiO3M6NToidXNlcjMiO30=', 1750218110);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `Id_Track` int(11) NOT NULL,
  `Id_User` int(11) NOT NULL,
  `Id_Type` varchar(100) NOT NULL,
  `Id_Area` int(11) NOT NULL,
  `Path_Front_Right` varchar(100) NOT NULL,
  `Path_Rear_Right` varchar(100) NOT NULL,
  `Path_Behind` varchar(100) NOT NULL,
  `Path_Rear_Left` varchar(100) NOT NULL,
  `Path_Front_Left` varchar(100) NOT NULL,
  `Path_Ahead` varchar(100) NOT NULL,
  `Path_Free_Angle_1` varchar(100) NOT NULL,
  `Path_Free_Angle_2` varchar(100) NOT NULL,
  `Time_Track` timestamp NULL DEFAULT NULL,
  `Status_Track` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`Id_Track`, `Id_User`, `Id_Type`, `Id_Area`, `Path_Front_Right`, `Path_Rear_Right`, `Path_Behind`, `Path_Rear_Left`, `Path_Front_Left`, `Path_Ahead`, `Path_Free_Angle_1`, `Path_Free_Angle_2`, `Time_Track`, `Status_Track`) VALUES
(18, 2, '3963;20250630;SXG327S5H2S;100020', 1, 'uploads/track/GKFm8Rcmg0vUt8YhwqjwZPoNNqq5uvubPm9eG9gN.jpg', 'uploads/track/K5jAEMIF8cbeegy8dzJ8JreO4Fmg3oHgd1NuyeqJ.jpg', 'uploads/track/cyjr0PM3Zqmyr72N46B5qqWj8q22hzQN2sF1BgMb.jpg', 'uploads/track/AUbmQW57fUBJ6CD3l5nZESiExf4yl6HGMJvaDeim.jpg', 'uploads/track/fFaulMW6s3u3Fp0DbaFO8s9C7OQ153G7duLxbP8j.jpg', 'uploads/track/V1HuKy6e1trrpIJxoECo2DIxsAK6X2xrNvjkUw73.jpg', 'uploads/track/bkay7mfltIpZhl021DekocgcGZrRjCBhl915oix2.jpg', 'uploads/track/C9AFEJYCQYfafu16iTqyCLRWrXYTlcZx9qO5vezy.jpg', '2025-06-18 02:48:13', 0),
(21, 4, '3963;20250630;SXG327S5H2S;100020', 2, 'uploads/track/tQyZ3BObMxvjMfqIxC7UU33VX68PQDBid7D3mYrf.jpg', 'uploads/track/1jhQpd2FcDmC6rrQfqBTcpJUWIoC0KTn0RgRyLna.jpg', 'uploads/track/5y3thN3CVea4K5HgzleAjmh4mzdp1nVeQfZ2eCuW.jpg', 'uploads/track/CRyzcuapiXoaERAoX7M8fMZw3h5aA8kXUKQm2D0B.jpg', 'uploads/track/VMHhzD2ntwJr4xbBGv2PPIDWHQMqBkaKIE8pJsuY.jpg', 'uploads/track/wtkMTf103FFNclPeoDOBCZa75D2LH0T7R1XkXR0w.jpg', 'uploads/track/wsvw6hc2LktjFmDGSjf866sgSZPaVNS6XHwEsDbr.jpg', 'uploads/track/YhcoyyfqDpm9rXfnLZqQjjTjbzA7bPZ3fPZsfp1j.jpg', '2025-06-18 02:53:19', 0),
(24, 5, '3963;20250630;SXG327S5H2S;100020', 3, 'uploads/track/hKZVI7hXDTdaZH6YmXNm603iuTpkDpessuQs2a6X.jpg', 'uploads/track/RP0iQ9qCr4KnUxHbQPVbzWbRs4z4CZw1q0dhyjqo.jpg', 'uploads/track/WVboyFJcDQAxY04FKwOzy6dNn5cWTp4ZNI7fNPVL.jpg', 'uploads/track/V3pZIPBLxaAOpVGXbKnqgyIsQo9nWqHi9NSMOaAH.jpg', 'uploads/track/AmFxYg9S2NAvH9YsF78098USng0eMcdnarPW614A.jpg', 'uploads/track/fsiT0ccld4OxALNGZlVjvMnuIKtpGlwdvh4BjHUj.jpg', 'uploads/track/L63r9Vu7s0uuALbEwrWwXnrfU9ecwbZ5LgxpHWEo.jpg', 'uploads/track/DezagDZsKxo2X23W5WqQZUygj9I2jje4d2MnkgwE.jpg', '2025-06-18 02:57:11', 0),
(30, 6, '3963;20250630;SXG327S5H2S;100020', 4, 'uploads/track/CUbrXbGKR8yShK8gI7hc0Qas9EGWmcWzXyUH0w8C.jpg', 'uploads/track/l9Wi3sjvhsddcLeCyU70cmnK7TaitiWcqNJbLZ3I.jpg', 'uploads/track/FdjmYSeiAZoWNVLnLJdz3aBy1S4bqVF31MoHFyeu.jpg', 'uploads/track/RsBDk9T1gTm2gQjAsIB8Rk0iXCN2hPPGKeuTHZij.jpg', 'uploads/track/fVAGOpc5IBDsWf5itoPxBQBc29CK88Z6gjaRRmgn.jpg', 'uploads/track/dXB5JmfyMBbFNULFSy4iiUlkiBZkDVwRgv8zdSfM.jpg', 'uploads/track/8LXt39QsBjIdV3bRF7FA14o4gJ8dip0qc0CY15T2.jpg', 'uploads/track/om5KxxgMnaZ2EqdbCYnlZ7w9p1HZ5Xt405fSICd6.jpg', '2025-06-18 03:34:05', 0),
(31, 2, '3956;20250630;MF2E50HVRE3;S-2702', 1, 'uploads/track/a1mD4Kd9IlnU55Gb8lRYYeWLb7QygpiEqSr5H0K3.jpg', 'uploads/track/4ylhuH1iExFE7xucK7sBGwBQrHh6Zl0vDI87vFoh.jpg', 'uploads/track/ll1dGqHIziquU4CjT3lx89RKVfHSZQXYE1JiXiBa.jpg', 'uploads/track/MPcC4gndMX0Vn1PQDhW5oG8vHUhoknSIuJpc7B3r.jpg', 'uploads/track/KoUl9t4wklQl3a1CscBdI1GBSBjZmOUCIukxTnfI.jpg', 'uploads/track/U9mpM8SLmujeoDOUKLF1dyUmEbEMrWk6aJW4ohx0.jpg', 'uploads/track/NSjvPT7Lb04ezZO0esmoT33zdsIDA2EPIJdIq4cZ.jpg', 'uploads/track/s3zdbvNxd7GQcRp2y0pXDpwL1jIBBHorra5DsYzD.jpg', '2025-06-18 03:36:51', 0),
(32, 2, '3962;20250630;NT548FSE1;103232', 1, 'uploads/track/hbAinobr6vBVTzCyi9s1hgmBJz1RikOfASnJbzqE.jpg', 'uploads/track/3V02uJS7eBOgg7yJexml5O5xdayhdEzFX6E8OWc6.jpg', 'uploads/track/t6ZxTvFovLmQ8kxBpRRSI6tOwRMrh6uudreppVOF.jpg', 'uploads/track/RuoRetwrReb6KVrCutgso4RfJwKlBROgVvtLbUjW.jpg', 'uploads/track/a7go5xiEb4KdhvHblKaYsMnY9e7HPQHnj1BNEne1.jpg', 'uploads/track/VFtpUmyUeflOPCwpeKXbyloYzU7BoM0wq9uzgNe2.jpg', 'uploads/track/d2xhacii7fFdOTwke2qyfQRNf2oGMkWCdO6qGyEk.jpg', 'uploads/track/UdznMcNUXEVBkJYhHt7dAgEwzMhdbjIypXrripvg.jpg', '2025-06-18 03:37:49', 0),
(33, 4, '3956;20250630;MF2E50HVRE3;S-2702', 2, 'uploads/track/mEojiPzExhNJ1wDDxOwrjUGQvIQC906haCnsPFsv.jpg', 'uploads/track/WUcQFA7d9CkaFvzGyIrJc9SrmoizE9V0bSsCBuRc.jpg', 'uploads/track/zqhCYrghZLWhjtK7zv0RaqU2i35rLNQZfJQagoQT.jpg', 'uploads/track/YpxFkgvVJ1kH63Qb5yFGIyi2uuOZn0G4QGD9QtDF.jpg', 'uploads/track/b6CXmpkofMD6KWfidmkRIfTgrHqmZFKtcRRuzyT4.jpg', 'uploads/track/Vu1Sq1JxpChCsQPbyqRYQybh2hvsWgXIQQkR4e1F.jpg', 'uploads/track/gHCoVlrUwYX4qQTIYSD9O0HEcgEa2HlElWOdwMqk.jpg', 'uploads/track/lDmJHMKC35IXxUYHQ9D0Dim9G7BuT5fjO1ZeHk9e.jpg', '2025-06-18 03:38:50', 0),
(34, 4, '3962;20250630;NT548FSE1;103232', 2, 'uploads/track/KUKwwNr7i1xBwvDCVKAYMQ7xBtQl6ntJKTI9DH34.jpg', 'uploads/track/RAv2GoT25yOr430vPvKS20zgrT67rvgh1hyxsryC.jpg', 'uploads/track/HMFNglWg1vq2BcdA9jo5YGD09ce9T2SgSTMbIto9.jpg', 'uploads/track/oP4FEJBfww807plS8tWuotcSNNSvzHrWBrRsBaBO.jpg', 'uploads/track/z5LJS2A50Gs1cHk29SuZJAesdvffNwFg9phKLvR7.jpg', 'uploads/track/GFpuvUeYWmGdaNdCLYI8VJsEVT6EneDUPMBymVW2.jpg', 'uploads/track/aIr90oCvg76VipHD4lbdbmhVrnILtnGwTQmtiWQA.jpg', 'uploads/track/sbCXN3NrOFrijcEqQ9oYgfsMgWSAZPxHgRlRiwkL.jpg', '2025-06-18 03:39:49', 0),
(35, 5, '3956;20250630;MF2E50HVRE3;S-2702', 3, 'uploads/track/JZARLHs6UuHfzXRcChs3A3y29wsz4SpqazVK69WA.jpg', 'uploads/track/J7FnjZAT0nwBWJWGdYAKb69dp3sEXCqZ4OfgXHBL.jpg', 'uploads/track/P1BWF1jnK3UeBNRNO9Y8oRfkUw0YX61ipyr1rsMs.jpg', 'uploads/track/1kBhtyIwHXiilw1LAl7vkr9bC3rTGmwF6l8nzLFB.jpg', 'uploads/track/r4mFOAZjolsu5ICT4Ts6PKk9b972FifHWqzEMLf6.jpg', 'uploads/track/mc0O0GnPAKe2uGKNVhKCLd0TbtgxxTIQl2cuGdSB.jpg', 'uploads/track/0ZC21PXMNad7fwbeH0R6wyPMdwvKm9gzBzepkG4V.jpg', 'uploads/track/hM0Gw9TAkO5sue7tXAX7qgwxnKWLmhhKrYIpIZ1o.jpg', '2025-06-18 03:40:49', 0),
(36, 5, '3962;20250630;NT548FSE1;103232', 3, 'uploads/track/2948rmfTEdZRzVnR2wIovzAfGJ4krBSxB8FvaxGX.jpg', 'uploads/track/bxSL8mPq8irslgSyQkMGbA3HlpCPcNeR3PX7p3GD.jpg', 'uploads/track/4ra0tIuXxx3ac9YFyJd5oHKFWGkElBvmlyQXfhSK.jpg', 'uploads/track/Bvn0Ne9a4a8qSZnTyDaaTtRtRYX81dOFfaKw0fny.jpg', 'uploads/track/XIh5OI21ZMOw6KmpFqArZjEkral17XIfE6ISABTR.jpg', 'uploads/track/pEhFEdnVkvL9R9MZYCIUMaELcU9SYERjBVSofl0n.jpg', 'uploads/track/MJ9zeBVGaJUu55BvXzMKTdG2n4otCLvBRmqtdYXV.jpg', 'uploads/track/84xaBU8phCtYM0WgizjBg8RwtCABC88qPgmyfaew.jpg', '2025-06-18 03:41:50', 0);

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
(2, 'Member Engine', 'user1', '123456', 1, 1),
(4, 'Member Main Line Start', 'user2', '123456', 1, 2),
(5, 'Member Main Line End', 'user3', '123456', 1, 3),
(6, 'Member Mower Collector', 'user4', '123456', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`Id_Area`);

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
  MODIFY `Id_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `Id_Track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
