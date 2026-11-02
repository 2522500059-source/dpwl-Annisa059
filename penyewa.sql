-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2026 at 10:41 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `user_plg059` varchar(50) NOT NULL,
  `sandi059` varchar(255) NOT NULL,
  `nik059` varchar(20) NOT NULL,
  `nm_lngkp059` varchar(100) NOT NULL,
  `no_hp059` varchar(20) NOT NULL,
  `almt_lngkp059` text NOT NULL,
  `ft_ktp` varchar(255) DEFAULT NULL,
  `ft_sim_a` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`user_plg059`, `sandi059`, `nik059`, `nm_lngkp059`, `no_hp059`, `almt_lngkp059`, `ft_ktp`, `ft_sim_a`) VALUES
('fakhril@atmaluhur.ac.id', '123', '12345567', 'fahri', '0883993593', 'bateng', 'KTP12345567.png', 'SIM12345567.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`user_plg059`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
