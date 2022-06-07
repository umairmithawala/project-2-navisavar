-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 08:07 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `navisavar`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(500) DEFAULT NULL,
  `thumbnail_img` varchar(256) DEFAULT NULL,
  `blog_body` varchar(500) DEFAULT NULL,
  `publish_date` int(50) DEFAULT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `unique_link` varchar(55) DEFAULT NULL,
  `dislike` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `added_by` varchar(55) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_slider` varchar(256) DEFAULT '0',
  `likes` float DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `sharing` varchar(256) DEFAULT NULL,
  `timestamp` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blog_title`, `thumbnail_img`, `blog_body`, `publish_date`, `keywords`, `unique_link`, `dislike`, `is_deleted`, `added_by`, `category_id`, `is_slider`, `likes`, `view`, `comment`, `sharing`, `timestamp`) VALUES
(1, 'blog1', 'thumbnail_img1650971635akc1567487754.jpg', '<p>hello</p>', 1650924000, 'Lorem,Ipsum,Amet,Temporibus delectus', 'blog-1', 0, 0, '1', 3, '0', 0, 200, '0', '120', 1650453911),
(2, 'blog2', 'thumbnail_img1650971635akc1567487754.jpg', '<p>good</p>', 1650924000, 'Lorem,Ipsum,Amet,Saepe consequatur i', 'blog-2', 1, 0, '1', 1, '0', 0, 300, '5', '1000', 0),
(3, 'blogg3', 'thumbnail_img1650971635akc1567487754.jpg', '<p><img src=\"http://localhost/work73-navisavar.com/admin/uploads/c8687cdb471e038ee61d9bcfad5236d72fad22db.jpg\" style=\"width: 300px;\" class=\"fr-fic fr-dib\">blog content update</p>', 1650405600, 'blogupdate', 'blog-3', 0, 0, '1', 3, '0', 0, 250, '0', '485', 1650451100),
(4, 'blog4', 'thumbnail_img1650971635akc1567487754.jpg', '<p>ko</p>', 1650924000, 'Amet,Ad incidunt magni a', 'blog-4', 0, 0, '1', 1, '1', 0, 9000, '2', '40', 0),
(5, 'blog5', 'thumbnail_img1650971635akc1567487754.jpg', '<p>good</p>', 1650924000, 'Amet,Ea sunt amet id ve', 'blog-5', 0, 0, '1', 1, '0', 0, 450, '0', '784', 1650345741),
(6, 'Blog6', 'buy_request_ss1650358521akc1575752000.jpg', '<p>good</p>', 1650924000, 'Amet,Sit corporis aut acc', 'blog-6', 0, 0, '1', 2, '1', 0, 350, '1', '200', 1650358521),
(7, 'Blog7', 'buy_request_ss1650358593akc474995571.jpg', '<p>good</p>', 1650924000, 'Amet,Totam reprehenderit', 'blog-7', 0, 0, '1', 1, '0', 0, 50, '0', '120', 1650358593),
(8, 'Blog8', 'buy_request_ss1650358657akc2048779926.jpg', '<p>good</p>', 1650924000, 'Lorem,Ipsum,Amet,Consectetur ipsum n', 'blog-8', 0, 0, '1', 1, '0', 0, 589, '0', '785', 1650358657),
(9, 'Blog9', 'thumbnail_img1650358737akc1733037086.jpg', 'Perferendis ad venia.', 1650924000, 'Lorem,Ipsum,Amet,Adipisicing quasi ar', 'http://localhost/work73-navisavar.com/admin/blog-edit', 0, 0, '1', 1, '0', 0, 2000, '0', '985', 1650358737),
(10, 'Blog10', 'thumbnail_img1650363763akc877096295.jpg', '<p>not good</p>', 1650924000, 'Enim qui nobis disti', 'http://localhost/work73-navisavar.com/admin/blog-edit', 0, 0, '1', 1, '0', 0, 750, '0', '984', 1650363763),
(11, 'Commodo iure non ani', 'thumbnail_img1650364139akc1640674841.jpg', 'Rem eiusmod cum cupi.', 1650924000, 'Lorem,Ipsum,Amet,Ex lorem pariatur N', 'http://localhost/work73-navisavar.com/admin/blog-edit', 0, 0, '1', 3, '0', 0, 982, '0', '451', 1650364139),
(12, 'Blog12', 'thumbnail_img1650451408akc788132715.jpg', 'Non perferendis maxi.', 1650405600, 'add', NULL, 0, 0, '1', 1, '0', 0, 1000, '0', '235', 1650451408),
(13, 'blog15', 'thumbnail_img1650451727akc1528328023.jpg', 'Incididunt ab velit.', 678405600, 'Lorem,Ipsum,Amet,In qui voluptate in ', 'blog-15', 0, 0, '1', 3, '0', 0, 3000, '0', '741', 1650451727),
(14, 'Blog16', 'thumbnail_img1650969168akc992497947.jpg', '<p>nothing</p>', 1650924000, 'Lorem,Ipsum', NULL, 0, 0, '1', 1, '0', 0, 45, '0', '205', 1650969168),
(15, 'Blog17', 'thumbnail_img1650969539akc1242642457.jpg', '<p>nothing</p>', 1650924000, 'Lorem,Ipsum', NULL, 0, 0, '1', 3, '0', 0, 855, '0', '985', 1650969539),
(16, 'maaru amdavad', 'thumbnail_img1650971373akc1298142986.jpg', '<p>noooo</p>', 1650924000, 'uh', 'maaru-amdavad', 0, 0, '1', 2, '0', 0, 800, '0', '2000', 1650971373),
(17, 'Maaru Amdavad', 'thumbnail_img1650972853akc2045409738.jpg', '<p>nottt</p>', 1650924000, 'hello,nottt', 'maaru-amdavad', 0, 0, '1', 4, '0', 0, 432, '0', '702', 1650971502),
(18, 'Maaru Amdavad', 'thumbnail_img1650969168akc992497947.jpg', '<p>nottt</p>', 1650924000, 'hello,nottt', 'maaru-amdavad', 0, 0, '1', 2, '0', 0, 985, '0', '985', 1650971635),
(19, 'Maaru Amdavad', 'thumbnail_img1650971659akc835305327.jpg', '<p>nottt</p>', 1650924000, 'hello,nottt', 'maaru-amdavad', 0, 0, '1', 4, '0', 0, 854, '0', '541', 1650971659),
(20, 'Maaru Amdavad', 'thumbnail_img1650971702akc1490882319.jpg', '<p>nottt</p>', 1650924000, 'hello,nottt', 'maaru-amdavad', 0, 0, '1', 2, '0', 0, 546, '0', '245', 1650971702),
(21, 'Maaru Amdavad', 'thumbnail_img1650971715akc2039908825.jpg', '<p>nottt</p>', 1650924000, 'hello,nottt', 'maaru-amdavad', 0, 0, '1', 4, '0', 0, 421, '0', '851', 1650971715),
(22, 'Amaru Amdavad', 'thumbnail_img1650972853akc2045409738.jpg', '<p>ndn</p>', 1650924000, 'hello', 'amaru-amdavad-69 ', 0, 0, '1', 2, '0', 0, 471, '0', '145', 1650972853),
(23, 'Maaru Amdabad', 'thumbnail_img1650973028akc140939663.jpg', '<p>good</p>', 498006000, 'good', 'amaru-amdavad-69-91', 0, 0, '1', 2, '0', 0, 4000, '1', '985', 1650976017),
(24, 'Aaj Ni Savar', 'thumbnail_img1651299100akc226308279.jpg', '<p>AAJ NI SAVAR VISHE HU KAHI KEHVA MANGAVA MAANGU CHU.</p><p><img src=\"http://localhost/work73-navisavar.com/admin/uploads/4e136366cba33028c0e1e68f215c0538360113de.jpg\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></p><blockquote><p>helloo</p></blockquote>', 1651269600, 'aajnublog,navisavar,savar,morning', 'aaj-ni-savar-1c ', 0, 0, '1', 4, '1', 0, 3000, '2', '20000', 1651899599);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `unique_link` varchar(256) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `unique_link`, `is_deleted`) VALUES
(1, 'cate11', 'cate-10', 0),
(2, 'cate2', 'cate-2', 0),
(3, 'cate3', 'cate-3', 0),
(4, 'cate4', 'cate-4', 0),
(6, 'cate7', 'category-seven', 0),
(7, 'cate6', 'category-six', 0),
(8, 'cate5', 'category-five', 0),
(9, 'cate8', 'category-eight-7d', 0),
(10, 'cate9', 'category-eight-7d-f4', 0),
(11, 'cate9', 'category-eight-7d-37', 0),
(12, 'cate9', 'category-eight-7d-ba', 0),
(13, 'cate9', 'category-eight-7d-fe', 0),
(14, 'cate9', 'category-eight-7d-a1', 0),
(15, 'cate9', 'category-eight-7d-c3', 0),
(16, 'cate9', 'category-eight-7d-63', 0),
(17, 'cate9', 'category-eight-7d-6f', 0),
(18, 'cate10', 'category-ten-c3', 0),
(19, 'cate10', 'category-ten-b8', 0),
(20, 'cate10', 'category-ten-fd', 0),
(21, 'cate11', 'cate-eleven-70', 0),
(22, 'cate11', 'cate-eleven-57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `blog_id`, `user_id`, `comment`, `is_deleted`, `timestamp`) VALUES
(1, 23, 2, 'Very Helpfull blog', 0, 1651494898),
(2, 6, 3, 'I think this blog is very helpful', 0, 1650924000),
(3, 4, 4, 'this blog is good ', 0, 1651901032),
(4, 24, 5, 'I am happy to read this blog aaj ni savar.', 0, 1651901493),
(5, 24, 2, 'I am happy to read this blog aaj ni savar.', 0, 1651901519),
(6, 4, 2, 'helpfull blog', 0, 1652090586),
(7, 2, 2, 'umai', 0, 1652246235),
(8, 2, 2, 'hello', 0, 1652247685),
(9, 2, 1, 'hello', 0, 1652247745),
(10, 2, 3, 'i am new', 0, 1652247838),
(11, 2, 2, 'jgkjjg', 0, 1652351516);

-- --------------------------------------------------------

--
-- Table structure for table `dislike`
--

CREATE TABLE `dislike` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislike`
--

INSERT INTO `dislike` (`id`, `user_id`, `blog_id`) VALUES
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_role` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `user_img` varchar(256) DEFAULT 'no-image.png',
  `is_banned` int(11) DEFAULT 0,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role`, `name`, `email`, `password`, `user_img`, `is_banned`, `is_verified`, `timestamp`) VALUES
(1, 1, 'admin', 'admin@gmail.com', 'admin', 'user_img1651916898naisavar623141263.png', 0, 0, 1649768739),
(2, 2, 'john', 'test@testing.com', 'test', 'user_img1652339897naisavar1108823740.png', 0, 1, 1649768739),
(3, 2, 'Umair', 'u@gmail.com', 'u', 'user_img1651916432naisavar1481222131.png', 0, 1, 1649840259),
(4, 2, 'Shannon Keller ', 'z@mailinator.com ', ' Autem qui error qui  ', 'user_img1651916432naisavar1481222131.png', 0, 0, 1651916432),
(5, 2, 'Amery Wyatt', 't@mailinator.com', 'pass123', 'user_img1651916898naisavar623141263.png', 0, 0, 1651916898),
(6, 2, 'penerarame@mailinator.com', 'xypebir@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 1652163953),
(7, 2, 'lateho@mailinator.com', 'hatizil@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 1652163953),
(8, 2, 'jyfi@mailinator.com', 'puxydudi@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 1652164114),
(9, 2, '', 'user@tsit.com', 'tsit', NULL, 0, 0, 1652269184),
(10, 2, 'fydyl@mailinator.com', 'gequhyxuse@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652339826),
(11, 2, 'cexaqe@mailinator.com', 'sazo@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652340135),
(12, 2, 'situpiilinator.com', 'qaxahuqi@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652340308),
(13, 2, 'veatorcom', 'qyzuhaha@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652340332),
(14, 2, 'Quinlan Holman', 'lifopysyda@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652340402),
(15, 2, 'Ifeoma Fisher', 'javuc@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652340452),
(16, 2, 'Kevyn Powers', 'puxydeb@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652340651),
(17, 2, 'Andrew Hodge', 'hafovina@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652341054),
(18, 2, 'Ivy Clay', 'nikacuqo@mailinator.com', 'Pa$$w0rd!', 'no-image.png', 0, 0, 1652352832);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_role` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_role`) VALUES
(1, 'admin'),
(2, 'reader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislike`
--
ALTER TABLE `dislike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dislike`
--
ALTER TABLE `dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
