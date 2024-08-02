-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-02 15:05:34
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
-- 資料表結構 `children_card`
--

CREATE TABLE `children_card` (
  `children_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `children_name` varchar(255) NOT NULL,
  `children_birthdate` date NOT NULL,
  `children_gender` enum('男','女','其他') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `children_card`
--

INSERT INTO `children_card` (`children_id`, `user_id`, `children_name`, `children_birthdate`, `children_gender`, `created_at`, `updated_at`) VALUES
(10, 6, 'Amy', '2021-02-02', '男', '2024-08-01 19:59:40', '2024-08-01 19:59:40'),
(11, 6, 'Amy', '2024-07-29', '男', '2024-08-01 21:57:33', '2024-08-01 21:57:33');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `children_card`
--
ALTER TABLE `children_card`
  ADD PRIMARY KEY (`children_id`),
  ADD KEY `children_card_user_id_foreign` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `children_card`
--
ALTER TABLE `children_card`
  MODIFY `children_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `children_card`
--
ALTER TABLE `children_card`
  ADD CONSTRAINT `children_card_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
