-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2015 at 07:09 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heydatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE IF NOT EXISTS `users_account` (
  `userID` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` set('Male','Female') NOT NULL,
  `city` varchar(30) NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `education` varchar(20) NOT NULL,
  `profilePhoto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`userID`, `name`, `password`, `email`, `birthdate`, `gender`, `city`, `height`, `education`, `profilePhoto`) VALUES
(1, 'Beauty', '7a7f3a70f71ac2372ae60e431b8236bb', 'Beauty@gmail.com', '2003-07-24', 'Female', 'Singapore', 164, 'MBA', '1.jpeg'),
(2, 'Noah', 'cfa36b7c75e18a9dc6e2a35d19a58ee7', 'Noah@gmail.com', '2000-01-01', 'Female', 'Singapore', 170, 'MBA', '2.jpg'),
(3, 'James', 'd52e32f3a96a64786814ae9b5279fbe5', 'James@gmail.com', '2000-01-01', 'Female', 'Singapore', 170, 'MBA', '3.jpg'),
(4, 'Zhao', 'c7d42e3dd6efc36afa732fb393090adf', 'Zhao@gmail.com', '2000-01-28', 'Female', 'Shanghai', 161, 'MBA', '4.jpg'),
(5, 'Ethan', 'e05699b45eae134804f4419d3fbb3139', 'Ethan@gmail.com', '2000-01-01', 'Female', 'Singapore', 170, 'MBA', '5.jpg'),
(6, 'David', '464e07afc9e46359fb480839150595c5', 'David@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '6.jpg'),
(7, 'Lucas', 'c3d41bf5efb468a1bcce53bd53726c85', 'Lucas@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '7.jpg'),
(8, 'Leon', 'd8f7de479b1fae3d85d341f380524de5', 'Leon@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '8.jpg'),
(9, 'Zoey', '69a99f608340f12d821de723a60f3c41', 'Zoey@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '9.jpg'),
(10, 'Model', 'a559b87068921eec05086ce5485e9784', 'Model@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '10.jpg'),
(11, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', NULL),
(12, 'test1', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', NULL),
(13, 'test2', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Female', 'Tokyo', 170, 'test', '13.jpeg'),
(14, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', NULL),
(16, 'test4', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Female', 'Tokyo', 170, 'test', '16.jpeg'),
(17, 'test5', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', '17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_description`
--

CREATE TABLE IF NOT EXISTS `users_description` (
  `descriptionID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_description`
--

INSERT INTO `users_description` (`descriptionID`, `userID`, `description`) VALUES
(1, 1, 'I''m  very very pretty'),
(2, 2, 'I''m sexy'),
(3, 5, 'I''m handsome'),
(4, 6, 'I''m rich'),
(5, 4, 'I''m very hot');

-- --------------------------------------------------------

--
-- Table structure for table `users_photo`
--

CREATE TABLE IF NOT EXISTS `users_photo` (
  `photoID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_photo`
--

INSERT INTO `users_photo` (`photoID`, `userID`, `photo`) VALUES
(4, 2, '2_1.jpg'),
(6, 17, '17_1445540039.jpg'),
(7, 17, '17_1445540056.jpg'),
(8, 17, '17_1445540204.jpeg'),
(11, 1, '1_1445540675.jpg'),
(12, 1, '1_1445542386.jpg'),
(15, 1, '1_1445569587.jpg'),
(18, 4, '4_1445576012.jpg'),
(19, 4, '4_1445576860.jpg'),
(21, 4, '4_1445578434.jpg'),
(29, 4, '4_1445581297.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_relationship`
--

CREATE TABLE IF NOT EXISTS `users_relationship` (
  `relationID` int(10) unsigned NOT NULL,
  `userID1` int(10) unsigned NOT NULL,
  `userID2` int(10) unsigned NOT NULL,
  `status` set('Viewed','Like') NOT NULL,
  `statusTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_relationship`
--

INSERT INTO `users_relationship` (`relationID`, `userID1`, `userID2`, `status`, `statusTime`) VALUES
(1, 1, 14, 'Viewed', '2015-10-23 14:08:48'),
(2, 1, 3, 'Like', '2015-10-23 16:44:45'),
(3, 10, 1, 'Like', '2015-10-23 16:25:34'),
(4, 10, 13, 'Like', '2015-10-23 15:07:35'),
(5, 10, 8, 'Like', '2015-10-23 15:07:45'),
(6, 10, 9, 'Viewed', '2015-10-23 14:27:48'),
(7, 10, 7, 'Viewed', '2015-10-23 14:27:50'),
(8, 10, 11, 'Viewed', '2015-10-23 14:27:51'),
(10, 10, 4, 'Like', '2015-10-23 15:06:44'),
(11, 10, 3, 'Like', '2015-10-23 15:06:48'),
(12, 10, 2, 'Like', '2015-10-23 15:06:59'),
(13, 10, 16, 'Like', '2015-10-23 15:07:40'),
(14, 16, 10, 'Like', '2015-10-23 15:07:40'),
(15, 2, 10, 'Like', '2015-10-23 15:06:59'),
(16, 1, 10, 'Viewed', '2015-10-23 16:44:26'),
(17, 5, 9, 'Like', '2015-10-23 16:40:31'),
(18, 5, 4, 'Like', '2015-10-23 16:40:43'),
(19, 5, 12, 'Like', '2015-10-23 16:40:58'),
(20, 1, 16, 'Like', '2015-10-23 16:44:57'),
(21, 1, 9, 'Viewed', '2015-10-23 16:44:22'),
(22, 1, 13, 'Like', '2015-10-23 16:44:41'),
(23, 16, 1, 'Viewed', '2015-10-23 16:45:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `users_description`
--
ALTER TABLE `users_description`
  ADD PRIMARY KEY (`descriptionID`);

--
-- Indexes for table `users_photo`
--
ALTER TABLE `users_photo`
  ADD PRIMARY KEY (`photoID`);

--
-- Indexes for table `users_relationship`
--
ALTER TABLE `users_relationship`
  ADD PRIMARY KEY (`relationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users_description`
--
ALTER TABLE `users_description`
  MODIFY `descriptionID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_photo`
--
ALTER TABLE `users_photo`
  MODIFY `photoID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users_relationship`
--
ALTER TABLE `users_relationship`
  MODIFY `relationID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
