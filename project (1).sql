-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 jun 2017 om 22:29
-- Serverversie: 10.1.22-MariaDB
-- PHP-versie: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `collector`
--

CREATE TABLE `collector` (
  `id` int(11) NOT NULL,
  `Temperature` float NOT NULL,
  `Air-pressure` float NOT NULL,
  `Air-quality` float NOT NULL,
  `Wind-speed` float NOT NULL,
  `Wind-direction` varchar(2) NOT NULL,
  `Rain-gauge` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `collector`
--

INSERT INTO `collector` (`id`, `Temperature`, `Air-pressure`, `Air-quality`, `Wind-speed`, `Wind-direction`, `Rain-gauge`, `date`) VALUES
(2, 20, 80, 90, 30, 'N', 10, '2017-06-03 16:48:46'),
(3, 23, 70, 100, 25, 'NE', 0, '2017-06-03 16:56:30');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `collector`
--
ALTER TABLE `collector`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `collector`
--
ALTER TABLE `collector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
