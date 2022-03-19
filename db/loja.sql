-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2022 at 06:47 PM
-- Server version: 10.5.12-MariaDB-0+deb11u1
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja`
--

-- --------------------------------------------------------

--
-- Table structure for table `precos`
--

CREATE TABLE `precos` (
  `idpreco` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `idprodf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `precos`
--

INSERT INTO `precos` (`idpreco`, `preco`, `idprodf`) VALUES
(9, '2.00', 3),
(13, '1.58', 7),
(15, '10.35', 9),
(17, '552.00', 11),
(18, '99.95', 12);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `idprod` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `cor` enum('amarelo','azul','vermelho') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`idprod`, `nome`, `cor`) VALUES
(1, 'aaa', 'azul'),
(2, 'aaa', 'azul'),
(3, 'aaa', 'azul'),
(7, 'nono', 'vermelho'),
(9, 'AAAAAA', 'vermelho'),
(11, 'PV552', 'vermelho'),
(12, 'TesteFinal', 'vermelho');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `precos`
--
ALTER TABLE `precos`
  ADD PRIMARY KEY (`idpreco`),
  ADD KEY `precos_produtos_id` (`idprodf`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idprod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `precos`
--
ALTER TABLE `precos`
  MODIFY `idpreco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `precos`
--
ALTER TABLE `precos`
  ADD CONSTRAINT `precos_produtos_id` FOREIGN KEY (`idprodf`) REFERENCES `produtos` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
