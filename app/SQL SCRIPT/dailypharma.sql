-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 08:02 AM
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
-- Database: `dailyPharma`
--

CREATE DATABASE IF NOT EXISTS `dailyPharma`;


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `adminLastName` VARCHAR(50) NOT NULL,
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminLastName`,`Password`) VALUES
('John','password1'),
('Jane','password2'),
('Lance','123yy');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `Company_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Company_Name` VARCHAR(50) NOT NULL,
  `Company_Email` VARCHAR(50) NOT NULL,
  `Company_Phone` INT(20) NOT NULL,
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Company_ID`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_Name`, `Company_Email`, `Company_Phone`, `Password`) VALUES
('ABC Pharmaceuticals', 'abcpharma@gmail.com', 1234567890, 'password123'),
('XYZ Pharmaceuticals', 'xyzpharma@gmail.com', 9876543210, 'password456'),
('PQR Pharmaceuticals', 'pqrpharma@gmail.com', 1112223333, 'password789'),
('DEF Pharmaceuticals', 'defpharma@gmail.com', 4445556666, 'passwordabc'),
('GHI Pharmaceuticals', 'ghipharma@gmail.com', 7778889999, 'passwordxyz');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `Doctor_SSN` INT(10) NOT NULL,
  `Doctor_Name` VARCHAR(20) NOT NULL,
  `Doctor_Phone` INT(20) NOT NULL,
  `Doctor_Speciality` VARCHAR(20) NOT NULL,
  `Doctor_Experience` INT(3) NOT NULL,
  `Password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`Doctor_SSN`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`Doctor_SSN`, `Doctor_Name`, `Doctor_Phone`, `Doctor_Speciality`, `Doctor_Experience`, `Password`)
VALUES
(25, 'Dr. Sarah', 1112223333, 'Orthopedic', 11, 'password2'),
(26, 'Dr. Christopher', 1112223333, 'Orthopedic', 5, 'password3'),
(27, 'Dr. Olivia', 147483647, 'Neurosurgeon', 3, 'password4'),
(42, 'Rewel', 12103923, 'Residency', 1, '123yy'),
(43, 'Dr. Emily', 2147483647, 'Dermatology', 8, 'password6'),
(44, 'Dr. Daniel', 1112223333, 'Cardiology', 15, 'password7'),
(45, 'Dr. Jessica', 1112223333, 'Gastroenterology', 7, 'password8'),
(46, 'Dr. Andrew', 147483647, 'Psychiatry', 9, 'password9'),
(47, 'Dr. James', 12103923, 'Family Medicine', 12, 'password10');


