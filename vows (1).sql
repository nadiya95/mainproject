-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 04:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vows`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `state_id`, `district_name`) VALUES
(1, 1, 'Sri Potti Sriramulu Nellore'),
(2, 1, 'Visakhapatnam'),
(3, 1, 'Guntur'),
(4, 1, 'Krishna'),
(5, 1, 'West Godavari'),
(6, 1, 'East Godavari'),
(7, 1, 'Chittoor'),
(8, 1, 'Prakasam'),
(9, 1, 'Y.S.R. Kadapa'),
(10, 2, 'Tawang'),
(11, 2, 'West Kameng'),
(12, 2, 'East Kameng'),
(13, 2, 'Papum Pare'),
(14, 2, 'Kurung Kumey'),
(15, 2, 'Kra Daadi'),
(16, 2, 'Lower Subansiri'),
(17, 2, 'Upper Subansiri'),
(18, 2, 'West Siang'),
(19, 2, 'East Siang'),
(20, 2, 'Siang'),
(21, 2, 'Chowkham'),
(22, 2, 'Namsai'),
(23, 3, 'Kamrup Metropolitan'),
(24, 3, 'Kamrup'),
(25, 3, 'Nagaon'),
(26, 3, 'Golaghat'),
(27, 3, 'Karbi Anglong'),
(28, 3, 'Dibrugarh'),
(29, 3, 'Tinsukia'),
(30, 3, 'Jorhat'),
(31, 3, 'Sivasagar'),
(32, 3, 'Bongaigaon'),
(33, 3, 'Cachar'),
(34, 3, 'Hailakandi'),
(35, 3, 'Karimganj'),
(36, 4, 'Patna'),
(37, 4, 'Gaya'),
(38, 4, 'Bhagalpur'),
(39, 4, 'Munger'),
(40, 4, 'Muzaffarpur'),
(41, 4, 'Darbhanga'),
(42, 4, 'Saran'),
(43, 4, 'Siwan'),
(44, 4, 'Samastipur'),
(45, 4, 'Purnia'),
(46, 4, 'Kishanganj'),
(47, 4, 'Jehanabad'),
(48, 4, 'Nawada'),
(49, 5, 'Raipur'),
(50, 5, 'Bilaspur'),
(51, 5, 'Durg'),
(52, 5, 'Korba'),
(53, 5, 'Janji'),
(54, 5, 'Rajnandgaon'),
(55, 5, 'Kanker'),
(56, 5, 'Surguja'),
(57, 5, 'Bastar'),
(58, 5, 'Mungeli'),
(59, 6, 'North Goa'),
(60, 6, 'South Goa'),
(61, 7, 'Ahmedabad'),
(62, 7, 'Surat'),
(63, 7, 'Vadodara'),
(64, 7, 'Rajkot'),
(65, 7, 'Gandhinagar'),
(66, 7, 'Kutch'),
(67, 7, 'Junagadh'),
(68, 7, 'Sabarkantha'),
(69, 7, 'Banaskantha'),
(70, 7, 'Amreli'),
(71, 8, 'Ambala'),
(72, 8, 'Faridabad'),
(73, 8, 'Gurugram'),
(74, 8, 'Hisar'),
(75, 8, 'Karnal'),
(76, 8, 'Panipat'),
(77, 8, 'Rohtak'),
(78, 8, 'Sirsa'),
(79, 9, 'Shimla'),
(80, 9, 'Kangra'),
(81, 9, 'Mandi'),
(82, 9, 'Hamirpur'),
(83, 9, 'Kullu'),
(84, 9, 'Una'),
(85, 9, 'Bilaspur'),
(86, 9, 'Chamba'),
(87, 9, 'Sirmaur'),
(88, 9, 'Solan'),
(89, 10, 'Ranchi'),
(90, 10, 'Jamshedpur'),
(91, 10, 'Dhanbad'),
(92, 10, 'Hazaribagh'),
(93, 10, 'Giridih'),
(94, 10, 'Deoghar'),
(95, 10, 'Koderma'),
(96, 10, 'Palamu'),
(97, 10, 'Chatra'),
(98, 10, 'Latehar'),
(99, 11, 'Bengaluru Urban'),
(100, 11, 'Mysuru'),
(101, 11, 'Tumakuru'),
(102, 11, 'Chikkamagaluru'),
(103, 11, 'Dakshina Kannada'),
(104, 11, 'Udupi'),
(105, 11, 'Belagavi'),
(106, 11, 'Bagalkot'),
(107, 11, 'Hubballi-Dharwad'),
(108, 11, 'Hassan'),
(109, 12, 'Thiruvananthapuram'),
(110, 12, 'Kollam'),
(111, 12, 'Pathanamthitta'),
(112, 12, 'Alappuzha'),
(113, 12, 'Kottayam'),
(114, 12, 'Idukki'),
(115, 12, 'Ernakulam'),
(116, 12, 'Thrissur'),
(117, 12, 'Palakkad'),
(118, 12, 'Wayanad'),
(119, 12, 'Kannur'),
(120, 12, 'Kasargod'),
(121, 13, 'Bhopal'),
(122, 13, 'Indore'),
(123, 13, 'Jabalpur'),
(124, 13, 'Ujjain'),
(125, 13, 'Sagar'),
(126, 13, 'Ratlam'),
(127, 13, 'Satna'),
(128, 13, 'Gwalior'),
(129, 13, 'Shivpuri'),
(130, 13, 'Dewas'),
(131, 14, 'Mumbai City'),
(132, 14, 'Mumbai Suburban'),
(133, 14, 'Pune'),
(134, 14, 'Nagpur'),
(135, 14, 'Thane'),
(136, 14, 'Aurangabad'),
(137, 14, 'Kolhapur'),
(138, 14, 'Nashik'),
(139, 14, 'Jalgaon'),
(140, 14, 'Solapur'),
(141, 15, 'Imphal East'),
(142, 15, 'Imphal West'),
(143, 15, 'Thoubal'),
(144, 15, 'Churachandpur'),
(145, 15, 'Bishnupur'),
(146, 15, 'Senapati'),
(147, 15, 'Tamenglong'),
(148, 15, 'Ukhrul'),
(149, 15, 'Jiribam'),
(150, 16, 'East Khasi Hills'),
(151, 16, 'West Khasi Hills'),
(152, 16, 'Jaintia Hills'),
(153, 16, 'Ri-Bhoi'),
(154, 16, 'South West Khasi Hills'),
(155, 16, 'South West Garo Hills'),
(156, 16, 'West Garo Hills'),
(157, 16, 'North Garo Hills'),
(158, 17, 'Aizawl'),
(159, 17, 'Champhai'),
(160, 17, 'Lunglei'),
(161, 17, 'Mamit'),
(162, 17, 'Kolasib'),
(163, 17, 'Serchhip'),
(164, 17, 'Hnahthial'),
(165, 17, 'Lawngtlai'),
(166, 18, 'Kohima'),
(167, 18, 'Dimapur'),
(168, 18, 'Mokokchung'),
(169, 18, 'Wokha'),
(170, 18, 'Mon'),
(171, 18, 'Zunheboto'),
(172, 18, 'Phek'),
(173, 18, 'Tuensang'),
(174, 19, 'Bhubaneswar'),
(175, 19, 'Cuttack'),
(176, 19, 'Ganjam'),
(177, 19, 'Khurda'),
(178, 19, 'Sambalpur'),
(179, 19, 'Rourkela'),
(180, 19, 'Balasore'),
(181, 19, 'Bargarh'),
(182, 19, 'Berhampur'),
(183, 19, 'Kalahandi'),
(184, 20, 'Amritsar'),
(185, 20, 'Jalandhar'),
(186, 20, 'Ludhiana'),
(187, 20, 'Patiala'),
(188, 20, 'Mohali'),
(189, 20, 'Ferozepur'),
(190, 20, 'Rupnagar'),
(191, 20, 'Sangrur'),
(192, 21, 'Jaipur'),
(193, 21, 'Jodhpur'),
(194, 21, 'Udaipur'),
(195, 21, 'Kota'),
(196, 21, 'Ajmer'),
(197, 21, 'Bikaner'),
(198, 21, 'Pali'),
(199, 21, 'Sikar'),
(200, 21, 'Churu'),
(201, 22, 'East Sikkim'),
(202, 22, 'West Sikkim'),
(203, 22, 'North Sikkim'),
(204, 22, 'South Sikkim'),
(205, 23, 'Chennai'),
(206, 23, 'Coimbatore'),
(207, 23, 'Madurai'),
(208, 23, 'Tiruchirappalli'),
(209, 23, 'Salem'),
(210, 23, 'Erode'),
(211, 23, 'Thanjavur'),
(212, 23, 'Tirunelveli'),
(213, 23, 'Kanyakumari'),
(214, 24, 'Hyderabad'),
(215, 24, 'Warangal'),
(216, 24, 'Khammam'),
(217, 24, 'Nizamabad'),
(218, 24, 'Mahbubnagar'),
(219, 24, 'Ranga Reddy'),
(220, 24, 'Adilabad'),
(221, 24, 'Karimnagar'),
(222, 25, 'West Tripura'),
(223, 25, 'South Tripura'),
(224, 25, 'North Tripura'),
(225, 25, 'Dhalai'),
(226, 26, 'Lucknow'),
(227, 26, 'Kanpur'),
(228, 26, 'Agra'),
(229, 26, 'Varanasi'),
(230, 26, 'Allahabad'),
(231, 26, 'Ghaziabad'),
(232, 26, 'Meerut'),
(233, 26, 'Bareilly'),
(234, 26, 'Moradabad'),
(235, 27, 'Dehradun'),
(236, 27, 'Haridwar'),
(237, 27, 'Nainital'),
(238, 27, 'Udhamsingh Nagar'),
(239, 27, 'Pauri Garhwal'),
(240, 27, 'Tehri Garhwal'),
(241, 27, 'Almora'),
(242, 27, 'Bageshwar'),
(243, 27, 'Champawat'),
(244, 28, 'Kolkata'),
(245, 28, 'Howrah'),
(246, 28, 'Murshidabad'),
(247, 28, 'North 24 Parganas'),
(248, 28, 'South 24 Parganas'),
(249, 28, 'Jalpaiguri'),
(250, 28, 'Cooch Behar'),
(251, 28, 'Paschim Medinipur'),
(252, 28, 'Purulia'),
(253, 28, 'Bankura'),
(254, 29, 'North and Middle Andaman'),
(255, 29, 'South Andaman'),
(256, 29, 'Nicobar'),
(257, 30, 'Chandigarh'),
(258, 31, 'Dadra and Nagar Haveli'),
(259, 31, 'Daman'),
(260, 31, 'Diu'),
(261, 32, 'North Delhi'),
(262, 32, 'South Delhi'),
(263, 32, 'East Delhi'),
(264, 32, 'West Delhi'),
(265, 32, 'Central Delhi'),
(266, 33, 'Lakshadweep'),
(267, 34, 'Puducherry'),
(268, 34, 'Karaikal'),
(269, 34, 'Mahe'),
(270, 34, 'Yanam'),
(271, 35, 'Leh'),
(272, 35, 'Kargil'),
(273, 36, 'Srinagar'),
(274, 36, 'Jammu'),
(275, 36, 'Udhampur'),
(276, 36, 'Rajouri'),
(277, 36, 'Anantnag'),
(278, 36, 'Pulwama'),
(279, 36, 'Kathua'),
(280, 36, 'Baramulla');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `sender`, `receiver`, `status`, `created_at`) VALUES
(22, 'basil', 'nadiya', 'rejected', '2024-10-13 14:23:06'),
(24, 'nadiya', 'Ali', 'pending', '2024-10-14 02:35:54'),
(25, 'nadiya', 'cayl', 'pending', '2024-10-15 01:36:39'),
(26, 'nadiya', 'Daniel', 'pending', '2024-10-15 01:42:16'),
(27, 'nadiya', 'nadiya467', 'pending', '2024-10-15 01:42:45'),
(28, 'nadiya', 'hii', 'pending', '2024-10-15 01:50:07'),
(30, 'Muhammad', 'nadiya', 'accepted', '2024-10-15 02:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `personality`
--

CREATE TABLE `personality` (
  `pty_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `personality_type` varchar(50) NOT NULL,
  `personality_description` text DEFAULT NULL,
  `compatibility_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personality`
