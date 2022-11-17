-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2022 pada 14.43
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`nama`, `harga`, `jumlah`, `kode_barang`) VALUES
('Sempak', 5000, 10, 'BR004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_km`
--

CREATE TABLE `barang_km` (
  `id_barang` int(5) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jumlah_rusak` int(11) NOT NULL,
  `keterangan` enum('Masuk','Keluar','Rusak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_km`
--

INSERT INTO `barang_km` (`id_barang`, `kode_barang`, `jumlah_masuk`, `jumlah_keluar`, `tgl_masuk`, `tgl_keluar`, `jumlah_rusak`, `keterangan`) VALUES
(186, 'BR001', 2, 0, '2022-06-25', '0000-00-00', 0, 'Masuk'),
(187, 'BR002', 2, 0, '2022-06-25', '0000-00-00', 0, 'Masuk'),
(188, 'BR003', 0, 0, '2022-06-25', '0000-00-00', 0, 'Masuk'),
(189, 'BR004', 0, 7, '2022-06-25', '0000-00-00', 0, 'Keluar'),
(190, 'BR003', 5, 0, '2022-06-25', '0000-00-00', 0, 'Masuk'),
(191, 'BR004', 0, 8, '0000-00-00', '2022-06-25', 0, 'Keluar'),
(192, 'BR004', 0, 2, '0000-00-00', '2022-07-19', 0, 'Keluar'),
(193, 'BR004', 0, 2, '0000-00-00', '2022-07-25', 0, 'Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disbarang`
--

CREATE TABLE `disbarang` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama`) VALUES
(1, 'Admin'),
(2, 'Kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_waktu` date NOT NULL,
  `waktu` time NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `nama_kasir` varchar(50) NOT NULL,
  `cust` varchar(30) NOT NULL,
  `bayar` int(11) NOT NULL,
  `ket` enum('Cash','Transfer') NOT NULL,
  `kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_waktu`, `waktu`, `nomor`, `total`, `nama_kasir`, `cust`, `bayar`, `ket`, `kembali`) VALUES
(207, '2022-06-19', '23:51:21', 'TR06-', 0, 'RiffaShop Tenggarong', '', 0, 'Transfer', 0),
(208, '2022-06-20', '00:07:52', 'TR06-207', 0, 'RiffaShop Tenggarong', '', 0, 'Transfer', 0),
(209, '2022-06-20', '12:30:09', 'TR06-208', 282888, 'RiffaShop Tenggarong', '', 0, 'Cash', -282888),
(210, '2022-06-20', '12:30:45', 'TR06-209', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(211, '2022-06-20', '12:31:14', 'TR06-210', 287888, 'RiffaShop Tenggarong', 'uuu', 287888, 'Transfer', 0),
(212, '2022-06-20', '12:31:50', 'TR06-211', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(213, '2022-06-20', '12:32:08', 'TR06-212', 284888, 'RiffaShop Tenggarong', '', 0, 'Cash', -284888),
(214, '2022-06-20', '12:32:21', 'TR06-213', 284888, 'RiffaShop Tenggarong', '', 284888, 'Transfer', 0),
(215, '2022-06-20', '12:34:34', 'TR06-214', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(216, '2022-06-20', '12:35:10', 'TR06-215', 286888, 'RiffaShop Tenggarong', '', 0, 'Cash', -286888),
(217, '2022-06-20', '12:40:18', 'TR06-216', 281888, 'RiffaShop Tenggarong', 'ww', 281888, 'Transfer', 0),
(218, '2022-06-20', '12:40:30', 'TR06-217', 285888, 'RiffaShop Tenggarong', '', 0, 'Cash', -285888),
(219, '2022-06-20', '12:42:00', 'TR06-218', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(220, '2022-06-20', '12:42:09', 'TR06-219', 282888, 'RiffaShop Tenggarong', '', 0, 'Cash', -282888),
(221, '2022-06-20', '12:42:26', 'TR06-220', 287888, 'RiffaShop Tenggarong', 'rr', 287888, 'Transfer', 0),
(222, '2022-06-20', '12:42:40', 'TR06-221', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(223, '2022-06-20', '12:43:37', 'TR06-222', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(224, '2022-06-20', '12:43:52', 'TR06-223', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(225, '2022-06-20', '12:44:29', 'TR06-224', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(226, '2022-06-20', '12:44:33', 'TR06-225', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(227, '2022-06-20', '12:45:01', 'TR06-226', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(228, '2022-06-20', '12:45:03', 'TR06-227', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(229, '2022-06-20', '12:45:03', 'TR06-228', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(230, '2022-06-20', '12:45:04', 'TR06-229', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(231, '2022-06-20', '12:45:04', 'TR06-230', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(232, '2022-06-20', '12:45:05', 'TR06-231', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(233, '2022-06-20', '12:45:05', 'TR06-232', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(234, '2022-06-20', '12:45:06', 'TR06-233', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(235, '2022-06-20', '12:45:07', 'TR06-234', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(236, '2022-06-20', '12:45:07', 'TR06-235', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(237, '2022-06-20', '12:45:08', 'TR06-236', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(238, '2022-06-20', '12:45:09', 'TR06-237', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(239, '2022-06-20', '12:45:09', 'TR06-238', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(240, '2022-06-20', '12:45:10', 'TR06-239', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(241, '2022-06-20', '12:46:10', 'TR06-240', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(242, '2022-06-20', '12:46:11', 'TR06-241', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(243, '2022-06-20', '12:46:12', 'TR06-242', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(244, '2022-06-20', '12:46:40', 'TR06-243', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(245, '2022-06-20', '12:46:41', 'TR06-244', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(246, '2022-06-20', '12:46:42', 'TR06-245', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(247, '2022-06-20', '12:46:42', 'TR06-246', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(248, '2022-06-20', '12:46:49', 'TR06-247', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(249, '2022-06-20', '12:47:30', 'TR06-248', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(250, '2022-06-20', '12:47:31', 'TR06-249', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(251, '2022-06-20', '12:47:31', 'TR06-250', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(252, '2022-06-20', '12:47:32', 'TR06-251', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(253, '2022-06-20', '12:47:35', 'TR06-252', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(254, '2022-06-20', '12:48:08', 'TR06-253', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(255, '2022-06-20', '12:48:09', 'TR06-254', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(256, '2022-06-20', '12:48:10', 'TR06-255', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(257, '2022-06-20', '12:48:27', 'TR06-256', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(258, '2022-06-20', '12:48:39', 'TR06-257', 288888, 'RiffaShop Tenggarong', '', 288888, 'Transfer', 0),
(259, '2022-06-20', '12:48:50', 'TR06-258', 283888, 'RiffaShop Tenggarong', '', 0, 'Cash', -283888),
(260, '2022-06-20', '12:50:38', 'TR06-259', 283888, 'RiffaShop Tenggarong', '', 0, 'Cash', -283888),
(261, '2022-06-20', '12:55:19', 'TR06-260', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(262, '2022-06-20', '12:56:41', 'TR06-261', 287888, 'RiffaShop Tenggarong', '', 287888, 'Transfer', 0),
(263, '2022-06-20', '12:57:06', 'TR06-262', 282888, 'RiffaShop Tenggarong', '', 0, 'Cash', -282888),
(264, '2022-06-20', '13:25:37', 'TR06-263', 278888, 'RiffaShop Tenggarong', '', 0, 'Cash', -278888),
(265, '2022-06-20', '13:25:55', 'TR06-264', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(266, '2022-06-20', '13:34:31', 'TR06-265', 278888, 'RiffaShop Tenggarong', '', 278888, 'Transfer', 0),
(267, '2022-06-20', '13:35:19', 'TR06-266', 287888, 'RiffaShop Tenggarong', '', 0, 'Cash', -287888),
(268, '2022-06-20', '13:35:38', 'TR06-267', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(269, '2022-06-20', '13:35:51', 'TR06-268', 280888, 'RiffaShop Tenggarong', '', 0, 'Cash', -280888),
(270, '2022-06-20', '13:36:02', 'TR06-269', 282888, 'RiffaShop Tenggarong', '', 282888, 'Transfer', 0),
(271, '2022-06-20', '13:36:35', 'TR06-270', 278888, 'RiffaShop Tenggarong', '', 278888, 'Transfer', 0),
(272, '2022-06-20', '13:38:14', 'TR06-271', 281888, 'RiffaShop Tenggarong', '', 281888, 'Transfer', 0),
(273, '2022-06-20', '13:44:42', 'TR06-272', 285888, 'RiffaShop Tenggarong', '', 285888, 'Transfer', 0),
(274, '2022-06-20', '13:44:52', 'TR06-273', 285888, 'RiffaShop Tenggarong', '', 0, 'Cash', -285888),
(275, '2022-06-20', '13:45:33', 'TR06-274', 856664, 'RiffaShop Tenggarong', '', 856664, 'Transfer', 0),
(276, '2022-06-20', '13:45:49', 'TR06-275', 288888, 'RiffaShop Tenggarong', '', 0, 'Cash', -288888),
(277, '2022-06-20', '13:46:17', 'TR06-276', 39000, 'RiffaShop Tenggarong', '', 0, 'Cash', -39000),
(278, '2022-06-20', '13:47:12', 'TR06-277', 19000, 'RiffaShop Tenggarong', '', 0, 'Cash', -19000),
(279, '2022-06-20', '13:48:02', 'TR06-278', 120000, 'RiffaShop Tenggarong', '', 0, 'Cash', -120000),
(280, '2022-06-20', '13:48:18', 'TR06-279', 180000, 'RiffaShop Tenggarong', 'yyyy', 180000, 'Transfer', 0),
(281, '2022-06-20', '14:01:55', 'TR06-280', 20000, 'RiffaShop Tenggarong', '', 0, 'Cash', -20000),
(282, '2022-06-20', '14:02:16', 'TR06-281', 20000, 'RiffaShop Tenggarong', '', 0, 'Cash', -20000),
(283, '2022-06-20', '14:02:57', 'TR06-282', 20000, 'RiffaShop Tenggarong', '', 20000, 'Transfer', 0),
(284, '2022-06-20', '14:04:14', 'TR06-283', 60000, 'RiffaShop Tenggarong', '', 60000, 'Transfer', 0),
(285, '2022-06-20', '14:04:32', 'TR06-284', 20000, 'RiffaShop Tenggarong', '', 0, 'Cash', -20000),
(286, '2022-06-20', '14:05:16', 'TR06-285', 40000, 'RiffaShop Tenggarong', '', 0, 'Cash', -40000),
(287, '2022-06-20', '14:05:55', 'TR06-286', 19000, 'RiffaShop Tenggarong', '', 19000, 'Transfer', 0),
(288, '2022-06-20', '14:06:07', 'TR06-287', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(289, '2022-06-20', '14:06:58', 'TR06-288', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(290, '2022-06-20', '14:07:16', 'TR06-289', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(291, '2022-06-20', '14:07:21', 'TR06-290', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(292, '2022-06-20', '14:07:29', 'TR06-291', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(293, '2022-06-20', '14:07:46', 'TR06-292', 0, 'RiffaShop Tenggarong', '', 0, 'Cash', 0),
(294, '2022-06-25', '11:23:18', 'TR06-293', 5000, 'RiffaShop Tenggarong', '', 0, 'Cash', -5000),
(295, '2022-06-25', '11:32:11', 'TR06-294', 5000, 'RiffaShop Tenggarong', '', 0, 'Cash', -5000),
(296, '2022-06-25', '11:32:25', 'TR06-295', 4000, 'RiffaShop Tenggarong', '', 0, 'Cash', -4000),
(297, '2022-06-25', '11:32:48', 'TR06-296', 20000, 'RiffaShop Tenggarong', 'yyy', 20000, 'Transfer', 0),
(298, '2022-07-19', '09:40:08', 'TR07-297', 4000, 'RiffaShop Tenggarong', '', 0, 'Cash', -4000),
(299, '2022-07-25', '20:40:36', 'TR07-298', 5000, 'Dimas', '', 0, 'Cash', 0),
(300, '2022-07-25', '20:40:53', 'TR07-299', 5000, 'Dimas', 'Dimas', 0, 'Cash', 0),
(301, '2022-07-25', '20:41:38', 'TR07-300', 0, 'Dimas', '', 0, 'Cash', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `kode_barang`, `harga`, `qty`, `total`, `diskon`) VALUES
(286, 286, 'BR001', 20000, 2, 40000, 0),
(287, 287, 'BR001', 20000, 1, 20000, 0),
(288, 294, 'BR004', 5000, 1, 5000, 0),
(289, 295, 'BR004', 5000, 1, 5000, 0),
(290, 296, 'BR004', 5000, 1, 5000, 0),
(291, 297, 'BR004', 5000, 4, 20000, 0),
(292, 298, 'BR004', 5000, 1, 5000, 0),
(293, 299, 'BR004', 5000, 1, 5000, 0),
(294, 300, 'BR004', 5000, 1, 5000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `pass`, `role_id`, `alamat`) VALUES
(2, 'Dimas Bayu', 'admin', 'admin', 2, 'Jl.PadatKarya Gg.Melati Samarinda Kalimantan Timur');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `barang_km`
--
ALTER TABLE `barang_km`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `disbarang`
--
ALTER TABLE `disbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_km`
--
ALTER TABLE `barang_km`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT untuk tabel `disbarang`
--
ALTER TABLE `disbarang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
