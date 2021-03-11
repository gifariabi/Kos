-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2021 pada 10.29
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngekost`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_admin`, `email`, `no_telp`, `foto`) VALUES
('Admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin Kost1', 'admin@gmail.com', '0823462621', '26577b0c1269-2728-4441-8b8b-179aa0ac987a_169.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori_artikel` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `tgl_ubah` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar_di_muka`
--

CREATE TABLE `bayar_di_muka` (
  `kode_dp` int(11) NOT NULL,
  `jam` varchar(255) COLLATE utf8_bin NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_transfer` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `kode_kamar` varchar(255) NOT NULL,
  `kode_kos` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_tersedia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`kode_kamar`, `kode_kos`, `harga`, `deskripsi`, `foto`, `status`, `tgl_tersedia`) VALUES
('A1', 'ondo9313', 12000000, 'Fasilitas  lengkap', 'slide-1.jpg', 'Tersedia', '2020-12-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kosan`
--

CREATE TABLE `kosan` (
  `kode_kos` varchar(255) NOT NULL,
  `nama_kos` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis_kosan` varchar(255) NOT NULL,
  `saldo_kos` int(255) NOT NULL,
  `id_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kosan`
--

INSERT INTO `kosan` (`kode_kos`, `nama_kos`, `alamat`, `deskripsi`, `foto`, `jenis_kosan`, `saldo_kos`, `id_pemilik`) VALUES
('ondo9313', 'Pondok Annisa', 'Jalan Riau No.20                        \r\n                      ', 'Fasilitas lengkap', 'post-5.jpg', 'Putri', 0, 'Pemilik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mailbox`
--

CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `untuk` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelunasan`
--

CREATE TABLE `pelunasan` (
  `id_lunas` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(255) COLLATE utf8_bin NOT NULL,
  `jumlah_pelunasan` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pesan` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(255) COLLATE utf8_bin NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_dp` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama_pemilik`, `password`, `no_telp`, `email`, `jenis_kelamin`, `foto`) VALUES
('Pemilik', 'Pemilik Kostx', '827ccb0eea8a706c4c34a16891f84e7b', '088742726951', 'pemilik@gmail.com', '', '9810jens-stoltenberg_169.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencari`
--

CREATE TABLE `pencari` (
  `id_pencari` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pencari` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pencari`
--

INSERT INTO `pencari` (`id_pencari`, `password`, `nama_pencari`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `email`, `no_telp`, `foto`) VALUES
('Pencari', '827ccb0eea8a706c4c34a16891f84e7b', 'Pencari Kost', 'Jakarta x', '2002-10-12', '', 'pencari@gmail.com', '09899999891', '227Screenshot_2020-03-01 Tour Travel(1).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `kode_pengeluaran` int(11) NOT NULL,
  `keterangan_pengeluaran` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghuni`
--

CREATE TABLE `penghuni` (
  `nik` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_bin NOT NULL,
  `umur` varchar(255) COLLATE utf8_bin NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `no_telp` varchar(255) COLLATE utf8_bin NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_forget_pass`
--

CREATE TABLE `tmp_forget_pass` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `exp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tmp_forget_pass`
--

INSERT INTO `tmp_forget_pass` (`id`, `email`, `kode`, `exp`) VALUES
(3, 'pemilik@gmail.com', '43b52842663fa6e4100c72751d08de6f', '22'),
(2, 'pemilik@gmail.com', 'f0a5944c6a815b7bb44323d783eede4d', '22'),
(4, 'pemilik@gmail.com', 'f24ad6f72d6cc4cb51464f2b29ab69d3', '22'),
(5, 'pemilik@gmail.com', '4bb236de7787ceedafdff83bb8ea4710', '22'),
(6, 'pemilik@gmail.com', '5f0453f78909173a7ce2eb874d2a7f52', '22'),
(7, 'pemilik@gmail.com', 'b112ca4087d668785e947a57493d1740', '22'),
(8, 'pemilik@gmail.com', 'c2c2a04512b35d13102459f8784f1a2d', '22'),
(9, 'pemilik@gmail.com', '243facb29564e7b448834a7c9d901201', '22'),
(10, 'pemilik@gmail.com', '95a7e4252fc7bc562a711ef96884a383', '22'),
(11, 'pemilik@gmail.com', '4f1f29888cabf5d45f866fe457737a23', '22'),
(12, 'pemilik@gmail.com', '4764f37856fc727f70b666b8d0c4ab7a', '22'),
(13, 'pemilik@gmail.com', 'ab9ebd57177b5106ad7879f0896685d4', '21'),
(14, 'pemilik@gmail.com', 'c30fb4dc55d801fc7473840b5b161dfa', '21'),
(15, 'pemilik@gmail.com', 'dbbf603ff0e99629dda5d75b6f75f966', '22'),
(16, 'pencari@gmail.com', '5747a0021eb349e9c8d3667cf1a5e9ec', '11'),
(17, 'pemilik@gmail.com', '941e1aaaba585b952b62c14a3a175a61', '12'),
(18, 'pemilik@gmail.com', '298f587406c914fad5373bb689300433', '12'),
(19, 'pencari@gmail.com', '1d01bd2e16f57892f0954902899f0692', '07'),
(20, 'admin@gmail.com', '931af583573227f0220bc568c65ce104', '07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(255) NOT NULL,
  `kode_kamar` varchar(255) NOT NULL,
  `id_pencari` varchar(255) NOT NULL,
  `total_bayar` int(255) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `sisa_pembayaran` int(255) NOT NULL,
  `status_transaksi` int(11) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_kamar`, `id_pencari`, `total_bayar`, `tgl_bayar`, `tgl_masuk`, `tgl_keluar`, `sisa_pembayaran`, `status_transaksi`, `bukti_bayar`) VALUES
('trx001', 'A1', 'Pencari', 12000000, '2020-12-27', '2020-12-10', '2021-12-10', 0, 2, 'Capture.PNG'),
('trx002', 'A1', 'Pencari', 12000000, '0000-00-00', '2021-03-04', '2022-03-04', 11800000, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `bayar_di_muka`
--
ALTER TABLE `bayar_di_muka`
  ADD PRIMARY KEY (`kode_dp`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`kode_kamar`),
  ADD UNIQUE KEY `kode_kamar` (`kode_kamar`),
  ADD KEY `kode_kos` (`kode_kos`);

--
-- Indeks untuk tabel `kosan`
--
ALTER TABLE `kosan`
  ADD PRIMARY KEY (`kode_kos`),
  ADD UNIQUE KEY `kode_kos` (`kode_kos`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD PRIMARY KEY (`id_lunas`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indeks untuk tabel `pencari`
--
ALTER TABLE `pencari`
  ADD PRIMARY KEY (`id_pencari`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`kode_pengeluaran`);

--
-- Indeks untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `tmp_forget_pass`
--
ALTER TABLE `tmp_forget_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pencari` (`id_pencari`),
  ADD KEY `kode_kamar` (`kode_kamar`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bayar_di_muka`
--
ALTER TABLE `bayar_di_muka`
  MODIFY `kode_dp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_lunas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `kode_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tmp_forget_pass`
--
ALTER TABLE `tmp_forget_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`kode_kos`) REFERENCES `kosan` (`kode_kos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kosan`
--
ALTER TABLE `kosan`
  ADD CONSTRAINT `kosan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pencari`) REFERENCES `pencari` (`id_pencari`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kode_kamar`) REFERENCES `kamar` (`kode_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
