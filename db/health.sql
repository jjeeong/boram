-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-10-21 14:47
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `boram`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `health`
--

CREATE TABLE `health` (
  `num` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `type` int(2) NOT NULL,
  `count` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `health`
--

INSERT INTO `health` (`num`, `id`, `type`, `count`, `start_time`, `end_time`, `start_date`, `end_date`) VALUES
(25, 'user', 1, 16, '21:45:54', '21:46:37', '2023-10-21', '2023-10-21'),
(26, 'user', 1, 16, '21:45:54', '21:47:04', '2023-10-21', '2023-10-21');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `health`
--
ALTER TABLE `health`
  ADD PRIMARY KEY (`num`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `health`
--
ALTER TABLE `health`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
