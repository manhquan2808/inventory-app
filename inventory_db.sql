-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 10:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(10) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `number` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `inventory_id` int(10) UNSIGNED NOT NULL,
  `otp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `role_id`, `first_name`, `last_name`, `number`, `email`, `password`, `birth_date`, `create_date`, `update_date`, `inventory_id`, `otp`) VALUES
('AD34284', 1, 'Nguyễn Văn', 'F', '0123654987', 'w@gmail.com', '$2y$10$MYi5E9X.6/iG9iR91SceueFpWmowLcVeE0ciVduordFN/Bu6cJb2i', '2024-05-01', '2024-05-14 08:05:59', '2024-05-14 08:05:59', 1, 0),
('AD72789', 1, 'Mạnh', 'Mueller', '535', 'cysytuz@mailinator.com', '$2y$10$mmoXkJkH7hywSRk8gwdhxOIKGeiCw0ovd3htfTzqGcHyNP4UtTd5K', '1998-05-13', '2024-05-17 10:43:57', '2024-05-27 05:42:32', 1, 0),
('AD78061', 1, 'Iliana', 'Lowery', '285', 'xyvysomily@mailinator.com', '$2y$10$ZROjYs.TH/yr/2kUPFbZz.KQQ1gwvIL/u.Qg2R47xMTENSwOPHXnG', '2013-11-30', '2024-05-21 11:18:41', '2024-05-21 11:18:41', 5, 0),
('AD80603', 1, 'Nguyễn Văn', 'A', '0123654987', 'a123@gmail.com', '$2y$10$aGD6ToNUnVSqkp/WOGcD9e5ktzdAPZbde9eCrRohR9nGL5vrwEEUG', '2024-04-03', '2024-04-23 17:28:36', '2024-05-05 13:20:19', 1, 0),
('NVNL25026', 54, 'Medge', 'Fischer', '528', 'wederosiv@gmail1.com', '$2y$10$ICEBoGYqkAwo.fcqOkSYI.IFobHJhGn88BNI7rlMRudI24oX4tbYi', '1997-11-24', '2024-05-18 10:01:02', '2024-05-18 10:01:02', 1, 0),
('NVNL41739', 54, 'Nguyễn Văn', 'B', '0123654987', 'adsadsa123@gmail.com', '$2y$10$YNCcdSkxcpvU4Vr7kmmtvetVqxOMt22H1kleocuGewCGFXbXuGryS', '2024-05-03', '2024-05-25 13:42:23', '2024-05-25 13:42:23', 1, 0),
('NVNL66377', 54, 'Candace', 'Ballard', '778', 'jeadfnsjsanfjlspu@mailinator.com', '$2y$10$b3zactaRI1kD7pcM2skNpeRT1zcZoeBCZuoHbco9jj11sCnMeaRwG', '2022-08-16', '2024-05-18 09:46:09', '2024-05-18 09:46:09', 1, 0),
('NVNL68149', 54, 'Garrison', 'Mcneil', '11', 'gysecu@mailinator.com', '$2y$10$XpcdTjZ9LfoooHvCe1yz4.i6JLRM2ucJ25/zqNcz9Tv9Lh70ntnZG', '2002-01-06', '2024-05-21 11:24:03', '2024-05-21 11:24:03', 6, 0),
('NVNL77228', 54, 'Chu Ngọc', 'Anh', '0123654987', 'chnganh54@gmail.com', '$2y$10$X5rTf5ZHmvCZJRNSkOcf/OS6AklrQSrwX75yTfIenjJreSa0icocW', '2002-04-05', '2024-05-18 14:42:16', '2024-05-18 14:42:16', 1, 0),
('NVNL78514', 54, 'Azalia', 'Figueroa', '988', 'hysezeb@mailinator.com', '$2y$10$CFv3oRQ8gJq504Cx/HWFV.W3TE6SgYYzwrooKh45MgCMvimJYlTxO', '1994-05-08', '2024-05-17 18:57:18', '2024-05-17 18:57:18', 1, 0),
('NVNL85270', 54, 'Stephanie', 'Small', '673', 'quan9102323@gmail.com', '$2y$10$EJR7AgDRPneLZghjgFCZguyTJwLYkPRbbH/kmLhoWVWuE9KCW6MYG', '2012-05-31', '2024-05-27 05:42:03', '2024-05-27 05:58:24', 1, 687954),
('NVSP32840', 55, 'Gray', 'Buckley', '254', 'tecileqebu@mailinator.com', '$2y$10$70jlZhHZWb50uMEoi1Kfk.ercF9ur8XAWxf.wkTDGXzJ9SLMAl9MK', '2006-12-07', '2024-05-18 09:25:19', '2024-05-18 09:25:19', 1, 0),
('NVSP48803', 55, 'Paloma', 'Gay', '289', 'mefusyj@mailinator.com', '$2y$10$eEx1QVidc6LOAXTY7glq1OweDDvVQ22CvFw6E.0UrrjvX22/4uTfm', '1986-10-15', '2024-05-18 09:27:54', '2024-05-18 09:27:54', 1, 0),
('QLNVL18157', 49, 'Nguyễn Văn', 'C', '0123654987', 'c123@gmail.com', '$2y$10$1IYDjUpUqRO4NGmlLz1Mnu4PWV11CAU5VCSyrChS91zkYJAJtUHYa', '2001-06-12', '2024-05-07 09:25:55', '2024-05-07 09:40:14', 1, 0),
('QLTP29577', 50, 'Chava', 'Merritt', '413', 'd123@gmail.com', '$2y$10$ENGAM2XpyPNayWjray8EF.mYd6nLmGgNWr1F741BH1Vdp9USmdWUy', '1999-02-09', '2024-05-08 07:35:02', '2024-05-08 07:35:02', 1, 0),
('QLTP45838', 50, 'Trần Đại', 'Phúc', '0123654987', 'trandaiphuc2711@gmail.com', '$2y$10$BqNUQ1mhqWwa11NOwt09uOJc2uRY5uPoSKknBhAzfxkhYqz40kHH2', '1997-11-26', '2024-05-25 13:39:15', '2024-05-25 13:39:15', 1, 0),
('QLTP47586', 50, 'Vanna', 'Yang', '232', 'vowexikyre@mailinator.com', '$2y$10$jXCoINmoZav9oOp4kXDbB.iqABKobsR6YT8U9AryOWMP/KdDAFkbO', '1973-06-16', '2024-05-21 11:32:55', '2024-05-21 11:32:55', 6, 0),
('QLTP60159', 50, 'Rahim', 'Avery', '628', 'gatumudyge@mailinator.com', '$2y$10$AzC/Jw7vR/lySt3cw/gE3ek/YKJnMkvaKAyTQyiq/gaMghW1v6QiK', '1974-07-18', '2024-05-17 10:48:11', '2024-05-17 10:48:11', 5, 0),
('SX82147', 56, 'Zorita', 'Hampton', '378', 'loweq@mailinator.com', '$2y$10$DDFh/n.E9wJAALz06Tndc.I5MuR5LP3Wr1Zcd3MZRHTrSewnILDL2', '1985-01-06', '2024-05-21 11:24:31', '2024-05-21 11:24:31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(10) UNSIGNED NOT NULL,
  `inventory_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `inventory_name`, `address`, `type_id`) VALUES
