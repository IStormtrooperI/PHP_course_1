-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 19 2020 г., 10:24
-- Версия сервера: 5.6.47
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rent`
--

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `price_per_month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `type`, `price_per_month`) VALUES
(3, 'двухкомнатная квартира', 125447),
(4, 'трехкомнатная квартира', 11200),
(5, 'однокомнатная квартира', 200000),
(6, 'Туалет', 5000),
(7, 'двухкомнатная квартира', 13),
(8, 'двухкомнатная квартира', 486219),
(9, 'трехкомнатная квартира', 312412),
(10, 'трехкомнатная квартира', 12432412),
(11, 'однокомнатная квартира', 32143324),
(12, 'однокомнатная квартира', 4325134),
(13, 'Туалет', 41265),
(14, 'Туалет', 645745);

-- --------------------------------------------------------

--
-- Структура таблицы `rental_details`
--

CREATE TABLE `rental_details` (
  `id` int(11) NOT NULL,
  `id_objects` int(11) NOT NULL,
  `id_tenants` int(11) NOT NULL,
  `rent_start_date` date NOT NULL,
  `duration_month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rental_details`
--

INSERT INTO `rental_details` (`id`, `id_objects`, `id_tenants`, `rent_start_date`, `duration_month`) VALUES
(12, 3, 3, '2020-12-01', 3),
(13, 4, 5, '2020-12-02', 2),
(14, 5, 5, '2021-01-14', 2),
(15, 3, 3, '2018-01-05', 2),
(16, 3, 6, '2023-01-14', 2),
(17, 3, 3, '2020-02-05', 1),
(18, 3, 3, '2011-01-14', 13),
(19, 3, 3, '2009-01-14', 14),
(20, 3, 3, '2002-01-01', 15),
(21, 6, 3, '2020-12-01', 1),
(22, 6, 3, '2020-01-14', 1),
(23, 6, 3, '2020-10-14', 1),
(24, 7, 5, '2020-01-14', 1),
(25, 7, 3, '2020-03-14', 1),
(26, 7, 6, '2020-05-14', 1),
(27, 6, 3, '2021-02-28', 1),
(28, 7, 5, '2022-02-14', 2),
(29, 6, 3, '2016-01-14', 13),
(30, 6, 3, '2024-05-14', 14),
(31, 6, 3, '2008-01-14', 13),
(32, 13, 3, '2020-12-01', 14),
(33, 13, 5, '2016-01-14', 14),
(34, 13, 3, '2027-05-14', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `passport` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tenants`
--

INSERT INTO `tenants` (`id`, `surname`, `passport`) VALUES
(3, 'Алтынбеков', 1344567890),
(5, 'Нестеров', 1234567890),
(6, 'Фавилев', 1344567820);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rental_details`
--
ALTER TABLE `rental_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_details_ibfk_1` (`id_objects`),
  ADD KEY `rental_details_ibfk_2` (`id_tenants`);

--
-- Индексы таблицы `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `rental_details`
--
ALTER TABLE `rental_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `rental_details`
--
ALTER TABLE `rental_details`
  ADD CONSTRAINT `rental_details_ibfk_1` FOREIGN KEY (`id_objects`) REFERENCES `objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rental_details_ibfk_2` FOREIGN KEY (`id_tenants`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
