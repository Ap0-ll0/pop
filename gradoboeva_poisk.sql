-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 16 2024 г., 10:52
-- Версия сервера: 10.11.10-MariaDB-ubu2204
-- Версия PHP: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gradoboeva_poisk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `resum_pols`
--

CREATE TABLE `resum_pols` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `drug_spec_discrip` varchar(255) NOT NULL DEFAULT 'Нет',
  `specialization` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` set('В поиске','Есть отклик') NOT NULL DEFAULT 'В поиске'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `resum_pols`
--

INSERT INTO `resum_pols` (`id`, `name`, `photo`, `experience`, `email`, `phone`, `description`, `drug_spec_discrip`, `specialization`, `user_id`, `status`) VALUES
(9, 'бэмс', '42de4488bc2d85bb8818e548a537614aca5e6a4d7f731183d4ddc42a07b33235.png', 'нету', 'let@gmail.com', '3423', 'вот так вот', 'Нет', 2, 8, 'В поиске'),
(12, 'Ивонов Иван Иванович', '42de4488bc2d85bb8818e548a537614aca5e6a4d7f731183d4ddc42a07b33235.png', 'нет', 'kruto@gmail.com', '777777777', 'вот это сюрприз', 'Нет', 2, 10, 'В поиске');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Работодатель'),
(3, 'Работник');

-- --------------------------------------------------------

--
-- Структура таблицы `special`
--

CREATE TABLE `special` (
  `id_spec` int(11) NOT NULL,
  `name_spec` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `special`
--

INSERT INTO `special` (`id_spec`, `name_spec`) VALUES
(1, 'Стоматолог'),
(2, 'Массажистка'),
(3, 'Реаниматолог'),
(4, 'Скейтер');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `age`, `gender`, `email`, `phone`, `password`, `role`, `username`, `token`) VALUES
(7, 'ааа ООО ллл', '19', 'женский', 'redflag@gmail.com', '0000000', '$2y$13$0ioBOlbeSHkTZckfQh7R0ODJzmoYfq.RA6zbtG8MXFRfOqeOEClnG', 1, 'popop', '8ues1KT3oFb6nW_BC8Uqb2cQ-Ye6Rq18'),
(8, 'Уга буга угавна', '19', 'женский', 'stoler@gmail.com', '8912345458667', '$2y$13$.lZwv0WcAQtSQTjEEDfu2egB0DQ/zxvlnne3P.1OVA.Ccxs698wla', 2, 'ula', 'EQ71DIUfJ3fyI0BjA-FOpHZztdHNVYma'),
(9, 'Уга буга угавна', '19', 'женский', 'stolr@gmail.com', '89123454586', '$2y$13$ywGfG98xroyhUIffZHlKee8afN7kezVqsM4ruUPIGVnL07hvoaDTq', 2, 'ulaga', 'ctzMw13d8AKr6do7Zbx5ySbDJfcfSkt4'),
(10, 'Ивонов Иван Иванович', '20', 'мужской', 'kruto@gmail.com', '0000000', '$2y$13$L.FQIcTQLhc2UnW7Z43pk.oVZKQDvydWT/Y.Z3Xfwc6SwFzIFBnoC', 3, 'Ivan', 'c2mr59aWRziXlE_SAcHd5UyWLl2JEthV');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `resum_pols`
--
ALTER TABLE `resum_pols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization` (`specialization`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `special`
--
ALTER TABLE `special`
  ADD PRIMARY KEY (`id_spec`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone`,`username`),
  ADD KEY `role` (`role`),
  ADD KEY `age` (`age`),
  ADD KEY `age_2` (`age`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `resum_pols`
--
ALTER TABLE `resum_pols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `special`
--
ALTER TABLE `special`
  MODIFY `id_spec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `resum_pols`
--
ALTER TABLE `resum_pols`
  ADD CONSTRAINT `resum_pols_ibfk_1` FOREIGN KEY (`specialization`) REFERENCES `special` (`id_spec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resum_pols_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
