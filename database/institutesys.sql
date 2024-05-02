-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 01:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `institutesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `emailid`, `user_id`, `image`) VALUES
(0, 'admin', '$2y$10$qvp5vkKsRNuBLrnmVV.nUehYP1gzNvNDaQ1/MUXpDGmTAHlJT8DGG', 'admin@gmail.com', NULL, '64f8c1511d3ba.jpeg'),
(1, 'subash', '$2y$10$tsmEyE/Sd8Gm0ix1wAEE3Orx6z3DAQ1wdf.zynOtfjc.QLRHjH7Rq', 'subash@gmail.com', NULL, '64e33dadb1939.png');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `teacher` varchar(50) NOT NULL,
  `fee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course`, `teacher`, `fee`) VALUES
(3, 'BBA 4th Semseter Business Statistics', 'Tanka Kandel', 3000),
(4, 'Computer Basic Course', 'Nirmal Gyawali', 4000),
(14, 'Bim 3rd Sesmseter Java', 'Sujan Chapagai', 3000),
(22, 'BBS 2nd Year CMA', 'Aashika Sapkota', 3000),
(24, 'Cmat', 'Amrit Giri', 7000),
(25, 'BIM 3rd Java', 'Suraj khatri', 4000),
(27, 'Php', 'Ram Bahadur Thapa', 5000),
(28, 'Digital Marketing', 'Ujwal Neupane', 4000),
(29, 'HTML', 'Abc', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `fees_transaction`
--

CREATE TABLE `fees_transaction` (
  `id` int(255) NOT NULL,
  `stdid` int(11) NOT NULL,
  `paid` int(255) NOT NULL,
  `submitdate` datetime NOT NULL,
  `transcation_remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fees_transaction`
--

INSERT INTO `fees_transaction` (`id`, `stdid`, `paid`, `submitdate`, `transcation_remark`) VALUES
(35, 28, 3000, '2023-08-01 00:00:00', ''),
(36, 29, 300, '2023-08-01 00:00:00', 'On the first month'),
(37, 30, 1233, '2023-11-01 00:00:00', 'Paid in advance'),
(38, 31, 1000, '2023-08-01 00:00:00', ''),
(39, 32, 10, '2023-08-16 00:00:00', ''),
(40, 35, 1233, '2023-08-02 00:00:00', ''),
(41, 36, 10, '2023-08-02 00:00:00', 'paid in advance'),
(42, 38, 1000, '2023-08-01 00:00:00', 'Paid in advance'),
(43, 39, 3000, '2023-08-02 00:00:00', 'paid in advance'),
(44, 40, 800, '2023-08-01 00:00:00', ''),
(45, 41, 1234, '2023-08-23 00:00:00', '100'),
(46, 43, 2000, '2023-08-01 00:00:00', 'paid in avance'),
(47, 44, 1000, '2023-08-01 00:00:00', 'Money Paid'),
(48, 46, 100, '2023-08-01 00:00:00', ''),
(49, 48, 100, '2023-08-02 00:00:00', 'hey'),
(50, 49, 1000, '2023-09-21 00:00:00', 'paid in advance'),
(51, 50, 3000, '2023-08-02 00:00:00', 'advance paid'),
(52, 51, 1000, '2023-09-11 00:00:00', 'Paid in advance'),
(53, 52, 1000, '2023-09-10 00:00:00', 'shree paid in advance'),
(54, 0, 100, '2023-08-12 00:00:00', 'paid'),
(55, 0, 200, '2023-09-05 00:00:00', 'paid today'),
(56, 0, 500, '2023-09-05 00:00:00', 'paid today'),
(57, 53, 100, '2023-09-21 00:00:00', 'only 100'),
(58, 43, 500, '2023-09-06 00:00:00', 'just now paid i'),
(59, 43, 700, '2023-09-05 00:00:00', 'test'),
(60, 46, 900, '2023-09-05 00:00:00', 'test2'),
(61, 48, 20, '2023-09-03 00:00:00', 'try'),
(62, 54, 5000, '2023-09-06 00:00:00', 'Pay the remaining amount as soon as possible.'),
(63, 55, 500, '2023-09-20 00:00:00', 'Rahul Paid 500 advace'),
(64, 56, 100, '2023-09-12 00:00:00', 'Approve by bishal'),
(65, 51, 500, '2023-09-06 00:00:00', 'Paid'),
(66, 57, 1000, '2023-09-01 00:00:00', 'only paid 1000'),
(67, 51, 300, '2023-09-07 00:00:00', 'approve by bishal'),
(68, 51, 300, '2023-09-11 00:00:00', 'paid 300 today'),
(69, 51, 100, '2023-09-07 00:00:00', 'paid'),
(70, 58, 1000, '2023-09-14 00:00:00', 'paid'),
(71, 60, 1000, '0000-00-00 00:00:00', 'paid 1000'),
(72, 61, 100, '2023-09-02 00:00:00', 'paid'),
(73, 54, 3000, '2023-09-16 00:00:00', 'paid'),
(74, 51, 70000, '0000-00-00 00:00:00', 'paid'),
(75, 49, 8000, '2023-09-13 00:00:00', 'paid'),
(76, 52, 10000, '2023-09-16 00:00:00', 'paid'),
(77, 50, 8000, '2023-09-15 00:00:00', 'paid'),
(78, 48, 900, '2023-09-15 00:00:00', 'paid'),
(79, 62, 2000, '2023-09-14 00:00:00', 'paid'),
(80, 63, 1000, '2023-09-13 00:00:00', 'paid in advace'),
(81, 64, 1000, '2023-09-20 00:00:00', 'Paid in Advance'),
(82, 43, 100, '0000-00-00 00:00:00', 'paid'),
(83, 43, 100, '2023-09-13 00:00:00', 'paid'),
(84, 67, 100, '2023-09-13 00:00:00', 'paid'),
(85, 68, 1000, '2023-09-13 00:00:00', 'Paid advance'),
(86, 43, 3000, '2023-09-19 00:00:00', 'paid 2nd time'),
(87, 43, 1000, '2023-09-20 00:00:00', 'paid'),
(88, 43, 5000, '2023-09-20 00:00:00', 'paid'),
(89, 53, 100, '2023-09-20 00:00:00', 'paid'),
(90, 54, 3000, '2023-09-20 00:00:00', 'paid'),
(91, 69, 100, '2023-09-01 00:00:00', 'paid'),
(92, 54, -22323, '2023-11-06 00:00:00', 'adssda');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `joindate` datetime NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(30) NOT NULL,
  `image` varchar(75) NOT NULL,
  `fees` int(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `balance` int(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `emailid`, `sname`, `joindate`, `contact`, `address`, `image`, `fees`, `course`, `balance`, `username`, `password`) VALUES
(46, 'eshmeta@gmail.com', 'Eshmeta Dangi', '2023-08-01 00:00:00', '9811510000', 'Murgiya', '6511682046380.jpg', 1000, 'Cmat', 0, 'smita', 'smita'),
(54, 'aashika@gmail.com', 'Aashika Subedi', '2023-08-01 09:11:30', '9844542780', 'Fulbari', '64f8568ee6ecf.jpg', 15000, 'Basic Computer course', 26323, 'aas_hika', ''),
(55, 'rahul@gmail.com', 'Rahul Dhakal', '2023-09-12 06:20:00', '9802823930', 'Sukhanagar', '64f857f580632.jpeg', 3000, 'BBA 4th Semseter Business Statistics', 2500, 'rahul', 'rahul'),
(56, 'arjun@gmail.com', 'Arjun Dhakal', '2023-09-12 12:50:00', '9811238329', 'Maglapur', '64f8c7551cced.jpeg', 2200, 'BBA 4th Semseter Business Statistics', 2100, 'arjun', 'arjun'),
(57, 'heera@gmail.com', 'Heera Thapa', '2023-09-12 10:50:00', '9824113078', 'Haraiya', '64f99f5f4a7e3.jpg', 4000, 'BBS 2nd Year CMA', 3000, 'heera', 'heera'),
(58, 'sanu@gmail.com', 'Sanu Chaudhary', '2023-08-01 02:35:30', '9811515434', 'Khaireni', '65006908919c6.jpeg', 3000, 'BBS 2nd Year CMA', 2000, 'sanu', 'sanu'),
(61, 'sarita@gmail.com', 'Sarita Chaudhary', '2023-08-01 12:02:10', '9342423424', 'Ranibagiya', '650725b2335ff.jpeg', 1000, 'Bim 3rd Sesmseter Java', 900, 'sarita', 'sarita'),
(62, 'amisha@gmail.com', 'Amisha Subedi', '2023-09-14 00:00:00', '9811412323', 'Kathmandu', '65096a554dbd4.jpeg', 10000, 'Cmat', 8000, 'amisha', 'amisha'),
(64, 'bishal@gmail.com', 'Deepak Sapkota', '2023-09-20 00:00:00', '9838232992', 'Kanchan-5, Rupandehi', '652186248371e.jpg', 4000, 'Bim 3rd Sesmseter Java', 3000, 'deepak', 'deepak'),
(67, 'junkri@gmail.com', 'Junkri Thapa', '2023-09-13 00:00:00', '9839272382', 'Ramapur', '650aad60ec831.jpeg', 1000, 'Cmat', 900, 'junkri', '70f9ea05ed03c6975fa2e48ef37c4e'),
(68, 'demo@gmail.com', 'Demo ', '2023-09-13 00:00:00', '9811343832', 'Kanchan-3,Haraiya', '650aba135c55a.jpeg', 3000, 'Cmat', 2000, 'Demo', 'Demo'),
(69, '', 'Dibya Khanal', '2023-09-01 00:00:00', '9811203232', 'Kanchan-3,Haraiya', '6511a896be5dc.jpeg', 1500, 'Computer Basic Course', 1400, 'dibya', 'dibya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ibfk_1` (`user_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
