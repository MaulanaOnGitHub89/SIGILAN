-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2018 at 01:41 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrianloket`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_param`
--

CREATE TABLE `mst_param` (
  `id_param` int(11) NOT NULL,
  `param_name` varchar(100) NOT NULL,
  `param_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_param`
--

INSERT INTO `mst_param` (`id_param`, `param_name`, `param_value`) VALUES
(1, 'BLINK', 'F'),
(2, 'BLINK_ADMIN', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `runningtext`
--

CREATE TABLE `runningtext` (
  `id_runnungtext` int(11) NOT NULL,
  `textdesc` varchar(500) NOT NULL,
  `activeflag` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trx_counter`
--

CREATE TABLE `trx_counter` (
  `id_loket` int(11) NOT NULL,
  `loket_name` varchar(100) NOT NULL,
  `officer_name` varchar(100) NOT NULL,
  `queue_prefix` varchar(1) NOT NULL,
  `queue_number` int(11) NOT NULL,
  `call_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blink_flag` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_counter`
--

INSERT INTO `trx_counter` (`id_loket`, `loket_name`, `officer_name`, `queue_prefix`, `queue_number`, `call_time`, `blink_flag`) VALUES
(1, 'CUSTOMER SERVICE 1', 'AGOESMAN', 'A', 0, '2018-11-10 18:39:39', 'F'),
(2, 'CUSTOMER SERVICE 2', 'AKBAR', 'A', 0, '2018-11-10 18:18:21', 'F'),
(3, 'CUSTOMER SERVICE 3', 'VANDIGA', 'A', 0, '2018-11-10 18:18:20', 'F'),
(4, 'PENGAMBILAN PASPOR', 'IVAN', 'C', 0, '2018-11-10 19:39:31', 'F'),
(5, 'LAYANAN WNI', 'YANI', 'B', 0, '2018-11-10 19:40:06', 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_param`
--
ALTER TABLE `mst_param`
  ADD PRIMARY KEY (`id_param`),
  ADD UNIQUE KEY `MST_PARAM_IDX01` (`param_name`);

--
-- Indexes for table `runningtext`
--
ALTER TABLE `runningtext`
  ADD PRIMARY KEY (`id_runnungtext`);

--
-- Indexes for table `trx_counter`
--
ALTER TABLE `trx_counter`
  ADD PRIMARY KEY (`id_loket`),
  ADD UNIQUE KEY `LOKET_NAME_IDX01` (`loket_name`),
  ADD KEY `blink_flag` (`blink_flag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_param`
--
ALTER TABLE `mst_param`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `runningtext`
--
ALTER TABLE `runningtext`
  MODIFY `id_runnungtext` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_counter`
--
ALTER TABLE `trx_counter`
  MODIFY `id_loket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
