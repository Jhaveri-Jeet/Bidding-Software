
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 10:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidingsoftwaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `biding`
--

CREATE TABLE `biding` (
  `Id` int(11) NOT NULL,
  `RequirementId` int(11) NOT NULL,
  `SellerId` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biding`
--

INSERT INTO `biding` (`Id`, `RequirementId`, `SellerId`, `Price`, `Description`) VALUES
(1, 1, 1, 2000, 'i can give what you want ');

-- --------------------------------------------------------

--
-- Table structure for table `requirement`
--

CREATE TABLE `requirement` (
  `Id` int(11) NOT NULL,
  `BuyerId` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Requirement` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'NotFulfilled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirement`
--

INSERT INTO `requirement` (`Id`, `BuyerId`, `Price`, `Requirement`, `Description`, `Status`) VALUES
(1, 2, 20, 'i want 200 pieces', 'i want 200 pieces by this week', 'Fulfilled'),
(3, 2, 200, 'i want 3000 pieces ', 'i am giving the prices per piece', 'NotFulfilled'),
(4, 2, 50, 'i want 5000 pieces', 'i want 5000 pieces', 'NotFulfilled'),
(5, 5, 200, 'i want 30000 brass taps ', 'i want 30000 taps of brass material', 'NotFulfilled');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL,
  `RoleName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'Seller'),
(3, 'Buyer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Business` varchar(250) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Number` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `RoleId`, `Username`, `Password`, `Email`, `Business`, `Address`, `Number`) VALUES
(1, 2, 'Testing Seller', 'admin', 'testing@gmail,com', 'Brass Part', 'this is my address', '9712791515'),
(2, 3, 'Testing Buyer', 'admin', 'testing@gmail.com', 'Brass Part', 'this is my address', '9499815372'),
(3, 2, 'Testing Seller 2', 'admin', 'testing@gmail,com', 'Steal Manufacturing', 'this is my address', '7894561234'),
(4, 1, 'S K Industry', 'admin', 'testing@gmail.com', 'Industry', 'This is my address', '9712791515'),
(5, 3, 'Testing Buyer 2', 'admin', 'testing@gmail.com', 'Brass Part', 'this is my address', '9712791515');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biding`
--
ALTER TABLE `biding`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RequirmentId` (`RequirementId`),
  ADD KEY `SellerId` (`SellerId`);

--
-- Indexes for table `requirement`
--
ALTER TABLE `requirement`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BuyerId` (`BuyerId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoleId` (`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biding`
--
ALTER TABLE `biding`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requirement`
--
ALTER TABLE `requirement`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biding`
--
ALTER TABLE `biding`
  ADD CONSTRAINT `biding_ibfk_1` FOREIGN KEY (`RequirementId`) REFERENCES `requirement` (`Id`),
  ADD CONSTRAINT `biding_ibfk_2` FOREIGN KEY (`SellerId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `requirement`
--
ALTER TABLE `requirement`
  ADD CONSTRAINT `requirement_ibfk_1` FOREIGN KEY (`BuyerId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
