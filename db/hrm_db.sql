-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 05:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `hrm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CityId` int(11) NOT NULL,
  `StateId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityId`, `StateId`, `Name`) VALUES
(1, 1, 'Sample 101'),
(2, 1, 'Sample 102'),
(21, 1, 'Manila'),
(22, 1, 'Muntinlupa'),
(23, 4, 'Los Angeles'),
(24, 3, 'Washington');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `CountryId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`CountryId`, `Name`) VALUES
(1, 'Philippines'),
(9, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `dailyworkload`
--

CREATE TABLE `dailyworkload` (
  `DailyWorkLoadId` bigint(20) NOT NULL,
  `EmpId` varchar(50) NOT NULL,
  `LoginDate` datetime DEFAULT NULL,
  `LogoutDate` datetime DEFAULT NULL,
  `DailyWorkingminutes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpId` bigint(20) NOT NULL,
  `EmployeeId` varchar(11) NOT NULL,
  `FirstName` varchar(200) NOT NULL,
  `MiddleName` varchar(200) NOT NULL,
  `LastName` varchar(200) NOT NULL,
  `Birthdate` date NOT NULL,
  `Gender` int(10) NOT NULL,
  `Address1` varchar(500) NOT NULL,
  `Address2` varchar(500) NOT NULL,
  `Address3` varchar(500) NOT NULL,
  `CityId` int(11) NOT NULL,
  `Mobile` decimal(10,0) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `AadharNumber` varchar(25) NOT NULL,
  `MaritalStatus` int(11) NOT NULL,
  `PositionId` int(11) NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `JoinDate` date NOT NULL,
  `LeaveDate` date DEFAULT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `LastLogout` datetime DEFAULT NULL,
  `StatusId` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `ImageName` varchar(1000) DEFAULT NULL,
  `MacAddress` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpId`, `EmployeeId`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Gender`, `Address1`, `Address2`, `Address3`, `CityId`, `Mobile`, `Email`, `Password`, `AadharNumber`, `MaritalStatus`, `PositionId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `JoinDate`, `LeaveDate`, `LastLogin`, `LastLogout`, `StatusId`, `RoleId`, `ImageName`, `MacAddress`) VALUES
