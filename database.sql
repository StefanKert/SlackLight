-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Aug 2015 um 16:08
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fh_2015_scm4_s1310307019`
--
CREATE DATABASE IF NOT EXISTS `fh_2015_scm4_s1310307019` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fh_2015_scm4_s1310307019`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `channels`
--

DROP TABLE IF EXISTS `channels`;
CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(11) NOT NULL,
  `creationdate` datetime NOT NULL,
  `updateddate` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `creationUserId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- TRUNCATE Tabelle vor dem Einfügen `channels`
--

TRUNCATE TABLE `channels`;
--
-- Daten für Tabelle `channels`
--

INSERT INTO `channels` (`id`, `creationdate`, `updateddate`, `title`, `description`, `creationUserId`) VALUES
(4, '2015-08-21 13:43:08', '2015-08-21 13:43:08', 'Allgemeine Diskussionen', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 38),
(6, '2015-08-21 14:51:45', '2015-08-21 14:51:45', 'Off Topic', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 38);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL,
  `text` text NOT NULL,
  `channelId` int(11) NOT NULL,
  `creationUserId` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- TRUNCATE Tabelle vor dem Einfügen `comments`
--

TRUNCATE TABLE `comments`;
--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`id`, `creationDate`, `updatedDate`, `text`, `channelId`, `creationUserId`, `deleted`) VALUES
(34, '2015-08-21 13:47:59', '2015-08-21 14:39:19', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 4, 38, 1),
(35, '2015-08-21 14:45:51', '2015-08-21 14:45:51', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.   <br />\r\n<br />\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,', 4, 38, 0),
(36, '2015-08-21 14:52:57', '2015-08-21 14:52:57', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 6, 38, 0),
(37, '2015-08-21 14:54:21', '2015-08-21 14:54:21', '<br />\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. <br />\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. ', 6, 38, 1),
(38, '2015-08-21 14:57:16', '2015-08-21 14:57:16', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 6, 38, 1),
(39, '2015-08-21 14:57:23', '2015-08-21 14:57:23', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 6, 38, 1),
(40, '2015-08-21 14:57:29', '2015-08-21 14:57:29', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 6, 38, 1),
(41, '2015-08-21 14:58:14', '2015-08-21 14:58:14', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. ', 6, 38, 1),
(42, '2015-08-21 14:58:40', '2015-08-21 14:58:40', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. ', 6, 38, 1),
(43, '2015-08-21 14:59:31', '2015-08-21 14:59:31', '                                if($channelRepository-&gt;hasChannelNewPostsForUser($channel-&gt;getId(), SessionContext::getCurrentUser())){<br />\r\n                                    echo &quot;!&quot;;<br />\r\n                                }', 6, 38, 1),
(44, '2015-08-21 14:59:48', '2015-08-21 14:59:48', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 6, 38, 1),
(45, '2015-08-21 16:03:28', '2015-08-21 16:03:28', 'asdfasdf', 4, 57, 0),
(46, '2015-08-21 16:03:34', '2015-08-21 16:03:34', 'asdfasdf', 6, 57, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- TRUNCATE Tabelle vor dem Einfügen `favorites`
--

TRUNCATE TABLE `favorites`;
--
-- Daten für Tabelle `favorites`
--

INSERT INTO `favorites` (`id`, `userId`, `commentId`) VALUES
(31, 38, 35),
(32, 38, 36);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `requestlogs`
--

DROP TABLE IF EXISTS `requestlogs`;
CREATE TABLE IF NOT EXISTS `requestlogs` (
  `id` int(11) NOT NULL,
  `requestUri` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=latin1;

--
-- TRUNCATE Tabelle vor dem Einfügen `requestlogs`
--

TRUNCATE TABLE `requestlogs`;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userchannelregestrations`
--

DROP TABLE IF EXISTS `userchannelregestrations`;
CREATE TABLE IF NOT EXISTS `userchannelregestrations` (
  `id` int(11) NOT NULL,
  `channelId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastTimeOpenedChannel` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- TRUNCATE Tabelle vor dem Einfügen `userchannelregestrations`
--

TRUNCATE TABLE `userchannelregestrations`;
--
-- Daten für Tabelle `userchannelregestrations`
--

INSERT INTO `userchannelregestrations` (`id`, `channelId`, `userId`, `lastTimeOpenedChannel`) VALUES
(10, 4, 38, '2015-08-21 16:03:49'),
(12, 6, 38, '2015-08-21 16:03:53'),
(16, 4, 57, '2015-08-21 16:03:28'),
(17, 6, 57, '2015-08-21 16:03:34');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- TRUNCATE Tabelle vor dem Einfügen `users`
--

TRUNCATE TABLE `users`;
--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `passwordHash`, `firstname`, `lastname`, `mail`) VALUES
(38, 'Tester', '1f5b090c6bafc8c60a5e4db6ec6c0391ddbaf1a8', 'Max', 'Mustermann', 'max@test.at'),
(57, 'Testfrau', 'a450f1d1bc9a19015e9f1dda5110092234f66c02', 'Maria', 'Musterfrau', 'maria@test.at');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`), ADD KEY `creationUserId` (`creationUserId`);

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`), ADD KEY `creationUserId` (`creationUserId`), ADD KEY `channelId` (`channelId`);

--
-- Indizes für die Tabelle `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`), ADD KEY `commentId` (`commentId`), ADD KEY `userId` (`userId`);

--
-- Indizes für die Tabelle `requestlogs`
--
ALTER TABLE `requestlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `userchannelregestrations`
--
ALTER TABLE `userchannelregestrations`
  ADD PRIMARY KEY (`id`), ADD KEY `userId` (`userId`), ADD KEY `channelId` (`channelId`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT für Tabelle `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT für Tabelle `requestlogs`
--
ALTER TABLE `requestlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=424;
--
-- AUTO_INCREMENT für Tabelle `userchannelregestrations`
--
ALTER TABLE `userchannelregestrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `channels`
--
ALTER TABLE `channels`
ADD CONSTRAINT `CREATIONUSERID` FOREIGN KEY (`creationUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `CHANNELID_ADD CONSTRAINT` FOREIGN KEY (`channelId`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `CREATIONUSERID_ADD CONSTRAINT` FOREIGN KEY (`creationUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `favorites`
--
ALTER TABLE `favorites`
ADD CONSTRAINT `COMMENT_ADD CONSTRAINT` FOREIGN KEY (`commentId`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `USER_ADD CONSTRAINT` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `userchannelregestrations`
--
ALTER TABLE `userchannelregestrations`
ADD CONSTRAINT `CHANNEL_ADD CONSTRAINT` FOREIGN KEY (`channelId`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `USER_CHANNELREGESTRATIONADD CONSTRAINT` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
