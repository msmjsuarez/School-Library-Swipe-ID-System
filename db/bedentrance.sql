-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 07:32 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bedentrance`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `grade_level_id` int(11) NOT NULL,
  `grade_level_n` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`grade_level_id`, `grade_level_n`) VALUES
(1, 'K1'),
(2, 'K2'),
(3, 'Grade 1'),
(4, 'Grade 2'),
(5, 'Grade 3'),
(6, 'Grade 4'),
(7, 'Grade 5'),
(8, 'Grade 6'),
(9, 'Grade 7'),
(10, 'Grade 8'),
(11, 'Grade 9'),
(12, 'Grade 10'),
(13, 'Grade 11'),
(14, 'Grade 12'),
(15, 'Personnel');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level_section`
--

CREATE TABLE `grade_level_section` (
  `grade_level_section_id` int(11) NOT NULL,
  `grade_level_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_level_section`
--

INSERT INTO `grade_level_section` (`grade_level_section_id`, `grade_level_id`, `section_id`, `school_year_id`) VALUES
(9, 1, 7, 5),
(10, 2, 8, 5),
(11, 3, 9, 5),
(12, 4, 10, 5),
(13, 5, 11, 5),
(14, 6, 12, 5),
(15, 7, 13, 5),
(16, 8, 14, 5),
(17, 9, 17, 5),
(18, 10, 19, 5),
(19, 11, 20, 5),
(20, 11, 21, 5),
(21, 9, 15, 5),
(22, 9, 16, 5),
(23, 10, 18, 5),
(24, 11, 22, 5),
(25, 12, 23, 5),
(26, 12, 24, 5),
(27, 12, 25, 5),
(28, 13, 26, 5),
(29, 13, 27, 5),
(30, 13, 28, 5),
(31, 13, 29, 5),
(32, 13, 30, 5),
(33, 13, 31, 5),
(34, 13, 32, 5),
(35, 15, 37, 5),
(36, 15, 34, 5),
(37, 15, 35, 5),
(38, 15, 33, 5),
(39, 15, 36, 5);

-- --------------------------------------------------------

--
-- Table structure for table `libstaff`
--

CREATE TABLE `libstaff` (
  `libstaff_id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libstaff`
--

INSERT INTO `libstaff` (`libstaff_id`, `fullname`, `username`, `password`) VALUES
(7, 'Ms. MJ Suarez', 'mj', '007de96adfa8b36dc2c8dd268d039129'),
(12, 'Provir Tare', 'biboy', '4a7b45822b9066df3ca7180bf5a4e342');

-- --------------------------------------------------------

--
-- Table structure for table `patron`
--

CREATE TABLE `patron` (
  `patron_id` int(11) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `fn` varchar(20) NOT NULL,
  `ln` varchar(20) NOT NULL,
  `mn` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patron_grade_level`
--

CREATE TABLE `patron_grade_level` (
  `patron_grade_level_id` int(11) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `grade_level_section_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `school_year_id` int(11) NOT NULL,
  `school_year_n` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`school_year_id`, `school_year_n`) VALUES
(5, '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_n` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_n`) VALUES
(7, 'Joy'),
(8, 'Peace'),
(9, 'Love'),
(10, 'Faith'),
(11, 'Sincerity'),
(12, 'Trust'),
(13, 'Hope'),
(14, 'Simplicity'),
(15, 'Competence'),
(16, 'Courtesy'),
(17, 'Compassion'),
(18, 'Fidelity'),
(19, 'Fortitude'),
(20, 'Honesty'),
(21, 'Humility'),
(22, 'Harmony'),
(23, 'Prosperity'),
(24, 'Prudence'),
(25, 'Passion'),
(26, 'Our Lady Of Fatima'),
(27, 'Our Lady Of Lourdes'),
(28, 'Our Lady Of Immaculate Conception'),
(29, 'Our Lady Of Perpetual Help'),
(30, 'Our Lady Of Guadalupe'),
(31, 'Our Lady Of Assumption'),
(32, 'Our Lady Of Mt. Carmel'),
(33, 'HEd Faculty'),
(34, 'BEd Faculty'),
(35, 'BEd Staff'),
(36, 'HEd Staff'),
(37, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visit_id` int(11) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `patron_grade_level_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_wo_hyphen1` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `otherpurpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visit_purpose`
--

CREATE TABLE `visit_purpose` (
  `visit_purpose_id` int(11) NOT NULL,
  `purpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit_purpose`
--

INSERT INTO `visit_purpose` (`visit_purpose_id`, `purpose`) VALUES
(1, 'Make Assignment / Project'),
(2, 'Borrow / Return Book/s'),
(3, 'Do Research'),
(4, 'Use Online Catalog'),
(5, 'Read Magazines / Journal /News Papers'),
(6, 'Use of Internet / Wi-Fi'),
(7, 'Consult Librarian / Faculty'),
(8, 'Consult with Faculty'),
(9, 'Study'),
(10, 'Read E-books / Electronic Resources'),
(11, 'Access to E-Journals'),
(12, 'Class Activity / Library Period'),
(13, 'Others');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `grade_level_section`
--
ALTER TABLE `grade_level_section`
  ADD PRIMARY KEY (`grade_level_section_id`);

--
-- Indexes for table `libstaff`
--
ALTER TABLE `libstaff`
  ADD PRIMARY KEY (`libstaff_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `patron`
--
ALTER TABLE `patron`
  ADD PRIMARY KEY (`patron_id`);

--
-- Indexes for table `patron_grade_level`
--
ALTER TABLE `patron_grade_level`
  ADD PRIMARY KEY (`patron_grade_level_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`school_year_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `visit_purpose`
--
ALTER TABLE `visit_purpose`
  ADD PRIMARY KEY (`visit_purpose_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `grade_level_section`
--
ALTER TABLE `grade_level_section`
  MODIFY `grade_level_section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `libstaff`
--
ALTER TABLE `libstaff`
  MODIFY `libstaff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `patron`
--
ALTER TABLE `patron`
  MODIFY `patron_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `patron_grade_level`
--
ALTER TABLE `patron_grade_level`
  MODIFY `patron_grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `school_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
--
-- AUTO_INCREMENT for table `visit_purpose`
--
ALTER TABLE `visit_purpose`
  MODIFY `visit_purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
