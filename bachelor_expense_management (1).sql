-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 06:34 PM
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
(8, 1, 7, 'Creepy', 'Vaat', 'Food', 2000, '2022-12-13', '19:39:51'),
(9, 1, 1, 'JubayerHossain', 'Something', 'Food', 2000, '2022-12-13', '19:53:27'),
(10, 1, 2, 'Nocktowl', 'Something', 'Food', 2000, '2022-12-13', '21:03:52');

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
(1, 'Jubayer', 'BaddarAdda', 'Cha-71, Uttar Badda', '1234', '0000-00-00', 9),
(2, 'Jubayer', 'Adda2', 'Cha-71 Uttar Badda', '1234', '2022-12-12', 1);

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
  `amount` int(11) NOT NULL,
  `paid` int(11) DEFAULT NULL,
  `partial_pay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdebtsurplus`
--

INSERT INTO `userdebtsurplus` (`debt_id`, `home_id`, `homename`, `creditor`, `debtor`, `amount`, `paid`, `partial_pay`) VALUES
(1, 1, '', 'JubayerHossain', 'abubakr72', 500, NULL, NULL),
(2, 1, '', 'JubayerHossain', 'hasnat79', 500, NULL, NULL),
(3, 1, '', 'JubayerHossain', 'Nocktowl', 0, NULL, NULL),
(4, 1, '', 'Nocktowl', 'abubakr72', 500, NULL, NULL),
(5, 1, '', 'Nocktowl', 'hasnat79', 500, NULL, NULL),
(6, 1, '', 'Nocktowl', 'JubayerHossain', 500, NULL, NULL);

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
(4, NULL, 7, 'Creepy', 'Vaat', 'Food', 10, '2022-12-13', '17:55:11'),
(6, 8, 7, 'Creepy', 'Vaat', 'Food', 400, '2022-12-13', '19:39:51'),
(7, NULL, 1, 'JubayerHossain', 'Something', 'Food', 100, '2022-12-13', '19:50:42'),
(8, 9, 1, 'JubayerHossain', 'Something', 'Food', 500, '2022-12-13', '19:53:27'),
(9, NULL, 2, 'Nocktowl', 'Buyar Putki', 'Food', 100, '2022-12-13', '19:55:43'),
(11, 10, 2, 'Nocktowl', 'Something', 'Food', 500, '2022-12-13', '21:03:52'),
(12, NULL, 1, 'JubayerHossain', 'Anything', 'Housing', 100, '2022-12-13', '21:19:48');

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
(3, 'Abu', 'Bark', 'Siddique', 'absiddique0377@gmail.com', '01995120377', 'abubakr72', 'mahin12345', '0000-00-00 00:00:00', 1),
(6, 'Any', '', 'Many', 'dsds@gmail.com', 'gsgsdfs', 'buac', '1234', '2022-12-08 01:21:15', NULL),
(4, 'Hasnat Md.', '', 'Abdullah', 'hasnatabdullah79@gmail.com', '66 mohakhali', 'hasnat79', '1234', '0000-00-00 00:00:00', 1),
(1, 'Jubayer', '', 'Hossain', 'jubayer.hossain@g.bracu.ac.bd', '01955112789', 'JubayerHossain', '1234', '0000-00-00 00:00:00', 1),
(2, 'Mehedi', 'Hasan', 'Nabil', 'Mehedi.hasanhulknabil@gmail.com', '01985868407', 'Nocktowl', '12345678', '0000-00-00 00:00:00', 1);

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
  MODIFY `HExpenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hometodo`
--
ALTER TABLE `hometodo`
  MODIFY `htodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userdebtsurplus`
--
ALTER TABLE `userdebtsurplus`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userexpenses`
--
ALTER TABLE `userexpenses`
  MODIFY `UExpenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usertodo`
--
ALTER TABLE `usertodo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
