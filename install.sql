
CREATE TABLE IF NOT EXISTS `persist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `thekey` varchar(5) NOT NULL,
  `thevalue` varchar(50) NOT NULL
);

ALTER TABLE `persist` ADD PRIMARY KEY (`id`);
ALTER TABLE `persist` CHANGE `id` `id` INT(5) NOT NULL AUTO_INCREMENT;

INSERT INTO `persist` (`id`, `thekey`, `thevalue`) VALUES
(1, 'r18', 'tostart'),
(2, 'r12', 'disabled'),
(3, 'rpl', 'disabled');

CREATE TABLE IF NOT EXISTS `playoff_positions` (
  `id` int(11) NOT NULL DEFAULT '0',
  `pos` int(5) NOT NULL,
  `tid` int(5) NOT NULL
);

ALTER TABLE `playoff_positions` ADD PRIMARY KEY (`id`);
ALTER TABLE `playoff_positions` CHANGE `id` `id` INT(5) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(5) NOT NULL,
  `gid` int(5) NOT NULL,
  `tid` int(5) NOT NULL
);
ALTER TABLE `groups` ADD PRIMARY KEY (`id`);
ALTER TABLE `groups` CHANGE `id` `id` INT(5) NOT NULL AUTO_INCREMENT;
  
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL DEFAULT '0',
  `team_away_id` int(11) DEFAULT NULL,
  `team_home_id` int(11) DEFAULT NULL,
  `points_away` int(11) DEFAULT NULL,
  `points_home` int(11) DEFAULT NULL,
  `fixtures_day`  int(11) DEFAULT NULL
);
ALTER TABLE `games` ADD PRIMARY KEY (`id`);
ALTER TABLE `games` CHANGE `id` `id` INT(5) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(5) NOT NULL,
  `name` varchar(70) NOT NULL
);
ALTER TABLE `teams` ADD PRIMARY KEY (`id`);
ALTER TABLE `teams` CHANGE `id` `id` INT(5) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL,
  `W` int(11) DEFAULT NULL,
  `L` int(11) DEFAULT NULL,
  `PS` int(11) DEFAULT NULL,
  `PC` int(11) DEFAULT NULL
);

ALTER TABLE `stats` ADD PRIMARY KEY (`id`);
ALTER TABLE `stats` CHANGE `id` `id` INT(5) NOT NULL AUTO_INCREMENT;

INSERT INTO `teams` (`id`, `name`) VALUES
(1, 'Los Angeles Lakers'),
(2, 'Miami Heat'),
(3, 'Denver Nuggets'),
(4, 'New York Knicks'),
(5, 'Toronto Raptors'),
(6, 'Chicago Bulls'),
(7, 'Los angeles Clippers'),
(8, 'Cleveland Cavaliers'),
(9, 'Memphis Grizzlies'),
(10, 'Dallas Mavericks'),
(11, 'Brooklyn Nets'),
(12, 'Indiana Pacers'),
(13, 'Houston Rockets'),
(14, 'San Antonio Spurs'),
(15, 'Oklahoma City Thunder'),
(16, 'Portland Blazers'),
(17, 'Golden State Warriors'),
(18, 'Washington Wizards');

INSERT INTO `stats` (`id`, `W`, `L`, `PS`, `PC`) VALUES
(1, 0, 0, 0, 0),
(2, 0, 0, 0, 0),
(3, 0, 0, 0, 0),
(4, 0, 0, 0, 0),
(5, 0, 0, 0, 0),
(6, 0, 0, 0, 0),
(7, 0, 0, 0, 0),
(8, 0, 0, 0, 0),
(9, 0, 0, 0, 0),
(10,0, 0, 0, 0),
(11,0, 0, 0, 0),
(12,0, 0, 0, 0),
(13,0, 0, 0, 0),
(14,0, 0, 0, 0),
(15,0, 0, 0, 0),
(16,0, 0, 0, 0),
(17,0, 0, 0, 0),
(18,0, 0, 0, 0),
(101, 0, 0, 0, 0),
(102, 0, 0, 0, 0),
(103, 0, 0, 0, 0),
(104, 0, 0, 0, 0),
(105, 0, 0, 0, 0),
(106, 0, 0, 0, 0),
(107, 0, 0, 0, 0),
(108, 0, 0, 0, 0),
(109, 0, 0, 0, 0),
(110,0, 0, 0, 0),
(111,0, 0, 0, 0),
(112,0, 0, 0, 0),
(113,0, 0, 0, 0),
(114,0, 0, 0, 0),
(115,0, 0, 0, 0),
(116,0, 0, 0, 0),
(117,0, 0, 0, 0),
(118,0, 0, 0, 0),
(1001, 0, 0, 0, 0),
(1002, 0, 0, 0, 0),
(1003, 0, 0, 0, 0),
(1004, 0, 0, 0, 0),
(1005, 0, 0, 0, 0),
(1006, 0, 0, 0, 0),
(1007, 0, 0, 0, 0),
(1008, 0, 0, 0, 0),
(1009, 0, 0, 0, 0),
(1010,0, 0, 0, 0),
(1011,0, 0, 0, 0),
(1012,0, 0, 0, 0),
(1013,0, 0, 0, 0),
(1014,0, 0, 0, 0),
(1015,0, 0, 0, 0),
(1016,0, 0, 0, 0),
(1017,0, 0, 0, 0),
(1018,0, 0, 0, 0),
(10001, 0, 0, 0, 0),
(10002, 0, 0, 0, 0),
(10003, 0, 0, 0, 0),
(10004, 0, 0, 0, 0),
(10005, 0, 0, 0, 0),
(10006, 0, 0, 0, 0),
(10007, 0, 0, 0, 0),
(10008, 0, 0, 0, 0),
(10009, 0, 0, 0, 0),
(10010,0, 0, 0, 0),
(10011,0, 0, 0, 0),
(10012,0, 0, 0, 0),
(10013,0, 0, 0, 0),
(10014,0, 0, 0, 0),
(10015,0, 0, 0, 0),
(10016,0, 0, 0, 0),
(10017,0, 0, 0, 0),
(10018,0, 0, 0, 0),
(100001, 0, 0, 0, 0),
(100002, 0, 0, 0, 0),
(100003, 0, 0, 0, 0),
(100004, 0, 0, 0, 0),
(100005, 0, 0, 0, 0),
(100006, 0, 0, 0, 0),
(100007, 0, 0, 0, 0),
(100008, 0, 0, 0, 0),
(100009, 0, 0, 0, 0),
(100010,0, 0, 0, 0),
(100011,0, 0, 0, 0),
(100012,0, 0, 0, 0),
(100013,0, 0, 0, 0),
(100014,0, 0, 0, 0),
(100015,0, 0, 0, 0),
(100016,0, 0, 0, 0),
(100017,0, 0, 0, 0),
(100018,0, 0, 0, 0),
(1000001, 0, 0, 0, 0),
(1000002, 0, 0, 0, 0),
(1000003, 0, 0, 0, 0),
(1000004, 0, 0, 0, 0),
(1000005, 0, 0, 0, 0),
(1000006, 0, 0, 0, 0),
(1000007, 0, 0, 0, 0),
(1000008, 0, 0, 0, 0),
(1000009, 0, 0, 0, 0),
(1000010,0, 0, 0, 0),
(1000011,0, 0, 0, 0),
(1000012,0, 0, 0, 0),
(1000013,0, 0, 0, 0),
(1000014,0, 0, 0, 0),
(1000015,0, 0, 0, 0),
(1000016,0, 0, 0, 0),
(1000017,0, 0, 0, 0),
(1000018,0, 0, 0, 0);