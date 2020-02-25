-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2020 at 03:33 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Mizanur Rahman Riyadh', 'riyadh@example.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2018-12-06 16:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

DROP TABLE IF EXISTS `tblauthors`;
CREATE TABLE IF NOT EXISTS `tblauthors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(5, 'Chowdhury & Hossain', '2018-11-21 07:02:01', '2018-11-23 10:20:58'),
(6, 'Dr. Shahjahan Topon', '2018-11-21 07:03:18', NULL),
(7, 'Hazari', '2018-11-21 07:04:37', NULL),
(8, 'Soumitro Shekhor', '2018-11-21 07:06:59', NULL),
(9, 'Herbert Schildt', '2018-11-23 10:23:46', NULL),
(10, 'Wes McKinney', '2018-11-23 10:32:24', NULL),
(11, 'Thomas H Coreman', '2018-11-23 10:35:07', NULL),
(12, 'Michael Wolf', '2018-11-23 10:37:00', NULL),
(13, 'Sheikh Mujibur Rahman ', '2018-11-23 10:39:47', NULL),
(15, 'Humayun Ahmed', '2018-12-07 05:38:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

DROP TABLE IF EXISTS `tblbooks`;
CREATE TABLE IF NOT EXISTS `tblbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Status` int(2) DEFAULT '1',
  `image` varchar(255) NOT NULL,
  `ebook` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`, `Status`, `image`, `ebook`) VALUES
