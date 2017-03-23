-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2014 at 05:26 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bedentrance`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE IF NOT EXISTS `grade_level` (
  `grade_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade_level_n` varchar(20) NOT NULL,
  PRIMARY KEY (`grade_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
(15, 'Third Year'),
(16, 'Fourth Year');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level_section`
--

CREATE TABLE IF NOT EXISTS `grade_level_section` (
  `grade_level_section_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade_level_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  PRIMARY KEY (`grade_level_section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `grade_level_section`
--

INSERT INTO `grade_level_section` (`grade_level_section_id`, `grade_level_id`, `section_id`, `school_year_id`) VALUES
(7, 8, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `libstaff`
--

CREATE TABLE IF NOT EXISTS `libstaff` (
  `libstaff_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`libstaff_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `libstaff`
--

INSERT INTO `libstaff` (`libstaff_id`, `fullname`, `username`, `password`) VALUES
(7, 'Ms. MJ Suarez', 'mj', '81dc9bdb52d04dc20036dbd8313ed055'),
(12, 'Provir Tare', 'biboy', '4a7b45822b9066df3ca7180bf5a4e342');

-- --------------------------------------------------------

--
-- Table structure for table `patron`
--

CREATE TABLE IF NOT EXISTS `patron` (
  `patron_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(7) NOT NULL,
  `fn` varchar(20) NOT NULL,
  `ln` varchar(20) NOT NULL,
  `mn` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`patron_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`patron_id`, `id_number`, `fn`, `ln`, `mn`, `filename`) VALUES
(68, '08-0035', 'Jasfer Levin', 'Eltanal', 'L.', '');

-- --------------------------------------------------------

--
-- Table structure for table `patron_grade_level`
--

CREATE TABLE IF NOT EXISTS `patron_grade_level` (
  `patron_grade_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(7) NOT NULL,
  `grade_level_section_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  PRIMARY KEY (`patron_grade_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `patron_grade_level`
--

INSERT INTO `patron_grade_level` (`patron_grade_level_id`, `id_number`, `grade_level_section_id`, `school_year_id`) VALUES
(1, '08-0035', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE IF NOT EXISTS `school_year` (
  `school_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year_n` varchar(9) NOT NULL,
  PRIMARY KEY (`school_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`school_year_id`, `school_year_n`) VALUES
(1, '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_n` varchar(50) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_n`) VALUES
(6, 'Our Lady of Assumption');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(7) NOT NULL,
  `patron_grade_level_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_wo_hyphen1` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visit_id`, `id_number`, `patron_grade_level_id`, `date_in`, `date_wo_hyphen1`, `school_year_id`) VALUES
(79, '08-0035', 1, '2014-01-06', 20140106, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
