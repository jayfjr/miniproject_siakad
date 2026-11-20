-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2026 at 04:57 AM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajar_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nid` char(5) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nid`, `nama_lengkap`) VALUES
('08166', 'Ruli Supriati, S.Kom., M.TI.'),
('08197', 'Aris Martono, S.Kom., M.M.SI.'),
('15018', 'Desy Apriani, S.Kom., M.TI.'),
('25001', 'Fajar Nur Iman, M.Kom.');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `kode_mk` char(5) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruangan` char(5) NOT NULL,
  `nid` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kode_mk`, `hari`, `jam_mulai`, `jam_selesai`, `ruangan`, `nid`) VALUES
(1, 'FS403', 'Senin', '08:40:00', '10:40:00', 'L201', '08197'),
(2, 'FS327', 'Jumat', '10:40:00', '12:50:00', 'L204', '25001');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `nim` char(10) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `pertemuan1` time DEFAULT NULL,
  `pertemuan2` time DEFAULT NULL,
  `pertemuan3` time DEFAULT NULL,
  `pertemuan4` time DEFAULT NULL,
  `pertemuan5` time DEFAULT NULL,
  `nilai_tm` int(3) DEFAULT NULL,
  `nilai_uts` int(3) DEFAULT NULL,
  `nilai_uas` int(3) DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `grade` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `nim`, `id_jadwal`, `pertemuan1`, `pertemuan2`, `pertemuan3`, `pertemuan4`, `pertemuan5`, `nilai_tm`, `nilai_uts`, `nilai_uas`, `nilai_akhir`, `grade`) VALUES
