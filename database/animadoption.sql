-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 12:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animadoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_img` varchar(255) NOT NULL DEFAULT 'default.png',
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `blood_group` varchar(250) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_img`, `username`, `password`, `firstname`, `lastname`, `gender`, `birthday`, `email`, `blood_group`, `contact`, `address`, `city`, `zip`) VALUES
(1, 'default.png', 'nila', '123456', 'nila', 'nila', 'Female', '1998-12-01', 'nila123@gmail.com', 'A+ (ve)', '+8801212122123', 'mirpur', 'dhaka', '1205');

-- --------------------------------------------------------

--
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `pet_id` int(11) NOT NULL,
  `shelter_id` int(11) NOT NULL,
  `pet_img` varchar(255) NOT NULL,
  `pet_name` varchar(250) NOT NULL,
  `age` varchar(15) NOT NULL,
  `trained` varchar(20) NOT NULL,
  `background` varchar(500) NOT NULL,
  `pet_type` varchar(100) NOT NULL,
  `vaccinated` varchar(20) NOT NULL,
  `post_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`pet_id`, `shelter_id`, `pet_img`, `pet_name`, `age`, `trained`, `background`, `pet_type`, `vaccinated`, `post_date`) VALUES
(3, 2, 'cat.jpg', 'unknown', '1 year', 'no', 'Found her near a house at mohammadpur.', 'cat', 'yes', '2022-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shelter_id` int(11) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `shelter_image` varchar(250) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `shelter_name` varchar(50) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `pet_image` varchar(250) NOT NULL,
  `pet_name` varchar(250) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `message` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoption_requests`
--

INSERT INTO `adoption_requests` (`request_id`, `user_id`, `shelter_id`, `user_image`, `shelter_image`, `user_name`, `shelter_name`, `pet_id`, `pet_image`, `pet_name`, `date`, `time`, `message`, `status`) VALUES
(2, 2, 2, 'simon-reza-Auk1sZjba7M-unsplash.jpg', 'orphanage-1.jpg', 'reza', 'mohammadpur pet shelter', 3, 'cat.jpg', 'unknown', '2022-09-08', '17:00', 'ass', 0);

-- --------------------------------------------------------

--
-- Table structure for table `recent`
--

CREATE TABLE `recent` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recent`
--

INSERT INTO `recent` (`id`, `image`, `name`, `role`) VALUES
(1, 'default.png', 'nila', 'Admin'),
(2, 'image (3).png', 'nila', 'User'),
(3, 'default.png', 'nila', 'Admin'),
(4, 'default.png', 'nila', 'Admin'),
(5, '1.jpg', 'mili', 'Vet'),
(6, '1.jpg', 'mili', 'Vet'),
(7, '1.jpg', 'mili', 'Vet'),
(8, 'simon-reza-Auk1sZjba7M-unsplash.jpg', 'reza', 'User'),
(9, '1.jpg', 'mili', 'Vet'),
(10, 'orphanage-1.jpg', 'sunny56', 'Shelter'),
(11, 'simon-reza-Auk1sZjba7M-unsplash.jpg', 'reza', 'User'),
(12, 'simon-reza-Auk1sZjba7M-unsplash.jpg', 'reza', 'User'),
(13, 'orphanage-1.jpg', 'shelter', 'Shelter');

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE `shelter` (
  `shelter_id` int(11) NOT NULL,
  `shelter_img` varchar(250) NOT NULL DEFAULT 'default.png',
  `shelter_name` varchar(100) NOT NULL,
  `shelter_reg_id` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`shelter_id`, `shelter_img`, `shelter_name`, `shelter_reg_id`, `username`, `email`, `password`, `contact`, `address`, `city`, `zip`, `verified`, `join_date`) VALUES
