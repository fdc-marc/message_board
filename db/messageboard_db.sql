-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2023 at 09:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `latest_message_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user1`, `user2`, `latest_message_time`) VALUES
(2, 1, 3, '2023-10-18 16:06:16'),
(3, 1, 4, '2023-10-17 17:13:36'),
(4, 1, 5, '2023-10-17 17:13:42'),
(5, 1, 6, '2023-10-17 17:14:48'),
(6, 1, 7, '2023-10-17 17:14:55'),
(7, 1, 8, '2023-10-17 17:15:03'),
(8, 1, 9, '2023-10-17 17:15:10'),
(9, 1, 10, '2023-10-17 17:15:18'),
(10, 1, 11, '2023-10-18 12:59:56'),
(11, 1, 12, '2023-10-17 17:16:16'),
(12, 1, 2, '2023-10-18 16:41:41'),
(13, 13, 6, '2023-10-18 16:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `receiver_id`, `conversation_id`, `content`, `time_sent`) VALUES
(2, 1, 3, 2, 'hey test1', '2023-10-17 17:13:29'),
(3, 1, 4, 3, 'hey test2', '2023-10-17 17:13:36'),
(4, 1, 5, 4, 'hey test3', '2023-10-17 17:13:42'),
(5, 1, 6, 5, 'hello Marc', '2023-10-17 17:14:48'),
(6, 1, 7, 6, 'hey Johnny', '2023-10-17 17:14:55'),
(7, 1, 8, 7, 'hey Peter!', '2023-10-17 17:15:03'),
(8, 1, 9, 8, 'hey chatting', '2023-10-17 17:15:10'),
(9, 1, 10, 9, 'hey tester!\r\n', '2023-10-17 17:15:18'),
(10, 1, 11, 10, 'message', '2023-10-17 17:16:11'),
(11, 1, 12, 11, 'register', '2023-10-17 17:16:16'),
(15, 1, 3, 2, 'teqwe', '2023-10-17 17:48:53'),
(16, 1, 3, 2, 'qwe', '2023-10-17 17:48:54'),
(17, 1, 3, 2, 'asd', '2023-10-17 17:48:54'),
(18, 1, 3, 2, 'dzxc', '2023-10-17 17:48:55'),
(19, 1, 3, 2, 'zxc', '2023-10-17 17:48:56'),
(20, 1, 3, 2, 'asdasd', '2023-10-17 17:48:57'),
(21, 1, 3, 2, 'qweqwe', '2023-10-17 17:48:58'),
(25, 1, 2, 12, 'wew', '2023-10-18 09:13:50'),
(26, 1, 2, 12, 'hey', '2023-10-18 09:15:57'),
(27, 1, 11, 10, 'lunch', '2023-10-18 12:59:56'),
(28, 2, 1, 12, 'what', '2023-10-18 13:01:08'),
(29, 1, 3, 2, 'page', '2023-10-18 14:20:50'),
(30, 1, 3, 2, 'ination', '2023-10-18 14:20:54'),
(31, 1, 3, 2, 'pagination', '2023-10-18 14:21:03'),
(32, 1, 3, 2, 'test', '2023-10-18 15:15:57'),
(33, 1, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque fermentum sagittis porttitor. Pellentesque auctor eros volutpat ultricies sodales. Proin justo magna, bibendum ac rutrum nec, iaculis vel orci. Fusce a condimentum magna. Vestibulum volutpat maximus nunc id volutpat. Pellentesque eu libero ac sem mattis porttitor. Mauris enim mauris, vulputate ac sapien vehicula, fringilla feugiat quam. Quisque ullamcorper condimentum leo, vel varius lectus interdum accumsan. Phasellus luctus vulputate eros vel mattis. Cras eget arcu nunc. Phasellus quis mi finibus erat tincidunt hendrerit sit amet a libero.', '2023-10-18 15:21:35'),
(34, 1, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque fermentum sagittis porttitor. Pellentesque auctor eros volutpat ultricies sodales. Proin justo magna, bibendum ac rutrum nec, iaculis vel orci. Fusce a condimentum magna. Vestibulum volutpat maximus nunc id volutpat. Pellentesque eu libero ac sem mattis porttitor. Mauris enim mauris, vulputate ac sapien vehicula, fringilla feugiat quam. Quisque ullamcorper condimentum leo, vel varius lectus interdum accumsan. Phasellus luctus vulputate eros vel mattis. Cras eget arcu nunc. Phasellus quis mi finibus erat tincidunt hendrerit sit amet a libero.', '2023-10-18 15:48:53'),
(37, 1, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque fermentum sagittis porttitor. Pellentesque auctor eros volutpat ultricies sodales. Proin justo magna, bibendum ac rutrum nec, iaculis vel orci. Fusce a condimentum magna. Vestibulum volutpat maximus nunc id volutpat. Pellentesque eu libero ac sem mattis porttitor. Mauris enim mauris, vulputate ac sapien vehicula, fringilla feugiat quam. Quisque ullamcorper condimentum leo, vel varius lectus interdum accumsan. Phasellus luctus vulputate eros vel mattis. Cras eget arcu nunc. Phasellus quis mi finibus erat tincidunt hendrerit sit amet a libero.', '2023-10-18 16:06:16'),
(38, 1, 2, 12, 'send message', '2023-10-18 16:41:40'),
(39, 13, 6, 13, 'good afternoon\r\n', '2023-10-18 16:53:40'),
(40, 6, 13, 13, 'hey', '2023-10-18 16:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `hobby` text DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `birthdate`, `joined_date`, `last_login_date`, `photo`, `hobby`, `password`) VALUES
(1, 'login', 'login@gmail.com', 'Male', '2023-10-18', '2023-10-17 16:58:16', '2023-10-18 17:38:22', 'sample-pic.jpeg-1', 'login time', '428821350e9691491f616b754cd8315fb86d797ab35d843479e732ef90665324'),
(2, 'chatter', 'chat@gmail.com', NULL, NULL, '2023-10-17 17:09:25', '2023-10-18 13:01:02', NULL, NULL, '31e06f7d89feb99a0e6c0affe198748c3bb5bef5e3cc92d95cb9e996197d3fc3'),
(3, 'test1', 'test1@gmail.com', NULL, NULL, '2023-10-17 17:10:36', '2023-10-18 16:13:38', NULL, NULL, '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014'),
(4, 'test2', 'test2@gmail.com', NULL, NULL, '2023-10-17 17:10:49', '2023-10-17 17:10:49', NULL, NULL, '60303ae22b998861bce3b28f33eec1be758a213c86c93c076dbe9f558c11c752'),
(5, 'test3', 'test3@gmail.com', NULL, NULL, '2023-10-17 17:11:01', '2023-10-17 17:11:01', NULL, NULL, 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13'),
(6, 'Marc Baring', 'baringmarc@yahoo.com', NULL, NULL, '2023-10-17 17:11:20', '2023-10-18 17:02:40', NULL, NULL, '4697c20f8a70fcad6323e007d553cfe05d4433f81be70884ea3b4834b147f4c1'),
(7, 'Johnny', 'johnny@gmail.com', NULL, NULL, '2023-10-17 17:11:45', '2023-10-17 17:11:45', NULL, NULL, 'd808cfd66215b9ca25d0d02778e1931c7055e2a21bde4a695b9df4ab522ff3cf'),
(8, 'Peter', 'peter@gmail.com', NULL, NULL, '2023-10-17 17:12:28', '2023-10-17 17:12:28', NULL, NULL, '026ad9b14a7453b7488daa0c6acbc258b1506f52c441c7c465474c1a564394ff'),
(9, 'chatting', 'chatting@gmail.com', NULL, NULL, '2023-10-17 17:12:57', '2023-10-17 17:12:57', NULL, NULL, '0d62646ad2a4c5ed523519b8d4d8c11b4de2405ff7f85a65a3d5976e6bacd8fe'),
(10, 'tester', 'tester@gmail.com', NULL, NULL, '2023-10-17 17:13:12', '2023-10-17 17:13:12', NULL, NULL, '9bba5c53a0545e0c80184b946153c9f58387e3bd1d4ee35740f29ac2e718b019'),
(11, 'message', 'message@gmail.com', NULL, NULL, '2023-10-17 17:15:48', '2023-10-17 17:15:48', NULL, NULL, 'ab530a13e45914982b79f9b7e3fba994cfd1f3fb22f71cea1afbf02b460c6d1d'),
(12, 'register', 'register@gmail.com', NULL, NULL, '2023-10-17 17:15:57', '2023-10-17 17:15:57', NULL, NULL, '87780fa5de684e87cb92b279f0bc07b14f572851e73b8943a097c1770a5f38e6'),
(13, 'newest', 'newest@gmail.com', 'Male', '2014-10-01', '2023-10-18 16:42:54', '2023-10-18 16:42:54', 'Cake-logo.png-13', 'cakephp tester', '1871d953530dd322ad0064b3df5878d040af678e76ee8f1693b87812a9582096');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
