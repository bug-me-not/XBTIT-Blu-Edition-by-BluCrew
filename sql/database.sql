-- Not sure why but it seems the install script ignores the first query.

-- This drop query is not really needed but it makes sure the table
-- actually gets created.

DROP TABLE IF EXISTS `{$db_prefix}addedrequests`;

CREATE TABLE `{$db_prefix}addedrequests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requestid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}adminpanel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL,
  `id_level` int(11) NOT NULL,
  `access` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}adminpanel` (`id`, `section`, `description`, `link`, `id_level`, `access`) VALUES
(1, 'config', 'ACP_TRACKER_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=config&action=read', 7, 0),
(2, 'banip', 'ACP_BAN_IP', 'index.php?page=admin&user={uid}&code={ucode}&do=banip&action=read', 7, 0),
(3, 'language', 'ACP_LANGUAGES', 'index.php?page=admin&user={uid}&code={ucode}&do=language&action=read', 7, 0),
(4, 'style', 'ACP_STYLES', 'index.php?page=admin&user={uid}&code={ucode}&do=style&action=read', 7, 0),
(5, 'category', 'ACP_CATEGORIES', 'index.php?page=admin&user={uid}&code={ucode}&do=category&action=read', 7, 0),
(6, 'poller', 'ACP_POLLS', 'index.php?page=admin&user={uid}&code={ucode}&do=poller&action=read', 7, 0),
(7, 'badwords', 'ACP_CENSORED', 'index.php?page=admin&user={uid}&code={ucode}&do=badwords&action=read', 7, 0),
(8, 'blocks', 'ACP_BLOCKS', 'index.php?page=admin&user={uid}&code={ucode}&do=blocks&action=read', 7, 0),
(9, 'masspm', 'ACP_MASSPM', 'index.php?page=admin&user={uid}&code={ucode}&do=masspm&action=read', 7, 0),
(10, 'pruneu', 'ACP_PRUNE_USERS', 'index.php?page=admin&user={uid}&code={ucode}&do=pruneu', 7, 0),
(11, 'searchdiff', 'ACP_SEARCH_DIFF', 'index.php?page=admin&user={uid}&code={ucode}&do=searchdiff', 7, 0),
(12, 'prunet', 'ACP_PRUNE_TORRENTS', 'index.php?page=admin&user={uid}&code={ucode}&do=prunet', 7, 0),
(13, 'forum', 'ACP_FORUM', 'index.php?page=admin&user={uid}&code={ucode}&do=forum&action=read', 7, 0),
(14, 'mysql_stats', 'ACP_MYSQL_STATS', 'index.php?page=admin&user={uid}&code={ucode}&do=mysql_stats', 7, 0),
(15, 'logview', 'ACP_SITE_LOG', 'index.php?page=admin&user={uid}&code={ucode}&do=logview', 7, 0);

CREATE TABLE IF NOT EXISTS `{$db_prefix}welcome_msg` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)

); -- TABLEOPT --

INSERT INTO `{$db_prefix}welcome_msg` (`key`, `value`) VALUES
('fm_welcome_sub', 'Welcome to my tracker.'),
('fm_welcome_msg', '[b]Welcome[/b] blah de blah drone... ');

CREATE TABLE IF NOT EXISTS `{$db_prefix}ads` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
); -- TABLEOPT --


INSERT INTO `{$db_prefix}ads` (`key`, `value`) VALUES
('above_comments', ''),
('above_comments_enabled', 'disabled'),
('footer', ''),
('footer_enabled', 'disabled'),
('header', ''),
('header_enabled', 'disabled'),
('left_bottom', ''),
('left_bottom_enabled', 'disabled'),
('left_top', ''),
('left_top_enabled', 'disabled'),
('right_bottom', ''),
('right_bottom_enabled', 'disabled'),
('right_top', ''),
('right_top_enabled', 'disabled');

