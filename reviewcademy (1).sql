-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 09:00 AM
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
-- Database: `reviewcademy`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_title`) VALUES
('CSE101', 'Introduction to Computer Science'),
('CSE102', 'Programming Fundamentals'),
('CSE103', 'Data Structures'),
('CSE104', 'Algorithms'),
('cse115', 'introducing to c'),
('CSE201', 'Database Management Systems'),
('CSE202', 'Operating Systems'),
('CSE203', 'Computer Networks'),
('CSE204', 'Software Engineering'),
('cse215', 'introducing to oop'),
('cse225', 'Dat Structure and Algorithm'),
('CSE301', 'Artificial Intelligence'),
('CSE302', 'Machine Learning'),
('CSE303', 'Cybersecurity'),
('CSE304', 'Human-Computer Interaction'),
('CSE305', 'Web Development'),
('CSE306', 'Mobile Application Development'),
('CSE401', 'Digital Signal Processing'),
('CSE402', 'Cloud Computing'),
('CSE403', 'Blockchain Technology'),
('CSE404', 'Big Data Analytics'),
('CSE405', 'Internet of Things (IoT)'),
('CSE406', 'Natural Language Processing');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `review_id` int(11) DEFAULT NULL,
  `report_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `review_id`, `report_type`) VALUES
(8, 25, 'OTHERS'),
(10, 28, 'FALSE REVIEW'),
(12, 22, 'FALSE REVIEW'),
(13, 22, 'OTHERS');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `s_id` bigint(20) NOT NULL,
  `t_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `rate_grading` int(11) NOT NULL,
  `rate_learning` int(11) NOT NULL,
  `rate_professor` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `s_id`, `t_id`, `course_name`, `rate_grading`, `rate_learning`, `rate_professor`, `comment`) VALUES
(22, 2231018642, 101, 'cse215', 5, 5, 5, 'teaching style was very good and understandable\r\n'),
(25, 2231018642, 101, 'cse215', 1, 1, 1, 'not good'),
(26, 2231018642, 101, 'cse215', 5, 5, 5, 'very good'),
(27, 2231018642, 101, 'cse215', 4, 4, 4, 'good'),
(28, 10001, 20001, 'CSE101', 4, 4, 5, 'Great professor, very knowledgeable and engaging lectures.'),
(29, 10002, 20001, 'CSE101', 3, 4, 4, 'Good course but needs better explanations on difficult topics.'),
(31, 10004, 20002, 'CSE102', 4, 4, 4, 'Interesting subject, but the pace of the course was a bit fast.'),
(32, 10005, 20002, 'CSE102', 3, 3, 4, 'Content is good, but it would be better with more practical examples.'),
(33, 10006, 20002, 'CSE102', 5, 4, 5, 'She explains concepts clearly and makes complex topics easy to understand.'),
(34, 10007, 20003, 'CSE103', 4, 4, 5, 'Very passionate and approachable. The course content is relevant and interesting.'),
(35, 10008, 20003, 'CSE103', 4, 5, 5, 'Great course with real-world applications. Rakib sir is excellent.'),
(36, 10009, 20003, 'CSE103', 3, 3, 4, 'The course could be more organized, but the professor’s teaching is solid.'),
(37, 10010, 20004, 'CSE104', 5, 5, 5, 'Amazing professor! Very interactive and gives great feedback.'),
(38, 10011, 20004, 'CSE104', 4, 4, 4, 'Good course, but the homework assignments were too difficult.'),
(39, 10012, 20004, 'CSE104', 5, 5, 5, 'Prof. Sadia is very patient and clarifies doubts in the class very well.'),
(40, 10013, 20005, 'CSE201', 4, 4, 5, 'Strong subject knowledge, but needs better communication on assignments.'),
(41, 10014, 20005, 'CSE201', 5, 5, 5, 'Excellent teaching! Dr. Tareq makes complex topics seem easy to grasp.'),
(42, 10015, 20005, 'CSE201', 3, 4, 4, 'The course was informative, but the pace was a bit slow at times.'),
(43, 10016, 20006, 'CSE202', 5, 5, 5, 'She is a fantastic professor. Very thorough and provides good support.'),
(44, 10017, 20006, 'CSE202', 4, 4, 4, 'The course was great, but more focus on practical applications would be beneficial.'),
(45, 10018, 20006, 'CSE202', 4, 4, 5, 'Very helpful and understanding professor, highly recommend the course.'),
(46, 10019, 20007, 'CSE203', 5, 5, 5, 'Dr. Haque is an excellent instructor with a deep understanding of the subject.'),
(47, 10020, 20007, 'CSE203', 4, 4, 5, 'Course content is relevant, but more in-depth examples would be helpful.'),
(48, 10001, 20007, 'CSE203', 3, 4, 4, 'A good course, but the class was sometimes hard to follow due to too much theory.'),
(49, 10002, 20008, 'CSE204', 5, 5, 5, 'Amazing course. Prof. Farhana explained everything in great detail!'),
(51, 10004, 20008, 'CSE204', 3, 4, 4, 'Good course but the grading system should be more transparent.'),
(52, 10005, 20009, 'CSE301', 4, 4, 5, 'The course content was great. Dr. Nafis explains everything with real-world examples.'),
(53, 10006, 20009, 'CSE301', 4, 4, 4, 'Good professor and engaging class, but more case studies would improve the course.'),
(54, 10007, 20009, 'CSE301', 5, 5, 5, 'Fantastic professor! Makes everything very easy to understand.'),
(55, 10008, 20010, 'CSE302', 5, 5, 5, 'Very good at explaining difficult concepts in a simple manner.'),
(56, 10009, 20010, 'CSE302', 4, 4, 4, 'The course was interesting, but it could benefit from more hands-on projects.'),
(57, 10010, 20010, 'CSE302', 5, 5, 5, 'Prof. Tania is very experienced, and her lectures are clear and engaging.'),
(58, 2231018642, 20001, 'CSE303', 5, 4, 4, 'teaching quality was good but curves a lot'),
(59, 2231018642, 101, 'cse215', 4, 3, 5, 'well');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT 'student',
  `university_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `department`, `password`, `type`, `university_name`) VALUES
