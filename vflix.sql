-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 11:09 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actor_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`actor_id`, `name`) VALUES
(1, 'Leonardo di Caprio'),
(2, 'Park Hoon'),
(3, 'Shin Sia'),
(4, 'Park Eun-bin'),
(5, 'Seo Eun-Soo'),
(6, 'Takuya Eguchi'),
(7, 'Saori Hayami'),
(8, 'Atsumi Tanezaki');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('05djpvfhbv363ivb27sc480qiott4j97', '::1', 1667657631, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373635373633313b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2231223b6c6f67696e5f747970657c733a313a2231223b),
('07ib97h38pv8phc57updu3oin8c5qhrd', '::1', 1667667095, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636373039353b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('0ln6ab4ln13bc9b6fk4bqi8gbp3lkchg', '::1', 1667665944, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636353934343b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('0nqg7rpglk5g4u1hui9n0ro7bc4hkb09', '::1', 1667725939, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732353933393b),
('2e7gja49ksmu89erco3rqo3j3rdmr12q', '::1', 1667664690, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636343639303b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('4f0pdhhs9u3jo17ktssrhk3bra7pfgcc', '::1', 1667723239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732333233393b),
('5bh60h1o6n2vu9fju9meme31vktu93g8', '::1', 1667656999, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373635363939393b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2231223b6c6f67696e5f747970657c733a313a2231223b),
('66uel2fmn0n32c3vc0d6lbkfq71mkfu4', '::1', 1667720549, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732303534393b),
('6pi122f76am0o3n9ol6src799t8t9j88', '::1', 1667666683, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636363638333b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('7ah4dn13rldu17ouq06uaag8etpccbo0', '::1', 1667720187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732303138373b),
('91cp55avetqibikt3i98uj0gdln1kmqu', '::1', 1667727523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732373333313b),
('91seca1mosqch5ves2rjqr8s4n71n135', '::1', 1667722763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732323736333b),
('9iiduv0it21i36ok40um0n9t447cceeo', '::1', 1667721189, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732313138393b),
('a7n167m1cn75qn52trhpsb6jfbtl6eqr', '::1', 1667663994, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636333939343b),
('ac1g43gpehm2pbvcp2o79f7vrlvkjrn2', '::1', 1667665291, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636353239313b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('bnhbupimn6htgd537g1a31r9kpi058vl', '::1', 1667664299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636343239393b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('bvoe34keg0c1gdm45rn3427758bq55e0', '::1', 1667724311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732343331313b),
('c0rbfo5f0kucf7esgf8ikodhf090rm4m', '::1', 1667725070, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732353037303b),
('c183hcm4b8qhagjjlglasv4507te7bhj', '::1', 1667721908, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732313930383b),
('d9eei5mlp9ip3vt0ing6a8u7k340d2rm', '::1', 1667789205, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373738393230353b),
('eoa0j14ohgh11nvm0f8cjtt9piiq65f9', '::1', 1667722585, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732323538353b),
('fe0rjafthudk1flm7dj6tsnu0vhkil6i', '::1', 1667667219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636373039353b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('ftc5dek7np6sv51eau6673hv7k6v686g', '::1', 1667726312, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732363331323b),
('fu02g7bkjqjrjllv732cc7otcl3c2itu', '::1', 1667725372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732353337323b),
('g1gqodccg5ltm7934r8spip9ocsbu47n', '::1', 1667726986, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732363938363b),
('gdqmpvq30gk4f7j2h9hgusrtbquf43qk', '::1', 1667662555, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636323535353b),
('gk8c585s43slsgg44g9f7eb64694lf2h', '::1', 1667666307, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636363330373b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('ha14d8cbl01feef976rephko83adup2l', '::1', 1667658236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373635383233363b),
('hlea6iee2rn62snpav0o0g30oekbbl9p', '::1', 1667662994, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636323939343b),
('i01d6t8ukk95ac13a7kqqlpugoih4cpt', '::1', 1667722237, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732323233373b),
('iim8ps1qmupafdfo85cj41vnt74dla37', '::1', 1667726645, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732363634353b),
('jai4501n0ml4b1fo80bodhljsdc0raf9', '::1', 1667723937, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732333933373b),
('k50i8s0dkqf9q5sjfnug9uvdtkh9sen6', '::1', 1667790028, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373739303032383b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2231223b6c6f67696e5f747970657c733a313a2231223b),
('kh33qid7jao2g1kfbrss39eik9c3ac44', '::1', 1667727331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732373333313b),
('mib0t9gnomti6a70uj6fdir6gui6ho6p', '::1', 1667787927, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373738373932373b),
('nqi312tukbmekan2akm0u1od5v929cuu', '::1', 1667665643, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636353634333b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2235223b6c6f67696e5f747970657c733a313a2230223b6163746976655f757365727c733a353a227573657231223b757365725f656e746572696e675f74696d657374616d707c693a313636373636343033323b),
('o0psbtqrr6sfcbstih42o20qkv5djej4', '::1', 1667720882, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732303838323b),
('p4frgbks5nhuhog6eacep2ilc4vd90r4', '::1', 1667788302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373738383330323b),
('p7rf0osa4aa6ld3eg578t3nm9slc4uoq', '::1', 1667790028, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373739303032383b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2231223b6c6f67696e5f747970657c733a313a2231223b),
('pbq96nmn35f5cua395mpbqfnree6odcf', '::1', 1667663342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636333334323b),
('q7os8the8p51hsrkcinhbg9646ml52tl', '::1', 1667663672, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373636333637323b),
('rurpveop3kdiv8f71l67v3e7qj3978nc', '::1', 1667788720, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373738383732303b),
('tn6bd5pssdifqntt3cvm6qmj5fln6u7t', '::1', 1667721523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732313532333b),
('tu64vrmuqdv31af5fmf2lgqf47k42l4g', '::1', 1667789686, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373738393638363b),
('uom7ec4pubn3mqgk5fd0irbvenpu2vo7', '::1', 1667723628, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373732333632383b),
('uscr2vgfr7357q37b7ihu4l539jadrug', '::1', 1667657710, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373635373731303b),
('v8jrjmh4c8e4lk9d14kun5285shfq3jn', '::1', 1667657309, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636373635373330393b757365725f6c6f67696e5f7374617475737c733a313a2231223b757365725f69647c733a313a2231223b6c6f67696e5f747970657c733a313a2231223b);

-- --------------------------------------------------------

--
-- Table structure for table `episode`
--

CREATE TABLE `episode` (
  `episode_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `episode`
--

INSERT INTO `episode` (`episode_id`, `season_id`, `title`, `url`) VALUES
(1, 1, 'Episode #1', 'http://localhost/assets/videos/readyforlove.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` longtext COLLATE utf8_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `name`) VALUES
(1, 'Комеди'),
(2, 'Адал явдалт'),
(3, 'Action'),
(5, 'Гэмт хэрэг'),
(6, 'Баримтат'),
(7, 'Драм'),
(8, 'Гэр бүл, хүүхийн'),
(9, 'Уран зөгнөлт'),
(10, 'Түүхэн'),
(11, 'Аймшгийн'),
(12, 'Нууцлаг'),
(13, 'Романс'),
(14, 'Шинжлэх ухааны'),
(15, 'Триллер'),
(16, 'Дайн байлдаан'),
(17, 'Тулаант'),
(18, 'Вестерн');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description_short` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description_long` longtext COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `actors` longtext COLLATE utf8_unicode_ci NOT NULL,
  `featured` int(11) NOT NULL,
  `kids_restriction` int(11) NOT NULL DEFAULT 0,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_id`, `title`, `description_short`, `description_long`, `year`, `rating`, `genre_id`, `actors`, `featured`, `kids_restriction`, `url`) VALUES
(1, 'BlackPink', 'Black pink', 'Black pink Black pink Black pink Black pink Black pink Black pink Black pink Black pink ', 2022, 5, 2, '[\"1\"]', 1, 0, 'http://localhost/assets/videos/asifitsyourlast.mp4'),
(2, 'Witch 2', '', 'A girl wakes up in a huge secret laboratory, then accidentally meets another girl who is trying to protect her house from a gang. The mystery girl overthrows the gang with her unexpected powers, and laboratory staff set out to find her.', 2022, 5, 1, '[\"2\",\"3\",\"4\",\"5\"]', 1, 0, 'http://localhost/assets/videos/readyforlove.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `screens` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 active, 0 inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `name`, `screens`, `price`, `status`) VALUES
(1, '1 сар', '1', '5000', 1),
(2, '2 сар', '1', '10000', 1),
(3, '3 сар', '1', '15000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `season`
--

CREATE TABLE `season` (
  `season_id` int(11) NOT NULL,
  `series_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `season`
--

INSERT INTO `season` (`season_id`, `series_id`, `name`) VALUES
(1, 1, 'Season 1');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `series_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description_short` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description_long` longtext COLLATE utf8_unicode_ci NOT NULL,
  `genre_id` int(11) NOT NULL,
  `actors` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'comma separated actor_id',
  `year` int(11) NOT NULL,
  `rating` int(11) DEFAULT 5,
  `featured` int(11) NOT NULL,
  `kids_restriction` int(11) NOT NULL,
  `episodes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`series_id`, `title`, `description_short`, `description_long`, `genre_id`, `actors`, `year`, `rating`, `featured`, `kids_restriction`, `episodes`, `type`) VALUES
(1, 'Demon Slayer', 'Demon Slayer: It follows teenage Tanjiro Kamado, who strives to become a demon slayer after his family was slaughtered and his younger sister, Nezuko, turned into a demon. ', 'Demon Slayer: Kimetsu no Yaiba is a Japanese manga series written and illustrated by Koyoharu Gotouge. It follows teenage Tanjiro Kamado, who strives to become a demon slayer after his family was slaughtered and his younger sister, Nezuko, turned into a demon. ', 1, '[]', 2019, 5, 0, 0, '', 2),
(2, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(3, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(4, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(5, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 2),
(6, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(7, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(8, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(9, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 2),
(10, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(11, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(12, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 2),
(13, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(14, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(15, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(16, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(17, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(18, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(19, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(20, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(21, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(22, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(23, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(24, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(25, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 2),
(26, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(27, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(28, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(29, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1),
(30, 'SPY x FAMILY', '', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head! Not one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn’t know is that …', 1, '[\"6\",\"7\",\"8\"]', 2022, NULL, 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'site_name', 'Videoflix'),
(2, 'site_email', ''),
(3, 'paypal_merchant_email', ''),
(4, 'invoice_address', ''),
(5, 'language', 'english'),
(6, 'purchase_code', ''),
(7, 'privacy_policy', ''),
(8, 'refund_policy', '');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price_amount` int(11) NOT NULL,
  `paid_amount` float NOT NULL,
  `timestamp_from` int(11) NOT NULL,
  `timestamp_to` int(11) NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 active, 0 cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `plan_id`, `user_id`, `price_amount`, `paid_amount`, `timestamp_from`, `timestamp_to`, `payment_method`, `payment_details`, `payment_timestamp`, `status`) VALUES
(1, 2, 2, 0, 5000, 1666943132, 1669538732, 'bank', '--', 1666943132, 1),
(2, 2, 5, 0, 10000, 1667355664, 1669947664, 'bank', '--', 1667355664, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 admin, 0 customer',
  `name` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user1` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user 1',
  `user1_session` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user1_movielist` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user1_serieslist` longtext COLLATE utf8_unicode_ci NOT NULL,
  `plan_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 banned',
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `verified_timestamp` timestamp NULL DEFAULT NULL,
  `otp` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `type`, `name`, `phone`, `email`, `password`, `user1`, `user1_session`, `user1_movielist`, `user1_serieslist`, `plan_id`, `status`, `verified`, `verified_timestamp`, `otp`) VALUES
(1, 1, 'Mr. Admin', 98950575, 'admin@neontoon.mn', 'c9d8bba5244022fabf59d0aa7a5edf0dfbf51338', '', '', '', '', 0, 1, 1, NULL, NULL),
(5, 0, 'Aagii', 86950575, NULL, 'c9d8bba5244022fabf59d0aa7a5edf0dfbf51338', 'user 1', '1667722744', '[1, 5, 8]', '', 0, 1, 2, '0000-00-00 00:00:00', '3611');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`episode_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`season_id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`series_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `episode`
--
ALTER TABLE `episode`
  MODIFY `episode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `season`
--
ALTER TABLE `season`
  MODIFY `season_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `series_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
