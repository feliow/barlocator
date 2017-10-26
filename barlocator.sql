-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2017 at 12:47 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barlocator`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bars`
--

CREATE TABLE `Bars` (
  `barID` int(11) NOT NULL,
  `name` char(225) NOT NULL,
  `homepage` varchar(300) NOT NULL,
  `phone` char(40) NOT NULL,
  `agelimit` char(20) NOT NULL,
  `favorite` tinyint(1) NOT NULL,
  `locationFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Bars`
--

INSERT INTO `Bars` (`barID`, `name`, `homepage`, `phone`, `agelimit`, `favorite`, `locationFK`) VALUES
(1, 'Shooters', 'www.shootersbiljard.com/', '36121350', '18', 0, 0),
(2, 'Bongo Bar', 'www.bongobar.se', '36129566', '18', 0, 0),
(3, 'El Duderino', 'www.elduderino.se/', '362912437', '20', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `BLO`
--

CREATE TABLE `BLO` (
  `barID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `openID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `locationID` int(11) NOT NULL,
  `area` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`locationID`, `area`, `address`) VALUES
(1, 'Juneporten', 'Trädgårdsgatan 4');

-- --------------------------------------------------------

--
-- Table structure for table `Openhours`
--

CREATE TABLE `Openhours` (
  `openID` int(11) NOT NULL,
  `day` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Openhours`
--

INSERT INTO `Openhours` (`openID`, `day`) VALUES
(1, 'Monday 16-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bars`
--
ALTER TABLE `Bars`
  ADD PRIMARY KEY (`barID`);

--
-- Indexes for table `BLO`
--
ALTER TABLE `BLO`
  ADD KEY `barID` (`barID`),
  ADD KEY `locationID` (`locationID`),
  ADD KEY `openID` (`openID`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `Openhours`
--
ALTER TABLE `Openhours`
  ADD PRIMARY KEY (`openID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bars`
--
ALTER TABLE `Bars`
  MODIFY `barID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Openhours`
--
ALTER TABLE `Openhours`
  MODIFY `openID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `BLO`
--
ALTER TABLE `BLO`
  ADD CONSTRAINT `blo_ibfk_1` FOREIGN KEY (`barID`) REFERENCES `Bars` (`barID`),
  ADD CONSTRAINT `blo_ibfk_2` FOREIGN KEY (`locationID`) REFERENCES `Location` (`locationID`),
  ADD CONSTRAINT `blo_ibfk_3` FOREIGN KEY (`openID`) REFERENCES `Openhours` (`openID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
