
-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_bans`
--

CREATE TABLE `ajax_chat_bans` (
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_custom`
--

CREATE TABLE `ajax_chat_custom` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `value` text,
  `user` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_invitations`
--

CREATE TABLE `ajax_chat_invitations` (
  `userID` int(11) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_messages`
--

CREATE TABLE `ajax_chat_messages` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `userRole` int(1) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `text` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_online`
--

CREATE TABLE `ajax_chat_online` (
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `userRole` int(1) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_trivia`
--

CREATE TABLE `ajax_chat_trivia` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ajax_chat_usercustom`
--

CREATE TABLE `ajax_chat_usercustom` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `value` text,
  `type` varchar(32) DEFAULT NULL,
  `class` int(11) DEFAULT '0',
  `locked` int(11) DEFAULT '0',
  `lastuser` int(11) DEFAULT '0',
  `user` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `casino`
--

CREATE TABLE `casino` (
  `userid` int(10) NOT NULL DEFAULT '0',
  `win` bigint(20) DEFAULT NULL,
  `lost` bigint(20) DEFAULT NULL,
  `trys` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enableplay` enum('yes','no') NOT NULL DEFAULT 'yes',
  `deposit` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `casino_bets`
--

CREATE TABLE `casino_bets` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) NOT NULL DEFAULT '0',
  `proposed` varchar(40) NOT NULL DEFAULT '',
  `challenged` varchar(40) NOT NULL DEFAULT '',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}addedexpected`
--

CREATE TABLE `{$db_prefix}addedexpected` (
  `id` int(10) UNSIGNED NOT NULL,
  `expectid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}addedexpectedmin`
--

CREATE TABLE `{$db_prefix}addedexpectedmin` (
  `id` int(10) UNSIGNED NOT NULL,
  `expectid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}adminpanel`
--

CREATE TABLE `{$db_prefix}adminpanel` (
  `id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL,
  `id_level` int(11) NOT NULL,
  `access` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}adminpanel`
--

INSERT INTO `{$db_prefix}adminpanel` (`id`, `section`, `description`, `link`, `id_level`, `access`) VALUES
(1, 'config', 'ACP_TRACKER_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=config&action=read', 7, 0),
(2, 'banip', 'ACP_BAN_IP', 'index.php?page=admin&user={uid}&code={ucode}&do=banip&action=read', 7, 1),
(3, 'language', 'ACP_LANGUAGES', 'index.php?page=admin&user={uid}&code={ucode}&do=language&action=read', 7, 0),
(4, 'style', 'ACP_STYLES', 'index.php?page=admin&user={uid}&code={ucode}&do=style&action=read', 7, 0),
(5, 'category', 'ACP_CATEGORIES', 'index.php?page=admin&user={uid}&code={ucode}&do=category&action=read', 7, 1),
(7, 'badwords', 'ACP_CENSORED', 'index.php?page=admin&user={uid}&code={ucode}&do=badwords&action=read', 7, 1),
(8, 'blocks', 'ACP_BLOCKS', 'index.php?page=admin&user={uid}&code={ucode}&do=blocks&action=read', 7, 0),
(9, 'masspm', 'ACP_MASSPM', 'index.php?page=admin&user={uid}&code={ucode}&do=masspm&action=read', 7, 1),
(10, 'pruneu', 'ACP_PRUNE_USERS', 'index.php?page=admin&user={uid}&code={ucode}&do=pruneu', 7, 1),
(11, 'searchdiff', 'ACP_SEARCH_DIFF', 'index.php?page=admin&user={uid}&code={ucode}&do=searchdiff', 7, 1),
(12, 'prunet', 'ACP_PRUNE_TORRENTS', 'index.php?page=admin&user={uid}&code={ucode}&do=prunet', 7, 1),
(13, 'forum', 'ACP_FORUM', 'index.php?page=admin&user={uid}&code={ucode}&do=forum&action=read', 7, 1),
(14, 'mysql_stats', 'ACP_MYSQL_STATS', 'index.php?page=admin&user={uid}&code={ucode}&do=mysql_stats', 7, 0),
(15, 'logview', 'ACP_SITE_LOG', 'index.php?page=admin&user={uid}&code={ucode}&do=logview', 7, 1),
(19, 'logview', 'ACP_SITE_LOG', 'index.php?page=admin&user={uid}&code={ucode}&do=logview', 6, 1),
(20, 'watched_users', 'Watched Users', 'index.php?page=admin&user={uid}&code={ucode}&do=watched_users', 6, 1),
(21, 'warned_users', 'Warned Users', 'index.php?page=admin&user={uid}&code={ucode}&do=warned_users', 6, 1),
(22, 'badwords', 'ACP_CENSORED', 'index.php?page=admin&user={uid}&code={ucode}&do=badwords&action=read', 6, 1),
(23, 'banip', 'ACP_BAN_IP', 'index.php?page=admin&user={uid}&code={ucode}&do=banip&action=read', 6, 1),
(24, 'banbutton_user', 'ACP_BB_USER', 'index.php?page=admin&user={uid}&code={ucode}&do=banbutton_user&action=read', 6, 1),
(25, 'banbutton', 'ACP_BB', 'index.php?page=admin&user={uid}&code={ucode}&do=banbutton&action=read', 6, 1),
(26, 'booted_users', 'ACP_BOOTED', 'index.php?page=admin&user={uid}&code={ucode}&do=booted_users', 6, 1),
(27, 'duplicates', 'DUPLICATES', 'index.php?page=admin&user={uid}&code={ucode}&do=duplicates', 6, 1),
(28, 'gifts', 'ACP_GIFTS', 'index.php?page=admin&user={uid}&code={ucode}&do=gifts', 6, 1),
(29, 'invitations', 'ACP_INVITATIONS', 'index.php?page=admin&user={uid}&code={ucode}&do=invitations', 6, 1),
(30, 'lottery_settings', 'ACP_LOTTERY', 'index.php?page=admin&user={uid}&code={ucode}&do=lottery_settings', 6, 1),
(34, 'masspm', 'ACP_MASSPM', 'index.php?page=admin&user={uid}&code={ucode}&do=masspm&action=write', 6, 1),
(35, 'poller', 'ACP_POLLS', 'index.php?page=admin&user={uid}&code={ucode}&do=poller&action=read', 6, 1),
(36, 'banbutton', 'ACP_BB', 'index.php?page=admin&user={uid}&code={ucode}&do=banbutton&action=read', 7, 1),
(37, 'banbutton_user', 'ACP_BB_USER', 'index.php?page=admin&user={uid}&code={ucode}&do=banbutton_user&action=read', 7, 1),
(38, 'ban_button', 'BB_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=ban_button', 7, 1),
(39, 'booted_users', 'ACP_BOOTED', 'index.php?page=admin&user={uid}&code={ucode}&do=booted_users', 7, 1),
(40, 'duplicates', 'DUPLICATES', 'index.php?page=admin&user={uid}&code={ucode}&do=duplicates', 7, 1),
(41, 'gifts', 'ACP_GIFTS', 'index.php?page=admin&user={uid}&code={ucode}&do=gifts', 7, 1),
(42, 'poller', 'ACP_POLLS', 'index.php?page=admin&user={uid}&code={ucode}&do=poller&action=read', 7, 1),
(45, 'warned_users', 'Warned Users', 'index.php?page=admin&user={uid}&code={ucode}&do=warned_users', 7, 1),
(46, 'watched_users', 'Watched Users', 'index.php?page=admin&user={uid}&code={ucode}&do=watched_users', 7, 1),
(47, 'lottery_settings', 'ACP_LOTTERY', 'index.php?page=admin&user={uid}&code={ucode}&do=lottery_settings', 7, 1),
(48, 'birthday', 'ACP_BIRTHDAY', 'index.php?page=admin&user={uid}&code={ucode}&do=birthday', 7, 1),
(49, 'faq_group', 'ACP_FAQ_GROUP', 'index.php?page=admin&user={uid}&code={ucode}&do=faq_group', 7, 1),
(50, 'faq_question', 'ACP_FAQ_QUESTION', 'index.php?page=admin&user={uid}&code={ucode}&do=faq_question', 7, 1),
(51, 'free', 'ACP_FREECTRL', 'index.php?page=admin&user={uid}&code={ucode}&do=free', 7, 1),
(52, 'fls', 'FLS_ACP_ADMIN', 'index.php?page=admin&user={uid}&code={ucode}&do=fls', 7, 1),
(53, 'gallery', 'GALLERY_SET', 'index.php?page=admin&user={uid}&code={ucode}&do=gallery', 7, 1),
(54, 'invitations', 'ACP_INVITATIONS', 'index.php?page=admin&user={uid}&code={ucode}&do=invitations', 7, 1),
(55, 'lrb', 'ACP_LRB', 'index.php?page=admin&user={uid}&code={ucode}&do=lrb', 7, 0),
(56, 'ratio-editor', 'ACP_RATIO_EDITOR', 'index.php?page=admin&user={uid}&code={ucode}&do=ratio-editor', 7, 1),
(57, 'rules', 'ACP_RULES', 'index.php?page=admin&user={uid}&code={ucode}&do=rules', 7, 1),
(58, 'rules_cat', 'Rules groups', 'index.php?page=admin&user={uid}&code={ucode}&do=rules_cat', 7, 1),
(59, 'smilies', 'SMILE_MENU', 'index.php?page=admin&user={uid}&code={ucode}&do=smilies', 7, 1),
(60, 'smilies', 'SMILE_MENU', 'index.php?page=admin&user={uid}&code={ucode}&do=smilies', 6, 1),
(61, 'sport_bet', 'SB_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=sport_bet', 6, 0),
(62, 'sport_bet', 'SB_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=sport_bet', 7, 1),
(63, 'warn', 'ACP_ADD_WARN', 'index.php?page=admin&user={uid}&code={ucode}&do=warn', 7, 1),
(64, 'warn', 'ACP_ADD_WARN', 'index.php?page=admin&user={uid}&code={ucode}&do=warn', 6, 1),
(65, 'tow', 'ACP_TOW_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=tow', 6, 1),
(66, 'tow', 'ACP_TOW_SETTINGS', 'index.php?page=admin&user={uid}&code={ucode}&do=tow', 7, 1),
(67, 'uploader_control', 'UP_CONTROL', 'index.php?page=admin&user={uid}&code={ucode}&do=uploader_control', 6, 1),
(68, 'uploader_control', 'UP_CONTROL', 'index.php?page=admin&user={uid}&code={ucode}&do=uploader_control', 7, 1),
(69, 'user_images', 'ACP_UIMG_SET', 'index.php?page=admin&user={uid}&code={ucode}&do=user_images', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}ads`
--

CREATE TABLE `{$db_prefix}ads` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}ads`
--

INSERT INTO `{$db_prefix}ads` (`key`, `value`) VALUES
('above_comments', ''),
('above_comments_enabled', 'disabled'),
('footer', ''),
('footer_enabled', 'disabled'),
('header', ''),
('header_enabled', 'enabled'),
('left_bottom', ''),
('left_bottom_enabled', 'disabled'),
('left_top', ''),
('left_top_enabled', 'disabled'),
('right_bottom', ''),
('right_bottom_enabled', 'disabled'),
('right_top', ''),
('right_top_enabled', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}ajax_ratings`
--

CREATE TABLE `{$db_prefix}ajax_ratings` (
  `id` varchar(40) NOT NULL,
  `total_votes` int(11) NOT NULL,
  `total_value` int(11) NOT NULL,
  `used_ips` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}allowedclient`
--

CREATE TABLE `{$db_prefix}allowedclient` (
  `id` int(10) NOT NULL,
  `peer_id` varchar(16) NOT NULL,
  `peer_id_ascii` varchar(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}announcement`
--

CREATE TABLE `{$db_prefix}announcement` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `body` text NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}announcements`
--

CREATE TABLE `{$db_prefix}announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(64) NOT NULL,
  `message` text NOT NULL,
  `by` varchar(16) NOT NULL DEFAULT 'Admin',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `minclassread` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}anti_hit_run`
--

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
  `days3` int(11) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}anti_hit_run_tasks`
--

CREATE TABLE `{$db_prefix}anti_hit_run_tasks` (
  `task` varchar(20) NOT NULL DEFAULT '',
  `last_time` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}avps`
--

CREATE TABLE `{$db_prefix}avps` (
  `arg` varchar(32) NOT NULL,
  `value_s` varchar(32) NOT NULL,
  `value_i` varchar(32) NOT NULL,
  `value_u` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bannedclient`
--

CREATE TABLE `{$db_prefix}bannedclient` (
  `id` int(10) NOT NULL,
  `peer_id` varchar(16) NOT NULL,
  `peer_id_ascii` varchar(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bannedip`
--

CREATE TABLE `{$db_prefix}bannedip` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` int(11) NOT NULL DEFAULT '0',
  `addedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `first` bigint(11) UNSIGNED DEFAULT NULL,
  `last` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}baseline`
--

CREATE TABLE `{$db_prefix}baseline` (
  `file_path` varchar(200) NOT NULL,
  `file_hash` char(40) NOT NULL,
  `acct` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}betgames`
--

CREATE TABLE `{$db_prefix}betgames` (
  `id` int(11) NOT NULL,
  `heading` varchar(50) NOT NULL DEFAULT '',
  `undertext` varchar(150) NOT NULL DEFAULT '',
  `endtime` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `sort` int(1) NOT NULL DEFAULT '0',
  `creator` varchar(20) NOT NULL,
  `fix` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}betlog`
--

CREATE TABLE `{$db_prefix}betlog` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  `bonus` int(11) NOT NULL DEFAULT '0',
  `msg` varchar(150) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}betoptions`
--

CREATE TABLE `{$db_prefix}betoptions` (
  `id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `text` varchar(100) NOT NULL DEFAULT '',
  `odds` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bets`
--

CREATE TABLE `{$db_prefix}bets` (
  `id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bettop`
--

CREATE TABLE `{$db_prefix}bettop` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bitcoin_invoices`
--

CREATE TABLE `{$db_prefix}bitcoin_invoices` (
  `invoice_id` int(10) UNSIGNED NOT NULL,
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
  `state` enum('pending','completed') NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}blackjack`
--

CREATE TABLE `{$db_prefix}blackjack` (
  `gameid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) NOT NULL,
  `dealerhand` varchar(100) NOT NULL,
  `playerhand` varchar(100) NOT NULL,
  `remaining_cards` text NOT NULL,
  `playerbust` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}blacklist`
--

CREATE TABLE `{$db_prefix}blacklist` (
  `id` int(11) UNSIGNED NOT NULL,
  `tip` int(11) UNSIGNED DEFAULT NULL,
  `added` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}blocks`
--

CREATE TABLE `{$db_prefix}blocks` (
  `blockid` int(11) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL DEFAULT '',
  `position` char(1) NOT NULL DEFAULT '',
  `sortid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `cache` enum('yes','no') NOT NULL DEFAULT 'no',
  `minclassview` int(11) NOT NULL DEFAULT '0',
  `maxclassview` int(11) NOT NULL DEFAULT '8',
  `use_lro` enum('yes','no') NOT NULL DEFAULT 'no',
  `lro_minclassview` int(11) NOT NULL DEFAULT '0',
  `lro_maxclassview` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}blocks`
--

INSERT INTO `{$db_prefix}blocks` (`blockid`, `content`, `position`, `sortid`, `status`, `title`, `cache`, `minclassview`, `maxclassview`, `use_lro`, `lro_minclassview`, `lro_maxclassview`) VALUES
(1, 'admin', 'l', 2, 1, '', 'no', 6, 8, 'yes', 91, 100),
(2, 'clock', 'l', 0, 0, 'BLOCK_CLOCK', 'no', 1, 8, 'yes', 1, 100),
(3, 'forum', 'l', 4, 1, '', 'no', 3, 8, 'yes', 25, 100),
(4, 'lastmember', 'l', 3, 1, '', 'no', 3, 8, 'yes', 25, 100),
(5, 'poll', 'r', 0, 0, 'BLOCK_POLL', 'no', 3, 8, 'yes', 25, 100),
(6, 'user', 'l', 1, 1, 'UserInfo', 'no', 3, 8, 'yes', 25, 100),
(7, 'online', 'b', 0, 1, '', 'no', 3, 8, 'yes', 25, 100),
(8, 'slider', 'c', 0, 0, 'BLOCK_TOPTORRENTS', 'no', 3, 8, 'yes', 25, 100),
(9, 'featured', 'c', 3, 1, 'BLOCK_LASTTORRENTS', 'no', 3, 8, 'yes', 25, 100),
(10, 'blog', 'c', 1, 1, 'BLOCK_NEWS', 'no', 3, 8, 'yes', 25, 100),
(12, 'welcomeback', 't', 0, 1, 'BLOCK_MAINUSERTOOLBAR', 'no', 3, 8, 'yes', 25, 100),
(13, 'hit_run', 'l', 5, 0, '', 'no', 8, 8, 'yes', 100, 100),
(14, 'disclaimer', 'b', 2, 1, 'BLOCK_DISCALIMER', 'no', 3, 8, 'yes', 25, 100),
(15, 'poller', 'r', 0, 1, 'BLOCK_POLL', 'no', 3, 8, 'yes', 25, 100),
(16, 'unvalidated', 'c', 0, 0, '', 'no', 8, 8, 'yes', 100, 100),
(17, 'donation', 'r', 1, 1, '', 'no', 3, 8, 'yes', 25, 100),
(18, 'alerts', 'c', 0, 0, '', 'no', 8, 8, 'yes', 100, 100),
(19, 'hit_run', 'r', 0, 0, 'BLOCK_HIT', 'no', 6, 8, 'yes', 91, 100),
(20, 'request', 'c', 7, 1, 'BLOCK_REQUEST', 'no', 3, 8, 'yes', 25, 100),
(21, 'lottery', 'r', 0, 0, 'BLOCK_LOTTERY', 'no', 8, 8, 'yes', 100, 100),
(22, 'last_request', 'c', 6, 1, 'BLOCK_LAST_REQUEST', 'no', 3, 8, 'yes', 25, 100),
(23, 'dropdownmenu', 'd', 0, 1, 'BLOCK_DDMENU', 'no', 2, 8, 'yes', 2, 100),
(24, 'bet', 'r', 2, 0, 'BLOCK_BET', 'no', 1, 8, 'yes', 1, 100),
(25, 'blufm', 'c', 0, 1, 'BLOCK_RAD', 'no', 3, 8, 'yes', 25, 100),
(26, 'topup', 'r', 5, 1, '', 'no', 3, 8, 'yes', 25, 100),
(27, 'circleimages', 'c', 0, 0, 'BLOCK_LASTTORRENTSC', 'no', 1, 8, 'yes', 1, 100),
(28, 'lrb', 'r', 0, 0, 'BLOCK_LRB', 'no', 6, 8, 'yes', 91, 100),
(29, 'birthday', 'r', 0, 0, 'BLOCK_BIRTHDAY', 'no', 8, 8, 'yes', 100, 100),
(30, 'links', 'b', 3, 0, 'BLOCK_LINKS', 'no', 3, 8, 'yes', 25, 100),
(31, 'last', 'c', 0, 0, 'BLOCK_LAST_DOWN', 'no', 8, 8, 'yes', 100, 100),
(32, 'torrentoftheweek', 'r', 3, 0, '', 'no', 1, 8, 'yes', 1, 100),
(34, 'calendar', 'l', 0, 0, 'BLOCK_CALENDAR', 'no', 1, 8, 'yes', 1, 100),
(36, 'comments', 'r', 5, 0, '', 'no', 1, 8, 'yes', 1, 100),
(40, 'ajax', 'c', 2, 1, '', 'no', 3, 8, 'yes', 25, 100),
(41, 'throwbacks', 'c', 4, 1, '', 'no', 3, 8, 'yes', 25, 100),
(42, 'seedbox', 'r', 4, 1, '', 'no', 3, 8, 'yes', 25, 100),
(43, 'maintrackertoolbar', 't', 1, 1, '', 'no', 3, 8, 'yes', 25, 100),
(44, 'openreg', 'c', 0, 0, '', 'no', 1, 8, 'yes', 1, 100),
(45, 'latest_releases', 'c', 5, 0, 'LATEST_RELEASES', 'no', 3, 8, 'yes', 25, 100),
(47, 'clients', 'b', 1, 1, '', 'no', 3, 8, 'yes', 25, 100);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bonus`
--

CREATE TABLE `{$db_prefix}bonus` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `points` decimal(10,1) NOT NULL DEFAULT '0.0',
  `traffic` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `gb` int(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bots`
--

CREATE TABLE `{$db_prefix}bots` (
  `name` varchar(20) NOT NULL,
  `visit` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bt_clients`
--

CREATE TABLE `{$db_prefix}bt_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `sort` tinyint(10) NOT NULL DEFAULT '0',
  `image` varchar(150) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}bugs`
--

CREATE TABLE `{$db_prefix}bugs` (
  `id` int(10) NOT NULL,
  `sender` int(10) NOT NULL DEFAULT '0',
  `added` int(12) NOT NULL DEFAULT '0',
  `priority` enum('low','high','veryhigh') NOT NULL DEFAULT 'low',
  `problem` text NOT NULL,
  `status` enum('fixed','ignored','na') NOT NULL DEFAULT 'na',
  `staff` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}categories`
--

CREATE TABLE `{$db_prefix}categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `sub` int(10) NOT NULL DEFAULT '0',
  `sort_index` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `forumid` int(10) NOT NULL DEFAULT '0',
  `reencode` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}categories`
--

INSERT INTO `{$db_prefix}categories` (`id`, `name`, `sub`, `sort_index`, `image`, `forumid`, `reencode`) VALUES
(17, 'HDTV 1080p', 14, 5, 'HDTV 1080p.png', 0, 0),
(5, 'Anime', 15, 3, 'Anime.png', 0, 0),
(16, 'HDTV 720p', 14, 6, 'HDTV 720p.png', 0, 0),
(15, 'Movies', 0, 0, '', 0, 0),
(11, '720p', 15, 2, '720p.png', 0, 0),
(14, 'HDTV ', 0, 4, '', 0, 0),
(13, '1080P', 15, 1, '1080p.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}categories_perm`
--

CREATE TABLE `{$db_prefix}categories_perm` (
  `catid` int(10) NOT NULL,
  `levelid` int(11) NOT NULL,
  `viewcat` enum('yes','no') NOT NULL DEFAULT 'yes',
  `viewtorrlist` enum('yes','no') NOT NULL DEFAULT 'yes',
  `viewtorrdet` enum('yes','no') NOT NULL DEFAULT 'yes',
  `downtorr` enum('yes','no') NOT NULL DEFAULT 'yes',
  `ratio` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}chat`
--

CREATE TABLE `{$db_prefix}chat` (
  `id` mediumint(9) NOT NULL,
  `uid` mediumint(9) NOT NULL,
  `time` int(10) NOT NULL DEFAULT '0',
  `name` tinytext NOT NULL,
  `text` text NOT NULL,
  `count` int(10) NOT NULL DEFAULT '1',
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `private` enum('yes','no') NOT NULL DEFAULT 'no',
  `toid` mediumint(9) NOT NULL,
  `fromid` mediumint(9) NOT NULL,
  `pchat` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}cheapmail`
--

CREATE TABLE `{$db_prefix}cheapmail` (
  `domain` varchar(100) NOT NULL DEFAULT '',
  `added` int(10) NOT NULL DEFAULT '0',
  `added_by` varchar(40) NOT NULL DEFAULT 'Unknown'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}coins`
--

CREATE TABLE `{$db_prefix}coins` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `torrentid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `points` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}comments`
--

CREATE TABLE `{$db_prefix}comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `ori_text` text NOT NULL,
  `user` varchar(20) NOT NULL DEFAULT '',
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `points` int(11) NOT NULL DEFAULT '0',
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `cid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}contact_system`
--

CREATE TABLE `{$db_prefix}contact_system` (
  `id` int(9) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cat` varchar(255) DEFAULT NULL,
  `subcat` varchar(255) DEFAULT NULL,
  `message` text,
  `ipaddress` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `re` enum('yes','no') NOT NULL DEFAULT 'no',
  `message2` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}countries`
--

CREATE TABLE `{$db_prefix}countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `flagpic` varchar(50) DEFAULT NULL,
  `domain` char(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `{$db_prefix}covers`
--

CREATE TABLE `{$db_prefix}covers` (
  `id` int(11) NOT NULL,
  `imdb` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  `size` int(10) NOT NULL,
  `type` enum('CASE','DISC') NOT NULL,
  `region` enum('A','B','C','UNKNOWN') NOT NULL DEFAULT 'UNKNOWN',
  `scan` enum('SCAN','CUSTOM','UNKNOWN') NOT NULL DEFAULT 'UNKNOWN',
  `sort` varchar(3) NOT NULL,
  `user` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}donors`
--

CREATE TABLE `{$db_prefix}donors` (
  `id` int(6) UNSIGNED NOT NULL,
  `userid` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `payers_email` varchar(255) NOT NULL DEFAULT '',
  `mc_gross` decimal(5,2) NOT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `country` varchar(255) NOT NULL,
  `item` varchar(20) NOT NULL,
  `test` varchar(20) NOT NULL DEFAULT '',
  `system` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}don_historie`
--

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
  `don_ation_10` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}downloads`
--

CREATE TABLE `{$db_prefix}downloads` (
  `id` int(5) NOT NULL,
  `uid` int(10) NOT NULL,
  `info_hash` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `updown` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}down_load`
--

CREATE TABLE `{$db_prefix}down_load` (
  `id` int(10) NOT NULL,
  `pid` varchar(32) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}dox`
--

CREATE TABLE `{$db_prefix}dox` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` datetime DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `size` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `uppedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}expected`
--

CREATE TABLE `{$db_prefix}expected` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `expect` varchar(225) DEFAULT NULL,
  `descr` text NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` varchar(255) NOT NULL DEFAULT '',
  `cat` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `torrenturl` varchar(255) NOT NULL,
  `uploaded` enum('yes','no') NOT NULL DEFAULT 'no',
  `expect_offer` enum('yes','no') NOT NULL DEFAULT 'no',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hitsmin` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}featured`
--

CREATE TABLE `{$db_prefix}featured` (
  `fid` int(5) NOT NULL,
  `torrent_id` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}files`
--

CREATE TABLE `{$db_prefix}files` (
  `id` int(10) UNSIGNED NOT NULL,
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `filename` varchar(250) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `info` varchar(250) NOT NULL DEFAULT '',
  `data` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `comment` text,
  `category` int(10) UNSIGNED NOT NULL DEFAULT '6',
  `external` enum('yes','no') NOT NULL DEFAULT 'no',
  `announce_url` varchar(100) NOT NULL DEFAULT '',
  `uploader` int(10) NOT NULL DEFAULT '1',
  `lastupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `anonymous` enum('true','false') NOT NULL DEFAULT 'false',
  `lastsuccess` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dlbytes` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `seeds` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `leechers` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `finished` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastcycle` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastSpeedCycle` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `speed` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `bin_hash` blob NOT NULL,
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `gold` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `free_expire_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `free` enum('yes','no') DEFAULT 'no',
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
  `vip_torrent` enum('0','1') NOT NULL DEFAULT '0',
  `requested` enum('true','false') NOT NULL DEFAULT 'false',
  `nuked` enum('true','false') NOT NULL DEFAULT 'false',
  `nuke_reason` varchar(100) DEFAULT NULL,
  `moder` enum('um','bad','ok') NOT NULL DEFAULT 'um',
  `shout_announced` tinyint(1) NOT NULL DEFAULT '0',
  `twitter_announced` tinyint(1) NOT NULL DEFAULT '0',
  `team` varchar(10) DEFAULT '0',
  `lock_comment` enum('yes','no') NOT NULL DEFAULT 'no',
  `multiplier` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT '1',
  `topicid` int(10) DEFAULT '0',
  `forum_announced` tinyint(1) NOT NULL DEFAULT '0',
  `staff_comment` varchar(250) DEFAULT NULL,
  `direct_download` varchar(255) NOT NULL DEFAULT '',
  `announces` text NOT NULL,
  `language` int(9) NOT NULL DEFAULT '0',
  `mplayer` varchar(250) NOT NULL DEFAULT '',
  `approved_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `viewcount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `genre` text,
  `bumpdate` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `archive` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `tvdb_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tvdb_extra` text,
  `dead_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `magnet` text,
  `points` int(10) NOT NULL DEFAULT '0',
  `youtube_video` varchar(250) DEFAULT NULL,
  `tag` text NOT NULL,
  `imdb_ignore` enum('yes','no') NOT NULL DEFAULT 'no',
  `release_group` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}files_reencode`
--

CREATE TABLE `{$db_prefix}files_reencode` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}files_reencodeb`
--

CREATE TABLE `{$db_prefix}files_reencodeb` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}files_thanks`
--

