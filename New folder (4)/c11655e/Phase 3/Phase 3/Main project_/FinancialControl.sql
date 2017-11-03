-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2017 at 07:24 PM
-- Server version: 5.7.18
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FinancialControl`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bonds`
--

CREATE TABLE `Bonds` (
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `bond` varchar(40) NOT NULL,
  `value` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Bonds`
--

INSERT INTO `Bonds` (`dateAdded`, `user`, `bond`, `value`) VALUES
('2017-04-24 23:51:33', 6, 'Example Bond', '95.92');

-- --------------------------------------------------------

--
-- Table structure for table `Cash`
--

CREATE TABLE `Cash` (
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cash`
--

INSERT INTO `Cash` (`dateAdded`, `user`, `amount`) VALUES
('2017-04-25 00:00:05', 6, '100.62');

-- --------------------------------------------------------

--
-- Table structure for table `Stocks`
--

CREATE TABLE `Stocks` (
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `ticker` varchar(8) NOT NULL,
  `shares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Stocks`
--

INSERT INTO `Stocks` (`dateAdded`, `user`, `ticker`, `shares`) VALUES
('2017-04-30 23:35:21', 6, 'goog', 10),
('2017-05-02 13:36:57', 6, 'MSFT', 0),
('2017-05-02 13:37:32', 6, 'AMZN', 0),
('2017-05-02 13:37:55', 6, 'AAPL', 0),
('2017-05-02 13:39:06', 6, 'WEN', 300),
('2017-05-02 13:40:15', 6, 'DDLS', 100);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userID`, `userName`) VALUES
(6, 'JeffMcDonald');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
