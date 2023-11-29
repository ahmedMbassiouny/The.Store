-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: systemanalysis.cgayjjlx0fgo.eu-north-1.rds.amazonaws.com:3306
-- Generation Time: 29 نوفمبر 2023 الساعة 00:46
-- إصدار الخادم: 8.0.33
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `The.Store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `Cart`
--

CREATE TABLE `Cart` (
  `CartID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `ProductID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Cart`
--

INSERT INTO `Cart` (`CartID`, `UserID`, `ProductID`, `Quantity`) VALUES
(4, 5, 33, 5),
(14, 9, 33, 5),
(36, 14, 3, 1),
(37, 14, 4, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `Categories`
--

CREATE TABLE `Categories` (
  `categoryID` int NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `imgURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Categories`
--

INSERT INTO `Categories` (`categoryID`, `categoryName`, `imgURL`) VALUES
(1, 'Electronics', 'https://i.postimg.cc/K86CvMTy/cate-2.png'),
(2, 'Jewelery', 'https://i.postimg.cc/k5WzVgNR/cate-4.png'),
(3, 'Men\'s Clothing', 'https://i.postimg.cc/gJD7DtTY/cate-3.png'),
(4, 'Women\'s Clothing', 'https://i.postimg.cc/Pxhc1nK3/cate-1.png'),
(5, 'kids Clothings', 'https://i.postimg.cc/3N82LMQg/output-onlinepngtools.png');

-- --------------------------------------------------------

--
-- بنية الجدول `OrderDetails`
--

CREATE TABLE `OrderDetails` (
  `orderDetailID` int NOT NULL,
  `orderID` int DEFAULT NULL,
  `productID` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `OrderDetails`
--

INSERT INTO `OrderDetails` (`orderDetailID`, `orderID`, `productID`, `quantity`, `subtotal`) VALUES
(1, 13, 5, 1, '47999.00'),
(20, NULL, 49, 3, '2999.97'),
(21, 27, 49, 3, '2999.97'),
(22, 27, 40, 1, '695.00'),
(23, 27, 2, 11, '11.00'),
(24, 27, 1, 2, '46.00'),
(25, 28, 49, 3, '2999.97'),
(26, 28, 40, 1, '695.00'),
(27, 28, 2, 11, '11.00'),
(28, 28, 1, 2, '46.00'),
(29, 30, 33, 4, '3588.00'),
(30, 30, 33, 4, '3588.00'),
(31, 30, 2, 4, '4.00'),
(32, 30, 2, 4, '4.00'),
(33, 31, 47, 1, '114.00'),
(34, 31, 47, 1, '114.00'),
(35, 32, 45, 5, '545.00'),
(36, 33, 49, 5, '4999.95'),
(37, 35, 48, 2, '1198.00'),
(38, 36, 4, 2, '3980.00');

-- --------------------------------------------------------

--
-- بنية الجدول `Orders`
--

CREATE TABLE `Orders` (
  `orderID` int NOT NULL,
  `userID` int DEFAULT NULL,
  `orderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `additionalPhone` varchar(20) DEFAULT NULL,
  `additionalEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Orders`
--

INSERT INTO `Orders` (`orderID`, `userID`, `orderDate`, `totalAmount`, `address1`, `address2`, `additionalPhone`, `additionalEmail`) VALUES
(13, 14, '2023-11-27 17:22:40', '47999.00', 'giza', 'cairo', '0123', '3210'),
(14, 11, '2023-11-28 00:22:34', '3705.97', 'adwdw', 'wdwdwa', 'ahmed@gmail.com', '0145747'),
(15, 11, '2023-11-28 00:23:30', '3705.97', 'asbdjwb', 'sadwdfe', 'ahmed@gmail.com', '012544'),
(16, 11, '2023-11-28 00:26:22', '3705.97', 'sadefef', 'dfqdwqd', 'ahmed@gmail.com', '0125468'),
(17, 11, '2023-11-28 00:27:09', '3705.97', 'sadefef', 'dfqdwqd', 'ahmed@gmail.com', '0125468'),
(18, 11, '2023-11-28 00:27:41', '3705.97', 'sadefef', 'dfqdwqd', 'ahmed@gmail.com', '0125468'),
(19, 11, '2023-11-28 00:28:29', '3705.97', 'sadefef', 'dfqdwqd', 'ahmed@gmail.com', '0125468'),
(20, 11, '2023-11-28 00:28:47', '3705.97', 'sadefef', 'dfqdwqd', 'ahmed@gmail.com', '0125468'),
(21, 11, '2023-11-28 00:30:33', '3705.97', 'sadefef', 'dfqdwqd', 'ahmed@gmail.com', '0125468'),
(22, 11, '2023-11-28 00:30:54', '3705.97', 'dfwdwd', 'awdwad', 'ahmed@gmail.com', '01144'),
(23, 11, '2023-11-28 00:32:20', '3705.97', 'dfwdwd', 'awdwad', 'ahmed@gmail.com', '01144'),
(24, 11, '2023-11-28 00:32:35', '3705.97', 'sadw', 'wdqwd', 'ahmed@gmail.com', '01244'),
(25, 11, '2023-11-28 00:34:14', '3705.97', 'wdad', 'wdawd', 'ahmed@gmail.com', '01244'),
(26, 11, '2023-11-28 00:35:51', '3705.97', 'adwd', 'awdwad', 'ahmed@gmail.com', '01445'),
(27, 11, '2023-11-28 00:37:49', '3705.97', 'adwd', 'awdwad', 'ahmed@gmail.com', '01445'),
(28, 11, '2023-11-28 00:38:04', '3705.97', 'adwd', 'awdwad', 'ahmed@gmail.com', '01445'),
(29, 11, '2023-11-28 01:03:18', '3592.00', 'sadwad', 'wdawd', 'ahmed@gmail.com', '01245'),
(30, 11, '2023-11-28 01:04:22', '3592.00', 'sadwad', 'wdawd', 'ahmed@gmail.com', '01245'),
(31, 11, '2023-11-28 01:10:02', '114.00', 'rgseg', 'wdwa', 'ahmed@gmail.com', '012548'),
(32, 11, '2023-11-28 01:20:37', '545.00', 'awdwd', 'wdawd', 'ahmed@gmail.com', '012444'),
(33, 11, '2023-11-28 01:22:45', '4999.95', 'dwd', 'wdadwa', 'ahmed@gmail.com', '0124456'),
(34, 11, '2023-11-28 02:57:51', '1198.00', 'sadwd', 'wdawd', 'ahmed@gmail.com', '012'),
(35, 11, '2023-11-28 02:58:47', '1198.00', 'sadwd', 'wdawd', 'ahmed@gmail.com', '012'),
(36, 14, '2023-11-28 03:19:59', '3980.00', '53 New Freeway', '52 North Old Drive', 'gupawemon@mailinator', '41');

-- --------------------------------------------------------

--
-- بنية الجدول `Products`
--

CREATE TABLE `Products` (
  `productID` int NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `stockQuantity` int DEFAULT NULL,
  `numSales` int DEFAULT '0',
  `categoryID` int DEFAULT NULL,
  `imgURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Products`
--

INSERT INTO `Products` (`productID`, `productName`, `description`, `price`, `stockQuantity`, `numSales`, `categoryID`, `imgURL`) VALUES
(1, 'John Hardy 5mm Legends Naga Bracelet', 'According to Balinese legend, Naga, the water dragon, symbolizes protection and prosperity. From our Legends Collection, Naga imbues this artisan-made bracelet (5mm) with unmistakable meaning. Its blue sapphire eyes and shimmering black sapphire mesmerize. Wear facing inward to be bestowed with love and abundance, or outward for protection. Wear it alone or as part of a stack.', '23.00', 0, 0, 2, 'https://knar.com/wp-content/uploads/2020/05/John-Hardy-HRD02558-Reference-No-BBS601884BLSBNXM-main.jpg'),
(2, 'John Hardy Legends Naga Drop Earrings', 'According to Balinese legend, Naga, the water dragon, symbolizes protection and prosperity. From our Legends Collection, Naga imbues these artisan-made earrings with unmistakable meaning. Earring measures 55.5mm long.', '1.00', 2, 0, 2, 'https://knar.com/wp-content/uploads/2021/07/John_Hardy_EBS60241BSP_Main.jpg'),
(3, 'Fabergé Heritage White Gold Royal Blue Enamel Petite Pendant', 'The Heritage collection draws inspiration from Fabergé’s historical masterpieces. Traditional materials and complex traditional techniques, such as the delicate art of guilloché enameling and hand-engraving, make up the signature elements of this colourful and opulent collection.', '10.00', 1, 0, 2, 'https://knar.com/wp-content/uploads/2022/09/Faberge-Necklace_213FP1351.jpg'),
(4, 'Apple iPhone 14 Pro Max', 'Apple iPhone 14 Pro Max (256 GB) - Deep Purple - Physical Dual Sim, Bluetooth, Wi-Fi, USB, NFC', '1990.00', 3, 2, 1, 'https://m.media-amazon.com/images/I/71yzJoE7WlL._AC_SX679_.jpg'),
(5, 'Samsung Galaxy S23 Ultra', 'Samsung Galaxy S23 Ultra, Mobile Phone, Dual SIM, 5G, Android Smartphone, 256GB - 12 GB RAM, Lavender, 1 Year Manufacturer Warranty', '47999.00', 50, 1, 1, 'https://m.media-amazon.com/images/I/7169yB5EVCL._AC_SX679_.jpg'),
(6, 'Samsung Galaxy M52', 'Samsung Galaxy M52 - Dual SIM, 8GB RAM, 128GB, 5G - White - 1 year Warranty', '100.00', 2, 0, 1, 'https://m.media-amazon.com/images/I/612o96Hxi-L._AC_SY879_.jpg'),
(33, 'First Kids Boys Embroidered Jersey 14811', 'About this item Made of soft and comfortable fabric Perfect gift for children. Suitable for summer and easy to store', '897.00', 90, 4, 5, 'https://m.media-amazon.com/images/I/51AVSTi1w6L._AC_SX466_.jpg'),
(36, 'Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops', 'Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday', '19.95', 12, 0, 3, 'https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg'),
(37, 'Mens Casual Premium Slim Fit T-Shirts', 'Slim-fitting style, contrast raglan long sleeve, three-button henley placket, light weight & soft fabric for breathable and comfortable wearing. And Solid stitched shirts with round neck made for durability and a great fit for casual fashion wear and diehard baseball fans. The Henley style round neckline includes a three-button placket.', '22.30', 0, 0, 3, 'https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg'),
(38, 'Mens Cotton Jacket', 'Great outerwear jackets for Spring/Autumn/Winter, suitable for many occasions, such as working, hiking, camping, mountain/rock climbing, cycling, traveling or other outdoors. Good gift choice for you or your family member. A warm-hearted love to Father, husband or son in this thanksgiving or Christmas Day.', '55.99', 19, 0, 3, 'https://fakestoreapi.com/img/71li-ujtlUL._AC_UX679_.jpg'),
(39, 'Mens Casual Slim Fit', 'The color could be slightly different between on the screen and in practice. / Please note that body builds vary by person, therefore, detailed size information should be reviewed below on the product description.', '15.99', 2, 0, 3, 'https://fakestoreapi.com/img/71YXzeOuslL._AC_UY879_.jpg'),
(40, 'John Hardy Women\'s Legends Chain Bracelet', 'From our Legends Collection, the Naga was inspired by the mythical water dragon that protects the ocean\'s pearl. Wear facing inward to be bestowed with love and abundance, or outward for protection.', '695.00', 16, 0, 2, 'https://fakestoreapi.com/img/71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg'),
(41, 'Solid Gold Petite Micropave', 'Satisfaction Guaranteed. Return or exchange any order within 30 days. Designed and sold by Hafeez Center in the United States. Satisfaction Guaranteed. Return or exchange any order within 30 days.', '168.00', 9, 0, 2, 'https://fakestoreapi.com/img/61sbMiUnoGL._AC_UL640_QL65_ML3_.jpg'),
(42, 'White Gold Plated Princess', 'Classic Created Wedding Engagement Solitaire Diamond Promise Ring for Her. Gifts to spoil your love more for Engagement, Wedding, Anniversary, Valentine\'s Day...', '9.99', 0, 0, 2, 'https://fakestoreapi.com/img/71YAIFU48IL._AC_UL640_QL65_ML3_.jpg'),
(43, 'Pierced Owl Rose Gold Plated Stainless ', 'Rose Gold Plated Double Flared Tunnel Plug Earrings. Made of 316L Stainless Steel', '10.99', 15, 0, 2, 'https://fakestoreapi.com/img/51UDEzMJVpL._AC_UL640_QL65_ML3_.jpg'),
(44, 'WD 2TB Elements Portable External ', 'USB 3.0 and USB 2.0 Compatibility Fast data transfers Improve PC Performance High Capacity; Compatibility Formatted NTFS for Windows 10, Windows 8.1, Windows 7; Reformatting may be required for other operating systems; Compatibility may vary depending on user’s hardware configuration and operating system', '64.00', 3, 0, 1, 'https://fakestoreapi.com/img/61IBBVJvSDL._AC_SY879_.jpg'),
(45, 'SanDisk SSD PLUS 1TB Internal SSD ', 'Easy upgrade for faster boot up, shutdown, application load and response (As compared to 5400 RPM SATA 2.5” hard drive; Based on published specifications and internal benchmarking tests using PCMark vantage scores) Boosts burst write performance, making it ideal for typical PC workloads The perfect balance of performance and reliability Read/write speeds of up to 535MB/s/450MB/s (Based on internal testing; Performance may vary depending upon drive capacity, host device, OS and application.)', '109.00', 6, 5, 1, 'https://fakestoreapi.com/img/61U7T1koQqL._AC_SX679_.jpg'),
(46, 'Silicon Power 256GB SSD 3D ', '3D NAND flash is applied to deliver high transfer speeds Remarkable transfer speeds that enable faster bootup and improved overall system performance. The advanced SLC Cache Technology allows performance boost and longer lifespan 7mm slim design suitable for Ultrabooks and Ultra-slim notebooks. Supports TRIM command, Garbage Collection technology, RAID, and ECC (Error Checking & Correction) to provide the optimized performance and enhanced reliability.', '109.00', 5, 0, 1, 'https://fakestoreapi.com/img/71kWymZ+c+L._AC_SX679_.jpg'),
(47, 'WD 4TB Gaming Drive Works ', 'Expand your PS4 gaming experience. Fast and easy setup, sleek design with high capacity. 3-year limited warranty.', '114.00', 4, 0, 1, 'https://fakestoreapi.com/img/61mtL65D4cL._AC_SX679_.jpg'),
(48, 'Acer SB220Q bi 21.5 inches ', '21.5-inch Full HD widescreen IPS display with Radeon Free Sync technology. Ultra-thin design with 4ms response time. 75Hz refresh rate.', '599.00', 4, 2, 1, 'https://fakestoreapi.com/img/81QpkIctqPL._AC_SX679_.jpg'),
(49, 'Samsung 49-Inch CHG90 144Hz ', '49-inch super ultrawide curved gaming monitor. Quantum Dot technology, HDR support. 144Hz refresh rate, 1ms response time.', '999.99', 13, 5, 1, 'https://fakestoreapi.com/img/81Zt42ioCgL._AC_SX679_.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `Promocode`
--

CREATE TABLE `Promocode` (
  `promocode` varchar(255) NOT NULL,
  `discount` int DEFAULT NULL
) ;

--
-- إرجاع أو استيراد بيانات الجدول `Promocode`
--

INSERT INTO `Promocode` (`promocode`, `discount`) VALUES
('Bassiouny90', 90),
('hazemProblemSolver90', 10);

-- --------------------------------------------------------

--
-- بنية الجدول `Users`
--

CREATE TABLE `Users` (
  `userID` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `DateOfCreation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('customer','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Users`
--

INSERT INTO `Users` (`userID`, `username`, `password`, `email`, `phone`, `DateOfCreation`, `role`) VALUES
(1, 'Hossam', '1234', 'Hossam@customer.com', '1234567890', '2023-11-24 18:09:52', 'customer'),
(2, 'Hossam', '1234', 'Hossam@admin.com', '1234567890', '2023-11-24 18:09:52', 'admin'),
(3, 'Ahmed_Bassiouny', '1234', 'Ahmed_Bassiouny@customer.com', '1234567890', '2023-11-24 18:09:52', 'customer'),
(4, 'Ahmed_Bassiouny', '1234', 'Ahmed_Bassiouny@admin.com', '1234567890', '2023-11-24 18:09:52', 'admin'),
(5, 'Hazem_Ahmed', '1234', 'Hazem_Ahmed@customer.com', '1234567890', '2023-11-24 18:09:52', 'customer'),
(6, 'Hazem_Ahmed', '1234', 'Hazem_Ahmed@admin.com', '1234567890', '2023-11-24 18:09:52', 'admin'),
(7, 'Ahmed_Makboul', '1234', 'Ahmed_Makboul@customer.com', '1234567890', '2023-11-24 18:09:52', 'customer'),
(8, 'Ahmed_Makboul', '1234', 'Ahmed_Makboul@admin.com', '1234567890', '2023-11-24 18:09:52', 'admin'),
(9, 'Omar', '1234', 'Omar@customer.com', '1234567890', '2023-11-24 18:09:52', 'customer'),
(10, 'Omar', '1234', 'Omar@admin.com', '1234567890', '2023-11-24 18:09:52', 'admin'),
(11, 'Ahmed', '1234', 'Ahmed@customer.com', '1234567890', '2023-11-24 18:09:53', 'customer'),
(12, 'Ahmed', '1234', 'Ahmed@admin.com', '1234567890', '2023-11-24 18:09:53', 'admin'),
(13, 'Regina Little', 'Pa$$w0rd!', 'culy@mailinator.com', '+1 (815) 452-9985', '2023-11-26 05:15:25', 'admin'),
(14, 'cust', 'cust', 'cust', '123456789', '2023-11-26 05:23:38', 'customer'),
(15, 'Whitney Silva', 'Pa$$w0rd!', 'cequjat@mailinator.com', '+1 (193) 394-4999', '2023-11-27 02:49:53', 'customer'),
(16, 'Irma Harrell', 'Pa$$w0rd!', 'hupon@mailinator.com', '+1 (127) 493-9332', '2023-11-27 03:45:40', 'customer'),
(17, 'Jayme Berger', 'Pa$$w0rd!', 'menebezi@mailinator.com', '+1 (651) 418-7371', '2023-11-27 03:50:15', 'customer'),
(18, 'Hope Meyers', 'Pa$$w0rd!', 'hatyrekeci@mailinator.com', '+1 (428) 914-6643', '2023-11-27 03:51:43', 'customer'),
(19, 'Victor Wall', 'Pa$$w0rd!', 'wemopi@mailinator.com', '+1 (526) 149-5777', '2023-11-27 03:52:42', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `Promocode`
--
ALTER TABLE `Promocode`
  ADD PRIMARY KEY (`promocode`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `CartID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `categoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  MODIFY `orderDetailID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `orderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `productID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`userID`),
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`productID`);

--
-- القيود للجدول `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD CONSTRAINT `OrderDetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `Orders` (`orderID`),
  ADD CONSTRAINT `OrderDetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`);

--
-- القيود للجدول `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);

--
-- القيود للجدول `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `Products_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `Categories` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
