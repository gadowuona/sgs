-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 07:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `alogin`
--

CREATE TABLE `alogin` (
  `id` int(11) NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alogin`
--

INSERT INTO `alogin` (`id`, `email`, `password`) VALUES
(1, 'gdowuona@ucc.edu.gh', 'pass123'),
(2, 'gassamah@ucc.edu.gh', 'pass123');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `middleName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `college` varchar(100) NOT NULL,
  `fns` enum('Faculty','School') DEFAULT NULL,
  `dept` varchar(100) NOT NULL,
  `qual` varchar(100) NOT NULL,
  `pic` text DEFAULT NULL,
  `super_status` varchar(100) NOT NULL,
  `doa` date DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `staffid`, `firstName`, `middleName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `nid`, `address`, `college`, `fns`, `dept`, `qual`, `pic`, `super_status`, `doa`, `faculty`, `school`) VALUES
(41, 12345, 'Gabirel', 'Esi', 'Bano', 'manager@example.com', 'sgs@1234', '1988-12-12', 'Female', '1234567890', '0', '123ff', 'college of humanities and legal studies', 'Faculty', 'Arts', 'Bsc. food science', 'images/20211117_104012.jpg', '', NULL, NULL, NULL),
(42, 12344, 'Godfred', 'w', 'Ennin', 'enningodfred5@gmail.com', 'sgs@1234', '1990-12-12', 'Male', '0546661772', '0', '123ff', 'college of humanities and legal studies', 'Faculty', 'Arts', 'Bsc. food science', 'images/AUCC.jpg', '', NULL, NULL, NULL),
(43, 0, 'Sarah', 'Esi', 'Mensah', 'esi.mensah@gmail.com', 'sgs@1234', '2000-12-17', 'Female', '0544616412', 'GHA-76225151-0', '123ff', 'college of distance education', 'School', 'Arts', 'Bsc. food science', 'images/AUCC.jpg', 'Supervisor', NULL, NULL, NULL),
(44, 12324, 'Godfred', 'w', 'Annan', 'gdowuona@ucc.edu.gh', 'sgs@1234', '1999-12-09', 'Female', '122322223', 'GHA-7645151-0', '123ff', 'college of agricultural and natural sciences', 'School', 'Arts', 'Bsc. food science', 'images/330px-Elon_Musk_Royal_Society.jpg', 'Supervisor', NULL, NULL, NULL),
(45, 13803, 'Gabirel', '', 'Assamah', 'gassamah@ucc.edu.gh', 'sgs@1234', '2022-08-17', 'Male', '0244261386', 'GHA-000370224-4', '123ff', 'college of humanities and legal studies', 'Faculty', 'Provost Office', 'PhD Computer Science', 'images/330px-Elon_Musk_Royal_Society.jpg', 'ddddd', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `id` int(11) DEFAULT NULL,
  `token` int(11) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `reason` char(100) DEFAULT NULL,
  `status` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pid` int(11) NOT NULL,
  `staffid` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `studname` varchar(255) DEFAULT NULL,
  `subdate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `remark` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `eid` int(11) NOT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `base` int(11) NOT NULL,
  `bonus` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alogin`
--
ALTER TABLE `alogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`token`),
  ADD KEY `employee_leave_ibfk_1` (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `project_ibfk_1` (`staffid`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alogin`
--
ALTER TABLE `alogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `employee_leave_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`staffid`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rank`
--
ALTER TABLE `rank`
  ADD CONSTRAINT `rank_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
