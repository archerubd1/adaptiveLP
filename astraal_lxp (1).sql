-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2026 at 12:36 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astraal_lxp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adaptive_recommendations`
--

CREATE TABLE `adaptive_recommendations` (
  `learner_id` int(11) DEFAULT NULL,
  `recommendation_type` varchar(50) DEFAULT NULL,
  `recommendation_text` text,
  `rank_score` float DEFAULT NULL,
  `rationale` text,
  `generated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adaptive_recommendations`
--

INSERT INTO `adaptive_recommendations` (`learner_id`, `recommendation_type`, `recommendation_text`, `rank_score`, `rationale`, `generated_on`) VALUES
(1, 'pathway', 'Advanced Skill Module', 0.513603, 'High readiness', '2026-02-14 11:52:08'),
(1, 'pathway', 'Collaborative Project Sprint', 0.462243, 'Low collaboration exposure', '2026-02-14 11:52:08'),
(1, NULL, 'Master Advanced PHP Architecture', 0.95, 'Ready for Object-Oriented patterns.', '2026-02-16 14:00:23'),
(1, NULL, 'Master Advanced PHP Architecture', 0.95, 'Ready for Object-Oriented patterns.', '2026-02-16 19:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `icon` varchar(50) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `icon`, `color`, `level`) VALUES
(1, 'Java Mastery', 'Object-Oriented Programming and Backend logic.', 'bx-code-curly', 'blue', 'Advanced'),
(2, 'Python Pro', 'Data structures and script automation.', 'bx-terminal', 'purple', 'Intermediate'),
(3, 'SQL & MongoDB', 'Relational and NoSQL database management.', 'bx-data', 'emerald', 'Intermediate'),
(4, 'Web Stack (HTML/CSS/JS)', 'Front-end architecture and interactivity.', 'bx-window-alt', 'blue', 'Beginner'),
(5, 'C/C++ Systems', 'Low-level programming and memory management.', 'bx-chip', 'purple', 'Hard'),
(6, 'Operating Systems', 'Kernel logic, processes, and threading.', 'bx-cog', 'emerald', 'Expert'),
(7, 'Computer Networks', 'TCP/IP, protocols, and network security.', 'bx-rss', 'blue', 'Intermediate');

-- --------------------------------------------------------

--
-- Table structure for table `course_modules`
--

CREATE TABLE `course_modules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `level_name` varchar(50) DEFAULT NULL,
  `topic_title` varchar(255) DEFAULT NULL,
  `topic_description` text,
  `order_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_modules`
--

