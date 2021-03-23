-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 03:48 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pra-ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kelas` char(5) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL,
  `almamater` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kelas`, `kompetensi_keahlian`, `almamater`) VALUES
(1, 'XII RPL 1', 'XII', 'RPL', 1),
(2, 'XII RPL 2', 'XII', 'RPL', 2),
(3, 'XII RPL 3', 'XII', 'RPL', 3),
(4, 'XII TKJ 1', 'XII', 'TKJ', 1),
(5, 'XII TKJ 2', 'XII', 'TKJ', 2),
(6, 'XII TKJ 3', 'XII', 'TKJ', 3),
(7, 'XII TEI 1', 'XII', 'TEI', 1),
(8, 'XII TEI 2', 'XII', 'TEI', 2),
(9, 'XII TEI 3', 'XII', 'TEI', 3),
(10, 'XII TEI 4', 'XII', 'TEI', 4),
(11, 'XII TKRO 1', 'XII', 'TKRO', 1),
(12, 'XII TKRO 2', 'XII', 'TKRO', 2),
(13, 'XII TKRO 3', 'XII', 'TKRO', 3),
(14, 'XII TBSM 1', 'XII', 'TBSM', 1),
(15, 'XII TBSM 2', 'XII', 'TBSM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_dibayar` date NOT NULL,
  `bulan_dibayar` varchar(30) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `tgl_dibayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES
(1, 1, '1234567890', '2021-02-28', '2020-07-01', 'Juli', '2020', 1, 75000),
(3, 1, '1234567890', '2021-02-28', '2020-08-01', 'Agustus', '2020', 1, 75000),
(5, 1, '1234567892', '2021-02-28', '2020-07-01', 'Juli', '2020', 2, 100000),
(7, 1, '1234567891', '2021-02-28', '2020-07-01', 'Juli', '2020', 1, 75000),
(8, 1, '1234567891', '2021-02-28', '2020-08-01', 'Agustus', '2020', 1, 75000),
(9, 1, '1234567890', '2021-03-01', '2020-09-01', 'September', '2020', 1, 75000),
(10, 1, '1234567890', '2021-03-01', '2020-10-01', 'Oktober', '2020', 1, 75000),
(11, 1, '1234567890', '2021-03-01', '2020-11-01', 'November', '2020', 1, 75000),
(12, 1, '1234567890', '2021-03-01', '2020-12-01', 'Desember', '2020', 1, 75000),
(13, 1, '1234567890', '2021-03-01', '2021-01-01', 'Januari', '2021', 1, 75000),
(14, 1, '1234567890', '2021-03-01', '2021-02-01', 'Februari', '2021', 1, 75000),
(15, 1, '1234567890', '2021-03-01', '2021-03-01', 'Maret', '2021', 1, 75000),
(16, 1, '1234567890', '2021-03-01', '2021-04-01', 'April', '2021', 1, 75000),
(17, 1, '1234567890', '2021-03-01', '2021-05-01', 'Mei', '2021', 1, 75000),
(18, 1, '1234567890', '2021-03-01', '2021-06-01', 'Juni', '2021', 1, 75000),
(19, 1, '1234567890', '2021-03-01', '2021-07-01', 'Juli', '2021', 1, 75000),
(21, 2, '1234567892', '2021-03-01', '2020-08-01', 'Agustus', '2020', 2, 100000),
(22, 2, '1234567892', '2021-03-01', '2020-09-01', 'September', '2020', 2, 100000),
(23, 2, '1234567890', '2021-03-01', '2021-08-01', 'Agustus', '2021', 1, 75000),
(24, 1, '1234567896', '2021-03-01', '2020-07-01', 'Juli', '2020', 2, 100000),
(25, 1, '1234567896', '2021-03-01', '2020-08-01', 'Agustus', '2020', 2, 100000),
(26, 1, '1234567890', '2021-03-01', '2021-09-01', 'September', '2021', 1, 75000),
(27, 1, '1234567890', '2021-03-23', '2021-10-01', 'Oktober', '2021', 1, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Admin Testing', 'admin'),
(2, 'petugas', '202cb962ac59075b964b07152d234b70', 'Petugas Testing', 'petugas'),
(3, 'rfqgal', '202cb962ac59075b964b07152d234b70', 'Rifky', 'admin'),
(4, 'rifkigal', '202cb962ac59075b964b07152d234b70', 'Galuh', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`) VALUES
('1234567890', '12345670', 'Rifky Galuh', 1, 'Sukoraharjo', '081234567890', 1),
('1234567891', '12345671', 'Nadila', 1, 'Gandusari', '081234567891', 1),
('1234567892', '12345672', 'Rendi', 4, 'G. Kawi', '081234567892', 2),
('1234567893', '12345673', 'Risnu', 7, 'Kepanjen', '081234567893', 3),
('1234567894', '12345674', 'Mita', 5, 'Ketawang', '081234567894', 2),
('1234567895', '12345675', 'Bagas', 1, 'G. Kawi', '081234567895', 2),
('1234567896', '12345676', 'Dikky', 12, 'Talangagung', '081234567896', 2),
('1234567897', '12345677', 'Maulana', 14, 'Ardirejo', '081234567897', 3);

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2021, 75000),
(2, 2020, 100000),
(3, 2019, 150000),
(4, 2018, 200000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `nis` (`nis`) USING BTREE,
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
