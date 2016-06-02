-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 02 Cze 2016, 10:57
-- Wersja serwera: 5.5.49-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `Twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tweet_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id` (`tweet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Zrzut danych tabeli `Comments`
--

INSERT INTO `Comments` (`id`, `text`, `creation_date`, `user_id`, `tweet_id`) VALUES
(38, 'asdsada', '2016-06-02', 11, 54),
(39, 'asdsada', '2016-06-02', 11, 54),
(40, 'asdsada', '2016-06-02', 11, 54),
(41, 'asdsada', '2016-06-02', 11, 54),
(42, 'asdsada', '2016-06-02', 11, 54),
(43, 'asdsada', '2016-06-02', 11, 54),
(44, 'asdsada', '0000-00-00', 11, 54),
(45, 'asdsada', '0000-00-00', 11, 54),
(46, 'asdsada', '0000-00-00', 11, 54),
(47, 'gdfgdf', '0000-00-00', 11, 54),
(48, 'gdfgdf', '0000-00-00', 11, 54),
(49, 'hfghfg', '0000-00-00', 11, 54),
(50, 'hfghfg', '0000-00-00', 11, 54),
(51, 'hfghfg', '0000-00-00', 11, 54),
(52, 'sdadsad', '0000-00-00', 11, 53),
(53, 'TRalalallaa', '0000-00-00', 5, 55),
(56, 'Komenatrz do tweeta', '0000-00-00', 5, 32);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `readed` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE IF NOT EXISTS `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `text`, `user_id`) VALUES
(32, 'fgdgdfg', 8),
(33, 'fgdgdfg', 8),
(34, 'fgdgdfg', 8),
(36, 'fgdgdfg', 8),
(37, 'hgfhfgh', 9),
(38, 'dsadsadas', 9),
(39, 'ghfhfghf', 9),
(43, 'sdsadsadasdsad', 5),
(45, 'dsadsada', 10),
(46, 'gdfgdfg', 8),
(47, 'gdfgdfg', 8),
(48, 'gdfgdfg', 8),
(49, 'hfghfgh', 8),
(50, 'hfghfgh', 8),
(51, 'hfghfgh', 8),
(52, 'hfghfgh', 8),
(53, 'hfghfgh', 8),
(54, 'testowy tweet', 11),
(55, 'Dodaje nowego tweeta dla uzytkownika 11', 11),
(56, 'Dodaje 50 tweetaaaa', 11),
(57, 'fsdfsdfds', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `fullName`, `active`) VALUES
(1, 'test@wp.pl', '$2y$10$c1w/f9uzeZTV058aQienQuNd1g3/DEpD7Cg8C7S1floixd1bUhV4G', 'KUba', 0),
(2, 'test2@wp.pl', '$2y$10$ovSVVpZou9v4mtrmYFPQj.7WJHWmdXgaMkcWiVgDd0ZNpNlyzx79S', 'kub', 1),
(3, 'kuba@wp.pl', '$2y$10$3S3vO2DH5r9SSven5C9D7OKH98QdTKMJHQRMD8u8AnrxvZ1BUPofC', 'Jakub', 1),
(4, 'admin@wp.pl', '$2y$10$VC/zk62U0RU1gInaGz1J/eZOnvUrrfQSXc0eE0v1uVU4bLcT.c0KO', 'admin', 1),
(5, 'admin@gmail.com', '$2y$10$.Q.LeJlW7VTaHeUO7aPo8.jXp7aBUeX0R67f6RzsL3B5D9DWWseZG', 'admin', 1),
(6, 'test3@gmail.com', '$2y$10$vdOQNfwJP4gSrjrDYgVzaeJpVXAuKqy4OueQ/0Re.WjpEslIEXT8O', 'Testowy', 1),
(7, 'test4@gmail.com', '$2y$10$PsY04tn5Ef3Z986VKl7My.f.SlDv4q5SsIDNCOvm4BCcgcSJks5OC', 'Kuba Test', 1),
(8, 'nowy@gmail.com', '$2y$10$4m4pWnmIaBPdh/8fEp71meygEy/BKZXDavqR250gLhm4HnUDq6Oku', 'KUba', 1),
(9, 'nowy2@gmail.com', '$2y$10$dCWgmAFWyw5CWcDFmZakmOcF2sxAgQ0VMggmydo1mXNP5y/eG9PHy', 'NOwy', 1),
(10, 'test5@wp.pl', '$2y$10$bF5RxOAj9q1H0yyA.5uame3gdXU7RCfmDYDdO791AxrcV859dzp7u', 'adsadsadsad', 1),
(11, 'nowy6@gmail.com', '$2y$10$8qP1KzOVSlvv9lFIpnhTU.i.RG5DFxhOV7sIh1705SshjXvGf5Jt6', 'Testowy6', 1),
(12, 'bootstrap@gmail.com', '$2y$10$Qy8cFTnkjnk4VqmfFCcdiOxMQHz.vOS2NpaN.7Uq9ugwBgbD.Axsu', 'Boot', 1),
(13, 'boot2@gmail.com', '$2y$10$s2SW3gOMDmJkFjAgRlnxkOJ37Dt4DXw.BZTOZhbRpeXIHv7TsJbrK', 'Kuba', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `User_Messages`
--

CREATE TABLE IF NOT EXISTS `User_Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `Tweet` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `User_Messages`
--
ALTER TABLE `User_Messages`
  ADD CONSTRAINT `User_Messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `User_Messages_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `Messages` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
