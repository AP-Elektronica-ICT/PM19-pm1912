-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2019 at 06:40 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Q6EhZWemZR`
--
CREATE DATABASE IF NOT EXISTS `Q6EhZWemZR` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `Q6EhZWemZR`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `number` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `password` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `first_name`, `last_name`, `username`, `email`, `number`, `city`, `address`, `zip`, `tel`, `password`) VALUES
(1, 'Jens', 'Test', 'Jensieee', 'test.email@test.com', '30', 'Kallo', 'Random Straat', '9120', '04-7335-232-672', ''),
(2, 'Nick', 'Van Acker', 'zapie007', 'vanackernick@hotmail.com', '39', 'Berchem', 'Jos Ratinckxstraat 2', '2600', '0492940703', '123'),
(3, 'Arno', 'Test', 'testertje', 'sdqfsgfdhgjh', '23', 'Gent', 'Een adres hier', '3242', '23233242323', 'password'),
(7, 'NickV', 'Van Acker', 'sha1', 'thenoob551@gmail.com', '50', 'Berchem', 'Jos Ratinckxstraat 2', '2600', '0492940703', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `likes` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `text`, `likes`) VALUES
(8, 54, 1, 'Test', 0),
(9, 53, 1, 'test', 0),
(10, 54, 2, 'Test', 0),
(11, 54, 1, 'Test', 0),
(12, 56, 2, 'Wew', 0),
(13, 57, 1, 'Oi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `id_first` int(10) NOT NULL,
  `id_second` int(10) NOT NULL,
  `id_first_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `id_second_confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `id_first`, `id_second`, `id_first_confirmed`, `id_second_confirmed`) VALUES
(20, 2, 1, 1, 1),
(21, 1, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ImageId` int(10) NOT NULL,
  `ImageFileName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ImageOwner` int(10) NOT NULL DEFAULT '1',
  `UploadTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ImageId`, `ImageFileName`, `ImageOwner`) VALUES
(65, '2019-09-11-VP1-eekhoorn-4-FC-web.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(7, 1, 51),
(9, 1, 53),
(10, 2, 56),
(11, 2, 54),
(12, 1, 57),
(13, 1, 58);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `postImageID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `text`, `likes`, `postImageID`) VALUES
(51, 1, 'Dit is een test post met enkel text', 0, NULL),
(53, 2, 'Test post', 0, NULL),
(54, 1, 'Test', 0, NULL),
(56, 1, 'Oh', 0, 65),
(57, 1, 'Wew', 0, NULL),
(58, 1, 'Test\r\n', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profielfoto`
--

CREATE TABLE `profielfoto` (
  `userID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_first` (`id_first`),
  ADD KEY `id_second` (`id_second`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageId`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `postImageID` (`postImageID`);

--
-- Indexes for table `profielfoto`
--
ALTER TABLE `profielfoto`
  ADD KEY `userID` (`userID`),
  ADD KEY `imageID` (`imageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ImageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`id_first`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`id_second`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`postImageID`) REFERENCES `images` (`imageid`);

--
-- Constraints for table `profielfoto`
--
ALTER TABLE `profielfoto`
  ADD CONSTRAINT `profielfoto_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `profielfoto_ibfk_2` FOREIGN KEY (`imageID`) REFERENCES `images` (`imageid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
