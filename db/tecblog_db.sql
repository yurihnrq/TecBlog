-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Dez-2018 às 15:43
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecblog_db`
--
CREATE DATABASE IF NOT EXISTS `tecblog_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tecblog_db`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_pub`
--

CREATE TABLE `table_pub` (
  `id` int(11) NOT NULL,
  `pub_title` varchar(35) NOT NULL,
  `pub_text` text NOT NULL,
  `pub_theme` enum('software','games','hardware') NOT NULL,
  `pub_date` date NOT NULL,
  `pub_img` varchar(100) NOT NULL,
  `adm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `table_user`
--

CREATE TABLE `table_user` (
  `id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_adm` enum('user','adm') NOT NULL,
  `user_text` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `table_user`
--

INSERT INTO `table_user` (`id`, `user_email`, `user_pass`, `user_name`, `user_adm`, `user_text`) VALUES
(2, 'yurihenrique.bernardes@gmail.com', 'aaee5d48e6c76dad3fa9020a5439e725', 'Yuri Henrique', 'adm', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_pub`
--
ALTER TABLE `table_pub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adm_pub` (`adm_id`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `USER_EMAIL` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_pub`
--
ALTER TABLE `table_pub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `table_pub`
--
ALTER TABLE `table_pub`
  ADD CONSTRAINT `adm_pub` FOREIGN KEY (`adm_id`) REFERENCES `table_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
