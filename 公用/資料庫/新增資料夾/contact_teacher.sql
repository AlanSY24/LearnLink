-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-15 04:53:01
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `learnlink`
--

-- --------------------------------------------------------

--
-- 資料表結構 `contact_teacher`
--

CREATE TABLE `contact_teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `be_teacher_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `contact_teacher`
--

INSERT INTO `contact_teacher` (`id`, `be_teacher_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 2, 6, '2024-08-12 19:03:44', '2024-08-12 19:03:44'),
(4, 3, 6, '2024-08-12 19:03:46', '2024-08-12 19:03:46'),
(5, 4, 6, '2024-08-12 23:31:49', '2024-08-12 23:31:49'),
(6, 5, 6, '2024-08-12 23:31:54', '2024-08-12 23:31:54'),
(11, 7, 6, '2024-08-13 23:03:36', '2024-08-13 23:03:36'),
(12, 8, 6, '2024-08-13 23:03:38', '2024-08-13 23:03:38'),
(13, 6, 6, '2024-08-14 17:08:54', '2024-08-14 17:08:54');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `contact_teacher`
--
ALTER TABLE `contact_teacher`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_teacher`
--
ALTER TABLE `contact_teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
