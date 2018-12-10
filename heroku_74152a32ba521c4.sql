-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2018 at 01:14 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `f_admin`
--

CREATE TABLE `f_admin` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `userName` varchar(8) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_admin`
--

INSERT INTO `f_admin` (`userID`, `firstName`, `lastName`, `userName`, `password`) VALUES
(1, 'Corey', 'Johnson', 'admin', 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4');

-- --------------------------------------------------------

--
-- Table structure for table `f_brands`
--

CREATE TABLE `f_brands` (
  `brandID` int(11) NOT NULL,
  `brandName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_brands`
--

INSERT INTO `f_brands` (`brandID`, `brandName`) VALUES
(21, 'Tesla'),
(31, 'Zero Motorcycles'),
(41, 'Evolve Skateboards'),
(51, 'Razor Scooters'),
(61, 'Evelo');

-- --------------------------------------------------------

--
-- Table structure for table `f_category`
--

CREATE TABLE `f_category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_category`
--

INSERT INTO `f_category` (`categoryID`, `categoryName`) VALUES
(51, 'Electric Car'),
(61, 'Electric Motorcycle'),
(71, 'Electric Skateboard'),
(81, 'Electric Scooter'),
(91, 'Electric Bike');

-- --------------------------------------------------------

--
-- Table structure for table `f_comments`
--

CREATE TABLE `f_comments` (
  `likesID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `comments` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_comments`
--

INSERT INTO `f_comments` (`likesID`, `productID`, `comments`) VALUES
(1, 31, 'This is a test'),
(2, 51, 'This is a test'),
(3, 51, 'This is a test 2'),
(4, 51, 'This is a test 3'),
(5, 51, 'Zoom Zoom'),
(6, 191, 'Smooth Ride'),
(7, 231, 'Cart fits a cooler nicely!');

-- --------------------------------------------------------

--
-- Table structure for table `f_product`
--

CREATE TABLE `f_product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(40) NOT NULL,
  `productDescription` varchar(300) NOT NULL,
  `productImage` varchar(300) NOT NULL,
  `brandID` int(11) NOT NULL COMMENT 'FOREIGN',
  `categoryID` int(11) NOT NULL COMMENT 'FOREIGN',
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `f_product`
--