(3, '2431417079', 2, '09:21:10', NULL, NULL, NULL, NULL, 60, 67, 69, 65.70, 'C'),
(4, '2431417037', 2, '09:21:09', NULL, NULL, NULL, NULL, 86, 59, 67, 70.30, 'C'),
(5, '2431416955', 2, '09:21:08', NULL, NULL, NULL, NULL, 79, 75, 71, 74.60, 'C'),
(6, '2531499933', 2, '09:21:11', NULL, NULL, NULL, NULL, 58, 67, 67, 64.30, 'D'),
(7, '2422471080', 2, '09:20:54', NULL, NULL, NULL, NULL, 80, 77, 81, 79.50, 'B'),
(8, '2611495107', 2, '09:21:12', NULL, NULL, NULL, NULL, 83, 74, 65, 73.10, 'C'),
(9, '2421477037', 2, '09:21:29', NULL, NULL, NULL, NULL, 60, 70, 80, 71.00, 'C'),
(10, '2431417093', 2, '09:21:11', NULL, NULL, NULL, NULL, 74, 61, 59, 64.10, 'D'),
(11, '2431410898', 2, '09:21:07', NULL, NULL, NULL, NULL, 58, 76, 69, 67.80, 'C'),
(12, '2422416772', 2, '09:20:53', NULL, NULL, NULL, NULL, 65, 68, 78, 71.10, 'C'),
(13, '2421477037', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2422416772', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2422471080', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2431410898', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2431416955', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2431417037', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '2431417079', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2431417093', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '2531499933', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2611495107', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jurusan`) VALUES
('2212476036', 'Mekhnaz Rizkiyah Adawiyah', 'Sistem Informasi'),
('2321476957', 'Ramdan Jamaluddin Mubarok', 'Teknik Informatika'),
('2322469052', 'Hanif Fadhlurrahman', 'Teknik Informatika'),
('2322477607', 'Robby Arliansyah Candrawijaya', 'Teknik Informatika'),
('2411410930', 'Rafi Zain Vernando', 'Sistem Informasi'),
('2411417028', 'Resmini Zebua', 'Sistem Informasi'),
('2421477037', 'Brian Abrar Aviantara', 'Teknik Informatika'),
('2422416772', 'Fairuz Akhwal Zahran Adianra', 'Teknik Informatika'),
('2422471080', 'Andyka Prastyo', 'Teknik Informatika'),
('2422477108', 'Intan Nurul Fitri', 'Teknik Informatika'),
('2431410898', 'Erland Eka Yuda', 'Sistem Komputer'),
('2431416812', 'Haikal Ananta Dwiguna', 'Sistem Komputer'),
('2431416836', 'Muhammad Rizki Ardiansyah', 'Sistem Komputer'),
('2431416955', 'Adintia Farhan Golam', 'Sistem Komputer'),
('2431417037', 'Abdihaq Fidyaraya Nugraha', 'Sistem Komputer'),
('2431417077', 'WILDHAN FADILAH', 'Sistem Komputer'),
('2431417078', 'MUHAMMAD FILLAH AKBAR', 'Sistem Komputer'),
('2431417079', 'AAN ARIP SURYANA', 'Sistem Komputer'),
('2431417081', 'REZA MAULANA HIDAYAT', 'Sistem Komputer'),
('2431417090', 'SARAH KHOIRUNISA', 'Sistem Komputer'),
('2431417093', 'CINTA NORATA GIAWA', 'Sistem Komputer'),
('2431417094', 'SAHRUL ALFARIZI ANSOR', 'Sistem Komputer'),
('2431417097', 'WIDYA SYAFITRI', 'Sistem Komputer'),
('2431435961', 'MUHAMMAD REZA PAHLEVI', 'Sistem Komputer'),
('2531499933', 'AGHNIA LUTHFUNNISA', 'Sistem Komputer'),
('2611495107', 'BIMO YOGO KOESIYANTO', 'Sistem Informasi'),
('2622498520', 'NABHILA ANNISA NAFTANSYAH', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` char(5) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('FS218', 'Analisis dan Perancangan Sistem', 3),
('FS327', 'Pemrograman berbasis Web', 3),
('FS403', 'Cloud Computing', 3),
('UR105', 'Pengantar Teknologi Informasi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`) VALUES
(1, 'admin', 'admin12345', 'Administrator', 'admin'),
(2, '2431417079', '2431417079', 'AAN ARIP SURYANA', 'mahasiswa'),
(3, '2431417037', '2431417037', 'Abdihaq Fidyaraya Nugraha', 'mahasiswa'),
(4, '2431416955', '2431416955', 'Adintia Farhan Golam', 'mahasiswa'),
(5, '2531499933', '2531499933', 'AGHNIA LUTHFUNNISA', 'mahasiswa'),
(6, '2611495107', '2611495107', 'BIMO YOGO KOESIYANTO', 'mahasiswa'),
(7, '2431417093', '2431417093', 'CINTA NORATA GIAWA', 'mahasiswa'),
(8, '2431410898', '2431410898', 'Erland Eka Yuda', 'mahasiswa'),
(9, '2422416772', '2422416772', 'Fairuz Akhwal Zahran Adianra', 'mahasiswa'),
(10, '2431416812', '2431416812', 'Haikal Ananta Dwiguna', 'mahasiswa'),
(11, '2431417078', '2431417078', 'MUHAMMAD FILLAH AKBAR', 'mahasiswa'),
(12, '2431435961', '2431435961', 'MUHAMMAD REZA PAHLEVI', 'mahasiswa'),
(13, '2431416836', '2431416836', 'Muhammad Rizki Ardiansyah', 'mahasiswa'),
(14, '2622498520', '2622498520', 'NABHILA ANNISA NAFTANSYAH', 'mahasiswa'),
(15, '2411410930', '2411410930', 'Rafi Zain Vernando', 'mahasiswa'),
(16, '2411417028', '2411417028', 'Resmini Zebua', 'mahasiswa'),
(17, '2431417081', '2431417081', 'REZA MAULANA HIDAYAT', 'mahasiswa'),
(18, '2431417094', '2431417094', 'SAHRUL ALFARIZI ANSOR', 'mahasiswa'),
(19, '2431417090', '2431417090', 'SARAH KHOIRUNISA', 'mahasiswa'),
(20, '2431417097', '2431417097', 'WIDYA SYAFITRI', 'mahasiswa'),
(21, '2431417077', '2431417077', 'WILDHAN FADILAH', 'mahasiswa'),
(22, '2422471080', '2422471080', 'Andyka Prastyo', 'mahasiswa'),
(23, '2322469052', '2322469052', 'Hanif Fadhlurrahman', 'mahasiswa'),
(24, '2422477108', '2422477108', 'Intan Nurul Fitri', 'mahasiswa'),
(25, '2322477607', '2322477607', 'Robby Arliansyah Candrawijaya', 'mahasiswa'),
(26, '2421477037', '2421477037', 'Brian Abrar Aviantara', 'mahasiswa'),
(27, '2212476036', '2212476036', 'Mekhnaz Rizkiyah Adawiyah', 'mahasiswa'),
(28, '2321476957', '2321476957', 'Ramdan Jamaluddin Mubarok', 'mahasiswa'),
(29, '08166', '08166', 'Ruli Supriati, S.Kom., M.TI.', 'dosen'),
(30, '08197', '08197', 'Aris Martono, S.Kom., M.M.SI.', 'dosen'),
(31, '15018', '15018', 'Desy Apriani, S.Kom., M.TI.', 'dosen'),
(32, '25001', '25001', 'Fajar Nur Iman, M.Kom.', 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `kode_mk` (`kode_mk`),
  ADD KEY `nid` (`nid`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`nid`) REFERENCES `dosen` (`nid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
