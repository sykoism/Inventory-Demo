-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-11-04 14:26:11
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `dsa_inventory_demo`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ims_equipment`
--

CREATE TABLE `ims_equipment` (
  `EquipmentID` varchar(50) NOT NULL,
  `EquipmentModel` varchar(255) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `LotNum` int(20) NOT NULL,
  `InventoryOnHand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_equipment`
--

INSERT INTO `ims_equipment` (`EquipmentID`, `EquipmentModel`, `ExpiryDate`, `LotNum`, `InventoryOnHand`) VALUES
('EQUI_TERUMO_12345', 'terumo_guidewire_035_M', '2022-07-13', 765832, 21);

-- --------------------------------------------------------

--
-- 資料表結構 `ims_equipment_details`
--

CREATE TABLE `ims_equipment_details` (
  `EquipmentModel` varchar(255) NOT NULL,
  `EquipmentName` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `EquipmentType` enum('guidewire','catheter','stent','balloon') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_equipment_details`
--

INSERT INTO `ims_equipment_details` (`EquipmentModel`, `EquipmentName`, `supplier_id`, `EquipmentType`) VALUES
('medtronic_catheter_6fr', 'Medtronic Pro-Flo Angiographic Catheter 6Fr', 222, 'catheter'),
('terumo_guidewire_035_M', 'Terumo Radifocus Guide Wire M', 111, 'guidewire');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_equipment_filled`
--

CREATE TABLE `ims_equipment_filled` (
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `EquipmentID` varchar(20) DEFAULT NULL,
  `LotNum` varchar(15) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `ims_equipment_used`
--

CREATE TABLE `ims_equipment_used` (
  `AccessionNumber` varchar(20) NOT NULL,
  `EquipmentID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `ims_exam`
--

