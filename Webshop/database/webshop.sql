-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 apr 2021 om 14:31
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_user_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_token` varchar(255) DEFAULT NULL,
  `password_changed` timestamp NULL DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `admin_user`
--

INSERT INTO `admin_user` (`admin_user_id`, `email`, `password`, `password_token`, `password_changed`, `datetime`) VALUES
(1, 'test@test.nl', '$2y$10$7SjOXOthLIws3mq5wb8IK.9u24db6NQ5JeklIQqkzey1rpJx4qc9K', NULL, NULL, '2021-04-19 18:35:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `active`) VALUES
(1, 'Tafellamp', 'Tafellampen zijn binnenlampen voor op tafel.', 1),
(2, 'Buitenlamp', 'Buitenlampen zijn lampen voor buiten.', 1),
(3, 'Designlamp', 'Designlampen zijn mooie lampen.', 1),
(4, 'Bureaulamp', 'Bureaulampen zijn lampen voor op een bureau.', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(6) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` int(6) NOT NULL,
  `house_number_addon` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` int(66) NOT NULL,
  `emailadres` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `newsletter_subscription` tinyint(1) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`customer_id`, `gender`, `first_name`, `middle_name`, `last_name`, `street`, `house_number`, `house_number_addon`, `zip_code`, `city`, `phone`, `emailadres`, `password`, `newsletter_subscription`, `date_added`) VALUES
(1, 'male', 'test', 'van', 'testing', 'Teststreet', 5, 'a', '5555TS', 'Test', 65555, 'test@test.nl', '$2y$10$m8k1NWe11e8lpZL5wzvj/OgqWO5vJwu4mdJ5brqwUfaZQbPfRNL8K', 1, '2021-04-22');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `street` text NOT NULL,
  `house_number` int(11) NOT NULL,
  `house_number_addon` varchar(2) NOT NULL,
  `zip_code` text NOT NULL,
  `city` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `shipping_costs` int(11) NOT NULL,
  `payment_method` text NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `shipping_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_per_piece` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `category_id`, `price`, `color`, `weight`, `active`) VALUES
(1, 'Arstid', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 1, 40, 'wit', 300, 1),
(2, 'Buitenlamp', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 1, 40, 'zwart', 300, 1),
(3, 'Gans', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 3, 40, 'goud', 300, 1),
(4, 'Giraf', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 3, 40, 'goud', 300, 1),
(5, 'Hektar', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 4, 40, 'zwart', 300, 1),
(6, 'Jesse', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 4, 40, 'zwart', 300, 1),
(7, 'Lampje', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 3, 40, 'zwart', 300, 1),
(8, 'Llahra', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 3, 40, 'zwart', 300, 1),
(9, 'Struisvogel', 'De lampenkap van textiel geeft een zacht en decoratief licht. Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit. Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt. Voorzien van trekschakelaar. Dit product is CE-gecertificeerd. Goed te completeren met andere lampen uit dezelfde serie.', 3, 40, 'goud', 300, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image`, `active`) VALUES
(1, 1, 'arstid.jpg', 1),
(2, 2, 'buitenlamp.jpg', 1),
(3, 2, 'buitenlamp2.jpg', 1),
(4, 3, 'gans.jpg', 1),
(5, 4, 'giraf.jpg', 1),
(6, 4, 'giraf2.jpg', 1),
(7, 5, 'hektar.jpg', 1),
(8, 6, 'jesse.jpg', 1),
(9, 7, 'lampje.jpg', 1),
(10, 8, 'llahra.jpg', 1),
(11, 9, 'struisvogel.jpg', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `tbl_order_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `bought_date` date NOT NULL DEFAULT current_timestamp(),
  `send_location` text NOT NULL,
  `delivery_choice` text NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `tbl_order_detail_id` int(11) NOT NULL,
  `tbl_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexen voor tabel `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Indexen voor tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`tbl_order_id`);

--
-- Indexen voor tabel `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`tbl_order_detail_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT voor een tabel `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT voor een tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `tbl_order_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `tbl_order_detail_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
