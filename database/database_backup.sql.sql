-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 06:42 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_f_category`
--

CREATE TABLE `add_f_category` (
  `id` int(50) NOT NULL,
  `f_c_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_f_category`
--

INSERT INTO `add_f_category` (`id`, `f_c_name`) VALUES
(15, 'Woman Ethnic'),
(16, 'Men Footwear'),
(17, 'Watches & Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `add_f_product`
--

CREATE TABLE `add_f_product` (
  `id` int(50) NOT NULL,
  `f_c_name` varchar(191) NOT NULL,
  `f_p_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_f_product`
--

INSERT INTO `add_f_product` (`id`, `f_c_name`, `f_p_name`) VALUES
(1, '16', 'Sports Shoes'),
(2, '16', 'Casual Shoes'),
(3, '16', 'Formal Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `add_f_product_details`
--

CREATE TABLE `add_f_product_details` (
  `id` int(100) NOT NULL,
  `f_p_name` varchar(191) NOT NULL,
  `p_c_name` varchar(100) NOT NULL,
  `pdname` varchar(120) NOT NULL,
  `p_color` varchar(50) NOT NULL,
  `p_price` varchar(100) NOT NULL,
  `p_off_price` varchar(102) NOT NULL,
  `p_p_discount` varchar(105) NOT NULL,
  `p_size` varchar(160) NOT NULL,
  `p_delivery` varchar(60) NOT NULL,
  `p_deal` varchar(103) NOT NULL,
  `f_image` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_f_product_details`
--

INSERT INTO `add_f_product_details` (`id`, `f_p_name`, `p_c_name`, `pdname`, `p_color`, `p_price`, `p_off_price`, `p_p_discount`, `p_size`, `p_delivery`, `p_deal`, `f_image`) VALUES
(1, '2', 'BIG FOX ', 'Riding| Outdoor| Hiking Lightweight Casual Boots For Men  (Brown , 10)', 'Brown', '1299', '2995', '56%', '10', 'Free Delivery', 'Bank Offer', 'image/f_image/256426-bfs-618-6-big-fox-brown-original-imah3ab3fzncqsmn.webp');

-- --------------------------------------------------------

--
-- Table structure for table `admin_pincodes`
--

CREATE TABLE `admin_pincodes` (
  `id` int(11) NOT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_pincodes`
--

INSERT INTO `admin_pincodes` (`id`, `pincode`, `is_active`) VALUES
(1, '110001', 1),
(2, '110002', 1),
(3, '110003', 1),
(4, '110004', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`) VALUES
(4, 'admin_user', '$2y$10$ZvQeUdLUFH7V/zxEMNVzv.FhK7oTmq6aMztGXNkEs9jjwdVZ1.Kpe'),
(5, 'admin', '$2y$10$18HXwM8//J2gVXdrFq4NUukHqYud5m239rpE6pdLnlZ/p.B93D0oe');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(30) NOT NULL,
  `c_h_names` varchar(100) NOT NULL,
  `c_name` varchar(191) NOT NULL,
  `c_image` varchar(192) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `c_h_names`, `c_name`, `c_image`) VALUES
(47, '1', 'Mobile', 'image/images__3_-removebg-preview.png'),
(48, '1', 'Laptop accessories', ''),
(49, '1', 'computer accessories', ''),
(70, '3', 'Men\'s Top Wear', 'image/62797618'),
(72, '3', 'Woman Ethnic', 'image/11925428'),
(73, '3', 'Men Footwear', 'image/64138496');

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` int(50) NOT NULL,
  `c_image` varchar(191) NOT NULL,
  `c_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `c_image`, `c_name`) VALUES
(7, 'image/3.jfif', 'first image'),
(8, 'image/1.png', 'second image');

-- --------------------------------------------------------

--
-- Table structure for table `category_head`
--

