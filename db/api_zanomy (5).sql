-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2021 at 01:39 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_zanomy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_generate_excel`
--

CREATE TABLE `admin_generate_excel` (
  `generate_excel_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `excel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_admin`
--

CREATE TABLE `zy_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `privilege` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT ' 0=superadmin, 1=sub admin',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=enabled',
  `upfront` float NOT NULL DEFAULT '0' COMMENT 'in %',
  `vendor_commission` float NOT NULL COMMENT 'in %'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zy_admin`
--

INSERT INTO `zy_admin` (`id`, `username`, `password`, `email`, `mobile`, `privilege`, `type`, `status`, `upfront`, `vendor_commission`) VALUES
(1, 'Super Admin', 'Z@nomy.com251118', 'alashter.mohaned@gmail.com', '', '', 0, 1, 100, 40);

-- --------------------------------------------------------

--
-- Table structure for table `zy_admin_slider`
--

CREATE TABLE `zy_admin_slider` (
  `slider_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1=application,2=website',
  `image` varchar(255) NOT NULL,
  `offer_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=redirection,2=not redirect',
  `offer` float NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_attribute`
--

CREATE TABLE `zy_attribute` (
  `attribute_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=unverify,1=verify'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_attribute_mapping`
--

CREATE TABLE `zy_attribute_mapping` (
  `attribute_mapping_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `attribute_id` int(11) NOT NULL DEFAULT '0',
  `is_primary` int(11) NOT NULL DEFAULT '0',
  `is_filter` int(11) NOT NULL DEFAULT '0',
  `is_required` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1=attribute,2=specification',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_attribute_value`
--

CREATE TABLE `zy_attribute_value` (
  `attribute_value_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL DEFAULT '0' COMMENT 'id of zy_sub_category_attribute',
  `value` varchar(100) NOT NULL,
  `value_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_attribute_value_mapping`
--

CREATE TABLE `zy_attribute_value_mapping` (
  `attribute_value_mapping_id` int(11) NOT NULL,
  `attribute_mapping_id` int(11) NOT NULL DEFAULT '0',
  `attribute_id` int(11) NOT NULL DEFAULT '0',
  `attribute_value_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_brand`
--

CREATE TABLE `zy_brand` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=enabled,99=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_brand_mapping`
--

CREATE TABLE `zy_brand_mapping` (
  `brand_mapping_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=enabled,99=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_cart`
--

CREATE TABLE `zy_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_city`
--

CREATE TABLE `zy_city` (
  `city_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1=enabled,0=disabled,99=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_content`
--

CREATE TABLE `zy_content` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_country_code`
--

CREATE TABLE `zy_country_code` (
  `country_code_id` int(11) NOT NULL,
  `country_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zy_country_code`
--

INSERT INTO `zy_country_code` (`country_code_id`, `country_code`, `name`, `name_ar`, `status`) VALUES
(1, '91', 'Libya', 'Libya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zy_coupon`
--

CREATE TABLE `zy_coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `coupon_discount` int(11) NOT NULL DEFAULT '0',
  `coupon_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=%,2=currency,3=delivery_fees(Free)',
  `min_purchase` float NOT NULL DEFAULT '0',
  `total_user` int(11) NOT NULL DEFAULT '0',
  `single_user` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `applied_on` int(11) NOT NULL DEFAULT '0' COMMENT '1=Category,2=Sub-Category,3=brand,4=model',
  `apply_id` int(11) NOT NULL DEFAULT '0' COMMENT 'id of category_id or sub_category_id or brand_id or model_id',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL DEFAULT '0',
  `model_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `description_ar` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_delivery_charges`
--

CREATE TABLE `zy_delivery_charges` (
  `id` int(11) NOT NULL,
  `hub_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `delivery_charge` float NOT NULL,
  `expected_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'comment in days',
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_driver`
--

CREATE TABLE `zy_driver` (
  `driver_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `latitude` float NOT NULL DEFAULT '0',
  `longitude` float NOT NULL DEFAULT '0',
  `block_reason` text CHARACTER SET utf8mb4 NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0:not verified,1:active,2=blocked,99=deleted',
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_driver_auth`
--

CREATE TABLE `zy_driver_auth` (
  `auth_id` int(22) NOT NULL,
  `driver_id` int(22) NOT NULL,
  `device_type` varchar(20) NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `device_token` varchar(300) NOT NULL,
  `security_token` varchar(100) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_driver_notifications`
--

CREATE TABLE `zy_driver_notifications` (
  `notification_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `driver_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `driver_order_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=order,2=booking',
  `is_seen` int(11) NOT NULL DEFAULT '0' COMMENT '1=seen',
  `send_by_admin` int(11) NOT NULL DEFAULT '0' COMMENT '1= send by admin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_driver_order`
--

CREATE TABLE `zy_driver_order` (
  `driver_order_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_tracking_id` bigint(20) NOT NULL DEFAULT '0',
  `driver_order_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=Out For Collecting Cash,2=Pickup Order From Vendor Location,3=Drop Order To User Location,4=pickup order fro international items(airport)',
  `driver_order_status` int(11) NOT NULL DEFAULT '0' COMMENT '1=assigned,2=inprocess,3=done,4=verified by admin',
  `international_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_driver_query`
--

CREATE TABLE `zy_driver_query` (
  `query_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_featuers`
--

CREATE TABLE `zy_featuers` (
  `featuers_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_featuers_mapping`
--

CREATE TABLE `zy_featuers_mapping` (
  `featuers_mapping_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `featuers_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_files`
--

CREATE TABLE `zy_files` (
  `files_id` int(11) NOT NULL,
  `file_path` text NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_hubs`
--

CREATE TABLE `zy_hubs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zy_hubs`
--

INSERT INTO `zy_hubs` (`id`, `name`, `name_ar`, `status`, `created_at`) VALUES
(2, 'Tripoli', 'طرابلس', 1, '2020-07-27 10:02:13'),
(3, 'Benghazi', 'بنغازي', 1, '2020-07-27 10:02:39'),
(4, 'Misrata', 'مصراته', 1, '2020-07-27 10:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `zy_model`
--

CREATE TABLE `zy_model` (
  `model_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=enabled,99=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_model_mapping`
--

CREATE TABLE `zy_model_mapping` (
  `model_mapping_id` int(11) NOT NULL,
  `brand_mapping_id` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_orders`
--

CREATE TABLE `zy_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `coupon_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=%,2=currency,3=free delivery',
  `item_amount` float NOT NULL DEFAULT '0',
  `coupon_amount` float NOT NULL DEFAULT '0',
  `delivery_charges` float NOT NULL DEFAULT '0',
  `free_delivery` float NOT NULL DEFAULT '0',
  `payble_amount` float NOT NULL DEFAULT '0',
  `upfront_amount` float NOT NULL DEFAULT '0',
  `remain_amount` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `payment_type` int(11) NOT NULL COMMENT '1=cod , 2=online',
  `payment_status` int(11) NOT NULL COMMENT '0= pending,1=success,2=fail',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1=place orde,2=Out For Collecting Cash,3=collecting cash verify by admin,4=inprocess(Pickup Order From Vendor Location/Drop Order To User Location),5=completed,6=cancel',
  `user_status` int(11) NOT NULL DEFAULT '1' COMMENT '1=new,2=inprocess ,3=delivered',
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `upfront_tracking_id` bigint(20) NOT NULL DEFAULT '0',
  `is_upfront_paid` int(11) NOT NULL DEFAULT '0' COMMENT '0=mot paid,1=paid',
  `is_seen` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_drop_tracking`
--

CREATE TABLE `zy_order_drop_tracking` (
  `order_drop_tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `drop_tracking_id` bigint(20) NOT NULL,
  `drop_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=assigned by admin, else zy_order_status=>[status_id]',
  `drop_tracking_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_international_tracking`
--

CREATE TABLE `zy_order_international_tracking` (
  `order_international_tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `international_tracking_id` bigint(20) NOT NULL,
  `international_status` int(11) NOT NULL DEFAULT '0' COMMENT 'zy_order_status=>[status_id]',
  `international_tracking_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_items`
--

CREATE TABLE `zy_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `hub_id` int(11) NOT NULL,
  `group` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `commission` float NOT NULL DEFAULT '0' COMMENT 'in LYD',
  `commission_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=product,2=vendor,3=sub category',
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `vendor_tracking_id` bigint(20) NOT NULL DEFAULT '0',
  `drop_driver_id` int(11) NOT NULL DEFAULT '0',
  `drop_tracking_id` bigint(20) NOT NULL DEFAULT '0',
  `international_driver_id` int(11) NOT NULL DEFAULT '0',
  `international_tracking_id` bigint(20) NOT NULL DEFAULT '0',
  `is_in_hub` int(11) NOT NULL DEFAULT '0' COMMENT '0=not in hub ,1= received at hub',
  `status_by` int(11) NOT NULL DEFAULT '0' COMMENT '1=admin,2=driver,3=vendor	',
  `item_status` varchar(100) NOT NULL,
  `item_action` int(11) NOT NULL DEFAULT '0' COMMENT '0=no action,1=Pickup Order From Vendor Location,2=Drop Order To User Location,3=pick up from international product(airport),4=cancel,5=pickup return order from user location,6=drop return order to vendor location',
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '1=awating-confirmation,2=inprocess,3=dispatch,4=delivered,5=cancel,,6=return	',
  `cancel_reason` text CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expected_delivery` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `max_return_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_returnable` int(11) NOT NULL DEFAULT '0' COMMENT '1=able to return oredr',
  `return_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `return_driver_id` int(11) NOT NULL,
  `return_tracking_id` bigint(11) NOT NULL,
  `is_return_in_hub` int(11) NOT NULL COMMENT '1=get return item on hub',
  `return_drop_driver_id` int(11) NOT NULL,
  `return_drop_tracking_id` bigint(11) NOT NULL,
  `is_return_drop` int(11) NOT NULL COMMENT '1=drop on vendor location	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_package`
--

CREATE TABLE `zy_order_package` (
  `order_package_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `order_type_id` int(11) NOT NULL DEFAULT '0',
  `order_status_id` int(11) NOT NULL DEFAULT '0',
  `order_action` int(11) NOT NULL DEFAULT '0' COMMENT '1=admin,2=driver,3=vendor',
  `package_status` int(11) NOT NULL COMMENT 'will change dynaimicly by driver'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_return_drop_tracking`
--

CREATE TABLE `zy_order_return_drop_tracking` (
  `order_return_drop_tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `return_drop_tracking_id` bigint(11) NOT NULL DEFAULT '0',
  `return_drop_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=assigned by admin, else zy_order_status=>[status_id]',
  `return_drop_tracking_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_return_tracking`
--

CREATE TABLE `zy_order_return_tracking` (
  `order_return_tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `return_tracking_id` bigint(20) NOT NULL,
  `return_status` int(11) NOT NULL COMMENT '0=assigned by admin, else zy_order_status=>[status_id]',
  `return_tracking_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_status`
--

CREATE TABLE `zy_order_status` (
  `status_id` int(11) NOT NULL,
  `order_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '1=Out For Collecting Cash,2=Pickup Order From Vendor Location,3=Drop Order To User Location,4=pick up from international product(airport),5=Pickup return order to user location,6=Drop ordre to vendor location',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1=admin,2=vendor,3=driver',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zy_order_status`
--

INSERT INTO `zy_order_status` (`status_id`, `order_type_id`, `type`, `order_status`, `order_status_ar`, `status`) VALUES
(1, 1, 3, 'Start Job', 'Assigned To Delivery Boy', 99),
(2, 1, 3, 'On The Way', 'Completed Order', 1),
(3, 1, 3, 'Reached A Location', 'On The Way', 1),
(4, 1, 3, 'Collect Up-Front Amount', 'Collect Up-Front Amount', 1),
(5, 1, 3, 'Reached Hub', 'Reached Hub', 1),
(6, 1, 3, 'Deposit Amount', 'Pickup Order', 1),
(7, 2, 3, 'Start Job', 'Drop Order', 1),
(8, 2, 3, 'On The Way', 'Collect Remain Amount', 1),
(9, 2, 3, 'Reached A Location', 'Delivered', 1),
(10, 2, 3, 'Pickup Order', 'On the way', 1),
(11, 2, 3, 'Submit Order', 'Dispatched', 1),
(12, 2, 3, 'Job Completed', 'Shipped', 0),
(13, 3, 3, 'Start Job', 'انتظارالبائع', 1),
(14, 3, 3, 'On The Way', 'انتظارالبائع', 1),
(15, 3, 3, 'Reached A Location', 'انتظارالبائع', 1),
(16, 3, 3, 'Drop Order', 'انتظارالبائع', 1),
(17, 3, 3, 'Collect Remain Amount', 'انتظارالبائع', 1),
(18, 3, 3, 'Reached Hub', 'انتظارالبائع', 1),
(19, 3, 3, 'Deposit Amount', 'انتظارالبائع', 1),
(20, 3, 3, 'Job Completed', 'انتظارالبائع', 1),
(21, 4, 3, 'Start Job', 'انتظارالبائع', 1),
(22, 4, 3, 'On The Way', 'انتظارالبائع', 1),
(23, 4, 3, 'Reached A Location', 'انتظارالبائع', 1),
(24, 4, 3, 'Pickup Order', 'انتظارالبائع', 1),
(25, 4, 3, 'Reached Hub', 'انتظارالبائع', 1),
(26, 4, 3, 'Job Completed', 'انتظارالبائع', 1),
(27, 0, 2, 'On the way', 'On the way', 1),
(28, 0, 2, 'test vendor', 'test vendor', 1),
(29, 0, 1, 'admin test', 'admin test', 1),
(30, 0, 3, 'driver test', 'driver test', 1),
(31, 5, 3, 'Start Job', 'انتظارالبائع', 1),
(32, 5, 3, 'On The Way', 'انتظارالبائع', 1),
(33, 5, 3, 'Reached A Location', 'انتظارالبائع', 1),
(34, 5, 3, 'Pickup Order', 'انتظارالبائع', 1),
(35, 5, 3, 'Reached Hub', 'انتظارالبائع', 1),
(36, 5, 3, 'Job Completed', 'انتظارالبائع', 1),
(37, 6, 3, 'Start Job', 'Drop Order', 1),
(38, 6, 3, 'On The Way', 'Collect Remain Amount', 1),
(39, 6, 3, 'Reached A Location', 'Delivered', 1),
(40, 6, 3, 'Submit Order', 'Dispatched', 1),
(41, 6, 3, 'Job Completed', 'Shipped', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_type`
--

CREATE TABLE `zy_order_type` (
  `order_type_id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `type_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zy_order_type`
--

INSERT INTO `zy_order_type` (`order_type_id`, `type`, `type_ar`, `status`) VALUES
(1, 'Out For Collecting Cash', 'لجمع النقود', 1),
(2, 'Pickup Order From Vendor Location', 'أمر الاستلام من موقع البائع', 1),
(3, 'Drop Order To User Location', 'إسقاط الطلب إلى موقع المستخدم', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_upfront_tracking`
--

CREATE TABLE `zy_order_upfront_tracking` (
  `order_upfront_tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `upfront_tracking_id` bigint(20) NOT NULL,
  `upfront_status` int(11) NOT NULL DEFAULT '0' COMMENT 'zy_order_status=>[status_id]',
  `upfront_tracking_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_user_status`
--

CREATE TABLE `zy_order_user_status` (
  `order_user_status_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_order_vendor_tracking`
--

CREATE TABLE `zy_order_vendor_tracking` (
  `order_vendor_tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vendor_tracking_id` bigint(20) NOT NULL,
  `vendor_status` int(11) NOT NULL DEFAULT '0' COMMENT 'zy_order_status=>[status_id]',
  `vendor_tracking_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_privelege_main`
--

CREATE TABLE `zy_privelege_main` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zy_privelege_main`
--

INSERT INTO `zy_privelege_main` (`id`, `type`, `title`, `status`) VALUES
(1, 1, 'user management', 1),
(2, 2, 'vendor management', 1),
(3, 3, 'driver management', 1),
(4, 4, 'product management', 1),
(5, 5, 'category management', 1),
(6, 6, 'brand management', 1),
(7, 7, 'model management', 1),
(8, 8, 'attribute management', 1),
(9, 9, 'delivery management', 1),
(10, 10, 'order status management', 1),
(11, 11, 'service management', 1),
(12, 12, 'order management', 1),
(13, 13, 'subscription management', 1),
(14, 14, 'sub admin management', 0),
(15, 15, 'commission & upfront management', 1),
(16, 16, 'request management', 1),
(17, 17, 'booking management', 1),
(18, 18, 'query management', 1),
(19, 19, 'banner management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zy_privilege_submenu`
--

CREATE TABLE `zy_privilege_submenu` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sub_menu_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_products`
--

CREATE TABLE `zy_products` (
  `product_id` int(11) NOT NULL,
  `commission` float NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `hub_id` int(11) NOT NULL DEFAULT '0',
  `product_from` int(11) NOT NULL DEFAULT '0' COMMENT '1=inventory,2=dubai',
  `upload_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=from panel,1=from excel',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL DEFAULT '0',
  `model_id` int(11) NOT NULL DEFAULT '0',
  `model_mapped` bigint(20) NOT NULL DEFAULT '0',
  `primary_attribute` int(11) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `description_short` text CHARACTER SET utf8mb4 NOT NULL,
  `description_short_ar` text CHARACTER SET utf8mb4 NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `is_featured` int(11) NOT NULL DEFAULT '0',
  `total_views` int(11) NOT NULL DEFAULT '0',
  `top_selling` int(11) NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  `terms` text CHARACTER SET utf8mb4 NOT NULL,
  `terms_ar` text CHARACTER SET utf8mb4 NOT NULL,
  `is_returnable` int(11) NOT NULL DEFAULT '1',
  `duration` int(11) NOT NULL DEFAULT '0',
  `return_policy` text CHARACTER SET utf8mb4 NOT NULL,
  `return_policy_ar` text CHARACTER SET utf8mb4 NOT NULL,
  `expected_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'comment in days',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=unverify,1=verify,99=deleted',
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_attribute`
--

CREATE TABLE `zy_product_attribute` (
  `product_attribute_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sub_parent_id` int(11) NOT NULL DEFAULT '0',
  `is_new` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `is_primary` int(11) NOT NULL DEFAULT '0',
  `attribute_id` int(11) NOT NULL DEFAULT '0',
  `attribute_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_attribute_group`
--

CREATE TABLE `zy_product_attribute_group` (
  `item_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `attribute_group_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `item_no` varchar(100) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `images` varchar(100) NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_attribute_mapping`
--

CREATE TABLE `zy_product_attribute_mapping` (
  `product_attribute_mapping_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT '1',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '1',
  `first_attribute_id` int(11) NOT NULL DEFAULT '0',
  `first` int(11) NOT NULL DEFAULT '1',
  `second_attribute_id` int(11) NOT NULL DEFAULT '0',
  `second` int(11) NOT NULL DEFAULT '1',
  `third_attribute_id` int(11) NOT NULL DEFAULT '0',
  `third` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_category`
--

CREATE TABLE `zy_product_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=diabled, 1=enabled , 99=deleted',
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_featuers`
--

CREATE TABLE `zy_product_featuers` (
  `product_featuers_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `featuers_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_filter`
--

CREATE TABLE `zy_product_filter` (
  `product_filter_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL,
  `value_id_1` int(11) NOT NULL DEFAULT '0',
  `value_id_2` int(11) NOT NULL DEFAULT '0',
  `value_id_3` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_images`
--

CREATE TABLE `zy_product_images` (
  `product_images_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_review`
--

CREATE TABLE `zy_product_review` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_specification`
--

CREATE TABLE `zy_product_specification` (
  `product_specification_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `attribute_id` int(11) NOT NULL DEFAULT '0',
  `attribute_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_product_sub_category`
--

CREATE TABLE `zy_product_sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `is_brand` int(11) NOT NULL DEFAULT '1',
  `is_model` int(11) NOT NULL DEFAULT '1',
  `commission` float NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL COMMENT '0=diabled, 1=enabled , 99=deleted',
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_service`
--

CREATE TABLE `zy_service` (
  `service_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '   ',
  `discount` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `description_ar` text NOT NULL,
  `total_booking` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=unverify,1=verify,99=deleted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_service_booking`
--

CREATE TABLE `zy_service_booking` (
  `booking_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `latitude` float NOT NULL DEFAULT '0',
  `longitude` float NOT NULL DEFAULT '0',
  `address` text NOT NULL,
  `note` varchar(255) NOT NULL,
  `card_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=debit,2=credit',
  `payment_type` int(11) NOT NULL COMMENT '1=cod , 2=online',
  `payment_status` int(11) NOT NULL COMMENT '0= pending,1=success,2=fail',
  `status` int(11) NOT NULL COMMENT '0=pending,1=accept(or active),2=on the way,3=work in progress,4=complete,5=reject',
  `is_paid` int(11) NOT NULL DEFAULT '0' COMMENT '0=unpaid,1=paid',
  `pay_vendor` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_service_category`
--

CREATE TABLE `zy_service_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=diabled, 1=enabled , 99=deleted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_service_featuer`
--

CREATE TABLE `zy_service_featuer` (
  `service_featuer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL DEFAULT '0',
  `featues` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_service_review`
--

CREATE TABLE `zy_service_review` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL DEFAULT '1',
  `booking_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `rating` int(11) NOT NULL DEFAULT '1',
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_service_sub_category`
--

CREATE TABLE `zy_service_sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=diabled, 1=enabled , 99=deleted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_subscription_plan`
--

CREATE TABLE `zy_subscription_plan` (
  `plan_id` int(11) NOT NULL,
  `service_category_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL DEFAULT '0',
  `duration` int(11) NOT NULL DEFAULT '0' COMMENT 'in days',
  `description` text NOT NULL,
  `description_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(255) NOT NULL DEFAULT '#c7bb6b',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_support_reason`
--

CREATE TABLE `zy_support_reason` (
  `reason_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1=user,2= driver,3= vendor',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_users`
--

CREATE TABLE `zy_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0:not verified,1:active,2=blocked,99=deleted',
  `block_reason` text CHARACTER SET utf8mb4 NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_user_address`
--

CREATE TABLE `zy_user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `postal_code` varchar(10) NOT NULL DEFAULT '',
  `country_code` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(15) NOT NULL,
  `geo_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `street_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `house_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '99=deleted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_user_auth`
--

CREATE TABLE `zy_user_auth` (
  `auth_id` int(22) NOT NULL,
  `user_id` int(22) NOT NULL,
  `device_type` varchar(20) NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `device_token` varchar(300) NOT NULL,
  `security_token` varchar(100) NOT NULL,
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_user_note`
--

CREATE TABLE `zy_user_note` (
  `user_note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_user_notifications`
--

CREATE TABLE `zy_user_notifications` (
  `notification_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=order,2=booking',
  `is_seen` int(11) NOT NULL DEFAULT '0' COMMENT '1=seen',
  `send_by_admin` int(11) NOT NULL DEFAULT '0' COMMENT '1= send by admin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_user_query`
--

CREATE TABLE `zy_user_query` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_user_transaction`
--

CREATE TABLE `zy_user_transaction` (
  `user_transaction_id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `reference_id` varchar(255) NOT NULL,
  `order_id` float NOT NULL DEFAULT '0',
  `user_id` float NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1=order,1=booking',
  `payment_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=cod,1=online',
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=pending,1=success,2=fail',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_vendor`
--

CREATE TABLE `zy_vendor` (
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `is_trusted` int(11) NOT NULL DEFAULT '0' COMMENT '1=trusted vendor',
  `commission` float NOT NULL DEFAULT '0',
  `hub_id` int(11) NOT NULL DEFAULT '0',
  `business_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=product,2=service',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `lat` float NOT NULL DEFAULT '0',
  `lng` float NOT NULL DEFAULT '0',
  `id_proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_commission` float NOT NULL COMMENT 'total pay to admin',
  `paid_commission` float NOT NULL COMMENT 'total paid to admin',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0:not verified,1:active,2=blocked,3=not verified by admin,99=deleted',
  `block_reason` text CHARACTER SET utf8mb4 NOT NULL,
  `created_at` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_vendor_commission`
--

CREATE TABLE `zy_vendor_commission` (
  `vendor_commission_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `comission_amount` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_vendor_note`
--

CREATE TABLE `zy_vendor_note` (
  `vendor_note_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_vendor_order`
--

CREATE TABLE `zy_vendor_order` (
  `vendor_order_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zy_vendor_query`
--

CREATE TABLE `zy_vendor_query` (
  `query_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zy_vendor_subscription`
--

CREATE TABLE `zy_vendor_subscription` (
  `vendor_subscription_id` int(11) NOT NULL,
  `service_category_id` int(11) NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `subscribe_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zy_wishlist`
--

CREATE TABLE `zy_wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_generate_excel`
--
ALTER TABLE `admin_generate_excel`
  ADD PRIMARY KEY (`generate_excel_id`);

--
-- Indexes for table `zy_admin`
--
ALTER TABLE `zy_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_admin_slider`
--
ALTER TABLE `zy_admin_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `zy_attribute`
--
ALTER TABLE `zy_attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `zy_attribute_mapping`
--
ALTER TABLE `zy_attribute_mapping`
  ADD PRIMARY KEY (`attribute_mapping_id`);

--
-- Indexes for table `zy_attribute_value`
--
ALTER TABLE `zy_attribute_value`
  ADD PRIMARY KEY (`attribute_value_id`);

--
-- Indexes for table `zy_attribute_value_mapping`
--
ALTER TABLE `zy_attribute_value_mapping`
  ADD PRIMARY KEY (`attribute_value_mapping_id`);

--
-- Indexes for table `zy_brand`
--
ALTER TABLE `zy_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `zy_brand_mapping`
--
ALTER TABLE `zy_brand_mapping`
  ADD PRIMARY KEY (`brand_mapping_id`);

--
-- Indexes for table `zy_cart`
--
ALTER TABLE `zy_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `zy_city`
--
ALTER TABLE `zy_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `zy_content`
--
ALTER TABLE `zy_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_country_code`
--
ALTER TABLE `zy_country_code`
  ADD PRIMARY KEY (`country_code_id`);

--
-- Indexes for table `zy_coupon`
--
ALTER TABLE `zy_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `zy_delivery_charges`
--
ALTER TABLE `zy_delivery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_driver`
--
ALTER TABLE `zy_driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `zy_driver_auth`
--
ALTER TABLE `zy_driver_auth`
  ADD PRIMARY KEY (`auth_id`),
  ADD UNIQUE KEY `user_id` (`driver_id`);

--
-- Indexes for table `zy_driver_notifications`
--
ALTER TABLE `zy_driver_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `zy_driver_order`
--
ALTER TABLE `zy_driver_order`
  ADD PRIMARY KEY (`driver_order_id`);

--
-- Indexes for table `zy_driver_query`
--
ALTER TABLE `zy_driver_query`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `zy_featuers`
--
ALTER TABLE `zy_featuers`
  ADD PRIMARY KEY (`featuers_id`);

--
-- Indexes for table `zy_featuers_mapping`
--
ALTER TABLE `zy_featuers_mapping`
  ADD PRIMARY KEY (`featuers_mapping_id`);

--
-- Indexes for table `zy_files`
--
ALTER TABLE `zy_files`
  ADD PRIMARY KEY (`files_id`);

--
-- Indexes for table `zy_hubs`
--
ALTER TABLE `zy_hubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_model`
--
ALTER TABLE `zy_model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `zy_model_mapping`
--
ALTER TABLE `zy_model_mapping`
  ADD PRIMARY KEY (`model_mapping_id`);

--
-- Indexes for table `zy_orders`
--
ALTER TABLE `zy_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `zy_order_drop_tracking`
--
ALTER TABLE `zy_order_drop_tracking`
  ADD PRIMARY KEY (`order_drop_tracking_id`);

--
-- Indexes for table `zy_order_international_tracking`
--
ALTER TABLE `zy_order_international_tracking`
  ADD PRIMARY KEY (`order_international_tracking_id`);

--
-- Indexes for table `zy_order_items`
--
ALTER TABLE `zy_order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `zy_order_package`
--
ALTER TABLE `zy_order_package`
  ADD PRIMARY KEY (`order_package_id`);

--
-- Indexes for table `zy_order_return_drop_tracking`
--
ALTER TABLE `zy_order_return_drop_tracking`
  ADD PRIMARY KEY (`order_return_drop_tracking_id`);

--
-- Indexes for table `zy_order_return_tracking`
--
ALTER TABLE `zy_order_return_tracking`
  ADD PRIMARY KEY (`order_return_tracking_id`);

--
-- Indexes for table `zy_order_status`
--
ALTER TABLE `zy_order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `zy_order_type`
--
ALTER TABLE `zy_order_type`
  ADD PRIMARY KEY (`order_type_id`);

--
-- Indexes for table `zy_order_upfront_tracking`
--
ALTER TABLE `zy_order_upfront_tracking`
  ADD PRIMARY KEY (`order_upfront_tracking_id`);

--
-- Indexes for table `zy_order_user_status`
--
ALTER TABLE `zy_order_user_status`
  ADD PRIMARY KEY (`order_user_status_id`);

--
-- Indexes for table `zy_order_vendor_tracking`
--
ALTER TABLE `zy_order_vendor_tracking`
  ADD PRIMARY KEY (`order_vendor_tracking_id`);

--
-- Indexes for table `zy_privelege_main`
--
ALTER TABLE `zy_privelege_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_privilege_submenu`
--
ALTER TABLE `zy_privilege_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_products`
--
ALTER TABLE `zy_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `zy_product_attribute`
--
ALTER TABLE `zy_product_attribute`
  ADD PRIMARY KEY (`product_attribute_id`);

--
-- Indexes for table `zy_product_attribute_group`
--
ALTER TABLE `zy_product_attribute_group`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `zy_product_attribute_mapping`
--
ALTER TABLE `zy_product_attribute_mapping`
  ADD PRIMARY KEY (`product_attribute_mapping_id`);

--
-- Indexes for table `zy_product_category`
--
ALTER TABLE `zy_product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `zy_product_featuers`
--
ALTER TABLE `zy_product_featuers`
  ADD PRIMARY KEY (`product_featuers_id`);

--
-- Indexes for table `zy_product_filter`
--
ALTER TABLE `zy_product_filter`
  ADD PRIMARY KEY (`product_filter_id`);

--
-- Indexes for table `zy_product_images`
--
ALTER TABLE `zy_product_images`
  ADD PRIMARY KEY (`product_images_id`);

--
-- Indexes for table `zy_product_review`
--
ALTER TABLE `zy_product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_product_specification`
--
ALTER TABLE `zy_product_specification`
  ADD PRIMARY KEY (`product_specification_id`);

--
-- Indexes for table `zy_product_sub_category`
--
ALTER TABLE `zy_product_sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `zy_service`
--
ALTER TABLE `zy_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `zy_service_booking`
--
ALTER TABLE `zy_service_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `zy_service_category`
--
ALTER TABLE `zy_service_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `zy_service_featuer`
--
ALTER TABLE `zy_service_featuer`
  ADD PRIMARY KEY (`service_featuer_id`);

--
-- Indexes for table `zy_service_review`
--
ALTER TABLE `zy_service_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zy_service_sub_category`
--
ALTER TABLE `zy_service_sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `zy_subscription_plan`
--
ALTER TABLE `zy_subscription_plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `zy_support_reason`
--
ALTER TABLE `zy_support_reason`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `zy_users`
--
ALTER TABLE `zy_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `zy_user_address`
--
ALTER TABLE `zy_user_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `zy_user_auth`
--
ALTER TABLE `zy_user_auth`
  ADD PRIMARY KEY (`auth_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `zy_user_note`
--
ALTER TABLE `zy_user_note`
  ADD PRIMARY KEY (`user_note_id`);

--
-- Indexes for table `zy_user_notifications`
--
ALTER TABLE `zy_user_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `zy_user_query`
--
ALTER TABLE `zy_user_query`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `zy_user_transaction`
--
ALTER TABLE `zy_user_transaction`
  ADD PRIMARY KEY (`user_transaction_id`);

--
-- Indexes for table `zy_vendor`
--
ALTER TABLE `zy_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `zy_vendor_commission`
--
ALTER TABLE `zy_vendor_commission`
  ADD PRIMARY KEY (`vendor_commission_id`);

--
-- Indexes for table `zy_vendor_note`
--
ALTER TABLE `zy_vendor_note`
  ADD PRIMARY KEY (`vendor_note_id`);

--
-- Indexes for table `zy_vendor_order`
--
ALTER TABLE `zy_vendor_order`
  ADD PRIMARY KEY (`vendor_order_id`);

--
-- Indexes for table `zy_vendor_query`
--
ALTER TABLE `zy_vendor_query`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `zy_vendor_subscription`
--
ALTER TABLE `zy_vendor_subscription`
  ADD PRIMARY KEY (`vendor_subscription_id`);

--
-- Indexes for table `zy_wishlist`
--
ALTER TABLE `zy_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_generate_excel`
--
ALTER TABLE `admin_generate_excel`
  MODIFY `generate_excel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_admin`
--
ALTER TABLE `zy_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zy_admin_slider`
--
ALTER TABLE `zy_admin_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_attribute`
--
ALTER TABLE `zy_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_attribute_mapping`
--
ALTER TABLE `zy_attribute_mapping`
  MODIFY `attribute_mapping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_attribute_value`
--
ALTER TABLE `zy_attribute_value`
  MODIFY `attribute_value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_attribute_value_mapping`
--
ALTER TABLE `zy_attribute_value_mapping`
  MODIFY `attribute_value_mapping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_brand`
--
ALTER TABLE `zy_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_brand_mapping`
--
ALTER TABLE `zy_brand_mapping`
  MODIFY `brand_mapping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_cart`
--
ALTER TABLE `zy_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_city`
--
ALTER TABLE `zy_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_content`
--
ALTER TABLE `zy_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_country_code`
--
ALTER TABLE `zy_country_code`
  MODIFY `country_code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zy_coupon`
--
ALTER TABLE `zy_coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_delivery_charges`
--
ALTER TABLE `zy_delivery_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_driver`
--
ALTER TABLE `zy_driver`
  MODIFY `driver_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_driver_auth`
--
ALTER TABLE `zy_driver_auth`
  MODIFY `auth_id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_driver_notifications`
--
ALTER TABLE `zy_driver_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_driver_order`
--
ALTER TABLE `zy_driver_order`
  MODIFY `driver_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_driver_query`
--
ALTER TABLE `zy_driver_query`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_featuers`
--
ALTER TABLE `zy_featuers`
  MODIFY `featuers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_featuers_mapping`
--
ALTER TABLE `zy_featuers_mapping`
  MODIFY `featuers_mapping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_files`
--
ALTER TABLE `zy_files`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_hubs`
--
ALTER TABLE `zy_hubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zy_model`
--
ALTER TABLE `zy_model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_model_mapping`
--
ALTER TABLE `zy_model_mapping`
  MODIFY `model_mapping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_orders`
--
ALTER TABLE `zy_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_drop_tracking`
--
ALTER TABLE `zy_order_drop_tracking`
  MODIFY `order_drop_tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_international_tracking`
--
ALTER TABLE `zy_order_international_tracking`
  MODIFY `order_international_tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_items`
--
ALTER TABLE `zy_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_package`
--
ALTER TABLE `zy_order_package`
  MODIFY `order_package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_return_drop_tracking`
--
ALTER TABLE `zy_order_return_drop_tracking`
  MODIFY `order_return_drop_tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_return_tracking`
--
ALTER TABLE `zy_order_return_tracking`
  MODIFY `order_return_tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_status`
--
ALTER TABLE `zy_order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `zy_order_type`
--
ALTER TABLE `zy_order_type`
  MODIFY `order_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zy_order_upfront_tracking`
--
ALTER TABLE `zy_order_upfront_tracking`
  MODIFY `order_upfront_tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_user_status`
--
ALTER TABLE `zy_order_user_status`
  MODIFY `order_user_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_order_vendor_tracking`
--
ALTER TABLE `zy_order_vendor_tracking`
  MODIFY `order_vendor_tracking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_privelege_main`
--
ALTER TABLE `zy_privelege_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `zy_privilege_submenu`
--
ALTER TABLE `zy_privilege_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_products`
--
ALTER TABLE `zy_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_attribute`
--
ALTER TABLE `zy_product_attribute`
  MODIFY `product_attribute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_attribute_group`
--
ALTER TABLE `zy_product_attribute_group`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_attribute_mapping`
--
ALTER TABLE `zy_product_attribute_mapping`
  MODIFY `product_attribute_mapping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_category`
--
ALTER TABLE `zy_product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_featuers`
--
ALTER TABLE `zy_product_featuers`
  MODIFY `product_featuers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_filter`
--
ALTER TABLE `zy_product_filter`
  MODIFY `product_filter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_images`
--
ALTER TABLE `zy_product_images`
  MODIFY `product_images_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_review`
--
ALTER TABLE `zy_product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_specification`
--
ALTER TABLE `zy_product_specification`
  MODIFY `product_specification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_product_sub_category`
--
ALTER TABLE `zy_product_sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_service`
--
ALTER TABLE `zy_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_service_booking`
--
ALTER TABLE `zy_service_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_service_category`
--
ALTER TABLE `zy_service_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_service_featuer`
--
ALTER TABLE `zy_service_featuer`
  MODIFY `service_featuer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_service_review`
--
ALTER TABLE `zy_service_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_service_sub_category`
--
ALTER TABLE `zy_service_sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_subscription_plan`
--
ALTER TABLE `zy_subscription_plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_support_reason`
--
ALTER TABLE `zy_support_reason`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_users`
--
ALTER TABLE `zy_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_user_address`
--
ALTER TABLE `zy_user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_user_auth`
--
ALTER TABLE `zy_user_auth`
  MODIFY `auth_id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_user_note`
--
ALTER TABLE `zy_user_note`
  MODIFY `user_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_user_notifications`
--
ALTER TABLE `zy_user_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_user_query`
--
ALTER TABLE `zy_user_query`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_user_transaction`
--
ALTER TABLE `zy_user_transaction`
  MODIFY `user_transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_vendor`
--
ALTER TABLE `zy_vendor`
  MODIFY `vendor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_vendor_commission`
--
ALTER TABLE `zy_vendor_commission`
  MODIFY `vendor_commission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_vendor_note`
--
ALTER TABLE `zy_vendor_note`
  MODIFY `vendor_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_vendor_order`
--
ALTER TABLE `zy_vendor_order`
  MODIFY `vendor_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_vendor_query`
--
ALTER TABLE `zy_vendor_query`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_vendor_subscription`
--
ALTER TABLE `zy_vendor_subscription`
  MODIFY `vendor_subscription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zy_wishlist`
--
ALTER TABLE `zy_wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
