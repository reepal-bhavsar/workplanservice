-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2022 at 04:26 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `work_planning_service_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `2_worker_shift`
--

CREATE TABLE IF NOT EXISTS `2_worker_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shiftmasterid` int(11) NOT NULL,
  `shiftdate` date NOT NULL,
  `shifttype` tinyint(4) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24',
  PRIMARY KEY (`shiftid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `2_worker_shift`
--

INSERT INTO `2_worker_shift` (`shiftid`, `shiftmasterid`, `shiftdate`, `shifttype`) VALUES
(1, 1, '2022-04-04', 1),
(2, 1, '2022-04-05', 2),
(3, 1, '2022-04-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `3_worker_shift`
--

CREATE TABLE IF NOT EXISTS `3_worker_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shiftmasterid` int(11) NOT NULL,
  `shiftdate` date NOT NULL,
  `shifttype` tinyint(4) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24',
  PRIMARY KEY (`shiftid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `3_worker_shift`
--

INSERT INTO `3_worker_shift` (`shiftid`, `shiftmasterid`, `shiftdate`, `shifttype`) VALUES
(1, 2, '2022-04-04', 1),
(2, 2, '2022-04-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `4_worker_shift`
--

CREATE TABLE IF NOT EXISTS `4_worker_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shiftmasterid` int(11) NOT NULL,
  `shiftdate` date NOT NULL,
  `shifttype` tinyint(4) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24',
  PRIMARY KEY (`shiftid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `4_worker_shift`
--

INSERT INTO `4_worker_shift` (`shiftid`, `shiftmasterid`, `shiftdate`, `shifttype`) VALUES
(1, 3, '2022-04-04', 3),
(2, 3, '2022-04-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `5_worker_shift`
--

CREATE TABLE IF NOT EXISTS `5_worker_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shiftmasterid` int(11) NOT NULL,
  `shiftdate` date NOT NULL,
  `shifttype` tinyint(4) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24',
  PRIMARY KEY (`shiftid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `5_worker_shift`
--

INSERT INTO `5_worker_shift` (`shiftid`, `shiftmasterid`, `shiftdate`, `shifttype`) VALUES
(1, 4, '2022-04-04', 3);

-- --------------------------------------------------------

--
-- Table structure for table `6_worker_shift`
--

CREATE TABLE IF NOT EXISTS `6_worker_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shiftmasterid` int(11) NOT NULL,
  `shiftdate` date NOT NULL,
  `shifttype` tinyint(4) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24',
  PRIMARY KEY (`shiftid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `6_worker_shift`
--

INSERT INTO `6_worker_shift` (`shiftid`, `shiftmasterid`, `shiftdate`, `shifttype`) VALUES
(1, 5, '2022-04-07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `7_worker_shift`
--

CREATE TABLE IF NOT EXISTS `7_worker_shift` (
  `shiftid` int(11) NOT NULL AUTO_INCREMENT,
  `shiftmasterid` int(11) NOT NULL,
  `shiftdate` date NOT NULL,
  `shifttype` tinyint(4) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24',
  PRIMARY KEY (`shiftid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `7_worker_shift`
--


-- --------------------------------------------------------

--
-- Table structure for table `shift_master`
--

CREATE TABLE IF NOT EXISTS `shift_master` (
  `shiftmasterid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`shiftmasterid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `shift_master`
--

INSERT INTO `shift_master` (`shiftmasterid`, `userid`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `ufname` varchar(500) NOT NULL,
  `ulname` varchar(255) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `utype` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=worker, 1=admin',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`uid`, `uname`, `ufname`, `ulname`, `upassword`, `phone`, `email`, `utype`) VALUES
(1, 'admin', 'Admin', 'admin', 'admin123', '+491234567890', 'admin@gmail.com', 1),
(2, 'dummyuser1', 'Dummy', 'UserOne', 'dummyuser1123', '+491234567890', 'dummyuser1@gmail.com', 0),
(3, 'dummyuser2', 'Dummy', 'UserTwo', 'dummyuser2123', '+491234567890', 'dummyuser2@gmail.com', 0),
(4, 'dummyuser3', 'Dummy', 'UserThree', 'dummyuser3123', '+491234567890', 'dummyuser3@gmail.com', 0),
(5, 'dummyuser4', 'Dummy', 'UserFour', 'dummyuser4123', '+491234567890', 'dummyuser4@gmail.com', 0),
(6, 'dummyuser5', 'Dummy', 'UserFive', 'dummyuser5123', '+491234567890', 'dummyuser5@gmail.com', 0),
(7, 'dummyuser6', 'Dummy', 'UserSix', 'dummyuser6123', '+491234567890', 'dummyuser6@gmail.com', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
