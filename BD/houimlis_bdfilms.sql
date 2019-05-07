-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2018 at 03:42 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `houimlis_bdfilms`
--
CREATE DATABASE IF NOT EXISTS `houimlis_bdfilms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `houimlis_bdfilms`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_connexion`
--

CREATE TABLE `tbl_connexion` (
  `codeusager` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_films`
--

CREATE TABLE `tbl_films` (
  `num` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `realisateur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `duree` float NOT NULL,
  `prix` float NOT NULL,
  `pochette` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `idm` int(11) NOT NULL,
  `num_film` int(11) NOT NULL,
  `nbr_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `tbl_membres`
--

CREATE TABLE `tbl_membres` (
  `idm` int(11) NOT NULL,
  `codeusager` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `poste` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_connexion`
--
ALTER TABLE `tbl_connexion`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tbl_films`
--
ALTER TABLE `tbl_films`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`idm`,`num_film`);

--
-- Indexes for table `tbl_membres`
--
ALTER TABLE `tbl_membres`
  ADD PRIMARY KEY (`idm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_films`
--
ALTER TABLE `tbl_films`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_membres`
--
ALTER TABLE `tbl_membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
