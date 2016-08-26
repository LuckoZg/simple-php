-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2014 at 08:44 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kolekcija`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

CREATE TABLE IF NOT EXISTS `filmovi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naslov` varchar(150) NOT NULL,
  `id_naziv` int(10) unsigned NOT NULL,
  `godina` year(4) NOT NULL,
  `trajanje` varchar(20) NOT NULL,
  `slika` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_naziv` (`id_naziv`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `filmovi`
--

INSERT INTO `filmovi` (`id`, `naslov`, `id_naziv`, `godina`, `trajanje`, `slika`) VALUES
(14, 'Antitrust', 2, 2001, '96', 'images/doc_1402798849.jpg'),
(22, 'Hackers', 2, 1995, '89', 'images/doc_1402850752.jpg'),
(23, 'Operation Swordfish', 4, 2001, '111', 'images/doc_1402850817.jpg'),
(24, 'Operation Takedown', 1, 2000, '123', 'images/doc_1402850960.jpg'),
(25, 'Pirates Of Silicon Valley', 4, 1999, '95', 'images/doc_1402850991.jpg'),
(26, 'The Social Network', 4, 2010, '87', 'images/doc_1402851052.jpg'),
(27, 'Tron', 1, 1982, '74', 'images/doc_1402851078.jpg'),
(28, 'Tron Legacy', 1, 2010, '92', 'images/doc_1402851099.jpg'),
(29, 'War Games', 1, 1983, '102', 'images/doc_1402851134.jpg'),
(30, 'Firewall', 6, 2006, '77', 'images/doc_1402851179.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `zanr`
--

CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `zanr`
--

INSERT INTO `zanr` (`id`, `naziv`) VALUES
(1, 'Akcija'),
(2, 'Triler'),
(3, 'Komedija'),
(4, 'Drama'),
(5, 'SF'),
(6, 'Horor');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD CONSTRAINT `filmovi_ibfk_1` FOREIGN KEY (`id_naziv`) REFERENCES `zanr` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
