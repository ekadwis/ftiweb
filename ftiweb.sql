-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 11:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ftiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `id_arsip` int(11) NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_dekanat` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `nik_dosen` varchar(50) NOT NULL,
  `kegiatan_keperluan` varchar(255) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `sifat` varchar(20) NOT NULL,
  `tembusan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `no_urut` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `revisi` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip_surat`
--

INSERT INTO `arsip_surat` (`id_arsip`, `id_permohonan`, `id_surat`, `id_dekanat`, `id_dosen`, `tanggal`, `kode_surat`, `perihal`, `jenis_surat`, `tujuan`, `prodi`, `nama_dosen`, `nik_dosen`, `kegiatan_keperluan`, `periode_awal`, `periode_akhir`, `sifat`, `tembusan`, `catatan`, `lampiran`, `no_urut`, `status`, `revisi`, `author`) VALUES
(11, 8, 28, 5, 13, '17-08-2024', 'B.02/001/FTI-I/2024', 'Pengabdian', 'Surat Keputusan', 'dummy 1', 'Informatika', 'Aditya Wikan M.', '164E427', 'untuk dummy 1', '2024-08-17', '2024-08-20', 'Urgent', 'dummy1', 'dummy1', '7fd40da1ec5feaffe3f82e8aad77132a.txt', '1', 'Download', '', 'Administrator SI'),
(12, 9, 32, 5, 13, '17-08-2024', 'B.02/001/FTI-I/2024', 'Pengabdian', 'Surat Keputusan', 'dummy 1', 'Informatika', 'Tarno', '164E427', 'untuk dummy 1', '2024-08-17', '2024-08-20', 'Urgent', 'dummy1', 'dummy1', '7fd40da1ec5feaffe3f82e8aad77132a.txt', '1', 'Download', '', 'Administrator SI');

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'administrator', 'Site Administrator'),
(2, 'user', 'Site Users');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 3),
(1, 7),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'kaprodi.ti@staff.ukdw.ac.id', 3, '2024-08-03 21:06:30', 1),
(2, '::1', 'user1@gmail.com', 4, '2024-08-03 21:42:29', 1),
(3, '::1', 'kaprodi.ti@staff.ukdw.ac.id', 3, '2024-08-03 21:56:03', 1),
(4, '::1', 'user1@gmail.com', NULL, '2024-08-03 22:04:13', 0),
(5, '::1', 'user1@gmail.com', 4, '2024-08-03 22:04:28', 1),
(6, '::1', 'dekan.fti@staff.ukdw.ac.id', 1, '2024-08-03 22:07:44', 0),
(7, '::1', 'dekan.fti@staff.ukdw.ac.id', 1, '2024-08-03 22:07:51', 0),
(8, '::1', 'kaprodi.ti@staff.ukdw.ac.id', NULL, '2024-08-03 22:07:59', 0),
(9, '::1', 'kaprodi.ti@staff.ukdw.ac.id', 3, '2024-08-03 22:08:08', 1),
(10, '::1', 'dekan.fti@staff.ukdw.ac.id', 1, '2024-08-05 09:08:06', 0),
(11, '::1', 'dekan.fti@staff.ukdw.ac.id', 1, '2024-08-05 09:08:15', 0),
(12, '::1', 'dekan.fti@staff.ukdw.ac.id', 1, '2024-08-05 09:08:23', 0),
(13, '::1', 'kaprodi.ti@staff.ukdw.ac.id', 3, '2024-08-05 09:08:31', 1),
(14, '::1', 'user2@gmail.com', 5, '2024-08-05 09:34:08', 1),
(15, '::1', 'kaprodi.ti@staff.ukdw.ac.id', 3, '2024-08-05 09:56:15', 1),
(16, '::1', 'kaprodi.si@staff.ukdw.ac.id', 6, '2024-08-05 09:58:11', 1),
(17, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-05 10:06:51', 1),
(18, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-07 08:09:19', 1),
(19, '::1', 'user2@gmail.com', 5, '2024-08-07 08:12:17', 1),
(20, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-08 17:59:01', 1),
(21, '::1', 'user2@gmail.com', 5, '2024-08-08 17:59:20', 1),
(22, '::1', 'user2@gmail.com', 5, '2024-08-08 19:23:26', 1),
(23, '::1', 'user2@gmail.com', 5, '2024-08-09 08:41:07', 1),
(24, '::1', 'user2@gmail.com', 5, '2024-08-10 03:03:54', 1),
(25, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-10 09:57:22', 1),
(26, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-12 07:20:31', 1),
(27, '::1', 'user2@gmail.com', 5, '2024-08-12 10:12:28', 1),
(28, '::1', 'user2@gmail.com', 5, '2024-08-12 10:14:29', 1),
(29, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-12 10:22:50', 1),
(30, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-13 03:05:33', 1),
(31, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-17 20:08:49', 1),
(32, '::1', 'user2@gmail.com', 5, '2024-08-17 20:30:28', 1),
(33, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-17 20:37:36', 1),
(34, '::1', 'user1@gmail.com', NULL, '2024-08-17 20:46:06', 0),
(35, '::1', 'user2@gmail.com', 5, '2024-08-17 20:46:17', 1),
(36, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-17 20:48:33', 1),
(37, '::1', 'user2@gmail.com', 5, '2024-08-17 21:10:43', 1),
(38, '::1', 'user2@gmail.com', 5, '2024-08-17 21:15:59', 1),
(39, '::1', 'kaprodi.si@staff.ukdw.ac.id', 7, '2024-08-17 21:19:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All Users'),
(2, 'manage-profile', 'Manage profile sendiri');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `combined_surat_view`
-- (See below for the actual view)
--
CREATE TABLE `combined_surat_view` (
`id_merged` bigint(21)
,`id_arsip` int(11)
,`id_permohonan` int(11)
,`id_surat` int(11)
,`id_dekanat` int(11)
,`id_dosen` int(11)
,`tanggal` varchar(20)
,`kode_surat` varchar(50)
,`perihal` varchar(50)
,`jenis_surat` varchar(50)
,`tujuan` varchar(255)
,`prodi` varchar(50)
,`nama_dosen` varchar(50)
,`nik_dosen` varchar(50)
,`kegiatan_keperluan` varchar(255)
,`periode_awal` date
,`periode_akhir` date
,`sifat` varchar(20)
,`tembusan` varchar(255)
,`catatan` varchar(255)
,`lampiran` varchar(255)
,`no_urut` varchar(20)
,`status` varchar(20)
,`revisi` varchar(255)
,`author` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `nik_dosen` varchar(20) DEFAULT NULL,
  `prodi_dosen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `nik_dosen`, `prodi_dosen`) VALUES