--

INSERT INTO `personality` (`pty_id`, `user_id`, `personality_type`, `personality_description`, `compatibility_description`) VALUES
(14, 30, 'ENFP', 'ENFP: The Campaigner. Enthusiastic, creative, and sociable. They thrive on new experiences and are highly empathetic, often inspiring others with their passion.', 'INFJ: INFJ: The Advocate. Insightful, reserved, and highly principled. They are driven by a strong sense of purpose and are often dedicated to helping others.\r\nINTJ: INTJ: The Architect. Strategic, analytical, and determined. They are highly independent thinkers, always planning for the future and seeking to achieve their goals.\r\nENTJ: ENTJ: The Commander. Bold, confident, and strong-willed. They are natural leaders, always looking for ways to improve efficiency and achieve success.'),
(15, 31, 'ISFP', 'ISFP: The Adventurer. Quiet, friendly, sensitive, and kind. They enjoy living in the moment and are deeply attuned to their surroundings.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENFJ: ENFJ: The Protagonist. Charismatic, empathetic, and inspiring. They are natural leaders, often helping others to realize their potential and achieve their goals.\r\nINTP: INTP: The Logician. Innovative, curious, and analytical. They love exploring complex ideas and are driven by a desire to understand the world around them.'),
(16, 32, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(17, 33, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(18, 34, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(19, 35, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(20, 36, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(21, 37, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(22, 38, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(24, 50, 'ENTP', 'ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nINFP: INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.'),
(25, 53, 'INFP', 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.', 'ESTJ: ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.\r\nENTP: ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.\r\nISFJ: ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Arunachal Pradesh'),
(3, 'Assam'),
(4, 'Bihar'),
(5, 'Chhattisgarh'),
(6, 'Goa'),
(7, 'Gujarat'),
(8, 'Haryana'),
(9, 'Himachal Pradesh'),
(10, 'Jharkhand'),
(11, 'Karnataka'),
(12, 'Kerala'),
(13, 'Madhya Pradesh'),
(14, 'Maharashtra'),
(15, 'Manipur'),
(16, 'Meghalaya'),
(17, 'Mizoram'),
(18, 'Nagaland'),
(19, 'Odisha'),
(20, 'Punjab'),
(21, 'Rajasthan'),
(22, 'Sikkim'),
(23, 'Tamil Nadu'),
(24, 'Telangana'),
(25, 'Tripura'),
(26, 'Uttar Pradesh'),
(27, 'Uttarakhand'),
(28, 'West Bengal'),
(29, 'Andaman and Nicobar Islands'),
(30, 'Chandigarh'),
(31, 'Dadra and Nagar Haveli and Daman and Diu'),
(32, 'Delhi'),
(33, 'Lakshadweep'),
(34, 'Puducherry'),
(35, 'Ladakh'),
(36, 'Jammu and Kashmir');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `sects` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `primaryNo` varchar(20) DEFAULT NULL,
  `secondaryNo` varchar(20) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `complexion` varchar(50) DEFAULT NULL,
  `appearance` varchar(100) DEFAULT NULL,
  `bodyType` varchar(50) DEFAULT NULL,
  `fatherName` varchar(100) DEFAULT NULL,
  `motherName` varchar(100) DEFAULT NULL,
  `siblings` varchar(255) DEFAULT NULL,
  `familyValues` varchar(50) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `annualIncome` varchar(50) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `profileVideo` varchar(255) DEFAULT NULL,
  `hashtags` varchar(100) DEFAULT NULL,
  `Max_age` int(11) DEFAULT NULL,
  `Min_age` int(11) DEFAULT NULL,
  `heightPreference` varchar(10) DEFAULT NULL,
  `religionPreference` varchar(50) DEFAULT NULL,
  `educationPreference` varchar(255) DEFAULT NULL,
  `otherPreference` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `fullName`, `dob`, `age`, `gender`, `religion`, `sects`, `state`, `district`, `primaryNo`, `secondaryNo`, `height`, `weight`, `complexion`, `appearance`, `bodyType`, `fatherName`, `motherName`, `siblings`, `familyValues`, `occupation`, `companyName`, `annualIncome`, `education`, `bio`, `profilePic`, `profileVideo`, `hashtags`, `Max_age`, `Min_age`, `heightPreference`, `religionPreference`, `educationPreference`, `otherPreference`, `timestamp`) VALUES
(30, 'nadiya', 'na', 'venadiya4@gmail.com', 'Nadiyaaa', '2002-10-17', 22, 'Female', 'islam', 'sunni', 'kerala', 'kollam', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahimm', 'jameela', '4', 'traditional', 'accountant', 'abc', '5', 'PG', 'ni', 'uploads/images/logo22.JPG', 'uploads/videos/video.mp4', '#helloo', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(31, 'Ali', 'na', 'ali@gmail.com', 'Ali muhammad', '2002-10-17', 34, 'Male', 'islam', 'salafi', 'Kerala', 'Palakkad', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/b1.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(32, 'Muhammad', 'na', 'm@gmail.com', ' muhammad Ali', '2002-10-17', 21, 'Male', 'islam', 'salafi', 'Kerala', 'Kollam', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/b3.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(33, 'basil', 'na', 'b@gmail.com', ' muhammad Basil', '2002-10-17', 31, 'Male', 'islam', 'salafi', 'Kerala', 'Kollam', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/b4.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(34, 'cayl', 'na', 'c@gmail.com', 'Cyal', '2002-10-17', 23, 'Male', 'islam', 'salafi', 'Kerala', 'Kollam', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/b5.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(35, 'Daniel', 'na', 'd@gmail.com', 'Daniel', '2002-10-17', 36, 'Male', 'islam', 'salafi', 'Kerala', 'Kollam', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/b6.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(36, 'Basila', 'na', 'ba@gmail.com', 'Basila', '2002-10-17', 38, 'Female', 'islam', 'salafi', 'Kerala', 'Wayanad', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/g1.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(37, 'Cayana', 'na', 'ca@gmail.com', 'Cayana', '2002-10-17', 34, 'Female', 'islam', 'salafi', 'Kerala', 'Kasargod', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/g6.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(38, 'Dana', 'na', 'da@gmail.com', 'Dane', '2002-10-17', 32, 'Female', 'islam', 'salafi', 'Kerala', 'Kasargod', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', 'uploads/images/g7.jpg', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(45, 'nadiya467', 'na', 'venadiya484@gmail.com', 'Zayn', '2002-10-17', 31, 'Male', 'islam', 'salafi', 'Arunachal Pradesh', 'Tawang', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', '', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(48, 'hgjh', 'na', 'hia484@gmail.com', 'Cay', '2002-10-17', 41, 'Male', 'islam', 'salafi', 'Arunachal Pradesh', 'Tawang', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', '', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(50, 'hii', 'na', 'hiii@gmail.com', 'ken', '2002-10-17', 34, 'Male', 'islam', 'salafi', 'Arunachal Pradesh', 'Tawang', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'Ibrahim', 'jameela', '4', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'ni', '', '', '#hello #games', 30, 20, '156', 'islam', 'hil', 'nil', '2024-10-04 07:35:01'),
(53, 'gysha', 'na', 'g@gmail.com', 'na', '2002-10-17', 21, 'Male', 'islam', 'sunni (ap)', 'Jharkhand', 'Dhanbad', '1234567890', '1234567890', '156', '45', 'fair', 'VeryAttractive', 'slim', 'na', 'na', '5', 'traditional', 'accountant', 'abc', 'Below_1L', 'PG', 'mi', 'uploads/images/g5.jpg', 'uploads/videos/video.mp4', '#hi', 30, 20, '156', 'isla', 'mm', 'mm', '2024-10-04 12:40:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `personality`
--
ALTER TABLE `personality`
  ADD PRIMARY KEY (`pty_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personality`
--
ALTER TABLE `personality`
  MODIFY `pty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`state_id`);

--
-- Constraints for table `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `interests_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `user` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `interests_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `personality`
--
ALTER TABLE `personality`
  ADD CONSTRAINT `personality_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
