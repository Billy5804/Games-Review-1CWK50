-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2020 at 10:19 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
  `enableComments` tinyint(1) NOT NULL DEFAULT 1,
  `reviewTimestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `activereviews`
--

INSERT INTO `activereviews` (`reviewID`, `reviewerID`, `gameID`, `review`, `enableComments`, `reviewTimestamp`) VALUES
(1, 1, 1, 'This is the 1st test review of the game Borderlands 3', 1, '2020-03-03 16:19:57'),
(2, 7, 1, 'This is the 2nd test review of the game Borderlands 3', 1, '2020-01-11 17:19:49'),
(3, NULL, 1, 'This is the 3rd test review of the game Borderlands 3', 1, '2020-02-24 21:40:35'),
(17, NULL, 2, 'This is the 1st test review of the game Animal Crossing: New Horizons.', 0, '2020-02-10 15:11:25'),
(18, 2, 2, 'This is the 2nd test review of the game Animal Crossing: New Horizons.', 0, '2020-02-02 12:53:42'),
(19, NULL, 2, 'This is the 3rd test review of the game Animal Crossing: New Horizons.', 1, '2020-01-26 05:33:19'),
(20, 4, 3, 'This is the 1st test review of the game Halo The Master Chief Collection.', 1, '2020-01-12 06:20:05'),
(21, 8, 3, 'This is the 2nd test review of the game Halo The Master Chief Collection.', 0, '2020-03-13 07:21:18'),
(22, 9, 3, 'This is the 3rd test review of the game Halo The Master Chief Collection.', 1, '2020-02-22 03:16:23'),
(23, 3, 4, 'This is the 1st test review of the game Control.', 0, '2020-03-09 22:28:49'),
(24, NULL, 4, 'This is the 2nd test review of the game Control.', 0, '2020-01-13 21:10:44'),
(25, 4, 4, 'This is the 3rd test review of the game Control.', 0, '2020-03-02 17:53:59'),
(26, 6, 5, 'This is the 1st test review of the game Cyberpunk 2077.', 1, '2020-01-24 01:04:59'),
(27, 5, 5, 'This is the 2nd test review of the game Cyberpunk 2077.', 1, '2020-01-09 04:29:17'),
(28, 5, 5, 'This is the 3rd test review of the game Cyberpunk 2077.', 1, '2020-03-18 10:55:47'),
(29, 1, 6, 'This is the 1st test review of the game DOOM Eternal.', 1, '2020-01-22 03:42:51'),
(30, 4, 6, 'This is the 2nd test review of the game DOOM Eternal.', 1, '2020-01-28 03:05:25'),
(31, 2, 6, 'This is the 3rd test review of the game DOOM Eternal.', 1, '2020-02-14 14:00:55'),
(32, 8, 7, 'This is the 1st test review of the game STAR WARS Jedi: Fallen Order.', 1, '2020-01-03 22:20:49'),
(33, 7, 7, 'This is the 2nd test review of the game STAR WARS Jedi: Fallen Order.', 1, '2020-01-11 12:16:00'),
(34, 1, 7, 'This is the 3rd test review of the game STAR WARS Jedi: Fallen Order.', 1, '2020-01-17 06:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameID` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `blurb` longtext NOT NULL,
  `slug` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameID`, `name`, `blurb`, `slug`, `image`) VALUES
(1, 'Borderlands 3', 'The original shooter-looter returns, packing bazillions of guns and a mayhem-fueled adventure! Blast through new worlds & enemies and save your home from the most ruthless cult leaders in the galaxy.\r\n-Gearbox Software & 2K', 'borderlands-3', 'borderlands-3.jpg'),
(2, 'Animal Crossing: New Horizons', 'A nonlinear life simulator played in real-time. The player assumes the role of a customizable character who moves to a deserted island after purchasing a vacation package from Tom Nook, a raccoon character who is a staple of the series.\r\n-IMDb', 'animal-crossing-new-horizons', 'animal-crossing-new-horizons.jpg'),
(3, 'Halo: The Master Chief Collection', 'The Master Chief’s iconic journey includes six games, built for PC and collected in a single integrated experience where each game is delivered over time. Whether you’re a long-time fan or meeting Spartan 117 for the first time, The Master Chief Collection is the definitive Halo gaming experience.\r\n-343 Industries', 'halo-mcc', 'halo-mcc.jpg'),
(4, 'Control', 'After a secretive agency in New York is invaded by an otherworldly threat, you become the new Director struggling to regain Control in this supernatural 3rd person action-adventure from Remedy Entertainment and 505 Games.\r\n-Remedy Entertainment & 505 Games', 'control', 'control.jpg'),
(5, 'Cyberpunk 2077', 'Cyberpunk 2077 is an open-world, action-adventure story set in Night City, a megalopolis obsessed with power, glamour and body modification. You play as V, a mercenary outlaw going after a one-of-a-kind implant that is the key to immortality.\r\n-CD PROJEKT RED', 'cyberpunk-2077', 'cyberpunk-2077.jpg'),
(6, 'DOOM Eternal', 'Hell’s armies have invaded Earth. Become the Slayer in an epic single-player campaign to conquer demons across dimensions and stop the final destruction of humanity. The only thing they fear... is you.\r\n-id Software & Bethesda Softworks ', 'doom-ethernal', 'doom-ethernal.jpg'),
(7, 'STAR WARS Jedi: Fallen Order', 'A galaxy-spanning adventure awaits in Star Wars Jedi: Fallen Order, a 3rd person action-adventure title from Respawn. An abandoned Padawan must complete his training, develop new powerful Force abilities, and master the art of the lightsaber - all while staying one step ahead of the Empire.\r\n-Respawn Entertainment & Electronic Arts', 'jedi-fallen-order', 'jedi-fallen-order.jpg');

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
(12, NULL, 1, '', '2020-03-03 15:39:52'),
(13, 1, 2, 'Comment added from web page', '2020-03-03 15:39:52');

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
(1, 'Lecturer', 'Example', 1, 1),
(2, 'Alex', 'Password', 0, 1),
(3, 'Einstein', 'Password', 0, 0),
(4, 'Luke', 'Password', 0, 0),
(5, 'Eleanor', 'Password', 0, 0),
(6, 'Rocky', 'Password', 0, 0),
(7, 'Gunner', 'Password', 0, 0),
(8, 'Missy', 'Password', 1, 0),
(9, 'Dare', 'Password', 1, 0);

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
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gamescomments`
--
ALTER TABLE `gamescomments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