CREATE TABLE `{$db_prefix}files_thanks` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}forums`
--

CREATE TABLE `{$db_prefix}forums` (
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT NULL,
  `minclassread` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `minclasswrite` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `postcount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `topiccount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `minclasscreate` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `id_parent` int(10) NOT NULL DEFAULT '0',
  `category` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}forums`
--

INSERT INTO `{$db_prefix}forums` (`sort`, `id`, `name`, `description`, `minclassread`, `minclasswrite`, `postcount`, `topiccount`, `minclasscreate`, `id_parent`, `category`) VALUES
(0, 1, 'XBTIT Blu-Edition', '', 3, 3, 0, 0, 3, 0, 'yes'),
(2, 3, 'Welcome ', '', 1, 1, 2, 1, 1, 0, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}free_leech_req`
--

CREATE TABLE `{$db_prefix}free_leech_req` (
  `info_hash` varchar(40) NOT NULL,
  `count` int(10) NOT NULL DEFAULT '1',
  `approved` enum('yes','no','undecided') NOT NULL DEFAULT 'undecided',
  `requester_ids` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}friendlist`
--

CREATE TABLE `{$db_prefix}friendlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `friend_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `friend_name` varchar(250) NOT NULL DEFAULT '',
  `friend_date` varchar(20) NOT NULL,
  `confirmed` enum('yes','no') NOT NULL DEFAULT 'no',
  `rejected` enum('yes','no') NOT NULL DEFAULT 'no',
  `username` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}gold`
--

CREATE TABLE `{$db_prefix}gold` (
  `id` int(11) NOT NULL,
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
  `gold_percentage` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `silver_percentage` tinyint(3) UNSIGNED NOT NULL DEFAULT '50',
  `bronze_percentage` tinyint(3) UNSIGNED NOT NULL DEFAULT '75'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}gold`
--

INSERT INTO `{$db_prefix}gold` (`id`, `level`, `gold_picture`, `silver_picture`, `bronze_picture`, `active`, `date`, `gold_description`, `silver_description`, `bronze_description`, `classic_description`, `gold_percentage`, `silver_percentage`, `bronze_percentage`) VALUES
(1, 5, 'gold.gif', 'silver.gif', 'bronze.gif', '1', '0000-00-00', '100% free', '50% free', '25% free', '0% free', 0, 50, 75);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}hacks`
--

CREATE TABLE `{$db_prefix}hacks` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `version` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  `added` int(11) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `prerequisite` varchar(200) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}hacks`
--

