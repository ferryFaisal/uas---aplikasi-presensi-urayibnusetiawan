-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2022 pada 17.14
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` char(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `kelas`) VALUES
(5, '3202016040', 'Rabuansah', '5A'),
(7, '3202016041', 'Annisa Parastika A.', '5A'),
(8, '3202016042', 'Egi Aenggi', '5A'),
(9, '3202016045', 'Jurina', '5A'),
(10, '3202016074', 'Feby Paramudia', '5A'),
(11, '3202016075', 'Susan', '5A'),
(12, '3202016076', 'Tari', '5A'),
(13, '3202016077', 'Jaka Adi Baskara', '5A'),
(14, '3202016078', 'Aris Adhadi', '5A'),
(15, '3202016079', 'Uray Ibnu Setiawan', '5A'),
(16, '3202016080', 'Elsadai Romyanna Br Ginting', '5A'),
(17, '3202016098', 'Vizhianto Wahyu Xaverius', '5A'),
(18, '3202016103', 'Fika Astuti Sari', '5A'),
(19, '3202016104', 'Cherly Evanjeli', '5A'),
(20, '3202016105', 'Vhika Wanasa Khosravi', '5A'),
(21, '320206106', 'Chrystoper Brayen Krisna', '5A'),
(22, '3202016107', 'Ofendi ', '5A'),
(23, '3202016108', 'Putra Satria Mujahid', '5A'),
(24, '3202016110', 'Fandy Haryadi', '5A'),
(25, '3202016111', 'Rifqy Nurfaizi', '5A'),
(26, '3202016113', 'Alya Nabilah Dwianda', '5A'),
(27, '3202016114', 'Muklis Faridho Novianto', '5A'),
(28, '3202016115', 'Fikri Faizul Azka', '5A'),
(29, '3202016116', 'Muhammad Nazar Bayhaqi', '5A'),
(30, '3202016117', 'Siti Auliyah', '5A'),
(31, '3202016119', 'Afillah Fahrur Robby', '5A'),
(32, '3202016120', 'Abang Muhammad Fajar', '5A'),
(33, '3202016121', 'Syarif Fahrulrazi', '5A'),
(34, '3202016122', 'M. David Firmansyah', '5A'),
(35, '3202016321', 'Jonsibu', '5B'),
(36, '3202016023', 'Renaldi', '5B');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
