-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2015 at 04:35 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f35im`
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`userID`, `name`, `password`, `email`, `birthdate`, `gender`, `city`, `height`, `education`, `profilePhoto`) VALUES
(1, 'Beauty2', 'ff5d0c28194e16175a33d8d8b018bdf3', 'Beauty@gmail.com', '1988-07-24', 'Female', 'Any', 171, '', '1.jpeg'),
(2, 'Noah', 'cfa36b7c75e18a9dc6e2a35d19a58ee7', 'Noah@gmail.com', '1993-01-01', 'Male', 'Singapore', 173, 'Beng', '2.jpg'),
(3, 'James', 'd52e32f3a96a64786814ae9b5279fbe5', 'James@gmail.com', '1990-07-09', 'Male', 'Tokyo', 178, 'Master', '3.jpg'),
(4, 'Zhao', 'c7d42e3dd6efc36afa732fb393090adf', 'Zhao@gmail.com', '1991-01-28', 'Female', 'Shanghai', 161, 'MBA', '4.jpg'),
(5, 'Ethan', 'e05699b45eae134804f4419d3fbb3139', 'Ethan@gmail.com', '2000-01-01', 'Female', 'Singapore', 170, 'MBA', '5.jpg'),
(6, 'David', '464e07afc9e46359fb480839150595c5', 'David@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '6.jpg'),
(7, 'Lucas', 'c3d41bf5efb468a1bcce53bd53726c85', 'Lucas@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '7.jpg'),
(8, 'Leon', 'd8f7de479b1fae3d85d341f380524de5', 'Leon@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '8.jpg'),
(9, 'Zoey', '69a99f608340f12d821de723a60f3c41', 'Zoey@gmail.com', '2000-01-01', 'Male', 'Singapore', 170, 'MBA', '9.jpg'),
(10, 'Model', 'a559b87068921eec05086ce5485e9784', 'Model@gmail.com', '2000-01-01', 'Male', 'New', 170, 'MBA', '10.jpg'),
(11, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 181, 'test', '11.jpg'),
(12, 'test1', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', NULL),
(13, 'test2', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Female', 'Tokyo', 170, 'test', '13.jpeg'),
(14, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', NULL),
(16, 'test4', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Female', 'Tokyo', 170, 'test', '16.jpeg'),
(17, 'test5', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-22', 'Male', 'Tokyo', 170, 'test', '17.jpg'),
(18, 'test6', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2000-07-19', 'Female', 'Seoul', 167, 'Bachelor', '18.jpeg'),
(19, 'test7', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2015-10-24', 'Male', 'Tokyo', 170, 'test', '19.jpeg'),
(20, 'asd', 'f854b8263fb2bdae91d8e8e42e888154', 'asd@asd.com', '2015-10-06', 'Male', 'asd', 9, 'asd', NULL),
(30, 'yuiy', '8fa14cdd754f91cc6554c9e71929cce7', 'qiuhai@qiuhai.com', '2015-11-20', 'Male', 'f', 2, 'f', NULL),
(33, 'Harry Potter', '0cc175b9c0f1b6a831c399e269772661', 'harrypotter@hogwarts.com', '2015-11-11', 'Male', 'Hogwarts', 1, 'sdf', NULL),
(34, 'Harry Potte', 'd9729feb74992cc3482b350163a1a010', 'harrypotter@hogwarts.com', '2015-11-12', 'Male', 'Hogwarts', 1, 'sdf', NULL),
(35, 'mail', '9f24d9454662dc3e554f42db9fb0ed52', 'mail@mail.com', '2015-11-13', 'Male', 'mail', 170, 'mail', NULL),
(36, 'mail2', '9f24d9454662dc3e554f42db9fb0ed52', 'mail@mail.com', '2015-11-14', 'Male', 'sd', 1, 'fds', NULL),
(37, 'mail3', '9f24d9454662dc3e554f42db9fb0ed52', 'mail@mail.com', '2015-11-14', 'Male', 'sd', 1, 'fds', NULL),
(38, 'mail4', '9f24d9454662dc3e554f42db9fb0ed52', 'asd@asd.com', '2015-11-06', 'Male', 'sdf', 2, 'sdf', '38.jpeg'),
(39, 'customer', '7367cc4cee061a476290d18978830414', 'customer@gmail.com', '2015-11-25', 'Male', 'Singapore', 168, 'MBA', NULL),
(40, 'wer', '7367cc4cee061a476290d18978830414', 'qiuhaiqiuhai@126.com', '2015-11-06', 'Female', 'werwe', 2, 'rwerw', NULL),
(41, 'demo', '7367cc4cee061a476290d18978830414', 'demo@gmail.com', '2000-01-01', 'Female', 'Tokyo', 4, 'Any', '41.jpeg'),
(42, 'demofemale', '7367cc4cee061a476290d18978830414', 'demo@gmail.com', '2000-01-20', 'Female', 'sdf', 4, 'sdf', NULL),
(43, 'demo upload photo', '7367cc4cee061a476290d18978830414', 'qiuhaiqiuhai@126', '2000-01-04', 'Female', 'asdqwe', 4, 'sdf', '43.jpeg'),
(44, 'demo2', '7367cc4cee061a476290d18978830414', 'demo@gmail.com', '2000-01-11', 'Male', 'sdf', 3, 'sdf', NULL),
(45, 'demo3', '7367cc4cee061a476290d18978830414', 'demo@gmail.com', '2000-01-01', 'Male', 'asdqweasd', 2, 'asdasda', NULL),
(47, 'demo5', '7367cc4cee061a476290d18978830414', 'demo@gmail.com', '2000-01-03', 'Male', 'New York City', 172, 'High School', '47.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users_description`
--

