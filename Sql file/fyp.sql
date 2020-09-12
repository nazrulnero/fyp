-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2020 at 01:18 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2020-05-12 17:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblcoordinator`
--

CREATE TABLE `tblcoordinator` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcoordinator`
--

INSERT INTO `tblcoordinator` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'coordinator', 'c4ca4238a0b923820dcc509a6f75849b', '2020-08-28 20:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'Human Resource', 'HR', 'HR001', '2017-10-31 23:16:25'),
(2, 'Information Technology', 'IT', 'IT001', '2017-10-31 23:19:37'),
(3, 'Operations', 'OP', 'OP1', '2017-12-02 13:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, 'EMP10806121', 'Anuj', 'kuma', 'anuj@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Male', '3 February, 1990', 'Human Resource', 'New Delhi', 'Delhi', 'India', '9857555555', 1, '2017-11-10 03:29:59'),
(2, 'DEMP2132', 'Amit', 'kumar', 'test@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Male', '3 February, 1990', 'Information Technology', 'New Delhi', 'Delhi', 'India', '8587944255', 1, '2017-11-10 05:40:02'),
(3, '52216117437', 'Nazrul', 'Nero', 'nazruleshah@gmail.com', '7ae4ffdcf99fd35c7c0c94da0e3d3a20', 'Male', '2 November, 1994', 'Information Technology', 'Selayang', 'Batu Caves', 'Malaysia', '0115921552', 1, '2020-04-21 19:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblimagelect`
--

CREATE TABLE `tblimagelect` (
  `id` int(11) NOT NULL,
  `Image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `empid`) VALUES
(7, 'Casual Leave', '30/11/2017', '29/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-19 05:11:21', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 23:26:27 ', 2, 1, 1),
(8, 'Medical Leave test', '21/10/2017', '25/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-20 03:14:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-12-02 23:24:39 ', 1, 1, 1),
(9, 'Medical Leave test', '08/12/2017', '12/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 10:26:01', NULL, NULL, 0, 1, 2),
(10, 'Restricted Holiday(RH)', '25/12/2017', '25/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 00:29:07', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 14:06:12 ', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Casual Leave ', '2017-11-01 04:07:56'),
(2, 'Medical Leave test', 'Medical Leave  test', '2017-11-06 05:16:09'),
(3, 'Restricted Holiday(RH)', 'Restricted Holiday(RH)', '2017-11-06 05:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbllecturers`
--

CREATE TABLE `tbllecturers` (
  `id` int(11) NOT NULL,
  `LectId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Picture` varchar(200) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Room` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `Research` varchar(200) NOT NULL,
  `Background` varchar(255) NOT NULL,
  `Nationality` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllecturers`
--

INSERT INTO `tbllecturers` (`id`, `LectId`, `FirstName`, `LastName`, `Picture`, `EmailId`, `Password`, `Gender`, `Room`, `Section`, `Research`, `Background`, `Nationality`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, '11223344', 'Suriana', 'Binti Ismail', '', 'suriana@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '1818', 'Software Engineering', '  Research interests include community detection, heuristic search, data clustering, and evolutionary computation. edit', '  Suriana Ismail is a Senior Lecturer in the Software Engineering Section at Universiti Kuala Lumpur Malaysian Institute of Information Technology (UniKL MIIT). She received M.Sc. degree in Information Technology from Universiti Utara Malaysia, Malaysia, ', 'Malaysian', '01758757', 1, '2020-05-12 01:15:28'),
(2, '13415', ' Noormadinah', 'Allias', '', 'madinah@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '2021', 'System Networking', '1. Mobile network technology\r\n2. Big data\r\n3. IOT\r\n4. Smart cities\r\n5. Network Security', 'Miss Noormadinah Allias is a Lecturer in the System and Network Department at Universiti Kuala Lumpur Malaysian Institute of Information Technology. She received a Master in Information Technology from the University Kuala Lumpur and worked as a lecturer ', 'Malaysian', '2451324', 1, '2020-05-12 01:41:36'),
(3, '413413', 'Abu', 'Bin Ali', '', 'ali@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '2312', 'System Networking', '', '', '', '', 1, '2020-05-17 20:12:28'),
(4, '92836598', 'John', 'Doe', '', 'john@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '2318', 'Software Engineering', '', '', 'American', '', 1, '2020-05-18 00:08:25'),
(5, '2345246', 'Jane', 'Doe', '', 'jane@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '1818', 'System Networking', '', '', '', '', 1, '2020-05-18 00:08:58'),
(7, '438744', 'Test', 'Lecturer', '', 'testlect@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '', 'System Netwok', '', '', '', '', 1, '2020-05-20 04:44:22'),
(8, '1', '1', '1', '', '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Other', '', '', '', '', '', '', 1, '2020-05-21 19:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblprojects`
--

CREATE TABLE `tblprojects` (
  `id` int(11) NOT NULL,
  `ProjTitle` mediumtext NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LecturerRemark` mediumtext DEFAULT NULL,
  `LecturerRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `studid` int(11) DEFAULT NULL,
  `superid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblprojects`
--

INSERT INTO `tblprojects` (`id`, `ProjTitle`, `Description`, `PostingDate`, `LecturerRemark`, `LecturerRemarkDate`, `Status`, `IsRead`, `studid`, `superid`) VALUES
(8, 'Supervisor Designation System', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-05-18 01:58:25', 'Very good, proceed with the requirement gathering.', '2020-05-19 11:04:47 ', 1, 1, 1, NULL),
(9, 'Fingerpint-Based Attendance System', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-05-18 01:59:22', NULL, NULL, 0, 1, 1, NULL),
(10, 'ATM System', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-05-18 02:00:51', NULL, NULL, 0, 1, 2, NULL),
(11, 'Test Project', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-05-18 02:02:12', NULL, NULL, 0, 0, 4, NULL),
(12, 'Test Project 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-05-18 02:03:01', NULL, NULL, 0, 0, 4, NULL),
(13, 'Food For Gelandangan System', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-05-18 02:04:28', NULL, NULL, 0, 1, 5, NULL),
(14, 'Project title', 'Project description', '2020-05-20 05:01:30', 'Comments', '2020-05-20 10:43:07 ', 1, 1, 1, NULL),
(15, 't', 't', '2020-05-22 01:54:37', 'NO LIKEY', '2020-05-22 11:19:54 ', 2, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Major` varchar(100) NOT NULL,
  `Semester` char(100) NOT NULL,
  `Nationality` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `ProjectTitle` varchar(150) NOT NULL,
  `Supervisor` varchar(150) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Major`, `Semester`, `Nationality`, `Phonenumber`, `ProjectTitle`, `Supervisor`, `Status`, `RegDate`) VALUES
(1, '52216117437', 'Nazrul Shah', 'Bin Nero Salim', 'nazruleshah@gmail.com', '7ae4ffdcf99fd35c7c0c94da0e3d3a20', 'Male', '2 November, 1994', 'Software Engineering', '3', 'Malaysian', '0115921551', 'Supervisor Designation System', 'Mdm. Suriana Binti Ismail', 1, '2020-05-12 17:24:18'),
(2, '52216117437', 'Alya', 'Binti Nor Hashimi', 'alya@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '5 September, 1996', 'System Netwok', '3', 'Malaysian', '34', '', '', 1, '2020-05-15 03:00:56'),
(4, '34524635', 'Tom', 'Holland', 'tom@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '', 'Software Engineering', '2', 'British', '', '', '', 1, '2020-05-18 00:10:23'),
(5, '462465246', 'Awadah', 'Binti Abdul Hakeem', 'awadah@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '', 'Software Engineering', '3', '', '', '', '', 1, '2020-05-18 00:12:13'),
(6, '2456442', 'Test', 'Student', 'teststud@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '', 'Software Engineering', '3', '', '', '', '', 1, '2020-05-20 04:47:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcoordinator`
--
ALTER TABLE `tblcoordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblimagelect`
--
ALTER TABLE `tblimagelect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllecturers`
--
ALTER TABLE `tbllecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprojects`
--
ALTER TABLE `tblprojects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`studid`),
  ADD KEY `LectEmail` (`superid`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcoordinator`
--
ALTER TABLE `tblcoordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbllecturers`
--
ALTER TABLE `tbllecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