CREATE TABLE `ims_exam` (
  `PatientID` varchar(15) NOT NULL,
  `AccessionNumber` varchar(15) NOT NULL,
  `PatientName` varchar(255) NOT NULL,
  `ExamID` int(11) NOT NULL,
  `ExamDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_exam`
--

INSERT INTO `ims_exam` (`PatientID`, `AccessionNumber`, `PatientName`, `ExamID`, `ExamDate`) VALUES
('A123456(7)', 'KWH002712345P', 'CHAN TAI MAN', 2216, '2021-07-13'),
('UE765432(1)', 'KWH006543216O', 'CHEUNG SIU MING', 6121, '2021-08-18');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_exam_detail`
--

CREATE TABLE `ims_exam_detail` (
  `AccessionNumber` varchar(15) NOT NULL,
  `Radiologist` varchar(255) DEFAULT NULL,
  `Radiographer` varchar(255) DEFAULT NULL,
  `Nurse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_exam_detail`
--

INSERT INTO `ims_exam_detail` (`AccessionNumber`, `Radiologist`, `Radiographer`, `Nurse`) VALUES
('KWH002712345P', 'ott789', 'nyc456', 'cmy123');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_exam_series`
--

CREATE TABLE `ims_exam_series` (
  `ExamID` int(11) NOT NULL,
  `ExamName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_exam_series`
--

INSERT INTO `ims_exam_series` (`ExamID`, `ExamName`) VALUES
(2216, 'Screening'),
(6121, 'CORO');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_staff`
--

CREATE TABLE `ims_staff` (
  `staff_name` varchar(50) NOT NULL,
  `staff_init` varchar(10) NOT NULL,
  `staff_type` enum('radiologist','radiographer','nurse') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_staff`
--

INSERT INTO `ims_staff` (`staff_name`, `staff_init`, `staff_type`) VALUES
('CHEUNG MING YAN', 'cmy123', 'nurse'),
('NG YING CHUN', 'nyc456', 'radiographer'),
('ONE TWO THREE', 'ott789', 'radiologist');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_supplier`
--

CREATE TABLE `ims_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `salesperson` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_supplier`
--

INSERT INTO `ims_supplier` (`supplier_id`, `supplier_name`, `salesperson`, `mobile`, `status`) VALUES
(111, 'GOOD MEDICAL CO LTD', 'PETER', 91234567, 'active'),
(222, 'BAD MEDICAL CO LTD', 'MARY', 67891234, 'active');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_user`
--

CREATE TABLE `ims_user` (
  `userid` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','member') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_user`
--

INSERT INTO `ims_user` (`userid`, `username`, `password`, `type`, `status`) VALUES
('admin', 'Administrator', '202cb962ac59075b964b07152d234b70', 'admin', 'Active'),
('user', 'User', '250cf8b51c773f3f8dc8b4be867a9a02', 'member', 'Active');

-- --------------------------------------------------------

--
-- 資料表結構 `ims_user_hash`
--

CREATE TABLE `ims_user_hash` (
  `userid` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','member') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ims_user_hash`
--

INSERT INTO `ims_user_hash` (`userid`, `username`, `password`, `type`, `status`) VALUES
('admin', 'Administrator', '$2y$10$tSnWQG2fyZ57uaNvI3qTTuEv2FescnNO/XSYYNCRmM.4T9nMse9xi', 'admin', 'Active'),
('user', 'User', '$2y$10$BJg21/Nujwbb7ujIeJdS8.J7G9.xfewgpDufiaxMKyl3JX59W1Ckq', 'member', 'Active');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ims_equipment`
--
ALTER TABLE `ims_equipment`
  ADD PRIMARY KEY (`EquipmentID`),
  ADD KEY `EquipmentModel` (`EquipmentModel`);

--
-- 資料表索引 `ims_equipment_details`
--
ALTER TABLE `ims_equipment_details`
  ADD PRIMARY KEY (`EquipmentModel`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- 資料表索引 `ims_equipment_used`
--
ALTER TABLE `ims_equipment_used`
  ADD PRIMARY KEY (`AccessionNumber`);

--
-- 資料表索引 `ims_exam`
--
ALTER TABLE `ims_exam`
  ADD PRIMARY KEY (`AccessionNumber`),
  ADD KEY `ExamID` (`ExamID`);

--
-- 資料表索引 `ims_exam_detail`
--
ALTER TABLE `ims_exam_detail`
  ADD PRIMARY KEY (`AccessionNumber`),
  ADD KEY `Radiologist` (`Radiologist`),
  ADD KEY `Radiographer` (`Radiographer`),
  ADD KEY `Nurse` (`Nurse`);

--
-- 資料表索引 `ims_exam_series`
--
ALTER TABLE `ims_exam_series`
  ADD PRIMARY KEY (`ExamID`);

--
-- 資料表索引 `ims_staff`
--
ALTER TABLE `ims_staff`
  ADD PRIMARY KEY (`staff_init`);

--
-- 資料表索引 `ims_supplier`
--
ALTER TABLE `ims_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- 資料表索引 `ims_user`
--
ALTER TABLE `ims_user`
  ADD UNIQUE KEY `userid` (`userid`);

--
-- 資料表索引 `ims_user_hash`
--
ALTER TABLE `ims_user_hash`
  ADD UNIQUE KEY `userid` (`userid`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `ims_equipment`
--
ALTER TABLE `ims_equipment`
  ADD CONSTRAINT `ims_equipment_ibfk_1` FOREIGN KEY (`EquipmentModel`) REFERENCES `ims_equipment_details` (`EquipmentModel`);

--
-- 資料表的限制式 `ims_equipment_details`
--
ALTER TABLE `ims_equipment_details`
  ADD CONSTRAINT `ims_equipment_details_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `ims_supplier` (`supplier_id`);

--
-- 資料表的限制式 `ims_exam`
--
ALTER TABLE `ims_exam`
  ADD CONSTRAINT `ims_exam_ibfk_1` FOREIGN KEY (`ExamID`) REFERENCES `ims_exam_series` (`ExamID`);

--
-- 資料表的限制式 `ims_exam_detail`
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
