-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2017 at 02:27 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shardul_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(111) NOT NULL,
  `volunteer_id` int(111) NOT NULL,
  `Paymentdate` date NOT NULL,
  `account_type` varchar(111) NOT NULL,
  `ammount` int(111) NOT NULL,
  `status` varchar(111) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `volunteer_id`, `Paymentdate`, `account_type`, `ammount`, `status`) VALUES
(1, 1, '2017-10-10', '', 2000, 'Yes'),
(2, 1, '2017-10-11', '', 5000, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(111) NOT NULL,
  `name` varchar(111) NOT NULL,
  `nid` int(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `pro-pic` varchar(111) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(111) NOT NULL,
  `user_name` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `catagory` varchar(111) NOT NULL,
  `softDelete` varchar(111) NOT NULL DEFAULT 'No',
  `phone` int(111) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `nid`, `email`, `pro-pic`, `dob`, `address`, `user_name`, `password`, `catagory`, `softDelete`, `phone`, `status`) VALUES
(1, 'Shardul1971', 2147483647, 'shardul@gmail.com', '', '2006-12-16', 'asdasd', 'Shardul', 'pass@123', 'Super Admin', 'No', 2147483647, 0),
(2, 'Sayed Simam', 1234567890, 'simam@aaa.com', '', '2000-03-16', 'Shardul', 'simam', 'pass@123', 'Donor Admin', 'No', 1812009988, 0),
(3, 'Diponkor Majumder', 2147483647, 'dipu@gmaild.com', '', '1993-03-17', 'Chandgaon', 'Dipuno2', 'pass@123', 'Volunteer Admin', 'No', 2147483647, 0),
(4, 'Ovi Chowdhury', 2147483647, 'ovi.chowdhury@yame.com', '', '2017-08-24', 'Chaktai', 'OviChy', 'pass@123', 'Muktipedia Admin', 'No', 2147483647, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blood_doner`
--

CREATE TABLE `blood_doner` (
  `id` int(111) NOT NULL,
  `user_id` int(111) NOT NULL,
  `blood_group` varchar(111) NOT NULL,
  `area_zone` varchar(111) NOT NULL,
  `last_donate_date` date NOT NULL,
  `prfrbl_time` varchar(111) NOT NULL,
  `gender` varchar(111) NOT NULL,
  `softDelete` varchar(111) NOT NULL DEFAULT 'No',
  `profile_picture` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_doner`
--

INSERT INTO `blood_doner` (`id`, `user_id`, `blood_group`, `area_zone`, `last_donate_date`, `prfrbl_time`, `gender`, `softDelete`, `profile_picture`) VALUES
(1, 77, 'A-', 'kotowali', '2017-03-15', 'Anytime', 'male', 'No', 'beautiful-fish-wallpaper-hd-61.jpg'),
(2, 65, '0+', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(3, 56, 'A-', 'kotowali', '2017-03-01', 'Anytime', 'male', 'No', ''),
(4, 67, 'A-', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(5, 73, '0+', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(6, 69, 'O+', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(7, 70, '0+', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(8, 51, 'A-', 'kotowali', '2017-03-01', 'Anytime', 'male', 'No', ''),
(9, 69, 'A-', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(10, 63, 'A-', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', ''),
(11, 58, 'A-', 'kotowali', '2017-03-02', 'Anytime', 'male', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `freedom_fighter`
--

CREATE TABLE `freedom_fighter` (
  `id` int(111) NOT NULL,
  `name` varchar(111) NOT NULL,
  `sector` int(111) NOT NULL,
  `address` varchar(111) NOT NULL,
  `designation` varchar(111) NOT NULL,
  `reg_no` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freedom_fighter`
--

INSERT INTO `freedom_fighter` (`id`, `name`, `sector`, `address`, `designation`, `reg_no`) VALUES
(1, 'Mahfuzur Rahman', 11, 'Chittagong', 'Bir-protik', '123654'),
(2, 'Motiur Rahman', 5, 'Barishal', 'Bir-sreshtto', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `mukttipedia`
--

CREATE TABLE `mukttipedia` (
  `id` int(111) NOT NULL,
  `softDelete` varchar(111) NOT NULL DEFAULT 'No',
  `blog_date` date NOT NULL,
  `blog_title` varchar(111) NOT NULL,
  `blog_post` varchar(111) NOT NULL,
  `freedom_fighter_id` int(111) NOT NULL,
  `question` varchar(111) NOT NULL,
  `answer` varchar(111) NOT NULL,
  `cetagory` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mukttipedia`
--

INSERT INTO `mukttipedia` (`id`, `softDelete`, `blog_date`, `blog_title`, `blog_post`, `freedom_fighter_id`, `question`, `answer`, `cetagory`) VALUES
(1, 'No', '0000-00-00', 'kemon acho?', 'onk onk din ager kotha!', 1, '', '', 'operation'),
(3, 'No', '2017-03-13', 'head', 'asdasd as asd as dfasd', 1, '', '', 'sub');

-- --------------------------------------------------------

--
-- Table structure for table `question_answer`
--

CREATE TABLE `question_answer` (
  `id` int(111) NOT NULL,
  `user_id` int(111) NOT NULL,
  `freedom_fighter_id` int(111) NOT NULL,
  `question` varchar(111) NOT NULL,
  `answer` varchar(111) NOT NULL,
  `status` varchar(111) NOT NULL DEFAULT 'No',
  `reply_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answer`
--

INSERT INTO `question_answer` (`id`, `user_id`, `freedom_fighter_id`, `question`, `answer`, `status`, `reply_date`) VALUES
(1, 2, 1, 'kemon achen Mahfuzur Sir?', 'hello', 'Yes', '0000-00-00'),
(2, 79, 1, 'Hello World', '', 'Yes', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(111) NOT NULL,
  `firstname` varchar(111) NOT NULL,
  `lastname` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `phone` varchar(111) NOT NULL,
  `user_name` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `address` varchar(111) NOT NULL,
  `softDelete` varchar(111) NOT NULL DEFAULT 'No',
  `role` varchar(111) NOT NULL,
  `dob` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `user_name`, `password`, `address`, `softDelete`, `role`, `dob`) VALUES
(1, 'simam', 'syed', 'simamsyed.ss@gmail.com', '01927511261', 'simam', '123@simam', 'muradpur', 'No', '', '10.06.1992'),
(2, 'si', 'syed', 'simamsyed.sss@gmail.com', '01927511261', 'simam', '123456@q', 'muradpur', 'No', '', '10.06.1992'),
(3, 'simam', 'syed', 'simed.ss@gmail.com', '01622138220', 'smmmmm', '12345@q', 'nsnaada', 'No', '', '08.07.1993'),
(17, 'df', 'dsf', 'sddadsfdsfsd@gmail.com', 'sdf', 'sdf', 'dsf', 'sdf', 'No', '', 'dfs'),
(18, 'sdfs', 'syed', 'simamsysfdsdfsed.ss@gmail.com', 'asd', 'simamsyed.ss@gmail.com', 'sa', 'asd', 'No', '', 'asda'),
(19, 's', 's', 'simamsyedfgdgd.ss@gmail.com', 'fgdgdg', 'SIMAM', 'df', 'dgdfg', 'No', '', '2017-02-02'),
(20, 'sdasd', 'sdfsdf', 'simamsydgdfgdgfsfdsded.ss@gmail.com', 'fgdfgg', 'sdfsfd', 'dfgdfgdfg', 'fghfgh', 'No', '', 'dfgdfg'),
(21, 'sdfsdf', 'sfsdfsdfsdf', 'sdfsf@sfsdfdasdasd.com', 'sdfsdf', 'asdasd', 'sdfsfasdasd', 'zxczxc', 'No', '', 'dsasdadsasdzxcfsds'),
(22, 'dsd', 'sdfsfd', 'sdfsdf@djha.com', 'fsdfsdf', 'sdfsf', 'sdff', 'sdfsf', 'No', '', '2017-02-07'),
(23, 'fdsf', 'sdfsfd', 'sdfsfd@yahoo.com', 'dfsf', 'sdfsfd', 'sfdsdf', 'sfdf', 'No', '', 'sdfsdf'),
(24, 'dsdf', 'dfsdf', 'sdf@sfsdf.com', 'erertert', 'sdfsdfs', 'sdfsdf', 'dfgdg', 'No', '', 'sdfsdf'),
(25, 'sdfsdf', 'sfsdfsdfsdf', 'sdfsf@sfsdffghasdasd.com', 'sdfsdf', 'asdasd', 'sdfsfasdasd', 'dfgdg', 'No', '', 'dsasdadsasdzxcfsds'),
(26, 'tfgh', 'ghf', 'sdfsf@sfsdfghfffghasdasd.com', 'sdfsdffghfhg', 'fghfh', 'sdfsfasdasdfghfh', 'fghfh', 'No', '', 'dsasdadsasdzxcfsdsfghfh'),
(27, 'dfgd', 'dfg', 'dfgdfg@hjfg.com', 'dfsfsdfgh', 'dfg', 'g', 'fgh', 'No', '', '2017-02-07'),
(28, 'sdf', 'hghf', 'dgf@yahooo.com', 'sdfsf', 'sfds', 'fsdfs', 'fdgdg', 'No', '', 'sfdsf'),
(29, 'dsfs', 'sdfsdfs', 'sddadsfdsfdsd@gmail.com', 'sdfsf', 'dfsf', 'sdfsfsf', 'sdfsf', 'No', '', 'sdfsdfsf'),
(30, 'sdsd', 'sdfsad', 'simamssdadfggfdyed.ss@gmail.com', 'asdad', 'sadasd', 'asdad', 'asdasd', 'No', '', 'asdasd'),
(31, 'asdadasda', 'adaadsaasda', 'asdasfdsd@hdsf.com', 'sfdsdf', 'sfdads', 'sdfs', 'xv', 'No', '', 'sdfsdf'),
(32, 'simam', 'syed', 'smed@gmail.com', 'adasdadsad', 'syed simam', '12345', 'adsadads', 'No', '', 'asdadad'),
(33, 'simam', 'adaadsaasda', 'asdasfsdaddsd@hdsf.com', 'sfdsdf', 'sfdads', 'sdfs', 'asdd', 'No', '', 'sdfsdf'),
(34, 'simam', 'adaadsaasda', 'asdasfdsffgdfgd@hdsf.com', 'sfdsdf', 'sfdads', 'sdfs', 'dgfdgdfg', 'No', '', 'sdfsdf'),
(35, 'j', 'adaadsaasda', 'asdalklksfdsd@hdsf.com', 'sfdsdf', 'sfdads', 'sdfs', 'kj', 'No', '', 'sdfsdf'),
(36, 'sssss', 'adaadsaasda', 'asdalklksffghfghdsd@hdsf.com', 'sfdsdf', 'sfdads', 'sdfs', 'fgdgdf', 'No', '', 'sdfsdf'),
(37, 'sssss', 'adaadsaasda', 'asdalklkszxcffghfghdsd@hdsf.com', 'sfdsdf', 'sfdads', 'sdfs', 'zcx', 'No', '', 'sdfsdf'),
(38, 'simam', 'syed', 'simamsyed.ssvb@gmail.com', 'dfsdfsfd', 'sd', 'dfsfsfd', 'fgdg', 'No', '', 'dsfsf'),
(39, 'simam', 'syed', 'simamsyedd.ssvb@gmail.com', 'dfsdfsfd', 'sd', 'dfsfsfd', 'dsfs', 'No', '', 'dsfsf'),
(40, 'simam', 'syed', 'simamsyffedd.ssvb@gmail.com', 'dfsdfsfd', 'sd', 'dfsfsfd', 'dfg', 'No', '', 'dsfsf'),
(41, 'zxczc', 'xczx', 'asdalklksfsdfsfdsd@hdsf.com', 'dfsdfsfd', 'sd', 'dfsfsfd', 'xv', 'No', '', 'dsfsf'),
(42, 'ds', 'dsa', 'dfsdsdfdfsf@yahoo.com', 'dsfsfd', 'dffsdf', 'dsfsf', 'czxcz', 'No', '', 'dsfsdf'),
(43, 'df', 'dsad', 'dfsdsdfdddfsf@yahoo.com', 'bv', 'dffsdf', '123@qwe', 'vmbnmb', 'No', '', '65654'),
(44, 'df', 'dsad', 'dfsdsfgddfdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'sdfs', 'No', '', '65654'),
(45, 'df', 'dsad', 'dfsdsfgddfddfddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'dfg', 'No', '', '65654'),
(46, 'df', 'dsad', 'dfsdsfgddfddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'sd', 'No', '', '65654'),
(47, 'df', 'dsad', 'dfsdsfgddfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'xvc', 'No', '', '65654'),
(48, 'df', 'dsad', 'dfsdsfgddxcvfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'xcvx', 'No', '', '65654'),
(49, 'df', 'dsad', 'dfsdsfgddxcvddfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'sdfs', 'No', '', '65654'),
(50, 'df', 'dsad', 'dfsdsfgsddxcvddfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'sdfada', 'No', '', '65654'),
(51, 'df', 'dsad', 'dfsdsfgsddxcsadvddfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'asd', 'No', '', '65654'),
(52, 'df', 'dsad', 'dfsdsfgsdsdxcsadvddfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'sad', 'No', '', '65654'),
(53, 'df', 'dsad', 'dfsdsfgdfsdsdxcsadvxcvddfxcvddfdsdddfbvvsf@yahoo.com', '0dfssdfsf', 'dffsdf', '12345', 'dfdfg', 'No', '', '65654'),
(54, 'df', 'dsad', 'dfsdsfgddfsdsdxcsadvxcvddfxcvddfdsdddfbvvsf@yahoo.com', 'dd', 'dffsdf', 'ddddd', 'd', 'No', '', '65654'),
(55, 'df', 'dsad', 'dddfxbffvvgsf@yahoo.com', 's', 'dffsdf', '12345', 's', 'No', '', 'sd'),
(56, 'df', 'dsad', 'dddfxbdffvvgsf@yahoo.com', 's', 'dffsdf', '12345', 'sdf', 'No', '', 'sd'),
(57, 'dfxcv', 'dsadxcv', 'dddfxbdxcvffvvgsf@yahoo.com', 'sc', 'dffsdf', '12345', 'xcv', 'No', '', 'sdx'),
(58, 'dfxcv', 'dsadxcv', 'dddfxffvvgsf@yahoo.com', '1-234-567-8901', 'dffsdf', '12345', 'ssad', 'No', '', 'sdx'),
(59, 'dfxcv', 'dsadxcv', 'dddfxffvsvgsf@yahoo.com', 'sdadasd', 'dffsdf', '12345', 'sad', 'No', '', 'sdx'),
(60, 'dfxcv', 'dsadxcv', 'dddfxffvsvfgsf@yahoo.com', '01927511261', 'dffsdf', '12345', 'f', 'No', '', 'sdx'),
(61, 'dfxcv', 'dsadxcv', 'dddfffvsvfgsf@yahoo.com', '01927511261', 'dffsdf', '12345', 'sdf', 'No', '', 'fdsfsdf'),
(62, 'dfxcv', 'dsadxcv', 'dddfffvsvcxvfgsf@yahoo.com', 'dfgdfgdf', 'dffsdf', 'simam123456@', 'cv', 'No', '', 'fdsfsdf'),
(63, 'simam', 'syed', 'simamsyedd.ss@gmail.com', '+8801927511261', 'simam', '12345678910@qwer', 'vxcvxcv', 'No', '', '08.07.1993'),
(64, 'simam', 'syed', 'simamsfyedd.ss@gmail.com', '01927511261', 'simam', 'simam@123', 'sdf', 'No', '', '08.07.1993'),
(65, 'simam', 'syed', 'simamsfysdedd.ss@gmail.com', '01812447538', 'simam', 'simam@123', 'sfd', 'No', '', '08.07.1993'),
(66, 'simam', 'syed', 'simamsfysdeddd.ss@gmail.com', '01812447538', 'simam', '1234567g', 'ds', 'No', '', '08.07.1993'),
(67, 'simam', 'syed', 'simamsfysddeddd.ss@gmail.com', '+8801927511261', 'simam', 'pass@123', 'fds', 'No', '', '08.07.1993'),
(68, 'simam', 'syed', 'simamsfysddveddd.ss@gmail.com', '+8801927511261', 'simam', 'xcvxv@6545', 'xv', 'No', '', '08.07.1993'),
(69, 'simam', 'syed', 'simamsfysddvdfeddd.ss@gmail.com', '+8801927511261', 'simam', 'xcvxv@6545', 'sdfsf', 'No', '', '08.07.1993'),
(70, 'simam', 'syed', 'simamsfysdddvdfeddd.ss@gmail.com', '+8801927511261', 'simam', 'xcvxv@6545', 'dsfsdf', 'No', '', '08.07.1993'),
(71, 'simam', 'syed', 'simamsfysdxddvdfeddd.ss@gmail.com', '+8801927511261', 'simam', 'xcvxv@6545', ' zxc', 'No', '', '08.07.1993'),
(72, 'simam', 'syed', 'simamsfysdxddvdfedfdd.ss@gmail.com', '+8801927511261', 'simam', 'xcvxv@6545', 'fdgdg', 'No', '', '08.07.1993'),
(73, 'simam', 'syed', 'simamsfysdxfddvdfedfdd.ss@gmail.com', '+8801927511261', 'simam', 'xcvxv@6545', 'tdrterte', 'No', '', '08.07.1993'),
(77, 'Ovi shaheb', 'Chy shaheb', 'ovi@gmail.coma', '222222222', 'ovi', 'pass@1234', 'chaktai', 'No', 'BloodDonor', '1993-03-02'),
(79, 'simam', 'sayed', 'shafayet.rabby@gmail.com', '01712312345', 'simamsayed', 'pass@123', 'Hillview', 'No', 'Volunteer', '1993-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `id` int(111) NOT NULL,
  `user_id` int(111) NOT NULL,
  `highest_education` varchar(111) NOT NULL,
  `passing_year` varchar(111) NOT NULL,
  `roll` int(111) NOT NULL,
  `profile_picture` varchar(111) NOT NULL,
  `softDelete` varchar(111) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`id`, `user_id`, `highest_education`, `passing_year`, `roll`, `profile_picture`, `softDelete`) VALUES
(1, 79, 'ssc', '1992-12-8', 120595, '8589130479434-best-nature-wallpaper-hd.jpg', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteer_id` (`volunteer_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_doner`
--
ALTER TABLE `blood_doner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `freedom_fighter`
--
ALTER TABLE `freedom_fighter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mukttipedia`
--
ALTER TABLE `mukttipedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freedom_fighter_id` (`freedom_fighter_id`);

--
-- Indexes for table `question_answer`
--
ALTER TABLE `question_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`freedom_fighter_id`),
  ADD KEY `freedom_fighter_id` (`freedom_fighter_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blood_doner`
--
ALTER TABLE `blood_doner`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `freedom_fighter`
--
ALTER TABLE `freedom_fighter`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mukttipedia`
--
ALTER TABLE `mukttipedia`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `question_answer`
--
ALTER TABLE `question_answer`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_doner`
--
ALTER TABLE `blood_doner`
  ADD CONSTRAINT `blood_doner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mukttipedia`
--
ALTER TABLE `mukttipedia`
  ADD CONSTRAINT `mukttipedia_ibfk_1` FOREIGN KEY (`freedom_fighter_id`) REFERENCES `freedom_fighter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_answer`
--
ALTER TABLE `question_answer`
  ADD CONSTRAINT `question_answer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_answer_ibfk_2` FOREIGN KEY (`freedom_fighter_id`) REFERENCES `freedom_fighter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
