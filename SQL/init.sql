-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:08 PM
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
-- Table structure for table `Certificates`
--

CREATE TABLE `Certificates` (
  `ID` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Course` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Score` int(11) NOT NULL,
  `Date` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Certificates`
--

INSERT INTO `Certificates` (`ID`, `Name`, `Course`, `Score`, `Date`) VALUES
('1', 'TTS', 'C++', 1000, '12.01.2018');

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
  `MaxPoints` text NOT NULL,
  `Certify` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contests`
--

INSERT INTO `Contests` (`ID`, `Name`, `Link`, `Tasks`, `Langs`, `MaxPoints`, `Certify`) VALUES
('1', 'I/O Stream :: C++', '/contests/1', '{\"Hello, C++\": 1}', '{\"cpp\": \"C++\", \"py\": \"Python\"}', '100', 0),
('2', 'First Certificate :: C++', '/contests/2', '{\"Hello, C++\": 1}', '{\"cpp\": \"C++\"}', '100', 1),
('3', '2017-02-28 C group', '/contests/3', '{\"suma\": 2, \"cross\": 3, \"parallelogram\": 4}', '{\"cpp\": \"C++\"}', '300', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Quizes`
--

CREATE TABLE `Quizes` (
  `ID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Link` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tasks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Quizes`
--

INSERT INTO `Quizes` (`ID`, `Link`, `Tasks`, `Name`) VALUES
('1', '/quiz/1', '1', 'Quiz for TechEdu++');

-- --------------------------------------------------------

--
-- Table structure for table `QuizResults`
--

CREATE TABLE `QuizResults` (
  `UserID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `QuizID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Result` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `QuizResults`
--

INSERT INTO `QuizResults` (`UserID`, `QuizID`, `Result`) VALUES
('alex@techedu.cf', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `QuizTasks`
--

CREATE TABLE `QuizTasks` (
  `ID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Options` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Hint` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Points` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `QuizTasks`
--

INSERT INTO `QuizTasks` (`ID`, `Question`, `Options`, `Answer`, `Hint`, `Points`) VALUES
('1', 'What\'s TechEdu++ founder\'s name?', '{\"1\":\"Alex\",\"2\":\"Dimo\",\"3\":\"Marin\"}', '1', 'There is one correct answer', '1');

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

ALTER TABLE `Submissions` ADD `IsEvaluating` BOOLEAN NOT NULL AFTER `CompileLog`;

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
('1', 'Hello, C++', 'https://github.com/TechEducationPlusPlus/Tasks/blob/master/C%2B%2B/IO%20Stream/Hello_C%2B%2B/README.md', 'https://raw.githubusercontent.com/TechEducationPlusPlus/Tasks/master/C%2B%2B/IO%20Stream/Hello_C%2B%2B/tests/', 'hello.*.in', 'hello.*.sol', 'diff', '01', '100', '0.1s', '256M'),
('2', 
	'Suma', 
	'https://github.com/TechEducationPlusPlus/Tasks/blob/master/C%2B%2B/2017-02-28-tests%26authors-C/1-suma/author/suma.pdf',
	'https://raw.githubusercontent.com/TechEducationPlusPlus/Tasks/master/C%2B%2B/2017-02-28-tests%26authors-C/1-suma/tests/', 
	'suma.*.in', 'suma.*.sol', 
	'diff', 
	'01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20', 
	'100', 
	'1s', 
	'256M'),
('3', 
	'Cross', 
	'https://github.com/TechEducationPlusPlus/Tasks/blob/master/C%2B%2B/2017-02-28-tests%26authors-C/2-cross/author/cross-bg.pdf',
	'https://raw.githubusercontent.com/TechEducationPlusPlus/Tasks/master/C%2B%2B/2017-02-28-tests%26authors-C/2-cross/tests/', 
	'cross.*.in', 'cross.*.sol', 
	'diff', 
	'01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25', 
	'100', 
	'1s', 
	'256M'),
('4', 
	'Parallelogram', 
	'https://github.com/TechEducationPlusPlus/Tasks/blob/master/C%2B%2B/2017-02-28-tests%26authors-C/3-parallelogram/author/parallelogram-bg.pdf',
	'https://raw.githubusercontent.com/TechEducationPlusPlus/Tasks/master/C%2B%2B/2017-02-28-tests%26authors-C/3-parallelogram/tests/', 
	'parallelogram.*.in', 'parallelogram.*.sol', 
	'diff', 
	'01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20', 
	'100', 
	'1s', 
	'256M')

;
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

INSERT INTO `Users` (`ID`, `Username`, `Password`, `Email`, `Name`, `Admin`) VALUES
('0', 'alex_ts', 'a204d95d18da65e6150c2b549aadc3e5', 'alex@techedu.cf', 'Alex Tsvetanov', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Certificates`
--
ALTER TABLE `Certificates`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `Quizes`
--
ALTER TABLE `Quizes`
  ADD UNIQUE KEY `Link` (`Link`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
