-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 03:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesanmakanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_admin`
--

CREATE TABLE `db_admin` (
  `id_adm` int(11) NOT NULL,
  `useradmin` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_admin`
--

INSERT INTO `db_admin` (`id_adm`, `useradmin`, `passwd`, `role`) VALUES
(1, 'ArilTEkobang23', 'EKBANGArilTrumpi23', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `db_cust`
--

CREATE TABLE `db_cust` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_cust`
--

INSERT INTO `db_cust` (`id`, `nama`, `telp`, `email`, `pass`) VALUES
(7, 'Fatur', '123', 'faturpohontu954@gmail.com', '$2y$10$O3IQfEE9NyBsgRvwVh9zXOl8T9Jv1ALw0n7dU5a5TfiotYbOE9fMa'),
(9, 'syakir', '0812345678', 'syakiralhasni77@gmail.com', '$2y$10$qzqjYC.9OjUp./j70waDQejTUCJFrGpnb/W6XlkEyVU/imGmT35dC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `Deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `nama`, `harga`, `Deskripsi`, `gambar`) VALUES
(1, 'Rice Bowl Mie Nuget', 10000, 'Yang Atas Isi : Ketimun, Mie, Nuget', 'rb.jpeg'),
(2, 'Rice Bowl Ayam Kecap', 10000, 'Isi : Nasi, Ayam, Ketimun, Sayur', 'rbb.jpeg'),
(3, 'Rice Bowl Mie Telur', 10000, 'Yang Bawah Isi : Mie, Telur, Sosis, Sayur', 'rb.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trx` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `customer` int(11) DEFAULT NULL,
  `jumlah` int(3) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('diterima','diantar','pending','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_trx`, `barang`, `customer`, `jumlah`, `total`, `tanggal`, `status`) VALUES
(20, 1, 7, 2, 20000, '2024-12-24 00:32:34', 'selesai'),
(22, 1, 9, 1, 10000, '2024-12-24 01:08:32', 'selesai'),
(23, 2, 7, 3, 30000, '2024-12-24 01:43:32', 'selesai'),
(24, 3, 7, 2, 20000, '2024-12-24 03:04:54', 'diterima');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_admin`
--
ALTER TABLE `db_admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `db_cust`
--
ALTER TABLE `db_cust`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trx`),
  ADD KEY `transaksi_ibfk_2` (`customer`),
  ADD KEY `transaksi_ibfk_1` (`barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_admin`
--
ALTER TABLE `db_admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_cust`
--
ALTER TABLE `db_cust`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`barang`) REFERENCES `tb_barang` (`id_brg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `db_cust` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