CREATE TABLE IF NOT EXISTS `users_description` (
  `descriptionID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `description` text,
  `type` set('Intro','Mate_Criteria','Life_Style') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_description`
--

INSERT INTO `users_description` (`descriptionID`, `userID`, `description`, `type`) VALUES
(1, 1, 'i changed my self-introduction.', 'Intro'),
(2, 1, 'I would say that trust is very important. It''s more of a gut feeling. How comfortable are you with your partner, and how comfortable are you without him? How much of you, are you around him? You are completely yourself by yourself, can you be comfortably yourself with your partner?', 'Mate_Criteria'),
(10, 4, 'I like sports', 'Life_Style'),
(11, 5, 'I''m pretty.', 'Intro'),
(12, 1, 'I love this Aveeno Baby Soothing Relief Creamy Wash is a tear-free creamy wash, specially formulated to gently cleanse and soothe dry skin. Aveeno''s baby Wash is enriched with colloidal oatmeal to care for baby''s sensitive skin. In spite of being fragrance free, it has a soft gentle scent that is perfect for both babies and adults. ', 'Life_Style'),
(13, 1, 'i changed my self-introduction.', 'Intro'),
(14, 1, 'I would say that trust is very important. It''s more of a gut feeling. How comfortable are you with your partner, and how comfortable are you without him? How much of you, are you around him? You are completely yourself by yourself, can you be comfortably yourself with your partner?', 'Mate_Criteria'),
(15, 1, 'I love this Aveeno Baby Soothing Relief Creamy Wash is a tear-free creamy wash, specially formulated to gently cleanse and soothe dry skin. Aveeno''s baby Wash is enriched with colloidal oatmeal to care for baby''s sensitive skin. In spite of being fragrance free, it has a soft gentle scent that is perfect for both babies and adults. ', 'Life_Style'),
(16, 1, 'I would say that trust is very important. It''s more of a gut feeling. How comfortable are you with your partner, and how comfortable are you without him? How much of you, are you around him? You are completely yourself by yourself, can you be comfortably yourself with your partner?', 'Mate_Criteria'),
(17, 1, 'I love this Aveeno Baby Soothing Relief Creamy Wash is a tear-free creamy wash, specially formulated to gently cleanse and soothe dry skin. Aveeno''s baby Wash is enriched with colloidal oatmeal to care for baby''s sensitive skin. In spite of being fragrance free, it has a soft gentle scent that is perfect for both babies and adults. ', 'Life_Style'),
(18, 41, 'asdasd', 'Intro'),
(19, 41, 'asdasd', 'Mate_Criteria'),
(20, 41, 'asdasd', 'Life_Style'),
(21, 41, 'asdasd', 'Intro'),
(22, 41, 'asdasd', 'Mate_Criteria'),
(23, 41, 'asdasd', 'Life_Style'),
(24, 41, 'asdasd', 'Intro'),
(25, 41, 'asdasd', 'Mate_Criteria'),
(26, 41, 'asdasd', 'Life_Style'),
(27, 41, 'asdasd', 'Intro'),
(28, 41, 'asdasd', 'Mate_Criteria'),
(29, 41, 'asdasd', 'Life_Style'),
(30, 41, 'asdasd', 'Intro'),
(31, 41, 'asdasd', 'Mate_Criteria'),
(32, 41, 'asdasd', 'Life_Style');

-- --------------------------------------------------------

--
-- Table structure for table `users_message`
--

CREATE TABLE IF NOT EXISTS `users_message` (
  `mesageID` int(10) unsigned NOT NULL,
  `senderID` int(10) unsigned NOT NULL,
  `receiverID` int(10) unsigned NOT NULL,
  `message` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_message`
--

INSERT INTO `users_message` (`mesageID`, `senderID`, `receiverID`, `message`, `time`) VALUES
(1, 3, 1, 'I''m love you', '2015-11-01 03:32:41'),
(2, 3, 5, 'Do you love me?', '2015-11-01 03:32:59'),
(3, 3, 5, 'Je t''aime!', '2015-11-01 03:33:42'),
(4, 1, 19, 'hello', '2015-11-01 03:33:57'),
(9, 18, 17, 'qasdasd', '2015-10-31 04:32:18'),
(10, 18, 17, 'adsasda', '2015-10-31 04:58:37'),
(11, 1, 10, 'I like you', '2015-10-31 05:01:07'),
(12, 1, 10, 'I really like you\r\n', '2015-10-31 05:01:16'),
(21, 1, 10, 'asdfasdf', '2015-10-31 07:31:15'),
(22, 1, 10, 'csdasda', '2015-10-31 09:08:48'),
(23, 1, 10, 'how are you', '2015-10-31 09:09:46'),
(24, 1, 19, 'hellohello', '2015-10-31 09:13:42'),
(25, 1, 10, 'what''s up', '2015-10-31 09:14:02'),
(27, 1, 19, 'I love you', '2015-11-01 10:52:32'),
(28, 1, 3, 'me too', '2015-11-01 10:52:57'),
(30, 1, 3, 'fuck you', '2015-11-01 10:57:27'),
(31, 1, 3, 'sdfsdf', '2015-11-01 10:57:30'),
(32, 1, 3, 'sdfsdf', '2015-11-01 10:57:32'),
(36, 1, 10, 'hello', '2015-11-01 11:14:31'),
(37, 1, 10, 'zcdsa', '2015-11-01 11:20:04'),
(38, 1, 3, 'hello', '2015-11-01 11:21:00'),
(51, 1, 10, 'I love you!', '2015-11-02 12:52:17'),
(52, 1, 10, 'I really love you!', '2015-11-02 12:52:28'),
(53, 1, 10, 'I really really love you!', '2015-11-02 12:52:40'),
(59, 1, 3, 'asdad', '2015-11-02 13:05:19'),
(60, 1, 10, 'Do you Love me?', '2015-11-02 13:05:40'),
(61, 1, 10, 'Answer me!', '2015-11-02 13:06:11'),
(62, 10, 1, 'I love you too', '2015-11-02 13:58:20'),
(66, 16, 1, 'Hello', '2015-11-04 11:17:37'),
(69, 1, 10, 'qweqweqw', '2015-11-04 11:42:45'),
(70, 41, 1, 'asda', '2015-11-04 13:40:27'),
(71, 41, 1, 'I like you', '2015-11-04 13:43:13'),
(72, 41, 1, 'do you love me', '2015-11-04 13:43:41'),
(74, 41, 1, 'I love you', '2015-11-04 13:47:32'),
(75, 41, 1, 'hello', '2015-11-04 13:54:46'),
(76, 41, 1, 'beauty', '2015-11-04 13:55:13'),
(77, 41, 1, 'lol', '2015-11-04 13:55:38'),
(78, 41, 1, 'how are you', '2015-11-04 13:56:04'),
(114, 41, 1, 'asdasd', '2015-11-04 14:22:26'),
(115, 41, 1, 'asdasd', '2015-11-04 14:25:10'),
(116, 41, 1, 'asd', '2015-11-04 14:28:44'),
(117, 41, 1, 'asd', '2015-11-04 14:28:53'),
(118, 41, 1, 'zxc', '2015-11-04 14:29:29'),
(119, 41, 1, 'hjgjhg', '2015-11-04 14:31:54'),
(120, 41, 1, 'I love you', '2015-11-04 14:33:48'),
(121, 41, 11, 'qwe', '2015-11-04 17:18:34'),
(122, 41, 11, 'ZX', '2015-11-04 17:18:44'),
(123, 41, 11, 'ZXZX', '2015-11-04 17:18:45'),
(126, 41, 19, 'hello', '2015-11-05 01:32:07'),
(127, 41, 1, 'jkl', '2015-11-05 01:34:33'),
(128, 41, 19, 'I love you', '2015-11-05 01:41:51'),
(129, 41, 5, 'How are you', '2015-11-05 01:43:19'),
(130, 41, 1, 'I like you', '2015-11-05 01:43:42'),
(131, 41, 1, 'asdfas', '2015-11-05 01:45:02'),
(132, 41, 1, 'what', '2015-11-05 01:49:04'),
(133, 41, 1, 'I like you', '2015-11-05 01:51:16'),
(134, 41, 5, 'what', '2015-11-05 01:51:34'),
(135, 1, 41, 'hello', '2015-11-05 01:54:06'),
(136, 1, 6, 'have dinner tonight?', '2015-11-05 01:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `users_photo`
--

CREATE TABLE IF NOT EXISTS `users_photo` (
  `photoID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_photo`
--

INSERT INTO `users_photo` (`photoID`, `userID`, `photo`) VALUES
(1, 17, '17_1445540039.jpg'),
(2, 17, '17_1445540056.jpg'),
(3, 17, '17_1445540204.jpeg'),
(4, 1, '1_1445540675.jpg'),
(5, 1, '1_1445542386.jpg'),
(15, 1, '1_1445569587.jpg'),
(18, 4, '4_1445576012.jpg'),
(19, 4, '4_1445576860.jpg'),
(21, 4, '4_1445578434.jpg'),
(29, 4, '4_1445581297.jpg'),
(30, 18, '18_1445653877.jpeg'),
(35, 10, '10_1445687343.jpg'),
(36, 2, '2_1446296481.jpg'),
(45, 1, '1_1446364386.jpg'),
(49, 1, '1_1446367946.jpeg'),
(50, 1, '1_1446367964.jpeg'),
(52, 38, '38_1446373979.jpeg'),
(56, 1, '1_1446466916.jpg'),
(57, 16, '16_1446635824.jpeg'),
(58, 16, '16_1446635960.jpeg'),
(62, 41, '41_1446642494.jpeg'),
(65, 41, '41_1446642548.jpeg');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_relationship`
--

INSERT INTO `users_relationship` (`relationID`, `userID1`, `userID2`, `status`, `statusTime`) VALUES
(1, 1, 14, 'Viewed', '2015-11-01 13:35:55'),
(2, 1, 3, 'Viewed', '2015-11-04 12:07:49'),
(3, 3, 1, 'Like', '2015-11-01 03:36:58'),
(4, 10, 13, 'Viewed', '2015-11-01 06:14:46'),
(5, 10, 8, 'Like', '2015-10-24 11:49:35'),
(6, 10, 9, 'Viewed', '2015-10-23 14:27:48'),
(7, 10, 7, 'Viewed', '2015-10-23 14:27:50'),
(8, 10, 11, 'Viewed', '2015-10-23 14:27:51'),
(10, 10, 4, 'Like', '2015-10-23 15:06:44'),
(11, 10, 3, 'Like', '2015-10-23 15:06:48'),
(12, 10, 2, 'Like', '2015-10-23 15:06:59'),
(13, 10, 16, 'Viewed', '2015-10-24 11:48:54'),
(14, 16, 10, 'Like', '2015-11-04 11:40:53'),
(15, 2, 10, 'Like', '2015-10-31 12:51:40'),
(16, 1, 10, 'Like', '2015-10-31 09:14:06'),
(17, 5, 9, 'Like', '2015-10-23 16:40:31'),
(18, 5, 4, 'Like', '2015-10-23 16:40:43'),
(19, 5, 12, 'Like', '2015-10-23 16:40:58'),
(20, 1, 16, 'Like', '2015-11-05 02:00:32'),
(21, 1, 9, 'Viewed', '2015-11-01 13:35:50'),
(22, 1, 13, 'Like', '2015-11-02 08:40:35'),
(23, 16, 1, 'Like', '2015-11-04 11:37:23'),
(24, 18, 10, 'Like', '2015-10-31 04:23:19'),
(25, 18, 17, 'Viewed', '2015-10-31 04:58:37'),
(26, 18, 14, 'Like', '2015-10-31 04:23:18'),
(27, 10, 18, 'Like', '2015-10-24 02:46:29'),
(28, 19, 8, 'Like', '2015-10-24 02:47:52'),
(29, 1, 18, 'Like', '2015-11-03 03:13:03'),
(30, 11, 5, 'Viewed', '2015-10-24 09:48:18'),
(31, 3, 1, 'Viewed', '2015-10-30 03:21:50'),
(32, 3, 5, 'Like', '2015-10-30 05:00:34'),
(33, 1, 19, 'Viewed', '2015-10-30 08:14:03'),
(34, 2, 5, 'Viewed', '2015-10-31 03:35:48'),
(35, 2, 1, 'Viewed', '2015-10-31 03:36:30'),
(36, 1, 2, 'Viewed', '2015-11-02 12:30:46'),
(37, 1, 12, 'Viewed', '2015-11-01 13:35:15'),
(38, 2, 16, 'Viewed', '2015-10-31 12:05:23'),
(39, 2, 8, 'Viewed', '2015-10-31 12:21:18'),
(40, 38, 18, 'Viewed', '2015-11-01 10:50:15'),
(41, 38, 4, 'Viewed', '2015-11-01 10:50:52'),
(42, 13, 4, 'Viewed', '2015-11-01 12:18:31'),
(43, 13, 7, 'Viewed', '2015-11-01 13:30:31'),
(44, 13, 28, 'Viewed', '2015-11-01 13:31:28'),
(45, 1, 4, 'Like', '2015-11-05 02:00:35'),
(46, 1, 8, 'Viewed', '2015-11-01 14:02:34'),
(47, 1, 6, 'Like', '2015-11-05 01:54:15'),
(48, 6, 1, 'Like', '2015-11-02 12:36:03'),
(49, 1, 40, 'Viewed', '2015-11-03 03:15:12'),
(50, 41, 1, 'Viewed', '2015-11-05 01:51:11'),
(51, 41, 11, 'Like', '2015-11-04 17:18:52'),
(52, 41, 3, 'Viewed', '2015-11-04 15:25:38'),
(53, 41, 19, 'Viewed', '2015-11-05 01:41:40'),
(54, 41, 14, 'Viewed', '2015-11-05 01:31:45'),
(55, 41, 7, 'Viewed', '2015-11-05 01:31:42'),
(56, 1, 41, 'Viewed', '2015-11-05 01:54:00'),
(57, 47, 13, 'Like', '2015-11-04 16:50:58'),
(58, 41, 8, 'Viewed', '2015-11-05 01:31:44'),
(59, 41, 4, 'Viewed', '2015-11-05 01:31:43'),
(61, 41, 45, 'Like', '2015-11-05 01:31:38'),
(62, 41, 5, 'Viewed', '2015-11-05 01:51:28'),
(63, 1, 43, 'Viewed', '2015-11-05 02:00:26');

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
-- Indexes for table `users_message`
--
ALTER TABLE `users_message`
  ADD PRIMARY KEY (`mesageID`);

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
  MODIFY `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `users_description`
--
ALTER TABLE `users_description`
  MODIFY `descriptionID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users_message`
--
ALTER TABLE `users_message`
  MODIFY `mesageID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `users_photo`
--
ALTER TABLE `users_photo`
  MODIFY `photoID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `users_relationship`
--
ALTER TABLE `users_relationship`
  MODIFY `relationID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
