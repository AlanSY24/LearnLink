-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-16 09:16:25
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
-- 資料表結構 `be_teachers`
--

CREATE TABLE `be_teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `available_time` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `hourly_rate` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `district_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `details` text DEFAULT NULL,
  `resume_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('published','in_progress','completed','cancelled') NOT NULL DEFAULT 'published',
  `CaseReceiver` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `be_teachers`
--

INSERT INTO `be_teachers` (`id`, `user_id`, `title`, `subject_id`, `available_time`, `hourly_rate`, `city_id`, `district_ids`, `details`, `resume_id`, `created_at`, `updated_at`, `status`, `CaseReceiver`) VALUES
(1, NULL, 'vvvv', 4, '[\"afternoon\"]', 6, 12, '', 'vvvv', NULL, '2024-08-04 19:02:14', '2024-08-04 19:02:14', 'published', NULL),
(2, NULL, 'Gggg', 4, '\"[\\\"afternoon\\\",\\\"evening\\\"]\"', 66, 16, '[\"299\",\"305\"]', 'ggggg', NULL, '2024-08-04 19:19:32', '2024-08-04 19:19:32', 'published', NULL),
(3, NULL, 'vvvv', 4, '\"[\\\"afternoon\\\"]\"', 66, 11, '[\"176\",\"177\"]', 'vvvvv', NULL, '2024-08-04 19:22:05', '2024-08-04 19:22:05', 'published', NULL),
(4, NULL, 'vvvvv', 6, '\"[\\\"afternoon\\\"]\"', 666, 13, '[\"199\",\"205\"]', 'vvvv', NULL, '2024-08-04 19:46:17', '2024-08-04 19:46:17', 'published', NULL),
(5, NULL, '55555', 5, '\"[\\\"afternoon\\\",\\\"evening\\\"]\"', 115651, 13, '[\"197\",\"203\"]', 'vvvvvvv', NULL, '2024-08-04 22:35:29', '2024-08-04 22:35:29', 'published', NULL),
(6, 6, '測試時段', 4, '\"[\\\"\\\\u65e9\\\\u4e0a\\\",\\\"\\\\u4e0b\\\\u5348\\\",\\\"\\\\u665a\\\\u4e0a\\\"]\"', 100, 16, '\"[\\\"299\\\",\\\"305\\\"]\"', 'gggggg', NULL, '2024-08-05 18:18:40', '2024-08-05 18:18:40', 'published', NULL),
(7, 6, 'sad', 2, '\"[\\\"\\\\u65e9\\\\u4e0a\\\"]\"', 23, 2, '\"[\\\"33\\\"]\"', 'qwqwqwqw', NULL, '2024-08-06 00:48:39', '2024-08-06 00:48:39', 'published', NULL),
(8, 6, 'qwq', 2, '\"[\\\"\\\\u65e9\\\\u4e0a\\\"]\"', 121, 2, '[\"21\"]', 'wqw', NULL, '2024-08-06 00:53:43', '2024-08-06 00:53:43', 'published', NULL),
(9, 6, 'qwq', 2, '\"[\\\"\\\\u65e9\\\\u4e0a\\\"]\"', 21, 18, '[\"348\",\"354\"]', 'wqw', NULL, '2024-08-06 01:00:23', '2024-08-06 01:00:23', 'published', NULL),
(10, 6, 'qweqw', 12, '早上, 下午, 晚上', 1, 16, '[\"299\"]', 'qweqw', NULL, '2024-08-13 17:28:53', '2024-08-13 17:28:53', 'published', NULL),
(11, 10, '測試身分3', 4, '早上, 下午', 200, 11, '[\"177\"]', '測試身分3', NULL, '2024-08-13 22:52:52', '2024-08-13 22:52:52', 'published', NULL),
(12, 10, '0815-2', 4, '早上, 下午, 晚上', 200, 5, '[\"61\",\"62\"]', '0815-2', NULL, '2024-08-14 17:53:04', '2024-08-14 18:11:14', 'in_progress', NULL),
(13, 6, '測試接案人存入1', 4, '早上', 200, 5, '[\"62\"]', 'test', NULL, '2024-08-15 17:25:35', '2024-08-15 17:27:08', 'in_progress', 10),
(14, 6, '02', 12, '早上, 下午', 1221, 16, '[\"299\",\"305\"]', 'ad', NULL, '2024-08-15 22:11:01', '2024-08-15 22:11:01', 'published', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('somethingooppll012288@gamil.com', 'a:1:{s:10:\"verifyCode\";i:351802;}', 1723709027);

-- --------------------------------------------------------

--
-- 資料表結構 `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(23, 10, '2024-08-22', '01:15:00', '測試身分2', '桃園市', '龍潭區', '123', 456, '2024-08-13 23:51:25', '2024-08-13 23:51:25'),
(24, 10, '2024-08-23', '06:20:00', 'ffffffffff', '基隆市', '仁愛區', '公益路國泰大樓', 999, '2024-08-14 00:00:28', '2024-08-14 00:00:28'),
(25, 10, '2024-08-28', '10:25:00', 'ffffffffff', '台中市', '烏日區', '公益路國泰大樓', 9999, '2024-08-14 00:00:28', '2024-08-14 00:00:28'),
(26, 10, '2024-08-23', '05:15:00', '測試身分2', '彰化縣', '大村鄉', '999', 888, '2024-08-14 00:08:49', '2024-08-14 00:08:49'),
(27, 10, '2024-08-21', '15:10:00', '0815-1', '台中市', '霧峰區', '公益路國泰大樓', 200, '2024-08-14 17:20:57', '2024-08-14 17:20:57'),
(29, 6, '2024-08-21', '02:10:00', '0815-2', '新竹市', '東區', '公益路國泰大樓', 200, '2024-08-14 18:11:14', '2024-08-14 18:11:14'),
(30, 6, '2024-08-22', '02:10:00', '0815-2', '新北市', '金山區', '公益路國泰大樓', 22, '2024-08-14 19:06:26', '2024-08-14 19:06:26'),
(31, 6, '2024-08-22', '05:15:00', '4555', '高雄市', '阿蓮區', 'fffff', 215919, '2024-08-14 19:07:05', '2024-08-14 19:07:05'),
(32, 6, '2024-08-22', '04:20:00', '0815-2', '宜蘭縣', '頭城鎮', '公益路國泰大樓', 25, '2024-08-14 21:46:28', '2024-08-14 21:46:28'),
(35, 6, '2024-08-21', '02:10:00', '測試存入接案人', '桃園市', '龍潭區', '公益路國泰大樓', 200, '2024-08-15 17:20:56', '2024-08-15 17:20:56'),
(36, 10, '2024-08-21', '13:10:00', '測試接案人存入1', '台中市', '后里區', '公益路國泰大樓', 200, '2024-08-15 17:27:08', '2024-08-15 17:27:08'),
(37, 6, '2024-08-27', '21:10:00', '01', '高雄市', '田寮區', 'ad', 11, '2024-08-15 22:14:10', '2024-08-15 22:14:10');

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

