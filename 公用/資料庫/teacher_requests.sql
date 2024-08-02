-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-02 08:00:10
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
-- 資料表結構 `teacher_requests`
--

CREATE TABLE `teacher_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject_id` varchar(255) NOT NULL,
  `available_time` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`available_time`)),
  `expected_date` date NOT NULL,
  `hourly_rate_min` int(11) NOT NULL,
  `hourly_rate_max` int(11) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `district_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`district_ids`)),
  `details` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `teacher_requests`
--

INSERT INTO `teacher_requests` (`id`, `title`, `subject_id`, `available_time`, `expected_date`, `hourly_rate_min`, `hourly_rate_max`, `city_id`, `district_ids`, `details`, `created_at`, `updated_at`) VALUES
(1, '999', '0', '[\"morning\"]', '2024-08-14', 55, 66, 9, '[\"139\",\"152\"]', '999', '2024-07-31 14:27:43', '2024-07-31 14:27:43'),
(2, 'cccc', '0', '[\"afternoon\",\"evening\"]', '2024-08-20', 20, 30, 14, '[\"231\"]', '165165', '2024-07-31 17:20:17', '2024-07-31 17:20:17'),
(3, '國小數學', '0', '[\"morning\",\"afternoon\"]', '2024-08-02', 500, 700, 8, '[\"116\",\"117\"]', '國小5年級數學 學生個性好動，性別男 希望長期', '2024-07-31 17:38:04', '2024-07-31 17:38:04'),
(4, '高中科學', '0', '[\"morning\",\"evening\"]', '2024-08-15', 100, 200, 8, '[\"119\",\"125\"]', '希望可以先試教後再決定', '2024-07-31 17:39:06', '2024-07-31 17:39:06'),
(5, '國中英文', '0', '[\"afternoon\"]', '2024-08-20', 500, 870, 14, '[\"219\",\"220\"]', '歡迎外國人', '2024-07-31 17:39:51', '2024-07-31 17:39:51'),
(6, '找考前衝刺連續7天', '0', '[\"evening\"]', '2024-08-09', 1000, 1200, 1, '[\"3\"]', '希望老師女生', '2024-07-31 17:40:52', '2024-07-31 17:40:52'),
(7, '4444', '5', '\"[\\\"afternoon\\\",\\\"evening\\\"]\"', '2024-08-21', 1, 3, 3, '\"[\\\"14\\\",\\\"15\\\"]\"', '333', '2024-08-01 13:39:30', '2024-08-01 13:39:30'),
(8, '國中生物', '9', '\"[\\\"afternoon\\\",\\\"evening\\\"]\"', '2024-08-14', 20, 30, 11, '\"[\\\"176\\\",\\\"177\\\"]\"', '暑假期間每周一天教學', '2024-08-01 21:58:36', '2024-08-01 21:58:36');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `teacher_requests`
--
ALTER TABLE `teacher_requests`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `teacher_requests`
--
ALTER TABLE `teacher_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
