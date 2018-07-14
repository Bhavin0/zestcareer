-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2018 at 03:49 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanskar`
--

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
(3, '1', '1', 'test123', '<span style=\"font-weight: bold;\">Sdasda</span>', 'png', '2018-04-12', 'admin', 1, 'active'),
(4, '1', '1', 'staff testing', '<p>staff testing demo&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', 'txt', '2018-04-10', 'teacher', 2, 'active'),
(5, '1', '1', 'test123', 'asfdsdfdfsdf', 'png', '2018-04-13', 'teacher', 2, 'deleted'),
(6, '6', '', 'demo', 'Sdads', 'png', '2018-04-19', 'admin', 1, 'active'),
(7, '6', '2', 'demo', 'sdasd', 'png', '2018-04-13', 'admin', 1, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `es_studymaterial`
--
ALTER TABLE `es_studymaterial`
  ADD PRIMARY KEY (`es_studymaterialid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `es_studymaterial`
--
ALTER TABLE `es_studymaterial`
  MODIFY `es_studymaterialid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
