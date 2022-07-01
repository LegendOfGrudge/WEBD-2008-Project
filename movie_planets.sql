-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2022 at 11:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_planets`
--

CREATE TABLE `movie_planets` (
  `movie_id` int(10) NOT NULL,
  `planet_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_planets`
--

INSERT INTO `movie_planets` (`movie_id`, `planet_id`, `name`) VALUES
(1, 1, 'Tatooine'),
(1, 8, 'Naboo'),
(1, 9, 'Coruscant'),
(2, 1, 'Tatooine'),
(2, 8, 'Naboo'),
(2, 9, 'Coruscant'),
(2, 10, 'Kamino'),
(2, 11, 'Geonosis'),
(3, 1, 'Tatooine'),
(3, 2, 'Alderaan'),
(3, 5, 'Dagobah'),
(3, 8, 'Naboo'),
(3, 9, 'Coruscant'),
(3, 12, 'Utapau'),
(3, 13, 'Mustafar'),
(3, 14, 'Kashyyyk'),
(3, 15, 'Polis Massa'),
(3, 16, 'Mygeeto'),
(3, 17, 'Felucia'),
(3, 18, 'Cato Neimoidia'),
(3, 19, 'Saleucami'),
(4, 1, 'Tatooine'),
(4, 2, 'Alderaan'),
(4, 3, 'Yavin IV'),
(5, 4, 'Hoth'),
(5, 5, 'Dagobah'),
(5, 6, 'Bespin'),
(5, 27, 'Ord Mantell'),
(6, 1, 'Tatooine'),
(6, 5, 'Dagobah'),
(6, 7, 'Endor'),
(6, 8, 'Naboo'),
(6, 9, 'Coruscant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_planets`
--
ALTER TABLE `movie_planets`
  ADD PRIMARY KEY (`movie_id`,`planet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