-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE IF NOT EXISTS `drugs` (
  `Drug_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Drug_Name` VARCHAR(50) NOT NULL,
  `Drug_Description` VARCHAR(200) DEFAULT NULL,
  `Drug_Quantity` INT(4) NOT NULL,
  `Drug_Expiration_Date` DATE DEFAULT NULL,
  `Drug_Manufacturing_Date` DATE DEFAULT NULL,
  `Drug_Company` INT(10) NOT NULL,
  PRIMARY KEY (`Drug_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`Drug_Name`, `Drug_Description`, `Drug_Quantity`, `Drug_Expiration_Date`, `Drug_Manufacturing_Date`, `Drug_Company`) VALUES
('Paracetamol', 'Fever reducer', 311, '2023-11-30', '2023-03-01', '1'),
('Metformin', 'Diabetes medication', 60, '2024-04-30', '2023-10-01', '1'),
('Aspirin', 'Pain reliever', 150, '2023-12-31', '2023-01-01', '5'),
('Simvastatin', 'Cholesterol medication', 25, '2024-03-31', '2023-07-15', '2'),
('Metoprolol', 'Beta blocker', 50, '2024-01-31', '2023-06-15', '2'),
('Warfarin', 'Blood thinner', 20, '2024-04-30', '2023-10-01', '2'),
('Loratadine', 'Antihistamine', 200, '2023-12-31', '2023-01-01', '2'),
('Citalopram', 'Antidepressant', 30, '2024-03-31', '2023-07-15', '2'),
('Aspirin', 'Pain reliever and fever reducer', 80, '2023-10-31', '2022-07-20', '2'),
('Cetirizine', 'Antihistamine for allergies', 120, '2023-09-30', '2022-05-10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `Patient_SSN` INT(10) NOT NULL,
  `Patient_Name` VARCHAR(20) NOT NULL,
  `Patient_Address` VARCHAR(50) NOT NULL,
  `Patient_Email` VARCHAR(50) NOT NULL,
  `Patient_Phone` INT(20) NOT NULL,
  `Patient_Gender` VARCHAR(10) NOT NULL,
  `Patient_DOB` DATE NOT NULL,
  `Patient_Age` INT(3) NOT NULL,
  `Patient_Physician` VARCHAR(20),
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Patient_SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Patient_SSN`, `Patient_Name`, `Patient_Address`, `Patient_Email`, `Patient_Phone`, `Patient_Gender`, `Patient_DOB`, `Patient_Age`, `Patient_Physician`, `Password`)
VALUES
(23, 'Jane', '456 Elm St', 'janesmith@yahoo.com', 2147483647, 'Female', '1992-05-10', 31, NULL, 'password1'),
(24, 'John', '789 Oak St', 'johnsmith@gmail.com', 2147483647, 'Male', '1990-09-15', 33, NULL, 'password2'),
(25, 'Sarah', '123 Maple Ave', 'sarahjones@hotmail.com', 2147483647, 'Female', '1985-12-03', 38, NULL, 'password3'),
(26, 'Michael', '321 Pine St', 'michaeldavis@gmail.com', 2147483647, 'Male', '1995-07-20', 28, NULL, 'password4'),
(27, 'Emily', '567 Birch Rd', 'emilywilson@yahoo.com', 2147483647, 'Female', '1988-02-18', 33, NULL, 'password5'),
(28, 'David', '987 Cedar Ln', 'davidbrown@gmail.com', 2147483647, 'Male', '1993-11-29', 28, NULL, 'password6'),
(29, 'Jennifer', '654 Walnut Dr', 'jennifermartin@hotmail.com', 2147483647, 'Female', '1991-06-05', 30, NULL, 'password7'),
(30, 'Daniel', '876 Spruce St', 'danieldavis@yahoo.com', 2147483647, 'Male', '1987-09-12', 34, NULL, 'password8'),
(31, 'Jessica', '234 Oak St', 'jessicawilson@gmail.com', 2147483647, 'Female', '1996-04-17', 27, NULL, 'password9'),
(32, 'Christopher', '543 Maple Ave', 'christopherbrown@hotmail.com', 2147483647, 'Male', '1994-08-22', 29, NULL, 'password10'),
(33, 'Sophia', '789 Pine St', 'sophiadavis@yahoo.com', 2147483647, 'Female', '1989-03-25', 32, NULL, 'password11'),
(34, 'Andrew', '876 Birch Rd', 'andrewmartin@gmail.com', 2147483647, 'Male', '1992-10-30', 28, NULL, 'password12'),
(35, 'Olivia', '432 Cedar Ln', 'oliviabrown@hotmail.com', 2147483647, 'Female', '1990-01-07', 31, NULL, 'password13'),
(36, 'James', '678 Walnut Dr', 'jameswilson@yahoo.com', 2147483647, 'Male', '1986-06-13', 35, NULL, 'password14'),
(37, 'Ava', '987 Spruce St', 'avadavis@gmail.com', 2147483647, 'Female', '1995-03-20', 27, NULL, 'password15'),
(38, 'Emma', '345 Elm St', 'emmamartin@hotmail.com', 2147483647, 'Female', '1993-12-25', 28, NULL, 'password16');


-- --------------------------------------------------------

--
-- Table structure for table `doctor_patient`
--
CREATE TABLE `doctor_patient` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `Doctor_SSN` INT(10) NOT NULL,
  `Patient_SSN` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`Doctor_SSN`) REFERENCES doctors (`Doctor_SSN`),
  FOREIGN KEY (`Patient_SSN`) REFERENCES patients (`Patient_SSN`)
);

INSERT INTO `doctor_patient` ( `Doctor_SSN`, `Patient_SSN`)
VALUES
    (47, 27),
    (47, 28),
    (47, 29),
    (47, 30),
    (47, 31),
    (47, 32),
    (47, 33),
    (42, 34),
    (42, 35);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--
CREATE TABLE IF NOT EXISTS `pharmacy` (
  `Pharmacy_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Pharmacy_Name` VARCHAR(50) NOT NULL,
  `Pharmacy_Email` VARCHAR(50) NOT NULL,
  `Pharmacy_Phone` INT(20) NOT NULL,
  `Pharmacy_Address` VARCHAR(50) NOT NULL,
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Pharmacy_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`Pharmacy_Name`, `Pharmacy_Email`, `Pharmacy_Phone`, `Pharmacy_Address`, `Password`) VALUES
('ABC Pharmacy', 'abcpharmacy@gmail.com', 1234567890, '123 Main St', 'password123'),
('XYZ Pharmacy', 'xyzpharmacy@gmail.com', 9876543210, '456 Elm St', 'password456'),
('EFG Pharmacy', 'efgpharmacy@gmail.com', 1112223333, '789 Oak St', 'password789'),
('LMN Pharmacy', 'lmnpharmacy@gmail.com', 4445556666, '321 Pine St', 'passwordabc'),
('PQR Pharmacy', 'pqrpharmacy@gmail.com', 7778889999, '654 Walnut Dr', 'passwordxyz');