(2, 'orphanage-1.jpg', 'mohammadpur pet shelter', '123456', 'shelter', 'shelter@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01774034918', 'Mohammadpur', 'Dhaka', '1207', 1, '2022-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_img` varchar(250) NOT NULL DEFAULT 'default.png',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `blood_group` varchar(250) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_img`, `firstname`, `lastname`, `username`, `email`, `password`, `gender`, `birthday`, `blood_group`, `contact`, `address`, `city`, `zip`) VALUES
(2, 'simon-reza-Auk1sZjba7M-unsplash.jpg', 'reza', 'khatun', 'reza', 'reza123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Female', '2022-08-28', 'B+(ve)', '01624034918', 'Mohammadpur', 'Dhaka', '1207');

-- --------------------------------------------------------

--
-- Table structure for table `vets`
--

CREATE TABLE `vets` (
  `vet_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `reg_id` varchar(50) NOT NULL,
  `education1` varchar(50) NOT NULL,
  `education2` varchar(50) NOT NULL,
  `year1` varchar(50) NOT NULL,
  `year2` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `clinic_address` varchar(100) NOT NULL,
  `clinic_city` varchar(50) NOT NULL,
  `clinic_zip` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vets`
--

INSERT INTO `vets` (`vet_id`, `firstname`, `lastname`, `reg_id`, `education1`, `education2`, `year1`, `year2`, `gender`, `contact`, `clinic_address`, `clinic_city`, `clinic_zip`, `username`, `email`, `password`, `join_date`, `image`, `status`) VALUES
(4, 'mili', 'ahmed', '123456', 'M.B.B.S', 'M.D.', '2022-02', '2014-02', 'Female', '1234567890', 'Mohammadpur', 'Dhaka', '1207', 'mili', 'mili56@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2022-09-08', '1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vet_appointment`
--

CREATE TABLE `vet_appointment` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `vet_image` varchar(250) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `vet_name` varchar(50) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vet_appointment`
--

INSERT INTO `vet_appointment` (`appointment_id`, `user_id`, `vet_id`, `user_image`, `vet_image`, `user_name`, `vet_name`, `pet_name`, `date`, `time`, `contact`, `email`, `message`, `status`) VALUES
(5, 2, 4, 'simon-reza-Auk1sZjba7M-unsplash.jpg', '1.jpg', 'reza', 'mili ahmed', 'sam', '2022-09-09', '17:30', '01824034918', 'mili@gmail.com', 'ss', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vet_rating`
--

CREATE TABLE `vet_rating` (
  `rating_id` int(11) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `shelter_id` (`shelter_id`);

--
-- Indexes for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shelter_id` (`shelter_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `recent`
--
ALTER TABLE `recent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shelter`
--
ALTER TABLE `shelter`
  ADD PRIMARY KEY (`shelter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vets`
--
ALTER TABLE `vets`
  ADD PRIMARY KEY (`vet_id`);

--
-- Indexes for table `vet_appointment`
--
ALTER TABLE `vet_appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vet_rating`
--
ALTER TABLE `vet_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recent`
--
ALTER TABLE `recent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shelter`
--
ALTER TABLE `shelter`
  MODIFY `shelter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vets`
--
ALTER TABLE `vets`
  MODIFY `vet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vet_appointment`
--
ALTER TABLE `vet_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vet_rating`
--
ALTER TABLE `vet_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `adoption_ibfk_1` FOREIGN KEY (`shelter_id`) REFERENCES `shelter` (`shelter_id`);

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `adoption_requests_ibfk_2` FOREIGN KEY (`shelter_id`) REFERENCES `shelter` (`shelter_id`),
  ADD CONSTRAINT `adoption_requests_ibfk_3` FOREIGN KEY (`pet_id`) REFERENCES `adoption` (`pet_id`);

--
-- Constraints for table `vet_appointment`
--
ALTER TABLE `vet_appointment`
  ADD CONSTRAINT `vet_appointment_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `vets` (`vet_id`),
  ADD CONSTRAINT `vet_appointment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `vet_rating`
--
ALTER TABLE `vet_rating`
  ADD CONSTRAINT `vet_rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `vet_rating_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `vets` (`vet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
