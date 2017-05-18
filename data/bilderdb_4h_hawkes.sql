-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Mai 2017 um 23:38
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bilderdb_4h_hawkes`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `access_user`
--

CREATE TABLE `access_user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `access_user`
--

INSERT INTO `access_user` (`id`, `username`, `email`, `password`) VALUES
(1, 'Test', 'test@gibb.ch', 'f0449f4d4ad115a9df25c6569723a7737bf137cb'),
(2, 'Sam', 'sam.hawkes@comvation.com', '48c856b6b8586122dc695f13a31888e364e3da15');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gallery_category`
--

CREATE TABLE `gallery_category` (
  `id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_german2_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `title`, `description`, `user_id`) VALUES
(1, 'Tiere', 'Hier sind alle Bilder zu Tieren', 1),
(2, 'Sonstiges', '', 1),
(3, 'Test', 'Dies ist ein Test', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gallery_image`
--

CREATE TABLE `gallery_image` (
  `id` int(11) NOT NULL,
  `image_name` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `title` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `gallery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `gallery_image`
--

INSERT INTO `gallery_image` (`id`, `image_name`, `title`, `gallery_id`) VALUES
(1, 'zebra.jpg', 'Zebra', 1),
(2, 'ente.jpg', 'Ente', 1),
(3, 'katze.jpg', 'Katze', 1),
(4, 'hund.png', 'Hund', 1),
(5, 'reh.jpg', 'Reh', 1),
(6, 'erde.gif', 'Erde', 2),
(7, 'giphy.gif', 'Star Wars', 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `access_user`
--
ALTER TABLE `access_user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gallery_category`
--
ALTER TABLE `gallery_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_id` (`gallery_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `access_user`
--
ALTER TABLE `access_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `gallery_category`
--
ALTER TABLE `gallery_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `gallery_category`
--
ALTER TABLE `gallery_category`
  ADD CONSTRAINT `gallery_category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `access_user` (`id`);

--
-- Constraints der Tabelle `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD CONSTRAINT `gallery_image_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
