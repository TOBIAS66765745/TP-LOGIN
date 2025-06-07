-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 02:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nusuarios`
--

-- --------------------------------------------------------

--
-- Table structure for table `recupera`
--

CREATE TABLE `recupera` (
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `clave_nueva` varchar(60) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registro_nuevo`
--

CREATE TABLE `registro_nuevo` (
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `EMail` varchar(150) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Clave` varchar(255) NOT NULL,
  `pass_cifrada` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registro_nuevo`
--

INSERT INTO `registro_nuevo` (`Nombre`, `Apellido`, `EMail`, `Usuario`, `Clave`, `pass_cifrada`) VALUES
('nahuek', 'gerez', 'nahuzinho0800@gmail.com', 'nahuel10', '', '$2y$10$hCxjDr2d1T06E.pQ4CK.M.hvtblI652u9XrMogchrFiwzheOVYEm.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registro_nuevo`
--
ALTER TABLE `registro_nuevo`
  ADD UNIQUE KEY `email` (`EMail`),
  ADD UNIQUE KEY `usuario` (`Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