(1, 'Budi Sutedjo', '944E217', 'Sistem Informasi'),
(2, 'Erick Kurniawan', '074E324', 'Sistem Informasi'),
(3, 'Halim Budi Santoso', '144E372', 'Sistem Informasi'),
(4, 'Jong Jek Siang', '104E344', 'Sistem Informasi'),
(5, 'Katon Wijana', '944E220', 'Sistem Informasi'),
(6, 'Umi Proboyekti', '974E244', 'Sistem Informasi'),
(7, 'Wimmie Handiwidjojo', '894E090', 'Sistem Informasi'),
(8, 'Yetli Oslan', '944E219', 'Sistem Informasi'),
(9, 'Argo Wibowo', '174E433', 'Sistem Informasi'),
(10, 'Gabriel Indra', '214E552', 'Sistem Informasi'),
(11, 'Bertha Laroha', '234KE530', 'Sistem Informasi'),
(12, 'Andhika Galuh', '234KE547', 'Sistem Informasi'),
(13, 'Aditya Wikan M.', '164E427', 'Informatika'),
(14, 'Antonius Rachmat C.', '104E342', 'Informatika'),
(15, 'Budi Susanto', '984E249', 'Informatika'),
(16, 'Gani Indriyanta', '944E228', 'Informatika'),
(17, 'Joko Purwadi', '964E239', 'Informatika'),
(18, 'Junius Karel', '964E241', 'Informatika'),
(19, 'Nugroho Agus H.', '014E292', 'Informatika'),
(20, 'Prihadi Beny Waluyo', '944E229', 'Informatika'),
(21, 'R. Gunawan Santosa', '914E162', 'Informatika'),
(22, 'Rosa Delima', '094E339', 'Informatika'),
(23, 'Sri Suwarno', '89E091', 'Informatika'),
(24, 'Willy Sudiarto R.', '104E341', 'Informatika'),
(25, 'Lukas Chrisantyo A.A', '134E365', 'Informatika'),
(26, 'Gloria Virginia', '084E325', 'Informatika'),
(27, 'Lucia Dwi K.', '944E227', 'Informatika'),
(28, 'Restyandito', '004E289', 'Informatika'),
(29, 'Yuan Lukito', '154E401', 'Informatika'),
(30, 'Kristian Adi Nugraha', '154E402', 'Informatika'),
(31, 'Hendro Setiadi', '094KE079', 'Informatika'),
(32, 'Danny Sebastian', '164E428', 'Informatika'),
(33, 'Laurentius Kuncoro P.S', '164E417', 'Informatika'),
(34, 'Maria Nila Angia R.', '194E498', 'Informatika'),
(35, 'Matahari Bhakti N.', '214E545', 'Informatika'),
(36, 'I Kadek Dendy S.', '244E589', 'Informatika'),
(37, 'Agata Filia', '204E537', 'Informatika'),
(39, 'dosendummy', '12313131313', 'apa hayo'),
(40, 'tes dosen 1', '919049941', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `kode_surat`
--

CREATE TABLE `kode_surat` (
  `id_surat` int(11) NOT NULL,
  `kode_surat` varchar(20) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kode_surat`
--

INSERT INTO `kode_surat` (`id_surat`, `kode_surat`, `jenis_surat`, `no_urut`) VALUES
(1, 'A.01', 'Perguruan tinggi', 0),
(2, 'A.02', 'Gereja-Gereja', 0),
(3, 'A.02', 'Sinode', 0),
(4, 'A.02', 'Lembaga Kristen', 0),
(5, 'A.02', 'PGI', 0),
(6, 'A.02', 'PERSETIA', 0),
(7, 'A.02', 'BKPTKI', 0),
(8, 'B.01', 'Anggaran Dasar', 0),
(9, 'B.01', 'Anggaran Rumah Tangga', 0),
(10, 'B.01', 'Rencana Induk Pengembangan', 0),
(11, 'B.01', 'Rencana Strategis', 0),
(12, 'B.01', 'STATUTA', 0),
(13, 'B.01', 'Status Perguruan Tinggi', 0),
(14, 'B.01', 'Peraturan-Peraturan Yayasan dan Universitas', 0),
(15, 'B.02', 'Surat Keputusan', 2),
(16, 'B.02', 'Peraturan dan Kepegawaian (Pengangkatan, Peningkatan, Pemberhentian Personalia)', 2),
(17, 'B.03', 'Perjanjian Khusus Kepegawaian', 0),
(18, 'B.04', 'Perumahan Pegawai', 0),
(19, 'B.05', 'Senat Universitas', 0),
(20, 'B.05', 'Senat Fakultas', 0),
(21, 'B.06', 'Surat Keputusan Organisasi Kemahasiswaan', 0),
(22, 'B.07', 'Surat Penunjukan', 0),
(23, 'C.01', 'Admisi', 0),
(24, 'C.01', 'Orientasi Kampus', 0),
(25, 'C.01', 'Registrasi', 0),
(26, 'C.02', 'Status Mahasiswa', 0),
(27, 'C.03', 'Kurikulum', 0),
(28, 'C.03', 'Silabus', 0),
(29, 'C.03', 'Kalender Akademik', 0),
(30, 'C.03', 'Jadwal Kuliah', 0),
(31, 'C.03', 'Kerja Praktik', 0),
(32, 'C.03', 'Magang', 0),
(33, 'C.04', 'Daftar Mahasiswa', 0),
(34, 'C.04', 'Dosen Wali', 0),
(35, 'C.04', 'Pemahaman Alkitab', 0),
(36, 'C.05', 'Daftar Nilai', 0),
(37, 'C.05', 'Judul dan Ujian Skripsi', 0),
(38, 'C.06', 'Ujian Negara', 0),
(39, 'C.06', 'Uji Kompetensi Mahasiswa Program Profesi Dokter (UKMPDD)', 0),
(40, 'C.07', 'Mahasiswa Asing', 0),
(41, 'C.07', 'Pendengar', 0),
(42, 'C.07', 'Teladan', 0),
(43, 'C.07', 'Mahakarta', 0),
(44, 'C.07', 'Wajib Militer', 0),
(45, 'C.08', 'Dies Natalis', 0),
(46, 'C.08', 'Reuni', 0),
(47, 'C.08', 'Alumni', 0),
(48, 'C.08', 'Studium General', 0),
(49, 'C.08', 'Wisuda', 0),
(50, 'C.08', 'Upacara Bendera', 0),
(51, 'C.08', 'Pelantikan Dokter', 0),
(52, 'C.09', 'Transkrip Nilai dan Ijazah', 0),
(53, 'C.10', 'Studi Lanjut S1', 0),
(54, 'C.10', 'Studi Lanjut S2', 0),
(55, 'C.10', 'Studi Lanjut S3', 0),
(56, 'C.11', 'Daftar Hadir Dosen', 0),
(57, 'C.11', 'Daftar Hadir Mahasiswa', 0),
(58, 'C.11', 'Daftar Hadir Probandus', 0),
(59, 'C.11', 'Evaluasi Dosen', 0),
(60, 'C.12', 'Pengumuman-Pengumuman', 0),
(61, 'C.12', 'Keterangan-Keterangan', 0),
(62, 'C.12', 'Ijin-ijin dari Universitas', 0),
(63, 'C.13', 'Surat Keterangan Lulus (S.Ked/Sarjana)', 0),
(64, 'C.14', 'Surat Keterangan Lulus OSCE Kompre', 0),
(65, 'C.15', 'Surat Keterangan Lulus Kepaniteraan Klinik', 0),
(66, 'C.16', 'Kelayakan Etik (Ethical Clearance)', 0),
(67, 'C.17', 'Tutorial', 0),
(68, 'C.18', 'Program Khusus', 0),
(69, 'C.19', 'Mini Blok', 0),
(70, 'C.20', 'Karya Tulis Ilmiah', 0),
(71, 'C.21', 'Yudisium', 0),
(72, 'D.01', 'Penelitian', 0),
(73, 'D.02', 'Pengabdian Masyarakat', 0),
(74, 'D.02', 'Kuliah Kerja Nyata', 0),
(75, 'D.02', 'Stage (Praktek Kejemaatan)', 0),
(76, 'D.02', 'Kerja Lapangan', 0),
(77, 'D.03', 'Ceramah', 0),
(78, 'D.03', 'Seminar', 0),
(79, 'D.03', 'Penataran', 0),
(80, 'D.03', 'Lokakarya', 0),
(81, 'D.03', 'Pelatihan', 0),
(82, 'D.04', 'Bantuan Kotbah', 0),
(83, 'D.04', 'Tenaga Pendeta', 0),
(84, 'D.05', 'Publikasi dan Karya Ilmiah', 0),
(85, 'D.05', 'Kehumasan', 0),
(86, 'D.06', 'Nomor Sertifikat', 0),
(87, 'E.01', 'Ruang Kuliah', 0),
(88, 'E.01', 'Ruang Kantor', 0),
(89, 'E.01', 'Auditorium', 0),
(90, 'E.01', 'Ruang Seminar', 0),
(91, 'E.01', 'Ruang Studio', 0),
(92, 'E.01', 'Laboratorium', 0),
(93, 'E.01', 'Gudang', 0),
(94, 'E.01', 'Perumahan', 0),
(95, 'E.01', 'Tanah', 0),
(96, 'E.01', 'Gedung', 0),
(97, 'E.01', 'Kendaraan', 0),
(98, 'E.01', 'Alat Kantor', 0),
(99, 'E.01', 'Sarana dan Prasarana', 0),
(100, 'E.02', 'Surat-Surat Perjanjian: Pembelian tanah', 0),
(101, 'E.02', 'Rumah', 0),
(102, 'E.02', 'Sewa Menyewa', 0),
(103, 'E.02', 'Pembangunan Gedung', 0),
(104, 'E.02', 'Surat Ijin Membangun', 0),
(105, 'E.02', 'Foto-Foto Kegiatan Universitas dan Mahasiswa Gedung', 0),
(106, 'E.03', 'KSO', 0),
(107, 'E.03', 'Perjanjian Kerjasama (MOU)', 0),
(108, 'F.01', 'Anggaran', 0),
(109, 'F.01', 'Pendapatan dan Belanja', 0),
(110, 'F.02', 'Bantuan-Bantuan', 0),
(111, 'F.02', 'Sumbangan-Sumbangan dari Luar Negeri', 0),
(112, 'F.02', 'Sumbangan-Sumbangan dari Gereja', 0),
(113, 'F.02', 'Sumbangan-Sumbangan dari Pemerintah', 0),
(114, 'F.02', 'Sumbangan-Sumbangan dari Perorangan', 0),
(115, 'F.03', 'Uang Pendaftaran Kuliah', 0),
(116, 'F.03', 'Uang Pendaftaran Asrama', 0),
(117, 'F.03', 'Uang Pendaftaran Ujian', 0),
(118, 'F.03', 'Uang Pendaftaran Legalisasi', 0),
(119, 'F.03', 'Uang Pendaftaran Skripsi', 0),
(120, 'F.03', 'Uang Pendaftaran Wisuda', 0),
(121, 'F.04', 'Pajak-Pajak', 0),
(122, 'F.04', 'Listrik', 0),
(123, 'F.04', 'Ipeda/PBB', 0),
(124, 'F.04', 'Tanah', 0),
(125, 'F.04', 'Air', 0),
(126, 'F.04', 'Gaji', 0),
(127, 'F.05', 'Iuran-Iuran: ATESEA', 0),
(128, 'F.05', 'Iuran-Iuran: PERSETIA', 0),
(129, 'F.05', 'Iuran-Iuran: Kopertis', 0),
(130, 'F.05', 'Iuran-Iuran: Yayasan Dana Pensiun', 0),
(131, 'F.05', 'Iuran-Iuran: Asuransi', 0),
(132, 'F.05', 'Iuran-Iuran: BKPTKI', 0),
(133, 'F.06', 'Terbitan-terbitan', 0),
(134, 'F.07', 'Gaji dan Tunjangan-Tunjangan', 0),
(135, 'F.07', 'Honor', 0),
(136, 'F.08', 'Biaya-Biaya Pos', 0),
(137, 'F.09', 'Perbaikan Gedung', 0),
(138, 'F.09', 'Perbaikan Alat-alat kantor', 0),
(139, 'F.09', 'Perbaikan Asuransi', 0),
(140, 'F.10', 'Biaya-Biaya Stase', 0),
(141, 'F.10', 'Biaya-Biaya Dies', 0),
(142, 'F.10', 'Biaya-Biaya Wisuda', 0),
(143, 'F.10', 'Biaya-Biaya Studium General', 0),
(144, 'F.10', 'Biaya-Biaya Kuliah Kerja Nyata', 0),
(145, 'F.10', 'Biaya-Biaya Kuliah', 0),
(146, 'F.10', 'Biaya-Biaya Penelitian/Laboratorium', 0),
(147, 'F.11', 'Permohonan Pembelian', 0),
(148, 'F.12', 'Permohonan Penawaran Harga', 0),
(149, 'F.13', 'Purchase Order', 0),
(150, 'F.14', 'Pencairan Dana', 0),
(151, 'F.14', 'Penempatan', 0),
(152, 'F.14', 'Pencairan Deposito', 0),
(153, 'F.15', 'Berita Acara Keuangan', 0),
(154, 'F.16', 'Surat-Surat Keuangan', 0),
(155, 'G.01', 'Laporan Tahunan', 0),
(156, 'G.01', 'Pengisian Data', 0),
(157, 'G.01', 'Pra-Evaluasi', 0),
(158, 'G.01', 'Evaluasi', 0),
(159, 'G.01', 'Ristek Dikti', 0),
(160, 'G.01', 'Kopertis', 0),
(161, 'G.01', 'Akreditasi', 0),
(162, 'G.02', 'APTISI/BKS/TRIAD', 0),
(163, 'G.03', 'Kemahasiswaan', 0),
(164, 'G.03', 'Dosen', 0),
(165, 'G.03', 'Karyawan (Misal Pekan Olahraga Mahasiswa dan Karyawan)', 0),
(166, 'G.04', 'Sumbangan-Sumbangan', 0),
(167, 'G.04', 'Beasiswa', 0),
(168, 'G.05', 'Undangan-Undangan', 0),
(169, 'G.05', 'Ucapan-ucapan', 0),
(170, 'G.05', 'Media Massa', 0),
(171, 'G.05', 'Alamat-Alamat', 0),
(172, 'G.06', 'Permohonan/Pemberian Bantuan Mengajar', 0),
(173, 'G.06', 'Penguji dan Probandus', 0),
(174, 'G.06', 'Ujian', 0),
(175, 'G.06', 'Promotor', 0),
(176, 'H.01', 'Laporan-Laporan Pimpinan Pada Dies', 0),
(177, 'H.01', 'Laporan-Laporan Pimpinan Pada Wisuda', 0),
(178, 'H.01', 'Laporan-Laporan Pimpinan Pada Rapat Yayasan', 0),
(179, 'H.02', 'Undangan', 0),
(180, 'H.02', 'Notula', 0),
(181, 'H.02', 'Berita Acara', 0),
(182, 'H.02', 'Daftar Hadir', 0),
(183, 'I.01', 'Instansi Pemerintah: Dinas Kebudayaan', 0),
(184, 'I.01', 'Instansi Pemerintah: Pemuda dan Olahraga', 0),
(185, 'I.01', 'Instansi Pemerintah: Departemen Agama', 0),
(186, 'I.01', 'Instansi Pemerintah: Imigrasi', 0),
(187, 'I.01', 'Instansi Pemerintah: Tenaga Kerja', 0),
(188, 'I.01', 'Instansi Pemerintah: Statistik', 0),
(189, 'I.01', 'Instansi Pemerintah: RT', 0),
(190, 'I.01', 'Instansi Pemerintah: RW', 0),
(191, 'I.01', 'Instansi Pemerintah: Kelurahan', 0),
(192, 'I.01', 'Instansi Pemerintah: Kecamatan', 0),
(193, 'I.01', 'Instansi Pemerintah: Kepolisian', 0),
(194, 'I.01', 'Instansi Pemerintah: Kodya', 0),
(195, 'I.01', 'Instansi Pemerintah: Pemda', 0),
(196, 'I.01', 'Instansi Pemerintah: Kantor Pos', 0),
(197, 'I.01', 'Instansi Pemerintah: Telkom', 0),
(198, 'I.01', 'Instansi Pemerintah: Agraria', 0),
(199, 'I.02', 'Instansi Swasta', 0),
(200, 'J.01', 'Usulan-Usulan', 0),
(201, 'J.02', 'Rekrutmen Pegawai (Pengumuman)', 0),
(202, 'J.02', 'Rekrutmen Pegawai (Seleksi)', 0),
(203, 'J.02', 'Rekrutmen Pegawai (Penerimaan/Penolakan)', 0),
(204, 'J.03', 'Kepegawaian (Peningkatan)', 0),
(205, 'J.03', 'Kepegawaian (Pembinaan)', 0),
(206, 'J.03', 'Kepegawaian (Rotasi)', 0),
(207, 'J.03', 'Kepegawaian (Mutasi)', 0),
(208, 'J.03', 'Kepegawaian (Penilaian)', 0),
(209, 'J.03', 'Kepegawaian (DP3)', 0),
(210, 'J.04', 'Perayaan Hari Besar', 0),
(211, 'J.04', 'Pengembangan Spiritualitas', 0),
(212, 'J.05', 'Surat Tugas', 2),
(213, 'J.05', 'Surat Cuti', 2),
(214, 'A.02', '', 0),
(215, 'Z.01', 'Surat Formal', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `merge_data_pengguna`
-- (See below for the actual view)
--
CREATE TABLE `merge_data_pengguna` (
`nama_user` varchar(50)
,`nik_user` char(16)
,`user_id` int(11) unsigned
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1722716266, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_ttd`
--

CREATE TABLE `permohonan_ttd` (
  `id_permohonan` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_dekanat` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `nik_dosen` varchar(50) NOT NULL,
  `kegiatan_keperluan` varchar(255) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `sifat` varchar(20) NOT NULL,
  `tembusan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `no_urut` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `revisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan_ttd`
--

INSERT INTO `permohonan_ttd` (`id_permohonan`, `id_surat`, `id_dekanat`, `id_dosen`, `tanggal`, `kode_surat`, `perihal`, `jenis_surat`, `tujuan`, `prodi`, `nama_dosen`, `nik_dosen`, `kegiatan_keperluan`, `periode_awal`, `periode_akhir`, `sifat`, `tembusan`, `catatan`, `lampiran`, `no_urut`, `status`, `revisi`) VALUES
(7, 29, 5, 7, '17-08-2024', 'B.02/002/FTI-SI/2024/FTI-I/2024', 'Pengabdian', 'Surat Keputusan', 'dummy 1', 'Sistem Informasi', 'Wimmie Handiwidjojo', '894E090', 'untuk dummy 1', '2024-08-17', '2024-08-20', 'Urgent', 'dummy1', 'dummy1', 'ddc740ee441ede0817da7abc8d9fc314.txt', '2', 'Proses', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `id_dekanat` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `nik_dosen` varchar(50) NOT NULL,
  `kegiatan_keperluan` varchar(255) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `sifat` varchar(20) NOT NULL,
  `tembusan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `no_urut` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `revisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `id_dekanat`, `id_dosen`, `tanggal`, `kode_surat`, `perihal`, `jenis_surat`, `tujuan`, `prodi`, `nama_dosen`, `nik_dosen`, `kegiatan_keperluan`, `periode_awal`, `periode_akhir`, `sifat`, `tembusan`, `catatan`, `lampiran`, `no_urut`, `status`, `revisi`) VALUES
(30, 5, 19, '17-08-2024', 'J.05/001', 'Penelitian (Publikasi) Tingkat Lokal', 'Surat Tugas', 'dummy2', 'Informatika', 'Nugroho Agus H.', '014E292', 'dummy2', '2024-08-17', '2024-08-27', 'Not Urgent', 'dummy2', 'dummy2', '33118f2429e0385b34e05325a4afba93.txt', '1', 'Revisi', 'Revisii yaa ini dummy'),
(31, 5, 36, '17-08-2024', 'Z.01/001', 'dummy3', 'Surat Formal', 'dummy3', 'Informatika', 'I Kadek Dendy S.', '244E589', 'dummy3', '2023-01-28', '2024-08-23', 'Urgent', 'dummy3', '', 'b3e696cc7dff9d3ae2f164e0329887ec.txt', '1', 'Pending', ''),
(33, 5, 6, '17-08-2024', 'J.05/002', 'Pengabdian (Publikasi) Tingkat Internal', 'Surat Tugas', 'dummy10', 'Sistem Informasi', 'Umi Proboyekti', '974E244', 'dummy10', '2024-07-17', '2024-08-21', 'Urgent', 'dummy10', 'dummy10', '742bbf95f4902f2d3d54c761d4226ae6.txt', '2', 'Pending', ''),
(34, 5, 11, '17-08-2024', 'J.05/002', 'Pengabdian (Publikasi) Tingkat Internal', 'Surat Tugas', 'dummy10', 'Sistem Informasi', 'Bertha Laroha', '234KE530', 'dummy10', '2024-07-17', '2024-08-21', 'Urgent', 'dummy10', 'dummy10', '742bbf95f4902f2d3d54c761d4226ae6.txt', '2', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `nik_user` char(16) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `telp_user` int(50) DEFAULT NULL,
  `jeniskelamin_user` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `nik_user`, `nama_user`, `telp_user`, `jeniskelamin_user`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'kaprodi.ti@staff.ukdw.ac.id', 'admin2', NULL, NULL, NULL, NULL, '$2y$10$Cs4XJG7eIQ6mPAJVDc4TvOesgNkUKdhLlMMY7Z3nEN3HjedXv9FsC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-08-03 21:06:24', '2024-08-03 21:06:24', NULL),
(5, 'user2@gmail.com', 'User2', '23242414141', 'Tes Nama Lengkap1', 2147483647, 'perempuan', '$2y$10$LeMqxOVxRGT1Kc4y6bSwvu71IpUyoonVKJUNE9ptj.Vw/nCS758Jy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-08-05 09:30:04', '2024-08-05 09:30:04', NULL),
(7, 'kaprodi.si@staff.ukdw.ac.id', 'Administrator3', '3267281304274392', 'Administrator SI', 2147483647, 'laki-laki', '$2y$10$qSxfDbW8fHgKBnAjdqMPIe2Jenyi60lsLqs0ZsNz9EZWWwQN02wzq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-08-05 10:06:19', '2024-08-05 10:06:19', NULL);

-- --------------------------------------------------------

--
-- Structure for view `combined_surat_view`
--
DROP TABLE IF EXISTS `combined_surat_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `combined_surat_view`  AS SELECT row_number() over ( order by `combined_data`.`id_surat_merged`) AS `id_merged`, `combined_data`.`id_arsip` AS `id_arsip`, `combined_data`.`id_permohonan` AS `id_permohonan`, `combined_data`.`id_surat` AS `id_surat`, `combined_data`.`id_dekanat` AS `id_dekanat`, `combined_data`.`id_dosen` AS `id_dosen`, `combined_data`.`tanggal` AS `tanggal`, `combined_data`.`kode_surat` AS `kode_surat`, `combined_data`.`perihal` AS `perihal`, `combined_data`.`jenis_surat` AS `jenis_surat`, `combined_data`.`tujuan` AS `tujuan`, `combined_data`.`prodi` AS `prodi`, `combined_data`.`nama_dosen` AS `nama_dosen`, `combined_data`.`nik_dosen` AS `nik_dosen`, `combined_data`.`kegiatan_keperluan` AS `kegiatan_keperluan`, `combined_data`.`periode_awal` AS `periode_awal`, `combined_data`.`periode_akhir` AS `periode_akhir`, `combined_data`.`sifat` AS `sifat`, `combined_data`.`tembusan` AS `tembusan`, `combined_data`.`catatan` AS `catatan`, `combined_data`.`lampiran` AS `lampiran`, `combined_data`.`no_urut` AS `no_urut`, `combined_data`.`status` AS `status`, `combined_data`.`revisi` AS `revisi`, `combined_data`.`author` AS `author` FROM (select NULL AS `id_arsip`,NULL AS `id_permohonan`,`s`.`id_surat` AS `id_surat_merged`,`s`.`id_surat` AS `id_surat`,`s`.`id_dekanat` AS `id_dekanat`,`s`.`id_dosen` AS `id_dosen`,`s`.`tanggal` AS `tanggal`,`s`.`kode_surat` AS `kode_surat`,`s`.`perihal` AS `perihal`,`s`.`jenis_surat` AS `jenis_surat`,`s`.`tujuan` AS `tujuan`,`s`.`prodi` AS `prodi`,`s`.`nama_dosen` AS `nama_dosen`,`s`.`nik_dosen` AS `nik_dosen`,`s`.`kegiatan_keperluan` AS `kegiatan_keperluan`,`s`.`periode_awal` AS `periode_awal`,`s`.`periode_akhir` AS `periode_akhir`,`s`.`sifat` AS `sifat`,`s`.`tembusan` AS `tembusan`,`s`.`catatan` AS `catatan`,`s`.`lampiran` AS `lampiran`,`s`.`no_urut` AS `no_urut`,`s`.`status` AS `status`,`s`.`revisi` AS `revisi`,NULL AS `author` from `surat` `s` union all select NULL AS `id_arsip`,`p`.`id_permohonan` AS `id_permohonan`,`p`.`id_surat` AS `id_surat_merged`,`p`.`id_surat` AS `id_surat`,`p`.`id_dekanat` AS `id_dekanat`,`p`.`id_dosen` AS `id_dosen`,`p`.`tanggal` AS `tanggal`,`p`.`kode_surat` AS `kode_surat`,`p`.`perihal` AS `perihal`,`p`.`jenis_surat` AS `jenis_surat`,`p`.`tujuan` AS `tujuan`,`p`.`prodi` AS `prodi`,`p`.`nama_dosen` AS `nama_dosen`,`p`.`nik_dosen` AS `nik_dosen`,`p`.`kegiatan_keperluan` AS `kegiatan_keperluan`,`p`.`periode_awal` AS `periode_awal`,`p`.`periode_akhir` AS `periode_akhir`,`p`.`sifat` AS `sifat`,`p`.`tembusan` AS `tembusan`,`p`.`catatan` AS `catatan`,`p`.`lampiran` AS `lampiran`,`p`.`no_urut` AS `no_urut`,`p`.`status` AS `status`,`p`.`revisi` AS `revisi`,NULL AS `author` from `permohonan_ttd` `p` union all select `a`.`id_arsip` AS `id_arsip`,`a`.`id_permohonan` AS `id_permohonan`,`a`.`id_surat` AS `id_surat_merged`,`a`.`id_surat` AS `id_surat`,`a`.`id_dekanat` AS `id_dekanat`,`a`.`id_dosen` AS `id_dosen`,`a`.`tanggal` AS `tanggal`,`a`.`kode_surat` AS `kode_surat`,`a`.`perihal` AS `perihal`,`a`.`jenis_surat` AS `jenis_surat`,`a`.`tujuan` AS `tujuan`,`a`.`prodi` AS `prodi`,`a`.`nama_dosen` AS `nama_dosen`,`a`.`nik_dosen` AS `nik_dosen`,`a`.`kegiatan_keperluan` AS `kegiatan_keperluan`,`a`.`periode_awal` AS `periode_awal`,`a`.`periode_akhir` AS `periode_akhir`,`a`.`sifat` AS `sifat`,`a`.`tembusan` AS `tembusan`,`a`.`catatan` AS `catatan`,`a`.`lampiran` AS `lampiran`,`a`.`no_urut` AS `no_urut`,`a`.`status` AS `status`,`a`.`revisi` AS `revisi`,`a`.`author` AS `author` from `arsip_surat` `a`) AS `combined_data` ;

-- --------------------------------------------------------

--
-- Structure for view `merge_data_pengguna`
--
DROP TABLE IF EXISTS `merge_data_pengguna`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `merge_data_pengguna`  AS SELECT `users`.`nama_user` AS `nama_user`, `users`.`nik_user` AS `nik_user`, `auth_groups_users`.`user_id` AS `user_id`, `auth_groups`.`name` AS `name` FROM ((`users` join `auth_groups_users` on(`users`.`id` = `auth_groups_users`.`user_id`)) join `auth_groups` on(`auth_groups_users`.`group_id` = `auth_groups`.`id`)) WHERE `auth_groups_users`.`group_id` = 2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `kode_surat`
--
ALTER TABLE `kode_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonan_ttd`
--
ALTER TABLE `permohonan_ttd`
  ADD PRIMARY KEY (`id_permohonan`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kode_surat`
--
ALTER TABLE `kode_surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permohonan_ttd`
--
ALTER TABLE `permohonan_ttd`
  MODIFY `id_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
