-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 10:21 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `tax_id` varchar(50) NOT NULL,
  `date_created` int(11) NOT NULL,
  `LIMIT_BAL` float DEFAULT NULL,
  `SEX` int(11) DEFAULT NULL,
  `EDUCATION` int(11) DEFAULT NULL,
  `MARRIAGE` int(11) DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `PAY_0` int(11) DEFAULT NULL,
  `PAY_2` int(11) DEFAULT NULL,
  `PAY_3` int(11) DEFAULT NULL,
  `PAY_4` int(11) DEFAULT NULL,
  `PAY_5` int(11) DEFAULT NULL,
  `PAY_6` int(11) DEFAULT NULL,
  `BILL_AMT1` float DEFAULT NULL,
  `BILL_AMT2` float DEFAULT NULL,
  `BILL_AMT3` float DEFAULT NULL,
  `BILL_AMT4` float DEFAULT NULL,
  `BILL_AMT5` float DEFAULT NULL,
  `BILL_AMT6` float DEFAULT NULL,
  `PAY_AMT1` float DEFAULT NULL,
  `PAY_AMT2` float DEFAULT NULL,
  `PAY_AMT3` float DEFAULT NULL,
  `PAY_AMT4` float DEFAULT NULL,
  `PAY_AMT5` float DEFAULT NULL,
  `PAY_AMT6` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `firstname`, `middlename`, `lastname`, `contact_no`, `address`, `email`, `tax_id`, `date_created`, `LIMIT_BAL`, `SEX`, `EDUCATION`, `MARRIAGE`, `AGE`, `PAY_0`, `PAY_2`, `PAY_3`, `PAY_4`, `PAY_5`, `PAY_6`, `BILL_AMT1`, `BILL_AMT2`, `BILL_AMT3`, `BILL_AMT4`, `BILL_AMT5`, `BILL_AMT6`, `PAY_AMT1`, `PAY_AMT2`, `PAY_AMT3`, `PAY_AMT4`, `PAY_AMT5`, `PAY_AMT6`) VALUES
