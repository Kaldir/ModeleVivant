-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db706429770.db.1and1.com
-- Generation Time: Mar 06, 2018 at 10:30 PM
-- Server version: 5.5.59-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db706429770`
--

-- --------------------------------------------------------

--
-- Table structure for table `mv_ad`
--

CREATE TABLE IF NOT EXISTS `mv_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `town` varchar(50) NOT NULL,
  `county` int(11) NOT NULL,
  `location` text,
  `date_event` date DEFAULT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  KEY `id_user` (`id_user`),
  KEY `id_category_2` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `mv_ad`
--

INSERT INTO `mv_ad` (`id`, `id_category`, `id_user`, `title`, `town`, `county`, `location`, `date_event`, `content`, `creation_date`, `published`) VALUES
(21, 1, 9, 'Modèle féminin cherche poses', 'Limoges', 87, 'Vieille ville', '2018-03-22', 'Donec eu diam gravida dolor elementum posuere at at lectus. Nam sem nulla, luctus id tristique eu, elementum eu ex. In at rutrum tortor, a imperdiet magna.', '2018-03-06 22:18:36', 1),
(22, 2, 9, 'Cherche modèle pour cours avec professeur', 'Poitiers', 86, 'Ecole des beaux-arts', '2018-03-03', 'Cras sit amet turpis vestibulum, consectetur eros sit amet, aliquam elit.', '2018-03-06 22:20:42', 1),
(23, 1, 9, 'Cherche artiste pour pose visage', 'Montélimar', 7, 'Centre de la Blaiserie', '2018-03-25', 'Aliquam in mi eu ipsum malesuada vestibulum quis id elit. Duis venenatis metus lacus, ac viverra eros lacinia ac. Etiam varius augue accumsan diam vehicula iaculis.', '2018-03-06 22:25:00', 0),
(24, 3, 9, 'Happening de modèle !', 'Bruxelles', 99, 'Ecole des arts appliqués', '2018-03-26', 'Sed felis diam, porttitor non facilisis eu, laoreet quis augue. Etiam finibus nunc sed lorem placerat congue. ', '2018-03-06 22:26:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mv_category_ads`
--

CREATE TABLE IF NOT EXISTS `mv_category_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mv_category_ads`
--

INSERT INTO `mv_category_ads` (`id`, `name`) VALUES
(1, 'Cherche artiste'),
(2, 'Cherche modèle'),
(3, 'Evénement'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `mv_category_posts`
--

CREATE TABLE IF NOT EXISTS `mv_category_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mv_category_posts`
--

INSERT INTO `mv_category_posts` (`id`, `name`) VALUES
(1, 'Bonnes pratiques'),
(2, 'Expériences vécues'),
(3, 'Expériences rapportées');

-- --------------------------------------------------------

--
-- Table structure for table `mv_comment`
--

CREATE TABLE IF NOT EXISTS `mv_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `signalised` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`),
  KEY `id_post_2` (`id_post`),
  KEY `id_post_3` (`id_post`),
  KEY `id_user_2` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mv_post`
--

CREATE TABLE IF NOT EXISTS `mv_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_category` (`id_category`),
  KEY `id_category_2` (`id_category`),
  KEY `id_user_2` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `mv_post`
--

INSERT INTO `mv_post` (`id`, `id_user`, `id_category`, `title`, `content`, `creation_date`) VALUES
(10, 9, 1, 'Choisir son modèle', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Mauris in lacus congue, consectetur mauris in, molestie magna. Curabitur in neque venenatis, fermentum dolor quis, elementum quam. Praesent molestie volutpat interdum. Praesent ut erat a enim maximus varius eu at quam. Duis quam risus, molestie quis luctus et, sodales at justo. Phasellus vel venenatis enim. Mauris a mi ac nibh pulvinar iaculis at ut lectus. Morbi at massa purus. Maecenas sodales odio purus, at molestie lorem cursus a. Donec interdum euismod lacus, efficitur varius magna commodo in. Phasellus a sapien gravida, dictum erat quis, pharetra nibh. Morbi faucibus tellus ex, sed porttitor sem pulvinar ut. Cras ac sapien id magna scelerisque tincidunt at at erat.</span></p>', '2018-03-06 22:09:04'),
(11, 9, 1, 'Règles de respect mutuel', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Sed id commodo magna. Aliquam sodales sagittis ante, quis tincidunt augue dignissim eget. Praesent eros ante, faucibus et dapibus quis, hendrerit eu sapien. Quisque eu dui vel sem auctor porta. Curabitur et metus et sem dapibus luctus sed eget velit. Nam faucibus vestibulum ante, sit amet porta est ultrices ut. Donec congue eros ut luctus maximus. Curabitur ornare a nisl ac cursus. Morbi pharetra tortor massa, eget fermentum leo blandit sit amet. In tempus euismod mi quis lobortis. Nunc sit amet ante venenatis, consectetur felis vel, dictum nulla. Curabitur nulla mauris, pulvinar in dui ac, tristique posuere nulla.</span></p>', '2018-03-06 22:10:26'),
(12, 9, 1, 'Quel matériel prévoir ?', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Integer viverra aliquet velit vitae ullamcorper. Duis lobortis at ipsum sed efficitur. Praesent enim velit, rutrum at ipsum ac, euismod vehicula erat. Aliquam id purus eu turpis lacinia ornare. Mauris aliquam scelerisque pulvinar. Cras pharetra nunc id nisl aliquam ullamcorper. Nulla tempus nulla ut lorem scelerisque molestie.</span></p>', '2018-03-06 22:10:49'),
(13, 9, 2, 'Ma première séance...', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Aliquam a ante interdum, bibendum felis in, molestie lectus. Nam eu facilisis turpis. Pellentesque blandit justo massa, ut dapibus nibh dictum quis. Cras vitae erat quam. Phasellus interdum nisi non mauris blandit, at condimentum arcu porta. Cras vel eleifend risus. Quisque bibendum dolor ac sapien auctor lobortis. Etiam sit amet fringilla quam. Vestibulum consectetur, ipsum vitae lobortis accumsan, neque ipsum scelerisque ex, eget tristique erat urna vel ipsum.</span></p>', '2018-03-06 22:11:09'),
(14, 9, 2, 'Est ce que c''est vraiment fait pour moi ?', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Sed malesuada nunc neque, quis tempus tellus pellentesque at. Integer sagittis ullamcorper nulla. Morbi a dolor nisl. Etiam non dolor nisl. Quisque ac velit a urna laoreet eleifend. Vivamus viverra sem sit amet finibus faucibus. Pellentesque vitae volutpat turpis, sed aliquet ex. Aliquam nibh justo, luctus non bibendum sed, lacinia eu risus.</span></p>', '2018-03-06 22:11:46'),
(15, 9, 3, 'S''endormir en pleine pose...', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Suspendisse non ullamcorper odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse vehicula magna nec justo aliquam tempus. Ut dignissim semper purus, eget tincidunt lacus hendrerit et. In in leo augue. Maecenas vel ipsum orci. Phasellus nisl sem, sollicitudin eget finibus a, interdum fringilla ante. Aenean pharetra, ligula sit amet aliquet dictum, sapien nisi varius nunc, condimentum viverra est tellus eget enim. Vestibulum condimentum mauris sit amet nisl vestibulum pulvinar. Integer efficitur mauris sed enim ultricies tempus. Ut tempor ac velit sit amet auctor. Pellentesque sit amet lectus nunc.</span></p>', '2018-03-06 22:12:23'),
(16, 9, 1, 'Gérer la douleur', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Suspendisse potenti. Fusce et nulla vel ante tempor ullamcorper. Curabitur velit ante, feugiat non mauris sed, commodo sagittis enim. Etiam libero metus, euismod ac tellus non, ultricies aliquam nisl. Mauris et tortor pharetra orci laoreet cursus. In massa elit, bibendum sed posuere vel, condimentum eu nunc. Nulla vel dolor a mauris vestibulum faucibus. Ut non placerat nisi. Vestibulum pretium dignissim lacus, ullamcorper sodales augue vehicula at. Ut blandit sed nunc sit amet vulputate. Sed tristique consequat nulla nec dignissim. Pellentesque rutrum elit eu semper rutrum. In aliquet mi tortor, ac suscipit erat tincidunt id. Duis egestas tempor lacus, nec viverra nunc placerat pharetra. Donec ut volutpat lacus.</span></p>', '2018-03-06 22:12:52'),
(17, 9, 3, 'A quoi tu penses quand tu poses ?', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Vivamus tincidunt augue ultricies, lobortis est in, venenatis odio. Donec sit amet magna mi. In scelerisque rutrum malesuada. Vestibulum congue elit eget dignissim porttitor. Etiam massa eros, suscipit nec orci vel, viverra gravida orci. Praesent molestie mollis metus ac euismod. Etiam venenatis egestas aliquam. Nulla in pellentesque turpis, sed iaculis massa. Morbi vel dignissim diam. Aenean molestie blandit dolor sed suscipit. Cras condimentum turpis sed rhoncus lobortis.</span></p>', '2018-03-06 22:13:14'),
(18, 9, 1, 'Les étirements', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Nam vel nunc ut quam interdum iaculis. Fusce sodales lorem nec erat vestibulum, et lacinia urna dapibus. Nam viverra non turpis ac suscipit. Donec tellus purus, volutpat in tempus vel, dapibus ut felis. Nam tincidunt porttitor sem, vitae interdum nulla. Morbi id urna sem. Vestibulum ut diam ipsum. Mauris laoreet elit leo, eget placerat purus posuere efficitur. Vivamus consequat condimentum blandit. Praesent placerat lacinia urna, et suscipit justo convallis eu.</span></p>', '2018-03-06 22:14:12'),
(20, 9, 3, 'Les différents points de vue', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Donec faucibus faucibus pretium. Vestibulum nec purus vel lacus viverra ultrices cursus aliquam sapien. Praesent tristique iaculis consectetur. Integer in auctor enim, sed dictum nisl. Proin lacinia nibh vitae tortor placerat, a ultricies erat tincidunt. Aliquam urna leo, fermentum id lectus non, vestibulum vulputate tellus. In et quam laoreet, viverra urna id, tristique neque.</span></p>', '2018-03-06 22:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `mv_user`
--

CREATE TABLE IF NOT EXISTS `mv_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.png',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mv_user`
--

INSERT INTO `mv_user` (`id`, `admin`, `pseudo`, `mail`, `password`, `avatar`, `creation_date`) VALUES
(9, 1, 'Lucie', 'lulu@kldr.fr', '$2y$10$gPYl8lkx7Q04UBoSfXW5Ru3R1BL5SXSvDZjFO.zv9GswOdC50xh3K', 'default.png', '2018-03-01 08:31:47'),
(10, 0, 'Milo', 'kaladri@gmail.com', '$2y$10$NbjbJJHYgvt14sE2PLo44u/zFN3rYVMbGIgelImRVetBQRec4bkNC', 'default.png', '2018-03-06 15:02:59');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mv_ad`
--
ALTER TABLE `mv_ad`
  ADD CONSTRAINT `mv_ad_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `mv_category_ads` (`id`),
  ADD CONSTRAINT `mv_ad_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mv_comment`
--
ALTER TABLE `mv_comment`
  ADD CONSTRAINT `mv_comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `mv_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mv_comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`);

--
-- Constraints for table `mv_post`
--
ALTER TABLE `mv_post`
  ADD CONSTRAINT `mv_post_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `mv_category_posts` (`id`),
  ADD CONSTRAINT `mv_post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
