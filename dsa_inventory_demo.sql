-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 02:36 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsa_inventory_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ims_equipment_details`
--

CREATE TABLE `ims_equipment_details` (
  `EquipmentModel` varchar(255) NOT NULL,
  `EquipmentName` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `EquipmentType` enum('guidewire','catheter','stent','balloon') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_equipment_details`
--

INSERT INTO `ims_equipment_details` (`EquipmentModel`, `EquipmentName`, `supplier_id`, `EquipmentType`) VALUES
('medtronic_catheter_6fr', 'Medtronic Pro-Flo Angiographic Catheter 6Fr', 222, 'catheter'),
('terumo_guidewire_035_M', 'Terumo Radifocus Guide Wire M', 111, 'guidewire');

-- --------------------------------------------------------

--
-- Table structure for table `ims_equipment_not_used`
--

CREATE TABLE `ims_equipment_not_used` (
  `EquipmentID` varchar(50) NOT NULL,
  `EquipmentModel` varchar(255) NOT NULL,
  `ExpiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ims_equipment_used`
--

CREATE TABLE `ims_equipment_used` (
  `EquipmentID` varchar(50) NOT NULL,
  `EquipmentModel` varchar(255) NOT NULL,
  `ExpiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_equipment_used`
--

INSERT INTO `ims_equipment_used` (`EquipmentID`, `EquipmentModel`, `ExpiryDate`) VALUES
('EQUI_TERUMO_12345', 'terumo_guidewire_035_M', '2022-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `ims_exam`
--

CREATE TABLE `ims_exam` (
  `PatientID` varchar(15) NOT NULL,
  `AccessionNumber` varchar(15) NOT NULL,
  `PatientName` varchar(255) NOT NULL,
  `ExamID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_exam`
--

INSERT INTO `ims_exam` (`PatientID`, `AccessionNumber`, `PatientName`, `ExamID`) VALUES
('A123456(7)', 'KWH002712345P', 'CHAN TAI MAN', 2216),
('UE765432(1)', 'KWH00654321O', 'CHEUNG SIU MING', 6121);

-- --------------------------------------------------------

--
-- Table structure for table `ims_exam_detail`
--

CREATE TABLE `ims_exam_detail` (
  `AccessionNumber` varchar(15) NOT NULL,
  `Radiologist` varchar(255) DEFAULT NULL,
  `Radiographer` varchar(255) DEFAULT NULL,
  `Nurse` varchar(255) DEFAULT NULL,
  `EquipmentID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_exam_detail`
--

INSERT INTO `ims_exam_detail` (`AccessionNumber`, `Radiologist`, `Radiographer`, `Nurse`, `EquipmentID`) VALUES
('KWH002712345P', 'ott789', 'nyc456', 'cmy123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ims_exam_series`
--

CREATE TABLE `ims_exam_series` (
  `ExamID` int(11) NOT NULL,
  `ExamName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_exam_series`
--

INSERT INTO `ims_exam_series` (`ExamID`, `ExamName`) VALUES
(2216, 'Screening'),
(6121, 'CORO');

-- --------------------------------------------------------

--
-- Table structure for table `ims_staff`
--

CREATE TABLE `ims_staff` (
  `staff_name` varchar(50) NOT NULL,
  `staff_init` varchar(10) NOT NULL,
  `staff_type` enum('radiologist','radiographer','nurse') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_staff`
--

INSERT INTO `ims_staff` (`staff_name`, `staff_init`, `staff_type`) VALUES
('CHEUNG MING YAN', 'cmy123', 'nurse'),
('NG YING CHUN', 'nyc456', 'radiographer'),
('ONE TWO THREE', 'ott789', 'radiologist');

-- --------------------------------------------------------

--
-- Table structure for table `ims_supplier`
--

CREATE TABLE `ims_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `salesperson` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_supplier`
--

INSERT INTO `ims_supplier` (`supplier_id`, `supplier_name`, `salesperson`, `mobile`, `status`) VALUES
(111, 'GOOD MEDICAL CO LTD', 'PETER', 91234567, 'active'),
(222, 'BAD MEDICAL CO LTD', 'MARY', 67891234, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ims_user`
--

CREATE TABLE `ims_user` (
  `userid` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','member') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_user`
--

INSERT INTO `ims_user` (`userid`, `username`, `password`, `type`, `status`) VALUES
('admin', 'Administrator', '202cb962ac59075b964b07152d234b70', 'admin', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ims_equipment_details`
--
ALTER TABLE `ims_equipment_details`
  ADD PRIMARY KEY (`EquipmentModel`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `ims_equipment_not_used`
--
ALTER TABLE `ims_equipment_not_used`
  ADD PRIMARY KEY (`EquipmentID`),
  ADD KEY `EquipmentModel` (`EquipmentModel`);

--
-- Indexes for table `ims_equipment_used`
--
ALTER TABLE `ims_equipment_used`
  ADD PRIMARY KEY (`EquipmentID`),
  ADD KEY `EquipmentModel` (`EquipmentModel`);

--
-- Indexes for table `ims_exam`
--
ALTER TABLE `ims_exam`
  ADD PRIMARY KEY (`AccessionNumber`),
  ADD KEY `ExamID` (`ExamID`);

--
-- Indexes for table `ims_exam_detail`
--
ALTER TABLE `ims_exam_detail`
  ADD PRIMARY KEY (`AccessionNumber`),
  ADD KEY `EquipmentID` (`EquipmentID`),
  ADD KEY `Radiologist` (`Radiologist`),
  ADD KEY `Radiographer` (`Radiographer`),
  ADD KEY `Nurse` (`Nurse`);

--
-- Indexes for table `ims_exam_series`
--
ALTER TABLE `ims_exam_series`
  ADD PRIMARY KEY (`ExamID`);

--
-- Indexes for table `ims_staff`
--
ALTER TABLE `ims_staff`
  ADD PRIMARY KEY (`staff_init`);

--
-- Indexes for table `ims_supplier`
--
ALTER TABLE `ims_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ims_equipment_details`
--
ALTER TABLE `ims_equipment_details`
  ADD CONSTRAINT `ims_equipment_details_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `ims_supplier` (`supplier_id`);

--
-- Constraints for table `ims_equipment_not_used`
--
ALTER TABLE `ims_equipment_not_used`
  ADD CONSTRAINT `ims_equipment_not_used_ibfk_1` FOREIGN KEY (`EquipmentModel`) REFERENCES `ims_equipment_details` (`EquipmentModel`);

--
-- Constraints for table `ims_equipment_used`
--
ALTER TABLE `ims_equipment_used`
  ADD CONSTRAINT `ims_equipment_used_ibfk_1` FOREIGN KEY (`EquipmentModel`) REFERENCES `ims_equipment_details` (`EquipmentModel`);

--
-- Constraints for table `ims_exam`
--
ALTER TABLE `ims_exam`
  ADD CONSTRAINT `ims_exam_ibfk_1` FOREIGN KEY (`ExamID`) REFERENCES `ims_exam_series` (`ExamID`);

--
-- Constraints for table `ims_exam_detail`
--
ALTER TABLE `ims_exam_detail`
  ADD CONSTRAINT `ims_exam_detail_ibfk_2` FOREIGN KEY (`Radiologist`) REFERENCES `ims_staff` (`staff_init`),
  ADD CONSTRAINT `ims_exam_detail_ibfk_3` FOREIGN KEY (`Radiographer`) REFERENCES `ims_staff` (`staff_init`),
  ADD CONSTRAINT `ims_exam_detail_ibfk_4` FOREIGN KEY (`Nurse`) REFERENCES `ims_staff` (`staff_init`),
  ADD CONSTRAINT `ims_exam_detail_ibfk_5` FOREIGN KEY (`AccessionNumber`) REFERENCES `ims_exam` (`AccessionNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
