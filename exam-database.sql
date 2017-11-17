-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2017 at 03:21 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `sender_id` varchar(128) NOT NULL,
  `reciever_id` varchar(128) NOT NULL,
  `content` varchar(300) NOT NULL,
  `id` int(9) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`sender_id`, `reciever_id`, `content`, `id`, `date`) VALUES
('groot@guardians.com', 'contact@blackwidow.com', 'I am Groot. I am Groot', 1, '2017-11-16 14:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `id` int(5) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`id`, `type`) VALUES
(1, 'Flower'),
(2, 'Chocolate'),
(3, 'Cake'),
(4, 'Ring'),
(5, 'Weapon'),
(6, 'Diamond');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_id` varchar(128) NOT NULL,
  `reciever_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `title`, `content`, `date`, `sender_id`, `reciever_id`) VALUES
(5, 'Hello Groot', 'Hey Groot. How are you doing? You feel\' Groot?', '2017-11-16 19:29:34', 'contact@ironman.com', 'groot@guardians.com');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `email` varchar(128) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `description` varchar(300) NOT NULL,
  `likes` int(5) NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`email`, `name`, `age`, `description`, `likes`, `img`) VALUES
('contact@blackwidow.com', 'Black Widow', 32, 'I am a strong and independent woman', 19, 'blackwidow.png'),
('contact@ironman.com', 'Iron Man', 52, 'I have a powered suit of amor', 28, 'ironman.png'),
('groot@guardians.com', 'Groot', 1, 'I am groot', 68, 'groot.png');

-- --------------------------------------------------------

--
-- Table structure for table `profile_send_gift`
--

CREATE TABLE `profile_send_gift` (
  `gift_id` int(9) NOT NULL,
  `reciever_id` varchar(128) NOT NULL,
  `sender_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_send_gift`
--

INSERT INTO `profile_send_gift` (`gift_id`, `reciever_id`, `sender_id`) VALUES
(3, 'groot@guardians.com', 'contact@blackwidow.com'),
(2, 'contact@ironman.com', 'groot@guardians.com'),
(2, 'groot@guardians.com', 'contact@ironman.com');

-- --------------------------------------------------------

--
-- Table structure for table `superpower`
--

CREATE TABLE `superpower` (
  `id` int(5) NOT NULL,
  `profile_id` varchar(128) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superpower`
--

INSERT INTO `superpower` (`id`, `profile_id`, `type`) VALUES
(3, 'contact@blackwidow.com', 'Fighting skills'),
(4, 'contact@blackwidow.com', 'Slowed aging'),
(5, 'contact@ironman.com', 'Strength'),
(6, 'contact@ironman.com', 'Fly'),
(27, 'groot@guardians.com', 'Strech bodyparts'),
(28, 'groot@guardians.com', 'Communicate with nature'),
(30, 'groot@guardians.com', 'Regrow bodyparts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `reciever_id` (`reciever_id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `reciever_id` (`reciever_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`email`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `profile_send_gift`
--
ALTER TABLE `profile_send_gift`
  ADD KEY `gift_id` (`gift_id`),
  ADD KEY `reciever_id` (`reciever_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `superpower`
--
ALTER TABLE `superpower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `superpower`
--
ALTER TABLE `superpower`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_reciever` FOREIGN KEY (`reciever_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_sender` FOREIGN KEY (`sender_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_reciever` FOREIGN KEY (`reciever_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `message_sender` FOREIGN KEY (`sender_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `profile_send_gift`
--
ALTER TABLE `profile_send_gift`
  ADD CONSTRAINT `gift` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reciever` FOREIGN KEY (`sender_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sender` FOREIGN KEY (`sender_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `superpower`
--
ALTER TABLE `superpower`
  ADD CONSTRAINT `profile_id` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`email`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
