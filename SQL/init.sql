-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 17, 2017 at 08:01 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.14

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
('diff', 'localhost:49152')
;

-- --------------------------------------------------------

--
-- Table structure for table `Contests`
--

CREATE TABLE `Contests` (
  `ID` text NOT NULL,
  `Name` text NOT NULL,
  `Link` text NOT NULL,
  `Tasks` text NOT NULL,
  `Langs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contests`
--

INSERT INTO `Contests` (`ID`, `Name`, `Link`, `Tasks`, `Langs`) VALUES
('1', 'I/O Stream :: C++', '/contests/1', '{\"Hello, C++\": 1}', '{\"cpp\": \"C++\"}')
;

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
--('0', '1', '1', 'alex@tsalex.tk', '%2F%2FTask%3A+chas%0D%0A%2F%2FAuthor%3A+Zornica+Dzhenkova%0D%0A%0D%0A%23include+%3Ciostream%3E%0D%0Ausing+namespace+std%3B%0D%0Aint+main%28%29%0D%0A%7B+int+t1%2Ct2%2Cm1%2Cm2%2Cch%2Cmin%2Crez%3B%0D%0A++cin%3E%3Et1%3E%3Em1%3E%3Et2%3E%3Em2%3B%0D%0A++if%28t1%3Ct2%29++ch+%3D+t2-t1-1%3B+%0D%0A++else++ch+%3D+23-t1%2Bt2%3B%0D%0A+++min+%3D+60-m1%2Bm2%3B+%0D%0A++if+%28t1%3D%3Dt2+%26%26+m1%3Cm2%29+%0D%0A++%7B+ch+%3D+0%3B+min+%3D+m2-m1%3B%7D%0D%0A++if%28t1%3D%3Dt2+%26%26+m1+%3D%3D+m2%29+%0D%0A++%7B+ch+%3D+0%3B+min+%3D+0%3B%7D%0D%0A++rez+%3D+ch%2A60+%2B+min%3B%0D%0A++cout%3C%3Crez%3C%3C%22+%22%3B%0D%0A++cout%3C%3Crez%2F30%3C%3Cendl%3B%0D%0A%7D%0D%0A', 'cpp', 100, '[[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1]]', ''),
--('1', '1', '1', 'alex@tsalex.tk', '%2F%2FTask%3A+chas%0D%0A%2F%2FAuthor%3A+Zornica+Dzhenkova%0D%0A%0D%0A%23include+%3Ciostream%3E%0D%0Ausing+namespace+std%3B%0D%0Aint+main%28%29%0D%0A%7B+int+t1%2Ct2%2Cm1%2Cm2%2Cch%2Cmin%2Crez%3B%0D%0A++cin%3E%3Et1%3E%3Em1%3E%3Et2%3E%3Em2%3B%0D%0A++if%28t1%3Ct2%29++ch+%3D+t2-t1-1%3B+%0D%0A++else++ch+%3D+23-t1%2Bt2%3B%0D%0A+++min+%3D+60-m1%2Bm2%3B+%0D%0A++if+%28t1%3D%3Dt2+%26%26+m1%3Cm2%29+%0D%0A++%7B+ch+%3D+0%3B+min+%3D+m2-m1%3B%7D%0D%0A++if%28t1%3D%3Dt2+%26%26+m1+%3D%3D+m2%29+%0D%0A++%7B+ch+%3D+0%3B+min+%3D+0%3B%7D%0D%0A++rez+%3D+ch%2A60+%2B+min%3B%0D%0A++cout%3C%3Crez%3C%3C%22+%22%3B%0D%0A++cout%3C%3Crez%2F30%3C%3Cendl%3B%0D%0A%7D%0D%0A', 'cpp', 100, '[[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1]]', ''),
--('2', '1', '1', 'alex@tsalex.tk', '%2F%2FTask%3A+chas%0D%0A%2F%2FAuthor%3A+Zornica+Dzhenkova%0D%0A%0D%0A%23include+%3Ciostream%3E%0D%0Ausing+namespace+std%3B%0D%0Aint+main%28%29%0D%0A%7B+int+t1%2Ct2%2Cm1%2Cm2%2Cch%2Cmin%2Crez%3B%0D%0A++cin%3E%3Et1%3E%3Em1%3E%3Et2%3E%3Em2%3B%0D%0A++if%28t1%3Ct2%29++ch+%3D+t2-t1-1%3B+%0D%0A++else++ch+%3D+23-t1%2Bt2%3B%0D%0A+++min+%3D+60-m1%2Bm2%3B+%0D%0A++if+%28t1%3D%3Dt2+%26%26+m1%3Cm2%29+%0D%0A++%7B+ch+%3D+0%3B+min+%3D+m2-m1%3B%7D%0D%0A++rez+%3D+ch%2A60+%2B+min%3B%0D%0A++cout%3C%3Crez%3C%3C%22+%22%3B%0D%0A++cout%3C%3Crez%2F30%3C%3Cendl%3B%0D%0A%7D%0D%0A', 'cpp', 90, '[[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"WA\",0],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"WA\",0],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1],[\"OK\",1]]', ''),
--('3', '1', '1', 'meme@xd.com', 'using+System%3B%0D%0A%0D%0Aclass+Program%0D%0A%7B%0D%0A++static+void+Main%28%29%0D%0A++%7B%0D%0A++++Console.Write%28%22Qko%22%29%3B%0D%0A++%7D%0D%0A%7D', 'cs', 0, '[[\"Compilation error\", 0]]', '')
--;

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
('1', 'Hello, C++', 'https://github.com/TechEducationPlusPlus/Tasks/blob/master/C%2B%2B/IO%20Stream/Hello_C%2B%2B/README.md', 'https://raw.githubusercontent.com/TechEducationPlusPlus/Tasks/master/C%2B%2B/IO%20Stream/Hello_C%2B%2B/tests/', 'hello.*.in', 'hello.*.sol', 'diff', '01', '100', '0.1', '256000')
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
('0', 'alex_ts', 'a204d95d18da65e6150c2b549aadc3e5', 'alex@tsalex.tk', 'Alex Tsvetanov', 0)
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
