-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 10:02 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kozmeticki_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(16) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `zakazani_termini`
--

CREATE TABLE `zakazani_termini` (
  `id` int(11) NOT NULL,
  `usluga` varchar(255) NOT NULL,
  `klijent` varchar(255) NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zakazani_termini`
--

INSERT INTO `zakazani_termini` (`id`, `usluga`, `klijent`, `cena`, `datum`) VALUES
(1, 'Fitopiling terapija', 'Zorica Markovic', '4000', '2023-07-07'),
(4, 'Oblikovanje obrva', 'Mira Stankovic', '500', '2023-07-03'),
(5, 'Manikir', 'Danica Djuric', '1000', '2023-07-12'),
(6, 'Tretman vocne kiseline', 'Milos Lazic', '5000', '2023-07-11'),
(7, 'Tretman mlade koze', 'Darko Gavrilovic', '3000', '2023-07-17'),
(8, 'Tretman vocne kiseline', 'Milos Lazic', '5000', '2023-07-11'),
(9, 'Tretman mlade koze', 'Darko Gavrilovic', '3000', '2023-07-17'),
(10, 'Nadogradnja trepavica', 'Milica Radic', '2000', '2023-07-11'),
(11, 'Tretman dermaoxy 1', 'Darko Gavrilovic', '6000', '2023-07-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zakazani_termini`
--
ALTER TABLE `zakazani_termini`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zakazani_termini`
--
ALTER TABLE `zakazani_termini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