(1, '1', 'admin', 'admin', 'admin', '1994-10-09', 1, 'address1', 'address2', 'address3', 1, '9999999999', 'admin@gmail.com', 'admin#123', '12354658496', 2, 1, 1, '2017-01-01 00:00:00', 1, '2017-01-31 10:33:33', '2017-01-11', '2017-01-18', '2022-10-10 09:10:42', '2017-02-09 15:12:09', 1, 1, 'images (2).jpg', ''),
(2, '6231415', 'Mark', 'D', 'Cooper', '2022-10-10', 1, 'Sample Address 101', 'Sample Address 102', '', 22, '912345678', 'mcooper@mail.com', 'mcooper#123', '', 1, 2, 1, '2022-10-10 08:01:43', 1, '2022-10-10 08:05:39', '2022-10-10', '0000-00-00', '2022-10-10 08:55:27', '2022-10-10 08:55:05', 1, 3, '33615user.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `GenderId` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GenderId`, `Name`) VALUES
(1, 'male'),
(2, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `leavedays`
--

CREATE TABLE `leavedays` (
  `LeaveDayId` bigint(20) NOT NULL,
  `LeaveDay` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leavedays`
--

INSERT INTO `leavedays` (`LeaveDayId`, `LeaveDay`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `leavedetails`
--

CREATE TABLE `leavedetails` (
  `Detail_Id` bigint(20) NOT NULL,
  `EmpId` bigint(20) NOT NULL,
  `TypesLeaveId` int(10) NOT NULL,
  `Reason` varchar(500) NOT NULL,
  `StateDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `LeaveStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leavedetails`
--

INSERT INTO `leavedetails` (`Detail_Id`, `EmpId`, `TypesLeaveId`, `Reason`, `StateDate`, `EndDate`, `LeaveStatus`) VALUES
(1, 6231415, 3, 'Sample Reason', '2022-10-12', '2022-10-14', 'Accept');

-- --------------------------------------------------------

--
-- Table structure for table `maritalstatus`
--

CREATE TABLE `maritalstatus` (
  `MaritalId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maritalstatus`
--

INSERT INTO `maritalstatus` (`MaritalId`, `Name`) VALUES
(1, 'Married'),
(2, 'Unmarried');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `PositinId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`PositinId`, `Name`) VALUES
(1, 'HR'),
(2, 'Web Developer'),
(3, 'Fullstack PHP Developer');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleId`, `Name`) VALUES
(1, 'admin'),
(2, 'admin-hr'),
(3, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StateId` int(11) NOT NULL,
  `CountryId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateId`, `CountryId`, `Name`) VALUES
(1, 1, 'Metro Manila'),
(2, 1, 'Negros Oriental'),
(3, 9, 'DC'),
(4, 9, 'California');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusId`, `Name`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_leave`
--

CREATE TABLE `type_of_leave` (
  `LeaveId` bigint(20) NOT NULL,
  `Type_of_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_leave`
--

INSERT INTO `type_of_leave` (`LeaveId`, `Type_of_Name`) VALUES
(1, 'sick leave'),
(3, 'casual leave'),
(4, 'privilege leave'),
(5, 'half day leave');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CityId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`CountryId`);

--
-- Indexes for table `dailyworkload`
--
ALTER TABLE `dailyworkload`
  ADD PRIMARY KEY (`DailyWorkLoadId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpId`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`GenderId`);

--
-- Indexes for table `leavedays`
--
ALTER TABLE `leavedays`
  ADD PRIMARY KEY (`LeaveDayId`);

--
-- Indexes for table `leavedetails`
--
ALTER TABLE `leavedetails`
  ADD PRIMARY KEY (`Detail_Id`);

--
-- Indexes for table `maritalstatus`
--
ALTER TABLE `maritalstatus`
  ADD PRIMARY KEY (`MaritalId`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`PositinId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`StateId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusId`);

--
-- Indexes for table `type_of_leave`
--
ALTER TABLE `type_of_leave`
  ADD PRIMARY KEY (`LeaveId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `CountryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dailyworkload`
--
ALTER TABLE `dailyworkload`
  MODIFY `DailyWorkLoadId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `GenderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leavedays`
--
ALTER TABLE `leavedays`
  MODIFY `LeaveDayId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leavedetails`
--
ALTER TABLE `leavedetails`
  MODIFY `Detail_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `PositinId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `StateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_of_leave`
--
ALTER TABLE `type_of_leave`
  MODIFY `LeaveId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

-- First clear existing state data
DELETE FROM state WHERE CountryId = 1;

-- Insert all Philippine provinces
INSERT INTO state (CountryId, Name) VALUES
(1, 'Abra'),
(1, 'Agusan del Norte'),
(1, 'Agusan del Sur'),
(1, 'Aklan'),
(1, 'Albay'),
(1, 'Antique'),
(1, 'Apayao'),
(1, 'Aurora'),
(1, 'Basilan'),
(1, 'Bataan'),
(1, 'Batanes'),
(1, 'Batangas'),
(1, 'Benguet'),
(1, 'Biliran'),
(1, 'Bohol'),
(1, 'Bukidnon'),
(1, 'Bulacan'),
(1, 'Cagayan'),
(1, 'Camarines Norte'),
(1, 'Camarines Sur'),
(1, 'Camiguin'),
(1, 'Capiz'),
(1, 'Catanduanes'),
(1, 'Cavite'),
(1, 'Cebu'),
(1, 'Cotabato'),
(1, 'Davao de Oro'),
(1, 'Davao del Norte'),
(1, 'Davao del Sur'),
(1, 'Davao Occidental'),
(1, 'Davao Oriental'),
(1, 'Dinagat Islands'),
(1, 'Eastern Samar'),
(1, 'Guimaras'),
(1, 'Ifugao'),
(1, 'Ilocos Norte'),
(1, 'Ilocos Sur'),
(1, 'Iloilo'),
(1, 'Isabela'),
(1, 'Kalinga'),
(1, 'La Union'),
(1, 'Laguna'),
(1, 'Lanao del Norte'),
(1, 'Lanao del Sur'),
(1, 'Leyte'),
(1, 'Maguindanao'),
(1, 'Marinduque'),
(1, 'Masbate'),
(1, 'Metro Manila'),
(1, 'Misamis Occidental'),
(1, 'Misamis Oriental'),
(1, 'Mountain Province'),
(1, 'Negros Occidental'),
(1, 'Negros Oriental'),
(1, 'Northern Samar'),
(1, 'Nueva Ecija'),
(1, 'Nueva Vizcaya'),
(1, 'Occidental Mindoro'),
(1, 'Oriental Mindoro'),
(1, 'Palawan'),
(1, 'Pampanga'),
(1, 'Pangasinan'),
(1, 'Quezon'),
(1, 'Quirino'),
(1, 'Rizal'),
(1, 'Romblon'),
(1, 'Samar'),
(1, 'Sarangani'),
(1, 'Siquijor'),
(1, 'Sorsogon'),
(1, 'South Cotabato'),
(1, 'Southern Leyte'),
(1, 'Sultan Kudarat'),
(1, 'Sulu'),
(1, 'Surigao del Norte'),
(1, 'Surigao del Sur'),
(1, 'Tarlac'),
(1, 'Tawi-Tawi'),
(1, 'Zambales'),
(1, 'Zamboanga del Norte'),
(1, 'Zamboanga del Sur'),
(1, 'Zamboanga Sibugay');

-- Clear existing city data for Philippines
DELETE FROM city WHERE StateId IN (SELECT StateId FROM state WHERE CountryId = 1);

-- Insert cities for each province
INSERT INTO city (StateId, Name) VALUES
-- Abra
((SELECT StateId FROM state WHERE Name = 'Abra' LIMIT 1), 'Bangued'),
((SELECT StateId FROM state WHERE Name = 'Abra' LIMIT 1), 'Bucay'),
((SELECT StateId FROM state WHERE Name = 'Abra' LIMIT 1), 'Dolores'),

-- Agusan del Norte
((SELECT StateId FROM state WHERE Name = 'Agusan del Norte' LIMIT 1), 'Butuan City'),
((SELECT StateId FROM state WHERE Name = 'Agusan del Norte' LIMIT 1), 'Cabadbaran City'),
((SELECT StateId FROM state WHERE Name = 'Agusan del Norte' LIMIT 1), 'Nasipit'),

-- Metro Manila
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Manila'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Quezon City'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Makati'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Taguig'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Pasig'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Parañaque'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Muntinlupa'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Las Piñas'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Marikina'),
((SELECT StateId FROM state WHERE Name = 'Metro Manila' LIMIT 1), 'Pasay'),

-- Cebu
((SELECT StateId FROM state WHERE Name = 'Cebu' LIMIT 1), 'Cebu City'),
((SELECT StateId FROM state WHERE Name = 'Cebu' LIMIT 1), 'Mandaue'),
((SELECT StateId FROM state WHERE Name = 'Cebu' LIMIT 1), 'Lapu-Lapu'),
((SELECT StateId FROM state WHERE Name = 'Cebu' LIMIT 1), 'Talisay'),
((SELECT StateId FROM state WHERE Name = 'Cebu' LIMIT 1), 'Danao'),

-- Davao del Sur
((SELECT StateId FROM state WHERE Name = 'Davao del Sur' LIMIT 1), 'Davao City'),
((SELECT StateId FROM state WHERE Name = 'Davao del Sur' LIMIT 1), 'Digos'),
((SELECT StateId FROM state WHERE Name = 'Davao del Sur' LIMIT 1), 'Malalag'),

-- Negros Oriental
((SELECT StateId FROM state WHERE Name = 'Negros Oriental' LIMIT 1), 'Dumaguete'),
((SELECT StateId FROM state WHERE Name = 'Negros Oriental' LIMIT 1), 'Bais'),
((SELECT StateId FROM state WHERE Name = 'Negros Oriental' LIMIT 1), 'Tanjay'),

-- Iloilo
((SELECT StateId FROM state WHERE Name = 'Iloilo' LIMIT 1), 'Iloilo City'),
((SELECT StateId FROM state WHERE Name = 'Iloilo' LIMIT 1), 'Passi'),
((SELECT StateId FROM state WHERE Name = 'Iloilo' LIMIT 1), 'Oton'),

-- Cavite
((SELECT StateId FROM state WHERE Name = 'Cavite' LIMIT 1), 'Bacoor'),
((SELECT StateId FROM state WHERE Name = 'Cavite' LIMIT 1), 'Imus'),
((SELECT StateId FROM state WHERE Name = 'Cavite' LIMIT 1), 'Dasmariñas'),
((SELECT StateId FROM state WHERE Name = 'Cavite' LIMIT 1), 'General Trias'),
((SELECT StateId FROM state WHERE Name = 'Cavite' LIMIT 1), 'Kawit');

-- Note: This is a partial list. Would you like me to continue with more cities for other provinces?
-- The complete list would be very long. I can provide it in chunks if you'd like.