-- --------------------------------------------------------

--
-- 資料表結構 `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, '台北市'),
(2, '新北市'),
(3, '基隆市'),
(4, '桃園市'),
(5, '新竹市'),
(6, '新竹縣'),
(7, '苗栗縣'),
(8, '台中市'),
(9, '彰化縣'),
(10, '南投縣'),
(11, '嘉義市'),
(12, '嘉義縣'),
(13, '雲林縣'),
(14, '台南市'),
(15, '高雄市'),
(16, '屏東縣'),
(17, '宜蘭縣'),
(18, '花蓮縣'),
(19, '台東縣'),
(20, '澎湖縣'),
(21, '金門縣'),
(22, '連江縣');

-- --------------------------------------------------------

--
-- 資料表結構 `contact_student`
--

CREATE TABLE `contact_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_requests_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `contact_student`
--

INSERT INTO `contact_student` (`id`, `teacher_requests_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 23, 6, '2024-08-13 22:27:34', '2024-08-13 22:27:34'),
(4, 24, 6, '2024-08-13 22:27:36', '2024-08-13 22:27:36'),
(5, 27, 6, '2024-08-13 22:51:58', '2024-08-13 22:51:58'),
(6, 28, 6, '2024-08-13 23:59:23', '2024-08-13 23:59:23'),
(7, 30, 6, '2024-08-14 17:19:49', '2024-08-14 17:19:49'),
(8, 32, 10, '2024-08-15 17:12:45', '2024-08-15 17:12:45'),
(9, 25, 6, '2024-08-15 22:11:46', '2024-08-15 22:11:46'),
(10, 33, 6, '2024-08-15 22:11:50', '2024-08-15 22:11:50');

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
(7, 8, 6, '2024-08-13 00:28:37', '2024-08-13 00:28:37'),
(8, 6, 6, '2024-08-13 22:27:26', '2024-08-13 22:27:26'),
(9, 11, 6, '2024-08-13 22:55:04', '2024-08-13 22:55:04'),
(10, 12, 6, '2024-08-14 17:54:06', '2024-08-14 17:54:06'),
(11, 13, 10, '2024-08-15 17:26:20', '2024-08-15 17:26:20');

-- --------------------------------------------------------

--
-- 資料表結構 `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `district_name` varchar(40) NOT NULL,
  `cities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `districts`
--

INSERT INTO `districts` (`id`, `district_name`, `cities_id`) VALUES
(1, '中正區', 1),
(2, '大同區', 1),
(3, '中山區', 1),
(4, '松山區', 1),
(5, '大安區', 1),
(6, '萬華區', 1),
(7, '信義區', 1),
(8, '士林區', 1),
(9, '北投區', 1),
(10, '內湖區', 1),
(11, '南港區', 1),
(12, '文山區', 1),
(13, '仁愛區', 3),
(14, '信義區', 3),
(15, '中正區', 3),
(16, '中山區', 3),
(17, '安樂區', 3),
(18, '暖暖區', 3),
(19, '七堵區', 3),
(20, '萬里區', 2),
(21, '金山區', 2),
(22, '板橋區', 2),
(23, '汐止區', 2),
(24, '深坑區', 2),
(25, '石碇區', 2),
(26, '瑞芳區', 2),
(27, '平溪區', 2),
(28, '雙溪區', 2),
(29, '貢寮區', 2),
(30, '新店區', 2),
(31, '坪林區', 2),
(32, '烏來區', 2),
(33, '永和區', 2),
(34, '中和區', 2),
(35, '土城區', 2),
(36, '三峽區', 2),
(37, '樹林區', 2),
(38, '鶯歌區', 2),
(39, '三重區', 2),
(40, '新莊區', 2),
(41, '泰山區', 2),
(42, '林口區', 2),
(43, '蘆洲區', 2),
(44, '五股區', 2),
(45, '八里區', 2),
(46, '淡水區', 2),
(47, '三芝區', 2),
(48, '石門區', 2),
(49, '宜蘭市', 17),
(50, '頭城鎮', 17),
(51, '礁溪鄉', 17),
(52, '壯圍鄉', 17),
(53, '員山鄉', 17),
(54, '羅東鎮', 17),
(55, '三星鄉', 17),
(56, '大同鄉', 17),
(57, '五結鄉', 17),
(58, '冬山鄉', 17),
(59, '蘇澳鎮', 17),
(60, '南澳鄉', 17),
(61, '東區', 5),
(62, '北區', 5),
(63, '香山區', 5),
(64, '竹北市', 6),
(65, '湖口鄉', 6),
(66, '新豐鄉', 6),
(67, '新埔鎮', 6),
(68, '關西鎮', 6),
(69, '芎林鄉', 6),
(70, '寶山鄉', 6),
(71, '竹東鎮', 6),
(72, '五峰鄉', 6),
(73, '橫山鄉', 6),
(74, '尖石鄉', 6),
(75, '北埔鄉', 6),
(76, '峨嵋鄉', 6),
(77, '中壢區', 4),
(78, '平鎮區', 4),
(79, '龍潭區', 4),
(80, '楊梅區', 4),
(81, '新屋區', 4),
(82, '觀音區', 4),
(83, '桃園區', 4),
(84, '龜山區', 4),
(85, '八德區', 4),
(86, '大溪區', 4),
(87, '復興區', 4),
(88, '大園區', 4),
(89, '蘆竹區', 4),
(90, '竹南鎮', 7),
(91, '頭份市', 7),
(92, '三灣鄉', 7),
(93, '南庄鄉', 7),
(94, '獅潭鄉', 7),
(95, '後龍鎮', 7),
(96, '通霄鎮', 7),
(97, '苑裡鎮', 7),
(98, '苗栗市', 7),
(99, '造橋鄉', 7),
(100, '頭屋鄉', 7),
(101, '公館鄉', 7),
(102, '大湖鄉', 7),
(103, '泰安鄉', 7),
(104, '銅鑼鄉', 7),
(105, '三義鄉', 7),
(106, '西湖鄉', 7),
(107, '卓蘭鎮', 7),
(108, '中區', 8),
(109, '東區', 8),
(110, '南區', 8),
(111, '西區', 8),
(112, '北區', 8),
(113, '北屯區', 8),
(114, '西屯區', 8),
(115, '南屯區', 8),
(116, '太平區', 8),
(117, '大里區', 8),
(118, '霧峰區', 8),
(119, '烏日區', 8),
(120, '豐原區', 8),
(121, '后里區', 8),
(122, '石岡區', 8),
(123, '東勢區', 8),
(124, '和平區', 8),
(125, '新社區', 8),
(126, '潭子區', 8),
(127, '大雅區', 8),
(128, '神岡區', 8),
(129, '大肚區', 8),
(130, '沙鹿區', 8),
(131, '龍井區', 8),
(132, '梧棲區', 8),
(133, '清水區', 8),
(134, '大甲區', 8),
(135, '外埔區', 8),
(136, '大安區', 8),
(137, '彰化市', 9),
(138, '芬園鄉', 9),
(139, '花壇鄉', 9),
(140, '秀水鄉', 9),
(141, '鹿港鎮', 9),
(142, '福興鄉', 9),
(143, '線西鄉', 9),
(144, '和美鎮', 9),
(145, '伸港鄉', 9),
(146, '員林市', 9),
(147, '社頭鄉', 9),
(148, '永靖鄉', 9),
(149, '埔心鄉', 9),
(150, '溪湖鎮', 9),
(151, '大村鄉', 9),
(152, '埔鹽鄉', 9),
(153, '田中鎮', 9),
(154, '北斗鎮', 9),
(155, '田尾鄉', 9),
(156, '埤頭鄉', 9),
(157, '溪州鄉', 9),
(158, '竹塘鄉', 9),
(159, '二林鎮', 9),
(160, '大城鄉', 9),
(161, '芳苑鄉', 9),
(162, '二水鄉', 9),
(163, '南投市', 10),
(164, '中寮鄉', 10),
(165, '草屯鎮', 10),
(166, '國姓鄉', 10),
(167, '埔里鎮', 10),
(168, '仁愛鄉', 10),
(169, '名間鄉', 10),
(170, '集集鎮', 10),
(171, '水里鄉', 10),
(172, '魚池鄉', 10),
(173, '信義鄉', 10),
(174, '竹山鎮', 10),
(175, '鹿谷鄉', 10),
(176, '西區', 11),
(177, '東區', 11),
(178, '番路鄉', 12),
(179, '梅山鄉', 12),
(180, '竹崎鄉', 12),
(181, '阿里山鄉', 12),
(182, '中埔鄉', 12),
(183, '大埔鄉', 12),
(184, '水上鄉', 12),
(185, '鹿草鄉', 12),
(186, '太保市', 12),
(187, '朴子市', 12),
(188, '東石鄉', 12),
(189, '六腳鄉', 12),
(190, '新港鄉', 12),
(191, '民雄鄉', 12),
(192, '大林鎮', 12),
(193, '溪口鄉', 12),
(194, '義竹鄉', 12),
(195, '布袋鎮', 12),
(196, '斗南鎮', 13),
(197, '大埤鄉', 13),
(198, '虎尾鎮', 13),
(199, '土庫鎮', 13),
(200, '褒忠鄉', 13),
(201, '東勢鄉', 13),
(202, '臺西鄉', 13),
(203, '崙背鄉', 13),
(204, '麥寮鄉', 13),
(205, '斗六市', 13),
(206, '林內鄉', 13),
(207, '古坑鄉', 13),
(208, '莿桐鄉', 13),
(209, '西螺鎮', 13),
(210, '二崙鄉', 13),
(211, '北港鎮', 13),
(212, '水林鄉', 13),
(213, '口湖鄉', 13),
(214, '四湖鄉', 13),
(215, '元長鄉', 13),
(216, '中西區', 14),
(217, '東區', 14),
(218, '南區', 14),
(219, '北區', 14),
(220, '安平區', 14),
(221, '安南區', 14),
(222, '永康區', 14),
(223, '歸仁區', 14),
(224, '新化區', 14),
(225, '左鎮區', 14),
(226, '玉井區', 14),
(227, '楠西區', 14),
(228, '南化區', 14),
(229, '仁德區', 14),
(230, '關廟區', 14),
(231, '龍崎區', 14),
(232, '官田區', 14),
(233, '麻豆區', 14),
(234, '佳里區', 14),
(235, '西港區', 14),
(236, '七股區', 14),
(237, '將軍區', 14),
(238, '學甲區', 14),
(239, '北門區', 14),
(240, '新營區', 14),
(241, '後壁區', 14),
(242, '白河區', 14),
(243, '東山區', 14),
(244, '六甲區', 14),
(245, '下營區', 14),
(246, '柳營區', 14),
(247, '鹽水區', 14),
(248, '善化區', 14),
(249, '大內區', 14),
(250, '山上區', 14),
(251, '新市區', 14),
(252, '安定區', 14),
(253, '新興區', 15),
(254, '前金區', 15),
(255, '芩雅區', 15),
(256, '鹽埕區', 15),
(257, '鼓山區', 15),
(258, '旗津區', 15),
(259, '前鎮區', 15),
(260, '三民區', 15),
(261, '楠梓區', 15),
(262, '小港區', 15),
(263, '左營區', 15),
(264, '仁武區', 15),
(265, '大社區', 15),
(266, '岡山區', 15),
(267, '路竹區', 15),
(268, '阿蓮區', 15),
(269, '田寮區', 15),
(270, '燕巢區', 15),
(271, '橋頭區', 15),
(272, '梓官區', 15),
(273, '彌陀區', 15),
(274, '永安區', 15),
(275, '湖內區', 15),
(276, '鳳山區', 15),
(277, '大寮區', 15),
(278, '林園區', 15),
(279, '鳥松區', 15),
(280, '大樹區', 15),
(281, '旗山區', 15),
(282, '美濃區', 15),
(283, '六龜區', 15),
(284, '內門區', 15),
(285, '杉林區', 15),
(286, '甲仙區', 15),
(287, '桃源區', 15),
(288, '三民區', 15),
(289, '那瑪夏區', 15),
(290, '茂林區', 15),
(291, '茄萣區', 15),
(292, '馬公市', 20),
(293, '西嶼鄉', 20),
(294, '望安鄉', 20),
(295, '七美鄉', 20),
(296, '白沙鄉', 20),
(297, '湖西鄉', 20),
(298, '屏東市', 16),
(299, '三地門鄉', 16),
(300, '霧臺鄉', 16),
(301, '瑪家鄉', 16),
(302, '九如鄉', 16),
(303, '里港鄉', 16),
(304, '高樹鄉', 16),
(305, '盬埔鄉', 16),
(306, '長治鄉', 16),
(307, '麟洛鄉', 16),
(308, '竹田鄉', 16),
(309, '內埔鄉', 16),
(310, '萬丹鄉', 16),
(311, '潮州鎮', 16),
(312, '泰武鄉', 16),
(313, '來義鄉', 16),
(314, '萬巒鄉', 16),
(315, '崁頂鄉', 16),
(316, '新埤鄉', 16),
(317, '南州鄉', 16),
(318, '林邊鄉', 16),
(319, '東港鎮', 16),
(320, '琉球鄉', 16),
(321, '佳冬鄉', 16),
(322, '新園鄉', 16),
(323, '枋寮鄉', 16),
(324, '枋山鄉', 16),
(325, '春日鄉', 16),
(326, '獅子鄉', 16),
(327, '車城鄉', 16),
(328, '牡丹鄉', 16),
(329, '恆春鎮', 16),
(330, '滿州鄉', 16),
(331, '臺東市', 19),
(332, '綠島鄉', 19),
(333, '蘭嶼鄉', 19),
(334, '延平鄉', 19),
(335, '卑南鄉', 19),
(336, '鹿野鄉', 19),
(337, '關山鎮', 19),
(338, '海端鄉', 19),
(339, '池上鄉', 19),
(340, '東河鄉', 19),
(341, '成功鎮', 19),
(342, '長濱鄉', 19),
(343, '太麻里鄉', 19),
(344, '金峰鄉', 19),
(345, '大武鄉', 19),
(346, '達仁鄉', 19),
(347, '花蓮市', 18),
(348, '新城鄉', 18),
(349, '秀林鄉', 18),
(350, '吉安鄉', 18),
(351, '壽豐鄉', 18),
(352, '鳳林鎮', 18),
(353, '光復鄉', 18),
(354, '豐濱鄉', 18),
(355, '瑞穗鄉', 18),
(356, '萬榮鄉', 18),
(357, '玉里鎮', 18),
(358, '卓溪鄉', 18),
(359, '富里鄉', 18),
(360, '金沙鎮', 21),
(361, '金湖鎮', 21),
(362, '金寧鄉', 21),
(363, '金城鎮', 21),
(364, '烈嶼鄉', 21),
(365, '烏坵鄉', 21),
(366, '南竿鄉', 22),
(367, '北竿鄉', 22),
(368, '莒光鄉', 22),
(369, '東引鄉', 22);

-- --------------------------------------------------------

--
-- 資料表結構 `failed_jobs`
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
-- 資料表結構 `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_request_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `teacher_request_id`, `created_at`, `updated_at`) VALUES
(52, 6, 24, '2024-08-13 17:24:29', '2024-08-13 17:24:29'),
(54, 6, 26, '2024-08-13 17:31:50', '2024-08-13 17:31:50'),
(56, 6, 27, '2024-08-13 22:48:32', '2024-08-13 22:48:32'),
(57, 6, 28, '2024-08-13 23:58:54', '2024-08-13 23:58:54'),
(58, 6, 30, '2024-08-14 17:19:02', '2024-08-14 17:19:02'),
(59, 10, 32, '2024-08-15 17:12:10', '2024-08-15 17:12:10'),
(60, 6, 33, '2024-08-15 22:11:29', '2024-08-15 22:11:29');