(0, 'Admin', 'Admin@gmail.com', 'Admin', '0', 'admin', 'North South'),
(10001, 'Arif Hasan', 'arif.hasan@email.com', 'Computer Science', 'Arif', 'student', 'North South'),
(10002, 'Nabila Akter', 'nabila.akter@email.com', 'Business Administration', 'Nabila', 'student', 'IUB'),
(10004, 'Sadia Jahan', 'sadia.jahan@email.com', 'Law', 'Sadia', 'student', 'BRAC'),
(10005, 'Tareq Islam', 'tareq.islam@email.com', 'Pharmacy', 'Tareq', 'student', 'North South'),
(10006, 'Mehnaz Rahman', 'mehnaz.rahman@email.com', 'Environmental Science', 'Mehnaz', 'student', 'IUB'),
(10007, 'Samiul Haque', 'samiul.haque@email.com', 'Mathematics', 'Samiul', 'student', 'AIUB'),
(10008, 'Farhana Sultana', 'farhana.sultana@email.com', 'Accounting', 'Farhana', 'student', 'BRAC'),
(10009, 'Nafis Chowdhury', 'nafis.chowdhury@email.com', 'Marketing', 'Nafis', 'student', 'North South'),
(10010, 'Tania Begum', 'tania.begum@email.com', 'Architecture', 'Tania', 'student', 'IUB'),
(10011, 'Hasan Karim', 'hasan.karim@email.com', 'Economics', 'Hasan', 'student', 'AIUB'),
(10012, 'Maliha Zaman', 'maliha.zaman@email.com', 'Psychology', 'Maliha', 'student', 'BRAC'),
(10013, 'Tanvir Hossain', 'tanvir.hossain@email.com', 'Sociology', 'Tanvir', 'student', 'North South'),
(10014, 'Ayesha Siddique', 'ayesha.siddique@email.com', 'Media Studies', 'Ayesha', 'student', 'IUB'),
(10015, 'Imran Ali', 'imran.ali@email.com', 'Software Engineering', 'Imran', 'student', 'AIUB'),
(10016, 'Rina Sultana', 'rina.sultana@email.com', 'Political Science', 'Rina', 'student', 'BRAC'),
(10017, 'Nazmul Haque', 'nazmul.haque@email.com', 'Finance', 'Nazmul', 'student', 'North South'),
(10018, 'Anika Khan', 'anika.khan@email.com', 'International Relations', 'Anika', 'student', 'IUB'),
(10019, 'Shahidul Islam', 'shahidul.islam@email.com', 'Mechanical Engineering', 'Shahidul', 'student', 'AIUB'),
(10020, 'Lamia Akter', 'lamia.akter@email.com', 'Biotechnology', 'Lamia', 'student', 'BRAC'),
(10021, 'masum billah', 'masum@email.com', 'Chinese', 'masum', 'student', 'University of Dhaka'),
(22334456, 'Raja Mia RAj', 'Raja.Mia@northsouth.edu', 'ECE', 'raja', 'student', 'North South'),
(2231018642, 'Md. Mofidul Hassan', 'mofidul.hassan@northsouth.edu', 'ECE', 'mofid', 'student', 'North South');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `university_name` varchar(100) NOT NULL,
  `initial` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `dept`, `university_name`, `initial`) VALUES
