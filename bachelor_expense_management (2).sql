-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2022 at 01:09 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bachelor expense management`
--

-- --------------------------------------------------------

--
-- Table structure for table `homeexpenses`
--

CREATE TABLE `homeexpenses` (
  `HExpenseID` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `ds` date NOT NULL DEFAULT current_timestamp(),
  `ts` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `homeexpenses`
--

INSERT INTO `homeexpenses` (`HExpenseID`, `home_id`, `user_id`, `username`, `descr`, `category`, `amount`, `ds`, `ts`) VALUES
(1, 1, 3, 'Tajwar', 'Rice', 'Food', 2000, '2022-12-18', '09:00:13'),
(2, 1, 4, 'Samanta', 'Juice', 'Food', 500, '2022-12-18', '09:12:56'),
(3, 1, 2, 'Jubayer Hossain', 'Murgi', 'Food', 500, '2022-12-18', '09:25:11'),
(4, 1, 3, 'Everyone', 'Rent', 'Housing', 15000, '2022-12-18', '09:54:32'),
(5, 1, 5, 'Everyone', 'basha vara', 'Housing', 30000, '2022-12-18', '10:14:14'),
(6, 1, 2, 'Jubayer Hossain', 'Koyla 5kg', 'Others', 250, '2022-12-18', '10:16:33'),
(7, 1, 5, 'hasnat79', 'murgi', 'Others', 600, '2022-12-18', '10:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `home_id` int(11) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `homename` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `securitycode` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `member_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`home_id`, `owner`, `homename`, `address`, `securitycode`, `created_at`, `member_count`) VALUES
(1, 'Mehedi Hasan Nabil', 'CSE370', 'UB40101', '1234', '2022-12-18', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hometodo`
--

CREATE TABLE `hometodo` (
  `htodo_id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `ds` date NOT NULL,
  `ts` time NOT NULL,
  `completed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userdebtsurplus`
--

CREATE TABLE `userdebtsurplus` (
  `debt_id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `homename` varchar(100) NOT NULL,
  `creditor` varchar(100) NOT NULL,
  `debtor` varchar(100) NOT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `paid` int(11) DEFAULT NULL,
  `partial_pay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdebtsurplus`
--

INSERT INTO `userdebtsurplus` (`debt_id`, `home_id`, `homename`, `creditor`, `debtor`, `descr`, `amount`, `paid`, `partial_pay`) VALUES
(1, 1, '', 'Tajwar', 'Jubayer Hossain', 'Rice', 667, NULL, NULL),
(2, 1, '', 'Tajwar', 'mehedihasannabil', 'Rice,Koyla 5kg', 717, NULL, NULL),
(3, 1, '', 'Samanta', 'Jubayer Hossain', 'Juice', 125, NULL, NULL),
(4, 1, '', 'Samanta', 'mehedihasannabil', NULL, 50, NULL, NULL),
(5, 1, '', 'Samanta', 'Tajwar', 'Juice,Koyla 5kg', 175, NULL, NULL),
(6, 1, '', 'Jubayer Hossain', 'mehedihasannabil', 'Murgi,Koyla 5kg', 175, NULL, NULL),
(7, 1, '', 'Jubayer Hossain', 'Samanta', 'Murgi,Koyla 5kg', 175, NULL, NULL),
(8, 1, '', 'Jubayer Hossain', 'Tajwar', NULL, 50, NULL, NULL),
(9, 1, '', 'Jubayer Hossain', 'hasnat79', 'Koyla 5kg', 30, NULL, NULL),
(10, 1, '', 'hasnat79', 'Jubayer Hossain', 'murgi', 120, NULL, NULL),
(11, 1, '', 'hasnat79', 'mehedihasannabil', 'murgi', 120, NULL, NULL),
(12, 1, '', 'hasnat79', 'Samanta', 'murgi', 120, NULL, NULL),
(13, 1, '', 'hasnat79', 'Tajwar', 'murgi', 120, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userexpenses`
--

CREATE TABLE `userexpenses` (
  `UExpenseID` int(11) NOT NULL,
  `HExpenseID` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `DS` date NOT NULL DEFAULT current_timestamp(),
  `TS` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userexpenses`
--

INSERT INTO `userexpenses` (`UExpenseID`, `HExpenseID`, `user_id`, `username`, `descr`, `category`, `amount`, `DS`, `TS`) VALUES
(1, 1, 3, 'Tajwar', 'Rice', 'Food', 667, '2022-12-18', '09:00:13'),
(2, 2, 4, 'Samanta', 'Juice', 'Food', 125, '2022-12-18', '09:12:56'),
(3, NULL, 1, 'mehedihasannabil', 'Partial Debt pay to Tajwar for Rice', 'Debt', 0, '2022-12-18', '09:22:49'),
(4, NULL, 1, 'mehedihasannabil', 'Partial Debt pay to Samanta for Juice', 'Debt', 25, '2022-12-18', '09:23:03'),
(5, 3, 2, 'Jubayer Hossain', 'Murgi', 'Food', 125, '2022-12-18', '09:25:11'),
(6, NULL, 2, 'Jubayer Hossain', 'Home to BRAC', 'Transportation', 100, '2022-12-18', '09:30:45'),
(7, NULL, 1, 'mehedihasannabil', 'Debt pay to Samanta for Juice', 'Debt', 100, '2022-12-18', '09:30:53'),
(8, NULL, 2, 'Jubayer Hossain', 'Avatar 2', 'Entertainment', 450, '2022-12-18', '09:31:03'),
(9, NULL, 2, 'Jubayer Hossain', 'Jacket', 'Clothings', 1000, '2022-12-18', '09:31:33'),
(10, NULL, 3, 'Tajwar', 'Rent', 'Housing', 3750, '2022-12-18', '09:54:32'),
(11, NULL, 2, 'Jubayer Hossain', 'Rent', 'Housing', 3750, '2022-12-18', '09:54:32'),
(12, NULL, 1, 'mehedihasannabil', 'Rent', 'Housing', 3750, '2022-12-18', '09:54:32'),
(13, NULL, 4, 'Samanta', 'Rent', 'Housing', 3750, '2022-12-18', '09:54:32'),
(14, NULL, 3, 'Tajwar', 'Debt pay to Jubayer Hossain for Murgi', 'Debt', 125, '2022-12-18', '09:59:39'),
(16, NULL, 5, 'hasnat79', 'bus vara', 'Transportation', 40, '2022-12-18', '10:10:08'),
(17, NULL, 5, 'hasnat79', 'chal er bosta', 'Food', 1200, '2022-12-18', '10:10:53'),
(18, NULL, 5, 'hasnat79', 'basha vara', 'Housing', 6000, '2022-12-18', '10:14:14'),
(19, NULL, 2, 'Jubayer Hossain', 'basha vara', 'Housing', 6000, '2022-12-18', '10:14:14'),
(20, NULL, 1, 'mehedihasannabil', 'basha vara', 'Housing', 6000, '2022-12-18', '10:14:14'),
(21, NULL, 4, 'Samanta', 'basha vara', 'Housing', 6000, '2022-12-18', '10:14:14'),
(22, NULL, 3, 'Tajwar', 'basha vara', 'Housing', 6000, '2022-12-18', '10:14:14'),
(23, 6, 2, 'Jubayer Hossain', 'Koyla 5kg', 'Others', 50, '2022-12-18', '10:16:33'),
(24, 7, 5, 'hasnat79', 'murgi', 'Others', 120, '2022-12-18', '10:16:34'),
(25, NULL, 5, 'hasnat79', 'Partial Debt pay to Jubayer Hossain for Koyla 5kg', 'Debt', 20, '2022-12-18', '10:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `joined_at` datetime NOT NULL DEFAULT current_timestamp(),
  `home_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `username`, `pass`, `joined_at`, `home_id`) VALUES
(5, 'Hasnat Md', '', 'Abdullah', 'hasnatabdullah79@gmail.com', '012365478974', 'hasnat79', '12345', '2022-12-18 10:05:54', 1),
(2, 'Jubayer', '', 'Hossain', 'jubayer.hossain@g.bracu.ac.bd', '01955112789', 'Jubayer Hossain', '1234', '2022-12-18 08:38:13', 1),
(1, 'Mehedi', 'Hasan', 'Nabil', 'mehedi.hasan.nabil@g.bracu.ac.bd', '01985868407', 'mehedihasannabil', '12345678', '2022-12-18 08:38:07', 1),
(4, 'Samanta', 'Binte', 'Taher', 'samanta@gmail.com', '01819931634', 'Samanta', '1234', '2022-12-18 09:00:44', 1),
(3, 'Tajwar', '', 'Chowdhury', 'tajwarchy425@gmail.com', '01877181276', 'Tajwar', '1234', '2022-12-18 08:45:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertodo`
--

CREATE TABLE `usertodo` (
  `todo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `ds` date DEFAULT current_timestamp(),
  `ts` time DEFAULT '23:59:59',
  `completed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertodo`
--

INSERT INTO `usertodo` (`todo_id`, `user_id`, `descr`, `ds`, `ts`, `completed`) VALUES
(1, 1, 'Assignment', '2022-12-19', '23:56:00', 0),
(2, 1, 'Quiz ', '2022-12-20', '11:00:00', 0),
(3, 2, 'quiz', '2022-12-20', '10:00:00', 0),
(4, 5, 'vaat khabo', '2022-12-18', '13:29:00', 1),
(5, 5, 'nasta korbo', '2022-12-17', '10:08:00', 1),
(6, 5, 'ghum theke utha lagbe', '2022-12-16', '10:09:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homeexpenses`
--
ALTER TABLE `homeexpenses`
  ADD PRIMARY KEY (`HExpenseID`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`home_id`),
  ADD UNIQUE KEY `homename` (`homename`);

--
-- Indexes for table `hometodo`
--
ALTER TABLE `hometodo`
  ADD PRIMARY KEY (`htodo_id`);

--
-- Indexes for table `userdebtsurplus`
--
ALTER TABLE `userdebtsurplus`
  ADD PRIMARY KEY (`debt_id`);

--
-- Indexes for table `userexpenses`
--
ALTER TABLE `userexpenses`
  ADD PRIMARY KEY (`UExpenseID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `usertodo`
--
ALTER TABLE `usertodo`
  ADD PRIMARY KEY (`todo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homeexpenses`
--
ALTER TABLE `homeexpenses`
  MODIFY `HExpenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hometodo`
--
ALTER TABLE `hometodo`
  MODIFY `htodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdebtsurplus`
--
ALTER TABLE `userdebtsurplus`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userexpenses`
--
ALTER TABLE `userexpenses`
  MODIFY `UExpenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usertodo`
--
ALTER TABLE `usertodo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