-- --------------------------------------------------------

--
-- 資料表結構 `favorites_student`
--

CREATE TABLE `favorites_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `be_teachers_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `favorites_student`
--

INSERT INTO `favorites_student` (`id`, `user_id`, `be_teachers_id`, `created_at`, `updated_at`) VALUES
(9, 6, 4, '2024-08-12 23:22:33', '2024-08-12 23:22:33'),
(21, 6, 3, '2024-08-12 23:55:18', '2024-08-12 23:55:18'),
(22, 6, 6, '2024-08-12 23:55:20', '2024-08-12 23:55:20'),
(23, 6, 7, '2024-08-12 23:55:22', '2024-08-12 23:55:22'),
(24, 6, 8, '2024-08-12 23:55:23', '2024-08-12 23:55:23'),
(25, 6, 9, '2024-08-12 23:55:24', '2024-08-12 23:55:24'),
(26, 6, 11, '2024-08-13 22:54:38', '2024-08-13 22:54:38'),
(27, 6, 12, '2024-08-14 17:53:52', '2024-08-14 17:53:52'),
(28, 10, 13, '2024-08-15 17:25:50', '2024-08-15 17:25:50');

-- --------------------------------------------------------

--
-- 資料表結構 `jobs`
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
-- 資料表結構 `job_batches`
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
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_23_060701_add_fields_to_users_table', 2),
(5, '2024_08_02_071902_create_teacher_profiles_table', 3),
(6, '2024_08_06_013929_create_favorites_table', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `sessions`
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
-- 傾印資料表的資料 `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rMO7nx4WJPL8w8AQnkbD0LwO78sEzXucyNmiYYzw', 6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYURNUjRpckxkd2pSRnNSMGdSc3lER2FCOGxWNGhzVGRobGxvcWx2UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvTGVhcm5MaW5rL3B1YmxpYy9zdHVkZW50cHJvZmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvTGVhcm5MaW5rL3B1YmxpYy90ZWFjaGVycHJvZmlsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1723791624);

-- --------------------------------------------------------

--
-- 資料表結構 `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `education` text DEFAULT NULL,
  `introduction` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `student_profiles`
--

INSERT INTO `student_profiles` (`id`, `user_id`, `education`, `introduction`, `created_at`, `updated_at`) VALUES
(1, 6, 'asd', 'we', '2024-08-01 22:44:26', '2024-08-11 17:42:12');

-- --------------------------------------------------------

--
-- 資料表結構 `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, '數學'),
(2, '國語'),
(3, '英語'),
(4, '科學'),
(5, '社會'),
(6, '自然'),
(7, '物理'),
(8, '化學'),
(9, '生物'),
(10, '地理'),
(11, '歷史'),
(12, '體育'),
(13, '音樂'),
(14, '美術'),
(15, '政治'),
(16, '經濟學'),
(17, '哲學');

-- --------------------------------------------------------

--
-- 資料表結構 `teacher_calendars`
--

CREATE TABLE `teacher_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `text` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `detail_address` varchar(255) NOT NULL,
  `hourly_rate` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `teacher_calendars`
--

INSERT INTO `teacher_calendars` (`id`, `user_id`, `date`, `time`, `text`, `city`, `district`, `detail_address`, `hourly_rate`, `created_at`, `updated_at`) VALUES
(1, NULL, '2024-08-22', '03:15:00', '數學課', '彰化縣', '社頭鄉', '公益路國泰大樓', 99.00, '2024-08-11 18:54:43', '2024-08-11 18:54:43'),
(2, NULL, '2024-08-16', '05:25:00', '數學課', '苗栗縣', '三灣鄉', '公益路國泰大樓', 999.00, '2024-08-11 21:46:30', '2024-08-11 21:46:30'),
(3, NULL, '2024-08-15', '05:15:00', '數學課', '新竹市', '東區', '公益路國泰大樓', 99.00, '2024-08-11 22:05:30', '2024-08-11 22:05:30'),
(4, 12345, '2024-08-14', '05:20:00', '數學課', '新竹縣', '湖口鄉', '公益路國泰大樓', 99.00, '2024-08-11 22:07:24', '2024-08-11 22:07:24'),
(5, 6, '2024-08-15', '02:15:00', '數學課', '新竹縣', '芎林鄉', '公益路國泰大樓', 9.00, '2024-08-11 23:40:32', '2024-08-11 23:40:32'),
(11, 6, '2024-08-20', '04:25:00', '數學課', '桃園市', '楊梅區', '公益路國泰大樓', 999.00, '2024-08-11 23:54:18', '2024-08-11 23:54:18'),
(15, 6, '2024-08-22', '01:15:00', '測試身分2', '桃園市', '龍潭區', '123', 456.00, '2024-08-13 23:51:25', '2024-08-13 23:51:25'),
(16, 6, '2024-08-23', '06:20:00', 'ffffffffff', '基隆市', '仁愛區', '公益路國泰大樓', 999.00, '2024-08-14 00:00:28', '2024-08-14 00:00:28'),
(17, 6, '2024-08-28', '10:25:00', 'ffffffffff', '台中市', '烏日區', '公益路國泰大樓', 9999.00, '2024-08-14 00:00:28', '2024-08-14 00:00:28'),
(18, 6, '2024-08-23', '05:15:00', '測試身分2', '彰化縣', '大村鄉', '999', 888.00, '2024-08-14 00:08:49', '2024-08-14 00:08:49'),
(19, 6, '2024-08-21', '15:10:00', '0815-1', '台中市', '霧峰區', '公益路國泰大樓', 200.00, '2024-08-14 17:20:57', '2024-08-14 17:20:57'),
(21, 10, '2024-08-21', '02:10:00', '0815-2', '新竹市', '東區', '公益路國泰大樓', 200.00, '2024-08-14 18:11:14', '2024-08-14 18:11:14'),
(22, 10, '2024-08-22', '02:10:00', '0815-2', '新北市', '金山區', '公益路國泰大樓', 22.00, '2024-08-14 19:06:26', '2024-08-14 19:06:26'),
(23, 6, '2024-08-22', '05:15:00', '4555', '高雄市', '阿蓮區', 'fffff', 215919.00, '2024-08-14 19:07:05', '2024-08-14 19:07:05'),
(24, 10, '2024-08-22', '04:20:00', '0815-2', '宜蘭縣', '頭城鎮', '公益路國泰大樓', 25.00, '2024-08-14 21:46:28', '2024-08-14 21:46:28'),
(27, 10, '2024-08-21', '02:10:00', '測試存入接案人', '桃園市', '龍潭區', '公益路國泰大樓', 200.00, '2024-08-15 17:20:56', '2024-08-15 17:20:56'),
(28, 6, '2024-08-21', '13:10:00', '測試接案人存入1', '台中市', '后里區', '公益路國泰大樓', 200.00, '2024-08-15 17:27:08', '2024-08-15 17:27:08'),
(29, 6, '2024-08-27', '21:10:00', '01', '高雄市', '田寮區', 'ad', 11.00, '2024-08-15 22:14:10', '2024-08-15 22:14:10');

-- --------------------------------------------------------

--
-- 資料表結構 `teacher_profiles`
--

CREATE TABLE `teacher_profiles` (
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` longblob DEFAULT NULL,
  `pdf` longblob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `teacher_profiles`
--


-- --------------------------------------------------------

--
-- 資料表結構 `teacher_requests`
--

CREATE TABLE `teacher_requests` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject_id` varchar(255) NOT NULL,
  `available_time` longtext NOT NULL,
  `expected_date` date NOT NULL,
  `hourly_rate_min` int(11) NOT NULL,
  `hourly_rate_max` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`district_ids`)),
  `details` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('published','in_progress','completed','cancelled') NOT NULL DEFAULT 'published',
  `CaseReceiver` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `teacher_requests`
