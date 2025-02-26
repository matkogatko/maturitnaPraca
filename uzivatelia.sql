-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 26.Feb 2025, 10:21
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `uzivatelia`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`) VALUES
(30, 8, 19, 'S', 1, '2025-02-24 23:14:44'),
(38, 8, 18, '40', 1, '2025-02-25 09:17:20'),
(39, 10, 17, '40', 1, '2025-02-25 11:59:14'),
(40, 10, 16, 'L', 1, '2025-02-25 11:59:21');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`) VALUES
(7, 7, 330.00, '2025-02-25 18:38:23');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `quantity`, `price`) VALUES
(2, 7, 18, '40', 1, 280.00),
(3, 7, 16, 'S', 1, 50.00);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image`, `created_at`) VALUES
(16, 'juice world T-shirt', '', 50.00, 'clothing', 'img/juice.webp', '2025-02-24 20:12:29'),
(17, 'Nike AF1 Supreme', 'Limited edition', 200.00, 'sneakers', 'img/sup.webp', '2025-02-24 22:13:30'),
(18, 'Nike Jordan 4 Seafoam', '', 280.00, 'sneakers', 'img/jordan4 seafoam.webp', '2025-02-24 22:13:56'),
(19, 'Spider Hoodie', '', 95.00, 'clothing', 'img/spidey.webp', '2025-02-24 22:14:23'),
(22, 'Nike Jordan 4 military white', '', 350.00, 'sneakers', 'img/military.webp', '2025-02-24 22:17:19'),
(25, 'Gap T-shirt', 'tricko', 40.00, 'clothing', 'img/gap.webp', '2025-02-25 12:01:10');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `Age`, `Password`, `address`, `role`, `status`) VALUES
(6, 'admin_product', 'adminproduct@gmail.com', 25, 'admin', '', 'admin_for_products', 'active'),
(7, 'mato', 'mato@gmail.com', 2, 'mato', '', 'user', 'active'),
(8, 'adminuser', 'adminuser@gmail.com', 45, 'admin', '', 'admin_for_users', 'active'),
(10, 'martin', 'martin@gmail.com', 15, 'martin', '', 'user', 'active'),
(11, 'miso', 'miso@gmail.com', 88, 'miso', 'intrak', 'user', 'blocked');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexy pre tabuľku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexy pre tabuľku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pre tabuľku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