INSERT INTO `course_modules` (`id`, `course_id`, `level_name`, `topic_title`, `topic_description`, `order_num`) VALUES
(1, 1, 'Beginner', 'Introduction to JVM', 'Understanding how Java runs on different platforms.', 1),
(2, 1, 'Beginner', 'Variables & Data Types', 'Mastering int, double, String, and Boolean.', 2),
(3, 1, 'Intermediate', 'Object-Oriented Programming', 'Classes, Objects, Inheritance, and Polymorphism.', 3),
(4, 1, 'Advanced', 'Multi-threading & Streams', 'Concurrency and functional programming in Java.', 4),
(5, 2, 'Beginner', 'Python Setup & Syntax', 'Installing Python, VS Code, and writing your first Hello World script.', 1),
(6, 2, 'Beginner', 'Control Flow & Logic', 'Mastering if-statements, for-loops, and while-loops.', 2),
(7, 2, 'Intermediate', 'Data Structures Pro', 'Deep dive into Lists, Dictionaries, Tuples, and Sets.', 3),
(8, 2, 'Intermediate', 'Functions & Modules', 'Writing reusable code and importing external libraries like Math or Random.', 4),
(9, 2, 'Advanced', 'Object-Oriented Python', 'Building real-world applications using Classes, Methods, and Inheritance.', 5),
(10, 2, 'Advanced', 'File Handling & APIs', 'Reading/Writing files and connecting Python to the web using Requests.', 6),
(11, 3, 'Beginner', 'Relational Database Basics', 'Understanding tables, rows, columns, and Primary Keys.', 1),
(12, 3, 'Beginner', 'SQL Fundamentals', 'Mastering SELECT, WHERE, and ORDER BY queries.', 2),
(13, 3, 'Intermediate', 'Joining Tables', 'Connecting data using INNER, LEFT, and RIGHT JOINs.', 3),
(14, 3, 'Intermediate', 'Introduction to MongoDB', 'Understanding NoSQL, collections, and JSON-like documents.', 4),
(15, 3, 'Advanced', 'Advanced Aggregations', 'Grouping data and using MongoDB aggregation pipelines.', 5),
(16, 3, 'Advanced', 'Database Architecture', 'Designing efficient schemas for both SQL and NoSQL environments.', 6),
(17, 6, 'Beginner', 'OS Fundamentals', 'Role of the OS, Kernels vs. Shells, and Booting process.', 1),
(18, 6, 'Beginner', 'Process Management', 'Understanding Processes, Threads, and Lifecycle states.', 2),
(19, 6, 'Intermediate', 'Memory Management', 'Paging, Segmentation, and Virtual Memory allocation.', 3),
(20, 6, 'Intermediate', 'CPU Scheduling', 'Algorithms like Round Robin, First-Come-First-Served, and Priority.', 4),
(21, 6, 'Advanced', 'Concurrency & Deadlocks', 'Synchronization, Semaphores, and preventing system lockups.', 5),
(22, 6, 'Advanced', 'File Systems & Security', 'Disk structures, I/O management, and Kernel-level protection.', 6),
(23, 7, 'Beginner', 'Network Basics', 'Types of networks (LAN/WAN) and Network Topologies.', 1),
(24, 7, 'Beginner', 'The OSI Model', 'Deep dive into the 7 layers of network communication.', 2),
(25, 7, 'Intermediate', 'TCP/IP Protocol Suite', 'Understanding IP addressing, Subnetting, and Port numbers.', 3),
(26, 7, 'Intermediate', 'Routing & Switching', 'How routers move data packets and switches manage traffic.', 4),
(27, 7, 'Advanced', 'Network Security', 'Firewalls, VPNs, Encryption (SSL/TLS), and common attacks.', 5),
(28, 7, 'Advanced', 'Cloud Networking', 'Introduction to DNS, CDN, and modern Cloud architectures.', 6),
(29, 4, 'Beginner', 'HTML5 Semantic Structure', 'Building accessible web pages using headers, navs, and sections.', 1),
(30, 4, 'Beginner', 'CSS3 Styling & Layouts', 'Mastering colors, fonts, and the Box Model.', 2),
(31, 4, 'Intermediate', 'Responsive Design', 'Using Flexbox, CSS Grid, and Media Queries for mobile-first sites.', 3),
(32, 4, 'Intermediate', 'JavaScript Essentials', 'Variables, DOM manipulation, and handling user events (clicks/inputs).', 4),
(33, 4, 'Advanced', 'Modern JS & ES6+', 'Arrow functions, Promises, Async/Await, and API fetching.', 5),
(34, 4, 'Advanced', 'Build Tools & Frameworks', 'Introduction to NPM, Webpack, and the basics of React or Vue.', 6),
(35, 5, 'Beginner', 'Low-Level Syntax', 'C basics, data types, and compiling with GCC.', 1),
(36, 5, 'Beginner', 'Memory Addresses & Pointers', 'Understanding how variables are stored in RAM.', 2),
(37, 5, 'Intermediate', 'Dynamic Memory Allocation', 'Mastering malloc(), free(), and the Heap vs. Stack.', 3),
(38, 5, 'Intermediate', 'OOP in C++', 'Classes, Objects, and the "this" pointer.', 4),
(39, 5, 'Advanced', 'Advanced Data Structures', 'Building Linked Lists, Stacks, and Queues from scratch.', 5),
(40, 5, 'Advanced', 'Systems Programming', 'File descriptors, system calls, and interacting with the Kernel.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_overrides`
--

CREATE TABLE `faculty_overrides` (
  `override_id` int(11) NOT NULL,
  `learner_id` int(11) DEFAULT NULL,
  `original_recommendation` text,
  `overridden_recommendation` text,
  `reason` text,
  `overridden_by` int(11) DEFAULT NULL,
  `overridden_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `learner_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`learner_id`, `name`, `email`, `created_on`) VALUES
(1, 'Sinchana', 'test@astraal.edu', '2026-02-16 13:57:08'),
(2, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-16 21:08:01'),
(3, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-16 21:08:43'),
(4, 'sinchana poojari', 'psinchana867@gmail.com', '2026-02-17 11:03:34'),
(5, 'sham', 'sudeep123@gmail.com', '2026-02-17 11:10:34'),
(6, 'sham', 'sudeep123@gmail.com', '2026-02-17 11:36:29'),
(7, 'sham', 'sudeep123@gmail.com', '2026-02-17 11:37:45'),
(8, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-17 12:05:13'),
(9, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-19 10:08:19'),
(10, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-19 10:08:29'),
(11, 'Srushti', 'sru@gmail.com', '2026-02-19 12:50:09'),
(12, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-19 13:29:58'),
(13, 'sinchana poojari', 'sinchanapoo.com@gmail.com', '2026-02-20 11:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `learner_journey_state`
--

CREATE TABLE `learner_journey_state` (
  `learner_id` int(11) NOT NULL,
  `skill_maturity` decimal(5,2) DEFAULT '0.00',
  `thinking_complexity` decimal(5,2) DEFAULT '0.00',
  `collaboration_index` decimal(5,2) DEFAULT '0.00',
  `milestone_progress` decimal(5,2) DEFAULT '0.00',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learner_journey_state`
--

INSERT INTO `learner_journey_state` (`learner_id`, `skill_maturity`, `thinking_complexity`, `collaboration_index`, `milestone_progress`, `last_updated`) VALUES
(1, '1.24', '0.65', '0.45', '0.00', '2026-02-20 12:33:57'),
(2, '0.10', '0.10', '0.10', '0.00', '2026-02-16 15:38:01'),
(3, '0.10', '0.10', '0.10', '0.00', '2026-02-16 15:38:43'),
(4, '0.10', '0.10', '0.10', '0.00', '2026-02-17 05:33:34'),
(5, '0.19', '0.10', '0.10', '0.00', '2026-02-17 05:48:05'),
(6, '0.10', '0.10', '0.10', '0.00', '2026-02-17 06:06:29'),
(7, '0.13', '0.10', '0.10', '0.00', '2026-02-17 06:16:50'),
(8, '0.10', '0.10', '0.10', '0.00', '2026-02-17 06:35:13'),
(9, '0.10', '0.10', '0.10', '0.00', '2026-02-19 04:38:19'),
(10, '0.40', '0.10', '0.10', '0.00', '2026-02-19 06:56:14'),
(11, '0.10', '0.10', '0.10', '0.00', '2026-02-19 07:20:09'),
(12, '0.12', '0.10', '0.10', '0.00', '2026-02-19 08:02:12'),
(13, '0.10', '0.10', '0.10', '0.00', '2026-02-20 05:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `learner_projects`
--

CREATE TABLE `learner_projects` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `code_content` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learner_projects`
--

INSERT INTO `learner_projects` (`id`, `learner_id`, `project_name`, `language`, `code_content`, `created_at`) VALUES
(1, 1, 'hello.py', 'python', NULL, '2026-02-20 12:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `learning_events`
--

CREATE TABLE `learning_events` (
  `event_id` int(11) NOT NULL,
  `learner_id` int(11) DEFAULT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `event_value` float DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `language_used` varchar(50) DEFAULT 'php'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learning_events`
--

INSERT INTO `learning_events` (`event_id`, `learner_id`, `event_type`, `event_value`, `source`, `created_on`, `language_used`) VALUES
(1, 2, 'USER_REGISTERED', NULL, NULL, '2026-02-16 21:08:01', 'php'),
(2, 3, 'USER_REGISTERED', NULL, NULL, '2026-02-16 21:08:43', 'php'),
(3, 1, 'USER_LOGIN', NULL, NULL, '2026-02-16 21:10:40', 'php'),
(4, 4, 'USER_REGISTERED', NULL, NULL, '2026-02-17 11:03:34', 'php'),
(5, 5, 'USER_REGISTERED', NULL, NULL, '2026-02-17 11:10:34', 'php'),
(6, 5, 'CHALLENGE_PASSED', NULL, NULL, '2026-02-17 11:17:49', 'php'),
(7, 5, 'CHALLENGE_PASSED', NULL, NULL, '2026-02-17 11:17:58', 'php'),
(8, 5, 'CHALLENGE_PASSED', NULL, NULL, '2026-02-17 11:18:05', 'php'),
(9, 6, 'USER_REGISTERED', NULL, NULL, '2026-02-17 11:36:29', 'php'),
(10, 7, 'USER_REGISTERED', NULL, NULL, '2026-02-17 11:37:45', 'php'),
(11, 7, 'CHALLENGE_PASSED', NULL, NULL, '2026-02-17 11:46:50', 'php'),
(12, 8, 'USER_REGISTERED', NULL, NULL, '2026-02-17 12:05:13', 'php'),
(13, 9, 'USER_REGISTERED', NULL, NULL, '2026-02-19 10:08:19', 'php'),
(14, 10, 'USER_REGISTERED', NULL, NULL, '2026-02-19 10:08:29', 'php'),
(15, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 10:27:57', 'php'),
(16, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 10:51:53', 'php'),
(17, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 10:53:23', 'php'),
(18, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 10:54:23', 'php'),
(19, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 10:57:58', 'php'),
(20, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 10:59:43', 'php'),
(21, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:00:43', 'php'),
(22, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:01:43', 'php'),
(23, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:02:43', 'php'),
(24, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:03:57', 'php'),
(25, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:04:57', 'php'),
(26, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:05:57', 'php'),
(27, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:11:41', 'php'),
(28, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:12:41', 'php'),
(29, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:13:41', 'php'),
(30, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:27:22', 'php'),
(31, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:28:22', 'php'),
(32, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:32:51', 'php'),
(33, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:33:51', 'php'),
(34, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 11:58:07', 'php'),
(35, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:02:26', 'php'),
(36, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:03:26', 'php'),
(37, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:04:26', 'php'),
(38, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:05:26', 'php'),
(39, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:06:26', 'php'),
(40, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:09:02', 'php'),
(41, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:12:11', 'php'),
(42, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:15:21', 'php'),
(43, 10, 'SANDBOX_TIME_BOOST', NULL, NULL, '2026-02-19 12:17:25', 'php'),
(44, 10, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 12:26:14', 'python'),
(45, 1, 'USER_LOGIN', NULL, NULL, '2026-02-19 12:37:38', 'php'),
(46, 11, 'USER_REGISTERED', NULL, NULL, '2026-02-19 12:50:09', 'php'),
(47, 12, 'USER_REGISTERED', NULL, NULL, '2026-02-19 13:29:58', 'php'),
(48, 12, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 13:31:12', 'php'),
(49, 12, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 13:32:12', 'php'),
(50, 1, 'USER_LOGIN', NULL, NULL, '2026-02-19 18:57:39', 'php'),
(51, 1, 'USER_LOGIN', NULL, NULL, '2026-02-19 19:25:58', 'php'),
(52, 1, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 19:45:03', 'c'),
(53, 1, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 19:46:03', 'c'),
(54, 1, 'USER_LOGIN', NULL, NULL, '2026-02-19 20:53:44', 'php'),
(55, 1, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 20:55:02', 'python'),
(56, 1, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-19 20:56:34', 'python'),
(57, 1, 'USER_LOGIN', NULL, NULL, '2026-02-20 09:53:17', 'php'),
(58, 13, 'USER_REGISTERED', NULL, NULL, '2026-02-20 11:12:48', 'php'),
(59, 1, 'USER_LOGIN', NULL, NULL, '2026-02-20 13:24:59', 'php'),
(60, 1, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-20 13:25:32', 'python'),
(61, 1, 'TIME_BASED_PRACTICE', NULL, NULL, '2026-02-20 13:26:02', 'python'),
(62, 1, 'USER_LOGIN', NULL, NULL, '2026-02-20 17:39:28', 'php');

-- --------------------------------------------------------

--
-- Table structure for table `module_content`
--

CREATE TABLE `module_content` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `content_body` text,
  `code_example` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_modules`
--
ALTER TABLE `course_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `faculty_overrides`
--
ALTER TABLE `faculty_overrides`
  ADD PRIMARY KEY (`override_id`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`learner_id`);

--
-- Indexes for table `learner_journey_state`
--
ALTER TABLE `learner_journey_state`
  ADD PRIMARY KEY (`learner_id`);

--
-- Indexes for table `learner_projects`
--
ALTER TABLE `learner_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning_events`
--
ALTER TABLE `learning_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `module_content`
--
ALTER TABLE `module_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `faculty_overrides`
--
ALTER TABLE `faculty_overrides`
  MODIFY `override_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `learner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `learner_projects`
--
ALTER TABLE `learner_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `learning_events`
--
ALTER TABLE `learning_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `module_content`
--
ALTER TABLE `module_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_modules`
--
ALTER TABLE `course_modules`
  ADD CONSTRAINT `course_modules_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `module_content`
--
ALTER TABLE `module_content`
  ADD CONSTRAINT `module_content_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `course_modules` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
