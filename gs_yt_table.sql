-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 6 月 01 日 11:21
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_yt_table`
--

CREATE TABLE `gs_yt_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(128) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `unread` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_yt_table`
--

INSERT INTO `gs_yt_table` (`id`, `title`, `URL`, `date`, `unread`) VALUES
(1, 'あああ', 'vpha_NxXFUI', '2022-06-01 13:00:12', '1'),
(2, 'aaa', 'kJjDLVxQjtA', '2022-06-01 14:10:23', '1'),
(3, '川瀬名人', 'Vwb1TWRv7eI', '2022-06-01 15:21:35', NULL),
(4, '東野VS川原(天竺鼠)', 'vpha_NxXFUI', '2022-06-01 15:35:26', '1'),
(5, '東野VS国崎', '3P6D9GdYzck', '2022-06-01 15:48:47', NULL),
(6, 'ランジャタイvsNY', '6X-6kZTJsYg', '2022-06-01 15:49:25', '1'),
(7, 'ニューヨーク', '6X-6kZTJsYg', '2022-06-01 16:03:59', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_yt_table`
--
ALTER TABLE `gs_yt_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_yt_table`
--
ALTER TABLE `gs_yt_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
