-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 04:31 PM
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
-- Table structure for table `cenovnik`
--

CREATE TABLE `cenovnik` (
  `id` int(11) NOT NULL,
  `tretman` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cena` int(16) NOT NULL,
  `kozmeticar` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cenovnik`
--

INSERT INTO `cenovnik` (`id`, `tretman`, `cena`, `kozmeticar`) VALUES
(1, 'Tretman dermaoxy 1', 6000, 'Zorica'),
(2, 'Tretman dermaoxy 2', 5000, 'Zorica'),
(5, 'Fitopiling terapija', 5000, 'Zorica'),
(6, 'Biotretman alge', 4000, 'Zorica'),
(7, 'Mezoporacija', 3000, 'Zorica'),
(8, 'Klasican tretman', 4000, 'Zorica'),
(9, 'Tretman mlade koze', 3000, 'Zorica'),
(10, 'Oblikovanje obrva', 600, 'Nina'),
(11, 'Manikir', 1000, 'Nina'),
(12, 'CND lakiranje', 1600, 'Nina'),
(13, 'Depilacija', 1000, 'Nina');

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
(1, 'Manikir', 'Danica Djuric', '1000', '2023-06-30'),
(2, 'Fitopiling terapija', 'Mika Mikic', '4000', '2023-06-30'),
(4, 'Tretman mlade koze', 'Darko Gavrilovic', '3000', '2023-07-03'),
(5, 'Tretman dermaoxy 1', 'Marko Ivanovic', '6000', '2023-07-05'),
(26, 'Tretman mlade koze', 'Milos Milovanovic', '3000', '2023-07-04'),
(33, 'Mila', 'Manikir', '433', '2023-07-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cenovnik`
--
ALTER TABLE `cenovnik`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cenovnik`
--
ALTER TABLE `cenovnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zakazani_termini`
--
ALTER TABLE `zakazani_termini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
