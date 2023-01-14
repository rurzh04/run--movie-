-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 10 2022 г., 01:25
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `arun`
--

-- --------------------------------------------------------

--
-- Структура таблицы `commentary`
--

CREATE TABLE `commentary` (
  `id` int(11) NOT NULL,
  `addDate` int(32) NOT NULL,
  `commName` text NOT NULL,
  `commDescription` text NOT NULL,
  `kinoid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `commentary`
--

INSERT INTO `commentary` (`id`, `addDate`, `commName`, `commDescription`, `kinoid`) VALUES
(81, 1627207666, 'arnat04', 'норм фильм', 35),
(82, 1627239129, 'arnat04', 'фвыфвфвфыв', 34);

-- --------------------------------------------------------

--
-- Структура таблицы `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `addDate` int(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `complaints`
--

INSERT INTO `complaints` (`id`, `login`, `addDate`, `description`) VALUES
(1, 'root', 1626553011, 'arnatarnat adfnkafa');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `addDate` int(32) NOT NULL,
  `itemName` text NOT NULL,
  `itemCost` text NOT NULL,
  `itemCountry` text NOT NULL,
  `itemRaisal` int(9) NOT NULL,
  `itemGenre` int(9) NOT NULL,
  `itemDescription` text NOT NULL,
  `itemMainImg` text NOT NULL,
  `itemMainVideo` text NOT NULL,
  `itemSeries` text NOT NULL,
  `itemEstimation` text NOT NULL,
  `itemTime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `addDate`, `itemName`, `itemCost`, `itemCountry`, `itemRaisal`, `itemGenre`, `itemDescription`, `itemMainImg`, `itemMainVideo`, `itemSeries`, `itemEstimation`, `itemTime`) VALUES
(23, 1626966606, 'Симпсоны', 'Мультиксериал', 'США', 8, 4, 'Мультфильм - пародия на американский уклад жизни. Семейство Симпсонов состоит из пяти членов: папаша Гомер, мать семейства Мардж, их дочери, Лиза и Мэгги, и несносный подросток Барт.', '1626966606_sumson.jpg', 'https://7923.svetacdn.in/QKh4X41fRLUU/tv-series/540', 'сериал', '', '22 мин'),
(24, 1626968218, 'Тяжёлая поездка', 'Комедия', 'Финляндия, Норвегия', 7, 20, 'В небольшом финском городке четыре патлатых друга играют тяжелую музыку в подвале дома и по совместительству оленьей фермы одного из них, да так, что олени готовы покончить с собой.', '1626968403_1626968218_hevi.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/movie/18322', 'кино', '', '92 мин'),
(25, 1626968709, 'Мстители: Финал', 'Боевик', 'США', 8, 1, 'Оставшиеся в живых члены команды Мстителей и их союзники должны разработать новый план, который поможет противостоять разрушительным действиям могущественного титана Таноса.', '1626972170_1585414286-1933961545.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/movie/25284', 'кино', '', '181 мин'),
(26, 1626972737, 'Форсаж 9', 'Триллеры', 'США', 6, 1, 'Доминик Торетто ведет спокойную жизнь вместе с Летти и своим сыном Брайаном, однако, они знают, что новая опасность всегда где-то рядом.', '1627069055_for9.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/movie/50518', 'кино', '', '145 мин'),
(27, 1626972959, 'Американские истории ужасов', 'Зарубежные', 'США', 9, 23, '«Американские истории ужасов» – это спинофф удостоенного наград сериала антологий Райана Мерфи и Брэда Фалчука «Американская история ужасов».', '1627069115_1626973097_amerhis.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/tv-series/11038', 'сериал', '', '45мин'),
(28, 1626973333, 'Покемон', 'Аниме', 'Япония', 8, 8, 'Очередная легенда об очередном легендарном покемоне. На этот раз - о Манафи, которого называют Принцем моря. О Храме моря - доме для Манафи', '1626973390_1626973333_poc.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/anime-tv-series/943', 'сериал', '', '25мин'),
(30, 1626973959, 'Американский папаша', 'Мультиксериал', 'США', 8, 7, 'Эдди Кэй Томас Сюжет мультсериала разворачивается вокруг семьи Смитов. Папа Стэн — агент ЦРУ и республиканец до мозга костей, силен телом, но глуп разумом.', '1626973959_avericandad.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/tv-series/1161', 'сериал', '', '22 мин'),
(31, 1627146678, 'Никому не говори', 'Триллеры', 'США', 6, 22, 'Эдди Кэй Томас Сюжет разворачивается вокруг семьи Смитов. Папа Стэн — агент ЦРУ и республиканец до мозга костей, силен телом, но глуп разумом.', '1627205349_1611093781-731088099.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/movie/47134', 'кино', '', '120мин'),
(32, 1627157366, 'Тройной форсаж: Токийский Дрифт', 'Криминал', 'США', 9, 8, 'Старшеклассник Шон Босуэлл только и делает, что попадает в неприятности. После очередной выходки — импровизированных гонок и аварии — парню уже светит тюрьма, тогда мать решает отправить его к отцу в Японию. В первый же день в японской школе он знакомится с соотечественником, а тот притаскивает нового друга на подпольные соревнования по дрифт-рейсингу.', '1627205286_for3.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/movie/747', 'кино', '', '104 мин'),
(33, 1627205628, 'Мортал Комбат', 'Боевики', 'США', 6, 23, 'Действие развернется вокруг турнира, на котором сойдутся лучшие бойцы мира.', '1627205628_1627157366_1627146678_mortal.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/movie/49503', 'кино', '', '110 мин'),
(34, 1627207308, 'Рик и Морти', 'Мультиксериал', 'США', 9, 15, 'В центре сюжета - школьник по имени Морти и его дедушка Рик. Морти - самый обычный мальчик, который ничем не отличается от своих сверстников. А вот его дедуля занимается необычными научными исследованиями и зачастую полностью неадекватен.', '1627207308_1585365915-930353446.jpg', '//7923.svetacdn.in/QKh4X41fRLUU/tv-series/1237', 'сериал', '', '23мин');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `aid` int(10) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `soonew`
--

CREATE TABLE `soonew` (
  `id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_hash` varchar(32) NOT NULL,
  `user_ip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `soonew`
--

INSERT INTO `soonew` (`id`, `user_login`, `user_password`, `user_hash`, `user_ip`) VALUES
(8, 'rurzh', 'be897c5f0d51c6bfc4e6e60a67b406b1', '', 0),
(9, 'root', 'd9b1d7db4cd6e70935368a1efb10e377', 'f6a5aa690580cec01468f87173d9d90e', 2130706433),
(10, 'karlygashtaldybaeva', '37dce6a3bda40f442c971ceaacc1d94d', '', 0),
(11, 'arnat', 'b9be11166d72e9e3ae7fd407165e4bd2', '', 0),
(12, 'arnat04', 'd9b1d7db4cd6e70935368a1efb10e377', 'f42f69864713161bfbd61642dad56821', 2130706433),
(13, 'arnat045', 'd9b1d7db4cd6e70935368a1efb10e377', 'b98848d3c2032b0c98d5a980cf8ba8b6', 2130706433),
(14, 'root1', 'd9b1d7db4cd6e70935368a1efb10e377', '', 0),
(15, 'root12', 'd9b1d7db4cd6e70935368a1efb10e377', '', 0),
(16, 'root123', 'd9b1d7db4cd6e70935368a1efb10e377', '', 0),
(17, 'arnatarnatarnat', 'd9b1d7db4cd6e70935368a1efb10e377', 'd63239d000498f5a12f2ec82f19d52fe', 2130706433),
(18, 'ARNUR', 'd9b1d7db4cd6e70935368a1efb10e377', '08da90a64135fa748213866ea2949f22', 2130706433),
(19, 'qwerty', 'd9b1d7db4cd6e70935368a1efb10e377', '', 0),
(20, 'miras', 'd9b1d7db4cd6e70935368a1efb10e377', '502cc167118ae4db96210b4c8a871fbd', 2130706433),
(21, '1ARNAT123', 'd9b1d7db4cd6e70935368a1efb10e377', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `viewlater`
--

CREATE TABLE `viewlater` (
  `id` int(11) NOT NULL,
  `user_id` int(9) NOT NULL,
  `film_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `viewlater`
--

INSERT INTO `viewlater` (`id`, `user_id`, `film_id`) VALUES
(32, 12, 30),
(33, 12, 27),
(34, 12, 26),
(35, 9, 28);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `commentary`
--
ALTER TABLE `commentary`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `soonew`
--
ALTER TABLE `soonew`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `viewlater`
--
ALTER TABLE `viewlater`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `commentary`
--
ALTER TABLE `commentary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT для таблицы `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `soonew`
--
ALTER TABLE `soonew`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `viewlater`
--
ALTER TABLE `viewlater`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
