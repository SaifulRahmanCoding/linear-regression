-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 07:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dm_lr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_testing`
--

CREATE TABLE `tb_testing` (
  `id_test` int(11) NOT NULL,
  `x_test` double NOT NULL,
  `y_test` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_testing`
--

INSERT INTO `tb_testing` (`id_test`, `x_test`, `y_test`) VALUES
(1, 30, 19.78),
(2, 20.525641025641, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training`
--

CREATE TABLE `tb_training` (
  `id` int(11) NOT NULL,
  `x` double DEFAULT NULL,
  `y` double DEFAULT NULL,
  `xx` double DEFAULT NULL,
  `yy` double DEFAULT NULL,
  `xy` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_training`
--

INSERT INTO `tb_training` (`id`, `x`, `y`, `xx`, `yy`, `xy`) VALUES
(1, 24, 10, 576, 100, 240),
(2, 22, 5, 484, 25, 110),
(3, 21, 6, 441, 36, 126),
(4, 20, 3, 400, 9, 60),
(5, 22, 6, 484, 36, 132),
(6, 19, 4, 361, 16, 76),
(7, 20, 5, 400, 25, 100),
(8, 23, 9, 529, 81, 207),
(9, 24, 11, 576, 121, 264),
(10, 25, 13, 625, 169, 325);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_testing`
--
ALTER TABLE `tb_testing`
  ADD PRIMARY KEY (`id_test`);

--
-- Indexes for table `tb_training`
--
ALTER TABLE `tb_training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_testing`
--
ALTER TABLE `tb_testing`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_training`
--
ALTER TABLE `tb_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