CREATE TABLE `{$db_prefix}anti_hit_run` (
  `id_level` int(11) NOT NULL DEFAULT '0',
  `min_download_size` bigint(20) NOT NULL DEFAULT '0',
  `min_ratio` float NOT NULL DEFAULT '0',
  `min_seed_hours` int(11) NOT NULL DEFAULT '0',
  `tolerance_days_before_punishment` int(11) NOT NULL DEFAULT '0',
  `upload_punishment` int(11) NOT NULL DEFAULT '0',
  `reward` enum('no','yes') NOT NULL DEFAULT 'no',
  `warn` enum('no','yes') NOT NULL DEFAULT 'no',
  `boot` enum('no','yes') NOT NULL DEFAULT 'no',
  `warnboot` enum('no','yes') NOT NULL DEFAULT 'no',
  `days1` int(11) NOT NULL DEFAULT '2',
  `days2` int(11) NOT NULL DEFAULT '2',
  `days3` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_level`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}announcements` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`subject` varchar(64) NOT NULL,
`message` text NOT NULL,
`by` varchar(16) NOT NULL DEFAULT 'Admin',
`added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
`minclassread` tinyint(3) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `subject` (`subject`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}avps` (
  `arg` varchar(32) NOT NULL,
  `value_s` varchar(32) NOT NULL,
  `value_i` varchar(32) NOT NULL,
  `value_u` varchar(32) NOT NULL
); -- TABLEOPT --

INSERT INTO `{$db_prefix}avps` (`arg`, `value_s`, `value_i`, `value_u`) VALUES
('happyhour', '', '0', '0');

CREATE TABLE `{$db_prefix}bannedclient` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `peer_id` varchar(16) NOT NULL,
  `peer_id_ascii` varchar(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `peer_id` (`peer_id`),
  KEY `peer_id_ascii` (`peer_id_ascii`),
  KEY `user_agent` (`user_agent`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}bannedip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` int(11) NOT NULL DEFAULT '0',
  `addedby` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `first` bigint(11) unsigned DEFAULT NULL,
  `last` bigint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `first_last` (`first`,`last`)
); -- TABLEOPT --

CREATE TABLE IF NOT EXISTS `{$db_prefix}baseline` (
  `file_path` varchar(200) NOT NULL,
  `file_hash` char(40) NOT NULL,
  `acct` varchar(40) NOT NULL,
  PRIMARY KEY (`file_path`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}betgames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(50) NOT NULL DEFAULT '',
  `undertext` varchar(150) NOT NULL DEFAULT '',
  `endtime` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `sort` int(1) NOT NULL DEFAULT '0',
  `creator` varchar(20) NOT NULL,
  `fix` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}betlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  `bonus` int(11) NOT NULL DEFAULT '0',
  `msg` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `userid_2` (`userid`,`bonus`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}betoptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `text` varchar(100) NOT NULL DEFAULT '',
  `odds` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}bets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `userid` (`userid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}bettop` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}bitcoin_invoices` (
  `invoice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tracker_id` int(10) NOT NULL DEFAULT '0',
  `secret` varchar(12) NOT NULL,
  `currency` enum('USD','AUD','CAD','CHF','CNY','DKK','EUR','GBP','HKD','JPY','NZD','PLN','RUB','SEK','SGD','THB') NOT NULL DEFAULT 'EUR',
  `price_in_currency` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_in_btc` decimal(10,8) NOT NULL DEFAULT '0.00000000',
  `product_type` int(10) NOT NULL DEFAULT '0',
  `added` int(10) NOT NULL DEFAULT '0',
  `confirmation_count` int(10) NOT NULL DEFAULT '0',
  `transaction_hash` varchar(64) NOT NULL,
  `input_transaction_hash` varchar(64) NOT NULL,
  `input_address` varchar(40) NOT NULL,
  `received_in_btc` decimal(10,8) NOT NULL DEFAULT '0.00000000',
  `received_in_currency` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lastupdate` int(10) NOT NULL DEFAULT '0',
  `state` enum('pending','completed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`invoice_id`),
  KEY `tracker_id` (`tracker_id`),
  KEY `secret` (`secret`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tip` int(11) unsigned DEFAULT NULL,
  `added` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tip` (`tip`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}blocks` (
  `blockid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '',
  `position` char(1) NOT NULL DEFAULT '',
  `sortid` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `cache` enum('yes','no') NOT NULL DEFAULT 'no',
  `minclassview` int(11) NOT NULL DEFAULT '0',
  `maxclassview` int(11) NOT NULL DEFAULT '8',
  `use_lro` enum('yes','no') NOT NULL DEFAULT 'no',
  `lro_minclassview` int(11) NOT NULL DEFAULT '0',
  `lro_maxclassview` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blockid`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}blocks` (`blockid`, `content`, `position`, `sortid`, `status`, `title`, `cache`, `minclassview`, `maxclassview`, `use_lro`, `lro_minclassview`, `lro_maxclassview`) VALUES
(1, 'menu', 'r', 5, 1, 'BLOCK_MENU', 'no', 3, 8, 'no', 0, 0),
(2, 'clock', 'r', 2, 1, 'BLOCK_CLOCK', 'no', 3, 8, 'no', 0, 0),
(3, 'forum', 'l', 2, 1, 'BLOCK_FORUM', 'no', 3, 8, 'no', 0, 0),
(4, 'lastmember', 'l', 1, 1, 'BLOCK_LASTMEMBER', 'no', 3, 8, 'no', 0, 0),
(5, 'trackerinfo', 'l', 6, 1, 'BLOCK_INFO', 'no', 3, 8, 'no', 0, 0),
(6, 'user', 'r', 4, 1, 'BLOCK_USER', 'no', 3, 8, 'no', 0, 0),
(7, 'online', 'b', 0, 1, 'BLOCK_ONLINE', 'no', 3, 8, 'no', 0, 0),
(8, 'toptorrents', 'c', 5, 1, 'BLOCK_TOPTORRENTS', 'no', 3, 8, 'no', 0, 0),
(9, 'lasttorrents', 'c', 4, 1, 'BLOCK_LASTTORRENTS', 'no', 3, 8, 'no', 0, 0),
(10, 'news', 'c', 1, 1, 'BLOCK_NEWS', 'no', 1, 8, 'no', 0, 0),
(11, 'mainmenu', 't', 1, 1, 'BLOCK_MENU', 'no', 1, 8, 'no', 0, 0),
(12, 'maintrackertoolbar', 't', 2, 1, 'BLOCK_MAINTRACKERTOOLBAR', 'no', 3, 8, 'no', 0, 0),
(13, 'mainusertoolbar', 't', 2, 1, 'BLOCK_MAINUSERTOOLBAR', 'no', 1, 8, 'no', 0, 0),
(14, 'serverload', 'c', 8, 0, 'BLOCK_SERVERLOAD', 'no', 8, 8, 'no', 0, 0),
(15, 'poller', 'l', 3, 1, 'BLOCK_POLL', 'no', 3, 8, 'no', 0, 0),
(16, 'seedwanted', 'c', 3, 1, 'BLOCK_SEEDWANTED', 'no', 3, 8, 'no', 0, 0),
(17, 'paypal', 'r', 1, 1, 'BLOCK_PAYPAL', 'no', 3, 8, 'no', 0, 0),
(18, 'ajax_shoutbox', 'c', 2, 1, 'BLOCK_SHOUTBOX', 'no', 3, 8, 'no', 0, 0),
(19, 'hit_run', 'l', 1, 0, 'BLOCK_HIT', 'no', 3, 8, 'no', 0, 0),
(20, 'request', 'c', 6, 0, 'BLOCK_REQUEST', 'no', 3, 8, 'no', 0, 0),
(21, 'lottery', 'r', 10, 0, 'BLOCK_LOTTERY', 'no', 3, 8, 'no', 0, 0),
(22, 'led', 'a', 1, 0, 'Ticker', 'no', 3, 8, 'no', 0, 0),
(23, 'dropdownmenu', 'd', 1, 1, 'BLOCK_DDMENU', 'no', 1, 8, 'no', 0, 0),
(24, 'bet', 'l', 2, 0, 'BLOCK_BET', 'no', 3, 8, 'no', 0, 0),
(25, 'radio', 'c', 3, 0, 'BLOCK_RAD', 'no', 3, 8, 'no', 0, 0),
(26, 'topup', 'l', 1, 0, 'BLOCK_TOPU', 'no', 3, 8, 'no', 0, 0),
(27, 'circleimages', 'c', 1, 0, 'BLOCK_LASTTORRENTSC', 'no', 3, 8, 'no', 0, 0),
(28, 'lrb', 'l', 0, 0, 'BLOCK_LRB', 'no', 3, 8, 'no', 0, 0),
(29, 'birthday', 'l', 0, 0, 'BLOCK_BIRTHDAY', 'no', 3, 8, 'no', 0, 0),
(30, 'links', 'b', 1, 0, 'BLOCK_LINKS', 'no', 3, 8, 'no', 0, 0),
(31, 'last', 'c', '9', '0', 'BLOCK_LAST_DOWN', 'no', '3', '8', 'no', 0, 0),
(32, 'torrentoftheweek', 'l', '0', '0', 'BLOCK_TOW', 'no', '3', '8', 'no', 0, 0),
(33, 'altmenubar', 'e', 0, 1, 'BLOCK_ALTMENUBAR', 'no', 1, 1, 'no', 0, 0),
(34, 'calendar', 'l', 1, 1, 'BLOCK_CALENDAR', 'no', 3, 8, 'no', 0, 0);

CREATE TABLE `{$db_prefix}bonus` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `points` decimal(5,1) NOT NULL DEFAULT '0.0',
  `traffic` bigint(20) unsigned NOT NULL DEFAULT '0',
  `gb` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}bonus` (`id`, `name`, `points`, `traffic`, `gb`) VALUES
(3, '1', 30.0, 1073741824, 1),
(4, '2', 50.0, 2147483648, 2),
(5, '3', 100.0, 5368709120, 5);

CREATE TABLE `{$db_prefix}categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `sub` int(10) NOT NULL DEFAULT '0',
  `sort_index` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `forumid` int(10) NOT NULL DEFAULT '0',
  `reencode` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}categories` (`id`, `name`, `sub`, `sort_index`, `image`, `forumid`, `reencode`) VALUES
(7, 'Apps Win', 0, 1010, 'windows.png', 0, 0),
(6, 'Books', 0, 110, 'books.png', 0, 0),
(5, 'Anime', 0, 90, 'anime.png', 0, 0),
(4, 'Other', 0, 1000, 'utilities2.png', 0, 0),
(3, 'Games', 0, 40, 'games.png', 0, 0),
(2, 'Music', 0, 20, 'music.png', 0, 0),
(1, 'Movies', 0, 10, 'mov1es.png', 0, 0),
(8, 'Apps Linux', 0, 1020, 'linux.png', 0, 0),
(9, 'Apps Mac', 0, 1030, 'mac.png', 0, 0),
(11, 'DVD-R', 1, 0, 'movies.png', 0, 0),
(12, 'Adult', 0, 6969, 'adult.png', 0, 0);

CREATE TABLE `{$db_prefix}chat` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(9) NOT NULL,
  `time` int(10) NOT NULL DEFAULT '0',
  `name` tinytext NOT NULL,
  `text` text NOT NULL,
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `private` enum('yes','no') NOT NULL DEFAULT 'no',
  `toid` mediumint(9) NOT NULL,
  `fromid` mediumint(9) NOT NULL,
  `pchat` varchar(40) NOT NULL,
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}cheapmail` (
  `domain` varchar(100) NOT NULL DEFAULT '',
  `added` int(10) NOT NULL DEFAULT '0',
  `added_by` varchar(40) NOT NULL DEFAULT 'Unknown',
  KEY `domain` (`domain`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `ori_text` text NOT NULL,
  `user` varchar(20) NOT NULL DEFAULT '',
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`),
  KEY `info_hash` (`info_hash`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `flagpic` varchar(50) DEFAULT NULL,
  `domain` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}countries` (`id`, `name`, `flagpic`, `domain`) VALUES
(1, 'Sweden', 'se.png', 'SE'),
(2, 'United States of America', 'us.png', 'US'),
(3, 'American Samoa', 'as.png', 'AS'),
(4, 'Finland', 'fi.png', 'FI'),
(5, 'Canada', 'ca.png', 'CA'),
(6, 'France', 'fr.png', 'FR'),
(7, 'Germany', 'de.png', 'DE'),
(8, 'China', 'cn.png', 'CN'),
(9, 'Italy', 'it.png', 'IT'),
(10, 'Denmark', 'dk.png', 'DK'),
(11, 'Norway', 'no.png', 'NO'),
(12, 'United Kingdom', 'gb.png', 'GB'),
(13, 'Ireland', 'ie.png', 'IE'),
(14, 'Poland', 'pl.png', 'PL'),
(15, 'Netherlands', 'nl.png', 'NL'),
(16, 'Belgium', 'be.png', 'BE'),
(17, 'Japan', 'jp.png', 'JP'),
(18, 'Brazil', 'br.png', 'BR'),
(19, 'Argentina', 'ar.png', 'AR'),
(20, 'Australia', 'au.png', 'AU'),
(21, 'New Zealand', 'nz.png', 'NZ'),
(22, 'United Arab Emirates', 'ae.png', 'AE'),
(23, 'Spain', 'es.png', 'ES'),
(24, 'Portugal', 'pt.png', 'PT'),
(25, 'Mexico', 'mx.png', 'MX'),
(26, 'Singapore', 'sg.png', 'SG'),
(27, 'Anguilla', 'ai.png', 'AI'),
(28, 'Armenia', 'am.png', 'AM'),
(29, 'South Africa', 'za.png', 'ZA'),
(30, 'South Korea', 'kr.png', 'KR'),
(31, 'Jamaica', 'jm.png', 'JM'),
(32, 'Luxembourg', 'lu.png', 'LU'),
(33, 'Hong Kong', 'hk.png', 'HK'),
(34, 'Belize', 'bz.png', 'BZ'),
(35, 'Algeria', 'dz.png', 'DZ'),
(36, 'Angola', 'ao.png', 'AO'),
(37, 'Austria', 'at.png', 'AT'),
(38, 'Aruba', 'aw.png', 'AW'),
(39, 'Samoa', 'ws.png', 'WS'),
(40, 'Malaysia', 'my.png', 'MY'),
(41, 'Dominican Republic', 'do.png', 'DO'),
(42, 'Greece', 'gr.png', 'GR'),
(43, 'Guatemala', 'gt.png', 'GT'),
(44, 'Israel', 'il.png', 'IL'),
(45, 'Pakistan', 'pk.png', 'PK'),
(46, 'Czech Republic', 'cz.png', 'CZ'),
(47, 'Serbia and Montenegro', 'cs.png', 'CS'),
(48, 'Seychelles', 'sc.png', 'SC'),
(49, 'Taiwan', 'tw.png', 'TW'),
(50, 'Puerto Rico', 'pr.png', 'PR');
INSERT INTO `{$db_prefix}countries` (`id`, `name`, `flagpic`, `domain`) VALUES
(51, 'Chile', 'cl.png', 'CL'),
(52, 'Cuba', 'cu.png', 'CU'),
(53, 'Congo', 'cg.png', 'CG'),
(54, 'Afghanistan', 'af.png', 'AF'),
(55, 'Turkey', 'tr.png', 'TR'),
(56, 'Uzbekistan', 'uz.png', 'UZ'),
(57, 'Switzerland', 'ch.png', 'CH'),
(58, 'Kiribati', 'ki.gif', 'KI'),
(59, 'Philippines', 'ph.png', 'PH'),
(60, 'Burkina Faso', 'bf.png', 'BF'),
(61, 'Nigeria', 'ng.png', 'NG'),
(62, 'Iceland', 'is.png', 'IS'),
(63, 'Nauru', 'nr.png', 'NR'),
(64, 'Slovenia', 'si.png', 'SI'),
(65, 'Albania', 'al.png', 'AL'),
(66, 'Turkmenistan', 'tm.png', 'TM'),
(67, 'Bosnia and Herzegovina', 'ba.png', 'BA'),
(68, 'Andorra', 'ad.png', 'AD'),
(69, 'Lithuania', 'lt.png', 'LT'),
(70, 'India', 'in.png', 'IN'),
(71, 'Netherlands Antilles', 'an.png', 'AN'),
(72, 'Ukraine', 'ua.png', 'UA'),
(73, 'Venezuela', 've.png', 'VE'),
(74, 'Hungary', 'hu.png', 'HU'),
(75, 'Romania', 'ro.png', 'RO'),
(76, 'Vanuatu', 'vu.png', 'VU'),
(77, 'Viet Nam', 'vn.png', 'VN'),
(78, 'Trinidad & Tobago', 'tt.png', 'TT'),
(79, 'Honduras', 'hn.png', 'HN'),
(80, 'Kyrgyzstan', 'kg.png', 'KG'),
(81, 'Ecuador', 'ec.png', 'EC'),
(82, 'Bahamas', 'bs.png', 'BS'),
(83, 'Peru', 'pe.png', 'PE'),
(84, 'Cambodia', 'kh.png', 'KH'),
(85, 'Barbados', 'bb.png', 'BB'),
(86, 'Bangladesh', 'bd.png', 'BD'),
(87, 'Laos', 'la.png', 'LA'),
(88, 'Uruguay', 'uy.png', 'UY'),
(89, 'Antigua Barbuda', 'ag.png', 'AG'),
(90, 'Paraguay', 'py.png', 'PY'),
(91, 'Antarctica', 'aq.png', 'AQ'),
(92, 'Russian Federation', 'ru.png', 'RU'),
(93, 'Thailand', 'th.png', 'TH'),
(94, 'Senegal', 'sn.png', 'SN'),
(95, 'Togo', 'tg.png', 'TG'),
(96, 'North Korea', 'kp.png', 'KP'),
(97, 'Croatia', 'hr.png', 'HR'),
(98, 'Estonia', 'ee.png', 'EE'),
(99, 'Colombia', 'co.png', 'CO'),
(100, 'unknown', 'unknown.gif', 'AA');
INSERT INTO `{$db_prefix}countries` (`id`, `name`, `flagpic`, `domain`) VALUES
(101, 'Organization', 'org.png', 'ORG'),
(102, 'Aland Islands', 'ax.png', 'AX'),
(103, 'Azerbaijan', 'az.png', 'AZ'),
(104, 'Bulgaria', 'bg.png', 'BG'),
(105, 'Bahrain', 'bh.png', 'BH'),
(106, 'Burundi', 'bi.png', 'BI'),
(107, 'Benin', 'bj.png', 'BJ'),
(108, 'Bermuda', 'bm.png', 'BM'),
(109, 'Brunei Darussalam', 'bn.png', 'BN'),
(110, 'Bolivia', 'bo.png', 'BO'),
(111, 'Bhutan', 'bt.png', 'BT'),
(112, 'Bouvet Island', 'bv.png', 'BV'),
(113, 'Botswana', 'bw.png', 'BW'),
(114, 'Belarus', 'by.png', 'BY'),
(115, 'Cocos (Keeling) Islands', 'cc.png', 'CC'),
(116, 'Congo, the Democratic Republic of the', 'cd.png', 'CD'),
(117, 'Central African Republic', 'cf.png', 'CF'),
(118, 'Ivory Coast', 'ci.png', 'CI'),
(119, 'Cook Islands', 'ck.png', 'CK'),
(120, 'Cameroon', 'cm.png', 'CM'),
(121, 'Costa Rica', 'cr.png', 'CR'),
(122, 'Cape Verde', 'cv.png', 'CV'),
(123, 'Christmas Island', 'cx.png', 'CX'),
(124, 'Cyprus', 'cy.png', 'CY'),
(125, 'Djibouti', 'dj.png', 'DJ'),
(126, 'Dominica', 'dm.png', 'DM'),
(127, 'Egypt', 'eg.png', 'EG'),
(128, 'Western Sahara', 'eh.png', 'EH'),
(129, 'Eritrea', 'er.png', 'ER'),
(130, 'Ethiopia', 'et.png', 'ET'),
(131, 'Fiji', 'fj.png', 'FJ'),
(132, 'Falkland Islands (Malvinas)', 'fk.png', 'FK'),
(133, 'Micronesia, Federated States of', 'fm.png', 'FM'),
(134, 'Faroe Islands', 'fo.png', 'FO'),
(135, 'Gabon', 'ga.png', 'GA'),
(136, 'Grenada', 'gd.png', 'GD'),
(137, 'Georgia', 'ge.png', 'GE'),
(138, 'French Guiana', 'gf.png', 'GF'),
(139, 'Guernsey', 'gg.png', 'GG'),
(140, 'Ghana', 'gh.png', 'GH'),
(141, 'Gibraltar', 'gi.png', 'GI'),
(142, 'Greenland', 'gl.png', 'GL'),
(143, 'Gambia', 'gm.png', 'GM'),
(144, 'Guinea', 'gn.png', 'GN'),
(145, 'Guadeloupe', 'gp.png', 'GP'),
(146, 'Equatorial Guinea', 'gq.png', 'GQ'),
(147, 'South Georgia and the South Sandwich Islands', 'gs.png', 'GS'),
(148, 'Guam', 'gu.png', 'GU'),
(149, 'Guinea-Bissau', 'gw.png', 'GW'),
(150, 'Guyana', 'gy.png', 'GY');
INSERT INTO `{$db_prefix}countries` (`id`, `name`, `flagpic`, `domain`) VALUES
(151, 'Heard Island and McDonald Islands', 'hm.png', 'HM'),
(152, 'Haiti', 'ht.png', 'HT'),
(153, 'Indonesia', 'id.png', 'ID'),
(154, 'Isle of Man', 'im.png', 'IM'),
(155, 'British Indian Ocean Territory', 'io.png', 'IO'),
(156, 'Jersey', 'je.png', 'JE'),
(157, 'Jordan', 'jo.png', 'JO'),
(158, 'Kenya', 'ke.png', 'KE'),
(159, 'Comoros', 'km.png', 'KM'),
(160, 'Saint Kitts and Nevis', 'kn.png', 'KN'),
(161, 'Kuwait', 'kw.png', 'KW'),
(162, 'Cayman Islands', 'ky.png', 'KY'),
(163, 'Kazahstan', 'kz.png', 'KZ'),
(164, 'Lebanon', 'lb.png', 'LB'),
(165, 'Saint Lucia', 'lc.png', 'LC'),
(166, 'Liechtenstein', 'li.png', 'LI'),
(167, 'Sri Lanka', 'lk.png', 'LK'),
(168, 'Liberia', 'lr.png', 'LR'),
(169, 'Lesotho', 'ls.png', 'LS'),
(170, 'Latvia', 'lv.png', 'LV'),
(171, 'Libyan Arab Jamahiriya', 'ly.png', 'LY'),
(172, 'Morocco', 'ma.png', 'MA'),
(173, 'Monaco', 'mc.png', 'MC'),
(174, 'Moldova, Republic of', 'md.png', 'MD'),
(175, 'Madagascar', 'mg.png', 'MG'),
(176, 'Marshall Islands', 'mh.png', 'MH'),
(177, 'Macedonia, the former Yugoslav Republic of', 'mk.png', 'MK'),
(178, 'Mali', 'ml.png', 'ML'),
(179, 'Myanmar', 'mm.png', 'MM'),
(180, 'Mongolia', 'mn.png', 'MN'),
(181, 'Macao', 'mo.png', 'MO'),
(182, 'Northern Mariana Islands', 'mp.png', 'MP'),
(183, 'Martinique', 'mq.png', 'MQ'),
(184, 'Mauritania', 'mr.png', 'MR'),
(185, 'Montserrat', 'ms.png', 'MS'),
(186, 'Malta', 'mt.png', 'MT'),
(187, 'Mauritius', 'mu.png', 'MU'),
(188, 'Maldives', 'mv.png', 'MV'),
(189, 'Malawi', 'mw.png', 'MW'),
(190, 'Mozambique', 'mz.png', 'MZ'),
(191, 'Namibia', 'na.png', 'NA'),
(192, 'New Caledonia', 'nc.png', 'NC'),
(193, 'Niger', 'ne.png', 'NE'),
(194, 'Norfolk Island', 'nf.png', 'NF'),
(195, 'Nicaragua', 'ni.png', 'NI'),
(196, 'Nepal', 'np.png', 'NP'),
(197, 'Niue', 'nu.png', 'NU'),
(198, 'Oman', 'om.png', 'OM'),
(199, 'Panama', 'pa.png', 'PA'),
(200, 'French Polynesia', 'pf.png', 'PF');
INSERT INTO `{$db_prefix}countries` (`id`, `name`, `flagpic`, `domain`) VALUES
(201, 'Papua New Guinea', 'pg.png', 'PG'),
(202, 'Saint Pierre and Miquelon', 'pm.png', 'PM'),
(203, 'Pitcairn', 'pn.png', 'PN'),
(204, 'Palestinian Territory, Occupied', 'ps.png', 'PS'),
(205, 'Palau', 'pw.png', 'PW'),
(206, 'Qatar', 'qa.png', 'QA'),
(207, 'Reunion', 're.png', 'RE'),
(208, 'Rwanda', 'rw.png', 'RW'),
(209, 'Saudi Arabia', 'sa.png', 'SA'),
(210, 'Solomon Islands', 'sb.png', 'SB'),
(211, 'Sudan', 'sd.png', 'SD'),
(212, 'Saint Helena', 'sh.png', 'SH'),
(213, 'Svalbard and Jan Mayen', 'sj.png', 'SJ'),
(214, 'Slovakia', 'sk.png', 'SK'),
(215, 'Sierra Leone', 'sl.png', 'SL'),
(216, 'San Marino', 'sm.png', 'SM'),
(217, 'Somalia', 'so.png', 'SO'),
(218, 'Suriname', 'sr.png', 'SR'),
(219, 'Sao Tome and Principe', 'st.png', 'ST'),
(220, 'El Salvador', 'sv.png', 'SV'),
(221, 'Syrian Arab Republic', 'sy.png', 'SY'),
(222, 'Swaziland', 'sz.png', 'SZ'),
(223, 'Turks and Caicos Islands', 'tc.png', 'TC'),
(224, 'Chad', 'td.png', 'TD'),
(225, 'French Southern Territories', 'tf.png', 'TF'),
(226, 'Tajikistan', 'tj.png', 'TJ'),
(227, 'Tokelau', 'tk.png', 'TK'),
(228, 'Timor-Leste', 'tl.png', 'TL'),
(229, 'Tunisia', 'tn.png', 'TN'),
(230, 'Tonga', 'to.png', 'TO'),
(231, 'Tuvalu', 'tv.png', 'TV'),
(232, 'Tanzania, United Republic of', 'tz.png', 'TZ'),
(233, 'Uganda', 'ug.png', 'UG'),
(234, 'United States Minor Outlying Islands', 'um.png', 'UM'),
(235, 'Holy See (Vatican City State)', 'va.png', 'VA'),
(236, 'Saint Vincent and the Grenadines', 'vc.png', 'VC'),
(237, 'Virgin Islands, British', 'vg.png', 'VG'),
(238, 'Wallis and Futuna', 'wf.png', 'WF'),
(239, 'Yemen', 'ye.png', 'YE'),
(240, 'Mayotte', 'yt.png', 'YT'),
(241, 'Zambia', 'zm.png', 'ZM'),
(242, 'Zimbabwe', 'zw.png', 'ZW'),
(243, 'Iraq', 'iq.png', 'IQ'),
(244, 'Iran, Islamic Republic of', 'ir.png', 'IR');

CREATE TABLE `{$db_prefix}donors` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `payers_email` varchar(255) NOT NULL DEFAULT '',
  `mc_gross` decimal(5,2) NOT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `country` varchar(255) NOT NULL,
  `item` varchar(20) NOT NULL,
  `test` varchar(20) NOT NULL DEFAULT '',
  `system` varchar(20) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}don_historie` (
  `don_id` int(11) NOT NULL DEFAULT '0',
  `donate_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation` int(11) NOT NULL,
  `donate_date_1` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_1` int(11) NOT NULL,
  `donate_date_2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_2` int(11) NOT NULL,
  `donate_date_3` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_3` int(11) NOT NULL,
  `donate_date_4` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_4` int(11) NOT NULL,
  `donate_date_5` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_5` int(11) NOT NULL,
  `donate_date_6` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_6` int(11) NOT NULL,
  `donate_date_7` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_7` int(11) NOT NULL,
  `donate_date_8` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_8` int(11) NOT NULL,
  `donate_date_9` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_9` int(11) NOT NULL,
  `donate_date_10` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_ation_10` int(11) NOT NULL,
  PRIMARY KEY (`don_id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}down_load` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` varchar(32) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `hash` (`hash`)
); -- TABLEOPT --


CREATE TABLE IF NOT EXISTS `{$db_prefix}downloads` (
  `id` int(5) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `info_hash` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`,`uid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}faq_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `sort_index` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `filename` varchar(250) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `info` varchar(250) NOT NULL DEFAULT '',
  `data` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `comment` text,
  `category` int(10) unsigned NOT NULL DEFAULT '6',
  `external` enum('yes','no') NOT NULL DEFAULT 'no',
  `announce_url` varchar(100) NOT NULL DEFAULT '',
  `uploader` int(10) NOT NULL DEFAULT '1',
  `lastupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `anonymous` enum('true','false') NOT NULL DEFAULT 'false',
  `lastsuccess` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dlbytes` bigint(20) unsigned NOT NULL DEFAULT '0',
  `seeds` int(10) unsigned NOT NULL DEFAULT '0',
  `leechers` int(10) unsigned NOT NULL DEFAULT '0',
  `finished` int(10) unsigned NOT NULL DEFAULT '0',
  `lastcycle` int(10) unsigned NOT NULL DEFAULT '0',
  `lastSpeedCycle` int(10) unsigned NOT NULL DEFAULT '0',
  `speed` bigint(20) unsigned NOT NULL DEFAULT '0',
  `bin_hash` blob NOT NULL,
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `gold` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `free_expire_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `free` enum('yes','no') NOT NULL DEFAULT 'no',
  `happy` enum('yes','no') DEFAULT 'no',
  `happy_hour` enum('yes','no') DEFAULT 'no',
  `image` varchar(255) NOT NULL DEFAULT '',
  `screen1` varchar(255) NOT NULL DEFAULT '',
  `screen2` varchar(255) NOT NULL DEFAULT '',
  `screen3` varchar(255) NOT NULL DEFAULT '',
  `reseed` int(9) NOT NULL DEFAULT '0',
  `imdb` varchar(10) NOT NULL DEFAULT '0',
  `seedbox` enum('0','1') NOT NULL DEFAULT '0',
  `sticky` enum('0','1') NOT NULL DEFAULT '0',
  `requested` enum('true','false') NOT NULL DEFAULT 'false',
  `nuked` enum('true','false') NOT NULL DEFAULT 'false',
  `nuke_reason` varchar(100) DEFAULT NULL,
  `moder` enum('um','bad','ok') NOT NULL DEFAULT 'ok',
  `shout_announced` tinyint(1) NOT NULL DEFAULT '0',
  `twitter_announced` tinyint(1) NOT NULL DEFAULT '0',
  `team` varchar(10) DEFAULT '0',
  `lock_comment` enum('yes','no') NOT NULL DEFAULT 'no',
  `multiplier` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT '1',
  `topicid` int(10) NOT NULL DEFAULT '0',
  `forum_announced` tinyint(1) NOT NULL DEFAULT '0',
  `staff_comment` varchar(250) DEFAULT NULL,
  `direct_download` varchar(255) NOT NULL DEFAULT '',
  `announces` text NOT NULL,
  `language` int(9) NOT NULL DEFAULT '0',
  `mplayer` varchar(250) NOT NULL DEFAULT '',
  `approved_by` int(10) unsigned NOT NULL DEFAULT '0',
  `viewcount` int(10) unsigned NOT NULL DEFAULT '0',
  `genre` text,
  `bumpdate` int(10) unsigned NOT NULL DEFAULT '0',
  `archive` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tvdb_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tvdb_extra` text,
  `dead_time` int(10) unsigned NOT NULL DEFAULT '0',
  `magnet` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `info_hash` (`info_hash`),
  KEY `filename` (`filename`),
  KEY `category` (`category`),
  KEY `uploader` (`uploader`),
  KEY `bin_hash` (`bin_hash`(20)),
  KEY `approved_by` (`approved_by`),
  KEY `dead_time` (`dead_time`)
); -- TABLEOPT --


CREATE TABLE `xbtit_file_hosting` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime default '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `size` int(10) unsigned NOT NULL default '0',
  `uppedby` int(10) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `hits` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}files_reencode` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  KEY `infohash` (`infohash`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}files_reencodeb` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  KEY `infohash` (`infohash`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}files_thanks` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  KEY `infohash` (`infohash`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}forums` (
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT NULL,
  `minclassread` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `minclasswrite` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `postcount` int(10) unsigned NOT NULL DEFAULT '0',
  `topiccount` int(10) unsigned NOT NULL DEFAULT '0',
  `minclasscreate` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `id_parent` int(10) NOT NULL DEFAULT '0',
  `category` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `id_parent` (`id_parent`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}friendlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `friend_id` int(10) unsigned NOT NULL DEFAULT '0',
  `friend_name` varchar(250) NOT NULL DEFAULT '',
  `friend_date` varchar(20) NOT NULL,
  `confirmed` enum('yes','no') NOT NULL DEFAULT 'no',
  `rejected` enum('yes','no') NOT NULL DEFAULT 'no',
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}gold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL DEFAULT '4',
  `gold_picture` varchar(255) NOT NULL DEFAULT 'gold.gif',
  `silver_picture` varchar(255) NOT NULL DEFAULT 'silver.gif',
  `bronze_picture` varchar(255) NOT NULL DEFAULT 'bronze.gif',
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `gold_description` text NOT NULL,
  `silver_description` text NOT NULL,
  `bronze_description` text NOT NULL,
  `classic_description` text NOT NULL,
  `gold_percentage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `silver_percentage` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `bronze_percentage` tinyint(3) unsigned NOT NULL DEFAULT '75',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}gold` (`id`, `level`, `gold_picture`, `silver_picture`, `bronze_picture`, `active`, `date`, `gold_description`, `silver_description`, `bronze_description`, `classic_description`, `gold_percentage`, `silver_percentage`, `bronze_percentage`) VALUES
(1, 3, 'gold.gif', 'silver.gif', 'bronze.gif', '1', '0000-00-00', 'Gold torrent description', 'Silver torrent description', 'Bronze torrent description', 'Classic torrent description', 0, 50, 75);

CREATE TABLE `{$db_prefix}gallery` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `owner` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}hacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `version` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  `added` int(11) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `prerequisite` varchar(200) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}hacks` (`id`, `title`, `version`, `author`, `added`, `folder`, `prerequisite`) VALUES
(1, 'fmhack_invitation_system', '1.2 (FM)', 'dodge', UNIX_TIMESTAMP(), '', 'no'),
(2, 'fmhack_custom_title', '1.0 (FM)', 'Real_ptr', UNIX_TIMESTAMP(), '', 'fmhack_bonus_system'),
(3, 'fmhack_bonus_system', '1.3 (FM)', 'Real_ptr & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(4, 'fmhack_donation_history', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'fmhack_advanced_auto_donation_system'),
(5, 'fmhack_simple_donor_display', '1.0 (FM)', 'Lupin', UNIX_TIMESTAMP(), '', 'fmhack_advanced_auto_donation_system'),
(6, 'fmhack_timed_ranks', '1.1 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'fmhack_advanced_auto_donation_system'),
(7, 'fmhack_advanced_auto_donation_system', '1.3 (FM)', 'DiemThuy & cooly', UNIX_TIMESTAMP(), '', 'no'),
(8, 'fmhack_gold_and_silver_torrents', '1.2 (FM)', 'Losmi & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(9, 'fmhack_free_leech_with_happy_hour', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(10, 'fmhack_torrent_image_upload', '1.1 (FM)', 'Real_ptr & Petr1fied', UNIX_TIMESTAMP(), '', 'fmhack_balloons_on_mouseover|fmhack_circling_last_torrents'),
(11, 'fmhack_warning_system', '1.1 (FM)', 'linux198 & Petr1fied', UNIX_TIMESTAMP(), '', 'fmhack_anti_hit_and_run_system|fmhack_low_ratio_ban_system'),
(12, 'fmhack_anti_hit_and_run_system', '1.3 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(13, 'fmhack_ask_for_reseed', '1.2 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(14, 'fmhack_auto_rank', '1.3 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(15, 'fmhack_report_users_and_torrents', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'fmhack_high_UL_speed_report'),
(16, 'fmhack_booted', '1.1 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(17, 'fmhack_group_colours_overall', '1.1 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(18, 'fmhack_getIMDB_in_torrent_details', '1.1 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(19, 'fmhack_staffpanel', '1.0 (FM)', 'Lupin', UNIX_TIMESTAMP(), '', 'no'),
(20, 'fmhack_rules_with_groups', '1.0 (FM)', 'Losmi', UNIX_TIMESTAMP(), '', 'no'),
(21, 'fmhack_show_if_seedbox_is_used', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(22, 'fmhack_shoutbox_member_and_torrent_announce', '1.1 (FM)', 'DarkLegion & Lupin', UNIX_TIMESTAMP(), '', 'no'),
(23, 'fmhack_sticky_torrent', '1.0 (FM)', 'Losmi', UNIX_TIMESTAMP(), '', 'no'),
(24, 'fmhack_helpdesk', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(25, 'fmhack_torrent_request_and_vote', '1.1 (FM)', 'DiemThuy & cooly', UNIX_TIMESTAMP(), '', 'no'),
(26, 'fmhack_extended_torrent_description', '1.0 (FM)', 'Khez', UNIX_TIMESTAMP(), '', 'no'),
(27, 'fmhack_graphic_average_bar', '1.0 (FM)', 'miskotes', UNIX_TIMESTAMP(), '', 'no'),
(28, 'fmhack_uploader_size_and_comments_on_torrent_list', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(29, 'fmhack_display_new_torrents_since_last_Visit', '1.0 (FM)', 'vasyajva', UNIX_TIMESTAMP(), '', 'no'),
(30, 'fmhack_lottery', '1.0 (FM)', 'JBoy (Original: Gewa)', UNIX_TIMESTAMP(), '', 'no'),
(31, 'fmhack_shoutbox_banned', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(32, 'fmhack_LED_ticker', '1.0 (FM)', 'cooly (Original idea by Diemthuy)', UNIX_TIMESTAMP(), '', 'no'),
(33, 'fmhack_torrent_thanks', '1.0 (FM)', 'Lupin', UNIX_TIMESTAMP(), '', 'no'),
(34, 'fmhack_downloaded_torrents', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(35, 'fmhack_advanced_torrent_search', '1.3 (FM)', 'DiemThuy & cooly', UNIX_TIMESTAMP(), '', 'no'),
(36, 'fmhack_sport_betting', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(37, 'fmhack_site_offline', '1.0 (FM)', 'Lupin', UNIX_TIMESTAMP(), '', 'no'),
(38, 'fmhack_shoutcast_stats_and_DJ_application', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(39, 'fmhack_message_spy', '1.1 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(40, 'fmhack_download_ratio_checker', '1.0 (FM)', 'Petr1fied & fatepower', UNIX_TIMESTAMP(), '', 'no'),
(41, 'fmhack_signup_bonus_upload', '1.0 (FM)', 'RBert', UNIX_TIMESTAMP(), '', 'no'),
(42, 'fmhack_add_new_users_in_adminCP', '1.0 (FM)', 'Lupin', UNIX_TIMESTAMP(), '', 'no'),
(43, 'fmhack_torrents_limit', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(44, 'fmhack_enhanced_wait_time', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(45, 'fmhack_ban_client', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(46, 'fmhack_auto_duplicate_torrent_checker', '1.0 (FM)', 'cooly & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(47, 'fmhack_show_members_whois_record_on_userdetails', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(48, 'fmhack_ban_button', '1.0 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(49, 'fmhack_ratio_editor', '1.0 (FM)', 'dodge & JBoy', UNIX_TIMESTAMP(), '', 'no'),
(50, 'fmhack_speed_stats_in_peers_with_filename', '1.0 (FM)', 'miskotes & Lupin', UNIX_TIMESTAMP(), '', 'no');
INSERT INTO `{$db_prefix}hacks` (`id`, `title`, `version`, `author`, `added`, `folder`, `prerequisite`) VALUES
(51, 'fmhack_subtitles', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(52, 'fmhack_torrent_nuked_and_requested', '1.0 (FM)', 'Author: RippeR | Conversion by Laurianti', UNIX_TIMESTAMP(), '', 'no'),
(53, 'fmhack_duplicate_accounts', '1.0 (FM)', 'CobraCRK', UNIX_TIMESTAMP(), '', 'no'),
(54, 'fmhack_high_UL_speed_report', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(55, 'fmhack_twitter_update', '1.0 (FM)', 'mcangeli & DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(56, 'fmhack_torrent_moderation', '1.2 (FM)', 'Losmi & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(57, 'fmhack_uploader_medals', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(58, 'fmhack_NFO_uploader_-_viewer', '1.1 (FM)', 'miskotes', UNIX_TIMESTAMP(), '', 'no'),
(59, 'fmhack_IMG_in_SB_after_x_shouts', '1.0 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(60, 'fmhack_balloons_on_mouseover', '1.1 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(61, 'fmhack_teams', '1.1 (FM)', 'cooly & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(62, 'fmhack_circling_last_torrents', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(63, 'fmhack_xbtit_->_SMF_style_bridge', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(64, 'fmhack_private_shouts', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(65, 'fmhack_lock_comments', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(66, 'fmhack_account_parked', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(67, 'fmhack_low_ratio_ban_system', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(68, 'fmhack_automatic_album_cover_and_picture_grabber', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(69, 'fmhack_hide_online_status', '1.1 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(70, 'fmhack_upload_multiplier', '1.1 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(71, 'fmhack_torrentBar', '1.0 (FM)', 'confe', UNIX_TIMESTAMP(), '', 'no'),
(72, 'fmhack_allow_and_disallow_users_to_up_and_download', '1.0 (FM)', 'linux198', UNIX_TIMESTAMP(), '', 'fmhack_detect_and_blacklist_proxy'),
(73, 'fmhack_detect_and_blacklist_proxy', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(74, 'fmhack_view_edit_delete_preview_shoutBox_comments', '1.0 (FM)', 'miskotes', UNIX_TIMESTAMP(), '', 'fmhack_comments_layout'),
(75, 'fmhack_comments_layout', '1.0 (FM)', 'Real_ptr', UNIX_TIMESTAMP(), '', 'no'),
(76, 'fmhack_faq_with_groups', '1.0 (FM)', 'Losmi', UNIX_TIMESTAMP(), '', 'fmhack_forced_FAQ'),
(77, 'fmhack_gifts', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(78, 'fmhack_hide_language', '2.0 (FM)', 'King Cobra', UNIX_TIMESTAMP(), '', 'no'),
(79, 'fmhack_hide_style', '2.0 (FM)', 'King Cobra', UNIX_TIMESTAMP(), '', 'no'),
(80, 'fmhack_bbcode_enhancements', '1.0 (FM)', 'King Cobra', UNIX_TIMESTAMP(), '', 'no'),
(81, 'fmhack_auto_announce', '1.0 (FM)', 'linux198', UNIX_TIMESTAMP(), '', 'no'),
(82, 'fmhack_staff_control', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(83, 'fmhack_torrent_bookmark', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(84, 'fmhack_birthdays', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(85, 'fmhack_PM_banned', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(86, 'fmhack_integrated_forum_display', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(87, 'fmhack_pm_alert_in_shoutbox', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(88, 'fmhack_view_peer_details', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(89, 'fmhack_download_prefix_or_suffix', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(90, 'fmhack_uploader_rights', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(91, 'fmhack_pager_type_select', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(92, 'fmhack_user_notes', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(93, 'fmhack_avatar_signature_sync', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(94, 'fmhack_ban_cheapmail_domains', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(95, 'fmhack_uploader_control', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(96, 'fmhack_IP_to_country', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'fmhack_last_download_block'),
(97, 'fmhack_avatar_upload', '1.0 (FM)', 'JBoy', UNIX_TIMESTAMP(), '', 'no'),
(98, 'fmhack_forced_FAQ', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(99, 'fmhack_registration_open_randomly', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(100, 'fmhack_forum_auto_topic', '1.1 (FM)', 'dodge & Petr1fied', UNIX_TIMESTAMP(), '', 'no');
INSERT INTO `{$db_prefix}hacks` (`id`, `title`, `version`, `author`, `added`, `folder`, `prerequisite`) VALUES
(101, 'fmhack_offer_to_re-encode', '1.0 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(102, 'fmhack_shoutbox_clean', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(103, 'fmhack_SEO_panel', '3.0 (FM)', 'atmoner', UNIX_TIMESTAMP(), '', 'no'),
(104, 'fmhack_staff_comment_in_torrent_details', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(105, 'fmhack_disable_user_registration_with_duplicate_IP', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(106, 'fmhack_recommended_torrents', '1.0 (FM)', 'kvetinka', UNIX_TIMESTAMP(), '', 'no'),
(107, 'fmhack_user_images', '1.0 (FM)', 'DiemThuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(108, 'fmhack_direct_download', '1.1 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(109, 'fmhack_about_me', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(110, 'fmhack_CBT_(Coolys_Backup_Tools)', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(111, 'fmhack_multi_tracker_scrape', '1.0 (FM)', 'Bitheaven', UNIX_TIMESTAMP(), '', 'no'),
(112, 'fmhack_user_watch_list', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(113, 'fmhack_partners_page', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(114, 'fmhack_similar_torrents', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(115, 'fmhack_force_ssl', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'SSL must be installed in the server.'),
(116, 'fmhack_addthis', '1.0 (FM)', 'signo', UNIX_TIMESTAMP(), '', 'no'),
(117, 'fmhack_alternate_login', '1.1 (FM)', 'King Cobra & cooly', UNIX_TIMESTAMP(), '', 'no'),
(118, 'fmhack_refresh_torrent_peers', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(119, 'fmhack_online_timeout', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(120, 'fmhack_search_all_sub-categories', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(121, 'fmhack_show_or_hide_porn', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(122, 'fmhack_private_profile', '1.0 (FM)', 'MrFix', UNIX_TIMESTAMP(), '', 'no'),
(123, 'fmhack_anonymous_links', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP() , '', 'no'),
(124, 'fmhack_language_in_torrent_list_and_details', '1.0 (FM)', 'MrFix', UNIX_TIMESTAMP() , '', 'no'),
(125, 'fmhack_torrent_details_media_player', '1.0 (FM)', 'Djburn', UNIX_TIMESTAMP() , '', 'no'),
(126, 'fmhack_signature_on_internal_forum', '1.0 (FM)', 'Lupin', UNIX_TIMESTAMP(), '', 'no'),
(127, 'fmhack_user_signup_agreement', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(128, 'fmhack_total_online_time', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no'),
(129, 'fmhack_last_download_block', '1.0 (FM)', 'DrAgon64', UNIX_TIMESTAMP(), '', 'no'),
(130, 'fmhack_VIP_freeleech', '1.1 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(131, 'fmhack_torrent_view_count', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(132, 'fmhack_split_torrents_by_date', '1.0 (FM)', 'hasu (George Hasu)', UNIX_TIMESTAMP(), '', 'no'),
(133, 'fmhack_social_network', '1.0 (FM)', 'Diemthuy & Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(134, 'fmhack_bump_torrents', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(135, 'fmhack_advanced_RSS_feed', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(136, 'fmhack_archive_torrents', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(137, 'fmhack_ads_system', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(138, 'fmhack_default_cat_browse', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(139, 'fmhack_welcome_pm', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(140, 'fmhack_logical_rank_ordering', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(141, 'fmhack_freeleech_slots', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(142, 'fmhack_torrent_of_the_week', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(143, 'fmhack_profile_torrent_sorting', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(144, 'fmhack_comment_captcha', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(145, 'fmhack_pM_notification_on_torrent_comment', '1.0 (FM)', 'Liroy (Original author:gAnDo)', UNIX_TIMESTAMP(), '', 'no'),
(146, 'fmhack_no_columns_display', '1.1 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(147, 'fmhack_protected_usernames', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(148, 'fmhack_multi_delete_torrents', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(149, 'fmhack_poll_from_integrated_forum', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(150, 'fmhack_torrent_activity_colouring', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no');
INSERT INTO `{$db_prefix}hacks` (`id`, `title`, `version`, `author`, `added`, `folder`, `prerequisite`) VALUES
(151, 'fmhack_grab_images_from_theTVDB', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(152, 'fmhack_advanced_prune_users_and_torrents', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(153, 'fmhack_previous_usernames', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(154, 'fmhack_download_requires_introduction', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(155, 'fmhack_only_allow_specified_email_domains', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(156, 'fmhack_magnet_links', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(157, 'fmhack_block_signup_from_certain_countries', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(158, 'fmhack_permissions_for_external_torrents', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(159, 'fmhack_torrent_times', '1.0 (FM)', 'Petr1fied', UNIX_TIMESTAMP(), '', 'no'),
(160, 'fmhack_gallery', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(161, 'fmhack_custom_smileys', '1.0 (FM)', 'cooly', UNIX_TIMESTAMP(), '', 'no'),
(162, 'fmhack_file_hosting', '1.0 (FM)', 'Diemthuy', UNIX_TIMESTAMP(), '', 'no'),
(163, 'fmhack_apply_for_membership', '1.0 (FM)', 'DiemThuy', UNIX_TIMESTAMP(), '', 'no');

CREATE TABLE `{$db_prefix}helpdesk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '',
  `msg_problem` text,
  `added` int(11) NOT NULL DEFAULT '0',
  `solved_date` int(11) NOT NULL DEFAULT '0',
  `solved` enum('no','yes','ignored') NOT NULL DEFAULT 'no',
  `added_by` int(10) NOT NULL DEFAULT '0',
  `solved_by` int(10) NOT NULL DEFAULT '0',
  `msg_answer` text,
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}history` (
  `uid` int(10) DEFAULT NULL,
  `infohash` varchar(40) NOT NULL DEFAULT '',
  `date` int(10) DEFAULT NULL,
  `uploaded` bigint(20) NOT NULL DEFAULT '0',
  `downloaded` bigint(20) NOT NULL DEFAULT '0',
  `active` enum('yes','no') NOT NULL DEFAULT 'no',
  `agent` varchar(30) NOT NULL DEFAULT '',
  `completed` enum('no','yes') NOT NULL DEFAULT 'no',
  `hit` enum('no','yes') NOT NULL DEFAULT 'no',
  `hitchecked` int(11) NOT NULL DEFAULT '0',
  `punishment_amount` int(11) NOT NULL DEFAULT '0',
  `seed` bigint(99) NOT NULL DEFAULT '0',
  `started_time` int(11) NOT NULL DEFAULT '-1',
  `completed_time` int(11) NOT NULL DEFAULT '-1',
  UNIQUE KEY `uid` (`uid`,`infohash`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}hnr` (
  `id_level` int(11) NOT NULL DEFAULT '0',
  `method` enum('seed_only','ratio_only','seed_or_ratio','seed_and_ratio') NOT NULL DEFAULT 'seed_only',
  `min_seed_hours` int(11) NOT NULL DEFAULT '0',
  `min_ratio` float NOT NULL DEFAULT '0',
  `tolerance_hours` int(11) NOT NULL DEFAULT '0',
  `dl_trig_bytes` bigint(20) NOT NULL DEFAULT '0',
  `block_leech` int(11) NOT NULL DEFAULT '0',
  `forum_post` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_level` (`id_level`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}invitations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inviter` int(10) unsigned NOT NULL DEFAULT '0',
  `invitee` varchar(80) NOT NULL DEFAULT '',
  `hash` varchar(32) NOT NULL DEFAULT '',
  `time_invited` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmed` enum('true','false') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `inviter` (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}ip2country` (
  `ip_from` double NOT NULL DEFAULT '0',
  `ip_to` double NOT NULL DEFAULT '0',
  `country_code2` char(2) NOT NULL DEFAULT '',
  `country_code3` char(3) NOT NULL DEFAULT '',
  `country_name` varchar(50) NOT NULL DEFAULT '',
  KEY `country_code2` (`country_code2`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}khez_configs` (
  `key` varchar(30) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`key`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}khez_configs` (`key`, `value`) VALUES
('xtd_enabled', 'true'),
('xtd_img', '1'),
('xtd_url', '1'),
('xtd_chars', '100'),
('xtd_file', 'Downloaded from YOUR_TRACKER.com'),
('xtd_casesens', 'true'),
('xtd_loc', '3');

CREATE TABLE `{$db_prefix}language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) NOT NULL DEFAULT '',
  `language_url` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}language` (`id`, `language`, `language_url`) VALUES
(1, 'English', 'language/english'),
(2, 'Romanian', 'language/romanian'),
(3, 'Polish', 'language/polish'),
(4, 'Srpsko-Hrvatski', 'language/serbocroatian'),
(5, 'Dutch', 'language/dutch'),
(6, 'Italiano', 'language/italian'),
(7, 'Russian', 'language/russian'),
(8, 'German', 'language/german'),
(9, 'Hungarian', 'language/hungarian'),
(10, 'Francais', 'language/french'),
(11, 'Finnish', 'language/finnish'),
(12, 'Vietnamese', 'language/vietnamese'),
(13, 'Greek', 'language/greek'),
(14, 'Bulgarian', 'language/bulgarian'),
(15, 'Spanish', 'language/spanish'),
(16, 'Portuguese-BR', 'language/portuguese-BR'),
(17, 'Portuguese-PT', 'language/portuguese-PT'),
(18, 'Swedish', 'language/swedish'),
(19, 'Arabic', 'language/arabic'),
(20, 'Danish', 'language/danish'),
(21, 'Chinese-Simplified', 'language/chinese'),
(22, 'Bengali', 'language/bangla');

CREATE TABLE `{$db_prefix}logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` int(10) DEFAULT NULL,
  `txt` text,
  `type` varchar(10) NOT NULL DEFAULT 'add',
  `user` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `added` (`added`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}lottery_config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `lot_expire_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lot_number_winners` varchar(20) NOT NULL DEFAULT '',
  `lot_number_to_win` varchar(20) NOT NULL DEFAULT '',
  `lot_amount` varchar(20) NOT NULL DEFAULT '',
  `lot_status` enum('yes','no','closed') NOT NULL DEFAULT 'yes',
  `limit_buy` char(2) NOT NULL DEFAULT '',
  `sender_id` char(8) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}lottery_config` (`id`, `lot_expire_date`, `lot_number_winners`, `lot_number_to_win`, `lot_amount`, `lot_status`, `limit_buy`, `sender_id`) VALUES
(0, '0000-00-00 00:00:00', '', '', '', '', '', '2'),
(1, '0000-00-00 00:00:00', '0', '0', '0', 'closed', '0', '2');

CREATE TABLE `{$db_prefix}lottery_tickets` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}lottery_winners` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `win_user` varchar(20) NOT NULL DEFAULT '',
  `windate` varchar(20) NOT NULL DEFAULT '',
  `price` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}low_ratio_ban` (
  `wb_down` varchar(10) NOT NULL,
  `wb_rank` varchar(10) NOT NULL,
  `wb_warn` enum('true','false') NOT NULL,
  `wb_one` varchar(10) NOT NULL,
  `wb_days_one` varchar(10) NOT NULL,
  `wb_two` varchar(10) NOT NULL,
  `wb_days_two` varchar(10) NOT NULL,
  `wb_three` varchar(10) NOT NULL,
  `wb_days_fin` varchar(10) NOT NULL,
  `wb_fin` varchar(10) NOT NULL,
  UNIQUE KEY `wb_rank` (`wb_rank`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}low_ratio_ban_settings` (
  `id` varchar(4) NOT NULL DEFAULT '1',
  `wb_sys` enum('true','false') NOT NULL DEFAULT 'false',
  `wb_text_one` varchar(255) NOT NULL,
  `wb_text_two` varchar(255) NOT NULL,
  `wb_text_fin` varchar(255) NOT NULL
); -- TABLEOPT --

INSERT INTO `{$db_prefix}low_ratio_ban_settings` (`id`, `wb_sys`, `wb_text_one`, `wb_text_two`, `wb_text_fin`) VALUES
('1', 'false', 'Message for first warning here', 'Message for second warning here', 'Message for final warning here');

CREATE TABLE `{$db_prefix}messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` int(10) unsigned NOT NULL DEFAULT '0',
  `receiver` int(10) unsigned NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `subject` varchar(50) NOT NULL DEFAULT '',
  `msg` text,
  `readed` enum('yes','no') NOT NULL DEFAULT 'no',
  `deletedBySender` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}moderate_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `ordering` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}modules` (
  `id` mediumint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `activated` enum('yes','no') NOT NULL DEFAULT 'yes',
  `type` enum('staff','misc','torrent','style') NOT NULL DEFAULT 'misc',
  `changed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}modules` (`id`, `name`, `activated`, `type`, `changed`, `created`) VALUES
(1, 'seedbonus', 'yes', 'misc', NOW(), NOW()),
(2, 'helpdesk', 'yes', 'misc', NOW(), NOW());

CREATE TABLE `{$db_prefix}news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` blob NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(40) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}news` (`id`, `news`, `user_id`, `date`, `title`) VALUES
(1, 0x496620796f752063616e20726561642074686973207468656e20796f757220736574207570206f66207862746974464d20776173206120737563636573732e203a7468756d627375703a0d0a0d0a596f752077696c6c2077616e7420746f2064656c657465207468697320706f73742e0d0a0d0a546563686e6963616c20737570706f72742063616e20626520666f756e64206f6e20746865207862746974464d20537570706f727420666f72756d73205b75726c3d687474703a2f2f7862746974666d2e636f6d2f666f72756d5d686572655b2f75726c5d2e0d0a, 2, NOW(), 'Welcome to xbtitFM');

CREATE TABLE `{$db_prefix}online` (
  `session_id` varchar(40) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `location` varchar(20) NOT NULL,
  `lastaction` int(10) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_group` varchar(50) NOT NULL,
  `prefixcolor` varchar(200) NOT NULL,
  `suffixcolor` varchar(200) NOT NULL,
  `donor` enum('yes','no') NOT NULL DEFAULT 'no',
  `warn_lev` int(11) NOT NULL DEFAULT '0',
  `booted` enum('yes','no') NOT NULL DEFAULT 'no',
  `invisible` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_images` varchar(50) NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `user_id` (`user_id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}partner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `addedby` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}paypal_settings` (
  `id` varchar(60) NOT NULL DEFAULT '',
  `test` enum('true','false') NOT NULL DEFAULT 'true',
  `paypal_email` varchar(60) NOT NULL DEFAULT '',
  `sandbox_email` varchar(60) NOT NULL DEFAULT '',
  `vip_days` varchar(60) NOT NULL DEFAULT '',
  `vip_rank` varchar(60) NOT NULL DEFAULT '',
  `needed` varchar(60) NOT NULL DEFAULT '',
  `due_date` varchar(60) NOT NULL DEFAULT '',
  `num_block` varchar(60) NOT NULL DEFAULT '',
  `received` varchar(60) NOT NULL DEFAULT '',
  `donation_block` enum('true','false') NOT NULL DEFAULT 'true',
  `scrol_tekst` varchar(255) NOT NULL DEFAULT '',
  `units` enum('AUD','BRL','BGN','CAD','CHF','CNY','CZK','DKK','EUR','GBP','HKD','HUF','ILS','INR','JPY','LTL','MKD','MXN','MYR','NOK','NZD','PHP','PLN','RON','RUB','SEK','SGD','THB','TWD','USD','ZAR') NOT NULL DEFAULT 'EUR',
  `historie` enum('true','false') NOT NULL DEFAULT 'true',
  `don_star` enum('true','false') NOT NULL DEFAULT 'true',
  `gb` varchar(60) NOT NULL DEFAULT '',
  `smf` varchar(60) NOT NULL DEFAULT '',
  `vip_daysb` varchar(60) NOT NULL DEFAULT '',
  `vip_daysc` varchar(60) NOT NULL DEFAULT '',
  `gbb` varchar(60) NOT NULL DEFAULT '',
  `gbc` varchar(60) NOT NULL DEFAULT '',
  `togb` varchar(60) NOT NULL DEFAULT '',
  `togbb` varchar(60) NOT NULL DEFAULT '',
  `today` varchar(60) NOT NULL DEFAULT '',
  `todayb` varchar(60) NOT NULL DEFAULT '',
  `todayc` varchar(60) NOT NULL DEFAULT '',
  `togbc` varchar(60) NOT NULL DEFAULT '',
  `poss_don_amnt` text NOT NULL,
  `IPN` enum('true','false') NOT NULL DEFAULT 'true',
  `identity_token` varchar(255) NOT NULL DEFAULT '',
  `alertpay_email` varchar(60) NOT NULL DEFAULT '',
  `alertpay_code` varchar(60) NOT NULL DEFAULT '',
  `ap` enum('true','false') NOT NULL DEFAULT 'false',
  `pp` enum('true','false') NOT NULL DEFAULT 'true',
  `auto` enum('true','false') NOT NULL DEFAULT 'false',
  `fl_slot` enum('true','false') NOT NULL DEFAULT 'false',
  `fl_slot_cost` varchar(60) NOT NULL DEFAULT '',
  `bc` enum('true','false') NOT NULL DEFAULT 'false',
  `bitcoin_address` varchar(40) NOT NULL,
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}paypal_settings` (`id`, `test`, `paypal_email`, `sandbox_email`, `vip_days`, `vip_rank`, `needed`, `due_date`, `num_block`, `received`, `donation_block`, `scrol_tekst`, `units`, `historie`, `don_star`, `gb`, `smf`, `vip_daysb`, `vip_daysc`, `gbb`, `gbc`, `togb`, `togbb`, `today`, `todayb`, `todayc`, `togbc`, `poss_don_amnt`, `IPN`, `identity_token`, `alertpay_email`, `alertpay_code`, `ap`, `pp`, `auto`, `fl_slot`, `fl_slot_cost`, `bc`, `bitcoin_address`) VALUES
('1', 'true', 'email', 'email', '1', '5', '50', '31/04/13', '3', '0', 'true', 'your text here', 'EUR', 'true', 'true', '3', '15', '2', '3', '5', '8', '20', '40', '20', '40', '', '', '5,10,15,20,30,40,50,60,80,100', 'true', '', 'email', '', 'false', 'true', 'false', 'false', '10', 'false', '');

CREATE TABLE `{$db_prefix}peers` (
  `infohash` varchar(40) NOT NULL DEFAULT '',
  `peer_id` varchar(40) NOT NULL DEFAULT '',
  `bytes` bigint(20) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT 'error.x',
  `port` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` enum('leecher','seeder') NOT NULL DEFAULT 'leecher',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `sequence` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `natuser` enum('N','Y') NOT NULL DEFAULT 'N',
  `client` varchar(60) NOT NULL DEFAULT '',
  `dns` varchar(100) NOT NULL DEFAULT '',
  `uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `pid` varchar(32) DEFAULT NULL,
  `with_peerid` varchar(101) NOT NULL DEFAULT '',
  `without_peerid` varchar(40) NOT NULL DEFAULT '',
  `compact` varchar(6) NOT NULL DEFAULT '',
  `announce_interval` int(10) NOT NULL,
  `upload_difference` bigint(20) NOT NULL,
  `download_difference` bigint(20) NOT NULL,
  `real_uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `real_downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`infohash`,`peer_id`),
  UNIQUE KEY `sequence` (`sequence`),
  KEY `pid` (`pid`),
  KEY `ip` (`ip`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}poller` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` int(10) NOT NULL DEFAULT '0',
  `endDate` int(10) NOT NULL DEFAULT '0',
  `pollerTitle` varchar(255) DEFAULT NULL,
  `starterID` mediumint(8) NOT NULL DEFAULT '0',
  `active` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`ID`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}poller` (`ID`, `startDate`, `endDate`, `pollerTitle`, `starterID`, `active`) VALUES
(1, UNIX_TIMESTAMP(), 0, 'How would you rate this script?', 2, 'yes');

CREATE TABLE `{$db_prefix}poller_option` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pollerID` int(11) DEFAULT NULL,
  `optionText` varchar(255) DEFAULT NULL,
  `pollerOrder` int(11) DEFAULT NULL,
  `defaultChecked` char(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}poller_option` (`ID`, `pollerID`, `optionText`, `pollerOrder`, `defaultChecked`) VALUES
(1, 1, 'Excellent', 1, '1'),
(2, 1, 'Very good', 2, '0'),
(3, 1, 'Good', 3, '0'),
(4, 1, 'Fair', 3, '0'),
(5, 1, 'Poor', 4, '0');

CREATE TABLE `{$db_prefix}poller_vote` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pollerID` int(11) NOT NULL DEFAULT '0',
  `optionID` int(11) DEFAULT NULL,
  `ipAddress` bigint(11) DEFAULT '0',
  `voteDate` int(10) NOT NULL DEFAULT '0',
  `memberID` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}polls` (
  `pid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `startdate` int(10) DEFAULT NULL,
  `choices` text,
  `starter_id` mediumint(8) NOT NULL DEFAULT '0',
  `votes` smallint(5) NOT NULL DEFAULT '0',
  `poll_question` varchar(255) DEFAULT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`pid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}poll_voters` (
  `vid` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL DEFAULT '',
  `votedate` int(10) NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `memberid` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`vid`),
  KEY `pid` (`pid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `body` text,
  `editedby` int(10) unsigned NOT NULL DEFAULT '0',
  `editedat` int(10) DEFAULT '0',
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`),
  FULLTEXT KEY `body` (`body`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}rank` (
  `userid` int(11) NOT NULL,
  `old_rank` int(11) NOT NULL,
  `new_rank` int(11) NOT NULL,
  `byt` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `undone` enum('yes','no') NOT NULL DEFAULT 'no',
  KEY `old_rank` (`old_rank`),
  KEY `byt` (`byt`),
  KEY `userid` (`userid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}ratings` (
  `infohash` char(40) NOT NULL DEFAULT '',
  `userid` int(10) unsigned NOT NULL DEFAULT '1',
  `rating` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `added` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `infohash` (`infohash`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}readposts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpostread` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}recommended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `user_name` varchar(40) NOT NULL DEFAULT 'anonymous',
  PRIMARY KEY (`id`),
  KEY `info_hash` (`info_hash`),
  KEY `user_name` (`user_name`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addedby` int(10) unsigned NOT NULL DEFAULT '0',
  `votedfor` varchar(50) DEFAULT NULL,
  `type` enum('torrent','user') NOT NULL DEFAULT 'torrent',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `dealtby` int(10) unsigned NOT NULL DEFAULT '0',
  `dealtwith` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `request` varchar(225) DEFAULT NULL,
  `descr` text NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fulfilled` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `cat` int(10) unsigned NOT NULL DEFAULT '0',
  `filled` varchar(255) DEFAULT NULL,
  `filledby` int(10) unsigned NOT NULL DEFAULT '0',
  `job` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `sort_index` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}rules_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `sort_index` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}seo` (
  `id` varchar(60) NOT NULL DEFAULT '',
  `activated` enum('true','false') NOT NULL DEFAULT 'false',
  `activated_user` enum('true','false') NOT NULL,
  `str` varchar(400) NOT NULL DEFAULT '',
  `strto` varchar(400) NOT NULL DEFAULT '',
  `cano` enum('true','false') NOT NULL,
  `use_meta` enum('true','false') NOT NULL,
  `metakeyword` varchar(400) NOT NULL,
  `metadesc` varchar(400) NOT NULL,
  `copyright` varchar(400) NOT NULL DEFAULT '',
  `author` varchar(400) NOT NULL,
  `robots` varchar(400) NOT NULL,
  `revisitafter` varchar(10) NOT NULL,
  `analytic_active` enum('true','false') NOT NULL,
  `ggwebmaster_active` enum('true','false') NOT NULL,
  `analytic` varchar(400) NOT NULL,
  `ggwebmaster` varchar(400) NOT NULL,
  `maxurl` varchar(500) NOT NULL,
  `namemap` varchar(400) NOT NULL,
  `active_map` enum('true','false') NOT NULL,
  `abs_path` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}seo` (`id`, `activated`, `activated_user`, `str`, `strto`, `cano`, `use_meta`, `metakeyword`, `metadesc`, `copyright`, `author`, `robots`, `revisitafter`, `analytic_active`, `ggwebmaster_active`, `analytic`, `ggwebmaster`, `maxurl`, `namemap`, `active_map`, `abs_path`) VALUES
('1', 'true', 'true', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ {}[]', 'abcdefghijklmnopqrstuvwxyz-----', 'true', 'true', 'Meta Keyword for xbtit team', 'Meta description for xbtit team', 'your Meta Copyright', 'your Meta Author', 'index, follow', '12 days', 'true', 'true', 'analytict', 'testee', '3', 'sitemap.xml', 'true', '/var/www/');

CREATE TABLE `{$db_prefix}settings` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('name', 'xbtitFM'),
('url', 'http://localhost/dev'),
('announce', 'a:2:{i:0;s:30:"http://localhost/announce.php\r";i:1;s:30:"http://localhost:2710/announce";}'),
('email', 'admin@localhost'),
('torrentdir', 'torrents'),
('external', 'true'),
('gzip', 'true'),
('debug', 'true'),
('disable_dht', 'true'),
('livestat', 'true'),
('logactive', 'true'),
('loghistory', 'true'),
('p_announce', 'true'),
('p_scrape', 'false'),
('show_uploader', 'false'),
('usepopup', 'false'),
('default_language', '1'),
('default_charset', 'UTF-8'),
('default_style', '1'),
('max_users', '0'),
('max_torrents_per_page', '15'),
('sanity_update', '1800'),
('external_update', '1800'),
('max_announce', '1800'),
('min_announce', '300'),
('max_peers_per_announce', '50'),
('dynamic', 'false'),
('nat', 'false'),
('persist', 'false'),
('allow_override_ip', 'false'),
('countbyte', 'true'),
('peercaching', 'false'),
('maxpid_seeds', '3'),
('maxpid_leech', '1'),
('validation', 'user'),
('imagecode', 'true'),
('forum', ''),
('clocktype', 'false'),
('newslimit', '3'),
('forumlimit', '5'),
('last10limit', '5'),
('mostpoplimit', '5'),
('xbtt_url', 'http://localhost:2710'),
('cache_duration', '0'),
('cut_name', '0'),
('mail_type', 'php'),
('invitation_reqvalid', 'false'),
('invitation_only', 'true'),
('fmhack_invitation_system', 'disabled'),
('fm_version', '17');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('mindlratio', '0.5'),
('fmhack_custom_title', 'disabled'),
('bonus', '1'),
('price_vip', '750'),
('price_ct', '200'),
('price_name', '500'),
('fmhack_bonus_system', 'disabled'),
('gb_enable', 'true'),
('vip_enable', 'true'),
('ct_enable', 'true'),
('uname_enable', 'true'),
('inv_enable', 'false'),
('price_inv', '500'),
('price_inv3', '1250'),
('price_inv5', '2000'),
('bonus_type', 'all'),
('upl_enable', 'false'),
('bonus_upl', '100'),
('bonus_upl_delay', '24'),
('comm_enable', 'false'),
('bonus_comm', '100'),
('vip_timeframe', '0'),
('forpost_enable', 'false'),
('bonus_forpost', '10'),
('dh_unit', 'true'),
('dh_pm', 'false'),
('dh_text', 'your text here'),
('fmhack_donation_history', 'disabled'),
('fmhack_simple_donor_display', 'disabled'),
('invitation_expires', '7'),
('fmhack_timed_ranks', 'disabled'),
('fmhack_advanced_auto_donation_system', 'disabled'),
('fmhack_gold_and_silver_torrents', 'disabled'),
('fmhack_free_leech_with_happy_hour', 'disabled'),
('imageon', 'true'),
('uploaddir', 'torrentimg/'),
('file_limit', '15'),
('screenon', 'true'),
('fmhack_torrent_image_upload', 'disabled'),
('fmhack_warning_system', 'disabled'),
('hitnumber', '2'),
('scrol_tekst', 'your text here'),
('fmhack_anti_hit_and_run_system', 'disabled'),
('fmhack_ask_for_reseed', 'disabled'),
('autorank_fullcheck', '0'),
('fmhack_auto_rank', 'disabled'),
('fmhack_report_users_and_torrents', 'disabled'),
('fmhack_booted', 'disabled'),
('fmhack_group_colours_overall', 'disabled'),
('fmhack_getIMDB_in_torrent_details', 'disabled');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('fmhack_staffpanel', 'disabled'),
('fmhack_rules_with_groups', 'disabled'),
('seedbox', 'lro-0-6'),
('fmhack_show_if_seedbox_is_used', 'disabled'),
('fmhack_shoutbox_member_and_torrent_announce', 'disabled'),
('fmhack_sticky_torrent', 'disabled'),
('fmhack_helpdesk', 'disabled'),
('req_prune', '30'),
('req_page', '10'),
('req_sb', '10'),
('req_mb', '10000'),
('req_rwon', 'true'),
('req_sbmb', 'true'),
('req_shout', 'true'),
('req_max', '100'),
('req_onoff', 'true'),
('req_number', '5'),
('req_maxon', 'true'),
('fmhack_torrent_request_and_vote', 'disabled'),
('fmhack_extended_torrent_description', 'disabled'),
('fmhack_graphic_average_bar', 'disabled'),
('fmhack_uploader_size_and_comments_on_torrent_list', 'disabled'),
('fmhack_display_new_torrents_since_last_Visit', 'disabled'),
('fmhack_lottery', 'disabled'),
('fmhack_shoutbox_banned', 'disabled'),
('fmhack_LED_ticker', 'disabled'),
('ticker_msg_1', 'testing testing'),
('ticker_msg_2', 'hello hello'),
('ticker_msg_3', 'change me now'),
('ticker_msg_4', 'blah blah'),
('fmhack_torrent_thanks', 'disabled'),
('fmhack_downloaded_torrents', 'disabled'),
('fmhack_advanced_torrent_search', 'disabled'),
('fmhack_sport_betting', 'disabled'),
('fmhack_site_offline', 'disabled'),
('fmhack_shoutcast_stats_and_DJ_application', 'disabled'),
('fmhack_message_spy', 'disabled'),
('fmhack_download_ratio_checker', 'disabled'),
('min_bet', 'lro-0-3'),
('fid_bet', '1'),
('max_bon_bet', '200'),
('fid_bet_user', '0'),
('radio_pass', 'mypass'),
('radio_port', '8000'),
('radio_ip', 'localhost'),
('radio_interval', '1200'),
('fmhack_signup_bonus_upload', 'disabled'),
('donate_upload', '1'),
('unit', 'Gb'),
('fmhack_add_new_users_in_adminCP', 'disabled');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('fmhack_torrents_limit', 'disabled'),
('fmhack_enhanced_wait_time', 'disabled'),
('fmhack_ban_client', 'disabled'),
('fmhack_auto_duplicate_torrent_checker', 'disabled'),
('fmhack_show_members_whois_record_on_userdetails', 'disabled'),
('fmhack_ban_button', 'disabled'),
('bandays', '2'),
('banbutton', 'lro-0-8'),
('fmhack_ratio_editor', 'disabled'),
('sb_speed_enable', 'true'),
('bonus_min_uprate', '1'),
('sb_max_ph_enable', 'true'),
('bonus_max_per_hour', '50'),
('sb_shout_enable', 'true'),
('bonus_make_a_shout', '0.1'),
('bonus_listen2radio', '1'),
('sb_gift_enable', 'true'),
('bonus_giftmax', '250'),
('fmhack_speed_stats_in_peers_with_filename', 'disabled'),
('sb_radio_enable', 'true'),
('fmhack_subtitles', 'disabled'),
('fmhack_torrent_nuked_and_requested', 'disabled'),
('fmhack_duplicate_accounts', 'disabled'),
('fmhack_high_UL_speed_report', 'disabled'),
('highspeed', '1000'),
('highswitch', 'true'),
('highonce', 'false'),
('fmhack_twitter_update', 'disabled'),
('fmhack_torrent_moderation', 'disabled'),
('twitter_request_token', ''),
('twitter_request_token_secret', ''),
('twitter_oauth_token', ''),
('twitter_oauth_token_secret', ''),
('UPD', '20'),
('UPB', '1'),
('UPS', '3'),
('UPG', '5'),
('UPC', 'true'),
('fmhack_uploader_medals', 'disabled'),
('UPBL', '10'),
('fmhack_NFO_uploader_-_viewer', 'disabled'),
('fmhack_IMG_in_SB_after_x_shouts', 'disabled'),
('don_chat', '10'),
('type_chat', 'both'),
('fmhack_balloons_on_mouseover', 'disabled'),
('fmhack_teams', 'disabled'),
('fmhack_circling_last_torrents', 'disabled'),
('fmhack_xbtit_->_SMF_style_bridge', 'disabled'),
('fmhack_private_shouts', 'disabled'),
('fmhack_lock_comments', 'disabled');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('fmhack_account_parked', 'disabled'),
('warn_max', '10'),
('warn_auto_decrease', '10'),
('warn_auto_down_enable', 'yes'),
('warn_bantype', 'no_action_at_max'),
('warn_booted_days', '0'),
('fmhack_low_ratio_ban_system', 'disabled'),
('fmhack_automatic_album_cover_and_picture_grabber', 'disabled'),
('fmhack_hide_online_status', 'disabled'),
('fmhack_upload_multiplier', 'disabled'),
('fmhack_torrentBar', 'disabled'),
('fmhack_allow_and_disallow_users_to_up_and_download', 'disabled'),
('fmhack_detect_and_blacklist_proxy', 'disabled'),
('fmhack_view_edit_delete_preview_shoutBox_comments', 'disabled'),
('fmhack_comments_layout', 'disabled'),
('fmhack_faq_with_groups', 'disabled'),
('fmhack_gifts', 'disabled'),
('fmhack_hide_language', 'disabled'),
('usercp_language', 'enabled'),
('userinfo_language', 'enabled'),
('usertoolbar_language', 'enabled'),
('createacc_language', 'enabled'),
('add_new_user_language', 'enabled'),
('sbg_login_language', 'enabled'),
('rbg_login_language', 'enabled'),
('fmhack_hide_style', 'disabled'),
('usercp_style', 'enabled'),
('userinfo_style', 'enabled'),
('usertoolbar_style', 'enabled'),
('createacc_style', 'enabled'),
('add_new_user_style', 'enabled'),
('sbg_login_style', 'enabled'),
('rbg_login_style', 'enabled'),
('fmhack_bbcode_enhancements', 'disabled'),
('fmhack_auto_announce', 'disabled'),
('fmhack_staff_control', 'disabled'),
('fmhack_torrent_bookmark', 'disabled'),
('fmhack_birthdays', 'disabled'),
('birthday_lower_limit', '4'),
('birthday_upper_limit', '100'),
('birthday_bonus', '0.1'),
('fmhack_PM_banned', 'disabled'),
('fmhack_integrated_forum_display', 'disabled'),
('forum_viewtype', 'iframe'),
('fmhack_pm_alert_in_shoutbox', 'disabled'),
('fmhack_view_peer_details', 'disabled'),
('fmhack_download_prefix_or_suffix', 'disabled'),
('download_prefix', ''),
('download_suffix', ''),
('fmhack_uploader_rights', 'disabled'),
('ulri_edit', 'yes'),
('ulri_delete', 'yes'),
('fmhack_pager_type_select', 'disabled'),
('pager_type', 'new'),
('fmhack_user_notes', 'disabled'),
('fmhack_avatar_signature_sync', 'disabled'),
('fmhack_ban_cheapmail_domains', 'disabled'),
('fmhack_uploader_control', 'disabled'),
('fmhack_IP_to_country', 'disabled'),
('img_file_size', '500'),
('img_size_width', '300'),
('img_size_height', '200'),
('fmhack_avatar_upload', 'disabled'),
('un_invite', 'disabled');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('un_bonus', 'disabled'),
('un_donate', 'disabled'),
('un_warn', 'disabled'),
('un_autorank', 'disabled'),
('un_booted', 'disabled'),
('un_sbban', 'disabled'),
('un_banbut', 'disabled'),
('un_notesperpage', '10'),
('mod_app_pm', 'yes'),
('fmhack_forced_FAQ', 'disabled'),
('fmhack_registration_open_randomly', 'disabled'),
('rreg_open_for', '5'),
('rreg_min', '1'),
('rreg_max', '60'),
('fmhack_forum_auto_topic', 'disabled'),
('smf_autotopic', 'true'),
('smf_tag', '[New Torrent] '),
('ipb_autoposter', '0'),
('fmhack_offer_to_re-encode', 'disabled'),
('fmhack_shoutbox_clean', 'disabled'),
('shoutann_display_uploader', 'no'),
('fmhack_SEO_panel', 'disabled'),
('fmhack_staff_comment_in_torrent_details', 'disabled'),
('staff_comment', 'lro-0-6'),
('staff_comment_view', 'lro-0-6'),
('fmhack_disable_user_registration_with_duplicate_IP', 'disabled'),
('fmhack_recommended_torrents', 'disabled'),
('recommended', '5'),
('fmhack_user_images', 'disabled'),
('user_img_1', 'don5.gif[+]Donator 1'),
('user_img_2', 'don10.gif[+]Donator 2'),
('user_img_3', 'user_male.png[+]Male'),
('user_img_4', 'user_female.png[+]Female'),
('user_img_5', 'birthdayboy-girl.png[+]Birthday'),
('user_img_6', 'bot.png[+]Bot'),
('user_img_7', 'MemberParked.gif[+]Parked'),
('user_img_8', 'banned.png[+]Banned'),
('user_img_9', 'TrustedMusicuploader.png[+]Trusted Music Uploader'),
('user_img_10', 'TrustedMovieUploader.png[+]Trusted Movie Uploader'),
('user_img_11', 'VIPMusicuploader.png[+]VIP Music Uploader'),
('user_img_12', 'VIPMovieUploader.png[+]VIP Movie Uploader'),
('user_img_13', 'Warned.png[+]Warned'),
('user_img_14', 'admin.png[+]Staff'),
('user_img_15', 'sysop.png[+]SysOp'),
('user_img_16', 'sitefriend.png[+]Site Friend'),
('user_img_17', 'Genesisjunkie-1.png[+]Site Junkie'),
('secsui_quarantine_dir', ''),
('secsui_quarantine_search_terms', '<?php,base64_decode,base64_encode,eval(,phpinfo,fopen,fread,fwrite,file_get_contents'),
('secsui_cookie_name', ''),
('secsui_quarantine_pm', '2');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('secsui_pass_type', '1'),
('secsui_ss', ''),
('secsui_cookie_type', '1'),
('secsui_cookie_exp1', '1'),
('secsui_cookie_exp2', '3'),
('secsui_cookie_path', ''),
('secsui_cookie_domain', ''),
('secsui_cookie_items', '1-0,2-0,3-0,4-0,5-0,6-0,7-0,8-0[+]0'),
('secsui_pass_min_req', '4,0,0,0,0'),
('fmhack_direct_download', 'disabled'),
('fmhack_about_me', 'disabled'),
('fmhack_CBT_(Coolys_Backup_Tools)', 'disabled'),
('fmhack_multi_tracker_scrape', 'disabled'),
('fmhack_user_watch_list', 'disabled'),
('fmhack_partners_page', 'disabled'),
('fmhack_similar_torrents', 'disabled'),
('php_log_name', 'xbtit-errors'),
('php_log_path', '/full/path/to/the/web/root/include/logs'),
('php_log_lines', '5'),
('fmhack_force_ssl', 'disabled'),
('autorank_sendpm', 'no'),
('fmhack_addthis', 'disabled'),
('team_state', 'private'),
('fmhack_alternate_login', 'disabled'),
('loginpagetype', 'single'),
('fmhack_refresh_torrent_peers', 'disabled'),
('balloontype', '1,2,3'),
('fmhack_online_timeout', 'disabled'),
('online_timeout', '900'),
('price_hnr', '1000'),
('hnr_enable', 'false'),
('fmhack_search_all_sub-categories', 'disabled'),
('fmhack_show_or_hide_porn', 'disabled'),
('porncat', '12'),
('fmhack_private_profile', 'disabled'),
('fmhack_anonymous_links', 'disabled'),
('fmhack_language_in_torrent_list_and_details', 'disabled'),
('fmhack_torrent_details_media_player', 'disabled'),
('fmhack_signature_on_internal_forum', 'disabled'),
('shout_history_pp', '30'),
('fmhack_user_signup_agreement', 'disabled'),
('oa_one_text', 'line 1'),
('oa_two_text', 'line 2'),
('oa_three_text', 'line 3'),
('oa_four_text', 'line 4'),
('fmhack_total_online_time', 'disabled'),
('fmhack_last_download_block', 'disabled'),
('imgup_maxw', '100'),
('imgup_maxh', '100'),
('fmhack_VIP_freeleech', 'disabled');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('mod_app_sa', 'no'),
('fmhack_torrent_view_count', 'disabled'),
('imageflow_limit', '30'),
('imageflow_cats', ''),
('imageflow_priority', '1,2,3'),
('fmhack_split_torrents_by_date', 'disabled'),
('fmhack_social_network', 'disabled'),
('fmhack_bump_torrents', 'disabled'),
('fmhack_advanced_RSS_feed', 'disabled'),
('fmhack_archive_torrents', 'disabled'),
('archive_time', '7-2'),
('fmhack_ads_system', 'disabled'),
('ad_groups', '3'),
('fmhack_default_cat_browse', 'disabled'),
('fmhack_welcome_pm', 'disabled'),
('fmhack_logical_rank_ordering', 'disabled'),
('fmhack_freeleech_slots', 'disabled'),
('archive_enable', 'false'),
('bonus_archive', '1'),
('bonus_flslot', '9999'),
('flshot_enable', 'false'),
('fmhack_torrent_of_the_week', 'disabled'),
('tow_this_week', ''),
('tow_next_week', ''),
('fmhack_profile_torrent_sorting', 'disabled'),
('fmhack_comment_captcha', 'disabled'),
('comment_captcha_priv', ''),
('comment_captcha_pub', ''),
('fmhack_pM_notification_on_torrent_comment', 'disabled'),
('fmhack_no_columns_display', 'disabled'),
('fmhack_protected_usernames', 'disabled'),
('banned_usernames', ''),
('fmhack_multi_delete_torrents', 'disabled'),
('html_entities', 'disabled'),
('fmhack_poll_from_integrated_forum', 'disabled'),
('pollCat', '0'),
('fmhack_torrent_activity_colouring', 'disabled'),
('snatched_prefixcolor', ''),
('snatched_suffixcolor', ''),
('leeching_prefixcolor', ''),
('leeching_suffixcolor', ''),
('seeding_prefixcolor', ''),
('seeding_suffixcolor', ''),
('hide_down_img', 'no'),
('fmhack_grab_images_from_theTVDB', 'disabled'),
('tvdb_cats', ''),
('tvdb_img_min_rating', '6.66'),
('tvdb_image_min_voters', '5'),
('tvdb_awkward_titles', ''),
('tvdb_hide_imdb', 'no');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('fmhack_advanced_prune_users_and_torrents', 'disabled'),
('advprune_validate_max', '2'),
('advprune_firstwarn_max', '14'),
('advprune_firstwarn_msg', 'Hello {member},\n\nIt\'s been {warn1days} days since your last visit to {sitename} and we miss you.\n\nPlease come back soon.\n\nRegards\n{sitename}\n{siteurl}'),
('advprune_secondwarn_max', '21'),
('advprune_secondwarn_msg', 'Hello {member},\n\nIt\'s now been {warn2days} days since your last visit to {sitename}.\n\nUnfortunately, if you do not log in to {sitename} within the next {warn3days} days your account will be deleted. Please visit us soon to avoid this from happening.\n\nRegards\n{sitename}\n{siteurl}'),
('advprune_final_msg', 'Hello {member},\n\nUnfortunately it\'s now been {warnoverall} days since your last visit to {sitename}.\n\nAs you have been sent two previous emails and you failed to act I\'m afraid your account has now been deleted and this is the final email you will receive from us.\n\nRegards\n{sitename}\n{siteurl}'),
('advprune_del_after', '7'),
('advprune_exempt_ranks', '1,2,4,5,6,7,8'),
('advprunet_del_torrents', '30'),
('alt_news', 'disabled'),
('alt_rules', 'disabled'),
('alt_faq', 'disabled'),
('altrulestype', 'kcdon'),
('altfaqtype', 'kcdon'),
('altmode', 'new'),
('fmhack_previous_usernames', 'disabled'),
('reseed_minSeeds', '0'),
('reseed_minFinished', '2'),
('reseed_minLeechers', '1'),
('reseed_minTorrentAgeInDays', '1'),
('reseed_minDaysSinceLast', '5'),
('fmhack_download_requires_introduction', 'disabled'),
('ibd_forumid', '0'),
('ibd_topicid', '0'),
('fmhack_only_allow_specified_email_domains', 'disabled'),
('email_allowed', ''),
('nocol_exceptions', ''),
('fmhack_magnet_links', 'disabled'),
('fmhack_block_signup_from_certain_countries', 'disabled'),
('blocked_signup_countries', ''),
('fmhack_permissions_for_external_torrents', 'disabled'),
('fmhack_torrent_times', 'disabled'),
('fmhack_gallery', 'disabled'),
('gallery_grp', '7,9,3,6,8,10,4,5'),
('gallery_pth', 'gallery'),
('gallery_mfs', '1048576'),
('fmhack_custom_smileys', 'disabled'),
('CBT_FILE_BACKUP_DIR', 'backup/backup/'),
('donate_mode', 'classic'),
('birthday_bytes', 'GB'),
('fmhack_file_hosting', 'disabled'),
('fhost_file_limit', '52428800'),
('fhost_delete_days', '7'),
('fhost_level_upload', '3'),
('fhost_level_download', '3'),
('fhost_page_limit', '15'),
('fhost_upload', 'disabled'),
('fhost_title', 'Place Your Message Here'),
('fmhack_apply_for_membership', 'disabled'),
('apply_all', 'true'),
('apply_id', '8'),
('apply_rules_text', 'Place Your Apply for Membership Rules Here');

CREATE TABLE `{$db_prefix}shoutcastdj` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `activedays` char(30) NOT NULL DEFAULT '',
  `activetime` char(11) NOT NULL DEFAULT '',
  `genre` char(50) NOT NULL DEFAULT '',
  KEY `id` (`id`),
  KEY `active` (`active`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}signup_ip_block` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_ip` double NOT NULL DEFAULT '0',
  `last_ip` double NOT NULL DEFAULT '0',
  `added` int(10) unsigned NOT NULL DEFAULT '0',
  `addedby` varchar(50) NOT NULL DEFAULT '',
  `comment` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}sitemap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `nb` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  KEY `url` (`url`)
); -- TABLEOPT --

CREATE TABLE IF NOT EXISTS `{$db_prefix}smilies` (
  `key` varchar(200) NOT NULL,
  `value` text,
  PRIMARY KEY (`key`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}sticky` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#bce1ac;',
  `level` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}sticky` (`id`, `color`, `level`) VALUES
(1, '#bce1ac;', 3);

CREATE TABLE `{$db_prefix}style` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `style` varchar(20) NOT NULL DEFAULT '',
  `style_url` varchar(100) NOT NULL DEFAULT '',
  `style_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}style` (`id`, `style`, `style_url`, `style_type`) VALUES
(1, 'FM Default', 'style/xbtit_default', 3),
(2, 'Black Neon', 'style/Black_Neon', 3),
(3, 'Cherry Splash', 'style/Cherry_Splash', 3),
(4, 'Christmas 20XX', 'style/Christmas_20XX', 3),
(5, 'Rustic Moon', 'style/Rustic_Moon', 3),
(6, 'Splatter', 'style/Splatter', 3),
(7, 'SR-5', 'style/SR-5', 3),
(8, 'Valentine', 'style/Valentine', 3),
(9, 'XBTIT', 'style/Xbtit_Original', 3);

CREATE TABLE `{$db_prefix}style_bridge` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `xbtit_style` int(10) NOT NULL DEFAULT '0',
  `smf_style` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `xbtit_style` (`xbtit_style`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}subtitles` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(99) NOT NULL DEFAULT '',
  `file` varchar(99) NOT NULL DEFAULT '',
  `imdb` varchar(200) NOT NULL DEFAULT '',
  `pic` varchar(200) NOT NULL DEFAULT '',
  `Framerate` varchar(99) NOT NULL DEFAULT '',
  `cds` int(9) NOT NULL DEFAULT '0',
  `uploader` int(9) NOT NULL DEFAULT '0',
  `downloaded` int(9) NOT NULL DEFAULT '0',
  `author` varchar(99) DEFAULT NULL,
  `hash` varchar(40) NOT NULL DEFAULT '',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}tasks` (
  `task` varchar(20) NOT NULL DEFAULT '',
  `last_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}tasks` (`task`, `last_time`) VALUES
('sanity', UNIX_TIMESTAMP()),
('update', UNIX_TIMESTAMP()),
('radio', UNIX_TIMESTAMP()),
('rreg', UNIX_TIMESTAMP());

CREATE TABLE `{$db_prefix}teams` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `owner` int(10) NOT NULL DEFAULT '0',
  `info` text,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
); -- TABLEOPT --

-- For some reason it won't insert as id = 0 (Probably the auto increment)
-- so we add it as id = 1 and then change it afterwards

INSERT INTO `{$db_prefix}teams` (`id`, `added`, `owner`, `info`, `name`, `image`) VALUES
(1, '0000-00-00 00:00:00', 0, '', 'none', '');
UPDATE `{$db_prefix}teams` SET `id` = '0' WHERE `id` =1;
ALTER TABLE `{$db_prefix}teams` AUTO_INCREMENT =1;

CREATE TABLE `{$db_prefix}timestamps` (
  `info_hash` char(40) NOT NULL DEFAULT '',
  `sequence` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bytes` bigint(20) unsigned NOT NULL DEFAULT '0',
  `delta` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sequence`),
  KEY `sorting` (`info_hash`)
); -- TABLEOPT --

CREATE TABLE IF NOT EXISTS `{$db_prefix}tested` (
  `tested` datetime NOT NULL,
  `acct` varchar(40) NOT NULL,
  PRIMARY KEY (`tested`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}timezone` (
  `difference` varchar(4) NOT NULL DEFAULT '0',
  `timezone` text NOT NULL,
  PRIMARY KEY (`difference`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}timezone` (`difference`, `timezone`) VALUES
('-12', '(GMT - 12:00 hours) Enitwetok, Kwajalien'),
('-11', '(GMT - 11:00 hours) Midway Island, Samoa'),
('-10', '(GMT - 10:00 hours) Hawaii'),
('-9', '(GMT - 9:00 hours) Alaska'),
('-8', '(GMT - 8:00 hours) Pacific Time (US &amp; Canada)'),
('-7', '(GMT - 7:00 hours) Mountain Time (US &amp; Canada)'),
('-6', '(GMT - 6:00 hours) Central Time (US &amp; Canada), Mexico City'),
('-5', '(GMT - 5:00 hours) Eastern Time (US &amp; Canada), Bogota, Lima'),
('-4', '(GMT - 4:00 hours) Atlantic Time (Canada), Caracas, La Paz'),
('-3.5', '(GMT - 3:30 hours) Newfoundland'),
('-3', '(GMT - 3:00 hours) Brazil, Buenos Aires, Falkland Is.'),
('-2', '(GMT - 2:00 hours) Mid-Atlantic, Ascention Is., St Helena'),
('-1', '(GMT - 1:00 hours) Azores, Cape Verde Islands'),
('0', '(GMT) Casablanca, Dublin, London, Lisbon, Monrovia'),
('1', '(GMT + 1:00 hours) Amsterdam, Brussels, Copenhagen, Madrid, Paris'),
('2', '(GMT + 2:00 hours) Kaliningrad, South Africa'),
('3', '(GMT + 3:00 hours) Baghdad, Riyadh, Moscow, Nairobi'),
('3.5', '(GMT + 3:30 hours) Tehran'),
('4', '(GMT + 4:00 hours) Abu Dhabi, Baku, Muscat, Tbilisi'),
('4.5', '(GMT + 4:30 hours) Kabul'),
('5', '(GMT + 5:00 hours) Ekaterinburg, Karachi, Tashkent'),
('5.5', '(GMT + 5:30 hours) Bombay, Calcutta, Madras, New Delhi'),
('6', '(GMT + 6:00 hours) Almaty, Colomba, Dhaka'),
('7', '(GMT + 7:00 hours) Bangkok, Hanoi, Jakarta'),
('8', '(GMT + 8:00 hours) Hong Kong, Perth, Singapore, Taipei'),
('9', '(GMT + 9:00 hours) Osaka, Sapporo, Seoul, Tokyo, Yakutsk'),
('9.5', '(GMT + 9:30 hours) Adelaide, Darwin'),
('10', '(GMT + 10:00 hours) Melbourne, Papua New Guinea, Sydney'),
('11', '(GMT + 11:00 hours) Magadan, New Caledonia, Solomon Is.'),
('12', '(GMT + 12:00 hours) Auckland, Fiji, Marshall Island');

CREATE TABLE `{$db_prefix}topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(40) DEFAULT NULL,
  `locked` enum('yes','no') NOT NULL DEFAULT 'no',
  `forumid` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('yes','no') NOT NULL DEFAULT 'no',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `subject` (`subject`),
  KEY `lastpost` (`lastpost`)
); -- TABLEOPT --


CREATE TABLE `{$db_prefix}users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(20) NOT NULL,
  `pass_type` enum('1','2','3','4','5','6','7') NOT NULL DEFAULT '1',
  `dupe_hash` varchar(20) NOT NULL,
  `id_level` int(10) NOT NULL DEFAULT '1',
  `random` int(10) DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `language` tinyint(4) NOT NULL DEFAULT '1',
  `style` tinyint(4) NOT NULL DEFAULT '1',
  `joined` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastconnect` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lip` bigint(11) DEFAULT '0',
  `downloaded` bigint(20) DEFAULT '0',
  `uploaded` bigint(20) DEFAULT '0',
  `avatar` varchar(200) DEFAULT NULL,
  `pid` varchar(32) NOT NULL DEFAULT '',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topicsperpage` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `postsperpage` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `torrentsperpage` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `cip` varchar(15) DEFAULT NULL,
  `time_offset` varchar(4) NOT NULL DEFAULT '0',
  `temp_email` varchar(50) NOT NULL DEFAULT '',
  `smf_fid` int(10) NOT NULL DEFAULT '0',
  `invitations` int(10) NOT NULL DEFAULT '0',
  `invited_by` int(10) NOT NULL DEFAULT '0',
  `invitedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `custom_title` varchar(50) DEFAULT NULL,
  `seedbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `smf_postcount` int(11) NOT NULL DEFAULT '0',
  `donor` enum('yes','no') NOT NULL DEFAULT 'no',
  `rank_switch` enum('yes','no') NOT NULL DEFAULT 'no',
  `old_rank` varchar(12) NOT NULL DEFAULT '3',
  `timed_rank` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warn` enum('yes','no') NOT NULL DEFAULT 'no',
  `warnreason` varchar(255) NOT NULL,
  `warnadded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warns` bigint(20) DEFAULT '0',
  `warnaddedby` varchar(255) NOT NULL,
  `booted` enum('yes','no') NOT NULL DEFAULT 'no',
  `whybooted` varchar(255) NOT NULL,
  `addbooted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `whobooted` varchar(255) NOT NULL,
  `sbox` enum('yes','no') NOT NULL DEFAULT 'no',
  `dlrandom` varchar(8) DEFAULT '0',
  `custom_torr_limit` enum('yes','no') NOT NULL DEFAULT 'no',
  `php_cust_torr_limit` int(11) NOT NULL DEFAULT '0',
  `custom_wait_time` enum('yes','no') NOT NULL DEFAULT 'no',
  `php_cust_wait_time` int(11) NOT NULL DEFAULT '0',
  `ban` enum('yes','no') NOT NULL DEFAULT 'no',
  `ban_added` varchar(50) NOT NULL,
  `ban_added_by` varchar(50) NOT NULL,
  `ban_comment` varchar(255) NOT NULL,
  `up_med` int(11) NOT NULL DEFAULT '0',
  `team` int(10) unsigned NOT NULL DEFAULT '0',
  `pchat` varchar(40) NOT NULL,
  `block_comment` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_parked` enum('yes','no') NOT NULL DEFAULT 'no',
  `warn_lev` int(11) NOT NULL DEFAULT '0',
  `warn_last` int(11) NOT NULL DEFAULT '0',
  `hnr_count` int(11) NOT NULL DEFAULT '0',
  `rat_warn_level` varchar(10) NOT NULL DEFAULT '0',
  `rat_warn_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bandt` enum('yes','no') NOT NULL DEFAULT 'no',
  `invisible` enum('yes','no') NOT NULL DEFAULT 'no',
  `allowdownload` enum('yes','no') NOT NULL DEFAULT 'yes',
  `allowupload` enum('yes','no') NOT NULL DEFAULT 'yes',
  `proxy` enum('yes','no') NOT NULL DEFAULT 'no',
  `ipb_fid` int(11) NOT NULL DEFAULT '0',
  `ipb_postcount` int(11) NOT NULL DEFAULT '0',
  `dob` date NOT NULL,
  `birthday_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `pmbanned` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_notes` text NOT NULL,
  `sig` text NOT NULL,
  `syncsig` enum('true','false') NOT NULL DEFAULT 'false',
  `syncav` enum('true','false') NOT NULL DEFAULT 'false',
  `country_name` varchar(25) NOT NULL DEFAULT 'unknown',
  `country_flag` varchar(25) NOT NULL DEFAULT 'unknown',
  `avatar_upload` enum('yes','no') NOT NULL DEFAULT 'no',
  `avatar_upload_name` varchar(60) NOT NULL DEFAULT '',
  `viewed_faq` tinyint(1) NOT NULL DEFAULT '0',
  `user_images` varchar(50) NOT NULL,
  `about_me` text NOT NULL,
  `IS_WATCHED` enum('yes','no') NOT NULL DEFAULT 'no',
  `force_ssl` enum('yes','no') NOT NULL DEFAULT 'no',
  `showporn` enum('yes','no') NOT NULL DEFAULT 'no',
  `profileview` int(9) NOT NULL DEFAULT '0',
  `signature` text NOT NULL,
  `tot_on` INT(10) NOT NULL DEFAULT '0',
  `custom_rss` text NOT NULL,
  `vipfl_down` bigint(20) unsigned NOT NULL DEFAULT '0',
  `vipfl_date` int(10) unsigned NOT NULL DEFAULT '0',
  `catins` text NOT NULL,
  `freeleech_slots` int(10) unsigned NOT NULL DEFAULT '0',
  `freeleech_slot_hashes` text NOT NULL,
  `commentpm` enum('true','false') NOT NULL DEFAULT 'true',
  `prune_last_warn` int(11) unsigned NOT NULL DEFAULT '0',
  `prune_level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `previous_names` text NOT NULL,
  `made_intro` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `announce_read` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_level` (`id_level`),
  KEY `pid` (`pid`),
  KEY `cip` (`cip`),
  KEY `smf_fid` (`smf_fid`),
  KEY `ipb_fid` (`ipb_fid`),
  KEY `avatar_upload` (`avatar_upload`)
); -- TABLEOPT --


INSERT INTO `{$db_prefix}users` (`id`, `username`, `password`, `salt`, `pass_type`, `dupe_hash`, `id_level`, `random`, `email`, `language`, `style`, `joined`, `lastconnect`, `lip`, `downloaded`, `uploaded`, `avatar`, `pid`, `flag`, `topicsperpage`, `postsperpage`, `torrentsperpage`, `cip`, `time_offset`, `temp_email`, `smf_fid`, `invitations`, `invited_by`, `invitedate`, `custom_title`, `seedbonus`, `smf_postcount`, `donor`, `rank_switch`, `old_rank`, `timed_rank`, `warn`, `warnreason`, `warnadded`, `warns`, `warnaddedby`, `booted`, `whybooted`, `addbooted`, `whobooted`, `sbox`, `dlrandom`, `custom_torr_limit`, `php_cust_torr_limit`, `custom_wait_time`, `php_cust_wait_time`, `ban`, `ban_added`, `ban_added_by`, `ban_comment`, `up_med`, `team`, `pchat`, `block_comment`, `is_parked`, `warn_lev`, `warn_last`, `hnr_count`, `rat_warn_level`, `rat_warn_time`, `bandt`, `invisible`, `allowdownload`, `allowupload`, `proxy`, `ipb_fid`, `ipb_postcount`, `dob`, `birthday_bonus`, `pmbanned`, `user_notes`, `sig`, `syncsig`, `syncav`, `country_name`, `country_flag`, `avatar_upload`, `avatar_upload_name`, `viewed_faq`, `user_images`, `about_me`, `IS_WATCHED`, `force_ssl`, `showporn`, `profileview`, `signature`, `tot_on`, `custom_rss`, `vipfl_down`, `vipfl_date`, `catins`, `freeleech_slots`, `freeleech_slot_hashes`, `commentpm`, `prune_last_warn`, `prune_level`, `previous_names`, `made_intro`, `announce_read`) VALUES
(1, 'Guest', '', '', '1', '', 1, 0, 'none', 1, 20, '2014-02-19 05:44:31', '2014-02-19 05:44:31', 0, 0, 0, NULL, '00000000000000000000000000000000', 0, 10, 10, 15, '127.0.0.2', '0', '', 0, 0, 0, '0000-00-00 00:00:00', NULL, '0.000000', 0, 'no', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '', 'no', '0', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'no', 'no', 'no', 0, 0, '0000-00-00', 0, 'no', '', '', 'false', 'false', 'unknown', 'unknown', 'no', '', 0, '', '', 'no', 'no', 'no', 0, '', 0, '', 0, 0, '', 0, '', 'false', 0, 0, '', 0, 'no');

CREATE TABLE `{$db_prefix}users_level` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL DEFAULT '0',
  `level` varchar(50) NOT NULL DEFAULT '',
  `view_torrents` enum('yes','no') NOT NULL DEFAULT 'yes',
  `edit_torrents` enum('yes','no') NOT NULL DEFAULT 'no',
  `delete_torrents` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_users` enum('yes','no') NOT NULL DEFAULT 'yes',
  `edit_users` enum('yes','no') NOT NULL DEFAULT 'no',
  `delete_users` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_news` enum('yes','no') NOT NULL DEFAULT 'yes',
  `edit_news` enum('yes','no') NOT NULL DEFAULT 'no',
  `delete_news` enum('yes','no') NOT NULL DEFAULT 'no',
  `can_upload` enum('yes','no') NOT NULL DEFAULT 'no',
  `can_download` enum('yes','no') NOT NULL DEFAULT 'yes',
  `view_forum` enum('yes','no') NOT NULL DEFAULT 'yes',
  `edit_forum` enum('yes','no') NOT NULL DEFAULT 'yes',
  `delete_forum` enum('yes','no') NOT NULL DEFAULT 'no',
  `predef_level` enum('guest','validating','member','uploader','vip','moderator','admin','owner') NOT NULL DEFAULT 'guest',
  `can_be_deleted` enum('yes','no') NOT NULL DEFAULT 'yes',
  `admin_access` enum('yes','no') NOT NULL DEFAULT 'no',
  `prefixcolor` varchar(200) NOT NULL DEFAULT '',
  `suffixcolor` varchar(200) NOT NULL DEFAULT '',
  `WT` int(11) NOT NULL DEFAULT '0',
  `autorank_state` enum('Enabled','Disabled') NOT NULL DEFAULT 'Disabled',
  `autorank_position` smallint(3) NOT NULL DEFAULT '0',
  `autorank_min_upload` bigint(20) NOT NULL DEFAULT '0',
  `autorank_minratio` decimal(5,2) NOT NULL DEFAULT '0.00',
  `smf_group_mirror` int(11) NOT NULL DEFAULT '0',
  `ipb_group_mirror` int(11) NOT NULL DEFAULT '0',
  `bypass_dlcheck` tinyint(1) NOT NULL DEFAULT '0',
  `torrents_limit` int(11) NOT NULL DEFAULT '0',
  `trusted` enum('yes','no') NOT NULL DEFAULT 'no',
  `moderate_trusted` enum('yes','no') NOT NULL DEFAULT 'no',
  `sel_team` int(11) NOT NULL DEFAULT '0',
  `all_teams` enum('yes','no') NOT NULL DEFAULT 'no',
  `delete_comments` enum('yes','no') NOT NULL DEFAULT 'no',
  `edit_comments` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_comments` enum('yes','no') NOT NULL DEFAULT 'no',
  `delete_shout` enum('yes','no') NOT NULL DEFAULT 'no',
  `edit_shout` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_shout` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_peers` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_history` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_userdetails_torrents` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_nfo` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_reencode` enum('yes','no') NOT NULL DEFAULT 'no',
  `add_request` enum('yes','no') NOT NULL DEFAULT 'no',
  `add_ddl` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_ddl` enum('yes','no') NOT NULL DEFAULT 'no',
  `freeleech` enum('yes','no') NOT NULL DEFAULT 'no',
  `can_hide` enum('yes','no') NOT NULL DEFAULT 'no',
  `see_hidden` enum('yes','no') NOT NULL DEFAULT 'no',
  `bump_torrents` enum('yes','no') NOT NULL DEFAULT 'no',
  `set_multi` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_multi` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_new` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `up_new` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `down_new` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `view_arc` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `up_arc` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `down_arc` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `logical_rank_order` int(10) NOT NULL DEFAULT '0',
  `can_boot` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `down_req_intro` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `external_upload` enum('yes', 'no') NOT NULL DEFAULT 'no',
  `external_refresh` enum('yes', 'no') NOT NULL DEFAULT 'no',
  UNIQUE KEY `base` (`id`),
  KEY `id_level` (`id_level`),
  KEY `smf_group_mirror` (`smf_group_mirror`),
  KEY `ipb_group_mirror` (`ipb_group_mirror`)
); -- TABLEOPT --

INSERT INTO `{$db_prefix}users_level` (`id`, `id_level`, `level`, `view_torrents`, `edit_torrents`, `delete_torrents`, `view_users`, `edit_users`, `delete_users`, `view_news`, `edit_news`, `delete_news`, `can_upload`, `can_download`, `view_forum`, `edit_forum`, `delete_forum`, `predef_level`, `can_be_deleted`, `admin_access`, `prefixcolor`, `suffixcolor`, `WT`, `autorank_state`, `autorank_position`, `autorank_min_upload`, `autorank_minratio`, `smf_group_mirror`, `ipb_group_mirror`, `bypass_dlcheck`, `torrents_limit`, `trusted`, `moderate_trusted`, `sel_team`, `all_teams`, `delete_comments`, `edit_comments`, `view_comments`, `delete_shout`, `edit_shout`, `view_shout`, `view_peers`, `view_history`, `view_userdetails_torrents`, `view_nfo`, `view_reencode`, `add_request`, `add_ddl`, `view_ddl`, `freeleech`, `can_hide`, `see_hidden`, `bump_torrents`, `set_multi`, `view_multi`, `view_new`, `up_new`, `down_new`, `view_arc`, `up_arc`, `down_arc`, `logical_rank_order`, `can_boot`, `down_req_intro`, `external_upload`, `external_refresh`) VALUES
(1, 1, 'guest', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'guest', 'no', 'no', '', '', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 1, 'no', 'no', 'no', 'no'),
(2, 2, 'validating', 'yes', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'validating', 'no', 'no', '', '', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 2, 'no', 'no', 'no', 'no'),
(3, 3, 'Members', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'no', 'no', 'member', 'no', 'no', '<span style=\'color:#000000\'>', '</span>', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 3, 'no', 'no', 'no', 'no'),
(4, 4, 'Uploader', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'uploader', 'no', 'no', '', '', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 4, 'no', 'no', 'no', 'no'),
(5, 5, 'V.I.P.', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'vip', 'no', 'no', '', '', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 5, 'no', 'no', 'no', 'no'),
(6, 6, 'Moderator', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'no', 'moderator', 'no', 'no', '<span style=\'color: #428D67\'>', '</span>', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 6, 'no', 'no', 'no', 'no'),
(7, 7, 'Administrator', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'admin', 'no', 'yes', '<span style=\'color:#FF8000\'>', '</span>', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 7, 'no', 'no', 'no', 'no'),
(8, 8, 'Owner', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'owner', 'no', 'yes', '<span style=\'color:#EE4000\'>', '</span>', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 8, 'no', 'no', 'no', 'no');

CREATE TABLE `{$db_prefix}warn_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `contact` enum('none','pm') NOT NULL DEFAULT 'none',
  `date_added` int(10) NOT NULL DEFAULT '0',
  `type` enum('inc','dec') NOT NULL DEFAULT 'inc',
  `added_by` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}warn_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '12',
  PRIMARY KEY (`id`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}watched_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL,
  `username` varchar(40) NOT NULL DEFAULT '',
  `cip` varchar(15) DEFAULT NULL,
  `location` text,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cip` (`cip`)
); -- TABLEOPT --

CREATE TABLE `{$db_prefix}wishlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `torrent_id` varchar(40) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_announce_log`;
CREATE TABLE `xbt_announce_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipa` int(10) unsigned NOT NULL,
  `port` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `info_hash` binary(20) NOT NULL,
  `peer_id` binary(20) NOT NULL,
  `downloaded` bigint(20) unsigned NOT NULL,
  `left0` bigint(20) unsigned NOT NULL,
  `uploaded` bigint(20) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_config`;
CREATE TABLE `xbt_config` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_deny_from_clients`;
CREATE TABLE `xbt_deny_from_clients` (
  `peer_id` char(20) NOT NULL
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_deny_from_hosts`;
CREATE TABLE `xbt_deny_from_hosts` (
  `begin` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_files`;
CREATE TABLE `xbt_files` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `info_hash` binary(20) NOT NULL,
  `leechers` int(11) NOT NULL DEFAULT '0',
  `seeders` int(11) NOT NULL DEFAULT '0',
  `completed` int(11) NOT NULL DEFAULT '0',
  `flags` int(11) NOT NULL DEFAULT '0',
  `mtime` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `down_multi` int(11) DEFAULT '100',
  `up_multi` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`fid`),
  UNIQUE KEY `info_hash` (`info_hash`)
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_files_users`;
CREATE TABLE `xbt_files_users` (
  `fid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `announced` int(11) NOT NULL,
  `completed` int(11) NOT NULL,
  `downloaded` bigint(20) unsigned NOT NULL,
  `left` bigint(20) unsigned NOT NULL,
  `uploaded` bigint(20) unsigned NOT NULL,
  `mtime` int(11) NOT NULL,
  `completed_time` int(11) NOT NULL,
  `down_rate` bigint(20) unsigned NOT NULL DEFAULT '0',
  `up_rate` bigint(20) unsigned NOT NULL DEFAULT '0',
  `peer_id` binary(20) NOT NULL,
  `ipa` int(10) unsigned NOT NULL,
  `port` int(11) NOT NULL,
  `seeding_time` int(11) NOT NULL DEFAULT '0',
  `hit` enum('no','yes') NOT NULL DEFAULT 'no',
  `hitchecked` int(11) NOT NULL DEFAULT '0',
  `punishment_amount` int(11) NOT NULL DEFAULT '0',
  `started_time` int(11) NOT NULL DEFAULT '-1',
  UNIQUE KEY `fid` (`fid`,`uid`),
  KEY `uid` (`uid`)
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_scrape_log`;
CREATE TABLE `xbt_scrape_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipa` int(10) unsigned NOT NULL,
  `info_hash` binary(20) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
); -- TABLEOPT --

DROP TABLE IF EXISTS `xbt_users`;
CREATE TABLE `xbt_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `torrent_pass_version` int(11) NOT NULL DEFAULT '0',
  `downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `torrent_pass` char(32) NOT NULL,
  `torrent_pass_secret` bigint(20) unsigned NOT NULL,
  `can_announce` tinyint(4) NOT NULL DEFAULT '1',
  `can_leech` tinyint(4) NOT NULL DEFAULT '1',
  `wait_time` int(11) NOT NULL DEFAULT '0',
  `peers_limit` int(11) NOT NULL DEFAULT '0',
  `torrents_limit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
); -- TABLEOPT --

