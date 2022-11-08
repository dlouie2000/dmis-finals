-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 03:07 PM
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
-- Database: `dmis-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoryrecord`
--

CREATE TABLE `categoryrecord` (
  `categoryID` varchar(50) NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoryrecord`
--

INSERT INTO `categoryrecord` (`categoryID`, `categoryName`) VALUES
('CTGRYPRD-0Q4FD9GJ', 'Dress'),
('CTGRYPRD-AYHYLYX3', 'Romper'),
('CTGRYPRD-KX2S64ZZ', 'Xtian :))'),
('CTGRYPRD-S518K49D', 'Bottom'),
('CTGRYPRD-V7H2L68R', 'Jumpsuit'),
('CTGRYPRD-XO6Z3O5F', 'Top');

-- --------------------------------------------------------

--
-- Table structure for table `productrecord`
--

CREATE TABLE `productrecord` (
  `productId` varchar(50) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productCategory` varchar(50) NOT NULL,
  `productCondition` varchar(50) NOT NULL,
  `productQuantity` int(20) NOT NULL,
  `productImage` varchar(50) NOT NULL,
  `DateTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productrecord`
--

INSERT INTO `productrecord` (`productId`, `productName`, `productCategory`, `productCondition`, `productQuantity`, `productImage`, `DateTime`) VALUES
('PRD-90B33QFH', 'Black Skater Skirt Xtian 123', 'Bottom', 'Good', 198, 'images_(2).jpg', '2022-03-08T12:37'),
('PRD-911WN6FG', 'Denim Summer Pants', 'Bottom', 'Good', 90, 'summer-pants-1624910460.jpg', '2022-01-11T18:40'),
('PRD-9UKP7MZ3', 'White and Blue Plaid Shirt', 'Top', 'Good', 95, 'vbe_6333.jpg', '2022-03-07T22:40'),
('PRD-BL9U7XOJ', 'Xtian<3', 'Dress', 'Mildly Damaged', 123, 'peralta.jpg', '2022-09-18T19:26'),
('PRD-CL6HTK4T', 'Gaby', 'Dress', 'Good', 999, 'peralta.jpg', '2022-09-18T19:23'),
('PRD-EB87P24I', 'High Waisted Mom Jeans', 'Bottom', 'Good', 280, 'high-waisted-mom-jeans-in-light-blue.jpg', '2022-03-11T18:35'),
('PRD-IYZBU4WX', 'Sweatshort', 'Bottom', 'Good', 300, '1590093734-sweatshorts-palace-1590093727.jpg', '2022-02-27T21:31'),
('PRD-J3QDV8UR', 'qwe', 'Dress', 'Repairable', 100, 'peralta.jpg', '2022-09-14T00:45'),
('PRD-JFK2IS33', 'sept21', 'Romper', 'Mildly Damaged', 999, 'peralta.jpg', '2022-09-22T00:43'),
('PRD-JPQZB2GW', ' Black and White Checkered Polo', 'Top', 'Good', 120, '12d3a687b3286ed9d538e860724eb9a2.jpg', '2022-03-01T11:30'),
('PRD-MV0F7TRR', 'Blue Wrap-around Romper', 'Romper', 'Good', 250, '3d1bf406b70c2a95bca771431c6e48f3.jpg', '2022-03-11T18:23'),
('PRD-N32OYWEW', 'Red Shorts', 'Bottom', 'Good', 197, 'fox-kids-baby-2745-4131541-1.jpg', '2022-03-11T18:35'),
('PRD-OU1PALHC', 'Gray V-neck Shirt', 'Top', 'Bad', 7, '71tfHjpjtcL__AC_UY445_.jpg', '2021-09-25T18:27'),
('PRD-PK1VOIW3', 'Skinny Jeans', 'Bottom', 'Good', 95, '-1117Wx1400H-440794191-mediumblue-MODEL.jpg', '2022-02-08T19:29'),
('PRD-QKKRLURX', 'Gray V-neck Shirt', 'Top', 'Good', 93, '71tfHjpjtcL__AC_UY445_.jpg', '2021-09-25T18:28'),
('PRD-QRVRYP75', 'Straight Cut Jeans', 'Bottom', 'Good', 500, '1620985519-app005prod.jpg', '2022-01-05T20:36'),
('PRD-R3S4MBEQ', 'Strawberry Puff Dress', 'Dress', 'Good', 500, '18STRAWBERRYDRESS-4-mobileMasterAt3x.jpg', '2022-01-11T10:29'),
('PRD-RKJHRKTD', 'White 3/4 Dress', 'Dress', 'Good', 600, 'sipsip-3d750d4ed7154222a2dd1722ed3f71d2.jpg', '2021-12-14T18:46'),
('PRD-X1YTG05Q', 'Gaby121212121', 'Romper', 'Good', 9999, 'peralta.jpg', '2022-09-18T19:29'),
('PRD-YAGTO4MW', 'Gray Puffy Long Sleeves', 'Top', 'Good', 150, '1204506282.jpg', '2022-02-01T22:30'),
('PRD-YMBM5SI6', 'Red Shorts', 'Bottom', 'Mildly Damaged', 3, 'fox-kids-baby-2745-4131541-1.jpg', '2022-02-20T22:34');

-- --------------------------------------------------------

--
-- Table structure for table `reqproductrecord`
--

CREATE TABLE `reqproductrecord` (
  `reqproductId` varchar(50) NOT NULL,
  `productId` varchar(50) NOT NULL,
  `reqproductQuantity` int(20) NOT NULL,
  `reqDateTime` datetime NOT NULL,
  `reqproductStatus` varchar(100) NOT NULL,
  `approveDateTime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reqproductrecord`
--

INSERT INTO `reqproductrecord` (`reqproductId`, `productId`, `reqproductQuantity`, `reqDateTime`, `reqproductStatus`, `approveDateTime`) VALUES
('REQPRD-7PSX2MLF', 'PRD-3WCSWK54', 50, '2022-09-18 23:16:00', 'Pending', 'Pending'),
('REQPRD-K03LYD7P', 'PRD-90B33QFH', 1, '2022-09-30 00:55:00', 'Approved', '2022-09-30 01:07:22'),
('REQPRD-W2ZKHZ29', 'PRD-90B33QFH', 150, '2022-09-18 23:21:00', 'Pending', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_name`
--

CREATE TABLE `tbl_name` (
  `id` int(11) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `contactNo` int(15) NOT NULL,
  `bio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_name`
--

INSERT INTO `tbl_name` (`id`, `lastName`, `firstName`, `birthdate`, `contactNo`, `bio`) VALUES
(8, 'aaa', 'ccc', '1992-12-04', 90909090, 'asda a a');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `username`, `email`, `password`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'warehouse', 'warehouse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoryrecord`
--
ALTER TABLE `categoryrecord`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `productrecord`
--
ALTER TABLE `productrecord`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `reqproductrecord`
--
ALTER TABLE `reqproductrecord`
  ADD PRIMARY KEY (`reqproductId`);

--
-- Indexes for table `tbl_name`
--
ALTER TABLE `tbl_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_name`
--
ALTER TABLE `tbl_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
