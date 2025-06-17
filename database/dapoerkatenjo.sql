-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2025 at 10:11 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dapoerkatenjo`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `ID_Kasir` int(11) NOT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  `email_kasir` varchar(100) DEFAULT NULL,
  `alamat_kasir` text,
  `no_tlp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`ID_Kasir`, `nama_kasir`, `email_kasir`, `alamat_kasir`, `no_tlp`) VALUES
(1, 'Dina Kasir', 'dina@resto.com', 'Jl. Merpati No. 1', '081234567891'),
(2, 'Andi Putra', 'andi@resto.com', 'Jl. Kenanga No. 2', '081234567892');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID_Menu` int(11) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID_Menu`, `nama_menu`, `harga`, `kategori`) VALUES
(1, 'Nasi Goreng', '20000.00', 'Makanan'),
(2, 'Ayam Bakar', '25000.00', 'Makanan'),
(3, 'Teh Manis', '5000.00', 'Minuman'),
(4, 'Jus Alpukat', '10000.00', 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_Pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_Pelanggan`, `nama_pelanggan`) VALUES
(1, 'Ahmad Ramadhan'),
(2, 'Siti Nurhaliza'),
(3, 'Budi Hartono');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_Pembayaran` int(11) NOT NULL,
  `ID_Transaksi` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status_pembayaran` varchar(50) DEFAULT NULL,
  `tunai` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID_Pembayaran`, `ID_Transaksi`, `metode_pembayaran`, `status_pembayaran`, `tunai`, `kembalian`) VALUES
(1, 1, 'Tunai', 'Lunas', 50000, 10000),
(2, 2, 'QRIS', 'Lunas', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `ID_Pesanan` int(11) NOT NULL,
  `ID_Transaksi` int(11) DEFAULT NULL,
  `ID_Menu` int(11) DEFAULT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`ID_Pesanan`, `ID_Transaksi`, `ID_Menu`, `jumlah_pesanan`, `harga_satuan`) VALUES
(1, 1, 1, 1, '20000.00'),
(2, 1, 4, 1, '10000.00'),
(3, 1, 2, 1, '25000.00'),
(4, 2, 3, 2, '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Pelanggan` int(11) DEFAULT NULL,
  `ID_Kasir` int(11) DEFAULT NULL,
  `status_pesanan` varchar(50) DEFAULT NULL,
  `waktu_pesanan` datetime DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Pelanggan`, `ID_Kasir`, `status_pesanan`, `waktu_pesanan`, `total_harga`) VALUES
(1, 1, 1, 'Selesai', '2025-06-10 10:30:00', '45000.00'),
(2, 2, 2, 'Selesai', '2025-06-10 11:00:00', '30000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_transaksi`
--
CREATE TABLE `v_detail_transaksi` (
`TransaksiID` int(11)
,`Tanggal` date
,`Waktu` time
,`Kasir` varchar(100)
,`Item` varchar(100)
,`Quantity` int(11)
,`HargaSatuan` decimal(10,2)
,`TotalItem` decimal(20,2)
,`Tunai` int(11)
,`Kembalian` decimal(21,2)
,`TotalBelanja` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v_detail_transaksi`
--
DROP TABLE IF EXISTS `v_detail_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_transaksi`  AS  select `t`.`ID_Transaksi` AS `TransaksiID`,cast(`t`.`waktu_pesanan` as date) AS `Tanggal`,cast(`t`.`waktu_pesanan` as time) AS `Waktu`,`k`.`nama_kasir` AS `Kasir`,`m`.`nama_menu` AS `Item`,`ps`.`jumlah_pesanan` AS `Quantity`,`ps`.`harga_satuan` AS `HargaSatuan`,(`ps`.`jumlah_pesanan` * `ps`.`harga_satuan`) AS `TotalItem`,`pb`.`tunai` AS `Tunai`,(`pb`.`tunai` - (`ps`.`jumlah_pesanan` * `ps`.`harga_satuan`)) AS `Kembalian`,(`ps`.`jumlah_pesanan` * `ps`.`harga_satuan`) AS `TotalBelanja` from ((((`transaksi` `t` join `kasir` `k` on((`t`.`ID_Kasir` = `k`.`ID_Kasir`))) join `pesanan` `ps` on((`t`.`ID_Transaksi` = `ps`.`ID_Transaksi`))) join `menu` `m` on((`ps`.`ID_Menu` = `m`.`ID_Menu`))) join `pembayaran` `pb` on((`t`.`ID_Transaksi` = `pb`.`ID_Transaksi`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`ID_Kasir`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID_Menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_Pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_Pembayaran`),
  ADD KEY `ID_Transaksi` (`ID_Transaksi`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`ID_Pesanan`),
  ADD KEY `ID_Transaksi` (`ID_Transaksi`),
  ADD KEY `ID_Menu` (`ID_Menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Pelanggan` (`ID_Pelanggan`),
  ADD KEY `ID_Kasir` (`ID_Kasir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `ID_Kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID_Menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_Pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID_Pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `ID_Pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`ID_Menu`) REFERENCES `menu` (`ID_Menu`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Pelanggan`) REFERENCES `pelanggan` (`ID_Pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Kasir`) REFERENCES `kasir` (`ID_Kasir`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
