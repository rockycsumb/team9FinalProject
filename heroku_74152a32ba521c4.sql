-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2018 at 02:14 AM
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
(21, 'Model 3', 'Model 3 has a 310 mile range, 0-60 mph acceleration in 3.3 seconds', 'https://www.tesla.com/content/dam/tesla-site/sx-redesign/img/model3-proto/specs/compare-model3--right.png', 21, 51, '45002.00'),
(31, 'Model S', 'Model S has a 315 mile range, 0-60 mph acceleration in 2.5 seconds', 'https://otomotopl-imagestmp.akamaized.net/images_otomotopl/877108315_1_1080x720_p90d-pakiet-premium-pelna-opcja-dozywotnie-ladowanie-1wl-fvat-warszawa.jpg', 21, 51, '77000.00'),
(41, 'Model X', 'Model X has a 295 mile range, 0-60 mph acceleration in 2.9 seconds', 'https://s3.amazonaws.com/myev-data/listing/0001/11/thumb_10594_listing_big.jpeg', 21, 51, '83000.00'),
(51, 'Zero S ZF14.4', 'Zero S ZF14.4  has a range of 90/179 (highway/city) with a top speed of 98 mph', 'https://www.plugincars.com/sites/default/files/zero-s-studio-620.jpg', 31, 61, '13995.00'),
(61, 'Zero SR', 'Zero SR has a range of 112/223 (highway/city) with a top speed of 102 mph', 'https://www.chuckhawks.com/zero_SR.jpg', 31, 61, '16495.00'),
(71, 'Zero DS ZF14.4', 'Zero DS ZF14.4 has a range of 78/163 (highway/city) with a top speed of 98 mph', 'https://gearmoose.com/wp-content/uploads/2013/10/2013-zero-ds-electric-motorcycle.jpg', 31, 61, '13995.00'),
(81, 'Zero DSR', 'Zero DSR has a range of 78/163 (highway/city) with a top speed of 102 mph', 'https://www.tflcar.com/wp-content/uploads/2016/03/2016_zero_dsr_01-620x589.jpg', 31, 61, '16495.00'),
(91, 'Zero FX ZF7.2', 'Zero FX ZF7.2 has a range of 39/91 (highway/city) with a top speed of 85 mph', 'https://www.cyclenews.com/wp-content/uploads/2018/06/2018-zero-fx-2.jpg', 31, 61, '10495.00'),
(101, 'Zero FXS ZF7.2', 'Zero FXS ZF7.2 has a range of 40/100 (highway/city) with a top speed of 85 mph', 'http://media.zeromotorcycles.com/gallery-2016/zero-fxs/location/large/2016_zero-fxs_action-06_777x555_gallery.jpg', 31, 61, '10495.00'),
(111, 'Bamboo GTX Street', 'The Bamboo GTX Street has a range up to 31 miles with a top speed of 26 mph', 'https://cdn.shopify.com/s/files/1/0869/0934/products/GTX_ST_Main_grande_540x_9d1d0592-53cf-4b96-a9fd-ea9f7576a041_650x.jpg?v=1523890848', 41, 71, '1560.00'),
(121, 'Bamboo One', 'The Bamboo One has a range up to 21 miles with a top speed of 22 mph', 'https://cdn.shopify.com/s/files/1/0869/0934/products/281a4930-abf3-51fa-95c8-d4112a1264d2_52cd2c6e-50f3-421b-8662-c5e59f5af8eb_900x.png?v=1534787914', 41, 71, '999.00'),
(131, 'GT Carbon Series', 'The GT Carbon Series has a range up to 31 miles with a top speed of 26 mph', 'https://cdn.shopify.com/s/files/1/1472/8356/products/Evolve_Skateboards_Bamboo_GTX_Series_All_Terrain_20_grande.jpg?v=1541045682', 41, 71, '1959.99'),
(141, 'E Prime', 'The Razor E Prime Scooter has a top speed of 15 mph and 40 minute battery life', 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6255/6255464_sd.jpg;maxHeight=640;maxWidth=550', 51, 81, '379.00'),
(151, 'E300', 'The Razor E300 Scooter has a top speed of 15 mph and 40 minute battery life', 'https://www.razor.com/wp-content/uploads/2018/04/e300_whbl_product-700x1024.png', 51, 81, '255.99'),
(161, 'E150', 'The Razor E150 Scooter has a top speed of 10 mph and 40 minute battery life', 'https://www.razor.com/wp-content/uploads/2018/08/e150_pu_product.png', 51, 81, '159.00'),
(171, 'Eco Smart Metro', 'The Eco Smart Metro Scooter has a top speed of 18 mph and 40 minute battery life', 'https://images-na.ssl-images-amazon.com/images/I/61W7KDUnXlL._SX679_.jpg', 51, 81, '349.99'),
(181, 'E200S', 'The Razor E200S has a top speed of 12 mph and a battery life of 45 minutes', 'https://www.myproscooter.com/wp-content/uploads/2018/05/41mBN2BGzDeL.jpg', 51, 81, '259.99'),
(191, 'Galaxy ST', 'The Galaxy ST has a top speed of 20 mph and range of 30/50 miles (electric/assisted)', 'https://i0.wp.com/electricbikereport.com/wp-content/uploads/2017/09/EVELO-Galaxy-ST-electric-bike-3.jpg?fit=1200%2C900&ssl=1&w=640', 61, 91, '2999.00'),
(201, 'Aurora', 'The Aurora has a top speed of 20 mph and range of 20/40 miles (electric/assisted)', 'https://www.bestcyclebikes.com/wp-content/uploads/EVELO-Aurora-Electric-Bike-with-Shimano-Alivio-8-Speed-Drivetrain-250W-Mid-Drive-Motor-White-0-0.jpg', 61, 91, '2999.00'),
(211, 'Delta X', 'The Delta X has a top speed of 20 mph and range of 20/45 miles (electric/assisted)', 'https://biketoday.news/storage/articles/1896/1531757872.jpg', 61, 91, '3999.00'),
(221, 'Quest Max', 'The Quest Max has a top speed of 20 mph and range of 20/40 miles (electric/assisted)', 'https://www.evelo.com/wp-content/uploads/2017/09/quest-max-steel-gray.jpg', 61, 91, '2999.00'),
(231, 'Compass', 'The Compass has a top speed of 18 mph and range of 30/50 miles (electric/assisted)', 'https://www.evelo.com/wp-content/uploads/2017/10/compass-featured.jpg', 61, 91, '3299.00');

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
