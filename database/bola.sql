-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2024 pada 04.54
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bola`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_klub`
--

CREATE TABLE `t_klub` (
  `id_klub` int(11) NOT NULL,
  `nama_klub` varchar(100) NOT NULL,
  `asal_kota_klub` varchar(100) NOT NULL,
  `goal` int(11) NOT NULL,
  `kebobolan` int(11) NOT NULL,
  `menang` int(11) NOT NULL,
  `seri` int(11) NOT NULL,
  `kalah` int(11) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_klub`
--

INSERT INTO `t_klub` (`id_klub`, `nama_klub`, `asal_kota_klub`, `goal`, `kebobolan`, `menang`, `seri`, `kalah`, `point`) VALUES
(21, 'Arema FC', 'Malang, Jawa Timur', 2, 4, 0, 0, 1, 0),
(22, 'Persib FC', 'Bandung, Jawa Barat', 1, 1, 0, 1, 0, 1),
(23, 'Sriwijaya FC', 'Palembang, Sumatera Selatan', 0, 0, 0, 0, 0, 0),
(24, 'Persija', 'Jakarta, DKI Jakarta', 1, 1, 0, 1, 0, 1),
(25, 'Semen Padang FC', 'Padang, Sumatera Barat', 4, 2, 1, 0, 0, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pertandingan`
--

CREATE TABLE `t_pertandingan` (
  `id_pertandingan` int(11) NOT NULL,
  `id_kandang` int(11) NOT NULL,
  `id_tandang` int(11) NOT NULL,
  `skor_kandang` int(11) NOT NULL,
  `skor_tandang` int(11) NOT NULL,
  `tanggal_pertandingan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pertandingan`
--

INSERT INTO `t_pertandingan` (`id_pertandingan`, `id_kandang`, `id_tandang`, `skor_kandang`, `skor_tandang`, `tanggal_pertandingan`) VALUES
(51, 21, 25, 2, 4, '2024-02-13'),
(52, 22, 24, 1, 1, '2024-02-13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_klub`
--
ALTER TABLE `t_klub`
  ADD PRIMARY KEY (`id_klub`);

--
-- Indeks untuk tabel `t_pertandingan`
--
ALTER TABLE `t_pertandingan`
  ADD PRIMARY KEY (`id_pertandingan`),
  ADD KEY `id_kandang` (`id_kandang`),
  ADD KEY `id_tandang` (`id_tandang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_klub`
--
ALTER TABLE `t_klub`
  MODIFY `id_klub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `t_pertandingan`
--
ALTER TABLE `t_pertandingan`
  MODIFY `id_pertandingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_pertandingan`
--
ALTER TABLE `t_pertandingan`
  ADD CONSTRAINT `t_pertandingan_ibfk_1` FOREIGN KEY (`id_kandang`) REFERENCES `t_klub` (`id_klub`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pertandingan_ibfk_2` FOREIGN KEY (`id_tandang`) REFERENCES `t_klub` (`id_klub`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
