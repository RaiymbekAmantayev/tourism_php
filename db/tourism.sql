-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 24 2024 г., 16:34
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tourism`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clicks`
--

CREATE TABLE `clicks` (
  `id` int(10) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `number` double NOT NULL,
  `archive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `clicks`
--

INSERT INTO `clicks` (`id`, `name`, `number`, `archive`) VALUES
(5, 'aza', 874755544411, 0),
(11, 'Raiymbek Amantayev', 8747968855, NULL),
(13, 'Сұлтан', 87054741112, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `tourID` int(11) DEFAULT NULL,
  `archive` int(11) DEFAULT NULL,
  `changed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `userID`, `tourID`, `archive`, `changed`) VALUES
(1, 'good job guys', 7, 18, 1, 0),
(3, 'good tour', 6, 23, 1, 0),
(5, 'good job', 14, 23, 1, 0),
(6, 'it\'s so awesome', 14, 22, 1, 0),
(7, 'my fav country', 14, 21, 1, 0),
(8, 'i want to visit this country', 6, 20, 1, 0),
(9, ' I know that is the best tour in the world', 6, 18, 1, 0),
(13, 'testing comment', 14, 23, 1, 0),
(16, 'it was great trip to europe\r\n', 7, 22, 1, 0),
(18, 'Түркияға барғым келеді.', 7, 21, 1, 0),
(19, 'Түркия керемет!', 7, 21, 1, 0),
(20, 'Мексикаға бару қымбат екен!', 17, 23, 1, 0),
(22, 'it was best tour i\'ve been ever!!!', 7, 20, 1, 1),
(23, 'hello guys', 7, 22, NULL, 0),
(24, 'good job', 7, 27, NULL, 0),
(25, 'hi', 7, 19, NULL, 0),
(26, 'privet', 7, 17, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `tourID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `response`
--

INSERT INTO `response` (`id`, `userID`, `tourID`) VALUES
(11, 14, 23),
(12, 14, 21),
(13, 7, 22),
(17, 7, 27),
(19, 7, 21),
(20, 17, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `tour`
--

CREATE TABLE `tour` (
  `id` int(10) NOT NULL,
  `title` varchar(25) NOT NULL,
  `price` int(25) NOT NULL,
  `image` text CHARACTER SET utf8 NOT NULL,
  `datastart` date NOT NULL,
  `dataend` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tour`
--

INSERT INTO `tour` (`id`, `title`, `price`, `image`, `datastart`, `dataend`) VALUES
(17, 'Мальдивы', 350000, 'мальдивы.jpg', '2023-11-01', '2023-11-10'),
(18, 'Индонезия', 300000, 'id.jpg', '2023-11-13', '2023-11-30'),
(19, 'Швейцария', 500000, 'sw2.jpg', '2023-11-26', '2023-12-10'),
(20, 'Египет', 300000, 'egypt.jpg', '2023-11-30', '2023-12-10'),
(21, 'Турция', 400000, 'турция.jpg', '2023-11-30', '2023-11-30'),
(22, 'Италия', 500000, 'itjpg.jpg', '2023-12-17', '2023-11-30'),
(23, 'Mexica', 300000, 'mx.jpg', '2023-11-30', '2023-12-09'),
(27, 'Жапония', 450000, 'Без названия (2).jpg', '2023-12-31', '2024-01-05');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `login` varchar(25) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES
(1, 'Raiymbek', 'amantayev', '$2y$10$I11mClc/enAOcE3NrfJWp.h'),
(3, 'jake', 'jjj', '$2y$10$8CMKQsOGxm8qjteiMcZsj.G'),
(6, 'User', 'user', '$2y$10$82LB2rS8tUePDLmIRzCViuK2EbTJ7IUQMOdLRSVVMJmnnEXigzqGS'),
(7, 'Sultan', 'sultan', '$2y$10$UADaXPL70pZmuKKpqTII8emAVunD.eWeDy.xncoHGoEDBu2VRl9h2'),
(10, 'Raiymbek Amantayev', 'Raim', '$2y$10$EeCrSgyrDXpo9Rfb0g9LV.UsMEXcIWPU7q6jqZNH10n7vlBdQ3J/6'),
(14, 'Raim', 'Raiymbek', '$2y$10$jxRXWvqZSmKF0nSqCO4LReW3kGvnaAcnjeAsTadNtIB8U0hEjkR1O'),
(17, 'Qanat', 'qanat', '$2y$10$QdSDYhoe8/xFndLz0ZwoDul2CmuZdnSlMJuufyg70l/xjGZTRD2dK'),
(18, 'admin', 'admin', '$2y$10$iVOwxTVIRTPYcXtUS83eh.4InD3iq65Za5zB2TTclxHGO1YKjNOCS');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `tourID` (`tourID`);

--
-- Индексы таблицы `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `tourID` (`tourID`);

--
-- Индексы таблицы `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clicks`
--
ALTER TABLE `clicks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `tour`
--
ALTER TABLE `tour`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`tourID`) REFERENCES `tour` (`id`);

--
-- Ограничения внешнего ключа таблицы `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`tourID`) REFERENCES `tour` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
