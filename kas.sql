-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2024 pada 03.50
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(32) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama_anggota`, `saldo`) VALUES
('AG240911034629', 'Ahmad Faaza Mubaarok', 0),
('AG240911041747', 'Ahmad Musyafa', 98000),
('AG240911041754', 'Rian Santoso', 98000),
('AG240911041805', 'Farrel Hafizh Setiawan', 100000),
('AG240911041832', 'DestaYogi Oktafiyan', 98000),
('AG240911041857', 'Habib Zikri Malik', 100000),
('AG240911041916', 'Muhammad Imam Ichsan Savingi', 98000),
('AG240911041929', 'Ramadhani Gama Maftuhin', 100000),
('AG240911041939', 'Billy Bentang Sagara', 100000),
('AG240911042012', 'Raditya Muhammad Kesya', 100000),
('AG240911042026', 'Hanif Dzil Maarif Azizy', 100000),
('AG240911042040', 'Wildan Abida Maulida Ahmad', 100000),
('AG240911042056', 'Haidar Mustafid', 100000),
('AG240911042110', 'Muhammad Zaim Akmal Khadziq', 100000),
('AG240911042124', 'Muhammad Henrizal', 98000),
('AG240911042139', 'Ramadhannurrahman Harwani', 98000),
('AG240911042151', 'Ahmad Firdaus Al Hakim', 0),
('AG240911043149', 'Bayu Sidiq Yugiarto', 98000),
('AG240911043207', 'Reza Muhammad Abdul Rasyid', 98000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bendahara`
--