--

INSERT INTO `teacher_requests` (`user_id`, `id`, `title`, `subject_id`, `available_time`, `expected_date`, `hourly_rate_min`, `hourly_rate_max`, `city_id`, `district_ids`, `details`, `created_at`, `updated_at`, `status`, `CaseReceiver`) VALUES
(6, 23, 'qwwqwqqw', '3', '\"[\\\"\\\\u65e9\\\\u4e0a\\\",\\\"\\\\u4e0b\\\\u5348\\\"]\"', '2024-08-22', 1, 2, 15, '[\"254\",\"260\"]', 'qawqwq', '2024-08-07 18:39:39', '2024-08-07 18:39:39', 'published', 0),
(6, 24, '4555', '4', '早上, 下午', '2024-08-15', 100, 200, 15, '[\"254\",\"260\"]', 'gsdggsg', NULL, '2024-08-14 19:07:05', 'in_progress', 0),
(6, 25, 'qweq', '14', '早上, 下午, 晚上', '2024-08-21', 12, 1212, 15, '[\"254\"]', '1eqweqw', NULL, NULL, 'published', 0),
(6, 26, 'qweqwe', '14', '早上, 下午', '2024-08-21', 12, 121, 14, '[\"217\"]', 'qweqw', NULL, NULL, 'published', 0),
(10, 27, '測試身分2', '1', '早上, 下午, 晚上', '2024-08-15', 100, 200, 8, '[\"110\",\"116\"]', '測試身分2', NULL, '2024-08-13 23:51:25', 'in_progress', 0),
(10, 28, 'ffffffffff', '4', '早上, 下午', '2024-08-15', 66, 99, 12, '[\"179\",\"185\"]', 'fffff', NULL, '2024-08-14 00:00:28', 'in_progress', 0),
(10, 29, '0815', '4', '早上, 下午, 晚上', '2024-08-08', 100, 200, 12, '[\"179\",\"185\"]', '0815', NULL, NULL, 'published', 0),
(10, 30, '0815-1', '5', '早上, 下午, 晚上', '2024-08-17', 100, 200, 8, '[\"111\",\"117\"]', '0815-1', NULL, '2024-08-14 17:20:57', 'in_progress', 0),
(10, 31, 'ggggg', '4', '早上, 下午, 晚上', '2024-09-28', 200, 300, 6, '[\"65\",\"71\"]', 'fffff', NULL, NULL, 'published', 0),
(6, 32, '測試存入接案人', '2', '早上, 下午', '2024-08-23', 200, 500, 11, '[\"176\",\"177\"]', 'test', NULL, '2024-08-15 17:20:56', 'in_progress', 10),
(6, 33, '01', '13', '早上, 下午', '2024-08-23', 1, 12, 14, '[\"218\",\"224\"]', '12', NULL, '2024-08-15 22:14:10', 'in_progress', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) UNSIGNED DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `account`, `gender`, `phone`, `birthday`) VALUES
(6, '王大明', NULL, NULL, '$2y$12$GDfUqKnhSH9Nuo/qIcb9nOIIAIUfUvOB77XFnud.tQZ9WHoe2Al8i', NULL, '2024-07-29 07:40:30', '2024-07-29 07:40:30', 'A01', NULL, NULL, NULL),
(9, '小美', 'sean2000.cy@gmail.com', NULL, '$2y$12$Ece5J4Ygd1OPo9Hvb7tm7.K2fMTjNDkBWnSG9y6yME60v9nVhpE4a', NULL, '2024-08-12 14:01:46', '2024-08-13 11:43:51', 'AA01', 1, '1234564444', '2024-08-01'),
(10, '小美', 'tile.zip@gmail.com', NULL, '$2y$12$0SZ8x4VCt6fOVoY6GzQm6uYRzlwEWma1onX7.dynsAAexr95Sl1z.', NULL, '2024-08-13 14:24:01', '2024-08-14 00:39:11', 'BB02', 2, NULL, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `be_teachers`
--
ALTER TABLE `be_teachers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- 資料表索引 `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- 資料表索引 `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `children_card`
--
ALTER TABLE `children_card`
  ADD PRIMARY KEY (`children_id`),
  ADD KEY `children_card_user_id_foreign` (`user_id`);

--
-- 資料表索引 `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `contact_student`
--
ALTER TABLE `contact_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_student_teacher_requests_id_foreign` (`teacher_requests_id`),
  ADD KEY `contact_student_user_id_foreign` (`user_id`);

--
-- 資料表索引 `contact_teacher`
--
ALTER TABLE `contact_teacher`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `districts`
--
ALTER TABLE `districts`
  ADD KEY `fk_districts_cities` (`cities_id`);

--
-- 資料表索引 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- 資料表索引 `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_teacher_request_id_unique` (`user_id`,`teacher_request_id`),
  ADD KEY `favorites_teacher_request_id_foreign` (`teacher_request_id`);

--
-- 資料表索引 `favorites_student`
--
ALTER TABLE `favorites_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `be_teacher_id` (`be_teachers_id`),
  ADD KEY `favorites_student_user_id_foreign` (`user_id`);

--
-- 資料表索引 `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- 資料表索引 `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- 資料表索引 `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- 資料表索引 `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_profiles_user_id_foreign` (`user_id`);

--
-- 資料表索引 `teacher_calendars`
--
ALTER TABLE `teacher_calendars`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `teacher_profiles`
--
ALTER TABLE `teacher_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `teacher_profiles_user_id_foreign` (`user_id`);

--
-- 資料表索引 `teacher_requests`
--
ALTER TABLE `teacher_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teacher_requests_users` (`user_id`),
  ADD KEY `fk_teacher_requests_cities` (`city_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_account_unique` (`account`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `be_teachers`
--
ALTER TABLE `be_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `children_card`
--
ALTER TABLE `children_card`
  MODIFY `children_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_student`
--
ALTER TABLE `contact_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_teacher`
--
ALTER TABLE `contact_teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `favorites_student`
--
ALTER TABLE `favorites_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `teacher_calendars`
--
ALTER TABLE `teacher_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `teacher_profiles`
--
ALTER TABLE `teacher_profiles`
  MODIFY `profile_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `teacher_requests`
--
ALTER TABLE `teacher_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `children_card`
--
ALTER TABLE `children_card`
  ADD CONSTRAINT `children_card_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `contact_student`
--
ALTER TABLE `contact_student`
  ADD CONSTRAINT `contact_student_teacher_requests_id_foreign` FOREIGN KEY (`teacher_requests_id`) REFERENCES `teacher_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `fk_districts_cities` FOREIGN KEY (`cities_id`) REFERENCES `cities` (`id`);

--
-- 資料表的限制式 `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_teacher_request_id_foreign` FOREIGN KEY (`teacher_request_id`) REFERENCES `teacher_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `favorites_student`
--
ALTER TABLE `favorites_student`
  ADD CONSTRAINT `favorites_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `student_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `teacher_profiles`
--
ALTER TABLE `teacher_profiles`
  ADD CONSTRAINT `teacher_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 資料表的限制式 `teacher_requests`
--
ALTER TABLE `teacher_requests`
  ADD CONSTRAINT `fk_teacher_requests_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `fk_teacher_requests_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
