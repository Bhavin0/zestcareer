-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 05:42 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zest_career`
--

-- --------------------------------------------------------

--
-- Table structure for table `addmission`
--

CREATE TABLE `addmission` (
  `add_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fesstype_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `penamt` double DEFAULT NULL,
  `paiamt` double DEFAULT NULL,
  `process_date` date DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendancesheet`
--

CREATE TABLE `attendancesheet` (
  `attendance_key` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `attendance` enum('P','A') NOT NULL,
  `remarks` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendancesheet`
--

INSERT INTO `attendancesheet` (`attendance_key`, `attendance_id`, `studentid`, `attendance`, `remarks`) VALUES
(1, 1, 19, 'A', 'continously absent'),
(2, 1, 20, 'P', ''),
(3, 1, 21, 'P', ''),
(4, 1, 22, 'P', ''),
(5, 1, 23, 'P', ''),
(6, 1, 24, 'P', ''),
(7, 1, 25, 'P', ''),
(8, 1, 26, 'P', ''),
(9, 1, 27, 'P', ''),
(10, 1, 28, 'P', ''),
(11, 1, 29, 'P', ''),
(12, 1, 30, 'P', ''),
(13, 1, 31, 'P', ''),
(14, 1, 32, 'P', ''),
(15, 1, 33, 'P', ''),
(16, 1, 34, 'P', ''),
(17, 1, 35, 'P', ''),
(18, 1, 36, 'P', ''),
(19, 2, 19, 'A', 'continously absent'),
(20, 2, 20, 'P', ''),
(21, 2, 21, 'P', ''),
(22, 2, 22, 'P', ''),
(23, 2, 23, 'P', ''),
(24, 2, 24, 'P', ''),
(25, 2, 25, 'P', ''),
(26, 2, 26, 'P', ''),
(27, 2, 27, 'P', ''),
(28, 2, 28, 'P', ''),
(29, 2, 29, 'P', ''),
(30, 2, 30, 'P', ''),
(31, 2, 31, 'P', ''),
(32, 2, 32, 'P', ''),
(33, 2, 33, 'P', ''),
(34, 2, 34, 'P', ''),
(35, 2, 35, 'P', ''),
(36, 2, 36, 'P', ''),
(37, 3, 19, 'A', 'thseyseh'),
(38, 3, 20, 'P', ''),
(39, 3, 21, 'P', ''),
(40, 3, 22, 'P', ''),
(41, 3, 23, 'P', ''),
(42, 3, 24, 'P', ''),
(43, 3, 25, 'P', ''),
(44, 3, 26, 'P', ''),
(45, 3, 27, 'P', ''),
(46, 3, 28, 'P', ''),
(47, 3, 29, 'P', ''),
(48, 3, 30, 'P', ''),
(49, 3, 31, 'P', ''),
(50, 3, 32, 'P', ''),
(51, 3, 33, 'P', ''),
(52, 3, 34, 'P', ''),
(53, 3, 35, 'P', ''),
(54, 3, 36, 'P', ''),
(55, 4, 19, 'A', 'thseyseh'),
(56, 4, 20, 'P', ''),
(57, 4, 21, 'P', ''),
(58, 4, 22, 'P', ''),
(59, 4, 23, 'P', ''),
(60, 4, 24, 'P', ''),
(61, 4, 25, 'P', ''),
(62, 4, 26, 'P', ''),
(63, 4, 27, 'P', ''),
(64, 4, 28, 'P', ''),
(65, 4, 29, 'P', ''),
(66, 4, 30, 'P', ''),
(67, 4, 31, 'P', ''),
(68, 4, 32, 'P', ''),
(69, 4, 33, 'P', ''),
(70, 4, 34, 'P', ''),
(71, 4, 35, 'P', ''),
(72, 4, 36, 'P', ''),
(73, 5, 6, 'P', ''),
(74, 5, 7, 'A', ''),
(75, 5, 2, 'P', ''),
(76, 5, 3, 'A', ''),
(77, 5, 5, 'P', ''),
(78, 5, 4, 'P', ''),
(79, 5, 1, 'P', ''),
(80, 6, 37, 'P', ''),
(81, 6, 38, 'P', ''),
(82, 6, 39, 'P', ''),
(83, 6, 40, 'P', ''),
(84, 6, 41, 'P', ''),
(85, 6, 42, 'P', ''),
(86, 6, 43, 'P', ''),
(87, 6, 44, 'P', ''),
(88, 6, 45, 'P', ''),
(89, 6, 46, 'P', ''),
(90, 6, 47, 'P', ''),
(91, 6, 48, 'P', ''),
(92, 6, 49, 'P', ''),
(93, 6, 50, 'P', ''),
(94, 6, 51, 'P', ''),
(95, 6, 52, 'P', ''),
(96, 6, 53, 'P', ''),
(97, 6, 54, 'P', ''),
(98, 6, 55, 'P', ''),
(99, 6, 56, 'P', ''),
(100, 6, 57, 'P', ''),
(101, 6, 58, 'P', ''),
(102, 6, 59, 'P', ''),
(103, 6, 60, 'P', ''),
(104, 6, 61, 'P', ''),
(105, 6, 62, 'P', ''),
(106, 6, 63, 'P', ''),
(107, 6, 64, 'P', ''),
(108, 6, 65, 'P', ''),
(109, 6, 66, 'P', ''),
(110, 6, 67, 'P', ''),
(111, 7, 38, 'P', ''),
(112, 7, 55, 'A', ''),
(113, 7, 58, 'P', ''),
(114, 7, 66, 'P', ''),
(115, 7, 43, 'P', ''),
(116, 7, 54, 'P', ''),
(117, 7, 46, 'P', ''),
(118, 7, 49, 'P', ''),
(119, 7, 37, 'P', ''),
(120, 7, 41, 'P', ''),
(121, 7, 67, 'P', ''),
(122, 7, 44, 'P', ''),
(123, 7, 50, 'P', ''),
(124, 7, 52, 'P', ''),
(125, 7, 53, 'P', ''),
(126, 7, 57, 'P', ''),
(127, 7, 60, 'P', ''),
(128, 7, 47, 'P', ''),
(129, 7, 59, 'P', ''),
(130, 7, 40, 'P', ''),
(131, 7, 65, 'P', ''),
(132, 7, 39, 'P', ''),
(133, 7, 56, 'P', ''),
(134, 7, 62, 'P', ''),
(135, 7, 45, 'P', ''),
(136, 7, 42, 'P', ''),
(137, 7, 51, 'P', ''),
(138, 7, 48, 'P', ''),
(139, 7, 61, 'P', ''),
(140, 7, 64, 'P', ''),
(141, 7, 63, 'P', ''),
(142, 8, 11, 'P', ''),
(143, 8, 17, 'P', ''),
(144, 8, 8, 'A', 'Today your child is ab sent.'),
(145, 8, 15, 'P', ''),
(146, 8, 14, 'P', ''),
(147, 8, 16, 'P', ''),
(148, 8, 18, 'P', ''),
(149, 8, 10, 'P', ''),
(150, 8, 13, 'P', ''),
(151, 8, 12, 'P', ''),
(152, 8, 9, 'P', ''),
(153, 9, 107, 'P', 'hello woprld'),
(154, 9, 122, 'P', ''),
(155, 9, 105, 'P', ''),
(156, 9, 116, 'P', ''),
(157, 9, 124, 'P', ''),
(158, 9, 119, 'P', ''),
(159, 9, 121, 'P', ''),
(160, 9, 129, 'P', ''),
(161, 9, 114, 'P', ''),
(162, 9, 112, 'P', ''),
(163, 9, 127, 'P', ''),
(164, 9, 110, 'P', ''),
(165, 9, 109, 'P', ''),
(166, 9, 123, 'P', ''),
(167, 9, 126, 'P', ''),
(168, 9, 120, 'P', ''),
(169, 9, 117, 'P', ''),
(170, 9, 125, 'P', ''),
(171, 9, 108, 'P', ''),
(172, 9, 106, 'P', ''),
(173, 9, 104, 'P', ''),
(174, 9, 113, 'P', ''),
(175, 9, 118, 'P', ''),
(176, 9, 111, 'P', ''),
(177, 9, 115, 'P', ''),
(178, 9, 128, 'P', ''),
(179, 10, 107, 'P', ''),
(180, 10, 122, 'P', ''),
(181, 10, 105, 'P', ''),
(182, 10, 116, 'P', ''),
(183, 10, 124, 'P', ''),
(184, 10, 119, 'P', ''),
(185, 10, 121, 'P', ''),
(186, 10, 129, 'P', ''),
(187, 10, 114, 'P', ''),
(188, 10, 112, 'P', ''),
(189, 10, 127, 'P', ''),
(190, 10, 110, 'P', ''),
(191, 10, 109, 'P', ''),
(192, 10, 123, 'P', ''),
(193, 10, 126, 'P', ''),
(194, 10, 120, 'P', ''),
(195, 10, 117, 'P', ''),
(196, 10, 125, 'P', ''),
(197, 10, 108, 'P', ''),
(198, 10, 106, 'P', ''),
(199, 10, 104, 'P', ''),
(200, 10, 113, 'P', ''),
(201, 10, 118, 'P', ''),
(202, 10, 111, 'P', ''),
(203, 10, 115, 'P', ''),
(204, 10, 128, 'P', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `att_ID` int(11) NOT NULL,
  `ref_ID` int(11) NOT NULL,
  `isabsent` tinyint(1) DEFAULT NULL,
  `today_date` date DEFAULT NULL,
  `remarks` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Sports'),
(1, 'Stationary');

-- --------------------------------------------------------

--
-- Table structure for table `childfeereceipt`
--

CREATE TABLE `childfeereceipt` (
  `childfee_id` int(11) NOT NULL,
  `feereceipt_id` int(11) NOT NULL,
  `pen_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modeofpay` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amountpay` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devise_user_details`
--

CREATE TABLE `devise_user_details` (
  `user_id` int(11) NOT NULL,
  `foundation_id` int(11) NOT NULL DEFAULT '1',
  `user_type` varchar(12) CHARACTER SET utf8 NOT NULL DEFAULT 'Teacher',
  `ref_id` int(4) NOT NULL,
  `user_firstname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `user_lastname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `user_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `user_password` varchar(500) CHARACTER SET latin1 NOT NULL,
  `user_ipaddress` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `signin_count` int(11) DEFAULT '0',
  `signin_time` datetime DEFAULT NULL,
  `token` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `es_addon_modules`
--

CREATE TABLE `es_addon_modules` (
  `addon_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `v_admin` varchar(255) NOT NULL,
  `v_staff` varchar(255) NOT NULL,
  `v_n_staff` varchar(255) NOT NULL,
  `v_student` varchar(255) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_type` varchar(255) NOT NULL DEFAULT 'admin',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_admins`
--

CREATE TABLE `es_admins` (
  `es_adminsid` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_fname` varchar(255) NOT NULL,
  `user_type` enum('super','admin') NOT NULL,
  `user_theme` varchar(255) NOT NULL DEFAULT 'pink.css',
  `admin_lname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phoneno` varchar(255) NOT NULL,
  `admin_more` text NOT NULL,
  `admin_permissions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_admins`
--

INSERT INTO `es_admins` (`es_adminsid`, `admin_username`, `admin_password`, `admin_fname`, `user_type`, `user_theme`, `admin_lname`, `admin_email`, `admin_phoneno`, `admin_more`, `admin_permissions`) VALUES
(1, 'admin', 'admin*123#', 'Admin', '', 'pink.css', 'Admin', 'admin@gmail.com', '12345556', '', '1_p,1_1,1_2,1_3,2_p,2_1,2_2,2_3,2_4,2_5,2_6,2_7,2_8,2_9,2_10,2_11,2_12,2_13,2_14,2_15,2_20,2_18,2_19,3_p,3_1,3_2,3_3,3_5,3_4,4_p,5_p,5_1,5_3,5_2,5_5,5_6,6_p,6_1,6_2,6_3,6_4,6_5,6_6,6_7,7_p,7_1,7_2,7_3,7_4,7_5,8_p,8_1,8_2,8_3,8_101,8_4,8_5,8_6,8_16,8_102,8_7,8_8,8_9,8_17,8_103,8_104,8_10,8_11,8_12,8_18,8_105,8_106,8_13,8_14,8_15,8_19,8_107,8_108,9_p,9_1,9_17,9_18,9_19,9_2,9_20,9_21,9_22,9_3,9_4,9_5,9_6,9_101,9_7,9_102,9_8,9_103,9_24,9_25,9_33,9_23,9_11,9_13,9_27,9_14,9_29,9_30,9_31,9_15,9_16,9_32,10_p,10_1,10_2,10_3,10_4,10_5,10_6,10_7,10_8,10_11,10_9,10_10,10_12,11_p,11_1,11_2,11_3,11_4,11_5,11_6,11_7,11_8,11_9,11_10,11_11,11_12,11_13,11_14,11_15,11_16,11_17,11_18,11_19,11_20,11_21,11_23,11_101,11_102,11_22,11_103,11_104,12_p,12_1,12_2,12_3,12_4,12_5,12_11,12_6,12_7,12_8,12_12,12_9,12_10,13_p,13_1,13_2,13_3,13_17,13_4,13_5,13_6,13_18,13_7,13_8,13_9,13_19,13_20,13_10,13_11,13_12,13_21,13_22,13_13,13_14,13_15,13_16,13_108,13_23,13_101,13_102,13_103,13_104,13_106,13_105,14_p,14_1,14_2,14_3,14_101,14_4,14_5,14_6,14_102,14_7,14_8,14_9,14_103,14_10,14_21,14_104,14_11,14_105,14_12,14_106,14_13,14_14,14_15,14_16,14_107,14_17,14_18,14_19,14_20,15_p,15_1,15_2,15_3,16_p,16_1,16_2,16_3,16_101,16_4,16_5,16_6,16_102,16_7,16_8,16_10,16_11,16_12,16_103,16_13,16_14,16_15,16_17,16_18,16_20,16_21,16_24,16_104,16_105,16_22,16_25,16_23,16_26,16_106,16_107,16_27,16_28,16_29,17_p,17_1,17_6,17_2,17_3,17_101,17_4,17_5,17_7,17_8,17_9,18_p,18_5,18_1,18_2,18_3,18_4,18_6,18_7,18_8,18_9,18_10,18_11,18_12,19_p,19_1,19_2,19_3,19_4,19_5,19_6,19_11,19_7,19_12,19_13,19_14,19_15,19_101,19_102,19_8,19_16,19_9,19_10,19_17,19_18,20_p,20_1,20_5,20_101,20_2,20_6,20_102,20_3,20_4,21_p,21_1,21_2,21_3,22_p,22_1,22_2,22_3,22_5,22_4,22_6,23_p,24_p,24_1,24_2,24_3,24_4,25_p,25_1,25_2,25_5,25_6,25_3,25_4,25_7,25_8,26_p,26_1,26_2,27_p,27_1,27_2,27_3,28_p,28_1,28_2,28_3,28_4,28_5,29_p,29_1,29_2,30_p,30_1,30_2,30_3,30_4,30_5,30_6,30_7,30_8,31_p,31_1,31_2,31_3,31_5,31_4,32_p,32_3,32_1,32_4,32_2,32_5,33_p,33_1,33_2,33_3,33_8,33_4,33_5,33_6,33_7,34_p,34_1,34_2,35_p,35_1,35_2,35_3');

-- --------------------------------------------------------

--
-- Table structure for table `es_allowencemaster`
--

CREATE TABLE `es_allowencemaster` (
  `es_allowencemasterid` int(11) NOT NULL,
  `alw_type` varchar(255) NOT NULL,
  `alw_fromdate` date NOT NULL,
  `alw_todate` date NOT NULL,
  `alw_dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_assignment`
--

CREATE TABLE `es_assignment` (
  `es_assignmentid` int(11) NOT NULL,
  `as_academic_id` int(11) NOT NULL,
  `as_class_id` varchar(255) NOT NULL,
  `as_division_id` int(11) NOT NULL,
  `as_subject_id` varchar(255) NOT NULL,
  `as_name` varchar(255) NOT NULL,
  `as_description` longtext NOT NULL,
  `as_attachment` varchar(256) NOT NULL,
  `as_createdon` date NOT NULL,
  `as_lastdate` date NOT NULL,
  `person_type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_assignment`
--

INSERT INTO `es_assignment` (`es_assignmentid`, `as_academic_id`, `as_class_id`, `as_division_id`, `as_subject_id`, `as_name`, `as_description`, `as_attachment`, `as_createdon`, `as_lastdate`, `person_type`, `created_by`, `status`) VALUES
(1, 1, '2', 2, '1', 'MATHS SUM', '<p>DO THE FOLLOWIG SUM </p><p><span style="font-weight: bold;">q.1 876328042398</span></p><p><span style="font-weight: bold;">q.2 3287409283498-2</span></p><p><span style="font-weight: bold;">q.3 432894-2394230<br></span><br></p>', 'sql', '2018-03-16', '2018-03-16', 'admin', 1, 'active'),
(2, 1, '5', 5, '19', 'DRAW INIDAN FLAG DRAWING', 'draw an indian flag painting, and fill color in it.<br>', 'sql', '2018-03-16', '2018-03-16', 'teacher', 3, 'deleted'),
(3, 1, '2', 2, '1', 'test 1', '<span style="font-weight: bold;">67556<span style="font-style: italic;">8797</span></span>', '', '2018-03-17', '2018-03-17', 'admin', 1, 'active'),
(4, 1, '4', 4, '13', '*', '', 'jpg', '2018-03-17', '2018-03-17', 'admin', 1, 'active'),
(5, 1, '4', 4, '11', 'English', 'Yfucufuf', '', '2018-03-21', '2018-03-21', 'teacher', 3, 'deleted'),
(6, 1, '4', 4, '15', 'Paper craft', '', '', '2018-06-02', '2018-06-10', 'teacher', 3, 'deleted'),
(7, 3, '3', 3, '6', 'Alphabets', 'Write "A" in N.B', 'docx', '2018-06-04', '2018-06-04', 'teacher', 3, 'active'),
(8, 1, '3', 3, '7', 'Spellings', 'Pg 10. Fill in the missing numbers. in T.B.', '', '2018-06-04', '2018-06-04', 'teacher', 3, 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `es_attemptcerti`
--

CREATE TABLE `es_attemptcerti` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `exam_name` varchar(222) NOT NULL,
  `exam_date` varchar(222) NOT NULL,
  `roll_number` varchar(222) NOT NULL,
  `marks_obtained` varchar(222) NOT NULL,
  `rank` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `charector` varchar(222) NOT NULL,
  `conduct` varchar(222) NOT NULL,
  `games` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(35) NOT NULL,
  `state` varchar(35) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_attend_staff`
--

CREATE TABLE `es_attend_staff` (
  `es_attend_staffid` int(11) NOT NULL,
  `at_staff_dept` varchar(255) NOT NULL,
  `at_staff_date` date NOT NULL,
  `at_staff_id` varchar(255) NOT NULL,
  `at_staff_name` varchar(255) NOT NULL,
  `at_staff_desig` varchar(255) NOT NULL,
  `at_staff_attend` varchar(255) NOT NULL,
  `at_staff_remarks` varchar(255) NOT NULL,
  `at_time_in` time NOT NULL,
  `at_time_out` time NOT NULL,
  `leave_type` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_attend_student`
--

CREATE TABLE `es_attend_student` (
  `es_attend_studentid` int(11) NOT NULL,
  `at_std_group` varchar(255) NOT NULL,
  `at_std_class` varchar(255) NOT NULL,
  `at_attendance_date` datetime NOT NULL,
  `at_std_subject` varchar(255) NOT NULL,
  `at_std_period` int(11) NOT NULL,
  `at_period_from` int(11) NOT NULL,
  `at_period_to` int(11) NOT NULL,
  `at_reg_no` varchar(255) NOT NULL,
  `at_stud_name` varchar(255) NOT NULL,
  `at_attendance` varchar(255) NOT NULL,
  `at_remarks` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_bonafied`
--

CREATE TABLE `es_bonafied` (
  `id` int(2) NOT NULL,
  `date` date NOT NULL,
  `academic_year` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `place_of_birth` varchar(64) NOT NULL,
  `caste` varchar(128) NOT NULL,
  `grno` varchar(128) NOT NULL,
  `passed_standard` varchar(128) NOT NULL,
  `trials` varchar(128) NOT NULL,
  `progress` varchar(128) NOT NULL,
  `conduct` varchar(128) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_bonafied`
--

INSERT INTO `es_bonafied` (`id`, `date`, `academic_year`, `class_id`, `student_id`, `student_name`, `father_name`, `dob`, `place_of_birth`, `caste`, `grno`, `passed_standard`, `trials`, `progress`, `conduct`, `status`, `created_on`) VALUES
(1, '2018-03-28', 1, 4, 19, 'Kavita Moolaram Dewasi', 'Moolaram', '2012-07-18', 'Sojat', '*', '*', '*', '*', 'good', 'good', 'Active', '2018-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `es_bookissue`
--

CREATE TABLE `es_bookissue` (
  `es_bookissueid` int(11) NOT NULL,
  `bki_id` int(11) NOT NULL,
  `bki_bookid` int(11) NOT NULL,
  `issuetype` varchar(255) NOT NULL,
  `issuedate` date NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_booklets`
--

CREATE TABLE `es_booklets` (
  `booklet_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_file` varchar(255) NOT NULL,
  `book_desc` longtext NOT NULL,
  `user_type` enum('admin','staff') NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_bookreturns`
--

CREATE TABLE `es_bookreturns` (
  `id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_book_reservation`
--

CREATE TABLE `es_book_reservation` (
  `reserv_id` bigint(20) NOT NULL,
  `staff_or_student_id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `reservetype` enum('student','staff') NOT NULL,
  `reserved_on` date NOT NULL,
  `expired_on` date NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_candidate`
--

CREATE TABLE `es_candidate` (
  `es_candidateid` int(11) NOT NULL,
  `st_postaplied` varchar(255) NOT NULL,
  `st_firstname` varchar(255) NOT NULL,
  `st_lastname` varchar(255) NOT NULL,
  `st_gender` varchar(255) NOT NULL,
  `st_dob` varchar(255) NOT NULL,
  `st_primarysubject` varchar(255) NOT NULL,
  `st_fatherhusname` varchar(255) NOT NULL,
  `st_noofdughters` int(11) NOT NULL,
  `st_noofsons` int(11) NOT NULL,
  `st_email` varchar(255) NOT NULL,
  `st_mobilenocomunication` varchar(255) NOT NULL,
  `st_examp1` varchar(255) NOT NULL,
  `st_examp2` varchar(255) NOT NULL,
  `st_examp3` varchar(255) NOT NULL,
  `st_marks1` varchar(255) NOT NULL,
  `st_marks2` varchar(255) NOT NULL,
  `st_marks3` varchar(255) NOT NULL,
  `st_borduniversity1` varchar(255) NOT NULL,
  `st_borduniversity2` varchar(255) NOT NULL,
  `st_borduniversity3` varchar(255) NOT NULL,
  `st_year1` varchar(255) NOT NULL,
  `st_year2` varchar(255) NOT NULL,
  `st_year3` varchar(255) NOT NULL,
  `st_insititute1` varchar(255) NOT NULL,
  `st_insititute2` varchar(255) NOT NULL,
  `st_insititute3` varchar(255) NOT NULL,
  `st_position1` varchar(255) NOT NULL,
  `st_position2` varchar(255) NOT NULL,
  `st_position3` varchar(255) NOT NULL,
  `st_period1` varchar(255) NOT NULL,
  `st_period2` varchar(255) NOT NULL,
  `st_period3` varchar(255) NOT NULL,
  `st_pradress` varchar(255) NOT NULL,
  `st_prcity` varchar(255) NOT NULL,
  `st_prpincode` varchar(255) NOT NULL,
  `st_prphonecode` varchar(255) NOT NULL,
  `st_prstate` varchar(255) NOT NULL,
  `st_prresino` varchar(255) NOT NULL,
  `st_prcountry` varchar(255) NOT NULL,
  `st_prmobno` varchar(255) NOT NULL,
  `st_peadress` varchar(255) NOT NULL,
  `st_pecity` varchar(255) NOT NULL,
  `st_pepincode` varchar(255) NOT NULL,
  `st_pephoneno` varchar(255) NOT NULL,
  `st_pestate` varchar(255) NOT NULL,
  `st_peresino` varchar(255) NOT NULL,
  `st_pecountry` varchar(255) NOT NULL,
  `st_pemobileno` varchar(255) NOT NULL,
  `st_refposname1` varchar(255) NOT NULL,
  `st_refposname2` varchar(255) NOT NULL,
  `st_refposname3` varchar(255) NOT NULL,
  `st_refdesignation1` varchar(255) NOT NULL,
  `st_refdesignation2` varchar(255) NOT NULL,
  `st_refdesignation3` varchar(255) NOT NULL,
  `st_refinsititute1` varchar(255) NOT NULL,
  `st_refinsititute2` varchar(255) NOT NULL,
  `st_refinsititute3` varchar(255) NOT NULL,
  `st_refemail1` varchar(255) NOT NULL,
  `st_refemail2` varchar(255) NOT NULL,
  `st_refemail3` varchar(255) NOT NULL,
  `st_writentest` varchar(255) NOT NULL,
  `st_technicalinterview` varchar(255) NOT NULL,
  `st_finalinterview` varchar(255) NOT NULL,
  `status` enum('selected','notselected','onhold') NOT NULL,
  `st_perviouspackage` varchar(255) NOT NULL,
  `st_basic` varchar(255) NOT NULL,
  `st_dateofjoining` varchar(255) NOT NULL,
  `st_post` varchar(255) NOT NULL,
  `st_department` varchar(255) NOT NULL,
  `st_remarks` varchar(255) NOT NULL,
  `st_qualification` varchar(255) NOT NULL,
  `st_class` varchar(255) NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `staff_status` enum('addedtostaff','notadded') NOT NULL,
  `st_emailsend` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_caste`
--

CREATE TABLE `es_caste` (
  `caste_id` bigint(20) NOT NULL,
  `caste` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_caste`
--

INSERT INTO `es_caste` (`caste_id`, `caste`, `created_on`) VALUES
(1, 'General', '2018-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `es_categorylibrary`
--

CREATE TABLE `es_categorylibrary` (
  `es_categorylibraryid` int(11) NOT NULL,
  `lb_categoryname` varchar(255) NOT NULL,
  `lb_catdesc` longtext NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_chapters`
--

CREATE TABLE `es_chapters` (
  `chapter_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_charcerti`
--

CREATE TABLE `es_charcerti` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `exam_name` varchar(222) NOT NULL,
  `exam_date` varchar(222) NOT NULL,
  `roll_number` varchar(222) NOT NULL,
  `marks_obtained` varchar(222) NOT NULL,
  `rank` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `charector` varchar(222) NOT NULL,
  `conduct` varchar(222) NOT NULL,
  `games` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_classes`
--

CREATE TABLE `es_classes` (
  `es_classesid` int(11) NOT NULL,
  `es_classname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `es_orderby` int(11) NOT NULL,
  `es_schoolid` int(11) NOT NULL,
  `es_groupid` int(11) NOT NULL,
  `minimum_age` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `es_classes`
--

INSERT INTO `es_classes` (`es_classesid`, `es_classname`, `es_orderby`, `es_schoolid`, `es_groupid`, `minimum_age`) VALUES
(1, 'NURSERY (ENGLISH)', 1, 0, 2, '1'),
(2, 'NURSERY (GUJARATI)', 2, 0, 2, '1'),
(3, 'JR.KG', 3, 0, 2, '3'),
(4, 'SR.KG.', 4, 0, 2, '4'),
(5, 'SOPAN - 1', 5, 0, 1, '1'),
(6, 'SOPAN - 2', 6, 0, 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `es_classifieds`
--

CREATE TABLE `es_classifieds` (
  `es_classifiedsid` int(11) NOT NULL,
  `cfs_name` varchar(255) NOT NULL,
  `cfs_modeofadds` varchar(255) NOT NULL,
  `cfs_posteddate` date NOT NULL,
  `cfs_details` longtext NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_deductionmaster`
--

CREATE TABLE `es_deductionmaster` (
  `es_deductionmasterid` int(11) NOT NULL,
  `ded_type` varchar(255) NOT NULL,
  `ded_fromdate` date NOT NULL,
  `ded_todate` date NOT NULL,
  `ded_dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_departments`
--

CREATE TABLE `es_departments` (
  `es_departmentsid` int(11) NOT NULL,
  `es_deptname` varchar(255) NOT NULL,
  `es_orderby` int(11) NOT NULL,
  `es_groupid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_departments`
--

INSERT INTO `es_departments` (`es_departmentsid`, `es_deptname`, `es_orderby`, `es_groupid`) VALUES
(1, 'KINDER GARDEN ACADEMY', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `es_deptposts`
--

CREATE TABLE `es_deptposts` (
  `es_deptpostsid` int(11) NOT NULL,
  `es_postshortname` varchar(255) NOT NULL,
  `es_postcode` varchar(255) NOT NULL,
  `es_postname` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_deptposts`
--

INSERT INTO `es_deptposts` (`es_deptpostsid`, `es_postshortname`, `es_postcode`, `es_postname`, `status`) VALUES
(1, '1', '', 'PRINCIPAL', ''),
(2, '1', '', 'CO-ORDINATOR', ''),
(3, '1', '', 'TEACHER', ''),
(4, '1', '', 'ADMIN', '');

-- --------------------------------------------------------

--
-- Table structure for table `es_dispatch`
--

CREATE TABLE `es_dispatch` (
  `id` int(11) NOT NULL,
  `dispatch_category` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL DEFAULT 'Active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_dispatch_entry`
--

CREATE TABLE `es_dispatch_entry` (
  `id` int(11) NOT NULL,
  `dispatchgroup` int(11) NOT NULL,
  `dateofdispatch` date NOT NULL,
  `received_company` varchar(255) NOT NULL,
  `received_address` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `partculars` text NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `recived_by` varchar(255) NOT NULL,
  `submited_to` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `latter_status` enum('Open','Closed') NOT NULL DEFAULT 'Closed',
  `status` enum('Active','Inactive','Delete') NOT NULL DEFAULT 'Active',
  `out_sender` varchar(255) NOT NULL,
  `out_to` varchar(255) NOT NULL,
  `out_address` text NOT NULL,
  `out_type` varchar(255) NOT NULL,
  `out_sentthrough` varchar(255) NOT NULL,
  `in_receivedthrough` varchar(255) NOT NULL,
  `consignment_no` varchar(255) NOT NULL,
  `dispatch_type` varchar(255) NOT NULL,
  `outward_dispatch_type` varchar(255) NOT NULL,
  `d_letter_types` varchar(255) NOT NULL,
  `p_latter_id` int(11) NOT NULL,
  `courrier_name` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_division`
--

CREATE TABLE `es_division` (
  `es_divisionid` int(11) NOT NULL,
  `es_classid` int(11) DEFAULT NULL COMMENT 'Reference of es_classes  table',
  `es_divisionname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_division`
--

INSERT INTO `es_division` (`es_divisionid`, `es_classid`, `es_divisionname`) VALUES
(2, 3, 'Div G'),
(3, 5, 'Div B');

-- --------------------------------------------------------

--
-- Table structure for table `es_eligibilitycerti`
--

CREATE TABLE `es_eligibilitycerti` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `exam_name` varchar(222) NOT NULL,
  `exam_date` varchar(222) NOT NULL,
  `roll_number` varchar(222) NOT NULL,
  `marks_obtained` varchar(222) NOT NULL,
  `rank` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `charector` varchar(222) NOT NULL,
  `conduct` varchar(222) NOT NULL,
  `games` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(35) NOT NULL,
  `state` varchar(35) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_enquiry`
--

CREATE TABLE `es_enquiry` (
  `es_enquiryid` int(11) NOT NULL,
  `eq_serialno` int(11) NOT NULL,
  `eq_createdon` date NOT NULL,
  `eq_name` varchar(255) NOT NULL,
  `eq_address` varchar(255) NOT NULL,
  `eq_city` varchar(255) NOT NULL,
  `eq_wardname` varchar(255) NOT NULL,
  `eq_sex` varchar(255) NOT NULL,
  `eq_class` varchar(255) NOT NULL,
  `eq_phno` varchar(255) NOT NULL,
  `eq_mobile` varchar(255) NOT NULL,
  `eq_emailid` varchar(255) NOT NULL,
  `eq_reftype` varchar(255) NOT NULL,
  `eq_refname` varchar(255) NOT NULL,
  `eq_description` varchar(255) NOT NULL,
  `eq_formtype` varchar(255) NOT NULL,
  `eq_paymode` varchar(255) NOT NULL,
  `eq_chequeno` varchar(255) NOT NULL,
  `eq_bankname` varchar(255) NOT NULL,
  `eq_submitedon` date NOT NULL,
  `eq_acadamic` varchar(255) NOT NULL,
  `eq_marksobtain` int(11) NOT NULL,
  `eq_outof` int(11) NOT NULL,
  `eq_oralexam` varchar(255) NOT NULL,
  `eq_familyinteraction` varchar(255) NOT NULL,
  `eq_percentage` double NOT NULL,
  `eq_result` varchar(255) NOT NULL,
  `eq_amountpaid` varchar(255) NOT NULL,
  `eq_state` varchar(255) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `eq_mothername` varchar(255) NOT NULL,
  `eq_zip` varchar(255) NOT NULL,
  `college_id` int(11) NOT NULL,
  `eq_prv_acdmic` text NOT NULL,
  `eq_countryid` varchar(255) NOT NULL,
  `eq_dob` date NOT NULL,
  `eq_application_no` varchar(255) NOT NULL,
  `es_voucherentryid` int(11) NOT NULL,
  `pre_class` varchar(255) NOT NULL,
  `scat_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_exam`
--

CREATE TABLE `es_exam` (
  `es_examid` int(11) NOT NULL,
  `es_examname` varchar(255) NOT NULL,
  `es_examordby` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_examfee`
--

CREATE TABLE `es_examfee` (
  `exam_fee_id` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `fine_name` varchar(255) NOT NULL,
  `fine_amount` double NOT NULL,
  `created_on` date NOT NULL,
  `paid_amount` double NOT NULL,
  `deduction_allowed` double NOT NULL,
  `paid_on` date NOT NULL,
  `balance` double NOT NULL,
  `remarks` text NOT NULL,
  `voucherid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_exam_academic`
--

CREATE TABLE `es_exam_academic` (
  `es_exam_academicid` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_exam_details`
--

CREATE TABLE `es_exam_details` (
  `es_exam_detailsid` int(11) NOT NULL,
  `academicexam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_date` datetime NOT NULL,
  `exam_duration` varchar(255) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `pass_marks` int(11) NOT NULL,
  `upload_exam_paper` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_expcerti`
--

CREATE TABLE `es_expcerti` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `aced_year` varchar(255) NOT NULL,
  `doj` varchar(255) NOT NULL,
  `charac` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_on` varchar(255) NOT NULL,
  `conduct` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_fa_groups`
--

CREATE TABLE `es_fa_groups` (
  `es_fa_groupsid` int(11) NOT NULL,
  `fa_groupname` varchar(255) NOT NULL,
  `fa_undergroup` varchar(255) NOT NULL,
  `fa_display` int(5) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_feemaster`
--

CREATE TABLE `es_feemaster` (
  `es_feemasterid` int(11) NOT NULL,
  `academy_year_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `fee_class` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `fee_particular` varchar(255) NOT NULL,
  `fee_amount` double NOT NULL,
  `optional` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `ledger_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_feemaster`
--

INSERT INTO `es_feemaster` (`es_feemasterid`, `academy_year_id`, `section_id`, `fee_class`, `semester_id`, `fee_particular`, `fee_amount`, `optional`, `ledger_id`, `order_by`) VALUES
(1, 1, 2, 1, 2, 'ADMISSION FEES ', 1000, 'YES', 3, 0),
(2, 1, 2, 1, 2, 'SCHOOL FEES', 2125, 'NO', 4, 0),
(3, 1, 2, 1, 4, 'SCHOOL FEES', 2125, 'NO', 4, 0),
(4, 1, 2, 1, 6, 'SCHOOL FEES', 2125, 'NO', 4, 0),
(5, 1, 2, 1, 8, 'SCHOOL FEES', 2125, 'NO', 4, 0),
(6, 1, 2, 2, 2, 'ADMISSION FEES', 1000, 'YES', 3, 0),
(7, 1, 2, 2, 2, 'SCHOOL FEES', 3250, 'NO', 4, 0),
(8, 1, 2, 2, 4, 'SCHOOL FEES', 3250, 'NO', 4, 0),
(9, 1, 2, 2, 6, 'SCHOOL FEES', 3250, 'NO', 4, 0),
(10, 1, 2, 2, 8, 'SCHOOL FEES', 3250, 'NO', 4, 0),
(11, 1, 2, 3, 2, 'ADMISSION FEES', 1000, 'YES', 3, 0),
(12, 1, 2, 3, 2, 'SCHOOL FEES', 3500, 'NO', 4, 0),
(13, 1, 2, 3, 4, 'SCHOOL FEES', 3500, 'NO', 4, 0),
(14, 1, 2, 3, 6, 'SCHOOL FEES', 3500, 'NO', 4, 0),
(15, 1, 2, 3, 8, 'SCHOOL FEES', 3500, 'NO', 4, 0),
(16, 1, 2, 4, 2, 'ADMISSION FEES', 1000, 'YES', 3, 0),
(17, 1, 2, 4, 2, 'SCHOOL FEES', 3750, 'NO', 4, 0),
(18, 1, 2, 4, 4, 'SCHOOL FEES', 3750, 'NO', 4, 0),
(19, 1, 2, 4, 6, 'SCHOOL FEES', 3750, 'NO', 4, 0),
(20, 1, 2, 4, 8, 'SCHOOL FEES', 3750, 'NO', 4, 0),
(21, 1, 1, 5, 1, 'ADMISSION FEES', 1000, 'YES', 1, 0),
(22, 1, 1, 5, 1, 'SCHOOL FEES', 2375, 'NO', 2, 0),
(23, 1, 1, 5, 3, 'SCHOOL FEES', 2375, 'NO', 2, 0),
(24, 1, 1, 5, 5, 'SCHOOL FEES', 2375, 'NO', 2, 0),
(25, 1, 1, 5, 7, 'SCHOOL FEES', 2375, 'NO', 2, 0),
(26, 1, 1, 6, 1, 'ADMISSION FEES', 1000, 'YES', 1, 0),
(27, 1, 1, 6, 1, 'SCHOOL FEES', 2625, 'NO', 2, 0),
(28, 1, 1, 6, 3, 'SCHOOL FEES', 2625, 'NO', 2, 0),
(29, 1, 1, 6, 5, 'SCHOOL FEES', 2625, 'NO', 2, 0),
(30, 1, 1, 6, 7, 'SCHOOL FEES', 2625, 'NO', 2, 0),
(31, 3, 2, 1, 9, 'Admission Fees', 1000, 'YES', 5, 0),
(32, 3, 2, 2, 9, 'Admission Fees', 1000, 'YES', 5, 0),
(33, 3, 2, 3, 9, 'Admission Fees', 1000, 'YES', 5, 0),
(34, 3, 2, 4, 9, 'Admission Fees', 1000, 'YES', 5, 0),
(35, 3, 2, 2, 9, 'Tution Fees', 2750, 'NO', 5, 0),
(36, 3, 2, 2, 9, 'Activity Fees', 300, 'NO', 5, 0),
(37, 3, 2, 2, 9, 'App Fee', 100, 'NO', 5, 0),
(38, 3, 2, 2, 9, 'Exam Fees', 100, 'NO', 5, 0),
(39, 3, 2, 2, 10, 'Tution Fees', 2750, 'NO', 5, 0),
(40, 3, 2, 2, 10, 'Activity Fees', 300, 'NO', 5, 0),
(41, 3, 2, 2, 10, 'App Fee', 100, 'NO', 5, 0),
(42, 3, 2, 2, 10, 'Exam Fees', 100, 'NO', 5, 0),
(43, 3, 2, 2, 11, 'Tution Fees', 2750, 'NO', 5, 0),
(44, 3, 2, 2, 11, 'Activity Fees', 300, 'NO', 5, 0),
(45, 3, 2, 2, 11, 'App Fee', 100, 'NO', 5, 0),
(46, 3, 2, 2, 11, 'Exam Fees', 100, 'NO', 5, 0),
(47, 3, 2, 2, 12, 'Tution Fees', 2750, 'NO', 5, 0),
(48, 3, 2, 2, 12, 'Activity Fees', 300, 'NO', 5, 0),
(49, 3, 2, 2, 12, 'App Fee', 100, 'NO', 5, 0),
(50, 3, 2, 2, 12, 'Exam Fees', 100, 'NO', 5, 0),
(51, 3, 2, 3, 9, 'Tution Fees', 3000, 'NO', 5, 0),
(52, 3, 2, 3, 9, 'Activity Fees', 300, 'NO', 5, 0),
(53, 3, 2, 3, 9, 'App Fee', 100, 'NO', 5, 0),
(54, 3, 2, 3, 9, 'Exam Fees', 100, 'NO', 5, 0),
(55, 3, 2, 3, 10, 'Tution Fees', 3000, 'NO', 5, 0),
(56, 3, 2, 3, 10, 'Activity Fees', 300, 'NO', 5, 0),
(57, 3, 2, 3, 10, 'App Fee', 100, 'NO', 5, 0),
(58, 3, 2, 3, 10, 'Exam Fees', 100, 'NO', 5, 0),
(59, 3, 2, 3, 11, 'Tution Fees', 3000, 'NO', 5, 0),
(60, 3, 2, 3, 11, 'Activity Fees', 300, 'NO', 5, 0),
(61, 3, 2, 3, 11, 'App Fee', 100, 'NO', 5, 0),
(62, 3, 2, 3, 11, 'Exam Fees', 100, 'NO', 5, 0),
(63, 3, 2, 3, 12, 'Tution Fees', 3000, 'NO', 5, 0),
(64, 3, 2, 3, 12, 'Activity Fees', 300, 'NO', 5, 0),
(65, 3, 2, 3, 12, 'App Fee', 100, 'NO', 5, 0),
(66, 3, 2, 3, 12, 'Exam Fees', 100, 'NO', 5, 0),
(67, 3, 2, 4, 9, 'Tution Fees', 3250, 'NO', 5, 0),
(68, 3, 2, 4, 9, 'Activity Fees', 300, 'NO', 5, 0),
(69, 3, 2, 4, 9, 'App Fee', 100, 'NO', 5, 0),
(70, 3, 2, 4, 9, 'Exam Fees', 100, 'NO', 5, 0),
(71, 3, 2, 4, 10, 'Tution Fees', 3250, 'NO', 5, 0),
(72, 3, 2, 4, 10, 'Activity Fees', 300, 'NO', 5, 0),
(73, 3, 2, 4, 10, 'App Fee', 100, 'NO', 5, 0),
(74, 3, 2, 4, 10, 'Exam Fees', 100, 'NO', 5, 0),
(75, 3, 2, 4, 11, 'Tution Fees', 3250, 'NO', 5, 0),
(76, 3, 2, 4, 11, 'Activity Fees', 300, 'NO', 5, 0),
(77, 3, 2, 4, 11, 'App Fee', 100, 'NO', 5, 0),
(78, 3, 2, 4, 11, 'Exam Fees', 100, 'NO', 5, 0),
(79, 3, 2, 4, 12, 'Tution Fees', 3250, 'NO', 5, 0),
(80, 3, 2, 4, 12, 'Activity Fees', 300, 'NO', 5, 0),
(81, 3, 2, 4, 12, 'App Fee', 100, 'NO', 5, 0),
(82, 3, 2, 4, 12, 'Exam Fees', 100, 'NO', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `es_feepaid`
--

CREATE TABLE `es_feepaid` (
  `fid` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `receipt_no` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_date` date NOT NULL,
  `financemaster_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `semester_id` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `received_amount` int(11) NOT NULL,
  `concession` int(11) NOT NULL,
  `fine` int(11) NOT NULL,
  `transportation_fees` int(11) NOT NULL,
  `transport_concession` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `not_applicable` int(11) NOT NULL,
  `payment_mode` enum('Cash','Cheque','Bank Deposit','DD') CHARACTER SET latin1 NOT NULL,
  `voucherid` int(50) NOT NULL,
  `es_remarks` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `cheque_bank_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_account_no` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_account_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `cheque_no` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_bank_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_bank_account_no` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depositor_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desposit_slip_no` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dd_no` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dd_depositor` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `es_feepaid`
--

INSERT INTO `es_feepaid` (`fid`, `es_preadmissionid`, `receipt_no`, `receipt_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `fine`, `transportation_fees`, `transport_concession`, `grand_total`, `not_applicable`, `payment_mode`, `voucherid`, `es_remarks`, `cheque_bank_name`, `cheque_account_no`, `cheque_account_name`, `cheque_date`, `cheque_no`, `school_bank_name`, `school_bank_account_no`, `depositor_name`, `desposit_slip_no`, `dd_no`, `dd_depositor`, `status`) VALUES
(1, 92, '4', '2018-05-09', 3, 2, '9', 7250, 0, 0, 3000, 0, 7250, 0, 'Bank Deposit', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `es_feepaid_new_details`
--

CREATE TABLE `es_feepaid_new_details` (
  `fp_det_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `particular_id` int(11) NOT NULL,
  `particulars` varchar(255) CHARACTER SET latin1 NOT NULL,
  `amount` varchar(255) CHARACTER SET latin1 NOT NULL,
  `concession` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `applicable` enum('YES','NO') CHARACTER SET latin1 NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `es_feepaid_new_details`
--

INSERT INTO `es_feepaid_new_details` (`fp_det_id`, `fid`, `student_id`, `particular_id`, `particulars`, `amount`, `concession`, `total_amount`, `applicable`, `created_on`) VALUES
(1, 1, 92, 32, 'Admission Fees', '1000', 0, 1000, 'YES', '0000-00-00'),
(2, 1, 92, 35, 'Tution Fees', '2750', 0, 2750, 'YES', '0000-00-00'),
(3, 1, 92, 36, 'Activity Fees', '300', 0, 300, 'YES', '0000-00-00'),
(4, 1, 92, 37, 'App Fee', '100', 0, 100, 'YES', '0000-00-00'),
(5, 1, 92, 38, 'Exam Fees', '100', 0, 100, 'YES', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `es_feesnotice`
--

CREATE TABLE `es_feesnotice` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `exam_name` varchar(222) NOT NULL,
  `exam_date` varchar(222) NOT NULL,
  `roll_number` varchar(222) NOT NULL,
  `marks_obtained` varchar(222) NOT NULL,
  `rank` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `charector` varchar(222) NOT NULL,
  `conduct` varchar(222) NOT NULL,
  `games` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(222) NOT NULL,
  `state` varchar(222) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `fee` varchar(230) NOT NULL,
  `subject` varchar(230) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_fee_inst_last_date`
--

CREATE TABLE `es_fee_inst_last_date` (
  `inst_id` int(11) NOT NULL,
  `es_finance_masterid` int(11) NOT NULL,
  `instalment_no` int(11) NOT NULL,
  `last_date` date NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_finance_master`
--

CREATE TABLE `es_finance_master` (
  `es_finance_masterid` int(11) NOT NULL,
  `fi_startdate` date NOT NULL,
  `fi_enddate` date NOT NULL,
  `fi_address` text NOT NULL,
  `fi_currency` varchar(255) NOT NULL,
  `fi_symbol` varchar(255) NOT NULL,
  `fi_email` varchar(255) NOT NULL,
  `fi_initialbalance` float NOT NULL,
  `fi_phoneno` varchar(255) NOT NULL,
  `fi_school_logo` varchar(255) NOT NULL,
  `fi_website` varchar(255) NOT NULL,
  `fi_ac_startdate` date NOT NULL,
  `fi_ac_enddate` date NOT NULL,
  `fi_schoolname` varchar(255) NOT NULL,
  `fi_endclass` varchar(255) NOT NULL,
  `affiliation_detail` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_finance_master`
--

INSERT INTO `es_finance_master` (`es_finance_masterid`, `fi_startdate`, `fi_enddate`, `fi_address`, `fi_currency`, `fi_symbol`, `fi_email`, `fi_initialbalance`, `fi_phoneno`, `fi_school_logo`, `fi_website`, `fi_ac_startdate`, `fi_ac_enddate`, `fi_schoolname`, `fi_endclass`, `affiliation_detail`) VALUES
(1, '2017-04-01', '2018-03-31', 'Gandhidham', 'INR', 'Rs', 'mundra@sanskarschool.ac.in', 0, '8758091409 | 9712774899', 'st_12082016_121209_color jpeg.jpg', '', '2017-04-01', '2018-03-31', 'Zest Career Eduventure', '', ''),
(3, '2018-04-01', '2019-03-31', 'Gandhidham', 'INR', 'Rs', 'mundra@sanskarschool.ac.in', 0, '8758091409 | 9712774899', 'st_12082016_121209_color jpeg.jpg', '', '2018-04-01', '2019-03-31', 'Zest Career Eduventure', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `es_fine_charged_collected`
--

CREATE TABLE `es_fine_charged_collected` (
  `es_fcc_id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `es_feemasterid` int(11) NOT NULL,
  `fine_amount` double NOT NULL,
  `amount_paid` double NOT NULL,
  `deduction_allowed` double NOT NULL,
  `es_installment` int(11) NOT NULL,
  `date` date NOT NULL,
  `fi_fromdate` date NOT NULL,
  `fi_todate` date NOT NULL,
  `es_voucherentryid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_fine_master`
--

CREATE TABLE `es_fine_master` (
  `es_fine_masterid` int(11) NOT NULL,
  `fine_amount` float NOT NULL,
  `fine_type` enum('Percentage','Amount') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_groups`
--

CREATE TABLE `es_groups` (
  `es_groupsid` int(11) NOT NULL,
  `es_groupname` varchar(255) NOT NULL,
  `es_grouporderby` int(11) NOT NULL,
  `school_name` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_groups`
--

INSERT INTO `es_groups` (`es_groupsid`, `es_groupname`, `es_grouporderby`, `school_name`) VALUES
(1, 'GUJARATI MEDIUM', 1, ''),
(2, 'ENGLISH MEDIUM', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `es_holidaynoti`
--

CREATE TABLE `es_holidaynoti` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `exam_name` varchar(222) NOT NULL,
  `exam_date` varchar(222) NOT NULL,
  `roll_number` varchar(222) NOT NULL,
  `marks_obtained` varchar(222) NOT NULL,
  `rank` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `charector` varchar(222) NOT NULL,
  `conduct` varchar(222) NOT NULL,
  `games` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_holidays`
--

CREATE TABLE `es_holidays` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_holidays`
--

INSERT INTO `es_holidays` (`id`, `title`, `holiday_date`, `status`, `created_on`) VALUES
(3, 'Second saturday /àªšà«‹àª¥à«‹ àª¶àª¨àª¿àªµàª¾àª°', '2018-06-23', 'active', '2018-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `es_hostelbuld`
--

CREATE TABLE `es_hostelbuld` (
  `es_hostelbuldid` int(11) NOT NULL,
  `buld_name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `createdon` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_hostelperson_item`
--

CREATE TABLE `es_hostelperson_item` (
  `es_hostelperson_itemid` int(11) NOT NULL,
  `hostelperson_itemno` int(11) NOT NULL,
  `hostelperson_itemcode` int(11) NOT NULL,
  `hostelperson_itemname` varchar(255) NOT NULL,
  `hostelperson_itemtype` varchar(255) NOT NULL,
  `hostelperson_itemqty` int(11) NOT NULL,
  `es_personid` int(11) NOT NULL,
  `hostelperson_itemissued` datetime NOT NULL,
  `es_persontype` varchar(255) NOT NULL,
  `es_roomallotmentid` int(11) NOT NULL,
  `status` enum('issued','issuereturn') NOT NULL,
  `return_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_hostelroom`
--

CREATE TABLE `es_hostelroom` (
  `es_hostelroomid` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `room_vacancy` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `buld_name` varchar(255) NOT NULL,
  `es_hostelbuldid` int(11) DEFAULT NULL,
  `room_rate` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_hostel_charges`
--

CREATE TABLE `es_hostel_charges` (
  `es_hostel_charges_id` int(11) NOT NULL,
  `es_roomallotmentid` int(11) NOT NULL,
  `es_hostelbuldid` int(11) NOT NULL,
  `es_personid` int(11) NOT NULL,
  `es_persontype` varchar(255) NOT NULL,
  `due_month` date NOT NULL,
  `room_rate` double NOT NULL,
  `amount_paid` double NOT NULL,
  `deduction` double NOT NULL,
  `balance` double NOT NULL,
  `name` varchar(255) NOT NULL,
  `father` varchar(255) NOT NULL,
  `paid_on` date NOT NULL,
  `remarks` text NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_hostel_health`
--

CREATE TABLE `es_hostel_health` (
  `es_hostel_healthid` int(11) NOT NULL,
  `health_regno` int(11) NOT NULL,
  `health_name` varchar(255) NOT NULL,
  `health_class` varchar(255) NOT NULL,
  `health_section` varchar(255) NOT NULL,
  `health_problem` varchar(255) NOT NULL,
  `health_doctorname` varchar(255) NOT NULL,
  `health_address` varchar(255) NOT NULL,
  `health_contactno` int(11) NOT NULL,
  `health_prescription` varchar(255) NOT NULL,
  `es_personid` int(11) NOT NULL,
  `es_persontpe` varchar(255) NOT NULL,
  `es_createdon` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_idcard_image`
--

CREATE TABLE `es_idcard_image` (
  `id` int(11) NOT NULL,
  `horizontal_image` varchar(255) NOT NULL,
  `vertical_image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_incharge`
--

CREATE TABLE `es_incharge` (
  `incharge_id` int(11) NOT NULL,
  `es_classesid` varchar(255) NOT NULL,
  `es_staffid` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_institutes`
--

CREATE TABLE `es_institutes` (
  `inst_id` int(11) NOT NULL,
  `inst_name` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_inventory`
--

CREATE TABLE `es_inventory` (
  `es_inventoryid` int(11) NOT NULL,
  `in_inventory_name` varchar(255) NOT NULL,
  `in_short_name` varchar(255) NOT NULL,
  `in_description` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_category`
--

CREATE TABLE `es_in_category` (
  `es_in_categoryid` int(11) NOT NULL,
  `in_category_name` varchar(255) NOT NULL,
  `in_description` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_in_category`
--

INSERT INTO `es_in_category` (`es_in_categoryid`, `in_category_name`, `in_description`, `status`) VALUES
(1, 'Stationary', 'Stationary Items', 'active'),
(2, 'electronics', 'electrical goods', 'active'),
(3, 'grocery', 'kitchen items', 'active'),
(4, 'cleaning items', 'all items related to cleaning', 'active'),
(5, 'MEDICAL ', 'ALL TYPES OF MEDICAL ITEM', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `es_in_goods_issue`
--

CREATE TABLE `es_in_goods_issue` (
  `es_in_goods_issueid` int(11) NOT NULL,
  `in_issue_date` date NOT NULL,
  `request_id` varchar(4) DEFAULT NULL,
  `in_issue_to` varchar(255) NOT NULL,
  `staff_id` varchar(4) DEFAULT NULL,
  `remarks` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_goods_issue_items`
--

CREATE TABLE `es_in_goods_issue_items` (
  `es_in_goods_issue_item_id` int(11) NOT NULL,
  `es_in_goods_issue_id` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` enum('RETURNED','NOT RETURNED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_goods_issue_requests`
--

CREATE TABLE `es_in_goods_issue_requests` (
  `es_in_goods_issueid` int(11) NOT NULL,
  `in_issue_date` date NOT NULL,
  `staff_id` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','Rejected','') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_goods_issue_request_items`
--

CREATE TABLE `es_in_goods_issue_request_items` (
  `es_in_goods_issue_item_id` int(11) NOT NULL,
  `es_in_goods_issue_id` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_goods_receipt_note`
--

CREATE TABLE `es_in_goods_receipt_note` (
  `grn_id` int(11) NOT NULL,
  `es_order_id` varchar(11) DEFAULT NULL,
  `grn_date` date NOT NULL,
  `bill_no` varchar(32) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `additional_amount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `remarks` varchar(1024) NOT NULL,
  `paid_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_goods_receipt_note_items`
--

CREATE TABLE `es_in_goods_receipt_note_items` (
  `es_in_goods_receipt_note_itemsid` int(11) NOT NULL,
  `grn_id` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_item_master`
--

CREATE TABLE `es_in_item_master` (
  `es_in_item_masterid` int(11) NOT NULL,
  `in_item_code` varchar(255) NOT NULL,
  `in_item_name` varchar(255) NOT NULL,
  `cost` bigint(20) NOT NULL,
  `in_inventory_id` enum('Returnable Goods','Non-returnable Goods') NOT NULL,
  `in_category_id` int(11) NOT NULL,
  `in_qty_available` float NOT NULL,
  `in_reorder_level` float NOT NULL,
  `in_quantity_issued` float NOT NULL DEFAULT '0',
  `in_last_recieved_date` datetime NOT NULL,
  `in_last_issued_date` datetime NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `in_units` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_in_item_master`
--

INSERT INTO `es_in_item_master` (`es_in_item_masterid`, `in_item_code`, `in_item_name`, `cost`, `in_inventory_id`, `in_category_id`, `in_qty_available`, `in_reorder_level`, `in_quantity_issued`, `in_last_recieved_date`, `in_last_issued_date`, `status`, `in_units`) VALUES
(1, '', '', 0, 'Non-returnable Goods', 1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'deleted', '10 pens'),
(2, '380006', 'tst', 1200, 'Non-returnable Goods', 1, 10, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active', '100');

-- --------------------------------------------------------

--
-- Table structure for table `es_in_orders`
--

CREATE TABLE `es_in_orders` (
  `es_in_ordersid` int(11) NOT NULL,
  `in_suplier_id` int(4) NOT NULL,
  `order_date` date NOT NULL,
  `in_ord_status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_orders_items`
--

CREATE TABLE `es_in_orders_items` (
  `es_order_item_id` int(11) NOT NULL,
  `es_order_id` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ordered_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_quotation_requests`
--

CREATE TABLE `es_in_quotation_requests` (
  `rfq_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `quotation_date` date NOT NULL,
  `quotation_subject` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `message_body` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `es_in_supplier_master`
--

CREATE TABLE `es_in_supplier_master` (
  `es_in_supplier_masterid` int(11) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_address` varchar(255) NOT NULL,
  `in_city` varchar(255) NOT NULL,
  `in_state` varchar(255) NOT NULL,
  `in_country` varchar(255) NOT NULL,
  `in_office_no` varchar(255) NOT NULL,
  `in_mobile_no` varchar(255) NOT NULL,
  `in_email` varchar(255) NOT NULL,
  `in_fax` varchar(255) NOT NULL,
  `in_description` varchar(255) NOT NULL,
  `bank_account_name` varchar(128) NOT NULL,
  `bank_account_no` varchar(128) NOT NULL,
  `bank_name` varchar(128) NOT NULL,
  `bank_branch` varchar(128) NOT NULL,
  `beneficary_code` varchar(128) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_issueloan`
--

CREATE TABLE `es_issueloan` (
  `es_issueloanid` int(11) NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `es_loanmasterid` int(11) NOT NULL,
  `loan_intrestrate` float NOT NULL,
  `loan_amount` float NOT NULL,
  `loan_instalments` int(11) NOT NULL,
  `deductionmonth` date NOT NULL,
  `dud_amount` float NOT NULL,
  `amountpaidtillnow` float NOT NULL,
  `noofinstalmentscompleted` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `voucherid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_knowledge_articles`
--

CREATE TABLE `es_knowledge_articles` (
  `es_knowledge_articlesid` int(11) NOT NULL,
  `kb_category_id` int(11) NOT NULL,
  `kb_article_name` varchar(255) NOT NULL,
  `kb_article_desc` text NOT NULL,
  `kb_article_date` datetime NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `kb_priority` varchar(255) NOT NULL,
  `kb_views` bigint(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `person_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_knowledge_base`
--

CREATE TABLE `es_knowledge_base` (
  `es_knowledge_baseid` int(11) NOT NULL,
  `kb_category` varchar(255) NOT NULL,
  `kb_description` text NOT NULL,
  `kb_date` datetime NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_leavemaster`
--

CREATE TABLE `es_leavemaster` (
  `es_leavemasterid` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `leave_department` int(11) NOT NULL,
  `leave_name` varchar(264) NOT NULL,
  `allowed_leave` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_leave_request`
--

CREATE TABLE `es_leave_request` (
  `es_leave_request_id` int(11) NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `leave_fromdate` date NOT NULL,
  `leave_todate` date NOT NULL,
  `priority` varchar(64) NOT NULL,
  `reason` varchar(2048) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `leave_duration` enum('Full Day','First Half','Second Half') NOT NULL DEFAULT 'Full Day',
  `status` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `es_leave_request`
--

INSERT INTO `es_leave_request` (`es_leave_request_id`, `es_staffid`, `leave_fromdate`, `leave_todate`, `priority`, `reason`, `leave_type`, `leave_duration`, `status`) VALUES
(1, 3, '2018-06-02', '2018-06-02', 'Normal', 'Personal reasons', 0, 'Full Day', 'Pending'),
(2, 3, '2018-06-04', '2018-06-04', 'Normal', 'not well', 0, 'First Half', 'Pending'),
(3, 3, '2018-06-04', '2018-06-04', 'Normal', 'Not well', 0, 'First Half', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `es_ledger`
--

CREATE TABLE `es_ledger` (
  `es_ledgerid` int(11) NOT NULL,
  `lg_name` varchar(255) NOT NULL,
  `lg_openingbalance` double NOT NULL,
  `lg_createdon` date NOT NULL,
  `lg_amounttype` varchar(255) NOT NULL,
  `lg_remarks` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_ledger`
--

INSERT INTO `es_ledger` (`es_ledgerid`, `lg_name`, `lg_openingbalance`, `lg_createdon`, `lg_amounttype`, `lg_remarks`) VALUES
(1, 'GUJARATI MEDIUM (ADMISSION FEES)', 0, '0000-00-00', '', ''),
(2, 'GUJARATI MEDIUM (INSTALLMENT FEES)', 0, '0000-00-00', '', ''),
(3, 'ENGLISH MEDIUM (ADMISSION FEES)', 0, '0000-00-00', '', ''),
(4, 'ENGLISH MEDIUM (INSTALLMENT FEES)', 0, '0000-00-00', '', ''),
(5, 'AXIS BANK', 0, '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `es_libaraypublisher`
--

CREATE TABLE `es_libaraypublisher` (
  `es_libaraypublisherid` int(11) NOT NULL,
  `library_publishername` varchar(255) NOT NULL,
  `library_pulisheradress` varchar(255) NOT NULL,
  `library_city` varchar(255) NOT NULL,
  `libaray_state` varchar(255) NOT NULL,
  `libarary_country` varchar(255) NOT NULL,
  `libaray_phoneno` varchar(255) NOT NULL,
  `librray_mobileno` varchar(255) NOT NULL,
  `library_fax` varchar(255) NOT NULL,
  `libarary_email` varchar(255) NOT NULL,
  `libarary_aditinalinformation` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_libbook`
--

CREATE TABLE `es_libbook` (
  `es_libbookid` int(11) NOT NULL,
  `lbook_dateofpurchase` date NOT NULL,
  `lbook_aceesnofrom` int(11) NOT NULL,
  `lbook_accessnoto` int(11) NOT NULL,
  `lbook_bookfromno` int(11) NOT NULL,
  `lbook_booktono` int(11) NOT NULL,
  `lbook_author` varchar(255) NOT NULL,
  `lbook_title` varchar(255) NOT NULL,
  `lbook_publishername` varchar(255) NOT NULL,
  `lbook_publisherplace` varchar(255) NOT NULL,
  `lbook_booksubject` varchar(255) NOT NULL,
  `lbook_bookedition` varchar(255) NOT NULL,
  `lbook_year` varchar(255) NOT NULL,
  `lbook_cost` varchar(255) NOT NULL,
  `lbook_sourse` varchar(255) NOT NULL,
  `lbook_aditinalbookinfo` varchar(255) NOT NULL,
  `lbook_bookstatus` varchar(255) NOT NULL,
  `lbook_category` varchar(255) NOT NULL,
  `lbook_class` varchar(255) NOT NULL,
  `lbook_booksubcategory` varchar(255) NOT NULL,
  `lbook_ref` varchar(255) NOT NULL,
  `lbook_statusstatus` varchar(255) NOT NULL,
  `lbook_pages` varchar(255) NOT NULL,
  `lbook_volume` varchar(255) NOT NULL,
  `lbook_bilnumber` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `issuestatus` enum('issued','notissued') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_libbookfinedet`
--

CREATE TABLE `es_libbookfinedet` (
  `es_libbookfinedetid` int(11) NOT NULL,
  `es_libbooksid` varchar(255) NOT NULL,
  `es_libbookbwid` varchar(255) NOT NULL,
  `es_libbookfine` varchar(255) NOT NULL,
  `es_libbookdate` varchar(255) NOT NULL,
  `es_type` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `es_issuetype` varchar(255) NOT NULL,
  `fine_paid` varchar(255) NOT NULL,
  `fine_deducted` varchar(255) NOT NULL,
  `paid_on` date NOT NULL,
  `remarks` text NOT NULL,
  `returnedon` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_libfine`
--

CREATE TABLE `es_libfine` (
  `es_libfineid` int(11) NOT NULL,
  `es_libfinenoofdays` varchar(255) NOT NULL,
  `es_libfineamount` varchar(255) NOT NULL,
  `es_libfineduration` varchar(255) NOT NULL,
  `es_libfinefor` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_loanmaster`
--

CREATE TABLE `es_loanmaster` (
  `es_loanmasterid` int(11) NOT NULL,
  `loan_post` varchar(255) NOT NULL,
  `loan_type` varchar(255) NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `loan_fromdate` date NOT NULL,
  `loan_todate` date NOT NULL,
  `loan_intrestrate` varchar(255) NOT NULL,
  `loan_maxlimit` varchar(255) NOT NULL,
  `loan_dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_loanpayment`
--

CREATE TABLE `es_loanpayment` (
  `es_loanpaymentid` int(11) NOT NULL,
  `es_issueloanid` int(11) NOT NULL,
  `inst_amount` float NOT NULL,
  `onmonth` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_marks`
--

CREATE TABLE `es_marks` (
  `es_marksid` int(11) NOT NULL,
  `es_examdetailsid` int(11) NOT NULL,
  `es_marksstudentid` int(11) NOT NULL,
  `es_marksobtined` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_mcq_questions`
--

CREATE TABLE `es_mcq_questions` (
  `question_id` int(11) NOT NULL,
  `testid` int(11) DEFAULT NULL COMMENT 'Reference of es_test table',
  `question` text,
  `option1` varchar(30) DEFAULT NULL,
  `option2` varchar(30) DEFAULT NULL,
  `option3` varchar(30) DEFAULT NULL,
  `option4` varchar(30) DEFAULT NULL,
  `answer` tinyint(4) DEFAULT NULL COMMENT 'Can be 1,2,3 or 4',
  `que_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_mcq_questions`
--

INSERT INTO `es_mcq_questions` (`question_id`, `testid`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `que_status`) VALUES
(1, 3, 'this is test questions', 'op1', 'op2', 'op3', 'op4', 3, 1),
(7, 3, 'This is yearly test question', 'option1', 'option2', 'option3', 'option4', 1, 1),
(8, 1, 'This is yearly test question 2018', 'aadfsfds', 'b', 'c', 'd', 1, 1),
(9, 3, 'Who is prime minister of India ? ', 'modi', 'nehru', 'vajpeyi', 'kalam', 1, 1),
(10, 3, 'Who is lady in a history has 5 husbands ?', 'Yashoda', 'Rukmani', 'Draupadi', 'Kunti', 3, 1),
(13, 4, 'Who is father of  bhishma  ?', 'shantanu', 'Dron', 'Raghu', 'Ram', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `es_mcq_result`
--

CREATE TABLE `es_mcq_result` (
  `result_id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL COMMENT 'Reference of test table',
  `student_id` int(11) DEFAULT NULL COMMENT 'Reference student table or admission table',
  `que_id` int(11) DEFAULT NULL COMMENT 'Reference of question table',
  `answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_mcq_result`
--

INSERT INTO `es_mcq_result` (`result_id`, `test_id`, `student_id`, `que_id`, `answer`) VALUES
(1, 3, 68, 1, 0),
(2, 3, 68, 7, 0),
(3, 3, 68, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `es_mcq_test`
--

CREATE TABLE `es_mcq_test` (
  `test_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL COMMENT 'Reference of class table',
  `subject_id` int(11) DEFAULT NULL,
  `test_name` varchar(55) DEFAULT NULL,
  `no_of_question` int(3) DEFAULT NULL,
  `negative_marking` tinyint(3) NOT NULL DEFAULT '0',
  `weightage` tinyint(4) DEFAULT NULL,
  `from_date` timestamp NULL DEFAULT NULL,
  `to_date` timestamp NULL DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_mcq_test`
--

INSERT INTO `es_mcq_test` (`test_id`, `class_id`, `subject_id`, `test_name`, `no_of_question`, `negative_marking`, `weightage`, `from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'monthly', 10, 25, 2, '2018-06-29 18:30:00', '2018-06-29 18:30:00', 10, '05:30:00', '05:30:00', NULL, NULL, 1, '0000-00-00 00:00:00', '2018-07-14 06:30:47', NULL),
(2, 2, 2, 'yearly', 10, 0, NULL, '2018-06-29 18:30:00', '2018-06-29 18:30:00', 10, '00:20:18', '00:20:18', NULL, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 2, 6, 'Prely test', 10, 25, 4, '2018-07-12 18:30:00', '2018-07-18 18:30:00', 30, '05:30:00', '05:30:00', NULL, NULL, 1, '2018-07-01 07:24:09', '2018-07-14 06:33:04', NULL),
(4, 1, 1, 'Quarterly', 10, 0, NULL, '2018-07-12 18:30:00', '2018-07-19 18:30:00', 30, '12:55:00', '01:30:00', NULL, NULL, 1, '2018-07-12 07:07:16', '2018-07-12 07:07:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `es_messages`
--

CREATE TABLE `es_messages` (
  `es_messagesid` bigint(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `from_type` varchar(255) NOT NULL,
  `to_id` int(11) NOT NULL,
  `to_type` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` longtext NOT NULL,
  `created_on` datetime NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `from_status` enum('active','inactive','deleted') NOT NULL,
  `to_status` enum('active','inactive','deleted') NOT NULL,
  `replay_status` enum('notreplied','replied') NOT NULL DEFAULT 'notreplied'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_message_documents`
--

CREATE TABLE `es_message_documents` (
  `doc_id` bigint(20) NOT NULL,
  `es_messagesid` bigint(20) NOT NULL,
  `message_doc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_modules_alloted`
--

CREATE TABLE `es_modules_alloted` (
  `id` int(11) NOT NULL,
  `max_no_courses` varchar(255) NOT NULL,
  `max_no_students` varchar(255) NOT NULL,
  `modules_permissions` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_modules_alloted`
--

INSERT INTO `es_modules_alloted` (`id`, `max_no_courses`, `max_no_students`, `modules_permissions`, `created_on`) VALUES
(1, '1000', '9000000', '1_p,2_p,3_p,4_p,5_p,6_p,7_p,8_p,9_p,10_p,11_p,12_p,13_p,14_p,15_p,16_p,17_p,18_p,19_p,20_p,21_p,22_p,23_p,24_p,25_p,26_p,27_p,28_p,29_p,30_p,31_p,32_p,33_p,34_p,35_p', '2010-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `es_new_timetable`
--

CREATE TABLE `es_new_timetable` (
  `new_time_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_notice`
--

CREATE TABLE `es_notice` (
  `es_noticeid` int(11) NOT NULL,
  `es_title` varchar(255) NOT NULL,
  `es_message` longtext NOT NULL,
  `es_date` date NOT NULL,
  `es_subject` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_notice_messages`
--

CREATE TABLE `es_notice_messages` (
  `es_messagesid` int(11) NOT NULL,
  `notice_date` date NOT NULL,
  `from_id` int(11) NOT NULL,
  `from_type` enum('admin','staff') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `to_id` int(11) NOT NULL,
  `to_type` varchar(255) NOT NULL,
  `academic_year_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject` text NOT NULL,
  `message` longtext NOT NULL,
  `created_on` datetime NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `from_status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `to_status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `replay_status` enum('notreplied','replied') NOT NULL DEFAULT 'notreplied',
  `replied_message_id` bigint(20) NOT NULL,
  `read_status` enum('Unread','Read') NOT NULL DEFAULT 'Unread'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_notice_messages`
--

INSERT INTO `es_notice_messages` (`es_messagesid`, `notice_date`, `from_id`, `from_type`, `to_id`, `to_type`, `academic_year_id`, `class_id`, `subject`, `message`, `created_on`, `status`, `from_status`, `to_status`, `replay_status`, `replied_message_id`, `read_status`) VALUES
(1, '2018-04-01', 1, 'admin', 1, 'student', 1, 2, 'HELLO WORLD', 'HELLO WORLD', '2018-04-14 07:27:59', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(2, '2018-04-14', 1, 'admin', 1, 'staff', NULL, NULL, 'HELLO WORLD', 'HELLO WORLD', '2018-04-14 07:30:08', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(3, '2018-04-01', 1, 'admin', 1, 'student', 1, 2, 'HELLO WORLD', 'hello world', '2018-04-14 07:48:17', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(4, '2018-04-14', 1, 'admin', 1, 'student', 1, 2, 'asd', 'asddsaf', '2018-04-14 07:48:22', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(5, '2018-05-09', 1, 'admin', 8, 'student', 1, 3, 'Holiday', 'Tomorrow is Holiday.', '2018-05-09 03:23:55', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(6, '2018-05-09', 1, 'admin', 8, 'student', 1, 3, 'Holiday', 'Tomorrow is Holiday.', '2018-05-09 03:33:51', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(7, '2018-06-04', 3, 'staff', 37, 'student', 1, 5, 'English', 'Work incomplete', '2018-06-04 10:06:19', 'active', 'active', 'active', 'notreplied', 0, 'Unread'),
(8, '2018-06-04', 3, 'staff', 14, 'student', 1, 3, 'English', 'Homework always not complete.', '2018-06-04 10:39:45', 'active', 'active', 'active', 'notreplied', 0, 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `es_offerletter`
--

CREATE TABLE `es_offerletter` (
  `es_offerletterid` int(11) NOT NULL,
  `ofr_message` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_old_balances`
--

CREATE TABLE `es_old_balances` (
  `ob_id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `old_balance` varchar(255) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `wived_amount` varchar(255) NOT NULL,
  `last_paid_dt` date NOT NULL,
  `balance` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_old_balances_paid`
--

CREATE TABLE `es_old_balances_paid` (
  `obp_id` int(11) NOT NULL,
  `ob_id` int(11) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `waived_amount` varchar(255) NOT NULL,
  `paid_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_otherletter_formats`
--

CREATE TABLE `es_otherletter_formats` (
  `letter_id` int(11) NOT NULL,
  `letter_title` text NOT NULL,
  `letter_desc` longtext NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_other_fine_dettails`
--

CREATE TABLE `es_other_fine_dettails` (
  `otherfine_id` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `fine_name` varchar(255) NOT NULL,
  `fine_amount` double NOT NULL,
  `created_on` date NOT NULL,
  `paid_amount` double NOT NULL,
  `deduction_allowed` double NOT NULL,
  `paid_on` date NOT NULL,
  `balance` double NOT NULL,
  `remarks` text NOT NULL,
  `voucherid` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_payslipdetails`
--

CREATE TABLE `es_payslipdetails` (
  `es_payslipdetailsid` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `pay_month` date NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `tot_allowance` int(11) NOT NULL,
  `tot_deductions` int(11) NOT NULL,
  `net_salary` int(11) NOT NULL,
  `balance` varchar(255) CHARACTER SET latin1 NOT NULL,
  `leavedays` varchar(255) CHARACTER SET latin1 NOT NULL,
  `totalleave` varchar(255) CHARACTER SET latin1 NOT NULL,
  `voucherid` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `es_pfmaster`
--

CREATE TABLE `es_pfmaster` (
  `es_pfmasterid` int(11) NOT NULL,
  `pf_post` varchar(255) NOT NULL,
  `pf_empcont` float NOT NULL,
  `pf_empconttype` varchar(255) NOT NULL,
  `pf_empycont` float NOT NULL,
  `pf_empyconttype` varchar(255) NOT NULL,
  `pf_dept` varchar(255) NOT NULL,
  `pf_from_date` date NOT NULL,
  `pf_to_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_photogallery`
--

CREATE TABLE `es_photogallery` (
  `id` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_preadmission`
--

CREATE TABLE `es_preadmission` (
  `es_preadmissionid` int(11) NOT NULL,
  `pre_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `middle_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_lastname` varchar(230) CHARACTER SET latin1 NOT NULL,
  `pre_student_username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_student_password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_dateofbirth` date NOT NULL,
  `pre_fathername` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_mothername` varchar(255) CHARACTER SET latin1 NOT NULL,
  `grno` varchar(100) CHARACTER SET latin1 NOT NULL,
  `pre_image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_emailid` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_religion` varchar(255) NOT NULL,
  `pre_nationality` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `pre_gender` enum('male','female') CHARACTER SET latin1 NOT NULL,
  `caste` varchar(256) NOT NULL,
  `pre_mother_tounge` varchar(255) NOT NULL,
  `pre_blood_group` varchar(255) CHARACTER SET latin1 NOT NULL,
  `admission_form_no` varchar(100) CHARACTER SET latin1 NOT NULL,
  `admission_date` date NOT NULL,
  `pre_placeofbirth` varchar(230) CHARACTER SET latin1 NOT NULL,
  `pre_cur_address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_cur_area` varchar(255) NOT NULL,
  `pre_cur_city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pre_cur_state` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_cur_pincode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pre_per_address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_per_area` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pre_per_city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pre_per_state` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pre_per_pincode` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_aadhar_no` varchar(128) NOT NULL,
  `pre_uid_no` varchar(128) NOT NULL,
  `pre_status` enum('inactive','active','transferred','defaulter') CHARACTER SET latin1 NOT NULL DEFAULT 'active',
  `pre_mobile_no` varchar(16) NOT NULL,
  `pre_sms_no` varchar(16) NOT NULL,
  `whatsapp_number` varchar(16) NOT NULL,
  `pre_telephone` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `es_preadmission`
--

INSERT INTO `es_preadmission` (`es_preadmissionid`, `pre_name`, `middle_name`, `pre_lastname`, `pre_student_username`, `pre_student_password`, `pre_dateofbirth`, `pre_fathername`, `pre_mothername`, `grno`, `pre_image`, `pre_emailid`, `pre_religion`, `pre_nationality`, `category_id`, `pre_gender`, `caste`, `pre_mother_tounge`, `pre_blood_group`, `admission_form_no`, `admission_date`, `pre_placeofbirth`, `pre_cur_address`, `pre_cur_area`, `pre_cur_city`, `pre_cur_state`, `pre_cur_pincode`, `pre_per_address`, `pre_per_area`, `pre_per_city`, `pre_per_state`, `pre_per_pincode`, `pre_aadhar_no`, `pre_uid_no`, `pre_status`, `pre_mobile_no`, `pre_sms_no`, `whatsapp_number`, `pre_telephone`) VALUES
(1, 'Samiya', 'Mustak', 'Sameja', 'sanskar1', '9913621075', '2014-09-03', 'Mustak', 'Sehnaz', '', '', '', '', '', '', 'female', '', 'Gujarati', '', '', '2017-06-17', 'Mandvi', 'Sukhpur Mundra', '', '', '', '', 'Sukhpur Mundra', '', '', '', '', '', '', 'active', '9913621075', '', '', ''),
(2, 'Ashaz', 'Mohib', 'Khatri', 'sanskar2', '9909515304', '2013-11-11', 'Mohib', 'Humera M Khatri', '', '', '', 'Muslim', '', '', 'male', '', 'Gujarati', '', '', '0000-00-00', 'Mundra', '15, new shivparas, baroi raod, Mundra', '', '', '', '', '15, new shivparas, baroi raod, Mundra', '', '', '', '', '', '', 'active', '9909515304', '', '', ''),
(3, 'Harshai', 'Shankar', 'Maheshwari', 'sanskar3', '9925971959', '2013-10-28', 'Shankar', 'Nayna', '', '', '', 'Hindu', '', '', 'male', '', '', '', '', '2017-06-14', 'Mundra', 'Viil. Mangra Tal. Mundra Kutch ', '', '', '', '', 'Viil. Mangra Tal. Mundra Kutch ', '', '', '', '', '', '', 'active', '9925971959', '', '', ''),
(4, 'Naiti', 'Piyush Kumar', 'Senghan', 'sanskar4', '9913114360', '2013-12-03', 'Piyush Kumar', 'Rina Ben', '', '', '', '', '', '', 'female', '', '', '', '', '2017-06-06', 'Mundra', 'Baroi Road, Mundra', '', '', '', '', 'Baroi Road, Mundra', '', '', '', '', '', '', 'active', '9913114360', '', '', ''),
(5, 'Hensi', 'Nileshbhai', 'Kanzariya', 'sanskar5', '9712417919', '2014-09-19', 'Nileshbhai', 'Manisha', '', '', '', 'Hindu', '', '', 'female', '', 'Gujarati', '', '', '2017-05-27', 'Rajkot', 'ho.No 66/A, Mangalam Park, Near Saraswati Vidhya Mandir, baroi Road, Mundra', '', '', '', '', 'ho.No 66/A, Mangalam Park, Near Saraswati Vidhya Mandir, baroi Road, Mundra', '', '', '', '', '', '', 'active', '9712417919', '', '', ''),
(6, 'Aaysha', 'Hamid Hussain', 'Turk', 'sanskar6', '9913113757', '2014-02-09', 'Hamid Hussain', 'Rijvana', '', '', '', 'Muslim', '', '', 'female', '', 'Gujarati', '', '', '0000-00-00', 'Mundra', 'Sukhpur Vas, Mundra', '', '', '', '', 'Sukhpur Vas, Mundra', '', '', '', '', '', '', 'active', '9913113757', '', '', ''),
(7, 'Ansh', 'Jaiswal', 'Chandan', 'sanskar7', '9067003660', '2014-01-01', 'Jaiswal', 'Pooja Jaiswal', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Hindi', '', '', '0000-00-00', 'Alawalpur', 'Plot No 99B Surya vNagar Baroi Road Mundra Kutch', '', '', '', '', 'Plot No 99B Surya vNagar Baroi Road Mundra Kutch', '', '', '', '', '', '', 'active', '9067003660', '', '', ''),
(8, 'Jyoti', 'Prakash', 'Chandhari', 'sanskar8', '9377419203', '2013-03-08', 'Prakash', 'Ashaben Prakash Chaudhri', '', '', '', 'Hindu', 'Indian', '', 'female', '', 'Gujarati', '', '', '2017-10-12', 'Mundra', '3, Panchvati Society, b/h Sanskar nagar Baroi Road Mundra', '', '', '', '', '3, Panchvati Society, b/h Sanskar nagar Baroi Road Mundra', '', '', '', '', '', '', 'active', '9377419203', '', '', ''),
(9, 'Vishvarajshih', 'Ajitsinh', 'Mokha', 'sanskar9', '8469590041', '2014-08-19', 'Ajitsinh', 'Shobhanaba', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Gujarati', '', '', '0000-00-00', 'Nakhatrana', 'S/O Mokha Shobhnaba ni wadi visistor baroi Kutch ', '', '', '', '', 'S/O Mokha Shobhnaba ni wadi visistor baroi Kutch ', '', '', '', '', '', '', 'active', '8469590041', '', '', ''),
(10, 'Prince', 'Jalandhar ', 'Varma', 'sanskar10', '7405715167', '2013-02-07', 'Jalandhar ', 'Nilam', '', '', '', 'Hindu', 'Indian', '', 'male', '', '', '', '', '2017-07-17', 'Madhachha', 'Baroi Road Surya Nagar Mundra', '', '', '', '', 'Baroi Road Surya Nagar Mundra', '', '', '', '', '', '', 'active', '7405715167', '', '', ''),
(11, 'Chetanya', 'Vijay Lal', 'Kumar', 'sanskar11', '8141216187', '2013-10-19', 'Vijay Lal', 'Kavitha Devi', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Hindi', '', '', '0000-00-00', 'Nadiad', '86, Shivtownship Gandhidham Road Mundra', '', '', '', '', '86, Shivtownship Gandhidham Road Mundra', '', '', '', '', '', '', 'active', '8141216187', '', '', ''),
(12, 'Savan', 'BijmalBhai', 'Maheshwari', 'sanskar12', '9879934850', '2012-09-28', 'BijmalBhai', 'Lilbai', '', '', '', 'Hindu', 'Indian', '', 'male', '', '', '', '', '2017-06-13', 'Mundra', 'Rajput vas Patri Kutch Mundra', '', '', '', '', 'Rajput vas Patri Kutch Mundra', '', '', '', '', '', '', 'active', '9879934850', '', '', ''),
(13, 'Rahemat', 'Aabid Hussain', 'Padhiyar', 'sanskar13', '9909220062', '2013-03-13', 'Aabid Hussain', 'Razia Banu', '', '', '', 'Muslim', 'Indian', '', 'female', '', 'Kutchi', '', '', '0000-00-00', 'Mandvi', 'Patri', '', '', '', '', 'Patri', '', '', '', '', '', '', 'active', '9909220062', '', '', ''),
(14, 'Navya', 'Dilipbhai', 'Kanan', 'sanskar14', '9825539833', '2012-09-21', 'Dilipbhai', 'Mina Ben', '', '', '', 'Hindu', 'Indian', '', 'female', '', 'Gujarati', '', '', '2017-06-16', 'Mundra', 'Momai Ghar Plot 12 baroi Road Maruti Nagar', '', '', '', '', 'Momai Ghar Plot 12 baroi Road Maruti Nagar', '', '', '', '', '', '', 'active', '9825539833', '', '', ''),
(15, 'manyata', 'Ramkishor', 'Bhati', 'sanskar15', '9913304200', '2013-10-02', 'Ramkishor', 'Mamta', '', '', '', 'Hindu', 'Indian', '', 'female', '', 'Hindi', '', '', '2017-06-12', 'Bhopalgarh', 'Sanskar Nagar Mundra Kutch', '', '', '', '', 'Sanskar Nagar Mundra Kutch', '', '', '', '', '', '', 'active', '9913304200', '', '', ''),
(16, 'Poojan', 'Shatis', 'Bhinde', 'sanskar16', '9537596108', '0000-00-00', 'Shatis', 'Shruti', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Kutchi', '', '', '2017-04-07', 'Mundra', 'Ambhika Nagar Plot No 187', '', '', '', '', 'Ambhika Nagar Plot No 187', '', '', '', '', '', '', 'active', '9537596108', '', '', ''),
(17, 'Ekamjot', 'PrabhjotSingh', 'Khalsa', 'sanskar17', '9722058263', '2013-01-13', 'PrabhjotSingh', 'Sadhana Kaur Khalsa', '', '', '', 'Sikh', 'Indian', '', 'male', '', 'Punjabi', '', '', '2017-05-29', 'Mundra', 'Plot 67,68,69 Behind Gurudwara Saheb Kalyan Nagar Mundra Gundala Road Gundala', '', '', '', '', 'Plot 67,68,69 Behind Gurudwara Saheb Kalyan Nagar Mundra Gundala Road Gundala', '', '', '', '', '', '', 'active', '9722058263', '', '', ''),
(18, 'Prarthna', 'Akshay Kumar', 'Jethi', 'sanskar18', '9978989333', '2013-05-21', 'Akshay Kumar', 'Meera Ben', '', '', '', '', 'Indian', '', 'female', '', '', '', '', '2017-02-17', 'Bhuj', 'Plot No 107/109 House No C Panchvati Society Baroi Mundra Kutch', '', '', '', '', 'Plot No 107/109 House No C Panchvati Society Baroi Mundra Kutch', '', '', '', '', '', '', 'active', '9978989333', '', '', ''),
(19, 'Kavita', 'Moolaram', 'Dewasi', 'sanskar19', '9099510132', '2012-07-18', 'Moolaram', 'Sena Devi', '', '', '', '', 'Indian', '', 'female', '', 'Marwadi', '', '', '2017-06-16', 'Sojat', 'Plot 82 Sitaram Park Baroi Road Mundra', '', '', '', '', 'Plot 82 Sitaram Park Baroi Road Mundra', '', '', '', '', '', '', 'active', '9099510132', '', '', ''),
(20, 'Hasenali', 'Abdul', 'Khan', 'sanskar20', '7802875892', '2011-12-03', 'Abdul', 'Zareena', '', '', '', '', 'Indian', '', 'male', '', 'Hindi', '', '', '0000-00-00', 'Mundra', 'Muslim Vas baroi Mundra Kutch', '', '', '', '', 'Muslim Vas baroi Mundra Kutch', '', '', '', '', '', '', 'active', '7802875892', '', '', ''),
(21, 'Ekra', 'Mohd Ansar', 'Khan', 'sanskar21', '8866157820', '2012-03-03', 'Mohd Ansar', 'Shabnam', '', '', '', '', 'Indian', '', 'female', '', 'Hindi', '', '', '2017-06-21', 'Phulpur', 'Sanskar Nagar Room-98 Baroi Road Mundra', '', '', '', '', 'Sanskar Nagar Room-98 Baroi Road Mundra', '', '', '', '', '', '', 'active', '8866157820', '', '', ''),
(22, 'Abhisekh', 'Prakash', 'Sharma', 'sanskar22', '9904713875', '2012-09-13', 'Prakash', 'Manju Sharma', '', '', '', '', 'Indian', '', 'male', '', '', '', '', '2017-07-04', 'Kishanagarh', 'p No 104-113 H.No 58 Sanskar Nagar Baroi Road Mundra Kutch', '', '', '', '', 'p No 104-113 H.No 58 Sanskar Nagar Baroi Road Mundra Kutch', '', '', '', '', '', '', 'active', '9904713875', '', '', ''),
(23, 'Dhruv', 'Rameshbhai', 'Solanki', 'sanskar23', '9913292737', '2011-11-27', 'Rameshbhai', 'Laxaben', '', '', '', '', 'Indian', '', 'male', '', '', '', '', '2017-06-09', 'Buja', 'Mota Kapaya Mundra', '', '', '', '', 'Mota Kapaya Mundra', '', '', '', '', '', '', 'active', '9913292737', '', '', ''),
(24, 'Nitesh', 'Ram Kishor', 'Bhati', 'sanskar24', '9913304200', '2011-12-23', 'Ram Kishor', 'Mamta', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Hindi', '', '', '2017-06-12', 'Bhopalgarh', 'Sanskar Nagar Mundra Tal. Mundra Kutch ', '', '', '', '', 'Sanskar Nagar Mundra Tal. Mundra Kutch ', '', '', '', '', '', '', 'active', '9913304200', '', '', ''),
(25, 'Rishu', 'Ramsamujh', 'Singh', 'sanskar25', '9510680410', '2013-06-01', 'Ramsamujh', 'Saroj Singh', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Hindi', '', '', '2017-06-08', 'Uttar Pradesh', 'Vaidhei Nagare Baroi Road Mundra', '', '', '', '', 'Vaidhei Nagare Baroi Road Mundra', '', '', '', '', '', '', 'active', '9510680410', '', '', ''),
(26, 'Ram', 'Govind', 'Gadhvi', 'sanskar26', '9727812598', '2012-11-28', 'Govind', 'Laxiben', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Kutchi', '', '', '2017-06-07', 'Mundra', 'Shekhadiya Sadua Kutch Mundra', '', '', '', '', 'Shekhadiya Sadua Kutch Mundra', '', '', '', '', '', '', 'active', '9727812598', '', '', ''),
(27, 'Poojan', 'Mehulbhai', 'Patel', 'sanskar27', '9924669766', '2012-11-12', 'Mehulbhai', 'Jignasha ben', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Gujarati', '', '', '2017-06-02', 'Mehsana', '2, Khetar Par nagar, Behind St.xaviers School, Baroi Road Mundra', '', '', '', '', '2, Khetar Par nagar, Behind St.xaviers School, Baroi Road Mundra', '', '', '', '', '', '', 'active', '9924669766', '', '', ''),
(28, 'Tabrez', 'Imran', 'Ansari', 'sanskar28', '9978866592', '2013-01-24', 'Imran', 'LailaKhatun', '', '', '', 'Muslim', 'Indian', '', 'male', '', 'Hindi', '', '', '2017-06-02', 'Mundra', 'Masjid Faliya Baroi Mundra', '', '', '', '', 'Masjid Faliya Baroi Mundra', '', '', '', '', '', '', 'active', '9978866592', '', '', ''),
(29, 'Akshat', 'Bhuwan Chandra', 'Pandey', 'sanskar29', '9925043799', '2012-06-24', 'Bhuwan Chandra', 'Neema Pandey', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Hindi', '', '', '2017-05-27', 'Banbassa', 'Mahavir Colony, Baroi s-5 Swastik-2 Mundra', '', '', '', '', 'Mahavir Colony, Baroi s-5 Swastik-2 Mundra', '', '', '', '', '', '', 'active', '9925043799', '', '', ''),
(30, 'Hishalsinh', 'Karansinh', 'Parmar', 'sanskar30', '9909008958', '2012-09-13', 'Karansinh', 'Khushbu K Parmar', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Gujarati', '', '', '2017-05-06', 'Bardoli', '2, plot no 37/B, Mahaveer Nagar-3, opp. Axis bank, Baroi Road Mundra ', '', '', '', '', '2, plot no 37/B, Mahaveer Nagar-3, opp. Axis bank, Baroi Road Mundra ', '', '', '', '', '', '', 'active', '9909008958', '', '', ''),
(31, 'Fatima', 'Rajabali', 'Khalifa', 'sanskar31', '9978217557', '2012-12-01', 'Rajabali', 'Shirin banu', '', '', '', 'Muslim', 'Indian', '', 'female', '', 'Kutchi', '', '', '2017-04-19', 'Bhuj', 'Green Park, Near Vagher Masjid Baroi Mundra', '', '', '', '', 'Green Park, Near Vagher Masjid Baroi Mundra', '', '', '', '', '', '', 'active', '9978217557', '', '', ''),
(32, 'Jasleen', 'Kuldeep', 'Singh', 'sanskar32', '9463294401', '2012-11-18', 'Kuldeep', 'Gurdeep Kaur', '', '', '', '', 'Indian', '', 'female', '', '', '', '', '0000-00-00', 'Galherian', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9463294401', '', '', ''),
(33, 'Mohammad farukh', 'Mamad', 'Kakal', 'sanskar33', '7874150239', '2013-04-08', 'Mamad', 'Farida', '', '', '', '', 'Indian', '', 'male', '', 'Gujarati', '', '', '0000-00-00', 'Anjar', 'Nava Vas, baroi Mundra', '', '', '', '', 'Nava Vas, baroi Mundra', '', '', '', '', '', '', 'active', '7874150239', '', '', ''),
(34, 'Jeet Kumar', 'Balubhai', 'Tarkhala', 'sanskar34', '8264505582', '2012-08-02', 'Balubhai', 'Bhavna Ben', '', '', '', 'Hindu', 'Indian', '', 'male', '', '', '', '', '2017-03-11', 'Mahiyari', 'Opp. Shital Hotel, Mahvir Nagar Room No 62 Baroi Road Mundra', '', '', '', '', 'Opp. Shital Hotel, Mahvir Nagar Room No 62 Baroi Road Mundra', '', '', '', '', '', '', 'active', '8264505582', '', '', ''),
(35, 'Ridham', 'Rakesh Masul Bhai', 'Kisore', 'sanskar35', '', '2011-01-25', 'Rakesh Masul Bhai', 'naina', '', '', '', 'Hindu', 'Indian', '', 'male', '', 'Gujarati', '', '', '2017-04-07', 'Dahod', 'Savla Apartment Baroi Road Mundra Kutch', '', '', '', '', 'Savla Apartment Baroi Road Mundra Kutch', '', '', '', '', '', '', 'active', '', '', '', ''),
(36, 'Aryan', 'Ravjibhai', 'Chuiya', 'sanskar36', '9537965552', '2011-12-07', 'Ravjibhai', 'Dhanbai Ravji', '', '', '', '', 'Indian', '', 'male', '', 'Gujarati', '', '', '0000-00-00', 'Mundra', 'Maheshvari Vass, Khari Mitti Road, Baroi Road,near old masjid Mundra Kutch', '', '', '', '', 'Maheshvari Vass, Khari Mitti Road, Baroi Road,near old masjid Mundra Kutch', '', '', '', '', '', '', 'active', '9537965552', '', '', ''),
(37, 'Mansi', 'Yogeshbhai', 'Baldadiya', 'mansibaldaniya', '9687639217', '2014-02-16', 'Yogeshbhai  Vishram Baldadiya', 'Gitaben Yogeshbhai Baldadiya', '', '', '', 'Hindu', 'Indian', '1', 'male', '', 'Kutchhi', 'A+', '37', '2017-02-27', 'Anjar', 'Plot No. 6,7,8 Khetarpal Nagar,Opp.Kala purna Ashish, Mundra.', '', '', '', '', 'Plot No. 6,7,8 Khetarpal Nagar,Opp.Kala purna Ashish, Mundra.', '', '', '', '', '', '', 'active', '9687639217', '', '9909956683', ''),
(38, 'Anish', 'Haroonbhai', 'Kumbhar', 'sanskar38', '9067007300', '2013-12-04', 'Haroonbhai Adam Kumbhar', 'Hajrabai Haroonbhai Kumbhar', '', '', '', 'Muslim', 'Indian', '', '', '', 'Kutchhi', '', '', '2017-02-21', 'Mundra', 'Gurjar Vas, Nr. Taluka Panchayat, Baroi road, Mundra.', '', '', '', '', 'Gurjar Vas, Nr. Taluka Panchayat, Baroi road, Mundra.', '', '', '', '', '', '', 'active', '9067007300', '', '7575897766', ''),
(39, 'Saurya', 'Arjanbhai', 'Maheshwari', 'sanskar39', '9909885968', '2013-10-16', 'Arjanbhai Jakhubhai Maheshwari', 'Damyantiben Arjanbhai Maheshwari', '', '', '', 'son', 'Indian', '', '', '', 'bhilu', '', '', '2017-01-25', 'Mundra', 'B.64/65, Shilpvatika, Nr. Sanskarnagar, Baroi Road, Mundra.', '', '', '', '', 'B.64/65, Shilpvatika, Nr. Sanskarnagar, Baroi Road, Mundra.', '', '', '', '', '', '', 'active', '9909885968', '', '9726687940', ''),
(40, 'Rajviba', 'Gajendrasinh', 'Jadeja ', 'sanskar40', '9978583477', '2014-05-13', 'Gajendrasinh Vijaysinh Jadeja', 'Minaba Gajendrasinh Jadeja', '', '', '', '', 'Indian', '', '', '', 'Gujarati', '', '', '2017-03-14', 'Mundra', 'Plot No. 107-109/4, Panchvati Society, Baroi , Mundra.', '', '', '', '', 'Plot No. 107-109/4, Panchvati Society, Baroi , Mundra.', '', '', '', '', '', '', 'active', '9978583477', '', '9726624205', ''),
(41, 'Mo. Farid', 'Aasif', 'Khalifa', 'sanskar41', '9727328036', '2013-01-09', 'Aasif Anvar Khalifa', 'Aishabai Aasif Khalifa', '', '', '', 'Muslim', 'Indian', '', '', '', 'Kutchhi', '', '', '2017-05-30', 'Baroi', 'Mafat Nagar, Musalman Vas, Luni road, Baroi, Mundra.', '', '', '', '', 'Mafat Nagar, Musalman Vas, Luni road, Baroi, Mundra.', '', '', '', '', '', '', 'active', '9727328036', '', '9726110478', ''),
(42, 'Tanviben', 'Maheshkumar', 'Pandor', 'sanskar42', '8141545760', '2014-02-08', 'Maheshkumar Somabhai Pandor', 'Urmilaben Maheshkumar Pandor', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'Vaniyavada', 'Opp. Dariyalal Shop, Baroi, Mundra.', '', '', '', '', 'Opp. Dariyalal Shop, Baroi, Mundra.', '', '', '', '', '', '', 'active', '8141545760', '', '8741741056', ''),
(43, 'Hardik', 'Maheshbhai', 'Maheshwari', 'sanskar43', '8758776790', '2014-01-16', 'Maheshbhai shivribhai Maheshwari', 'Hiruben Maheshbhai Maheshwari', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-04-15', 'Bhuj', 'Mangra sadau kachchh', '', '', '', '', 'Mangra sadau kachchh', '', '', '', '', '', '', 'active', '8758776790', '', '9726110879', ''),
(44, 'Naitik', 'Krunal', 'Mehta', 'sanskar44', '8141643931', '2013-07-20', 'Krunal Natavarlal Mehta', 'kinjal krunal Mehta', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-04-10', 'Bhuj', 'Vabhnagar statebank opp baroi Mundra', '', '', '', '', 'Vabhnagar statebank opp baroi Mundra', '', '', '', '', '', '', 'active', '8141643931', '', '8980343131', ''),
(45, 'sumiya', 'Mosin', 'Bhajir', 'sanskar45', '8264858584', '2013-01-25', 'Mosin Iliyas Bhajir', 'Ruksana Mosin Bhajir', '', '', '', 'Muslim', 'Indian', '', '', '', 'Gujarati', '', '', '2017-04-15', 'Baroi', 'Farm area,Gayarsama road,Baroi Mundra', '', '', '', '', 'Farm area,Gayarsama road,Baroi Mundra', '', '', '', '', '', '', 'active', '8264858584', '', '9662855727', ''),
(46, 'Krisha', 'Dinesh', 'Khatri', 'sanskar46', '9978765660', '2014-05-03', 'Dinesh shantilal khatri', 'Nayanaben Dinesh khatri', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-04-26', 'Mundra', 'Vaidhei nagar baroi road Mundra', '', '', '', '', 'Vaidhei nagar baroi road Mundra', '', '', '', '', '', '', 'active', '9978765660', '', '8758975722', ''),
(47, 'prisha', 'Ankitbhai', 'Heniya', 'sanskar47', '9979185646', '2013-04-23', 'Ankitbhai Nemjibhai Heniya', 'Deepali Ankitbhai Heniya', '', '', '', 'Hindu', 'Indian', '', '', '', 'Kutchhi', '', '', '2017-03-24', 'Mundra', 'Patel faliya jain derasar baroi Mundra', '', '', '', '', 'Patel faliya jain derasar baroi Mundra', '', '', '', '', '', '', 'active', '9979185646', '', '9913620932', ''),
(48, 'Tirthkumar', 'Dasharathbhai', 'Sabhani', 'sanskar48', '9979001518', '2013-09-09', 'Dasharathbhai Mahadevbhai sabhani', 'Hetalben Dashrathbhai sabhani', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-03-07', 'Surendra nagar', 'P.N.84/85B Mahavirnagar sisymandir baroi road mundra', '', '', '', '', 'P.N.84/85B Mahavirnagar sisymandir baroi road mundra', '', '', '', '', '', '', 'active', '9979001518', '', '9099081584', ''),
(49, 'krishav', 'Bharat', 'Kandoriya', 'sanskar49', '9712497455', '2013-06-11', 'Bharat Jethabhai Kandoriya', 'kuvarben jethbhai kandoriya', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-02-23', 'Jam-khambhadiya', 'Ship vatical socatiay p.n.55/59 b.g baroi road mundra', '', '', '', '', 'Ship vatical socatiay p.n.55/59 b.g baroi road mundra', '', '', '', '', '', '', 'active', '9712497455', '', '7874572072', ''),
(50, 'Nakshkumar', 'bharat', 'Joshi', 'sanskar50', '9978979905', '2014-03-22', 'bharat Jayrambhai joshi ', 'sarsvatiben bharat joshi', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-03-17', 'sihori', '107,109 Panchavati society baroi road mundra', '', '', '', '', '107,109 Panchavati society baroi road mundra', '', '', '', '', '', '', 'active', '9978979905', '', '7874572072', ''),
(51, 'Tathya', 'vipulbhai', 'Patel', 'sanskar51', '94263509350', '2014-04-16', 'vipulbhai ganpatbhai patel', 'Dimpalben vipulbhai patel', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-03-01', 'Visnagar', '79/C silp vatika society baroi road,mundra', '', '', '', '', '79/C silp vatika society baroi road,mundra', '', '', '', '', '', '', 'active', '94263509350', '', '8511358487', ''),
(52, 'Nenshiben', 'kalmeshbhai', 'Shah', 'sanskar52', '9712775603', '2013-10-09', 'kalmeshbhai parivn shah', 'Hiralben kalmeshbhai shah', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'Surendra nagar', 'Devnada st.xaviers road baroi road mundra', '', '', '', '', 'Devnada st.xaviers road baroi road mundra', '', '', '', '', '', '', 'active', '9712775603', '', '9016312013', ''),
(53, 'Niva', 'jignesh', 'Tank', 'sanskar53', '9925153795', '2014-06-11', 'jignesh Nathalal Tank', 'Hetal Jignesh Tank', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-06-16', 'Amreli', 'Maruti nagar p.134,135,parmukh sadan nr.st xaviros school baroi road mundra', '', '', '', '', 'Maruti nagar p.134,135,parmukh sadan nr.st xaviros school baroi road mundra', '', '', '', '', '', '', 'active', '9925153795', '', '9428469668', ''),
(54, 'Khanak', 'vimal', 'Chhabhaiya', 'sanskar54', '8866238607', '2014-01-03', 'vimal kantilal chhabhaiya', 'Geetaben vimal chhabhaiya', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'Mundra', 'H.N.2,ilark homes prisha park mundra', '', '', '', '', 'H.N.2,ilark homes prisha park mundra', '', '', '', '', '', '', 'active', '8866238607', '', '9033959658', ''),
(55, 'Bhagirathsigh', 'navalsigh', 'vaghela', 'sanskar55', '8238813492', '2013-09-15', 'navalsigh popatsigh vaghela', 'Hastaba navalsigh vaghela', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-06-06', 'Nakhatrana', 'R.n10,keniya Apartment baroi road mundra', '', '', '', '', 'R.n10,keniya Apartment baroi road mundra', '', '', '', '', '', '', 'active', '8238813492', '', '8980665156', ''),
(56, 'Shahzaib', 'Mohamad', 'Shekh', 'sanskar56', '9913955175', '2014-06-13', 'Mohamad lmran rahim shekh', 'Alfanabanu mo.lmaran', '', '', '', 'Muslim', 'Indian', '', '', '', 'Gujarati', '', '', '2017-06-13', 'Bhuj', 'Goyar sama road Muslim vas baroi road mundra', '', '', '', '', 'Goyar sama road Muslim vas baroi road mundra', '', '', '', '', '', '', 'active', '9913955175', '', '9978023434', ''),
(57, 'Panth', 'Jatinbhai', 'Patel', 'sanskar57', '9712909715', '2014-05-11', 'Jatinbhai nathabhai patel', 'Jignaben jatinbhai patel ', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-06-08', 'patan', '78,80.B shilp vatika society near sanskar nagar mundra', '', '', '', '', '78,80.B shilp vatika society near sanskar nagar mundra', '', '', '', '', '', '', 'active', '9712909715', '', '9712909716', ''),
(58, 'Daksh', 'Ratan', 'Barot', 'sanskar58', '9638087604', '2014-05-23', 'Ratan harji  Barot', 'Ramila ratan barot', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-06-08', 'Mandvi', 'Shreeji nagar baroi road mundra', '', '', '', '', 'Shreeji nagar baroi road mundra', '', '', '', '', '', '', 'active', '9638087604', '', '9638087602', ''),
(59, 'Rahi', 'chiragkumar', 'Darji', 'sanskar59', '9408831654', '2013-06-19', 'chiragkumar kanubhai Darji', 'Manishben chiragkumar Darji', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'Kundel', 'p.n.60-63/3,shilp vatika baroi road mundra', '', '', '', '', 'p.n.60-63/3,shilp vatika baroi road mundra', '', '', '', '', '', '', 'active', '9408831654', '', '9427545219', ''),
(60, 'parvisha', 'Manishbhai', 'Dodiya', 'sanskar60', '9687678077', '2013-06-18', 'Manishbhai valabhai', 'Daksha manishbhai dodiya', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687678077', '', '9712938537', ''),
(61, 'varj', 'kirtibhai', 'piprotar', 'sanskar61', '9978217665', '2013-10-23', 'kirtibhai piprotar', '', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-11-07', 'Mundra', 'Mahivr nagar 3 ,baroi road mundra', '', '', '', '', 'Mahivr nagar 3 ,baroi road mundra', '', '', '', '', '', '', 'active', '9978217665', '', '9925623576', ''),
(62, 'srusty', 'chandubhai', 'Hadiyal', 'sanskar62', '9925683144', '2013-06-27', 'chandubhai madhabhai hadiyal', 'Ranjanben chandubhai hadiyal', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'porbandar', 'jay nagar near arti hospital mundra', '', '', '', '', 'jay nagar near arti hospital mundra', '', '', '', '', '', '', 'active', '9925683144', '', '9586284015', ''),
(63, 'vishva', 'vipulkumar', 'patel', 'sanskar63', '9925657310', '2012-02-29', 'vipulkumar prahladbhai', 'Hemlata vipulkumar patel', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-03-02', 'ahmedabad', 'Ship vatical socatiay baroi road mundra', '', '', '', '', 'Ship vatical socatiay baroi road mundra', '', '', '', '', '', '', 'active', '9925657310', '', '7600011798', ''),
(64, 'vishala', 'ramijebhai', 'sathvara', 'sanskar64', '9925811855', '2013-08-15', 'ramijebhai ', 'kantaben ', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'Mundra', 'baroi road mundra', '', '', '', '', 'baroi road mundra', '', '', '', '', '', '', 'active', '9925811855', '', '', ''),
(65, 'Rudrarajsinh', 'Gajendrasinh', 'Jadeja ', 'sanskar65', '9978583477', '2014-05-13', 'Gajendrasinh Vijaysinh Jadeja', 'Minaba Gajendrasinh Jadeja', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-03-14', 'Mundra', 'p.n.107-109/h panchvati society baroi road mundra', '', '', '', '', 'p.n.107-109/h panchvati society baroi road mundra', '', '', '', '', '', '', 'active', '9978583477', '', '9726624205', ''),
(66, 'Dhurmik', 'Rameshbhai', 'Jepar', 'sanskar66', '9586413256', '2014-04-19', 'Rameshbhai Devjibhai jepar', 'savitaben  rameshbhai jepar', '', '', '', 'Hindu', 'Indian', '', '', '', 'Gujarati', '', '', '2017-06-05', 'bhuj', 'p.88/a khetapal nagar,baroi road mundra ', '', '', '', '', 'p.88/a khetapal nagar,baroi road mundra ', '', '', '', '', '', '', 'active', '9586413256', '', '9586693565', ''),
(67, 'Mohamadijhan', 'Husenbhai', 'Bhatti', 'sanskar67', '9979445735', '2013-07-12', 'Husenbhai ', 'Rashida husenbhai bhatti', '', '', '', 'Muslim', 'Indian', '', '', '', 'Gujarati', '', '', '0000-00-00', 'luni', 'luni kachchh mundra', '', '', '', '', 'luni kachchh mundra', '', '', '', '', '', '', 'active', '9979445735', '', '', ''),
(68, 'BHAVYA', 'HARESHBHAI ', 'JADAV', 'sanskar68', '9979441819', '2012-11-18', 'HARESHBHAI ', 'VARSHABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '0000-00-00', 'MUNDRA', 'NEAR SHITLA MATA MANDIR ,GAYTREE NAGAR,BAROI ROAD ', '', '', '', '', 'NEAR SHITLA MATA MANDIR ,GAYTREE NAGAR,BAROI ROAD ', '', '', '', '', '', '', 'active', '9979441819', '', '', ''),
(69, 'MO.RIHAN', 'NAJIR', 'BHATTI', 'sanskar69', '7600526049', '2012-09-15', 'NAJIR', 'SHERBANU', '', '', '', 'MUSLIM', 'INDIAN', '', '', '', 'KUTCHI', '', '', '2017-03-17', 'MUNDRA', 'BAROI,MUSLIM WAS, GOYAR SAMA ROAD , GAYATRI NAGAR,MUNDRA', '', '', '', '', 'BAROI,MUSLIM WAS, GOYAR SAMA ROAD , GAYATRI NAGAR,MUNDRA', '', '', '', '', '', '', 'active', '7600526049', '', '7600526049', ''),
(70, 'KISHNA', 'RAMJEE VELJEE', 'SATHVARA', 'sanskar70', '9925811855', '2011-10-29', 'RAMJEE VELJEE', 'KANTABEN', '', '', '', '', 'INDIAN', '', '', '', '', '', '', '0000-00-00', 'MUNDRA', 'BAPU NAGAR BAROI ROOD', '', '', '', '', 'BAPU NAGAR BAROI ROOD', '', '', '', '', '', '', 'active', '9925811855', '', '', ''),
(71, 'DHRUVRAJSIH', 'LAXMANSIH', 'SODHA', 'sanskar71', '9879080776', '2012-02-14', 'LAXMANSIH', 'JAYSHREEBAA', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-05-27', '', 'BAROI,GAYTRI NAGAR, MUNDRA ', '', '', '', '', 'BAROI,GAYTRI NAGAR, MUNDRA ', '', '', '', '', '', '', 'active', '9879080776', '', '', ''),
(72, 'HETRAJ', 'PRAKASH', 'SODHA', 'sanskar72', '9979274192', '2012-04-29', 'PRAKASH', 'TRUPTI BEN ', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-04-06', 'BHACHAU', 'NIL HINGLAG NAGAR-1 ,BAROI - MUDRA', '', '', '', '', 'NIL HINGLAG NAGAR-1 ,BAROI - MUDRA', '', '', '', '', '', '', 'active', '9979274192', '', '', ''),
(73, 'DAKSHRAJSINH', 'MAYUR SINH', 'RATHOD', 'sanskar73', '9913965744', '2012-12-20', 'MAYUR SINH', 'HETALBEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-09-13', 'DHOLKA', '128/129 B GHANSYAM PARK -02,BAROI ROAD MUNDRA', '', '', '', '', '128/129 B GHANSYAM PARK -02,BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '9913965744', '', '9429298332', ''),
(74, 'SHORYA', 'PANKAJBHAI', 'JANKHARIYA', 'sanskar74', '7874653292', '2012-12-17', 'PANKAJBHAI', 'VAISHALIBEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-05-17', 'RAJKOT', '37-KAILAS PARK,PEREDISE HOTEL BAROI ROAD', '', '', '', '', '37-KAILAS PARK,PEREDISE HOTEL BAROI ROAD', '', '', '', '', '', '', 'active', '7874653292', '', '7016479597', ''),
(75, 'ARYAKUMAR', 'NAVINBHAI', 'PRAJAPATI', 'sanskar75', '9687435347', '2012-09-05', 'NAVINBHAI', 'SHIPABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '0000-00-00', 'KHAERALU', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687435347', '', '', ''),
(76, 'VED', 'RAJESH', 'GONDALIYA', 'sanskar76', '8758710485', '2012-08-11', 'RAJESH', 'DIMPALBEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-06-06', 'BHESHAN', 'P.N.46.50 E SITARAM PARK BAROI ROAD MUNDRA', '', '', '', '', 'P.N.46.50 E SITARAM PARK BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '8758710485', '', '9601424819', ''),
(77, 'NENSHIBEN', 'RAJENDRAKUMAR', 'SOLANKI', 'sanskar77', '997843007', '2012-09-21', 'RAJENDRAKUMAR', 'NEETABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2012-06-07', 'MUNDRA', 'ASHPURA NAGAR MUNDRA ', '', '', '', '', 'ASHPURA NAGAR MUNDRA ', '', '', '', '', '', '', 'active', '997843007', '', '8758636848', ''),
(78, 'GUNJAN', 'NITLNBHAI', 'GHEDIYA', 'sanskar78', '9898352098', '2012-11-22', 'NITLNBHAI', 'HETALBEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-06-05', 'GADHAKA', 'P-N-21-C HINGAJ NAGAR-2 NR.LITTLE WOND ER SCHOOL ROAD MUNDRA', '', '', '', '', 'P-N-21-C HINGAJ NAGAR-2 NR.LITTLE WOND ER SCHOOL ROAD MUNDRA', '', '', '', '', '', '', 'active', '9898352098', '', '9586424445', ''),
(79, 'NAUSHAD', 'DAUD', 'BHAJIR', 'sanskar79', '9825582983', '2012-10-29', 'DAUD', 'RAJIYA', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-06-04', 'MUNDRA', 'MUSLIM VAS BAROI ROAD', '', '', '', '', 'MUSLIM VAS BAROI ROAD', '', '', '', '', '', '', 'active', '9825582983', '', '7575070492', ''),
(80, 'JINALBEN', 'RAJESBHAI', 'YADAV', 'sanskar80', '9998031619', '2012-07-05', 'RAJESBHAI', 'SHILABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-06-04', 'DRABAVAD', 'P.N.102/103/B .DEVANG TOWANSHIP BAROI ROAD MUNDRA', '', '', '', '', 'P.N.102/103/B .DEVANG TOWANSHIP BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '9998031619', '', '9429039887', ''),
(81, 'GURU', 'KALPESH', 'VASANI', 'sanskar81', '9979794456', '2013-03-11', 'KALPESH', 'SAKUNTALABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-04-10', 'MANDVI', 'C/O.VISHAL CHHALHAIYA GANCHYAM PARK-1,NEAR PRIHA PARK BAROI ROAD,MUNDRA', '', '', '', '', 'C/O.VISHAL CHHALHAIYA GANCHYAM PARK-1,NEAR PRIHA PARK BAROI ROAD,MUNDRA', '', '', '', '', '', '', 'active', '9979794456', '', '7228994456', ''),
(82, 'HARSHITABA', 'BHARATSINH', 'JADEJA', 'sanskar82', '9099280230', '2012-12-04', 'BHARATSINH', 'ARUNABA', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-05-26', 'MUNDRA', 'GAYRATI NAGAR BAROI ROAD MUNDRA', '', '', '', '', 'GAYRATI NAGAR BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '9099280230', '', '', ''),
(83, 'AAYUSHI', 'JAYESHBHAI', 'NAKUM', 'sanskar83', '9724872256', '2012-12-23', 'JAYESHBHAI', 'JOSHANABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '0000-00-00', 'MANAVADAR', 'P.N.44,AASHAPURA-2 BAROI MUNDRA', '', '', '', '', 'P.N.44,AASHAPURA-2 BAROI MUNDRA', '', '', '', '', '', '', 'active', '9724872256', '', '9979859638', ''),
(84, 'DHYEY', 'NITIN', 'PADALIYA', 'sanskar84', '9909950477', '2012-11-18', 'NITIN', 'KAILASH', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '0000-00-00', 'MUNDRA', 'H.N.48,49/D,JASARY NAGAR,BAROI ROAD MUNDRA                               ', '', '', '', '', 'H.N.48,49/D,JASARY NAGAR,BAROI ROAD MUNDRA                               ', '', '', '', '', '', '', 'active', '9909950477', '', '9909950478', ''),
(85, 'NIKHIL', 'NAMORI', 'FAFAL ', 'sanskar85', '9979210634', '2011-06-04', 'NAMORI', 'LAKSHMIBEN', '', '', '', '', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-04-15', 'MUNDRA', 'BAROI MUNDRA', '', '', '', '', 'BAROI MUNDRA', '', '', '', '', '', '', 'active', '9979210634', '', '', ''),
(86, 'RIDHAM', 'MAHESHBHAI', 'TANK', 'sanskar86', '9427265125', '2012-12-10', 'MAHESHBHAI', 'SANGEETA', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-04-13', 'VERAVAL', 'SHILP VATIKA SOCIETY BAROI ROAD MUNDRA', '', '', '', '', 'SHILP VATIKA SOCIETY BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '9427265125', '', '9428306009', ''),
(87, 'MO.FAIZAN', 'AHEMAD RAJAK', 'THEBA', 'sanskar87', '9662562184', '2011-12-26', 'AHEMAD RAJAK', 'NAJMA', '', '', '', 'MUSLIM', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-03-17', 'MANDVI', 'BUS STATION SHERRY BAROI-1 ,MUNDRA', '', '', '', '', 'BUS STATION SHERRY BAROI-1 ,MUNDRA', '', '', '', '', '', '', 'active', '9662562184', '', '7383538967', ''),
(88, 'NIYATI', 'NARENDRA', 'KUSVAHA', 'sanskar88', '9427915780', '2012-08-24', 'NARENDRA', 'RINKUBEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-03-20', 'VISNAGAR', '46-49/1,SHILP VATIKA SOCIETY BAROI ROAD MUNDRA', '', '', '', '', '46-49/1,SHILP VATIKA SOCIETY BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '9427915780', '', '9727753377', ''),
(89, 'VALIMOHMAD', 'IMTIYAJ', 'MUNERA', 'sanskar89', '9879076236', '2012-03-05', 'IMTIYAJ', 'SAHIN', '', '', '', 'MUSLIM', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-03-23', 'JAMNAGAR', 'KHARVA CHAWK,OPP.BHATIA MAHAJAN WADI MUNDRA', '', '', '', '', 'KHARVA CHAWK,OPP.BHATIA MAHAJAN WADI MUNDRA', '', '', '', '', '', '', 'active', '9879076236', '', '9722992836', ''),
(90, 'VIRRAJSINH', 'JAGDISHBHAI', 'SODHA', 'sanskar90', '9979547406', '2012-09-08', 'JAGDISHBHAI', 'PRTIXABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '2017-06-08', 'MUNDRA', 'VORA COLONY BAROI ROAD MUNDRA', '', '', '', '', 'VORA COLONY BAROI ROAD MUNDRA', '', '', '', '', '', '', 'active', '9979547406', '', '9913724035', ''),
(91, 'SHORYA', 'JITENDRA', 'CHHABHAIYA', 'sanskar91', '9879121425', '2012-12-14', 'JITENDRA', 'RITABEN', '', '', '', 'HINDU', 'INDIAN', '', '', '', 'GUJARATI', '', '', '0000-00-00', 'MUNDRA', 'H.N.2,ILARK HOMES PRISHA PARK ,MUNDRA', '', '', '', '', 'H.N.2,ILARK HOMES PRISHA PARK ,MUNDRA', '', '', '', '', '', '', 'active', '9879121425', '', '9428772835', ''),
(92, 'KUNAL KUMAR', 'RAJ KUMAR', 'NAGAL', 'TEMP001', 'TEMP001', '2014-08-19', 'RAJ KUMAR', 'MONIKA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'DEVANG TOWNSHIP,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9033623669', '8734920241', '', ''),
(93, 'RUDRA', 'MAULIK KUMAR', 'SUTHAR', 'TEMP002', 'TEMP002', '2015-01-15', 'MAULIK KUMAR', 'POONAMBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'JINDALSAW LTD.(IPU),SAMAGOGHA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8490852865', '9898576480', '', ''),
(94, 'AASIFALI ', 'ROSHAN HUSAIN', 'SIDDHIKI', 'TEMP003', 'TEMP003', '2014-02-19', 'ROSHAN HUSAIN', '', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9429581778', '9726054408', '', ''),
(95, 'BRIJRAJSINH', 'SAVAISINH', 'JADEJA', 'TEMP004', 'TEMP004', '2014-10-13', 'SAVAISINH', '', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'VIRANIYA ', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978863375', '9978863375', '', ''),
(96, 'DEEPUKUMAR', 'RAMESH', 'CHAUHAN', 'TEMP005', 'TEMP005', '2014-08-24', 'RAMESH', 'SEEMADEVI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'NO-184/NEAR MASTIJ BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979514407', '', '', ''),
(97, 'MOHI', 'DEVENDRA', 'PATEL', 'TEMP006', 'TEMP006', '2015-05-26', 'DEVENDRA', 'NAYANABEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'SHILP-VATIKA SOC.BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9409508130', '9726657280', '', ''),
(98, 'BHUMI ', 'JAYESH KUMAR', 'SEN', 'TEMP007', 'TEMP007', '2015-04-10', 'JAYESH KUMAR', 'NIRMALA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '2,KUVARJI KENYA APPARTMENT,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9712913224', '9825695777', '', ''),
(99, 'NILAKSH KUMAR', 'PURANJAY KUMAR', 'SINGH', 'TEMP008', 'TEMP008', '2015-03-12', 'PURANJAY KUMAR', 'MUNNIKUMARI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'UMIYA NAGAR,NEAR SHREEJI MANDIR,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '7228902944', '9724905954', '', ''),
(100, 'GAURAV', 'RAMJI', 'SAHARIYA', 'TEMP009', 'TEMP009', '2015-05-11', 'RAMJI', 'KONIKA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'TRIVENI PARK,PLOT NO.28/B,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9723022336', '', '', ''),
(101, 'PRISHA', 'SANJAYBHAI', 'BUMTARIYA', 'TEMP010', 'TEMP010', '2015-08-18', 'SANJAYBHAI', 'JOSHNA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'SURYA NAGAR,NEAR GARBI CHOUK BAROI ROAD', '', '', '', '', '', '', '', '', '', '', '', 'active', '9726455507', '8511977388', '', ''),
(102, 'DIVYANSHGIRI', 'BHAVESHGIRI', 'GUSAI', 'TEMP011', 'TEMP011', '2015-05-15', 'BHAVESHGIRI', 'URVIBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'NEAR POST OFFICE,GUNDALA', '', '', '', '', '', '', '', '', '', '', '', 'active', '7567158021', '9913470409', '', ''),
(103, 'NAITIKSINH', 'INDRASINH', 'CHAUHAN', 'TEMP012', 'TEMP012', '2014-04-19', 'INDRASINH', 'POOJA DEVI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'DEVANG TOWNSHIP,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9537163522', '7408840299', '', ''),
(104, 'RADHE', 'MAHESHKUMAR', 'PATEL', 'TEMP013', 'TEMP013', '2014-09-28', 'MAHESHKUMAR', 'RINKUBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'DEWANG TOWNSHIP,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9429447184', '9409556625', '', ''),
(105, 'ASHUTOSH', 'ASHISH', 'TRIPATHI', 'TEMP014', 'TEMP014', '2014-05-28', 'ASHISH', 'ARADHANA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '7974795737', '7974763477', '', ''),
(106, 'PRIYANSHU', 'DINESHBHAI', 'GARVA', 'TEMP015', 'TEMP015', '2014-07-05', 'DINESHBHAI', 'CHANDRIKABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'DEWANG TOWNSHIP ,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925875304', '8469400738', '', ''),
(107, 'AAYAN', 'KAMAL', 'KHAN', 'TEMP016', 'TEMP016', '2013-07-05', 'KAMAL', 'NIKHAT PARWEEN', '', '', '', '', '', '1', 'male', '', '', 'A+', '0', '0000-00-00', '', 'NEAR HINGLAJ NAGAR,VIDYUT VIHAR SOCIETY,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979898158', '7573085001', '', ''),
(108, 'PRISHA', 'PRASHANT ', 'ADIYECHA', 'TEMP017', 'TEMP017', '2014-12-16', 'PRASHANT ', 'DIPALI', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'HINGLAJ NAGAR MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '7575082776', '9825532776', '', ''),
(109, 'MO.FAIZAN', 'MO.FARHAN', 'THEBA', 'TEMP018', 'TEMP018', '2013-12-14', 'MO.FARHAN', 'FARZANABANU', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'KANTHAWALA GATE, MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979284651', '8467626815', '', ''),
(110, 'MEET', 'KHIMA', 'RABARI', 'TEMP019', 'TEMP019', '2014-06-05', 'KHIMA', 'LAXMI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'RATADIYA', '', '', '', '', '', '', '', '', '', '', '', 'active', '7088450098', '99091 71027', '', ''),
(111, 'UTSHAVI', 'TARISH KUMAR', 'GORANI', 'TEMP020', 'TEMP020', '2014-11-09', 'TARISH KUMAR', 'DIPIKABEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'MARUTI NAGAR,ST.XAVIERS ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9426452465', '9409193164', '', ''),
(112, 'KUMAR', 'MANOJ', 'MAHESHWARI', 'TEMP021', 'TEMP021', '2014-08-22', 'MANOJ', 'JYOTIBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'ALAKHNANDA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925411089', '9512970754', '', ''),
(113, 'RAJ', 'PANCHLAL', 'PAL', 'TEMP022', 'TEMP022', '2013-11-18', 'PANCHLAL', 'JAY DEVI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SHANTINIKETAN COLONY,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978866967', '7041109641', '', ''),
(114, 'KARTIK', 'MANOJ', 'MAHESHWARI', 'TEMP023', 'TEMP023', '2014-08-22', 'MANOJ', 'JYOTIBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'ALAKHNANDA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925411089', '9512970754', '', ''),
(115, 'VIRAJ', 'AWADHESH', 'SINGH', 'TEMP024', 'TEMP024', '2013-02-10', 'AWADHESH', 'MIRADEVI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'PLOT NO.2,MOMAIDHAR,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9377770066', '', '', ''),
(116, 'BHAVYA', 'AKSHAYBHAI', 'JANI', 'TEMP025', 'TEMP025', '2014-06-13', 'AKSHAYBHAI', 'SUNITA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'JAIN NAGAR-3,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141150677', '9726387281', '', ''),
(117, 'NITINKUMAR', 'PRADIPKUMAR', 'TELAR', 'TEMP026', 'TEMP026', '2014-03-05', 'PRADIPKUMAR', 'POOJABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'VATHAN,NEAR DENA BANK,PATRI', '', '', '', '', '', '', '', '', '', '', '', 'active', '8980419973', '9712882428', '', ''),
(118, 'Samiya', 'Mustak', 'Sameja', 'TEMP027', 'TEMP027', '2014-09-03', 'Mustak', 'Sehnaz', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913621075', '', '', ''),
(119, 'HARSHAL', 'Shankar', 'Maheshwari', 'TEMP028', 'TEMP028', '2013-10-28', 'Shankar', 'Nayna', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925971959', '', '', ''),
(120, 'Naiti', 'Piyush Kumar', 'Senghan', 'TEMP029', 'TEMP029', '2013-12-03', 'Piyush Kumar', 'Rina Ben', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913114360', '', '', ''),
(121, 'Hensi', 'Nileshbhai', 'Kanzariya', 'TEMP030', 'TEMP030', '2014-09-19', 'Nileshbhai', 'Manisha', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9712417919', '', '', ''),
(122, 'Aaysha', 'Hamid Hussain', 'Turk', 'TEMP031', 'TEMP031', '2014-02-09', 'Hamid Hussain', 'Rijvana', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913113757', '', '', ''),
(123, 'MO.WAHAB', 'ABDUL KADIR', 'SIDI', 'TEMP032', 'TEMP032', '2014-04-15', 'ABDUL KADIR', 'SAHIMABANU', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MUSLIM VAS,(OPP.)SHIV PARAS,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925758521', '', '', ''),
(124, 'HARDI', 'JITESHBHAI', 'CHHODAVADIYA', 'TEMP033', 'TEMP033', '2014-09-04', 'JITESHBHAI', 'NILAM', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'BLOCK-4,PLOT-87/88,JAIN NAGAR,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9909354796', '9173704775', '', ''),
(125, 'PARTH', 'AMBABHAI', 'PARMAR', 'TEMP034', 'TEMP034', '2014-04-07', 'AMBABHAI', 'HANSABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'BLOCK-3,PLOT-87/88,JAIN  NAGAR,BAROI,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9099021542', '9925642608', '', ''),
(126, 'MOKSH', 'ROHIT', 'RAJGOR', 'TEMP035', 'TEMP035', '2013-07-08', 'ROHIT', 'CHETNA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '67/A,MANGALAM PARK,OPP.SANSKAR SCHOOL,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8469591267', '7405171121', '', ''),
(127, 'MANVI', 'RAJESH KUMAR', 'NAIN', 'TEMP036', 'TEMP036', '2013-07-08', 'RAJESH KUMAR', 'PUSHPA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'HOME NO.15,SURSHATI PARK,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9355878774', '8529450443', '', ''),
(128, 'VISHWARAJSINH', 'AJITSINH', 'MOHKA', 'TEMP037', 'TEMP037', '2014-08-19', 'AJITSINH', 'SHOBHNABA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'S/O,MOHKA SHOBHNA NI WADI VISITOR,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '8469590041', '9712909631', '', ''),
(129, 'HIMANSHI', 'KALURAM', 'DEORA', 'TEMP038', 'TEMP038', '2014-12-03', 'KALURAM', 'SUSHILA DEVI', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'H.N.3,VAIBHAV PARK,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9409294297', '8890888172', '', ''),
(130, 'NEEV', 'JAYESHBHAI', 'CHAUDHARI', 'TEMP039', 'TEMP039', '2014-05-16', 'JAYESHBHAI', 'VANDANABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MAHAVIR NAGAR BAROI ROAD ,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687660131', '8980357662', '', ''),
(131, 'ANSHUMAN', 'UMESHKUMAR', 'GUPTA', 'TEMP040', 'TEMP040', '2013-06-03', 'UMESHKUMAR', 'MAYA DEVI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'H.N,MANGLAM PARK NR,SHISHU MANDIR SCHOOL-MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '7982026171', '9325259928', '', ''),
(132, 'DIYA', 'AMITBHAI', 'PANDYA', 'TEMP041', 'TEMP041', '2012-09-04', 'AMITBHAI', 'POOJA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'KENIYA COMPLEX,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978243405', '', '', ''),
(133, 'RUDRA', 'PRAVINBHAI', 'SARVALIYA', 'TEMP042', 'TEMP042', '2014-07-07', 'PRAVINBHAI', 'ANITABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'OLD PETROL PUMP,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979140222', '9586015532', '', ''),
(134, 'KUNDANA', 'SRINIVASARAO', 'LUKULAPU', 'TEMP043', 'TEMP043', '2014-04-05', 'SRINIVASARAO', 'SRIDEVI', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'GATATRI NAGAR,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9104757262', '9157647208', '', ''),
(135, 'HARSHIDA', 'RAMARAO', 'KEERTHI', 'TEMP044', 'TEMP044', '2014-02-08', 'RAMARAO', 'SUNITHA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'MOMAI GHAR,NR.SWAMINARAYAN TEMPLE,BAROI ROAD', '', '', '', '', '', '', '', '', '', '', '', 'active', '9428064471', '9157706015', '', ''),
(136, 'AARAYAN', 'AWADHESH', 'SINGH', 'TEMP045', 'TEMP045', '2011-02-07', 'AWADHESH', 'MIRA DEVI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MOMAI GHAR,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9377770055', '', '', ''),
(137, 'PRIYANSHI', 'RAMASHANKAR', 'PAL', 'TEMP046', 'TEMP046', '2013-10-07', 'RAMASHANKAR', 'URMILADEVI', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '8155916941', '', '', ''),
(138, 'HETVIKA', 'VANKAT', 'GUNTI', 'TEMP047', 'TEMP047', '2014-10-16', 'VANKAT', 'HEMALATHA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'ASHAPURA NAGAR-2,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9666658565', '8186844704', '', ''),
(139, 'Ansh', 'Jaiswal', 'Chandan', 'TEMP048', 'TEMP048', '2014-01-01', 'Jaiswal', 'Pooja Jaiswal', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Plot No 99B Surya vNagar Baroi Road Mundra Kutch', '', '', '', '', '', '', '', '', '', '', '', 'active', '9067003660', '', '', ''),
(140, 'Jyoti', 'Prakash', 'Chandhari', 'TEMP049', 'TEMP049', '2013-03-08', 'Prakash', 'Ashaben Prakash Chaudhri', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '3, Panchvati Society, b/h Sanskar nagar Baroi Road Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9377419203', '', '', ''),
(141, 'Vishvarajshih', 'Ajitsinh', 'Mokha', 'TEMP050', 'TEMP050', '2014-08-19', 'Ajitsinh', 'Shobhanaba', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'S/O Mokha Shobhnaba ni wadi visistor baroi Kutch ', '', '', '', '', '', '', '', '', '', '', '', 'active', '8469590041', '', '', ''),
(142, 'Prince', 'Jalandhar ', 'Varma', 'TEMP051', 'TEMP051', '2013-02-07', 'Jalandhar ', 'Nilam', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Baroi Road Surya Nagar Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '7405715167', '', '', ''),
(143, 'Chetanya', 'Vijay Lal', 'Kumar', 'TEMP052', 'TEMP052', '2013-10-19', 'Vijay Lal', 'Kavitha Devi', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '86, Shivtownship Gandhidham Road Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141216187', '', '', ''),
(144, 'Savan', 'BijmalBhai', 'Maheshwari', 'TEMP053', 'TEMP053', '2012-09-28', 'BijmalBhai', 'Lilbai', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Rajput vas Patri Kutch Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9879934850', '', '', ''),
(145, 'Rahemat', 'Aabid Hussain', 'Padhiyar', 'TEMP054', 'TEMP054', '2013-03-13', 'Aabid Hussain', 'Razia Banu', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Patri', '', '', '', '', '', '', '', '', '', '', '', 'active', '9909220062', '', '', '');
INSERT INTO `es_preadmission` (`es_preadmissionid`, `pre_name`, `middle_name`, `pre_lastname`, `pre_student_username`, `pre_student_password`, `pre_dateofbirth`, `pre_fathername`, `pre_mothername`, `grno`, `pre_image`, `pre_emailid`, `pre_religion`, `pre_nationality`, `category_id`, `pre_gender`, `caste`, `pre_mother_tounge`, `pre_blood_group`, `admission_form_no`, `admission_date`, `pre_placeofbirth`, `pre_cur_address`, `pre_cur_area`, `pre_cur_city`, `pre_cur_state`, `pre_cur_pincode`, `pre_per_address`, `pre_per_area`, `pre_per_city`, `pre_per_state`, `pre_per_pincode`, `pre_aadhar_no`, `pre_uid_no`, `pre_status`, `pre_mobile_no`, `pre_sms_no`, `whatsapp_number`, `pre_telephone`) VALUES
(146, 'Navya', 'Dilipbhai', 'Kanan', 'TEMP055', 'TEMP055', '2012-09-21', 'Dilipbhai', 'Mina Ben', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Momai Ghar Plot 12 baroi Road Maruti Nagar', '', '', '', '', '', '', '', '', '', '', '', 'active', '9825539833', '', '', ''),
(147, 'manyata', 'Ramkishor', 'Bhati', 'TEMP056', 'TEMP056', '2013-10-02', 'Ramkishor', 'Mamta', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Sanskar Nagar Mundra Kutch', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913304200', '', '', ''),
(148, 'Poojan', 'Shatis', 'Bhinde', 'TEMP057', 'TEMP057', '0000-00-00', 'Shatis', 'Shruti', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Ambhika Nagar Plot No 187', '', '', '', '', '', '', '', '', '', '', '', 'active', '9537596108', '', '', ''),
(149, 'Ekamjot', 'PrabhjotSingh', 'Khalsa', 'TEMP058', 'TEMP058', '2013-01-13', 'PrabhjotSingh', 'Sadhana Kaur Khalsa', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Plot 67,68,69 Behind Gurudwara Saheb Kalyan Nagar Mundra Gundala Road Gundala', '', '', '', '', '', '', '', '', '', '', '', 'active', '9722058263', '', '', ''),
(150, 'Prarthna', 'Akshay Kumar', 'Jethi', 'TEMP059', 'TEMP059', '2013-05-21', 'Akshay Kumar', 'Meera Ben', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Plot No 107/109 House No C Panchvati Society Baroi Mundra Kutch', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978989333', '', '', ''),
(151, 'DEPENDRA KUMAR', '', 'SINGH', 'TEMP060', 'TEMP060', '2013-11-11', '', 'KANTABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MAFAT NAGAR,NEAR SACHHA MATA TEMPLE,GUNDALA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9274712296', '9687238833', '', ''),
(152, 'JAYVEERSINH', 'DHARMENDRASINH', 'ZALA', 'TEMP061', 'TEMP061', '2014-09-06', 'DHARMENDRASINH', 'CHHAYABA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'CHAUTHANI BUILDINGS, OLD PORT ROAD, MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9081724192', '8374534927', '', ''),
(153, 'AARYADIPSINH', 'HARISINH', 'JADEJA', 'TEMP062', 'TEMP062', '2015-09-28', 'HARISINH', 'NITABA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'HINGLAJ NAGAR,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913952774', '8758948279', '', ''),
(154, 'PRATIKSHA', 'ROHITBHAI', 'MAHESHWARI', 'TEMP063', 'TEMP063', '2015-06-25', 'ROHITBHAI', 'SANGITABEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'MAHESHWARI WAS, BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9909580231', '8866369120', '', ''),
(155, 'AYUSH', 'PRAVIN', 'DAFDA', 'TEMP064', 'TEMP064', '2014-08-26', 'PRAVIN', 'VANITABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SHILPA VATIKA,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687700424', '8141002291', '', ''),
(156, 'KRISHIV', 'KANAKSINH', 'ZALA', 'TEMP065', 'TEMP065', '2015-07-16', 'KANAKSINH', 'DHARMISTHA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'KAILASH PARK,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9904346794', '7046964233', '', ''),
(157, 'PUSHPARAJSINH', 'MAHENDRASINH', 'JADEJA', 'TEMP066', 'TEMP066', '2015-06-25', 'MAHENDRASINH', 'MANCHHABA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'ROOM NO.75,76,JAIN NAGAR,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9512993502', '9712482037', '', ''),
(158, 'MAHIR', 'SUNILBHAI', 'CHAUDHARI', 'TEMP067', 'TEMP067', '2014-11-16', 'SUNILBHAI', 'BHANUBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SHAJANAND PARKPOI-80/82-A MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913432505', '9712928779', '', ''),
(159, 'KAVY', 'PRAVINBHAI', 'JOSHI', 'TEMP068', 'TEMP068', '2014-08-21', 'PRAVINBHAI', 'BHAVANABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SANTINIKETAN COLONY NEAR JAIN NAGAR SUNDRAM ,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8511928654', '9998127254', '', ''),
(160, 'MAHI', 'PINTUKUMAR', 'GAMI', 'TEMP069', 'TEMP069', '2015-03-05', 'PINTUKUMAR', 'MINAXIBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'ASHAPURA NAGAR-2,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8238038161', '9429708006', '', ''),
(161, 'MOHIT', 'RAVINDRA', 'MAHESHWARI', 'TEMP070', 'TEMP070', '2013-07-12', 'RAVINDRA', 'BHARTI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'ASHAPURA NAGAR-2,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9879806243', '8140237911', '', ''),
(162, 'RITANSHU', 'PRAVINBHAI', 'BHEDA', 'TEMP071', 'TEMP071', '2014-03-20', 'PRAVINBHAI', 'NIRMALA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'P-NO19/ASHAPURA NAGAR,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9723519607', '7276986519', '', ''),
(163, 'DHYANI', 'HARDIKBHAI', 'PUROHIT', 'TEMP072', 'TEMP072', '2015-03-14', 'HARDIKBHAI', 'HETALBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'MAHAVIR NAGAR,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9662389336', '7575819575', '', ''),
(164, 'NISHANT', 'RAMJIBHAI', 'MAHESHWARI', 'TEMP073', 'TEMP073', '2014-08-07', 'RAMJIBHAI', 'LAXMIBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MANGRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9909329878', '9978863788', '', ''),
(165, 'NAVYA', 'SATISHBHAI', 'MOTKA', 'TEMP074', 'TEMP074', '2014-09-29', 'SATISHBHAI', 'NUTANBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'HINGALAJ NAGAR-2,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141201983', '7567141934', '', ''),
(166, 'MESHVA', 'ALPESH KUMAR', 'THAKAR', 'TEMP075', 'TEMP075', '2014-08-27', 'ALPESH KUMAR', 'ALPABEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'SHIP VATIKA ,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687678250', '9687678235', '', ''),
(167, 'HITIXABA', 'RAVIRAJSINH', 'JADEJA', 'TEMP076', 'TEMP076', '2014-09-21', 'RAVIRAJSINH', 'VAISHALIBA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'MAHAVIR NAGAR,BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9974308641', '8511517826', '', ''),
(168, 'RAKESH', 'KISHORBHAI', 'FAFFAL', 'TEMP077', 'TEMP077', '2013-10-08', 'KISHORBHAI', 'SONALBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MAHESHWARI VAS BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '7874381693', '9687582231', '', ''),
(169, 'SHIVAMSINH', 'NARANJI', 'JADEJA', 'TEMP078', 'TEMP078', '2014-07-15', 'NARANJI', 'MINABA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'BAPUNAGAR,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687959612', '', '', ''),
(170, 'HIREN', 'MEGHABHAI', 'RABARI', 'TEMP079', 'TEMP079', '2013-09-30', 'MEGHABHAI', 'MAGIBAI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9638971090', '9484552845', '', ''),
(171, 'PRINSH', 'JIVAN', 'FAFFAL', 'TEMP080', 'TEMP080', '2013-11-28', 'JIVAN', 'KESARBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MAHESHWARI WAS,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9537322610', '', '', ''),
(172, 'NITYA', 'SHARADBHAI', 'TRIVEDI', 'TEMP081', 'TEMP081', '2013-09-11', 'SHARADBHAI', 'RIDDHI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'KUTCH CROP SERVICE PVT.LTD.,MAHESH NAGAR,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9712075500', '9726606687', '', ''),
(173, 'KRISHA', 'JAYESHBHAI', 'SOLANKI', 'TEMP082', 'TEMP082', '2014-11-12', 'JAYESHBHAI', 'KHUSHIBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'SAHJANAND PARK,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9909227769', '9726936174', '', ''),
(174, 'YASHWINIBA', 'JAMBHA', 'JADEJA', 'TEMP083', 'TEMP083', '2015-03-13', 'JAMBHA', 'SUNITABA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'GADASAR, MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9924822780', '8758853098', '', ''),
(175, 'BHAVYA', 'UDAY ', 'DODIYA', 'TEMP084', 'TEMP084', '2014-09-05', 'UDAY ', 'JAGRUTIBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SAHJANAND PARK,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9879643323', '8511545197', '', ''),
(176, 'CHETANABEN', 'SURESHBHAI', 'JOSHI', 'TEMP085', 'TEMP085', '2014-08-24', 'SURESHBHAI', 'JAYSHRIBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'NIRMAL PARK,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8154083238', '9662041486', '', ''),
(177, 'JAYDEV', 'PIRDAN ', 'GADHAVI', 'TEMP086', 'TEMP086', '2014-05-19', 'PIRDAN ', 'SUGAN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'PARAS NAGAR,SWAMINARAYAN MANDIR SAME', '', '', '', '', '', '', '', '', '', '', '', 'active', '9427818670', '7990020599', '', ''),
(178, 'DIYA', 'KIRAN KUMAR', 'MODH', 'TEMP087', 'TEMP087', '2014-11-30', 'KIRAN KUMAR', 'SANDHYABEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'RAJLAXMI TAWAR,JESAR CHOUK,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141654748', '9978654748', '', ''),
(179, 'VED', 'NIMISH', 'BHATT', 'TEMP088', 'TEMP088', '2014-12-06', 'NIMISH', 'BHAVIKA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SUNDARAM SOCIETY,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913838791', '9712494217', '', ''),
(180, 'PRUTHVIRAJSINH', 'KANUBHA', 'RATHOD', 'TEMP089', 'TEMP089', '2014-05-12', 'KANUBHA', 'PAGNABA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'RATHOD WAS,MANGARA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9825415761', '8320448656', '', ''),
(181, 'PRERITSINH', 'DILIPSINH', 'PARMAR', 'TEMP090', 'TEMP090', '2015-09-16', 'DILIPSINH', 'MANISHABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'KAILASH PARK, BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '8320905670', '9277153152', '', ''),
(182, 'CHIRAG', 'KARAMSI', 'PARMAR', 'TEMP091', 'TEMP091', '2013-11-13', 'KARAMSI', 'SAVITABEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'MAHESH NAGAR,STREET NO.3,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978737931', '9979191542', '', ''),
(183, 'SANDHYA', 'GAURAV', 'MAHESHWARI', 'TEMP092', 'TEMP092', '2013-08-22', 'GAURAV', 'HETALBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'SARDAR PATELAAVASH YAJANU JUNA BANDRA ROAD', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913472756', '7874509422', '', ''),
(184, 'NAVYA', 'ROHITKUMAR', 'PATEL', 'TEMP093', 'TEMP093', '2014-02-23', 'ROHITKUMAR', 'KINJALBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'PATRI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9725871750', '9974729864', '', ''),
(185, 'TRUSHNA', 'VIJAYBHAI', 'CHAUHAN', 'TEMP094', 'TEMP094', '2013-09-08', 'VIJAYBHAI', 'RINKUBEN', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '4,RAJGRUHI APT,NEW MUNDRA,', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141368168', '9998123843', '', ''),
(186, 'TANAY', 'NILESHBHAI', 'KATESHIYA', 'TEMP095', 'TEMP095', '2013-06-19', 'NILESHBHAI', 'SHILPA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'JASHRAJ NAGAR P-48/49A BAROI MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '89806665464', '9737919463', '', ''),
(187, 'RUDRA', 'LOMESHBHAI', 'PATEL', 'TEMP096', 'TEMP096', '2013-08-09', 'LOMESHBHAI', 'MITTALBEN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'SARDAR PATELAAVASH YAJANU JUNA BANDRA ROAD', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925023922', '8469968200', '', ''),
(188, 'DIVYESHWARIBA', 'DASHARATHSINH', 'ZALA', 'TEMP097', 'TEMP097', '2014-01-07', 'DASHARATHSINH', 'DAXABA', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'HINGLAJ NAGAR-2,BAROI ROAD,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9099887310', '9909082757', '', ''),
(189, 'UMANG', 'KULDEEP', 'MAHESHWARI', 'TEMP098', 'TEMP098', '2013-12-15', 'KULDEEP', 'RATAN', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'STREET NO.1,MAHESH NAGAR,MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925681380', '9726688022', '', ''),
(190, 'KRISH', 'KULDIPBHAI', 'GAJJAR', 'TEMP099', 'TEMP099', '2014-05-31', 'KULDIPBHAI', 'KRUPALI', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687429331', '', '', ''),
(191, 'NAVYRAJSINH', 'NARENDRASINH', 'JADEJA', 'TEMP100', 'TEMP100', '2013-08-16', 'NARENDRASINH', 'TORALBA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'HAJIPIRNI DARGAH, BAPUNAGAR,BAROI', '', '', '', '', '', '', '', '', '', '', '', 'active', '9723126828', '9558872828', '', ''),
(192, 'ABDULWAHID', 'IQBAL', 'DHOBI', 'TEMP101', 'TEMP101', '2013-09-10', 'IQBAL', 'WAHIDA', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'NADIWALA NAKA PASE, LANGA SHERI, MUNDRA', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978738760', '', '', ''),
(193, 'mansi', 'Yogeshbhai  Vishram Baldadiya', 'Baldadiya', 'TEMP102', 'TEMP102', '2014-02-16', 'Yogeshbhai  Vishram Baldadiya', 'Gitaben Yogeshbhai Baldadiya', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Plot No. 6,7,8 Khetarpal Nagar,Opp.Kala purna Ashish, Mundra.', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687639217', '9909956683', '', ''),
(194, 'Anish', 'Haroonbhai Adam Kumbhar', 'Kumbhar', 'TEMP103', 'TEMP103', '2013-12-04', 'Haroonbhai Adam Kumbhar', 'Hajrabai Haroonbhai Kumbhar', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Gurjar Vas, Nr. Taluka Panchayat, Baroi road, Mundra.', '', '', '', '', '', '', '', '', '', '', '', 'active', '9067007300', '7575897766', '', ''),
(195, 'Saurya', 'Arjanbhai Jakhubhai Maheshwari', 'Maheshwari', 'TEMP104', 'TEMP104', '2013-10-16', 'Arjanbhai Jakhubhai Maheshwari', 'Damyantiben Arjanbhai Maheshwari', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'B.64/65, Shilpvatika, Nr. Sanskarnagar, Baroi Road, Mundra.', '', '', '', '', '', '', '', '', '', '', '', 'active', '9909885968', '9726687940', '', ''),
(196, 'Rajviba', 'Gajendrasinh Vijaysinh Jadeja', 'Jadeja ', 'TEMP105', 'TEMP105', '2014-05-13', 'Gajendrasinh Vijaysinh Jadeja', 'Minaba Gajendrasinh Jadeja', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Plot No. 107-109/4, Panchvati Society, Baroi , Mundra.', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978583477', '9726624205', '', ''),
(197, 'Mo. Farid', 'Aasif Anvar Khalifa', 'Khalifa', 'TEMP106', 'TEMP106', '2013-01-09', 'Aasif Anvar Khalifa', 'Aishabai Aasif Khalifa', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Mafat Nagar, Musalman Vas, Luni road, Baroi, Mundra.', '', '', '', '', '', '', '', '', '', '', '', 'active', '9727328036', '9726110478', '', ''),
(198, 'Tanviben', 'Maheshkumar Somabhai Pandor', 'Pandor', 'TEMP107', 'TEMP107', '2014-02-08', 'Maheshkumar Somabhai Pandor', 'Urmilaben Maheshkumar Pandor', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Opp. Dariyalal Shop, Baroi, Mundra.', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141545760', '8741741056', '', ''),
(199, 'Hardik', 'Maheshbhai shivribhai Maheshwari', 'Maheshwari', 'TEMP108', 'TEMP108', '2014-01-16', 'Maheshbhai shivribhai Maheshwari', 'Hiruben Maheshbhai Maheshwari', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Mangra sadau kachchh', '', '', '', '', '', '', '', '', '', '', '', 'active', '8758776790', '9726110879', '', ''),
(200, 'Naitik', 'Krunal Natavarlal Mehta', 'Mehta', 'TEMP109', 'TEMP109', '2013-07-20', 'Krunal Natavarlal Mehta', 'kinjal krunal Mehta', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Vabhnagar statebank opp baroi Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '8141643931', '8980343131', '', ''),
(201, 'sumiya', 'Mosin Iliyas Bhajir', 'Bhajir', 'TEMP110', 'TEMP110', '2013-01-25', 'Mosin Iliyas Bhajir', 'Ruksana Mosin Bhajir', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Farm area,Gayarsama road,Baroi Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '8264858584', '9662855727', '', ''),
(202, 'Krisha', 'Dinesh shantilal khatri', 'Khatri', 'TEMP111', 'TEMP111', '2014-05-03', 'Dinesh shantilal khatri', 'Nayanaben Dinesh khatri', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Vaidhei nagar baroi road Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978765660', '8758975722', '', ''),
(203, 'prisha', 'Ankitbhai Nemjibhai Heniya', 'Heniya', 'TEMP112', 'TEMP112', '2013-04-23', 'Ankitbhai Nemjibhai Heniya', 'Deepali Ankitbhai Heniya', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Patel faliya jain derasar baroi Mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979185646', '9913620932', '', ''),
(204, 'Tirthkumar', 'Dasharathbhai Mahadevbhai sabhani', 'Sabhani', 'TEMP113', 'TEMP113', '2013-09-09', 'Dasharathbhai Mahadevbhai sabhani', 'Hetalben Dashrathbhai sabhani', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'P.N.84/85B Mahavirnagar sisymandir baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979001518', '9099081584', '', ''),
(205, 'krishav', 'Bharat Jethabhai Kandoriya', 'Kandoriya', 'TEMP114', 'TEMP114', '2013-06-11', 'Bharat Jethabhai Kandoriya', 'kuvarben jethbhai kandoriya', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Ship vatical socatiay p.n.55/59 b.g baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9712497455', '7874572072', '', ''),
(206, 'Nakshkumar', 'bharat Jayrambhai joshi ', 'Joshi', 'TEMP115', 'TEMP115', '2014-03-22', 'bharat Jayrambhai joshi ', 'sarsvatiben bharat joshi', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '107,109 Panchavati society baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978979905', '7874572072', '', ''),
(207, 'Tathya', 'vipulbhai ganpatbhai patel', 'Patel', 'TEMP116', 'TEMP116', '2014-04-16', 'vipulbhai ganpatbhai patel', 'Dimpalben vipulbhai patel', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '79/C silp vatika society baroi road,mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '94263509350', '8511358487', '', ''),
(208, 'Nenshiben', 'kalmeshbhai parivn shah', 'Shah', 'TEMP117', 'TEMP117', '2013-10-09', 'kalmeshbhai parivn shah', 'Hiralben kalmeshbhai shah', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Devnada st.xaviers road baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9712775603', '9016312013', '', ''),
(209, 'Niva', 'jignesh Nathalal Tank', 'Tank', 'TEMP118', 'TEMP118', '2014-06-11', 'jignesh Nathalal Tank', 'Hetal Jignesh Tank', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Maruti nagar p.134,135,parmukh sadan nr.st xaviros school baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925153795', '9428469668', '', ''),
(210, 'Khanak', 'vimal kantilal chhabhaiya', 'Chhabhaiya', 'TEMP119', 'TEMP119', '2014-01-03', 'vimal kantilal chhabhaiya', 'Geetaben vimal chhabhaiya', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'H.N.2,ilark homes prisha park mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '8866238607', '9033959658', '', ''),
(211, 'Bhagirathsigh', 'navalsigh popatsigh vaghela', 'vaghela', 'TEMP120', 'TEMP120', '2013-09-15', 'navalsigh popatsigh vaghela', 'Hastaba navalsigh vaghela', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'R.n10,keniya Apartment baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '8238813492', '8980665156', '', ''),
(212, 'Shahzaib', 'Mohamad lmran rahim shekh', 'Shekh', 'TEMP121', 'TEMP121', '2014-06-13', 'Mohamad lmran rahim shekh', 'Alfanabanu mo.lmaran', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Goyar sama road Muslim vas baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9913955175', '9978023434', '', ''),
(213, 'Panth', 'Jatinbhai nathabhai patel', 'Patel', 'TEMP122', 'TEMP122', '2014-05-11', 'Jatinbhai nathabhai patel', 'Jignaben jatinbhai patel ', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', '78,80.B shilp vatika society near sanskar nagar mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9712909715', '9712909716', '', ''),
(214, 'Daksh', 'Ratan harji  Barot', 'Barot', 'TEMP123', 'TEMP123', '2014-05-23', 'Ratan harji  Barot', 'Ramila ratan barot', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Shreeji nagar baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9638087604', '9638087602', '', ''),
(215, 'Rahi', 'chiragkumar kanubhai Darji', 'Darji', 'TEMP124', 'TEMP124', '2013-06-19', 'chiragkumar kanubhai Darji', 'Manishben chiragkumar Darji', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'p.n.60-63/3,shilp vatika baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9408831654', '9427545219', '', ''),
(216, 'parvisha', 'Manishbhai valabhai', 'Dodiya', 'TEMP125', 'TEMP125', '2013-06-18', 'Manishbhai valabhai', 'Daksha manishbhai dodiya', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '9687678077', '9712938537', '', ''),
(217, 'varj', 'kirtibhai piprotar', 'piprotar', 'TEMP126', 'TEMP126', '2013-10-23', 'kirtibhai piprotar', '', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'Mahivr nagar 3 ,baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978217665', '9925623576', '', ''),
(218, 'srusty', 'chandubhai madhabhai hadiyal', 'Hadiyal', 'TEMP127', 'TEMP127', '2013-06-27', 'chandubhai madhabhai hadiyal', 'Ranjanben chandubhai hadiyal', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'jay nagar near arti hospital mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925683144', '9586284015', '', ''),
(219, 'vishva', 'vipulkumar prahladbhai', 'patel', 'TEMP128', 'TEMP128', '2012-02-29', 'vipulkumar prahladbhai', 'Hemlata vipulkumar patel', '', '', '', '', '', '', 'female', '', '', '', '', '0000-00-00', '', 'Ship vatical socatiay baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925657310', '7600011798', '', ''),
(220, 'vishala', 'ramijebhai ', 'sathvara', 'TEMP129', 'TEMP129', '2013-08-15', 'ramijebhai ', 'kantaben ', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9925811855', '', '', ''),
(221, 'Rudrarajsinh', 'Gajendrasinh Vijaysinh Jadeja', 'Jadeja ', 'TEMP130', 'TEMP130', '2014-05-13', 'Gajendrasinh Vijaysinh Jadeja', 'Minaba Gajendrasinh Jadeja', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'p.n.107-109/h panchvati society baroi road mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9978583477', '9726624205', '', ''),
(222, 'Dhurmik', 'Rameshbhai Devjibhai jepar', 'Jepar', 'TEMP131', 'TEMP131', '2014-04-19', 'Rameshbhai Devjibhai jepar', 'savitaben  rameshbhai jepar', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'p.88/a khetapal nagar,baroi road mundra ', '', '', '', '', '', '', '', '', '', '', '', 'active', '9586413256', '9586693565', '', ''),
(223, 'Mohamadijhan', 'Husenbhai ', 'Bhatti', 'TEMP132', 'TEMP132', '2013-07-12', 'Husenbhai ', 'Rashida husenbhai bhatti', '', '', '', '', '', '', 'male', '', '', '', '', '0000-00-00', '', 'luni kachchh mundra', '', '', '', '', '', '', '', '', '', '', '', 'active', '9979445735', '', '', ''),
(224, 'PARMAR', 'VIJAY', 'NATWAR', 'vijay-p', 'vijay-p', '2015-06-29', '', 'KAMLA VIJAY NATWAR', '', '', '', '', '', '1', 'male', '', '', 'A+', '0', '2018-06-21', '', 'GROUND FLOOR, RAJLAXMI BLDG.NEAR ADANI GUEST HOUSE,BAROI ROAD,MUNDRA', '', '', 'GUJARAT', '370421', '', '', '', '', '', '', '', 'active', '9727635124', '', '', ''),
(225, 'PARMAR', 'PRERITSINH', 'DILIPSINH', 'preritsinh-p', 'preritsinh-p', '2015-09-16', '', 'MANISHABEN', '', '', '', '', '', '1', 'male', '', '', 'A+', '0', '2018-06-21', '', 'GROUND FLOOR, RAJLAXMI BLDG.NEAR ADANI GUEST HOUSE,BAROI ROAD,MUNDRA', '', '', 'GUJARAT', '370421', '', '', '', '', '', '', '', 'active', '8320905670', '', '', ''),
(226, 'JADEJA', 'TULSHIBA', 'KARANSINH', 'tulshiba-j', 'tulshiba-j', '2013-12-01', '', 'SAJANBA', '', '', '', '', '', '1', 'female', '', '', 'A+', '0', '2018-06-21', '', 'VRUSHABH NAGAR,BAROI ROAD,MUNDRA\r\n', '', 'MUNDRA', 'GUJARAT', '370421', '', '', '', '', '', '', '', 'active', '9904807618', '9909379201', '', ''),
(227, 'Gohar', 'Dhara', 'Niraj', 'hiramoti', 'hiramoti', '2018-04-04', 'Niraj Kumar Hiralal Gohar', 'Shusma Gohar', '123', '', '', 'junagarh', 'indian', '1', 'male', 'Hindu,Luhar', 'Gujarati', 'B+', '123', '2018-06-27', 'junagarh', 'ahmedabad, ahmedabad, ahmedabad\r\nahmedabad', 'Junagarh', 'ahmedabad', 'Gujarat', '368002', 'ahmedabad, ahmedabad, ahmedabad\r\nahmedabad', 'ahmedabad', 'ahmedabad', 'Gujarat', '368002', '180012223333', '123456789456566646', 'active', '9723849565', '7878979879', '', '09723849232');

-- --------------------------------------------------------

--
-- Table structure for table `es_preadmission_details`
--

CREATE TABLE `es_preadmission_details` (
  `es_preadmission_detailsid` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `pre_class` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pre_fromdate` date DEFAULT NULL,
  `pre_todate` date DEFAULT NULL,
  `status` enum('pass','fail','resultawaiting','transferred') CHARACTER SET latin1 NOT NULL,
  `admission_status` enum('newadmission','promoted') CHARACTER SET latin1 NOT NULL,
  `division_id` int(11) NOT NULL,
  `scat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `es_preadmission_details`
--

INSERT INTO `es_preadmission_details` (`es_preadmission_detailsid`, `es_preadmissionid`, `academic_year_id`, `pre_class`, `pre_fromdate`, `pre_todate`, `status`, `admission_status`, `division_id`, `scat_id`) VALUES
(1, 1, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 1),
(2, 2, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 2),
(3, 3, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 3),
(4, 4, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 4),
(5, 5, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 5),
(6, 6, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 6),
(7, 7, 1, '2', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 2, 7),
(8, 8, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 1),
(9, 9, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 2),
(10, 10, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 3),
(11, 11, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 4),
(12, 12, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 5),
(13, 13, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 6),
(14, 14, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 7),
(15, 15, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 8),
(16, 16, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 9),
(17, 17, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 10),
(18, 18, 1, '3', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 3, 11),
(19, 19, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 1),
(20, 20, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 2),
(21, 21, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 3),
(22, 22, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 4),
(23, 23, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 5),
(24, 24, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 6),
(25, 25, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 7),
(26, 26, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 8),
(27, 27, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 9),
(28, 28, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 10),
(29, 29, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 11),
(30, 30, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 12),
(31, 31, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 13),
(32, 32, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 14),
(33, 33, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 15),
(34, 34, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 16),
(35, 35, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 17),
(36, 36, 1, '4', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 4, 18),
(37, 37, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 1),
(38, 38, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 2),
(39, 39, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 3),
(40, 40, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 4),
(41, 41, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 5),
(42, 42, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 6),
(43, 43, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 7),
(44, 44, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 8),
(45, 45, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 9),
(46, 46, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 10),
(47, 47, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 11),
(48, 48, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 12),
(49, 49, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 13),
(50, 50, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 14),
(51, 51, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 15),
(52, 52, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 16),
(53, 53, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 17),
(54, 54, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 18),
(55, 55, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 19),
(56, 56, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 20),
(57, 57, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 21),
(58, 58, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 22),
(59, 59, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 23),
(60, 60, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 24),
(61, 61, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 25),
(62, 62, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 26),
(63, 63, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 27),
(64, 64, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 28),
(65, 65, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 29),
(66, 66, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 30),
(67, 67, 1, '5', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 5, 31),
(68, 68, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 1),
(69, 69, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 2),
(70, 70, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 3),
(71, 71, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 4),
(72, 72, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 5),
(73, 73, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 6),
(74, 74, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 7),
(75, 75, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 8),
(76, 76, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 9),
(77, 77, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 10),
(78, 78, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 11),
(79, 79, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 12),
(80, 80, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 13),
(81, 81, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 14),
(82, 82, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 15),
(83, 83, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 16),
(84, 84, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 17),
(85, 85, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 18),
(86, 86, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 19),
(87, 87, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 20),
(88, 88, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 21),
(89, 89, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 22),
(90, 90, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 23),
(91, 91, 1, '6', '0000-00-00', '0000-00-00', 'resultawaiting', 'newadmission', 6, 24),
(92, 92, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(93, 93, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(94, 94, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(95, 95, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(96, 96, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(97, 97, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(98, 98, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(99, 99, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(100, 100, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(101, 101, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(102, 102, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(103, 103, 3, '1', NULL, NULL, 'resultawaiting', 'newadmission', 1, 0),
(104, 104, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(105, 105, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(106, 106, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(107, 107, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(108, 108, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(109, 109, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(110, 110, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(111, 111, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(112, 112, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(113, 113, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(114, 114, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(115, 115, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(116, 116, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(117, 117, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(118, 118, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(119, 119, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(120, 120, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(121, 121, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(122, 122, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(123, 123, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(124, 124, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(125, 125, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(126, 126, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(127, 127, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(128, 128, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(129, 129, 3, '3', NULL, NULL, 'resultawaiting', 'newadmission', 3, 0),
(130, 130, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(131, 131, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(132, 132, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(133, 133, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(134, 134, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(135, 135, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(136, 136, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(137, 137, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(138, 138, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(139, 139, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(140, 140, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(141, 141, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(142, 142, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(143, 143, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(144, 144, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(145, 145, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(146, 146, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(147, 147, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(148, 148, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(149, 149, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(150, 150, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(151, 151, 3, '4', NULL, NULL, 'resultawaiting', 'newadmission', 4, 0),
(152, 152, 3, '2', NULL, NULL, 'resultawaiting', 'newadmission', 2, 0),
(153, 153, 3, '2', NULL, NULL, 'resultawaiting', 'newadmission', 2, 0),
(154, 154, 3, '2', NULL, NULL, 'resultawaiting', 'newadmission', 2, 0),
(155, 155, 3, '2', NULL, NULL, 'resultawaiting', 'newadmission', 2, 0),
(156, 156, 3, '2', NULL, NULL, 'resultawaiting', 'newadmission', 2, 0),
(157, 157, 3, '2', NULL, NULL, 'resultawaiting', 'newadmission', 2, 0),
(158, 158, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(159, 159, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(160, 160, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(161, 161, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(162, 162, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(163, 163, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(164, 164, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(165, 165, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(166, 166, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(167, 167, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(168, 168, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(169, 169, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(170, 170, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(171, 171, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(172, 172, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(173, 173, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(174, 174, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(175, 175, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(176, 176, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(177, 177, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(178, 178, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(179, 179, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(180, 180, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(181, 181, 3, '5', NULL, NULL, 'resultawaiting', 'newadmission', 5, 0),
(182, 182, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(183, 183, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(184, 184, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(185, 185, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(186, 186, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(187, 187, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(188, 188, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(189, 189, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(190, 190, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(191, 191, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(192, 192, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(193, 193, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(195, 195, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(196, 196, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(197, 197, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(198, 198, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(199, 199, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(200, 200, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(201, 201, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(202, 202, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(203, 203, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(204, 204, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(205, 205, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(206, 206, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(207, 207, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(208, 208, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(210, 210, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(211, 211, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(212, 212, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(213, 213, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(214, 214, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(215, 215, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(216, 216, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(217, 217, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(220, 220, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(221, 221, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(222, 222, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(223, 223, 3, '6', NULL, NULL, 'resultawaiting', 'newadmission', 6, 0),
(224, 224, 3, '2', NULL, NULL, 'pass', 'newadmission', 2, 0),
(225, 225, 3, '2', NULL, NULL, 'pass', 'newadmission', 0, 0),
(226, 226, 3, '5', NULL, NULL, 'pass', 'newadmission', 5, 0),
(227, 227, 3, '1', NULL, NULL, 'pass', 'newadmission', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `es_questionbank`
--

CREATE TABLE `es_questionbank` (
  `q_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `choice_1` text NOT NULL,
  `choice_2` text NOT NULL,
  `choice_3` text NOT NULL,
  `choice_4` text NOT NULL,
  `answer` enum('A','B','C','D') NOT NULL,
  `feed_dis` varchar(255) NOT NULL,
  `correct_ans` text NOT NULL,
  `wrong_ans` text NOT NULL,
  `created_on` date NOT NULL,
  `user_type` enum('admin','staff') NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_requirement`
--

CREATE TABLE `es_requirement` (
  `es_requirementid` int(11) NOT NULL,
  `es_post` varchar(255) NOT NULL,
  `es_depatname` varchar(255) NOT NULL,
  `es_qualification` varchar(255) NOT NULL,
  `es_experience` varchar(255) NOT NULL,
  `es_noofpositions` int(11) NOT NULL,
  `es_date_posteddate` date NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_resignation`
--

CREATE TABLE `es_resignation` (
  `es_resignationid` int(11) NOT NULL,
  `res_letter` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_roomallotment`
--

CREATE TABLE `es_roomallotment` (
  `es_roomallotmentid` int(11) NOT NULL,
  `es_hostelroomid` int(11) NOT NULL,
  `es_personid` int(11) NOT NULL,
  `es_persontype` varchar(255) NOT NULL,
  `alloted_date` date NOT NULL,
  `dealloted_date` date NOT NULL,
  `status` enum('allocated','deallocated') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_schools`
--

CREATE TABLE `es_schools` (
  `Sr.No.` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_sections`
--

CREATE TABLE `es_sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_sections_student`
--

CREATE TABLE `es_sections_student` (
  `section_student_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `year_id` bigint(20) NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `section_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_security`
--

CREATE TABLE `es_security` (
  `es_securityid` int(11) NOT NULL,
  `sec_name` varchar(255) NOT NULL,
  `sec_address` varchar(255) NOT NULL,
  `sec_contact_person` varchar(255) NOT NULL,
  `sec_vehicle_no` varchar(255) NOT NULL,
  `sec_purpose` varchar(255) NOT NULL,
  `sec_mode_app` varchar(255) NOT NULL,
  `sec_time_out` datetime NOT NULL,
  `sec_remarks` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `sec_time_in` datetime NOT NULL,
  `sec_colour` varchar(255) NOT NULL,
  `sec_make_vehicle` varchar(255) NOT NULL,
  `sec_reg_no` varchar(255) NOT NULL,
  `sec_phone` varchar(255) NOT NULL,
  `sec_mobile` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_shortlisted`
--

CREATE TABLE `es_shortlisted` (
  `es_shortlistedid` int(11) NOT NULL,
  `stl_message` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_staff`
--

CREATE TABLE `es_staff` (
  `es_staffid` int(11) NOT NULL,
  `attendance_machine_id` varchar(12) NOT NULL,
  `st_postaplied` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_firstname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_gender` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_fthname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_dob` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_primarysubject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_fatherhusname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_noofdughters` int(11) NOT NULL,
  `st_noofsons` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_faminfo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_hobbies` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_marital` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_experience` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_attach1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_attach2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_attach3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_attach4` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_category` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_mobilenocomunication` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_examp1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_examp2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_examp3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_borduniversity1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_borduniversity2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_borduniversity3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_year1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_year2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_year3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_insititute1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_insititute2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_insititute3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_position1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_position2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_position3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_period1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_period2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_period3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pradress` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prcity` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prpincode` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prphonecode` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prstate` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prresino` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prcountry` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_prmobno` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_peadress` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pecity` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pepincode` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pephoneno` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pestate` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_peresino` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pecountry` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_pemobileno` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refposname1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refposname2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refposname3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refdesignation1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refdesignation2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refdesignation3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refinsititute1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refinsititute2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refinsititute3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refemail1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refemail2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_refemail3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_writentest` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_technicalinterview` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_finalinterview` varchar(255) CHARACTER SET latin1 NOT NULL,
  `status` enum('selected','notselected','onhold','added','dismisied') CHARACTER SET latin1 NOT NULL,
  `st_perviouspackage` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_basic` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_dateofjoining` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_post` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_department` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_remarks` varchar(255) CHARACTER SET latin1 NOT NULL,
  `intdate` date NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `selstatus` enum('issued','notissued','accepted','notaccepted') CHARACTER SET latin1 NOT NULL,
  `tcstatus` enum('notissued','issued','resigned') CHARACTER SET latin1 NOT NULL,
  `st_username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_theme` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_class` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_qualification` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_marks1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_marks2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_marks3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_permissions` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_bloodgroup` varchar(255) CHARACTER SET latin1 NOT NULL,
  `teach_nonteach` enum('teaching','nonteaching') CHARACTER SET latin1 NOT NULL DEFAULT 'teaching',
  `st_emailsend` varchar(255) CHARACTER SET latin1 NOT NULL,
  `terminationdate` varchar(255) CHARACTER SET latin1 NOT NULL,
  `hrdsid` varchar(255) CHARACTER SET latin1 NOT NULL,
  `st_mail` varchar(222) CHARACTER SET latin1 NOT NULL,
  `mamber1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mamber2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mamber3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mamber4` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mamber5` varchar(255) CHARACTER SET latin1 NOT NULL,
  `age1` int(11) NOT NULL,
  `age2` int(11) NOT NULL,
  `age3` int(11) NOT NULL,
  `age4` int(11) NOT NULL,
  `age5` int(11) NOT NULL,
  `relation1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `relation2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `relation3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `relation4` varchar(255) CHARACTER SET latin1 NOT NULL,
  `relation5` varchar(255) CHARACTER SET latin1 NOT NULL,
  `education1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `education2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `education3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `education4` varchar(255) CHARACTER SET latin1 NOT NULL,
  `education5` varchar(255) CHARACTER SET latin1 NOT NULL,
  `occupation1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `occupation2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `occupation3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `occupation4` varchar(255) CHARACTER SET latin1 NOT NULL,
  `occupation5` varchar(255) CHARACTER SET latin1 NOT NULL,
  `staff_status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `es_staff`
--

INSERT INTO `es_staff` (`es_staffid`, `attendance_machine_id`, `st_postaplied`, `st_firstname`, `st_lastname`, `st_gender`, `st_fthname`, `st_dob`, `st_primarysubject`, `st_fatherhusname`, `st_noofdughters`, `st_noofsons`, `st_faminfo`, `st_hobbies`, `st_marital`, `st_experience`, `st_attach1`, `st_attach2`, `st_attach3`, `st_attach4`, `st_category`, `st_email`, `st_mobilenocomunication`, `st_examp1`, `st_examp2`, `st_examp3`, `st_borduniversity1`, `st_borduniversity2`, `st_borduniversity3`, `st_year1`, `st_year2`, `st_year3`, `st_insititute1`, `st_insititute2`, `st_insititute3`, `st_position1`, `st_position2`, `st_position3`, `st_period1`, `st_period2`, `st_period3`, `st_pradress`, `st_prcity`, `st_prpincode`, `st_prphonecode`, `st_prstate`, `st_prresino`, `st_prcountry`, `st_prmobno`, `st_peadress`, `st_pecity`, `st_pepincode`, `st_pephoneno`, `st_pestate`, `st_peresino`, `st_pecountry`, `st_pemobileno`, `st_refposname1`, `st_refposname2`, `st_refposname3`, `st_refdesignation1`, `st_refdesignation2`, `st_refdesignation3`, `st_refinsititute1`, `st_refinsititute2`, `st_refinsititute3`, `st_refemail1`, `st_refemail2`, `st_refemail3`, `st_writentest`, `st_technicalinterview`, `st_finalinterview`, `status`, `st_perviouspackage`, `st_basic`, `st_dateofjoining`, `st_post`, `st_department`, `st_remarks`, `intdate`, `image`, `selstatus`, `tcstatus`, `st_username`, `st_password`, `st_theme`, `st_class`, `st_subject`, `st_qualification`, `st_marks1`, `st_marks2`, `st_marks3`, `st_permissions`, `st_bloodgroup`, `teach_nonteach`, `st_emailsend`, `terminationdate`, `hrdsid`, `st_mail`, `mamber1`, `mamber2`, `mamber3`, `mamber4`, `mamber5`, `age1`, `age2`, `age3`, `age4`, `age5`, `relation1`, `relation2`, `relation3`, `relation4`, `relation5`, `education1`, `education2`, `education3`, `education4`, `education5`, `occupation1`, `occupation2`, `occupation3`, `occupation4`, `occupation5`, `staff_status`) VALUES
(1, '', '', 'PRANITA', 'RAGHUVANSHI', 'Female', 'GIRISH', '1979-04-22', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'pranita.raghuwanshi@yahoo.com', '', 'B.E (PROD)', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8 YEARS', '', '', 'C-2/3 Samudra Township', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9712774899', 'C-2/3 Samudra Township', 'Mundra', '370421', '', 'Gujarat', '370421', 'India', '9712774899', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '1', '1', '', '0000-00-00', 'userphoto.gif', 'accepted', 'notissued', 'pranitaraghuvanshi', 'pranitaraghuvanshi', 'pink.css', '0', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(2, '', '', 'VIBHA', 'KHATRI', 'Female', 'NIRAJ', '1980-03-21', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'vibhakhatri21@gmail.com', '', 'F.Y.B.Com.', ' Pre primary montesory course', '', '', '', '', '', '', '', '', '', '', '', '', '', '7 YEARS', '', '', 'Plot no.43/44 Dwanil ban., Ganshyam Park 2, Baroi Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9978103292', 'Plot no.43/44 Dwanil ban., Ganshyam Park 2, Baroi Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9978103292', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '2', '1', '', '0000-00-01', 'userphoto.gif', 'accepted', 'notissued', 'vibhakhatri', 'vibhakhatri', 'pink.css', '0', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(3, '', '', 'POOJA', 'POPAT', 'Female', 'PARAG', '1981-08-31', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'poojapopat@gmail.com', '', 'B.Com.', 'L.L.B.', '', '', '', '', '', '', '', '', '', '', 'TEACHER', 'MIS ASSISTANT', '', '3 YEARS', '2 YEARS', '', 'S-4, Rajlaxmi Palace, Near Adani Guest House, Old Petrol Pump, Baroi Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9428596757', 'S-4, Rajlaxmi Palace, Near Adani Guest House, Old Petrol Pump, Baroi Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9428596757', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '2', '1', '', '0000-00-02', 'userphoto.gif', 'accepted', 'notissued', 'poojapopat', 'poojapopat', 'pink.css', '0', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(4, '', '', 'TEJAL', 'PATEL', 'Female', 'CHETAN', '1988-10-11', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'pateltejal417@gmail.com', '', 'M.A.', 'B.Ed.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' A-14/7 Samudra Township, Old Port Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9429561401', ' A-14/7 Samudra Township, Old Port Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9429561401', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-03', 'userphoto.gif', 'accepted', 'notissued', 'tejalpatel', 'tejalpatel', 'pink.css', '3', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(5, '', '', 'AARTI', 'GOSAI', 'Female', 'VIJAY', '1989-03-16', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'OBC', '', '', 'M.A.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2 YEARS', '', '', 'B 25/11 , shantivan teacher''s colony at Nana kapaya , Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '7433960533', 'B 25/11 , shantivan teacher''s colony at Nana kapaya , Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '7433960533', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-04', 'userphoto.gif', 'accepted', 'notissued', 'aartigusai', 'aartigusai', 'pink.css', '4', '0', '', '', '', '', '1,2,3,4', 'A+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(6, '', '', 'MANISHA', 'SHARMA', 'Female', 'RAJESH', '1984-08-27', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'myr1@gmail.com', '', 'M.Com.', 'PGDCA', '', '', '', '', '', '', '', '', '', '', 'COMPUTER TEACHER', 'HR & ACCOUNTANT', '', '2.5 YEARS', '3 YEARS', '', 'B-68/4, Samudra Township,Mundra.', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9228289454', 'B-68/4, Samudra Township,Mundra.', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9228289454', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-05', 'userphoto.gif', 'accepted', 'notissued', 'manishasharma', 'manishasharma', 'pink.css', '4', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(7, '', '', 'VAISHALI', 'PATEL', 'Female', 'CHIRAG', '1986-03-16', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'cp8619825@gmail.com', '', 'F.Y.B.A.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Jasraj nagar plot no 14/15 baroi road mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9624749190', 'Jasraj nagar plot no 14/15 baroi road mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9624749190', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-06', 'userphoto.gif', 'accepted', 'notissued', 'vaishalipatel', 'vaishalipatel', 'pink.css', '1', '0', '', '', '', '', '1,2,3,4', '', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(8, '', '', 'JULI', 'PITHDIYA', 'Female', 'JAGDISHBHAI', '1997-06-23', '', '', 0, 'Indian', '', '', 'Unmarried', '', '', '', '', '', 'OBC', 'julipithadiya236@gmail.com', '', 'T.Y.B.Com.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Vrushabh nagar, plot no. 85 , baroi road , mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9978253493', 'Vrushabh nagar, plot no. 85 , baroi road , mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9978253493', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-07', 'userphoto.gif', 'accepted', 'notissued', 'julipatel', 'julipatel', 'pink.css', '1', '0', '', '', '', '', '1,2,3,4', '', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(9, '', '', 'GEETANJALI', 'GUPTA', 'Female', 'VISHWAS', '1982-09-11', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', '', '', 'B.A.', 'I.G.D.', '', '', '', '', '', '', '', '', '', '', 'TEACHER', '', '', '12 YEARS', '', '', 'Rajlaxmi Palace, First Floor , Room No. 3. Nr. Adani Guest House, Old Petrol Pump, Baroi Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '7984099960', 'Rajlaxmi Palace, First Floor , Room No. 3. Nr. Adani Guest House, Old Petrol Pump, Baroi Road', 'Mundra', '370421', '', 'Gujarat', '', 'India', '7984099960', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-08', 'userphoto.gif', 'accepted', 'notissued', 'geetanjaligupta', 'geetanjaligupta', 'pink.css', '2', '0', '', '', '', '', '1,2,3,4', 'O+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(10, '', '', 'DHARMISHTA', 'GODHANIA', 'Female', 'SHAILESH', '1994-04-29', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'dkateliya84@gmail.com', '', 'B.Com', '', '', '', '', '', '', '', '', '', '', '', 'ADMIN', '', '', '1 YEAR', '', '', 'Plot no.44, Jasraj Nagar, Baroi road, Mundra.', 'Mundra', '370421', '', 'Gujarat', '', 'India', '8689960669', 'Plot no.44, Jasraj Nagar, Baroi road, Mundra.', 'Mundra', '370421', '', 'Gujarat', '', 'India', '8689960669', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-09', 'userphoto.gif', 'accepted', 'notissued', 'dharmishtagodhania', 'dharmishtagodhania', 'pink.css', '0', '0', '', '', '', '', '1,2,3,4', ' O+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(11, '', '', 'DHARA', 'VYAS', 'Female', 'KALPAK', '1990-11-21', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'General', 'dharadave6@gmail', '', 'M.Com.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1 YEAR', '', '', 'Prisha park, parth residency, Near ghanshym park,block no. 17,"Mauleshwari"krupa , mundra.', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9714533406', 'Prisha park, parth residency, Near ghanshym park,block no. 17,"Mauleshwari"krupa , mundra.', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9714533406', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-10', 'userphoto.gif', 'accepted', 'notissued', 'dharavyas', 'dharavyas', 'pink.css', '2', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(12, '', '', 'POOJA', 'PANCHAL', 'Female', 'NAVIN', '1993-02-09', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'OBC', 'panchalp92@gmail.com', '', 'B.Com.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2 YEAR', '', '', 'C-2/4 Samudra Township,Old bandar road, Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9879009990', 'C-2/4 Samudra Township,Old bandar road, Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9879009990', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '4', '1', '', '0000-00-11', 'userphoto.gif', 'accepted', 'notissued', 'poojapanchal', 'poojapanchal', 'pink.css', '0', '0', '', '', '', '', '1,2,3,4', 'O+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(13, '', '', 'VAISHALI', 'PATEL', 'Female', 'DEVENDRA', '1986-02-17', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'OBC', 'vaisu2117@gmail.com', '', 'Diploma engineer', '', '', '', '', '', '', '', '', '', '', '', 'TEACHER', '', '', '3 YEAR', '', '', 'A-37/11, Samudra Township,Old port road, Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9974064166', 'A-37/11, Samudra Township,Old port road, Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9974064166', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-12', 'userphoto.gif', 'accepted', 'notissued', 'vaishalipatel', 'vaishalipatel', 'pink.css', '3', '0', '', '', '', '', '1,2,3,4', 'O+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(14, '', '', 'RUPA', 'CHAVHAN', 'Female', 'HASMUKHBHAI', '1982-10-26', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', '', 'chavhan3280@gmail.com', '', 'S.Y.B.A.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '"Krishna-Sadan",plot no. 23,opp.of Axis Bank,mahavir nagar,Baroi Road,Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '7600056859', '"Krishna-Sadan",plot no. 23,opp.of Axis Bank,mahavir nagar,Baroi Road,Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '7600056859', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-13', 'userphoto.gif', 'accepted', 'notissued', 'rupachavhan', 'rupachavhan', 'pink.css', '5', '0', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(15, '', '', 'PANNABEN', 'NAT', 'Female', 'P.', '2000-02-23', '', '', 0, 'Indian', '', '', 'Unmarried', '', '', '', '', '', 'OBC', '', '', 'S.S.C.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Shilp vatika, Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9913390374', 'Shilp vatika, Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9913390374', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-14', 'userphoto.gif', 'accepted', 'notissued', 'pannanat', 'pannanat', 'pink.css', '6', '0', '', '', '', '', '1,2,3,4', '', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(16, '', '', 'RANJAN', 'JADHAV', 'Female', 'P.', '1976-02-29', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'SC', 'r.jadhav.p@gmail.com', '', 'B.A.', 'PRI.P.T.C.', '', '', '', '', '', '', '', '', '', '', '', '', '', '8 YEAR', '', '', 'Sthanak Chowk,near Kuvarji Kaniya house,Baroi', 'Baroi, Mundra', '370421', '', 'Gujarat', '', 'India', '9712331587', 'Sthanak Chowk,near Kuvarji Kaniya house,Baroi', 'Baroi, Mundra', '370421', '', 'Gujarat', '', 'India', '9712331587', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-15', 'userphoto.gif', 'accepted', 'notissued', 'ranjanjadhav', 'ranjanjadhav', 'pink.css', '5', '0', '', '', '', '', '1,2,3,4', 'O+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(17, '', '', 'RESHMA', 'KHALIFA', 'Female', 'IMRAN', '1993-06-10', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'OBC', 'khalifareshma8909@gmail.com', '', 'P.T.C.Montesory Teacher Training', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Near Bukhari Dargah,Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9925964695', 'Near Bukhari Dargah,Mundra', 'Mundra', '370421', '', 'Gujarat', '', 'India', '9925964695', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2017-04-01', '3', '1', '', '0000-00-16', 'userphoto.gif', 'accepted', 'notissued', 'reshmakhalifa', 'reshmakhalifa', 'pink.css', '2', '0', '', '', '', '', '1,2,3,4', 'AB+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active'),
(18, '', '', 'Jayshree', 'Gadhavi', 'Female', '', '1982-01-27', '', '', 0, 'Indian', '', '', 'Married', '', '', '', '', '', 'OTHER', 'sanskar school.mundra@gmail', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Jasraj nagar, baroi road , Mundra', '', '', '', '', '', '', '9904769080', 'Jasraj nagar, baroi road , Mundra', '', '', '', '', '', '', '9904769080', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'added', '', '0', '2018-03-21', '3', '1', '', '0000-00-00', 'userphoto.gif', 'accepted', 'notissued', 'jayshreegadhavi', 'jayshreegadhavi', 'pink.css', '6', '20', '', '', '', '', '1,2,3,4', 'B+', 'teaching', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `es_stationary`
--

CREATE TABLE `es_stationary` (
  `stationary_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `st_pay_id` bigint(20) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_stationary_payment`
--

CREATE TABLE `es_stationary_payment` (
  `st_pay_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `waived_amount` bigint(20) NOT NULL,
  `paid_amount` bigint(20) NOT NULL,
  `pay_status` enum('Paid','Pending') NOT NULL DEFAULT 'Pending',
  `saled_date` date NOT NULL,
  `paid_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_studentabsentnoti`
--

CREATE TABLE `es_studentabsentnoti` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `exam_name` varchar(222) NOT NULL,
  `exam_date` varchar(222) NOT NULL,
  `roll_number` varchar(222) NOT NULL,
  `marks_obtained` varchar(222) NOT NULL,
  `rank` varchar(222) NOT NULL,
  `dob` date NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `charector` varchar(222) NOT NULL,
  `conduct` varchar(222) NOT NULL,
  `games` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_studymaterial`
--

CREATE TABLE `es_studymaterial` (
  `es_studymaterialid` int(11) NOT NULL,
  `sm_class_id` varchar(255) NOT NULL,
  `sm_subject_id` varchar(255) NOT NULL,
  `sm_name` varchar(255) NOT NULL,
  `sm_description` longtext NOT NULL,
  `sm_attachment` varchar(256) NOT NULL,
  `sm_createdon` date NOT NULL,
  `person_type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_studymaterial`
--

INSERT INTO `es_studymaterial` (`es_studymaterialid`, `sm_class_id`, `sm_subject_id`, `sm_name`, `sm_description`, `sm_attachment`, `sm_createdon`, `person_type`, `created_by`, `status`) VALUES
(1, '1', '1', 'demo', 'zXcdzsc', '', '0000-00-00', 'admin', 1, 'deleted'),
(2, '1', '1', 'demo', 'asdasda', 'txt', '0000-00-00', 'admin', 1, 'deleted'),
(3, '1', '1', 'test123', '<span style="font-weight: bold;">Sdasda</span>', 'png', '2018-04-12', 'admin', 1, 'deleted'),
(4, '1', '1', 'staff testing', '<p>staff testing demo&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', 'txt', '2018-04-10', 'teacher', 2, 'deleted'),
(5, '1', '1', 'test123', 'asfdsdfdfsdf', 'png', '2018-04-13', 'teacher', 2, 'deleted'),
(6, '6', '', 'demo', 'Sdads', 'png', '2018-04-19', 'admin', 1, 'active'),
(7, '6', '2', 'demo', 'sdasd', 'png', '2018-04-13', 'admin', 1, 'deleted'),
(8, '2', '1', 'BOOK 1', '', 'sql', '2018-04-14', 'admin', 1, 'deleted'),
(9, '2', '1', 'BOOK 1', 'HELLO WORLD<br>', 'sql', '2018-04-14', 'admin', 1, 'deleted'),
(10, '2', '1', 'ass', 'sdsdfsdfsdsdfsdfsdfsdfsdfsdsxfdsxdf', 'jpeg', '2018-04-14', 'admin', 1, 'deleted'),
(11, '3', '6', 'Small letters', 'Writing and reading the small alphabet.', '', '2018-05-09', 'admin', 1, 'active'),
(12, '4', '11', 'Small letters', '', '', '2018-06-02', 'teacher', 3, 'deleted'),
(13, '3', '6', 'Worksheet', '', 'docx', '2018-06-04', 'teacher', 3, 'deleted'),
(14, '3', '7', 'Revision paper', '', 'docx', '2018-06-04', 'teacher', 3, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `es_subcategory`
--

CREATE TABLE `es_subcategory` (
  `es_subcategoryid` int(11) NOT NULL,
  `subcat_catname` int(11) NOT NULL,
  `subcat_scatname` varchar(255) NOT NULL,
  `subcat_scatdesc` longtext NOT NULL,
  `subcat_status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_subject`
--

CREATE TABLE `es_subject` (
  `es_subjectid` int(11) NOT NULL,
  `es_classid` int(11) DEFAULT NULL,
  `es_subjectname` varchar(255) NOT NULL,
  `es_subjectcode` varchar(255) NOT NULL,
  `es_subjectshortname` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_subject`
--

INSERT INTO `es_subject` (`es_subjectid`, `es_classid`, `es_subjectname`, `es_subjectcode`, `es_subjectshortname`) VALUES
(1, 1, 'English', '', '2'),
(2, 1, 'Mathematics', '', '2'),
(4, 1, 'Art & Craft', '', '2'),
(3, 1, 'GK', '', '2'),
(6, 2, 'English', '', '3'),
(7, 0, 'Mathematics', '', '3'),
(8, 0, 'Hindi', '', '3'),
(9, 0, 'GK', '', '3'),
(10, 0, 'Art & Craft', '', '3'),
(11, 0, 'English', '', '4'),
(12, 0, 'Mathematics', '', '4'),
(13, 0, 'Hindi', '', '4'),
(14, 0, 'GK', '', '4'),
(15, 0, 'Art & Craft', '', '4'),
(16, 0, 'Gujarati', '', '5'),
(17, 0, 'Mathematics', '', '5'),
(18, 0, 'English', '', '5'),
(19, 0, 'Art & Craft', '', '5'),
(20, 0, 'Gujarati', '', '6'),
(21, 0, 'Mathematics', '', '6'),
(22, 0, 'English', '', '6'),
(23, 0, 'Hindi', '', '6'),
(24, 0, 'Art & Craft', '', '6'),
(25, 0, 'Mathematics', '', '6'),
(30, 0, 'Account', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `es_taxmaster`
--

CREATE TABLE `es_taxmaster` (
  `es_taxmasterid` int(11) NOT NULL,
  `es_dept` int(11) NOT NULL,
  `tax_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tax_from_date` date NOT NULL,
  `tax_to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `es_tcmaster`
--

CREATE TABLE `es_tcmaster` (
  `es_tcmasterid` int(11) NOT NULL,
  `tcm_description` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_tcstudent`
--

CREATE TABLE `es_tcstudent` (
  `es_tcstudentid` int(11) NOT NULL,
  `tcm_description` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_timetable`
--

CREATE TABLE `es_timetable` (
  `es_timetableid` int(11) NOT NULL,
  `es_class` varchar(255) NOT NULL,
  `es_m1` varchar(255) NOT NULL,
  `es_m2` varchar(255) NOT NULL,
  `es_m3` varchar(255) NOT NULL,
  `es_m4` varchar(255) NOT NULL,
  `es_m5` varchar(255) NOT NULL,
  `es_m6` varchar(255) NOT NULL,
  `es_m7` varchar(255) NOT NULL,
  `es_m8` varchar(255) NOT NULL,
  `es_m9` varchar(255) NOT NULL,
  `es_subject` varchar(255) NOT NULL,
  `es_staffid` varchar(255) NOT NULL,
  `es_t1` varchar(255) NOT NULL,
  `es_t2` varchar(255) NOT NULL,
  `es_t3` varchar(255) NOT NULL,
  `es_t4` varchar(255) NOT NULL,
  `es_t5` varchar(255) NOT NULL,
  `es_t6` varchar(255) NOT NULL,
  `es_t7` varchar(255) NOT NULL,
  `es_t8` varchar(255) NOT NULL,
  `es_t9` varchar(255) NOT NULL,
  `es_w1` varchar(255) NOT NULL,
  `es_w2` varchar(255) NOT NULL,
  `es_w3` varchar(255) NOT NULL,
  `es_w4` varchar(255) NOT NULL,
  `es_w5` varchar(255) NOT NULL,
  `es_w6` varchar(255) NOT NULL,
  `es_w7` varchar(255) NOT NULL,
  `es_w8` varchar(255) NOT NULL,
  `es_w9` varchar(255) NOT NULL,
  `es_th1` varchar(255) NOT NULL,
  `es_th2` varchar(255) NOT NULL,
  `es_th3` varchar(255) NOT NULL,
  `es_th4` varchar(255) NOT NULL,
  `es_th5` varchar(255) NOT NULL,
  `es_th6` varchar(255) NOT NULL,
  `es_th7` varchar(255) NOT NULL,
  `es_th8` varchar(255) NOT NULL,
  `es_th9` varchar(255) NOT NULL,
  `es_f1` varchar(255) NOT NULL,
  `es_f2` varchar(255) NOT NULL,
  `es_f3` varchar(255) NOT NULL,
  `es_f4` varchar(255) NOT NULL,
  `es_f5` varchar(255) NOT NULL,
  `es_f6` varchar(255) NOT NULL,
  `es_f7` varchar(255) NOT NULL,
  `es_f8` varchar(255) NOT NULL,
  `es_f9` varchar(255) NOT NULL,
  `es_s1` varchar(255) NOT NULL,
  `es_s2` varchar(255) NOT NULL,
  `es_s3` varchar(255) NOT NULL,
  `es_s4` varchar(255) NOT NULL,
  `es_s5` varchar(255) NOT NULL,
  `es_s6` varchar(255) NOT NULL,
  `es_s7` varchar(255) NOT NULL,
  `es_s8` varchar(255) NOT NULL,
  `es_s9` varchar(255) NOT NULL,
  `es_startfrom` time DEFAULT '09:00:00',
  `es_endto` int(11) DEFAULT '9',
  `es_breakfrom` int(11) DEFAULT '20',
  `es_breakto` int(11) DEFAULT '1',
  `es_lunchfrom` int(11) DEFAULT '20',
  `es_lunchto` int(11) DEFAULT '2',
  `es_duration` int(11) NOT NULL DEFAULT '45'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_timetablemaster`
--

CREATE TABLE `es_timetablemaster` (
  `es_timetablemasterid` int(11) NOT NULL,
  `es_class` varchar(255) NOT NULL,
  `es_staffid` varchar(255) NOT NULL,
  `es_subject` varchar(255) NOT NULL,
  `es_teachername` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_timetable_staff`
--

CREATE TABLE `es_timetable_staff` (
  `es_st_id` int(11) NOT NULL,
  `es_class` varchar(255) NOT NULL,
  `es_m1` varchar(255) NOT NULL,
  `es_m2` varchar(255) NOT NULL,
  `es_m3` varchar(255) NOT NULL,
  `es_m4` varchar(255) NOT NULL,
  `es_m5` varchar(255) NOT NULL,
  `es_m6` varchar(255) NOT NULL,
  `es_m7` varchar(255) NOT NULL,
  `es_m8` varchar(255) NOT NULL,
  `es_m9` varchar(255) NOT NULL,
  `es_subject` varchar(255) NOT NULL,
  `es_staffid` varchar(255) NOT NULL,
  `es_t1` varchar(255) NOT NULL,
  `es_t2` varchar(255) NOT NULL,
  `es_t3` varchar(255) NOT NULL,
  `es_t4` varchar(255) NOT NULL,
  `es_t5` varchar(255) NOT NULL,
  `es_t6` varchar(255) NOT NULL,
  `es_t7` varchar(255) NOT NULL,
  `es_t8` varchar(255) NOT NULL,
  `es_t9` varchar(255) NOT NULL,
  `es_w1` varchar(255) NOT NULL,
  `es_w2` varchar(255) NOT NULL,
  `es_w3` varchar(255) NOT NULL,
  `es_w4` varchar(255) NOT NULL,
  `es_w5` varchar(255) NOT NULL,
  `es_w6` varchar(255) NOT NULL,
  `es_w7` varchar(255) NOT NULL,
  `es_w8` varchar(255) NOT NULL,
  `es_w9` varchar(255) NOT NULL,
  `es_th1` varchar(255) NOT NULL,
  `es_th2` varchar(255) NOT NULL,
  `es_th3` varchar(255) NOT NULL,
  `es_th4` varchar(255) NOT NULL,
  `es_th5` varchar(255) NOT NULL,
  `es_th6` varchar(255) NOT NULL,
  `es_th7` varchar(255) NOT NULL,
  `es_th8` varchar(255) NOT NULL,
  `es_th9` varchar(255) NOT NULL,
  `es_f1` varchar(255) NOT NULL,
  `es_f2` varchar(255) NOT NULL,
  `es_f3` varchar(255) NOT NULL,
  `es_f4` varchar(255) NOT NULL,
  `es_f5` varchar(255) NOT NULL,
  `es_f6` varchar(255) NOT NULL,
  `es_f7` varchar(255) NOT NULL,
  `es_f8` varchar(255) NOT NULL,
  `es_f9` varchar(255) NOT NULL,
  `es_s1` varchar(255) NOT NULL,
  `es_s2` varchar(255) NOT NULL,
  `es_s3` varchar(255) NOT NULL,
  `es_s4` varchar(255) NOT NULL,
  `es_s5` varchar(255) NOT NULL,
  `es_s6` varchar(255) NOT NULL,
  `es_s7` varchar(255) NOT NULL,
  `es_s8` varchar(255) NOT NULL,
  `es_s9` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_timetable_staff`
--

INSERT INTO `es_timetable_staff` (`es_st_id`, `es_class`, `es_m1`, `es_m2`, `es_m3`, `es_m4`, `es_m5`, `es_m6`, `es_m7`, `es_m8`, `es_m9`, `es_subject`, `es_staffid`, `es_t1`, `es_t2`, `es_t3`, `es_t4`, `es_t5`, `es_t6`, `es_t7`, `es_t8`, `es_t9`, `es_w1`, `es_w2`, `es_w3`, `es_w4`, `es_w5`, `es_w6`, `es_w7`, `es_w8`, `es_w9`, `es_th1`, `es_th2`, `es_th3`, `es_th4`, `es_th5`, `es_th6`, `es_th7`, `es_th8`, `es_th9`, `es_f1`, `es_f2`, `es_f3`, `es_f4`, `es_f5`, `es_f6`, `es_f7`, `es_f8`, `es_f9`, `es_s1`, `es_s2`, `es_s3`, `es_s4`, `es_s5`, `es_s6`, `es_s7`, `es_s8`, `es_s9`) VALUES
(1, '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, '2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, '4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, '5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, '6', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `es_timetable_subject`
--

CREATE TABLE `es_timetable_subject` (
  `es_sub_id` int(11) NOT NULL,
  `es_class` varchar(255) NOT NULL,
  `es_m1` varchar(255) NOT NULL,
  `es_m2` varchar(255) NOT NULL,
  `es_m3` varchar(255) NOT NULL,
  `es_m4` varchar(255) NOT NULL,
  `es_m5` varchar(255) NOT NULL,
  `es_m6` varchar(255) NOT NULL,
  `es_m7` varchar(255) NOT NULL,
  `es_m8` varchar(255) NOT NULL,
  `es_m9` varchar(255) NOT NULL,
  `es_subject` varchar(255) NOT NULL,
  `es_staffid` varchar(255) NOT NULL,
  `es_t1` varchar(255) NOT NULL,
  `es_t2` varchar(255) NOT NULL,
  `es_t3` varchar(255) NOT NULL,
  `es_t4` varchar(255) NOT NULL,
  `es_t5` varchar(255) NOT NULL,
  `es_t6` varchar(255) NOT NULL,
  `es_t7` varchar(255) NOT NULL,
  `es_t8` varchar(255) NOT NULL,
  `es_t9` varchar(255) NOT NULL,
  `es_w1` varchar(255) NOT NULL,
  `es_w2` varchar(255) NOT NULL,
  `es_w3` varchar(255) NOT NULL,
  `es_w4` varchar(255) NOT NULL,
  `es_w5` varchar(255) NOT NULL,
  `es_w6` varchar(255) NOT NULL,
  `es_w7` varchar(255) NOT NULL,
  `es_w8` varchar(255) NOT NULL,
  `es_w9` varchar(255) NOT NULL,
  `es_th1` varchar(255) NOT NULL,
  `es_th2` varchar(255) NOT NULL,
  `es_th3` varchar(255) NOT NULL,
  `es_th4` varchar(255) NOT NULL,
  `es_th5` varchar(255) NOT NULL,
  `es_th6` varchar(255) NOT NULL,
  `es_th7` varchar(255) NOT NULL,
  `es_th8` varchar(255) NOT NULL,
  `es_th9` varchar(255) NOT NULL,
  `es_f1` varchar(255) NOT NULL,
  `es_f2` varchar(255) NOT NULL,
  `es_f3` varchar(255) NOT NULL,
  `es_f4` varchar(255) NOT NULL,
  `es_f5` varchar(255) NOT NULL,
  `es_f6` varchar(255) NOT NULL,
  `es_f7` varchar(255) NOT NULL,
  `es_f8` varchar(255) NOT NULL,
  `es_f9` varchar(255) NOT NULL,
  `es_s1` varchar(255) NOT NULL,
  `es_s2` varchar(255) NOT NULL,
  `es_s3` varchar(255) NOT NULL,
  `es_s4` varchar(255) NOT NULL,
  `es_s5` varchar(255) NOT NULL,
  `es_s6` varchar(255) NOT NULL,
  `es_s7` varchar(255) NOT NULL,
  `es_s8` varchar(255) NOT NULL,
  `es_s9` varchar(255) NOT NULL,
  `es_startfrom` time DEFAULT '09:00:00',
  `es_endto` int(11) DEFAULT '9',
  `es_breakfrom` int(11) DEFAULT '20',
  `es_breakto` int(11) DEFAULT '1',
  `es_lunchfrom` int(11) DEFAULT '20',
  `es_lunchto` int(11) DEFAULT '2',
  `es_duration` int(11) NOT NULL DEFAULT '45'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_timetable_subject`
--

INSERT INTO `es_timetable_subject` (`es_sub_id`, `es_class`, `es_m1`, `es_m2`, `es_m3`, `es_m4`, `es_m5`, `es_m6`, `es_m7`, `es_m8`, `es_m9`, `es_subject`, `es_staffid`, `es_t1`, `es_t2`, `es_t3`, `es_t4`, `es_t5`, `es_t6`, `es_t7`, `es_t8`, `es_t9`, `es_w1`, `es_w2`, `es_w3`, `es_w4`, `es_w5`, `es_w6`, `es_w7`, `es_w8`, `es_w9`, `es_th1`, `es_th2`, `es_th3`, `es_th4`, `es_th5`, `es_th6`, `es_th7`, `es_th8`, `es_th9`, `es_f1`, `es_f2`, `es_f3`, `es_f4`, `es_f5`, `es_f6`, `es_f7`, `es_f8`, `es_f9`, `es_s1`, `es_s2`, `es_s3`, `es_s4`, `es_s5`, `es_s6`, `es_s7`, `es_s8`, `es_s9`, `es_startfrom`, `es_endto`, `es_breakfrom`, `es_breakto`, `es_lunchfrom`, `es_lunchto`, `es_duration`) VALUES
(1, '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '09:00:00', 9, 20, 1, 20, 2, 45),
(2, '2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '09:00:00', 9, 20, 1, 20, 2, 45),
(3, '3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '09:00:00', 9, 20, 1, 20, 2, 45),
(4, '4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '09:00:00', 9, 20, 1, 20, 2, 45),
(5, '5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '09:00:00', 9, 20, 1, 20, 2, 45),
(6, '6', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '09:00:00', 9, 20, 1, 20, 2, 45);

-- --------------------------------------------------------

--
-- Table structure for table `es_timetable_subjects`
--

CREATE TABLE `es_timetable_subjects` (
  `ts_id` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `subjectname` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_tips`
--

CREATE TABLE `es_tips` (
  `tip_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `lastupdated_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_transferstudent`
--

CREATE TABLE `es_transferstudent` (
  `id` int(1) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name_of_student` varchar(512) NOT NULL,
  `mother_name` varchar(256) NOT NULL,
  `grno` varchar(64) NOT NULL,
  `religion` varchar(128) NOT NULL,
  `place_of_birth` varchar(512) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_birth_in_words` varchar(1024) NOT NULL,
  `last_school` varchar(1024) NOT NULL,
  `date_of_admission` date NOT NULL,
  `progress` varchar(512) NOT NULL,
  `conduct` varchar(128) NOT NULL,
  `date_of_leaving` date NOT NULL,
  `last_standard` varchar(512) NOT NULL,
  `last_standard_join` date NOT NULL,
  `reason` varchar(1024) NOT NULL,
  `no_of_present_days` varchar(64) NOT NULL,
  `remarks` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_translist`
--

CREATE TABLE `es_translist` (
  `id` int(11) NOT NULL,
  `route_title` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_transport`
--

CREATE TABLE `es_transport` (
  `es_transportid` int(11) NOT NULL,
  `tr_transport_type` enum('bus','Car(Manual)','Car(Auto)','coach','minibus','van','other') NOT NULL,
  `tr_purchase_date` datetime NOT NULL,
  `tr_transport_no` varchar(255) NOT NULL,
  `tr_transport_name` varchar(255) NOT NULL,
  `tr_vehicle_no` varchar(255) NOT NULL,
  `tr_insurance_date` datetime NOT NULL,
  `tr_ins_renewal_date` datetime NOT NULL,
  `tr_seating_capacity` int(11) NOT NULL,
  `tr_route` varchar(255) NOT NULL,
  `tr_route_from` varchar(255) NOT NULL,
  `tr_route_to` varchar(255) NOT NULL,
  `tr_route_via` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_transport_allots`
--

CREATE TABLE `es_transport_allots` (
  `driver_allot_id` int(11) NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `es_transportid` int(11) NOT NULL,
  `driver_alloted_date` date DEFAULT NULL,
  `deallocate_date` date NOT NULL,
  `status` enum('Allocated','Deallocated') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_transport_drivers`
--

CREATE TABLE `es_transport_drivers` (
  `driver_id` int(11) NOT NULL,
  `driver_license` varchar(255) NOT NULL,
  `issuing_authority` varchar(255) NOT NULL,
  `valid_date` date NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `license_doc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_transport_maintenance`
--

CREATE TABLE `es_transport_maintenance` (
  `es_transport_maintenanceid` int(11) NOT NULL,
  `tr_transportid` varchar(255) NOT NULL,
  `tr_maintenance_type` varchar(255) NOT NULL,
  `tr_date_of_maintenance` datetime NOT NULL,
  `tr_amount_paid` double NOT NULL,
  `tr_remarks` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `tr_transportno` varchar(255) NOT NULL,
  `tr_transportname` varchar(255) NOT NULL,
  `es_ledger` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_transport_places`
--

CREATE TABLE `es_transport_places` (
  `tr_place_id` int(11) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_board`
--

CREATE TABLE `es_trans_board` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `board_title` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_board_allocation_to_student`
--

CREATE TABLE `es_trans_board_allocation_to_student` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `student_staff_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL,
  `created_on` date NOT NULL,
  `deallocated` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_driver_allocation_to_vehicle`
--

CREATE TABLE `es_trans_driver_allocation_to_vehicle` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_driver_details`
--

CREATE TABLE `es_trans_driver_details` (
  `id` int(11) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `driver_addrs` varchar(255) NOT NULL,
  `diver_mobile` varchar(255) NOT NULL,
  `driver_license` varchar(255) NOT NULL,
  `issuing_authority` varchar(255) NOT NULL,
  `valid_date` date NOT NULL,
  `driver_id` int(11) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `license_doc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_fee_details`
--

CREATE TABLE `es_trans_fee_details` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `installment_type` enum('monthly','yearly') NOT NULL,
  `fee_fromdate` date NOT NULL,
  `fee_todate` date NOT NULL,
  `financial_year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_maintenance`
--

CREATE TABLE `es_trans_maintenance` (
  `es_transport_maintenanceid` int(11) NOT NULL,
  `tr_transportid` varchar(255) NOT NULL,
  `tr_maintenance_type` varchar(255) NOT NULL,
  `tr_date_of_maintenance` date NOT NULL,
  `tr_amount_paid` double NOT NULL,
  `tr_remarks` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_payment_history`
--

CREATE TABLE `es_trans_payment_history` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `due_month` date NOT NULL,
  `pay_amount` double NOT NULL,
  `amount_paid` double NOT NULL,
  `deduction` double NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `paid_on` date NOT NULL,
  `pay_status` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `voucherid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_route`
--

CREATE TABLE `es_trans_route` (
  `id` int(11) NOT NULL,
  `route_title` varchar(255) NOT NULL,
  `route_Via` text NOT NULL,
  `amount` double NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_vehicle`
--

CREATE TABLE `es_trans_vehicle` (
  `es_transportid` int(11) NOT NULL,
  `tr_transport_type` enum('bus','Car(Manual)','Car(Auto)','coach','minibus','van','other') NOT NULL,
  `tr_purchase_date` date NOT NULL,
  `tr_transport_name` varchar(255) NOT NULL,
  `tr_vehicle_no` varchar(255) NOT NULL,
  `tr_insurance_date` date NOT NULL,
  `tr_ins_renewal_date` date NOT NULL,
  `tr_seating_capacity` int(11) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_trans_vehicle_allocation_to_board`
--

CREATE TABLE `es_trans_vehicle_allocation_to_board` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_tutorials`
--

CREATE TABLE `es_tutorials` (
  `tut_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `tut_desc` longtext NOT NULL,
  `lesson` longtext NOT NULL,
  `summary` longtext NOT NULL,
  `created_on` date NOT NULL,
  `user_type` enum('admin','staff') NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_undertaking`
--

CREATE TABLE `es_undertaking` (
  `id` int(2) NOT NULL,
  `sno` int(22) NOT NULL,
  `date` date NOT NULL,
  `student_name` varchar(222) NOT NULL,
  `father_name` varchar(222) NOT NULL,
  `mother_name` varchar(222) NOT NULL,
  `class_name` varchar(222) NOT NULL,
  `section` varchar(222) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `hobbies` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_units`
--

CREATE TABLE `es_units` (
  `unit_id` int(11) NOT NULL,
  `es_classesid` int(11) NOT NULL,
  `es_subjectid` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_userlogs`
--

CREATE TABLE `es_userlogs` (
  `id` bigint(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `submodule` varchar(255) NOT NULL,
  `record_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `posted_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_userlogs`
--

INSERT INTO `es_userlogs` (`id`, `user_id`, `table_name`, `module`, `submodule`, `record_id`, `action`, `ipaddress`, `posted_on`) VALUES
(1, 1, 'es_departments', 'STAFF', 'ADD DEPARTMENT', 1, 'DEPARTMENT ADDED', '49.34.81.144', '2018-03-01 10:52:06'),
(2, 1, 'es_departments', 'STAFF', 'ADD DEPARTMENT', 1, 'POST ADDED', '49.34.81.144', '2018-03-01 10:52:20'),
(3, 1, 'es_departments', 'STAFF', 'ADD DEPARTMENT', 2, 'POST ADDED', '49.34.81.144', '2018-03-01 10:52:38'),
(4, 1, 'es_departments', 'STAFF', 'ADD DEPARTMENT', 3, 'POST ADDED', '49.34.81.144', '2018-03-01 10:52:50'),
(5, 1, 'es_departments', 'STAFF', 'ADD DEPARTMENT', 4, 'POST ADDED', '49.34.81.144', '2018-03-01 10:53:05'),
(6, 1, 'es_staff', 'STAFF', 'ADD STAFF', 1, 'STAFF ADDED', '49.34.81.144', '2018-03-01 10:59:55'),
(7, 8, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '64.233.173.23', '2018-05-09 08:49:35'),
(8, 8, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '64.233.173.23', '2018-05-09 08:49:35'),
(9, 8, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '157.33.107.92', '2018-05-09 10:14:58'),
(10, 8, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '157.33.107.92', '2018-05-09 10:14:58'),
(11, 0, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 3, 'VIEW TIMETABLE', '49.44.139.234', '2018-06-02 11:50:45'),
(12, 0, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 3, 'VIEW TIMETABLE', '49.44.139.234', '2018-06-02 11:50:45'),
(13, 23, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '119.160.197.178', '2018-06-15 08:32:14'),
(14, 23, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '119.160.197.178', '2018-06-15 08:32:14'),
(15, 1, 'es_staff', 'STAFF', 'ADD STAFF', 18, 'STAFF ADDED', '157.32.79.71', '2018-06-23 07:09:21'),
(16, 1, 'es_classes', 'SET UP', 'Groups/Classes/Subjects', 11, 'DELETE CLASS', '127.0.0.1', '2018-06-26 21:57:50'),
(17, 1, 'es_classes', 'SET UP', 'Groups/Classes/Subjects', 12, 'DELETE CLASS', '127.0.0.1', '2018-06-26 21:58:36'),
(18, 1, 'es_subject', 'SET UP', 'Groups/Classes/Subjects', 0, 'DELETE SUBJECT', '127.0.0.1', '2018-06-27 21:46:48'),
(19, 1, 'es_subject', 'SET UP', 'Groups/Classes/Subjects', 0, 'DELETE SUBJECT', '127.0.0.1', '2018-06-27 21:48:26'),
(20, 1, 'es_subject', 'SET UP', 'Groups/Classes/Subjects', 0, 'DELETE SUBJECT', '127.0.0.1', '2018-06-27 22:04:27'),
(21, 1, 'es_subject', 'SET UP', 'Groups/Classes/Subjects', 0, 'DELETE SUBJECT', '127.0.0.1', '2018-06-27 22:12:52'),
(22, 70, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '127.0.0.1', '2018-07-03 21:26:25'),
(23, 70, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '127.0.0.1', '2018-07-03 21:26:25'),
(24, 70, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '127.0.0.1', '2018-07-03 21:26:36'),
(25, 70, ' es_timetable', 'TIME TABLE', 'CLASS/STAFF WISE TIME TABLE', 0, 'VIEW TIMETABLE', '127.0.0.1', '2018-07-03 21:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `es_videogallery`
--

CREATE TABLE `es_videogallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_voucher`
--

CREATE TABLE `es_voucher` (
  `es_voucherid` int(11) NOT NULL,
  `voucher_type` varchar(255) NOT NULL,
  `voucher_mode` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `es_voucherentry`
--

CREATE TABLE `es_voucherentry` (
  `es_voucherentryid` int(11) NOT NULL,
  `es_vouchertype` varchar(255) NOT NULL,
  `es_voucherno` varchar(255) NOT NULL,
  `es_voucherdate` date NOT NULL,
  `es_paymentmode` varchar(255) NOT NULL,
  `es_bankname_acc` varchar(255) NOT NULL,
  `es_ledger` varchar(255) NOT NULL,
  `es_amount_in` double NOT NULL,
  `es_amount_out` int(11) NOT NULL,
  `es_narration` varchar(1024) NOT NULL,
  `opposite_partyname` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_voucherentry`
--

INSERT INTO `es_voucherentry` (`es_voucherentryid`, `es_vouchertype`, `es_voucherno`, `es_voucherdate`, `es_paymentmode`, `es_bankname_acc`, `es_ledger`, `es_amount_in`, `es_amount_out`, `es_narration`, `opposite_partyname`) VALUES
(1, 'Receipt', '4', '2018-05-09', 'Bank', '', 'School Fees', 7250, 0, '', 'roat mihr ghanshyam');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(2) NOT NULL,
  `event_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `foundation_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `exam_type` varchar(20) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `exam_mark` int(11) NOT NULL,
  `status` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_marksheet`
--

CREATE TABLE `exam_marksheet` (
  `marksheet_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `student_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `exam_mark` int(2) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feereceipttransection`
--

CREATE TABLE `feereceipttransection` (
  `feereceipt_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quarter` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `remarks` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentstatus` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `selectionstatus` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fyear` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feestype`
--

CREATE TABLE `feestype` (
  `fesstype_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_series`
--

CREATE TABLE `fees_series` (
  `series_id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `pre_fix` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fees_type` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fees_series`
--

INSERT INTO `fees_series` (`series_id`, `section`, `pre_fix`, `fees_type`) VALUES
(1, 1, 'GUJ/INS/', 'INSTALLMENT - I@INSTALLMENT - II@INSTALLMENT - III@INSTALLMENT - IV@'),
(2, 1, 'GUJ/ADM/', 'ADMISSION FEES'),
(3, 2, 'ENG/INS/', 'INSTALLMENT - I@INSTALLMENT - II@INSTALLMENT - III@INSTALLMENT - IV@'),
(4, 2, 'ENG/ADM/', 'ADMISSION FEES');

-- --------------------------------------------------------

--
-- Table structure for table `fees_submission_dates`
--

CREATE TABLE `fees_submission_dates` (
  `fees_submission_dateid` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fees_submission_dates`
--

INSERT INTO `fees_submission_dates` (`fees_submission_dateid`, `academic_year_id`, `class_id`, `semester_id`, `from_date`, `to_date`) VALUES
(1, 3, 1, 9, '2018-05-20', '2018-06-03'),
(2, 3, 2, 9, '2018-05-20', '2018-06-03'),
(3, 3, 3, 9, '2018-05-20', '2018-06-03'),
(4, 3, 4, 9, '2018-05-20', '2018-06-03'),
(5, 3, 1, 10, '2018-08-20', '2018-09-03'),
(6, 3, 2, 10, '2018-08-20', '2018-09-03'),
(7, 3, 3, 10, '2018-08-20', '2018-09-03'),
(8, 3, 4, 10, '2018-08-20', '2018-09-03'),
(9, 3, 1, 11, '2018-11-20', '2018-12-03'),
(10, 3, 2, 11, '2018-11-20', '2018-12-03'),
(11, 3, 3, 11, '2018-11-20', '2018-12-03'),
(12, 3, 4, 11, '2018-11-20', '2018-12-03'),
(13, 3, 1, 12, '2019-02-20', '2019-03-03'),
(14, 3, 2, 12, '2019-02-20', '2019-03-03'),
(15, 3, 3, 12, '2019-02-20', '2019-03-03'),
(16, 3, 4, 12, '2019-02-20', '2019-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `fee_card_numbering`
--

CREATE TABLE `fee_card_numbering` (
  `fee_card_numbering_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `card_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fee_card_numbering`
--

INSERT INTO `fee_card_numbering` (`fee_card_numbering_id`, `academic_year_id`, `student_id`, `card_number`) VALUES
(1, 1, 293, 1),
(2, 1, 1, 2),
(3, 1, 9, 3),
(4, 3, 92, 1),
(5, 1, 0, 4),
(6, 1, 8, 5),
(7, 3, 94, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_fee_cards`
--

CREATE TABLE `fm_fee_cards` (
  `card_id` int(11) NOT NULL,
  `slip_no` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `card_date` date NOT NULL,
  `financemaster_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `semester_id` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `received_amount` int(11) NOT NULL,
  `concession` int(11) NOT NULL,
  `transportation_fees` int(11) NOT NULL,
  `transport_concession` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `not_applicable` int(11) NOT NULL,
  `receipt_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `bank_name` varchar(128) CHARACTER SET latin1 NOT NULL,
  `last_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_fee_cards`
--

INSERT INTO `fm_fee_cards` (`card_id`, `slip_no`, `es_preadmissionid`, `card_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `transportation_fees`, `transport_concession`, `grand_total`, `not_applicable`, `receipt_id`, `bank_name`, `last_date`) VALUES
(1, 1, 293, '2018-03-01', 1, 5, '1', 10500, 0, 0, 0, 10500, 0, NULL, 'AXIS BANK', '2017-06-30'),
(2, 2, 1, '2018-04-27', 1, 2, '2', 3250, 0, 0, 0, 3250, 1000, NULL, 'AXIS BANK', '2017-06-30'),
(3, 3, 9, '2018-04-28', 1, 3, '2', 3500, 0, 0, 0, 3500, 1000, NULL, 'AXIS BANK', '2017-06-30'),
(4, 1, 92, '2018-05-09', 3, 2, '9', 7250, 0, 3000, 0, 7250, 0, '1', 'AXIS BANK', '2017-06-30'),
(5, 4, 0, '2018-05-09', 1, 3, '2', 3500, 0, 0, 0, 3500, 1000, NULL, 'AXIS BANK', '2017-06-30'),
(6, 5, 8, '2018-05-09', 1, 3, '2', 3500, 0, 0, 0, 3500, 1000, NULL, 'AXIS BANK', '2017-06-30'),
(7, 2, 94, '2018-06-21', 3, 1, '9', 0, 0, 0, 0, 0, 1000, NULL, 'AXIS BANK', '2017-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `fm_fee_card_childs`
--

CREATE TABLE `fm_fee_card_childs` (
  `card_child_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `particular_id` int(11) NOT NULL,
  `particulars` varchar(255) CHARACTER SET latin1 NOT NULL,
  `amount` varchar(255) CHARACTER SET latin1 NOT NULL,
  `concession` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `applicable` enum('YES','NO') CHARACTER SET latin1 NOT NULL,
  `ledger_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fm_fee_card_childs`
--

INSERT INTO `fm_fee_card_childs` (`card_child_id`, `card_id`, `student_id`, `particular_id`, `particulars`, `amount`, `concession`, `total_amount`, `applicable`, `ledger_id`) VALUES
(1, 1, 293, 1, 'ADMISSION FEES', '1000', 0, 1000, 'YES', 1),
(2, 1, 293, 2, 'INSTALLMENT - I', '2375', 0, 2375, 'YES', 2),
(3, 1, 293, 3, 'INSTALLMENT - II', '2375', 0, 2375, 'YES', 2),
(4, 1, 293, 4, 'INSTALLMENT - III', '2375', 0, 2375, 'YES', 2),
(5, 1, 293, 5, 'INSTALLMENT - IV', '2375', 0, 2375, 'YES', 2),
(6, 2, 1, 6, 'ADMISSION FEES', '1000', 0, 1000, 'NO', 3),
(7, 2, 1, 7, 'SCHOOL FEES', '3250', 0, 3250, 'YES', 4),
(8, 3, 9, 11, 'ADMISSION FEES', '1000', 0, 1000, 'NO', 3),
(9, 3, 9, 12, 'SCHOOL FEES', '3500', 0, 3500, 'YES', 4),
(10, 4, 92, 32, 'Admission Fees', '1000', 0, 1000, 'YES', 5),
(11, 4, 92, 35, 'Tution Fees', '2750', 0, 2750, 'YES', 5),
(12, 4, 92, 36, 'Activity Fees', '300', 0, 300, 'YES', 5),
(13, 4, 92, 37, 'App Fee', '100', 0, 100, 'YES', 5),
(14, 4, 92, 38, 'Exam Fees', '100', 0, 100, 'YES', 5),
(15, 5, 0, 11, 'ADMISSION FEES', '1000', 0, 1000, 'NO', 3),
(16, 5, 0, 12, 'SCHOOL FEES', '3500', 0, 3500, 'YES', 4),
(17, 6, 8, 11, 'ADMISSION FEES', '1000', 0, 1000, 'NO', 3),
(18, 6, 8, 12, 'SCHOOL FEES', '3500', 0, 3500, 'YES', 4),
(19, 7, 94, 31, 'Admission Fees', '1000', 0, 1000, 'NO', 5);

-- --------------------------------------------------------

--
-- Table structure for table `foundations`
--

CREATE TABLE `foundations` (
  `foundation_id` int(11) NOT NULL,
  `foundation_name` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foundations`
--

INSERT INTO `foundations` (`foundation_id`, `foundation_name`) VALUES
(1, 'Sadhu Vaswani International School'),
(2, 'Gajwani Nursing College');

-- --------------------------------------------------------

--
-- Table structure for table `gardian`
--

CREATE TABLE `gardian` (
  `gardian_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `type_relation` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `maritalstatus` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupid` int(11) NOT NULL,
  `foundation_id` int(11) NOT NULL,
  `groupname` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupid`, `foundation_id`, `groupname`) VALUES
(1, 1, 'Team A'),
(2, 1, 'Team B');

-- --------------------------------------------------------

--
-- Table structure for table `him_administrator`
--

CREATE TABLE `him_administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `type` enum('super','admin') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_admission`
--

CREATE TABLE `him_admission` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_applyteacher`
--

CREATE TABLE `him_applyteacher` (
  `id` int(22) NOT NULL,
  `aname` varchar(222) NOT NULL,
  `fname` varchar(222) NOT NULL,
  `mname` varchar(222) NOT NULL,
  `resident` text NOT NULL,
  `postapplied` varchar(222) NOT NULL,
  `classes` varchar(222) NOT NULL,
  `teachingsub` text NOT NULL,
  `experience` text NOT NULL,
  `nameinstitue` varchar(222) NOT NULL,
  `hobbies` varchar(222) NOT NULL,
  `tellus` text NOT NULL,
  `salery` varchar(222) NOT NULL,
  `landlineno` varchar(222) NOT NULL,
  `mobileno` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `corrosponding` text NOT NULL,
  `photo` varchar(222) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `created_on` date NOT NULL,
  `downloadapp` varchar(222) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_cms`
--

CREATE TABLE `him_cms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `document1` varchar(255) NOT NULL,
  `document2` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `videocode` text NOT NULL,
  `back_ground_image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_country`
--

CREATE TABLE `him_country` (
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '1',
  `country_name` varchar(64) DEFAULT NULL,
  `country_3_code` char(3) DEFAULT NULL,
  `country_2_code` char(2) DEFAULT NULL,
  `country_flag` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_datasheet`
--

CREATE TABLE `him_datasheet` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_gallery`
--

CREATE TABLE `him_gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_settings`
--

CREATE TABLE `him_settings` (
  `id` int(11) NOT NULL,
  `constant_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `him_toppers`
--

CREATE TABLE `him_toppers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_on` date NOT NULL,
  `details` text NOT NULL,
  `select_front` enum('selected','notselected') NOT NULL DEFAULT 'notselected'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `histry_fm_cards`
--

CREATE TABLE `histry_fm_cards` (
  `card_id` int(11) NOT NULL,
  `slip_no` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `card_date` date NOT NULL,
  `financemaster_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `semester_id` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `received_amount` int(11) NOT NULL,
  `concession` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `not_applicable` int(11) NOT NULL,
  `receipt_id` varchar(11) DEFAULT NULL,
  `bank_name` varchar(128) NOT NULL,
  `last_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `isd_class_division`
--

CREATE TABLE `isd_class_division` (
  `class_division_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `division_name` varchar(8) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `isd_class_division`
--

INSERT INTO `isd_class_division` (`class_division_id`, `class_id`, `division_name`) VALUES
(1, 1, 'A'),
(2, 2, 'A'),
(3, 3, 'A'),
(4, 4, 'A'),
(5, 5, 'A'),
(6, 6, 'A'),
(7, 2, 'Div G'),
(9, 4, 'Div B');

-- --------------------------------------------------------

--
-- Table structure for table `isd_class_tests`
--

CREATE TABLE `isd_class_tests` (
  `class_test_id` int(11) NOT NULL,
  `class_test_date` date DEFAULT NULL,
  `academic_year_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `test_status` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `isd_class_test_marks`
--

CREATE TABLE `isd_class_test_marks` (
  `test_marks_id` int(11) NOT NULL,
  `class_test_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `scored_marks` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `item_inventory`
--

CREATE TABLE `item_inventory` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `item_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `more_info` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `group` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `uom` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `packing` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `item_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_entries`
--

CREATE TABLE `ledger_entries` (
  `ledger_entry_id` int(11) NOT NULL,
  `es_ledger_id` int(11) NOT NULL,
  `es_voucher_id` int(11) NOT NULL,
  `ledger_detail` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `amount_in` int(11) NOT NULL,
  `amount_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ledger_entries`
--

INSERT INTO `ledger_entries` (`ledger_entry_id`, `es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`, `amount_out`) VALUES
(1, 5, 1, 'Transportation Fees', 3000, 0),
(2, 5, 1, 'Admission Fees', 1000, 0),
(3, 5, 1, 'Tution Fees', 2750, 0),
(4, 5, 1, 'Activity Fees', 300, 0),
(5, 5, 1, 'App Fee', 100, 0),
(6, 5, 1, 'Exam Fees', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loginattempts`
--

CREATE TABLE `loginattempts` (
  `IP` varchar(20) DEFAULT NULL,
  `Attempts` int(11) DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `blocked_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_sessions`
--

CREATE TABLE `login_sessions` (
  `Login_Session_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Login_Time` datetime NOT NULL,
  `Logout_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_replies`
--

CREATE TABLE `maintenance_replies` (
  `reply_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `message` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_request`
--

CREATE TABLE `maintenance_request` (
  `req_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `problem` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_career`
--

CREATE TABLE `mlc_career` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_college`
--

CREATE TABLE `mlc_college` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_document`
--

CREATE TABLE `mlc_document` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_download`
--

CREATE TABLE `mlc_download` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_feedback`
--

CREATE TABLE `mlc_feedback` (
  `id` int(11) NOT NULL,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_homenews`
--

CREATE TABLE `mlc_homenews` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_news`
--

CREATE TABLE `mlc_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_newsletters`
--

CREATE TABLE `mlc_newsletters` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_desc` longtext NOT NULL,
  `news_doc` varchar(255) NOT NULL,
  `news_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_school_policies`
--

CREATE TABLE `mlc_school_policies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_subscribers`
--

CREATE TABLE `mlc_subscribers` (
  `subid` int(11) NOT NULL,
  `sub_email` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlc_yourcomment`
--

CREATE TABLE `mlc_yourcomment` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsupdate`
--

CREATE TABLE `newsupdate` (
  `news_id` int(2) NOT NULL,
  `news` varchar(1000) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `new_allowencemaster_childs`
--

CREATE TABLE `new_allowencemaster_childs` (
  `new_allowencemaster_child_id` int(11) NOT NULL,
  `es_allowencemasterid` int(11) NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `alw_amount` int(11) NOT NULL,
  `alw_amt_type` varchar(16) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `new_deductionmaster_childs`
--

CREATE TABLE `new_deductionmaster_childs` (
  `new_deductionmaster_child_id` int(11) NOT NULL,
  `es_deductionmasterid` int(11) NOT NULL,
  `es_staffid` int(11) NOT NULL,
  `ded_amount` int(11) NOT NULL,
  `ded_amt_type` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_payslip_childs`
--

CREATE TABLE `new_payslip_childs` (
  `payslip_child_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `type` varchar(20) CHARACTER SET latin1 NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_semesters`
--

CREATE TABLE `new_semesters` (
  `semester_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `new_semesters`
--

INSERT INTO `new_semesters` (`semester_id`, `academic_year_id`, `department_id`, `from_date`, `to_date`, `name`) VALUES
(1, 1, 1, '2017-04-01', '2017-06-30', 'QUATER 1'),
(2, 1, 2, '2017-04-01', '2017-06-30', 'QUATER 1'),
(3, 1, 1, '2017-07-01', '2017-09-30', 'QUATER 2'),
(4, 1, 2, '2017-07-01', '2017-09-30', 'QUATER 2'),
(5, 1, 1, '2017-10-01', '2017-12-31', 'QUATER 3'),
(6, 1, 2, '2017-10-01', '2017-12-31', 'QUATER 3'),
(7, 1, 1, '2018-01-01', '2018-03-31', 'QUATER 4'),
(8, 1, 2, '2018-01-01', '2018-03-31', 'QUATER 4'),
(9, 3, 2, '2018-04-01', '2018-06-30', 'QUATER 1'),
(10, 3, 2, '2018-07-01', '2018-09-30', 'QUATER 2'),
(11, 3, 2, '2018-10-01', '2018-12-31', 'QUATER 3'),
(12, 3, 2, '2019-01-01', '2019-03-31', 'QUATER 4');

-- --------------------------------------------------------

--
-- Table structure for table `new_survey`
--

CREATE TABLE `new_survey` (
  `survey_id` int(11) NOT NULL,
  `survey_title` varchar(500) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `actual_bonus` int(11) NOT NULL,
  `survey_bonus` int(11) NOT NULL,
  `survey_description` varchar(500) NOT NULL,
  `survey_standard` int(11) NOT NULL,
  `survey_division` int(11) NOT NULL,
  `survey_subject` int(11) NOT NULL,
  `survey_date` date NOT NULL,
  `survey_reviewer` int(11) NOT NULL,
  `survey_options_title` varchar(1000) NOT NULL,
  `survey_type` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `new_survey_child`
--

CREATE TABLE `new_survey_child` (
  `survey_child_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `option_title` varchar(100) NOT NULL,
  `option_description` varchar(100) NOT NULL,
  `rating` varchar(11) NOT NULL,
  `actual_rating` int(11) NOT NULL,
  `b_amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `new_survey_option`
--

CREATE TABLE `new_survey_option` (
  `option_id` int(11) NOT NULL,
  `option_title` varchar(100) NOT NULL,
  `class_id` varchar(128) NOT NULL,
  `options` varchar(1000) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_survey_option`
--

INSERT INTO `new_survey_option` (`option_id`, `option_title`, `class_id`, `options`, `type`) VALUES
(9, 'Test Score Improvement', '', '5', 1),
(10, 'Personal Development T/A', '', '15', 1),
(7, 'Homework Review', '', '10', 1),
(8, 'Test Prep Techniques', '', '5', 1),
(5, 'PPT + Video Clip', '', '20', 1),
(6, 'Other Teaching Aids', '', '5', 1),
(2, 'Class Control & Discipline', '', '10', 1),
(3, 'Team Development / Board Preparations', '', '10', 1),
(4, 'Positive Enforcements', '', '10', 1),
(1, 'Attitude & Energy Level', '', '10', 1),
(11, 'Attitude & Energy Level', '', '5', 2),
(12, 'Class Control & Discipline', '', '10', 2),
(13, 'Team Development', '', '5', 2),
(14, 'Positive Enforcements', '', '5', 2),
(15, 'PPT + Video Clip', '', '10', 2),
(16, 'Other Teaching Aids', '', '5', 2),
(17, 'Homework Review', '', '10', 2),
(18, 'Test Prep Techniques', '', '10', 2),
(19, 'Test Score Improvement', '', '20', 2),
(20, 'Personal Development T/A', '', '10', 2),
(28, 'Goal', '', '10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `new_survey_teacher_group`
--

CREATE TABLE `new_survey_teacher_group` (
  `id` int(11) NOT NULL,
  `head_teacher_id` int(11) NOT NULL,
  `teachers_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `new_survey_teacher_group`
--

INSERT INTO `new_survey_teacher_group` (`id`, `head_teacher_id`, `teachers_id`) VALUES
(1, 1, '78,6,11,15,35,30,32,31,50'),
(2, 35, '39,36,43,24,38,118'),
(3, 30, '42,37,92,22'),
(4, 78, '86,27,106,107'),
(5, 11, '10,101,102,21,4,114'),
(6, 32, '33,41,29'),
(7, 6, '3,96,98,112,115,64'),
(8, 15, '18,117,93,119,111'),
(9, 31, '48,88,89'),
(12, 50, '51,52,53,116');

-- --------------------------------------------------------

--
-- Table structure for table `new_taxmaster_childs`
--

CREATE TABLE `new_taxmaster_childs` (
  `new_taxmaster_child_id` int(11) NOT NULL,
  `es_taxmasterid` int(11) NOT NULL,
  `slab_from` int(11) NOT NULL,
  `slab_to` int(11) NOT NULL,
  `tax_rate` int(11) NOT NULL,
  `tax_type` varchar(16) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notice_replies`
--

CREATE TABLE `notice_replies` (
  `notice_repliyid` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `reply_message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reply_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(2) NOT NULL,
  `heading_name` varchar(25) NOT NULL,
  `notification` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

CREATE TABLE `photo_gallery` (
  `photo_galleryid` int(11) NOT NULL,
  `photo_gallery_date` date NOT NULL,
  `photo_gallery_name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `photo_gallery_description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`photo_galleryid`, `photo_gallery_date`, `photo_gallery_name`, `photo_gallery_description`) VALUES
(19, '2018-05-01', 'DEMO GALLERY', 'THIS IS JUST FOR TESTING PURPOSE');

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_images`
--

CREATE TABLE `photo_gallery_images` (
  `photo_gallery_imageid` int(11) NOT NULL,
  `photo_gallery_id` int(11) NOT NULL,
  `image_name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `image_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery_images`
--

INSERT INTO `photo_gallery_images` (`photo_gallery_imageid`, `photo_gallery_id`, `image_name`, `image_description`, `image_date`) VALUES
(19, 19, 'NATURE 1', 'THIS IS DESCRIPTION', '2018-05-01'),
(20, 19, 'NATURE 2', 'THIS IS DESCRIPTION', '2018-05-01'),
(21, 19, 'NATURE 3', 'THIS IS DESCRIPTION', '2018-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `pur_req_form_child`
--

CREATE TABLE `pur_req_form_child` (
  `pur_req_child_id` int(11) NOT NULL,
  `pur_req_id` int(11) NOT NULL,
  `item_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `item_desc` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `req_qty` double DEFAULT '1',
  `remarks` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` double DEFAULT '0',
  `amount` double DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pur_req_id`
--

CREATE TABLE `pur_req_id` (
  `pur_req_id` int(11) NOT NULL,
  `req_date` date DEFAULT '0000-00-00',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `priority` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `shipto` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `main_remarks` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'PENDING',
  `hod_app_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'PENDING',
  `hod_app_date` date DEFAULT '0000-00-00',
  `pur_dept_app_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'PENDING',
  `pur_dept_app_date` date DEFAULT '0000-00-00',
  `pur_order_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `pur_order_date` date DEFAULT '0000-00-00',
  `inv_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `inv_date` date DEFAULT '0000-00-00',
  `inv_verified_by` varchar(150) COLLATE utf8_unicode_ci DEFAULT '0000-00-00',
  `payment_app_one` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `payment_app_two` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `payment_mode` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `payment_date` date DEFAULT '0000-00-00',
  `payment_ref_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `pur_req_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `reg_ID` int(11) NOT NULL,
  `degree` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stream` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_university` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` double DEFAULT NULL,
  `pass_year` date DEFAULT NULL,
  `teacher_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `ac_year` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `remarks` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `next_class` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result_layouts`
--

CREATE TABLE `result_layouts` (
  `result_layout_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `layouts` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smsconfig`
--

CREATE TABLE `smsconfig` (
  `configid` int(11) NOT NULL,
  `sms_api_url` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smsconfig`
--

INSERT INTO `smsconfig` (`configid`, `sms_api_url`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE `standard` (
  `standard_id` int(11) NOT NULL,
  `foundation_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `totstrength` int(11) DEFAULT '0',
  `stuseventyperauto` int(11) DEFAULT '0',
  `stuthirtyperauto` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `foundation_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `student_fname` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `student_dob` date DEFAULT '2000-01-01',
  `student_pob` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `student_gender` varchar(6) COLLATE utf8_unicode_ci DEFAULT '',
  `student_nationality` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `student_religion` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `student_caste` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `student_subcaste` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `student_identityficationmark` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `student_bloodgroup` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `studetnt_height` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0''.0"',
  `student_weight` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0 KG',
  `student_resaddress` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `student_age` varchar(4) COLLATE utf8_unicode_ci DEFAULT '',
  `student_timestamp` date DEFAULT '2016-01-01',
  `student_lname` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `student_mobil` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `student_remarks` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `fathername` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `mothername` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `send_sms` varchar(3) COLLATE utf8_unicode_ci DEFAULT '',
  `gr_no` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uid` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `groupid` int(11) NOT NULL DEFAULT '1',
  `stnameauto` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `groupname` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `classrollno` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `section` varchar(50) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_activities`
--

CREATE TABLE `student_activities` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `order_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_activity_grades`
--

CREATE TABLE `student_activity_grades` (
  `student_activity_gradesid` int(11) NOT NULL,
  `student_activtiy_examid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_activtiy_exam`
--

CREATE TABLE `student_activtiy_exam` (
  `student_activtiy_examid` int(11) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `status` enum('Pending','Submitted','Finalised') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `submitted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `attendance_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `standard_id` int(4) NOT NULL,
  `division_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`attendance_id`, `academic_year_id`, `attendance_date`, `standard_id`, `division_id`, `teacher_id`) VALUES
(1, 1, '2018-03-17', 4, 4, 3),
(2, 1, '2018-03-17', 4, 4, 3),
(3, 1, '2018-03-17', 4, 4, 3),
(4, 1, '2018-03-17', 4, 4, 3),
(5, 1, '2018-04-14', 2, 2, 5),
(6, 1, '2018-04-14', 5, 5, 1),
(7, 1, '2018-04-14', 5, 5, 5),
(8, 1, '2018-05-09', 3, 3, 4),
(9, 3, '2018-06-16', 3, 3, 5),
(10, 3, '2018-06-19', 3, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `student_violation`
--

CREATE TABLE `student_violation` (
  `student_violationid` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `es_classesid` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `es_preadmissionid` int(11) NOT NULL,
  `violation_date` date DEFAULT NULL,
  `violation_time` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `violation_type` enum('DRESS-CODE VIOLATION','TARDINESS VIOLATION','ABSENTEE VIOLATION','BAD BEHAVIOR VIOLATION') COLLATE utf8_unicode_ci NOT NULL,
  `violation_level` enum('LEVEL 1','LEVEL 2','LEVEL 3') COLLATE utf8_unicode_ci NOT NULL,
  `violation_remarks` longtext COLLATE utf8_unicode_ci NOT NULL,
  `violation_file` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `violation_status` enum('PENDING','APPROVED') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PENDING',
  `violation_submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects_cat`
--

CREATE TABLE `subjects_cat` (
  `scat_id` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `scat_name` varchar(255) NOT NULL,
  `subject_id_array` varchar(255) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `supplier_payment_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `payment_mode` enum('Cash','Cheque','Online Payment','Bank Deposit','DD Payment') COLLATE utf8_unicode_ci NOT NULL,
  `cheque_no` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cheque_date` date NOT NULL,
  `ac_payee_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_no` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `online_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `transection_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiary_code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_bank` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `suppllier_account_no` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_account_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `deposit_slip_no` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `dd_no` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment_child`
--

CREATE TABLE `supplier_payment_child` (
  `supplier_payment_child_id` int(11) NOT NULL,
  `supplier_payment_id` int(11) NOT NULL,
  `grn_id` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_setup`
--

CREATE TABLE `tbl_sms_setup` (
  `tbl_sms_setup_id` int(11) NOT NULL,
  `tbl_sms_api_link` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `sms_setup_user_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sms_setup_password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sms_setup_senderid` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sms_setup_priority` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sms_setup_type` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_to_student`
--

CREATE TABLE `tbl_sms_to_student` (
  `tbl_sms_to_student_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message_datetime` datetime NOT NULL,
  `message` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `response` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_leave_request`
--

CREATE TABLE `teacher_leave_request` (
  `request_id` int(4) NOT NULL,
  `apply_date` date NOT NULL,
  `teacherid` int(3) NOT NULL,
  `teacher_name` varchar(250) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `priority` varchar(15) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_planner`
--

CREATE TABLE `teacher_planner` (
  `teacher_plannerid` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `planner_remarks` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `teacher_planner`
--

INSERT INTO `teacher_planner` (`teacher_plannerid`, `academic_year_id`, `teacher_id`, `class_id`, `division_id`, `subject_id`, `planner_remarks`) VALUES
(14, 1, 5, 2, 2, 1, 'THIS IS FOR TESTING PURPOSE.'),
(16, 3, 3, 3, 3, 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_planner_descriptions`
--

CREATE TABLE `teacher_planner_descriptions` (
  `teacher_planner_descriptionid` int(11) NOT NULL,
  `teacher_planner_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `plan_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `task_status` enum('pending','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `task_completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher_planner_descriptions`
--

INSERT INTO `teacher_planner_descriptions` (`teacher_planner_descriptionid`, `teacher_planner_id`, `from_date`, `to_date`, `plan_description`, `task_status`, `task_completion_date`) VALUES
(61, 14, '2018-05-01', '2018-05-15', 'CHAPTER 1', 'completed', '2018-05-01'),
(62, 14, '2018-05-15', '2018-05-31', 'CHAPTER 2', 'pending', NULL),
(63, 14, '2018-05-31', '2018-06-15', 'CHAPTER 3', 'pending', NULL),
(64, 15, '2018-06-04', '2018-06-09', 'Write A to H letter in cursive.', 'pending', NULL),
(65, 16, '2018-06-04', '2018-06-04', 'Teach alphabets A- D', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_register`
--

CREATE TABLE `teacher_register` (
  `reg_ID` int(11) NOT NULL,
  `foundation_id` int(11) NOT NULL,
  `fname` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `lname` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `city` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `state` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `country` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `postal_code` varchar(6) COLLATE utf8_unicode_ci DEFAULT '',
  `father_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `mother_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `dob` date DEFAULT '1971-01-01',
  `doj` date DEFAULT '2010-01-01',
  `degisnation` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `salary_amt` double DEFAULT '0',
  `total_deduction` double DEFAULT '0',
  `total_pay` double DEFAULT '0',
  `notice` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `bankaccountname` varchar(60) COLLATE utf8_unicode_ci DEFAULT '',
  `bankaccountno` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `bankname` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `bankbranch` varchar(40) COLLATE utf8_unicode_ci DEFAULT '',
  `bankifsccode` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `account_allocation` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_period`
--

CREATE TABLE `time_period` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `from_p` varchar(255) NOT NULL,
  `to_p` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transectionentry`
--

CREATE TABLE `transectionentry` (
  `trans_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `description` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `tran_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_pickup_points`
--

CREATE TABLE `transport_pickup_points` (
  `tr_place_id` int(11) NOT NULL,
  `pickuppoint_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `annual_charges` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `transport_pickup_points`
--

INSERT INTO `transport_pickup_points` (`tr_place_id`, `pickuppoint_name`, `annual_charges`, `academic_id`, `ledger_id`, `created_on`) VALUES
(3, 'gandhidham', 12000, 3, 5, '2018-05-09'),
(4, 'baroi', 3000, 1, 1, '2018-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `transport_student_allocation`
--

CREATE TABLE `transport_student_allocation` (
  `transport_student_allocation_id` int(11) NOT NULL,
  `acdemic_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `pickup_point_id` int(11) NOT NULL,
  `payble_charges` int(11) NOT NULL,
  `received_amount` int(11) NOT NULL,
  `concession` int(11) NOT NULL,
  `actual_received` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transport_student_allocation`
--

INSERT INTO `transport_student_allocation` (`transport_student_allocation_id`, `acdemic_year_id`, `student_id`, `pickup_point_id`, `payble_charges`, `received_amount`, `concession`, `actual_received`, `ledger_id`) VALUES
(1, 3, 92, 3, 12000, 3000, 0, 3000, 5),
(2, 1, 1, 4, 3000, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_Image` blob,
  `User_First_Name` varchar(50) DEFAULT NULL,
  `User_Last_Name` varchar(50) DEFAULT NULL,
  `User_Username` varchar(15) DEFAULT NULL,
  `User_Usertype` varchar(1) DEFAULT NULL,
  `User_Birthdate` date DEFAULT NULL,
  `User_Gender` varchar(6) DEFAULT NULL,
  `User_Contact_No` bigint(20) DEFAULT NULL,
  `User_Email` varchar(100) DEFAULT NULL,
  `User_Password` varchar(15) DEFAULT NULL,
  `User_SQ` varchar(150) DEFAULT NULL,
  `User_SA` varchar(20) DEFAULT NULL,
  `User_Editor` varchar(15) DEFAULT NULL,
  `User_Created_Date` datetime DEFAULT NULL,
  `User_Last_Modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `User_Rights` varchar(200) DEFAULT NULL,
  `CompanyName` varchar(250) DEFAULT NULL,
  `CompanyID` varchar(10) DEFAULT NULL,
  `CompanyAddress` varchar(250) DEFAULT NULL,
  `BranchID` varchar(10) DEFAULT NULL,
  `BranchAddress` varchar(250) DEFAULT NULL,
  `BranchName` varchar(250) DEFAULT NULL,
  `YearID` varchar(5) DEFAULT NULL,
  `CurrentYear` varchar(10) DEFAULT NULL,
  `BGONE` varchar(1) DEFAULT NULL,
  `SGONE` varchar(1) DEFAULT NULL,
  `BGTWO` varchar(1) DEFAULT NULL,
  `SGTWO` varchar(1) DEFAULT NULL,
  `BGTHR` varchar(1) DEFAULT NULL,
  `SGTHR` varchar(1) DEFAULT NULL,
  `BGFOU` varchar(1) DEFAULT NULL,
  `SGFOU` varchar(1) DEFAULT NULL,
  `BGFIV` varchar(1) DEFAULT NULL,
  `SGFIV` varchar(1) DEFAULT NULL,
  `BGSIX` varchar(1) DEFAULT NULL,
  `SGSIX` varchar(1) DEFAULT NULL,
  `BGSEV` varchar(1) DEFAULT NULL,
  `SGSEV` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_Image`, `User_First_Name`, `User_Last_Name`, `User_Username`, `User_Usertype`, `User_Birthdate`, `User_Gender`, `User_Contact_No`, `User_Email`, `User_Password`, `User_SQ`, `User_SA`, `User_Editor`, `User_Created_Date`, `User_Last_Modified`, `User_Rights`, `CompanyName`, `CompanyID`, `CompanyAddress`, `BranchID`, `BranchAddress`, `BranchName`, `YearID`, `CurrentYear`, `BGONE`, `SGONE`, `BGTWO`, `SGTWO`, `BGTHR`, `SGTHR`, `BGFOU`, `SGFOU`, `BGFIV`, `SGFIV`, `BGSIX`, `SGSIX`, `BGSEV`, `SGSEV`) VALUES
(1, NULL, 'Admin', 'User', 'admin', 'A', '1991-12-23', 'Female', 9979994369, 'hardikmanglani@gmail.com', 'admin95/', 'What is your Mother''s Maiden name?', 'xyz', 'Self', '2016-07-01 00:00:00', '2016-07-09 07:00:02', 'Everything', 'Gajawani School', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'Clerk', 'User', 'clerk', 'B', '1991-12-23', 'Male', 9876543210, 'p@p.com', '123456', 'What is your Mother''s Maiden name?', 'xyz', 'Self', '2016-07-01 00:00:00', '2016-07-09 07:00:10', 'Limited', 'Gajwani School', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'Clerk2', 'user', 'clerk2', 'B', '2001-12-12', 'Male', 9874563210, 'p@p.com', '123456', 'What is your favorite book name?', '123456', NULL, '2016-07-04 00:00:00', '2016-07-09 07:00:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 'Official', 'Official', 'official', 'B', '2001-12-12', 'Male', 9874563210, 'p@p.com', '123456', 'What is your favorite book name?', '123456', NULL, '2016-07-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Official Staff Manager', 'Manager', 'manager', 'C', '2001-12-12', 'Male', 9874563210, 'p@p.com', '123456', 'What is your favorite book name?', '123456', NULL, '2016-07-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'HOD', 'hod', 'hod', 'D', '2001-12-12', 'Male', 9638527410, 'p@p.com', '123456', 'What is your favorite book name?', '123456', NULL, '2016-07-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'purchase', 'purchase', 'purchase', 'E', '2001-12-12', 'Male', 8527419630, 'p@p.com', '123456', 'What is your favorite book name?', '123456', NULL, '2016-07-09 00:00:00', '2016-07-12 09:33:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucherhead`
--

CREATE TABLE `voucherhead` (
  `voucher_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addmission`
--
ALTER TABLE `addmission`
  ADD PRIMARY KEY (`add_id`),
  ADD KEY `standard_id` (`standard_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fesstype_id` (`fesstype_id`);

--
-- Indexes for table `attendancesheet`
--
ALTER TABLE `attendancesheet`
  ADD PRIMARY KEY (`attendance_key`),
  ADD KEY `attendance_id` (`attendance_id`,`studentid`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`att_ID`),
  ADD KEY `ref_ID` (`ref_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `childfeereceipt`
--
ALTER TABLE `childfeereceipt`
  ADD PRIMARY KEY (`childfee_id`),
  ADD KEY `feereceipt_id` (`feereceipt_id`),
  ADD KEY `pen_id` (`pen_id`);

--
-- Indexes for table `devise_user_details`
--
ALTER TABLE `devise_user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `foundation_id` (`foundation_id`);

--
-- Indexes for table `es_addon_modules`
--
ALTER TABLE `es_addon_modules`
  ADD PRIMARY KEY (`addon_id`);

--
-- Indexes for table `es_admins`
--
ALTER TABLE `es_admins`
  ADD PRIMARY KEY (`es_adminsid`);

--
-- Indexes for table `es_allowencemaster`
--
ALTER TABLE `es_allowencemaster`
  ADD PRIMARY KEY (`es_allowencemasterid`);

--
-- Indexes for table `es_assignment`
--
ALTER TABLE `es_assignment`
  ADD PRIMARY KEY (`es_assignmentid`);

--
-- Indexes for table `es_attemptcerti`
--
ALTER TABLE `es_attemptcerti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_attend_staff`
--
ALTER TABLE `es_attend_staff`
  ADD PRIMARY KEY (`es_attend_staffid`);

--
-- Indexes for table `es_attend_student`
--
ALTER TABLE `es_attend_student`
  ADD PRIMARY KEY (`es_attend_studentid`);

--
-- Indexes for table `es_bonafied`
--
ALTER TABLE `es_bonafied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_bookissue`
--
ALTER TABLE `es_bookissue`
  ADD PRIMARY KEY (`es_bookissueid`);

--
-- Indexes for table `es_booklets`
--
ALTER TABLE `es_booklets`
  ADD PRIMARY KEY (`booklet_id`);

--
-- Indexes for table `es_bookreturns`
--
ALTER TABLE `es_bookreturns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_book_reservation`
--
ALTER TABLE `es_book_reservation`
  ADD PRIMARY KEY (`reserv_id`);

--
-- Indexes for table `es_candidate`
--
ALTER TABLE `es_candidate`
  ADD PRIMARY KEY (`es_candidateid`);

--
-- Indexes for table `es_caste`
--
ALTER TABLE `es_caste`
  ADD PRIMARY KEY (`caste_id`);

--
-- Indexes for table `es_categorylibrary`
--
ALTER TABLE `es_categorylibrary`
  ADD PRIMARY KEY (`es_categorylibraryid`);

--
-- Indexes for table `es_chapters`
--
ALTER TABLE `es_chapters`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `es_charcerti`
--
ALTER TABLE `es_charcerti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_classes`
--
ALTER TABLE `es_classes`
  ADD PRIMARY KEY (`es_classesid`);

--
-- Indexes for table `es_classifieds`
--
ALTER TABLE `es_classifieds`
  ADD PRIMARY KEY (`es_classifiedsid`);

--
-- Indexes for table `es_deductionmaster`
--
ALTER TABLE `es_deductionmaster`
  ADD PRIMARY KEY (`es_deductionmasterid`);

--
-- Indexes for table `es_departments`
--
ALTER TABLE `es_departments`
  ADD PRIMARY KEY (`es_departmentsid`);

--
-- Indexes for table `es_deptposts`
--
ALTER TABLE `es_deptposts`
  ADD PRIMARY KEY (`es_deptpostsid`);

--
-- Indexes for table `es_dispatch`
--
ALTER TABLE `es_dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_dispatch_entry`
--
ALTER TABLE `es_dispatch_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_division`
--
ALTER TABLE `es_division`
  ADD PRIMARY KEY (`es_divisionid`);

--
-- Indexes for table `es_eligibilitycerti`
--
ALTER TABLE `es_eligibilitycerti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_enquiry`
--
ALTER TABLE `es_enquiry`
  ADD PRIMARY KEY (`es_enquiryid`);

--
-- Indexes for table `es_exam`
--
ALTER TABLE `es_exam`
  ADD PRIMARY KEY (`es_examid`);

--
-- Indexes for table `es_examfee`
--
ALTER TABLE `es_examfee`
  ADD PRIMARY KEY (`exam_fee_id`);

--
-- Indexes for table `es_exam_academic`
--
ALTER TABLE `es_exam_academic`
  ADD PRIMARY KEY (`es_exam_academicid`);

--
-- Indexes for table `es_exam_details`
--
ALTER TABLE `es_exam_details`
  ADD PRIMARY KEY (`es_exam_detailsid`);

--
-- Indexes for table `es_expcerti`
--
ALTER TABLE `es_expcerti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_fa_groups`
--
ALTER TABLE `es_fa_groups`
  ADD PRIMARY KEY (`es_fa_groupsid`);

--
-- Indexes for table `es_feemaster`
--
ALTER TABLE `es_feemaster`
  ADD PRIMARY KEY (`es_feemasterid`);

--
-- Indexes for table `es_feepaid`
--
ALTER TABLE `es_feepaid`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `es_feepaid_new_details`
--
ALTER TABLE `es_feepaid_new_details`
  ADD PRIMARY KEY (`fp_det_id`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `es_feesnotice`
--
ALTER TABLE `es_feesnotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_fee_inst_last_date`
--
ALTER TABLE `es_fee_inst_last_date`
  ADD PRIMARY KEY (`inst_id`);

--
-- Indexes for table `es_finance_master`
--
ALTER TABLE `es_finance_master`
  ADD PRIMARY KEY (`es_finance_masterid`);

--
-- Indexes for table `es_fine_charged_collected`
--
ALTER TABLE `es_fine_charged_collected`
  ADD PRIMARY KEY (`es_fcc_id`);

--
-- Indexes for table `es_fine_master`
--
ALTER TABLE `es_fine_master`
  ADD PRIMARY KEY (`es_fine_masterid`);

--
-- Indexes for table `es_groups`
--
ALTER TABLE `es_groups`
  ADD PRIMARY KEY (`es_groupsid`);

--
-- Indexes for table `es_holidaynoti`
--
ALTER TABLE `es_holidaynoti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_holidays`
--
ALTER TABLE `es_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_hostelbuld`
--
ALTER TABLE `es_hostelbuld`
  ADD PRIMARY KEY (`es_hostelbuldid`);

--
-- Indexes for table `es_hostelperson_item`
--
ALTER TABLE `es_hostelperson_item`
  ADD PRIMARY KEY (`es_hostelperson_itemid`);

--
-- Indexes for table `es_hostelroom`
--
ALTER TABLE `es_hostelroom`
  ADD PRIMARY KEY (`es_hostelroomid`);

--
-- Indexes for table `es_hostel_charges`
--
ALTER TABLE `es_hostel_charges`
  ADD PRIMARY KEY (`es_hostel_charges_id`);

--
-- Indexes for table `es_hostel_health`
--
ALTER TABLE `es_hostel_health`
  ADD PRIMARY KEY (`es_hostel_healthid`);

--
-- Indexes for table `es_idcard_image`
--
ALTER TABLE `es_idcard_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_incharge`
--
ALTER TABLE `es_incharge`
  ADD PRIMARY KEY (`incharge_id`);

--
-- Indexes for table `es_institutes`
--
ALTER TABLE `es_institutes`
  ADD PRIMARY KEY (`inst_id`);

--
-- Indexes for table `es_inventory`
--
ALTER TABLE `es_inventory`
  ADD PRIMARY KEY (`es_inventoryid`);

--
-- Indexes for table `es_in_category`
--
ALTER TABLE `es_in_category`
  ADD PRIMARY KEY (`es_in_categoryid`);

--
-- Indexes for table `es_in_goods_issue`
--
ALTER TABLE `es_in_goods_issue`
  ADD PRIMARY KEY (`es_in_goods_issueid`);

--
-- Indexes for table `es_in_goods_issue_items`
--
ALTER TABLE `es_in_goods_issue_items`
  ADD PRIMARY KEY (`es_in_goods_issue_item_id`);

--
-- Indexes for table `es_in_goods_issue_requests`
--
ALTER TABLE `es_in_goods_issue_requests`
  ADD PRIMARY KEY (`es_in_goods_issueid`);

--
-- Indexes for table `es_in_goods_issue_request_items`
--
ALTER TABLE `es_in_goods_issue_request_items`
  ADD PRIMARY KEY (`es_in_goods_issue_item_id`);

--
-- Indexes for table `es_in_goods_receipt_note`
--
ALTER TABLE `es_in_goods_receipt_note`
  ADD PRIMARY KEY (`grn_id`);

--
-- Indexes for table `es_in_goods_receipt_note_items`
--
ALTER TABLE `es_in_goods_receipt_note_items`
  ADD PRIMARY KEY (`es_in_goods_receipt_note_itemsid`);

--
-- Indexes for table `es_in_item_master`
--
ALTER TABLE `es_in_item_master`
  ADD PRIMARY KEY (`es_in_item_masterid`);

--
-- Indexes for table `es_in_orders`
--
ALTER TABLE `es_in_orders`
  ADD PRIMARY KEY (`es_in_ordersid`);

--
-- Indexes for table `es_in_orders_items`
--
ALTER TABLE `es_in_orders_items`
  ADD PRIMARY KEY (`es_order_item_id`);

--
-- Indexes for table `es_in_quotation_requests`
--
ALTER TABLE `es_in_quotation_requests`
  ADD PRIMARY KEY (`rfq_id`);

--
-- Indexes for table `es_in_supplier_master`
--
ALTER TABLE `es_in_supplier_master`
  ADD PRIMARY KEY (`es_in_supplier_masterid`);

--
-- Indexes for table `es_issueloan`
--
ALTER TABLE `es_issueloan`
  ADD PRIMARY KEY (`es_issueloanid`);

--
-- Indexes for table `es_knowledge_articles`
--
ALTER TABLE `es_knowledge_articles`
  ADD PRIMARY KEY (`es_knowledge_articlesid`);

--
-- Indexes for table `es_knowledge_base`
--
ALTER TABLE `es_knowledge_base`
  ADD PRIMARY KEY (`es_knowledge_baseid`);

--
-- Indexes for table `es_leavemaster`
--
ALTER TABLE `es_leavemaster`
  ADD PRIMARY KEY (`es_leavemasterid`);

--
-- Indexes for table `es_leave_request`
--
ALTER TABLE `es_leave_request`
  ADD PRIMARY KEY (`es_leave_request_id`);

--
-- Indexes for table `es_ledger`
--
ALTER TABLE `es_ledger`
  ADD PRIMARY KEY (`es_ledgerid`);

--
-- Indexes for table `es_libaraypublisher`
--
ALTER TABLE `es_libaraypublisher`
  ADD PRIMARY KEY (`es_libaraypublisherid`);

--
-- Indexes for table `es_libbook`
--
ALTER TABLE `es_libbook`
  ADD PRIMARY KEY (`es_libbookid`);

--
-- Indexes for table `es_libbookfinedet`
--
ALTER TABLE `es_libbookfinedet`
  ADD PRIMARY KEY (`es_libbookfinedetid`);

--
-- Indexes for table `es_libfine`
--
ALTER TABLE `es_libfine`
  ADD PRIMARY KEY (`es_libfineid`);

--
-- Indexes for table `es_loanmaster`
--
ALTER TABLE `es_loanmaster`
  ADD PRIMARY KEY (`es_loanmasterid`);

--
-- Indexes for table `es_loanpayment`
--
ALTER TABLE `es_loanpayment`
  ADD PRIMARY KEY (`es_loanpaymentid`);

--
-- Indexes for table `es_marks`
--
ALTER TABLE `es_marks`
  ADD PRIMARY KEY (`es_marksid`);

--
-- Indexes for table `es_mcq_questions`
--
ALTER TABLE `es_mcq_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `es_mcq_result`
--
ALTER TABLE `es_mcq_result`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `es_mcq_test`
--
ALTER TABLE `es_mcq_test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `es_messages`
--
ALTER TABLE `es_messages`
  ADD PRIMARY KEY (`es_messagesid`);

--
-- Indexes for table `es_message_documents`
--
ALTER TABLE `es_message_documents`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `es_modules_alloted`
--
ALTER TABLE `es_modules_alloted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_new_timetable`
--
ALTER TABLE `es_new_timetable`
  ADD PRIMARY KEY (`new_time_id`);

--
-- Indexes for table `es_notice`
--
ALTER TABLE `es_notice`
  ADD PRIMARY KEY (`es_noticeid`);

--
-- Indexes for table `es_notice_messages`
--
ALTER TABLE `es_notice_messages`
  ADD PRIMARY KEY (`es_messagesid`);

--
-- Indexes for table `es_offerletter`
--
ALTER TABLE `es_offerletter`
  ADD PRIMARY KEY (`es_offerletterid`);

--
-- Indexes for table `es_old_balances`
--
ALTER TABLE `es_old_balances`
  ADD PRIMARY KEY (`ob_id`);

--
-- Indexes for table `es_old_balances_paid`
--
ALTER TABLE `es_old_balances_paid`
  ADD PRIMARY KEY (`obp_id`);

--
-- Indexes for table `es_otherletter_formats`
--
ALTER TABLE `es_otherletter_formats`
  ADD PRIMARY KEY (`letter_id`);

--
-- Indexes for table `es_other_fine_dettails`
--
ALTER TABLE `es_other_fine_dettails`
  ADD PRIMARY KEY (`otherfine_id`);

--
-- Indexes for table `es_payslipdetails`
--
ALTER TABLE `es_payslipdetails`
  ADD PRIMARY KEY (`es_payslipdetailsid`);

--
-- Indexes for table `es_pfmaster`
--
ALTER TABLE `es_pfmaster`
  ADD PRIMARY KEY (`es_pfmasterid`);

--
-- Indexes for table `es_photogallery`
--
ALTER TABLE `es_photogallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_preadmission`
--
ALTER TABLE `es_preadmission`
  ADD PRIMARY KEY (`es_preadmissionid`);

--
-- Indexes for table `es_preadmission_details`
--
ALTER TABLE `es_preadmission_details`
  ADD PRIMARY KEY (`es_preadmission_detailsid`),
  ADD KEY `es_preadmissionid` (`es_preadmissionid`);

--
-- Indexes for table `es_questionbank`
--
ALTER TABLE `es_questionbank`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `es_requirement`
--
ALTER TABLE `es_requirement`
  ADD PRIMARY KEY (`es_requirementid`);

--
-- Indexes for table `es_resignation`
--
ALTER TABLE `es_resignation`
  ADD PRIMARY KEY (`es_resignationid`);

--
-- Indexes for table `es_roomallotment`
--
ALTER TABLE `es_roomallotment`
  ADD PRIMARY KEY (`es_roomallotmentid`);

--
-- Indexes for table `es_schools`
--
ALTER TABLE `es_schools`
  ADD PRIMARY KEY (`Sr.No.`);

--
-- Indexes for table `es_sections`
--
ALTER TABLE `es_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `es_sections_student`
--
ALTER TABLE `es_sections_student`
  ADD PRIMARY KEY (`section_student_id`);

--
-- Indexes for table `es_security`
--
ALTER TABLE `es_security`
  ADD PRIMARY KEY (`es_securityid`);

--
-- Indexes for table `es_shortlisted`
--
ALTER TABLE `es_shortlisted`
  ADD PRIMARY KEY (`es_shortlistedid`);

--
-- Indexes for table `es_staff`
--
ALTER TABLE `es_staff`
  ADD PRIMARY KEY (`es_staffid`);

--
-- Indexes for table `es_stationary`
--
ALTER TABLE `es_stationary`
  ADD PRIMARY KEY (`stationary_id`);

--
-- Indexes for table `es_stationary_payment`
--
ALTER TABLE `es_stationary_payment`
  ADD PRIMARY KEY (`st_pay_id`);

--
-- Indexes for table `es_studentabsentnoti`
--
ALTER TABLE `es_studentabsentnoti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_studymaterial`
--
ALTER TABLE `es_studymaterial`
  ADD PRIMARY KEY (`es_studymaterialid`);

--
-- Indexes for table `es_subcategory`
--
ALTER TABLE `es_subcategory`
  ADD PRIMARY KEY (`es_subcategoryid`);

--
-- Indexes for table `es_subject`
--
ALTER TABLE `es_subject`
  ADD PRIMARY KEY (`es_subjectid`);

--
-- Indexes for table `es_taxmaster`
--
ALTER TABLE `es_taxmaster`
  ADD PRIMARY KEY (`es_taxmasterid`);

--
-- Indexes for table `es_tcmaster`
--
ALTER TABLE `es_tcmaster`
  ADD PRIMARY KEY (`es_tcmasterid`);

--
-- Indexes for table `es_tcstudent`
--
ALTER TABLE `es_tcstudent`
  ADD PRIMARY KEY (`es_tcstudentid`);

--
-- Indexes for table `es_timetable`
--
ALTER TABLE `es_timetable`
  ADD PRIMARY KEY (`es_timetableid`);

--
-- Indexes for table `es_timetablemaster`
--
ALTER TABLE `es_timetablemaster`
  ADD PRIMARY KEY (`es_timetablemasterid`);

--
-- Indexes for table `es_timetable_staff`
--
ALTER TABLE `es_timetable_staff`
  ADD PRIMARY KEY (`es_st_id`);

--
-- Indexes for table `es_timetable_subject`
--
ALTER TABLE `es_timetable_subject`
  ADD PRIMARY KEY (`es_sub_id`);

--
-- Indexes for table `es_timetable_subjects`
--
ALTER TABLE `es_timetable_subjects`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `es_tips`
--
ALTER TABLE `es_tips`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `es_transferstudent`
--
ALTER TABLE `es_transferstudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_translist`
--
ALTER TABLE `es_translist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_transport`
--
ALTER TABLE `es_transport`
  ADD PRIMARY KEY (`es_transportid`);

--
-- Indexes for table `es_transport_allots`
--
ALTER TABLE `es_transport_allots`
  ADD PRIMARY KEY (`driver_allot_id`);

--
-- Indexes for table `es_transport_drivers`
--
ALTER TABLE `es_transport_drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `es_transport_maintenance`
--
ALTER TABLE `es_transport_maintenance`
  ADD PRIMARY KEY (`es_transport_maintenanceid`);

--
-- Indexes for table `es_transport_places`
--
ALTER TABLE `es_transport_places`
  ADD PRIMARY KEY (`tr_place_id`);

--
-- Indexes for table `es_trans_board`
--
ALTER TABLE `es_trans_board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_board_allocation_to_student`
--
ALTER TABLE `es_trans_board_allocation_to_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_driver_allocation_to_vehicle`
--
ALTER TABLE `es_trans_driver_allocation_to_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_driver_details`
--
ALTER TABLE `es_trans_driver_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_fee_details`
--
ALTER TABLE `es_trans_fee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_maintenance`
--
ALTER TABLE `es_trans_maintenance`
  ADD PRIMARY KEY (`es_transport_maintenanceid`);

--
-- Indexes for table `es_trans_payment_history`
--
ALTER TABLE `es_trans_payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_route`
--
ALTER TABLE `es_trans_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_trans_vehicle`
--
ALTER TABLE `es_trans_vehicle`
  ADD PRIMARY KEY (`es_transportid`);

--
-- Indexes for table `es_trans_vehicle_allocation_to_board`
--
ALTER TABLE `es_trans_vehicle_allocation_to_board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_tutorials`
--
ALTER TABLE `es_tutorials`
  ADD PRIMARY KEY (`tut_id`);

--
-- Indexes for table `es_undertaking`
--
ALTER TABLE `es_undertaking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_units`
--
ALTER TABLE `es_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `es_userlogs`
--
ALTER TABLE `es_userlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_videogallery`
--
ALTER TABLE `es_videogallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `es_voucher`
--
ALTER TABLE `es_voucher`
  ADD PRIMARY KEY (`es_voucherid`);

--
-- Indexes for table `es_voucherentry`
--
ALTER TABLE `es_voucherentry`
  ADD PRIMARY KEY (`es_voucherentryid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_marksheet`
--
ALTER TABLE `exam_marksheet`
  ADD PRIMARY KEY (`marksheet_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `feereceipttransection`
--
ALTER TABLE `feereceipttransection`
  ADD PRIMARY KEY (`feereceipt_id`),
  ADD KEY `feereceipt_id` (`feereceipt_id`),
  ADD KEY `standard_id` (`standard_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `feestype`
--
ALTER TABLE `feestype`
  ADD PRIMARY KEY (`fesstype_id`),
  ADD KEY `standard_id` (`standard_id`);

--
-- Indexes for table `fees_series`
--
ALTER TABLE `fees_series`
  ADD PRIMARY KEY (`series_id`);

--
-- Indexes for table `fees_submission_dates`
--
ALTER TABLE `fees_submission_dates`
  ADD PRIMARY KEY (`fees_submission_dateid`);

--
-- Indexes for table `fee_card_numbering`
--
ALTER TABLE `fee_card_numbering`
  ADD PRIMARY KEY (`fee_card_numbering_id`);

--
-- Indexes for table `fm_fee_cards`
--
ALTER TABLE `fm_fee_cards`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `fm_fee_card_childs`
--
ALTER TABLE `fm_fee_card_childs`
  ADD PRIMARY KEY (`card_child_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `foundations`
--
ALTER TABLE `foundations`
  ADD PRIMARY KEY (`foundation_id`);

--
-- Indexes for table `gardian`
--
ALTER TABLE `gardian`
  ADD PRIMARY KEY (`gardian_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupid`),
  ADD UNIQUE KEY `groupname` (`groupname`),
  ADD KEY `foundation_id` (`foundation_id`);

--
-- Indexes for table `him_administrator`
--
ALTER TABLE `him_administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_admission`
--
ALTER TABLE `him_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_applyteacher`
--
ALTER TABLE `him_applyteacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_cms`
--
ALTER TABLE `him_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_country`
--
ALTER TABLE `him_country`
  ADD PRIMARY KEY (`country_id`),
  ADD KEY `idx_country_name` (`country_name`);

--
-- Indexes for table `him_datasheet`
--
ALTER TABLE `him_datasheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_gallery`
--
ALTER TABLE `him_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_settings`
--
ALTER TABLE `him_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `him_toppers`
--
ALTER TABLE `him_toppers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histry_fm_cards`
--
ALTER TABLE `histry_fm_cards`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `isd_class_division`
--
ALTER TABLE `isd_class_division`
  ADD PRIMARY KEY (`class_division_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `isd_class_tests`
--
ALTER TABLE `isd_class_tests`
  ADD PRIMARY KEY (`class_test_id`),
  ADD KEY `divisionid` (`standard_id`,`teacherid`,`subject_id`),
  ADD KEY `teacherid` (`teacherid`),
  ADD KEY `subid` (`subject_id`),
  ADD KEY `subid_2` (`subject_id`),
  ADD KEY `subid_3` (`subject_id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

--
-- Indexes for table `isd_class_test_marks`
--
ALTER TABLE `isd_class_test_marks`
  ADD PRIMARY KEY (`test_marks_id`),
  ADD KEY `testid` (`class_test_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `item_inventory`
--
ALTER TABLE `item_inventory`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_name` (`item_name`),
  ADD UNIQUE KEY `item_code` (`item_code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  ADD PRIMARY KEY (`ledger_entry_id`);

--
-- Indexes for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD PRIMARY KEY (`Login_Session_ID`),
  ADD UNIQUE KEY `Login_Session_ID` (`Login_Session_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `maintenance_replies`
--
ALTER TABLE `maintenance_replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `maintenance_request`
--
ALTER TABLE `maintenance_request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `mlc_career`
--
ALTER TABLE `mlc_career`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_college`
--
ALTER TABLE `mlc_college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_document`
--
ALTER TABLE `mlc_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_download`
--
ALTER TABLE `mlc_download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_feedback`
--
ALTER TABLE `mlc_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_homenews`
--
ALTER TABLE `mlc_homenews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_news`
--
ALTER TABLE `mlc_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_newsletters`
--
ALTER TABLE `mlc_newsletters`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `mlc_school_policies`
--
ALTER TABLE `mlc_school_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlc_subscribers`
--
ALTER TABLE `mlc_subscribers`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `mlc_yourcomment`
--
ALTER TABLE `mlc_yourcomment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsupdate`
--
ALTER TABLE `newsupdate`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `new_allowencemaster_childs`
--
ALTER TABLE `new_allowencemaster_childs`
  ADD PRIMARY KEY (`new_allowencemaster_child_id`),
  ADD KEY `es_staffid` (`es_staffid`),
  ADD KEY `es_allowencemasterid` (`es_allowencemasterid`);

--
-- Indexes for table `new_deductionmaster_childs`
--
ALTER TABLE `new_deductionmaster_childs`
  ADD PRIMARY KEY (`new_deductionmaster_child_id`);

--
-- Indexes for table `new_payslip_childs`
--
ALTER TABLE `new_payslip_childs`
  ADD PRIMARY KEY (`payslip_child_id`);

--
-- Indexes for table `new_semesters`
--
ALTER TABLE `new_semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `new_survey`
--
ALTER TABLE `new_survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `new_survey_child`
--
ALTER TABLE `new_survey_child`
  ADD PRIMARY KEY (`survey_child_id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `survey_id_2` (`survey_id`);

--
-- Indexes for table `new_survey_option`
--
ALTER TABLE `new_survey_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `new_survey_teacher_group`
--
ALTER TABLE `new_survey_teacher_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_taxmaster_childs`
--
ALTER TABLE `new_taxmaster_childs`
  ADD PRIMARY KEY (`new_taxmaster_child_id`);

--
-- Indexes for table `notice_replies`
--
ALTER TABLE `notice_replies`
  ADD PRIMARY KEY (`notice_repliyid`),
  ADD KEY `notice_id` (`notice_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `photo_gallery`
--
ALTER TABLE `photo_gallery`
  ADD PRIMARY KEY (`photo_galleryid`);

--
-- Indexes for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  ADD PRIMARY KEY (`photo_gallery_imageid`);

--
-- Indexes for table `pur_req_form_child`
--
ALTER TABLE `pur_req_form_child`
  ADD PRIMARY KEY (`pur_req_child_id`),
  ADD KEY `pur_req_id` (`pur_req_id`),
  ADD KEY `pur_req_id_2` (`pur_req_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `pur_req_id`
--
ALTER TABLE `pur_req_id`
  ADD PRIMARY KEY (`pur_req_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`reg_ID`),
  ADD KEY `teacher_ID` (`teacher_ID`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `result_layouts`
--
ALTER TABLE `result_layouts`
  ADD PRIMARY KEY (`result_layout_id`);

--
-- Indexes for table `smsconfig`
--
ALTER TABLE `smsconfig`
  ADD PRIMARY KEY (`configid`);

--
-- Indexes for table `standard`
--
ALTER TABLE `standard`
  ADD PRIMARY KEY (`standard_id`),
  ADD KEY `foundation_id` (`foundation_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `standard_id` (`standard_id`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `foundation_id` (`foundation_id`);

--
-- Indexes for table `student_activities`
--
ALTER TABLE `student_activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `student_activity_grades`
--
ALTER TABLE `student_activity_grades`
  ADD PRIMARY KEY (`student_activity_gradesid`);

--
-- Indexes for table `student_activtiy_exam`
--
ALTER TABLE `student_activtiy_exam`
  ADD PRIMARY KEY (`student_activtiy_examid`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `standard_id` (`standard_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `student_violation`
--
ALTER TABLE `student_violation`
  ADD PRIMARY KEY (`student_violationid`),
  ADD KEY `es_preadmissionid` (`es_preadmissionid`),
  ADD KEY `es_classesid` (`es_classesid`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `subjects_cat`
--
ALTER TABLE `subjects_cat`
  ADD PRIMARY KEY (`scat_id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`supplier_payment_id`);

--
-- Indexes for table `supplier_payment_child`
--
ALTER TABLE `supplier_payment_child`
  ADD PRIMARY KEY (`supplier_payment_child_id`);

--
-- Indexes for table `tbl_sms_setup`
--
ALTER TABLE `tbl_sms_setup`
  ADD PRIMARY KEY (`tbl_sms_setup_id`);

--
-- Indexes for table `tbl_sms_to_student`
--
ALTER TABLE `tbl_sms_to_student`
  ADD PRIMARY KEY (`tbl_sms_to_student_id`);

--
-- Indexes for table `teacher_leave_request`
--
ALTER TABLE `teacher_leave_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `teacher_planner`
--
ALTER TABLE `teacher_planner`
  ADD PRIMARY KEY (`teacher_plannerid`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `teacher_planner_descriptions`
--
ALTER TABLE `teacher_planner_descriptions`
  ADD PRIMARY KEY (`teacher_planner_descriptionid`),
  ADD KEY `teacher_planner_id` (`teacher_planner_id`);

--
-- Indexes for table `teacher_register`
--
ALTER TABLE `teacher_register`
  ADD PRIMARY KEY (`reg_ID`),
  ADD KEY `foundation_id` (`foundation_id`);

--
-- Indexes for table `time_period`
--
ALTER TABLE `time_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transectionentry`
--
ALTER TABLE `transectionentry`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Indexes for table `transport_pickup_points`
--
ALTER TABLE `transport_pickup_points`
  ADD PRIMARY KEY (`tr_place_id`);

--
-- Indexes for table `transport_student_allocation`
--
ALTER TABLE `transport_student_allocation`
  ADD PRIMARY KEY (`transport_student_allocation_id`),
  ADD KEY `pickup_point_id` (`pickup_point_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_Username` (`User_Username`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `User_ID_2` (`User_ID`);

--
-- Indexes for table `voucherhead`
--
ALTER TABLE `voucherhead`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addmission`
--
ALTER TABLE `addmission`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendancesheet`
--
ALTER TABLE `attendancesheet`
  MODIFY `attendance_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `att_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `childfeereceipt`
--
ALTER TABLE `childfeereceipt`
  MODIFY `childfee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `devise_user_details`
--
ALTER TABLE `devise_user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_addon_modules`
--
ALTER TABLE `es_addon_modules`
  MODIFY `addon_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_admins`
--
ALTER TABLE `es_admins`
  MODIFY `es_adminsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `es_allowencemaster`
--
ALTER TABLE `es_allowencemaster`
  MODIFY `es_allowencemasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_assignment`
--
ALTER TABLE `es_assignment`
  MODIFY `es_assignmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `es_attemptcerti`
--
ALTER TABLE `es_attemptcerti`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_attend_staff`
--
ALTER TABLE `es_attend_staff`
  MODIFY `es_attend_staffid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_attend_student`
--
ALTER TABLE `es_attend_student`
  MODIFY `es_attend_studentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_bonafied`
--
ALTER TABLE `es_bonafied`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `es_bookissue`
--
ALTER TABLE `es_bookissue`
  MODIFY `es_bookissueid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_booklets`
--
ALTER TABLE `es_booklets`
  MODIFY `booklet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_bookreturns`
--
ALTER TABLE `es_bookreturns`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_book_reservation`
--
ALTER TABLE `es_book_reservation`
  MODIFY `reserv_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_candidate`
--
ALTER TABLE `es_candidate`
  MODIFY `es_candidateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_caste`
--
ALTER TABLE `es_caste`
  MODIFY `caste_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `es_categorylibrary`
--
ALTER TABLE `es_categorylibrary`
  MODIFY `es_categorylibraryid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_chapters`
--
ALTER TABLE `es_chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_charcerti`
--
ALTER TABLE `es_charcerti`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_classes`
--
ALTER TABLE `es_classes`
  MODIFY `es_classesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `es_classifieds`
--
ALTER TABLE `es_classifieds`
  MODIFY `es_classifiedsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_deductionmaster`
--
ALTER TABLE `es_deductionmaster`
  MODIFY `es_deductionmasterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `es_departments`
--
ALTER TABLE `es_departments`
  MODIFY `es_departmentsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `es_deptposts`
--
ALTER TABLE `es_deptposts`
  MODIFY `es_deptpostsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `es_dispatch`
--
ALTER TABLE `es_dispatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_dispatch_entry`
--
ALTER TABLE `es_dispatch_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_division`
--
ALTER TABLE `es_division`
  MODIFY `es_divisionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `es_eligibilitycerti`
--
ALTER TABLE `es_eligibilitycerti`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_enquiry`
--
ALTER TABLE `es_enquiry`
  MODIFY `es_enquiryid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_exam`
--
ALTER TABLE `es_exam`
  MODIFY `es_examid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_examfee`
--
ALTER TABLE `es_examfee`
  MODIFY `exam_fee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_exam_academic`
--
ALTER TABLE `es_exam_academic`
  MODIFY `es_exam_academicid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_exam_details`
--
ALTER TABLE `es_exam_details`
  MODIFY `es_exam_detailsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_expcerti`
--
ALTER TABLE `es_expcerti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_fa_groups`
--
ALTER TABLE `es_fa_groups`
  MODIFY `es_fa_groupsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_feemaster`
--
ALTER TABLE `es_feemaster`
  MODIFY `es_feemasterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `es_feepaid`
--
ALTER TABLE `es_feepaid`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `es_feepaid_new_details`
--
ALTER TABLE `es_feepaid_new_details`
  MODIFY `fp_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `es_feesnotice`
--
ALTER TABLE `es_feesnotice`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_fee_inst_last_date`
--
ALTER TABLE `es_fee_inst_last_date`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_finance_master`
--
ALTER TABLE `es_finance_master`
  MODIFY `es_finance_masterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `es_fine_charged_collected`
--
ALTER TABLE `es_fine_charged_collected`
  MODIFY `es_fcc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_fine_master`
--
ALTER TABLE `es_fine_master`
  MODIFY `es_fine_masterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_groups`
--
ALTER TABLE `es_groups`
  MODIFY `es_groupsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `es_holidaynoti`
--
ALTER TABLE `es_holidaynoti`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_holidays`
--
ALTER TABLE `es_holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `es_hostelbuld`
--
ALTER TABLE `es_hostelbuld`
  MODIFY `es_hostelbuldid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_hostelperson_item`
--
ALTER TABLE `es_hostelperson_item`
  MODIFY `es_hostelperson_itemid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_hostelroom`
--
ALTER TABLE `es_hostelroom`
  MODIFY `es_hostelroomid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_hostel_charges`
--
ALTER TABLE `es_hostel_charges`
  MODIFY `es_hostel_charges_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_hostel_health`
--
ALTER TABLE `es_hostel_health`
  MODIFY `es_hostel_healthid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_idcard_image`
--
ALTER TABLE `es_idcard_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_incharge`
--
ALTER TABLE `es_incharge`
  MODIFY `incharge_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_institutes`
--
ALTER TABLE `es_institutes`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_inventory`
--
ALTER TABLE `es_inventory`
  MODIFY `es_inventoryid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_category`
--
ALTER TABLE `es_in_category`
  MODIFY `es_in_categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `es_in_goods_issue`
--
ALTER TABLE `es_in_goods_issue`
  MODIFY `es_in_goods_issueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `es_in_goods_issue_items`
--
ALTER TABLE `es_in_goods_issue_items`
  MODIFY `es_in_goods_issue_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_goods_issue_requests`
--
ALTER TABLE `es_in_goods_issue_requests`
  MODIFY `es_in_goods_issueid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_goods_issue_request_items`
--
ALTER TABLE `es_in_goods_issue_request_items`
  MODIFY `es_in_goods_issue_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_goods_receipt_note`
--
ALTER TABLE `es_in_goods_receipt_note`
  MODIFY `grn_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_goods_receipt_note_items`
--
ALTER TABLE `es_in_goods_receipt_note_items`
  MODIFY `es_in_goods_receipt_note_itemsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_item_master`
--
ALTER TABLE `es_in_item_master`
  MODIFY `es_in_item_masterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `es_in_orders`
--
ALTER TABLE `es_in_orders`
  MODIFY `es_in_ordersid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_orders_items`
--
ALTER TABLE `es_in_orders_items`
  MODIFY `es_order_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_quotation_requests`
--
ALTER TABLE `es_in_quotation_requests`
  MODIFY `rfq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_in_supplier_master`
--
ALTER TABLE `es_in_supplier_master`
  MODIFY `es_in_supplier_masterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_issueloan`
--
ALTER TABLE `es_issueloan`
  MODIFY `es_issueloanid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_knowledge_articles`
--
ALTER TABLE `es_knowledge_articles`
  MODIFY `es_knowledge_articlesid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_knowledge_base`
--
ALTER TABLE `es_knowledge_base`
  MODIFY `es_knowledge_baseid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_leavemaster`
--
ALTER TABLE `es_leavemaster`
  MODIFY `es_leavemasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_leave_request`
--
ALTER TABLE `es_leave_request`
  MODIFY `es_leave_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `es_ledger`
--
ALTER TABLE `es_ledger`
  MODIFY `es_ledgerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `es_libaraypublisher`
--
ALTER TABLE `es_libaraypublisher`
  MODIFY `es_libaraypublisherid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_libbook`
--
ALTER TABLE `es_libbook`
  MODIFY `es_libbookid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_libbookfinedet`
--
ALTER TABLE `es_libbookfinedet`
  MODIFY `es_libbookfinedetid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_libfine`
--
ALTER TABLE `es_libfine`
  MODIFY `es_libfineid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_loanmaster`
--
ALTER TABLE `es_loanmaster`
  MODIFY `es_loanmasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_loanpayment`
--
ALTER TABLE `es_loanpayment`
  MODIFY `es_loanpaymentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_marks`
--
ALTER TABLE `es_marks`
  MODIFY `es_marksid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_mcq_questions`
--
ALTER TABLE `es_mcq_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `es_mcq_result`
--
ALTER TABLE `es_mcq_result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `es_mcq_test`
--
ALTER TABLE `es_mcq_test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `es_messages`
--
ALTER TABLE `es_messages`
  MODIFY `es_messagesid` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `es_message_documents`
--
ALTER TABLE `es_message_documents`
  MODIFY `doc_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_modules_alloted`
--
ALTER TABLE `es_modules_alloted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `es_new_timetable`
--
ALTER TABLE `es_new_timetable`
  MODIFY `new_time_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_notice`
--
ALTER TABLE `es_notice`
  MODIFY `es_noticeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `es_notice_messages`
--
ALTER TABLE `es_notice_messages`
  MODIFY `es_messagesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `es_offerletter`
--
ALTER TABLE `es_offerletter`
  MODIFY `es_offerletterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_old_balances`
--
ALTER TABLE `es_old_balances`
  MODIFY `ob_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_old_balances_paid`
--
ALTER TABLE `es_old_balances_paid`
  MODIFY `obp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_otherletter_formats`
--
ALTER TABLE `es_otherletter_formats`
  MODIFY `letter_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_other_fine_dettails`
--
ALTER TABLE `es_other_fine_dettails`
  MODIFY `otherfine_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_payslipdetails`
--
ALTER TABLE `es_payslipdetails`
  MODIFY `es_payslipdetailsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_pfmaster`
--
ALTER TABLE `es_pfmaster`
  MODIFY `es_pfmasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_photogallery`
--
ALTER TABLE `es_photogallery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_preadmission`
--
ALTER TABLE `es_preadmission`
  MODIFY `es_preadmissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `es_preadmission_details`
--
ALTER TABLE `es_preadmission_details`
  MODIFY `es_preadmission_detailsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `es_questionbank`
--
ALTER TABLE `es_questionbank`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_requirement`
--
ALTER TABLE `es_requirement`
  MODIFY `es_requirementid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_resignation`
--
ALTER TABLE `es_resignation`
  MODIFY `es_resignationid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_roomallotment`
--
ALTER TABLE `es_roomallotment`
  MODIFY `es_roomallotmentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_sections`
--
ALTER TABLE `es_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_sections_student`
--
ALTER TABLE `es_sections_student`
  MODIFY `section_student_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_security`
--
ALTER TABLE `es_security`
  MODIFY `es_securityid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_shortlisted`
--
ALTER TABLE `es_shortlisted`
  MODIFY `es_shortlistedid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_staff`
--
ALTER TABLE `es_staff`
  MODIFY `es_staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `es_stationary`
--
ALTER TABLE `es_stationary`
  MODIFY `stationary_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_stationary_payment`
--
ALTER TABLE `es_stationary_payment`
  MODIFY `st_pay_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_studentabsentnoti`
--
ALTER TABLE `es_studentabsentnoti`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_studymaterial`
--
ALTER TABLE `es_studymaterial`
  MODIFY `es_studymaterialid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `es_subcategory`
--
ALTER TABLE `es_subcategory`
  MODIFY `es_subcategoryid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_subject`
--
ALTER TABLE `es_subject`
  MODIFY `es_subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `es_taxmaster`
--
ALTER TABLE `es_taxmaster`
  MODIFY `es_taxmasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_tcmaster`
--
ALTER TABLE `es_tcmaster`
  MODIFY `es_tcmasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_tcstudent`
--
ALTER TABLE `es_tcstudent`
  MODIFY `es_tcstudentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_timetable`
--
ALTER TABLE `es_timetable`
  MODIFY `es_timetableid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_timetablemaster`
--
ALTER TABLE `es_timetablemaster`
  MODIFY `es_timetablemasterid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_timetable_staff`
--
ALTER TABLE `es_timetable_staff`
  MODIFY `es_st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `es_timetable_subject`
--
ALTER TABLE `es_timetable_subject`
  MODIFY `es_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `es_timetable_subjects`
--
ALTER TABLE `es_timetable_subjects`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_tips`
--
ALTER TABLE `es_tips`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_transferstudent`
--
ALTER TABLE `es_transferstudent`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_translist`
--
ALTER TABLE `es_translist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_transport`
--
ALTER TABLE `es_transport`
  MODIFY `es_transportid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_transport_allots`
--
ALTER TABLE `es_transport_allots`
  MODIFY `driver_allot_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_transport_drivers`
--
ALTER TABLE `es_transport_drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_transport_maintenance`
--
ALTER TABLE `es_transport_maintenance`
  MODIFY `es_transport_maintenanceid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_transport_places`
--
ALTER TABLE `es_transport_places`
  MODIFY `tr_place_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_board`
--
ALTER TABLE `es_trans_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_board_allocation_to_student`
--
ALTER TABLE `es_trans_board_allocation_to_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_driver_allocation_to_vehicle`
--
ALTER TABLE `es_trans_driver_allocation_to_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_driver_details`
--
ALTER TABLE `es_trans_driver_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_fee_details`
--
ALTER TABLE `es_trans_fee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_maintenance`
--
ALTER TABLE `es_trans_maintenance`
  MODIFY `es_transport_maintenanceid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_payment_history`
--
ALTER TABLE `es_trans_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_route`
--
ALTER TABLE `es_trans_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_vehicle`
--
ALTER TABLE `es_trans_vehicle`
  MODIFY `es_transportid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_trans_vehicle_allocation_to_board`
--
ALTER TABLE `es_trans_vehicle_allocation_to_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_tutorials`
--
ALTER TABLE `es_tutorials`
  MODIFY `tut_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_undertaking`
--
ALTER TABLE `es_undertaking`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_units`
--
ALTER TABLE `es_units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_userlogs`
--
ALTER TABLE `es_userlogs`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `es_videogallery`
--
ALTER TABLE `es_videogallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_voucher`
--
ALTER TABLE `es_voucher`
  MODIFY `es_voucherid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `es_voucherentry`
--
ALTER TABLE `es_voucherentry`
  MODIFY `es_voucherentryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_marksheet`
--
ALTER TABLE `exam_marksheet`
  MODIFY `marksheet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feereceipttransection`
--
ALTER TABLE `feereceipttransection`
  MODIFY `feereceipt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feestype`
--
ALTER TABLE `feestype`
  MODIFY `fesstype_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fees_series`
--
ALTER TABLE `fees_series`
  MODIFY `series_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fees_submission_dates`
--
ALTER TABLE `fees_submission_dates`
  MODIFY `fees_submission_dateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `fee_card_numbering`
--
ALTER TABLE `fee_card_numbering`
  MODIFY `fee_card_numbering_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fm_fee_cards`
--
ALTER TABLE `fm_fee_cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fm_fee_card_childs`
--
ALTER TABLE `fm_fee_card_childs`
  MODIFY `card_child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `foundations`
--
ALTER TABLE `foundations`
  MODIFY `foundation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gardian`
--
ALTER TABLE `gardian`
  MODIFY `gardian_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `him_administrator`
--
ALTER TABLE `him_administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_admission`
--
ALTER TABLE `him_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_applyteacher`
--
ALTER TABLE `him_applyteacher`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_country`
--
ALTER TABLE `him_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_datasheet`
--
ALTER TABLE `him_datasheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_gallery`
--
ALTER TABLE `him_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_settings`
--
ALTER TABLE `him_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `him_toppers`
--
ALTER TABLE `him_toppers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histry_fm_cards`
--
ALTER TABLE `histry_fm_cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `isd_class_division`
--
ALTER TABLE `isd_class_division`
  MODIFY `class_division_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `isd_class_tests`
--
ALTER TABLE `isd_class_tests`
  MODIFY `class_test_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `isd_class_test_marks`
--
ALTER TABLE `isd_class_test_marks`
  MODIFY `test_marks_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_inventory`
--
ALTER TABLE `item_inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  MODIFY `ledger_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login_sessions`
--
ALTER TABLE `login_sessions`
  MODIFY `Login_Session_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance_replies`
--
ALTER TABLE `maintenance_replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance_request`
--
ALTER TABLE `maintenance_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_career`
--
ALTER TABLE `mlc_career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_college`
--
ALTER TABLE `mlc_college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_document`
--
ALTER TABLE `mlc_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_download`
--
ALTER TABLE `mlc_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_feedback`
--
ALTER TABLE `mlc_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_homenews`
--
ALTER TABLE `mlc_homenews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_news`
--
ALTER TABLE `mlc_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_newsletters`
--
ALTER TABLE `mlc_newsletters`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_school_policies`
--
ALTER TABLE `mlc_school_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_subscribers`
--
ALTER TABLE `mlc_subscribers`
  MODIFY `subid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlc_yourcomment`
--
ALTER TABLE `mlc_yourcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `newsupdate`
--
ALTER TABLE `newsupdate`
  MODIFY `news_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `new_allowencemaster_childs`
--
ALTER TABLE `new_allowencemaster_childs`
  MODIFY `new_allowencemaster_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_deductionmaster_childs`
--
ALTER TABLE `new_deductionmaster_childs`
  MODIFY `new_deductionmaster_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_payslip_childs`
--
ALTER TABLE `new_payslip_childs`
  MODIFY `payslip_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_semesters`
--
ALTER TABLE `new_semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `new_survey`
--
ALTER TABLE `new_survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_survey_child`
--
ALTER TABLE `new_survey_child`
  MODIFY `survey_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_survey_option`
--
ALTER TABLE `new_survey_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `new_survey_teacher_group`
--
ALTER TABLE `new_survey_teacher_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `new_taxmaster_childs`
--
ALTER TABLE `new_taxmaster_childs`
  MODIFY `new_taxmaster_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notice_replies`
--
ALTER TABLE `notice_replies`
  MODIFY `notice_repliyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photo_gallery`
--
ALTER TABLE `photo_gallery`
  MODIFY `photo_galleryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  MODIFY `photo_gallery_imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pur_req_form_child`
--
ALTER TABLE `pur_req_form_child`
  MODIFY `pur_req_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pur_req_id`
--
ALTER TABLE `pur_req_id`
  MODIFY `pur_req_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `reg_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `result_layouts`
--
ALTER TABLE `result_layouts`
  MODIFY `result_layout_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smsconfig`
--
ALTER TABLE `smsconfig`
  MODIFY `configid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `standard`
--
ALTER TABLE `standard`
  MODIFY `standard_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_activities`
--
ALTER TABLE `student_activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_activity_grades`
--
ALTER TABLE `student_activity_grades`
  MODIFY `student_activity_gradesid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_activtiy_exam`
--
ALTER TABLE `student_activtiy_exam`
  MODIFY `student_activtiy_examid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `student_violation`
--
ALTER TABLE `student_violation`
  MODIFY `student_violationid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects_cat`
--
ALTER TABLE `subjects_cat`
  MODIFY `scat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `supplier_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier_payment_child`
--
ALTER TABLE `supplier_payment_child`
  MODIFY `supplier_payment_child_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sms_setup`
--
ALTER TABLE `tbl_sms_setup`
  MODIFY `tbl_sms_setup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sms_to_student`
--
ALTER TABLE `tbl_sms_to_student`
  MODIFY `tbl_sms_to_student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_leave_request`
--
ALTER TABLE `teacher_leave_request`
  MODIFY `request_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_planner`
--
ALTER TABLE `teacher_planner`
  MODIFY `teacher_plannerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `teacher_planner_descriptions`
--
ALTER TABLE `teacher_planner_descriptions`
  MODIFY `teacher_planner_descriptionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `teacher_register`
--
ALTER TABLE `teacher_register`
  MODIFY `reg_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_period`
--
ALTER TABLE `time_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transectionentry`
--
ALTER TABLE `transectionentry`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transport_pickup_points`
--
ALTER TABLE `transport_pickup_points`
  MODIFY `tr_place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transport_student_allocation`
--
ALTER TABLE `transport_student_allocation`
  MODIFY `transport_student_allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `voucherhead`
--
ALTER TABLE `voucherhead`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addmission`
--
ALTER TABLE `addmission`
  ADD CONSTRAINT `addmission_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`standard_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addmission_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addmission_ibfk_3` FOREIGN KEY (`fesstype_id`) REFERENCES `feestype` (`fesstype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendancesheet`
--
ALTER TABLE `attendancesheet`
  ADD CONSTRAINT `attn` FOREIGN KEY (`attendance_id`) REFERENCES `student_attendance` (`attendance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`ref_ID`) REFERENCES `teacher_register` (`reg_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `childfeereceipt`
--
ALTER TABLE `childfeereceipt`
  ADD CONSTRAINT `childfeereceipt_ibfk_1` FOREIGN KEY (`feereceipt_id`) REFERENCES `feereceipttransection` (`feereceipt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `childfeereceipt_ibfk_2` FOREIGN KEY (`pen_id`) REFERENCES `addmission` (`add_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devise_user_details`
--
ALTER TABLE `devise_user_details`
  ADD CONSTRAINT `devise_user_details_ibfk_1` FOREIGN KEY (`foundation_id`) REFERENCES `foundations` (`foundation_id`);

--
-- Constraints for table `es_feepaid_new_details`
--
ALTER TABLE `es_feepaid_new_details`
  ADD CONSTRAINT `es_feepaid_new_details_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `es_feepaid` (`fid`) ON DELETE CASCADE;

--
-- Constraints for table `es_preadmission_details`
--
ALTER TABLE `es_preadmission_details`
  ADD CONSTRAINT `es_preadmission_details_ibfk_1` FOREIGN KEY (`es_preadmissionid`) REFERENCES `es_preadmission` (`es_preadmissionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_marksheet`
--
ALTER TABLE `exam_marksheet`
  ADD CONSTRAINT `exam_marksheet_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feereceipttransection`
--
ALTER TABLE `feereceipttransection`
  ADD CONSTRAINT `feereceipttransection_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`standard_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feereceipttransection_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feestype`
--
ALTER TABLE `feestype`
  ADD CONSTRAINT `feestype_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`standard_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fm_fee_card_childs`
--
ALTER TABLE `fm_fee_card_childs`
  ADD CONSTRAINT `fm_fee_card_childs_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `fm_fee_cards` (`card_id`) ON DELETE CASCADE;

--
-- Constraints for table `gardian`
--
ALTER TABLE `gardian`
  ADD CONSTRAINT `gardian_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `isd_class_division`
--
ALTER TABLE `isd_class_division`
  ADD CONSTRAINT `isd_class_division_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `es_classes` (`es_classesid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `isd_class_test_marks`
--
ALTER TABLE `isd_class_test_marks`
  ADD CONSTRAINT `isd_class_test_marks_ibfk_1` FOREIGN KEY (`class_test_id`) REFERENCES `isd_class_tests` (`class_test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isd_class_test_marks_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `es_preadmission` (`es_preadmissionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_inventory`
--
ALTER TABLE `item_inventory`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD CONSTRAINT `User_ID` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_replies`
--
ALTER TABLE `maintenance_replies`
  ADD CONSTRAINT `maintenance_replies_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `maintenance_request` (`req_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `new_allowencemaster_childs`
--
ALTER TABLE `new_allowencemaster_childs`
  ADD CONSTRAINT `new_allowencemaster_childs_ibfk_1` FOREIGN KEY (`es_staffid`) REFERENCES `es_staff` (`es_staffid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `new_payslip_childs`
--
ALTER TABLE `new_payslip_childs`
  ADD CONSTRAINT `new_payslip_childs_ibfk_1` FOREIGN KEY (`payslip_child_id`) REFERENCES `es_payslipdetails` (`es_payslipdetailsid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `new_survey_child`
--
ALTER TABLE `new_survey_child`
  ADD CONSTRAINT `new_survey_child_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `new_survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pur_req_form_child`
--
ALTER TABLE `pur_req_form_child`
  ADD CONSTRAINT `pur_req_form_child_ibfk_1` FOREIGN KEY (`pur_req_id`) REFERENCES `pur_req_id` (`pur_req_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pur_req_id`
--
ALTER TABLE `pur_req_id`
  ADD CONSTRAINT `pur_req_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `devise_user_details` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `qualification`
--
ALTER TABLE `qualification`
  ADD CONSTRAINT `qualification_ibfk_1` FOREIGN KEY (`teacher_ID`) REFERENCES `teacher_register` (`reg_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `standard`
--
ALTER TABLE `standard`
  ADD CONSTRAINT `standard_ibfk_1` FOREIGN KEY (`foundation_id`) REFERENCES `foundations` (`foundation_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`standard_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `groups` (`groupid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`foundation_id`) REFERENCES `foundations` (`foundation_id`);

--
-- Constraints for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `attendance_standard` FOREIGN KEY (`standard_id`) REFERENCES `es_classes` (`es_classesid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `es_staff` (`es_staffid`) ON UPDATE CASCADE;

--
-- Constraints for table `teacher_leave_request`
--
ALTER TABLE `teacher_leave_request`
  ADD CONSTRAINT `teacherid_leave` FOREIGN KEY (`teacherid`) REFERENCES `teacher_register` (`reg_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `teacher_register`
--
ALTER TABLE `teacher_register`
  ADD CONSTRAINT `teacher_register_ibfk_1` FOREIGN KEY (`foundation_id`) REFERENCES `foundations` (`foundation_id`);

--
-- Constraints for table `transectionentry`
--
ALTER TABLE `transectionentry`
  ADD CONSTRAINT `transectionentry_ibfk_1` FOREIGN KEY (`voucher_id`) REFERENCES `voucherhead` (`voucher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transport_student_allocation`
--
ALTER TABLE `transport_student_allocation`
  ADD CONSTRAINT `transport_student_allocation_ibfk_1` FOREIGN KEY (`pickup_point_id`) REFERENCES `transport_pickup_points` (`tr_place_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
