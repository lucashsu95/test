-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-15 07:30:52
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `49web01`
--

-- --------------------------------------------------------

--
-- 資料表結構 `active`
--

CREATE TABLE `active` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `udesc` varchar(30) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `signUp` varchar(30) DEFAULT NULL,
  `isTop` tinyint(1) NOT NULL,
  `isShow` tinyint(1) NOT NULL,
  `template_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `active`
--

INSERT INTO `active` (`id`, `name`, `date`, `udesc`, `link`, `image`, `signUp`, `isTop`, `isShow`, `template_id`) VALUES
(12, 'abc', '2023-03-18', 'testse', 'setsets', 'img/20230314130303.jpg', 'tsetet', 0, 1, '6'),
(13, 'test2', '2023-03-14', 'test2', 'klikkk', 'img/20230314131733.jpg', 'tset2', 1, 0, '6'),
(14, '聽下雨的聲音', '2023-03-13', '這是一首好歌', '無', 'img/20230315011433.jpg', '呵呵呵', 0, 0, '4');

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `account` varchar(30) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(30) NOT NULL,
  `utype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `record`
--

INSERT INTO `record` (`id`, `account`, `time`, `action`, `utype`) VALUES
(1, 'admin', '2023-03-14 07:15:23', '登出', '成功'),
(2, 'admin', '2023-03-14 07:15:32', '登入', '失敗'),
(3, 'admin', '2023-03-14 07:15:45', '登入', '成功'),
(4, NULL, '2023-03-14 07:16:07', '登入', '失敗'),
(5, 'admin', '2023-03-14 07:16:08', '登出', '成功'),
(6, 'admin', '2023-03-14 07:18:01', '登入', '失敗'),
(7, 'admin', '2023-03-14 07:55:49', '登入', '失敗'),
(8, 'admin', '2023-03-14 07:56:04', '登入', '成功'),
(9, 'admin', '2023-03-15 03:54:33', '登出', '成功'),
(10, 'admin', '2023-03-15 03:54:53', '登入', '成功'),
(11, 'admin', '2023-03-15 03:57:04', '登出', '成功');

-- --------------------------------------------------------

--
-- 資料表結構 `sno`
--

CREATE TABLE `sno` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `num` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `sno`
--

INSERT INTO `sno` (`id`, `title`, `num`) VALUES
(1, 'a', 2),
(2, 'u', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `template` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`template`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `template`
--

INSERT INTO `template` (`id`, `template`) VALUES
(1, '[\"name\",\"udesc\",\"date\",\"link\",\"image\",\"signUp\"]'),
(3, '[\"name\",\"udesc\",\"date\",\"link\",\"signUp\",\"image\"]'),
(4, '[\"name\",\"date\",\"udesc\",\"link\",\"signUp\",\"image\"]'),
(5, '[\"name\",\"date\",\"udesc\",\"signUp\",\"image\",\"link\"]'),
(6, '[\"image\",\"udesc\",\"date\",\"link\",\"signUp\",\"name\"]');

-- --------------------------------------------------------

--
-- 資料表結構 `timecount`
--

CREATE TABLE `timecount` (
  `id` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `timecount`
--

INSERT INTO `timecount` (`id`, `time`) VALUES
(1, 9999999);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `account` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `rec_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `account`, `password`, `role`, `rec_id`) VALUES
(1, '管理者', 'admin', '1234', '管理員', 'a0000'),
(2, 'abc', 'admin2', '12345', '會員', 'u0001'),
(3, 'test', 'admin3', '123456', '會員', 'u0002'),
(4, 'test2', 'admin4', '1234567', '管理員', 'a0001');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `active`
--
ALTER TABLE `active`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sno`
--
ALTER TABLE `sno`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `timecount`
--
ALTER TABLE `timecount`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `active`
--
ALTER TABLE `active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sno`
--
ALTER TABLE `sno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `timecount`
--
ALTER TABLE `timecount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
