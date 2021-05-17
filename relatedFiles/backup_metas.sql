-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2020 at 10:04 AM
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
-- Database: `db_ecom_single_vendor`
--

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `key`, `description`, `value`) VALUES
(1, 'banner_type', 'Banner Type', 'homepage-1,homepage-2,product-details,user-dashboard,login-page'),
(2, 'business_type', 'Business Type', 'Trading Company,Distributor / Wholesaler,Other'),
(3, 'hide-permit', NULL, '1'),
(4, 'site_name', 'Auto Generated', 'Kab Mart'),
(5, 'site_description', 'Auto Generated', 'kabmart'),
(6, 'facebook_link', 'Auto Generated', 'facebook.com'),
(7, 'twitter_link', 'Auto Generated', 'twitter.com'),
(8, 'instagram_link', 'Auto Generated', 'InstaGram.com'),
(9, 'google-plus_link', 'Auto Generated', 'googleplus.com'),
(10, 'youtube_link', 'Auto Generated', 'youtubelink.com'),
(11, 'linkedin_link', 'Auto Generated', 'linkedin.com'),
(12, 'site_keywords', 'Auto Generated', 'Kab Mart'),
(13, 'tracking', 'Auto Generated', ''),
(14, 'logo', 'Auto Generated', 'public/logo/iI1JhEc4gBSjLfsibt8G450VOpUW944WVhGwUch1.png'),
(15, 'contact_email', 'Auto Generated', 'kabmart@gmail.com'),
(16, 'all_right_reserved', 'Auto Generated', 'please change it'),
(17, 'unit_type', 'Auto Generated', 'kilogram,kilohertz,Meter,Ampere,Case'),
(19, 'supported_countries', 'supported_countries', 'supported_countries'),
(20, 'default_country', 'default_country', 'default_country'),
(21, 'supported_locales', 'supported_locales', 'supported_locales'),
(22, 'default_locale', 'default_locale', 'default_locale'),
(23, 'default_timezone', 'default_timezone', 'default_timezone'),
(24, 'maintenance_mode', 'maintenance_mode', 'on'),
(26, 'allowed_IPs', 'allowed_IPs', 'https://webcart.envaysoft.com/#maintenance\r\nhttps://webcart.envaysoft.com/#maintenance'),
(27, 'supported_currencies', 'supported_currencies', 'supported_currencies'),
(28, 'default_currency', 'default_currency', 'default_currency'),
(29, 'mail_from_address', 'mail_from_address', 'mail_from_address update'),
(30, 'mail_from_name', 'mail_from_name', 'mail_from_name'),
(31, 'mail_host', 'mail_host', 'mail_host'),
(32, 'mail_port', 'mail_port', 'mail_port'),
(33, 'mail_username', 'mail_username', 'mail_username'),
(34, 'mail_password', 'mail_password', 'mail_password'),
(35, 'mail_encryption', 'mail_encryption', 'tls'),
(36, 'newsletter_mode', 'newsletter_mode', 'off'),
(37, 'mailchimp_api_key', 'mailchimp_api_key', 'mailchimp_api_key'),
(38, 'mailchimp_list_id', 'mailchimp_list_id', 'mailchimp_list_id'),
(39, 'custom_header', 'custom_header', 'custom_header'),
(40, 'custom_footer', 'custom_footer', 'custom_footer'),
(43, 'paypal_sandbox', 'paypal_sandbox', 'off'),
(44, 'paypal_client_id', 'paypal_client_id', 'paypal_client_id'),
(45, 'paypal_secreate_key', 'paypal_secreate_key', 'paypal_secreate_key'),
(46, 'stripe_status', 'stripe_status', 'true'),
(47, 'stripe_label', 'stripe_label', 'stripe_label'),
(48, 'stripe_description', 'stripe_description', 'stripe_description'),
(49, 'stripe_publishable_key', 'stripe_publishable_key', 'stripe_publishable_key'),
(50, 'stripe_secreate_key', 'stripe_secreate_key', 'stripe_secreate_key'),
(51, 'cash_on_delivery_status', 'cash_on_delivery_status', 'on'),
(52, 'cash_on_delivery_label', 'cash_on_delivery_label', 'cash_on_delivery_label'),
(53, 'cash_on_delivery_description', 'cash_on_delivery_description', 'cash_on_delivery_description'),
(54, 'bank_transfer_status', 'bank_transfer_status', 'true'),
(57, 'cash_on_delivery_instruction', 'cash_on_delivery_instruction', 'cash_on_delivery_instruction'),
(58, 'free_shipping_status', 'free_shipping_status', 'on'),
(59, 'free_shipping_label', 'free_shipping_label', 'Free Shipping'),
(60, 'free_shipping_minimum_amount', 'free_shipping_minimum_amount', '50'),
(61, 'local_pick_up_status', 'local_pick_up_status', 'on'),
(62, 'local_pickup_label', 'local_pickup_label', 'local_pickup_label'),
(63, 'local_pickup_cost', 'local_pickup_cost', '100'),
(64, 'flat_rate_status', 'flat_rate_status', 'on'),
(65, 'flat_rate_label', 'flat_rate_label', 'flat_rate_label'),
(66, 'flat_rate_cost', 'flat_rate_cost', '15'),
(67, 'bank_transfer_label', 'bank_transfer_label', 'bank_transfer_label'),
(68, 'bank_transfer_description', 'bank_transfer_description', 'bank_transfer_description'),
(70, 'paypal_status', 'paypal_status', 'off'),
(71, 'paypal_description', 'paypal_description', 'paypal_description'),
(72, 'paypal_label', 'paypal_label', 'paypal_label');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metas_key_unique` (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