(1, 'Kho Gò Vấp', '118 Thông Tây Hội, phường 10, quận Gò Vấp, thành phố Hồ Chí Minh', 1),
(5, 'Không', 'không', 3),
(6, 'Kho Bình Thạnh', '117/1B Bình Quới, phường 27, quận Bình Thạnh, thành phố Hồ Chí Minh', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_material`
--

CREATE TABLE `inventory_material` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_id` int(10) UNSIGNED NOT NULL,
  `material_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_material`
--

INSERT INTO `inventory_material` (`id`, `inventory_id`, `material_id`, `quantity`, `last_updated`) VALUES
(8, 1, 9, 165, '2024-05-27 05:45:12'),
(9, 1, 10, 265, '2024-05-27 05:45:12'),
(10, 1, 11, 465, '2024-05-27 05:45:12'),
(11, 1, 13, 5, '2024-05-25 14:06:51'),
(12, 1, 12, 170, '2024-05-27 05:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_product`
--

CREATE TABLE `inventory_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_id` int(10) UNSIGNED NOT NULL,
  `product_input_id` int(10) UNSIGNED NOT NULL,
  `sequence` int(10) NOT NULL,
  `is_scanned` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_product`
--

INSERT INTO `inventory_product` (`id`, `inventory_id`, `product_input_id`, `sequence`, `is_scanned`, `status`, `reason`, `last_updated`) VALUES
(2, 1, 1, 1, 1, NULL, '', '2024-05-22 20:07:36'),
(3, 1, 1, 2, 1, NULL, '', '2024-05-22 19:40:56'),
(4, 1, 1, 3, 1, 'spending', '', '2024-05-23 07:10:33'),
(5, 1, 1, 4, 0, 'accept', '', '2024-05-25 22:27:43'),
(6, 1, 1, 5, 0, 'reject', 'a', '2024-05-25 22:28:10'),
(7, 1, 1, 6, 0, 'accept', '', '2024-05-25 22:29:09'),
(8, 1, 1, 7, 1, 'spending', '', '2024-05-23 08:28:24'),
(9, 1, 1, 8, 1, 'accept', '', '2024-05-23 07:18:05'),
(10, 1, 1, 9, 1, 'spending', '', '2024-05-22 21:13:45'),
(11, 1, 1, 10, 1, 'accept', '', '2024-05-22 21:54:24'),
(12, 1, 1, 11, 1, 'accept', '', '2024-05-22 21:55:45'),
(13, 1, 1, 12, 0, 'accept', '', '2024-05-25 22:31:32'),
(14, 1, 1, 13, 0, 'reject', 'a', '2024-05-26 07:34:15'),
(15, 1, 1, 14, 0, 'accept', '', '2024-05-26 07:35:35'),
(16, 1, 1, 15, 1, 'accept', '', '2024-05-23 05:21:20'),
(17, 1, 1, 16, 1, 'spending', '', '2024-05-23 05:23:51'),
(18, 1, 1, 17, 1, 'spending', '', '2024-05-23 05:24:00'),
(19, 1, 1, 18, 0, NULL, '', '2024-05-22 19:07:04'),
(20, 1, 1, 19, 0, NULL, '', '2024-05-22 19:07:04'),
(21, 1, 1, 20, 1, 'accept', '', '2024-05-23 05:41:29'),
(22, 1, 1, 21, 1, 'accept', '', '2024-05-23 05:42:24'),
(23, 1, 1, 22, 1, 'accept', '', '2024-05-22 22:17:21'),
(24, 1, 1, 23, 1, 'accept', '', '2024-05-22 22:22:00'),
(25, 1, 1, 24, 0, NULL, '', '2024-05-22 19:07:04'),
(26, 1, 1, 25, 0, NULL, '', '2024-05-24 13:44:27'),
(27, 1, 1, 26, 1, 'accept', '', '2024-05-23 08:01:57'),
(28, 1, 1, 27, 1, 'spending', '', '2024-05-23 05:54:18'),
(29, 1, 1, 28, 1, 'accept', '', '2024-05-23 06:09:11'),
(30, 1, 1, 29, 0, NULL, '', '2024-05-22 19:07:04'),
(31, 1, 1, 30, 1, 'accept', '', '2024-05-23 06:28:34'),
(32, 1, 1, 31, 1, 'accept', '', '2024-05-23 06:30:54'),
(33, 1, 1, 32, 1, 'accept', '', '2024-05-23 06:37:41'),
(34, 1, 1, 33, 1, 'accept', '', '2024-05-23 06:38:35'),
(35, 1, 1, 34, 1, 'accept', '', '2024-05-23 06:43:26'),
(36, 1, 1, 35, 0, NULL, '', '2024-05-22 19:07:04'),
(37, 1, 1, 36, 0, NULL, '', '2024-05-22 19:07:04'),
(38, 1, 1, 37, 0, NULL, '', '2024-05-22 19:07:04'),
(39, 1, 1, 38, 0, NULL, '', '2024-05-22 19:07:04'),
(40, 1, 1, 39, 1, 'spending', '', '2024-05-23 09:27:07'),
(41, 1, 1, 40, 1, 'accept', '', '2024-05-23 05:45:18'),
(42, 1, 1, 41, 0, NULL, '', '2024-05-22 19:07:04'),
(43, 1, 1, 42, 0, NULL, '', '2024-05-22 19:07:04'),
(44, 1, 1, 43, 0, NULL, '', '2024-05-22 19:07:04'),
(45, 1, 1, 44, 0, NULL, '', '2024-05-22 19:07:04'),
(46, 1, 1, 45, 0, NULL, '', '2024-05-22 19:07:04'),
(47, 1, 1, 46, 0, NULL, '', '2024-05-22 19:07:04'),
(48, 1, 1, 47, 0, NULL, '', '2024-05-22 19:07:04'),
(49, 1, 1, 48, 0, NULL, '', '2024-05-22 19:07:04'),
(50, 1, 1, 49, 0, NULL, '', '2024-05-22 19:07:04'),
(51, 1, 1, 50, 0, NULL, '', '2024-05-22 19:07:04'),
(52, 1, 1, 51, 1, 'accept', '', '2024-05-23 07:21:37'),
(53, 1, 1, 52, 1, 'accept', '', '2024-05-23 07:22:40'),
(54, 1, 1, 53, 1, 'accept', '', '2024-05-23 07:23:12'),
(55, 1, 1, 54, 1, 'accept', '', '2024-05-23 07:24:35'),
(56, 1, 1, 55, 1, 'spending', '', '2024-05-23 07:24:59'),
(57, 1, 1, 56, 1, 'accept', '', '2024-05-23 08:02:14'),
(58, 1, 1, 57, 1, 'accept', '', '2024-05-23 08:06:06'),
(59, 1, 1, 58, 1, 'accept', '', '2024-05-23 08:11:15'),
(60, 1, 1, 59, 1, 'accept', '', '2024-05-23 08:11:44'),
(61, 1, 1, 60, 1, 'accept', '', '2024-05-23 08:12:36'),
(62, 1, 1, 61, 1, 'accept', '', '2024-05-23 08:15:05'),
(63, 1, 1, 62, 1, 'accept', '', '2024-05-23 08:18:46'),
(64, 1, 1, 63, 1, 'accept', '', '2024-05-23 08:21:36'),
(65, 1, 1, 64, 1, 'accept', '', '2024-05-23 08:22:22'),
(66, 1, 1, 65, 1, 'accept', '', '2024-05-23 08:23:34'),
(67, 1, 1, 66, 1, 'accept', '', '2024-05-23 08:26:02'),
(68, 1, 1, 67, 1, 'accept', '', '2024-05-23 08:26:24'),
(69, 1, 1, 68, 0, NULL, '', '2024-05-22 19:07:04'),
(70, 1, 1, 69, 0, NULL, '', '2024-05-22 19:07:04'),
(71, 1, 1, 70, 0, NULL, '', '2024-05-22 19:07:04'),
(72, 1, 3, 1, 1, 'accept', NULL, '2024-05-25 21:04:40'),
(73, 1, 3, 2, 1, 'accept', NULL, '2024-05-25 21:07:47'),
(74, 1, 3, 3, 1, 'accept', NULL, '2024-05-25 21:07:47'),
(75, 1, 3, 4, 1, 'reject', 'a', '2024-05-25 21:07:56'),
(76, 1, 3, 5, 1, 'accept', NULL, '2024-05-25 21:07:47'),
(77, 1, 3, 6, 0, NULL, NULL, '2024-05-24 10:43:24'),
(78, 1, 3, 7, 1, 'accept', NULL, '2024-05-25 21:07:47'),
(79, 1, 3, 8, 0, NULL, NULL, '2024-05-24 10:43:24'),
(80, 1, 3, 9, 0, NULL, NULL, '2024-05-24 10:43:24'),
(81, 1, 3, 10, 0, NULL, NULL, '2024-05-24 10:43:24'),
(82, 1, 3, 11, 0, NULL, NULL, '2024-05-24 10:43:24'),
(83, 1, 3, 12, 0, NULL, NULL, '2024-05-24 10:43:24'),
(84, 1, 3, 13, 0, NULL, NULL, '2024-05-24 10:43:24'),
(85, 1, 3, 14, 0, NULL, NULL, '2024-05-24 10:43:24'),
(86, 1, 3, 15, 0, NULL, NULL, '2024-05-24 10:43:24'),
(87, 1, 3, 16, 0, NULL, NULL, '2024-05-24 10:43:24'),
(88, 1, 3, 17, 0, NULL, NULL, '2024-05-24 10:43:24'),
(89, 1, 3, 18, 0, NULL, NULL, '2024-05-24 10:43:24'),
(90, 1, 3, 19, 0, NULL, NULL, '2024-05-24 10:43:24'),
(91, 1, 3, 20, 0, NULL, NULL, '2024-05-24 10:43:24'),
(92, 1, 3, 21, 0, NULL, NULL, '2024-05-24 10:43:24'),
(93, 1, 3, 22, 0, NULL, NULL, '2024-05-24 10:43:24'),
(94, 1, 3, 23, 0, NULL, NULL, '2024-05-24 10:43:24'),
(95, 1, 3, 24, 0, NULL, NULL, '2024-05-24 10:43:24'),
(96, 1, 3, 25, 0, NULL, NULL, '2024-05-24 10:43:24'),
(97, 1, 3, 26, 0, NULL, NULL, '2024-05-24 10:43:24'),
(98, 1, 3, 27, 0, NULL, NULL, '2024-05-24 10:43:24'),
(99, 1, 3, 28, 0, NULL, NULL, '2024-05-24 10:43:24'),
(100, 1, 3, 29, 0, NULL, NULL, '2024-05-24 10:43:24'),
(101, 1, 3, 30, 0, NULL, NULL, '2024-05-24 10:43:24'),
(102, 1, 3, 31, 0, NULL, NULL, '2024-05-24 10:43:24'),
(103, 1, 3, 32, 0, NULL, NULL, '2024-05-24 10:43:24'),
(104, 1, 3, 33, 0, NULL, NULL, '2024-05-24 10:43:24'),
(105, 1, 3, 34, 0, NULL, NULL, '2024-05-24 10:43:24'),
(106, 1, 3, 35, 0, NULL, NULL, '2024-05-24 10:43:24'),
(107, 1, 3, 36, 0, NULL, NULL, '2024-05-24 10:43:24'),
(108, 1, 3, 37, 0, NULL, NULL, '2024-05-24 10:43:24'),
(109, 1, 3, 38, 0, NULL, NULL, '2024-05-24 10:43:24'),
(110, 1, 3, 39, 0, NULL, NULL, '2024-05-24 10:43:24'),
(111, 1, 3, 40, 0, NULL, NULL, '2024-05-24 10:43:24'),
(112, 1, 3, 41, 0, NULL, NULL, '2024-05-24 10:43:24'),
(113, 1, 3, 42, 0, NULL, NULL, '2024-05-24 10:43:24'),
(114, 1, 3, 43, 0, NULL, NULL, '2024-05-24 10:43:24'),
(115, 1, 3, 44, 0, NULL, NULL, '2024-05-24 10:43:24'),
(116, 1, 3, 45, 0, NULL, NULL, '2024-05-24 10:43:24'),
(117, 1, 3, 46, 0, NULL, NULL, '2024-05-24 10:43:24'),
(118, 1, 3, 47, 0, NULL, NULL, '2024-05-24 10:43:24'),
(119, 1, 3, 48, 0, NULL, NULL, '2024-05-24 10:43:24'),
(120, 1, 3, 49, 0, NULL, NULL, '2024-05-24 10:43:24'),
(121, 1, 3, 50, 0, NULL, NULL, '2024-05-24 10:43:24'),
(122, 1, 4, 1, 1, 'accept', NULL, '2024-05-24 10:52:11'),
(123, 1, 4, 2, 1, 'accept', NULL, '2024-05-24 10:56:05'),
(124, 1, 4, 3, 1, 'accept', NULL, '2024-05-24 10:56:15'),
(125, 1, 4, 4, 1, 'accept', NULL, '2024-05-24 10:56:35'),
(126, 1, 4, 5, 1, 'accept', NULL, '2024-05-24 10:56:52'),
(127, 1, 4, 6, 1, 'accept', NULL, '2024-05-24 10:57:04'),
(128, 1, 4, 7, 1, 'reject', 'a', '2024-05-25 21:07:56'),
(129, 1, 4, 8, 1, 'accept', NULL, '2024-05-24 16:20:20'),
(130, 1, 4, 9, 1, 'accept', NULL, '2024-05-24 10:57:14'),
(131, 1, 4, 10, 1, 'spending', NULL, '2024-05-24 15:09:31'),
(132, 1, 5, 1, 0, NULL, NULL, '2024-05-24 16:12:43'),
(133, 1, 5, 2, 0, NULL, NULL, '2024-05-24 16:12:43'),
(134, 1, 5, 3, 0, NULL, NULL, '2024-05-24 16:12:43'),
(135, 1, 5, 4, 0, NULL, NULL, '2024-05-24 16:12:43'),
(136, 1, 5, 5, 0, NULL, NULL, '2024-05-24 16:12:43'),
(137, 1, 5, 6, 0, NULL, NULL, '2024-05-24 16:12:43'),
(138, 1, 5, 7, 0, NULL, NULL, '2024-05-24 16:12:43'),
(139, 1, 5, 8, 0, NULL, NULL, '2024-05-24 16:12:43'),
(140, 1, 5, 9, 1, 'reject', 'A', '2024-05-25 11:34:34'),
(141, 1, 5, 10, 0, NULL, NULL, '2024-05-24 16:12:43'),
(142, 1, 6, 1, 1, 'accept', 'a', '2024-05-25 21:07:47'),
(143, 1, 6, 2, 0, NULL, NULL, '2024-05-25 14:08:14'),
(144, 1, 6, 3, 0, NULL, NULL, '2024-05-25 14:08:14'),
(145, 1, 6, 4, 0, NULL, NULL, '2024-05-25 14:08:14'),
(146, 1, 6, 5, 0, NULL, NULL, '2024-05-25 14:08:14'),
(147, 1, 6, 6, 0, NULL, NULL, '2024-05-25 14:08:14'),
(148, 1, 6, 7, 0, NULL, NULL, '2024-05-25 14:08:14'),
(149, 1, 6, 8, 0, NULL, NULL, '2024-05-25 14:08:14'),
(150, 1, 6, 9, 0, NULL, NULL, '2024-05-25 14:08:14'),
(151, 1, 6, 10, 0, NULL, NULL, '2024-05-25 14:08:14'),
(152, 1, 6, 11, 0, NULL, NULL, '2024-05-25 14:08:14'),
(153, 1, 6, 12, 0, NULL, NULL, '2024-05-25 14:08:14'),
(154, 1, 6, 13, 0, NULL, NULL, '2024-05-25 14:08:14'),
(155, 1, 6, 14, 0, NULL, NULL, '2024-05-25 14:08:14'),
(156, 1, 6, 15, 0, NULL, NULL, '2024-05-25 14:08:14'),
(157, 1, 6, 16, 0, NULL, NULL, '2024-05-25 14:08:14'),
(158, 1, 6, 17, 0, NULL, NULL, '2024-05-25 14:08:14'),
(159, 1, 6, 18, 0, NULL, NULL, '2024-05-25 14:08:14'),
(160, 1, 6, 19, 0, NULL, NULL, '2024-05-25 14:08:14'),
(161, 1, 6, 20, 0, NULL, NULL, '2024-05-25 14:08:14'),
(162, 1, 7, 1, 0, NULL, NULL, '2024-05-26 17:34:01'),
(163, 1, 7, 2, 0, 'accept', NULL, '2024-05-26 17:37:47'),
(164, 1, 7, 3, 0, NULL, NULL, '2024-05-26 17:34:01'),
(165, 1, 7, 4, 0, NULL, NULL, '2024-05-26 17:34:01'),
(166, 1, 7, 5, 0, NULL, NULL, '2024-05-26 17:34:01'),
(167, 1, 7, 6, 0, NULL, NULL, '2024-05-26 17:34:01'),
(168, 1, 7, 7, 0, NULL, NULL, '2024-05-26 17:34:01'),
(169, 1, 7, 8, 0, NULL, NULL, '2024-05-26 17:34:01'),
(170, 1, 7, 9, 0, NULL, NULL, '2024-05-26 17:34:01'),
(171, 1, 7, 10, 0, NULL, NULL, '2024-05-26 17:34:01'),
(172, 1, 7, 11, 0, NULL, NULL, '2024-05-26 17:34:01'),
(173, 1, 7, 12, 0, NULL, NULL, '2024-05-26 17:34:01'),
(174, 1, 7, 13, 0, NULL, NULL, '2024-05-26 17:34:01'),
(175, 1, 7, 14, 0, NULL, NULL, '2024-05-26 17:34:01'),
(176, 1, 7, 15, 0, NULL, NULL, '2024-05-26 17:34:01'),
(177, 1, 7, 16, 0, NULL, NULL, '2024-05-26 17:34:01'),
(178, 1, 7, 17, 0, NULL, NULL, '2024-05-26 17:34:01'),
(179, 1, 7, 18, 0, NULL, NULL, '2024-05-26 17:34:01'),
(180, 1, 7, 19, 0, NULL, NULL, '2024-05-26 17:34:01'),
(181, 1, 7, 20, 0, NULL, NULL, '2024-05-26 17:34:01'),
(182, 1, 8, 1, 0, 'reject', 'Hàng lỗi', '2024-05-26 17:55:59'),
(183, 1, 8, 2, 0, 'accept', NULL, '2024-05-26 17:55:39'),
(184, 1, 9, 1, 0, 'accept', NULL, '2024-05-27 02:10:51'),
(185, 1, 9, 2, 0, 'reject', 'Hàng lỗi', '2024-05-27 02:11:30'),
(186, 1, 9, 3, 0, NULL, NULL, '2024-05-27 02:08:52'),
(187, 1, 9, 4, 0, NULL, NULL, '2024-05-27 02:08:52'),
(188, 1, 9, 5, 0, NULL, NULL, '2024-05-27 02:08:52'),
(189, 1, 9, 6, 0, NULL, NULL, '2024-05-27 02:08:52'),
(190, 1, 9, 7, 0, NULL, NULL, '2024-05-27 02:08:52'),
(191, 1, 9, 8, 0, NULL, NULL, '2024-05-27 02:08:52'),
(192, 1, 9, 9, 0, NULL, NULL, '2024-05-27 02:08:52'),
(193, 1, 9, 10, 0, NULL, NULL, '2024-05-27 02:08:52'),
(194, 1, 9, 11, 0, NULL, NULL, '2024-05-27 02:08:52'),
(195, 1, 9, 12, 0, NULL, NULL, '2024-05-27 02:08:52'),
(196, 1, 9, 13, 0, NULL, NULL, '2024-05-27 02:08:52'),
(197, 1, 9, 14, 0, NULL, NULL, '2024-05-27 02:08:52'),
(198, 1, 9, 15, 0, NULL, NULL, '2024-05-27 02:08:52'),
(199, 1, 9, 16, 0, NULL, NULL, '2024-05-27 02:08:52'),
(200, 1, 9, 17, 0, NULL, NULL, '2024-05-27 02:08:52'),
(201, 1, 9, 18, 0, NULL, NULL, '2024-05-27 02:08:53'),
(202, 1, 9, 19, 0, NULL, NULL, '2024-05-27 02:08:53'),
(203, 1, 9, 20, 0, NULL, NULL, '2024-05-27 02:08:53'),
(204, 1, 10, 1, 0, 'accept', NULL, '2024-05-27 05:49:43'),
(205, 1, 10, 2, 0, NULL, NULL, '2024-05-27 05:47:58'),
(206, 1, 10, 3, 0, NULL, NULL, '2024-05-27 05:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_type`
--

CREATE TABLE `inventory_type` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_type`
--

INSERT INTO `inventory_type` (`type_id`, `type_name`) VALUES
(1, 'Kho nguyên vật liệu'),
(2, 'Kho thành phẩm'),
(3, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(10) UNSIGNED NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price_per_unit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `material_name`, `unit`, `price_per_unit`) VALUES
(9, 'CPU', 'cái', 1000000),
(10, 'RAM', 'cái', 700000),
(11, 'Ổ cứng SSD', 'cái', 1900000),
(12, 'Tấm màn', 'cái', 900000),
(13, 'Nguồn', 'cái', 400000);

-- --------------------------------------------------------

--
-- Table structure for table `material_input`
--

CREATE TABLE `material_input` (
  `input_id` int(10) UNSIGNED NOT NULL,
  `material_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_input`
--

INSERT INTO `material_input` (`input_id`, `material_id`, `supplier_id`, `quantity`, `status`, `date`) VALUES
(13, 9, 1, 100, 'confirmed', '2024-05-21 13:32:27'),
(14, 10, 1, 100, 'confirmed', '2024-05-21 13:32:35'),
(15, 11, 1, 100, 'confirmed', '2024-05-21 13:32:43'),
(16, 10, 1, 500, 'confirmed', '2024-05-21 14:06:16'),
(17, 9, 1, 400, 'confirmed', '2024-05-21 14:06:41'),
(18, 11, 1, 700, 'confirmed', '2024-05-21 14:06:32'),
(19, 9, 1, 10, 'confirmed', '2024-05-21 16:08:13'),
(20, 13, 1, 15, 'confirmed', '2024-05-24 10:36:54'),
(21, 12, 1, 20, 'confirmed', '2024-05-24 10:39:00'),
(22, 12, 1, 50, 'confirmed', '2024-05-24 14:57:44'),
(23, 12, 1, 100, 'check', '2024-05-25 13:55:12'),
(24, 13, 1, 100, 'confirmed', '2024-05-25 14:00:07'),
(25, 12, 1, 10, 'confirmed', '2024-05-27 02:07:21'),
(26, 12, 1, 100, 'confirmed', '2024-05-27 05:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `material_product`
--

CREATE TABLE `material_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity_require` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_product`
--

INSERT INTO `material_product` (`id`, `material_id`, `product_id`, `quantity_require`) VALUES
(84, 9, 94, 1),
(85, 10, 94, 1),
(86, 11, 94, 1),
(87, 9, 95, 1),
(88, 10, 95, 1),
(89, 11, 95, 1),
(90, 10, 96, 1),
(91, 9, 96, 1),
(92, 11, 96, 1),
(93, 9, 97, 1),
(94, 10, 97, 1),
(95, 11, 97, 1),
(96, 9, 98, 1),
(97, 10, 98, 1),
(98, 11, 98, 1),
(99, 9, 99, 1),
(100, 13, 99, 1),
(101, 12, 99, 1),
(102, 12, 100, 1),
(103, 13, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_supplier`
--

CREATE TABLE `material_supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `price` int(10) NOT NULL,
  `delivery_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(10) NOT NULL,
  `sender_id` varchar(10) NOT NULL,
  `receiver_id` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(11, 'NVNL78514', 'AD34284', 'a', '2024-05-23 13:22:54', '2024-05-23 13:22:54'),
(12, 'NVNL78514', 'AD34284', 'a', '2024-05-23 13:27:55', '2024-05-23 13:27:55'),
(13, 'NVNL78514', 'NVNL66377', 'aalooo', '2024-05-23 13:28:26', '2024-05-23 13:28:26'),
(14, 'NVNL78514', 'AD34284', 'a', '2024-05-23 13:32:55', '2024-05-23 13:32:55'),
(15, 'NVNL78514', 'AD34284', 'ádasda', '2024-05-23 13:52:35', '2024-05-23 13:52:35'),
(16, 'AD34284', 'NVNL78514', 'alo', '2024-05-23 13:53:32', '2024-05-23 13:53:32'),
(17, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 01:44:10', '2024-05-24 01:44:10'),
(18, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 01:44:18', '2024-05-24 01:44:18'),
(19, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 02:10:27', '2024-05-24 02:10:27'),
(20, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 02:16:16', '2024-05-24 02:16:16'),
(21, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 02:16:36', '2024-05-24 02:16:36'),
(22, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 02:29:06', '2024-05-24 02:29:06'),
(23, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 02:29:37', '2024-05-24 02:29:37'),
(24, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 02:30:12', '2024-05-24 02:30:12'),
(25, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 02:31:17', '2024-05-24 02:31:17'),
(26, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 02:31:21', '2024-05-24 02:31:21'),
(27, 'NVNL78514', 'AD34284', 'a', '2024-05-24 02:31:23', '2024-05-24 02:31:23'),
(28, 'NVNL78514', 'AD34284', 'aa', '2024-05-24 02:31:24', '2024-05-24 02:31:24'),
(29, 'NVNL78514', 'AD34284', 'aaa', '2024-05-24 02:31:25', '2024-05-24 02:31:25'),
(30, 'NVNL78514', 'AD34284', 'a', '2024-05-24 02:36:06', '2024-05-24 02:36:06'),
(31, 'NVNL78514', 'AD34284', 'q', '2024-05-24 02:36:11', '2024-05-24 02:36:11'),
(32, 'AD34284', 'NVNL78514', 'a', '2024-05-24 02:42:36', '2024-05-24 02:42:36'),
(33, 'NVNL78514', 'AD34284', 'q', '2024-05-24 02:42:48', '2024-05-24 02:42:48'),
(34, 'AD34284', 'NVNL78514', 'a', '2024-05-24 03:03:55', '2024-05-24 03:03:55'),
(35, 'AD34284', 'NVNL78514', 'a', '2024-05-24 14:29:27', '2024-05-24 14:29:27'),
(36, 'AD34284', 'NVNL78514', 'a', '2024-05-24 14:33:23', '2024-05-24 14:33:23'),
(37, 'NVNL78514', 'AD34284', 'a', '2024-05-24 14:34:22', '2024-05-24 14:34:22'),
(38, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 14:43:50', '2024-05-24 14:43:50'),
(39, 'NVNL78514', 'AD34284', 'a', '2024-05-24 14:46:19', '2024-05-24 14:46:19'),
(40, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 14:49:39', '2024-05-24 14:49:39'),
(41, 'NVNL78514', 'AD34284', 'alo', '2024-05-24 14:49:49', '2024-05-24 14:49:49'),
(42, 'AD34284', 'NVNL78514', 'alo', '2024-05-24 14:53:36', '2024-05-24 14:53:36'),
(43, 'AD34284', 'NVNL78514', 'alo', '2024-05-25 01:22:23', '2024-05-25 01:22:23'),
(44, 'NVNL78514', 'AD34284', '?', '2024-05-25 01:22:37', '2024-05-25 01:22:37'),
(45, 'NVNL78514', 'AD34284', 'alo', '2024-05-25 01:28:32', '2024-05-25 01:28:32'),
(46, 'NVNL78514', 'AD34284', 'alo', '2024-05-25 01:36:10', '2024-05-25 01:36:10'),
(47, 'NVNL78514', 'AD34284', 'a', '2024-05-25 01:42:40', '2024-05-25 01:42:40'),
(48, 'AD34284', 'NVNL78514', 'a', '2024-05-25 01:42:54', '2024-05-25 01:42:54'),
(49, 'AD34284', 'NVNL78514', 'a', '2024-05-25 01:47:46', '2024-05-25 01:47:46'),
(50, 'NVNL78514', 'AD34284', 'a', '2024-05-25 01:48:13', '2024-05-25 01:48:13'),
(51, 'NVNL78514', 'AD34284', 'a', '2024-05-25 01:48:25', '2024-05-25 01:48:25'),
(52, 'NVNL78514', 'AD34284', 'a', '2024-05-25 01:48:51', '2024-05-25 01:48:51'),
(53, 'AD34284', 'NVNL78514', '1', '2024-05-25 05:20:42', '2024-05-25 05:20:42'),
(54, 'AD34284', 'NVNL78514', 'a', '2024-05-25 05:22:21', '2024-05-25 05:22:21'),
(55, 'NVNL78514', 'AD34284', 'alo', '2024-05-25 05:22:35', '2024-05-25 05:22:35'),
(56, 'NVNL78514', 'AD34284', 'alo', '2024-05-25 05:27:14', '2024-05-25 05:27:14'),
(57, 'NVNL78514', 'AD34284', 'a', '2024-05-25 07:20:18', '2024-05-25 07:20:18'),
(58, 'AD34284', 'NVNL78514', 'a', '2024-05-25 07:22:20', '2024-05-25 07:22:20'),
(59, 'AD34284', 'NVNL78514', 'alo', '2024-05-25 07:23:04', '2024-05-25 07:23:04'),
(60, 'NVNL78514', 'AD72789', 'nhắn tn mới', '2024-05-25 07:24:15', '2024-05-25 07:24:15'),
(61, 'AD72789', 'NVNL78514', 'nhắn gì', '2024-05-25 07:24:58', '2024-05-25 07:24:58'),
(62, 'SX82147', 'AD34284', 'hello', '2024-05-26 09:38:48', '2024-05-26 09:38:48'),
(63, 'SX82147', 'AD34284', 'hello', '2024-05-26 09:38:59', '2024-05-26 09:38:59'),
(64, 'AD34284', 'AD72789', 'aadsa', '2024-05-26 09:44:59', '2024-05-26 09:44:59'),
(65, 'AD34284', 'AD72789', 'csdnkjfasf', '2024-05-26 09:45:07', '2024-05-26 09:45:07'),
(66, 'AD72789', 'AD34284', 'a', '2024-05-26 09:48:21', '2024-05-26 09:48:21'),
(67, 'AD72789', 'AD34284', 'a', '2024-05-26 09:48:29', '2024-05-26 09:48:29'),
(68, 'AD72789', 'AD34284', 'a', '2024-05-26 09:48:30', '2024-05-26 09:48:30'),
(69, 'AD34284', 'AD72789', 'dsafs', '2024-05-26 09:48:55', '2024-05-26 09:48:55'),
(70, 'AD72789', 'AD34284', 'ádasda', '2024-05-26 09:49:02', '2024-05-26 09:49:02'),
(71, 'SX82147', 'QLNVL18157', 'a', '2024-05-26 11:26:14', '2024-05-26 11:26:14'),
(72, 'QLNVL18157', 'SX82147', 'a', '2024-05-26 11:28:20', '2024-05-26 11:28:20'),
(73, 'AD34284', 'NVNL25026', 'alo', '2024-05-26 19:33:13', '2024-05-26 19:33:13'),
(74, 'AD34284', 'NVNL25026', 'alo', '2024-05-26 19:33:21', '2024-05-26 19:33:21'),
(75, 'AD34284', 'NVNL25026', 'alo', '2024-05-26 19:33:31', '2024-05-26 19:33:31'),
(76, 'AD34284', 'NVNL25026', 'a', '2024-05-26 22:53:38', '2024-05-26 22:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `production_cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `unit`, `production_cost`) VALUES
(94, 'Laptop ASUS', 'cái', 20000000),
(95, 'Laptop DELL', 'cái', 23000000),
(96, 'Laptop MSI', 'cái', 12000000),
(97, 'Laptop Lenovo', 'cái', 17000000),
(98, 'Laptop Acer', 'cái', 19000000),
(99, 'Laptop ACER II', 'cái', 19990000),
(100, 'Laptop Dell II', 'cái', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `product_input`
--

CREATE TABLE `product_input` (
  `input_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_input`
--

INSERT INTO `product_input` (`input_id`, `product_id`, `employee_id`, `quantity`, `status`, `date`) VALUES
(1, 95, 'SX82147', 70, 'receive', '2024-05-22 18:07:05'),
(2, 98, 'SX82147', 20, 'receive', '2024-05-22 11:27:30'),
(3, 96, 'SX82147', 50, 'receive', '2024-05-25 19:48:33'),
(4, 99, 'SX82147', 10, 'receive', '2024-05-25 17:20:13'),
(5, 97, 'SX82147', 10, 'receive', '2024-05-24 16:13:41'),
(6, 96, 'SX82147', 20, 'receive', '2024-05-25 14:12:40'),
(7, 95, 'SX82147', 20, 'receive', '2024-05-26 17:37:09'),
(8, 95, 'SX82147', 2, 'receive', '2024-05-26 17:54:40'),
(9, 97, 'SX82147', 20, 'receive', '2024-05-27 02:10:25'),
(10, 96, 'SX82147', 3, 'receive', '2024-05-27 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`order_id`, `product_id`, `quantity`, `start_date`, `end_date`, `status`) VALUES
(12, 98, 20, '2024-05-21 14:00:51', '2024-05-22 10:24:39', 'complete'),
(13, 97, 10, '2024-05-21 14:01:01', '2024-05-24 14:59:37', 'complete'),
(14, 96, 50, '2024-05-21 14:01:11', '2024-05-24 10:41:07', 'complete'),
(15, 95, 70, '2024-05-21 14:01:22', '2024-05-22 08:55:20', 'complete'),
(16, 94, 100, '2024-05-21 14:01:59', '2024-05-24 14:53:56', 'receive'),
(17, 99, 10, '2024-05-24 10:32:02', '2024-05-24 10:41:15', 'complete'),
(18, 95, 20, '2024-05-24 14:46:16', '2024-05-24 14:54:03', 'receive'),
(19, 96, 20, '2024-05-25 13:44:41', '2024-05-25 14:07:50', 'complete'),
(20, 100, 100, '2024-05-25 13:46:48', '2024-05-25 13:46:48', 'required'),
(21, 95, 20, '2024-05-26 16:59:07', '2024-05-26 17:33:33', 'complete'),
(22, 95, 2, '2024-05-26 17:51:02', '2024-05-26 17:52:29', 'complete'),
(23, 97, 20, '2024-05-27 01:59:51', '2024-05-27 02:08:28', 'complete'),
(24, 96, 1, '2024-05-27 02:39:03', '2024-05-27 02:39:03', 'required'),
(25, 96, 3, '2024-05-27 05:44:29', '2024-05-27 05:47:39', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `product_output`
--

CREATE TABLE `product_output` (
  `output_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `destination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `nickname`) VALUES
(1, 'Admin', 'AD'),
(49, 'Quản lý nguyên liệu', 'QLNL'),
(50, 'Quản lý thành phẩm', 'QLTP'),
(53, 'Nhà cung cấp', 'NCC'),
(54, 'Nhân viên nguyên liệu', 'NVNL'),
(55, 'Nhân viên sản phẩm', 'NVSP'),
(56, 'Sản xuất', 'SX');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `email`, `number`, `password`, `role_id`) VALUES
(1, 'Apple', 'apple@example.com', '0123456789', '$2y$10$08Wq/fZte9a9DyTWzp9ClOSc5YJKobCZXIi.6/.67g2Vbgcrx4u1u', 53);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_inventory` (`inventory_id`),
  ADD KEY `employee_role` (`role_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `inventory_type` (`type_id`);

--
-- Indexes for table `inventory_material`
--
ALTER TABLE `inventory_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_material` (`inventory_id`),
  ADD KEY `material_inventory` (`material_id`);

--
-- Indexes for table `inventory_product`
--
ALTER TABLE `inventory_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_product` (`inventory_id`),
  ADD KEY `product_inventory` (`product_input_id`);

--
-- Indexes for table `inventory_type`
--
ALTER TABLE `inventory_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `material_input`
--
ALTER TABLE `material_input`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `material_supplier2` (`material_id`),
  ADD KEY `supplier_material2` (`supplier_id`);

--
-- Indexes for table `material_product`
--
ALTER TABLE `material_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_product` (`material_id`),
  ADD KEY `product_material` (`product_id`);

--
-- Indexes for table `material_supplier`
--
ALTER TABLE `material_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_supplier` (`material_id`),
  ADD KEY `supplier_material` (`supplier_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_message` (`sender_id`),
  ADD KEY `employee_message_2` (`receiver_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_input`
--
ALTER TABLE `product_input`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `input_product` (`product_id`),
  ADD KEY `input_employee` (`employee_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_order` (`product_id`);

--
-- Indexes for table `product_output`
--
ALTER TABLE `product_output`
  ADD PRIMARY KEY (`output_id`),
  ADD KEY `product_output` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supplier_role` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_material`
--
ALTER TABLE `inventory_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory_product`
--
ALTER TABLE `inventory_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `inventory_type`
--
ALTER TABLE `inventory_type`
  MODIFY `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `material_input`
--
ALTER TABLE `material_input`
  MODIFY `input_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `material_product`
--
ALTER TABLE `material_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `material_supplier`
--
ALTER TABLE `material_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product_input`
--
ALTER TABLE `product_input`
  MODIFY `input_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_output`
--
ALTER TABLE `product_output`
  MODIFY `output_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82769;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employee_inventory` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_type` FOREIGN KEY (`type_id`) REFERENCES `inventory_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_material`
--
ALTER TABLE `inventory_material`
  ADD CONSTRAINT `inventory_material` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_inventory` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_product`
--
ALTER TABLE `inventory_product`
  ADD CONSTRAINT `inventory_product` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_inventory` FOREIGN KEY (`product_input_id`) REFERENCES `product_input` (`input_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_input`
--
ALTER TABLE `material_input`
  ADD CONSTRAINT `material_supplier2` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_material2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_product`
--
ALTER TABLE `material_product`
  ADD CONSTRAINT `material_product` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_material` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_supplier`
--
ALTER TABLE `material_supplier`
  ADD CONSTRAINT `material_supplier` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_material` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `employee_message` FOREIGN KEY (`sender_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_message_2` FOREIGN KEY (`receiver_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_input`
--
ALTER TABLE `product_input`
  ADD CONSTRAINT `input_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `input_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_output`
--
ALTER TABLE `product_output`
  ADD CONSTRAINT `product_output` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `supplier_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
