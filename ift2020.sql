-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 07:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ift2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `throwback`
--

CREATE TABLE `throwback` (
  `id` int(255) NOT NULL,
  `upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `throwback`
--

INSERT INTO `throwback` (`id`, `upload`) VALUES
(1, 'throwback/60c889e5cd2189.84541068.png'),
(2, 'throwback/60c8cd892a6711.53327926.png');

-- --------------------------------------------------------

--
-- Table structure for table `yearbook`
--

CREATE TABLE `yearbook` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yearbook`
--

INSERT INTO `yearbook` (`id`, `name`, `comment`, `upload`) VALUES
(1, 'Paul Nnadi', 'This is the yearbook', 'yearbook/60c887cede0391.25091660.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `throwback`
--
ALTER TABLE `throwback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearbook`
--
ALTER TABLE `yearbook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `throwback`
--
ALTER TABLE `throwback`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yearbook`
--
ALTER TABLE `yearbook`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
