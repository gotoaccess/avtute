-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 01:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avtute`
--

-- --------------------------------------------------------

--
-- Table structure for table `sitearticle`
--

CREATE TABLE `sitearticle` (
  `article_primary` int(8) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_url` varchar(255) NOT NULL,
  `fk_topic_primary` varchar(8) NOT NULL,
  `article_html` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `article_thumb` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sitearticle`
--

INSERT INTO `sitearticle` (`article_primary`, `article_title`, `article_url`, `fk_topic_primary`, `article_html`, `created`, `article_thumb`, `deleted`) VALUES
(1, 'What is HTML?', 'What+is+HTML+?', '2', '<h2 style=\"box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin-top: 10px; color: rgb(0, 0, 0);\">What is HTML?</h2><ul style=\"box-sizing: inherit; font-family: Verdana, sans-serif; font-size: 15px;\"><li style=\"box-sizing: inherit;\">HTML stands for Hyper Text Markup Language</li><li style=\"box-sizing: inherit;\">HTML is the standard markup language for creating Web pages</li><li style=\"box-sizing: inherit;\">HTML describes the structure of a Web page</li><li style=\"box-sizing: inherit;\">HTML consists of a series of elements</li><li style=\"box-sizing: inherit;\">HTML elements tell the browser how to display the content</li><li style=\"box-sizing: inherit;\">HTML elements label pieces of content such as \"this is a heading\", \"this is a paragraph\", \"this is a link\", etc.</li></ul><hr style=\"height: 0px; overflow: visible; border-top-color: rgb(238, 238, 238); margin: 20px -16px; font-family: Verdana, sans-serif; font-size: 15px;\"><h2 style=\"box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin-top: 10px; color: rgb(0, 0, 0);\">A Simple HTML Document</h2>', '2021-04-05 23:29:13', NULL, 0),
(2, 'What is JavaScript?', 'what+is+javaScript', '14', '<p>Hello World</p>', '2021-04-28 23:36:58', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sitemenu`
--

CREATE TABLE `sitemenu` (
  `menu_primary` int(4) NOT NULL,
  `sitemenu_title` varchar(255) NOT NULL,
  `sitemenu_url` varchar(255) NOT NULL,
  `sitemenu_parent` varchar(4) DEFAULT NULL,
  `created` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sitemenu`
--

INSERT INTO `sitemenu` (`menu_primary`, `sitemenu_title`, `sitemenu_url`, `sitemenu_parent`, `created`, `deleted`) VALUES
(7, 'HTML', 'html', '', '2021-03-21 02:10:07', 0),
(8, 'CSS', 'css', '', '2021-03-21 02:10:20', 0),
(9, 'JavaScript', 'javascript', '', '2021-03-21 02:11:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sitetopic`
--

CREATE TABLE `sitetopic` (
  `topic_primary` int(8) NOT NULL,
  `menu_parent` varchar(255) NOT NULL,
  `topic_title` varchar(255) NOT NULL,
  `topic_url` varchar(225) NOT NULL,
  `topic_parent` varchar(8) DEFAULT NULL,
  `created` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sitetopic`
--

INSERT INTO `sitetopic` (`topic_primary`, `menu_parent`, `topic_title`, `topic_url`, `topic_parent`, `created`, `deleted`) VALUES
(1, 'html', 'Start with HTML', 'start+with+html', NULL, '2021-03-21 03:01:46', 0),
(2, 'html', 'HTML Documents', 'html+documents', NULL, '2021-03-21 03:03:22', 0),
(3, 'html', 'HTML Elements', 'html+elements', NULL, '2021-03-21 03:23:22', 0),
(4, 'css', 'CSS Introduction', 'css+introduction', NULL, '2021-03-21 03:34:24', 0),
(5, 'css', 'CSS Selectors', 'css+selectors', NULL, '2021-03-21 03:34:47', 0),
(6, 'html', 'HTML Headings', 'html+headings', NULL, '2021-03-23 15:53:19', 0),
(14, 'javascript', 'What is JavaScript', 'what+is+javascript', NULL, '2021-04-28 23:35:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siteuser`
--

CREATE TABLE `siteuser` (
  `user_primary` int(3) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_password` varchar(225) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siteuser`
--

INSERT INTO `siteuser` (`user_primary`, `user_name`, `user_password`, `created`) VALUES
(1, 'omie', '21232f297a57a5a743894a0e4a801fc3', '2021-04-23 00:00:00'),
(2, 'shashvat', '21232f297a57a5a743894a0e4a801fc3', '2021-04-14 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sitearticle`
--
ALTER TABLE `sitearticle`
  ADD PRIMARY KEY (`article_primary`);

--
-- Indexes for table `sitemenu`
--
ALTER TABLE `sitemenu`
  ADD PRIMARY KEY (`menu_primary`);

--
-- Indexes for table `sitetopic`
--
ALTER TABLE `sitetopic`
  ADD PRIMARY KEY (`topic_primary`);

--
-- Indexes for table `siteuser`
--
ALTER TABLE `siteuser`
  ADD PRIMARY KEY (`user_primary`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sitearticle`
--
ALTER TABLE `sitearticle`
  MODIFY `article_primary` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sitemenu`
--
ALTER TABLE `sitemenu`
  MODIFY `menu_primary` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sitetopic`
--
ALTER TABLE `sitetopic`
  MODIFY `topic_primary` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `siteuser`
--
ALTER TABLE `siteuser`
  MODIFY `user_primary` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