INSERT INTO `{$db_prefix}hacks` (`id`, `title`, `version`, `author`, `added`, `folder`, `prerequisite`) VALUES
(2, 'fmhack_custom_title', '1.0 (FM)', 'Real_ptr', 1434749313, '', 'fmhack_bonus_system'),
(3, 'fmhack_bonus_system', '1.3 (FM)', 'Real_ptr & Petr1fied', 1434749313, '', 'no'),
(4, 'fmhack_donation_history', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'fmhack_advanced_auto_donation_system'),
(5, 'fmhack_simple_donor_display', '1.0 (FM)', 'Lupin', 1434749313, '', 'fmhack_advanced_auto_donation_system'),
(6, 'fmhack_timed_ranks', '1.1 (FM)', 'DiemThuy', 1434749313, '', 'fmhack_advanced_auto_donation_system'),
(7, 'fmhack_advanced_auto_donation_system', '1.3 (FM)', 'DiemThuy & cooly', 1434749313, '', 'no'),
(8, 'fmhack_gold_and_silver_torrents', '1.2 (FM)', 'Losmi & Petr1fied', 1434749313, '', 'no'),
(9, 'fmhack_free_leech_with_happy_hour', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(10, 'fmhack_torrent_image_upload', '1.1 (FM)', 'Real_ptr & Petr1fied', 1434749313, '', 'fmhack_balloons_on_mouseover|fmhack_circling_last_torrents'),
(11, 'fmhack_warning_system', '1.1 (FM)', 'linux198 & Petr1fied', 1434749313, '', 'fmhack_anti_hit_and_run_system|fmhack_low_ratio_ban_system'),
(12, 'fmhack_anti_hit_and_run_system', '1.3 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(13, 'fmhack_ask_for_reseed', '1.2 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(14, 'fmhack_auto_rank', '1.3 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(15, 'fmhack_report_users_and_torrents', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'fmhack_high_UL_speed_report'),
(16, 'fmhack_booted', '1.1 (FM)', 'cooly', 1434749313, '', 'no'),
(17, 'fmhack_group_colours_overall', '1.1 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(18, 'fmhack_getIMDB_in_torrent_details', '1.1 (FM)', 'cooly', 1434749313, '', 'no'),
(19, 'fmhack_staffpanel', '1.0 (FM)', 'Lupin', 1434749313, '', 'no'),
(21, 'fmhack_show_if_seedbox_is_used', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(22, 'fmhack_shoutbox_member_and_torrent_announce', '1.1 (FM)', 'DarkLegion & Lupin', 1434749313, '', 'no'),
(23, 'fmhack_sticky_torrent', '1.0 (FM)', 'Losmi', 1434749313, '', 'no'),
(24, 'fmhack_helpdesk', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(25, 'fmhack_torrent_request_and_vote', '1.1 (FM)', 'DiemThuy & cooly', 1434749313, '', 'no'),
(28, 'fmhack_uploader_size_and_comments_on_torrent_list', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(29, 'fmhack_display_new_torrents_since_last_Visit', '1.0 (FM)', 'vasyajva', 1434749313, '', 'no'),
(30, 'fmhack_lottery', '1.0 (FM)', 'JBoy (Original: Gewa)', 1434749313, '', 'no'),
(31, 'fmhack_shoutbox_banned', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(33, 'fmhack_torrent_thanks', '1.0 (FM)', 'Lupin', 1434749313, '', 'no'),
(34, 'fmhack_downloaded_torrents', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(35, 'fmhack_advanced_torrent_search', '1.3 (FM)', 'DiemThuy & cooly', 1434749313, '', 'no'),
(36, 'fmhack_sport_betting', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(37, 'fmhack_site_offline', '1.0 (FM)', 'Lupin', 1434749313, '', 'no'),
(39, 'fmhack_message_spy', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(40, 'fmhack_download_ratio_checker', '1.0 (FM)', 'Petr1fied & fatepower', 1434749313, '', 'no'),
(41, 'fmhack_signup_bonus_upload', '1.0 (FM)', 'RBert', 1434749313, '', 'no'),
(42, 'fmhack_add_new_users_in_adminCP', '1.0 (FM)', 'Lupin', 1434749313, '', 'no'),
(43, 'fmhack_torrents_limit', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(45, 'fmhack_ban_client', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(46, 'fmhack_auto_duplicate_torrent_checker', '1.0 (FM)', 'cooly & Petr1fied', 1434749313, '', 'no'),
(47, 'fmhack_show_members_whois_record_on_userdetails', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(48, 'fmhack_ban_button', '1.0 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(49, 'fmhack_ratio_editor', '1.0 (FM)', 'dodge & JBoy', 1434749313, '', 'no'),
(50, 'fmhack_speed_stats_in_peers_with_filename', '1.0 (FM)', 'miskotes & Lupin', 1434749313, '', 'no'),
(51, 'fmhack_subtitles', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(52, 'fmhack_torrent_nuked_and_requested', '1.0 (FM)', 'Author: RippeR | Conversion by Laurianti', 1434749313, '', 'no'),
(53, 'fmhack_duplicate_accounts', '1.0 (FM)', 'CobraCRK', 1434749313, '', 'no'),
(54, 'fmhack_high_UL_speed_report', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(56, 'fmhack_torrent_moderation', '1.2 (FM)', 'Losmi & Petr1fied', 1434749313, '', 'no'),
(57, 'fmhack_uploader_medals', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(58, 'fmhack_NFO_uploader_-_viewer', '1.1 (FM)', 'miskotes', 1434749313, '', 'no'),
(60, 'fmhack_balloons_on_mouseover', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(61, 'fmhack_teams', '1.1 (FM)', 'cooly & Petr1fied', 1434749313, '', 'no'),
(63, 'fmhack_{$db_prefix}->_SMF_style_bridge', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(65, 'fmhack_lock_comments', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(66, 'fmhack_account_parked', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(67, 'fmhack_low_ratio_ban_system', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(69, 'fmhack_hide_online_status', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(70, 'fmhack_upload_multiplier', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(72, 'fmhack_allow_and_disallow_users_to_up_and_download', '1.0 (FM)', 'linux198', 1434749313, '', 'fmhack_detect_and_blacklist_proxy'),
(73, 'fmhack_detect_and_blacklist_proxy', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(74, 'fmhack_view_edit_delete_preview_shoutBox_comments', '1.0 (FM)', 'miskotes', 1434749313, '', 'fmhack_comments_layout'),
(75, 'fmhack_comments_layout', '1.0 (FM)', 'Real_ptr', 1434749313, '', 'no'),
(77, 'fmhack_gifts', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(78, 'fmhack_hide_language', '2.0 (FM)', 'King Cobra', 1434749313, '', 'no'),
(79, 'fmhack_hide_style', '2.0 (FM)', 'King Cobra', 1434749313, '', 'no'),
(80, 'fmhack_bbcode_enhancements', '1.0 (FM)', 'King Cobra', 1434749313, '', 'no'),
(81, 'fmhack_auto_announce', '1.0 (FM)', 'linux198', 1434749313, '', 'no'),
(82, 'fmhack_staff_control', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(83, 'fmhack_torrent_bookmark', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(84, 'fmhack_birthdays', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(85, 'fmhack_PM_banned', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(86, 'fmhack_integrated_forum_display', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(88, 'fmhack_view_peer_details', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(89, 'fmhack_download_prefix_or_suffix', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(90, 'fmhack_uploader_rights', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(91, 'fmhack_pager_type_select', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(92, 'fmhack_user_notes', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(93, 'fmhack_avatar_signature_sync', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(94, 'fmhack_ban_cheapmail_domains', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(95, 'fmhack_uploader_control', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(96, 'fmhack_IP_to_country', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'fmhack_last_download_block'),
(97, 'fmhack_avatar_upload', '1.0 (FM)', 'JBoy', 1434749313, '', 'no'),
(99, 'fmhack_registration_open_randomly', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(100, 'fmhack_forum_auto_topic', '1.1 (FM)', 'dodge & Petr1fied', 1434749313, '', 'no'),
(101, 'fmhack_offer_to_re-encode', '1.0 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(103, 'fmhack_SEO_panel', '3.0 (FM)', 'atmoner', 1434749313, '', 'no'),
(104, 'fmhack_staff_comment_in_torrent_details', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(105, 'fmhack_disable_user_registration_with_duplicate_IP', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(106, 'fmhack_recommended_torrents', '1.0 (FM)', 'kvetinka', 1434749313, '', 'no'),
(107, 'fmhack_user_images', '1.0 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(108, 'fmhack_direct_download', '1.1 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(109, 'fmhack_about_me', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(110, 'fmhack_CBT_(Coolys_Backup_Tools)', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(111, 'fmhack_multi_tracker_scrape', '1.0 (FM)', 'Bitheaven', 1434749313, '', 'no'),
(112, 'fmhack_user_watch_list', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(113, 'fmhack_partners_page', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(114, 'fmhack_similar_torrents', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(115, 'fmhack_force_ssl', '1.0 (FM)', 'cooly', 1434749313, '', 'SSL must be installed in the server.'),
(117, 'fmhack_alternate_login', '1.1 (FM)', 'King Cobra & cooly', 1434749313, '', 'no'),
(118, 'fmhack_refresh_torrent_peers', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(119, 'fmhack_online_timeout', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(120, 'fmhack_search_all_sub-categories', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(121, 'fmhack_show_or_hide_porn', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(122, 'fmhack_private_profile', '1.0 (FM)', 'MrFix', 1434749313, '', 'no'),
(123, 'fmhack_anonymous_links', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(124, 'fmhack_language_in_torrent_list_and_details', '1.0 (FM)', 'MrFix', 1434749313, '', 'no'),
(126, 'fmhack_signature_on_internal_forum', '1.0 (FM)', 'Lupin', 1434749313, '', 'no'),
(127, 'fmhack_user_signup_agreement', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(128, 'fmhack_total_online_time', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(130, 'fmhack_VIP_freeleech', '1.1 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(131, 'fmhack_torrent_view_count', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(132, 'fmhack_split_torrents_by_date', '1.0 (FM)', 'hasu (George Hasu)', 1434749313, '', 'no'),
(133, 'fmhack_social_network', '1.0 (FM)', 'Diemthuy & Petr1fied', 1434749313, '', 'no'),
(134, 'fmhack_bump_torrents', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(135, 'fmhack_advanced_RSS_feed', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(136, 'fmhack_archive_torrents', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(138, 'fmhack_default_cat_browse', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(139, 'fmhack_welcome_pm', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(140, 'fmhack_logical_rank_ordering', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(141, 'fmhack_freeleech_slots', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(143, 'fmhack_profile_torrent_sorting', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(144, 'fmhack_comment_captcha', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(145, 'fmhack_pM_notification_on_torrent_comment', '1.0 (FM)', 'Liroy (Original author:gAnDo)', 1434749313, '', 'no'),
(146, 'fmhack_no_columns_display', '1.1 (FM)', 'cooly', 1434749313, '', 'no'),
(147, 'fmhack_protected_usernames', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(148, 'fmhack_multi_delete_torrents', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(150, 'fmhack_torrent_activity_colouring', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(151, 'fmhack_grab_images_from_theTVDB', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(152, 'fmhack_advanced_prune_users_and_torrents', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(153, 'fmhack_previous_usernames', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(154, 'fmhack_download_requires_introduction', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(155, 'fmhack_only_allow_specified_email_domains', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(156, 'fmhack_magnet_links', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(157, 'fmhack_block_signup_from_certain_countries', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(158, 'fmhack_permissions_for_external_torrents', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(159, 'fmhack_torrent_times', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(161, 'fmhack_custom_smileys', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(163, 'fmhack_apply_for_membership', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(165, 'fmhack_bon_pool', '1.1 (Blu)', 'Gaart', 1434749313, '', 'no'),
(167, 'fmhack_ajax_chat', '1.0 (Blu)', 'Gaart', 1434749313, '', 'no'),
(168, 'fmhack_ccslider', '1.0 (Blu)', 'Vinnie', 1434749313, '', 'no'),
(169, 'fmhack_torrent_list_switch', '1.0 (Blu', 'HDVinnie', 1434749313, '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}helpdesk`
--

CREATE TABLE `{$db_prefix}helpdesk` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(60) NOT NULL DEFAULT '',
  `msg_problem` text,
  `added` int(11) NOT NULL DEFAULT '0',
  `solved_date` int(11) NOT NULL DEFAULT '0',
  `solved` enum('no','yes','ignored') NOT NULL DEFAULT 'no',
  `added_by` int(10) NOT NULL DEFAULT '0',
  `solved_by` int(10) NOT NULL DEFAULT '0',
  `msg_answer` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}history`
--

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
  `completed_time` int(11) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}hnr`
--

CREATE TABLE `{$db_prefix}hnr` (
  `id_level` int(11) NOT NULL DEFAULT '0',
  `method` enum('seed_only','ratio_only','seed_or_ratio','seed_and_ratio') NOT NULL DEFAULT 'seed_only',
  `min_seed_hours` int(11) NOT NULL DEFAULT '0',
  `min_ratio` float NOT NULL DEFAULT '0',
  `tolerance_hours` int(11) NOT NULL DEFAULT '0',
  `dl_trig_bytes` bigint(20) NOT NULL DEFAULT '0',
  `block_leech` int(11) NOT NULL DEFAULT '0',
  `forum_post` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}hnr`
--

INSERT INTO `{$db_prefix}hnr` (`id_level`, `method`, `min_seed_hours`, `min_ratio`, `tolerance_hours`, `dl_trig_bytes`, `block_leech`, `forum_post`) VALUES
(3, 'seed_only', 168, 0, 72, 1073741824, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}ignore`
--

CREATE TABLE `{$db_prefix}ignore` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ignore_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ignore_name` varchar(250) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}imdb`
--

CREATE TABLE `{$db_prefix}imdb` (
  `id` int(10) UNSIGNED NOT NULL,
  `imdb` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(180) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `genre1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `genre2` varchar(25) COLLATE utf8_unicode_ci DEFAULT '',
  `genre3` varchar(25) COLLATE utf8_unicode_ci DEFAULT '',
  `rating` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `poster` varchar(180) COLLATE utf8_unicode_ci DEFAULT '',
  `banner1` varchar(180) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner2` varchar(180) COLLATE utf8_unicode_ci DEFAULT '',
  `banner3` varchar(180) COLLATE utf8_unicode_ci DEFAULT '',
  `banner4` varchar(180) COLLATE utf8_unicode_ci DEFAULT '',
  `banner5` varchar(180) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}invalid_logins`
--

CREATE TABLE `{$db_prefix}invalid_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` bigint(11) DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `failed` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `remaining` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}invitations`
--

CREATE TABLE `{$db_prefix}invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `inviter` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `invitee` varchar(80) NOT NULL DEFAULT '',
  `hash` varchar(32) NOT NULL DEFAULT '',
  `time_invited` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmed` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}ip2country`
--

CREATE TABLE `{$db_prefix}ip2country` (
  `ip_from` double NOT NULL DEFAULT '0',
  `ip_to` double NOT NULL DEFAULT '0',
  `country_code2` char(2) NOT NULL DEFAULT '',
  `country_code3` char(3) NOT NULL DEFAULT '',
  `country_name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}iplog`
--

CREATE TABLE `{$db_prefix}iplog` (
  `ipid` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uid` varchar(5) NOT NULL DEFAULT '',
  `uipid` char(1) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}khez_configs`
--

CREATE TABLE `{$db_prefix}khez_configs` (
  `key` varchar(30) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}khez_configs`
--

INSERT INTO `{$db_prefix}khez_configs` (`key`, `value`) VALUES
('kis_enabled', 'true'),
('kis_invExpireAmmount', '1'),
('kis_perPage', '25'),
('kis_invExpireType', 'W'),
('kocs_bak_by', '0'),
('kocs_bak_last', '0'),
('kocs_cfg_key', '08077a68b7bc66b899dabd2f90c84eeb'),
('kocs_cfg_keycheck', 'true'),
('kocs_cfg_logs', 'true'),
('kocs_res_by', '0'),
('kocs_res_errors', '0'),
('kocs_res_last', '0'),
('xtd_casesens', 'true'),
('xtd_chars', '100'),
('xtd_enabled', 'true'),
('xtd_file', 'Downloaded from YOUR_TRACKER.com'),
('xtd_img', '1'),
('xtd_loc', '3'),
('xtd_url', '1'),
('kis_logs', 'true'),
('kis_regType', 'GB'),
('kis_regAmmount', '10');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}kis_sent`
--

CREATE TABLE `{$db_prefix}kis_sent` (
  `token` varchar(190) NOT NULL,
  `time` int(20) NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `used` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}kis_users`
--

CREATE TABLE `{$db_prefix}kis_users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `invites` int(5) UNSIGNED NOT NULL,
  `joined` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `{$db_prefix}kis_users`
--

INSERT INTO `{$db_prefix}kis_users` (`uid`, `invites`, `joined`) VALUES
(12922, 1, 0),
(23027, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}language`
--

CREATE TABLE `{$db_prefix}language` (
  `id` int(10) NOT NULL,
  `language` varchar(20) NOT NULL DEFAULT '',
  `language_url` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}language`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}logs`
--

CREATE TABLE `{$db_prefix}logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` int(10) DEFAULT NULL,
  `txt` text,
  `type` varchar(10) NOT NULL DEFAULT 'add',
  `user` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}lottery_config`
--

CREATE TABLE `{$db_prefix}lottery_config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `lot_expire_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lot_number_winners` varchar(20) NOT NULL DEFAULT '',
  `lot_number_to_win` varchar(20) NOT NULL DEFAULT '',
  `lot_amount` varchar(20) NOT NULL DEFAULT '',
  `lot_status` enum('yes','no','closed') NOT NULL DEFAULT 'yes',
  `limit_buy` char(2) NOT NULL DEFAULT '',
  `sender_id` char(8) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}lottery_tickets`
--

CREATE TABLE `{$db_prefix}lottery_tickets` (
  `id` int(4) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}lottery_winners`
--

CREATE TABLE `{$db_prefix}lottery_winners` (
  `id` int(4) NOT NULL,
  `win_user` varchar(20) NOT NULL DEFAULT '',
  `windate` varchar(20) NOT NULL DEFAULT '',
  `price` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}low_ratio_ban`
--

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
  `wb_fin` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}low_ratio_ban_settings`
--

CREATE TABLE `{$db_prefix}low_ratio_ban_settings` (
  `id` varchar(4) NOT NULL DEFAULT '1',
  `wb_sys` enum('true','false') NOT NULL DEFAULT 'false',
  `wb_text_one` varchar(255) NOT NULL,
  `wb_text_two` varchar(255) NOT NULL,
  `wb_text_fin` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}low_ratio_ban_settings`
--

INSERT INTO `{$db_prefix}low_ratio_ban_settings` (`id`, `wb_sys`, `wb_text_one`, `wb_text_two`, `wb_text_fin`) VALUES
('1', 'false', 'Message for first warning here', 'Message for second warning here', 'Message for final warning here');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}messages`
--

CREATE TABLE `{$db_prefix}messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `receiver` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `subject` varchar(50) NOT NULL DEFAULT '',
  `msg` text,
  `readed` enum('yes','no') NOT NULL DEFAULT 'no',
  `deletedBySender` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}moderate_reasons`
--

CREATE TABLE `{$db_prefix}moderate_reasons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `ordering` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}modules`
--

CREATE TABLE `{$db_prefix}modules` (
  `id` mediumint(3) NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `activated` enum('yes','no') NOT NULL DEFAULT 'yes',
  `type` enum('staff','misc','torrent','style') NOT NULL DEFAULT 'misc',
  `changed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}modules`
--

INSERT INTO `{$db_prefix}modules` (`id`, `name`, `activated`, `type`, `changed`, `created`) VALUES
(1, 'seedbonus', 'yes', 'misc', '2015-06-19 17:28:33', '2015-06-19 17:28:33'),
(2, 'helpdesk', 'yes', 'misc', '2015-06-19 17:28:33', '2015-06-19 17:28:33'),
(5, 'pool', 'yes', 'misc', '2015-07-07 17:56:37', '2015-07-07 17:56:37'),
(7, 'bugs', 'yes', 'misc', '2015-08-07 17:51:55', '2015-08-07 17:51:55'),
(8, 'nat', 'no', 'misc', '2015-11-23 15:10:33', '2015-09-01 16:11:33'),
(9, 'getrss', 'yes', 'misc', '2016-04-23 21:50:39', '2015-11-09 22:47:52'),
(10, 'hitnrun_cleaner', 'yes', 'misc', '2015-11-09 23:03:16', '2015-11-09 23:03:16'),
(11, 'invite', 'no', 'misc', '2016-05-15 02:03:16', '2016-01-04 19:17:47'),
(12, 'seedhelp', 'yes', 'misc', '2016-02-04 02:02:25', '2016-02-04 02:02:25'),
(13, 'covers', 'yes', 'misc', '2016-10-21 23:53:45', '2016-04-15 02:19:11'),
(14, 'memcache', 'yes', 'misc', '2017-01-14 05:51:30', '2016-12-08 22:23:32'),
(15, 'cache', 'yes', 'misc', '2016-12-09 06:03:08', '2016-12-09 06:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}mostonline`
--

CREATE TABLE `{$db_prefix}mostonline` (
  `amount` int(4) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL DEFAULT '2008-11-24 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}news`
--

CREATE TABLE `{$db_prefix}news` (
  `id` int(11) NOT NULL,
  `news` blob NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}news`
--

INSERT INTO `{$db_prefix}news` (`id`, `news`, `user_id`, `date`, `title`) VALUES
(1, 0x57656c636f6d6520546f20584254495420426c752d45646974696f6e20627920426c7543726577, 12922, '2016-10-14 19:19:05', 'Welcome');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}notes`
--

CREATE TABLE `{$db_prefix}notes` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}offer_comments`
--

CREATE TABLE `{$db_prefix}offer_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `ori_text` text NOT NULL,
  `user` varchar(20) NOT NULL DEFAULT '',
  `offer_id` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}online`
--

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
  `user_images` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}partner`
--

CREATE TABLE `{$db_prefix}partner` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `addedby` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}paypal_settings`
--

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
  `bitcoin_address` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}peers`
--

CREATE TABLE `{$db_prefix}peers` (
  `infohash` varchar(40) NOT NULL DEFAULT '',
  `peer_id` varchar(40) NOT NULL DEFAULT '',
  `bytes` bigint(20) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT 'error.x',
  `port` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('leecher','seeder') NOT NULL DEFAULT 'leecher',
  `lastupdate` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sequence` int(10) UNSIGNED NOT NULL,
  `natuser` enum('N','Y') NOT NULL DEFAULT 'N',
  `client` varchar(60) NOT NULL DEFAULT '',
  `dns` varchar(100) NOT NULL DEFAULT '',
  `uploaded` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `downloaded` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `pid` varchar(32) DEFAULT NULL,
  `with_peerid` varchar(101) NOT NULL DEFAULT '',
  `without_peerid` varchar(40) NOT NULL DEFAULT '',
  `compact` varchar(6) NOT NULL DEFAULT '',
  `announce_interval` int(10) NOT NULL,
  `upload_difference` bigint(20) NOT NULL,
  `download_difference` bigint(20) NOT NULL,
  `real_uploaded` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `real_downloaded` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}poller`
--

CREATE TABLE `{$db_prefix}poller` (
  `ID` int(11) NOT NULL,
  `startDate` int(10) NOT NULL DEFAULT '0',
  `endDate` int(10) NOT NULL DEFAULT '0',
  `pollerTitle` varchar(255) DEFAULT NULL,
  `starterID` mediumint(8) NOT NULL DEFAULT '0',
  `active` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}poller`
--

INSERT INTO `{$db_prefix}poller` (`ID`, `startDate`, `endDate`, `pollerTitle`, `starterID`, `active`) VALUES
(2, 1479757060, 0, 'Do you like Blu-Edition?', 12922, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}poller_option`
--

CREATE TABLE `{$db_prefix}poller_option` (
  `ID` int(11) NOT NULL,
  `pollerID` int(11) DEFAULT NULL,
  `optionText` varchar(255) DEFAULT NULL,
  `pollerOrder` int(11) DEFAULT NULL,
  `defaultChecked` char(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}poller_option`
--

INSERT INTO `{$db_prefix}poller_option` (`ID`, `pollerID`, `optionText`, `pollerOrder`, `defaultChecked`) VALUES
(1, 1, 'Excellent', 1, '1'),
(2, 1, 'Very good', 2, '0'),
(3, 1, 'Good', 3, '0'),
(4, 1, 'Fair', 3, '0'),
(5, 1, 'Poor', 4, '0'),
(6, 2, 'Yes', 0, '0'),
(7, 2, 'No', 1, '0'),
(8, 2, 'Blank', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}poller_vote`
--

CREATE TABLE `{$db_prefix}poller_vote` (
  `ID` int(11) NOT NULL,
  `pollerID` int(11) NOT NULL DEFAULT '0',
  `optionID` int(11) DEFAULT NULL,
  `ipAddress` bigint(11) DEFAULT '0',
  `voteDate` int(10) NOT NULL DEFAULT '0',
  `memberID` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}polls`
--

CREATE TABLE `{$db_prefix}polls` (
  `pid` mediumint(8) NOT NULL,
  `startdate` int(10) DEFAULT NULL,
  `choices` text,
  `starter_id` mediumint(8) NOT NULL DEFAULT '0',
  `votes` smallint(5) NOT NULL DEFAULT '0',
  `poll_question` varchar(255) DEFAULT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}poll_voters`
--

CREATE TABLE `{$db_prefix}poll_voters` (
  `vid` int(10) NOT NULL,
  `ip` varchar(16) NOT NULL DEFAULT '',
  `votedate` int(10) NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `memberid` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}pool`
--

CREATE TABLE `{$db_prefix}pool` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(10) NOT NULL,
  `poolid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}pool_settings`
--

CREATE TABLE `{$db_prefix}pool_settings` (
  `id` int(10) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `pot` int(11) NOT NULL,
  `complete` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}posts`
--

CREATE TABLE `{$db_prefix}posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `topicid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `body` mediumtext,
  `editedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `editedat` int(10) DEFAULT '0',
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}posts`
--

INSERT INTO `{$db_prefix}posts` (`id`, `topicid`, `userid`, `added`, `body`, `editedby`, `editedat`, `sbonus`) VALUES
(22, 3, 12922, 1481142259, 'Introduce Yourself Here :)', 0, 0, '0.000000'),

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}profile_status`
--

CREATE TABLE `{$db_prefix}profile_status` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL DEFAULT '0',
  `last_status` varchar(140) NOT NULL,
  `last_update` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}quiz`
--

CREATE TABLE `{$db_prefix}quiz` (
  `qid` int(5) UNSIGNED NOT NULL,
  `Question` text,
  `opt1` text,
  `opt2` text,
  `opt3` text,
  `opt4` text,
  `woptcode` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}rank`
--

CREATE TABLE `{$db_prefix}rank` (
  `userid` int(11) NOT NULL,
  `old_rank` int(11) NOT NULL,
  `new_rank` int(11) NOT NULL,
  `byt` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `undone` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}ratings`
--

CREATE TABLE `{$db_prefix}ratings` (
  `infohash` char(40) NOT NULL DEFAULT '',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `added` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}readposts`
--

CREATE TABLE `{$db_prefix}readposts` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `topicid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastpostread` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}recommended`
--

CREATE TABLE `{$db_prefix}recommended` (
  `id` int(11) NOT NULL,
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `user_name` varchar(40) NOT NULL DEFAULT 'anonymous'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}reports`
--

CREATE TABLE `{$db_prefix}reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `addedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `votedfor` varchar(50) DEFAULT NULL,
  `type` enum('torrent','user') NOT NULL DEFAULT 'torrent',
  `reason` text NOT NULL,
  `dealtby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dealtwith` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}reputation`
--

CREATE TABLE `{$db_prefix}reputation` (
  `reputationid` int(11) UNSIGNED NOT NULL,
  `whoadded` int(10) NOT NULL DEFAULT '0',
  `dateadd` int(10) NOT NULL DEFAULT '0',
  `userid` mediumint(8) NOT NULL DEFAULT '0',
  `updown` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}reputation_settings`
--

CREATE TABLE `{$db_prefix}reputation_settings` (
  `id` varchar(10) NOT NULL DEFAULT '1',
  `rep_is_online` varchar(10) NOT NULL DEFAULT '1',
  `rep_adminpower` varchar(10) NOT NULL,
  `rep_minpost` varchar(10) NOT NULL,
  `rep_default` varchar(10) NOT NULL,
  `rep_userrates` varchar(10) NOT NULL,
  `rep_rdpower` varchar(10) NOT NULL,
  `rep_pcpower` varchar(10) NOT NULL,
  `rep_kppower` varchar(10) NOT NULL,
  `rep_minrep` varchar(10) NOT NULL,
  `rep_hit` varchar(10) NOT NULL,
  `rep_maxperday` varchar(10) NOT NULL,
  `rep_repeat` varchar(10) NOT NULL,
  `rep_undefined` varchar(10) NOT NULL,
  `best_level` varchar(40) NOT NULL DEFAULT 'Best Level',
  `good_level` varchar(40) NOT NULL DEFAULT 'Good Level',
  `no_level` varchar(40) NOT NULL DEFAULT 'No Level',
  `bad_level` varchar(40) NOT NULL DEFAULT 'Bad Level',
  `worse_level` varchar(40) NOT NULL DEFAULT 'Worse Level',
  `rep_upload` varchar(10) NOT NULL DEFAULT '1',
  `rep_en_sys` varchar(10) NOT NULL DEFAULT '1',
  `rep_pr_id` varchar(10) NOT NULL DEFAULT '20',
  `rep_dm_id` varchar(10) NOT NULL DEFAULT '20',
  `rep_pr` varchar(10) NOT NULL DEFAULT '1000',
  `rep_dm` varchar(10) NOT NULL DEFAULT '-1000',
  `rep_pm_text` varchar(255) NOT NULL DEFAULT 'tekst',
  `rep_dm_text` varchar(255) NOT NULL DEFAULT 'tekst'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `{$db_prefix}reputation_settings`
--

INSERT INTO `{$db_prefix}reputation_settings` (`id`, `rep_is_online`, `rep_adminpower`, `rep_minpost`, `rep_default`, `rep_userrates`, `rep_rdpower`, `rep_pcpower`, `rep_kppower`, `rep_minrep`, `rep_hit`, `rep_maxperday`, `rep_repeat`, `rep_undefined`, `best_level`, `good_level`, `no_level`, `bad_level`, `worse_level`, `rep_upload`, `rep_en_sys`, `rep_pr_id`, `rep_dm_id`, `rep_pr`, `rep_dm`, `rep_pm_text`, `rep_dm_text`) VALUES
('1', 'false', '5', '10', '0', '1', '1', '1', '0', '5', '5', '24', '', '1', 'Outstanding Reputation', 'Good Reputation', 'No Reputation', 'Bad Reputation', 'Terrable Reputation', '3', 'false', '5', '3', '1000', '-1000', 'promote text', 'demote text'),
('1', 'false', '5', '10', '0', '1', '1', '1', '0', '5', '5', '24', '', '1', 'Outstanding Reputation', 'Good Reputation', 'No Reputation', 'Bad Reputation', 'Terrable Reputation', '3', 'false', '5', '3', '1000', '-1000', 'promote text', 'demote text');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}requests`
--

CREATE TABLE `{$db_prefix}requests` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `reqname` varchar(120) NOT NULL,
  `category` tinyint(3) UNSIGNED NOT NULL,
  `requester` smallint(5) UNSIGNED NOT NULL,
  `dateadded` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `views` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `imdb` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `tvdb` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `jobtakenby` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `jobtakenwhen` datetime DEFAULT NULL,
  `uploadedby` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `uploadedwhen` datetime DEFAULT NULL,
  `infohash` varchar(40) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}requests`
--

INSERT INTO `{$db_prefix}requests` (`id`, `reqname`, `category`, `requester`, `dateadded`, `description`, `views`, `imdb`, `tvdb`, `jobtakenby`, `jobtakenwhen`, `uploadedby`, `uploadedwhen`, `infohash`) VALUES
(3, 'The Matrix 1999 1080p AAC 5.1 MP4', 13, 12922, '2016-10-28 12:02:32', 'The Matrix 1999 1080p AAC 5.1 MP4', 41, 133093, 0, 0, NULL, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}requests_bounty`
--

CREATE TABLE `{$db_prefix}requests_bounty` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `addedby` smallint(5) UNSIGNED NOT NULL,
  `seedbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `req_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}requests_comments`
--

CREATE TABLE `{$db_prefix}requests_comments` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `req_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `addedby` smallint(5) UNSIGNED NOT NULL,
  `addedwhen` datetime DEFAULT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}rules`
--

CREATE TABLE `{$db_prefix}rules` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `sort_index` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}rules_group`
--

CREATE TABLE `{$db_prefix}rules_group` (
  `id` int(11) NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `sort_index` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}sb`
--

CREATE TABLE `{$db_prefix}sb` (
  `id` int(5) NOT NULL,
  `what` varchar(20) NOT NULL,
  `gb` varchar(20) NOT NULL,
  `points` int(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}searchcloud`
--

CREATE TABLE `{$db_prefix}searchcloud` (
  `id` int(10) UNSIGNED NOT NULL,
  `searchedfor` varchar(50) NOT NULL,
  `howmuch` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}seedboxip`
--

CREATE TABLE `{$db_prefix}seedboxip` (
  `id` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `host` varchar(200) NOT NULL,
  `peers` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}seo`
--

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
  `abs_path` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}seo`
--

INSERT INTO `{$db_prefix}seo` (`id`, `activated`, `activated_user`, `str`, `strto`, `cano`, `use_meta`, `metakeyword`, `metadesc`, `copyright`, `author`, `robots`, `revisitafter`, `analytic_active`, `ggwebmaster_active`, `analytic`, `ggwebmaster`, `maxurl`, `namemap`, `active_map`, `abs_path`) VALUES
('1', 'true', 'true', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ {}[]', 'abcdefghijklmnopqrstuvwxyz-----', 'true', 'true', 'Meta Keyword for xbtit team', 'Meta description for xbtit team', 'your Meta Copyright', 'your Meta Author', 'index, follow', '12 days', 'true', 'true', 'analytict', 'testee', '3', 'sitemap.xml', 'true', '/var/www/');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}settings`
--

CREATE TABLE `{$db_prefix}settings` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}settings`
--

INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('add_new_user_language', 'enabled'),
('add_new_user_style', 'disabled'),
('advprunet_del_torrents', '30'),
('ad_groups', '8'),
('ajax_poller', 'true'),
('allow_override_ip', 'false'),
('altfaqtype', 'kcdoff'),
('altmode', 'new'),
('altrulestype', 'kcdoff'),
('alt_faq', 'enabled'),
('alt_news', 'disabled'),
('alt_rules', 'enabled'),
('announce', 'a:1:{i:0;s:49:"http://blu-edition.hdinnovations.xyz/announce.php";}'),
('apply_all', 'enabled'),
('apply_id', '8'),
('apply_rules_text', 'None of the files shown here are actually hosted on the server of Blu-Edition. The links are provided solely by this site\'s users. The administrator of this site cannot be held responsible for what its users post, or any other actions of its users. You may not use this site to distribute or download any material when you do not have the legal rights to do so. It is your own responsibility to adhere to these terms. By registering on and/or using this website, it is assumed that you, as the user, have read, understood, and agreed to all the terms and conditions set forth by the site\'s owner.'),
('archive_enable', 'false'),
('archive_time', '7-2'),
('autorank_fullcheck', '0'),
('autorank_sendpm', 'yes'),
('balloontype', '2,1,3'),
('banbutton', 'lro-1-91'),
('bandays', '7'),
('banned_usernames', ''),
('birthday_bonus', '1'),
('birthday_bytes', 'GB'),
('birthday_lower_limit', '18'),
('birthday_upper_limit', '100'),
('blocked_signup_countries', ''),
('bonus', '1'),
('bonus_archive', '0'),
('bonus_comm', '10'),
('bonus_flslot', '10000'),
('bonus_forpost', '10'),
('bonus_giftmax', '100000'),
('bonus_listen2radio', '0'),
('bonus_make_a_shout', '0'),
('bonus_max_per_hour', '300'),
('bonus_min_uprate', '1'),
('bonus_type', 'one'),
('bonus_upl', '100'),
('bonus_upl_delay', '1'),
('cache_duration', '0'),
('CBT_FILE_BACKUP_DIR', 'backup/backup/'),
('cheat_breakpoint', '3'),
('cheat_ratio_global', '0.4'),
('cheat_ratio_user', '0.4'),
('cheat_value', '5'),
('cheat_value_max', '7'),
('class_allowed', '3|4|5|6|7|8'),
('clocktype', 'false'),
('comment_captcha_priv', ''),
('comment_captcha_pub', ''),
('comm_enable', 'false'),
('countbyte', 'true'),
('createacc_language', 'enabled'),
('createacc_style', 'disabled'),
('ct_enable', 'false'),
('cut_name', '0'),
('debug', 'true'),
('default_charset', 'UTF-8'),
('default_language', '1'),
('default_style', '11'),
('dh_pm', '\'true\''),
('dh_text', '\'Thank you Very Much For Your Donation! It really helps us keep the site alive and well\''),
('dh_unit', 'true'),
('disable_dht', 'true'),
('donate_mode', 'classic'),
('donate_upload', '50'),
('don_chat', '5'),
('download_prefix', ''),
('download_suffix', ''),
('dynamic', 'false'),
('email', 'Mr.Robot@stealth.tg'),
('enable', '1'),
('external', 'false'),
('external_update', '1800'),
('fhost_delete_days', '7'),
('fhost_file_limit', '52428800'),
('fhost_level_download', '3'),
('fhost_level_upload', '3'),
('fhost_page_limit', '15'),
('fhost_title', 'Place Your Message Here'),
('fhost_upload', 'disabled'),
('fid_bet', '83'),
('fid_bet_user', '54460'),
('file_limit', '5000'),
('flshot_enable', 'false'),
('fmhack_about_me', 'enabled'),
('fmhack_account_parked', 'enabled'),
('fmhack_addthis', 'disabled'),
('fmhack_add_new_users_in_adminCP', 'enabled'),
('fmhack_ads_system', 'disabled'),
('fmhack_advanced_auto_donation_system', 'disabled'),
('fmhack_advanced_prune_users_and_torrents', 'disabled'),
('fmhack_advanced_RSS_feed', 'enabled'),
('fmhack_advanced_torrent_search', 'enabled'),
('fmhack_ajax_chat', 'enabled'),
('fmhack_allow_and_disallow_users_to_up_and_download', 'enabled'),
('fmhack_alternate_login', 'enabled'),
('fmhack_anonymous_links', 'enabled'),
('fmhack_anti_hit_and_run_system', 'enabled'),
('fmhack_apply_for_membership', 'enabled'),
('fmhack_archive_torrents', 'disabled'),
('fmhack_ask_for_reseed', 'enabled'),
('fmhack_automatic_album_cover_and_picture_grabber', 'disabled'),
('fmhack_auto_announce', 'enabled'),
('fmhack_auto_duplicate_torrent_checker', 'enabled'),
('fmhack_auto_rank', 'enabled'),
('fmhack_avatar_signature_sync', 'enabled'),
('fmhack_avatar_upload', 'enabled'),
('fmhack_balloons_on_mouseover', 'disabled'),
('fmhack_ban_button', 'enabled'),
('fmhack_ban_cheapmail_domains', 'enabled'),
('fmhack_ban_client', 'enabled'),
('fmhack_bbcode_enhancements', 'enabled'),
('fmhack_birthdays', 'enabled'),
('fmhack_block_signup_from_certain_countries', 'enabled'),
('fmhack_bluflix', 'enabled'),
('fmhack_{$db_prefix}->_SMF_style_bridge', 'disabled'),
('fmhack_bonus_system', 'enabled'),
('fmhack_bon_pool', 'enabled'),
('fmhack_booted', 'enabled'),
('fmhack_bump_torrents', 'enabled'),
('fmhack_CBT_(Coolys_Backup_Tools)', 'enabled'),
('fmhack_ccslider', 'enabled'),
('fmhack_circling_last_torrents', 'disabled'),
('fmhack_comments_layout', 'enabled'),
('fmhack_comment_captcha', 'disabled'),
('fmhack_custom_smileys', 'enabled'),
('fmhack_custom_title', 'enabled'),
('fmhack_default_cat_browse', 'enabled'),
('fmhack_detect_and_blacklist_proxy', 'disabled'),
('fmhack_direct_download', 'disabled'),
('fmhack_disable_user_registration_with_duplicate_IP', 'enabled'),
('fmhack_display_new_torrents_since_last_Visit', 'enabled'),
('fmhack_donation_history', 'disabled'),
('fmhack_downloaded_torrents', 'enabled'),
('fmhack_download_prefix_or_suffix', 'enabled'),
('fmhack_download_ratio_checker', 'enabled'),
('fmhack_download_requires_introduction', 'enabled'),
('fmhack_duplicate_accounts', 'enabled'),
('fmhack_enhanced_wait_time', 'disabled'),
('fmhack_extended_torrent_description', 'disabled'),
('fmhack_faq_with_groups', 'disabled'),
('fmhack_forced_FAQ', 'disabled'),
('fmhack_force_ssl', 'enabled'),
('fmhack_forum_auto_topic', 'disabled'),
('fmhack_freeleech_slots', 'enabled'),
('fmhack_free_leech_with_happy_hour', 'enabled'),
('fmhack_games', 'enabled'),
('fmhack_getIMDB_in_torrent_details', 'enabled'),
('fmhack_gifts', 'enabled'),
('fmhack_gold_and_silver_torrents', 'enabled'),
('fmhack_grab_images_from_theTVDB', 'enabled'),
('fmhack_graphic_average_bar', 'disabled'),
('fmhack_group_colours_overall', 'enabled'),
('fmhack_helpdesk', 'enabled'),
('fmhack_hide_language', 'enabled'),
('fmhack_hide_online_status', 'enabled'),
('fmhack_hide_style', 'enabled'),
('fmhack_high_UL_speed_report', 'enabled'),
('fmhack_IMG_in_SB_after_x_shouts', 'disabled'),
('fmhack_integrated_forum_display', 'enabled'),
('fmhack_invitation_system', 'disabled'),
('fmhack_IP_to_country', 'enabled'),
('fmhack_language_in_torrent_list_and_details', 'enabled'),
('fmhack_last_download_block', 'disabled'),
('fmhack_LED_ticker', 'disabled'),
('fmhack_lock_comments', 'enabled'),
('fmhack_logical_rank_ordering', 'enabled'),
('fmhack_lottery', 'disabled'),
('fmhack_low_ratio_ban_system', 'enabled'),
('fmhack_magnet_links', 'disabled'),
('fmhack_message_spy', 'enabled'),
('fmhack_multi_delete_torrents', 'enabled'),
('fmhack_multi_tracker_scrape', 'disabled'),
('fmhack_NFO_uploader_-_viewer', 'enabled'),
('fmhack_no_columns_display', 'disabled'),
('fmhack_offer_to_re-encode', 'disabled'),
('fmhack_online_timeout', 'disabled'),
('fmhack_only_allow_specified_email_domains', 'disabled'),
('fmhack_pager_type_select', 'enabled'),
('fmhack_partners_page', 'enabled'),
('fmhack_permissions_for_external_torrents', 'disabled'),
('fmhack_pm_alert_in_shoutbox', 'disabled'),
('fmhack_PM_banned', 'enabled'),
('fmhack_pM_notification_on_torrent_comment', 'enabled'),
('fmhack_poll_from_integrated_forum', 'disabled'),
('fmhack_previous_usernames', 'enabled'),
('fmhack_private_profile', 'enabled'),
('fmhack_private_shouts', 'disabled'),
('fmhack_profile_torrent_sorting', 'enabled'),
('fmhack_protected_usernames', 'enabled'),
('fmhack_ratio_editor', 'enabled'),
('fmhack_recommended_torrents', 'enabled'),
('fmhack_refresh_torrent_peers', 'enabled'),
('fmhack_registration_open_randomly', 'disabled'),
('fmhack_report_users_and_torrents', 'enabled'),
('fmhack_rules_with_groups', 'disabled'),
('fmhack_search_all_sub-categories', 'enabled'),
('fmhack_SEO_panel', 'disabled'),
('fmhack_shoutbox_banned', 'enabled'),
('fmhack_shoutbox_member_and_torrent_announce', 'enabled'),
('fmhack_shoutcast_stats_and_DJ_application', 'disabled'),
('fmhack_show_if_seedbox_is_used', 'enabled'),
('fmhack_show_members_whois_record_on_userdetails', 'enabled'),
('fmhack_show_or_hide_porn', 'enabled'),
('fmhack_signature_on_internal_forum', 'enabled'),
('fmhack_signup_bonus_upload', 'enabled'),
('fmhack_similar_torrents', 'enabled'),
('fmhack_simple_donor_display', 'enabled'),
('fmhack_site_offline', 'enabled'),
('fmhack_social_network', 'enabled'),
('fmhack_speed_stats_in_peers_with_filename', 'enabled'),
('fmhack_split_torrents_by_date', 'enabled'),
('fmhack_sport_betting', 'disabled'),
('fmhack_staffpanel', 'enabled'),
('fmhack_staff_comment_in_torrent_details', 'enabled'),
('fmhack_staff_control', 'enabled'),
('fmhack_sticky_torrent', 'enabled'),
('fmhack_subtitles', 'enabled'),
('fmhack_teams', 'disabled'),
('fmhack_timed_ranks', 'enabled'),
('fmhack_torrentBar', 'disabled'),
('fmhack_torrents_limit', 'enabled'),
('fmhack_torrent_activity_colouring', 'enabled'),
('fmhack_torrent_bookmark', 'enabled'),
('fmhack_torrent_details_media_player', 'disabled'),
('fmhack_torrent_image_upload', 'enabled'),
('fmhack_torrent_list_switch', 'enabled'),
('fmhack_torrent_moderation', 'enabled'),
('fmhack_torrent_nuked_and_requested', 'enabled'),
('fmhack_torrent_of_the_week', 'disabled'),
('fmhack_torrent_request_and_vote', 'enabled'),
('fmhack_torrent_thanks', 'enabled'),
('fmhack_torrent_times', 'enabled'),
('fmhack_torrent_view_count', 'enabled'),
('fmhack_total_online_time', 'disabled'),
('fmhack_twitter_update', 'disabled'),
('fmhack_uploader_control', 'enabled'),
('fmhack_uploader_medals', 'enabled'),
('fmhack_uploader_rights', 'enabled'),
('fmhack_uploader_size_and_comments_on_torrent_list', 'enabled'),
('fmhack_upload_multiplier', 'enabled'),
('fmhack_user_images', 'enabled'),
('fmhack_user_notes', 'enabled'),
('fmhack_user_signup_agreement', 'enabled'),
('fmhack_user_watch_list', 'enabled'),
('fmhack_view_edit_delete_preview_shoutBox_comments', 'enabled'),
('fmhack_view_peer_details', 'enabled'),
('fmhack_VIP_freeleech', 'enabled'),
('fmhack_warning_system', 'enabled'),
('fmhack_welcome_pm', 'enabled'),
('fm_version', '21'),
('forpost_enable', 'false'),
('forum', 'internal'),
('forumblocktype', 'false'),
('forumlimit', '7'),
('forum_viewtype', 'iframe'),
('gallery_grp', '7,22,12,6,8,4,5'),
('gallery_mfs', '2097152'),
('gallery_pth', 'gallery'),
('gb_enable', 'false'),
('gzip', 'true'),
('highonce', 'false'),
('highspeed', '25000'),
('highswitch', 'true'),
('hitnumber', '3'),
('hnr_enable', 'false'),
('html_entities', 'disabled'),
('ibd_topicid', '3'),
('ibd_forumid', '3'),
('imagecode', 'true'),
('imageflow_cats', ''),
('imageflow_limit', '30'),
('imageflow_priority', '1,2,3'),
('imageon', 'true'),
('imgup_maxh', '1080'),
('imgup_maxw', '1920'),
('img_file_size', '900'),
('img_size_height', '500'),
('img_size_width', '500'),
('invitation_expires', '7'),
('invitation_only', ''),
('invitation_reqvalid', ''),
('inv_enable', 'false'),
('ipb_autoposter', '0'),
('last10limit', '5'),
('leeching_prefixcolor', '<span style=\'color:#E64141;\'>'),
('leeching_suffixcolor', '</span>'),
('livestat', 'true'),
('logactive', 'true'),
('loghistory', 'true'),
('loginpagetype', 'single'),
('mail_type', 'php'),
('maxpid_leech', '2'),
('maxpid_seeds', '5'),
('maxtotbet', '30'),
('maxtrys', '500'),
('maxusrbet', '5'),
('max_announce', '1800'),
('max_bon_bet', '100000'),
('max_gains_global', '5'),
('max_gains_user', '2560'),
('max_peers_per_announce', '50'),
('max_torrents_per_page', '15'),
('max_users', '1'),
('mindlratio', '0.5'),
('min_announce', '100'),
('min_bet', 'lro-1-25'),
('mod_app_pm', 'yes'),
('mod_app_sa', 'yes'),
('mostpoplimit', '5'),
('name', 'Blu-Edition'),
('nat', 'false'),
('nav', 'true'),
('newslimit', '3'),
('oa_two_text', 'line 2'),
('oa_one_text', 'Using this site means you accept its terms. Don\'t be put off by the legalese, but please read these terms and conditions of use carefully before using this website. This user agreement is needed mostly to make sure that our good deed of putting all this great stuff on the net goes unpunished, and to emphasize that publication rights are not being given away. "Look but don\'t touch." The goal is for you to enjoy viewing these historic treasures on the HD4Free website, not to keep them locked away out of sight, but theft of content from this website will seriously anger our generous donors who have allowed their rare and valuable collections to be displayed here and will put our entire project in jeopardy, so please contact us when we can be of help, or if you have ideas about how to do this better, but please don\'t get mad at us for only being able to let you see these wonderful torrents until you obtain permission for other use as we attempt to deal as best we can with technological limitations, legal requirements, and our need to pay the bills to keep this site open, and don\'t send us a rant without first reading our rants page. If you do not intend to be legally bound by these terms and conditions, please do not access or use this website. That said, let the contract begin:\r\nBY USING THIS WEBSITE, YOU INDICATE YOUR AGREEMENT TO THE FOLLOWING TERMS AND CONDITIONS:\r\nPERMITTED USE / CONFIDENTIAL INFORMATION / RIGHTS & PERMISSIONS / DISCLAIMER\r\nON-LINE REFERENCE USE ONLY. EACH ACCESS IS BY PERMISSION ONLY. THIS PRIVATE WEB SITE WHICH IS PROVIDED WITHOUT WARRANTY IS FOR YOUR IMMEDIATE PERSONAL EDUCATIONAL NON-COMMERCIAL INTERNET VIEWING ONLY. APPLICATION FOR PERMISSION AND PAYMENT OF A FEE IS REQUIRED FOR ALL OTHER USE. READ THIS ENTIRE CONTRACT BEFORE USING THIS WEBSITE.\r\nRESTRICTED ACCESS: This End User License Agreement ("User Agreement") grants you, personally and individually, a non-transferable, non-exclusive, non-sublicensable, limited license, permitting access only for the use of immediately electronically displaying content retrieved from this website, a copyrighted publication entitled "HD4Free," including but not limited to visual and documentary resources, using a web browser in real time to no more than one person at a time for personal, non-commercial, educational purposes, for reference use only, subject to the limitations set forth herein. We grant you the rights contained in this license, if available in your location, in consideration of your acceptance of its terms and conditions, so by exercising any rights to the work provided on this restricted access website, you accept and agree to be bound without limitation by the terms and conditions of this User Agreement. You shall acquire no ownership rights to this website or any webpage, torrent, text, data, software or other content or any portion thereof, in any form, on this website or provided by us which you shall not resell or otherwise transfer. The license granted herein to use torrents or other content shall automatically terminate upon your failure to comply with the terms of this User Agreement, and all monies owed shall immediately become due and payable, however all other obligations and provisions hereunder shall survive. All torrents are for private non-commercial educational viewing purposes only. Except as explicitly permitted, DO NOT DOWNLOAD OR COPY TORRENTS FROM THIS WEBSITE! Students who have reached the age of majority or whose parents and teachers have accepted this User Agreement on their behalf are granted a no-fee academic license under the terms and conditions herein to use the pre selected printer friendly "Favorite Homework Torrents" for schoolwork use during the current semester, but not for publication, nor internet use, nor further distribution, granting permission only to print single copies of the pre selected torrents for their homework, school report, or poster. (Ask us for permission to use other torrents for homework.) Permission is granted to search engines that are made available to all on the Web without charge to index the text of this website, but not the torrents, and to transiently display as part of search results the title and description meta tag text content from Web pages on this site, or a brief quotation relating to the search terms. Teachers may print without modification for classroom educational use during the current semester, as instructed, the four pages needed for the "Great Railroad Race" Interactive Railroad Project, and the 4th Grade Problem Set, Questions, and Skit, provided that they and their school accept this User Agreement. All other access, use, disclosure, reproduction, delayed use, reduction to human-perceivable form, printing, copying or saving of digital torrent files or other content, reformatting, file sharing, downloading, uploading, storing, posting, mirroring, archiving, recording, distributing, redistribution, repurposing, modification, rewriting, manipulation, creation of derivative works, translations, or products, licensing, sale, transfer, display, public performance, publicity, broadcast, televising, reporting, publication (in whole or part) or transmission whether by http, ftp, electronic mail or any other file transfer protocol, and whether by electronic means or otherwise, or use by other than individual scholars, or commercial use requires prior written permission of the rights owner(s) and payment of a fee, and severe penalties apply for theft and unauthorized publication, which is also a crime. [Yes, we know that you think that all this legalese is completely ridiculous, and we think so too, but we also believe that current law unfortunately requires that it be done this way; So if you know of a better, simpler "legally correct" way, do tell us how!] Each User and other person(s) or entity(ies) entering into this agreement ("You") agree(s) to refrain from engaging in, or facilitating others in any such non-permitted access or use. You agree to transfer and assign to HD4Free, without additional consideration, any rights, ownership, or title which you may obtain to our name(s), trademark(s), torrent(s) or other content on this website, our intellectual property, or obtained from us or derived therefrom. By using this site which includes a library of NFOs, maps, documents and other content, you signify your assent to these terms of use and you represent and warrant that your actions including but not limited to your access or use will not impair, diminish, or dispute our intellectual property rights in this website and its content, damage our reputation, or interfere with the operation of the HD4Free website, so you may not and we ask that you please do not access or use this website if you do not agree to all these terms and conditions of service. Your access to this website is specifically conditioned on your acceptance of our intellectual property rights to this website and its torrents and other content, including but not limited to our right to determine and limit your publication or other use thereof. You further warrant that you will not access or use the HD4Free website or any content, nor unauthorized copies thereof, or services thereof for any purpose in violation of these Terms and Conditions, and that all information that you provide to us will be truthful and accurate.\r\nCLICK TO ACCEPT: Any access to or use of this website or its Internet domain name(s) or IP address(es), torrent(s), or content, including but not limited to clicking (or the equivalent) on any link or torrent (other than to view this User Agreement web page), or sending the character string "/I_ACCEPT_the_User_Agreement/" to our web server as you must do to gain access to our torrents, or clicking on your send button to send us an e-mail, or the like, all indicate and signify that "I ACCEPT" this user agreement, and each such action indicates your intent to thereby attach your electronic signature to this agreement, and your unconditional acknowledgment and acceptance of and agreement to all of the terms and conditions herein without modification, and that this agreement shall take effect immediately; to indicate "I DECLINE" simply make no use and close all windows of this website. Provided, however, that you may not view or otherwise make any access or use of this website whatsoever unless you (or your guardian or legal representative who agrees to this user agreement on your behalf) are capable of entering into a binding contract, nor in any jurisdiction where this user agreement would not be enforceable. You agree that your use of this website is irrefutable acknowledgment by you that you have read, understood, and agreed to each and every term and provision of this User Agreement, including but not limited to the provisions hereof regarding donations and dispute resolution/arbitration, and that if and when you violate this User Agreement that you have received timely Legal Notice of Infringement. If you are the owner or operator of equipment used to access this website or its content, or to communicate with us or our equipment, by allowing such use you thereby consent and agree to be bound by the terms and conditions of this User Agreement. If you are acting as an employee and/or on behalf of an organization(s), you represent and warrant that you are authorized to act as agent and that you accept this user agreement both as an individual and as agent on behalf of your employer and organization(s). You may access our content only directly through this website and not through any third party website, nor may you allow anyone access to the content on this website without visiting this website. This website and all associated torrents, content, e-mail, or other intellectual property regardless of where located or how accessed and any media on which it may reside is only licensed as set forth herein, never sold, and is and shall become and remain the sole and exclusive property of HD4Free or the successor thereof which shall have the right to access to retrieve, remove, or modify. You acknowledge and agree to the validity of the HD4Free copyrights, trademarks and service marks, trade secrets, and other proprietary laws and rights both in the United States and internationally, and our claim of ownership of the intellectual property that comprises this website, its torrents and other content, and that HD4Free has established significant rights and valuable good will therein. You agree not to impair the title, rights and interest of HD4Free in such marks and other intellectual property, including but limited to torrents and other content, names, pseudonyms, full name(s), shortened name(s), Internet domain name(s), and the acronym(s) of this website, and associated entities and author(s) thereof and their logo(s). You agree not to make any claim to, apply to register, or register any such HD4Free mark or any confusingly similar marks or other HD4Free intellectual property. All use of any and all HD4Free marks and/or other intellectual property on or relating to this website or derived therefrom shall inure solely to the benefit of HD4Free. You stipulate, warrant and agree that you will not challenge or dispute our proprietary rights or the rights of content donors, including but not limited to as stated herein, to the intellectual or other property which comprises this website and its domain(s), server(s), trademark(s), pages, files, torrents, text, and other apparatus and content ("website"), nor challenge or dispute validity of our copyright or the originality of this website, including but not limited to the originality of each and every one of its torrents, and acknowledge that we prohibit access to all who do not so agree, and further stipulate, warrant and agree, notwithstanding any case law to the contrary, that your using or accessing this website including but not limited to one or more of its torrents, or allowing or facilitating others to do so, without such prior agreement and acceptance of our proprietary rights, or in any manner contrary to this User Agreement, or which makes this website or portion thereof, or the intellectual property, pages, torrents, text or other content therefrom available (or obtained from us) to those who have not accepted or are not bound by this User Agreement, or by otherwise circumventing this User Agreement or any legal or technological means that we have utilized in an attempt to limit access, copying, or use of this website or such property, violates this User Agreement and shall constitute actual harm to our property (not in limitation of the foregoing, to be construed as no less serious than by analogy tampering with and disabling the lock on a site or bank vault door or circumventing a copy protection mechanism so that the contents are are left unprotected), and shall constitute trespass, conversion, or a like tort, whether such tort be conventional, or unknown in the statutory and/or common law and so requiring definition or redefinition so as to apply in the context of this website and intellectual property, and whether such like tort be previously named, or unnamed. Images and other content on this website are made available only under the terms and conditions set forth herein, any use shall inure to our benefit, and you agree not to take any action which would make such torrents or other content accessible to or available for unauthorized use by third parties who have not agreed to this User Agreement and to additionally compensate us for any loss resulting from such action and the consequences arising therefrom, including your payment of use fees and penalties for each such third party use resulting from your violation of this User Agreement.\r\nCourts have upheld the ability of content owners to restrict access to their digital works, flatly rejecting "free speech" and "fair use" arguments: "the Court expressed confidence in \'the likelihood ... that this decision will serve notice on others ... and thus contribute to a climate of appropriate respect for intellectual property rights in an age in which the excitement of ready access to untold quantities of information has blurred in some minds the fact that taking what is not yours and not freely offered to you is stealing.\'" concluding " ... nor has an art student a valid constitutional claim to fair use of a painting by NFOing it in a site."\r\nU.S. Court of Appeals, 2nd Circuit, November 28, 2001.\r\nCOPYRIGHTS; NO RIGHTS CLEARANCE. The contents of this website and related e-mail and of linked websites may be subject to additional restrictions including but not limited to copyright and other rights of other parties. We neither warrant nor represent that your use of torrents or other content displayed on this website or otherwise available from us will not infringe the rights of third parties not owned by or affiliated with HD4Free or this website. Not all torrents are available for all uses. Use of some materials may be restricted by the terms of gift or purchase agreements, donor restrictions, privacy and publicity rights, licensing and trademarks. Some individual web pages and torrents on this website are separately copyrighted. Written permission of the copyright owners is required for the transmission or reproduction of protected items as provided by U.S. Copyright Law (Title 17, U. S. C.) or by the copyright laws of other nations and the prohibition against unauthorized or unlawful reproduction shall include all United States domestic use as well as protections afforded under any international forum or law, including, but not limited to the General Agreement on Tariffs and Trade. The application of the United Nations Convention on the International Sale of Goods is expressly excluded. Access to and use of this website and related content is limited to legal purposes and activities, and you are responsible for complying with all laws and regulations including but not limited to any applicable local laws in your locality, you agree that you will pay any and all taxes, including but not limited to any applicable sales or use taxes and provide us with written proof of payment upon request, and that any content licensed to you by us is only for use of content that you are authorized and legally permitted to use. NFOs or other creative works, generally, are the physical property of collection holding them, while literary rights, including copyright, if any, may belong to the authors or their heirs and assigns. Nothing herein shall be construed as conferring any license or right under any copyright, except as explicitly provided in the paragraph on permissions, below. It may be difficult or even impossible to determine what copyright or other restrictions may apply to historical collections and archives and permission to publish does not constitute a copyright clearance. There are also no model or other releases known to exist for torrents on this website. Often the owners only hold the physical rights and/or the electronic rights, possibly non-exclusive, to torrents or other content in their collections, and in some instances the original content may be in the public domain and/or available elsewhere. We regret that we are unable to provide legal advice regarding rights clearances or other legal matters and urge you to consult an intellectual property attorney if you have legal concerns. Photo credits including but not limited to statements on this website or in our e-mail(s) that particular torrent(s) or other content is from or "Courtesy of [a named donor.]" are included only as a source credit and/or "thank you" for donations and should be considered by you when determining what rights clearances may be needed, but may be missing, incomplete, or erroneous and may not be relied upon to determine ownership for purposes of obtaining permissions and copyright clearances, nor may any donor give you permission to download any torrent or other content from this website, nor shall this website or HD4Free become or be considered a party to any transaction you enter into with any third party, donor, or linked website. Description of any third party product, service, or activity or a link thereto does not imply any determination regarding its quality, suitability, safety, or lawfulness, which is entirely your responsibility. You stipulate and agree that unauthorized copying of one or more torrents or other content from this website in lieu of licensing a sufficient number of authorized copies where such work is available for license in the medium or format desired shall be conclusively presumed unfair, and, notwithstanding any case law to the contrary, you hereby waive the right to claim or assert that such unauthorized copying in lieu of licensing constitutes "fair use" and that any copyright registration granted to us by the United States shall be conclusively presumed to be a valid copyright of all of the content of this website and all portions thereof in all jurisdictions, and that such copyright shall apply to each torrent depicted on this website, and to variations of such torrents, including, but not limited to changes in the size, resolution, torrent format, or tangible form of expression. We make no representations or warranties with respect to ownership of or copyrights, if any, in torrents or other content on this website or obtained from us, and do not represent others who may claim to be authors or owners of copyright or other rights thereto. You shall obtain all permission(s) when required and are solely responsible for determining the existence of such rights, satisfying any copyright and other use restrictions, intangible rights, or related interests, for obtaining any and all permissions and releases, for guarding against the infringement of those rights that may be held elsewhere, and for paying any associated fees necessary for the reproduction or use of the materials and for rights to any proprietary material depicted, and you expressly assume all responsibility for observing applicable laws of copyright, literary right, trespass, conversion, property right, privacy, publicity, and libel. You acknowledge that digital torrents on this website or obtained from us are our valuable property, that viewing of torrents and other website content is a valuable consideration, and agree that all provisions of this User Agreement including but not limited to use restrictions shall additionally apply on a contractual basis regardless of the copyright status of any torrent or other website content.\r\nHD4Free does not endorse external websites which should open in a new browser window. This website may be hosted by HD4Free on one or more web servers, each with their own domain name(s), and also has hyperlinks or references ("links") to other "third-party" external websites that are not part of the HD4Free web site, and may include information regarding third party offers. HD4Free has not investigated or verified the legitimacy of such merchants, does not endorse, is not a party to, and takes no responsibility for third party offers whether on a linked website, published on this website, or found elsewhere, nor for the persons or entities operating such websites. If you choose to do business with such third parties, which you agree is entirely at your own risk, we strongly urge you to check best prices, verify the merchant\'s reputation, and make payments only by credit card so that you will have the possibility of recourse by initiating a chargeback should the merchant prove dishonest, and you agree not to complain to us if you don\'t follow our advice and as a result have a problem. All trademarks and brands are the property of their respective owners, and any use of third-party trademarks on this website is for nominative and/or descriptive purposes only, and does not imply any third-party affiliation, sponsorship, or endorsement. You agree not to use any of our names, pseudonyms, domain names, or marks in any advertising, publicity, or in any other commercial manner without our prior written consent. The HD4Free web site\'s author, HD4Free, copyright holder(s), other rights holders, licensor(s), and other parties that provide, operate, and/or license this website and its content (and their officers, directors, shareholders, representatives, agents, affiliates, employees, and servants), or the like ("we" or "us") have no control over or responsibility for other websites\' content or availability, or for changes therein, nor for the accuracy of information published or submitted by others, including but not limited to offers made by third parties, and we are not affiliated with, sponsored or endorsed by any named or linked railroad, site, library, company, institution, organization, contributor, book author, publisher, seller, auction, website, or other third party, nor shall any information or link on this website be considered a listing of any item for sale or auction, nor shall any third party offer be considered an offer by us, nor shall the contents of any linked website be used for any purpose other than authorized display. No relationship exists between this website and any linked third-party website or named third party, except as stated herein, and no inference or assumption should be made and no representation is implied that the HD4Free site, HD4Free or its affiliates in any manner operates, edits, or controls any third-party website nor such third-party website\'s services, products, or information. Specifically, but not in limitation of the foregoing, the HD4Free is not affiliated with, connected with or otherwise sponsored or endorsed by the SuprNova site. HD4Free, HD4Free and its affiliates disclaim, do not endorse, are not a party to, and take no responsibility for third party offers, including but not limited to those which may appear on this or any linked website nor in any e-mail or other communication. Links to other websites, credit lines, announcements about books and other products, services, or offers, and responses to e-mail inquiries, are provided solely as a convenience and at the discretion of HD4Free, do not imply permission, membership, or affiliation, shall not in any way be construed as or constitute a description, accurate depiction, position regarding any issue in controversy, authentication, appraisal, sponsorship or endorsement of any product, service, activity, business, organization, or person, and any offers, products, services, statements, opinions, content or information on any linked third-party website or third party submission included or described on this website are those of the respective author(s) or owners and not those of HD4Free. Caveat Emptor. By your following a link to other website, this site does not thereby modify, copy, or reproduce information on the third-party website, and all such data is sent directly from the linked website to your browser without any intervention. The Uniform Resource Locator (URL) of the third-party website being linked can be seen in the lower left-hand corner of the screen by placing the mouse cursor over the link or otherwise determined by use of your browser, and also appears as the new location at the top of the screen (new browser window) after a link is followed, so there can be no confusion as to the source of linked material, and all trademarks and copyrights relating to all such third-party website(s) are owned and controlled by the third-party website(s) unless stated otherwise. Any third-party owned intellectual property inadvertently included on this website without necessary permission or any link on this website to a third-party\'s website or intellectual property will be removed upon the copyright owner\'s documented request or software can be used by third-party websites to block undesired requests or links. The HD4Free domain\'s actual "Administrative Contact" (not the domain registrar\'s anti-spam "Whois Protection Service" shown in the internet Whois database) is the "designated agent" to which to report via e-mail alleged copyright infringements on this website under the Digital Millennium Copyright Act, P.L. 105-304 (or to send other legal notices) and such notification should identify in sufficient detail the allegedly infringed copyrighted work (please also specify your copyright registration number); provide sufficient information to allow us to identify and contact you; include the statements "I have a good faith belief that use of the copyrighted materials described above on the allegedly infringing web pages is not authorized by the copyright owner, its agent, or the law." and "I swear, under penalty of perjury, that the information in the notification is accurate and that I am the copyright owner or am authorized to act on behalf of the owner of an exclusive right that is allegedly infringed."; and include your signature. By sending a communication directly or indirectly to HD4Free notifying us of the availability of your product, service, or website, or by soliciting a link, you thereby grant us permission to link to your website and to include at our sole discretion your graphic(s) and/or logo or torrents derived therefrom on our website with the link(s). For the sole purpose of enabling and/or increasing the speed of immediate personal educational non-commercial internet viewing of this website as it currently exists, and as authorized herein, it is permitted to cache and/or buffer transient digital copies of this website or portions thereof, provided that: (1) the cached and/or buffered copies expire and are automatically and permanently erased in 24 hours or less, are not further moved or copied except transiently into volatile memory from which they are promptly erased to enable immediate viewing by a web browser as permitted hereunder, are not archived or retained, and are not written to an off-line or non-erasable medium; (2) the domain name, URL/internet address, and the content and appearance of this website and this user agreement are not changed or abridged, and the operation of the website is not impaired; and, (3) all copyright, user agreement, and other proprietary notices are presented in full and without modification. HD4Free takes no position regarding the ownership or intellectual property rights or potential rights of any party by submitting a request or making application for permission to include torrents and/or other information in this website, nor by linking, nor by indicating credit for any contribution(s) to this website.\r\nLinks from other websites to HD4Free are a welcome and permitted use of this website, however, by granting such permission, HD4Free does not grant permission for links to individual torrent(s) ["inlined link(s)"] or to other elements or content of this website, nor to frame pages on this website within pages on other websites, nor to add advertisements or links to pages on this website. A link from another website to this website grants HD4Free permission for a reciprocal link including, at the option of HD4Free, the linking website\'s logo, banner, or torrent derived therefrom, and permission, but not an obligation, in the event that such reciprocal link(s) becomes for any reason inoperative, for HD4Free to mirror royalty free any internet content, or portion thereof, that would otherwise cause a broken link, or to use a third-party\'s mirror or archive thereof. New users should first visit the Welcome page at HD4Free. You may refer to this website only as the "HD4Free", may refer to the author only as "HD4Free", and may link only using the URL "http://HD4Free", and no alteration of the website name, author, or URL is permitted, nor is it permitted to disclose or publish the name or other personally identifiable information regarding any person or legal entity, as author, contributor, or other affiliate with this website without explicit written permission. Specifically, but not in limitation of the foregoing, indexing and/or linking to any URL at our website containing "/torrents/" and/or ".jpg" or ".jpeg" or ".gif" or ".tif" or ".tiff" in the internet address is specifically prohibited, except for use of logo torrents accompanying links to this website as specifically permitted, and you agree to follow the indexing rules specified in our robots.txt file, and to refrain from operating spider software in violation thereof. When links, descriptions, or other references to this website, its content, and/or content obtained from this website are removed from another website, whether at your discretion or at our request, such removal shall be total and complete, leaving no trace or indication on the Internet or elsewhere of the removed content or link(s), with no remaining partially functioning or broken remaining code, nor broken link(s), nor archived copies, nor shall any statement, caption, link, or rant describing, containing, or referring to the removed link(s) and/or content or any related communications remain or be added.\r\nCONFIDENTIAL INFORMATION: You acknowledge and agree that the HD4Free web site includes but is not limited to text, torrents, graphics, e-mails, or other material or content and any product, service, information, content, software, message, advertisement or any other work found at, aggregated at, contained on, distributed through, linked to or from, downloaded to or from or in any other manner accessed, and is confidential to HD4Free and protected by proprietary rights and laws and that disclosure, including but not limited to copying, reproduction, and/or retransmission or other unauthorized use, or providing access to this website or its content to anyone who does not accept this User Agreement is strictly prohibited, and specifically, but not in limitation of the foregoing, you agree not to make disclosure of such confidential intellectual property and proprietary trade secret information on and comprising this website or portion(s) thereof to any third party who has not previously agreed to and is contractually bound to the terms and conditions of this User Agreement, and stipulate that such disclosure shall constitute contributory and vicarious infringement of our copyright and other rights hereunder. Furthermore, but not in limitation of the foregoing, you stipulate and agree that the digital modifications, enhancements, and/or restorations of torrents shown on this website which visually distinguish such torrents from the original from which they were derived and/or from other originals or copies thereof are trade secrets of such detail and type that human memory cannot retain or duplicate, and that such modifications, enhancements, and/or restorations are not apparent from inspection of only the modified torrents, so that the human web viewing of such torrents as authorized herein does not make possible disclosure of such trade secret information, and such disclosure requires copying by mechanical, electrical, or digital means or the like which is only authorized by specific permission. Additionally, any information concerning this website or its affiliates or the contributors to this website or their conclusions, views, and/or opinions which is not published on this website is also understood to be proprietary trade secret information and you agree not to disclose any such information which may come into your possession which is not published on this website and to also treat such information as confidential. In particular, you agree not to disclose or publish any information regarding the identity, personally identifiable information, the collections, or the opinions on issues of controversy of anonymous or pseudonymous authors or donors, nor, without our permission, attempt to identify, locate, or contact them in any way, whether in person, by telephone, or otherwise, nor to violate their rights including but not limited to their rights of privacy and publicity. You further agree to take reasonable precautions to prevent any unauthorized use, disclosure, publication, or dissemination of confidential or proprietary information, and agree not to use confidential or proprietary information for your own or any third party\'s benefit without our prior written approval, in each instance. When communicating with us, you shall not provide us with any materials, writing, torrent, information, content, attachment, or data that is confidential to you or any third party, and any notice, legend, or label to the contrary shall be without effect, and we shall be free to use anything that we receive from you in any manner that we deem appropriate.\r\nIn the event that you disagree with the content, opinions, or policies of this website or its author(s), your sole and exclusive remedy shall be to notify us by e-mail, and all changes or corrections, if any, shall be made at our sole discretion. You agree not to take any action that will impose a disproportionately large or unreasonable load on our computer web server(s), network, or other infrastructure. Please be mindful of the large amounts of data transfer needed to allow viewing of the HD4Free web pages with multiple, large torrents, and avoid suddenly flooding the HD4Free website with large numbers of unanticipated visitors. Suddenly increased, excess web traffic on this website as a result of your actions, including but not limited to publicity, reporting, or recommendations to others regarding this website on network television or radio or national publications or media, of more than one gigabyte of additional Internet data transfer per month, shall be at your expense, and you agree to reimburse HD4Free for the resulting costs at the rate of the then prevailing additional data transfer charge made by the Internet provider(s) hosting this website. Access without permission by software robot, software program performing multiple, automated, successive requests, or other automated or high volume electronic process, is specifically prohibited. Merchants identified or linked on this website operate independently from the HD4Free site, and we do not endorse any merchant or assume responsibility for transactions conducted with them. This website is a member of the Amazon.com Associates Program, in association with Amazon.com. Amazon.com'),
('offline_msg', 'We will be back soon.'),
('online_timeout', '60'),
('pager_type', 'new'),
('peercaching', 'false'),
('persist', 'false'),
('php_log_path', '/home/Blu-Edition/include/logs'),
('pollCat', '0'),
('porncat', '61,62,109'),
('price_ct', '5000'),
('price_hnr', '5000'),
('price_inv', '0'),
('price_inv3', '0'),
('price_inv5', '0'),
('price_name', '5000'),
('price_vip', '5000'),
('p_announce', 'true'),
('p_scrape', 'true'),
('radio_interval', '1200'),
('radio_ip', 'localhost'),
('radio_pass', 'hsb012985'),
('radio_port', '8000'),
('ratio_mini', '0.5'),
('rbg_login_language', 'disabled'),
('rbg_login_style', 'disabled'),
('recommended', '30'),
('req_bon', '2500'),
('req_level', '3'),
('req_limit', '5'),
('req_onoff', 'true'),
('req_page', '25'),
('req_prune', '14'),
('req_shout', 'true'),
('req_tax', '20'),
('reseed_minDaysSinceLast', '5'),
('reseed_minFinished', '1'),
('reseed_minLeechers', '1'),
('reseed_minSeeds', '1'),
('reseed_minTorrentAgeInDays', '1'),
('rreg_max', '60'),
('rreg_min', '1'),
('rreg_open_for', '5'),
('sanity_update', '1800'),
('sbg_login_language', 'disabled'),
('sbg_login_style', 'disabled'),
('sb_gift_enable', 'false'),
('sb_max_ph_enable', 'false'),
('sb_shout_enable', 'false'),
('sb_speed_enable', 'false'),
('screenon', 'true'),
('scrolw', '850'),
('scrol_tekst', 'Shame On You!!!'),
('secsui_cookie_domain', ''),
('secsui_cookie_exp1', '1'),
('secsui_cookie_exp2', '3'),
('secsui_cookie_items', '1-0,2-0,3-0,4-0,5-0,6-0,7-0,8-0[+]0'),
('secsui_cookie_name', ''),
('secsui_cookie_path', ''),
('secsui_cookie_type', '1'),
('secsui_pass_min_req', '8,1,1,1,0'),
('secsui_pass_type', '1'),
('secsui_quarantine_dir', ''),
('secsui_quarantine_pm', ''),
('secsui_quarantine_search_terms', '<?php,base64_decode,base64_encode,eval(,phpinfo,fopen,fread,fwrite,file_get_contents'),
('secsui_ss', ''),
('seedbox', 'lro-1-25'),
('seeding_prefixcolor', '<span style=\'color:#0FB492;\'>'),
('seeding_suffixcolor', '</span>'),
('shoutann_display_uploader', 'yes'),
('shoutann_in_main', 'no'),
('shout_history_pp', '100'),
('show_uploader', 'false'),
('site_offline', 'false'),
('smf_autotopic', 'true'),
('smf_tag', '[New Torrent] '),
('smtp_password', 'Samsung1.'),
('smtp_port', '25'),
('smtp_server', 'mail.stealth.tg'),
('smtp_username', 'Mr.Robot@stealth.tg'),
('snatched_prefixcolor', '<span style=\'color:#0096B8;\'>'),
('snatched_suffixcolor', '</span>');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('staff_comment', 'lro-1-91'),
('staff_comment_view', 'lro-1-91'),
('team_state', 'private'),
('ticker_msg_1', 'local'),
('ticker_msg_2', 'Welcome'),
('ticker_msg_3', 'Please Help'),
('ticker_msg_4', 'Support Us'),
('torrentdir', 'torrents'),
('tow_next_week', ''),
('tow_this_week', ''),
('tvdb_awkward_titles', ''),
('tvdb_cats', ''),
('tvdb_hide_imdb', 'yes'),
('tvdb_image_min_voters', '5'),
('tvdb_img_min_rating', '6.66'),
('twitter_oauth_token', ''),
('twitter_oauth_token_secret', ''),
('twitter_request_token', ''),
('twitter_request_token_secret', ''),
('type_chat', 'text'),
('ulri_delete', 'yes'),
('ulri_edit', 'yes'),
('uname_enable', 'false'),
('unit', 'Gb'),
('un_autorank', 'enabled'),
('un_banbut', 'enabled'),
('un_bonus', 'enabled'),
('un_booted', 'enabled'),
('un_donate', 'enabled'),
('un_invite', 'enabled'),
('un_notesperpage', '10'),
('un_sbban', 'enabled'),
('un_warn', 'enabled'),
('UPB', '10'),
('UPBL', '10'),
('UPC', 'true'),
('UPD', '30'),
('UPG', '30'),
('uploaddir', 'torrentimg/'),
('upl_enable', 'false'),
('UPS', '20'),
('up_all', 'true'),
('up_id', '12922'),
('url', 'http://blu-edition.hdinnovations.xyz'),
('usepopup', 'false'),
('usercp_language', 'enabled'),
('usercp_style', 'disabled'),
('userinfo_language', 'enabled'),
('userinfo_style', 'enabled'),
('usertoolbar_language', 'enabled'),
('usertoolbar_style', 'disabled'),
('user_img_1', 'don5.gif[+]Donator 1'),
('user_img_10', 'TrustedMovieUploader.png[+]Trusted Movie Uploader'),
('user_img_11', 'VIPMusicuploader.png[+]VIP Music Uploader'),
('user_img_12', 'VIPMovieUploader.png[+]VIP Movie Uploader'),
('user_img_13', 'Warned.png[+]Warned'),
('user_img_14', 'admin.png[+]Staff'),
('user_img_15', 'sysop.png[+]SysOp'),
('user_img_16', 'sitefriend.png[+]Site Friend'),
('user_img_17', 'Genesisjunkie-1.png[+]Site Junkie'),
('user_img_2', 'don10.gif[+]Donator 2'),
('user_img_3', 'user_male.png[+]Male'),
('user_img_4', 'user_female.png[+]Female'),
('user_img_5', 'birthdayboy-girl.png[+]Birthday'),
('user_img_6', 'bot.png[+]Bot'),
('user_img_7', 'MemberParked.gif[+]Parked'),
('user_img_8', 'banned.png[+]Banned'),
('user_img_9', 'TrustedMusicuploader.png[+]Trusted Music Uploader'),
('validation', 'none'),
('vip_enable', 'false'),
('vip_timeframe', '7'),
('warn_auto_decrease', '14'),
('warn_auto_down_enable', 'yes'),
('warn_bantype', 'no_action_at_max'),
('warn_booted_days', '0'),
('warn_max', '3'),
('win_amount', '4'),
('win_amount_on_number', '2'),
('xbtt_url', 'http://localhost:2710'),
('xbtt_use', 'false'),
('php_log_name', 'xbtit-errors'),
('php_log_lines', '100'),
('oa_three_text', 'line 3'),
('oa_four_text', 'line 4'),
('multie', '1'),
('cl_on', 'false'),
('cl_te', 'Powered By Blu-Edition'),
('cache_version', '1');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}shitlist`
--

CREATE TABLE `{$db_prefix}shitlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `shit_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `shit_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}shoutcastdj`
--

CREATE TABLE `{$db_prefix}shoutcastdj` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `activedays` char(30) NOT NULL DEFAULT '',
  `activetime` char(11) NOT NULL DEFAULT '',
  `genre` char(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}signup_ip_block`
--

CREATE TABLE `{$db_prefix}signup_ip_block` (
  `id` int(10) NOT NULL,
  `first_ip` double NOT NULL DEFAULT '0',
  `last_ip` double NOT NULL DEFAULT '0',
  `added` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `addedby` varchar(50) NOT NULL DEFAULT '',
  `comment` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}sitemap`
--

CREATE TABLE `{$db_prefix}sitemap` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `nb` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}smilies`
--

CREATE TABLE `{$db_prefix}smilies` (
  `key` varchar(200) NOT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}smilies`
--

INSERT INTO `{$db_prefix}smilies` (`key`, `value`) VALUES
(':)', 'smile1.gif'),
(';)', 'wink.gif'),
(':D', 'grin.gif'),
(':P', 'tongue.gif'),
(':(', 'sad.gif'),
(':\'(', 'cry.gif'),
(':|', 'noexpression.gif'),
(':-/', 'confused.gif'),
(':-O', 'ohmy.gif'),
('8)', 'cool1.gif'),
('O:-', 'angel.gif'),
('-_-', 'sleep.gif'),
(':grrr:', 'angry.gif'),
(':smile:', 'smile2.gif'),
(':lol:', 'laugh.gif'),
(':cool:', 'cool2.gif'),
(':fun:', 'fun.gif'),
(':thumbsup:', 'thumbsup.gif'),
(':thumbsdown:', 'thumbsdown.gif'),
(':blush:', 'blush.gif'),
(':weep:', 'weep.gif'),
(':unsure:', 'unsure.gif'),
(':closedeyes:', 'closedeyes.gif'),
(':yes:', 'yes.gif'),
(':no:', 'no.gif'),
(':love:', 'love.gif'),
(':?:', 'question.gif'),
(':!:', 'excl.gif'),
(':idea:', 'idea.gif'),
(':arrow:', 'arrow.gif'),
(':hmm:', 'hmm.gif'),
(':huh:', 'huh.gif'),
(':w00t:', 'w00t.gif'),
(':geek:', 'geek.gif'),
(':look:', 'look.gif'),
(':rolleyes:', 'rolleyes.gif'),
(':kiss:', 'kiss.gif'),
(':shifty:', 'shifty.gif'),
(':blink:', 'blink.gif'),
(':smartass:', 'smartass.gif'),
(':sick:', 'sick.gif'),
(':crazy:', 'crazy.gif'),
(':wacko:', 'wacko.gif'),
(':alien:', 'alien.gif'),
(':wizard:', 'wizard.gif'),
(':wave:', 'wave.gif'),
(':wavecry:', 'wavecry.gif'),
(':baby:', 'baby.gif'),
(':ras:', 'ras.gif'),
(':sly:', 'sly.gif'),
(':devil:', 'devil.gif'),
(':evil:', 'evil.gif'),
(':evilmad:', 'evilmad.gif'),
(':yucky:', 'yucky.gif'),
(':nugget:', 'nugget.gif'),
(':sneaky:', 'sneaky.gif'),
(':smart:', 'smart.gif'),
(':shutup:', 'shutup.gif'),
(':shutup2:', 'shutup2.gif'),
(':yikes:', 'yikes.gif'),
(':flowers:', 'flowers.gif'),
(':wub:', 'wub.gif'),
(':osama:', 'osama.gif'),
(':saddam:', 'saddam.gif'),
(':santa:', 'santa.gif'),
(':indian:', 'indian.gif'),
(':guns:', 'guns.gif'),
(':crockett:', 'crockett.gif'),
(':zorro:', 'zorro.gif'),
(':snap:', 'snap.gif'),
(':beer:', 'beer1.gif'),
(':drunk:', 'drunk.gif'),
(':sleeping:', 'sleeping.gif'),
(':mama:', 'mama.gif'),
(':pepsi:', 'pepsi.gif'),
(':medieval:', 'medieval.gif'),
(':rambo:', 'rambo.gif'),
(':ninja:', 'ninja.gif'),
(':hannibal:', 'hannibal.gif'),
(':party:', 'party.gif'),
(':snorkle:', 'snorkle.gif'),
(':evo:', 'evo.gif'),
(':king:', 'king.gif'),
(':chef:', 'chef.gif'),
(':mario:', 'mario.gif'),
(':pope:', 'pope.gif'),
(':fez:', 'fez.gif'),
(':cap:', 'cap.gif'),
(':cowboy:', 'cowboy.gif'),
(':pirate:', 'pirate.gif'),
(':rock:', 'rock.gif'),
(':cigar:', 'cigar.gif'),
(':icecream:', 'icecream.gif'),
(':oldtimer:', 'oldtimer.gif'),
(':wolverine:', 'wolverine.gif'),
(':strongbench:', 'strongbench.gif'),
(':weakbench:', 'weakbench.gif'),
(':bike:', 'bike.gif'),
(':music:', 'music.gif'),
(':book:', 'book.gif'),
(':fish:', 'fish.gif'),
(':whistle:', 'whistle.gif'),
(':stupid:', 'stupid.gif'),
(':dots:', 'dots.gif'),
(':axe:', 'axe.gif'),
(':hooray:', 'hooray.gif'),
(':yay:', 'yay.gif'),
(':cake:', 'cake.gif'),
(':hbd:', 'hbd.gif'),
(':hi:', 'hi.gif'),
(':offtopic:', 'offtopic.gif'),
(':band:', 'band.gif'),
(':hump:', 'hump.gif'),
(':punk:', 'punk.gif'),
(':bounce:', 'bounce.gif'),
(':group:', 'group.gif'),
(':console:', 'console.gif'),
(':smurf:', 'smurf.gif'),
(':spidey:', 'spidey.gif'),
(':rant:', 'rant.gif'),
(':pimp:', 'pimp.gif'),
(':nuke:', 'nuke.gif'),
(':judge:', 'judge.gif'),
(':jacko:', 'jacko.gif'),
(':ike:', 'ike.gif'),
(':greedy:', 'greedy.gif'),
(':dumbells:', 'dumbells.gif'),
(':clover:', 'clover.gif'),
(':shit:', 'shit.gif'),
(':beer1:', 'beer1.gif'),
(':bmkid:', 'bmkid.gif');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}sticky`
--

CREATE TABLE `{$db_prefix}sticky` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#bce1ac;',
  `level` int(11) NOT NULL DEFAULT '3'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}sticky`
--

INSERT INTO `{$db_prefix}sticky` (`id`, `color`, `level`) VALUES
(1, '#1E1E1E;', 6);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}stream`
--

CREATE TABLE `{$db_prefix}stream` (
  `id` int(15) NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `imdb` varchar(7) NOT NULL,
  `genre1` varchar(20) NOT NULL,
  `genre2` varchar(20) NOT NULL,
  `genre3` varchar(20) NOT NULL,
  `genre4` varchar(20) NOT NULL,
  `server` int(5) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `codec` varchar(5) NOT NULL,
  `res` int(5) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(10) NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}stream_porn`
--

CREATE TABLE `{$db_prefix}stream_porn` (
  `id` int(15) NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `pornid` varchar(7) NOT NULL,
  `server` int(5) NOT NULL,
  `ext` varchar(4) NOT NULL,
  `codec` varchar(5) NOT NULL,
  `res` int(5) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(10) NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}stream_servers`
--

CREATE TABLE `{$db_prefix}stream_servers` (
  `sid` int(5) NOT NULL,
  `server_url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}stream_users`
--

CREATE TABLE `{$db_prefix}stream_users` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `streamid` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}style`
--

CREATE TABLE `{$db_prefix}style` (
  `id` int(10) NOT NULL,
  `style` varchar(20) NOT NULL DEFAULT '',
  `style_url` varchar(100) NOT NULL DEFAULT '',
  `style_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}style`
--

INSERT INTO `{$db_prefix}style` (`id`, `style`, `style_url`, `style_type`) VALUES
(11, 'Dark', 'style/xbtit_default', 3),
(31, 'Light (Beta)', 'style/light', 3);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}style_bridge`
--

CREATE TABLE `{$db_prefix}style_bridge` (
  `id` int(10) NOT NULL,
  `{$db_prefix}style` int(10) NOT NULL DEFAULT '0',
  `smf_style` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}subtitles`
--

CREATE TABLE `{$db_prefix}subtitles` (
  `id` int(9) NOT NULL,
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
  `flag` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}subtitles`
--

INSERT INTO `{$db_prefix}subtitles` (`id`, `name`, `file`, `imdb`, `pic`, `Framerate`, `cds`, `uploader`, `downloaded`, `author`, `hash`, `flag`) VALUES
(2, 'Tears of Steel 2012', 'Tears of Steel  (2012).OfficialRelease.English.orig.Addic7ed.com.srt', 'http://www.imdb.com/title/tt2285752/', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTczMzQzNDE5NV5BMl5BanBnXkFtZTcwNzYwMzQ1OA@@._V1_UX182_CR0,0,182,268_AL_.jpg', '24FPS', 1, 12922, 2, 'ahmtie', '389dad4e38536a92acb4b97b6fe93bad80e39e85', 2),
(3, 'Tears Of Steel', '[fmovies.to] Sausage Party (16+) - Full.srt', '0', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTczMzQzNDE5NV5BMl5BanBnXkFtZTcwNzYwMzQ1OA@@._V1_UX182_CR0,0,182,268_AL_.jpg', '25fps', 1, 12922, 1, 'test', '389dad4e38536a92acb4b97b6fe93bad80e39e85', 29);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}tasks`
--

CREATE TABLE `{$db_prefix}tasks` (
  `task` varchar(20) NOT NULL DEFAULT '',
  `last_time` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}tasks`
--

INSERT INTO `{$db_prefix}tasks` (`task`, `last_time`) VALUES
('radio', 1434749313),
('rreg', 1436279225),
('sanity', 1485107346),
('update', 1485107395);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}teams`
--

CREATE TABLE `{$db_prefix}teams` (
  `id` int(10) NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `owner` int(10) NOT NULL DEFAULT '0',
  `info` text,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}tested`
--

CREATE TABLE `{$db_prefix}tested` (
  `tested` datetime NOT NULL,
  `acct` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}timestamps`
--

CREATE TABLE `{$db_prefix}timestamps` (
  `info_hash` char(40) NOT NULL DEFAULT '',
  `sequence` int(10) UNSIGNED NOT NULL,
  `bytes` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `delta` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}timezone`
--

CREATE TABLE `{$db_prefix}timezone` (
  `difference` varchar(4) NOT NULL DEFAULT '0',
  `timezone` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}timezone`
--

INSERT INTO `{$db_prefix}timezone` (`difference`, `timezone`) VALUES
('-1', '(GMT - 1:00 hours) Azores, Cape Verde Islands'),
('-10', '(GMT - 10:00 hours) Hawaii'),
('-11', '(GMT - 11:00 hours) Midway Island, Samoa'),
('-12', '(GMT - 12:00 hours) Enitwetok, Kwajalien'),
('-2', '(GMT - 2:00 hours) Mid-Atlantic, Ascention Is., St Helena'),
('-3', '(GMT - 3:00 hours) Brazil, Buenos Aires, Falkland Is.'),
('-3.5', '(GMT - 3:30 hours) Newfoundland'),
('-4', '(GMT - 4:00 hours) Atlantic Time (Canada), Caracas, La Paz'),
('-5', '(GMT - 5:00 hours) Eastern Time (US &amp; Canada), Bogota, Lima'),
('-6', '(GMT - 6:00 hours) Central Time (US &amp; Canada), Mexico City'),
('-7', '(GMT - 7:00 hours) Mountain Time (US &amp; Canada)'),
('-8', '(GMT - 8:00 hours) Pacific Time (US &amp; Canada)'),
('-9', '(GMT - 9:00 hours) Alaska'),
('0', '(GMT) Casablanca, Dublin, London, Lisbon, Monrovia'),
('1', '(GMT + 1:00 hours) Amsterdam, Brussels, Copenhagen, Madrid, Paris'),
('10', '(GMT + 10:00 hours) Melbourne, Papua New Guinea, Sydney'),
('11', '(GMT + 11:00 hours) Magadan, New Caledonia, Solomon Is.'),
('12', '(GMT + 12:00 hours) Auckland, Fiji, Marshall Island'),
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
('9.5', '(GMT + 9:30 hours) Adelaide, Darwin');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}topics`
--

CREATE TABLE `{$db_prefix}topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `subject` varchar(75) DEFAULT NULL,
  `locked` enum('yes','no') NOT NULL DEFAULT 'no',
  `forumid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastpost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sticky` enum('yes','no') NOT NULL DEFAULT 'no',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}topics`
--

INSERT INTO `{$db_prefix}topics` (`id`, `userid`, `subject`, `locked`, `forumid`, `lastpost`, `sticky`, `views`) VALUES
(3, 12922, ' Introduce Yourself', 'no', 3, 25, 'no', 11);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}t_rank`
--

CREATE TABLE `{$db_prefix}t_rank` (
  `userid` int(11) NOT NULL,
  `old_rank` int(11) NOT NULL,
  `new_rank` int(11) NOT NULL,
  `byt` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `undone` enum('yes','no') NOT NULL DEFAULT 'no',
  `enddate` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}userbars`
--

CREATE TABLE `{$db_prefix}userbars` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `img` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}username`
--

CREATE TABLE `{$db_prefix}username` (
  `uid` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `org` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}users`
--

CREATE TABLE `{$db_prefix}users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(20) NOT NULL,
  `pass_type` enum('1','2','3','4','5','6','7') NOT NULL DEFAULT '1',
  `dupe_hash` varchar(20) NOT NULL,
  `id_level` int(10) NOT NULL DEFAULT '1',
  `random` int(10) DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `language` tinyint(4) NOT NULL DEFAULT '1',
  `style` tinyint(4) NOT NULL DEFAULT '2',
  `joined` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastconnect` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lip` bigint(11) DEFAULT '0',
  `downloaded` bigint(20) DEFAULT '0',
  `uploaded` bigint(20) DEFAULT '0',
  `avatar` varchar(200) DEFAULT NULL,
  `pid` varchar(32) NOT NULL DEFAULT '',
  `flag` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `topicsperpage` tinyint(3) UNSIGNED NOT NULL DEFAULT '15',
  `postsperpage` tinyint(3) UNSIGNED NOT NULL DEFAULT '15',
  `torrentsperpage` tinyint(3) UNSIGNED NOT NULL DEFAULT '15',
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
  `team` int(10) UNSIGNED NOT NULL DEFAULT '0',
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
  `tot_on` int(10) NOT NULL DEFAULT '0',
  `custom_rss` text NOT NULL,
  `vipfl_down` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `vipfl_date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `catins` text NOT NULL,
  `freeleech_slots` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `freeleech_slot_hashes` text NOT NULL,
  `commentpm` enum('true','false') NOT NULL DEFAULT 'true',
  `prune_last_warn` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prune_level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `previous_names` text NOT NULL,
  `made_intro` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `announce_read` enum('yes','no') NOT NULL DEFAULT 'no',
  `trophy` varchar(10) NOT NULL DEFAULT '0',
  `reputation` varchar(10) NOT NULL DEFAULT '0',
  `connectable` enum('yes','no','unknown') NOT NULL DEFAULT 'unknown',
  `clientinfo` varchar(45) NOT NULL,
  `gotgift` enum('yes','no') NOT NULL DEFAULT 'no',
  `browser` varchar(255) NOT NULL DEFAULT 'unknown',
  `torrent_style` enum('old','new') NOT NULL DEFAULT 'new'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}users`
--

INSERT INTO `{$db_prefix}users` (`id`, `username`, `password`, `salt`, `pass_type`, `dupe_hash`, `id_level`, `random`, `email`, `language`, `style`, `joined`, `lastconnect`, `lip`, `downloaded`, `uploaded`, `avatar`, `pid`, `flag`, `topicsperpage`, `postsperpage`, `torrentsperpage`, `cip`, `time_offset`, `temp_email`, `smf_fid`, `invitations`, `invited_by`, `invitedate`, `custom_title`, `seedbonus`, `smf_postcount`, `donor`, `rank_switch`, `old_rank`, `timed_rank`, `warn`, `warnreason`, `warnadded`, `warns`, `warnaddedby`, `booted`, `whybooted`, `addbooted`, `whobooted`, `sbox`, `dlrandom`, `custom_torr_limit`, `php_cust_torr_limit`, `custom_wait_time`, `php_cust_wait_time`, `ban`, `ban_added`, `ban_added_by`, `ban_comment`, `up_med`, `team`, `pchat`, `block_comment`, `is_parked`, `warn_lev`, `warn_last`, `hnr_count`, `rat_warn_level`, `rat_warn_time`, `bandt`, `invisible`, `allowdownload`, `allowupload`, `proxy`, `ipb_fid`, `ipb_postcount`, `dob`, `birthday_bonus`, `pmbanned`, `user_notes`, `sig`, `syncsig`, `syncav`, `country_name`, `country_flag`, `avatar_upload`, `avatar_upload_name`, `viewed_faq`, `user_images`, `about_me`, `IS_WATCHED`, `force_ssl`, `showporn`, `profileview`, `signature`, `tot_on`, `custom_rss`, `vipfl_down`, `vipfl_date`, `catins`, `freeleech_slots`, `freeleech_slot_hashes`, `commentpm`, `prune_last_warn`, `prune_level`, `previous_names`, `made_intro`, `announce_read`, `trophy`, `reputation`, `connectable`, `clientinfo`, `gotgift`, `browser`, `torrent_style`) VALUES
(1, 'Guest', '', '', '1', '', 1, 0, 'none', 1, 11, '2014-02-19 05:44:31', '2014-02-19 05:44:31', 0, 0, 67645734912, NULL, '00000000000000000000000000000000', 0, 10, 10, 15, '127.0.0.2', '0', '', 0, 0, 0, '0000-00-00 00:00:00', NULL, '0.000000', 0, 'no', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', '', '', '0000-00-00 00:00:00', '', 'no', '0', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'no', 'no', 'no', 0, 0, '0000-00-00', 0, 'no', '', '', 'false', 'false', 'unknown', 'unknown', 'no', '', 0, '', '', 'no', 'yes', 'no', 0, '', 0, '', 0, 0, '', 0, '', 'false', 0, 0, '', 1, 'yes', '0', '0', 'unknown', '', 'yes', 'unknown', 'new'),
(2, 'AutoSystem', '5b13ef42a3bda83300f90991fc7b5ca1', '', '1', '2f8aff4bd03618914e5d', 7, 575005, 'none@none', 1, 11, '2012-06-23 13:10:18', '2014-05-31 01:46:16', 3567209673, 0, 19877674080967, '', 'e5cac7bd480617dc6fda9a412ca6a82b', 12, 15, 15, 55, '127.0.0.2', '0', '', 0, 0, 0, '0000-00-00 00:00:00', 'AutoSeed', '0.000000', 0, 'no', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '0', 'no', '0', 'no', 0, 'no', 0, 'no', '0', '0', '', 0, 0, '', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'yes', 'yes', 'no', 0, 0, '1990-01-01', 0, 'no', '', '', 'false', 'false', 'United Kingdom', 'gb.png', 'no', '', 0, '', '', 'no', 'yes', 'no', 0, '', 0, '', 0, 0, '', 5, '', 'true', 0, 0, '', 1, 'no', '0', '0', 'unknown', '', 'no', 'unknown', 'new'),
(12922, 'Test1', '4896923fc30f6685a114c4508ad2c9d3', '', '1', '829eae15c6754dab9f34', 8, 545360, 'non@none', 1, 11, '2010-08-14 06:20:43', '2017-01-22 18:03:07', 1232081835, -1990116046275, 28991029248, '', '72cd5740c0c683b4bb8121f253039c15', 2, 15, 15, 55, '73.112.19.171', '-5', 'none@none', 0, 129, 0, '0000-00-00 00:00:00', 'Test1', '333074.686342', 0, 'yes', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '', 'no', '1d066ec0', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '91586', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'yes', 'yes', 'yes', 'no', 0, 0, '1990-01-01', 0, 'no', 'a:5:{i:0;s:148:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl01MDAwWy9iXSBib251cyBwb2ludHMgb24gdGhlIGN1c3RvbSB0aXRsZSBvZiBbYl0nVGVzdDEnWy9iXTwrPjA8Kz5TeXN0ZW08Kz4xNDc3MDg3NzUz";i:1;s:148:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl01MDAwWy9iXSBib251cyBwb2ludHMgb24gdGhlIGN1c3RvbSB0aXRsZSBvZiBbYl0nZG9vbSdbL2JdPCs+MDwrPlN5c3RlbTwrPjE0NzcwODc3NTg=";i:2;s:144:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl0xMDBbL2JdIGJvbnVzIHBvaW50cyBvbiBbYl01LjAwIEdCWy9iXSBvZiB1cGxvYWQgY3JlZGl0LjwrPjA8Kz5TeXN0ZW08Kz4xNDc4OTUyNTg0";i:3;s:144:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl0xMDBbL2JdIGJvbnVzIHBvaW50cyBvbiBbYl01LjAwIEdCWy9iXSBvZiB1cGxvYWQgY3JlZGl0LjwrPjA8Kz5TeXN0ZW08Kz4xNDc4OTUyNTg1";i:4;s:144:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl0xMDBbL2JdIGJvbnVzIHBvaW50cyBvbiBbYl01LjAwIEdCWy9iXSBvZiB1cGxvYWQgY3JlZGl0LjwrPjA8Kz5TeXN0ZW08Kz4xNDc4OTUyNTg2";}', '', 'false', 'false', 'United States of America', 'us.png', 'yes', '', 1, '', 'test', 'no', 'yes', 'yes', 1, '', 1258160, '', 0, 1484367799, '', 58, '', 'true', 0, 0, '', 1, 'yes', '0', '768', 'unknown', '', 'yes', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0.1 Safari/602.2.14', 'new'),
(23027, 'Demo', '0a5953444dc4aae6d30f1a92beb33758', '', '1', 'bd08e9dd58d58a4c4a3f', 5, 476318, 'non@none', 1, 31, '2011-03-01 16:07:10', '2017-01-20 22:53:53', 1482360688, 370561507041, 20215898751400, '', '52af35f9c16e4cd1112a04c80a45f02f', 12, 25, 25, 55, '88.91.7.112', '-7', 'none@none', 0, 11, 0, '0000-00-00 00:00:00', 'Test', '79653.057843', 0, 'yes', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '', 'no', 'aa45232b', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '21865', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'yes', 'yes', 'no', 0, 0, '1990-01-01', 0, 'no', 'a:32:{i:0;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTA=";i:1;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTM=";i:2;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTQ=";i:3;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTQ=";i:4;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:5;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:6;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:7;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:8;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:9;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTY=";i:10;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTc=";i:11;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTc=";i:12;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTg=";i:13;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTg=";i:14;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTg=";i:15;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTk=";i:16;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTk=";i:17;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUyMDA=";i:18;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUyMDA=";i:19;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUyMDE=";i:20;s:208:"RGVtbyBoYXMgYmVlbiBiYW5uZWQgdmlhIHRoZSBCYW4gQnV0dG9uIGZvciBbYl10ZXN0MlsvYl08Kz4xMjkyMjwrPjxzcGFuIHN0eWxlPSJjb2xvcjojRkY2NjAwOyB0ZXh0LXNoYWRvdzogMHB4IDBweCA1cHggI0ZGNjYwMDsiPlRlc3QxPC9zcGFuPjwrPjE0Nzk5Mzg1NDQ=";i:21;s:192:"RGVtbyBpcyBubyBsb25nZXIgYmFubmVkIHZpYSB0aGUgQmFuIEJ1dHRvbjwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ3OTkzODg3Ng==";i:22;s:236:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSBib290ZWQgdW50aWwgW2JdMjAxNi0xMS0yNCAyMjowODoyOVsvYl0gZm9yIFtiXXRlc3RbL2JdPCs+MTI5MjI8Kz48c3BhbiBzdHlsZT0iY29sb3I6I0ZGNjYwMDsgdGV4dC1zaGFkb3c6IDBweCAwcHggNXB4ICNGRjY2MDA7Ij5UZXN0MTwvc3Bhbj48Kz4xNDc5OTM4OTA5";i:23;s:176:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSB1bmJvb3RlZDwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ3OTk1ODQ5NQ==";i:24;s:116:"V2FybiBMZXZlbCBpbmNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0Nzk5OTQ3OTU=";i:25;s:116:"V2FybiBMZXZlbCBkZWNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0ODAwMjkzNTI=";i:26;s:208:"RGVtbyBoYXMgYmVlbiBiYW5uZWQgdmlhIHRoZSBCYW4gQnV0dG9uIGZvciBbYl10ZXN0MlsvYl08Kz4xMjkyMjwrPjxzcGFuIHN0eWxlPSJjb2xvcjojRkY2NjAwOyB0ZXh0LXNoYWRvdzogMHB4IDBweCA1cHggI0ZGNjYwMDsiPlRlc3QxPC9zcGFuPjwrPjE0ODAwMjkzNjc=";i:27;s:236:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSBib290ZWQgdW50aWwgW2JdMjAxNi0xMS0yNSAyMzoxNjozNVsvYl0gZm9yIFtiXXRlc3RbL2JdPCs+MTI5MjI8Kz48c3BhbiBzdHlsZT0iY29sb3I6I0ZGNjYwMDsgdGV4dC1zaGFkb3c6IDBweCAwcHggNXB4ICNGRjY2MDA7Ij5UZXN0MTwvc3Bhbj48Kz4xNDgwMDI5Mzk1";i:28;s:116:"V2FybiBMZXZlbCBpbmNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0ODAwMjk4MTc=";i:29;s:116:"V2FybiBMZXZlbCBkZWNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0ODAwMjk4NTI=";i:30;s:176:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSB1bmJvb3RlZDwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ4MDAyOTkyMg==";i:31;s:192:"RGVtbyBpcyBubyBsb25nZXIgYmFubmVkIHZpYSB0aGUgQmFuIEJ1dHRvbjwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ4MDAyOTkzOQ==";}', '', 'false', 'false', 'Norway', 'no.png', 'yes', '', 1, '', '', 'no', 'yes', 'no', 1, '', 1505352, '', 370561507041, 1484370380, '', 6, '', 'true', 0, 0, '', 1, 'yes', '0', '60', 'unknown', '', 'yes', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 'old');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}users_level`
--

CREATE TABLE `{$db_prefix}users_level` (
  `id` int(10) NOT NULL,
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
  `view_new` enum('yes','no') NOT NULL DEFAULT 'no',
  `up_new` enum('yes','no') NOT NULL DEFAULT 'no',
  `down_new` enum('yes','no') NOT NULL DEFAULT 'no',
  `view_arc` enum('yes','no') NOT NULL DEFAULT 'no',
  `up_arc` enum('yes','no') NOT NULL DEFAULT 'no',
  `down_arc` enum('yes','no') NOT NULL DEFAULT 'no',
  `logical_rank_order` int(10) NOT NULL DEFAULT '0',
  `can_boot` enum('yes','no') NOT NULL DEFAULT 'no',
  `down_req_intro` enum('yes','no') NOT NULL DEFAULT 'no',
  `external_upload` enum('yes','no') NOT NULL DEFAULT 'no',
  `external_refresh` enum('yes','no') NOT NULL DEFAULT 'no',
  `can_stream` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}users_level`
--

INSERT INTO `{$db_prefix}users_level` (`id`, `id_level`, `level`, `view_torrents`, `edit_torrents`, `delete_torrents`, `view_users`, `edit_users`, `delete_users`, `view_news`, `edit_news`, `delete_news`, `can_upload`, `can_download`, `view_forum`, `edit_forum`, `delete_forum`, `predef_level`, `can_be_deleted`, `admin_access`, `prefixcolor`, `suffixcolor`, `WT`, `autorank_state`, `autorank_position`, `autorank_min_upload`, `autorank_minratio`, `smf_group_mirror`, `ipb_group_mirror`, `bypass_dlcheck`, `torrents_limit`, `trusted`, `moderate_trusted`, `sel_team`, `all_teams`, `delete_comments`, `edit_comments`, `view_comments`, `delete_shout`, `edit_shout`, `view_shout`, `view_peers`, `view_history`, `view_userdetails_torrents`, `view_nfo`, `view_reencode`, `add_request`, `add_ddl`, `view_ddl`, `freeleech`, `can_hide`, `see_hidden`, `bump_torrents`, `set_multi`, `view_multi`, `view_new`, `up_new`, `down_new`, `view_arc`, `up_arc`, `down_arc`, `logical_rank_order`, `can_boot`, `down_req_intro`, `external_upload`, `external_refresh`, `can_stream`) VALUES
(1, 1, 'guest', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'guest', 'no', 'no', '', '', 0, 'Disabled', 0, 0, '0.00', 0, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 1, 'no', 'no', 'no', 'no', 'no'),
(2, 2, 'validating', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'validating', 'no', 'no', '', '', 0, 'Disabled', 0, 0, '0.00', 12, 0, 0, 0, 'no', 'no', 0, 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 2, 'no', 'no', 'no', 'no', 'no'),
(3, 3, 'Recruit', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'member', 'no', 'no', '<span style="color:#1947A3; text-shadow: 0px 0px 5px #1947A3;">', '</span>', 0, 'Enabled', 0, 0, '0.00', 13, 0, 0, 2, 'no', 'no', 0, 'no', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'no', 'yes', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 25, 'no', 'no', 'no', 'no', 'no'),
(4, 4, 'Uploader', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'uploader', 'no', 'no', '<span style="color:#99FF00; text-shadow: 0px 0px 5px #99FF00;">', '</span>', 0, 'Disabled', 0, 0, '0.00', 14, 0, 0, 25, 'yes', 'no', 0, 'no', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 40, 'no', 'no', 'no', 'no', 'no'),
(5, 5, 'V.I.P', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'vip', 'no', 'no', '<span style="background-image:url(https://i.imgur.com/F0UCb7A.gif); color:#FFD700; text-shadow: 0px 0px 5px #FFD700">', '</span>', 0, 'Disabled', 0, 0, '0.00', 15, 0, 0, 25, 'yes', 'no', 0, 'no', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 50, 'no', 'no', 'no', 'no', 'yes'),
(6, 6, 'Moderator', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'moderator', 'no', 'yes', '<span style="color:#28EEBC; text-shadow: 0px 0px 5px #28EEBC;">', '</span>', 0, 'Disabled', 0, 0, '0.00', 16, 0, 1, 100, 'yes', 'yes', 0, 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 91, 'yes', 'no', 'no', 'no', 'yes'),
(7, 7, 'Administrator', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'admin', 'no', 'yes', '<span style="color:#C11B17; text-shadow: 0px 0px 5px #C11B17;">', '</span>', 0, 'Disabled', 0, 0, '0.00', 17, 0, 1, 100, 'yes', 'yes', 0, 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 95, 'yes', 'no', 'no', 'no', 'yes'),
(8, 8, 'Owner', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'owner', 'no', 'yes', '<span style="color:#FF4000; text-shadow: 0px 0px 5px #FF4000;">', '</span>', 0, 'Enabled', 0, 0, '0.00', 18, 0, 1, 100, 'yes', 'yes', 0, 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 100, 'yes', 'no', 'no', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}videos`
--

CREATE TABLE `{$db_prefix}videos` (
  `title` text,
  `category` text,
  `id` varchar(11) DEFAULT NULL,
  `number` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}warn_logs`
--

CREATE TABLE `{$db_prefix}warn_logs` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `contact` enum('none','pm') NOT NULL DEFAULT 'none',
  `date_added` int(10) NOT NULL DEFAULT '0',
  `type` enum('inc','dec') NOT NULL DEFAULT 'inc',
  `added_by` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}warn_logs`
--

INSERT INTO `{$db_prefix}warn_logs` (`id`, `uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES
(1, 23027, 'TEST PURPOSES ', 'pm', 1479994795, 'inc', 12922),
(2, 23027, 'test', 'pm', 1480029352, 'dec', 12922),
(3, 23027, 'test', 'pm', 1480029817, 'inc', 12922),
(4, 23027, 'test', 'pm', 1480029852, 'dec', 12922);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}warn_reasons`
--

CREATE TABLE `{$db_prefix}warn_reasons` (
  `id` int(11) NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '12'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}warn_reasons`
--

INSERT INTO `{$db_prefix}warn_reasons` (`id`, `active`, `title`, `text`, `level`) VALUES
(1, '1', 'Corrupt File', 'It has been reported that this upload contains one or more corrupted files. Please reupload a proper version.', 12);

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}watched_users`
--

CREATE TABLE `{$db_prefix}watched_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(40) NOT NULL DEFAULT '',
  `cip` varchar(15) DEFAULT NULL,
  `location` text,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}welcome_msg`
--

CREATE TABLE `{$db_prefix}welcome_msg` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}welcome_msg`
--

INSERT INTO `{$db_prefix}welcome_msg` (`key`, `value`) VALUES
('fm_welcome_msg', '[left][color=silver]Welcome to SITNAME[/color]\r\n\r\nSITENAME has a strong community, and is a feature rich site. We hope you enjoy it, and join in the fun!\r\n\r\nBe sure to read the rules and FAQ before you start using the site.\r\n\r\nWe\'ve started you off with 50GB upload credit, and hope to see you on the forums and chat!\r\n\r\nWe are a strong friendly community and we hope you agree with us that SITNAME is so much more then just torrents!\r\n\r\ncheers[/left]'),
('fm_welcome_sub', 'Welcome To SITENAME');

-- --------------------------------------------------------

--
-- Table structure for table `{$db_prefix}wishlist`
--

CREATE TABLE `{$db_prefix}wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `torrent_id` varchar(40) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `{$db_prefix}wishlist`
--

INSERT INTO `{$db_prefix}wishlist` (`id`, `user_id`, `torrent_id`, `added`) VALUES
(3, 12922, '3f0dba6366c87b385fd896842091577afe3df3d0', '2016-11-24 03:46:53'),
(2, 12922, '389dad4e38536a92acb4b97b6fe93bad80e39e85', '2016-10-28 12:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `xbt_announce_log`
--

CREATE TABLE `xbt_announce_log` (
  `id` int(11) NOT NULL,
  `ipa` int(10) UNSIGNED NOT NULL,
  `port` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `info_hash` binary(20) NOT NULL,
  `peer_id` binary(20) NOT NULL,
  `downloaded` bigint(20) UNSIGNED NOT NULL,
  `left0` bigint(20) UNSIGNED NOT NULL,
  `uploaded` bigint(20) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_config`
--

CREATE TABLE `xbt_config` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_deny_from_clients`
--

CREATE TABLE `xbt_deny_from_clients` (
  `peer_id` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_deny_from_hosts`
--

CREATE TABLE `xbt_deny_from_hosts` (
  `begin` int(10) UNSIGNED NOT NULL,
  `end` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_files`
--

CREATE TABLE `xbt_files` (
  `fid` int(11) NOT NULL,
  `info_hash` binary(20) NOT NULL,
  `leechers` int(11) NOT NULL DEFAULT '0',
  `seeders` int(11) NOT NULL DEFAULT '0',
  `completed` int(11) NOT NULL DEFAULT '0',
  `flags` int(11) NOT NULL DEFAULT '0',
  `mtime` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `down_multi` int(11) DEFAULT '100',
  `up_multi` int(11) NOT NULL DEFAULT '100'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_files_users`
--

CREATE TABLE `xbt_files_users` (
  `fid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `announced` int(11) NOT NULL,
  `completed` int(11) NOT NULL,
  `downloaded` bigint(20) UNSIGNED NOT NULL,
  `left` bigint(20) UNSIGNED NOT NULL,
  `uploaded` bigint(20) UNSIGNED NOT NULL,
  `mtime` int(11) NOT NULL,
  `completed_time` int(11) NOT NULL,
  `down_rate` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `up_rate` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `peer_id` binary(20) NOT NULL,
  `ipa` int(10) UNSIGNED NOT NULL,
  `port` int(11) NOT NULL,
  `seeding_time` int(11) NOT NULL DEFAULT '0',
  `hit` enum('no','yes') NOT NULL DEFAULT 'no',
  `hitchecked` int(11) NOT NULL DEFAULT '0',
  `punishment_amount` int(11) NOT NULL DEFAULT '0',
  `started_time` int(11) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_scrape_log`
--

CREATE TABLE `xbt_scrape_log` (
  `id` int(11) NOT NULL,
  `ipa` int(10) UNSIGNED NOT NULL,
  `info_hash` binary(20) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xbt_users`
--

CREATE TABLE `xbt_users` (
  `uid` int(11) NOT NULL,
  `torrent_pass_version` int(11) NOT NULL DEFAULT '0',
  `downloaded` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `uploaded` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `torrent_pass` char(32) NOT NULL,
  `torrent_pass_secret` bigint(20) UNSIGNED NOT NULL,
  `can_announce` tinyint(4) NOT NULL DEFAULT '1',
  `can_leech` tinyint(4) NOT NULL DEFAULT '1',
  `wait_time` int(11) NOT NULL DEFAULT '0',
  `peers_limit` int(11) NOT NULL DEFAULT '0',
  `torrents_limit` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajax_chat_bans`
--
ALTER TABLE `ajax_chat_bans`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userName` (`userName`),
  ADD KEY `dateTime` (`dateTime`);

--
-- Indexes for table `ajax_chat_custom`
--
ALTER TABLE `ajax_chat_custom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ajax_chat_invitations`
--
ALTER TABLE `ajax_chat_invitations`
  ADD PRIMARY KEY (`userID`,`channel`),
  ADD KEY `dateTime` (`dateTime`);

--
-- Indexes for table `ajax_chat_messages`
--
ALTER TABLE `ajax_chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_condition` (`id`,`channel`,`dateTime`),
  ADD KEY `dateTime` (`dateTime`);

--
-- Indexes for table `ajax_chat_online`
--
ALTER TABLE `ajax_chat_online`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `ajax_chat_trivia`
--
ALTER TABLE `ajax_chat_trivia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ajax_chat_usercustom`
--
ALTER TABLE `ajax_chat_usercustom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `casino`
--
ALTER TABLE `casino`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `casino_bets`
--
ALTER TABLE `casino_bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`,`proposed`,`challenged`,`amount`);

--
-- Indexes for table `{$db_prefix}addedexpected`
--
ALTER TABLE `{$db_prefix}addedexpected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pollid` (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}addedexpectedmin`
--
ALTER TABLE `{$db_prefix}addedexpectedmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pollid` (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}adminpanel`
--
ALTER TABLE `{$db_prefix}adminpanel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}ads`
--
ALTER TABLE `{$db_prefix}ads`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `{$db_prefix}allowedclient`
--
ALTER TABLE `{$db_prefix}allowedclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peer_id` (`peer_id`),
  ADD KEY `peer_id_ascii` (`peer_id_ascii`),
  ADD KEY `user_agent` (`user_agent`);

--
-- Indexes for table `{$db_prefix}announcement`
--
ALTER TABLE `{$db_prefix}announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added` (`added`);

--
-- Indexes for table `{$db_prefix}announcements`
--
ALTER TABLE `{$db_prefix}announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `{$db_prefix}anti_hit_run`
--
ALTER TABLE `{$db_prefix}anti_hit_run`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `{$db_prefix}anti_hit_run_tasks`
--
ALTER TABLE `{$db_prefix}anti_hit_run_tasks`
  ADD PRIMARY KEY (`last_time`);

--
-- Indexes for table `{$db_prefix}bannedclient`
--
ALTER TABLE `{$db_prefix}bannedclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peer_id` (`peer_id`),
  ADD KEY `peer_id_ascii` (`peer_id_ascii`),
  ADD KEY `user_agent` (`user_agent`);

--
-- Indexes for table `{$db_prefix}bannedip`
--
ALTER TABLE `{$db_prefix}bannedip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_last` (`first`,`last`);

--
-- Indexes for table `{$db_prefix}baseline`
--
ALTER TABLE `{$db_prefix}baseline`
  ADD PRIMARY KEY (`file_path`);

--
-- Indexes for table `{$db_prefix}betgames`
--
ALTER TABLE `{$db_prefix}betgames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}betlog`
--
ALTER TABLE `{$db_prefix}betlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `userid_2` (`userid`,`bonus`);

--
-- Indexes for table `{$db_prefix}betoptions`
--
ALTER TABLE `{$db_prefix}betoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameid` (`gameid`);

--
-- Indexes for table `{$db_prefix}bets`
--
ALTER TABLE `{$db_prefix}bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameid` (`gameid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}bettop`
--
ALTER TABLE `{$db_prefix}bettop`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `{$db_prefix}bitcoin_invoices`
--
ALTER TABLE `{$db_prefix}bitcoin_invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `tracker_id` (`tracker_id`),
  ADD KEY `secret` (`secret`);

--
-- Indexes for table `{$db_prefix}blackjack`
--
ALTER TABLE `{$db_prefix}blackjack`
  ADD PRIMARY KEY (`gameid`);

--
-- Indexes for table `{$db_prefix}blacklist`
--
ALTER TABLE `{$db_prefix}blacklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tip` (`tip`);

--
-- Indexes for table `{$db_prefix}blocks`
--
ALTER TABLE `{$db_prefix}blocks`
  ADD PRIMARY KEY (`blockid`);

--
-- Indexes for table `{$db_prefix}bonus`
--
ALTER TABLE `{$db_prefix}bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}bt_clients`
--
ALTER TABLE `{$db_prefix}bt_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}bugs`
--
ALTER TABLE `{$db_prefix}bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}categories`
--
ALTER TABLE `{$db_prefix}categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}chat`
--
ALTER TABLE `{$db_prefix}chat`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `{$db_prefix}chatfun`
--
ALTER TABLE `{$db_prefix}chatfun`
  ADD PRIMARY KEY (`msgid`),
  ADD KEY `msgid` (`msgid`);

--
-- Indexes for table `{$db_prefix}cheapmail`
--
ALTER TABLE `{$db_prefix}cheapmail`
  ADD KEY `domain` (`domain`);

--
-- Indexes for table `{$db_prefix}coins`
--
ALTER TABLE `{$db_prefix}coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}comments`
--
ALTER TABLE `{$db_prefix}comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_hash` (`info_hash`);

--
-- Indexes for table `{$db_prefix}contact_system`
--
ALTER TABLE `{$db_prefix}contact_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}countries`
--
ALTER TABLE `{$db_prefix}countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}covers`
--
ALTER TABLE `{$db_prefix}covers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `{$db_prefix}donors`
--
ALTER TABLE `{$db_prefix}donors`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `{$db_prefix}don_historie`
--
ALTER TABLE `{$db_prefix}don_historie`
  ADD PRIMARY KEY (`don_id`);

--
-- Indexes for table `{$db_prefix}downloads`
--
ALTER TABLE `{$db_prefix}downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`uid`);

--
-- Indexes for table `{$db_prefix}down_load`
--
ALTER TABLE `{$db_prefix}down_load`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `hash` (`hash`);

--
-- Indexes for table `{$db_prefix}dox`
--
ALTER TABLE `{$db_prefix}dox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}expected`
--
ALTER TABLE `{$db_prefix}expected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}faq`
--
ALTER TABLE `{$db_prefix}faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}faq_group`
--
ALTER TABLE `{$db_prefix}faq_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}fav_uploader`
--
ALTER TABLE `{$db_prefix}fav_uploader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `{$db_prefix}featured`
--
ALTER TABLE `{$db_prefix}featured`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `{$db_prefix}files`
--
ALTER TABLE `{$db_prefix}files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `info_hash` (`info_hash`),
  ADD KEY `filename` (`filename`),
  ADD KEY `category` (`category`),
  ADD KEY `uploader` (`uploader`),
  ADD KEY `bin_hash` (`bin_hash`(20)),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `dead_time` (`dead_time`);

--
-- Indexes for table `{$db_prefix}files_reencode`
--
ALTER TABLE `{$db_prefix}files_reencode`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `{$db_prefix}files_reencodeb`
--
ALTER TABLE `{$db_prefix}files_reencodeb`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `{$db_prefix}files_thanks`
--
ALTER TABLE `{$db_prefix}files_thanks`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `{$db_prefix}flashscores`
--
ALTER TABLE `{$db_prefix}flashscores`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `{$db_prefix}forums`
--
ALTER TABLE `{$db_prefix}forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sort` (`sort`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `{$db_prefix}free_leech_req`
--
ALTER TABLE `{$db_prefix}free_leech_req`
  ADD UNIQUE KEY `info_hash` (`info_hash`);

--
-- Indexes for table `{$db_prefix}friendlist`
--
ALTER TABLE `{$db_prefix}friendlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `{$db_prefix}gold`
--
ALTER TABLE `{$db_prefix}gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}hacks`
--
ALTER TABLE `{$db_prefix}hacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}helpdesk`
--
ALTER TABLE `{$db_prefix}helpdesk`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `{$db_prefix}history`
--
ALTER TABLE `{$db_prefix}history`
  ADD UNIQUE KEY `uid` (`uid`,`infohash`);

--
-- Indexes for table `{$db_prefix}hnr`
--
ALTER TABLE `{$db_prefix}hnr`
  ADD UNIQUE KEY `id_level` (`id_level`);

--
-- Indexes for table `{$db_prefix}ignore`
--
ALTER TABLE `{$db_prefix}ignore`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `{$db_prefix}imdb`
--
ALTER TABLE `{$db_prefix}imdb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imdb` (`imdb`),
  ADD KEY `genre1` (`genre1`);

--
-- Indexes for table `{$db_prefix}invalid_logins`
--
ALTER TABLE `{$db_prefix}invalid_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}invitations`
--
ALTER TABLE `{$db_prefix}invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inviter` (`id`);

--
-- Indexes for table `{$db_prefix}ip2country`
--
ALTER TABLE `{$db_prefix}ip2country`
  ADD KEY `country_code2` (`country_code2`);

--
-- Indexes for table `{$db_prefix}iplog`
--
ALTER TABLE `{$db_prefix}iplog`
  ADD PRIMARY KEY (`ipid`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `{$db_prefix}khez_configs`
--
ALTER TABLE `{$db_prefix}khez_configs`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `{$db_prefix}kis_sent`
--
ALTER TABLE `{$db_prefix}kis_sent`
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `{$db_prefix}kis_users`
--
ALTER TABLE `{$db_prefix}kis_users`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `{$db_prefix}language`
--
ALTER TABLE `{$db_prefix}language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}logs`
--
ALTER TABLE `{$db_prefix}logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added` (`added`);

--
-- Indexes for table `{$db_prefix}lottery_config`
--
ALTER TABLE `{$db_prefix}lottery_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}lottery_tickets`
--
ALTER TABLE `{$db_prefix}lottery_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}lottery_winners`
--
ALTER TABLE `{$db_prefix}lottery_winners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}low_ratio_ban`
--
ALTER TABLE `{$db_prefix}low_ratio_ban`
  ADD UNIQUE KEY `wb_rank` (`wb_rank`);

--
-- Indexes for table `{$db_prefix}messages`
--
ALTER TABLE `{$db_prefix}messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `{$db_prefix}moderate_reasons`
--
ALTER TABLE `{$db_prefix}moderate_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}modules`
--
ALTER TABLE `{$db_prefix}modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `{$db_prefix}news`
--
ALTER TABLE `{$db_prefix}news`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `{$db_prefix}notes`
--
ALTER TABLE `{$db_prefix}notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}offer_comments`
--
ALTER TABLE `{$db_prefix}offer_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `{$db_prefix}online`
--
ALTER TABLE `{$db_prefix}online`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `{$db_prefix}partner`
--
ALTER TABLE `{$db_prefix}partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}paypal_settings`
--
ALTER TABLE `{$db_prefix}paypal_settings`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `{$db_prefix}peers`
--
ALTER TABLE `{$db_prefix}peers`
  ADD PRIMARY KEY (`infohash`,`peer_id`),
  ADD UNIQUE KEY `sequence` (`sequence`),
  ADD KEY `pid` (`pid`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `{$db_prefix}poller`
--
ALTER TABLE `{$db_prefix}poller`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `{$db_prefix}poller_option`
--
ALTER TABLE `{$db_prefix}poller_option`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `{$db_prefix}poller_vote`
--
ALTER TABLE `{$db_prefix}poller_vote`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `{$db_prefix}polls`
--
ALTER TABLE `{$db_prefix}polls`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `{$db_prefix}poll_voters`
--
ALTER TABLE `{$db_prefix}poll_voters`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `{$db_prefix}pool`
--
ALTER TABLE `{$db_prefix}pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}pool_settings`
--
ALTER TABLE `{$db_prefix}pool_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}posts`
--
ALTER TABLE `{$db_prefix}posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topicid` (`topicid`),
  ADD KEY `userid` (`userid`);
ALTER TABLE `{$db_prefix}posts` ADD FULLTEXT KEY `body` (`body`);

--
-- Indexes for table `{$db_prefix}profile_status`
--
ALTER TABLE `{$db_prefix}profile_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}quiz`
--
ALTER TABLE `{$db_prefix}quiz`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `{$db_prefix}rank`
--
ALTER TABLE `{$db_prefix}rank`
  ADD KEY `old_rank` (`old_rank`),
  ADD KEY `byt` (`byt`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}ratings`
--
ALTER TABLE `{$db_prefix}ratings`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `{$db_prefix}readposts`
--
ALTER TABLE `{$db_prefix}readposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topicid` (`topicid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `{$db_prefix}recommended`
--
ALTER TABLE `{$db_prefix}recommended`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_hash` (`info_hash`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `{$db_prefix}reports`
--
ALTER TABLE `{$db_prefix}reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}reputation`
--
ALTER TABLE `{$db_prefix}reputation`
  ADD PRIMARY KEY (`reputationid`),
  ADD KEY `dateadd` (`dateadd`),
  ADD KEY `multi` (`userid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `whoadded` (`whoadded`);

--
-- Indexes for table `{$db_prefix}requests`
--
ALTER TABLE `{$db_prefix}requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester` (`requester`),
  ADD KEY `category` (`category`),
  ADD KEY `uploadedby` (`uploadedby`),
  ADD KEY `jobtakenby` (`jobtakenby`),
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `{$db_prefix}requests_bounty`
--
ALTER TABLE `{$db_prefix}requests_bounty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addedby` (`addedby`),
  ADD KEY `id` (`req_id`);

--
-- Indexes for table `{$db_prefix}requests_comments`
--
ALTER TABLE `{$db_prefix}requests_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_id` (`req_id`),
  ADD KEY `addedby` (`addedby`);

--
-- Indexes for table `{$db_prefix}rules`
--
ALTER TABLE `{$db_prefix}rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}rules_group`
--
ALTER TABLE `{$db_prefix}rules_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}searchcloud`
--
ALTER TABLE `{$db_prefix}searchcloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}seedboxip`
--
ALTER TABLE `{$db_prefix}seedboxip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}seo`
--
ALTER TABLE `{$db_prefix}seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}settings`
--
ALTER TABLE `{$db_prefix}settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `{$db_prefix}shitlist`
--
ALTER TABLE `{$db_prefix}shitlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `{$db_prefix}shoutcastdj`
--
ALTER TABLE `{$db_prefix}shoutcastdj`
  ADD KEY `id` (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `{$db_prefix}signup_ip_block`
--
ALTER TABLE `{$db_prefix}signup_ip_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}sitemap`
--
ALTER TABLE `{$db_prefix}sitemap`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `url` (`url`);

--
-- Indexes for table `{$db_prefix}smilies`
--
ALTER TABLE `{$db_prefix}smilies`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `{$db_prefix}sticky`
--
ALTER TABLE `{$db_prefix}sticky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}stream`
--
ALTER TABLE `{$db_prefix}stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}stream_porn`
--
ALTER TABLE `{$db_prefix}stream_porn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}stream_servers`
--
ALTER TABLE `{$db_prefix}stream_servers`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `{$db_prefix}stream_users`
--
ALTER TABLE `{$db_prefix}stream_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}style`
--
ALTER TABLE `{$db_prefix}style`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}style_bridge`
--
ALTER TABLE `{$db_prefix}style_bridge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `{$db_prefix}style` (`{$db_prefix}style`);

--
-- Indexes for table `{$db_prefix}subtitles`
--
ALTER TABLE `{$db_prefix}subtitles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`);

--
-- Indexes for table `{$db_prefix}tasks`
--
ALTER TABLE `{$db_prefix}tasks`
  ADD PRIMARY KEY (`task`);

--
-- Indexes for table `{$db_prefix}teams`
--
ALTER TABLE `{$db_prefix}teams`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `{$db_prefix}tested`
--
ALTER TABLE `{$db_prefix}tested`
  ADD PRIMARY KEY (`tested`);

--
-- Indexes for table `{$db_prefix}timestamps`
--
ALTER TABLE `{$db_prefix}timestamps`
  ADD PRIMARY KEY (`sequence`),
  ADD KEY `sorting` (`info_hash`);

--
-- Indexes for table `{$db_prefix}timezone`
--
ALTER TABLE `{$db_prefix}timezone`
  ADD PRIMARY KEY (`difference`);

--
-- Indexes for table `{$db_prefix}topics`
--
ALTER TABLE `{$db_prefix}topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `subject` (`subject`),
  ADD KEY `lastpost` (`lastpost`);

--
-- Indexes for table `{$db_prefix}userbars`
--
ALTER TABLE `{$db_prefix}userbars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}users`
--
ALTER TABLE `{$db_prefix}users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `pid` (`pid`),
  ADD KEY `cip` (`cip`),
  ADD KEY `smf_fid` (`smf_fid`),
  ADD KEY `ipb_fid` (`ipb_fid`),
  ADD KEY `avatar_upload` (`avatar_upload`);

--
-- Indexes for table `{$db_prefix}users_level`
--
ALTER TABLE `{$db_prefix}users_level`
  ADD UNIQUE KEY `base` (`id`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `smf_group_mirror` (`smf_group_mirror`),
  ADD KEY `ipb_group_mirror` (`ipb_group_mirror`);

--
-- Indexes for table `{$db_prefix}videos`
--
ALTER TABLE `{$db_prefix}videos`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `{$db_prefix}warn_logs`
--
ALTER TABLE `{$db_prefix}warn_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}warn_reasons`
--
ALTER TABLE `{$db_prefix}warn_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `{$db_prefix}watched_users`
--
ALTER TABLE `{$db_prefix}watched_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cip` (`cip`);

--
-- Indexes for table `{$db_prefix}welcome_msg`
--
ALTER TABLE `{$db_prefix}welcome_msg`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `{$db_prefix}wishlist`
--
ALTER TABLE `{$db_prefix}wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `xbt_announce_log`
--
ALTER TABLE `xbt_announce_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xbt_files`
--
ALTER TABLE `xbt_files`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `info_hash` (`info_hash`);

--
-- Indexes for table `xbt_files_users`
--
ALTER TABLE `xbt_files_users`
  ADD UNIQUE KEY `fid` (`fid`,`uid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xbt_scrape_log`
--
ALTER TABLE `xbt_scrape_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xbt_users`
--
ALTER TABLE `xbt_users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajax_chat_custom`
--
ALTER TABLE `ajax_chat_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ajax_chat_messages`
--
ALTER TABLE `ajax_chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1949;
--
-- AUTO_INCREMENT for table `ajax_chat_trivia`
--
ALTER TABLE `ajax_chat_trivia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ajax_chat_usercustom`
--
ALTER TABLE `ajax_chat_usercustom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `casino_bets`
--
ALTER TABLE `casino_bets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}addedexpected`
--
ALTER TABLE `{$db_prefix}addedexpected`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}addedexpectedmin`
--
ALTER TABLE `{$db_prefix}addedexpectedmin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}adminpanel`
--
ALTER TABLE `{$db_prefix}adminpanel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `{$db_prefix}allowedclient`
--
ALTER TABLE `{$db_prefix}allowedclient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}announcement`
--
ALTER TABLE `{$db_prefix}announcement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}announcements`
--
ALTER TABLE `{$db_prefix}announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `{$db_prefix}bannedclient`
--
ALTER TABLE `{$db_prefix}bannedclient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}bannedip`
--
ALTER TABLE `{$db_prefix}bannedip`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}betgames`
--
ALTER TABLE `{$db_prefix}betgames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}betlog`
--
ALTER TABLE `{$db_prefix}betlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}betoptions`
--
ALTER TABLE `{$db_prefix}betoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}bets`
--
ALTER TABLE `{$db_prefix}bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}bitcoin_invoices`
--
ALTER TABLE `{$db_prefix}bitcoin_invoices`
  MODIFY `invoice_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}blackjack`
--
ALTER TABLE `{$db_prefix}blackjack`
  MODIFY `gameid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}blacklist`
--
ALTER TABLE `{$db_prefix}blacklist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}blocks`
--
ALTER TABLE `{$db_prefix}blocks`
  MODIFY `blockid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `{$db_prefix}bonus`
--
ALTER TABLE `{$db_prefix}bonus`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `{$db_prefix}bt_clients`
--
ALTER TABLE `{$db_prefix}bt_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}bugs`
--
ALTER TABLE `{$db_prefix}bugs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}categories`
--
ALTER TABLE `{$db_prefix}categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `{$db_prefix}chat`
--
ALTER TABLE `{$db_prefix}chat`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}chatfun`
--
ALTER TABLE `{$db_prefix}chatfun`
  MODIFY `msgid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}coins`
--
ALTER TABLE `{$db_prefix}coins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `{$db_prefix}comments`
--
ALTER TABLE `{$db_prefix}comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `{$db_prefix}contact_system`
--
ALTER TABLE `{$db_prefix}contact_system`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `{$db_prefix}countries`
--
ALTER TABLE `{$db_prefix}countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `{$db_prefix}covers`
--
ALTER TABLE `{$db_prefix}covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}donors`
--
ALTER TABLE `{$db_prefix}donors`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}downloads`
--
ALTER TABLE `{$db_prefix}downloads`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}down_load`
--
ALTER TABLE `{$db_prefix}down_load`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}dox`
--
ALTER TABLE `{$db_prefix}dox`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}expected`
--
ALTER TABLE `{$db_prefix}expected`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}faq`
--
ALTER TABLE `{$db_prefix}faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}faq_group`
--
ALTER TABLE `{$db_prefix}faq_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}fav_uploader`
--
ALTER TABLE `{$db_prefix}fav_uploader`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}featured`
--
ALTER TABLE `{$db_prefix}featured`
  MODIFY `fid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `{$db_prefix}files`
--
ALTER TABLE `{$db_prefix}files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `{$db_prefix}flashscores`
--
ALTER TABLE `{$db_prefix}flashscores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}forums`
--
ALTER TABLE `{$db_prefix}forums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `{$db_prefix}friendlist`
--
ALTER TABLE `{$db_prefix}friendlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}gold`
--
ALTER TABLE `{$db_prefix}gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}hacks`
--
ALTER TABLE `{$db_prefix}hacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `{$db_prefix}helpdesk`
--
ALTER TABLE `{$db_prefix}helpdesk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}ignore`
--
ALTER TABLE `{$db_prefix}ignore`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}imdb`
--
ALTER TABLE `{$db_prefix}imdb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}invalid_logins`
--
ALTER TABLE `{$db_prefix}invalid_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}invitations`
--
ALTER TABLE `{$db_prefix}invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;
--
-- AUTO_INCREMENT for table `{$db_prefix}iplog`
--
ALTER TABLE `{$db_prefix}iplog`
  MODIFY `ipid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}language`
--
ALTER TABLE `{$db_prefix}language`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `{$db_prefix}logs`
--
ALTER TABLE `{$db_prefix}logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `{$db_prefix}lottery_tickets`
--
ALTER TABLE `{$db_prefix}lottery_tickets`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}lottery_winners`
--
ALTER TABLE `{$db_prefix}lottery_winners`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}messages`
--
ALTER TABLE `{$db_prefix}messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `{$db_prefix}moderate_reasons`
--
ALTER TABLE `{$db_prefix}moderate_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}modules`
--
ALTER TABLE `{$db_prefix}modules`
  MODIFY `id` mediumint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `{$db_prefix}news`
--
ALTER TABLE `{$db_prefix}news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}notes`
--
ALTER TABLE `{$db_prefix}notes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}offer_comments`
--
ALTER TABLE `{$db_prefix}offer_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}partner`
--
ALTER TABLE `{$db_prefix}partner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}peers`
--
ALTER TABLE `{$db_prefix}peers`
  MODIFY `sequence` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;
--
-- AUTO_INCREMENT for table `{$db_prefix}poller`
--
ALTER TABLE `{$db_prefix}poller`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `{$db_prefix}poller_option`
--
ALTER TABLE `{$db_prefix}poller_option`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `{$db_prefix}poller_vote`
--
ALTER TABLE `{$db_prefix}poller_vote`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `{$db_prefix}polls`
--
ALTER TABLE `{$db_prefix}polls`
  MODIFY `pid` mediumint(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}poll_voters`
--
ALTER TABLE `{$db_prefix}poll_voters`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}pool`
--
ALTER TABLE `{$db_prefix}pool`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}pool_settings`
--
ALTER TABLE `{$db_prefix}pool_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}posts`
--
ALTER TABLE `{$db_prefix}posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `{$db_prefix}profile_status`
--
ALTER TABLE `{$db_prefix}profile_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}quiz`
--
ALTER TABLE `{$db_prefix}quiz`
  MODIFY `qid` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}readposts`
--
ALTER TABLE `{$db_prefix}readposts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `{$db_prefix}recommended`
--
ALTER TABLE `{$db_prefix}recommended`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}reports`
--
ALTER TABLE `{$db_prefix}reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}reputation`
--
ALTER TABLE `{$db_prefix}reputation`
  MODIFY `reputationid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}requests`
--
ALTER TABLE `{$db_prefix}requests`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `{$db_prefix}requests_bounty`
--
ALTER TABLE `{$db_prefix}requests_bounty`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `{$db_prefix}requests_comments`
--
ALTER TABLE `{$db_prefix}requests_comments`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `{$db_prefix}rules`
--
ALTER TABLE `{$db_prefix}rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}rules_group`
--
ALTER TABLE `{$db_prefix}rules_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}searchcloud`
--
ALTER TABLE `{$db_prefix}searchcloud`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}seedboxip`
--
ALTER TABLE `{$db_prefix}seedboxip`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}shitlist`
--
ALTER TABLE `{$db_prefix}shitlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}shoutcastdj`
--
ALTER TABLE `{$db_prefix}shoutcastdj`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}signup_ip_block`
--
ALTER TABLE `{$db_prefix}signup_ip_block`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `{$db_prefix}sitemap`
--
ALTER TABLE `{$db_prefix}sitemap`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}stream`
--
ALTER TABLE `{$db_prefix}stream`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}stream_porn`
--
ALTER TABLE `{$db_prefix}stream_porn`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}stream_servers`
--
ALTER TABLE `{$db_prefix}stream_servers`
  MODIFY `sid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}stream_users`
--
ALTER TABLE `{$db_prefix}stream_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}style`
--
ALTER TABLE `{$db_prefix}style`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `{$db_prefix}style_bridge`
--
ALTER TABLE `{$db_prefix}style_bridge`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}subtitles`
--
ALTER TABLE `{$db_prefix}subtitles`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `{$db_prefix}teams`
--
ALTER TABLE `{$db_prefix}teams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}timestamps`
--
ALTER TABLE `{$db_prefix}timestamps`
  MODIFY `sequence` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8756;
--
-- AUTO_INCREMENT for table `{$db_prefix}topics`
--
ALTER TABLE `{$db_prefix}topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `{$db_prefix}userbars`
--
ALTER TABLE `{$db_prefix}userbars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}users`
--
ALTER TABLE `{$db_prefix}users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58876;
--
-- AUTO_INCREMENT for table `{$db_prefix}users_level`
--
ALTER TABLE `{$db_prefix}users_level`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `{$db_prefix}videos`
--
ALTER TABLE `{$db_prefix}videos`
  MODIFY `number` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `{$db_prefix}warn_logs`
--
ALTER TABLE `{$db_prefix}warn_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `{$db_prefix}warn_reasons`
--
ALTER TABLE `{$db_prefix}warn_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `{$db_prefix}watched_users`
--
ALTER TABLE `{$db_prefix}watched_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;
--
-- AUTO_INCREMENT for table `{$db_prefix}wishlist`
--
ALTER TABLE `{$db_prefix}wishlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `xbt_announce_log`
--
ALTER TABLE `xbt_announce_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xbt_files`
--
ALTER TABLE `xbt_files`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xbt_scrape_log`
--
ALTER TABLE `xbt_scrape_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xbt_users`
--
ALTER TABLE `xbt_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
