-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2016 at 08:48 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_block_fee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartament`
--

CREATE TABLE `appartament` (
  `app_ID` int(11) NOT NULL,
  `app_etaj` int(11) NOT NULL,
  `app_people` int(11) NOT NULL,
  `app_nachDataPolzvane` date NOT NULL,
  `app_vreme_na_nepolzvane_START` date DEFAULT NULL,
  `app_vreme_na_nepolzvane_END` date DEFAULT NULL,
  `app_other_info` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `msg_ID` int(11) NOT NULL,
  `msg_type` varchar(20) NOT NULL,
  `msg_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_ID` int(11) NOT NULL,
  `users_username` varchar(50) NOT NULL,
  `users_password` varchar(50) NOT NULL,
  `users_email` varchar(50) NOT NULL,
  `users_first_name` varchar(50) NOT NULL,
  `users_last_name` varchar(50) NOT NULL,
  `users_adress` varchar(100) NOT NULL,
  `users_premissions` int(11) NOT NULL,
  `users_etaj` int(11) NOT NULL,
  `users_apartament` int(11) NOT NULL,
  `users_tel_nomer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vhod`
--

CREATE TABLE `vhod` (
  `vhod_domoupraviteli` varchar(90) NOT NULL,
  `vhod_taksa_asansior` decimal(10,0) DEFAULT NULL,
  `vhod_taksa_vhod` decimal(10,0) DEFAULT NULL,
  `vhod_taska_pet` decimal(10,0) DEFAULT NULL,
  `vhod_taska_chistachka` decimal(10,0) DEFAULT NULL,
  `vhod_taksa_dop` decimal(10,0) DEFAULT NULL,
  `vhod_pari` decimal(10,0) DEFAULT NULL,
  `vhod_taska_elec` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartament`
--
ALTER TABLE `appartament`
  ADD PRIMARY KEY (`app_ID`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`msg_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appartament`
--
ALTER TABLE `appartament`
  MODIFY `app_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `msg_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
