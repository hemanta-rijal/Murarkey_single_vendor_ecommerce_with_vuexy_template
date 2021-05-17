-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2020 at 10:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latest_single_vendor_ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL,
  `_rgt` int(10) UNSIGNED NOT NULL,
  `product_count` int(11) NOT NULL DEFAULT 0,
  `icon_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_chart` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `description`, `_lft`, `_rgt`, `product_count`, `icon_path`, `image_path`, `size_chart`) VALUES
(1, 'Home, Lights & Construction', 'home-lights-construction', NULL, 'Home, Lights & Construction', 1, 10, 1, 'public/categories/wIjR3MFROvXKigB4XKVBKzAK6QVN7w8uavkFlKGf.png', 'public/categories/vUj9sOj36XmNSAXRuzvRGdpdjJeMpbtCk1TKCr3r.png', '<h3>Home, Lights &amp; Construction</h3>'),
(2, 'Machinery, Industrial Parts & Tools', 'machinery-industrial-parts-tools', NULL, 'Machinery, Industrial Parts & Tools', 11, 22, 0, 'public/categories/jebd7bEnJoIeJJR4SlSPKaGBASrwiaQnf8zQcbUH.png', 'public/categories/3S8A7wXjJUYNBVtLTo18BUDqongu4Me05Ru2tAk1.png', '<p><a href=\"https://pumili.com/categories#category-665\">Machinery, Industrial Parts &amp; Tools</a></p>'),
(3, 'Apparel,Textiles & Accessories', 'appareltextiles-accessories', NULL, 'Apparel,Textiles & Accessories', 23, 30, 0, 'public/categories/DNPX8ZH7IxBYKw2GM2atgRvxkKOsdbALcIqtCgrR.jpeg', 'public/categories/pzywAwUeA9qG5Al1YEPtdi3pxMJdw9E6KRgjFhqX.jpeg', '<p>&nbsp;</p>\r\n\r\n<p><a href=\"https://pumili.com/categories#category-59\">Apparel,Textiles &amp; Accessories</a></p>\r\n\r\n<p>&nbsp;</p>'),
(4, 'Agriculture & Food', 'agriculture-food', NULL, 'Agriculture & Food', 31, 36, 0, 'public/categories/A9aH5qXJy5HN9uCYTgZ95BOxvQMZAasSW0Zscn3k.jpeg', 'public/categories/AZCf0eIkNZbGAjRhk3pCDmbeDlcaaSSX58wuV7wL.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(5, 'Electrical Equipment, Components & Telecoms', 'electrical-equipment-components-telecoms', NULL, 'Electrical Equipment, Components & Telecoms', 37, 42, 0, 'public/categories/dPINbVBGTd6MLrvJ7pVd7aZv55x4xdDRORmnkFBb.jpeg', 'public/categories/MhAXGcWAx2tHdLaI6q8jxBpXMyZZZX71SpaafzJP.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(6, 'Electronics', 'electronics', NULL, 'Electronics', 43, 52, 0, 'public/categories/MHic0MUm4m7u6rXOlU38oQfHdVAD3ambiSfCyhCl.jpeg', 'public/categories/s2W6rnmZIlHjNCwBFeIh6AehYoYAVXMPqorlIkDP.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(7, 'Gifts, Sports & Toys', 'Gifts, Sports & Toys', NULL, 'Gifts, Sports & Toys', 53, 64, 0, 'public/categories/6QLjIqPB6XyAHp4zm0BjoRkziB8Xw3FkLYGM8kNU.jpeg', 'public/categories/wTBbn0Rtk5m8Y3wL9Dcc0SfW39g5DNfMKksYLqaF.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(8, 'Health & Beauty', 'health-beauty', NULL, 'Health & Beauty', 65, 66, 0, 'public/categories/tkQYGywaNstY1nkatBebh5w7Ed8ioFpFrteKLS8v.jpeg', 'public/categories/X78u9qqMDlfY59VSmaadCHL4DoCMTZQXuv4z4KEQ.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(9, 'Auto & Transportation', 'auto-transportation', NULL, 'Auto & Transportation', 67, 72, 0, 'public/categories/kNDkt50Go3gPSeNjT3JjORRnVEhrLpJU1afLNHJ9.jpeg', 'public/categories/oV7L8ytWDImBq1BdtvJ91kHN8NtbPBdraEUpcK93.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(10, 'Bags, Shoes & Accessories', 'bags-shoes-accessories', NULL, 'Bags, Shoes & Accessories', 73, 80, 0, 'public/categories/AOzb9UOIz84L2pqgoU7WE7bT6YsiOR2UlyGASmxt.jpeg', 'public/categories/rP3GSi99EizoJEitslmX3uEIoQpqT5oredK4NxgH.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(11, 'Packaging, Advertising & Office', 'packaging-advertising-office', NULL, 'Packaging, Advertising & Office', 81, 86, 0, 'public/categories/S1WRIQFGSPbduvBehH0mtFZMbAQ0MCtUq5QRdVJv.jpeg', 'public/categories/hVGmCPnVHmaQ6iTfrwJetJMkYP7OSRouUL4NtUuM.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(12, 'Metallurgy, Chemicals, Rubber & Plastics', 'metallurgy-chemicals-rubber-plastics', NULL, 'Metallurgy, Chemicals, Rubber & Plastics', 87, 98, 0, 'public/categories/cjOXlzgnCDqFB9LHYHZ4hDzowFGBd4DDjbQEgVWD.jpeg', 'public/categories/EPoE3uY1pVWLkE7Efr5rEMToIt676Lcu7fDU0Dbq.jpeg', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(13, 'Construction & Real Estate', 'construction-real-estate', 1, 'Construction & Real Estate', 2, 3, 0, NULL, NULL, NULL),
(14, 'Home & Garden', 'home-garden', 1, 'Home & Garden', 4, 5, 0, NULL, NULL, NULL),
(15, 'Lights & Lighting', 'lights-lighting', 1, 'Lights & Lighting', 6, 7, 0, NULL, NULL, NULL),
(16, 'Furniture', 'furniture', 1, 'Furniture', 8, 9, 1, NULL, NULL, NULL),
(17, 'Machinery', 'machinery', 2, 'Machinery', 12, 13, 0, NULL, NULL, NULL),
(18, 'Industrial Parts & Fabrication Services', 'industrial-parts-fabrication-services', 2, 'Industrial Parts & Fabrication Services', 14, 15, 0, NULL, NULL, NULL),
(19, 'Tools', 'tools', 2, 'Tools', 16, 17, 0, NULL, NULL, NULL),
(20, 'Hardware', 'hardware', 2, 'Hardware', 18, 19, 0, NULL, NULL, NULL),
(21, 'Measurement & Analysis Instruments', 'measurement-analysis-instruments', 2, 'Measurement & Analysis Instruments', 20, 21, 0, NULL, NULL, NULL),
(22, 'Apparel', 'apparel', 3, 'Apparel', 24, 25, 0, NULL, NULL, NULL),
(23, 'Fashion Accessories', 'fashion-accessories', 3, 'Fashion Accessories', 26, 27, 0, NULL, NULL, NULL),
(24, 'Timepieces, Jewelry, Eyewear', 'timepieces-jewelry-eyewear', 3, 'Timepieces, Jewelry, Eyewear', 28, 29, 0, NULL, NULL, NULL),
(25, 'Agriculture', 'agriculture', 4, 'Agriculture', 32, 33, 0, NULL, NULL, NULL),
(26, 'Food & Beverages', 'food-beverages', 4, 'Food & Beverages', 34, 35, 0, NULL, NULL, NULL),
(27, 'Electrical Equipment & Supplies', 'electrical-equipment-supplies', 5, 'Electrical Equipment & Supplies', 38, 39, 0, NULL, NULL, NULL),
(28, 'Telecommunication', 'telecommunication', 5, 'Telecommunication', 40, 41, 0, NULL, NULL, NULL),
(29, 'Computer Hardware & Software', 'computer-hardware-software', 6, 'Computer Hardware & Software', 44, 45, 0, NULL, NULL, NULL),
(30, 'Home Appliance', 'home-appliance', 6, 'Home Appliance', 46, 47, 0, NULL, NULL, NULL),
(31, 'Consumer Electronic', 'consumer-electronic', 6, 'Consumer Electronic', 48, 49, 0, NULL, NULL, NULL),
(32, 'Security & Protection', 'security-protection', 6, 'Security & Protection', 50, 51, 0, NULL, NULL, NULL),
(33, 'Sports & Entertainment', 'sports-entertainment', 7, 'Sports & Entertainment', 54, 55, 0, NULL, NULL, NULL),
(34, 'Gifts & Crafts', 'gifts-crafts', 7, 'Gifts & Crafts', 56, 57, 0, NULL, NULL, NULL),
(35, 'Toys & Hobbies', 'toys-hobbies', 7, 'Toys & Hobbies', 58, 59, 0, NULL, NULL, NULL),
(36, 'Health & Medical', 'health-medical', 7, 'Health & Medical', 60, 61, 0, NULL, NULL, NULL),
(37, 'Beauty & Personal Care', 'beauty-personal-care', 7, 'Beauty & Personal Care', 62, 63, 0, NULL, NULL, NULL),
(38, 'Automobiles & Motorcycles', 'automobiles-motorcycles', 9, 'Automobiles & Motorcycles', 68, 69, 0, NULL, NULL, NULL),
(39, 'Transportation', 'transportation', 9, 'Transportation', 70, 71, 0, NULL, NULL, NULL),
(40, 'Luggage, Bags & Cases', 'luggage-bags-cases', 10, 'Luggage, Bags & Cases', 74, 75, 0, NULL, NULL, NULL),
(41, 'Shoes & Accessories', 'shoes-accessories', 10, 'Shoes & Accessories', 76, 77, 0, NULL, NULL, NULL),
(42, 'Packaging & Printing', 'packaging-printing', 10, 'Packaging & Printing', 78, 79, 0, NULL, NULL, NULL),
(43, 'Office & School Supplies', 'office-school-supplies', 11, 'Office & School Supplies', 82, 83, 0, NULL, NULL, NULL),
(44, 'Packaging & Printings', 'packaging-printings', 11, 'Packaging & Printings', 84, 85, 0, NULL, NULL, NULL),
(45, 'Minerals & Metallurgy', 'minerals-metallurgy', 12, 'Minerals & Metallurgy', 88, 89, 0, NULL, NULL, NULL),
(46, 'Chemicals', 'chemicals', 12, 'Chemicals', 90, 91, 0, NULL, NULL, NULL),
(47, 'Rubber & Plastics', 'rubber-plastics', 12, 'Rubber & Plastics', 92, 93, 0, NULL, NULL, NULL),
(48, 'Energy', 'energy', 12, 'Energy', 94, 95, 0, NULL, NULL, NULL),
(49, 'Environment', 'environment', 12, 'Environment', 96, 97, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