CREATE TABLE `category_head` (
  `id` int(200) NOT NULL,
  `c_image` varchar(191) NOT NULL,
  `c_h_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_head`
--

INSERT INTO `category_head` (`id`, `c_image`, `c_h_name`) VALUES
(1, 'image/istockphoto-178716575-612x612-removebg-preview.png', 'Electronics'),
(3, 'image/lovepik-fashion-beauty-shopping-model-png-image_401409072_wh1200-removebg-preview.png', 'Fashion'),
(4, 'image/png-clipart-window-living-room-curtain-couch-furniture-american-simple-casual-single-modern-sofa-tufted-yellow-leather-armchair-interior-design-textile-thumbnail-removebg-preview.png', 'Home & furniture'),
(5, 'image/png-transparent-toy-graphy-illustration-toys-daquan-child-baby-photography-thumbnail-removebg-preview.png', 'Beauty, Toy & More'),
(6, 'image/two-wheeler-insurance-vehicle-insurance-insurance-policy-motorcycle-removebg-preview.png', 'Two Wheelers');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`id`, `comment_id`, `user_id`, `reply`, `created_at`, `is_active`) VALUES
(1, 1, 84, 'yes available it\\r\\n', '2024-10-26 10:35:13', 0),
(2, 2, 84, 'yes availble\\r\\n', '2024-10-26 10:38:08', 1),
(3, 2, 82, 'yes', '2024-10-26 10:38:52', 0),
(4, 4, 84, 'Yes', '2024-10-26 11:21:51', 1),
(5, 4, 83, 'yes', '2024-10-28 04:53:06', 0),
(6, 4, 83, 'yes', '2024-10-28 04:53:07', 0),
(7, 4, 83, 'yes', '2024-10-28 04:53:24', 0),
(8, 4, 83, 'yes', '2024-10-28 04:53:24', 0),
(9, 4, 83, 'yes', '2024-10-28 04:53:24', 0),
(10, 4, 83, 'yes', '2024-10-28 04:53:25', 0),
(11, 4, 83, 'no', '2024-10-28 04:55:30', 1),
(12, 4, 83, 'yes', '2024-10-28 04:59:58', 0),
(13, 5, 83, 'good\\r\\n', '2024-10-28 05:27:54', 1),
(14, 7, 83, 'yes', '2024-10-28 05:42:08', 1),
(15, 7, 84, 'no', '2024-10-28 05:42:59', 1),
(16, 7, 84, 'jj', '2024-10-28 05:52:27', 1),
(17, 5, 84, 'u', '2024-10-28 06:37:49', 1),
(18, 6, 84, 'yes', '2024-10-28 06:47:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `c_product`
--

CREATE TABLE `c_product` (
  `id` int(50) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `p_name` varchar(130) NOT NULL,
  `article_number` varchar(120) NOT NULL,
  `p_size` varchar(100) NOT NULL,
  `p_image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_product`
--

INSERT INTO `c_product` (`id`, `cat_name`, `product_name`, `p_name`, `article_number`, `p_size`, `p_image`) VALUES
(24, '39', '', 'Bluetooth Speakers', '', '', 'p_image/6896044'),
(50, '43', '', 'Accessory Kit', '', '', 'p_image/12732348'),
(51, '43', '', 'Gaming Accessories Combo', '', '', ''),
(52, '47', '', 'Redmi ', '', '', ''),
(53, '47', '', 'samsung', '', '', 'p_image/40935004'),
(54, '49', '', 'Printers', '', '', 'p_image/25786656'),
(55, '49', '', 'Monitors', '', '', 'p_image/53375005'),
(56, '49', '', 'Projectors', '', '', 'p_image/70842201'),
(57, '48', '', 'Laptops', '', '', 'p_image/31088910'),
(58, '48', '', 'Gaming Laptops', '', '', 'p_image/50384335'),
(59, '70', '', 'Men\'s T-Shirts', '', '', 'p_image/44162799'),
(60, '72', '', 'Woman Sarees', '', '', 'p_image/59710568'),
(61, '72', '', 'Woman Kurtas & Kurtis', '', '', 'p_image/5243909');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(200) NOT NULL,
  `user_id` int(191) NOT NULL,
  `total_price` varchar(130) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`) VALUES
(4, 19, '9999', '2024-10-10 11:24:51.000000'),
(5, 19, '92989', '2024-10-10 11:26:35.000000'),
(6, 19, '52998', '2024-10-14 05:38:41.000000'),
(7, 19, '52998', '2024-10-14 05:38:41.000000'),
(8, 19, '9999', '2024-10-14 05:55:13.000000'),
(9, 19, '9999', '2024-10-14 06:04:08.000000'),
(11, 19, '39996', '2024-10-14 06:24:27.000000'),
(12, 19, '9999', '2024-10-14 06:29:53.586479'),
(13, 19, '9999', '2024-10-14 06:32:08.777478'),
(15, 19, '47990', '2024-10-14 06:43:44.067786'),
(16, 19, '90989', '2024-10-14 06:52:40.473069'),
(17, 19, '143987', '2024-10-14 06:56:17.612614'),
(18, 19, '186986', '2024-10-14 06:59:06.622649'),
(22, 20, '42999', '2024-10-14 08:41:35.869693'),
(23, 20, '52998', '2024-10-14 08:51:08.406048'),
(24, 20, '42999', '2024-10-14 08:52:02.455285'),
(25, 20, '9999', '2024-10-14 09:10:02.725260'),
(26, 20, '59989', '2024-10-14 09:46:13.436831'),
(28, 19, '92989', '2024-10-15 07:16:07.519905'),
(29, 19, '99980', '2024-10-15 10:20:55.383030'),
(30, 19, '49990', '2024-10-15 10:53:21.212810'),
(32, 19, '3604', '2024-10-16 09:21:00.601208'),
(33, 19, '85998', '2024-10-16 09:34:08.015595'),
(34, 36, '199960', '2024-10-17 06:03:17.639106'),
(35, 19, '171996', '2024-10-19 07:00:30.106603'),
(36, 19, '42999', '2024-10-19 07:01:57.128260'),
(37, 19, '42999', '2024-10-19 07:10:27.725504'),
(38, 19, '49990', '2024-10-21 05:47:32.029569'),
(39, 19, '85998', '2024-10-21 05:51:52.851720'),
(40, 19, '99980', '2024-10-21 06:00:14.385303'),
(41, 19, '99980', '2024-10-21 06:06:33.161142'),
(42, 19, '99980', '2024-10-21 06:31:10.061381'),
(43, 19, '85998', '2024-10-21 06:32:57.407326'),
(44, 39, '99980', '2024-10-21 06:36:32.969073'),
(45, 40, '85998', '2024-10-21 06:41:01.632197'),
(46, 39, '99980', '2024-10-21 06:46:25.201835'),
(47, 39, '95980', '2024-10-21 06:48:36.121128'),
(48, 39, '13920', '2024-10-21 06:58:17.249927'),
(49, 39, '13920', '2024-10-21 06:58:44.087632'),
(50, 39, '19998', '2024-10-21 07:00:23.844018'),
(51, 39, '7208', '2024-10-21 07:05:25.053301'),
(52, 39, '570', '2024-10-21 07:09:04.342867'),
(53, 39, '13920', '2024-10-21 07:09:45.584761'),
(54, 39, '570', '2024-10-21 07:10:05.071502'),
(55, 39, '117980', '2024-10-21 07:10:59.714479'),
(56, 39, '570', '2024-10-21 07:14:31.825280'),
(57, 39, '85998', '2024-10-21 07:15:40.100230'),
(58, 39, '85998', '2024-10-21 07:17:02.672751'),
(59, 39, '85998', '2024-10-21 07:17:24.850530'),
(60, 39, '85998', '2024-10-21 07:19:38.354601'),
(61, 39, '85998', '2024-10-21 07:20:58.853108'),
(62, 39, '13920', '2024-10-21 07:24:13.944131'),
(63, 40, '570', '2024-10-21 07:25:26.896128'),
(64, 39, '140979', '2024-10-21 07:27:07.668927'),
(65, 40, '140979', '2024-10-21 07:28:20.192166'),
(66, 77, '49990', '2024-10-22 06:46:30.481600'),
(67, 84, '193100', '2024-10-24 07:04:33.927575'),
(68, 84, '59200', '2024-11-06 05:39:49.113708'),
(69, 84, '85998', '2024-11-06 05:51:50.462595'),
(70, 84, '570', '2024-11-06 05:53:57.982533'),
(71, 84, '13920', '2024-11-06 05:58:43.661973'),
(72, 84, '12998', '2024-11-06 06:04:53.299928'),
(73, 84, '180993', '2024-11-09 05:53:12.650504'),
(74, 84, '12999', '2024-11-09 08:56:04.471517');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `quantity`, `price`, `image`) VALUES
(1, 12, 21, '', 1, '9999.00', 'pd_image/39941vivo-mobile-phone.jpg'),
(2, 13, 21, '', 1, '9999.00', 'pd_image/39941vivo-mobile-phone.jpg'),
(11, 22, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(12, 23, 21, 'Vivo Y100', 1, '9999.00', 'pd_image/39941vivo-mobile-phone.jpg'),
(13, 23, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(14, 24, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(15, 25, 21, 'Vivo Y100', 1, '9999.00', 'pd_image/39941vivo-mobile-phone.jpg'),
(16, 26, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(17, 26, 21, 'Vivo Y100', 1, '9999.00', 'pd_image/39941vivo-mobile-phone.jpg'),
(19, 28, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(20, 28, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(21, 29, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 2, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(22, 30, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(25, 32, 26, 'Canon MG2570S Color Inkjet Printer', 1, '3604.00', 'pd_image/96330-original-imah2az4yzyzubt6.webp'),
(26, 33, 22, 'Samsung Galaxy S23 5G', 2, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(27, 34, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 4, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(28, 35, 22, 'Samsung Galaxy S23 5G', 4, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(29, 36, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(30, 37, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(31, 38, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(32, 39, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(33, 40, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(34, 41, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(35, 42, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(36, 43, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(37, 44, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(38, 45, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(39, 46, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(40, 47, 24, 'DELL Inspiron 15 with Backlit Keyboard, Intel Core i5 12th Gen 1235U', 1, '47990.00', 'pd_image/917040-original-imaghzahgukpkyfu.webp'),
(41, 48, 39, 'Frontech - 50.8 cm (20 inch) HD LED Backlit VA Panel Monitor', 1, '6960.00', 'pd_image/789598mon-0054-hd-20-2023-mon-0054-frontech-original-imahyrryap3ccunb.webp'),
(42, 49, 39, 'Frontech - 50.8 cm (20 inch) HD LED Backlit VA Panel Monitor', 1, '6960.00', 'pd_image/789598mon-0054-hd-20-2023-mon-0054-frontech-original-imahyrryap3ccunb.webp'),
(43, 50, 21, 'Vivo Y100', 1, '9999.00', 'pd_image/39941vivo-mobile-phone.jpg'),
(44, 51, 26, 'Canon MG2570S Color Inkjet Printer', 1, '3604.00', 'pd_image/96330-original-imah2az4yzyzubt6.webp'),
(45, 52, 40, 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 1, '285.00', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(46, 53, 39, 'Frontech - 50.8 cm (20 inch) HD LED Backlit VA Panel Monitor', 1, '6960.00', 'pd_image/789598mon-0054-hd-20-2023-mon-0054-frontech-original-imahyrryap3ccunb.webp'),
(47, 54, 40, 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 1, '285.00', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(48, 55, 25, 'HP Victus Intel Core i5 12th Gen', 1, '58990.00', 'pd_image/2881815-fa1226tx-gaming-laptop-hp-original-imah4bjbx8ctzdg6.webp'),
(49, 56, 40, 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 1, '285.00', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(50, 57, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(51, 58, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(52, 59, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(53, 60, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(54, 61, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(55, 62, 39, 'Frontech - 50.8 cm (20 inch) HD LED Backlit VA Panel Monitor', 1, '6960.00', 'pd_image/789598mon-0054-hd-20-2023-mon-0054-frontech-original-imahyrryap3ccunb.webp'),
(56, 63, 40, 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 1, '285.00', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(57, 64, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(58, 64, 24, 'DELL Inspiron 15 with Backlit Keyboard, Intel Core i5 12th Gen 1235U', 1, '47990.00', 'pd_image/917040-original-imaghzahgukpkyfu.webp'),
(59, 64, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(60, 65, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(61, 65, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(62, 65, 24, 'DELL Inspiron 15 with Backlit Keyboard, Intel Core i5 12th Gen 1235U', 1, '47990.00', 'pd_image/917040-original-imaghzahgukpkyfu.webp'),
(63, 66, 23, 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 1, '49990.00', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(64, 67, 24, 'DELL Inspiron 15 with Backlit Keyboard, Intel Core i5 12th Gen 1235U', 4, '47990.00', 'pd_image/917040-original-imaghzahgukpkyfu.webp'),
(65, 67, 40, 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 4, '285.00', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(66, 68, 42, 'SAMSUNG Galaxy S23 FE (Mint, 128 GB)  (8 GB RAM)', 1, '29600.00', 'pd_image/-original-imah5ywfebrs9bfg.webp'),
(67, 69, 22, 'Samsung Galaxy S23 5G', 1, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(68, 70, 40, 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 1, '285.00', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(69, 71, 39, 'Frontech - 50.8 cm (20 inch) HD LED Backlit VA Panel Monitor', 1, '6960.00', 'pd_image/789598mon-0054-hd-20-2023-mon-0054-frontech-original-imahyrryap3ccunb.webp'),
(70, 72, 44, 'SAMSUNG Galaxy F05 (Twilight Blue, 64 GB)  (4 GB RAM)', 1, '6499.00', 'pd_image/-original-imah56hkgehywn5b.webp'),
(71, 73, 22, 'Samsung Galaxy S23 5G', 3, '42999.00', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(72, 73, 21, 'REDMI 12 5G (Moonstone Silver, 256 GB)  (8 GB RAM)', 4, '12999.00', 'pd_image/-original-imags37h4prxjazz (1).webp'),
(73, 74, 21, 'REDMI 12 5G (Moonstone Silver, 256 GB)  (8 GB RAM)', 1, '12999.00', 'pd_image/-original-imags37h4prxjazz (1).webp');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `product_id`, `comment`, `created_at`, `user_id`, `is_active`) VALUES
(1, 45, 'any other color available', '2024-10-26 10:26:09', 1, 1),
(2, 40, 'any other color available', '2024-10-26 10:37:32', 0, 1),
(3, 40, 'xl size available\\r\\n', '2024-10-26 10:54:25', 0, 0),
(4, 40, 'XLL Available', '2024-10-26 11:21:04', 84, 1),
(5, 40, 'product quality?\\r\\n', '2024-10-28 05:17:56', 83, 0),
(6, 40, 'ye\\r\\n', '2024-10-28 05:21:57', 83, 0),
(7, 40, 'ds', '2024-10-28 05:41:12', 83, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(200) NOT NULL,
  `p_image` varchar(100) NOT NULL,
  `p_name` varchar(191) NOT NULL,
  `p_color` varchar(50) NOT NULL,
  `p_price` varchar(50) NOT NULL,
  `p_size` varchar(30) NOT NULL,
  `p_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `p_image`, `p_name`, `p_color`, `p_price`, `p_size`, `p_description`) VALUES
(17, 'image/2.png', 'Redmi 3S Prime', 'Blacks', '9999', '5.4 inch', 'This mobile is comfortable for the all Person'),
(18, 'image/3.jfif', 'Redmi 3S Prime', 'Black', '12999', '5.4 inch', 'This mobile is comfortable for the all Person'),
(19, 'image/1.png', '', '', '', '', ''),
(22, 'image/2.png', 'Redmi 3S Prime', 'Brown', '99990', '5.5 inch', 'This mobile is comfortable for the all Person');

-- --------------------------------------------------------

--
-- Table structure for table `p_details`
--

CREATE TABLE `p_details` (
  `id` int(50) NOT NULL,
  `p_name` varchar(191) NOT NULL,
  `cats_name` varchar(100) NOT NULL,
  `pdname` varchar(100) NOT NULL,
  `p_color` varchar(100) NOT NULL,
  `p_price` varchar(191) NOT NULL,
  `p_size` varchar(100) NOT NULL,
  `p_off_price` varchar(102) NOT NULL,
  `p_p_discount` varchar(105) NOT NULL,
  `p_delivery` varchar(160) NOT NULL,
  `p_deal` varchar(60) NOT NULL,
  `pd_image` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_details`
--

INSERT INTO `p_details` (`id`, `p_name`, `cats_name`, `pdname`, `p_color`, `p_price`, `p_size`, `p_off_price`, `p_p_discount`, `p_delivery`, `p_deal`, `pd_image`) VALUES
(21, '52', '47', 'REDMI 12 5G (Moonstone Silver, 256 GB)  (8 GB RAM)', 'Moonstone Silver', '12999', '6.79 inch', '19999', '35%', 'Free Delivery', 'Bank Offer', 'pd_image/-original-imags37h4prxjazz (1).webp'),
(22, '53', '47', 'Samsung Galaxy S23 5G', 'Cream', '42999', '6.1 inch', '95999', '55%', 'Free Delivery', 'Top Discount of the Sell', 'pd_image/491433-original-imah4zp7fgtezhsz.webp'),
(23, '57', '48', 'Lenovo IdeaPad Slim 3 Intel Core i5 12th Gen', 'Silver', '49990', '14 Inch Full HD', '59990', '16%', 'Free Delivery', 'Save extra with combo offers', 'pd_image/620005-original-imah4dcjs2wmpmv9.webp'),
(24, '57', '48', 'DELL Inspiron 15 with Backlit Keyboard, Intel Core i5 12th Gen 1235U', 'Platinum Silver', '47990', '15.6 Inch Full HD', '69990', '31% ', 'Free Delivery', 'Lowest Price Since Launch', 'pd_image/917040-original-imaghzahgukpkyfu.webp'),
(25, '58', '48', 'HP Victus Intel Core i5 12th Gen', 'Performance Blue', '58990', '15.6 inch', '76,354', '22%', 'Not Deliverable', 'Save extra with combo offers', 'pd_image/2881815-fa1226tx-gaming-laptop-hp-original-imah4bjbx8ctzdg6.webp'),
(26, '54', '49', 'Canon MG2570S Color Inkjet Printer', 'Black', '3604', '', '3875', '7%', 'Free Delivery', 'Save extra with combo offers', 'pd_image/96330-original-imah2az4yzyzubt6.webp'),
(39, '55', '49', 'Frontech - 50.8 cm (20 inch) HD LED Backlit VA Panel Monitor', 'Black', '6960', '20 inch', '8000', '13%', 'Free Delivery', 'Save extra with combo offers', 'pd_image/789598mon-0054-hd-20-2023-mon-0054-frontech-original-imahyrryap3ccunb.webp'),
(40, '59', '70', 'Men Colorblock High Neck Polyester Dark Blue T-Shirt', 'Dark Blue', '285', 'S M X XL', '1499', '81%', 'Free Delivery', 'Bank Offer', 'pd_image/814649s-auskk0785-ausk-original-imah4c7ftf6kzhwu.webp'),
(41, '53', '47', 'SAMSUNG Galaxy A14 5G (Dark Red, 64 GB)  (4 GB RAM)', 'Dark Red', '9065', '6.6 inch', '18499', '51%', 'Free Delivery', 'Save extra with combo offers', 'pd_image/978444-original-imah4sssdf9pgz3e.webp'),
(42, '53', '47', 'SAMSUNG Galaxy S23 FE (Mint, 128 GB)  (8 GB RAM)', 'Mint', '29600', '6.4 inch', '79999', '63%', 'Free Delivery', 'Save extra with combo offers', 'pd_image/-original-imah5ywfebrs9bfg.webp'),
(43, '53', '47', 'SAMSUNG Galaxy M35 5G (DayBreak Blue, 128 GB)  (6 GB RAM)', 'DayBreak Blue', '14944', '6.6 inch', '24499', '39%', 'Free Delivery', 'Save extra with combo offers', 'pd_image/galaxy-m35-5g-sm-m356b-samsung-original-imah3fgfmnamdg3m.webp'),
(44, '53', '47', 'SAMSUNG Galaxy F05 (Twilight Blue, 64 GB)  (4 GB RAM)', 'Twilight Blue', '6499', '6.74 inch', '9999', '35%', 'Free Delivery', 'Bank Offer', 'pd_image/-original-imah56hkgehywn5b.webp'),
(45, '52', '47', 'REDMI Note 12 5G (Matte Black, 128 GB)  (4 GB RAM)', 'Matte Black', '12599', '6.67 inch', '19999', '37%', 'Free Delivery', 'Loan available', 'pd_image/-original-imagpgsg2hvvtcef.webp'),
(46, '52', '47', 'REDMI 12C (Mint Green, 64 GB)  (4 GB RAM)', 'Mint Green', '8359', '6.71', '10999', '24', 'Free Delivery', 'Bank Offer', 'pd_image/453849-original-imagvfghsh7chtgh.webp');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(80) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(120) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `verification_token` varchar(100) NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `created_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000' ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `password`, `mobile_no`, `address`, `pincode`, `verification_token`, `is_verified`, `created_at`) VALUES
(18, 'Devarshi Singh', 'shyam@gmail.com', '1', '0', 'Vill./Post-Dhammours', '2255', '', NULL, '0000-00-00 00:00:00.000000'),
(19, 'Devarshi Singh', 'pa@gmail.com', '123', '2147483647', 'Vill./Post-Dhammour', '22', '', NULL, '0000-00-00 00:00:00.000000'),
(20, 'Deva Singh', 'ef@gmail.com', '123', '2147483647', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(21, 'Devarshi Singh', 'm@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(22, 'Devarshi Singh', 'a@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(23, 'Devarshi Singh', 'a@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(24, 'Devarshi Singh', 'b@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(25, 'Devarshi Singh', 'v@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(26, 'Devarshi Singh', 'hgfhfj@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(27, 'Devarshi Singh', 'pawan@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(28, 'Shyam Singh', 'shyams@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammours', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(29, 'Devarshi Singh', 'shyamss@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(30, 'Devarshi Singh', 'paa@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(31, 'Devarshi Singh', 'pas@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(32, 'Devarshi Singh', 'sh@gmail.com', '1234567', '2147483647', 'Vill./Post-Dhammours', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(33, 'Devarshi Singh', 'shy@gmail.com', '1234567', '9452645875', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(34, 'Devarshi Singh', 'sh11@gmail.com', '$2y$10$P./TnAG1601bNq0F49GwJuq1WtUAs2NqOpFcBa1CU1P.adGAF6mU.', '9452641111', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(35, 'Devarshi Singh', 'a11@gmail.com', '$2y$10$wRnMlym3yBXsQGqYEknXXOXr63lrQHt.iiq052lo80AREoFJ5FZLC', '9452645235', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(36, 'Devarshi Singh', 'ramji@gmail.com', '123', '9452656476', 'Vill./Post-Dhammour', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(37, 'Devarshi Singh', 'pa2222@gmail.com', 'aaaaaaa', '9452645778', 'Vill./Post-Dhammours', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(38, 'Devarshi Singh', 'sh444@gmail.com', '11111111', '9452648956', 'Vill./Post-Dhammoursss', '227408', '', NULL, '0000-00-00 00:00:00.000000'),
(82, 'Devarshi Singh', 'devarshisingh50@gmail.com', '1234567', '9452648795', 'Vill./Post-Dhammoursss', '227408', 'de7b60a3d4c3fab7d88056af949f3f18', 1, '2024-10-26 10:35:40.368527'),
(83, 'Sir ji', 'abhikersharma.fet@ramauniversity.ac.in', '1234567', '9452641254', 'Vill./Post-Dhammoursss', '227408', '', 1, '2024-10-22 10:16:15.296293'),
(84, 'Devarshi Singh', 'devarshisingh.fet@ramauniversity.ac.in', '1234567', '9452641546', 'Vill./Post-Dhammour', '110001', '', 1, '2024-11-06 06:04:43.766432');

-- --------------------------------------------------------

--
-- Table structure for table `reply_votes`
--

CREATE TABLE `reply_votes` (
  `id` int(11) NOT NULL,
  `reply_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vote` enum('like','dislike') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_votes`
--

INSERT INTO `reply_votes` (`id`, `reply_id`, `user_id`, `vote`) VALUES
(1, 14, 84, 'like'),
(2, 15, 84, 'like'),
(3, 13, 84, 'like'),
(4, 11, 84, 'like'),
(5, 4, 84, 'like'),
(6, 4, 83, 'like'),
(7, 18, 83, 'like'),
(8, 16, 84, 'dislike');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '1',
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(9, 1, 21, 2, '2024-10-05 06:58:50'),
(10, 1, 22, 1, '2024-10-05 07:12:14'),
(16, 1, 23, 2, '2024-10-08 05:50:31'),
(17, 6, 0, 4, '2024-10-08 11:05:21'),
(18, 6, 39, 1, '2024-10-09 05:05:16'),
(19, 6, 25, 1, '2024-10-09 05:18:05'),
(21, 6, 21, 1, '2024-10-09 06:27:14'),
(22, 6, 26, 2, '2024-10-09 06:27:53'),
(71, 20, 0, 1, '2024-10-14 12:07:40'),
(72, 20, 0, 1, '2024-10-14 12:07:58'),
(78, 20, 0, 1, '2024-10-15 04:38:16'),
(83, 20, 0, 1, '2024-10-15 04:44:11'),
(97, 20, 0, 1, '2024-10-15 06:17:22'),
(98, 20, 0, 1, '2024-10-15 06:31:29'),
(99, 20, 0, 1, '2024-10-15 06:32:10'),
(100, 20, 0, 1, '2024-10-15 06:44:26'),
(103, 20, 0, 1, '2024-10-15 07:01:32'),
(153, 28, 22, 5, '2024-10-17 04:43:23'),
(154, 60, 23, 1, '2024-10-22 05:22:11'),
(156, 77, 22, 1, '2024-10-22 07:12:01'),
(157, 84, 39, 1, '2024-11-18 10:18:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_f_category`
--
ALTER TABLE `add_f_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_f_product`
--
ALTER TABLE `add_f_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_f_product_details`
--
ALTER TABLE `add_f_product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_pincodes`
--
ALTER TABLE `admin_pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_head`
--
ALTER TABLE `category_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `c_product`
--
ALTER TABLE `c_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_details`
--
ALTER TABLE `p_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_votes`
--
ALTER TABLE `reply_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reply_id` (`reply_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_f_category`
--
ALTER TABLE `add_f_category`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `add_f_product`
--
ALTER TABLE `add_f_product`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `add_f_product_details`
--
ALTER TABLE `add_f_product_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_pincodes`
--
ALTER TABLE `admin_pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_head`
--
ALTER TABLE `category_head`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `c_product`
--
ALTER TABLE `c_product`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `p_details`
--
ALTER TABLE `p_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `reply_votes`
--
ALTER TABLE `reply_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `product_comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `p_details` (`id`);

--
-- Constraints for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD CONSTRAINT `product_comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `p_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reply_votes`
--
ALTER TABLE `reply_votes`
  ADD CONSTRAINT `reply_votes_ibfk_1` FOREIGN KEY (`reply_id`) REFERENCES `comment_replies` (`id`),
  ADD CONSTRAINT `reply_votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
