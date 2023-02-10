-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 04:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fns`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `kode_admin` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `nama_admin` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `kode_admin`, `nama_admin`, `username`, `password`) VALUES
(5, 'G001', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `admin_sales`
--

CREATE TABLE `admin_sales` (
  `id_admin_sales` int(11) NOT NULL,
  `kode_admin_sales` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `nama_admin_sales` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_sales`
--

INSERT INTO `admin_sales` (`id_admin_sales`, `kode_admin_sales`, `nama_admin_sales`, `username`, `password`) VALUES
(1, 'G001', 'Fauzi', 'fauzi', 'f6ad1060b401fbf92985f9ac91cb86dc');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` char(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_aplikasi`, `alamat`, `no_telp`, `email`, `website`, `logo`) VALUES
(1, 'DASHBOARD NEW PRODUCT', 'Tangerang', '085716315019', 'ahmad@polymindo.com', 'www.viroworld.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `AppID` varchar(15) CHARACTER SET latin1 NOT NULL,
  `AppName` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CatID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `CatName` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatID`, `CatName`) VALUES
('C01', 'Nasional '),
('C02', 'Bali'),
('C03', 'Export'),
('C04', 'Trade');

-- --------------------------------------------------------

--
-- Table structure for table `dedurasi`
--

CREATE TABLE `dedurasi` (
  `id_durasi` varchar(10) CHARACTER SET latin1 NOT NULL,
  `PI_SO` int(10) NOT NULL,
  `SO_PO` int(10) NOT NULL,
  `LTSales_Finish` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dedurasi`
--

INSERT INTO `dedurasi` (`id_durasi`, `PI_SO`, `SO_PO`, `LTSales_Finish`) VALUES
('J01', 48, 48, 48);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DeptID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `DeptName` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptID`, `DeptName`) VALUES
('D01', 'Sales'),
('D02', 'PPIC'),
('D03', 'IT'),
('D04', 'NPD'),
('D05', 'FA');

-- --------------------------------------------------------

--
-- Table structure for table `fa`
--

CREATE TABLE `fa` (
  `id_fa` int(11) NOT NULL,
  `kode_fa` char(10) CHARACTER SET latin1 NOT NULL,
  `DeptID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nama_fa` varchar(150) CHARACTER SET latin1 NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fa`
--

INSERT INTO `fa` (`id_fa`, `kode_fa`, `DeptID`, `nama_fa`, `username`, `password`, `email`) VALUES
(1, 'F01', 'D05', 'Lily', 'lily', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'lily@viroworld.com'),
(3, 'F03', 'D05', 'Dastin', 'dastin', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'komaru@viroworld.com'),
(4, 'F04', 'D05', 'Yosua', 'yosua', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', '');

-- --------------------------------------------------------

--
-- Table structure for table `finish`
--

CREATE TABLE `finish` (
  `NumDoc` varchar(10) CHARACTER SET latin1 NOT NULL,
  `CatID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `NoPI` varchar(250) CHARACTER SET latin1 NOT NULL,
  `DateFinish` datetime NOT NULL,
  `status_ok` varchar(25) CHARACTER SET latin1 NOT NULL,
  `UserID` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finish`
--

INSERT INTO `finish` (`NumDoc`, `CatID`, `NoPI`, `DateFinish`, `status_ok`, `UserID`) VALUES
('T00001', 'C03', 'PI 124 - Homebuilder', '2022-09-30 12:55:12', 'Close', 'Mika'),
('T00002', 'C03', '122 - Green Marquee', '2022-09-30 12:57:51', 'Close', 'Mika'),
('T00003', 'C01', '195_PT.Gitacipta Selaras_Surface Only_S0024', '2022-10-01 16:59:03', 'Close', 'Mika'),
('T00004', 'C03', '123 - Winroyal Rev.1', '2022-10-07 08:15:26', 'Close', 'Mika'),
('T00005', 'C03', '112 Backyard ', '2022-10-05 15:44:05', 'Close', 'Mika'),
('T00006', 'C01', '196-PT. Caturgriya Naradipa_Project Mansion Pine_Project Bapak Nabil_Grand & Junior Suite_Tambahan (Backing Pintu Mini Bar)', '2022-10-07 08:18:27', 'Close', 'Mika'),
('T00007', 'C01', '193_Bapak Mahmud Zakirin_Surface Bunga Tanjung ', '2022-10-05 15:12:55', 'Close', 'Mika'),
('T00008', 'C01', '199_PT.DAW_Surface S0365', '2022-10-10 15:53:52', 'Close', 'Mika'),
('T00009', 'C02', '049 - Ni luh/Buki Bali Surface S0056 ', '2022-10-13 14:01:11', 'Close', 'Mika'),
('T00010', 'C03', '119 Amazulu', '2022-10-14 15:40:58', 'Close', 'Mika'),
('T00011', 'C01', '194_PT.Tritunggal Prima_Ngurah Rai Project_Panel u/ Dinding/Kolom APH dengan Fiber FR', '2022-10-17 08:31:33', 'Close', 'Mika'),
('T00012', 'C02', '054 - Lumbung Ayu (2)', '2022-10-17 10:40:11', 'Close', 'Mika'),
('T00013', 'C03', '129 - Amazulu', '2022-10-17 14:16:22', 'Close', 'Mika'),
('T00014', 'C02', '052 - Tendy Sentosa', '2022-10-18 11:08:35', 'Close', 'Mika'),
('T00015', 'C02', 'VRG - 051/X/2022 Alam Sari', '2022-10-20 08:07:00', 'Close', 'Mika');

-- --------------------------------------------------------

--
-- Table structure for table `frame_detail`
--

CREATE TABLE `frame_detail` (
  `FrameID` varchar(15) CHARACTER SET latin1 NOT NULL,
  `FrameName` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frame_detail`
--

INSERT INTO `frame_detail` (`FrameID`, `FrameName`) VALUES
('frm001', 'using alumunium frame'),
('frm002', 'using iron metal frame'),
('frm003', 'hollo profile'),
('frm004', 'pipe profile'),
('frm005', 'standard size 40 x 40 cm'),
('frm006', 'tidak menggunakan Frame');

-- --------------------------------------------------------

--
-- Table structure for table `geninformation`
--

CREATE TABLE `geninformation` (
  `GenID` varchar(15) CHARACTER SET latin1 NOT NULL,
  `GenName` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `geninformation`
--

INSERT INTO `geninformation` (`GenID`, `GenName`) VALUES
('gen001', 'Archineering Project'),
('gen002', 'Request for costing estimation'),
('gen003', 'Request for design'),
('gen004', 'Request for prototyping'),
('gen005', 'Special request for packaging'),
('gen006', 'Special request for shipment'),
('gen007', 'Installation by client'),
('gen008', 'Installation by Viro'),
('gen009', 'Shipment by client'),
('gen010', 'Shipment by Viro'),
('gen011', 'Request for Exhibition or Event');

-- --------------------------------------------------------

--
-- Table structure for table `npd`
--

CREATE TABLE `npd` (
  `id_npd` int(11) NOT NULL,
  `kode_npd` char(10) CHARACTER SET latin1 NOT NULL,
  `DeptID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nama_npd` varchar(150) CHARACTER SET latin1 NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `plant` varchar(5) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `npd`
--

INSERT INTO `npd` (`id_npd`, `kode_npd`, `DeptID`, `nama_npd`, `username`, `password`, `email`, `plant`) VALUES
(1, 'N01', 'D02', 'Ali Mashudi', 'ali', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'ali.mashudi@viroworld.com', 'P1'),
(2, 'N02', 'D02', 'Suseno', 'suseno', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'suseno.febriyanto@viroworld.com', 'P4'),
(3, 'N03', 'D02', 'Umam', 'umam', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'engineer.npdfiber@viroworld.com', 'P1'),
(4, 'N04', 'D02', 'Okky', 'okky', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'okky@polymindo.com', 'P4'),
(5, 'N05', 'D02', 'Sutriono', 'sutriono', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'sutriono@polymindo.com', 'P4'),
(6, 'N06', 'D02', 'Agung', 'agung', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', '', 'P4');

-- --------------------------------------------------------

--
-- Table structure for table `npdtype`
--

CREATE TABLE `npdtype` (
  `NPDTypeID` varchar(15) CHARACTER SET latin1 NOT NULL,
  `NPDTypeName` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `npdtype`
--

INSERT INTO `npdtype` (`NPDTypeID`, `NPDTypeName`) VALUES
('npd001', 'New NPD - Sample Weaving Pattern'),
('npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule'),
('npd003', 'Development/Improvement of Product - Estimasi BOM & Costing'),
('npd004', 'Sample Varyan'),
('npd005', 'Sample Viroforms');

-- --------------------------------------------------------

--
-- Table structure for table `ppic`
--

CREATE TABLE `ppic` (
  `id_ppic` int(11) NOT NULL,
  `kode_ppic` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `nama_ppic` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ppic`
--

INSERT INTO `ppic` (`id_ppic`, `kode_ppic`, `nama_ppic`, `username`, `password`) VALUES
(1, 'G001', 'Mika', 'mika', '5cfc440d7090f16610447a3accdec4e0'),
(2, 'G002', 'Rizky', 'rizky', '2f908a706e4cd4550314bacda2e66bc5'),
(3, 'G003', 'Amir', 'amir', 'dd4b663692c1451f75c0985dd8d39f38'),
(4, 'G004', 'Krist', 'krist', 'cab155a3d0c3782efa3e90684a8e4969'),
(5, 'G005', 'Adhi', 'adhi', 'e541b728786e26771c2ae3f747fa873d');

-- --------------------------------------------------------

--
-- Table structure for table `prod_order`
--

CREATE TABLE `prod_order` (
  `NumDoc` varchar(10) CHARACTER SET latin1 NOT NULL,
  `CatID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `NoPI` varchar(250) CHARACTER SET latin1 NOT NULL,
  `NoSO` varchar(250) CHARACTER SET latin1 NOT NULL,
  `NoPO` varchar(256) CHARACTER SET latin1 NOT NULL,
  `DatePO` datetime NOT NULL,
  `DatePOSAP` datetime NOT NULL,
  `LeadTimePPIC` datetime NOT NULL,
  `UserID` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_order`
--

INSERT INTO `prod_order` (`NumDoc`, `CatID`, `NoPI`, `NoSO`, `NoPO`, `DatePO`, `DatePOSAP`, `LeadTimePPIC`, `UserID`) VALUES
('T00001', 'C03', '112 Backyard ', '221200107', '224100473 ', '2022-09-13 10:26:11', '2022-09-23 10:26:11', '2022-10-05 10:26:27', 'Mika'),
('T00002', 'C03', '119 Amazulu', '221200111', '224100495', '2022-09-23 14:02:31', '2022-09-23 14:02:31', '2022-10-15 15:11:38', 'Mika'),
('T00003', 'C03', '122 - Green Marquee', '221200112', '224100497', '2022-09-23 16:50:33', '2022-09-23 16:50:33', '2022-10-03 16:51:13', 'Mika'),
('T00004', 'C03', 'PI 117 - Safari', '221200113', '224100504', '2022-09-27 08:18:04', '2022-09-27 08:18:04', '2022-10-27 08:18:53', 'Mika'),
('T00005', 'C03', '106 - 2 ', '221200105', '224100463', '2022-09-27 08:20:47', '2022-09-27 08:20:47', '2022-10-19 08:21:07', 'Mika'),
('T00006', 'C01', '194_PT.Tritunggal Prima_Ngurah Rai Project_Panel u/ Dinding/Kolom APH dengan Fiber FR', '221100629', '224300621', '2022-09-27 14:08:29', '2022-09-27 14:08:29', '2022-10-14 14:08:56', 'Mika'),
('T00007', 'C01', '195_PT.Gitacipta Selaras_Surface Only_S0024', '221100631', '226101473', '2022-09-27 14:10:56', '2022-09-27 14:10:56', '2022-09-30 14:16:05', 'Mika'),
('T00009', 'C03', 'PI 124 - Homebuilder', '221200114', '224100439', '2022-09-28 10:03:31', '2022-09-28 10:03:31', '2022-09-30 17:03:56', 'Mika'),
('T00010', 'C01', '193_Bapak Mahmud Zakirin_Surface Bunga Tanjung ', '221100636', '226101475', '2022-09-28 16:56:52', '2022-09-28 16:56:52', '2022-10-07 16:57:13', 'Mika'),
('T00011', 'C01', '196-PT. Caturgriya Naradipa_Project Mansion Pine_Project Bapak Nabil_Grand & Junior Suite_Tambahan (Backing Pintu Mini Bar)', '221100637', '226101503', '2022-09-28 16:58:32', '2022-09-28 16:58:32', '2022-10-07 16:59:47', 'Mika'),
('T00012', 'C02', '046 - Begawan Giri Estate - Thatch Java Aged FR.A', '221100613', '224100500', '2022-09-29 16:40:39', '2022-09-29 16:40:39', '2022-10-31 16:41:14', 'Mika'),
('T00013', 'C03', '123 - Winroyal Rev.1', '221200115', '224100512', '2022-09-29 16:53:59', '2022-09-29 16:53:59', '2022-10-07 16:54:10', 'Mika'),
('T00014', 'C02', '049 - Ni luh/Buki Bali Surface S0056 ', '221100643', '226101515', '2022-09-30 17:09:53', '2022-09-30 17:09:53', '2022-10-15 17:10:11', 'Mika'),
('T00015', 'C01', '199_PT.DAW_Surface S0365', '221100646', '2261001520', '2022-10-04 08:33:46', '2022-10-04 08:33:46', '2022-10-12 08:34:05', 'Mika'),
('T00016', 'C01', '203_PT. Tritunggal Prima_Panel Bulkhead & Dinding Kolom APH', '221100647', '224300622', '2022-10-04 13:43:10', '2022-10-04 13:43:10', '2022-10-25 13:43:42', 'Mika'),
('T00017', 'C01', '205_PT. Mahogani Utama Indonesia_Suface Herrigbone Arurog 7x1.3 mm', '221100653', '226101541', '2022-10-13 14:48:27', '2022-10-13 14:48:27', '2022-10-19 14:48:38', 'Mika'),
('T00018', 'C01', '197_PT. Budi Bangun Konstruks_Sculpture', '221100666', '224300626', '2022-10-11 09:29:39', '2022-10-11 09:29:39', '2022-10-30 00:00:00', 'Mika'),
('T00019', 'C02', '053 - PT. Nautilus Utama Karya', '221100667', '226101550', '2022-10-11 15:48:40', '2022-10-11 15:48:40', '2022-10-25 15:49:03', 'Mika'),
('T00020', 'C03', '127 - Homebuilder Surface brown', '221200116', '226101560', '2022-10-11 16:07:14', '2022-10-11 16:07:14', '2022-10-25 16:07:26', 'Mika'),
('T00021', 'C02', '052 - Tendy Sentosa', '221100673', '226101559', '2022-10-12 08:13:47', '2022-10-12 08:13:47', '2022-10-18 08:14:35', 'Mika'),
('T00022', 'C02', 'VRG - 051/X/2022 Alam Sari', '221100675', 'Ambil Stok qty 200 pcs', '2022-10-14 15:43:11', '2022-10-14 15:43:11', '2022-10-20 15:44:09', 'Mika'),
('T00023', 'C02', '054 - Lumbung Ayu (2)', '221100677', 'SO sudah DI Close. Tidak bisa Buat PO', '2022-10-17 10:39:37', '2022-10-17 10:39:37', '2022-10-17 10:40:05', 'Mika'),
('T00024', 'C03', '129 - Amazulu', '221200120', 'Ambil stok FG', '2022-10-17 14:15:03', '2022-10-17 14:15:03', '2022-10-24 14:15:23', 'Mika'),
('T00025', 'C03', '126 - Safari', '221200118', '224100528', '2022-10-17 14:16:59', '2022-10-17 14:16:59', '2022-11-03 14:17:20', 'Mika'),
('T00026', 'C03', '128 - Winroyal 8th Container', '221200119', '224100521', '2022-10-17 14:17:33', '2022-10-17 14:17:33', '2022-10-31 14:17:56', 'Mika'),
('T00027', 'C03', '133 - Homebuilders_Ithaafushi', '221200121', '224100530', '2022-10-19 16:23:06', '2022-10-19 16:23:06', '2022-10-29 16:23:23', 'Mika');

-- --------------------------------------------------------

--
-- Table structure for table `proforma_inv`
--

CREATE TABLE `proforma_inv` (
  `NumDoc` varchar(10) CHARACTER SET latin1 NOT NULL,
  `CatID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `NoPI` varchar(250) CHARACTER SET latin1 NOT NULL,
  `Customer` text CHARACTER SET latin1 NOT NULL,
  `DatePI` datetime NOT NULL,
  `LeadTimeMKT` date NOT NULL,
  `UserID` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proforma_inv`
--

INSERT INTO `proforma_inv` (`NumDoc`, `CatID`, `NoPI`, `Customer`, `DatePI`, `LeadTimeMKT`, `UserID`) VALUES
('T00001', 'C03', '112 Backyard', 'Backyard Exscape', '2022-09-19 09:22:03', '2022-10-05', 'Hans'),
('T00005', 'C03', '119 Amazulu', '', '2022-09-23 09:50:44', '2022-10-10', 'Hans'),
('T00006', 'C03', '122 - Green Marquee', '', '2022-09-23 10:43:38', '2022-10-03', 'Yefta'),
('T00007', 'C01', '194_PT.Tritunggal Prima_Ngurah Rai Project_Panel u/ Dinding/Kolom APH dengan Fiber FR', '', '2022-09-26 03:10:48', '2022-10-21', 'Harpani'),
('T00008', 'C01', '195_PT.Gitacipta Selaras_Surface Only_S0024', '', '2022-09-26 03:15:15', '2022-09-30', 'Harpani'),
('T00009', 'C03', 'PI 117 - Safari', '', '2022-09-26 08:19:09', '2022-10-12', 'Yefta'),
('T00010', 'C01', '193_Bapak Mahmud Zakirin_Surface Bunga Tanjung ', '', '2022-09-27 11:50:33', '2022-10-07', 'Harpani'),
('T00011', 'C03', 'PI 124 - Homebuilder', '', '2022-09-28 08:59:07', '2022-09-30', 'Yefta'),
('T00012', 'C01', '196-PT. Caturgriya Naradipa_Project Mansion Pine_Project Bapak Nabil_Grand & Junior Suite_Tambahan (Backing Pintu Mini Bar)', '', '2022-09-28 14:52:53', '2022-10-07', 'Harpani'),
('T00013', 'C03', '123 - Winroyal Rev.1', '', '2022-09-29 14:27:18', '2022-10-07', 'Yefta'),
('T00015', 'C02', '049 - Ni luh/Buki Bali Surface S0056 ', '', '2022-09-29 14:41:47', '2022-10-15', 'Erika'),
('T00016', 'C02', '046 - Begawan Giri Estate - Thatch Java Aged FR.A', '', '2022-09-29 15:56:22', '2022-10-18', 'Yudi'),
('T00017', 'C01', '199_PT.DAW_Surface S0365', '', '2022-09-30 14:52:12', '2022-10-10', 'Harpani'),
('T00018', 'C01', '197_PT. Budi Bangun Konstruks_Sculpture', '', '2022-10-03 09:15:56', '2022-10-27', 'Harpani'),
('T00019', 'C01', '203_PT. Tritunggal Prima_Panel Bulkhead & Dinding Kolom APH', '', '2022-10-03 09:19:56', '2022-10-25', 'Harpani'),
('T00020', 'C01', '205_PT. Mahogani Utama Indonesia_Suface Herrigbone Arurog 7x1.3 mm', '', '2022-10-05 15:27:29', '2022-10-14', 'Harpani'),
('T00021', 'C02', '053 - PT. Nautilus Utama Karya', '', '2022-10-11 08:32:16', '0022-10-23', 'Erika'),
('T00022', 'C03', '127 - Homebuilder Surface brown', '', '2022-10-11 13:36:29', '0022-11-01', 'Yefta'),
('T00024', 'C02', '052 - Tendy Sentosa', '', '2022-10-11 15:49:10', '0022-10-18', 'Yudi'),
('T00025', 'C02', 'VRG - 051/X/2022 Alam Sari', '', '2022-10-13 16:21:13', '2022-10-20', 'Yudi'),
('T00026', 'C02', '054 - Lumbung Ayu (2)', '', '2022-10-14 13:34:43', '2022-10-14', 'Erika'),
('T00027', 'C03', '126 - Safari', '', '2022-10-17 09:05:02', '2022-11-03', 'Yefta'),
('T00028', 'C03', '129 - Amazulu', '', '2022-10-17 09:07:11', '2022-10-18', 'Yefta'),
('T00029', 'C03', '128 - Winroyal 8th Container', '', '2022-10-17 10:51:15', '2022-10-30', 'Yefta'),
('T00031', 'C03', '133 - Homebuilders_Ithaafushi', '', '2022-10-19 14:28:38', '2022-10-31', 'Yefta');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `kode_sales` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `DeptID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nama_sales` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `sales_category` varchar(25) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `kode_sales`, `DeptID`, `nama_sales`, `username`, `password`, `sales_category`, `email`) VALUES
(1, 'S01', 'D01', 'Hans', 'hans', '4c6ac4342fb50d1a344301878ff8cf49', 'C03', 'hans@virobuild.com'),
(2, 'S02', 'D01', 'Peter', 'peter', '4c6ac4342fb50d1a344301878ff8cf49', 'C03', 'peter@virobuild.com'),
(3, 'S03', 'D01', 'Harpani', 'harpani', '4c6ac4342fb50d1a344301878ff8cf49', 'C01', 'harpani@virobuild.com'),
(4, 'S04', 'D01', 'yefta', 'yefta', '4c6ac4342fb50d1a344301878ff8cf49', 'C03', 'yefta@virobuild.com'),
(5, 'S05', 'D01', 'yudi', 'Yudi K.', '4c6ac4342fb50d1a344301878ff8cf49', 'C02', 'yudi@virobuild.com'),
(6, 'S06', 'D01', 'Erika', 'rika', '4c6ac4342fb50d1a344301878ff8cf49', 'C02', 'rika@virobuild.com'),
(7, 'S07', 'D01', 'Ahmad Nazmudin', 'ahmad', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'C03', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `NumDoc` varchar(10) CHARACTER SET latin1 NOT NULL,
  `CatID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `NoPI` varchar(250) CHARACTER SET latin1 NOT NULL,
  `NoSO` varchar(256) CHARACTER SET latin1 NOT NULL,
  `status_so` varchar(25) CHARACTER SET latin1 NOT NULL,
  `DateSO` datetime NOT NULL,
  `DateSOSAP` datetime DEFAULT NULL,
  `UserID` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`NumDoc`, `CatID`, `NoPI`, `NoSO`, `status_so`, `DateSO`, `DateSOSAP`, `UserID`) VALUES
('T00001', 'C03', '112 Backyard ', '221200107', 'Complete', '2022-09-19 09:34:21', '2022-09-19 09:34:21', 'Fauzi'),
('T00003', 'C03', '106 - 2 ', '221200105', 'Complete', '2022-09-19 13:36:56', '2022-09-19 13:36:56', 'Fauzi'),
('T00004', 'C03', '119 Amazulu', '221200111', 'Complete', '2022-09-23 11:01:02', '2022-09-23 11:01:02', 'Fauzi'),
('T00005', 'C03', '122 - Green Marquee', '221200112', 'Complete', '2022-09-23 15:44:36', '2022-09-23 15:44:36', 'Fauzi'),
('T00006', 'C03', 'PI 117 - Safari', '221200113', 'Complete', '2022-09-26 09:16:27', '2022-09-26 09:16:27', 'Fauzi'),
('T00007', 'C01', '194_PT.Tritunggal Prima_Ngurah Rai Project_Panel u/ Dinding/Kolom APH dengan Fiber FR', '221100629', 'Complete', '2022-09-26 13:38:16', '2022-09-26 13:38:16', 'Fauzi'),
('T00008', 'C01', '195_PT.Gitacipta Selaras_Surface Only_S0024', '221100631', 'Complete', '2022-09-27 11:17:18', '2022-09-27 11:17:18', 'Fauzi'),
('T00009', 'C03', 'PI 124 - Homebuilder', '221200114', 'Complete', '2022-09-28 09:00:01', '2022-09-28 09:00:01', 'Fauzi'),
('T00010', 'C01', '193_Bapak Mahmud Zakirin_Surface Bunga Tanjung ', '221100636', 'Complete', '2022-09-28 13:17:48', '2022-09-28 13:17:48', 'Fauzi'),
('T00011', 'C01', '196-PT. Caturgriya Naradipa_Project Mansion Pine_Project Bapak Nabil_Grand & Junior Suite_Tambahan (Backing Pintu Mini Bar)', '221100637', 'Complete', '2022-09-28 15:37:43', '2022-09-28 15:37:43', 'Fauzi'),
('T00012', 'C03', '123 - Winroyal Rev.1', '221200115', 'Complete', '2022-09-29 16:14:15', '2022-09-29 16:14:15', 'Fauzi'),
('T00013', 'C02', '046 - Begawan Giri Estate - Thatch Java Aged FR.A', '221100613', 'Not Complete', '2022-09-29 16:20:10', '2022-09-29 16:20:10', 'Fauzi'),
('T00014', 'C02', '049 - Ni luh/Buki Bali Surface S0056 ', '221100643', 'Not Complete', '2022-09-30 16:48:57', '2022-09-30 16:48:57', 'Fauzi'),
('T00015', 'C01', '199_PT.DAW_Surface S0365', '221100646', 'Complete', '2022-10-04 08:22:43', '2022-10-04 08:22:43', 'Fauzi'),
('T00016', 'C01', '203_PT. Tritunggal Prima_Panel Bulkhead & Dinding Kolom APH', '221100647', 'Complete', '2022-10-04 09:56:27', '2022-10-04 09:56:27', 'Fauzi'),
('T00017', 'C02', '049 - Ni luh/Buki Bali Surface S0056 ', '221100643', 'Complete', '2022-10-04 11:29:59', '2022-10-04 11:29:59', 'Fauzi'),
('T00018', 'C01', '205_PT. Mahogani Utama Indonesia_Suface Herrigbone Arurog 7x1.3 mm', '221100653', 'Complete', '2022-10-05 16:44:33', '2022-10-05 16:44:33', 'Fauzi'),
('T00019', 'C01', '197_PT. Budi Bangun Konstruks_Sculpture', '221100666', 'Complete', '2022-10-11 08:20:45', '2022-10-11 08:20:45', 'Fauzi'),
('T00020', 'C02', '053 - PT. Nautilus Utama Karya', '221100667', 'Complete', '2022-10-11 13:25:20', '2022-10-11 13:25:20', 'Fauzi'),
('T00021', 'C03', '127 - Homebuilder Surface brown', '221200116', 'Complete', '2022-10-11 15:28:48', '2022-10-11 15:28:48', 'Fauzi'),
('T00022', 'C02', '052 - Tendy Sentosa', '221100673', 'Complete', '2022-10-11 16:57:20', '2022-10-11 16:57:20', 'Fauzi'),
('T00023', 'C02', 'VRG - 051/X/2022 Alam Sari', '221100675', 'Complete', '2022-10-13 16:22:19', '2022-10-13 16:22:19', 'Fauzi'),
('T00024', 'C02', '054 - Lumbung Ayu (2)', '221100677', 'Complete', '2022-10-17 09:43:16', '2022-10-17 09:43:16', 'Fauzi'),
('T00025', 'C03', '126 - Safari', '221200118', 'Complete', '2022-10-17 11:13:19', '2022-10-17 11:13:19', 'Fauzi'),
('T00026', 'C03', '128 - Winroyal 8th Container', '221200119', 'Complete', '2022-10-17 12:00:03', '2022-10-17 12:00:03', 'Fauzi'),
('T00027', 'C03', '129 - Amazulu', '221200120', 'Complete', '2022-10-17 13:09:57', '2022-10-17 13:09:57', 'Fauzi'),
('T00028', 'C03', '133 - Homebuilders_Ithaafushi', '221200121', 'Complete', '2022-10-19 15:45:54', '2022-10-19 15:45:54', 'Fauzi');

-- --------------------------------------------------------

--
-- Table structure for table `tapplications`
--

CREATE TABLE `tapplications` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `AppID` varchar(50) CHARACTER SET latin1 NOT NULL,
  `AppName` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tapplications`
--

INSERT INTO `tapplications` (`NumDoc`, `AppID`, `AppName`) VALUES
('D001', '', 'Roofing Outdoor,Roofing Indoor'),
('D002', '', 'Roofing Outdoor,Dome,Special Application (request) - continue to detail of special applications requested'),
('D003', '', 'Roofing Outdoor'),
('D004', '', 'Roofing Outdoor,Surface Loose (outdoor)'),
('D005', '', 'Roofing Outdoor'),
('D006', '', 'Roofing Outdoor'),
('D007', '', 'Roofing Outdoor, Roofing Indoor'),
('D008', '', 'Roofing Outdoor'),
('D009', '', 'Roofing Outdoor,Roofing Indoor'),
('D010', '', 'Roofing Outdoor, Roofing Indoor'),
('D011', '', 'Roofing Outdoor'),
('D012', '', 'Roofing Outdoor'),
('D013', '', 'Roofing Outdoor, Roofing Indoor'),
('D014', '', 'Roofing Outdoor, Roofing Indoor'),
('D015', '', 'Roofing Outdoor'),
('D016', '', 'Roofing Outdoor, Roofing Indoor'),
('D017', '', 'Roofing Outdoor,Roofing Indoor,Archineering Facade,Archineering Sculpture,Viroforms Produc'),
('D018', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor),Surface Loose (indoor),Surface + backing (indoor),Surface + frame (outdoor),Surface + frame (indoor),Handicraft (outdoor),Handicraft (indoor),Archineering Facade,Archineering Sculpture,Umbrella,Archineering Ceiling,Viroforms Produc'),
('D019', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor),Surface Loose (indoor),Surface + backing (indoor),Surface + frame (outdoor),Surface + frame (indoor),Handicraft (outdoor),Handicraft (indoor),Archineering Partition,Archineering Facade,Archineering Ornament,Archineering Sculpture,Archineering (others),Umbrella,Dome,Archineering Ceiling,Varyan Product,Viroforms Product,Special Application (request) - continue to detail of special applications requested'),
('D020', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor),Surface Loose (indoor),Surface + backing (indoor),Surface + frame (outdoor),Surface + frame (indoor),Handicraft (outdoor),Handicraft (indoor),Archineering Partition,Archineering Facade,Archineering Ornament,Archineering Sculpture,Archineering (others),Umbrella,Dome,Archineering Ceiling,Varyan Product,Viroforms Product,Special Application (request) - continue to detail of special applications requested'),
('D021', '', 'Roofing Outdoor,Handicraft (indoor),Archineering Ceiling,Varyan Product,Viroforms Product,Special Application (request) - continue to detail of special applications requested'),
('D022', '', 'Roofing Outdoor,Handicraft (indoor),Archineering Ceiling,Varyan Product,Viroforms Product,Special Application (request) - continue to detail of special applications requested'),
('D023', '', 'Roofing Outdoor,Roofing Indoo'),
('D024', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor'),
('D025', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor),Surface Loose (indoor'),
('D026', '', 'Roofing Outdoo'),
('D027', '', 'Handicraft (indoor),Archineering Partitio'),
('D028', '', 'Roofing Outdoo'),
('D029', '', 'Roofing Outdoor'),
('D030', '', 'Roofing Outdoo'),
('D031', '', 'Roofing Outdoo'),
('D032', '', 'Roofing Outdoor'),
('D033', '', 'Roofing Outdoo'),
('D034', '', 'Roofing Outdoor,Roofing Indoo'),
('D035', '', 'Roofing Outdoor,Roofing Indoo'),
('D036', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor'),
('D037', '', 'Roofing Outdoor,Roofing Indoo'),
('D038', '', 'Roofing Outdoor,Roofing Indoo'),
('D039', '', 'Roofing Outdoor,Handicraft (indoor),Archineering Ceilin'),
('D040', '', 'Roofing Outdoor,Roofing Indoo'),
('D041', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor'),
('D042', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor'),
('D043', '', 'Roofing Outdoor,Roofing Indoor,Surface Loose (outdoor');

-- --------------------------------------------------------

--
-- Table structure for table `tattachfa`
--

CREATE TABLE `tattachfa` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `FileDocFA` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tattachrnd`
--

CREATE TABLE `tattachrnd` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `FileDocRND` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tattachsales`
--

CREATE TABLE `tattachsales` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `FileDocSales` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tdocument`
--

CREATE TABLE `tdocument` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `DateRequest` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `NPDType` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `NPDTypeName` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `CodeProject` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `Prod_Name` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `CustName` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `CustPhone` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `DateFeedbackExp` datetime DEFAULT NULL,
  `PatternFiber` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `WhatFiber` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `SpecialSize` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `OtherLinkDrawing` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `PackagingDetail` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `Square` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `Budget` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `Location` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `DateTarget` datetime DEFAULT NULL,
  `ImportantRequest` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `DateVerification` datetime DEFAULT NULL,
  `DateEstBOM` datetime DEFAULT NULL,
  `DateCosting` datetime DEFAULT NULL,
  `DateClose` datetime DEFAULT NULL,
  `EmailSales` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `plant` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `EmailRND` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `EmailFA` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `EmailMKT` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `StatusRequest` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `StatusDoc` varchar(200) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tdocument`
--

INSERT INTO `tdocument` (`NumDoc`, `DateRequest`, `update_date`, `NPDType`, `NPDTypeName`, `CodeProject`, `Prod_Name`, `CustName`, `CustPhone`, `DateFeedbackExp`, `PatternFiber`, `WhatFiber`, `SpecialSize`, `OtherLinkDrawing`, `PackagingDetail`, `Square`, `Budget`, `Location`, `DateTarget`, `ImportantRequest`, `DateVerification`, `DateEstBOM`, `DateCosting`, `DateClose`, `EmailSales`, `plant`, `EmailRND`, `EmailFA`, `EmailMKT`, `StatusRequest`, `StatusDoc`) VALUES
('D001', '2023-02-03 09:10:33', '2023-02-03 09:10:33', 'Varyan', 'Varyan', 'Test 1', 'Test 1', 'Test 1', '085716315019', '2023-02-03 09:11:00', 'Test 1 Pattern', 'Test 1 Fiber 8', '180 m x 200 m', 'http://www.viroworld.com', 'Test 1', 'Test 1', 'Test 1', 'Jakarta', '2023-02-09 09:12:00', 'Test 1', '2023-02-15 11:59:00', '2023-02-06 11:59:45', '2023-02-06 12:00:43', NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'itmanager@viroworld.com', 'SALES', 'OPEN'),
('D002', '2023-02-03 10:37:43', '2023-02-03 10:37:43', 'Archineering Project (cost and schedule)', 'Archineering Project (cost and schedule)', '12', 'Test 2', 'Test 2', '085714142414', '2023-02-04 10:38:00', 'Test 2', 'Test 5 Fiber', '120 x 120', 'http://www.viroworld.com', 'Test 2', 'Test 2', '123', 'Bandung', '2023-02-10 10:48:00', 'Test 2', '2023-02-22 11:52:00', '2023-02-06 11:52:01', '0000-00-00 00:00:00', NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'nazmudinahmad0@gmail.com', 'SALES', 'OPEN'),
('D003', '2023-02-06 08:53:55', '2023-02-06 08:53:55', 'New NPD - weaving pattern', 'New NPD - weaving pattern', 'TEST', 'TEST', 'TEST', '08199999999', '2023-02-06 08:53:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2023-02-06 08:54:00', 'TEST', '2023-02-06 13:43:00', '2023-02-06 13:43:49', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', NULL, 'FA', 'OPEN'),
('D004', '2023-02-06 11:21:06', '2023-02-06 11:21:06', 'New NPD - Sample Weaving Pattern', 'New NPD - Sample Weaving Pattern', '101', 'Test 101', 'Test 101', '101', '2023-02-07 11:21:00', 'Test 101', 'Test 101', '120 x 120', 'http://www.viroworld.com', 'Test 101', 'Test 101', '5000000', 'Bandung', '2023-02-16 11:22:00', 'Test 101', '2023-02-08 11:44:00', '2023-02-06 11:44:32', '0000-00-00 00:00:00', NULL, 'nazmudinahmad0@gmail.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'nazmudinahmad0@gmail.com', 'SALES', 'OPEN'),
('D005', '2023-02-06 13:31:41', '2023-02-06 13:31:41', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'Archineering Project - Estimasi BOM, Costing & Schedule', '321', 'Product 321', 'Customer 321', '085716315019', '2023-02-07 13:32:00', 'Test 321', 'WF 321', '180 m x 200 m', 'http://www.viroworld.com', 'PD 321', 'Test 321', '123', 'Jakarta', '2023-02-22 13:33:00', 'Test 321', '2023-02-16 16:21:00', '2023-02-06 16:21:02', '2023-02-06 16:22:42', NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'nazmudinahmad0@gmail.com', 'SALES', 'OPEN'),
('D006', '2023-02-06 13:45:45', '2023-02-06 13:45:45', 'npd004', 'Sample Varyan', 'COBA APLIKASI', 'COBA APLIKASI', 'COBA APLIKASI', '08199999999', '2023-02-06 13:45:00', 'COBA APLIKASI', 'COBA APLIKASI', 'COBA APLIKASI', 'COBA APLIKASI', 'COBA APLIKASI', '1', '1', 'COBA APLIKASI', '2023-02-06 13:45:00', 'COBA APLIKASI', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D007', '2023-02-06 14:24:45', '2023-02-06 14:24:45', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'P009', 'Test', 'Test', '085716315019', '2023-02-07 14:25:00', 'Test', 'Test', '180 m x 200 m', 'http://www.viroworld.com', 'Test', 'Test', '5000000', 'Bandung', '2023-02-15 14:26:00', 'Test', '2023-02-09 16:01:00', '2023-02-06 16:01:25', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', NULL, 'FA', 'OPEN'),
('D008', '2023-02-06 15:49:14', '2023-02-06 15:49:14', 'Sample Viroforms', 'Sample Viroforms', 'COBA', 'COBA', 'COBA', '08199999999', '2023-02-06 15:48:00', 'COBA', 'COBA', 'COBA', 'COBA', 'COBA', '1', '1', 'COBA', '2023-02-06 15:49:00', 'COBA', '2023-02-06 15:52:00', '2023-02-06 15:53:21', '2023-02-06 15:54:07', NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'itmanager@viroworld.com', 'SALES', 'OPEN'),
('D009', '2023-02-07 08:27:54', '2023-02-07 08:27:54', 'New NPD - Sample Weaving Pattern', 'New NPD - Sample Weaving Pattern', '123', 'test 123', 'test 123', '123', '2023-02-08 08:29:00', 'test 123', 'fiber 123', 'test 123', 'http://www.viroworld.com', 'test 123', 'test 123', '5000000', 'Lombok', '2023-02-24 08:30:00', 'test 123', '2023-02-07 15:45:17', '2023-02-07 15:45:17', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'CLOSE'),
('D010', '2023-02-07 09:11:48', '2023-02-07 09:11:48', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', '321', 'test 321', 'test 321', '0812323234', '2023-02-09 09:12:00', 'test 321', 'test 321 fiber', 'test 321', 'http://www.viroworld.com', 'test 321', 'test 321', 'test 321', 'Bandung', '2023-02-23 09:12:00', 'test 321', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D011', '2023-02-07 15:48:56', '2023-02-07 15:48:56', 'npd005', 'Sample Viroforms', 'Sample', 'Kirim Sample', 'Customer Sample', '08199999999', '2023-02-07 15:48:00', 'Sample', 'Sample', 'Sample', 'Sample', 'Sample', '1', '1', 'Sample', '2023-02-07 15:49:00', 'Sample', '2023-02-07 15:51:14', '2023-02-07 15:51:14', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'CLOSE'),
('D012', '2023-02-07 17:02:31', '2023-02-07 17:02:31', 'npd003', 'Development/Improvement of Product - Estimasi BOM & Costing ', 'TX CODE', 'TX NAME', 'TX', '08199999999', '2023-02-07 17:02:00', 'TX', 'TX', 'TX', 'TX', 'TX', 'TX', '1', 'TX', '2023-02-07 17:03:00', 'TX', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D013', '2023-02-08 10:40:15', '2023-02-08 10:40:15', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'a1', 'a1', 'a1', '085766666666', '2023-02-08 10:40:00', 'a1', 'a1 fiber', 'a1', 'http://www.viroworld.com', 'a1', 'a1', 'a1', 'Jakarta', '2023-02-23 10:41:00', 'a1', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'SALES', 'OPEN'),
('D014', '2023-02-08 10:44:13', '2023-02-08 10:44:13', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'B1', 'B1', 'B1', '085716315019', '2023-02-09 10:44:00', 'B1', 'B1 FIBER', 'B1', 'http://www.viroworld.com', 'B1', 'B1', 'B1', 'Bandung', '2023-02-16 10:45:00', 'B1', '2023-02-10 10:32:00', '2023-02-09 10:32:11', '2023-02-09 15:06:49', NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'itmanager@viroworld.com', 'SALES', 'OPEN'),
('D015', '2023-02-08 11:12:44', '2023-02-08 11:12:44', 'npd003', 'Development/Improvement of Product - Estimasi BOM & Costing ', 'TEST DEVELOPMENT', 'TEST DEVELOPMENT', 'TEST DEVELOPMENT', '08199999999', '2023-02-08 11:12:00', 'TEST DEVELOPMENT', 'TEST DEVELOPMENT', 'TEST DEVELOPMENT', 'TEST DEVELOPMENT', 'TEST DEVELOPMENT', '1', '1', 'TEST DEVELOPMENT', '2023-02-08 11:12:00', 'TEST DEVELOPMENT', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'SALES', 'OPEN'),
('D016', '2023-02-08 13:27:55', '2023-02-08 13:27:55', 'npd003', 'Development/Improvement of Product - Estimasi BOM & Costing ', '56', 'product 56', '56', '085756565656', '2023-02-09 13:28:00', 'wp 56', 'wf 56', '180 m x 200 m', 'http://www.viroworld.com', 'pd 56', '56', '560000', 'Jakarta', '2023-02-23 13:29:00', '56', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'SALES', 'OPEN'),
('D017', '2023-02-08 16:09:40', '2023-02-08 16:09:40', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'r1', 'r1', 'r1', 'r1', '2023-02-16 16:10:00', 'r1', 'r1', 'r1', 'r1', 'r1', 'r1', 'r1', 'Jakarta', '2023-02-28 16:10:00', 'r1', '0000-00-00 00:00:00', NULL, NULL, '0000-00-00 00:00:00', 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', '', '', 'SALES', 'CLOSE'),
('D018', '2023-02-08 16:15:15', '2023-02-08 16:15:15', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'r2', 'r2', 'r2', '09898989898', '2023-02-09 16:15:00', 'r2', 'r2', 'r2', 'r2', 'r2', 'r2', 'r2', 'Jakarta', '2023-02-23 16:16:00', 'r2', '2023-02-10 10:05:00', '2023-02-09 10:05:17', '2023-02-09 10:07:33', '0000-00-00 00:00:00', 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'itmanager@viroworld.com', 'SALES', 'CLOSE'),
('D019', '2023-02-08 16:22:48', '2023-02-08 16:22:48', 'Sample Varyan', 'Sample Varyan', 'r3', 'r3', 'r3', '085716315019', '2023-02-15 16:23:00', 'r3', 'r3', 'r3', 'http://www.viroworld.com', 'r3', 'r3', 'r3', 'Jakarta', '2023-02-24 16:24:00', 'r3', '2023-02-09 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', '', '', 'SALES', 'ORDER'),
('D020', '2023-02-08 16:35:08', '2023-02-08 16:35:08', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'r4', 'r4', 'r4', '085716315019', '2023-02-09 16:35:00', 'r4', 'r4', 'r4', 'r4', 'r4', 'r4', 'r4', 'r4', '2023-02-23 16:36:00', 'r4', '2023-02-09 00:00:00', '2023-02-09 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', '', '', 'SALES', 'CLOSE'),
('D021', '2023-02-08 16:43:46', '2023-02-08 16:43:46', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'r5', 'r5', 'r5', 'r5', '2023-02-15 16:44:00', 'r5', 'r5', 'r5', 'r5', 'r5', 'r5', 'r5', 'r5', '2023-02-28 16:44:00', 'r5', '2023-02-09 00:00:00', '2023-02-09 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', '', '', 'SALES', 'CORRECTED'),
('D022', '2023-02-09 09:41:58', NULL, 'Archineering Project - Estimasi BOM, Costing & Schedule', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'r5', 'r5', 'r5', 'r5', '2023-02-15 16:44:00', 'r5', NULL, 'r5', 'r5', 'r5', 'r5', 'r5', 'r5', '2023-02-28 16:44:00', 'r5', '2023-02-09 00:00:00', '2023-02-09 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'itmanager@viroworld.com', NULL, 'viroworld.an@gmail.com', '', '', 'SALES', 'OPEN'),
('D023', '2023-02-09 14:03:07', '2023-02-09 14:03:07', 'npd001', 'New NPD - Sample Weaving Pattern', '21', '21', '21', '21', '2023-02-10 13:03:00', '21', '21', '21', '21', '21', '21', '21', 'Jakarta', '2023-02-13 14:04:00', '21', '2023-02-09 14:35:27', '2023-02-09 14:35:27', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'CLOSE'),
('D024', '2023-02-09 14:05:16', '2023-02-09 14:05:16', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', '22', '22', '22', '22', '2023-02-13 14:05:00', '22', '22', '22', '22', '22', '22', '22', 'Bandung', '2023-02-14 14:06:00', '22', '2023-02-14 14:32:00', '2023-02-09 14:32:50', '2023-02-09 14:47:21', NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', 'itmanager@viroworld.com', 'SALES', 'OPEN'),
('D025', '2023-02-09 14:06:36', '2023-02-09 14:06:36', 'npd003', 'Development/Improvement of Product - Estimasi BOM & Costing', '23', '23', '23', '23', '2023-02-15 14:06:00', '23', '23', '23', '23', '23', '23', '23', '23', '2023-02-23 14:07:00', '23', '2023-02-16 14:30:00', '2023-02-09 14:30:31', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', 'viroworld.an@gmail.com', NULL, 'NPD', 'OPEN'),
('D026', '2023-02-09 14:08:06', '2023-02-09 14:08:06', 'npd004', 'Sample Varyan', '24', '24', '24', '24', '2023-02-23 14:08:00', '24', '24', '24', '24', '24', '24', '24', '24', '2023-02-24 14:08:00', '24', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'SALES', 'OPEN'),
('D027', '2023-02-09 14:09:23', '2023-02-09 14:09:23', 'npd005', 'Sample Viroforms', '25', '25', '25', '25', '2023-02-27 14:09:00', '25', '25', '25', '25', '25', '25', '25', '25', '2023-02-28 14:10:00', '25', '2023-02-09 14:13:32', '2023-02-09 14:13:32', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'CLOSE'),
('D028', '2023-02-09 14:39:23', '2023-02-09 14:39:23', 'npd004', 'Sample Varyan', '123', '123', '123', '123', '2023-02-16 14:39:00', '123', '123', '123', '123', '123', '123', '123', '123', '2023-02-17 14:40:00', '123', '2023-02-09 14:42:00', '2023-02-09 14:42:00', NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'CLOSE'),
('D029', '2023-02-09 16:28:13', '2023-02-09 16:28:13', 'Development/Improvement of Product - Estimasi BOM & Costing', 'Development/Improvement of Product - Estimasi BOM & Costing', 'XXX', 'XXX', 'XXX', '08199999999', '2023-02-09 16:28:00', 'XXX', 'XXX', 'XXX', 'XXX', 'XXX', '1', '1', 'XXX', '2023-02-09 16:28:00', 'XXX', '2023-02-09 00:00:00', NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D030', '2023-02-09 16:39:06', '2023-02-09 16:39:06', 'npd001', 'New NPD - Sample Weaving Pattern', '333', '333', '333', '0812323234', '2023-02-10 16:39:00', '333', '333', '333', '333', '333', '333', '333', 'Bandung', '2023-02-23 16:40:00', '333', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'SALES', 'OPEN'),
('D031', '2023-02-09 16:41:26', '2023-02-09 16:41:26', 'npd001', 'New NPD - Sample Weaving Pattern', 'YYY', 'YYY', 'YYY', '08199999999', '2023-02-09 16:41:00', 'YYY', 'YYY', 'YYY', 'YYY', 'YYY', '1', '1', 'YYY', '2023-02-09 16:41:00', 'YYY', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'SALES', 'OPEN'),
('D032', '2023-02-09 16:52:23', '2023-02-09 16:52:23', 'New NPD - Sample Weaving Pattern', 'New NPD - Sample Weaving Pattern', '555', '555', '555', '555', '2023-02-10 16:54:00', '555', '555', '555', '555', '555', '555', '555', '555', '2023-02-24 16:53:00', '555', '2023-02-09 00:00:00', NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D033', '2023-02-09 16:56:51', '2023-02-09 16:56:51', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', '56', '56', '56', '56', '2023-02-23 16:57:00', '56', '56', '56', '56', '56', '56', '56', '56', '2023-02-24 16:57:00', '56', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D034', '2023-02-09 16:59:03', '2023-02-09 16:59:03', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', '11', '11', '11', '11', '2023-02-22 16:59:00', '11', '11', '11', '11', '11', '11', '11', '11', '2023-02-28 16:59:00', '11', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D035', '2023-02-10 08:48:43', '2023-02-10 08:48:43', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', '6', '6', '6', '6', '2023-02-16 08:49:00', '6', '6', '6', '6', '6', '6', '6', '6', '2023-02-24 08:49:00', '6', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D036', '2023-02-10 09:13:08', '2023-02-10 09:13:08', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'fix1', 'fix1', 'fix1', 'fix1', '2023-02-13 09:13:00', 'fix1', 'fix1', 'fix1', 'fix1', 'fix1', 'fix1', 'fix1', 'fix1', '2023-02-22 06:14:00', 'fix1', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D037', '2023-02-10 09:15:45', '2023-02-10 09:15:45', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'fix2', 'fix2', 'fix2', 'fix2', '2023-02-16 09:16:00', 'fix2', 'fix2', 'fix2', 'fix2', 'fix2', 'fix2', 'fix2', 'fix2', '2023-02-24 09:16:00', 'fix2', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D038', '2023-02-10 09:21:47', '2023-02-10 09:21:47', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'fix3', 'fix3', 'fix3', 'fix3', '2023-02-22 09:22:00', 'fix3', 'fix3', 'fix3', 'fix3', 'fix3', 'fix3', 'fix3', 'fix3', '2023-02-23 09:22:00', 'fix3', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D039', '2023-02-10 09:41:11', '2023-02-10 09:41:11', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'test123', 'test123', 'test123', 'test123', '2023-02-17 09:41:00', 'test123', 'test123', 'test123', 'test123', 'test123', 'test123', 'test123', 'test123', '2023-02-28 09:42:00', 'test123', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D040', '2023-02-10 09:45:16', '2023-02-10 09:45:16', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', '121', '121', '121', '121', '2023-02-14 09:45:00', '121', '121', '121', '121', '121', '121', '121', '121', '2023-02-28 09:46:00', '121', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D041', '2023-02-10 09:53:05', '2023-02-10 09:53:05', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'try', 'try', 'try', 'try', '2023-02-13 09:53:00', 'try', 'try', 'try', 'try', 'try', 'try', 'try', 'try', '2023-02-22 09:54:00', 'try', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D042', '2023-02-10 09:57:09', '2023-02-10 09:57:09', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 't1', 't1', 't1', '085716315019', '2023-02-16 09:57:00', 't1', 't1', 't1', 't1', 't1', 't1', 't1', 't1', '2023-02-28 09:58:00', 't1', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN'),
('D043', '2023-02-10 10:13:56', '2023-02-10 10:13:56', 'npd002', 'Archineering Project - Estimasi BOM, Costing & Schedule', 'test 123', 'test 123', 'test 123', 'test 123', '2023-02-13 12:59:00', 'test 123', 'test 123', 'test 123', 'test 123', 'test 123', 'test 123', 'test 123', 'test 123', '2023-02-24 22:15:00', 'test 123', NULL, NULL, NULL, NULL, 'itmanager@viroworld.com', 'P1', 'viroworld.an@gmail.com', NULL, NULL, 'NPD', 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `tframedetail`
--

CREATE TABLE `tframedetail` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `FrmID` varchar(500) CHARACTER SET latin1 NOT NULL,
  `FrameName` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tframedetail`
--

INSERT INTO `tframedetail` (`NumDoc`, `FrmID`, `FrameName`) VALUES
('D001', '', 'using alumunium frame,using iron metal frame'),
('D002', '', 'using alumunium frame,Tidak menggunakan Frame'),
('D003', '', 'using alumunium frame'),
('D004', '', 'using alumunium frame,hollo profile'),
('D005', '', 'using alumunium frame'),
('D006', '', 'using alumunium frame'),
('D007', '', 'using alumunium frame, using iron metal frame'),
('D008', '', 'using alumunium frame'),
('D009', '', 'using alumunium frame,using iron metal frame'),
('D010', '', 'using alumunium frame, using iron metal frame'),
('D011', '', 'using alumunium frame'),
('D012', '', 'using alumunium frame'),
('D013', '', 'using alumunium frame, using iron metal frame'),
('D014', '', 'using alumunium frame, using iron metal frame'),
('D015', '', 'using alumunium frame'),
('D016', '', 'using alumunium frame, using iron metal frame, Tidak menggunakan Frame'),
('D017', '', 'using alumunium frame,pipe profile,standard size 40 x 40 cm,Tidak menggunakan Fram'),
('D018', '', 'using alumunium frame,hollo profile,standard size 40 x 40 c'),
('D019', '', 'using alumunium frame,hollo profile'),
('D020', '', 'using alumunium frame,using iron metal frame,hollo profile,pipe profile,standard size 40 x 40 cm,Tidak menggunakan Frame'),
('D021', '', 'using alumunium frame,pipe profile,standard size 40 x 40 cm,Tidak menggunakan Frame'),
('D022', '', 'using alumunium frame,pipe profile,standard size 40 x 40 cm,Tidak menggunakan Frame'),
('D023', '', 'using alumunium frame,using iron metal fram'),
('D024', '', 'using alumunium frame,using iron metal frame,hollo profil'),
('D025', '', 'using alumunium frame,using iron metal frame,hollo profile,pipe profil'),
('D026', '', 'using alumunium fram'),
('D027', '', 'pipe profile,standard size 40 x 40 c'),
('D028', '', 'using alumunium fram'),
('D029', '', 'using alumunium frame'),
('D030', '', 'using alumunium fram'),
('D031', '', 'using alumunium fram'),
('D032', '', 'using alumunium frames'),
('D033', '', 'using alumunium fram'),
('D034', '', 'using alumunium frame,using iron metal fram'),
('D035', '', 'using alumunium frame,using iron metal fram'),
('D036', '', 'using alumunium frame,using iron metal frame,hollo profil'),
('D037', '', 'using alumunium frame,using iron metal fram'),
('D038', '', 'using alumunium frame,using iron metal fram'),
('D039', '', 'using alumunium frame,pipe profil'),
('D040', '', 'using alumunium frame,using iron metal fram'),
('D041', '', 'using alumunium frame,using iron metal frame,hollo profil'),
('D042', '', 'using alumunium frame,using iron metal frame,hollo profil,'),
('D043', '', 'using alumunium frame,using iron metal frame,hollo profil');

-- --------------------------------------------------------

--
-- Table structure for table `tgeninformation`
--

CREATE TABLE `tgeninformation` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `GenID` varchar(200) CHARACTER SET latin1 NOT NULL,
  `GenifName` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tgeninformation`
--

INSERT INTO `tgeninformation` (`NumDoc`, `GenID`, `GenifName`) VALUES
('D001', '', 'Archineering Project,Request for costing estimation'),
('D002', '', 'Archineering Project,Installation by Viro,Request for Exhibition or Event'),
('D003', '', 'Archineering Project'),
('D004', '', 'Archineering Project,Request for design'),
('D005', '', 'Archineering Project'),
('D006', '', 'Archineering Project'),
('D007', '', 'Archineering Project, Request for costing estimation'),
('D008', '', 'Archineering Project'),
('D009', '', 'Archineering Project,Request for costing estimation'),
('D010', '', 'Archineering Project, Request for costing estimation'),
('D011', '', 'Archineering Project'),
('D012', '', 'Archineering Project'),
('D013', '', 'Archineering Project, Request for costing estimation'),
('D014', '', 'Archineering Project, Request for costing estimation'),
('D015', '', 'Archineering Project'),
('D016', '', 'Archineering Project, Request for costing estimation'),
('D017', '', 'Archineering Project,Request for costing estimation,Request for design,Special request for shipment,Installation by Viro,Request for Exhibition or Even'),
('D018', '', 'Archineering Project,Request for design,Special request for packaging,Installation by client,Shipment by client,Request for Exhibition or Even'),
('D019', '', 'Archineering Project,Request for design,Special request for packaging,Installation by client,Shipment by client'),
('D020', '', 'Archineering Project,Request for costing estimation,Request for design,Request for prototyping,Special request for packaging,Special request for shipment,Installation by client,Installation by Viro,Shipment by client,Shipment by Viro,Request for Exhibition or Event'),
('D021', '', 'Archineering Project,Shipment by client,Shipment by Viro,Request for Exhibition or Event'),
('D022', '', 'Archineering Project,Shipment by client,Shipment by Viro,Request for Exhibition or Event'),
('D023', '', 'Archineering Project,Request for costing estimatio'),
('D024', '', 'Archineering Project,Request for costing estimation,Request for desig'),
('D025', '', 'Archineering Project,Request for costing estimation,Request for design,Request for prototypin'),
('D026', '', 'Archineering Projec'),
('D027', '', 'Special request for packaging,Special request for shipmen'),
('D028', '', 'Archineering Projec'),
('D029', '', 'Archineering Project'),
('D030', '', 'Archineering Projec'),
('D031', '', 'Archineering Projec'),
('D032', '', 'Archineering Projects'),
('D033', '', 'Archineering Projec'),
('D034', '', 'Archineering Project,Request for costing estimatio'),
('D035', '', 'Archineering Project,Request for costing estimatio'),
('D036', '', 'Archineering Project,Request for costing estimation,Request for desig'),
('D037', '', 'Archineering Project,Request for costing estimatio'),
('D038', '', 'Archineering Project,Request for costing estimatio'),
('D039', '', 'Archineering Project,Special request for packaging,Shipment by clien'),
('D040', '', 'Archineering Project,Request for costing estimatio'),
('D041', '', 'Archineering Project,Request for costing estimation,Request for desig'),
('D042', '', 'Archineering Project,Request for costing estimation,Request for desig'),
('D043', '', 'Archineering Project,Request for costing estimation,Request for desig');

-- --------------------------------------------------------

--
-- Table structure for table `thistorycomment`
--

CREATE TABLE `thistorycomment` (
  `NumDoc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `DateComment` datetime DEFAULT NULL,
  `Dept` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Comment` varchar(1000) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thistorycomment`
--

INSERT INTO `thistorycomment` (`NumDoc`, `DateComment`, `Dept`, `Comment`) VALUES
('D001', '2023-02-03 09:51:26', 'NPD', 'Tolong di update datanya'),
('D003', '2023-02-06 08:57:20', 'NPD', 'TEST RETURN NPD 1'),
('D004', '2023-02-06 11:28:12', 'NPD', 'tolong data di perbaiki'),
('D004', '2023-02-06 11:33:22', 'NPD', 'masih belum sesuai, tolong di update'),
('D004', '2023-02-06 00:00:00', 'FA', 'ini data masih salah, harap di perbaiki'),
('D001', '2023-02-06 00:00:00', 'FA', 'di kembalikan'),
('D005', '2023-02-06 13:35:43', 'FA', 'test tampil tanggal'),
('D008', '2023-02-06 15:50:56', 'NPD', 'Retur 1'),
('D008', '2023-02-06 15:52:53', 'FA', 'Return 2'),
('D005', '2023-02-06 16:11:02', 'FA', 'di return'),
('D005', '2023-02-06 16:15:44', 'FA', 'test return'),
('D005', '2023-02-06 16:20:16', 'FA', 'Di return lagi'),
('D009', '2023-02-07 09:05:53', 'NPD', 'return'),
('D013', '0000-00-00 00:00:00', 'Sales', 'Sales membuat RNP'),
('D014', '2023-02-08 10:44:13', 'Sales', 'Sales Request'),
('D015', '2023-02-08 11:12:44', 'Sales', 'Sales Request'),
('D016', '2023-02-08 13:27:55', 'Sales', 'Sales Request'),
('D016', '2023-02-08 14:39:27', 'NPD', 'return'),
('D013', '2023-02-08 15:34:27', 'NPD', 'return'),
('D017', '2023-02-08 16:09:40', 'Sales', 'Sales Request'),
('D018', '2023-02-08 16:15:15', 'Sales', 'Sales Request'),
('D019', '2023-02-08 16:22:48', 'Sales', 'Sales Request'),
('D020', '2023-02-08 16:35:08', 'Sales', 'Sales Request'),
('D021', '2023-02-08 16:43:46', 'Sales', 'Sales Request'),
('D021', '2023-02-08 16:43:46', 'Sales', 'Sales Update Request'),
('D020', '2023-02-08 16:35:08', 'Sales', 'Sales Update Request'),
('D019', '2023-02-08 16:22:48', 'Sales', 'Sales Update Request'),
('D020', '2023-02-09 09:39:33', 'NPD', 'di return'),
('D020', '2023-02-09 09:40:29', 'SALES', 'Sudah di close'),
('D021', '2023-02-09 09:41:16', 'NPD', 'return'),
('D021', '2023-02-09 09:41:58', 'SALES', 'sudah di koreksi'),
('', '2023-02-09 09:42:32', 'SALES', 'di order'),
('', '2023-02-09 09:43:26', 'SALES', 'order'),
('D019', '2023-02-09 09:46:38', 'NPD', 'return'),
('D019', '2023-02-09 09:47:40', 'SALES', 'lanjut order'),
('D018', '2023-02-09 10:09:06', 'SALES', 'Close'),
('D017', '2023-02-09 10:25:35', 'NPD', 'return r1'),
('D017', '2023-02-09 10:26:38', 'SALES', 'status close'),
('D015', '2023-02-09 10:31:04', 'NPD', 'npd return'),
('D023', '2023-02-09 14:03:07', 'Sales', 'Sales Request'),
('D024', '2023-02-09 14:05:16', 'Sales', 'Sales Request'),
('D025', '2023-02-09 14:06:36', 'Sales', 'Sales Request'),
('D026', '2023-02-09 14:08:06', 'Sales', 'Sales Request'),
('D027', '2023-02-09 14:09:23', 'Sales', 'Sales Request'),
('D026', '2023-02-09 14:29:50', 'NPD', 'RETURN OLEH NPD'),
('D023', '2023-02-09 14:35:27', 'Sales', ''),
('D028', '2023-02-09 14:39:23', 'Sales', 'Sales Request'),
('D028', '2023-02-09 14:42:00', 'NPD', 'NPD Send Sample'),
('D025', '2023-02-09 14:46:45', 'FA', 'return'),
('D014', '2023-02-09 15:06:49', 'FA', 'FA Update Request'),
('D029', '2023-02-09 16:28:13', 'Sales', 'Sales Request'),
('D029', '2023-02-09 16:30:37', 'NPD', 'Balik dari NPD'),
('D029', '2023-02-09 16:28:13', 'Sales', 'Sales Update Request'),
('D029', '2023-02-09 16:40:17', 'NPD', 'Return NPD lagi'),
('D030', '2023-02-09 16:39:06', 'Sales', 'Sales Request'),
('D029', '2023-02-09 16:28:13', 'Sales', 'Sales Update Request'),
('D030', '2023-02-09 16:41:11', 'NPD', 'test return'),
('D031', '2023-02-09 16:41:26', 'Sales', 'Sales Request'),
('D031', '2023-02-09 16:42:43', 'NPD', 'Balik 1'),
('D032', '2023-02-09 16:52:23', 'Sales', 'Sales Request'),
('D032', '2023-02-09 16:52:23', 'Sales', 'Sales Update Request'),
('D033', '2023-02-09 16:56:51', 'Sales', 'Sales Request'),
('D034', '2023-02-09 16:59:03', 'Sales', 'Sales Request'),
('D035', '2023-02-10 08:48:43', 'Sales', 'Sales Request'),
('D036', '2023-02-10 09:13:08', 'Sales', 'Sales Request'),
('D037', '2023-02-10 09:15:45', 'Sales', 'Sales Request'),
('D038', '2023-02-10 09:21:47', 'Sales', 'Sales Request'),
('D039', '2023-02-10 09:41:11', 'Sales', 'Sales Request'),
('D040', '2023-02-10 09:45:16', 'Sales', 'Sales Request'),
('D041', '2023-02-10 09:53:05', 'Sales', 'Sales Request'),
('D042', '2023-02-10 09:57:09', 'Sales', 'Sales Request'),
('D043', '2023-02-10 10:13:56', 'Sales', 'Sales Request');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `UserName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Password` text CHARACTER SET latin1 NOT NULL,
  `DeptID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `Status` enum('Admin','Superuser','User') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `DeptID`, `Status`) VALUES
('U01', 'ahmad', 'zzz', 'D03', 'Admin'),
('U02', 'hans', 'xxx', 'D01', 'User'),
('U03', 'mika', 'yyy', 'D02', 'User'),
('U04', 'fauzi', 'fff', 'D01', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `usercategory`
--

CREATE TABLE `usercategory` (
  `UserID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `CategoryID` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usercategory`
--

INSERT INTO `usercategory` (`UserID`, `CategoryID`) VALUES
('U02', 'C03'),
('U03', 'C01'),
('U02', 'C01'),
('U02', 'C02'),
('U02', 'C02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `admin_sales`
--
ALTER TABLE `admin_sales`
  ADD PRIMARY KEY (`id_admin_sales`);

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`AppID`);

--
-- Indexes for table `dedurasi`
--
ALTER TABLE `dedurasi`
  ADD PRIMARY KEY (`id_durasi`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptID`);

--
-- Indexes for table `fa`
--
ALTER TABLE `fa`
  ADD PRIMARY KEY (`id_fa`);

--
-- Indexes for table `finish`
--
ALTER TABLE `finish`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `frame_detail`
--
ALTER TABLE `frame_detail`
  ADD PRIMARY KEY (`FrameID`);

--
-- Indexes for table `geninformation`
--
ALTER TABLE `geninformation`
  ADD PRIMARY KEY (`GenID`);

--
-- Indexes for table `npd`
--
ALTER TABLE `npd`
  ADD PRIMARY KEY (`id_npd`);

--
-- Indexes for table `npdtype`
--
ALTER TABLE `npdtype`
  ADD PRIMARY KEY (`NPDTypeID`);

--
-- Indexes for table `ppic`
--
ALTER TABLE `ppic`
  ADD PRIMARY KEY (`id_ppic`);

--
-- Indexes for table `prod_order`
--
ALTER TABLE `prod_order`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `proforma_inv`
--
ALTER TABLE `proforma_inv`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tapplications`
--
ALTER TABLE `tapplications`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tattachfa`
--
ALTER TABLE `tattachfa`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tattachrnd`
--
ALTER TABLE `tattachrnd`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tattachsales`
--
ALTER TABLE `tattachsales`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tdocument`
--
ALTER TABLE `tdocument`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tframedetail`
--
ALTER TABLE `tframedetail`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `tgeninformation`
--
ALTER TABLE `tgeninformation`
  ADD PRIMARY KEY (`NumDoc`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
