-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 09:34 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamereviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `activereviews`
--

CREATE TABLE `activereviews` (
  `reviewID` int(11) NOT NULL,
  `reviewerID` int(11) DEFAULT NULL,
  `gameID` int(11) NOT NULL,
  `review` longtext NOT NULL,
  `enableComments` tinyint(1) NOT NULL,
  `image` varchar(250) NOT NULL,
  `reviewTimestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `activereviews`
--

INSERT INTO `activereviews` (`reviewID`, `reviewerID`, `gameID`, `review`, `enableComments`, `image`, `reviewTimestamp`) VALUES
(1, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(2, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(3, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(4, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(5, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(6, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(7, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(8, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(9, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(10, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(11, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(12, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(13, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(14, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(15, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57'),
(16, 1, 1, 'This is a test review of the game.', 0, 'borderlands-3.jpg', '2020-03-03 16:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameID` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `blurb` longtext NOT NULL,
  `slug` varchar(250) CHARACTER SET utf16 NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameID`, `name`, `blurb`, `slug`, `image`) VALUES
(1, 'Borderlands 3', 'At the hard edge of the galaxy lies a group of planets ruthlessly exploited by militarized corporations. Brimming with loot and violence, this is your home—the Borderlands. Now, a crazed cult known as The Children of the Vault has emerged and is spreading like an interstellar plague. Play solo or co-op as one of four unique Vault Hunters, score loads of loot, and save the galaxy from this fanatical threat.', 'borderlands-3', 'borderlands-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gamescomments`
--

CREATE TABLE `gamescomments` (
  `commentID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `reviewID` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `commentTimestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `gamescomments`
--

INSERT INTO `gamescomments` (`commentID`, `userID`, `reviewID`, `comment`, `commentTimestamp`) VALUES
(1, 1, 1, 'This is a comment that was generated manually in the database.', '2020-03-03 15:39:52'),
(2, 1, 1, 'Comment added from web page', '2020-03-03 15:39:52'),
(10, NULL, 1, '', '2020-03-03 15:39:52'),
(11, NULL, 1, '', '2020-03-03 15:39:52'),
(12, NULL, 1, '', '2020-03-03 15:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `enableDarkMode` tinyint(1) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `enableDarkMode`, `isAdmin`) VALUES
(1, 'Lecturer', 'Example', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activereviews`
--
ALTER TABLE `activereviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD UNIQUE KEY `reviewID` (`reviewID`),
  ADD KEY `reviewerID` (`reviewerID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `gamescomments`
--
ALTER TABLE `gamescomments`
  ADD PRIMARY KEY (`commentID`),
  ADD UNIQUE KEY `UID` (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `reviewID` (`reviewID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `UID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activereviews`
--
ALTER TABLE `activereviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gamescomments`
--
ALTER TABLE `gamescomments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activereviews`
--
ALTER TABLE `activereviews`
  ADD CONSTRAINT `activereviews_ibfk_1` FOREIGN KEY (`reviewerID`) REFERENCES `users` (`userID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activereviews_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `games` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gamescomments`
--
ALTER TABLE `gamescomments`
  ADD CONSTRAINT `gamescomments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `gamescomments_ibfk_2` FOREIGN KEY (`reviewID`) REFERENCES `activereviews` (`reviewID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