-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `Prescription_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Patient_SSN` INT(10) NOT NULL,
  `Doctor_SSN` INT(10) NOT NULL,
  `Drug_ID` INT(10) NOT NULL,
  `Prescription_Amount` VARCHAR(50) NOT NULL,
  `Prescription_Dosage` VARCHAR(50) NOT NULL,
  `Prescription_Instructions` VARCHAR(200) DEFAULT NULL,
  `Prescribed` CHAR(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Prescription_ID`),
  CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`Patient_SSN`) REFERENCES `patients` (`Patient_SSN`),
  CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`Doctor_SSN`) REFERENCES `doctors` (`Doctor_SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`Patient_SSN`, `Doctor_SSN`, `Drug_ID`, `Prescription_Amount`, `Prescription_Dosage`, `Prescription_Instructions`, `Prescribed`)
VALUES
(23, 25, 1, '100 mg', '2 times daily', 'Take with water', 'N'),
(23, 25, 2, '500 mg', '1 time daily', 'Take with food', 'N'),
(23, 26, 3, '75 mg', '1 time daily', 'Take after meals', 'N'),
(23, 27, 4, '20 mg', '1 time daily', 'Take in the evening', 'N'),
(23, 42, 5, '50 mg', '2 times daily', 'Take with or without food', 'N'),
(23, 25, 6, '5 mg', '1 time daily', 'Take at the same time each day', 'N'),
(23, 25, 7, '10 mg', '1 time daily', 'Take with or without food', 'N'),
(23, 26, 8, '20 mg', '1 time daily', 'Take with or without food', 'N'),
(23, 27, 9, '100 mg', '1 time daily', 'Take after meals', 'N'),
(23, 42, 10, '10 mg', '1 time daily', 'Take with water', 'N'),
(24, 25, 1, '100 mg', '2 times daily', 'Take with water', 'N'),
(24, 25, 2, '500 mg', '1 time daily', 'Take with food', 'N'),
(24, 26, 3, '75 mg', '1 time daily', 'Take after meals', 'N'),
(24, 27, 4, '20 mg', '1 time daily', 'Take in the evening', 'N'),
(24, 42, 5, '50 mg', '2 times daily', 'Take with or without food', 'N'),
(25, 25, 6, '5 mg', '1 time daily', 'Take at the same time each day', 'N'),
(25, 25, 7, '10 mg', '1 time daily', 'Take with or without food', 'N'),
(25, 26, 8, '20 mg', '1 time daily', 'Take with or without food', 'N'),
(25, 27, 9, '100 mg', '1 time daily', 'Take after meals', 'N'),
(25, 42, 10, '10 mg', '1 time daily', 'Take with water', 'N');


-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `Supervisor_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Supervisor_Name` VARCHAR(50) NOT NULL,
  `Supervisor_Email` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Supervisor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`Supervisor_Name`, `Supervisor_Email`)
