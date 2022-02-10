-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 04:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `alcohol_options`
--

CREATE TABLE `alcohol_options` (
  `GUID` int(11) NOT NULL,
  `response0` text NOT NULL,
  `response1` text NOT NULL,
  `response2` text NOT NULL,
  `response3` text NOT NULL,
  `response4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alcohol_options`
--

INSERT INTO `alcohol_options` (`GUID`, `response0`, `response1`, `response2`, `response3`, `response4`) VALUES
(1, 'Never', 'Monthly or less', '2 - 4 times per month', '2 - 3 timer per week', '4+ times per week'),
(2, '1 - 2', '3 - 4', '5 - 6', '7 - 8', '10+'),
(3, 'Never', 'Less than monthly', 'Monthly', 'Weekly', 'Daily or almost daily'),
(4, 'No', '', 'Yes but not in the last year ', '', 'Yes, during the last year');

-- --------------------------------------------------------

--
-- Table structure for table `alcohol_questions`
--

CREATE TABLE `alcohol_questions` (
  `GUID` int(11) NOT NULL,
  `optionsid` int(11) NOT NULL,
  `Question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alcohol_questions`
--

INSERT INTO `alcohol_questions` (`GUID`, `optionsid`, `Question`) VALUES
(1, 1, 'How often do you have a drink containing alcohol?'),
(2, 2, 'How many units of alcohol do you drink on a typical day when you are drinking?'),
(3, 3, 'How often have you had 6 or more  units if female, or 8 or more if male, on a single occasion in the last year?'),
(4, 3, 'How often during the last year have you found that you were not able to stop drinking once you have started?'),
(5, 3, 'How often during the last year have you failed to do what was expected from you because of drinking?'),
(6, 3, 'How often during the last year have you needed an alcoholic drink in the morning to get yourself going after a heavy drinking session?'),
(7, 3, 'How often during the last year have you had a feeling of guilt or remorse after drinking?'),
(8, 3, 'How often during the last year have you been unable to remember what happened the night before because you had been drinking?'),
(9, 4, 'Have you or somebody else been injured as a result of your drinking?'),
(10, 4, 'Has a relative or friend, doctor or other health worker been concerned about your drinking or suggested you cut down?');

-- --------------------------------------------------------

--
-- Table structure for table `alcohol_responses`
--

CREATE TABLE `alcohol_responses` (
  `GUID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `response` varchar(255) NOT NULL,
  `response_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alcohol_responses`
--

INSERT INTO `alcohol_responses` (`GUID`, `userid`, `questionid`, `response`, `response_score`) VALUES
(1, 4, 1, '2 - 4 times per month', 3),
(2, 4, 2, '7 - 8', 4),
(3, 4, 3, 'Daily or almost daily', 5),
(4, 4, 4, 'Monthly', 3),
(5, 4, 5, 'Weekly', 4),
(6, 4, 6, 'Weekly', 4),
(7, 4, 7, 'Monthly', 3),
(8, 4, 8, 'Daily or almost daily', 5),
(9, 4, 9, 'Yes, during the last year', 5),
(10, 4, 10, 'Yes but not in the last year', 3),
(11, 5, 1, '2 - 4 times per month', 3),
(12, 5, 2, '7 - 8', 4),
(13, 5, 3, 'Weekly', 4),
(14, 5, 4, 'Monthly', 3),
(15, 5, 5, 'Less than monthly', 2),
(16, 5, 6, 'Less than monthly', 2),
(17, 5, 7, 'Daily or almost daily', 5),
(18, 5, 8, 'Weekly', 4),
(19, 5, 9, 'Yes, during the last year', 5),
(20, 5, 10, 'Yes, during the last year', 5),
(21, 6, 1, 'Monthly or less', 2),
(22, 6, 2, '5 - 6', 3),
(23, 6, 3, 'Less than monthly', 2),
(24, 6, 4, 'Daily or almost daily', 5),
(25, 6, 5, 'Monthly', 3),
(26, 6, 6, 'Weekly', 4),
(27, 6, 7, 'Less than monthly', 2),
(28, 6, 8, 'Monthly', 3),
(29, 6, 9, 'Yes but not in the last year', 3),
(30, 6, 10, 'Yes, during the last year', 5),
(31, 8, 1, '2 - 4 times per month', 3),
(32, 8, 2, '5 - 6', 3),
(33, 8, 3, 'Less than monthly', 2),
(34, 8, 4, 'Daily or almost daily', 5),
(35, 8, 5, 'Daily or almost daily', 5),
(36, 8, 6, 'Less than monthly', 2),
(37, 8, 7, 'Daily or almost daily', 5),
(38, 8, 8, 'Monthly', 3),
(39, 8, 9, 'Yes, during the last year', 5),
(40, 8, 10, 'Yes, during the last year', 5),
(41, 9, 1, '4+ times per week', 5),
(42, 9, 2, '3 - 4', 2),
(43, 9, 3, 'Less than monthly', 2),
(44, 9, 4, 'Less than monthly', 2),
(45, 9, 5, 'Less than monthly', 2),
(46, 9, 6, 'Less than monthly', 2),
(47, 9, 7, 'Daily or almost daily', 5),
(48, 9, 8, 'Daily or almost daily', 5),
(49, 9, 9, 'No', 1),
(50, 9, 10, 'No', 1),
(51, 10, 1, 'Monthly or less', 2),
(52, 10, 2, '10+', 5),
(53, 10, 3, 'Less than monthly', 2),
(54, 10, 4, 'Weekly', 4),
(55, 10, 5, 'Less than monthly', 2),
(56, 10, 6, 'Daily or almost daily', 5),
(57, 10, 7, 'Less than monthly', 2),
(58, 10, 8, 'Weekly', 4),
(59, 10, 9, 'Yes, during the last year', 5),
(60, 10, 10, 'Yes but not in the last year', 3),
(61, 11, 1, 'Monthly or less', 2),
(62, 11, 2, '5 - 6', 3),
(63, 11, 3, 'Daily or almost daily', 5),
(64, 11, 4, 'Monthly', 3),
(65, 11, 5, 'Less than monthly', 2),
(66, 11, 6, 'Weekly', 4),
(67, 11, 7, 'Less than monthly', 2),
(68, 11, 8, 'Monthly', 3),
(69, 11, 9, 'No', 1),
(70, 11, 10, 'Yes, during the last year', 5),
(71, 13, 1, '4+ times per week', 5),
(72, 13, 2, '5 - 6', 3),
(73, 13, 3, 'Daily or almost daily', 5),
(74, 13, 4, 'Weekly', 4),
(75, 13, 5, 'Daily or almost daily', 5),
(76, 13, 6, 'Monthly', 3),
(77, 13, 7, 'Less than monthly', 2),
(78, 13, 8, 'Daily or almost daily', 5),
(79, 13, 9, 'Yes, during the last year', 5),
(80, 13, 10, 'No', 1),
(81, 14, 1, 'Monthly or less', 2),
(82, 14, 2, '10+', 5),
(83, 14, 3, 'Monthly', 3),
(84, 14, 4, 'Weekly', 4),
(85, 14, 5, 'Weekly', 4),
(86, 14, 6, 'Weekly', 4),
(87, 14, 7, 'Monthly', 3),
(88, 14, 8, 'Weekly', 4),
(89, 14, 9, 'Yes, during the last year', 5),
(90, 14, 10, 'No', 1),
(91, 15, 1, '2 - 3 timer per week', 4),
(92, 15, 2, '10+', 5),
(93, 15, 3, 'Daily or almost daily', 5),
(94, 15, 4, 'Daily or almost daily', 5),
(95, 15, 5, 'Weekly', 4),
(96, 15, 6, 'Less than monthly', 2),
(97, 15, 7, 'Daily or almost daily', 5),
(98, 15, 8, 'Monthly', 3),
(99, 15, 9, 'Yes but not in the last year', 3),
(100, 15, 10, 'No', 1),
(101, 16, 1, 'Monthly or less', 2),
(102, 16, 2, '3 - 4', 2),
(103, 16, 3, 'Weekly', 4),
(104, 16, 4, 'Monthly', 3),
(105, 16, 5, 'Weekly', 4),
(106, 16, 6, 'Monthly', 3),
(107, 16, 7, 'Monthly', 3),
(108, 16, 8, 'Weekly', 4),
(109, 16, 9, 'Yes but not in the last year', 3),
(110, 16, 10, 'Yes but not in the last year', 3),
(111, 17, 1, '2 - 3 timer per week', 4),
(112, 17, 2, '7 - 8', 4),
(113, 17, 3, 'Monthly', 3),
(114, 17, 4, 'Daily or almost daily', 5),
(115, 17, 5, 'Daily or almost daily', 5),
(116, 17, 6, 'Less than monthly', 2),
(117, 17, 7, 'Monthly', 3),
(118, 17, 8, 'Daily or almost daily', 5),
(119, 17, 9, 'Yes but not in the last year', 3),
(120, 17, 10, 'No', 1),
(121, 18, 1, '2 - 3 timer per week', 4),
(122, 18, 2, '10+', 5),
(123, 18, 3, 'Daily or almost daily', 5),
(124, 18, 4, 'Daily or almost daily', 5),
(125, 18, 5, 'Monthly', 3),
(126, 18, 6, 'Less than monthly', 2),
(127, 18, 7, 'Monthly', 3),
(128, 18, 8, 'Less than monthly', 2),
(129, 18, 9, 'Yes, during the last year', 5),
(130, 18, 10, 'Yes, during the last year', 5),
(131, 19, 1, '4+ times per week', 5),
(132, 19, 2, '5 - 6', 3),
(133, 19, 3, 'Daily or almost daily', 5),
(134, 19, 4, 'Weekly', 4),
(135, 19, 5, 'Monthly', 3),
(136, 19, 6, 'Daily or almost daily', 5),
(137, 19, 7, 'Less than monthly', 2),
(138, 19, 8, 'Weekly', 4),
(139, 19, 9, 'Yes, during the last year', 5),
(140, 19, 10, 'Yes but not in the last year', 3),
(141, 20, 1, '2 - 4 times per month', 3),
(142, 20, 2, '3 - 4', 2),
(143, 20, 3, 'Less than monthly', 2),
(144, 20, 4, 'Monthly', 3),
(145, 20, 5, 'Monthly', 3),
(146, 20, 6, 'Monthly', 3),
(147, 20, 7, 'Weekly', 4),
(148, 20, 8, 'Daily or almost daily', 5),
(149, 20, 9, 'Yes, during the last year', 5),
(150, 20, 10, 'Yes but not in the last year', 3),
(151, 22, 1, '2 - 4 times per month', 3),
(152, 22, 2, '5 - 6', 3),
(153, 22, 3, 'Monthly', 3),
(154, 22, 4, 'Daily or almost daily', 5),
(155, 22, 5, 'Daily or almost daily', 5),
(156, 22, 6, 'Monthly', 3),
(157, 22, 7, 'Daily or almost daily', 5),
(158, 22, 8, 'Daily or almost daily', 5),
(159, 22, 9, 'Yes but not in the last year', 3),
(160, 22, 10, 'Yes, during the last year', 5),
(161, 23, 1, '2 - 3 timer per week', 4),
(162, 23, 2, '3 - 4', 2),
(163, 23, 3, 'Weekly', 4),
(164, 23, 4, 'Daily or almost daily', 5),
(165, 23, 5, 'Daily or almost daily', 5),
(166, 23, 6, 'Daily or almost daily', 5),
(167, 23, 7, 'Weekly', 4),
(168, 23, 8, 'Weekly', 4),
(169, 23, 9, 'No', 1),
(170, 23, 10, 'Yes, during the last year', 5),
(171, 24, 1, '2 - 3 timer per week', 4),
(172, 24, 2, '7 - 8', 4),
(173, 24, 3, 'Less than monthly', 2),
(174, 24, 4, 'Monthly', 3),
(175, 24, 5, 'Daily or almost daily', 5),
(176, 24, 6, 'Daily or almost daily', 5),
(177, 24, 7, 'Monthly', 3),
(178, 24, 8, 'Less than monthly', 2),
(179, 24, 9, 'No', 1),
(180, 24, 10, 'No', 1),
(181, 25, 1, 'Monthly or less', 2),
(182, 25, 2, '5 - 6', 3),
(183, 25, 3, 'Daily or almost daily', 5),
(184, 25, 4, 'Weekly', 4),
(185, 25, 5, 'Daily or almost daily', 5),
(186, 25, 6, 'Daily or almost daily', 5),
(187, 25, 7, 'Daily or almost daily', 5),
(188, 25, 8, 'Weekly', 4),
(189, 25, 9, 'Yes, during the last year', 5),
(190, 25, 10, 'No', 1),
(191, 26, 1, '4+ times per week', 5),
(192, 26, 2, '5 - 6', 3),
(193, 26, 3, 'Daily or almost daily', 5),
(194, 26, 4, 'Daily or almost daily', 5),
(195, 26, 5, 'Monthly', 3),
(196, 26, 6, 'Weekly', 4),
(197, 26, 7, 'Monthly', 3),
(198, 26, 8, 'Monthly', 3),
(199, 26, 9, 'Yes, during the last year', 5),
(200, 26, 10, 'Yes but not in the last year', 3),
(201, 28, 1, '2 - 3 timer per week', 4),
(202, 28, 2, '5 - 6', 3),
(203, 28, 3, 'Less than monthly', 2),
(204, 28, 4, 'Daily or almost daily', 5),
(205, 28, 5, 'Less than monthly', 2),
(206, 28, 6, 'Daily or almost daily', 5),
(207, 28, 7, 'Weekly', 4),
(208, 28, 8, 'Weekly', 4),
(209, 28, 9, 'Yes but not in the last year', 3),
(210, 28, 10, 'Yes but not in the last year', 3),
(211, 30, 1, '4+ times per week', 5),
(212, 30, 2, '10+', 5),
(213, 30, 3, 'Daily or almost daily', 5),
(214, 30, 4, 'Weekly', 4),
(215, 30, 5, 'Weekly', 4),
(216, 30, 6, 'Monthly', 3),
(217, 30, 7, 'Weekly', 4),
(218, 30, 8, 'Monthly', 3),
(219, 30, 9, 'Yes, during the last year', 5),
(220, 30, 10, 'No', 1),
(221, 32, 1, '4+ times per week', 5),
(222, 32, 2, '7 - 8', 4),
(223, 32, 3, 'Less than monthly', 2),
(224, 32, 4, 'Weekly', 4),
(225, 32, 5, 'Daily or almost daily', 5),
(226, 32, 6, 'Daily or almost daily', 5),
(227, 32, 7, 'Daily or almost daily', 5),
(228, 32, 8, 'Weekly', 4),
(229, 32, 9, 'Yes, during the last year', 5),
(230, 32, 10, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `GUID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `allergy_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`GUID`, `userid`, `allergy_details`) VALUES
(1, 4, 'Linseed'),
(2, 5, 'No'),
(3, 6, 'Banana'),
(4, 8, 'Dairy'),
(5, 9, 'Celery'),
(6, 10, 'Fish'),
(7, 11, 'Chamomile'),
(8, 13, 'Mustard seeds'),
(9, 14, 'Passion fruit'),
(10, 15, 'Sesame seed'),
(11, 16, 'Eggs'),
(12, 17, 'Mustard seeds'),
(13, 18, 'No'),
(14, 19, 'Passion fruit'),
(15, 20, 'Peach'),
(16, 22, 'Peach'),
(17, 23, 'Eggs'),
(18, 24, 'Sesame seed'),
(19, 25, 'Avocado'),
(20, 26, 'Sesame seed'),
(21, 28, 'Avocado'),
(22, 30, 'Avocado'),
(23, 32, 'Avocado');

-- --------------------------------------------------------

--
-- Table structure for table `lifestyle`
--

CREATE TABLE `lifestyle` (
  `GUID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `exercise` varchar(2) NOT NULL,
  `exercise_minutes` int(11) NOT NULL,
  `exercise_days` int(11) NOT NULL,
  `diet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lifestyle`
--

INSERT INTO `lifestyle` (`GUID`, `userid`, `exercise`, `exercise_minutes`, `exercise_days`, `diet`) VALUES
(1, 4, 'No', 22, 2, 'Vegan'),
(2, 5, 'Ye', 175, 7, 'Vegan'),
(3, 6, 'Ye', 71, 6, 'Vegan'),
(4, 8, 'No', 93, 5, 'Good'),
(5, 9, 'Ye', 146, 6, 'Average'),
(6, 10, 'Ye', 124, 1, 'Vegetarian'),
(7, 11, 'No', 177, 7, 'Vegetarian'),
(8, 13, 'No', 23, 4, 'Poor'),
(9, 14, 'No', 134, 2, 'Average'),
(10, 15, 'No', 113, 1, 'Good'),
(11, 16, 'Ye', 36, 7, 'Low Fat'),
(12, 17, 'No', 89, 3, 'Good'),
(13, 18, 'No', 57, 4, 'Low Fat'),
(14, 19, 'No', 25, 5, 'Low salt'),
(15, 20, 'Ye', 18, 7, 'Vegetarian'),
(16, 22, 'No', 85, 4, 'Vegetarian'),
(17, 23, 'Ye', 67, 6, 'Low Fat'),
(18, 24, 'Ye', 189, 6, 'Vegan'),
(19, 25, 'Ye', 156, 5, 'Vegetarian'),
(20, 26, 'Ye', 101, 7, 'Vegan'),
(21, 28, 'No', 104, 2, 'Vegetarian'),
(22, 30, 'No', 155, 6, 'Low Fat'),
(23, 32, 'Ye', 19, 7, 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `GUID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `has_cancer` varchar(255) NOT NULL,
  `has_heart_disease` varchar(255) NOT NULL,
  `has_stroke` varchar(255) NOT NULL,
  `has_other` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`GUID`, `userid`, `has_cancer`, `has_heart_disease`, `has_stroke`, `has_other`) VALUES
(1, 4, 'grandfather', 'father', 'No', 'auntie'),
(2, 5, 'sister', 'auntie', 'No', 'mother'),
(3, 6, 'mother', 'sister', 'mother', 'mother'),
(4, 8, 'sister', 'grandmother', 'grandmother', 'brother'),
(5, 9, 'father', 'mother', 'auntie', 'brother'),
(6, 10, 'auntie', 'brother', 'uncle', 'grandfather'),
(7, 11, 'brother', 'sister', 'mother', 'No'),
(8, 13, 'mother', 'brother', 'mother', 'auntie'),
(9, 14, 'auntie', 'uncle', 'grandfather', 'grandmother'),
(10, 15, 'uncle', 'uncle', 'mother', 'grandmother'),
(11, 16, 'sister', 'father', 'mother', 'grandmother'),
(12, 17, 'brother', 'sister', 'grandmother', 'mother'),
(13, 18, 'grandfather', 'uncle', 'grandfather', 'sister'),
(14, 19, 'mother', 'uncle', 'grandmother', 'sister'),
(15, 20, 'uncle', 'No', 'grandmother', 'sister'),
(16, 22, 'father', 'sister', 'mother', 'grandmother'),
(17, 23, 'grandfather', 'uncle', 'brother', 'sister'),
(18, 24, 'grandmother', 'uncle', 'brother', 'sister'),
(19, 25, 'brother', 'grandfather', 'mother', 'No'),
(20, 26, 'No', 'uncle', 'uncle', 'uncle'),
(21, 28, 'uncle', 'father', 'grandmother', 'uncle'),
(22, 30, 'grandmother', 'auntie', 'brother', 'father'),
(23, 32, 'grandmother', 'brother', 'father', 'sister');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `GUID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `Medication_YN` varchar(255) NOT NULL,
  `Medication_1` text NOT NULL,
  `Medication_2` text NOT NULL,
  `Medication_3` text NOT NULL,
  `medication_frequency_1` int(11) NOT NULL,
  `medication_frequency_2` int(11) NOT NULL,
  `medication_frequency_3` int(11) NOT NULL,
  `medication_dosage_1` int(11) NOT NULL,
  `medication_dosage_2` int(11) NOT NULL,
  `medication_dosage_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`GUID`, `userid`, `Medication_YN`, `Medication_1`, `Medication_2`, `Medication_3`, `medication_frequency_1`, `medication_frequency_2`, `medication_frequency_3`, `medication_dosage_1`, `medication_dosage_2`, `medication_dosage_3`) VALUES
(1, 4, 'Yes', 'Januvia', '', '', 4, 0, 0, 3, 0, 0),
(2, 5, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(3, 6, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(4, 8, 'Yes', 'Wellbutrin', 'Fentanyl', 'Gilenya', 1, 2, 2, 4, 1, 4),
(5, 9, 'Yes', 'Xanax', 'Omeprazole', '', 2, 2, 0, 4, 1, 0),
(6, 10, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(7, 11, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(8, 13, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(9, 14, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(10, 15, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(11, 16, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(12, 17, 'Yes', 'Prednisone', 'Methadone', 'Hydrochlorothiazide', 3, 3, 2, 2, 3, 1),
(13, 18, 'Yes', 'Jardiance', 'Imbruvica', 'Pantoprazole', 2, 4, 4, 2, 3, 1),
(14, 19, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(15, 20, 'Yes', 'Clindamycin', '', '', 3, 0, 0, 3, 0, 0),
(16, 22, 'Yes', 'Otezla', 'Januvia', '', 2, 1, 0, 3, 2, 0),
(17, 23, 'Yes', 'Imbruvica', '', '', 3, 0, 0, 1, 0, 0),
(18, 24, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(19, 25, 'Yes', 'Lyrica', 'Farxiga', '', 2, 4, 0, 2, 4, 0),
(20, 26, 'Yes', 'Meloxicam', '', '', 3, 0, 0, 4, 0, 0),
(21, 28, 'No', '', '', '', 0, 0, 0, 0, 0, 0),
(22, 30, 'Yes', 'Ozempic', 'Hydroxychloroquine', '', 2, 4, 0, 2, 2, 0),
(23, 32, 'No', '', '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `smoking`
--

CREATE TABLE `smoking` (
  `GUID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `smoke_status` varchar(250) NOT NULL,
  `smoke_type` varchar(255) NOT NULL,
  `start_smoking` int(11) NOT NULL,
  `quit_smoking` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smoking`
--

INSERT INTO `smoking` (`GUID`, `userid`, `smoke_status`, `smoke_type`, `start_smoking`, `quit_smoking`) VALUES
(1, 4, 'Never Smoked', '', 0, ''),
(2, 5, 'Never Smoked', '', 0, ''),
(3, 6, 'Current Smoker', 'E-cigarettes', 28, 'No'),
(4, 8, 'Ex-smoker', 'Pipe', 17, 'No'),
(5, 9, 'Never Smoked', '', 0, ''),
(6, 10, 'Ex-smoker', 'Cigars', 35, 'No'),
(7, 11, 'Ex-smoker', 'E-cigarettes', 38, 'No'),
(8, 13, 'Ex-smoker', 'Cigars', 18, 'No'),
(9, 14, 'Current Smoker', 'Cigarettes', 31, 'No'),
(10, 15, 'Current Smoker', 'E-cigarettes', 21, 'Yes'),
(11, 16, 'Ex-smoker', 'E-cigarettes', 22, 'No'),
(12, 17, 'Current Smoker', 'Cigarettes', 33, 'Yes'),
(13, 18, 'Never Smoked', '', 0, ''),
(14, 19, 'Ex-smoker', 'Pipe', 16, 'No'),
(15, 20, 'Ex-smoker', 'Cigarettes', 36, 'No'),
(16, 22, 'Never Smoked', '', 0, ''),
(17, 23, 'Never Smoked', '', 0, ''),
(18, 24, 'Ex-smoker', 'Cigarettes', 24, 'No'),
(19, 25, 'Ex-smoker', 'E-cigarettes', 40, 'No'),
(20, 26, 'Current Smoker', 'E-cigarettes', 18, 'Yes'),
(21, 28, 'Ex-smoker', 'Cigarettes', 37, 'No'),
(22, 30, 'Ex-smoker', 'E-cigarettes', 27, 'No'),
(23, 32, 'Current Smoker', 'E-cigarettes', 24, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `GUID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` text NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `dob` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `postcode` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `home_telephone` varchar(255) NOT NULL,
  `SMS_YN` varchar(255) NOT NULL,
  `occupation` text NOT NULL,
  `email_yn` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `height` decimal(10,0) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `kin_name` text NOT NULL,
  `kin_relationship` text NOT NULL,
  `kin_telephone` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`GUID`, `username`, `password`, `email`, `firstname`, `surname`, `dob`, `title`, `marital_status`, `address`, `postcode`, `mobile`, `home_telephone`, `SMS_YN`, `occupation`, `email_yn`, `gender`, `height`, `weight`, `kin_name`, `kin_relationship`, `kin_telephone`, `status`) VALUES
(1, 'adminJSMP', 'password', 'admin@ehealth.com', 'Admin', 'Admin', '2019-04-25', '', '', '', '', '', '', '', '', '', '', '0', '0', '', '', '', ''),
(2, 'Bob', 'Letmein', 'test@test.com', 'John', 'Henry', '1991-10-22', '', 'Single', '', '', '', '', '', '', '', 'Female', '0', '0', '', '', '', ''),
(3, 'sdaffey0', 'PFyJS8t', 'sdaffey0@archive.org', 'Sissie', 'Daffey', '1999-12-26', 'Mrs', 'Single', '39977 Green Ridge Alley', 'BN11 9WX', '07765656783', '', 'yes', 'Physical Therapy Assistant', 'yes', 'Agender', '8', '18', 'Sissie Daffey', 'Parent', '07707118790', ''),
(4, 'sbelson1', '1IowwMNY3iP', 'sbelson1@blog.com', 'Stephanie', 'Belson', '1967-07-14', 'Ms', 'Civil Partnership', '737 Division Avenue', 'NP26 4EF', '07072022988', '0161-2924495', 'yes', 'Chief Design Engineer', 'yes', 'Genderfluid', '7', '9', 'Stephanie Belson', 'Parent', '07807905534', 'approved'),
(5, 'vmallon2', 'C1aC5AqQtC8', 'vmallon2@mozilla.org', 'Valle', 'Mallon', '2018-03-13', 'Dr', 'Other', '7 Cascade Crossing', 'OL8 2NL', '07824075387', '0161-1651614', 'yes', 'VP Quality Control', 'yes', 'Male', '5', '10', 'Valle Mallon', 'child', '07889122475', 'approved'),
(6, 'asegges3', 'PaJ86suTN7O', 'asegges3@wix.com', 'Aileen', 'Segges', '2014-07-08', 'Mrs', 'Single', '7 Rieder Alley', 'CO15 5PG', '07959699106', '0161-1287147', 'no', '', 'no', 'Agender', '6', '7', 'Aileen Segges', 'brother', '07889122475', 'rejected'),
(7, 'adesson4', 'lRaMnjiD', 'adesson4@amazon.com', 'Abagail', 'Desson', '2011-09-24', 'Rev', 'Divorced', '5 Reinke Avenue', 'PL12 5BP', '07703371511', '', 'yes', 'Staff Accountant IV', 'no', 'Male', '8', '15', 'Abagail Desson', 'Parent', '07889122475', ''),
(8, 'sbirwhistle5', '3c64rq', 'sbirwhistle5@indiatimes.com', 'Sherline', 'Birwhistle', '1995-09-07', 'Mrs', 'Divorced', '02308 Vermont Court', 'TN34 9ZY', '07824075387', '0161-1956534', 'yes', 'Human Resources Assistant III', 'no', 'Female', '5', '14', 'Sherline Birwhistle', 'Parent', '07787347824', 'rejected'),
(9, 'uiggo6', 'p1sZCJvF', 'uiggo6@foxnews.com', 'Ula', 'Iggo', '1996-03-18', 'Rev', 'Other', '769 Scoville Street', 'BT14 8HB', '07765656783', '0161-4573625', 'yes', 'Analog Circuit Design manager', 'no', 'Female', '7', '12', 'Ula Iggo', 'brother', '07807905534', 'pending'),
(10, 'bcodman7', 'k6AZ5aaG', 'bcodman7@blinklist.com', 'Barde', 'Codman', '1996-07-29', 'Rev', 'Single', '01 Sauthoff Hill', 'CO15 5PG', '07081537542', '0161-0221644', 'yes', 'Product Engineer', 'no', 'Male', '7', '7', 'Barde Codman', 'partner', '07703371511', 'pending'),
(11, 'mraffan8', 'rr98aQbT', 'mraffan8@typepad.com', 'Maryjane', 'Raffan', '1986-06-08', 'Mrs', 'Single', '50 Heath Court', 'NR7 0TR', '07982926531', '0161-1962654', 'yes', 'Structural Analysis Engineer', 'no', 'Agender', '7', '19', 'Maryjane Raffan', 'brother', '07979737032', 'approved'),
(12, 'mmcavinchey9', 'sMhGT9Z5u', 'mmcavinchey9@exblog.jp', 'Mordy', 'McAvinchey', '1952-08-10', 'Rev', 'Other', '9024 Manufacturers Road', 'BD23 2RX', '07909586499', '', 'yes', 'Budget/Accounting Analyst IV', 'no', 'Bigender', '6', '15', 'Mordy McAvinchey', 'partner', '07024229883', ''),
(13, 'aexona', 's9cUPXPaDRxy', 'aexona@wikia.com', 'Adham', 'Exon', '1950-09-01', 'Mr', 'Married', '8 Riverside Court', 'KA30 8QX', '07913831912', '0161-1423557', 'yes', 'GIS Technical Architect', 'yes', 'Bigender', '5', '17', 'Adham Exon', 'brother', '07879733309', 'approved'),
(14, 'pruffeyb', 'kL879a4', 'pruffeyb@businessinsider.com', 'Peadar', 'Ruffey', '1969-04-11', 'Honorable', 'Single', '616 Village Pass', 'PO30 3EU', '07765656783', '0161-2465230', 'no', 'Marketing Manager', 'no', 'Male', '5', '14', 'Peadar Ruffey', 'partner', '07707118790', 'approved'),
(15, 'npotterc', 'S0GzA9Kvjcd', 'npotterc@wordpress.com', 'Nita', 'Potter', '1956-11-26', 'Ms', 'Divorced', '62055 Stephen Terrace', 'BS11 8AF', '07707118790', '0161-0541772', 'no', 'Sales Associate', 'no', 'Non-binary', '5', '14', 'Nita Potter', 'child', '07072022988', 'approved'),
(16, 'alangand', 'oqiyhHg', 'alangand@ted.com', 'Abram', 'Langan', '1979-03-15', 'Dr', 'Divorced', '466 John Wall Street', 'E17 8BZ', '07982926531', '0161-4914267', 'no', 'Director of Sales', 'yes', 'Female', '7', '14', 'Abram Langan', 'Parent', '07765656783', 'approved'),
(17, 'lmugglestonee', 'Zaz1JBZJXg', 'lmugglestonee@tmall.com', 'Leigh', 'Mugglestone', '2006-04-20', 'Rev', 'Single', '1151 Evergreen Lane', 'TR10 8JH', '07913881081', '0161-1287147', 'no', 'Software Consultant', 'no', 'Agender', '8', '10', 'Leigh Mugglestone', 'partner', '07072022988', 'rejected'),
(18, 'frennenbachf', 'hQaggI6', 'frennenbachf@hostgator.com', 'Ferdie', 'Rennenbach', '2015-01-26', 'Mrs', 'Civil Partnership', '40 Erie Center', 'BS11 8AF', '07889122475', '0161-2124699', 'yes', 'Structural Engineer', 'no', 'Non-binary', '7', '16', 'Ferdie Rennenbach', 'Parent', '07072022988', 'pending'),
(19, 'dredwoodg', 'GeHvYTqI', 'dredwoodg@cornell.edu', 'Doloritas', 'Redwood', '1989-11-06', 'Dr', 'Single', '7 Muir Trail', 'CO10 0EA', '07801103923', '0161-4176191', 'no', 'Social Worker', 'yes', 'Bigender', '8', '15', 'Doloritas Redwood', 'partner', '07959699106', 'rejected'),
(20, 'qbernthh', 'OEG51BH4Cf', 'qbernthh@joomla.org', 'Quillan', 'Bernth', '1992-06-20', 'Ms', 'Married', '3 Huxley Alley', 'BA5 1DP', '07982926531', '0161-4914267', 'yes', '', 'yes', 'Bigender', '6', '8', 'Quillan Bernth', 'Parent', '07760322253', 'approved'),
(21, 'jwoodesi', 'MFbSfdG', 'jwoodesi@walmart.com', 'Joice', 'Woodes', '1961-08-24', 'Mr', 'Divorced', '82796 Mallard Pass', 'CF14 0TL', '07703371511', '', 'yes', 'Assistant Media Planner', 'no', 'Female', '7', '14', 'Joice Woodes', 'Parent', '07703371511', ''),
(22, 'browleyj', 'gpO6jsZA1MZW', 'browleyj@flickr.com', 'Bianka', 'Rowley', '1957-08-17', 'Rev', 'Other', '0636 Brickson Park Drive', 'NE23 2FE', '07024229883', '0161-0935184', 'yes', 'Research Assistant I', 'no', 'Agender', '6', '18', 'Bianka Rowley', 'child', '07760322253', 'pending'),
(23, 'rfaughnank', 'ZWMUb4esVpY', 'rfaughnank@homestead.com', 'Roderigo', 'Faughnan', '1962-02-14', 'Rev', 'Single', '7 Shasta Park', 'BT14 8HB', '07959699106', '0161-0221644', 'no', 'Marketing Assistant', 'yes', 'Genderqueer', '6', '7', 'Roderigo Faughnan', 'partner', '07889122475', 'approved'),
(24, 'rlal', 'Yf2n1Uh', 'rlal@facebook.com', 'Renard', 'La Rosa', '1973-09-23', 'Honorable', 'Single', '38788 Armistice Trail', 'PR5 8LA', '07807905534', '0161-0541772', 'yes', 'Nurse', 'yes', 'Agender', '7', '11', 'Renard La Rosa', 'brother', '07885337883', 'rejected'),
(25, 'sbartkowiakm', 'HE6agIpAqsRS', 'sbartkowiakm@howstuffworks.com', 'Sapphira', 'Bartkowiak', '2005-09-03', 'Ms', 'Civil Partnership', '5432 Pepper Wood Center', 'CR7 6HT', '07072022988', '0161-3303974', 'no', '', 'yes', 'Male', '8', '17', 'Sapphira Bartkowiak', 'brother', '07959699106', 'approved'),
(26, 'hcobainn', 'C2bxhXgnjwjE', 'hcobainn@answers.com', 'Henka', 'Cobain', '1991-04-11', 'Dr', 'Single', '80 Springview Park', 'NE23 2FE', '07754173632', '0161-2559509', 'yes', 'Budget/Accounting Analyst I', 'yes', 'Agender', '6', '14', 'Henka Cobain', 'child', '07885337883', 'approved'),
(27, 'tgieveso', 'mR6fMiro', 'tgieveso@jugem.jp', 'Todd', 'Gieves', '2017-06-08', 'Honorable', 'Civil Partnership', '01345 Sunfield Way', 'PR5 8LA', '07879733309', '', 'yes', 'Programmer Analyst I', 'no', 'Male', '6', '9', 'Todd Gieves', 'child', '07046483527', ''),
(28, 'cgildroyp', '5JqWOWrx6xW', 'cgildroyp@nature.com', 'Costanza', 'Gildroy', '2017-12-20', 'Dr', 'Married', '005 Ilene Court', 'WA1 3PT', '07760322253', '0161-5967619', 'no', 'Assistant Media Planner', 'yes', 'Non-binary', '7', '19', 'Costanza Gildroy', 'partner', '07888326043', 'rejected'),
(29, 'pchottyq', '0ILwfMnB2iYF', 'pchottyq@imdb.com', 'Portie', 'Chotty', '1982-04-09', 'Rev', 'Single', '20161 Pearson Park', 'CR7 6HT', '07754173632', '', 'yes', 'Nurse', 'yes', 'Bigender', '7', '19', 'Portie Chotty', 'partner', '07760322253', ''),
(30, 'acollickr', 'v5giD2Zvqr', 'acollickr@forbes.com', 'Aldous', 'Collick', '2013-02-05', 'Ms', 'Civil Partnership', '24394 Calypso Trail', 'PO30 3EU', '07984658668', '0161-1692652', 'no', 'Food Chemist', 'yes', 'Bigender', '7', '18', 'Aldous Collick', 'partner', '07913881081', 'rejected'),
(31, 'jfishburns', 'elHZalYb', 'jfishburns@nba.com', 'Jed', 'Fishburn', '1971-04-14', 'Ms', 'Married', '152 Spaight Point', 'E17 8BZ', '07888326043', '', 'no', 'Human Resources Assistant II', 'yes', 'Female', '7', '17', 'Jed Fishburn', 'Parent', '07885337883', ''),
(32, 'mvanyushkint', 'Qg4QygolCQ3', 'mvanyushkint@merriam-webster.com', 'Maurizio', 'Vanyushkin', '1971-05-31', 'Mrs', 'Civil Partnership', '044 Dayton Court', 'CH61 7XQ', '07703371511', '0161-4176191', 'yes', 'Pharmacist', 'no', 'Polygender', '5', '9', 'Maurizio Vanyushkin', 'partner', '07984658668', 'rejected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alcohol_options`
--
ALTER TABLE `alcohol_options`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `alcohol_questions`
--
ALTER TABLE `alcohol_questions`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `alcohol_responses`
--
ALTER TABLE `alcohol_responses`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `lifestyle`
--
ALTER TABLE `lifestyle`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`GUID`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `smoking`
--
ALTER TABLE `smoking`
  ADD PRIMARY KEY (`GUID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`GUID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alcohol_options`
--
ALTER TABLE `alcohol_options`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alcohol_questions`
--
ALTER TABLE `alcohol_questions`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `alcohol_responses`
--
ALTER TABLE `alcohol_responses`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `lifestyle`
--
ALTER TABLE `lifestyle`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `smoking`
--
ALTER TABLE `smoking`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
