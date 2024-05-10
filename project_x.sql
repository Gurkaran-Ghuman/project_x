-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2024 at 07:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_x`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`, `category_description`, `category_image`, `category_date`) VALUES
(10, 'Category_01', 'Category_Description_01', '1713945347.jpg', '2024-04-24 13:25:47'),
(11, 'Category_02', 'Category_Description_02', '1713945459.jpg', '2024-04-24 13:27:39'),
(12, 'Category_03', 'Category_Description_04', '1713945482.jpg', '2024-04-24 13:28:02'),
(13, 'Category_04', 'Category_Description_05', '1713945500.jpg', '2024-04-24 13:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `post_id` int DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author_id`, `is_active`, `created_date`, `comment`) VALUES
(1, 6, 11, 1, '2024-04-26 11:05:59', 'dvhdhg'),
(2, 6, 11, 1, '2024-04-26 11:08:39', 'jhdvfadjj'),
(5, 6, 13, 1, '2024-04-26 13:18:26', 'jsdvgfvcsadyuv'),
(6, 6, 13, 1, '2024-04-26 13:18:39', 'nbvbz v'),
(7, 12, 11, 1, '2024-04-30 15:39:47', 'cff'),
(8, 8, 11, 1, '2024-05-01 14:01:01', 'bakwas post'),
(9, 6, 12, 1, '2024-05-01 15:48:30', ':)'),
(10, 6, 12, 1, '2024-05-01 15:52:30', 'uygf'),
(11, 12, 12, 1, '2024-05-02 10:22:24', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_description` varchar(255) DEFAULT NULL,
  `post_category` int DEFAULT NULL,
  `post_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `is_active` varchar(255) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_video` varchar(255) DEFAULT NULL,
  `post_tags` longblob,
  `views` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_description`, `post_category`, `post_image`, `author_id`, `is_active`, `created_date`, `post_video`, `post_tags`, `views`) VALUES
(5, 'Post_Title_01', 'Post_Description_01', 10, '1714020633.jpg', 11, '1', '2024-04-25 10:20:33', NULL, NULL, 2),
(6, 'Post_Title_02', 'Post_Description_02', 11, '1714020659.jpg', 11, '1', '2024-04-25 10:20:59', NULL, NULL, 49),
(7, 'Post_Title_03', 'Post_Description_03', 12, '1714020675.jpeg', 11, '1', '2024-04-25 10:21:15', NULL, NULL, 18),
(8, 'Post_Title_04', 'Post_Description_04', 13, '1714020688.jpg', 11, '1', '2024-04-25 10:21:28', NULL, NULL, 97),
(9, 'Video Post', 'Post Description', 11, '1714381953.jpg', 11, '1', '2024-04-29 14:42:33', '1714381953.mp4', NULL, NULL),
(10, 'jhbchfs', 'ccdskvg', 10, '1714387078.jpg', 11, '1', '2024-04-29 16:07:58', '1714387078.mp4', NULL, NULL),
(11, 'sfhs', 'svdjhs', 10, '1714388404.jpeg', 11, '1', '2024-04-29 16:42:41', '1714388404.mp4', 0x613a343a7b693a303b733a353a227479667466223b693a313b733a353a226867637479223b693a323b733a373a22686a6768766768223b693a333b733a373a2262762063686763223b7d, NULL),
(12, 'Tag_Post_Title', 'Tag_Post_Description', 11, '1714389800.jpg', 11, '1', '2024-04-29 16:53:20', '1714389800.mp4', 0x613a343a7b693a303b733a343a2248544d4c223b693a313b733a333a22435353223b693a323b733a333a22504850223b693a333b733a323a224a53223b7d, 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `twitter`, `facebook`, `photo`, `fname`, `lname`, `phone`, `address`, `date`) VALUES
(11, 'email@email.com', 'pass', 'Twitter', 'Facebook', '1713782055.jpg', 'First Name', 'Last Name', 'Phone', 'Address', '2024-04-22 16:04:15'),
(12, 'name@name.com', 'pass', 'Twitter', 'Facebook', '1714019701.jpeg', 'First Name', 'Last Name', 'Phone', 'Address', '2024-04-25 10:05:01'),
(13, 'karan@karan.com', 'pass', 'Twitter', 'Facebook', '1714114451.jpg', 'Karan', 'Singh', 'Phone', 'Address', '2024-04-26 12:24:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
