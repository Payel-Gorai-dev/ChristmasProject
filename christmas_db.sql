-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2026 at 05:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `christmas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `gift_id`, `quantity`, `created_at`) VALUES
(5, 2, 2, 1, '2026-09-10 15:41:01'),
(9, 4, 2, 1, '2026-09-12 14:26:48'),
(10, 6, 1, 1, '2026-09-12 14:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `gift_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `seller_id`, `gift_name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 4, 'Christmas Gift Box', 'A beautiful Christmas surprise gift box for your loved ones.', 499.00, 'https://images.unsplash.com/photo-1617118601021-4992c028fe5d?fm=jpg&q=60&w=800&auto=format&fit=crop', '2026-09-10 14:26:56'),
(2, 4, 'Christmas Teddy Bear', 'A cute teddy bear wearing a Christmas hat.', 799.00, 'https://images.unsplash.com/photo-1602734846297-9299fc2d4703?fm=jpg&q=60&w=800&auto=format&fit=crop', '2026-09-10 14:26:56'),
(3, 4, 'Christmas Chocolate Box', 'Delicious chocolates for a sweet Christmas celebration.', 299.00, 'https://images.unsplash.com/photo-1549007994-cb92caebd54b', '2026-09-10 14:26:56'),
(4, 4, 'Christmas Decoration Set', 'Beautiful Christmas decorations to make your home festive and magical.', 599.00, 'https://images.unsplash.com/photo-1602521879046-b994fcd56190?fm=jpg&q=60&w=800&auto=format&fit=crop', '2026-09-10 16:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Processing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `phone`, `address`, `total_amount`, `order_status`, `created_at`) VALUES
(1, 2, 'Payel Gorai', '645466546466', 'kkgyf', 1598.00, 'Processing', '2026-09-10 15:25:01'),
(2, 2, 'Payel Gorai', '645466546466', 'czcz', 799.00, 'Processing', '2026-09-10 15:25:35'),
(3, 3, 'Payel Gorai', '64321324646', 'hggfhghg', 1497.00, 'Shipped', '2026-09-10 15:51:44'),
(4, 4, 'Payel Gorai', '645466546466', 'hii', 799.00, 'Shipped', '2026-09-10 16:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`, `is_admin`) VALUES
(4, 'Payel Gorai', 'goraipayel77@gmail.com', '$2y$10$fgsJ6hAZ0Bau2kPcNOxcdOMJUSZAJGzLLNOWKbhTwsnG1NwrswkJm', '2026-09-10 16:15:51', 'seller', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`id`, `name`, `message`, `created_at`) VALUES
(1, 'Payel Gorai', 'mnxxsdndfg', '2026-09-10 14:00:51'),
(2, 'Payel Gorai', 'hii', '2026-09-10 14:04:33'),
(3, 'Payel Gorai', 'jhjhjh', '2026-09-10 16:05:56'),
(4, 'Payel Gorai', 'hii', '2026-09-12 14:29:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gifts_seller` (`seller_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gifts`
--
ALTER TABLE `gifts`
  ADD CONSTRAINT `fk_gifts_seller` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
