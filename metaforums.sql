-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 09:31 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metaforums`
--

-- --------------------------------------------------------

--
-- Table structure for table `msban`
--

CREATE TABLE `msban` (
  `ID` int(11) NOT NULL,
  `BanUserID` int(11) NOT NULL,
  `ThreadID` int(11) NOT NULL,
  `ModerateLevel` varchar(255) NOT NULL,
  `Until` timestamp NULL DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mscomment`
--

CREATE TABLE `mscomment` (
  `ID` int(11) NOT NULL,
  `ThreadID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mscomment`
--

INSERT INTO `mscomment` (`ID`, `ThreadID`, `UserID`, `DateCreated`) VALUES
(30, 87, 48, '2021-11-17'),
(31, 88, 48, '2021-11-17'),
(32, 62, 49, '2021-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `msthread`
--

CREATE TABLE `msthread` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ReplyTo` varchar(255) NOT NULL DEFAULT 'None',
  `ForumID` int(11) DEFAULT NULL,
  `Title` varchar(255) NOT NULL DEFAULT 'a Reply',
  `Content` varchar(255) NOT NULL,
  `View` int(18) NOT NULL DEFAULT 0,
  `Replies` int(18) NOT NULL DEFAULT 0,
  `LastReply` timestamp NULL DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT current_timestamp(),
  `Category` varchar(255) NOT NULL,
  `Favourite` int(11) NOT NULL DEFAULT 0,
  `Locked` tinyint(1) NOT NULL DEFAULT 0,
  `Height` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msthread`
--

INSERT INTO `msthread` (`ID`, `UserID`, `ReplyTo`, `ForumID`, `Title`, `Content`, `View`, `Replies`, `LastReply`, `Created`, `Category`, `Favourite`, `Locked`, `Height`) VALUES
(1, 48, 'None', 1, 'OHHHHH ELDEN RING IS HERE', 'tes1\ntes2\ntes3', 233, 8, '2021-11-17 13:53:03', '2021-11-14 17:00:00', 'SoulsBorne', 0, 0, ''),
(2, 49, 'None', 2, 'BLOODBORNE COMING TO PC!!!', 'Source: Trust me bro', 3688, 2002, '2021-11-20 10:48:53', '2021-11-16 06:59:08', 'SoulsBorne', 0, 0, ''),
(3, 43, 'None', 3, 'WELCOME', '', 17, 0, '2021-11-16 13:12:28', '2021-11-16 07:00:58', 'Announcement', 0, 0, ''),
(58, 48, 'None', 58, 'one two three', 'spiderman was epic yes', 211, 10, '2021-11-21 08:04:37', '2021-11-17 12:04:50', 'Movie', 0, 0, ''),
(60, 48, 'johndoe', 58, 'a Reply', 'agree fam', 0, 0, '2021-11-17 12:06:59', '2021-11-17 12:06:59', 'Movie', 0, 0, ''),
(61, 48, 'johndoe', 58, 'a Reply', 'nahh brotah', 0, 0, '2021-11-17 12:07:13', '2021-11-17 12:07:13', 'Movie', 0, 0, ''),
(62, 48, 'johndoe', 2, 'a Reply', 'nahh fam 2 good 2 be true', 0, 0, '2021-11-17 12:13:52', '2021-11-17 12:13:52', 'SoulsBorne', 1, 0, ''),
(63, 48, 'None', 63, 'heheh', 'hehehe', 8, 1, '2021-11-17 13:25:33', '2021-11-17 12:18:58', 'News', 0, 0, ''),
(86, 48, 'johndoe', 1, 'a Reply', 'yes', 0, 0, '2021-11-17 12:39:31', '2021-11-17 12:39:31', 'SoulsBorne', 0, 0, ''),
(87, 48, 'None', 87, 'asdasd', 'asdads', 29, 4, '2021-11-17 13:23:27', '2021-11-17 12:42:30', 'FPS', 1, 0, ''),
(88, 48, 'johndoe', 87, 'a Reply', 'yes brother yes', 0, 0, '2021-11-17 12:42:41', '2021-11-17 12:42:41', 'FPS', 1, 0, ''),
(89, 48, 'johndoe', 87, 'a Reply', 'yeah', 0, 0, '2021-11-17 12:43:04', '2021-11-17 12:43:04', 'FPS', 0, 0, ''),
(90, 48, 'johndoe', 2, 'a Reply', 'bull', 0, 0, '2021-11-17 12:49:13', '2021-11-17 12:49:13', 'SoulsBorne', 0, 0, ''),
(102, 48, 'johndoe', 87, 'a Reply', 'true', 0, 0, '2021-11-17 13:21:43', '2021-11-17 13:21:43', 'FPS', 0, 0, ''),
(105, 48, 'johndoe', 87, 'a Reply', 'asdasda', 0, 0, '2021-11-17 13:23:27', '2021-11-17 13:23:27', 'FPS', 0, 0, ''),
(107, 49, 'None', 107, 'yes', 'hehe', 6, 0, '2021-11-17 13:25:51', '2021-11-17 13:25:51', 'Announcement', 0, 0, ''),
(108, 48, 'johndoe', 58, 'a Reply', 'yeyeye', 0, 0, '2021-11-17 13:41:49', '2021-11-17 13:41:49', 'Movie', 0, 0, ''),
(109, 48, 'johndoe', 1, 'a Reply', 'facts', 0, 0, '2021-11-17 13:42:55', '2021-11-17 13:42:55', 'SoulsBorne', 0, 0, ''),
(110, 48, 'Main Post', 1, 'a Reply', 'asdasdsdsd', 0, 0, '2021-11-17 13:53:03', '2021-11-17 13:53:03', 'SoulsBorne', 0, 0, ''),
(114, 48, 'Main Post', 58, 'a Reply', 'tes', 0, 0, '2021-11-17 13:55:20', '2021-11-17 13:55:20', 'Movie', 0, 0, ''),
(115, 48, 'johndoe', 58, 'a Reply', 'tes', 0, 0, '2021-11-17 13:55:26', '2021-11-17 13:55:26', 'Movie', 0, 0, ''),
(116, 48, 'None', 116, 'asdasd', 'asdadsaasds', 202, 3, '2021-11-20 13:55:17', '2021-11-17 13:56:15', 'Movie', 0, 0, ''),
(117, 48, 'Main Post', 116, 'a Reply', 'sdadsad', 0, 0, '2021-11-17 13:56:33', '2021-11-17 13:56:33', 'Movie', 0, 0, ''),
(118, 48, 'johndoe', 116, 'a Reply', 'asdadas', 0, 0, '2021-11-17 13:56:38', '2021-11-17 13:56:38', 'Movie', 0, 0, ''),
(119, 48, 'None', 119, 'asdadsadas', 'asdads', 7, 4, '2021-11-17 14:04:00', '2021-11-17 14:02:22', 'Animation', 0, 0, ''),
(121, 48, 'Main Post', 119, 'a Reply', 'asdads', 0, 0, '2021-11-17 14:03:44', '2021-11-17 14:03:44', 'Animation', 0, 0, ''),
(122, 48, 'johndoe', 119, 'a Reply', 'asdsad', 0, 0, '2021-11-17 14:03:52', '2021-11-17 14:03:52', 'Animation', 0, 0, ''),
(123, 48, 'johndoe', 119, 'a Reply', 'asdsd', 0, 0, '2021-11-17 14:04:00', '2021-11-17 14:04:00', 'Animation', 0, 0, ''),
(124, 48, 'None', 124, 'asdasd', 'asdasd', 3, 0, '2021-11-17 14:11:47', '2021-11-17 14:11:47', 'Animation', 0, 0, ''),
(129, 48, 'None', 129, 'doom', 'eternal', 15, 4, '2021-11-17 14:23:41', '2021-11-17 14:15:24', 'FPS', 0, 0, ''),
(130, 48, 'johndoe', 129, 'a Reply', 'yeah?', 0, 0, '2021-11-17 14:15:33', '2021-11-17 14:15:33', 'FPS', 0, 0, ''),
(131, 48, 'johndoe', 129, 'a Reply', 'yeah?', 0, 0, '2021-11-17 14:15:39', '2021-11-17 14:15:39', 'FPS', 0, 0, ''),
(132, 48, 'johndoe', 129, 'a Reply', 'no', 0, 0, '2021-11-17 14:15:50', '2021-11-17 14:15:50', 'FPS', 0, 0, ''),
(133, 48, 'johndoe', 129, 'a Reply', 'asdas', 0, 0, '2021-11-17 14:23:41', '2021-11-17 14:23:41', 'FPS', 0, 0, ''),
(137, 48, 'None', 137, 'asdad', 'asdasda', 6, 3, '2021-11-17 14:33:39', '2021-11-17 14:33:05', 'MOBA', 0, 0, ''),
(138, 48, 'johndoe', 137, 'a Reply', 'tes', 0, 0, '2021-11-17 14:33:10', '2021-11-17 14:33:10', 'MOBA', 0, 0, ''),
(139, 48, 'johndoe', 137, 'a Reply', 'yea??', 0, 0, '2021-11-17 14:33:16', '2021-11-17 14:33:16', 'MOBA', 0, 0, ''),
(140, 48, 'johndoe', 137, 'a Reply', 'yea', 0, 0, '2021-11-17 14:33:39', '2021-11-17 14:33:39', 'MOBA', 0, 0, ''),
(158, 48, 'None', 158, '123', 'nononono', 2, 0, '2021-11-20 10:57:31', '2021-11-20 10:57:31', 'Paintings', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `msuser`
--

CREATE TABLE `msuser` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Hashkey` varchar(255) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 0,
  `Role` varchar(5) NOT NULL DEFAULT 'Guest',
  `Token` varchar(25) NOT NULL,
  `ProfileImage` varchar(255) NOT NULL DEFAULT './images/default.jpg',
  `Post` int(11) NOT NULL DEFAULT 0,
  `LastLog` timestamp NULL DEFAULT NULL,
  `Online` tinyint(1) NOT NULL DEFAULT 0,
  `ModStat` varchar(255) NOT NULL DEFAULT 'Active',
  `Assignment` varchar(255) NOT NULL DEFAULT 'None',
  `LastReport` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msuser`
--

INSERT INTO `msuser` (`ID`, `Username`, `Email`, `Hashkey`, `Active`, `Role`, `Token`, `ProfileImage`, `Post`, `LastLog`, `Online`, `ModStat`, `Assignment`, `LastReport`) VALUES
(43, 'asdasd', 'asd@mail.com', '$2y$10$kItAC69mkf.BaeiTf7nlKuOeQpUoBo9rW5G.Ua2n/n/dEbHTdyYce', 1, 'Admin', '0', '', 0, '2021-11-16 10:18:14', 0, 'Active', '', '2021-11-19 17:00:00'),
(44, 'joshuasirus', 'josuasirustara@gmail.com', '$2y$10$j7TKMxCJwxB5Qu4ixA6UrufjrC.JuWM5CuUnQsqGt1PFO7XQu2MEG', 1, 'Guest', '0', './images/default.jpg	', 0, '2021-11-16 10:18:14', 0, 'Active', '', '2021-11-19 17:00:00'),
(48, 'johndoe', 'jckryder123@gmail.com', '$2y$10$cUgvLAexlZpkfYmg8pDJCew4xPbLoVay01EovLORJ9zZghO1yYX0u', 1, 'Mod', 'f086a725256b7d6f359f34db2', './images/default.jpg	', 10, '2021-11-21 09:10:10', 1, 'Active', 'Movie', '2021-10-31 17:00:00'),
(49, 'johndoee', 'jckryder123@gmail.com', '$2y$10$cUgvLAexlZpkfYmg8pDJCew4xPbLoVay01EovLORJ9zZghO1yYX0u', 1, 'Guest', 'f086a725256b7d6f359f34db2', './images/default.jpg	', 1, '2021-11-17 13:25:45', 0, 'Active', '', '2021-11-19 17:00:00'),
(50, 'joshuas', 'josuasirustara@mail.com', '$2y$10$TIBartIqHwj9a4gbruOQw.3fQlZYuVj6PXEB8I/1kknl0VJt94gX2', 0, 'Guest', 'daab33ce36e945e5dce69d88e', './images/default.jpg	', 0, '2021-11-16 10:18:14', 0, 'Active', '', '2021-11-19 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msban`
--
ALTER TABLE `msban`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Thread` (`ThreadID`),
  ADD KEY `FK_BanUser` (`BanUserID`);

--
-- Indexes for table `mscomment`
--
ALTER TABLE `mscomment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `mscomment_ibfk_1` (`UserID`),
  ADD KEY `mscomment_ibfk_2` (`ThreadID`);

--
-- Indexes for table `msthread`
--
ALTER TABLE `msthread`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_User` (`UserID`),
  ADD KEY `FK_ForumID` (`ForumID`);

--
-- Indexes for table `msuser`
--
ALTER TABLE `msuser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msban`
--
ALTER TABLE `msban`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mscomment`
--
ALTER TABLE `mscomment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `msthread`
--
ALTER TABLE `msthread`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `msuser`
--
ALTER TABLE `msuser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msban`
--
ALTER TABLE `msban`
  ADD CONSTRAINT `FK_BanUser` FOREIGN KEY (`BanUserID`) REFERENCES `msuser` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Thread` FOREIGN KEY (`ThreadID`) REFERENCES `msthread` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mscomment`
--
ALTER TABLE `mscomment`
  ADD CONSTRAINT `mscomment_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `msuser` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mscomment_ibfk_2` FOREIGN KEY (`ThreadID`) REFERENCES `msthread` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `msthread`
--
ALTER TABLE `msthread`
  ADD CONSTRAINT `FK_ForumID` FOREIGN KEY (`ForumID`) REFERENCES `msthread` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User` FOREIGN KEY (`UserID`) REFERENCES `msuser` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
