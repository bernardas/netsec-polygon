-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2021 at 08:31 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `visit_id` int(11) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `hour` int(2) NOT NULL,
  `minute` int(2) NOT NULL,
  `ssn` varchar(11) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doc_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `profession` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doc_id`, `fname`, `lname`, `password`, `profession`) VALUES
(1, 'Aurelijus', 'Veryga', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy', 'Psychiatrist'),
(111, 'Petras', 'Petraitis', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy', 'Cardiologist'),
(321, 'Henrikas', 'Daktaras', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy', 'Surgeon'),
(322, 'Jonas', 'Jonaitis', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy', 'Cardiologist'),
(324, 'Vaclovas', 'Pyragius', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy', 'Dentist'),
(325, 'Terese', 'Krusnauskiene', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy', 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `visit_id` int(11) NOT NULL,
  `doc_id` varchar(11) NOT NULL,
  `ssn` varchar(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `prescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `ssn` varchar(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `ssn`, `fname`, `lname`, `password`) VALUES
(6, '123', 'Jonas', 'Jonaitis', '$2y$10$nwJ3.FTz.N1WZjbegiwaIOpj5elwZPyAmk6fHpIOzjg0ZEuMLR0iy'),
(8, '12345678900', 'Mykolas', 'Jonas', '$2y$10$LLgRL3woAepSkw/XLKQFbO7dyqimuNJ5E3hzbP9DI.9x1X2hHs1qu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD UNIQUE KEY `visit_id` (`visit_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD UNIQUE KEY `visit_id` (`visit_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3375;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
