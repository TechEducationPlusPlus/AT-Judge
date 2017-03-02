-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2017 at 08:32 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `judge`
--

-- --------------------------------------------------------

--
-- Table structure for table `Checker`
--

CREATE TABLE `Checker` (
  `ID` text NOT NULL,
  `CheckLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Checker`
--

INSERT INTO `Checker` (`ID`, `CheckLink`) VALUES
('diff', 'localhost:49152');

-- --------------------------------------------------------

--
-- Table structure for table `Contests`
--

CREATE TABLE `Contests` (
  `ID` text NOT NULL,
  `Name` text NOT NULL,
  `Link` text NOT NULL,
  `Tasks` text NOT NULL,
  `Langs` text NOT NULL,
  `Certify` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contests`
--

INSERT INTO `Contests` (`ID`, `Name`, `Link`, `Tasks`, `Langs`, `Certify`) VALUES
('1', 'I/O Stream :: C++', '/contests/1', '{\"Hello, C++\": 1}', '{\"cpp\": \"C++\", \"py\": \"Python\"}', 0),
('2', 'First Certificate :: C++', '/contests/2', '{\"Hello, C++\": 1}', '{\"cpp\": \"C++\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Submissions`
--

CREATE TABLE `Submissions` (
  `ID` text NOT NULL,
  `ContestID` text NOT NULL,
  `TaskID` text NOT NULL,
  `UserID` text NOT NULL,
  `Code` longtext NOT NULL,
  `Lang` tinytext NOT NULL,
  `Points` float DEFAULT NULL,
  `Log` text NOT NULL,
  `CompileLog` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Submissions`
--

--INSERT INTO `Submissions` (`ID`, `ContestID`, `TaskID`, `UserID`, `Code`, `Lang`, `Points`, `Log`, `CompileLog`) VALUES
--('0', '1', '1', 'alex@tsalex.tk', '%23include+%3Ciostream%3E%0D%0A%0D%0Aint+main+%28%29%0D%0A%7B%0D%0A++std%3A%3Acout+%3C%3C+%22Hello%2C+C%2B%2B%22+%3C%3C+%22%5Cn%22%3B%0D%0A%7D', 'cpp', 100, '[[\"OK\",1]]', '');

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
  `ID` text NOT NULL,
  `Name` text NOT NULL,
  `DescriptionLink` text NOT NULL,
  `TestsLink` text NOT NULL,
  `Input` text NOT NULL,
  `Output` text NOT NULL,
  `Checker` text NOT NULL,
  `StarNotation` text NOT NULL,
  `MaxPoints` text NOT NULL,
  `TL` text NOT NULL,
  `ML` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Tasks`
--

INSERT INTO `Tasks` (`ID`, `Name`, `DescriptionLink`, `TestsLink`, `Input`, `Output`, `Checker`, `StarNotation`, `MaxPoints`, `TL`, `ML`) VALUES
('1', 'Hello, C++', 'https://github.com/TechEducationPlusPlus/Tasks/blob/master/C%2B%2B/IO%20Stream/Hello_C%2B%2B/README.md', 'https://raw.githubusercontent.com/TechEducationPlusPlus/Tasks/master/C%2B%2B/IO%20Stream/Hello_C%2B%2B/tests/', 'hello.*.in', 'hello.*.sol', 'diff', '01', '100', '0.1s', '256M');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` text NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Name` text NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

--INSERT INTO `Users` (`ID`, `Username`, `Password`, `Email`, `Name`, `Admin`)
--VALUES
--('0', 'alex_ts', 'a204d95d18da65e6150c2b549aadc3e5', 'alex@tsalex.tk', 'Alex Tsvetanov', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

