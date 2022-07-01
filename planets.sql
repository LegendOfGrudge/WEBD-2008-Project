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
-- Table structure for table `planets`
--

CREATE TABLE `planets` (
  `planet_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `climate` varchar(60) NOT NULL,
  `terrain` varchar(60) NOT NULL,
  `population` bigint(30) NOT NULL,
  `diameter` int(30) NOT NULL,
  `surface_water` int(3) NOT NULL,
  `image` varchar(255) NOT NULL,
  `api_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planets`
--

INSERT INTO `planets` (`planet_id`, `name`, `climate`, `terrain`, `population`, `diameter`, `surface_water`, `image`, `api_url`) VALUES
(1, 'Tatooine', 'arid', 'desert', 200000, 10465, 1, 'uploads/Tatooine.png', 'https://swapi.dev/api/planets/1/'),
(2, 'Alderaan', 'temperate', 'grasslands, mountains', 2000000000, 12500, 40, 'uploads/Alderaan.png', 'https://swapi.dev/api/planets/2/'),
(3, 'Yavin IV', 'temperate, tropical', 'jungle, rainforests', 1000, 10200, 8, '', 'https://swapi.dev/api/planets/3/'),
(4, 'Hoth', 'frozen', 'tundra, ice caves, mountain ranges', 0, 7200, 100, '', 'https://swapi.dev/api/planets/4/'),
(5, 'Dagobah', 'murky', 'swamp, jungles', 0, 8900, 8, '', 'https://swapi.dev/api/planets/5/'),
(6, 'Bespin', 'temperate', 'gas giant', 6000000, 118000, 0, 'uploads/Bespin.png', 'https://swapi.dev/api/planets/6/'),
(7, 'Endor', 'temperate', 'forests, mountains, lakes', 30000000, 4900, 8, 'uploads/Endor.png', 'https://swapi.dev/api/planets/7/'),
(8, 'Naboo', 'temperate', 'grassy hills, swamps, forests, mountains', 4500000000, 12120, 12, 'uploads/Naboo.png', 'https://swapi.dev/api/planets/8/'),
(9, 'Coruscant', 'temperate', 'cityscape, mountains', 1000000000000, 12240, 0, 'uploads/Coruscant.png', 'https://swapi.dev/api/planets/9/'),
(10, 'Kamino', 'temperate', 'ocean', 1000000000, 19720, 100, '', 'https://swapi.dev/api/planets/10/'),
(11, 'Geonosis', 'temperate, arid', 'rock, desert, mountain, barren', 100000000000, 11370, 5, '', 'https://swapi.dev/api/planets/11/'),
(12, 'Utapau', 'temperate, arid, windy', 'scrublands, savanna, canyons, sinkholes', 95000000, 12900, 1, '', 'https://swapi.dev/api/planets/12/'),
(13, 'Mustafar', 'hot', 'volcanoes, lava rivers, mountains, caves', 20000, 4200, 0, 'uploads/Mustafar.png', 'https://swapi.dev/api/planets/13/'),
(14, 'Kashyyyk', 'tropical', 'jungle, forests, lakes, rivers', 45000000, 12765, 60, '', 'https://swapi.dev/api/planets/14/'),
(15, 'Polis Massa', 'artificial temperate', 'airless asteroid', 1000000, 0, 0, '', 'https://swapi.dev/api/planets/15/'),
(16, 'Mygeeto', 'frigid', 'glaciers, mountains, ice canyons', 19000000, 10088, 0, '', 'https://swapi.dev/api/planets/16/'),
(17, 'Felucia', 'hot, humid', 'fungus forests', 8500000, 9100, 5, '', 'https://swapi.dev/api/planets/17/'),
(18, 'Cato Neimoidia', 'temperate, moist', 'mountains, fields, forests, rock arches', 10000000, 0, 5, '', 'https://swapi.dev/api/planets/18/'),
(19, 'Saleucami', 'hot', 'caves, desert, mountains, volcanoes', 1400000000, 14920, 0, '', 'https://swapi.dev/api/planets/19/'),
(20, 'Stewjon', 'temperate', 'grass', 0, 0, 0, '', 'https://swapi.dev/api/planets/20/'),
(21, 'Eriadu', 'polluted', 'cityscape', 22000000000, 13490, 0, '', 'https://swapi.dev/api/planets/21/'),
(22, 'Corellia', 'temperate', 'plains, urban, hills, forests', 3000000000, 11000, 70, '', 'https://swapi.dev/api/planets/22/'),
(23, 'Rodia', 'hot', 'jungles, oceans, urban, swamps', 1300000000, 7549, 60, '', 'https://swapi.dev/api/planets/23/'),
(24, 'Nal Hutta', 'temperate', 'urban, oceans, swamps, bogs', 7000000000, 12150, 0, '', 'https://swapi.dev/api/planets/24/'),
(25, 'Dantooine', 'temperate', 'oceans, savannas, mountains, grasslands', 1000, 9830, 0, '', 'https://swapi.dev/api/planets/25/'),
(26, 'Bestine IV', 'temperate', 'rocky islands, oceans', 62000000, 6400, 98, '', 'https://swapi.dev/api/planets/26/'),
(27, 'Ord Mantell', 'temperate', 'plains, seas, mesas', 4000000000, 14050, 10, '', 'https://swapi.dev/api/planets/27/'),
(28, 'Trandosha', 'arid', 'mountains, seas, grasslands, deserts', 42000000, 0, 0, '', 'https://swapi.dev/api/planets/29/'),
(29, 'Socorro', 'arid', 'deserts, mountains', 300000000, 0, 0, '', 'https://swapi.dev/api/planets/30/'),
(30, 'Mon Cala', 'temperate', 'oceans, reefs, islands', 27000000000, 11030, 100, '', 'https://swapi.dev/api/planets/31/'),
(31, 'Chandrilla', 'temperate', 'plains, forests', 1200000000, 13500, 40, '', 'https://swapi.dev/api/planets/32/'),
(32, 'Sullust', 'superheated', 'mountains, volcanoes, rocky deserts', 18500000000, 12780, 5, 'uploads/Sullust.png', 'https://swapi.dev/api/planets/33/'),
(33, 'Toydaria', 'temperate', 'swamps, lakes', 11000000, 7900, 0, '', 'https://swapi.dev/api/planets/34/'),
(34, 'Malastare', 'arid, temperate, tropical', 'swamps, deserts, jungles, mountains', 2000000000, 18880, 0, '', 'https://swapi.dev/api/planets/35/'),
(35, 'Dathomir', 'temperate', 'forests, deserts, savannas', 5200, 10480, 0, '', 'https://swapi.dev/api/planets/36/'),
(36, 'Ryloth', 'temperate, arid, subartic', 'mountains, valleys, deserts, tundra', 1500000000, 10600, 5, '', 'https://swapi.dev/api/planets/37/'),
(37, 'Vulpter', 'temperate, artic', 'urban, barren', 421000000, 14900, 0, '', 'https://swapi.dev/api/planets/39/'),
(38, 'Haruun Kal', 'temperate', 'toxic cloudsea, plateaus, volcanoes', 705300, 10120, 0, '', 'https://swapi.dev/api/planets/42/'),
(39, 'Cerea', 'temperate', 'verdant', 450000000, 0, 20, '', 'https://swapi.dev/api/planets/43/'),
(40, 'Glee Anselm', 'tropical, temperate', 'lakes, islands, swamps, seas', 500000000, 15600, 80, '', 'https://swapi.dev/api/planets/44/'),
(41, 'Muunilinst', 'temperate', 'plains, forests, hills, mountains', 5000000000, 13800, 25, '', 'https://swapi.dev/api/planets/57/'),
(42, 'Kalee', 'arid, temperate, tropical', 'rainforests, cliffs, canyons, seas', 4000000000, 13850, 0, '', 'https://swapi.dev/api/planets/59/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`planet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `planets`
--
ALTER TABLE `planets`
  MODIFY `planet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
