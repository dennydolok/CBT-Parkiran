-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2019 at 03:06 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simparkir`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan`
-- (See below for the actual view)
--
CREATE TABLE `laporan` (
`kd_parkir` varchar(5)
,`no_kendaraan` varchar(11)
,`jenis_kendaraan` varchar(8)
,`jam_masuk` time
,`jam_keluar` varchar(15)
,`nama_penjaga` varchar(150)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `kd_admin` varchar(11) NOT NULL,
  `nama_admin` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `shift` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`kd_admin`, `nama_admin`, `username`, `password`, `shift`) VALUES
('12wewe', 'sechan', 'sechan', 'syadat', 2),
('AD88', 'Denny', 'admin', 'admin1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parkiran`
--

CREATE TABLE `tbl_parkiran` (
  `kd_parkir` varchar(5) NOT NULL,
  `status` varchar(9) NOT NULL,
  `jenis` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_parkiran`
--

INSERT INTO `tbl_parkiran` (`kd_parkir`, `status`, `jenis`) VALUES
('SS25', 'selesai', 'Mobil'),
('SS51', 'selesai', 'Motor'),
('SS52', 'ada', 'Mobil'),
('SS9', 'selesai', 'Mobil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengendara`
--

CREATE TABLE `tbl_pengendara` (
  `no_kendaraan` varchar(11) NOT NULL,
  `kd_parkir` varchar(5) NOT NULL,
  `jenis_kendaraan` varchar(8) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` varchar(15) NOT NULL,
  `status` varchar(9) NOT NULL,
  `jumlah_jam` int(5) NOT NULL,
  `kd_penjaga` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengendara`
--

INSERT INTO `tbl_pengendara` (`no_kendaraan`, `kd_parkir`, `jenis_kendaraan`, `jam_masuk`, `jam_keluar`, `status`, `jumlah_jam`, `kd_penjaga`) VALUES
('F 000 gf', 'SS51', 'Motor', '19:45:00', '19:47', 'selesai', 19, 'PP128'),
('F 0001 GG', 'SS25', 'Mobil', '09:02:00', '09:02', 'selesai', 9, 'PP48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjaga`
--

CREATE TABLE `tbl_penjaga` (
  `kd_penjaga` varchar(11) NOT NULL,
  `nama_penjaga` varchar(150) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `shift` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjaga`
--

INSERT INTO `tbl_penjaga` (`kd_penjaga`, `nama_penjaga`, `username`, `password`, `shift`) VALUES
('PP128', 'Sechan', 'admin', 'admin', 1),
('PP48', 'Denny', 'admin', 'admin1', 2);

-- --------------------------------------------------------

--
-- Structure for view `laporan`
--
DROP TABLE IF EXISTS `laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan`  AS  select `tbl_pengendara`.`kd_parkir` AS `kd_parkir`,`tbl_pengendara`.`no_kendaraan` AS `no_kendaraan`,`tbl_pengendara`.`jenis_kendaraan` AS `jenis_kendaraan`,`tbl_pengendara`.`jam_masuk` AS `jam_masuk`,`tbl_pengendara`.`jam_keluar` AS `jam_keluar`,`tbl_penjaga`.`nama_penjaga` AS `nama_penjaga` from (`tbl_penjaga` join `tbl_pengendara` on((`tbl_penjaga`.`kd_penjaga` = `tbl_penjaga`.`kd_penjaga`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`kd_admin`);

--
-- Indexes for table `tbl_parkiran`
--
ALTER TABLE `tbl_parkiran`
  ADD PRIMARY KEY (`kd_parkir`);

--
-- Indexes for table `tbl_pengendara`
--
ALTER TABLE `tbl_pengendara`
  ADD PRIMARY KEY (`no_kendaraan`);

--
-- Indexes for table `tbl_penjaga`
--
ALTER TABLE `tbl_penjaga`
  ADD PRIMARY KEY (`kd_penjaga`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