(101, 'Muhammad Safayet', 'ECE', 'North South', 'MUO'),
(102, 'Muhammad Elahi', 'ECE', 'IUB', 'MLE'),
(104, 'Mehedi Pobitro', 'English', 'BRAC', 'ad'),
(105, 'Silvia', 'ECE', 'North South', 'MPA'),
(20001, 'Dr. Arif Rahman', 'Computer Science', 'North South', 'AR01'),
(20002, 'Prof. Nabila Chowdhury', 'Business Administration', 'IUB', 'NC02'),
(20003, 'Dr. Rakib Hossain', 'Electrical Engineering', 'AIUB', 'RH03'),
(20004, 'Prof. Sadia Jahan', 'Law', 'BRAC', 'SJ04'),
(20005, 'Dr. Tareq Ahmed', 'Pharmacy', 'North South', 'TA05'),
(20006, 'Prof. Mehnaz Rahman', 'Environmental Science', 'IUB', 'MR06'),
(20007, 'Dr. Samiul Haque', 'Mathematics', 'AIUB', 'SH07'),
(20008, 'Prof. Farhana Sultana', 'Accounting', 'BRAC', 'FS08'),
(20009, 'Dr. Nafis Chowdhury', 'Marketing', 'North South', 'NC09'),
(20010, 'Prof. Tania Begum', 'Architecture', 'IUB', 'TB10'),
(200024, 'Md Ishan Arefin Hoissain', 'ECE', 'North South', 'IAH');

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `c_code` varchar(50) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`c_code`, `t_id`) VALUES
('cse215', 101),
('CSE101', 20001),
('CSE102', 20002),
('CSE103', 20003),
('CSE104', 20004),
('CSE201', 20005),
('CSE202', 20006),
('CSE203', 20007),
('CSE204', 20008),
('CSE301', 20009),
('CSE302', 20010),
('CSE303', 20001),
('CSE304', 20002),
('CSE305', 20003),
('CSE306', 20004),
('CSE401', 20005),
('CSE402', 20006),
('CSE403', 20007),
('CSE404', 20008),
('CSE405', 20009),
('CSE406', 20010);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `location`) VALUES
(1, 'North South', 'Bashundhara, Dhaka'),
(2, 'IUB', 'Bashundhara, Dhaka'),
(3, 'AIUB', 'Bashundhara, Dhaka'),
(4, 'BRAC', ' Mohakhali'),
(8, 'University of Dhaka', 'Shahbagh'),
(9, 'Bangladesh University of Engineering and Technology (BUET)', 'Palashi'),
(10, 'United International University', 'Dhanmondi'),
(11, 'American International University-Bangladesh (AIUB)', 'Banani'),
(12, 'East West University', 'Aftabnagar'),
(13, 'University of Liberal Arts Bangladesh', 'Dhanmondi'),
(14, 'Stamford University Bangladesh', 'Siddheswari'),
(15, 'Ahsanullah University of Science and Technology', 'Tejgaon'),
(16, 'Primeasia University', 'Banani'),
(17, 'Southeast University', 'Tejgaon'),
(18, 'Daffodil International University', 'Dhanmondi'),
(19, 'Bangladesh University', 'Mohammadpur'),
(20, 'State University of Bangladesh', 'Dhanmondi'),
(21, 'Green University of Bangladesh', 'Mirpur'),
(22, 'Uttara University', 'Uttara'),
(23, 'World University of Bangladesh', 'Dhanmondi'),
(24, 'Asian University of Bangladesh', 'Uttara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `fk_review` (`review_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teacher` (`t_id`),
  ADD KEY `fk_student` (`s_id`),
  ADD KEY `fk_courses` (`course_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`,`university_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_unis` (`university_name`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `initial` (`initial`),
  ADD KEY `fk_unit` (`university_name`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD KEY `fk_teaches_course` (`c_code`),
  ADD KEY `fk_teaches_teacher` (`t_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_review` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_courses` FOREIGN KEY (`course_name`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`s_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_unis` FOREIGN KEY (`university_name`) REFERENCES `university` (`name`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_unit` FOREIGN KEY (`university_name`) REFERENCES `university` (`name`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `fk_teaches_course` FOREIGN KEY (`c_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_teaches_teacher` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