('000001', 'Nguyen', 'Van', 'An', '0901234567', '1 Le Loi, Ha Noi', 'an.nguyen@email.com', '010101-01', 0, 50000, 1, 1, 1, 28, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000002', 'Tran', 'Thi', 'Binh', '0912345678', '2 Tran Hung Dao, Ha Noi', 'binh.tran@email.com', '010102-02', 0, 60000, 2, 2, 2, 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000003', 'Le', 'Quoc', 'Cuong', '0923456789', '3 Nguyen Trai, HCM', 'cuong.le@email.com', '010103-03', 0, 70000, 1, 3, 1, 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000004', 'Pham', 'Minh', 'Dung', '0934567890', '4 Le Duan, Da Nang', 'dung.pham@email.com', '010104-04', 0, 80000, 1, 1, 2, 40, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000005', 'Hoang', 'Thi', 'Em', '0945678901', '5 Tran Phu, Hai Phong', 'em.hoang@email.com', '010105-05', 0, 55000, 2, 2, 1, 27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000006', 'Do', 'Van', 'Phat', '0956789012', '6 Nguyen Hue, Hue', 'phat.do@email.com', '010106-06', 0, 90000, 1, 3, 2, 38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000007', 'Bui', 'Thi', 'Giang', '0967890123', '7 Bach Dang, Da Nang', 'giang.bui@email.com', '010107-07', 0, 62000, 2, 1, 1, 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000008', 'Vu', 'Minh', 'Hieu', '0978901234', '8 Ly Thuong Kiet, HCM', 'hieu.vu@email.com', '010108-08', 0, 75000, 1, 2, 2, 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000009', 'Dang', 'Thi', 'Hoa', '0989012345', '9 Nguyen Hue, Ha Noi', 'hoa.dang@email.com', '010109-09', 0, 53000, 2, 3, 1, 29, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000010', 'Ngo', 'Van', 'Khanh', '0990123456', '10 Le Lai, HCM', 'khanh.ngo@email.com', '010110-10', 0, 67000, 1, 1, 2, 36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000011', 'Trinh', 'Thi', 'Lan', '0901122334', '11 Tran Quoc Toan, Da Nang', 'lan.trinh@email.com', '010111-11', 0, 58000, 2, 2, 1, 31, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000012', 'Phan', 'Quoc', 'Minh', '0912233445', '12 Nguyen Van Cu, Ha Noi', 'minh.phan@email.com', '010112-12', 0, 81000, 1, 3, 2, 41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000013', 'Mai', 'Thi', 'Ngoc', '0923344556', '13 Le Thanh Tong, Hai Phong', 'ngoc.mai@email.com', '010113-13', 0, 56000, 2, 1, 1, 26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000014', 'Duong', 'Van', 'Phuc', '0934455667', '14 Tran Nhan Tong, HCM', 'phuc.duong@email.com', '010114-14', 0, 92000, 1, 2, 2, 39, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000015', 'Chu', 'Thi', 'Quyen', '0945566778', '15 Nguyen Dinh Chieu, Da Nang', 'quyen.chu@email.com', '010115-15', 0, 61000, 2, 3, 1, 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000016', 'Ly', 'Van', 'Son', '0956677889', '16 Le Van Sy, HCM', 'son.ly@email.com', '010116-16', 0, 73000, 1, 1, 2, 44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000017', 'Ta', 'Thi', 'Trang', '0967788990', '17 Nguyen Thi Minh Khai, Ha Noi', 'trang.ta@email.com', '010117-17', 0, 54000, 2, 2, 1, 28, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000018', 'Vuong', 'Quoc', 'Tuan', '0978899001', '18 Phan Dinh Phung, Da Nang', 'tuan.vuong@email.com', '010118-18', 0, 69000, 1, 3, 2, 37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000019', 'Kieu', 'Thi', 'Uyen', '0989900112', '19 Nguyen Huu Canh, HCM', 'uyen.kieu@email.com', '010119-19', 0, 57000, 2, 1, 1, 34, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('000020', 'Quach', 'Van', 'Vinh', '0991001223', '20 Le Hong Phong, Hai Phong', 'vinh.quach@email.com', '010120-20', 0, 83000, 1, 2, 2, 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE `loan_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `loan_type_id` int(30) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `plan_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= request, 1= confrimed,2=released,3=complteted,4=denied\r\n',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_list`
--

INSERT INTO `loan_list` (`id`, `ref_no`, `loan_type_id`, `borrower_id`, `purpose`, `amount`, `plan_id`, `status`, `date_released`, `date_created`) VALUES
(3, '81409630', 1, 1, 'Sample Only', 100000, 1, 2, '2020-09-26 09:06:00', '2020-09-26 15:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `id` int(30) NOT NULL,
  `months` int(11) NOT NULL,
  `interest_percentage` float NOT NULL,
  `penalty_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`id`, `months`, `interest_percentage`, `penalty_rate`) VALUES
(1, 36, 8, 3),
(2, 24, 5, 2),
(3, 27, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedules`
--

CREATE TABLE `loan_schedules` (
  `id` int(30) NOT NULL,
  `loan_id` int(30) NOT NULL,
  `date_due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_schedules`
--

INSERT INTO `loan_schedules` (`id`, `loan_id`, `date_due`) VALUES
(2, 3, '2020-10-26'),
(3, 3, '2020-11-26'),
(4, 3, '2020-12-26'),
(5, 3, '2021-01-26'),
(6, 3, '2021-02-26'),
(7, 3, '2021-03-26'),
(8, 3, '2021-04-26'),
(9, 3, '2021-05-26'),
(10, 3, '2021-06-26'),
(11, 3, '2021-07-26'),
(12, 3, '2021-08-26'),
(13, 3, '2021-09-26'),
(14, 3, '2021-10-26'),
(15, 3, '2021-11-26'),
(16, 3, '2021-12-26'),
(17, 3, '2022-01-26'),
(18, 3, '2022-02-26'),
(19, 3, '2022-03-26'),
(20, 3, '2022-04-26'),
(21, 3, '2022-05-26'),
(22, 3, '2022-06-26'),
(23, 3, '2022-07-26'),
(24, 3, '2022-08-26'),
(25, 3, '2022-09-26'),
(26, 3, '2022-10-26'),
(27, 3, '2022-11-26'),
(28, 3, '2022-12-26'),
(29, 3, '2023-01-26'),
(30, 3, '2023-02-26'),
(31, 3, '2023-03-26'),
(32, 3, '2023-04-26'),
(33, 3, '2023-05-26'),
(34, 3, '2023-06-26'),
(35, 3, '2023-07-26'),
(36, 3, '2023-08-26'),
(37, 3, '2023-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `id` int(30) NOT NULL,
  `type_name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`id`, `type_name`, `description`) VALUES
(1, 'Small Business', 'Small Business Loans'),
(2, 'Mortgages', 'Mortgages'),
(3, 'Personal Loans', 'Personal Loans');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `loan_id` int(30) NOT NULL,
  `payee` text NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `penalty_amount` float NOT NULL DEFAULT 0,
  `overdue` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no , 1 = yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `loan_id`, `payee`, `amount`, `penalty_amount`, `overdue`, `date_created`) VALUES
(2, 3, 'Smith, John C', 3000, 0, 0, '2020-09-26 15:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `doctor_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_id`, `name`, `address`, `contact`, `username`, `password`, `type`) VALUES
(1, 0, 'Administrator', '', '', 'admin', 'admin123', 1),
(2, 0, 'AnNguyen', '', '', 'user1', '123456', 2),
(3, 0, 'BinhTran', '', '', 'user2', '123456', 2),
(4, 0, 'CuongLe', '', '', 'user3', '123456', 2),
(5, 0, 'DungPham', '', '', 'user4', '123456', 2),
(6, 0, 'EmHoang', '', '', 'user5', '123456', 2),
(7, 0, 'PhatDo', '', '', 'user6', '123456', 2),
(8, 0, 'GiangBui', '', '', 'user7', '123456', 2),
(9, 0, 'HieuVu', '', '', 'user8', '123456', 2),
(10, 0, 'HoaDang', '', '', 'user9', '123456', 2),
(11, 0, 'KhanhNgo', '', '', 'user10', '123456', 2),
(12, 0, 'LanTrinh', '', '', 'user11', '123456', 2),
(13, 0, 'MinhPhan', '', '', 'user12', '123456', 2),
(14, 0, 'NgocMai', '', '', 'user13', '123456', 2),
(15, 0, 'PhucDuong', '', '', 'user14', '123456', 2),
(16, 0, 'QuyenChu', '', '', 'user15', '123456', 2),
(17, 0, 'SonLy', '', '', 'user16', '123456', 2),
(18, 0, 'TrangTa', '', '', 'user17', '123456', 2),
(19, 0, 'TuanVuong', '', '', 'user18', '123456', 2),
(20, 0, 'UyenKieu', '', '', 'user19', '123456', 2),
(21, 0, 'VinhQuach', '', '', 'user20', '123456', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
