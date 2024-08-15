-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-15 04:52:52
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
(4, 24, 6, '2024-08-13 22:27:36', '2024-08-13 22:27:36'),
(6, 23, 6, '2024-08-14 17:12:40', '2024-08-14 17:12:40'),
(7, 26, 6, '2024-08-14 18:09:29', '2024-08-14 18:09:29'),
(8, 25, 6, '2024-08-14 18:09:31', '2024-08-14 18:09:31');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `contact_student`
--
ALTER TABLE `contact_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_student_teacher_requests_id_foreign` (`teacher_requests_id`),
  ADD KEY `contact_student_user_id_foreign` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_student`
--
ALTER TABLE `contact_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `contact_student`
--
ALTER TABLE `contact_student`
  ADD CONSTRAINT `contact_student_teacher_requests_id_foreign` FOREIGN KEY (`teacher_requests_id`) REFERENCES `teacher_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