(40, 'Advanced Learner Functional English', 11, 5, 122, 400, '2018-11-23 10:21:47', '2018-11-23 18:47:13', 0, '621869.jpg', NULL),
(41, 'The Complete Reference C++ ', 18, 9, 123, 500, '2018-11-23 10:25:03', NULL, 1, '42035.jpg', NULL),
(42, 'The Complete Reference Java', 18, 9, 124, 650, '2018-11-23 10:27:35', NULL, 1, '412545.jpg', NULL),
(43, 'Tech Yourself C', 18, 9, 125, 250, '2018-11-23 10:29:23', '2018-11-23 20:58:32', 1, '233921.jpg', NULL),
(44, 'Python for Data Analysis', 19, 10, 126, 700, '2018-11-23 10:33:02', NULL, 1, '416142.jpg', NULL),
(45, 'Introduction to Algorithms', 21, 11, 127, 1200, '2018-11-23 10:35:47', NULL, 1, '532389.jpg', NULL),
(46, 'Fire & Fury inside the Trump', 20, 12, 128, 250, '2018-11-23 10:37:40', NULL, 1, '73772.jpg', NULL),
(47, 'Osampto Attojiboni', 20, 13, 129, 400, '2018-11-23 10:38:41', '2018-11-23 10:40:03', 1, '920368.jpg', NULL),
(48, 'Physics 2nd Paper', 17, 6, 121, 250, '2018-11-24 12:14:49', NULL, 1, '514829.jpg', NULL),
(49, 'Test Book', 15, 5, 1234567890, 1234, '2018-12-04 19:55:03', NULL, 1, '719092.png', '945947.pdf'),
(50, 'Himu', 15, 15, 786422, 400, '2018-12-07 14:00:38', NULL, 1, '469830.jpg', '499616.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooksbuyrequest`
--

DROP TABLE IF EXISTS `tblbooksbuyrequest`;
CREATE TABLE IF NOT EXISTS `tblbooksbuyrequest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `book_id` int(10) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0',
  `txid` int(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooksbuyrequest`
--

INSERT INTO `tblbooksbuyrequest` (`id`, `student_id`, `book_id`, `request_time`, `update_time`, `status`, `txid`) VALUES
(1, 'SID017', 42, '2018-12-06 11:09:42', '2018-12-06 11:09:42', 1, 123),
(2, 'SID019', 42, '2018-12-06 11:07:31', '2018-12-06 11:07:31', 0, 123455);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooksrequest`
--

DROP TABLE IF EXISTS `tblbooksrequest`;
CREATE TABLE IF NOT EXISTS `tblbooksrequest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `book_id` int(10) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooksrequest`
--

INSERT INTO `tblbooksrequest` (`id`, `student_id`, `book_id`, `request_time`, `update_time`, `status`) VALUES
(6, 'SID017', 40, '2018-11-23 18:31:06', '2018-11-23 18:31:06', 0),
(7, 'SID017', 44, '2018-12-08 13:26:02', '2018-12-08 13:26:02', 1),
(8, 'SID017', 43, '2018-12-08 13:27:33', '2018-12-08 13:27:33', 1),
(9, 'SID017', 39, '2018-11-24 12:04:15', '2018-11-24 12:04:15', 0),
(10, 'SID017', 39, '2018-11-24 12:04:28', '2018-11-24 12:04:28', 0),
(11, 'SID017', 48, '2018-12-07 12:30:33', '2018-12-07 12:30:33', 1),
(12, 'SID019', 49, '2018-12-04 20:38:36', '2018-12-04 20:38:36', 0),
(13, 'SID019', 49, '2018-12-06 05:03:04', '2018-12-06 05:03:04', 0),
(14, 'SID020', 44, '2018-12-07 12:35:17', '2018-12-07 12:35:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(11, 'English Grammar', 1, '2018-11-21 07:01:17', '0000-00-00 00:00:00'),
(14, 'Bangla Grammar', 1, '2018-11-21 07:06:46', '0000-00-00 00:00:00'),
(15, 'Bangla Literature', 1, '2018-11-22 16:47:21', '0000-00-00 00:00:00'),
(16, 'Statistics', 1, '2018-11-22 16:47:40', '0000-00-00 00:00:00'),
(17, 'Physics', 1, '2018-11-23 07:01:27', '0000-00-00 00:00:00'),
(18, 'Programming Language', 1, '2018-11-23 10:23:26', '2018-11-23 10:34:18'),
(19, 'Data Science', 1, '2018-11-23 10:30:59', '0000-00-00 00:00:00'),
(20, 'Biography', 1, '2018-11-23 10:31:21', '0000-00-00 00:00:00'),
(21, 'Algorithm & Data Structure ', 1, '2018-11-23 10:34:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

DROP TABLE IF EXISTS `tblissuedbookdetails`;
CREATE TABLE IF NOT EXISTS `tblissuedbookdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `RetrunStatus` int(1) NOT NULL,
  `fine` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
(6, 46, 'SID017                                                    ', '2018-11-23 21:12:43', NULL, 0, NULL),
(7, 47, 'SID017                                                    ', '2018-11-23 21:15:26', NULL, 0, NULL),
(8, 43, 'SID017                                                    ', '2018-11-23 21:18:21', NULL, 0, NULL),
(9, 44, 'SID019                                                    ', '2018-12-06 05:07:35', NULL, 0, NULL),
(10, 43, 'SID019', '2018-12-05 18:00:00', '2018-12-06 17:18:36', 1, NULL),
(15, 49, 'SID019', '2018-12-07 12:23:23', NULL, 0, NULL),
(16, 48, 'SID017', '2018-12-07 12:24:33', NULL, 0, NULL),
(33, 44, 'SID020', '2018-12-07 12:35:17', NULL, 0, NULL),
(34, 44, 'SID017', '2018-12-08 13:26:02', NULL, 0, NULL),
(35, 43, 'SID017', '2018-12-08 13:27:33', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsoldbooks`
--

DROP TABLE IF EXISTS `tblsoldbooks`;
CREATE TABLE IF NOT EXISTS `tblsoldbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL,
  `bid` int(20) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsoldbooks`
--

INSERT INTO `tblsoldbooks` (`id`, `sid`, `bid`, `date`) VALUES
(1, 'SID019', 49, '2018-12-05 00:00:00'),
(2, 'SID019', 45, '2018-12-03 00:00:00'),
(3, '0', 40, '2018-12-06 17:05:33'),
(4, '0', 40, '2018-12-06 17:06:18'),
(5, '0', 42, '2018-12-06 17:08:53'),
(6, '0', 42, '2018-12-06 17:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `smart_card` int(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `StudentId` (`StudentId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`, `smart_card`) VALUES
(11, 'SID013', 'Ahnaf', 'sakib@sakib.com', '0173778361', 'e19d5cd5af0378da05f63f891c7467af', 1, '2018-11-17 13:34:29', '2018-11-23 17:50:09', NULL),
(15, 'SID017', 'Mizanur Riyadh', 'riyadh@gmail.com', '1234567890', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2018-11-21 06:22:38', NULL, NULL),
(16, 'SID018', 'Ahnaf Shahriar', 'bdahnaf@gmail.com', '0173778361', '28e9ae3ae3f544edf077eae414725fa2', 1, '2018-11-30 12:23:04', NULL, NULL),
(17, 'SID019', 'Changed Name', 'abcdefg@wwe.com', '12356456', '7ac66c0f148de9519b8bd264312c4d64', 1, '2018-12-04 19:31:57', '2018-12-06 06:49:43', 12356467),
(18, 'SID020', 'nnn', '123@123.com', '123456789', '202cb962ac59075b964b07152d234b70', 1, '2018-12-07 12:32:31', NULL, 123456);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
