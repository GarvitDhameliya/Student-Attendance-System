-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 11:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_name` varchar(20) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_user_name`, `admin_password`) VALUES
(1, 'admin', '$2a$04$2DoqTr2MdSJ40SzQB9kUpO/asSTJryrvZ21jg5evHGTV1Y6xf6CJq');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `attendance_date` date NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `student_id`, `attendance_status`, `attendance_date`, `teacher_id`) VALUES
(69, 5, 'Present', '2020-08-25', 8),
(70, 11, 'Present', '2020-08-25', 8),
(71, 12, 'Absent', '2020-08-25', 8),
(72, 13, 'Absent', '2020-08-25', 8),
(73, 14, 'Present', '2020-08-25', 8),
(74, 5, 'Absent', '2020-08-26', 8),
(75, 11, 'Absent', '2020-08-26', 8),
(76, 12, 'Present', '2020-08-26', 8),
(77, 13, 'Present', '2020-08-26', 8),
(78, 14, 'Absent', '2020-08-26', 8),
(79, 5, 'Present', '2020-08-27', 8),
(80, 11, 'Present', '2020-08-27', 8),
(81, 12, 'Present', '2020-08-27', 8),
(82, 13, 'Present', '2020-08-27', 8),
(83, 14, 'Present', '2020-08-27', 8),
(84, 5, 'Absent', '2020-08-28', 8),
(85, 11, 'Present', '2020-08-28', 8),
(86, 12, 'Present', '2020-08-28', 8),
(87, 13, 'Present', '2020-08-28', 8),
(88, 14, 'Present', '2020-08-28', 8),
(89, 5, 'Absent', '2020-08-24', 8),
(90, 11, 'Absent', '2020-08-24', 8),
(91, 12, 'Present', '2020-08-24', 8),
(92, 13, 'Present', '2020-08-24', 8),
(93, 14, 'Absent', '2020-08-24', 8),
(94, 15, 'Present', '2020-08-24', 15),
(95, 16, 'Present', '2020-08-24', 15),
(96, 17, 'Present', '2020-08-24', 15),
(97, 15, 'Present', '2020-08-25', 15),
(98, 16, 'Absent', '2020-08-25', 15),
(99, 17, 'Present', '2020-08-25', 15),
(100, 15, 'Present', '2020-08-26', 15),
(101, 16, 'Absent', '2020-08-26', 15),
(102, 17, 'Absent', '2020-08-26', 15),
(103, 15, 'Present', '2020-08-27', 15),
(104, 16, 'Present', '2020-08-27', 15),
(105, 17, 'Present', '2020-08-27', 15),
(106, 15, 'Absent', '2020-08-28', 15),
(107, 16, 'Absent', '2020-08-28', 15),
(108, 17, 'Present', '2020-08-28', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `grade_id` int(255) NOT NULL,
  `grade_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grade`
--

INSERT INTO `tbl_grade` (`grade_id`, `grade_name`) VALUES
(1, '11 - A'),
(33, '11 - B'),
(36, '12 - A'),
(37, '12 - B'),
(41, '11 - C'),
(42, '11 -D'),
(44, '12 - D'),
(45, '12 - E'),
(46, '10 - A'),
(47, '10 - B'),
(48, '10 - C'),
(50, '10 - D');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(25) NOT NULL,
  `student_roll_number` int(11) NOT NULL,
  `student_dob` date NOT NULL,
  `student_grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_roll_number`, `student_dob`, `student_grade_id`) VALUES
(5, 'Darshan Kheni', 1, '2001-10-01', 1),
(11, 'sangita bhayani', 2, '2001-08-03', 1),
(12, 'anurag bhanderi', 3, '2001-07-02', 1),
(13, 'Darshak Mangroliya', 4, '2002-10-26', 1),
(14, 'Mitul Bhatiya', 5, '2002-10-05', 1),
(15, 'Ram Avasti', 1, '2002-01-15', 33),
(16, 'Shayam Darbar', 2, '2001-03-20', 33),
(17, 'Raghu Pathak', 3, '2001-02-21', 33);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(150) NOT NULL,
  `teacher_address` text NOT NULL,
  `teacher_emailid` varchar(100) NOT NULL,
  `teacher_password` varchar(100) NOT NULL,
  `teacher_qualification` varchar(100) NOT NULL,
  `teacher_doj` date NOT NULL,
  `teacher_image` varchar(100) NOT NULL,
  `teacher_grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_image`, `teacher_grade_id`) VALUES
(4, 'electra ray', '', 'electra.ray@email.com', '', '', '2020-07-09', 'electra.png', 37),
(5, 'Alisia Baker', '76, jenson house torreto streat, vatican city', 'alisia.baker@gmail.com', '$2y$10$E.y04zk25aVl91Y9tx0acOxoM6eOhb9hxqN3wO9nxwoS3Au8K.c1.', 'M Teach', '2020-08-11', '5f337662e4bfb.jpg', 46),
(8, 'Vivek Bodarya', 'D 401, shivanjali heights 2, mota varacha', 'vivekbodarya6@gmail.com', '$2y$10$//ikhLIKshMWe6wKBg8CduG0bF2Hp.roNgdu5ejiiN0CfeIyusmsa', 'B Tech ', '2020-08-12', '5f47d103e216b.jpg', 1),
(13, 'Peter Parker', '85 north downey new york', 'peter.parker@gmail.com', '$2y$10$7fBvJscczGTSYACyQJCQ0O7aCZ17Av3Km35KBNAolsAy7QBh1FE9C', 'M Teach ', '2020-08-27', '5f47739e11619.jpg', 50),
(14, 'Joy Tarhun', '103 volken streat', 'joy.tarhun@gmail.com', '$2y$10$PQb1xPj5p4gCQBpkwLZuf.AG9WM0VReTIVurKjYuo0yTdU7kKyPdC', 'M Teach ', '2020-08-27', '5f4773f3756cd.jpg', 41),
(15, 'Venesa Roy', '103 mavel luxria new york', 'venesa.roy@gmail.com', '$2y$10$FFkt6ulJyf/G6zoHRDYx.uVEkM5DH4tebOLGzWjzJ2IiFVG/54k6C', 'Msc Physics', '2020-08-27', '5f47748dbfc9d.jpg', 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `grade_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