CREATE TABLE `tb_bendahara` (
  `id_bendahara` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruang` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bendahara`
--

INSERT INTO `tb_bendahara` (`id_bendahara`, `username`, `password`, `ruang`) VALUES
('1', 'admin', '$2y$10$hRi1qju2KOeEPcBZ0wYfhu/PN5e9Wl.ddWeDTds8Uokad764X9D1a', '12 PPLG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hutang`
--

CREATE TABLE `tb_hutang` (
  `id_hutang` varchar(32) NOT NULL,
  `anggota` varchar(32) NOT NULL,
  `periode` varchar(32) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_hutang`
--

INSERT INTO `tb_hutang` (`id_hutang`, `anggota`, `periode`, `nominal`) VALUES
('HT66e269ad8c4b8', 'AG240911042151', 'PR240912061021', 2000),
('HT66e269ad8ca5d', 'AG240911041747', 'PR240912061021', 2000),
('HT66e269ad8d1bb', 'AG240911043149', 'PR240912061021', 2000),
('HT66e269ad8d918', 'AG240911041939', 'PR240912061021', 2000),
('HT66e269ad8e033', 'AG240911041832', 'PR240912061021', 2000),
('HT66e269ad8e7ee', 'AG240911041805', 'PR240912061021', 2000),
('HT66e269ad8ef03', 'AG240911041857', 'PR240912061021', 2000),
('HT66e269ad8f647', 'AG240911042056', 'PR240912061021', 2000),
('HT66e269ad8fc44', 'AG240911042026', 'PR240912061021', 2000),
('HT66e269ad90311', 'AG240911042124', 'PR240912061021', 2000),
('HT66e269ad90989', 'AG240911041916', 'PR240912061021', 2000),
('HT66e269ad910c7', 'AG240911042110', 'PR240912061021', 2000),
('HT66e269ad9182c', 'AG240911042012', 'PR240912061021', 2000),
('HT66e269ad91fb8', 'AG240911041929', 'PR240912061021', 2000),
('HT66e269ad9273d', 'AG240911042139', 'PR240912061021', 2000),
('HT66e269ad92f0b', 'AG240911043207', 'PR240912061021', 2000),
('HT66e269ad936f2', 'AG240911041754', 'PR240912061021', 2000),
('HT66e269ad93dcd', 'AG240911042040', 'PR240912061021', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemasukan`
--

CREATE TABLE `tb_pemasukan` (
  `id_pemasukan` varchar(32) NOT NULL,
  `anggota` varchar(32) NOT NULL,
  `bendahara` varchar(32) NOT NULL,
  `status` enum('tepat waktu','terlambat') NOT NULL,
  `nominal` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `periode` varchar(32) NOT NULL,
  `metode` enum('tunai','tabungan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pemasukan`
--

INSERT INTO `tb_pemasukan` (`id_pemasukan`, `anggota`, `bendahara`, `status`, `nominal`, `waktu`, `periode`, `metode`) VALUES
('KM240911042636', 'AG240831043629', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043238', 'AG240911042040', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043241', 'AG240911041754', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043242', 'AG240911041754', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043247', 'AG240911043207', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043251', 'AG240911042139', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043252', 'AG240911042139', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043257', 'AG240911041929', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043301', 'AG240911041929', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043302', 'AG240911041929', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043315', 'AG240911043149', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043320', 'AG240911034629', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043330', 'AG240911041747', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043340', 'AG240911041805', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043345', 'AG240911041832', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043355', 'AG240911041857', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043359', 'AG240911042151', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911043840', 'AG240911042124', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911050854', 'AG240911042110', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911051342', 'AG240911042056', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911051649', 'AG240911042026', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tabungan'),
('KM240911051948', 'AG240911042012', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911051953', 'AG240911041939', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911052002', 'AG240911041916', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911035634', 'tunai'),
('KM240911052354', 'AG240911034629', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tabungan'),
('KM240911060834', 'AG240911042151', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060838', 'AG240911041747', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060842', 'AG240911043149', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060848', 'AG240911041939', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060854', 'AG240911041832', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060855', 'AG240911041832', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060903', 'AG240911041805', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060910', 'AG240911041857', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060911', 'AG240911041857', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060920', 'AG240911042056', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060925', 'AG240911042026', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060929', 'AG240911042124', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060934', 'AG240911041916', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060939', 'AG240911042110', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060946', 'AG240911043207', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911060959', 'AG240911042012', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911061003', 'AG240911041929', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911061007', 'AG240911042139', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911061012', 'AG240911041754', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911061017', 'AG240911042040', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911052100', 'tunai'),
('KM240911061832', 'AG240911034629', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911061809', 'tabungan'),
('KM240911062132', 'AG240911041747', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911061809', 'tabungan'),
('KM240911065759', 'AG240911042151', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911061809', 'tunai'),
('KM240911070503', 'AG240911043149', '1', 'tepat waktu', 2000, '2024-09-11', 'PR240911061809', 'tabungan'),
('KM240912034721', 'AG240911043207', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tabungan'),
('KM240912034729', 'AG240911042139', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tabungan'),
('KM240912034743', 'AG240911042124', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tabungan'),
('KM240912034749', 'AG240911042110', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034754', 'AG240911042056', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034800', 'AG240911041754', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tabungan'),
('KM240912034805', 'AG240911041805', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034811', 'AG240911042040', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034816', 'AG240911042026', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034821', 'AG240911042012', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034826', 'AG240911041939', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034831', 'AG240911041929', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034835', 'AG240911041916', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tabungan'),
('KM240912034846', 'AG240911041857', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tunai'),
('KM240912034851', 'AG240911041832', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240911061809', 'tabungan'),
('KM240912061121', 'AG240911034629', '1', 'tepat waktu', 2000, '2024-09-12', 'PR240912061021', 'tabungan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` varchar(32) NOT NULL,
  `bendahara` varchar(32) NOT NULL,
  `nominal` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `periode` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `bendahara`, `nominal`, `waktu`, `keperluan`, `periode`) VALUES
('KK240911052032', '1', 8000, '2024-09-11', 'anggaran tertentu', 'PR240911035634');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `id_periode` varchar(32) NOT NULL,
  `periode` varchar(32) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_periode`
--

INSERT INTO `tb_periode` (`id_periode`, `periode`, `nominal`, `status`) VALUES
('PR240911035634', 'Pekan Pertama', 2000, 'nonaktif'),
('PR240911052100', 'Pekan Kedua', 2000, 'nonaktif'),
('PR240911061809', 'Pekan Ketiga', 2000, 'nonaktif'),
('PR240912061021', 'pekan keempat', 2000, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saldo`
--

CREATE TABLE `tb_saldo` (
  `id_saldo` int(11) NOT NULL,
  `nominal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_saldo`
--

INSERT INTO `tb_saldo` (`id_saldo`, `nominal`) VALUES
(1, 132000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tabungan`
--

CREATE TABLE `tb_tabungan` (
  `id_tabungan` varchar(32) NOT NULL,
  `anggota` varchar(32) NOT NULL,
  `waktu` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` enum('masuk','keluar') NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tabungan`
--

INSERT INTO `tb_tabungan` (`id_tabungan`, `anggota`, `waktu`, `nominal`, `keterangan`, `saldo`) VALUES
('TB240911062040', 'AG240911034629', '2024-09-11', 100000, 'masuk', 100000),
('TB240911062122', 'AG240911041747', '2024-09-11', 100000, 'masuk', 100000),
('TB240911062132', 'AG240911041747', '2024-09-11', 2000, 'keluar', 98000),
('TB240911065822', 'AG240911043149', '2024-09-11', 100000, 'masuk', 100000),
('TB240911070503', 'AG240911043149', '2024-09-11', 2000, 'keluar', 98000),
('TB240912034300', 'AG240911042151', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034327', 'AG240911041939', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034437', 'AG240911041832', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034448', 'AG240911041805', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034456', 'AG240911041857', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034502', 'AG240911042056', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034509', 'AG240911042026', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034517', 'AG240911042124', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034524', 'AG240911041916', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034530', 'AG240911042110', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034536', 'AG240911042012', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034541', 'AG240911041929', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034610', 'AG240911042139', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034617', 'AG240911043207', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034623', 'AG240911041754', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034629', 'AG240911042040', '2024-09-12', 100000, 'masuk', 100000),
('TB240912034721', 'AG240911043207', '2024-09-12', 2000, 'keluar', 98000),
('TB240912034729', 'AG240911042139', '2024-09-12', 2000, 'keluar', 98000),
('TB240912034743', 'AG240911042124', '2024-09-12', 2000, 'keluar', 98000),
('TB240912034800', 'AG240911041754', '2024-09-12', 2000, 'keluar', 98000),
('TB240912034835', 'AG240911041916', '2024-09-12', 2000, 'keluar', 98000),
('TB240912034851', 'AG240911041832', '2024-09-12', 2000, 'keluar', 98000),
('TB240912061004', 'AG240911034629', '2024-09-12', 2000, 'masuk', 102000),
('TB240912061121', 'AG240911034629', '2024-09-12', 2000, 'keluar', 100000),
('TB240912061159', 'AG240911034629', '2024-09-12', 100000, 'keluar', 0),
('TB240912061322', 'AG240911042151', '2024-09-12', 100000, 'keluar', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_bendahara`
--
ALTER TABLE `tb_bendahara`
  ADD PRIMARY KEY (`id_bendahara`);

--
-- Indeks untuk tabel `tb_hutang`
--
ALTER TABLE `tb_hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indeks untuk tabel `tb_pemasukan`
--
ALTER TABLE `tb_pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  ADD PRIMARY KEY (`id_tabungan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