VALUES
('John Doe', 'john.doe@example.com'),
('Jane Smith', 'jane.smith@example.com'),
('David Johnson', 'david.johnson@example.com'),
('Sarah Wilson', 'sarah.wilson@example.com'),
('Michael Brown', 'michael.brown@example.com'),
('Emily Davis', 'emily.davis@example.com'),
('Robert Taylor', 'robert.taylor@example.com'),
('Jessica Anderson', 'jessica.anderson@example.com'),
('Christopher Lee', 'christopher.lee@example.com'),
('Amanda Martinez', 'amanda.martinez@example.com'),
('Daniel Thomas', 'daniel.thomas@example.com'),
('Olivia Clark', 'olivia.clark@example.com'),
('William Rodriguez', 'william.rodriguez@example.com'),
('Sophia Lewis', 'sophia.lewis@example.com'),
('Matthew Hernandez', 'matthew.hernandez@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `Contract_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Pharmacy_ID` INT(10) NOT NULL,
  `Company_ID` INT(10) NOT NULL,
  `Supervisor_ID` INT(10) NOT NULL,
  `Start_Date` DATE DEFAULT CURRENT_TIMESTAMP,
  `End_Date` DATE DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Contract_ID`),
  CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`Pharmacy_ID`) REFERENCES `pharmacy` (`Pharmacy_ID`),
  CONSTRAINT `contracts_ibfk_2` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`),
  CONSTRAINT `contracts_ibfk_3` FOREIGN KEY (`Supervisor_ID`) REFERENCES `supervisors` (`Supervisor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`Pharmacy_ID`, `Company_ID`, `Supervisor_ID`, `Start_Date`, `End_Date`)
VALUES
(1, 1, 1, '2023-01-01', '2023-12-31'),
(2, 2, 2, '2023-03-15', '2024-03-14'),
(3, 3, 3, '2023-06-01', '2024-05-31'),
(4, 4, 4, '2023-09-15', '2024-09-14'),
(5, 5, 5, '2024-01-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `Order_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `Patient_SSN` INT(10) NOT NULL,
  `Drug_ID` INT(10) NOT NULL,
  `Patient_Address` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Order_ID`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Patient_SSN`) REFERENCES `patients` (`Patient_SSN`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Drug_ID`) REFERENCES `drugs` (`Drug_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Patient_SSN`, `Drug_ID`, `Patient_Address`)
VALUES
(23, 1, '456 Elm St'),
(24, 2, '789 Oak St'),
(25, 3, '123 Maple Ave');

-- --------------------------------------------------------


ALTER TABLE `pharmacy` ADD `Status` VARCHAR(50) NOT NULL DEFAULT 'Pending' AFTER `Password`;
ALTER TABLE `patients` ADD `Status` VARCHAR(50) NOT NULL DEFAULT 'Active' AFTER `Password`;
ALTER TABLE `company` ADD `Status` VARCHAR(50) NOT NULL DEFAULT 'Pending' AFTER `Password`;
ALTER TABLE `admin` ADD `Status` VARCHAR(50) NOT NULL DEFAULT 'Active' AFTER `Password`;
ALTER TABLE `doctors` ADD `Status` VARCHAR(50) NOT NULL DEFAULT 'Active' AFTER `Password`;
ALTER TABLE `contracts` ADD `Status` VARCHAR(50) NOT NULL DEFAULT 'Pending' AFTER `End_Date`;

UPDATE prescriptions
SET Prescribed  = 'Y'
WHERE Prescription_ID > 10;

UPDATE patients
SET Status  = 'active'
WHERE Patient_SSN > 32;

UPDATE doctors
SET Status  = 'active'
WHERE Doctor_SSN > 49;

UPDATE contracts
SET Status  = 'active'
WHERE Contract_ID > 3;


-- Create the drug_prices table with drug_id, pharmacy_id, and drug_price columns
CREATE TABLE drug_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Drug_ID INT NOT NULL,
    Pharmacy_ID INT NOT NULL,
    Drug_Price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (Drug_ID) REFERENCES drugs(Drug_ID),
    FOREIGN KEY (Pharmacy_ID) REFERENCES pharmacy(Pharmacy_ID)
);

-- Insert drug prices data into drug_prices table
-- Drug: Citalopram, Pharmacy: XYZ Pharmacy
INSERT INTO drug_prices (Drug_ID, Pharmacy_ID, Drug_Price)
VALUES
  ((SELECT Drug_ID FROM drugs WHERE Drug_Name = 'Citalopram'), (SELECT Pharmacy_ID FROM pharmacy WHERE Pharmacy_Name = 'XYZ Pharmacy'), 30.00);

-- Drug: Simvastatin, Pharmacy: XYZ Pharmacy
INSERT INTO drug_prices (Drug_ID, Pharmacy_ID, Drug_Price)
VALUES
  ((SELECT Drug_ID FROM drugs WHERE Drug_Name = 'Simvastatin'), (SELECT Pharmacy_ID FROM pharmacy WHERE Pharmacy_Name = 'XYZ Pharmacy'), 20.20);
  -- Drug: Metformin, Pharmacy: XYZ Pharmacy
  INSERT INTO drug_prices (Drug_ID, Pharmacy_ID, Drug_Price)
  VALUES
    ((SELECT Drug_ID FROM drugs WHERE Drug_Name = 'Metformin'), (SELECT Pharmacy_ID FROM pharmacy WHERE Pharmacy_Name = 'XYZ Pharmacy'), 15.50);
    -- Drug: Cetirizine, Pharmacy: XYZ Pharmaceuticals
    INSERT INTO drug_prices (Drug_ID, Pharmacy_ID, Drug_Price)
    VALUES
      ((SELECT Drug_ID FROM drugs WHERE Drug_Name = 'Cetirizine'), (SELECT Pharmacy_ID FROM pharmacy WHERE Pharmacy_Name = 'XYZ Pharmacy'), 9.50);

-- Drug: Loratadine, Pharmacy: ABC Pharmacy
INSERT INTO drug_prices (Drug_ID, Pharmacy_ID, Drug_Price)
VALUES
  ((SELECT Drug_ID FROM drugs WHERE Drug_Name = 'Loratadine'), (SELECT Pharmacy_ID FROM pharmacy WHERE Pharmacy_Name = 'ABC Pharmacy'), 7.50);
  
    COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
