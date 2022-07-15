-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2022 pada 11.13
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivethru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(11) NOT NULL,
  `no_perkara` varchar(64) NOT NULL,
  `pihak` varchar(16) NOT NULL,
  `alasan` text,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `libur`
--

CREATE TABLE `libur` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `libur`
--

INSERT INTO `libur` (`id`, `tanggal`, `nama`) VALUES
(1, '2022-07-15', 'libur terserah aku lah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `libur`
--
ALTER TABLE `libur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `libur`
--
ALTER TABLE `libur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
