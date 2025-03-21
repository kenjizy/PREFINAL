-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `responses`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_responses`
--

CREATE TABLE `tbl_responses` (
  `r_id` int(50) NOT NULL,
  `r_des` varchar(200) NOT NULL,
  `r_goals` varchar(200) NOT NULL,
  `r_email` varchar(200) NOT NULL,
  `r_na` varchar(200) NOT NULL,
  `r_gender` varchar(200) NOT NULL,
  `r_code` varchar(200) NOT NULL,
  `r_sub` varchar(200) NOT NULL,
  `r_food` varchar(200) NOT NULL,
  `r_pet` varchar(200) NOT NULL,
  `r_sport` varchar(200) NOT NULL,
  `r_season` varchar(200) NOT NULL,
  `r_drink` varchar(200) NOT NULL,
  `r_motiv` varchar(200) NOT NULL,
  `r_week` varchar(200) NOT NULL,
  `r_top` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_responses`
--

INSERT INTO `tbl_responses` (`r_id`, `r_des`, `r_goals`, `r_email`, `r_na`, `r_gender`, `r_code`, `r_sub`, `r_food`, `r_pet`, `r_sport`, `r_season`, `r_drink`, `r_motiv`, `r_week`, `r_top`) VALUES
(5, 'Qui vitae et animi', 'Architecto recusanda', 'Basketball', 'No', 'Qui nostrum veniam', 'Yes', 'Hic voluptas non qui', 'Officia pariatur Ni', 'No', 'Veniam laboris a qu', 'Yes', 'Consequuntur adipisc', 'Yes', 'Laborum accusantium', 'Yes'),
(6, 'Adele Herring', 'Et culpa in alias qu', 'No', 'Basketball', 'Eum nesciunt labori', 'No', 'Aperiam quae volupta', 'Ipsum consequuntur', 'Yes', 'Est aliquid adipisci', 'Yes', 'Rerum omnis vero cor', 'Yes', 'Error cupiditate mag', 'Yes'),
(7, 'Katell Garza', 'Omnis mollit est ad', 'No', 'Tennis, Badminton', 'Fuga Voluptatem Et', 'Yes', 'Quo ut assumenda arc', 'Esse harum provident', 'Yes', 'Molestiae vel consec', 'No', 'Et accusamus et cons', 'Yes', 'Enim enim saepe iste', 'Yes'),
(8, 'Quia nobis officiis', 'Ex molestias id quia', 'Yes', 'Basketball', 'Neque laudantium su', 'Yes', 'Quos voluptatem ulla', 'Qui tempor reprehend', 'No', 'Qui officia aut dign', 'Yes', 'Aut id aut enim qui', 'Yes', 'Voluptatem accusamus', 'No'),
(9, 'Optio veniam esse', 'Non eveniet sequi q', 'No', 'Badminton', 'Cum eos eu quibusda', 'No', 'Sint possimus vitae', 'Iste non in aut odio', 'Yes', 'Accusantium voluptat', 'No', 'Voluptas soluta dolo', 'No', 'Illum a ea et volup', 'Yes'),
(10, 'Magna Nam in nostrum', 'Itaque quod ut Nam r', 'No', 'Football, Basketball', 'Elit nihil cupidita', 'Yes', 'Reprehenderit conse', 'Molestiae provident', 'Yes', 'Est dolor quis excep', 'No', 'Ullam delectus sed', 'Yes', 'Sit nemo dolores te', 'Yes'),
(11, 'Magna Nam in nostrum', 'Itaque quod ut Nam r', 'No', 'Football, Basketball', 'Elit nihil cupidita', 'Yes', 'Reprehenderit conse', 'Molestiae provident', 'Yes', 'Est dolor quis excep', 'No', 'Ullam delectus sed', 'Yes', 'Sit nemo dolores te', 'Yes'),
(12, 'Quia cum duis iste q', 'Quis provident qui', 'No', 'Basketball', 'Ullam blanditiis ess', 'Yes', 'Quam incididunt veri', 'Sapiente nostrum qua', 'No', 'Dolor perspiciatis', 'No', 'Dolorem id et sint', 'No', 'Vero quod odit adipi', 'Yes'),
(13, 'Nihil eiusmod minima', 'Dolor illo odio nihi', 'Yes', 'Football', 'At qui numquam fuga', 'Yes', 'Iusto ipsa aut quis', 'Ullamco voluptate vo', 'Yes', 'Ad aut eiusmod simil', 'No', 'Molestias corrupti', 'No', 'Praesentium dolore d', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  MODIFY `r_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
