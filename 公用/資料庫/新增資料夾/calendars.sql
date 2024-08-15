-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-15 04:52:41
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
-- 資料表結構 `calendars`
--

CREATE TABLE `calendars` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `text` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `detail_address` varchar(255) NOT NULL,
  `hourly_rate` decimal(8,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `calendars`
--

INSERT INTO `calendars` (`id`, `user_id`, `date`, `time`, `text`, `city`, `district`, `detail_address`, `hourly_rate`, `created_at`, `updated_at`) VALUES
(3, NULL, '2024-08-01', '02:10:00', '數學課', '基隆市', '信義區', '公益路國泰大樓', 51, '2024-08-05 22:20:20', '2024-08-09 03:43:40'),
(4, NULL, '2024-08-22', '07:25:00', '數學課', '新竹市', '東區', '公益路國泰大樓', 558, '2024-08-05 22:30:28', '2024-08-05 22:30:28'),
(5, NULL, '2024-08-21', '06:20:00', '數學課', '台中市', '北區', '公益路國泰大樓', 555, '2024-08-05 22:31:05', '2024-08-05 22:31:05'),
(6, NULL, '2024-08-23', '09:20:00', '數學課', '苗栗縣', '苗栗市', '公益路國泰大樓', 999, '2024-08-05 22:31:05', '2024-08-05 22:31:05'),
(7, NULL, '2024-09-13', '16:15:00', '數學課', '高雄市', '阿蓮區', '公益路國泰大樓', 999, '2024-08-08 19:46:11', '2024-08-08 19:46:11'),
(8, NULL, '2024-08-22', '03:15:00', '數學課', '彰化縣', '社頭鄉', '公益路國泰大樓', 99, '2024-08-11 18:54:43', '2024-08-11 18:54:43'),
(9, 6, '2024-08-16', '05:25:00', '數學課', '苗栗縣', '三灣鄉', '公益路國泰大樓', 999, '2024-08-11 21:46:30', '2024-08-11 21:46:30'),
(11, 6, '2024-08-15', '05:15:00', '數學課', '新竹市', '東區', '公益路國泰大樓', 99, '2024-08-11 22:05:30', '2024-08-11 22:05:30'),
(12, 6, '2024-08-14', '05:20:00', '數學課', '新竹縣', '湖口鄉', '公益路國泰大樓', 99, '2024-08-11 22:07:24', '2024-08-11 22:07:24'),
(13, NULL, '2024-08-15', '02:15:00', '數學課', '新竹縣', '芎林鄉', '公益路國泰大樓', 9, '2024-08-11 23:40:32', '2024-08-11 23:40:32'),
(19, 12345, '2024-08-20', '04:25:00', '數學課', '桃園市', '楊梅區', '公益路國泰大樓', 999, '2024-08-11 23:54:18', '2024-08-11 23:54:18'),
(20, 6, '2024-08-22', '17:15:00', '4555', '屏東縣', '潮州鎮', 'sasa', 21, '2024-08-14 00:05:03', '2024-08-14 00:05:03'),
(21, 6, '2024-08-24', '19:05:00', '4555', '宜蘭縣', '大同鄉', 'sa', 21, '2024-08-14 17:09:17', '2024-08-14 17:09:17'),
(22, 6, '2024-08-23', '17:10:00', 'qwwqwqqw', '宜蘭縣', '蘇澳鎮', 'ad', 2, '2024-08-14 17:12:55', '2024-08-14 17:12:55');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