INSERT INTO `f_product` (`productID`, `productName`, `productDescription`, `productImage`, `brandID`, `categoryID`, `price`) VALUES
(21, 'Model 3', '310 mile range, 0-60 mpg 3.5 seconds', 'https://www.tesla.com/content/dam/tesla-site/sx-redesign/img/model3-proto/specs/compare-model3--right.png', 21, 51, '45002.00'),
(31, 'Model S', '315 range, 518 horsepower, 6 hour ', 'https://otomotopl-imagestmp.akamaized.net/images_otomotopl/877108315_1_1080x720_p90d-pakiet-premium-pelna-opcja-dozywotnie-ladowanie-1wl-fvat-warszawa.jpg\r\n', 21, 51, '77000.00'),
(41, 'Model X', '289 mile range, 518 horsepower, 0-', 'https://s3.amazonaws.com/myev-data/listing/0001/11/thumb_10594_listing_big.jpeg\r\n', 21, 51, '83000.00'),
(51, 'Zero S', 'Top speed 95mph, Range ', 'https://www.plugincars.com/sites/default/files/zero-s-studio-620.jpg\r\n', 31, 61, '11000.00'),
(61, 'Zero SR', 'Top speed 95mph', 'https://www.chuckhawks.com/zero_SR.jpg\r\n', 31, 61, '16500.00'),
(71, 'Zero DS', 'Top speed 98 mph, Rang', 'https://gearmoose.com/wp-content/uploads/2013/10/2013-zero-ds-electric-motorcycle.jpg\r\n', 31, 61, '11000.00'),
(81, 'Zero DSR', '102 mph top speed Range', 'https://www.tflcar.com/wp-content/uploads/2016/03/2016_zero_dsr_01-620x589.jpg\r\n', 31, 61, '16500.00'),
(91, 'Zero FX', 'Top Speed 85 mpg, Range:', 'https://www.cyclenews.com/wp-content/uploads/2018/06/2018-zero-fx-2.jpg\r\n', 31, 61, '9000.00'),
(101, 'Zero FXS', 'Top Speed 85 mpg, Range ', 'http://media.zeromotorcycles.com/gallery-2016/zero-fxs/location/large/2016_zero-fxs_action-06_777x555_gallery.jpg\r\n', 31, 61, '9000.00'),
(111, 'Bamboo GTX Street', 'Top Speed 26mph Ran', 'https://cdn.shopify.com/s/files/1/0869/0934/products/GTX_ST_Main_grande_540x_9d1d0592-53cf-4b96-a9fd-ea9f7576a041_650x.jpg?v=1523890848\r\n', 41, 71, '1560.00'),
(121, 'Bamboo One', 'Top Speed 26 Mph Range 21 ', 'https://cdn.shopify.com/s/files/1/0869/0934/products/281a4930-abf3-51fa-95c8-d4112a1264d2_52cd2c6e-50f3-421b-8662-c5e59f5af8eb_900x.png?v=1534787914\r\n', 41, 71, '800.00'),
(131, 'GT Carbon Series', 'Top Speed 26mph Rang', 'https://cdn.shopify.com/s/files/1/1472/8356/products/Evolve_Skateboards_Bamboo_GTX_Series_All_Terrain_20_grande.jpg?v=1541045682\r\n', 41, 71, '1960.00'),
(141, 'E Prime', 'Electric Scooter 15 mph speed Range ', 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6255/6255464_sd.jpg;maxHeight=640;maxWidth=550\r\n', 51, 81, '379.00'),
(151, 'E300', 'Electric Scooter 15 mph speed Range 45 ', 'https://www.razor.com/wp-content/uploads/2018/04/e300_whbl_product-700x1024.png\r\n', 51, 81, '279.00'),
(161, 'E150', 'Electric Scooter 10 mph speed, Range 40', 'https://www.razor.com/wp-content/uploads/2018/08/e150_pu_product.png\r\n', 51, 81, '159.00'),
(171, 'Eco Smart Metro', 'Electric Scooter 18mph Speed', 'https://images-na.ssl-images-amazon.com/images/I/61W7KDUnXlL._SX679_.jpg\r\n', 51, 81, '469.00'),
(181, 'E200S', 'Electric Scooter Seated 12 mph speed R', 'https://www.myproscooter.com/wp-content/uploads/2018/05/41mBN2BGzDeL.jpg\r\n', 51, 81, '259.00'),
(191, 'Galaxy ST', '50 mile range', 'https://i0.wp.com/electricbikereport.com/wp-content/uploads/2017/09/EVELO-Galaxy-ST-electric-bike-3.jpg?fit=1200%2C900&ssl=1&w=640\r\n', 61, 91, '2999.00'),
(201, 'Aurora', '40 mile range', 'https://www.bestcyclebikes.com/wp-content/uploads/EVELO-Aurora-Electric-Bike-with-Shimano-Alivio-8-Speed-Drivetrain-250W-Mid-Drive-Motor-White-0-0.jpg\r\n', 61, 91, '2999.00'),
(211, 'Delta X', '45 mile range', 'https://biketoday.news/storage/articles/1896/1531757872.jpg\r\n', 61, 91, '3999.00'),
(221, 'Quest Max', '40 mile range', 'https://www.evelo.com/wp-content/uploads/2017/09/quest-max-steel-gray.jpg\r\n', 61, 91, '2999.00'),
(231, 'Compass', '50 mile range', 'https://www.evelo.com/wp-content/uploads/2017/10/compass-featured.jpg\r\n', 61, 91, '3299.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `f_brands`
--
ALTER TABLE `f_brands`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `f_category`
--
ALTER TABLE `f_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `f_comments`
--
ALTER TABLE `f_comments`
  ADD PRIMARY KEY (`likesID`),
  ADD KEY `productID` (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `f_comments`
--
ALTER TABLE `f_comments`
  MODIFY `likesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
