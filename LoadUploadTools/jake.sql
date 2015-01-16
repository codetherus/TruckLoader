-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2011 at 08:17 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jake`
--

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_loads`
--

DROP TABLE IF EXISTS `uploaded_loads`;
CREATE TABLE IF NOT EXISTS `uploaded_loads` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `offer_number` varchar(15) NOT NULL,
  `ocity` varchar(30) NOT NULL,
  `ost` varchar(2) NOT NULL,
  `ozip` varchar(11) NOT NULL,
  `dcity` varchar(30) NOT NULL,
  `dst` varchar(2) NOT NULL,
  `dzip` varchar(15) NOT NULL,
  `pickup_start` date NOT NULL,
  `pickup_end` date NOT NULL,
  `delivery_start` date NOT NULL,
  `delivery_end` date NOT NULL,
  `state` varchar(30) NOT NULL,
  `weight` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `hazmat` varchar(10) NOT NULL,
  `over_dim` varchar(10) NOT NULL,
  `len` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  `hgt` int(11) NOT NULL,
  `eqpt` varchar(10) NOT NULL,
  `origin` varchar(80) NOT NULL,
  `destination` varchar(80) NOT NULL,
  `truckstop_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `offer_number` (`offer_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Military Loads uploaded from spreadsheet' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `uploaded_loads`
--

