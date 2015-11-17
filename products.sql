-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2015 at 11:37 PM
-- Server version: 5.6.23
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `veblo0_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subcategory`, `name`, `image`, `price`, `description`) VALUES
(3, 4, 0, 'Popcorn Machine', '', '30.00', 'It makes popcorn for about 100 people'),
(4, 4, 1, 'DJ aPATEL', '', '100.00', 'It was the only DJ we could find that would fit in a box.'),
(6, 4, 2, 'Photobooth', '', '100.00', ''),
(7, 4, 2, 'Photographer', '', '60.00', ''),
(9, 4, 0, 'Cotton Candy Machine', '', '30.00', ''),
(11, 3, -1, 'Masquerade ', '', '-1.00', 'A masquerade party allows attendees to experience new things, including adopting new—and anonymous—dress and exploring potentially forbidden worlds. And the best part is, you are a complete mystery to all attendees making you the talk of the party. En'),
(12, 3, -1, '1920s', '', '-1.00', 'Want a party fit for Great Jay Gatsby himself? Then you’ve come to the right ready. Be ready to '),
(13, 3, -1, 'Beach theme', '', '-1.00', 'Sand, salt water, and communal filth are the perfect way to liven up your wild summer party! '),
(14, 3, -1, 'Winter Wonderland', '', '-1.00', 'The only thing people like at parties more than frigid temperatures are tacky Christmas references! '),
(15, 3, -1, 'Vegas themed', '', '-1.00', 'What happens in Vegas, stay in Vegas'),
(16, 3, -1, 'Mardi Gras', '', '-1.00', 'Why go to New Orleans when you can bring New Orleans to you? At Block Party, we have all your essentials needed to bring the Louisiana hype to your party. From crazy decorations to smooth jazz, our Mardi Gras Party are sure to please. Customizable packages ensure you get the exactly what you desire to make your event one of the best. '),
(17, 3, -1, 'Black tie event', '', '-1.00', 'Nothing screams party like the manifestation of outdated cultural norms into what should be a modern 21st century affair! '),
(18, 3, -1, 'Greek themed', '', '-1.00', 'Want your fraternity or sorority be known as the best greek house there is on campus? Want access to  amazing parties all year round? Well, get your greek on with our Greek themed party. From decorations that are fit for the gods, to '),
(19, 3, -1, 'Hawaiian Theme', '', '-1.00', 'It''s not cultural appropriation if they''re technically Americans! '),
(20, 3, -1, '50s themed', '', '-1.00', 'Everybody''s favorite decade! The one right after the end of WWII and the one immediately preceding the 60''s! '),
(23, 2, -1, 'Holiday', '', '80.38', 'Holiday themed decor'),
(24, 2, -1, 'Birthdays', '', '100.00', 'Birthdays are very important events, and at Block Party, we understand and are dedicated to making sure each party is memorable. For all ages, young and old, you are bound to find everything you need to make sure your party is extravagant. And with fast delivery and any last minute changes, we guarantee you’ll have a great event without all the planning hassle.\r\n-birthday cake \r\n-balloons\r\n-banner with age and name \r\n'),
(25, 2, -1, 'Religious Events ', '', '80.00', 'Religious events are very important events, and at Block Party, we understand and are dedicated to making sure each party is memorable. For all ages, young and old, you are bound to find everything you need to make sure your party is extravagant. And with fast delivery and any last minute changes, we guarantee you’ll have a great event without all the planning hassle.\r\n-solely tables and chairs\r\n'),
(26, 2, -1, 'Keynote speeches', '', '400.00', '-podium\r\n-one microphone (attached to the podium) and sound board\r\n'),
(27, 2, -1, 'Outdoor Events', '', '120.00', '-tent'),
(28, 2, -1, 'High School dance', '', '157.00', '-dj\r\n-lights'),
(29, 2, -1, 'InstaRave™', '', '164.22', '-dj\r\n-lights'),
(31, 4, 0, 'Snow-Cone Machine', '', '30.00', ''),
(33, 4, 0, 'Contracted Food (partnership with Sysco food distributor)', '', '-1.00', ''),
(34, 4, 1, 'Djs', '', '100.00', ''),
(35, 4, 1, 'Musical Performers (contact for additional info)', '', '-1.00', ''),
(36, 4, 1, 'Dance (contact for additional info)', '', '-1.00', ''),
(37, 4, 2, 'Photobooth', '', '100.00', ''),
(38, 4, 2, 'Photographer ', '', '60.00', ''),
(39, 4, 3, 'Wireless Mics (20/ea)', '', '20.00', '-comes with XLR \r\n-and mic stands '),
(40, 4, 3, 'In-line Mics (10/ea)', '', '10.00', '-comes with XLR \r\n-and mic stands '),
(41, 4, 3, 'Speakers ', '', '50.00', '-thru cable 1/4 inch\r\n-speaker cable 14 gauge '),
(42, 4, 3, 'Sound System', '', '45.00', '-comes with power supply\r\n-XLRs come with mics '),
(43, 4, 3, 'Screen', '', '30.00', '-structure'),
(44, 4, 4, 'Specialized lighting Lighting (contract with ADJ) we receive commission ', '', '-1.00', ''),
(45, 4, 5, 'Tents ', '', '60.00', '-wooden structure \r\n-tent anchors '),
(46, 4, 5, 'Tile flooring ', '', '50.00', ''),
(47, 4, 5, 'Wood flooring ', '', '50.00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
