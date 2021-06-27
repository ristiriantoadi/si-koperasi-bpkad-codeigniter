-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2021 at 11:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpan_pinjam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `iuran_pokok` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat` varchar(20) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `tempat_tanggal_lahir` varchar(100) NOT NULL,
  `tanggal_nonaktif` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `status`, `iuran_pokok`, `id_bidang`, `nama`, `no_telepon`, `alamat`, `tanggal`, `no_ktp`, `tempat_tanggal_lahir`, `tanggal_nonaktif`) VALUES
(1, 'nonaktif', 0, 1, 'Ristirianto Adi', '081946690963', 'Karang Pule', '20-12-22', '1910910910901944', 'Surabaya, 24 Februari 1998', '2020-12-22'),
(2, 'aktif', 500000, 2, 'Wilham Reyyssan', '0878643321', 'BTN Kodya Asri', '20-12-22', '190191010111', 'Bima, 6 Desember 1998', '0000-00-00'),
(3, 'aktif', 500000, 1, 'Harry Potter', '10901910991', 'LAKLAklKA', '20-12-22', '121901992', 'London, 1 Januari 1990', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `id_pembiayaan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `id_pembiayaan`, `id_anggota`, `tanggal`, `jumlah_angsuran`) VALUES
(3, 3, 2, '2020-12-22', 5000000),
(4, 3, 2, '2020-12-22', 5000000),
(5, 4, 3, '2020-12-22', 5000000),
(6, 4, 3, '2020-12-22', 15000000);

-- --------------------------------------------------------

--
-- Table structure for table `biaya_admin`
--

CREATE TABLE `biaya_admin` (
  `id_biaya_admin` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biaya_admin`
--

INSERT INTO `biaya_admin` (`id_biaya_admin`, `jumlah`, `id_anggota`, `tanggal_transaksi`) VALUES
(1, 100000, 0, '2020-12-22'),
(2, 100000, 2, '2020-12-22'),
(3, 100000, 3, '2020-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nama_bidang`) VALUES
(1, 'Program'),
(2, 'Koperasi'),
(3, 'Keuangan'),
(4, 'Perbankan');

-- --------------------------------------------------------

--
-- Table structure for table `ijarah`
--

CREATE TABLE `ijarah` (
  `id_ijarah` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ijarah`
--

INSERT INTO `ijarah` (`id_ijarah`, `jumlah`, `id_anggota`, `tanggal_transaksi`) VALUES
(2, 100000, 2, '2020-12-22'),
(3, 100000, 2, '2020-12-22'),
(4, 200000, 3, '2020-12-22'),
(5, 200000, 3, '2020-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `iuran_wajib`
--

CREATE TABLE `iuran_wajib` (
  `id_iuran_wajib` int(11) NOT NULL,
  `jumlah_iuran_wajib` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iuran_wajib`
--

INSERT INTO `iuran_wajib` (`id_iuran_wajib`, `jumlah_iuran_wajib`, `id_anggota`, `tanggal_transaksi`) VALUES
(1, 200000, 1, '2020-12-22'),
(2, 200000, 1, '2020-12-22'),
(3, 200000, 1, '2020-12-22'),
(4, 200000, 2, '2020-12-22'),
(5, 200000, 3, '2020-12-22'),
(6, 200000, 3, '2020-12-25'),
(7, 200000, 0, '2020-12-22'),
(8, 200000, 2, '2020-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `master_biaya_admin`
--

CREATE TABLE `master_biaya_admin` (
  `jumlah_biaya_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_biaya_admin`
--

INSERT INTO `master_biaya_admin` (`jumlah_biaya_admin`) VALUES
(100000);

-- --------------------------------------------------------

--
-- Table structure for table `master_iuran_wajib`
--

CREATE TABLE `master_iuran_wajib` (
  `jumlah_iuran_wajib` int(11) NOT NULL,
  `id_iuran_wajib` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_iuran_wajib`
--

INSERT INTO `master_iuran_wajib` (`jumlah_iuran_wajib`, `id_iuran_wajib`) VALUES
(100000, 1),
(200000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pembiayaan`
--

CREATE TABLE `pembiayaan` (
  `id_pembiayaan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `status_pembiayaan` varchar(20) NOT NULL,
  `tanggal_pembiayaan` date NOT NULL,
  `jangka_waktu` int(11) NOT NULL,
  `ijarah` int(11) NOT NULL,
  `pengembalian_pokok` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembiayaan`
--

INSERT INTO `pembiayaan` (`id_pembiayaan`, `jumlah`, `id_anggota`, `status_pembiayaan`, `tanggal_pembiayaan`, `jangka_waktu`, `ijarah`, `pengembalian_pokok`, `keterangan`) VALUES
(4, 20000000, 3, 'Lunas', '2020-12-22', 4, 200000, 5000000, 'bayar uang masuk hogwarts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`);

--
-- Indexes for table `biaya_admin`
--
ALTER TABLE `biaya_admin`
  ADD PRIMARY KEY (`id_biaya_admin`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `ijarah`
--
ALTER TABLE `ijarah`
  ADD PRIMARY KEY (`id_ijarah`);

--
-- Indexes for table `iuran_wajib`
--
ALTER TABLE `iuran_wajib`
  ADD PRIMARY KEY (`id_iuran_wajib`);

--
-- Indexes for table `master_iuran_wajib`
--
ALTER TABLE `master_iuran_wajib`
  ADD PRIMARY KEY (`id_iuran_wajib`);

--
-- Indexes for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD PRIMARY KEY (`id_pembiayaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `biaya_admin`
--
ALTER TABLE `biaya_admin`
  MODIFY `id_biaya_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ijarah`
--
ALTER TABLE `ijarah`
  MODIFY `id_ijarah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `iuran_wajib`
--
ALTER TABLE `iuran_wajib`
  MODIFY `id_iuran_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_iuran_wajib`
--
ALTER TABLE `master_iuran_wajib`
  MODIFY `id_iuran_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  MODIFY `id_pembiayaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
