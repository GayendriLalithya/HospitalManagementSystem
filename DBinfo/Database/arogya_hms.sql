-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 08:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arogya_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `age`, `gender`, `password`) VALUES
(1, 'Alexander', 'Jackson', 'alexanderjackson@example.com', '1234509876', '2025 Broadway, New York, NY', 40, 'Male', '$2y$10$uMQQHILlnQ0tOx.nZSXyweDMsrhfygz.VsR98pLAe0RClQvOoxEUu'),
(2, 'Grace', 'Young', 'graceyoung@example.com', '2345609871', '5 E 22nd St, New York, NY', 37, 'Female', '$2y$10$Sj9FLSv802BIXXA8/d.sd.nTCQ5Gim3TfJFUf4KB4L18/X9beY5ka');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `admission_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `nurse_id` int(11) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `admission_time` time DEFAULT NULL,
  `discharge_date` date DEFAULT NULL,
  `discharge_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`admission_id`, `patient_id`, `room_id`, `nurse_id`, `admission_date`, `admission_time`, `discharge_date`, `discharge_time`) VALUES
(1, 3, 1, 1, '2023-05-01', '14:00:00', '2023-05-05', '10:00:00'),
(2, 2, 2, 2, '2023-05-02', '16:00:00', '2023-05-05', '10:00:00'),
(3, 1, 3, 1, '2023-05-03', '18:00:00', '2023-05-08', '14:00:00'),
(4, 4, 4, 2, '2023-05-04', '20:00:00', '2023-05-09', '16:00:00'),
(5, 5, 5, 3, '2023-05-05', '23:00:00', '2023-05-10', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `symptoms` text NOT NULL,
  `status` enum('Scheduled','Rescheduled','Cancelled','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `date`, `start_time`, `end_time`, `symptoms`, `status`) VALUES
(1, 4, 1, '2023-05-01', '09:00:00', '09:30:00', 'Headache, fever', 'Scheduled'),
(2, 1, 4, '2023-05-01', '10:00:00', '10:30:00', 'Back pain', 'Scheduled'),
(3, 3, 2, '2023-05-02', '11:00:00', '11:30:00', 'Joint pain', 'Scheduled'),
(4, 5, 1, '2023-05-03', '14:00:00', '14:30:00', 'Cough, sore throat', 'Scheduled'),
(5, 7, 2, '2023-05-04', '15:00:00', '15:30:00', 'Stomach pain, nausea', 'Scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `availability_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`availability_id`, `doctor_id`, `date`, `start_time`, `end_time`, `status`) VALUES
(1, 2, '2023-05-01', '09:00:00', '12:00:00', 'available'),
(2, 4, '2023-05-01', '10:00:00', '13:00:00', 'available'),
(3, 1, '2023-05-02', '11:00:00', '14:00:00', 'unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `age`, `gender`, `password`) VALUES
(1, 'David', 'Brown', 'davidbrown@example.com', '3456789012', '789 Elm St, New York, NY', 52, 'Male', '$2y$10$z2j8EVDzCigGZlFRlzk0getQbSbUvpnN0Ss4tL6IPtPAkH0YBSJkK'),
(2, 'Emma', 'Johnson', 'emmajohnson@example.com', '4567890123', '1025 5th Ave, New York, NY', 29, 'Female', '$2y$10$sZ1MXL62MKDhwRchluKURufy06HsmRUZAJ.tIfS13SBOvH/vCwq0u'),
(4, 'Michael', 'Lee', 'michaellee@example.com', '5678901234', '789 Maple St, Anytown, USA', 45, 'Male', '$2y$10$c9oDod9cJSR51TsvUH89r.4IpmDaCqEgPZg70AZQgTFRaSDDFCf6y');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `receptionist_id` int(11) DEFAULT NULL,
  `total_amount_due` float DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `patient_id`, `receptionist_id`, `total_amount_due`, `payment_status`, `payment_due_date`) VALUES
(1, 1, 1, 500, 'Paid', '2023-05-05'),
(2, 7, 1, 750, 'Unpaid', '2023-05-10'),
(3, 6, 2, 600, 'Paid', '2023-05-08'),
(4, 5, 3, 450, 'Unpaid', '2023-05-12'),
(5, 5, 3, 550, 'Paid', '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `treatment` text NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`record_id`, `patient_id`, `doctor_id`, `date`, `diagnosis`, `treatment`, `notes`) VALUES
(1, 4, 2, '2023-04-01', 'Common cold', 'Rest, fluids, over-the-counter medication', 'The patient should follow up if symptoms worsen'),
(2, 1, 1, '2023-04-10', 'Sprained ankle', 'Rest, ice, compression, elevation', 'The patient should avoid putting weight on the ankle for a week'),
(3, 5, 4, '2023-04-20', 'Arthritis', 'Pain medication, physical therapy', 'The patient should start physical therapy sessions'),
(4, 2, 1, '2023-04-25', 'Bronchitis', 'Antibiotics, rest, fluids', 'The patient should finish the entire course of antibiotics'),
(5, 6, 2, '2023-04-30', 'Gastritis', 'Antacids avoid spicy foods, smaller meals', 'The patient should avoid trigger foods and eat smaller meals');

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `nurse_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`nurse_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `age`, `gender`, `password`) VALUES
(1, 'Nancy', 'Smith', 'nancysmith@example.com', '5551234567', '123 Main St, Cityville', 30, 'Female', '$2y$10$08cP10k65M6WqYx74dV9euy1rcbY.C77p63A6M7cwZUqEh/np5zHu'),
(2, 'Benjamin', 'Hall', 'benjaminhall@example.com', '3456709872', '1510 Lexington Ave, New York, NY', 50, 'Male', '$2y$10$/zFmkYxVLY8UraLc9pdH..Q7Fa/0/Qv9jmGbcyJ.JF3z7piDLBovq'),
(3, 'Jane', 'Smith', 'janesmith@example.com', '2345678901', '456 Broadway, New York, NY', 36, 'Female', '$2y$10$10SP4aZSf1XTs/CTFAi4auOZJXUAx9PKGvRRqTejL6.cFXgQ8HCVq');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `age`, `gender`, `password`) VALUES
(1, 'Alice', 'Martin', 'alicemartin@example.com', '6789012345', '1730 Madison Ave, New York, NY', 30, 'Female', '$2y$10$8/nlO8QysYNlaCPlSX/cD.hejiSfuuikjFzBXw8ny/0Rf5ZlbkKkC'),
(2, 'James', 'Garcia', 'jamesgarcia@example.com', '7890123456', '864 7th Ave, New York, NY', 55, 'Male', '$2y$10$oFB5dP5mq8wfvJ2PD16gG..CmycqBF1RLyVlMgidxUpGtJerHj7Y2'),
(3, 'Sophia', 'Davis', 'sophiadavis@example.com', '8901234567', '320 E 42nd St, New York, NY', 22, 'Female', '$2y$10$lH7/Z1MYVswWFOYj5AXSe.KW8mR4c0fVejO8xjU/9umGUdIdvQtgy'),
(4, 'William', 'Lopez', 'williamlopez@example.com', '9012345678', '28 E 73rd St, New York, NY', 47, 'Male', '$2y$10$m9XmTsZDYR4Gf8Ornn1Vt.IDrU6B8NufU9aQmHhdoNQ1wg2b7HjWu'),
(5, 'Olivia', 'Hernandez', 'oliviahernandez@example.com', '0123456789', '101 W 68th St, New York, NY', 33, 'Female', '$2y$10$QOFwE6v9h61hNDlCBiVkQOITlP2syjtyqimyezoCQH1DfbigMS5sC'),
(6, 'Liam', 'Wright', 'liamwright@example.com', '4567809873', '201 W 70th St, New York, NY', 28, 'Male', '$2y$10$VzJiO87H9J.OlHEiosKvHe4si8Cq85ZGINMkjrY39rkC2JejEHomS'),
(7, 'John', 'Doe', 'johndoe@example.com', '1234567890', '123 Main St, New York, NY', 45, 'Male', '$2y$10$kZJmn/vu7plliZfXZ7sDbea.obzuT/Qtb0kv4zy8VwLw2r2itYIbO');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `billing_address` text NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_state` varchar(255) NOT NULL,
  `billing_zip` varchar(20) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` enum('Paid','Unpaid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `patient_id`, `amount`, `billing_address`, `billing_city`, `billing_state`, `billing_zip`, `transaction_id`, `payment_date`, `payment_status`) VALUES
(1, 1, '300.00', '1730 Madison Ave, ', 'New York', 'NY', '10001', '1682886041', '2023-04-30', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `receptionist_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`receptionist_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `age`, `gender`, `password`) VALUES
(1, 'Bob', 'Williams', 'bobwilliams@example.com', '555-321-4567', '123 Oak Street, Houston, TX', 40, 'Male', '$2y$10$VtlT6UUythfiMHcnlDL.yucXRhU2RdEDgtEkNdpPHlnlToeUePlty'),
(2, 'Ella', 'Green', 'ellagreen@example.com', '5678909874', '372 Central Park W, New York, NY', 42, 'Female', '$2y$10$qBLfg/ugjE7msY615BnY9e4uUCmfIpoJFQQtXtE9eFEm9F1ZyP0Ie'),
(3, 'Carol', 'Williams', 'carolwilliams@example.com', '3456789012', '9012 Maple Street, Springfield', 28, 'Female', '$2y$10$BqGyrefEsdnav1/6Zl4uD.l.YimF..HEJQ7meym2tzB8UQtZM180C');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_type` enum('General','Private','Semi-private','Intensive Care','Hybrid operating room','Integrated operating room','Digital operating room') NOT NULL,
  `status` enum('Available','Unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_type`, `status`) VALUES
(1, 101, 'Semi-private', 'Unavailable'),
(2, 102, 'Private', 'Unavailable'),
(3, 103, 'Semi-private', 'Available'),
(4, 104, 'Intensive Care', 'Unavailable'),
(5, 105, 'Hybrid operating room', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `doctor_id`, `date`, `start_time`, `end_time`) VALUES
(1, 2, '2023-05-01', '09:00:00', '12:00:00'),
(2, 1, '2023-05-01', '10:00:00', '15:00:00'),
(3, 4, '2023-05-02', '11:00:00', '14:00:00'),
(10, 2, '2023-05-03', '14:00:00', '17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`admission_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `nurse_id` (`nurse_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `receptionist_id` (`receptionist_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`nurse_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`receptionist_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `receptionist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission`
--
ALTER TABLE `admission`
  ADD CONSTRAINT `admission_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `admission_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `admission_ibfk_3` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`nurse_id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`receptionist_id`) REFERENCES `receptionists` (`receptionist_id`);

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `medical_history_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
