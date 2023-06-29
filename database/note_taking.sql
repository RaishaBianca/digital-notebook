-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 03:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `note_taking`
--

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `List_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`List_ID`, `User_ID`, `Title`) VALUES
(11, 4, 'll');

-- --------------------------------------------------------

--
-- Table structure for table `list_each`
--

CREATE TABLE `list_each` (
  `list_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `list_each_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_each`
--

INSERT INTO `list_each` (`list_id`, `title`, `checked`, `list_each_id`) VALUES
(1, 'oke', 1, 1),
(1, 'ok2 ', 0, 2),
(2, 'ok 3', 1, 3),
(4, 'ok 4', 0, 4),
(3, 'ok', 0, 5),
(5, 'ok', 1, 6),
(6, 'mine', 1, 8),
(1, 'ok', 0, 9),
(1, 'oke', 1, 10),
(1, 'oke', 0, 12),
(1, 'oke', 1, 13),
(1, 'oke', 0, 14),
(7, 'mylist', 1, 15),
(7, 'mylist', 0, 16),
(10, 'ok', 0, 21),
(16, 'd', 0, 27);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `time_in` varchar(50) NOT NULL,
  `last_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_ID` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_ID`, `fullName`, `email`, `password`) VALUES
(1, 'Nathaniel Nkrumah', 'code@gmail.com', 'e9b59046bfad66983177acea12045cb9'),
(2, 'William Abormega', 'nnn@gmail.com', 'd933df149c62be04ea54d3a9bfb0372c'),
(3, 'friend bot', 'friend@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(4, 'test', 'test@gmail.com', '92eb5ffee6ae2fec3ad71c777531578f'),
(6, 'windah', 'ss@gmail.com', '9dd4e461268c8034f5c8564e155c67a6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`List_ID`);

--
-- Indexes for table `list_each`
--
ALTER TABLE `list_each`
  ADD PRIMARY KEY (`list_each_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `List_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `list_each`
--
ALTER TABLE `list_each`
  MODIFY `list_each_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
