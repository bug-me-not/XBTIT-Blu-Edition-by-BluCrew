-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2017 at 06:33 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blu_DB`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_addedexpected`
--

CREATE TABLE `blu_addedexpected` (
  `id` int(10) UNSIGNED NOT NULL,
  `expectid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_addedexpectedmin`
--

CREATE TABLE `blu_addedexpectedmin` (
  `id` int(10) UNSIGNED NOT NULL,
  `expectid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_adminpanel`
--

CREATE TABLE `blu_adminpanel` (
  `id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL,
  `id_level` int(11) NOT NULL,
  `access` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_adminpanel`
--

INSERT INTO `blu_adminpanel` (`id`, `section`, `description`, `link`, `id_level`, `access`) VALUES
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
-- Table structure for table `blu_ads`
--

CREATE TABLE `blu_ads` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_ads`
--

INSERT INTO `blu_ads` (`key`, `value`) VALUES
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
-- Table structure for table `blu_ajax_ratings`
--

CREATE TABLE `blu_ajax_ratings` (
  `id` varchar(40) NOT NULL,
  `total_votes` int(11) NOT NULL,
  `total_value` int(11) NOT NULL,
  `used_ips` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_allowedclient`
--

CREATE TABLE `blu_allowedclient` (
  `id` int(10) NOT NULL,
  `peer_id` varchar(16) NOT NULL,
  `peer_id_ascii` varchar(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_announcement`
--

CREATE TABLE `blu_announcement` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `body` text NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_announcements`
--

CREATE TABLE `blu_announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(64) NOT NULL,
  `message` text NOT NULL,
  `by` varchar(16) NOT NULL DEFAULT 'Admin',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `minclassread` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_anti_hit_run`
--

CREATE TABLE `blu_anti_hit_run` (
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
-- Table structure for table `blu_anti_hit_run_tasks`
--

CREATE TABLE `blu_anti_hit_run_tasks` (
  `task` varchar(20) NOT NULL DEFAULT '',
  `last_time` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_avps`
--

CREATE TABLE `blu_avps` (
  `arg` varchar(32) NOT NULL,
  `value_s` varchar(32) NOT NULL,
  `value_i` varchar(32) NOT NULL,
  `value_u` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bannedclient`
--

CREATE TABLE `blu_bannedclient` (
  `id` int(10) NOT NULL,
  `peer_id` varchar(16) NOT NULL,
  `peer_id_ascii` varchar(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bannedip`
--

CREATE TABLE `blu_bannedip` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` int(11) NOT NULL DEFAULT '0',
  `addedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `first` bigint(11) UNSIGNED DEFAULT NULL,
  `last` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_baseline`
--

CREATE TABLE `blu_baseline` (
  `file_path` varchar(200) NOT NULL,
  `file_hash` char(40) NOT NULL,
  `acct` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_baseline`
--

INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./chat/js/lang/ka.js', 'dc6223be54639a9db9fadbf498c532afbb8108a6', 'Blu-Edition'),
('./chat/js/lang/kr.js', '3da8299c8f217efc9f9711a1de074d182b81c6f2', 'Blu-Edition'),
('./chat/js/lang/et.js', '93f9de0aeb50c7b0a214a68ec269efe5bca60ec5', 'Blu-Edition'),
('./chat/js/lang/cy.js', '11a1b74b9e196b0b0f85a5a715d5aadc92eaa38c', 'Blu-Edition'),
('./chat/js/lang/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/js/lang/ar.js', 'e67c7c1508269c465480dd5d5b4014a3a42538ad', 'Blu-Edition'),
('./chat/js/lang/fr.js', 'dfa0f0f89f9e5ee9f8117e5d4b37a1d0cb875648', 'Blu-Edition'),
('./chat/js/lang/pt-pt.js', 'f72ed231d3443f52bd18aa1d68763e3a54bab602', 'Blu-Edition'),
('./chat/js/lang/nl.js', 'e3468a8f9ad76dbfc82099229018dd71d41be2c6', 'Blu-Edition'),
('./chat/js/lang/bg.js', '70aebf3e2bfe523aaac992f19980d984889a759e', 'Blu-Edition'),
('./chat/js/lang/no.js', 'f32755fbf3b12a207c6f19dbd59f7a7abe372cd6', 'Blu-Edition'),
('./chat/js/lang/hu.js', '639a5112d50537879aa3a54a68422acb36079e2c', 'Blu-Edition'),
('./chat/js/lang/de.js', 'cabb5988a7e41a7ec3b26afe4f9ad50f694284e9', 'Blu-Edition'),
('./chat/js/lang/ru.js', '00a4074d791e1358b9dd01860452f22c32dd0807', 'Blu-Edition'),
('./chat/js/lang/ro.js', 'ed4e74f6bb5c0dbbad2fdf8cb759cd36a15d2da0', 'Blu-Edition'),
('./chat/js/lang/pt-br.js', '5acdac5f632ae48cac944884971e99d940b6add5', 'Blu-Edition'),
('./chat/js/lang/zh-tw.js', '884adc27b0c871165cacb8ff51229bddd489d324', 'Blu-Edition'),
('./chat/js/lang/sr.js', 'e0187505f1d2122aac6073e8850b620261bfe048', 'Blu-Edition'),
('./chat/js/lang/sv.js', 'f38a17e436a1b1afa606323435cdec3d7806aa37', 'Blu-Edition'),
('./chat/js/lang/uk.js', '8437d7bae1acf768b04c107a1328e5de02c49257', 'Blu-Edition'),
('./chat/js/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/js/lang/in.js', '02b1f294978f1438e23405a1e0ac3dad06863f1e', 'Blu-Edition'),
('./chat/js/chat.js', 'd246e3d9e9a037bdf04f0609e6a6588ff40ae2d3', 'Blu-Edition'),
('./chat/js/config.js', '70dcf0305fb3e22cece04c3abafc556201192087', 'Blu-Edition'),
('./chat/js/logs.js', '8156908672afc92a02d67e57d50c1c1c1bbaee2b', 'Blu-Edition'),
('./chat/socket/server.conf', '3df524fb4e14f2219221c97271b359383adceb58', 'Blu-Edition'),
('./chat/socket/server.rb', 'd70a8f7ffc10b37bc98b072b9ac576ed1747a00a', 'Blu-Edition'),
('./chat/socket/server', 'eb272457747f46ba0339e18ce1de31fb724cc8fe', 'Blu-Edition'),
('./chat/index.php', '911eca7c1249a43d0367b26afb7796d76dce8a5b', 'Blu-Edition'),
('./chat/socket/.htaccess', '9c86436d4e1f7b445c85e3df8921870996cb0b9d', 'Blu-Edition'),
('./chat/flash/FABridge.swf', 'bcdff36a49503165f3c5ad5c362e959516f5c273', 'Blu-Edition'),
('./chat/flash/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/src/EmptySwf.as', 'bb2823b41e95e3fdf6e187cf940e449a0e75da55', 'Blu-Edition'),
('./chat/src/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/src/FABridge.as', '41e2e1a8bb43215599588656f30ae235d0c4409b', 'Blu-Edition'),
('./faq.php', '150f1115526e99a8cf6b9c348923e0e9382afa0e', 'Blu-Edition'),
('./blocks/ajax_block.php', 'c750977abb74f2acecc2944b622f627d3c37ccf4', 'Blu-Edition'),
('./blocks/blufm_block.php', 'dd483a24b111a49bb44d02ec41a68e508bc13223', 'Blu-Edition'),
('./blocks/serverload_block.php', '1f4b712c4eb375e7a1e2ede14fb9c63ce103b627', 'Blu-Edition'),
('./blocks/user_block.php', 'e5fadab9557a8b5727035ffdc2c595e6b7efe8de', 'Blu-Edition'),
('./blocks/featured_block.php', 'cb7c2f89aab67e179375cc21aa171f4aa6ab4837', 'Blu-Edition'),
('./blocks/clients_block.php', '2bc3d68d5c70e07b493979d16afc2a29e7c956a0', 'Blu-Edition'),
('./blocks/throwbacks_block.php', 'd88efbb8ff23eac332bac8139b41b07f61efabcf', 'Blu-Edition'),
('./blocks/forum_block.php', '740cf15a4d1922a8d34c0765d93c7220381acb0c', 'Blu-Edition'),
('./blocks/welcomeback_block.php', '1c8b863b39f355b69ce613028398cba8a78dc30a', 'Blu-Edition'),
('./blocks/poll_block.php', '65e5e67f9d73575feffdaba79196a0660b8b349e', 'Blu-Edition'),
('./blocks/latest_releases_block.php', '0bf6b5484d3c6c9ab9c3088bc1654a077df583c7', 'Blu-Edition'),
('./blocks/poller_block.php', 'f3b724974e98d0236b107d7081d5c8b404bd23f3', 'Blu-Edition'),
('./blocks/admin_block.php', '581e4f10736fecf2e234b51765e8ff8182c85f31', 'Blu-Edition'),
('./blocks/openreg_block.php', 'b742a6bb35862de0f8040c0a540b2234e2360148', 'Blu-Edition'),
('./blocks/last_uploads_block.php', '322ee8388fb619ad56a9c62112de0197539b6c7d', 'Blu-Edition'),
('./blocks/paypal_block_AUTO.php', 'c67367a17ea83bb269462b8fbfebee6fa365a149', 'Blu-Edition'),
('./blocks/torrentoftheweek_block.php', 'd653a60040085fbc249fc26d91e41eb88c4b4141', 'Blu-Edition'),
('./blocks/lastmember_block.php', '1f0ea66366bfb77a7fe2fd654bd850359b89f7d0', 'Blu-Edition'),
('./blocks/lrb_block.php', 'a1d9abb0c16dde1670a6c81a539eb57edfdf77bf', 'Blu-Edition'),
('./blocks/online_block.php', 'c69fd1fe467180495a9df6b3dc52859c8b1f2efb', 'Blu-Edition'),
('./blocks/disclaimer_block.php', '8cfeec3eb7b5d2ead677d3bd25242d2d6f195a57', 'Blu-Edition'),
('./blocks/donation_block.php', '72ef3aed364a19a97ce5f6222aa41bb24c395d71', 'Blu-Edition'),
('./blocks/hit_run_block.php', '2523aceb73ee1c75a19b2b8ca43e5c05989bb1fa', 'Blu-Edition'),
('./blocks/maintrackertoolbar_block.php', 'c301e18d3dac42aadf640071393ac4932451f05d', 'Blu-Edition'),
('./blocks/topup_block.php', '6dc544d563887995e44341c02ea35d42019c83b7', 'Blu-Edition'),
('./blocks/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./blocks/links_block.php', '2441f207ecc6a6e37b7c74e3fe1930b8e7ac1147', 'Blu-Edition'),
('./blocks/dropdownmenu_block.php', 'f9cf19c1610a51ab7b5ed7e7cc21b3ee0c01a5db', 'Blu-Edition'),
('./blocks/last_request_block.php', '2f185ff7c1a42b2572b0e597b734237ee419b5c3', 'Blu-Edition'),
('./blocks/seedbox_block.php', 'fc172203d0d3aa20f989bb97a18558fc5d562333', 'Blu-Edition'),
('./blocks/comments_block.php', 'e24e78d01b2358243405cfe18ded00c370d5025c', 'Blu-Edition'),
('./blocks/blog_block.php', '7802f0e519f8f190aab9270db86c2f2b0979c41c', 'Blu-Edition'),
('./blocks/request_block.php', 'b200bb2c390338d023cfc30a26fbe2dd9bd6e222', 'Blu-Edition'),
('./blocks/unvalidated_block.php', '66ac09774547f7ee1a3bc97589f498b0134273af', 'Blu-Edition'),
('./blocks/bet_block.php', '761231ea765cc752be299eb5d2621e22cc7e968f', 'Blu-Edition'),
('./imageflow.php', '12591189244cb2e5ff13ed88a118131845f5feb4', 'Blu-Edition'),
('./closer.html', '56b7ffcdda99e69591fedb4ae2362f181e7edc53', 'Blu-Edition'),
('./Installer/fonts/fontawesome-webfont.ttf', '6225ccc4ec94d060f19efab97ca42d842845b949', 'Blu-Edition'),
('./Installer/fonts/fontawesome-webfont.eot', '0183979056f0b87616cd99d5c54a48f3b771eee6', 'Blu-Edition'),
('./Installer/fonts/fontawesome-webfont.woff', '7d65e0227d0d7cdc1718119cd2a7dce0638f151c', 'Blu-Edition'),
('./Installer/fonts/FontAwesome.otf', '6270a4a561a69fef5f5cc18cdf9efc256ec2ccbe', 'Blu-Edition'),
('./Installer/fonts/fontawesome-webfont.svg', 'cd980eab6db5fa57db670cb2e4278e67e1a4d6c9', 'Blu-Edition'),
('./Installer/includes/config/rbrgvnd.ini', '566176791383be8d5551ae8566ba8b834373d03a', 'Blu-Edition'),
('./Installer/includes/functions.php', '21b26ad541b86577423b60574a2673420ddbdd8f', 'Blu-Edition'),
('./Installer/includes/constants.php', 'de181c15de33b0baad5d34bef4de54d02583bc7e', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/Smarty.class.php', 'efa93f1c42ac140051bec2f39e37aa8d8349c29a', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/SmartyBC.class.php', '3afd69566489c695f894f6f0d550e7ab6b7a50ce', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_block.php', 'c242a1102f7ce2d4093a60e9e62a35c616c3c375', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_while.php', '9f32ca8639f48197cac0d96c7955ae8864a06f4f', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_append.php', '04e89fbabffd91e052daae2626ccb7abd51bb980', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_resource_custom.php', '8c1ca06021092c3f7b47dfecacf73db36bbedfbc', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_ldelim.php', 'bdce8ed53608f81ef73c7ce41bb6c30ce6c52eb6', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_configfileparser.php', '796aa9e421ae09147ad0f67c82a9c9673dc81e86', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_extends.php', '44f6cefdf929b02dbccda5f4d2921b9a8f27444d', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_file.php', '7a9fc5b275f2ca6d08ee20562047391ebb38cf70', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_templatecompilerbase.php', '9f8a562555258cc42acd904ffb119ef5d5dcb120', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_call.php', '8a0d4e1f39b98d3f6c335b681cf9e86e7c02cadb', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_parsetree.php', 'e19c7f9d154773a5a1ace7b186f96c6e9d0bc445', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_cacheresource_custom.php', 'ab5dcda87b3f017655b91016fb8d393385d8238a', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_config_load.php', '7b9297a141b23bcf3c17e11b2971eb703cd0c587', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_continue.php', '39cdd5c554f6d3ede42b28526da01a4de0496315', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_registered.php', '98b56c1420aa25f0d05a402dedc29e6f1c9c85bf', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_foreach.php', '31e5f8f7bde2387e01ed2266dbc9f62e851fe554', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_insert.php', 'aafacf8e14534b20877a7b98ef33ccf181040978', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_setfilter.php', '6e07aea1abe70c7bb9ed450f759650fb42b86752', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_cacheresource_file.php', '4c6616e245f914e5708378277eadbd52b1e04dad', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_for.php', '3762fd79b47f0d816f0cb6186dffd15759f226d6', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_assign.php', '27cbc53730e14f2cc3372bdcb5bf809578656e10', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_resource_uncompiled.php', '5a80fdd3119893761a55b910e8bae0ed62a981d2', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_config_source.php', '02caaf648a63de90139e3475ecf923846a04d275', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_rdelim.php', 'a99ed0a38c31c0d887f658c8f78ad33cb57ebe23', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_cacheresource_keyvaluestore.php', 'd5757166b88e916bf9d8fb85f8625a8ccf55ee10', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_templatelexer.php', 'a46ed07d46c6eada8201231e98d179fbf7f2fd3a', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_object_block_function.php', '4eef2c63e07c9ddb0784f51bddb6a1b82790082c', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_capture.php', '263c32f91907d2dc2a0a0f8a36d16068c2647ce5', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_nocache.php', '0e1a6c1deb3c00dbd89c303c5de14a2806516967', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_config.php', 'a9fb5ac027d14b969fc0491cb51373750ddd1b86', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_php.php', 'abe691a1d4e5505aa90d94a33299ba274a1b8a00', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_templateparser.php', 'db51aa82be0702cce2c2aad38fc59ed663165395', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_break.php', '184be50cb6b1c2c48dbb89599b92676b5f0c35e0', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_cacheresource.php', '615b5216330050560559dc811ade8642297d02a1', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_modifier.php', 'f5f2f32d1c4e39ac2180a5a42a4f56e943f38341', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_eval.php', '4093261f007601f64efe9023f0b7a92ee06e230d', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_data.php', '604fe77325cbb9cdeaf500f161dc950d822869b2', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_function_plugin.php', '8bb77859132f23e3b178948a6146641dee5da86d', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_include_php.php', 'fecea28e7794d3e1fd76320b35b6b3b8918a5544', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_special_variable.php', '099cc669f5b6048b230cae68c9edf683bb7fbdfd', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_stream.php', '59b11024a91e5d50115d59b554c6edf2e331cf06', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_get_include_path.php', 'b46107862664392881ab46cd52f138f09ac350a0', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_smartytemplatecompiler.php', 'eab72dcf22a70177de52e955662cc69b5b69d5b8', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_extends.php', '71592b813eae7f39eee55a61d4e302614c0d18ea', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_print_expression.php', '5b46ae59db8c7f9c1f8489f86edf0946421b7ff3', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_write_file.php', 'ec1d4d63c5eecb3c11a2f264e7f9f61550ea7d84', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_utility.php', '3f9e961acb3409ed08dc6eda986dd3a9036db3fb', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_if.php', '3059d614274176808b710de40556b4be45fa47c2', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_debug.php', 'b716b9697b9642ae87c145b3da0d98de1e779c2e', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_templatebase.php', 'd2780814a45574685fe4e87d484c6afe55765743', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_resource.php', 'c0455d074f6b39bd4277b020ce86251fa9310190', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_registered_block.php', '42a5d050aaa1ab08f3d4079e0ef319ffa90f6a6b', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_registered_function.php', 'e1cdb1b1a993b4d363e8803a010da53ca220b684', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_function.php', '909adc7f4e2d2eef9b36c8bba3b54e68c3204aa4', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_debug.php', '72cfa5d1917eece69aa7bda36e9a6ec18959b26b', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_string.php', 'a8a5370ddd045bd21cd72a2c2283a14093bac670', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_template.php', '73170e9d437e72da653d198a65858974d23ae191', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_object_function.php', '77e64d13eae7e3a541645880958cdd55cf9b88ef', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_resource_recompiled.php', '80091d77b6df3638c8aeb57738baee336c4b4602', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_function_call_handler.php', '89643e2f9f647c7fdde11b1854656cb061c1e566', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compilebase.php', '2512261bcda12d7242cdb309f4628f7d42049e46', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_configfilelexer.php', '655095685f42c3efdf5dac5347bb6cf2d68073aa', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_include.php', '9cb2fc27c1489d44dc8ee8f9e1450f7c83a42815', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_private_block_plugin.php', 'cd541a4a1605c3216dee3b02760afef944087ec0', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_resource_eval.php', '589f13f558d6bbe02869651984ef86bd4aea4687', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_config_file_compiler.php', '42e64a102ff61a9a49e172a0b41bb5cc509e89a6', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_nocache_insert.php', 'f50907b010b049127e3e6e5b29c03e548371aa94', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_compile_section.php', 'ae0ecb5251e73999fcfc0a94eedf8c607f0c3470', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_security.php', '0b8484dc7604dffa1b8dc13204f9e6f6c61e6266', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/sysplugins/smarty_internal_filter_handler.php', 'beed63d9edf730cbcdd92a55af628e5023646cdc', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.upper.php', 'ab8534fa1b90f2207bf6348505c3eed1d6318f33', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.replace.php', 'ce44596bc65a23b386fdf2f03597bdf1580f75fe', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.fetch.php', '811578f8d672cbed2ffae8439e50a4d17307d6ff', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.escape.php', 'd5b8a590080d3aa61d57d4a66954b0e2b9de8a79', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/shared.mb_wordwrap.php', 'd5a6a97370f6ff4a578baa09acd22f9fc3224725', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.default.php', '1249882bd21b9885352b75c2f2a096bee9af7235', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/shared.literal_compiler_param.php', '32e201f0773abdae09b25468a6ecd94d722eff5e', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/outputfilter.trimwhitespace.php', '135c2639f7290b7c390a2af2efbf037e62abd91e', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.string_format.php', '01b4ec89f99aa4db1664375bfc71d757d1e044f7', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/compiler.switch.php', 'f6a6327939122ae46a54ad7961891a4f3a732339', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.count_words.php', '180454752c216f369212a795779ac9c6527ccff3', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_checkboxes.php', 'a89b2a25e5ff6ff934e7b36c6db6308830921516', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_radios.php', '8ed472f203cdc2c89e92b91df6f1c366d16fcd31', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.spacify.php', 'a1ab43bb30e4da107f9e745bd83aedb03ca31b67', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.math.php', 'b9b70c55a7d5a32f81381ef9f65e408580bb6450', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.cat.php', '1fedead60c549751a8033d74e4890e4dfd145141', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/shared.mb_str_replace.php', 'a4eabc89f046e37fd5725f9b415a763f17d65766', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_options.php', 'd2bdf373f57b906698d518d076fb03d6b3dcdb3a', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/block.textformat.php', '2bd956456799460dbdea21689ccb57d993c0cec3', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.strip_tags.php', '19864afcbbcd8986c49519b84e060da73533904c', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.to_charset.php', 'ea1f11e21f410c844d071c473761e9d725b133f5', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.regex_replace.php', 'fb30c625e991131016ff3ee4812948991651e64b', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/shared.make_timestamp.php', '8723f501e1e08ac3b3b02ce0638d2be92fa5f072', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.count_characters.php', '8fb90ad12ced0de771a584ab0361a4cb5fc3c4f5', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.count_sentences.php', '0abc8528946e85ac9b3b89aaab702f34472c1721', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.count_paragraphs.php', '0990eec12cfb7b64c5e3472de2981d6387c81e73', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_image.php', '9cb868e11effca7f2958c46494a4b61385f3196e', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.indent.php', 'aada4f21e2d7fb787f86495de692422fed9213a0', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.noprint.php', '22da8d64ccb4f9aa042214e242aae0b779df834a', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.lower.php', '916024355d28d6e78ea00d60f08ea28ce93c30b9', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.debug_print_var.php', 'b33913580621acfc3bd1ae7facc35911e8f6b682', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.mailto.php', 'c758c38e494e687fcb59553e799e7eb8ef96c3bf', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_select_date.php', 'ef8c483cecf8c09b5ac4b6c67a64a068aaad6577', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.truncate.php', '4dc298a1c685b3c3badfe13c25fdc5a282ab83b9', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_table.php', 'f521bbcfc39cf70f027dbc533cddd70340ac889b', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.counter.php', 'e3b5b3317278b01db28e3470ceed8bcfc940fa0d', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.date_format.php', 'c5d851e63085e2756b705c3759b896f905d4b3f4', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/shared.mb_unicode.php', '0c8fe7dfd02e0447c2c34455f1772cdb28345915', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.wordwrap.php', 'e3d58b6c9d1cfb70655cc3e9e6e24215a609c8c7', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/shared.escape_special_chars.php', '9cca344e3c7a7ff882276f69a091181e34839e53', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifier.capitalize.php', 'ed80cdbba601a029d94be28be2840cbb377427d2', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.strip.php', 'c59ddffbfe8f98e005c89b278d02dc591dc86dc8', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.cycle.php', '4134c4a37590b72c448f541062303a558577539f', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/function.html_select_time.php', 'cfd26d29946c9a7ceeecfb7c39ebcb4628cd8031', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/variablefilter.htmlspecialchars.php', 'fb32589ce5ca59883267e607517c05b351aa9f2a', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.escape.php', '0bd22be730a8fef88ac24251735efedef442d844', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.from_charset.php', '77c57c25257e21168008adc873a89e93e031f924', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/plugins/modifiercompiler.unescape.php', '9201cd3d1a85b41745e63cf783a9a859bef679d1', 'Blu-Edition'),
('./Installer/includes/classes/Smarty/debug.tpl', 'd5b2bb30d7be62dc2412369c98d493a79b6a0ffc', 'Blu-Edition'),
('./Installer/includes/classes/singleton.class.php', '9659c153c237c4efb45bad0fa17e3fc05abb7cce', 'Blu-Edition'),
('./Installer/includes/classes/RonBurgundy.php', '233ab6d7a2a0ecc060354bb026554729a0a64969', 'Blu-Edition'),
('./Installer/includes/scripts/build/db/base.sql', 'f5cd1f564ff8e7a17a7c3b1a46f4d9388cb39b41', 'Blu-Edition'),
('./Installer/includes/scripts/example/config/db.ini', '226a46c0582a63ff742b3e52ba0b44f85e80b8e2', 'Blu-Edition'),
('./Installer/includes/scripts/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./Installer/includes/config.php', '43e930d9c817996b54d15e8620f8f181f1055a23', 'Blu-Edition'),
('./Installer/includes/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./Installer/css/font-awesome.css', '6df51eee1e75e450cb9cd71e925e6aa9ac2d6a9d', 'Blu-Edition'),
('./Installer/includes/templates/db.ini', '21a39cbe055859402cf8d1b58be26a1e446f54dc', 'Blu-Edition'),
('./Installer/css/messagebox.css', 'b64a4c6b188b307ef8169ae18777c765cddc076d', 'Blu-Edition'),
('./Installer/css/bootstrap/bootstrap.min.css', 'fb42a9f8e0dbe5b962a59bb9068c0f0e170cc197', 'Blu-Edition'),
('./Installer/css/bootstrap/bootstrap.css', '2f9880f998e3d99f10e14169366fc2c4bfd23d2a', 'Blu-Edition'),
('./Installer/css/font-awesome.min.css', 'b71d1c7c315b67c614563382d1c2a868ac14d729', 'Blu-Edition'),
('./Installer/css/custom.css', 'db3f8688578947f0aeb2d50d8863cbd7157765ec', 'Blu-Edition'),
('./Installer/css/jquery-ui/selene/jquery-ui.css', 'd444ff6f757b9516f5bb28a839097cab6ea8b484', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/parseTheme.css.php', 'ae5061e76db0ce6cbeac8d39617f27122226d0ff', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.gif.php', '3d21cbfe6898365eba2182f0a83d5a158e522c0e', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.functions.php', '90de7355b21ee2d24a241cec4aef140922eff338', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.filters.php', '6d39e5de3dcf8235cce87c8e44ec82107dc53fd9', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.php', 'abeca5c53df20037d4633ed4eedd21e057ead1c6', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.config.php.default', '67031e2f8da4e8e960508232ba246bae3a7c53f4', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/fonts/readme.txt', 'f416c8a43354d71070f4b30822182d3d0a7319a3', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/readme.demos.txt', '7482db36b6bda5369fef0e6aa1e4b3cdb26cbc89', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/javascript_api.js', 'fd8a7a2a39d2b5e11c7ad94669356e31d5725d16', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.demo.php', '14c409731800e7eaa4c499cbcc520d041863cce3', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.showpic.php', '22caee09971feaa3b83da79ae51ed396402592fe', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/index.php', 'a0466b0036357a77b2b049526513f3684a95efd7', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.gallery.php', '054c65fb10e24e33e43729acc270a09531192102', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.random.php', 'bf5f0acb1440accba6b36a8b026fe57e27f3c6a9', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.object.php', 'f2060f2e7dad0a4f71f4ab996d1470ec2f4d255f', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.object.simple.php', 'cdf465d5833796a11ae0632f1b0f350a4a00d6d0', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/demo/phpThumb.demo.check.php', '0e988e7d0839971493e498cdaa414eee7b9757ef', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.bmp.php', '2782c51cabc1fb68ef3b05b4c86a168a01c55ce5', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.config.php', '25e2527ffa84bcff94a266a8a4a440a83e67039a', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/images/readme.txt', '7ee3d6065986c6c460d5d8aecf439e11eaebdeb2', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/docs/phpthumb.faq.txt', '290ef1e71f594c961116bcfc1650cbd1f6f1999f', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/docs/phpthumb.license.txt', 'd69064b09520a062c3fef1c5517c1fa49153da3a', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/docs/phpthumb.changelog.txt', 'e697b946d4054c0f61513f2527334b40f343ce8b', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/docs/phpthumb.readme.txt', 'afc2101569dfeecc1639b63ed660ba29ef6d071d', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/docs/phpthumb.license.commercial.txt', '8442190cec647d92efc02efde8620b201daf0b86', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/index.php', 'e9079a5d658bfc509aaeada28bd70bba10f2a442', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.ico.php', '15fefec78fc9a876d169269e6d873a9b1f0b1fa3', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/cache/phpThumbCacheStats.txt', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/cache/source/index.php', '9b1b91b79a16657536044f5bb0f3c565ebb1a77e', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/cache/index.php', '9b1b91b79a16657536044f5bb0f3c565ebb1a77e', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.class.php', '89729e9e29397dc02946a91dfee954a13d56c372', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/_theme.config.php', 'f97c5b9530a2783fc4e5d27b1edb937157c8cc3f', 'Blu-Edition'),
('./Installer/css/jquery-ui/themeswitcher/images/phpThumb.unsharp.php', 'fca4d9704d5727fd8612e79aa31d9e628c467768', 'Blu-Edition'),
('./Installer/css/jquery-ui/delta/jquery-ui.css', 'd9e303f6c243bd8529ae7f7cb4bdb2710c4b2a1f', 'Blu-Edition'),
('./Installer/css/jquery-ui/aristo/jquery-ui.css', '85c112eab1b56cb1562507375a007983f8ad7047', 'Blu-Edition'),
('./Installer/css/jquery-ui/absolution/jquery-ui.css', 'fcae8e39ee6802d5fc4ceac3e696560139a0ebef', 'Blu-Edition'),
('./Installer/css/jquery-ui/absolution/jquery-ui.mobile.css', '6d261875e02e61dfd4571058931bf17077191be9', 'Blu-Edition'),
('./Installer/templates_c/.htaccess', 'eef55d493b0a4bd96902afac38cb1dee0efd4382', 'Blu-Edition'),
('./Installer/js/jquery-validation/additional-methods.js', '5e5d51df46e8b74b48cf1f6a02ab491e0a0244d9', 'Blu-Edition'),
('./Installer/js/jquery-validation/additional-methods.min.js', '30d9d1d01bfc18ab411b0ec70249c26160328665', 'Blu-Edition'),
('./Installer/js/jquery-validation/custom-methods.js', '07d606c0729de1bf0075dae16a2adf12ced60750', 'Blu-Edition'),
('./Installer/js/jquery-validation/jquery.validate.min.js', '9389012cc388a5177f0bce53fd474d16768344d0', 'Blu-Edition'),
('./Installer/js/jquery-validation/jquery.validate.js', '85c05620ea7323f00c3eafe32807e2de6bce8df1', 'Blu-Edition'),
('./Installer/js/imagesloaded.js', '316b19ed06e10425449a5f5e9d26d8a4048ed332', 'Blu-Edition'),
('./Installer/js/jquery.observor.js', 'da13efd5c2a166131673c6e21008d61fdf5a9f07', 'Blu-Edition'),
('./Installer/js/consolelog.min.js', '525c3969c5b61f0807f1bdc1916c2c7a3345f54b', 'Blu-Edition'),
('./Installer/js/jquery.imgpreload.min.js', 'f4a578490ba62198f12795c1e464a34ffa7406df', 'Blu-Edition'),
('./Installer/js/themeswitcher.js', '71fc40bbd5eba8af6f0893f723683e30fb1676de', 'Blu-Edition'),
('./Installer/js/bootstrap/bootstrap.js', '5c0c564ac4b2a48ff266e32fce31c805587b20ac', 'Blu-Edition'),
('./Installer/js/imagesloaded.pkgd.min.js', '27a20d2018659a1a301b21322f4c99b51ab4cf65', 'Blu-Edition'),
('./Installer/js/bootstrap/bootstrap.min.js', 'd7ff2fe8bfce06c970704e80fd96ae843edf0064', 'Blu-Edition'),
('./Installer/js/jquery-1.7.2.min.js', 'abcd2ba13348f178b17141b445bc99f1917d47af', 'Blu-Edition'),
('./Installer/js/jquery-ui-1.8.19.custom.min.js', '2fd761ffeabd3ce25d0f9381047be2b03b966c8a', 'Blu-Edition'),
('./Installer/js/jquery.bootstrap.wizard.min.js', 'bc3e9047b457342220249faf94f9a8560351ab38', 'Blu-Edition'),
('./Installer/js/functions.js', '91cf1cc6a3acba122c3622f1b540cf8579f5bc0e', 'Blu-Edition'),
('./Installer/js/phpjs.js', 'e56041b08afa658da4e8858b0739d88617e4f33f', 'Blu-Edition'),
('./Installer/js/bootbox.min.js', '6dda8db89b2e27beafef592d74146406b5b56681', 'Blu-Edition'),
('./Installer/js/jquery.bootstrap.wizard.js', '2be180d874e1441befb341531f528c7ee01033b8', 'Blu-Edition'),
('./Installer/js/jquery.blockUI.js', 'f7a6356eda8e6b79fcb2b7d4eafabbd28adceacd', 'Blu-Edition'),
('./Installer/js/jquery.blockUI.defaults.js', 'fa02597719f9190ccb141601ff2871de69bd4f4b', 'Blu-Edition'),
('./Installer/logs/.htaccess', 'eef55d493b0a4bd96902afac38cb1dee0efd4382', 'Blu-Edition'),
('./Installer/bigdump.php', '6d70452d098a5a715042d3931779bc71cd11999f', 'Blu-Edition'),
('./Installer/docs/README/assets/css/documenter_style.css', '020f493343aaad0eb2dcdc72c746235d2379a30c', 'Blu-Edition'),
('./Installer/docs/README/assets/css/custom.css', '4845895a5e7399b24f6eb66f1d5dbe45caa70db3', 'Blu-Edition'),
('./Installer/docs/README/assets/js/font.js', '5f8eaba406419594345b32b03385985e62941d71', 'Blu-Edition'),
('./Installer/docs/README/assets/js/jquery.scrollTo.js', '1746eba0698bedcab4bc3fc106c51da6bbaa1d65', 'Blu-Edition'),
('./Installer/docs/README/assets/js/jquery.js', 'e3049e9f8a643b8b2cfd2ca5e6ab8bfd483efe99', 'Blu-Edition'),
('./Installer/docs/README/assets/js/script.js', 'edba760ef6302b2d7117523cd5a12fe8423b3012', 'Blu-Edition'),
('./Installer/docs/README/assets/js/google-code-prettify/prettify.css', 'db085ff4c34ea017a2cb6928de859ee30cc21fd3', 'Blu-Edition'),
('./Installer/docs/README/assets/js/cufon.js', 'f3d2a9d12706adb5c47ec64948e97fd34c666e54', 'Blu-Edition'),
('./Installer/docs/README/assets/js/google-code-prettify/prettify.js', 'a4e5934397f97f79b8066984475c90af8a970a36', 'Blu-Edition'),
('./Installer/docs/README/index.html', '2df559e4b8a55563aa8350cf4901f17f94b819b6', 'Blu-Edition'),
('./Installer/docs/README/assets/js/jquery.easing.js', 'c6f74009a95b2d6f9c7b39ec121a4ca53a490a04', 'Blu-Edition'),
('./Installer/docs/INSTALL', '6d488eed91ffb1e034a5650a55eda10c0901a142', 'Blu-Edition'),
('./Installer/docs/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./Installer/docs/TODO', '4d1f24cb75b8ef85585f16b37a3282be64fa6617', 'Blu-Edition'),
('./Installer/docs/ABOUT', '950f32dbe10c4e670bc6558d15165dd255c75179', 'Blu-Edition'),
('./Installer/index.php', '6aff2a81b91d23782889aabfd03bd2fa21e417fa', 'Blu-Edition'),
('./Installer/templates/default/html/index.tpl', 'b7ec6e51a61aa58f23769bf926a64790ce90c249', 'Blu-Edition'),
('./Installer/templates/default/html/error/error.tpl', '02c1129d3a7ea2a354dfcbcfcd219c187efa694a', 'Blu-Edition'),
('./Installer/templates/.htaccess', 'eef55d493b0a4bd96902afac38cb1dee0efd4382', 'Blu-Edition'),
('./Installer/templates_cache/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./contact_Upload Errors.txt', 'adfb049c812417ef51443d3f04e5565c1d1e9e0a', 'Blu-Edition'),
('./torrentbar.php', '907a5bb329c27361d25e125063d6825b9040a617', 'Blu-Edition'),
('./subtitles.php', '30dd31d04d3ed3df28ac57d6289c57a36e14173d', 'Blu-Edition'),
('./pdon.php', 'fb230c9f9a74c0ada6f8cf8b6012529105759c86', 'Blu-Edition'),
('./phpmyadmin', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./private.php', '504e0dcd4acc3a030cdcc1506440041bd3ae033f', 'Blu-Edition'),
('./bet_opt2.php', '411849ae16d2bf921d9fb91df3f93a52ea1808e3', 'Blu-Edition'),
('./report.php', '6287d4e0d6b3b5400ceab5f9b33bc4d7e247bb28', 'Blu-Edition'),
('./_config-rating.php', '5ac2f1e318ff69b6731c8275b2c1e89ca8d03b6a', 'Blu-Edition'),
('./reports.php', 'f16fc8c271e1632bb5cc7e2ce81fd70b3697a453', 'Blu-Edition'),
('./smf_import.php', '848e5b55333ddd53daa660b1636920ce17721c9b', 'Blu-Edition'),
('./votesview.php', 'b04f79aeaec0962dfc60b19125172209a591b439', 'Blu-Edition'),
('./viewnews.php', 'b6a203b68d46450ff86376148a32df64a4fb65ce', 'Blu-Edition'),
('./agree.php', 'e50b8b48fa0bf5a68f12e1895a6f8aa78431f9f9', 'Blu-Edition'),
('./upload.php', '9c331a555112caa3d1ff49d61292e236fdab0786', 'Blu-Edition'),
('./allshout.php', '9604972a8089e8c47b76254b26d02e24ed227c41', 'Blu-Edition'),
('./rebooted.php', 'c29314b9520bdee3e42c245ef1893853f57621c3', 'Blu-Edition'),
('./index.pages.php', '760ea0222a479cab7920ff44d977292d291d9384', 'Blu-Edition'),
('./suggest.php', '3f762d3d60b10ab7dbff0d9cf22c6ff67653f9e9', 'Blu-Edition'),
('./uploadrequest.php', '1f722678caa586d7173c88a37696b884cc84a821', 'Blu-Edition'),
('./ipb/Upload_IPB_Here.txt', '6062f706ebac266cfca7979ac6b72927f8087bc9', 'Blu-Edition'),
('./download.php', '00c01aa00f4ae979d12befc802df6fef57da2afb', 'Blu-Edition'),
('./jscript/request.js', 'e8d74b1402492173735a459605eed35cef6aa9bd', 'Blu-Edition'),
('./jscript/jquery.tools.tooltip.min.js', 'ba7781f639bc83821f3f2866ffa38a1b62c80c0b', 'Blu-Edition'),
('./jscript/floatbox/floatbox.js', '428b70fcaeaafedd5a6a572df9f02003b7433fd5', 'Blu-Edition'),
('./jscript/floatbox/framebox.js', '1db6497685b440733fa80bfc10649f792bcc931d', 'Blu-Edition'),
('./jscript/floatbox/floatbox.css', 'f1ff3d8a22d11232ad35d76989c2e8332453b900', 'Blu-Edition'),
('./jscript/floatbox/floatbox_big.css', '989ad29e0974bc98192484c6df867021437d4a68', 'Blu-Edition'),
('./jscript/floatbox/images/xtras/index.html', 'aa68d185799e94ca3ae040a7d8f885ae1949af57', 'Blu-Edition'),
('./jscript/floatbox/images/index.html', 'd5dc95880bf285be8f7af2f503e75450577ff423', 'Blu-Edition'),
('./jscript/floatbox/images/big/index.html', 'aa68d185799e94ca3ae040a7d8f885ae1949af57', 'Blu-Edition'),
('./jscript/floatbox/index.html', 'd5dc95880bf285be8f7af2f503e75450577ff423', 'Blu-Edition'),
('./jscript/floatbox/docs/instructions.html', '00167905916ca4656bc3fa8fd29a6fd45880a9e3', 'Blu-Edition'),
('./jscript/floatbox/docs/options.html', 'ee318cc9d4ff17efc995dfbd389e435fcb5da268', 'Blu-Edition'),
('./jscript/floatbox/docs/floatbox_source.js', '09c8f05630b18b30d3da6f8d6b98ac39300424a1', 'Blu-Edition'),
('./jscript/floatbox/docs/index.html', 'd5dc95880bf285be8f7af2f503e75450577ff423', 'Blu-Edition'),
('./jscript/jquery-migrate-1.2.1.min.js', '743052320809514fb788fe1d3df37fc87ce90452', 'Blu-Edition'),
('./jscript/angular.min.js', '022f3ec8815b7e846d0701328f8128543729a616', 'Blu-Edition'),
('./jscript/animatedcollapse.js', '597ff363ddb6e36e458084fce4ab23070873d494', 'Blu-Edition'),
('./jscript/prototype.js', '8544be1041cb59f5baca815d83d729fe1810b2cb', 'Blu-Edition'),
('./jscript/snowstorm.js', 'a58fc314ede471f803f6003a1e0f72bc0853d188', 'Blu-Edition'),
('./jscript/xbtit.js', '1197806f181514d81d1e839481bf91759a52fefc', 'Blu-Edition'),
('./jscript/logincollapse.js', '41008d6e01c962642232c503ba9fa7981c5e068a', 'Blu-Edition'),
('./jscript/ajax.js', 'ac3baa41c9dfbe4c9b6169affe94f15564c0abfe', 'Blu-Edition'),
('./jscript/jquery-ui.min.js', '88c386b3e22be642e92a26ccb15c2d3214091d3d', 'Blu-Edition'),
('./jscript/jquery.lightbox.js', '95739490a1919adbf5198c9cf3279d65e33d582a', 'Blu-Edition'),
('./jscript/sliderman.1.3.7.js', '5d27fbd99f87c77b07a0834b9b3837ae69315615', 'Blu-Edition'),
('./jscript/jquery.ccslider-3.0.2.min.js', '6416d9ec9a19060093054141c374f291899cbeef', 'Blu-Edition'),
('./jscript/jquery.multiselect2side.js', '5b2a040f20db89e8b3bbf85b343e6c040a14da9a', 'Blu-Edition'),
('./jscript/script.js', '2f501378c52129f6a75f65e6abc79553bb582c2d', 'Blu-Edition'),
('./jscript/jQueryRotate.min.js', 'b9c456dc16937ae8d791710248047c5012dae38f', 'Blu-Edition'),
('./jscript/scroll.js', 'aa1babb2d7c3e9dffc0fb2a1db939cb948e784db', 'Blu-Edition'),
('./jscript/jquery-1.11.3.min.js', '276c87ff3e1e3155679c318938e74e5c1b76d809', 'Blu-Edition'),
('./jscript/sliderman.css', 'c53756e04f6ced733c877be91ba77d709f576e12', 'Blu-Edition'),
('./jscript/pngfix.js', 'd2cdb59616627322caeceb02674bb36df25e2d9a', 'Blu-Edition'),
('./jscript/countdown.js', '731eb2caad90d89871446269ea891eb3d9c36e20', 'Blu-Edition'),
('./jscript/anon.js', '23103202afd15ac4270f4c1f3d8d6a319bf36e96', 'Blu-Edition'),
('./jscript/jgauge-0.3.0.a3.min.js', 'ef13a74850c7723ded49ea95ba07b9fcad606fea', 'Blu-Edition'),
('./jscript/tooltip.js', 'e7b011bf3fa96ef0affe08bbdd3d95d8e409e94b', 'Blu-Edition'),
('./jscript/pm.js', '85234f96030648783c0ff842e218c7dc45876ae4', 'Blu-Edition'),
('./jscript/snowstorm-min.js', '14381c20f7196db0c80cab5945a017e9897f658d', 'Blu-Edition'),
('./jscript/announcement.js', '30e08fb38e41c2c1d71c496b831bc2502919595f', 'Blu-Edition'),
('./jscript/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./jscript/suggest.js', '4a515d4a3e5586aa757d5c135cee08bd70093326', 'Blu-Edition'),
('./jscript/btit_functions.js', '6100255d90e7889ad77ed27315ab187decc2127b', 'Blu-Edition'),
('./jscript/imdb.js', '3dc9f7c2642efff4482e68c9d9df874bf98f5bcb', 'Blu-Edition'),
('./jscript/categories.js', 'fe6c423865b4463cd0fe94bd8770ce2c4aa61c5e', 'Blu-Edition'),
('./jscript/faq.js', '02278738c241a7c5e44b9ae324e38cd85a1a84f4', 'Blu-Edition'),
('./jscript/ajax-poller-admin.js', '60596a88e091c7d2415d9e69585cb03eb5db3bfc', 'Blu-Edition'),
('./jscript/overlib.js', 'b038ae449d44ea7066549155c7fd15c1e4bea90d', 'Blu-Edition'),
('./jscript/effects.js', '21ce51daa693e3716678ac4190369b499b35e8de', 'Blu-Edition'),
('./jscript/preview.js', 'c45f5459fb9f71caba6e56f20ac7ed9f2a1e18f0', 'Blu-Edition'),
('./jscript/pace.js', 'b49c10cd65d9488f7338e3c778e55ac6628650f3', 'Blu-Edition'),
('./jscript/jquery.easing-1.3.min.js', '2725ed6948f181eeb10d53f015c2d05930c3f2bf', 'Blu-Edition'),
('./jscript/Featured_Torrent/strapslide.js', '2d82e79fe34195a5639124604333c35299f98398', 'Blu-Edition'),
('./jscript/Featured_Torrent/strapslide old.js', '365522e53c4b81ca1217843abed473cb5ec837b4', 'Blu-Edition'),
('./jscript/Featured_Torrent/jquery.fitVids.js', '02861efeae39170a70e03c808cbb24cbc2e0a147', 'Blu-Edition'),
('./jscript/Featured_Torrent/jquery.mousewheel.js', 'fc4f72339f0e401780d6323cf7c7cab23dd9186f', 'Blu-Edition'),
('./jscript/Featured_Torrent/jquery.transit.min.js', 'e455f4b344af907a34d70c758d8e07b5dde61761', 'Blu-Edition'),
('./jscript/Featured_Torrent/jquery.touchSwipe.min.js', '0808ec7bc3783ce6687927b6329ffe44eee3c90b', 'Blu-Edition'),
('./jscript/passwdcheck.js', '930f56f72f1bf40bd6d05bff0042213b9493ba6a', 'Blu-Edition'),
('./jscript/ajax-poller.js', 'ec68ed0955a86bee5e905448e156d5ef098be550', 'Blu-Edition'),
('./jscript/lightbox.js', '2a08a135e058f1612c63515b96952e7743b12775', 'Blu-Edition'),
('./jscript/newyear.js', 'f93f42a9d86fc506220efaf450bb58902fe68710', 'Blu-Edition'),
('./jscript/scriptaculous.js', '914db330c7fe585dfeddce713558f04328fb51db', 'Blu-Edition'),
('./jscript/basiccalendar.js', 'f95c86204c8d36af3de3f8ccf4e5ea023742272c', 'Blu-Edition'),
('./jscript/TorrentName.js', '5034fac96f3e9a7e72c45c3ae286923456094410', 'Blu-Edition'),
('./modules/getrss/index.php', '5ddb8cbdb962c4df3eccde541fcd45028f9e980e', 'Blu-Edition'),
('./jscript/tabber.js', '138d0e9f28ede8edf0a07ebf5f8716a21b293eef', 'Blu-Edition'),
('./modules/seedhelp/index.php', '083832a4437b71f67572011a719c91ee64ef9751', 'Blu-Edition'),
('./modules/nat/index.php', 'f29be4f04391ab0a8f0fa4fea217cc0aa1fd9c37', 'Blu-Edition'),
('./modules/pool/index.php', '2295be1d0a8d6d2eff8b7aa3c40accd81047c120', 'Blu-Edition'),
('./modules/seedbonus/index.php', '39b3bd6626df3da64199eb710e5a9d5678dc0e65', 'Blu-Edition'),
('./modules/shout/index.php', 'c2131cb99bc3f02b8a6209f708d8960a31bd60d0', 'Blu-Edition'),
('./modules/gallery/index.php', 'e577b1ae26847327f8f8f941412180f37db9f2c8', 'Blu-Edition'),
('./modules/helpdesk/index.php', '92bf87b46b70016dadcff84989d40b9b2b55f363', 'Blu-Edition'),
('./modules/covers/index.php', '7a6a1624c1cc725f69a47e58b31e3f08742b9fbd', 'Blu-Edition'),
('./modules/bugs/index.php', 'eb90368ac03fbfa4ec689d6f8f77eb2bf303b5ba', 'Blu-Edition'),
('./modules/cache/index.php', 'ec98e9a87e1ec75f43c8fbdc45e6682c87b06238', 'Blu-Edition'),
('./modules/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./modules/hitnrun_cleaner/index.php', '4d7f1f9d1dfd7ca31e03a34bfa9a79027267837c', 'Blu-Edition'),
('./modules/hitnrun_cleaner/uload.php', '62b4e973624c425f55608198c6851c6ea67a7a82', 'Blu-Edition'),
('./bet_admin.php', '4b6f2e07141a2f3beb4f4df748f7de606ee52a22', 'Blu-Edition'),
('./user/usercp.kis.help.php', '97cd44a29a530b7cd0218d8dc816288f6dcf7f49', 'Blu-Edition'),
('./user/usercp.kis.invite.php', '88b95d79816ff7f57f2fbc9c386af967c714c640', 'Blu-Edition'),
('./user/usercp.index.php', '7e1a78d3823095e3dac64f9cd3b4a263b8ee5bc6', 'Blu-Edition'),
('./user/usercp.avatar.php', '1e20aa834264eaabcb1217201c2f51363d0b6f99', 'Blu-Edition'),
('./user/usercp.profile.php', 'f9f9e3c2e3ebca243f2529d7417468f597df9c49', 'Blu-Edition'),
('./user/usercp.extras.php', '57824535ad29f587c25f8a12d5008b1f0264e3e9', 'Blu-Edition'),
('./user/usercp.invitations.php', '743efd0d83f42088953f8a9705a39267d65e4b79', 'Blu-Edition'),
('./user/usercp.kis.php', '5001ed4d506351002ce2a4919ab421adbd22bf66', 'Blu-Edition'),
('./user/usercp.pass.php', '8b57afb9b9d5368fce55e90dbcba14f7f569c536', 'Blu-Edition'),
('./user/usercp.menu.php', '7a00e71acd2fda2f1dc6b88d02500d8abb95eb0a', 'Blu-Edition'),
('./user/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./user/usercp.kis.view.php', 'bde57d3f1a03f96cf81eb132daad8525c7d6c495', 'Blu-Edition'),
('./user/usercp.main.php', 'b06087a6290781c9468413865d00d74287d0cb18', 'Blu-Edition'),
('./user/usercp.pidchange.php', '4ab9c95ff1aa1c72ded994d1e56159d25f16dcd3', 'Blu-Edition'),
('./user/usercp.pmbox.php', 'e69a1f7e9bda3bdb27a7a627e870d6ddd51617fc', 'Blu-Edition'),
('./style/index.php', '3b6deba82b18deced7d116b6b3944fd79f76d515', 'Blu-Edition'),
('./style/tron.css', '3afef15d1da3f252c91782c4a29a1bb57cc7fc2a', 'Blu-Edition'),
('./style/xbtit_default/admin.prune_users.tpl', 'de28c846f6eb8062224d0f0b4b1e8547e40be203', 'Blu-Edition'),
('./style/xbtit_default/admin.up_med.tpl', '84287fbfbf0240d7fedf4a4b01e65d4a1b44e744', 'Blu-Edition'),
('./style/xbtit_default/admin.lottery.tpl', '8517bd1b24cb8b3e1ec664c19e87f680e38fabc1', 'Blu-Edition'),
('./style/xbtit_default/radio.config.tpl', 'c7dedb7b1d9d187f0103a29bbafe0d36f7db7ac2', 'Blu-Edition'),
('./style/xbtit_default/news.tpl', '933971bacf52c2c05d1c1383ba640a7777da9770', 'Blu-Edition'),
('./style/xbtit_default/admin.smilies.tpl', '8c0d1cc0ce6a7d54bb3f0224d495ad51afef5621', 'Blu-Edition'),
('./style/xbtit_default/admin.rules.tpl', 'a2831678d116ad79bc187c94d18ac2cc9cf6342f', 'Blu-Edition'),
('./style/xbtit_default/admin.ticker.conf.tpl', '7a6b55206dfb4988db2e848dbb6b66ba4a473a22', 'Blu-Edition'),
('./style/xbtit_default/subsearch.tpl', 'ae76c7e5f9ca3d040dc21f1b462e5f2fa79e0144', 'Blu-Edition'),
('./style/xbtit_default/admin.donate.tpl', 'e43079a6df68066bc3757e0c55cb760785d63600', 'Blu-Edition'),
('./style/xbtit_default/rules.tpl', '715ca738a02fd96c34d3fc7ac1c10f455e44a3d9', 'Blu-Edition'),
('./style/xbtit_default/moresmiles.tpl', '86ca45a85e8b4208132d5b7bb96dd3aefba88af4', 'Blu-Edition'),
('./style/xbtit_default/admin.integrated_forum_poll.tpl', '7eab700f83f93626e6b9ec14376efcbf050c7e67', 'Blu-Edition'),
('./style/xbtit_default/admin.view_tickets.tpl', '330e04cd653f5f6b0599a5c0a91b82cf709bfec2', 'Blu-Edition'),
('./style/xbtit_default/admin.captcha.tpl', 'c7867627eaf74e018bfeb8ed708a35589e36b2e4', 'Blu-Edition'),
('./style/xbtit_default/forum.editpost.tpl', '452aa776b7e86f984a628cbb8126fde00bc8c2f6', 'Blu-Edition'),
('./style/xbtit_default/admin.file_hosting.tpl', '645008da61a4317288fe0b9ec2fa0adbf6a93b99', 'Blu-Edition'),
('./style/xbtit_default/admin.fls.tpl', '1683c92007b8291248d651d3194cccc80bef65b7', 'Blu-Edition'),
('./style/xbtit_default/admin.offline.tpl', 'f7acf64f2630157f34fd772b8cf1a22643026522', 'Blu-Edition'),
('./style/xbtit_default/admin.img_in_shout.tpl', 'edb06898d408477a8908dd972570e7ca522f6e92', 'Blu-Edition'),
('./style/xbtit_default/usercp.pmbox.tpl', '4902915a3d0519e04d5dd3f6498f946773104e7f', 'Blu-Edition'),
('./style/xbtit_default/friends.tpl', '2ab26b348ea56940242eaf2f2adcde919d0e413f', 'Blu-Edition'),
('./style/xbtit_default/admin.tmod_set.tpl', 'a5ce7a3b5185237c239254476b9c6abb5f879d26', 'Blu-Edition'),
('./style/xbtit_default/viewnews.tpl', '59e5840660e2e5315fc3d99eab8e6bc23580f0f1', 'Blu-Edition'),
('./style/xbtit_default/flash.tpl', '528393e7780f5f260744485ac19ccc1675c1fa9d', 'Blu-Edition'),
('./style/xbtit_default/usercp.pass.tpl', '5c761b00f5ffd5483f14e5b2b991525819e43ff2', 'Blu-Edition'),
('./style/xbtit_default/admin.agree.tpl', '688f714126c98020200ed9215a40115c74128d7a', 'Blu-Edition'),
('./style/xbtit_default/partners.tpl', '5abed1f59b2705d9c89e9ed4a8ff8a22d54c6dd7', 'Blu-Edition'),
('./style/xbtit_default/bet_bonustop.tpl', '5fd9a7176bec1d1da8b8962e24301e051c9f6a2e', 'Blu-Edition'),
('./style/xbtit_default/admin.integrity.tpl', '0954b4fb5d762db27eb829d2e3d87be8c5c748bb', 'Blu-Edition'),
('./style/xbtit_default/admin.users.tools.tpl', '372d890a5b731bd24aa48a56b678f610cc8b17e4', 'Blu-Edition'),
('./style/xbtit_default/error.tpl', 'c2c047ff73572eb776aac73d0683412d92fa7cb2', 'Blu-Edition'),
('./style/xbtit_default/all_torrents.tpl', 'f4f4293dec18405d3740bc91bce299ffae19953a', 'Blu-Edition'),
('./style/xbtit_default/login.tpl', '8cc3f6d5aca1931137c6a9269c106525345628a3', 'Blu-Edition'),
('./style/xbtit_default/admin.balloons.tpl', '05b19dd9b893a62a2e3824c1c2425b5ebc164ca9', 'Blu-Edition'),
('./style/xbtit_default/admin.uploader_control.tpl', '5524cc517686b973d0c207b0e9e1727d614bc7c8', 'Blu-Edition'),
('./style/xbtit_default/subsedit.tpl', '7092dc047ed08f7813c3f435e365c1cfb019a5e8', 'Blu-Edition'),
('./style/xbtit_default/subs.tpl', '87e384e128047d140f1f09ff69065ddccc6a0f9a', 'Blu-Edition'),
('./style/xbtit_default/imageflow.config.tpl', '97cc2404ddf76e8e416070568452b5fea5763ac0', 'Blu-Edition'),
('./style/xbtit_default/listen.tpl', '997bdb822ebb64711a6f8966d2a68a5f6ebbb389', 'Blu-Edition'),
('./style/xbtit_default/admin.rules.categories.tpl', '948494488777e60ad9ade098e1468eb5dc64c806', 'Blu-Edition'),
('./style/xbtit_default/usercp.profile.tpl', '87af8905a346096ae8e56495824d7bcf7dd6909a', 'Blu-Edition'),
('./style/xbtit_default/admin.seedbox.use.tpl', '9f55c52a60041b2b8c602f249f11f8f106c20461', 'Blu-Edition'),
('./style/xbtit_default/admin.massemail.tpl', '0a4c56f559bbabce69747f52ede9f9f3d9851835', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./style/xbtit_default/admin.specified_email_domains.tpl', 'e51a6ed8eae8570034b1162190869beeca442a33', 'Blu-Edition'),
('./style/xbtit_default/votesview.tpl', '7abd9d7ca06575a2fa5438f54545a9ec73a15346', 'Blu-Edition'),
('./style/xbtit_default/admin.kis.help.tpl', 'ad8aadbf409694d33535d04ff6875b3f25494ab6', 'Blu-Edition'),
('./style/xbtit_default/admin.search_diff.tpl', '5ce891dd44b0be43434eb51cb6b7b64f618082ab', 'Blu-Edition'),
('./style/xbtit_default/slots.tpl', 'f2b3f1fbdb4c3518881ba58a885f4e8e07bc21a8', 'Blu-Edition'),
('./style/xbtit_default/admin.modpanel.tpl', 'f8db384e63de9515c6ade452123a876caa1a42fa', 'Blu-Edition'),
('./style/xbtit_default/lottery.tickets.tpl', '46beffe1277ae34404aeefef23b652d960e85f7f', 'Blu-Edition'),
('./style/xbtit_default/reports.tpl', '213d7fbcead774af7082d8a52fc09ffd21701792', 'Blu-Edition'),
('./style/xbtit_default/warn.tpl', 'f3500d531e9fa9e7c74c11973c1b251d8bbffe7a', 'Blu-Edition'),
('./style/xbtit_default/donate_options.tpl', '8831aafd264074f31aaecf23594f247f37c19a33', 'Blu-Edition'),
('./style/xbtit_default/extra-stats.userb.tpl', 'f1411c1335c9f75b85335674df95b103f6646c3b', 'Blu-Edition'),
('./style/xbtit_default/arcadex.tpl', 'ada170d125365bac6847e0d27269512362207178', 'Blu-Edition'),
('./style/xbtit_default/admin.banbutton_user.tpl', '182ad2b10a20f2c47710799cd82280c400245415', 'Blu-Edition'),
('./style/xbtit_default/file_hosting.tpl', '8f8cb17fcba5c90b64d25b09e020d529f96d9ae3', 'Blu-Edition'),
('./style/xbtit_default/bet_coupon.tpl', '39e9ae20a8bee760626b04bd222f78ac394a42dd', 'Blu-Edition'),
('./style/xbtit_default/pp_new.tpl', 'ec79a8b9002fd06b90db4dfde92ba2bf43d2d7bc', 'Blu-Edition'),
('./style/xbtit_default/requests.createreq.tpl', '9c28c415c3e202da3f9b692d3803674669e3b7fd', 'Blu-Edition'),
('./style/xbtit_default/grabbed.tpl', '56158dcdc4f123d64b73ec79770a2c51e1830f56', 'Blu-Edition'),
('./style/xbtit_default/bet_admin.tpl', 'f071c77b3172cd987cd14ef3d14d10f63083fa8d', 'Blu-Edition'),
('./style/xbtit_default/subadd.tpl', '46057b88b928bb30c102669e1149b5538e094dc2', 'Blu-Edition'),
('./style/xbtit_default/admin.proxy.tpl', 'cfc4023b77dd36817b63f0b5c0689ad1e184750d', 'Blu-Edition'),
('./style/xbtit_default/admin.autorank.tpl', '6af52061eec809e7f79b2492ce273c83142fee28', 'Blu-Edition'),
('./style/xbtit_default/admin.adv_prune_torrents.tpl', 'c73fb8da2ca915b165ed8d6f6dc7ce1e3fadfd3d', 'Blu-Edition'),
('./style/xbtit_default/requests.main.tpl', '97dd425ef4d8a9e66120cbb73f15d5373d1e9e2d', 'Blu-Edition'),
('./style/xbtit_default/admin.team.tpl', 'fb094e88b6bb8d59550581dc03be95cec845e292', 'Blu-Edition'),
('./style/xbtit_default/pz_new.tpl', 'd3ca6d24c802cfc5f2d08976c88e188f216a779f', 'Blu-Edition'),
('./style/xbtit_default/admin.rep_high_ul.tpl', '47b2752f8c733427a018dca8f63fcb315e189f89', 'Blu-Edition'),
('./style/xbtit_default/all_torrents.uploaded.tpl', 'b3b1c508baec79146511e6dafce23687c9c40296', 'Blu-Edition'),
('./style/xbtit_default/admin.groups.tpl', '119bf567c3c370f337172c4396e5eed38aed6721', 'Blu-Edition'),
('./style/xbtit_default/irc.tpl', '154740806b59e25cfd4bbeed6a09a7634d62e114', 'Blu-Edition'),
('./style/xbtit_default/votesexpectedview.tpl', '34036124bbd1bb1dbabb97fbc17ccf8c639ce971', 'Blu-Edition'),
('./style/xbtit_default/admin.hide_language.tpl', '34e0407874f77bae301da697e8d66b59191cbc0f', 'Blu-Edition'),
('./style/xbtit_default/style_copyright.php', '9e11bd6f9ea70a156a16bab9aeeaebad2c9d91b1', 'Blu-Edition'),
('./style/xbtit_default/admin.loglog.tpl', '93d0eec43cf95720838bba94f99e6b19445b06c7', 'Blu-Edition'),
('./style/xbtit_default/admin.apply_membership.tpl', '46de026b78215a5263a4271fde9820e10a6cf36d', 'Blu-Edition'),
('./style/xbtit_default/forum.viewtopic.tpl', 'cca9486b470a706351a9ec69d7410bf2a3b5dccc', 'Blu-Edition'),
('./style/xbtit_default/admin.sticky.tpl', 'ab0b95733f1cfa1a58fab6b5d0941078728f3a13', 'Blu-Edition'),
('./style/xbtit_default/admin.archive.tpl', '0361ca4e02c6d97868257540afc6ede49bd15f83', 'Blu-Edition'),
('./style/xbtit_default/usercp.invitations.tpl', '2b5b13d5ec7ff90ab375b8c1ceee3c8b500de764', 'Blu-Edition'),
('./style/xbtit_default/forum.subforums.tpl', '3388b86badf6c5a3a3bfb267c632a13a1b7d42d8', 'Blu-Edition'),
('./style/xbtit_default/admin.blocks.tpl', '07de8338f898f3fbdf9243a6bee6f4e38a923f8d', 'Blu-Edition'),
('./style/xbtit_default/img/blueimp/play-pause.svg', 'b8c1fe6cad6d87bb6f31e313bc5e4680c77d2632', 'Blu-Edition'),
('./style/xbtit_default/img/blueimp/video-play.svg', '13c7369fbf619b5db6e006f03dd853e5cf7e7557', 'Blu-Edition'),
('./style/xbtit_default/img/blueimp/error.svg', '7f7949ec961fcf09cda44ae85aa775a6214ce78e', 'Blu-Edition'),
('./style/xbtit_default/admin.prune_torrents.tpl', '5c743f4ecdd4def23562770b6589f4b97dd92cbc', 'Blu-Edition'),
('./style/xbtit_default/usercp.menu.tpl', '6f0c9e757d68edc035a9c779c41de2d2f1047285', 'Blu-Edition'),
('./style/xbtit_default/all_torrents.snatched.tpl', 'db73848414fe03204e76ae4f6b4f4bc3fa3a7346', 'Blu-Edition'),
('./style/xbtit_default/information.tpl', '79683303f0e908e5f77b9b650f7bbe020e85e9d8', 'Blu-Edition'),
('./style/xbtit_default/admin.pd-block_cheapmail.tpl', '0bef1f2f84eb2b6c70be88221b9089140ac6fcc7', 'Blu-Edition'),
('./style/xbtit_default/admin.kocs.backup.tpl', '901d447a76b5705ed9f88c4f25719eacf6777d51', 'Blu-Edition'),
('./style/xbtit_default/admin.cats.forum.tpl', '59b47bbbc620197de38ca65469de671c28feecf1', 'Blu-Edition'),
('./style/xbtit_default/admin.notemod.tpl', '07e8f8fa697ad9b0c75fd2f9d85335cf3c87797a', 'Blu-Edition'),
('./style/xbtit_default/bet_opt.tpl', '44abecdf69a5f9ed6954a8ff610aae00240704d4', 'Blu-Edition'),
('./style/xbtit_default/admin.online.tpl', 'c1f8e08a2f9131a8d90f49129e2d0dd2900e1355', 'Blu-Edition'),
('./style/xbtit_default/admin.hitrun.tpl', 'a53fdb0d4f7ff53e631dac284011b0a8ae09213f', 'Blu-Edition'),
('./style/xbtit_default/downloadcheck.tpl', '33ca26fa0feebc960bce2cae4b6687ee04bffa8e', 'Blu-Edition'),
('./style/xbtit_default/admin.client_clearban.tpl', '9e9620094e58cf06f53c0f10d85b85e1576b2bac', 'Blu-Edition'),
('./style/xbtit_default/admin.kocs.badkey.tpl', '5741c19b9a1db7104a85f73031bd4434498152d4', 'Blu-Edition'),
('./style/xbtit_default/admin.teams.tpl', 'e804a36667630be2466d6e66bfaa5f88d77a8ef0', 'Blu-Edition'),
('./style/xbtit_default/admin.warned_users.tpl', '7bdbf1091757fb2d2b877b7a9ff5b83f405a22ab', 'Blu-Edition'),
('./style/xbtit_default/txtbbcode.tpl', 'c3a35afa1c8053ea70282333234a71cb987a8751', 'Blu-Edition'),
('./style/xbtit_default/lottery.purchase.tpl', '19a3bc452db9d90cb17d845cfb9f54d3792b0179', 'Blu-Edition'),
('./style/xbtit_default/fav_up_up.tpl', '518f334411436481df3ba59a6abad9f50e9e9e65', 'Blu-Edition'),
('./style/xbtit_default/torrent_history.tpl', 'dea9f2396bb693c3ffb635833393960e62323f11', 'Blu-Edition'),
('./style/xbtit_default/admin.hide_style.tpl', 'fbb364e026c4fc0e037787a1918e0246fadd8b22', 'Blu-Edition'),
('./style/xbtit_default/report.tpl', 'bf04699815556001118261b15a8254a23aa7c86b', 'Blu-Edition'),
('./style/xbtit_default/admin.kocs.config.tpl', 'd5bd35edfb0f475a4c1d50df5fd68dc15a74e125', 'Blu-Edition'),
('./style/xbtit_default/upload.tpl', 'f8863e2b3d99d5116c95faeaf7607ed86233c1de', 'Blu-Edition'),
('./style/xbtit_default/admin.module_config.tpl', 'fd6a5dd7e4e87a1ed8937fed050b559ed36eb2b2', 'Blu-Edition'),
('./style/xbtit_default/admin.gold.tpl', 'bead9442f20d8c02babc9a8d8898b300838a8d4f', 'Blu-Edition'),
('./style/xbtit_default/admin.polls.tpl', '41dd1fafe189ecaa7989505ab99209c501442dbe', 'Blu-Edition'),
('./style/xbtit_default/admin.user_notes.tpl', '8123ed2bed9c4565f1ae1a5d451943af540bd36d', 'Blu-Edition'),
('./style/xbtit_default/bookmark.tpl', 'd2f6ce6f50e9398403a9558919dd289bd760ef1e', 'Blu-Edition'),
('./style/xbtit_default/admin.forums.tpl', 'f90cdbe98f5a871c1154bfcfb21ad347a3f46979', 'Blu-Edition'),
('./style/xbtit_default/admin.whereheard.tpl', '1fa4dfb79011f43ef4032f38436af142f609ca76', 'Blu-Edition'),
('./style/xbtit_default/lottery.winners.tpl', 'fef76a4010519065a82a7ffc0270113bd43ffef7', 'Blu-Edition'),
('./style/xbtit_default/admin.sitelog.tpl', 'fd81938c66f171e859498297eeec24aa878c8e66', 'Blu-Edition'),
('./style/xbtit_default/torrent.listdc.tpl', 'b095b8686663fc65da7b12ca8f410d4293f146ff', 'Blu-Edition'),
('./style/xbtit_default/offer_comment.tpl', '62fdfd51aefcff15a7b2c801910bdfa6e0ce23a5', 'Blu-Edition'),
('./style/xbtit_default/gallery.tpl', 'bcfbc45f8c5a03f06ad1967a0f392c89f2360bd4', 'Blu-Edition'),
('./style/xbtit_default/admin.random_reg.tpl', '23d9920c3918e874350c3516a592ecc477584264', 'Blu-Edition'),
('./style/xbtit_default/admin.dl_prefix_or_suffix.tpl', '5916a4f8eb15825b94881ad1afefc34b14833c8a', 'Blu-Edition'),
('./style/xbtit_default/admin.kis.invites.tpl', '4d0a46dbfeccb7069c52b0e8066ba3da45811aa6', 'Blu-Edition'),
('./style/xbtit_default/expectedit.tpl', 'b560f48cdd5fb06b9034a45be5419af46bc3ff7c', 'Blu-Edition'),
('./style/xbtit_default/all_torrents.seeding.tpl', '2b4b46be5529f433abc6ee0f60b9b25f21c0e5d3', 'Blu-Edition'),
('./style/xbtit_default/admin.dbbackup.tpl', '194a905a6c4c62d80008d0c77a9313a4af266e85', 'Blu-Edition'),
('./style/xbtit_default/bc.tpl', 'f032438daa5d0de337b71bcd920d73b242047190', 'Blu-Edition'),
('./style/xbtit_default/admin.seedip.tpl', 'f2cb14582533daf014bae49de4a804ff60641496', 'Blu-Edition'),
('./style/xbtit_default/admin.seo.tpl', 'bb788b821ebd908a161c04c090cc2024726feb36', 'Blu-Edition'),
('./style/xbtit_default/extra-stats.forum.tpl', '71be040fb36a18c48993052ef0cdaf6bab941421', 'Blu-Edition'),
('./style/xbtit_default/usercp.extra.tpl', '450c8e1d21d5f144c686b4f288327d1e163aff74', 'Blu-Edition'),
('./style/xbtit_default/apply.tpl', 'a65119471b11fca198dfbc52b5ba96b45c9926c5', 'Blu-Edition'),
('./style/xbtit_default/admin.languages.tpl', '6b829219214f5e5ad6961440050e9954ba0e4c81', 'Blu-Edition'),
('./style/xbtit_default/bet_info.tpl', 'ccf3a3f26348984e0b78aaeff78e3efea12e9bcf', 'Blu-Edition'),
('./style/xbtit_default/admin.lrb.tpl', 'e81d4a5aef096a8e4b5905db3a237cd89fea128f', 'Blu-Edition'),
('./style/xbtit_default/admin.bonus.tpl', '7365506923f8e7306e434c46088fb134c1d7033a', 'Blu-Edition'),
('./style/xbtit_default/uploadrequest.tpl', '82f69e9dab85629f236d866c5502e343a3b45390', 'Blu-Edition'),
('./style/xbtit_default/usercp.kis.help.tpl', '6efe7a2174bbdd57e87a5e858b7460cc54115060', 'Blu-Edition'),
('./style/xbtit_default/torrent.delete.tpl', 'c50b0db04582a7e54ce28edd7277fafe109feb8c', 'Blu-Edition'),
('./style/xbtit_default/contact.tpl', '0bc2f36dc0ccc755f64636f15ad1d2032b0050a8', 'Blu-Edition'),
('./style/xbtit_default/torrent.edit.tpl', '5183989a682eec314ace7644c1df28dfe469aaaa', 'Blu-Edition'),
('./style/xbtit_default/viewexpected.tpl', '3c09ae8e01542b5c4857f38810c9f61e5ea95698', 'Blu-Edition'),
('./style/xbtit_default/hack.nodb.tpl', '5ff350b331b51f9452d0a632a0eb48058fdb6515', 'Blu-Edition'),
('./style/xbtit_default/admin.birthday.tpl', '4f52da528eee3c3482b3b0a4d7f8a1887df78f48', 'Blu-Edition'),
('./style/xbtit_default/admin.requests.tpl', '8ed67185ebe57eab693b157e5d0cb0929e8fd9fb', 'Blu-Edition'),
('./style/xbtit_default/admin.hacks.tpl', 'd1ce9296e7f1861a5a7f3b1c85e5eb29142f7aa3', 'Blu-Edition'),
('./style/xbtit_default/votesexpectedviewmin.tpl', '34036124bbd1bb1dbabb97fbc17ccf8c639ce971', 'Blu-Edition'),
('./style/xbtit_default/admin.ads.tpl', 'fbbd1176c729c710256c4d37a2c7b7b77428577e', 'Blu-Edition'),
('./style/xbtit_default/images/categories/index.php', '32ee218e1ea28cebad135a67b21a6ecc83bbe8ee', 'Blu-Edition'),
('./style/xbtit_default/admin.faq.question.tpl', 'b2830ecebe5a1260e44c5115d65452e122713d96', 'Blu-Edition'),
('./style/xbtit_default/admin.watched_users.tpl', 'c111dc1dd3f4543bacdfee796c6098e5781f2d39', 'Blu-Edition'),
('./style/xbtit_default/expectdetails.tpl', 'b2b779c040add1f68e1a22576a94bb623350beee', 'Blu-Edition'),
('./style/xbtit_default/pp.tpl', 'c42ab4c6028687c3c5fcd5cceb2c929b91933407', 'Blu-Edition'),
('./style/xbtit_default/bet_gamefinish2.tpl', '36bc94df35005322d6c0fd36c67abf58e1b89dfd', 'Blu-Edition'),
('./style/xbtit_default/admin.dlcheck.tpl', '4beb06c3557483298b8bfc2c4c6df11eb674ab41', 'Blu-Edition'),
('./style/xbtit_default/success.tpl', '6bb05cc411ba9b0344412e1982299209be6c9016', 'Blu-Edition'),
('./style/xbtit_default/hack.disabled.tpl', 'ecc670238f6d02e1d37bb996ace38b9074cb9970', 'Blu-Edition'),
('./style/xbtit_default/admin.menu.tpl', 'd8969a88b459146c46a0ca4e28de58c8a6583c2f', 'Blu-Edition'),
('./style/xbtit_default/main.tpl', '4a0b62c635638d966a59e5c8ed1a80b3162b7d24', 'Blu-Edition'),
('./style/xbtit_default/torrent.details.tpl', 'b146fa4d4934a411b23899c15e97d0cfdf8cc060', 'Blu-Edition'),
('./style/xbtit_default/admin.warn.tpl', 'c01b26c374299b21c470160f9b9179107d7e5d56', 'Blu-Edition'),
('./style/xbtit_default/forum.post.tpl', '5a766bf91d302c5a7cab7ca265d2888dbd0a5d5e', 'Blu-Edition'),
('./style/xbtit_default/admin.categories.tpl', '4764baf1c6cf46e072013dda65252730f80cc8b5', 'Blu-Edition'),
('./style/xbtit_default/bootstrap.css', '63cc536355ec7f4a27d564eba2cb5826794a9014', 'Blu-Edition'),
('./style/xbtit_default/admin.upload_rights.tpl', '7965a9ad9d6cd6e5239f19b7241771785a2d1e30', 'Blu-Edition'),
('./style/xbtit_default/admin.don_hist.tpl', 'be963122bd983a89b22113b030200e916d7f73a2', 'Blu-Edition'),
('./style/xbtit_default/mainmenu main.tpl/main.tpl', 'c8cd8800ce648ff4801b7eb875017bfb21dc3b45', 'Blu-Edition'),
('./style/xbtit_default/admin.banbutton.tpl', '896440c2e6167b8c54c89d9d734561254500b219', 'Blu-Edition'),
('./style/xbtit_default/bootstrap.css.map', '7d9441b7c167dc3822c0881c16c943094fcbaa38', 'Blu-Edition'),
('./style/xbtit_default/admin.booted_users.tpl', '0d20f51d6627b24dd8c30c96c02dd408bae940e3', 'Blu-Edition'),
('./style/xbtit_default/forum.search.tpl', 'dafa53632466b001b009d9083301f1e78659472e', 'Blu-Edition'),
('./style/xbtit_default/admin.dbutil.tpl', 'bb6c04ff668b88e138727d62948a33a5e8516a92', 'Blu-Edition'),
('./style/xbtit_default/admin.users.new.tpl', '911188f214f86d4fa22f88c4910e9300fe10207e', 'Blu-Edition'),
('./style/xbtit_default/usercp.kis.invite.tpl', 'bc965cd95e70bf0be487a85de5ae1f36f740f71d', 'Blu-Edition'),
('./style/xbtit_default/requests.details.tpl', '74d1e56bc0b25338a5e121eba4599647b4ab4bfe', 'Blu-Edition'),
('./style/xbtit_default/forum.viewforum.tpl', '2fc408931d8b2ce5c0920840916f7c910c67d3e7', 'Blu-Edition'),
('./style/xbtit_default/bet_opt2.tpl', 'f66eb65019fb42fadac60f9b1993150de7933a3a', 'Blu-Edition'),
('./style/xbtit_default/admin.sport_bet.tpl', 'c94ad0357726ab1ad2f24633c6a9e2c7e72df36f', 'Blu-Edition'),
('./style/xbtit_default/shoutbox_history.tpl', '17971b6cf15d3a215a054c2c6e20c0780bbc4ace', 'Blu-Edition'),
('./style/xbtit_default/admin.showporn.tpl', '55105e8f18b4765dc2ac7217b927cd71d02649f5', 'Blu-Edition'),
('./style/xbtit_default/admin.freecontrol.tpl', '076d239c380aae62155118a3fa49628b8fa463d0', 'Blu-Edition'),
('./style/xbtit_default/admin.protected_usernames.tpl', '09bda7b8f6ac5e4704771776c18bfa9fb5d9cb80', 'Blu-Edition'),
('./style/xbtit_default/admin.shout_announce.tpl', 'fea3a27da29ef7255967bf461d4a472b2da3b211', 'Blu-Edition'),
('./style/xbtit_default/usercp.kis.view.tpl', 'd703f9605e9e1fdc8c30061664cf7bbe4b80921c', 'Blu-Edition'),
('./style/xbtit_default/bet_nullbet.tpl', '6f490782c31f3dc8f1f940f9a6d2369d10591be8', 'Blu-Edition'),
('./style/xbtit_default/login_new.tpl', 'e708e84f7768386a6106e3480c8f4ecbd01b553b', 'Blu-Edition'),
('./style/xbtit_default/admin.recommend.tpl', 'b5c8ebf766c17caf7bc5483e4a06f891a9419e91', 'Blu-Edition'),
('./style/xbtit_default/teamstats.tpl', '79f617d552d9fca401ca5e8f34ffdd95131006f7', 'Blu-Edition'),
('./style/xbtit_default/admin.staff_control.tpl', '6e260094ad2786f2599d89ffe01855b0a371deec', 'Blu-Edition'),
('./style/xbtit_default/admin.adv_prune_users.tpl', '5906c0abef25b3d844f4e3c044c7b9a839a6c4f6', 'Blu-Edition'),
('./style/xbtit_default/admin.kis.award.tpl', '93741f3bcd1e2f006a9fa17e54e04c637993309d', 'Blu-Edition'),
('./style/xbtit_default/admin.toractcou.tpl', '0fd8be777669f2613f419b5b385cc64f6d15fac2', 'Blu-Edition'),
('./style/xbtit_default/admin.ban_client.tpl', '6b3afe8905611ab1865aa46e2512e201647d1e9e', 'Blu-Edition'),
('./style/xbtit_default/comment.tpl', 'b1d057941f527693b57f91e5360947a045cce892', 'Blu-Edition'),
('./style/xbtit_default/admin.backup.tpl', '0867c30fbefc185568454d46f56a78b283f455ec', 'Blu-Edition'),
('./style/xbtit_default/admin.warn_settings.tpl', '16c7e8ab092f7ea8b103a1d398e4f7996f7efb06', 'Blu-Edition'),
('./style/xbtit_default/bet_odds.tpl', '85df76a1e7048e9db3d47bde61f291a387574628', 'Blu-Edition'),
('./style/xbtit_default/admin.masspm.tpl', '7a4683a8d4942a76db0cfde9c36bfffc932e0bea', 'Blu-Edition'),
('./style/xbtit_default/index.php', '786a79a291d5e8202f00fe2a314019127ac1ea1b', 'Blu-Edition'),
('./style/xbtit_default/agree.tpl', 'b53df3a6735d0a353d889076286aa90c6d1e8a3c', 'Blu-Edition'),
('./style/xbtit_default/expected.tpl', '1f108c4b1f068784f4ba17025531daebec317393', 'Blu-Edition'),
('./style/xbtit_default/admin.don_edit.tpl', '8fe79825fe3c791567666870281c1b2f7686a07a', 'Blu-Edition'),
('./style/xbtit_default/bet_gameinfo.tpl', '586d42675194ad43f5470d8dace29bb6efc783f2', 'Blu-Edition'),
('./style/xbtit_default/admin.image.upload.tpl', '801780f0bdbb2a52f2af74916875a63d1fed40df', 'Blu-Edition'),
('./style/xbtit_default/bet_gamefinish.tpl', '592aceb91320ce6760d4c6dbd432f4e49fd28979', 'Blu-Edition'),
('./style/xbtit_default/private.tpl', 'cd7fcaa3d609be756e3576e79e9ade300615faea', 'Blu-Edition'),
('./style/xbtit_default/admin.kis.stats.tpl', '0edee203583c66a8b67db93254c47bf3a8f8c8c4', 'Blu-Edition'),
('./style/xbtit_default/friendlist.tpl', 'aa447a2d2954424fb35cbf1d7322d40137be5341', 'Blu-Edition'),
('./style/xbtit_default/account.tpl', 'bba382544279e9866b70ca2a9a43f70c8947c4ac', 'Blu-Edition'),
('./style/xbtit_default/userdetails.tpl', '0ec2cd20f212f47952fb97de5de6350177d77038', 'Blu-Edition'),
('./style/xbtit_default/forum.main.tpl', '71976182f193e590b5be9f90833f5eb9b6aac956', 'Blu-Edition'),
('./style/xbtit_default/admin.ban_button.tpl', 'dbe41b6272ded9ca158b00a6097ae4297ba534de', 'Blu-Edition'),
('./style/xbtit_default/admin.kocs.restore.tpl', 'a02c3e359ef4c4965431c17c177bcb6e505bb224', 'Blu-Edition'),
('./style/xbtit_default/admin.welcome_pm.tpl', '33a808bc6f69421010999566cb5295a7401731be', 'Blu-Edition'),
('./style/xbtit_default/extra-stats.torrent.tpl', 'f6b0587ae09d276741c9356b26a972adbdae5859', 'Blu-Edition'),
('./style/xbtit_default/warnlog.tpl', '96efd427d854b70e010eabb7f60dba5fe904d462', 'Blu-Edition'),
('./style/xbtit_default/admin.avatar_upload.tpl', '8ba3a216ee744305fd222570e7cdfca870581ea3', 'Blu-Edition'),
('./style/xbtit_default/admin.staff_comm_on_details.tpl', 'fe5f3e68abaf23ffa7748724af98044a6e1757d6', 'Blu-Edition'),
('./style/xbtit_default/admin.no_columns.tpl', '56a98e0d109f2362e0c4b722762d86dc5f67cdb3', 'Blu-Edition'),
('./style/xbtit_default/usercp.avatar.tpl', '7d60e9152b10cb29c424741dfb08f6fb1299d7f2', 'Blu-Edition'),
('./style/xbtit_default/shoutbox.tpl', '8375475bcd15f303e3b7d7ed7abf67dfe8594988', 'Blu-Edition'),
('./style/xbtit_default/usercp.pidchange.tpl', '578aab98755acf5a1f9564f44dc9c0160325be8b', 'Blu-Edition'),
('./style/xbtit_default/don_historie.tpl', '58dc8b5129334349e931e924a2b5d069350d53a3', 'Blu-Edition'),
('./style/xbtit_default/admin.security_suite.tpl', 'fb408445ceadb76de0ead2a54a8bb59e65a613de', 'Blu-Edition'),
('./style/xbtit_default/bc_new.tpl', 'ab7f624a6bda20123f5597e1549becc1a6a253dc', 'Blu-Edition'),
('./style/xbtit_default/admin.reencode.tpl', 'c5ce0422e208df358a864d19d0dc8d1d53029009', 'Blu-Edition'),
('./style/xbtit_default/admin.kis.users.tpl', '06580add1797a4b38c1b4df0058e7571316138f9', 'Blu-Edition'),
('./style/xbtit_default/admin.don.hist.tpl', 'fab1ca58a7d164ca44a8df6df86e0e6065d07448', 'Blu-Edition'),
('./style/xbtit_default/admin.pager_type.tpl', '5338fc4ba7604f611e8f43fbec60da36cbfc7711', 'Blu-Edition'),
('./style/xbtit_default/upload_finish.tpl', '73d53c11eca1144b46752444bceaffd6359e5a6c', 'Blu-Edition'),
('./style/xbtit_default/admin.php_errors_log.tpl', 'b9f39107a20a76d87f2ac739eaf25bb27a81fe21', 'Blu-Edition'),
('./style/xbtit_default/admin.hitrun.block.tpl', '23dfd2a40e7e852a53beaa97d79c1699db2a1231', 'Blu-Edition'),
('./style/xbtit_default/admin.signup.bonus.tpl', '673bff80eb5166a9249ec57a288d4d26f6d79628', 'Blu-Edition'),
('./style/xbtit_default/ppsynch.tpl', 'e594e5c8a4d1b62ec63531ea4f4cf84d2d6b507c', 'Blu-Edition'),
('./style/xbtit_default/admin.moder.tpl', '5a4d2a6dd5c64e49c1b536d0d6c38e835d121fab', 'Blu-Edition'),
('./style/xbtit_default/admin.reseed.tpl', 'd9ee45211da9d4f4519ac60ba48b004d700c8af2', 'Blu-Edition'),
('./style/xbtit_default/sb.tpl', 'd8049e9c7807e901f564b565118ba166875bf29c', 'Blu-Edition'),
('./style/xbtit_default/admin.twitter.tpl', 'b5cd37eec2e54d1b3bce80c9841d00f1168be2bd', 'Blu-Edition'),
('./style/xbtit_default/usercp.main.tpl', 'ad67b2822fa2d9f8b491ca5601d68e48c41aef69', 'Blu-Edition'),
('./style/xbtit_default/pz.tpl', '254945bb0fc943687230c97c3f9bc5c9e2992a4c', 'Blu-Edition'),
('./style/xbtit_default/txtbbcode_en.tpl', 'd90e0d9adb43c6bd5861c04116f559b4b2ad2d1f', 'Blu-Edition'),
('./style/xbtit_default/admin.main.tpl', 'f35a92e65b59a8fe62f85724dfeeac66d8b98294', 'Blu-Edition'),
('./style/xbtit_default/teampub.tpl', '5ae00dd3b0c35dc94d36a6b922d4b2edbe7286dd', 'Blu-Edition'),
('./style/xbtit_default/block.tpl', '469940222e28ae8b0db4ecdff7974c265c4bf33e', 'Blu-Edition'),
('./style/xbtit_default/admin.xtd.tpl', '96648df1137dfe3d62154a8243b9dd4d8a9e149b', 'Blu-Edition'),
('./style/xbtit_default/slotgo.tpl', '70632e29a7bb77768b83fcf0f0761e9bb88e6d32', 'Blu-Edition'),
('./style/xbtit_default/admin.invitations.tpl', '93855da69928b4ed6061746c0b2f407f05c5b35c', 'Blu-Edition'),
('./style/xbtit_default/banbutton.tpl', '785c9778337cc5e8b274094aeb8d73c1f9755ce0', 'Blu-Edition'),
('./style/xbtit_default/admin.gifts.tpl', '08e268dcf9d38251af6f29a93e135c1f7ebc4da0', 'Blu-Edition'),
('./style/xbtit_default/admin.ispy.tpl', '37cedb3fe29bddb7eee676bf5b2d0d5ac485babf', 'Blu-Edition'),
('./style/xbtit_default/admin.torofweek.tpl', '241ca1fac25c8c912e85c01834e597abfc306cc4', 'Blu-Edition'),
('./style/xbtit_default/admin.duplicates.tpl', 'd7de030bd2d6c52341036cb9e8148119900c6a64', 'Blu-Edition'),
('./style/xbtit_default/admin.blacklist.tpl', '2af7420e01f0f88adf2939700ddaf53958db807b', 'Blu-Edition'),
('./style/xbtit_default/forum.unread.tpl', '3fe2aeb7a9cca4c7ad4df050d0fe49d82e3d60c8', 'Blu-Edition'),
('./style/xbtit_default/admin.kocs.help.tpl', '8ea17153410fb6177d086d4b879047b38935db6f', 'Blu-Edition'),
('./style/xbtit_default/users.tpl', '26ce4ebdbb087f373c7d631154ebaf65193cac7c', 'Blu-Edition'),
('./style/xbtit_default/seedbox.tpl', 'bcfd9b88dfd5a4b98bd4adf35e3a7018a3d7b4bc', 'Blu-Edition'),
('./style/xbtit_default/admin.tvdb.tpl', '0907364bee2b420481a983a5a39d0b7620a68a65', 'Blu-Edition'),
('./style/xbtit_default/extra-stats.user.tpl', '9bfb30e7b115ce9e005f5b9f0e376a6e77e84f3e', 'Blu-Edition'),
('./style/xbtit_default/admin.featured.tpl', '557fdde0a4d50571655c2b1509e5f08fdf1a6670', 'Blu-Edition'),
('./style/xbtit_default/admin.intro_before_download.tpl', 'd4ae71fccb9cccceb8f991ef461f7771f7484a34', 'Blu-Edition'),
('./style/xbtit_default/fav_up.tpl', '7db211e0210651f4209a5578c495144deb2abd35', 'Blu-Edition'),
('./style/xbtit_default/extra-stats.posts.tpl', '94640026973c57e54c90baf10628c452126f1969', 'Blu-Edition'),
('./style/xbtit_default/admin.config.tpl', 'd47d430f555bdcff830bbe321ef9c400aeae6d58', 'Blu-Edition'),
('./style/xbtit_default/notepad.tpl', '3cf8663d7f1e9d35976e9b7af964e6e782a26213', 'Blu-Edition'),
('./style/xbtit_default/admin.faq.group.tpl', '8dd167ed7ce1585749c7fae73c108247713bfa91', 'Blu-Edition'),
('./style/xbtit_default/admin.styles.tpl', '13e537b20d04f3c822afef0e0c25c74ad8e64dc2', 'Blu-Edition'),
('./style/xbtit_default/recover.tpl', 'cea231de77ee9695310a3cc26c7ea3cf89ef4974', 'Blu-Edition'),
('./style/xbtit_default/bet.tpl', 'd45655861914814520f47ef10fd1428cb405c593', 'Blu-Edition'),
('./style/xbtit_default/torrent.list.tpl', '489248b5ae3793cf8900139726dad4d8e2028dbd', 'Blu-Edition'),
('./style/xbtit_default/dox.tpl', 'a43a954a065047d9b5a2bf83b45143db2615ed17', 'Blu-Edition'),
('./style/xbtit_default/admin.country_signup.tpl', '6bbfc04cfcae9a77f055143eaa97e6a1a27c4c0d', 'Blu-Edition'),
('./style/xbtit_default/admin.banip.tpl', '56831a65f4127282f0fbd3739fa6540db561a3d4', 'Blu-Edition'),
('./style/xbtit_default/admin.kis.config.tpl', '5a1d413175aafc5927bd5039d829c74f0fe572ef', 'Blu-Edition'),
('./style/xbtit_default/admin.style_bridge.tpl', '69d555e8df46aa68c1414f307004222ae9a40ed2', 'Blu-Edition'),
('./style/xbtit_default/admin.ratio-editor.tpl', '715071bd3577cde1530e7c990ea08455eebcfe65', 'Blu-Edition'),
('./style/xbtit_default/admin.read_messages.tpl', '46617d071e9ffae97bdf29fa35a4a30139320a25', 'Blu-Edition'),
('./style/xbtit_default/admin.user_images.tpl', '17f60420117357faadcd5e3951574bf832f73a7f', 'Blu-Edition'),
('./style/xbtit_default/faq.tpl', 'faf6c49d4268b0c63e30ca6c50bebae048624fb3', 'Blu-Edition'),
('./style/xbtit_default/admin.censored.tpl', '035ac0ab433953c90288dcb8aa404175d1b87f12', 'Blu-Edition'),
('./style/xbtit_default/user_img.tpl', '8428f7920a47ea3e08d42dd07831144d4429b109', 'Blu-Edition'),
('./style/xbtit_default/peers.tpl', '2cd6fda066735d70a57ee01e1d26d29721e7631f', 'Blu-Edition'),
('./style/light/images/categories/index.php', '32ee218e1ea28cebad135a67b21a6ecc83bbe8ee', 'Blu-Edition'),
('./style/light/bootstrap.css', 'a328628d563a4f7d824cc9e76e85fbcf2e0c3ee1', 'Blu-Edition'),
('./style/light/bootstrap.css.map', '7d9441b7c167dc3822c0881c16c943094fcbaa38', 'Blu-Edition'),
('./style/light/index.php', '786a79a291d5e8202f00fe2a314019127ac1ea1b', 'Blu-Edition'),
('./peers.php', '29e13287e149b14c0ac7f9d96d9647a953063fe2', 'Blu-Edition'),
('./details.php', 'fdb5cf95c7f676eb9c0666dad606860401e51954', 'Blu-Edition'),
('./backup/backup/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./backup/backup/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./backup/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./backup/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./font-awesome-4.5-2.0/fonts/fontawesome-webfont.eot', '986eed8dca049714e43eeebcb3932741a4bec76d', 'Blu-Edition'),
('./font-awesome-4.5-2.0/fonts/fontawesome-webfont.ttf', '6484f1af6b485d5096b71b344e67f4164c33dd1f', 'Blu-Edition'),
('./font-awesome-4.5-2.0/fonts/fontawesome-webfont.woff', '4a313eb93b959cc4154c684b915b0a31ddb68d84', 'Blu-Edition'),
('./font-awesome-4.5-2.0/fonts/FontAwesome.otf', '42c179eef588854b5ec151bcf6a3f58aa8b79b11', 'Blu-Edition'),
('./font-awesome-4.5-2.0/fonts/fontawesome-webfont.svg', 'b06b5c8f67fd632cdc62a33b62ae4f74194131b3', 'Blu-Edition'),
('./font-awesome-4.5-2.0/fonts/fontawesome-webfont.woff2', '638c652d623280a58144f93e7b552c66d1667a11', 'Blu-Edition'),
('./font-awesome-4.5-2.0/css/font-awesome.css', 'b488600451227b445414796e9b8550e7c1bd6d29', 'Blu-Edition'),
('./font-awesome-4.5-2.0/css/font-awesome.min.css', '12d6861075de8e293265ff6ff03b1f3adcb44c76', 'Blu-Edition'),
('./font-awesome-4.5-2.0/HELP-US-OUT.txt', '69a4c537d167b68a0ccf1c6febd138aeffca60d6', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/animated.less', '421f2c4e10191f148c13b8a34e5ff3f484d4c393', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/stacked.less', 'f044077bc8be1a989c245254e81eb084d52d29a7', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/fixed-width.less', 'ec0c24b97184dab86177660f486b8d08cd636c42', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/bordered-pulled.less', 'a2c292137b17406183ad0fdbf4880fd648b9a5ca', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/icons.less', '429f141f3fb8d208aa120b27f56b2752e11e2969', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/core.less', '1a37352286619b789d151a06eb4b7551e4c1aaa2', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/variables.less', '77cf688c0d91127a538fafe76c897d17fcb7b3d1', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/larger.less', 'e7119e82dc50540dbc3472bba7d74282815a7ecc', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/rotated-flipped.less', '95de5de9009714692430b04f9cd4388be8fba8f3', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/list.less', 'f53bc20884a1410d950b4a36a330c5181a8b55ab', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/font-awesome.less', 'ecb152f7ee25d5aea42db8cf3694a21d7f7b24c6', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/path.less', '47108f118b6a9643774b718dd4c56f4c81ce681b', 'Blu-Edition'),
('./font-awesome-4.5-2.0/less/mixins.less', '3a0717f78374197641fd7a9ff30dffe4c3207e10', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_rotated-flipped.scss', 'ca08a0af3da63c2f2a7d3c27a8747637744cc785', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_larger.scss', '940e1c5ebc690283bfaee92560cf15fabedbf6a9', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_variables.scss', '86410d7bed9d06c1d1bb6070207a4f5f1283d3d4', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_path.scss', '080158aeb1bf6df59ec98b2bbed44da61d9c9ca3', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_mixins.scss', '624682da7da2566b3c8d2d5fb268d8a73899b3ea', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_fixed-width.scss', '224417ca266c657849afb2bbcb6dc455894ff387', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_core.scss', '55a14a34267edc401b82e5ee41d8bd84fbb5da3f', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_list.scss', '4b53ee01513df8b9ce76442b2d8f1851613a435c', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_stacked.scss', 'cf6752ee609af36eb293a7197c88d31ecacbbc74', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_bordered-pulled.scss', '164b6a0a2b307cd293f4a914ab0fcdf643950374', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_animated.scss', '8daf189b2f8a404495b8424b6fd1ba630dd1c2dc', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/_icons.scss', 'dc8b100d2977dc34e71e7af8f5f5a6fc47977946', 'Blu-Edition'),
('./font-awesome-4.5-2.0/scss/font-awesome.scss', 'd502e54ad1a043e65f2af901a9ab425efa38aea1', 'Blu-Edition'),
('./flush.php', '9ed9e7635750451cb9e4656c4d58e9c7064914d3', 'Blu-Edition'),
('./shoutp.php', 'ef51b3cda1e436c39098a7b3c1e56af1da531d61', 'Blu-Edition'),
('./expectdetails.php', 'e72a21da4be4f1043e54dcdaf914d75d68d2ac3a', 'Blu-Edition'),
('./thumbnail.php', '8cfdf3fc86ecc19c258b0c20933dd60e98b936be', 'Blu-Edition'),
('./timedrank.php', 'f353406f3e55d45b92bf904f2b81fd145d68abd3', 'Blu-Edition'),
('./don_hist.php', '7545e2a0fc161e921d8c1774b87304557bbefd5d', 'Blu-Edition'),
('./donate_options.php', '7317131a26950c7d7a9fc6068c9213e9cb6aa84b', 'Blu-Edition'),
('./banbutton.php', '87ccd8d624e87aeb74bd4a8a27f39b1bbc58790c', 'Blu-Edition'),
('./title2.php', '30287a5a9900aa1f8dec644e47ff7996ed75df12', 'Blu-Edition'),
('./reseed.php', '84b9d10336e60730df9d6bd4d48a2bddb93ac0a6', 'Blu-Edition'),
('./watcher.php', 'd1c0c13a008caa3a5db51a77a1251a5ac0e7ee67', 'Blu-Edition'),
('./recover.php', '9454b2411d6456b943fcaf63464daba3b0bdaaf7', 'Blu-Edition'),
('./torrents.php', '3406f8ab0f34ebdf238f2c1549d3ae482e8daa66', 'Blu-Edition'),
('./hacks/Active_Forum_Users_By_Yupy/modification.xml', '74646ae2c21692984c1effa504effc8f02bb10ce', 'Blu-Edition'),
('./hacks/DT Xmas Present/modification.xml', '012acdf4ed20520268f70681c4fe108f18de3a22', 'Blu-Edition'),
('./hacks/DT Xmas Present/gift.php', '1d71e0e4fdddc488d34b9a477c9b9c621f36958b', 'Blu-Edition'),
('./hacks/Peer Connectable/modification.xml', '50e7d4011af0ce890ca7717f2013ded7836545e5', 'Blu-Edition'),
('./hacks/connectable/modification.xml', '0ff63f595b91c3d85a29dcdc8b2d3b2b8a88016c', 'Blu-Edition'),
('./hacks/Favourite Uploader/modification.xml', '6cc4abf8569d668077b3a0f9725172d3329cae90', 'Blu-Edition'),
('./hacks/Favourite Uploader/toCopy/lang_fav_up_up.php', 'd21cf8b27d85bf8eb5432b86cda6769040796d6b', 'Blu-Edition'),
('./hacks/Favourite Uploader/toCopy/fav_up_up.tpl', 'fa15a109464190f9a735cd26075097d3c13e17f3', 'Blu-Edition'),
('./hacks/Favourite Uploader/toCopy/fav_up_up.php', '0e1ba8177cb5a89be0318555c97077f9df9c8dc6', 'Blu-Edition'),
('./hacks/Favourite Uploader/toCopy/fav_up.tpl', 'e0a95dedb4b7e391cb271b745fb6c2eb4cbffadc', 'Blu-Edition'),
('./hacks/Favourite Uploader/toCopy/fav_up.php', '33468831c7758b1b8dbdaf519cdffe219fc9e96d', 'Blu-Edition'),
('./hacks/Show BOT Visits/Show BOT Visits/bots_block.php', '3e29799c6664d87539383551f0ab51547bb13e23', 'Blu-Edition'),
('./hacks/Show BOT Visits/Show BOT Visits/modification.xml', '20159f59ffe819bd36504e40a093148b8f8c5064', 'Blu-Edition'),
('./hacks/Last_Torrents/files/lasttorrentmarq_block.php', 'f08d406036b48997b573d2b04e6b7f2fc68471c4', 'Blu-Edition'),
('./hacks/Last_Torrents/files/lasttorrent_block.php', '5aed01f930ee2389241891a799ec1d3007733afb', 'Blu-Edition'),
('./hacks/Last_Torrents/modification.xml', 'be02833d810194941a15fbe69d99a287b9570f11', 'Blu-Edition'),
('./hacks/Forum and Comments Signature_/backup-17-08-2014_02-54-14.tar', '9315e4ba378d0e5c287692695e13db9700d84c45', 'Blu-Edition'),
('./hacks/Forum and Comments Signature_/modification.xml', 'c980a19935f266172517fd8004be6c8d631b17ed', 'Blu-Edition'),
('./hacks/Email notification PM/modification.xml', '81d938a2303c7e443206771fa0948b2a25353410', 'Blu-Edition'),
('./hacks/Show Users Last Browser/modification.xml', 'a3a3bb3a3b41b1d9357fa1856d94c14da9ae28ea', 'Blu-Edition'),
('./hacks/Copy_TorrentName_Yupy_v1.1/modification.xml', 'a410d486b044847a58fa6db334b1e2a72e735126', 'Blu-Edition'),
('./hacks/Copy_TorrentName_Yupy_v1.1/DeCopiat/TorrentName.js', '6fa35d03d9902979031ba7de5666d40fb3f3e27b', 'Blu-Edition'),
('./hacks/recommended_clients_block/recommended clients block/modification.xml', 'b6ae874950fef1b77ce0dd964f1b7a68eb973721', 'Blu-Edition'),
('./hacks/recommended_clients_block/recommended clients block/tocopy/client_block.php', 'fac5e1f9c3656bd896dbd68e7d1b1985fd954ffb', 'Blu-Edition'),
('./hacks/recommended_clients_block/recommended clients block/tocopy/admin.clients.tpl', '934924ae747d9f5c6d6943da41bad7cea413d2cd', 'Blu-Edition'),
('./hacks/recommended_clients_block/recommended clients block/tocopy/admin.clients.php', '7e20e303334db3d84bd57034506572365fa295a2', 'Blu-Edition'),
('./hacks/Search by ip, email, pid/modification.xml', 'c103727ec566928a1fe382b210f74278e32f6b0c', 'Blu-Edition'),
('./hacks/GenderAndAge/modification.xml', '872cc99007eace48cb5f2cb751121cdd5def9031', 'Blu-Edition'),
('./hacks/Bandwidth+ISP/modification.xml', '2639c8ec786dc898d1aecf8060bcbf5617762d5f', 'Blu-Edition'),
('./hacks/user invite log/index.php', 'e55265e1c68c5246b0db33930ea40a03ec413381', 'Blu-Edition'),
('./addexpectedmin.php', '238444351db495d31b14b503658e9b3cf0ab1f19', 'Blu-Edition'),
('./requests.php', '930960298354f0edd040bfb07bdd37185e72925a', 'Blu-Edition'),
('./css/rules.css', '9fbfcc39aa3343dcac9f211b9da81cd52519dbdd', 'Blu-Edition'),
('./css/hover.css', 'c17411894ffd1265019753c0fc112514a187dd8d', 'Blu-Edition'),
('./css/btccslider.css', 'b61198f331ca366de568ab4b1360a42497436d03', 'Blu-Edition'),
('./css/login.css', '31b1bd772c088c2ab20b17124fc76802730557e3', 'Blu-Edition'),
('./css/jquery.lightbox.css', 'e81d9932efa8dd91df9fc36238c9ac8c60c389d7', 'Blu-Edition'),
('./css/global.css', '6d156f82dc8d4eace75937266d8886e4c0c98ebd', 'Blu-Edition'),
('./css/categories.css', '426c260c1a2d0bd9e90d6a6d9a86c329c5de1d10', 'Blu-Edition'),
('./css/floatbox_big.css', '989ad29e0974bc98192484c6df867021437d4a68', 'Blu-Edition'),
('./css/featured_torrent.css', 'b8d61b1e712ea160d1be8706ae9cd32bfdb697e6', 'Blu-Edition'),
('./css/pace.css', '64c820c4ed57e23d248ee62a0b1a522b54f32bcc', 'Blu-Edition'),
('./css/floatbox.css', 'f1ff3d8a22d11232ad35d76989c2e8332453b900', 'Blu-Edition'),
('./css/newlogin.css', 'bbd30f8c3ed75bbfd07d3c38a3d10ab7b19343ca', 'Blu-Edition'),
('./css/passwdcheck.css', 'c44059c77839cf905acb950d82901a2bce2348cd', 'Blu-Edition'),
('./css/images/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./css/ccslider.css', '4e3851d4f84bb6fd4097fd25161dcf6c5f05acfc', 'Blu-Edition'),
('./css/torrent_activity_legend.css', '5ec415e7347d3bcdde6210c70c26d88bce9e7920', 'Blu-Edition'),
('./css/signup.css', '874d8852e020f953bdbb191e9566ceed18e8e835', 'Blu-Edition'),
('./css/tabber.css', '3e827e7cd6f2eaf8a5490bcc708b65efd127a526', 'Blu-Edition'),
('./css/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./css/jquery-ui.min.css', 'd7832e02ec4b9dc3485fbc3937192da151eea920', 'Blu-Edition'),
('./css/jquery.multiselect2side.css', '318dc3154e416795ad705d2f36923d9560951ff5', 'Blu-Edition'),
('./css/lightbox.css', '92647ebea7ffd0655b7e0663b2f73c6873a16deb', 'Blu-Edition'),
('./css/xmasheader.css', '3e543c2f0beed19cd31bbf493215b83950166700', 'Blu-Edition'),
('./css/faq.css', '5be720101720d2904607fc37640b1d087a0a3e48', 'Blu-Edition'),
('./css/countdown.css', 'ef3e3cfdaf963304bf03512ba759a5d5bce844cb', 'Blu-Edition'),
('./css/featured_torrent_metro.css', 'e24ca75aac24db5a6aa0cc58a8a068f3c5335dcf', 'Blu-Edition'),
('./alt_login/new/single/style_copyright.php', '5ee1d61276146d4afc312e91447a5bab90ff2998', 'Blu-Edition'),
('./alt_login/new/single/images/index.php', '2cf6a5b83e8c6d754ec9d790049a86dcc46bda0c', 'Blu-Edition'),
('./alt_login/new/single/main.css', '81521a50d4dfdd49912780a9f3a67e36311fd7d9', 'Blu-Edition'),
('./alt_login/new/single/index.php', '74dc63b862c1bb041a254f5b6ea87feab1ce6583', 'Blu-Edition'),
('./alt_login/new/rotating/style_copyright.php', '2db289fc3402703c52ac22a1d9e90e5a99cb54a3', 'Blu-Edition'),
('./alt_login/new/single/block.tpl', 'fcb3c7c9bba85eb74b548be8fa88199f12f1e219', 'Blu-Edition'),
('./alt_login/new/rotating/images/backgrounds/rotate.php', '9a2a058108da81ae48347d69042d915946ac3a33', 'Blu-Edition'),
('./alt_login/new/rotating/images/backgrounds/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./alt_login/new/rotating/images/index.php', '2cf6a5b83e8c6d754ec9d790049a86dcc46bda0c', 'Blu-Edition'),
('./alt_login/new/rotating/main.css', '9527ef908c584cc03ef8c0cd77819696ac303a48', 'Blu-Edition'),
('./alt_login/new/rotating/index.php', '74dc63b862c1bb041a254f5b6ea87feab1ce6583', 'Blu-Edition'),
('./alt_login/new/index.php', 'e95eaedbb91104e407892a954f75ca9c02c2fbb0', 'Blu-Edition'),
('./alt_login/new/rotating/block.tpl', '418440566f173ff919ed043f003ce3be744f42e9', 'Blu-Edition'),
('./alt_login/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./alt_login/classic/css/single_login.css', '25bbfb316b5592ad6a29f87c902d0aae594b63f4', 'Blu-Edition'),
('./alt_login/classic/login/index.php', '74dc63b862c1bb041a254f5b6ea87feab1ce6583', 'Blu-Edition'),
('./alt_login/classic/css/rotating_login.css', '2c75dd1475717fb6f85ddd99a2468d2c53290bcb', 'Blu-Edition'),
('./alt_login/classic/css/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./alt_login/classic/style_copyright.php', '2db289fc3402703c52ac22a1d9e90e5a99cb54a3', 'Blu-Edition'),
('./alt_login/classic/backgrounds/single/index.php', '2cf6a5b83e8c6d754ec9d790049a86dcc46bda0c', 'Blu-Edition'),
('./alt_login/classic/backgrounds/rotating/index.php', '2cf6a5b83e8c6d754ec9d790049a86dcc46bda0c', 'Blu-Edition'),
('./alt_login/classic/backgrounds/rotating/rotate.php', '9a2a058108da81ae48347d69042d915946ac3a33', 'Blu-Edition'),
('./alt_login/classic/backgrounds/index.php', '74dc63b862c1bb041a254f5b6ea87feab1ce6583', 'Blu-Edition'),
('./bet_addopt.php', 'faacb8828d2183b9df260ba79b96356f34e02cd3', 'Blu-Edition'),
('./alt_login/classic/index.php', 'e95eaedbb91104e407892a954f75ca9c02c2fbb0', 'Blu-Edition'),
('./votesexpectedview.php', '970e9e1baa70dcf26d3d9afbe8669e08987a1674', 'Blu-Edition'),
('./ajaxstarrater/readme.txt', '287209ec5506bb3e1476e32c4501702e5128c3aa', 'Blu-Edition'),
('./ajaxstarrater/css/rating.css', 'd8af2f4d823d4c21ad79ab230c43c765ce2a7a61', 'Blu-Edition'),
('./ajaxstarrater/_drawrating.php', 'd1ba61c8d8a92463b91e57d48b9486a091f67557', 'Blu-Edition'),
('./ajaxstarrater/db.php', 'e72b3589de3bc80f70224a5951492e0a64d12fd4', 'Blu-Edition'),
('./ajaxstarrater/js/rating.js', '2d4731ddf4fdede4e63f12e549e8fd881b5921ba', 'Blu-Edition'),
('./ajaxstarrater/js/behavior.js', 'e36b76605a24e260900fd86fa1ddce7dcea71c34', 'Blu-Edition'),
('./ajaxstarrater/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./avatar/index.php', '8079e4c4c9de0da1dc2c4c87a4596c68824e17f4', 'Blu-Edition'),
('./subtitles_search.php', '66e06833b83ee1bfde818b5d5a05b3d1186dfc09', 'Blu-Edition'),
('./scrollit.php', '3a4785972d764869f29a43114b4f341c1a69ee86', 'Blu-Edition'),
('./bitcoin_monitor.php', '69d765e1b04b31aa1ab2bc31fc16b05468c10eb8', 'Blu-Edition'),
('./paypalsynch.php', 'c954450e4639126042e411f8ff8f2e8c66f9f53b', 'Blu-Edition'),
('./template_tags.txt', '85c70f62cfb7bcee426a1e3a71e88838db919449', 'Blu-Edition'),
('./bet_delopt.php', '30fe4a9d4492f87c031e1b457e4c343ae6002d8f', 'Blu-Edition'),
('./takedelexpect.php', '33529d161c7d94db52dc819bfb5d9b1cf82767b8', 'Blu-Edition'),
('./torrent_history.php', '27bcbc9449329f52fea7fb07767b66ec8f5141c8', 'Blu-Edition'),
('./phpmailer4/examples/test_smtp.php', 'a6bd56046db96b1371bda98070afdaea3733df97', 'Blu-Edition'),
('./phpmailer4/examples/pop3_before_smtp_test.php', 'ea73c59f780bb2f95273499e97ef51c8cc1522d4', 'Blu-Edition'),
('./phpmailer4/examples/index.html', '00f6906697d0f04755a013826035df08d19fcb18', 'Blu-Edition'),
('./phpmailer4/examples/test_gmail.php', 'ab2e10869a33e54abb22de112e913fd8ab0a676a', 'Blu-Edition'),
('./phpmailer4/examples/test_mail.php', '82d98722eb85cbfe3a5ad8b553cc851902f01fe5', 'Blu-Edition'),
('./phpmailer4/examples/contents.html', '6780b799172a6450be5b1109aa28610e7e8a234c', 'Blu-Edition'),
('./phpmailer4/examples/test_sendmail.php', '032c54a6a99e656eff2ac8dbf887cace913d5318', 'Blu-Edition'),
('./phpmailer4/phpdocs/media/banner.css', '97ad736a9b411cd2e52e202f01f52ea93937c244', 'Blu-Edition'),
('./phpmailer4/phpdocs/media/stylesheet.css', '8a6640e1ec9ef57f9da032b460e391f563526f92', 'Blu-Edition'),
('./phpmailer4/phpdocs/elementindex_PHPMailer.html', '8d4864916bbc03e84ee25f57b36d84f1652df486', 'Blu-Edition'),
('./phpmailer4/phpdocs/__filesource/fsource_PHPMailer__class.smtp.php.html', '7a5d67ac22a08be6113ec4308c85c8cbe0d83164', 'Blu-Edition'),
('./phpmailer4/phpdocs/__filesource/fsource_PHPMailer__class.phpmailer.php.html', 'bf52413ffa90239a003d718b1f0dbf20ee135304', 'Blu-Edition'),
('./phpmailer4/phpdocs/__filesource/fsource_PHPMailer__class.pop3.php.html', '924943aeeac53ba5eaadc9b7147510e4fff7b4ff', 'Blu-Edition'),
('./phpmailer4/phpdocs/index.html', '8c2455a400a9eb7ea95526077ee1060d386aa062', 'Blu-Edition'),
('./phpmailer4/phpdocs/blank.html', '1ad28c5834a5939f89644f07a26a1c79179f7645', 'Blu-Edition'),
('./phpmailer4/phpdocs/li_PHPMailer.html', '6ba4eb006f38bf3bf781a14599e6067031995468', 'Blu-Edition'),
('./phpmailer4/phpdocs/PHPMailer/SMTP.html', 'df2374e67d020c38a789dfb4a7a2afc9a0e38f96', 'Blu-Edition'),
('./phpmailer4/phpdocs/PHPMailer/POP3.html', 'c977f17bc486f5324b206efeb258303711e29894', 'Blu-Edition'),
('./phpmailer4/phpdocs/PHPMailer/_v2.0.4_PHPMailer_v2.0.4_class_phpmailer_php.html', '274fe175a5c52ea06959b0dc24bdf29ac718f76f', 'Blu-Edition'),
('./phpmailer4/phpdocs/PHPMailer/_v2.0.4_PHPMailer_v2.0.4_class_smtp_php.html', 'a7110f9174a1b1190b8bbdf2813097c0eb172e5b', 'Blu-Edition'),
('./phpmailer4/phpdocs/PHPMailer/_v2.0.4_PHPMailer_v2.0.4_class_pop3_php.html', '851af07ba99985d60e60f6c0e4b0fee4875c5245', 'Blu-Edition'),
('./phpmailer4/phpdocs/PHPMailer/PHPMailer.html', '95cb313ebb108d690a7813cdbc786a7ad0624843', 'Blu-Edition'),
('./phpmailer4/phpdocs/classtrees_PHPMailer.html', '21f8400c278fc9d4dee52bbfe5efd4113dcfdebe', 'Blu-Edition'),
('./phpmailer4/phpdocs/packages.html', '39b7a2866bb7f9360fad434d08545faf70cae61e', 'Blu-Edition'),
('./phpmailer4/phpdocs/elementindex.html', '03ef0ac8b7578889ac71538228d85eed7b139b58', 'Blu-Edition'),
('./phpmailer4/test/phpunit.php', '7223b0b0759efc786261d5c0a870e59a17ed5a2e', 'Blu-Edition'),
('./phpmailer4/test/phpmailer_test.php', 'cc0cbec7a0c285d2818bca61dde19a89c1fe975d', 'Blu-Edition'),
('./phpmailer4/README', '65d709c163545fe75608d978c44a964af1b5b5f0', 'Blu-Edition'),
('./phpmailer4/codeworxtech.html', 'bb31b6109106c3f934adb3cddcb69e61ca1fea16', 'Blu-Edition'),
('./phpmailer4/LICENSE', 'd580d4205ca9e848768265f15e4afb91422da78d', 'Blu-Edition'),
('./phpmailer4/class.pop3.php', '3d4bb30c47c525db6f31785468080306ed54e9e4', 'Blu-Edition'),
('./phpmailer4/docs/faq.html', '1253a9418068a53b78aa04b572b9ab93f3f77d34', 'Blu-Edition'),
('./phpmailer4/docs/use_gmail.txt', '886296a10121de68d16cf14a875e3a2d579912a1', 'Blu-Edition'),
('./phpmailer4/docs/extending.html', 'bca4c70508b238b0973e78cf7535241c53b3ad55', 'Blu-Edition'),
('./phpmailer4/docs/pop3_article.txt', '647b7268cf0a447f28f0e0689facb594061f900f', 'Blu-Edition'),
('./phpmailer4/class.smtp.php', '0520fa78330fa88de55b12de25620c0b1447e12b', 'Blu-Edition'),
('./phpmailer4/ChangeLog.txt', '7637ca0389c8cda1c231d8cae1f4343c9a11b7a7', 'Blu-Edition'),
('./phpmailer4/index.php', '598fd3fd7ee7ea2260900f666569b4276a892fd3', 'Blu-Edition'),
('./phpmailer4/class.phpmailer.php', 'a1370572cedd2d716d61ffcab22c89821e543eea', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-dk.php', 'b838bbc9d6a5dc2cbbd302fbcaf4449662ddc200', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-zh_cn.php', '768be0c03309dd7c6bc217078299bb242fc097ef', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-en.php', 'adc7bbbd62d995b11f4a6e76055c4d05a8221351', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-ch.php', '74d42e5d2ed858299e724788d347de4964fd0463', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-zh.php', 'f403b45ae97393b725a408ab717a6749a756112e', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-fr.php', '54649dbc746a683dfe8b255d0b38d9ada4a62e4d', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-it.php', '2c1c5d804beb2f38f2192771b57a2acc8b20e8cd', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-ja.php', 'd7bcf3620b148eafcc93eb2532922ae1aaee572c', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-cz.php', '365e2666e0d459b1885bf029d3bdc2913b867d83', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-no.php', 'fde6cd10734d3c8f037bf3df8591b8757da5b372', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-hu.php', '70f1c5b1ab57b07d61de4e1269ffd8e35368c95a', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-pl.php', 'c9d34530d62ee7c44594a6a186097706629ca0be', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-se.php', '63113a38b7aea633c0ba4a516c8f35ac1d59990f', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-de.php', 'ee18ecd047378bccb3e5146a7df78e3f513905f4', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-et.php', 'a64497778c177932ac3040019515f93c02eecb92', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-tr.php', 'cc483d08b76adcb9fddfbb9076c260498cb0dd69', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-ru.php', 'bcc3ba32456639aeca20b64c04cb8fa4fa79d3d9', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-nl.php', '82fa5a532432fdc59dab86d83382f5b088cb2687', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-br.php', '83ebadc5cf70cf72c8bd53cacb76d6c904f6c7a2', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-ar.php', 'f5fbe289ab64b4d39be6e951bc83f0f4891de2a7', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-ca.php', '0eef5d292302df70fe680bfa229f73da319c69eb', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-fo.php', 'e44836138341afc47d4cc382f3f7806c0f9e38a7', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-ro.php', 'd18e1eff85404d65f6858a3d96690f8e63d6b68c', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-es.php', '2040a8acaa74abf8af1ac958312ed303cb953102', 'Blu-Edition'),
('./phpmailer4/language/phpmailer.lang-fi.php', 'faa7c0cb6ba373a15886b496f52daf63a1ef0d4b', 'Blu-Edition'),
('./torrentstats/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./bet_opt.php', 'a1275c8459103bac43fb7142f8bba9e4e3b71b3b', 'Blu-Edition'),
('./reencode.php', '7e021a8e095b1e55e82cb701eaa3fe152563cac0', 'Blu-Edition'),
('./friends.php', 'a962aca78afbbba39f33d576c5b91fd9fe03fef8', 'Blu-Edition'),
('./subtitle_download.php', 'fd9cf34cc9da376718ad4b06b51d822373fac9fc', 'Blu-Edition'),
('./upcheck.php', '486cea8e93e91d861a764c64cfa669b850e022f6', 'Blu-Edition'),
('./votesexpectedviewmin.php', 'a1cec67213a1ad2164dbaa32b9678d0d7b909014', 'Blu-Edition'),
('./access_code/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./sitemap/sitemap.xsl', '7e66eaf67727da46c29806eb6eb3ba65a5c4633d', 'Blu-Edition'),
('./sitemap/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./googly/process.php', '4d3e105d1eeee19eb8cbf7efc5e839311e338b95', 'Blu-Edition'),
('./googly/scan.php', 'ef064fd37d80a7f28faf56de26ab2e179d2f649e', 'Blu-Edition'),
('./googly/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./googly/imgs/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./after_smf_to_ipb_convert.php', 'e979a76dd31b8316507801bbd39a66f6c3eccfdf', 'Blu-Edition'),
('./delete.php', '63a65cdd75eec5b37251c504b7a60c7594a1f5d7', 'Blu-Edition'),
('./announce.php', '6d0b86d5e9d58f1746ff320b91e01fbdffaf6e6f', 'Blu-Edition'),
('./searchusers.php', '5cb97cf31ea2c8dbb058762abe3f287ca752a12c', 'Blu-Edition'),
('./transfer.php', 'e13c98eda4eb618d7895c6ecf3782a7fa6e98259', 'Blu-Edition'),
('./hnr.php', 'b35d19370578511567b5bfec6b3cdab2dbbe3e24', 'Blu-Edition'),
('./clear_ann.php', '741b00c82e2be23da53b094c859a7c4685ebe073', 'Blu-Edition'),
('./gallery/index.html', 'd5dc95880bf285be8f7af2f503e75450577ff423', 'Blu-Edition'),
('./whois/whois.ip.arin.php', 'af105377ff1a5ccc3e98224f8c62332065f18498', 'Blu-Edition'),
('./whois/whois.fi.php', '1ee81d02cb873b94be0307c434b08619586c6ed2', 'Blu-Edition'),
('./whois/whois.tel.php', '9c4776327413b30d30bca9a0163a6d1653af53d0', 'Blu-Edition'),
('./whois/whois.gtld.schlund.php', 'c1fcda718589b8f3ea38bb9cde1e2f9d75db2c64', 'Blu-Edition'),
('./whois/whois.org.php', '820c70afdeeb4bebf43a33b03dbbbc5a4df54ffe', 'Blu-Edition'),
('./whois/whois.aero.php', '716578c4dc5c3399eca6848e072145abf67e09c9', 'Blu-Edition'),
('./whois/whois.nl.php', '7aec9f663af9105e2e50864e16e424c3425fdaea', 'Blu-Edition'),
('./whois/whois.gtld.afternic.php', '643a6ef0c6ede99a677a2d9cc3dbde2da4fbec12', 'Blu-Edition'),
('./whois/whois.co.php', 'b19c8bd3f0ce2a4ab83ebfd4b9333879eb449c63', 'Blu-Edition'),
('./whois/whois.br.php', 'e2917b6942ef1a2e69eeee54cfdfb0d4c7f525ee', 'Blu-Edition'),
('./whois/whois.gtld.register.php', '4f6e642c10675f2e41a253cc7a4fcb5dba3180ff', 'Blu-Edition'),
('./whois/whois.gtld.enom.php', '6a907e8e1660d7b71720aec5aff2a0188da7fd3d', 'Blu-Edition'),
('./whois/whois.uk.php', '74c2fe5b41090cfa4944096c59e8f4d57a3c2dc7', 'Blu-Edition'),
('./whois/whois.gtld.dreamhost.php', 'b658cbfad1693c26c0fb644ce91b62b24e79877d', 'Blu-Edition'),
('./whois/whois.au.php', '8c633e794017ae7699f6061f650e581ac5a83db7', 'Blu-Edition'),
('./whois/whois.pro.php', '5adb847d0b309d8332782c0bdd65d9b97705a2f1', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./whois/whois.fm.php', 'c49ff1e5257f4a9fb3b04b031bdf48bbc0df2ac0', 'Blu-Edition'),
('./whois/whois.gtld.assorted.php', '7ae0d8d3c5f863c451f55260bde34fe0d8b76403', 'Blu-Edition'),
('./whois/whois.co.za.php', '29162ed518cbe05152db815dea90460c50d37029', 'Blu-Edition'),
('./whois/whois.fr.php', 'baa7684e1a32f935b1726433ac10c77aeb0b1a66', 'Blu-Edition'),
('./whois/whois.ip.php', '890a08d7f6e89dae8b74eb821612cc1ae778f634', 'Blu-Edition'),
('./whois/whois.be.php', 'a4c917de8ba8f27856b0d0db944665c4f67aa7e7', 'Blu-Edition'),
('./whois/whois.gtld.namevault.php', '3acea979c1275a336326eedc4bc2cb839ac5401a', 'Blu-Edition'),
('./whois/whois.gtld.godaddy.php', 'bf3c218e9c438c34e6c6c9b02596dcff462d51c9', 'Blu-Edition'),
('./whois/whois.de.php', '30c34e65125cbe91778220aa924b828933a84e55', 'Blu-Edition'),
('./whois/whois.ch.php', '285334b486fb376b43e255b4e8209528fc610765', 'Blu-Edition'),
('./whois/whois.gtld.onlinenic.php', '459ac1b555ac986a4559e37c3f0a1d95437fa370', 'Blu-Edition'),
('./whois/whois.gtld.domaindiscover.php', '18ffe2366a697806f953b4bc9f294c8fa1d53f2c', 'Blu-Edition'),
('./whois/whois.gtld.psiusa.php', '894347f1a3c11dd1f586dbea80f5746618e29931', 'Blu-Edition'),
('./whois/whois.gtld.php', 'aba0ccf9b072bd8de14f5247a3d0a7672d3e3fb5', 'Blu-Edition'),
('./whois/whois.ie.php', 'b479e798165eae1916a2b8577d9c98956d8b1a91', 'Blu-Edition'),
('./whois/whois.gtld.wildwestdomains.php', 'b4e14b707634c95b3cc6dbfe87a13d797db61c96', 'Blu-Edition'),
('./whois/whois.gtld.ovh.php', 'f9afb5f5857517f25b4a215a45f1598b36cbf3ba', 'Blu-Edition'),
('./whois/whois.ro.php', 'db42f2037d5db2f9ebf842a3f1ff7c97f79fa85f', 'Blu-Edition'),
('./whois/whois.gtld.moniker.php', 'c9a46f14b455a3d32e2fe56c3b15250399feebc1', 'Blu-Edition'),
('./whois/whois.pl.php', 'efe53f9604f91ba26c661ae93dc39701c37ce006', 'Blu-Edition'),
('./whois/whois.mobi.php', 'df9ab1674572a83f7cf2a7671428f3acdd1375f7', 'Blu-Edition'),
('./whois/whois.ly.php', '999633b4039e26a3036c9fdc45d7966f5c7b78a7', 'Blu-Edition'),
('./whois/whois.gtld.names4ever.php', 'c1c1dc670a81c2eb29aa3646c8636f4bc6d05870', 'Blu-Edition'),
('./whois/whois.rwhois.php', '8bfc424cea5a019b352c6b42edeb07da517838bf', 'Blu-Edition'),
('./whois/README', '180d3b90e95f6addd79b620f9c5a62468c879401', 'Blu-Edition'),
('./whois/whois.gtld.encirca.php', '82dc57ee172294443c0640039324793c93451278', 'Blu-Edition'),
('./whois/whois.ir.php', 'f12a334d1a9b8a22b30ad7cc26a7459c03a8facb', 'Blu-Edition'),
('./whois/whois.gtld.domainpeople.php', '6c91337d913fb0aef82f5e1ee2a1293724a53339', 'Blu-Edition'),
('./whois/whois.int.php', '46e035e8aa6a9870984cb391505d947f78f90bcc', 'Blu-Edition'),
('./whois/whois.sc.php', '3199ea70ed874c8fec02315290fdb749a714b37e', 'Blu-Edition'),
('./whois/whois.gtld.rrpproxy.php', '869b7137d1a14c4a632afa6c8c437c211840419f', 'Blu-Edition'),
('./whois/whois.is.php', 'f91ed5195457041435fa67275f2bdfa1b3b97efc', 'Blu-Edition'),
('./whois/whois.ag.php', 'cae50b58f34599c6c5355cea204e016514d94130', 'Blu-Edition'),
('./whois/whois.travel.php', '49ed7ea5bfe3fde9595f2b7fbe3954b3622ac474', 'Blu-Edition'),
('./whois/whois.gtld.fabulous.php', '43799a7c7d9c058b5c65c0e1b07d8553a0056864', 'Blu-Edition'),
('./whois/whois.gtld.nicline.php', '118629bea10d242b329cc52176f4c76bb63d51e8', 'Blu-Edition'),
('./whois/whois.idna.php', '23c0dab95ceec5fcbbac64053005241a799fbe89', 'Blu-Edition'),
('./whois/whois.gtld.nameking.php', 'a171a3fef3014cf19f4bf9420bb7ee209aed8e37', 'Blu-Edition'),
('./whois/whois.gtld.nicco.php', 'e346441721bd00fed34857eb9b9c2a558c964e31', 'Blu-Edition'),
('./whois/whois.name.php', '2c320b2ac28950e764adceee30afcb883acd7050', 'Blu-Edition'),
('./whois/example.cli.php', 'e4e8520f6b3212a90f88b83e8cbab7b87e650db1', 'Blu-Edition'),
('./whois/testsuite.txt', 'cbd16899559c3049ede8ff86dc205d1ce62d8cbf', 'Blu-Edition'),
('./whois/whois.gtld.markmonitor.php', '2104b7eca17c965c4eaec6a2c44d00d4e93fff7d', 'Blu-Edition'),
('./whois/whois.ip.lib.php', '4da8f2bcbc91dc1ceb99c62b91cb7f5f6733ef84', 'Blu-Edition'),
('./whois/whois.cat.php', 'f25b86703697c1acfee8024076af774033257f8f', 'Blu-Edition'),
('./whois/whois.gtld.gandi.php', '6281d974962451a6e5c10e3a1d9541004f07911c', 'Blu-Edition'),
('./whois/whois.pt.php', '95a11dd9a29c86a5dc6aa29bf3a8f207aa57f93a', 'Blu-Edition'),
('./whois/whois.gtld.publicdomainregistry.php', 'f82f1ca5a52ea6a3e555574d3b425b029af22b66', 'Blu-Edition'),
('./whois/whois.gtld.nominalia.php', '72dc9a2d0bf4a5e1141969a05f757d4b81288645', 'Blu-Edition'),
('./whois/whois.in.php', 'a248b5e110637144477712e215946b685d87eef0', 'Blu-Edition'),
('./whois/LICENSE', 'b47456e2c1f38c40346ff00db976a2badf36b5e3', 'Blu-Edition'),
('./whois/whois.main.php', 'fe670bdc9afbe104eea6ac84684ecd11de0f11f5', 'Blu-Edition'),
('./whois/whois.su.php', 'b4f9a40a2cbca6b83c23bf43c9a6f39e8e5d21ad', 'Blu-Edition'),
('./whois/whois.nz.php', '60c5fc6e11e81870d8393ed25b9ec753a79135eb', 'Blu-Edition'),
('./whois/whois.ip.apnic.php', 'b129fef665d01c154d3fde0bf70eb92585b4f205', 'Blu-Edition'),
('./whois/whois.fj.php', '05712622565cab738e6734d5183b46cc026ae470', 'Blu-Edition'),
('./whois/whois.gtld.melbourneit.php', '54dadc1d20ab32c2a5f33722ddf3d7065fa713de', 'Blu-Edition'),
('./whois/whois.parser.php', 'c64f17ec88cc96b1c4031f7dfffb6921f6a1d158', 'Blu-Edition'),
('./whois/whois.gtld.srsplus.php', '508aea8821bbe1fea8c3894a2d58d648dfe6b525', 'Blu-Edition'),
('./whois/whois.museum.php', '99dcf17402dd4c1e9d89d5ffb528e6f80fa40aee', 'Blu-Edition'),
('./whois/whois.utils.php', 'eb93d301f942f42bc5d5d8c049b493fa37d8ad68', 'Blu-Edition'),
('./whois/whois.cl.php', '34f5d2cee21316705789ad979e712e3247791acc', 'Blu-Edition'),
('./whois/whois.at.php', '4fd24a38c4a4e777c1e3b144c66d4661b9a2dc69', 'Blu-Edition'),
('./whois/whois.gtld.itsyourdomain.php', '8c5bc6d42a694905f7fd1677417a7b7def8c92bf', 'Blu-Edition'),
('./whois/whois.gtld.fastdomain.php', '4eae7893e772f4dcd7b3467adf8dba8f481d6a5f', 'Blu-Edition'),
('./whois/npdata.ser', '9cba72520af1e3916693cefbf692ea9d7fa7f15f', 'Blu-Edition'),
('./whois/whois.asia.php', '82889f0dc20772fa1d09fcd7c975dabd12255d42', 'Blu-Edition'),
('./whois/handler.template.php', '1ad1a4ec162a4382a0a5fc4bd1b67c9ecc544e12', 'Blu-Edition'),
('./whois/whois.ae.php', '97cc60e32c6bb591a5ca3d0fc38293a5a1d437aa', 'Blu-Edition'),
('./whois/whois.gtld.interdomain.php', 'cb7fa5894a95f5f3a77f8fbc1e50a5fe0182a3eb', 'Blu-Edition'),
('./whois/whois.me.php', '83473a7dcd70013b71c6fa0e465f3312ef4f79ef', 'Blu-Edition'),
('./whois/whois.gtld.networksolutions.php', '1c99005139bfc6e4c03f93ef77e4a81e27a6f7fb', 'Blu-Edition'),
('./whois/whois.coop.php', '751f20ca801606a9bd3f7b1ad9e4e5641acc2341', 'Blu-Edition'),
('./whois/whois.gtld.directnic.php', '5a23be60128ca2328ae2a873f963e97a314401f5', 'Blu-Edition'),
('./whois/whois.cz.php', '4099bcf847597315dd4d2cf2140f767ac5e0cb05', 'Blu-Edition'),
('./whois/whois.lt.php', 'f99be662310c524eb9ccaaa6ef6ce4e054c5eae7', 'Blu-Edition'),
('./whois/example.php', '8e0bf8477ecbd7bf8929847164159c33ea3eae61', 'Blu-Edition'),
('./whois/whois.ca.php', 'a8f119187fa8e82879bb6cefdc9a50204e8d293e', 'Blu-Edition'),
('./whois/whois.cn.php', '9db70b7f64e1a9a9ddeb1c7e274d63fd0398da5f', 'Blu-Edition'),
('./whois/whois.org.za.php', 'f624b403c8e471cbe499fa5a07999b08421ac7ab', 'Blu-Edition'),
('./whois/whois.biz.php', '7c1d3d674725bec212dfd6a21fc536b63c376cc5', 'Blu-Edition'),
('./whois/whois.eu.php', '9e21b144587b7c1eb4dfdae9c8097eb1f4b1a530', 'Blu-Edition'),
('./whois/whois.se.php', 'b0200a236316173cfae16a82c682bf3bca3590b8', 'Blu-Edition'),
('./whois/whois.gtld.tvcorp.php', '89a7edde71de85cc7d0ce7105059555645ce0030', 'Blu-Edition'),
('./whois/whois.gtld.iana.php', '02dc0a9f8bf441a8565c38835b2a39a57cb61ea4', 'Blu-Edition'),
('./whois/whois.gtld.alldomains.php', '56a7904296387d2afe0c8da5cdf9e9a7a2dc8f1a', 'Blu-Edition'),
('./whois/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./whois/whois.zanet.php', 'bdf206832216f3b16f2483f7bb4e9f842a479261', 'Blu-Edition'),
('./whois/HANDLERS', 'f6662e1725bfa5c4e620121764ee5b8d2645af3b', 'Blu-Edition'),
('./whois/whois.gtld.dotster.php', '0132a612e3653054e781cfc3e1ccec9f9c1f8e37', 'Blu-Edition'),
('./whois/whois.it.php', 'd87a69588cb84ea95deeaf34f3c6af514091e90d', 'Blu-Edition'),
('./whois/whois.nu.php', 'a7449c3e8dc64973eeff8f41f25f5f0e02cd046c', 'Blu-Edition'),
('./whois/whois.ip.lacnic.php', 'bd4be42d75b9af92d3a65b9e2c2bb8a355d44077', 'Blu-Edition'),
('./whois/whois.gtld.genericb.php', 'caa9b0b580bac7c990c632f0537ade5f861d98fd', 'Blu-Edition'),
('./whois/whois.ip.ripe.php', '02b883c5fef4a0198a046f391689f1cecda7f42c', 'Blu-Edition'),
('./whois/whois.ip.bripw.php', '6771c8de0234bfaafc3c9ff7ee8950e1f5125765', 'Blu-Edition'),
('./whois/whois.gtld.ascio.php', 'ea5999fcab38f3cad0878a17e81dbe6a44ac06f0', 'Blu-Edition'),
('./whois/whois.gtld.namejuice.php', '4948ba8185eb5507e9d9c10ab27ca92094c05bb3', 'Blu-Edition'),
('./whois/whois.es.php', '90496441bbf97042798215858f73b8ca5722a453', 'Blu-Edition'),
('./whois/whois.gtld.joker.php', 'ebd8126c2ec576e695f5e6aca2daddf946ecbd4e', 'Blu-Edition'),
('./whois/example.html', '7c631dc7e4103de84b7d23f6c916bc354000d205', 'Blu-Edition'),
('./whois/whois.info.php', 'fa38b30b8bb231df8efe0b78e32721bc68511a70', 'Blu-Edition'),
('./whois/whois.edu.php', 'b5e1f5d944a2d566e173ee91955c4efc98fc0762', 'Blu-Edition'),
('./whois/whois.us.php', 'e78bfcb31e8d06e98455dd0c5ff2ad4d2b07e550', 'Blu-Edition'),
('./whois/whois.mx.php', '8d26ded5ea0c7738fc3d2d52f513fe2016c2a5ab', 'Blu-Edition'),
('./whois/whois.ip.krnic.php', '354b90bb0539659bc559027587426106972c1cdf', 'Blu-Edition'),
('./whois/CHANGES', '462a014fb31910da6b941c22e40ccdcf08120918', 'Blu-Edition'),
('./whois/whois.ws.php', '0d8c194c49e9f187cf57da4d2fa8dbad75f17772', 'Blu-Edition'),
('./whois/whois.lu.php', '3533e3117ec006ddecef3262b7641155426c922b', 'Blu-Edition'),
('./whois/whois.ip.afrinic.php', 'e96617eebbb0743d30195305f34fc12713f556a9', 'Blu-Edition'),
('./whois/whois.client.php', 'acf4526e91414601d2037a51b7ffad499a6073ec', 'Blu-Edition'),
('./whois/whois.hu.php', '172fa73ff532c1dcc32da81ef76bdec6200033c7', 'Blu-Edition'),
('./whois/whois.ru.php', 'b1f00e89411b5623c74803c2bff4ed567fa17c91', 'Blu-Edition'),
('./whois/whois.servers.php', 'c2ff7f0e863296aff8f2e2f8c3b6c33e5d815eb5', 'Blu-Edition'),
('./whois/whois.gtld.corenic.php', 'd2a30be263b1dd6a1214ffd32067e8852b1f6ab1', 'Blu-Edition'),
('./whois/whois.ve.php', '22854febdbb5fbe335234f1ede0bb1dfb9b0b62e', 'Blu-Edition'),
('./whois/whois.si.php', '7640914648247bc16c74dd8fbcccf4d1a661f374', 'Blu-Edition'),
('./whois/whois.gtld.opensrs.php', '86289d4eb768e536b2118ec15357880aab3711b0', 'Blu-Edition'),
('./whois/whois.jp.php', 'e04605ea2d503d9c4a7eae9ba08ee11ee8daaa07', 'Blu-Edition'),
('./whois/whois.gtld.corporatedomains.php', '81b2a80e234a6eaf2e9e25f6c46e059ab970d40e', 'Blu-Edition'),
('./whois/whois.gtld.tmagnic.php', '91f5797c3b554c9b6d82bee3e8e200e2a71571be', 'Blu-Edition'),
('./whois/test.txt', 'ed9b136c21e58cb224297079dee4760129d3527d', 'Blu-Edition'),
('./whois/testsuite.php', '0ce8f35976ae9d7c08fa911f2f7a4cf0e630bfa2', 'Blu-Edition'),
('./expected.php', '7e677be44a55bd34f901e3e84029f2bf76eaa43a', 'Blu-Edition'),
('./whois/FAQ', 'e1413af1c4e34872c5f60edc627a65f8d5b45e04', 'Blu-Edition'),
('./votes.php', '825137bab199ee1572160f68841f3c825a1d8e75', 'Blu-Edition'),
('./phpmailer/examples/test_smtp_basic.php', 'b9343be0b8636f6f2ecca1d4e1518c9f1b6509e2', 'Blu-Edition'),
('./phpmailer/examples/test_pop_before_smtp_basic.php', 'b24faeb5d50a391fa8bab3b91bca3e6b58c7a9d5', 'Blu-Edition'),
('./phpmailer/examples/test_smtp.php', '0e4837ca3e254df4b36a5869cb95bc4c26bb3226', 'Blu-Edition'),
('./phpmailer/examples/pop3_before_smtp_test.php', 'b1d4689d8ae87f4a98ce5102466e9e02d0870df5', 'Blu-Edition'),
('./phpmailer/examples/test_pop_before_smtp_advanced.php', '890728d059e9a4cc6887bf5e96dc9266e6965802', 'Blu-Edition'),
('./phpmailer/examples/test_mail_basic.php', '3b45bac6f034dda43fef43b9f721f3eeb8990973', 'Blu-Edition'),
('./phpmailer/examples/test_smtp_gmail_advanced.php', '12221aadfdbc0ab2453114da12be7ba14eb844e6', 'Blu-Edition'),
('./phpmailer/examples/test_smtp_advanced_no_auth.php', 'c67c747f9e638c34f8732a5f717f900c9867324d', 'Blu-Edition'),
('./phpmailer/examples/index.html', 'cb1b20c1dca6d871176cb333c35adc63b6b18c8a', 'Blu-Edition'),
('./phpmailer/examples/test_smtp_advanced.php', '377534f927a747d947494c26cdc89370791b184d', 'Blu-Edition'),
('./phpmailer/examples/test_gmail.php', '99cd056a29356486923d77279320eba2158c4294', 'Blu-Edition'),
('./phpmailer/examples/test_mail_advanced.php', '94fed4f6446e4da609a72a4d4bb0daf251c9a41d', 'Blu-Edition'),
('./phpmailer/examples/test_smtp_basic_no_auth.php', 'cf7cd31c5e30ba1827b50f405516548c70885b21', 'Blu-Edition'),
('./phpmailer/examples/test_sendmail_advanced.php', 'cce4c2ca84a26cad48b401b5d34947c1e56415fb', 'Blu-Edition'),
('./phpmailer/examples/test_smtp_gmail_basic.php', '30bb1ce60e32b9bf7f128832eeb855ebe0741ccc', 'Blu-Edition'),
('./phpmailer/examples/test_mail.php', 'bdc3e2b35c22572ce41a4c586687cafb19f4d393', 'Blu-Edition'),
('./phpmailer/examples/test_sendmail_basic.php', 'ed4b91cce3bcfd4ae6c37b1109331d220368d5ca', 'Blu-Edition'),
('./phpmailer/examples/contents.html', 'deddd244504ce4f223b99449f50d1a110d39e327', 'Blu-Edition'),
('./phpmailer/examples/test_db_smtp_basic.php', 'ea910649ee499b51ae9cc3fabfcbd4597c29ee71', 'Blu-Edition'),
('./phpmailer/examples/test_sendmail.php', '1f046b46d0f1bea633835f5e043c23c644cb379a', 'Blu-Edition'),
('./phpmailer/test/phpmailerTest.php', '22548313b97695ee84f80be3d1dd25f56c26508d', 'Blu-Edition'),
('./phpmailer/test/testemail.php', '0f750b31a44f1d55074cc7e8c36d65acb2c3657c', 'Blu-Edition'),
('./phpmailer/test/phpunit.php', '18c1cb24bfa2bc6e4a5a179312c2c784dc676061', 'Blu-Edition'),
('./phpmailer/test/test_callback.php', '8326e39315122c68158876f2fc3e68e679d1a67b', 'Blu-Edition'),
('./phpmailer/test/phpmailer_test.php', '25eb0928d08ee3d76f3a94b01bcd5230bfa1dafa', 'Blu-Edition'),
('./phpmailer/README', '28263c101d961f18bdfff3c29777390263f2545d', 'Blu-Edition'),
('./phpmailer/test/contents.html', '8af27dc751b7f9e87f50b351c9d83850cf0ba887', 'Blu-Edition'),
('./phpmailer/codeworxtech.html', 'f472b103ef82dd14f3d890a1f7279d92fcb3c169', 'Blu-Edition'),
('./phpmailer/LICENSE', '65c71b7ff77a59a32247d83a528728637263c1b5', 'Blu-Edition'),
('./phpmailer/docs/Callback_function_notes.txt', 'af75e0e447df52c38952e29b8d0853693b01ab93', 'Blu-Edition'),
('./phpmailer/class.pop3.php', '4ba3ac437abb094a2e4386dff41163c0e966e751', 'Blu-Edition'),
('./phpmailer/docs/Note_for_SMTP_debugging.txt', '4a3f1177ea3e7083198eb68325a7a824adca0a4c', 'Blu-Edition'),
('./phpmailer/docs/faq.html', '316c78dea3a65fcaa0b2fc2d19f8bd57adc04fb0', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/classes.svg', 'aefc576326f4a18462bd6f6cc739f460a264b491', 'Blu-Edition'),
('./phpmailer/docs/DomainKeys_notes.txt', '068a0015d86b9da30ae90cf436512f07933c715c', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/deprecated.html', 'a8fd89e71f720ff2a5f1a21b46cfeacbf35f7524', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/jquery.iviewer.css', '881f8ee15cc827461fe2213fd82534243a1e8ff5', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/bootstrap.css', '2b66f67905cb2acf18f258b383610bac67571148', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/bootstrap.min.css', '74269e4704ec6e227a1bd67ccf403b9d04e6a35a', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/prettify.css', '8e1c89c9a44e0e837551bdfe250a672d6c21f2b7', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/template.css', 'df36350a5ebfe47148884d5853aec0a73d9cd163', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/bootstrap-responsive.css', '28b27d020603e1a422a0d712722a4de337763667', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/css/bootstrap-responsive.min.css', '74ebfe0df1aa1df504b4aa707e31310273e6c666', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/img/iviewer/grab.cur', 'b8bcadc66b9a279762efc313aab2db17e9cdd1c1', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/img/icons/icon_template.svg', '19c40ecb75ff4d0c20d86f1d675c89976198176c', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/img/iviewer/hand.cur', 'e4613fbe4cf0c13e55c78575fb052ab5388f8212', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/img/icons/favicon.ico', '419ce9fa8972e3fe53972e2ef3255d667faa9f28', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/img/favicon.ico', '037a12cd6d3f7d468c280dcb56bcde7bfa8f0e21', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/structure.xml', '59bd473b60b9de142c27a15472bce5bf8a9d1c56', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery-1.7.1.min.js', '7554b6e1b8dcad3111f5f4d7577e34dfe95a1075', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.treeview.js', '2aacdc1815df1c582a7f4b0434275f12ff961fe8', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/SVGPan.js', 'db7b2b82b2f6e02958bf59dcd74cc38701cc8407', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.mousewheel.min.js', '1e1b44eb7cfade680c52d8748846425ecd809bfd', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.panzoom.js', 'ab38b59c16f6ba3c8ae181a768d3fd02bcf318c4', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/bootstrap.js', '091fcb9d55f8a882a09d72b0ec762e51ea1b3e73', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.splitter.js', 'c829b3a7cca73f4240a62bfe137907b2b3b55245', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.cookie.js', '328abe4bd747086f7e5002adc5117d57d56bcd45', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery-ui-1.8.2.custom.min.js', 'ee9fb45a057673e22bc8134dd4ea0602f82cc058', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.iviewer.min.js', '6bf12ee832a4e5ba26a24c9cbebdc915ba69ecb4', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/bootstrap.min.js', 'f175f75cff9472ccf7d228ff6441fb778985cdd4', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/menu.js', 'b1b577025c3852a4fdbbceb16e5818a9119a4fd6', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.tools.min.js', '1e56c0b9072ed621be8a1c560afd7358a5c7803d', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/template.js', '7e2506792fd552c60bbf160075fc6cd33ccc7c20', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery.iviewer.js', '9190b5e69cc9f34f275e0bedca8460444c316459', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/sidebar.js', '294eaf2c5ca9452e014bfad34d65160e9b3113c4', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/jquery-1.4.2.min.js', '65cbff4e9d95d47a6f31d96ab4ea361c1f538a7b', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-vb.js', '9f5ed8ba49daa937016c3ce9396da978a683dd16', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-apollo.js', '98cd8e89050185baecf9078d37be4b1b95787de9', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-ml.js', '302ce03353c30ac70c0445aa37b34ecee8b34aa2', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-lua.js', '4d4d0f24eeb319bcbfa25c2c000f1fdd61f9cc43', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-go.js', '3ab5b2ed30f4dd5f437b521e7296eefe9ec8f71b', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-hs.js', '05b0e22f8beafb8275f3f51805545a00d70cf5e5', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/prettify.min.js', 'a4e5934397f97f79b8066984475c90af8a970a36', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-css.js', '0a6564da73538b95de1d787c36347f63595891b4', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-yaml.js', '66c3023ef2f7936d1e6778cb8a99ca9ca1795506', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-tex.js', 'f8b3190d48b329370333e888c8bd808080e8dac6', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-scala.js', 'a2d14738a1b4a5e79824c5171b6686a64381742d', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-sql.js', '469dfd225fc3866c55b80830ffa6e6f384d864ea', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-n.js', '91b2e4d9fdd2fd4adde75105f9bf54e38cfb918a', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-clj.js', '026e4ee179618c246c5876a05764f6b03e8e53a5', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-lisp.js', '4750b41bb947ff5c67c0e92884a6278cb3b2f0aa', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-xq.js', 'ea26069f950dac6f62bfa3785a2e1aa0f25b2eb6', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-vhdl.js', 'e12afa337705ba3d5535bf9dfd54d0db02814e9b', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-proto.js', '8b4404ff5baa73b04c311719d77aad14dd202c18', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/js/prettify/lang-wiki.js', '75a2708f63c2bb5bdb3bd9ebe737f39b5a0e356a', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/markers.html', 'a3eb78ab4a6d1ab2cd81ecd6df1bcf0a11a4d5b7', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/graph_class.html', 'fe53cd4ce28218bb933214e97cdba19ec299716e', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/errors.html', '1dd8658f050b0b43af73221364850fb813305686', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/packages/PHPMailer.html', '98e324cf5afdf3d1a08285c45ad1505001e5a69a', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/classes/SMTP.html', '5b746d665ea125f4ff116454a0a7ffc8bc1f1db8', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/classes/POP3.html', 'fdd7cf9a8f81705788cea0b713e7811d6450d838', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/classes/phpmailerException.html', '3b209a8e9507b1f703d9e0553a93a394e1672bdd', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/index.html', '107e2bd4ce6a76b8807a728fab60335a6f06b15e', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/classes/PHPMailer.html', 'bbbc741776f8e4e0021fb9b5efe4b7134ecef215', 'Blu-Edition'),
('./phpmailer/docs/phpdoc/namespaces/global.html', '9ea3f164ee95d0455076291cdc05c0ebf3f3d631', 'Blu-Edition'),
('./phpmailer/docs/use_gmail.txt', '2b31f79a71296666e7d1cbc4dec8d98834a7cd87', 'Blu-Edition'),
('./phpmailer/docs/pop3_article.txt', 'add200a7786ea1f5b5e9bf56f3da9f2d14bb6dbc', 'Blu-Edition'),
('./phpmailer/docs/makedocs2.sh', '6cb81f689a641c03b13a91d2e829dd9a2a4a830b', 'Blu-Edition'),
('./phpmailer/docs/extending.html', 'e57bbbe20a4503e398be784607fc0b14a72f96b9', 'Blu-Edition'),
('./phpmailer/class.smtp.php', '93b6df1077a2cef882b4f5bb3921f209c73c3810', 'Blu-Edition'),
('./phpmailer/extras/htmlfilter.php', 'f9d6cc2dc418db527f8d915e0e90cb977df1b77e', 'Blu-Edition'),
('./phpmailer/extras/ntlm_sasl_client.php', '310cce66e57e8bb5731afd0fb32be21c0ae5ecf7', 'Blu-Edition'),
('./phpmailer/extras/class.html2text.inc', '9f65cabbdaa7eeb94e7001542ef828be8c1bdfa0', 'Blu-Edition'),
('./phpmailer/ChangeLog.txt', '7ddf07c1ace001c6b46587c2cf54e855fa02dc8d', 'Blu-Edition'),
('./phpmailer/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./phpmailer/class.phpmailer.php', '9b8a9970495501884331fd6ff4c94dd9295ec0d6', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-dk.php', 'bc2259121b9ddcbf08a10c9a16e6ba48d7956502', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-zh_cn.php', 'b8b22960288ec7992c89864869094d500851214f', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-en.php', '85200baa2c294df83736c748f3426b145a665137', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-ch.php', '85144e1747400d2725f25447d520d07d00dc4e12', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-zh.php', 'be12bb9572a544465250f0944826bfaa814e7ad3', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-fr.php', '4127f819757f77fcfe3eaf863d82676823ef231f', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-it.php', 'ae10ab3ee26291805d7fb16511f5d9963c042c78', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-ja.php', 'bc7d037df02565cacf2a73d432e308df7d561ad8', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-cz.php', '7ca1b7bcff744a8937b652cb9daf246e9762d5fc', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-no.php', 'a4afd7731b23bc4e68d3921ff041bcc17a3553c7', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-hu.php', '0a39677d797a6cae74bb4ec87a5519a95c13e459', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-sk.php', 'b621226473c5d5c9e10d5f2a5d4dc8b9243b4918', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-pl.php', '7c570ca8fe12343fbb2ae9e32c2f9875cf329ee6', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-se.php', '1ce12e5040bf5616ff19eea32140697ff27b201d', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-de.php', 'dee87b59f367abf454de4e16d4d4e3ec6efd7df8', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-et.php', 'bcdd0ebf777c49e686567a374026d90bd05bfeea', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-tr.php', '0a9875151de51b0e4f38936d56c943aed0195b29', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-ru.php', '582fd8ac479e89dca0652805543466d5cbc35ad4', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-nl.php', 'd7fefd4036d911a3651c739cd96d676f51281536', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-br.php', 'a84a925aa946ef51497fc089de235578a809ed27', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-ar.php', '6cedc8557c672fe7035ec7d731ba56264d9608ee', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-ca.php', 'b8089eb58e8e202fd827348526adff69ade60af8', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-fo.php', '8b0a9a9c28a7ecd891e2c36f3fea3667159b2e40', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-ro.php', '17cec6e15aa2daa87cc021b0e67d7915c658167d', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-es.php', '97cad7b06265cd2ecb03c8bb20efb062df44acf7', 'Blu-Edition'),
('./phpmailer/language/phpmailer.lang-fi.php', 'cede8847331b7a3c83499c53b5db59735a5cf011', 'Blu-Edition'),
('./phpmailer/docs.ini', 'd5c583039ca837f4c72072838e3144274f54f004', 'Blu-Edition'),
('./booted.php', 'a64505eee598db42461c9673cde4cd6fe97e81f2', 'Blu-Edition'),
('./pmshout.php', 'ed059f6331e3782bab9538414bf5049048094c1c', 'Blu-Edition'),
('./preview.php', '9707565bb12b38a932198de17c328239e1fcc09d', 'Blu-Edition'),
('./badwords.txt', 'f238fd12e97170c7cf4bf9853e5875ac7cfe0c67', 'Blu-Edition'),
('./coverthumb.php', 'f70a9bd9f74708184fe849b3e447b4cdf92d3128', 'Blu-Edition'),
('./sxd/info.php', 'dfde6a14db1133a72f40290a14d94c8f82be0f69', 'Blu-Edition'),
('./sxd/readme_ru.txt', 'fe1b605b30c158b04b48a284b47a2dbc7d1c11b4', 'Blu-Edition'),
('./sxd/backup.sh', 'ee7ed24785c36d440a3c32f52235406f278cb99a', 'Blu-Edition'),
('./sxd/bsd_license.txt', '695eca4a6cd60edc8cd470f4074682d08803a3aa', 'Blu-Edition'),
('./sxd/backup/index.htm', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./sxd/backup/.htaccess', '27b2c46bbfb5fe5ddf47687b0206a5d96270541b', 'Blu-Edition'),
('./sxd/backup/web/index.htm', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./sxd/sxd.js', 'd15b5d0531e070d6aa1dce76ab0ca871d5ddd5a3', 'Blu-Edition'),
('./sxd/cfg.php', '652451fb717457ddb44ae9450ccffaf721b9c590', 'Blu-Edition'),
('./sxd/img/index.htm', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./sxd/lang/lng_az.php', 'f447a1d74abf52a137ffe9e023875888f92a2126', 'Blu-Edition'),
('./sxd/lang/lng_ru.php', '78e26d81c156f4bc19b194157a8886d82a039e6a', 'Blu-Edition'),
('./sxd/lang/update.php', '8289f6897e8a4b40f9c3090a0ee24597623414e4', 'Blu-Edition'),
('./sxd/lang/lng_pt-br.php', '005ad5ff2ed2200c92bca2d8bc53cbbe9488a868', 'Blu-Edition'),
('./sxd/lang/lng_it.php', 'aa3b9979feb91fb5c41b6568862047bf9aa9441f', 'Blu-Edition'),
('./sxd/lang/lng_es.php', 'ce021b672f5cd02529868a78a33b585d40ba754e', 'Blu-Edition'),
('./sxd/lang/lng_vi.php', '90851e4f08be9e60833674e1103fa5ad0e250d1a', 'Blu-Edition'),
('./sxd/lang/lng_de.php', 'cf07c164dee02525689ece9f01b3d23d4f738c79', 'Blu-Edition'),
('./sxd/lang/lng_be.php', '4e8a7978192490d6bb9f51acbe4060eed766dfc0', 'Blu-Edition'),
('./sxd/lang/lng_uk.php', '9d8d247e9ff67ba79b3272a50bd1de1b3f23ec9b', 'Blu-Edition'),
('./sxd/lang/lng_en.php', '748b1e7a0a1e24795410622a80bde503593430d2', 'Blu-Edition'),
('./sxd/lang/lng_ge.php', '34fc5d862357aaf70b9516a6c8c85e7b1a28e75e', 'Blu-Edition'),
('./sxd/lang/index.htm', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./sxd/lang/lng_kz.php', 'dbe488b3f51c9f208b9f87b2067a8d60574fb56a', 'Blu-Edition'),
('./sxd/lang/lng_bg.php', '3a396d80818bc7abda41b6fb10e34187629fbbb0', 'Blu-Edition'),
('./sxd/lang/lng_nl.php', '4d7e52752bc50315066cc87bd3bbd2b00699cd00', 'Blu-Edition'),
('./sxd/lang/lng_fr.php', '22102d896352b0a46ad309f054efcdbd80d2810f', 'Blu-Edition'),
('./sxd/lang/list.php', '91b56c4e564855df1b5fb4d6bd047864777777c8', 'Blu-Edition'),
('./sxd/lang/lng_fa.php', 'fc01e2609fda074a37689a94c166dacf046380bc', 'Blu-Edition'),
('./sxd/lang/lng_tr.php', 'dbbfed32ad5281e51629add788bef5e81d5740f7', 'Blu-Edition'),
('./sxd/lang/lng_ar.php', '17d78bf1955c10d32d568965c4ebe532c8038f05', 'Blu-Edition'),
('./sxd/ajax2/httprequest_example.html', '5bed9d5307ffdbb5b8c59d8ae2f54d235b4bd159', 'Blu-Edition'),
('./sxd/ajax2/test.html', '377ea6b433f5b6cc342aa822cd23a0defbfb0fb9', 'Blu-Edition'),
('./sxd/ajax2/webconsole_xml.html', 'ea2b72cbeb2afb32a39212ca6dbf3badb0a0d9cf', 'Blu-Edition'),
('./sxd/ajax2/webconsole.css', 'ea88f301cd72b32673555a8a0919b5a5307dfa8e', 'Blu-Edition'),
('./sxd/ajax2/yuiconsole.html', '2b8e5af0ab01cc948b72244031c2f26e6b5c7dd0', 'Blu-Edition'),
('./sxd/ajax2/exec_json.php5', '69be2322feb5cac7d95426f5425c8d5bf2c8d2fb', 'Blu-Edition'),
('./sxd/ajax2/jsimple.html', 'b653ff965fafda262526347c65b512050718055b', 'Blu-Edition'),
('./sxd/ajax2/exec_xml.php', 'dacbc55140e335782b24ea119942d93e4322dc76', 'Blu-Edition'),
('./sxd/ajax2/jquery-1.2.3.min.js', '6463e558dd79d51a2e8464806824c7bbc18c77fd', 'Blu-Edition'),
('./sxd/ajax2/st-xmlhttp.js', '50877f93db641b2a6e616f185282ae384d213ec4', 'Blu-Edition'),
('./sxd/ajax2/httprequest_test.html', '17afe3e644f7f7c16438a15c57e182d8a0c83d60', 'Blu-Edition'),
('./sxd/ajax2/exec.php', 'eef7ae4c7949b8614287a138281ec674321e8ecd', 'Blu-Edition'),
('./sxd/ajax2/jconsole.html', '244a44d4861802677f3e290a18eccd46271537cf', 'Blu-Edition'),
('./sxd/ajax2/webconsole_json.html', '4dc6bd4877cfd50b97c049d41ea1e810b3be1cdd', 'Blu-Edition'),
('./sxd/ajax2/webconsole.html', '0cd310d7fc003af4bc3d429c3a5e05bb3763ce7d', 'Blu-Edition'),
('./sxd/favicon.ico', '69e92bc68a0e8a442a1b6cd9415b9c135fb749ef', 'Blu-Edition'),
('./sxd/ajax2/json2.js', '259f0bd8bb039dcfb5b771f87f8eacf8a59a5cd2', 'Blu-Edition'),
('./sxd/index.php', '1fc3fa6066a1110c954a24d11e5a6f28c52c2ba0', 'Blu-Edition'),
('./sxd/sxd.css', '7e5c1e95c66071d57d379a6d58adf272195f59e3', 'Blu-Edition'),
('./sxd/ses.php', 'afd0a311fd1125f71d3277d6f736bafc12dd3ede', 'Blu-Edition'),
('./sxd/readme_en.txt', '3a60ecf14e2947f4f359cc64d1be75791f04f981', 'Blu-Edition'),
('./sxd/load.php', '104bf65ac416b8a59f3333f7d1d3d9f4b3f74281', 'Blu-Edition'),
('./backup_tmp/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./backup_tmp/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./comment.php', '44fa2b29569ae85f74b97e43c401ebe29f9946fe', 'Blu-Edition'),
('./btemplate/license.txt', 'c30404f9a77cd7a75e0bee3b3be5e8d80824056a', 'Blu-Edition'),
('./btemplate/bTemplate.php', '7fc818bc68210a74789b1acefbbfe5001ec350c9', 'Blu-Edition'),
('./btemplate/index.php', '317fd189f1e5cc3c7a50b903bdf1cd2754f7c395', 'Blu-Edition'),
('./moresmiles.php', 'd9c20515029effae240758ad08667a99b7f8ccf5', 'Blu-Edition'),
('./assets/fonts/glyphicons-halflings-regular.ttf', '44bc1850f570972267b169ae18f1cb06b611ffa2', 'Blu-Edition'),
('./assets/fonts/fontawesome-webfont.ttf', 'c59792c0a05a4da1f9202a390a27e2d500c36752', 'Blu-Edition'),
('./assets/fonts/fontawesome-webfont.eot', 'ad0c0513a2fbb7326ac5e11f7c94b95aa23b02e0', 'Blu-Edition'),
('./assets/fonts/glyphicons-halflings-regular.eot', '86b6f62b7853e67d3e635f6512a5a5efc58ea3c3', 'Blu-Edition'),
('./assets/fonts/fontawesome-webfont.woff', '7f2f3c55c2de192387c351b995115f6b79e09173', 'Blu-Edition'),
('./assets/fonts/FontAwesome.otf', '46198321f916ab2aa86c0ad51e0aacaa73783bd7', 'Blu-Edition'),
('./assets/fonts/fontawesome-webfont.svg', '28a0cd129eb6e57d21f8c511581f1909ee6b934a', 'Blu-Edition'),
('./assets/fonts/glyphicons-halflings-regular.woff', '278e49a86e634da6f2a02f3b47dd9d2a8f26210f', 'Blu-Edition'),
('./assets/fonts/glyphicons-halflings-regular.woff2', 'ca35b697d99cae4d1b60f2d60fcd37771987eb07', 'Blu-Edition'),
('./assets/fonts/glyphicons-halflings-regular.svg', 'de51a8494180a6db074af2dee2383f0a363c5b08', 'Blu-Edition'),
('./assets/font-awesome/fonts/fontawesome-webfont.ttf', 'c59792c0a05a4da1f9202a390a27e2d500c36752', 'Blu-Edition'),
('./assets/font-awesome/fonts/fontawesome-webfont.eot', 'ad0c0513a2fbb7326ac5e11f7c94b95aa23b02e0', 'Blu-Edition'),
('./assets/font-awesome/fonts/fontawesome-webfont.woff', '7f2f3c55c2de192387c351b995115f6b79e09173', 'Blu-Edition'),
('./assets/font-awesome/fonts/fontawesome-webfont.svg', '28a0cd129eb6e57d21f8c511581f1909ee6b934a', 'Blu-Edition'),
('./assets/font-awesome/fonts/FontAwesome.otf', '46198321f916ab2aa86c0ad51e0aacaa73783bd7', 'Blu-Edition'),
('./assets/font-awesome/css/font-awesome.css', '15e5b5a9c81e2cf89c768a80cd06c6180f35ab04', 'Blu-Edition'),
('./assets/font-awesome/css/font-awesome.min.css', '63a234ea4d60f6643a60a4d79e28f291b93c1743', 'Blu-Edition'),
('./assets/css/fonts/fontawesome-webfont.eot', 'ad0c0513a2fbb7326ac5e11f7c94b95aa23b02e0', 'Blu-Edition'),
('./assets/css/fonts/fontawesome-webfont.ttf', 'c59792c0a05a4da1f9202a390a27e2d500c36752', 'Blu-Edition'),
('./assets/css/fonts/fontawesome-webfont.woff', '7f2f3c55c2de192387c351b995115f6b79e09173', 'Blu-Edition'),
('./assets/css/fonts/FontAwesome.otf', '46198321f916ab2aa86c0ad51e0aacaa73783bd7', 'Blu-Edition'),
('./assets/css/fonts/fontawesome-webfont.svg', '28a0cd129eb6e57d21f8c511581f1909ee6b934a', 'Blu-Edition'),
('./assets/css/custom.css', '86f602004541526c8f71784211e0ab09880d2d35', 'Blu-Edition'),
('./assets/css/skins/skin-blue-light.min.css', 'd017a864fa1ea086978cfcb71ecddc1d77a824d6', 'Blu-Edition'),
('./assets/css/skins/skin-purple-light.min.css', '27c717134d29a24d9342a433d64cc5aca122c2e1', 'Blu-Edition'),
('./assets/css/skins/skin-red-light.min.css', '5be6cabed3bc2090230b60c3475aedc081bb04a2', 'Blu-Edition'),
('./assets/css/skins/skin-red.css', 'fa8e2cd88d00a92ee9764a7c679ccb2c5efb40f2', 'Blu-Edition'),
('./assets/css/skins/skin-yellow-light.css', 'b8421168619e7a330d8322bc7936ae1e97f67c7a', 'Blu-Edition'),
('./assets/css/skins/skin-black-light.min.css', '4297fd0af0cb186d2a30592be2b2e5c45dfcea16', 'Blu-Edition'),
('./assets/css/skins/skin-blue.css', '358f8c9b73ee37ffec3542bf5be748662d8e15c8', 'Blu-Edition'),
('./assets/css/skins/skin-red-light.css', 'fb156cd66857e61458200f47faa01d9f169135e7', 'Blu-Edition'),
('./assets/css/skins/skin-green-light.min.css', '1a0bdb6bd73b03e013446ffe2d57bbf2ef30e4d9', 'Blu-Edition'),
('./assets/css/skins/skin-black.css', '023fca746100e9cb203d7de8549604c021e07c81', 'Blu-Edition'),
('./assets/css/skins/skin-green-light.css', '7525ae422387a3239318c14938c85f30e1e485d8', 'Blu-Edition'),
('./assets/css/skins/skin-green.css', '6793a477866ec6a1745a564067c2b9bb99018c20', 'Blu-Edition'),
('./assets/css/skins/_all-skins.min.css', 'fe8767fd149a076ed298c2b71c21a3d44f4e542e', 'Blu-Edition'),
('./assets/css/skins/skin-purple-light.css', '1afc98bf3df204ae8586e6c7e0b70ff735019b70', 'Blu-Edition'),
('./assets/css/skins/skin-blue-light.css', '6077e9322eeb590d8ba183a407c5a913ba33000a', 'Blu-Edition'),
('./assets/css/skins/skin-yellow.css', 'fb4fec1f4f1e78116078e9a38119667b510a7a5b', 'Blu-Edition'),
('./assets/css/skins/skin-black.min.css', '99db585a8b19e3e7fd99ddef84f61335fdfe714a', 'Blu-Edition'),
('./assets/css/skins/skin-yellow-light.min.css', '53e239451fc6ac94ad8ba998ad68923d50909978', 'Blu-Edition'),
('./assets/css/skins/skin-black-light.css', 'c5f90990a83693d4b651c4d895435bd19c7b18c4', 'Blu-Edition'),
('./assets/css/skins/skin-yellow.min.css', '8613cc5bd98f4559d1fd51b02608dec76f21582f', 'Blu-Edition'),
('./assets/css/skins/skin-purple.min.css', 'c84a4492c9e307f801486ee7828b6e92c442edc3', 'Blu-Edition'),
('./assets/css/skins/skin-blue.min.css', '00945edeecebf440e3dcdd4d509935fc4ef64763', 'Blu-Edition'),
('./assets/css/skins/skin-red.min.css', 'e5e2c2310056efb3047a96f411265d1ce8009eae', 'Blu-Edition'),
('./assets/css/skins/_all-skins.css', 'dffae95fa8c718533d4b110079d9397c839d1d5d', 'Blu-Edition'),
('./assets/css/skins/skin-green.min.css', 'dfdab796857dddd1baaee9d8f28a8a6238e8107f', 'Blu-Edition'),
('./assets/css/skins/skin-purple.css', 'be5df7b309fe8e2d4ae72e8c50f4a0741e68739c', 'Blu-Edition'),
('./assets/css/custom.min.css', 'b27a6d51f8e0fda5ffbe001e05d676fec03b1ae6', 'Blu-Edition'),
('./assets/bootstrap/css/bootstrap.css', 'b07b6439e4919d275cc0b6e00ae18c572349a914', 'Blu-Edition'),
('./assets/bootstrap/css/bootstrap.min.css', '10f21dc14a6443ce473c7807014870468f94729a', 'Blu-Edition'),
('./assets/bootstrap/css/bootstrap.css.map', '7d9441b7c167dc3822c0881c16c943094fcbaa38', 'Blu-Edition'),
('./assets/bootstrap/js/bootstrap.js', '8c639912ccd43078865578e598607d1b847c2373', 'Blu-Edition'),
('./assets/bootstrap/js/bootstrap.min.js', '26908395e7a9a4eab607d80aa50a81d65f3017cb', 'Blu-Edition'),
('./assets/js/pages/dashboard.js', '83fe921211c9689812b7c2947212eef14f24854a', 'Blu-Edition'),
('./assets/js/pages/dashboard2.js', '816d0caf3819b7b1e842851a54368d311e518369', 'Blu-Edition'),
('./assets/js/app.js', '6b5a6242291f7dc93facf4a45cba0a05807ad445', 'Blu-Edition'),
('./assets/js/app.min.js', '9689c4a7735f2eb666382378e78d210367e00572', 'Blu-Edition'),
('./assets/js/less-1.7.3.min.js', '54c006ac41c366111854b0c88a47ffb7af0629fe', 'Blu-Edition'),
('./assets/js/demo.js', 'd825c11f96767d194b7870d37ec77da155f77d65', 'Blu-Edition'),
('./assets/plugins/iCheck/icheck.js', 'dc24458c0072cf2bf67a72278d7b5877e320b9c1', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/yellow.css', '3a37a15814cb651b83094c6c1684ea8502cb4c3f', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/flat.css', '60b25ca8665011ac79ecae73d896c236199a4be5', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/purple.css', 'b2870e219a8a42dc81055eed6caf169bf43bad30', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/aero.css', '6cae5f3800263ae9d23f4e1f724ea1b2f4e6e863', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/green.css', '43f50d843e81f4c78ef6a208b12961ee498d945d', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/blue.css', '5425aeaa2260f26c1e763545c769d25d0bd5867c', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/red.css', '9d3c4dad7281fd78d1a6191d420c4e22090d0a15', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/grey.css', '54b7251c1c95356e5a4fddfd76991c60fe24d9a3', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/_all.css', 'dc7c8ffd998b15bb91c52e22c4aca72efdc30380', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/orange.css', '0c6727f60bdce1b6d6fc0b0d977477806fcbc2d3', 'Blu-Edition'),
('./assets/plugins/iCheck/flat/pink.css', 'ba217f96bba0a3483e81db0027ca92a76d385abe', 'Blu-Edition'),
('./assets/plugins/iCheck/all.css', '9569852a3acb017552ecb6484d7ab2a2392a6fb0', 'Blu-Edition'),
('./assets/plugins/iCheck/icheck.min.js', 'b5ae4e9efe2d42a55d0e01b2bbc43b9a518996c4', 'Blu-Edition'),
('./assets/plugins/iCheck/square/yellow.css', 'e582cb427c8ee34d156e6b1e0419ad54563a0b5e', 'Blu-Edition'),
('./assets/plugins/iCheck/square/square.css', '582e71242c1b272f7a8fa07e3c632412a2e46cd3', 'Blu-Edition'),
('./assets/plugins/iCheck/square/aero.css', 'd8a78534fd235ba8458c4eeca963c77f84fdce7c', 'Blu-Edition'),
('./assets/plugins/iCheck/square/purple.css', '180f815eb5091837c8ff31f714ee95a68b8ad8e0', 'Blu-Edition'),
('./assets/plugins/iCheck/square/blue.css', 'd18acf65e95e79a0329d7cae5204897b79a68699', 'Blu-Edition'),
('./assets/plugins/iCheck/square/green.css', '51592f7872ca7a8c6c18edd4c7a7269bacd3d411', 'Blu-Edition'),
('./assets/plugins/iCheck/square/red.css', '9ac645ab846589527063e3903737c5637e440fb1', 'Blu-Edition'),
('./assets/plugins/iCheck/square/grey.css', '3bff34a968e431c100813bdf5fcedd3b86fb53f7', 'Blu-Edition'),
('./assets/plugins/iCheck/square/_all.css', 'ce4cbd345a783f2e46543b50ddc419fd8e029222', 'Blu-Edition'),
('./assets/plugins/iCheck/square/orange.css', '29feae4aa1749b4a99b5885f093d731134e083cd', 'Blu-Edition'),
('./assets/plugins/iCheck/square/pink.css', 'd85ad42427b54924f3dd9fe76a63b1e7f15e06f1', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/yellow.css', 'c8c0c7a765d51bff8d57fe984b99492e803b21a5', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/aero.css', 'e67ee9754574db9c9313d70e3ee0b9b4e2543832', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/purple.css', '9d05edeaca7b8ed015f8bcdc0a2f0f288b12e5ac', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/green.css', '426dce0f8c155d27bf6b61ed370c4907ba5fb999', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/minimal.css', '4749f6daf2ab781636eb4d9a11ec0ef4d3569a07', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/blue.css', '33effcdaf4118bec912993ae21815d9d0a00b89e', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/red.css', '36d689b42d62e8e747f8ee14ffbbe7775f6e8633', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/grey.css', '4d279a23ee3c57fe9f57074fd6c84afbeed63c03', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/_all.css', '4f4feff4f80386c205eb5a4928538519b1ea674f', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/orange.css', '19730885bd6d2b9954a71e869d13d17bd1555e4c', 'Blu-Edition'),
('./assets/plugins/iCheck/minimal/pink.css', '650c35822a8b4019c32b1731548a663fa75edf56', 'Blu-Edition'),
('./assets/plugins/iCheck/polaris/polaris.css', '058b9a99053fc3c697c0a30b7bcb562f97976c48', 'Blu-Edition'),
('./assets/plugins/iCheck/futurico/futurico.css', 'fb02e349dc5fab1494559b78780cb57f3b97f823', 'Blu-Edition'),
('./assets/plugins/iCheck/line/yellow.css', '7f3e934fc846ce60b2f2f22df5bde98efe2f4889', 'Blu-Edition'),
('./assets/plugins/iCheck/line/line.css', '2d3e57ece8d85ff24735fb0737231f80ff0fbeee', 'Blu-Edition'),
('./assets/plugins/iCheck/line/aero.css', '8c89b04a176985533fc906de22ca9eb09e6f89d2', 'Blu-Edition'),
('./assets/plugins/iCheck/line/purple.css', '60b4062a29e4b262eb92d1f5a41ab2c68ab77698', 'Blu-Edition'),
('./assets/plugins/iCheck/line/green.css', '0d19678b553af55d8dd0b1af782d7faac6b70b45', 'Blu-Edition'),
('./assets/plugins/iCheck/line/blue.css', '3a3c1c99f0e556cca8d8af21e2ffb6242d1905e9', 'Blu-Edition'),
('./assets/plugins/iCheck/line/red.css', '7f4ca2b61e3c55d40bd5541ccd50b4056ce94abd', 'Blu-Edition'),
('./assets/plugins/iCheck/line/grey.css', '99506cff35e23af352e8c0aec3c53060059c4cd9', 'Blu-Edition'),
('./assets/plugins/iCheck/line/_all.css', '7504b05a5638a2e8f71afd7e7c0c2daf55eeb6aa', 'Blu-Edition'),
('./assets/plugins/iCheck/line/orange.css', '4e987567289164353fe725d4d1393729fff3947d', 'Blu-Edition'),
('./assets/plugins/iCheck/line/pink.css', '22a1e45a2b9bfc7579b63e0796079bda45729807', 'Blu-Edition'),
('./assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css', '473130f6cee75918f10a7a5234270cdf7bfe39b2', 'Blu-Edition'),
('./assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css', '473130f6cee75918f10a7a5234270cdf7bfe39b2', 'Blu-Edition'),
('./assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css', '225e51d0b44bde30f1b32e9851e68221bda24334', 'Blu-Edition'),
('./assets/plugins/bootstrap-switch/css/bootstrap-switch.css', '50af48e2b48a076146179abd50e62b24d4478bbe', 'Blu-Edition'),
('./assets/plugins/bootstrap-switch/js/bootstrap-switch.js', '33d3df57b2e79ab606e5a84603c17d2da312a360', 'Blu-Edition'),
('./assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js', 'eb62413f2a8b4988de6c04344b72eb8f6113e15a', 'Blu-Edition'),
('./assets/plugins/fastclick/fastclick.min.js', '4f1721e190356cf41677d009afddff17a3fd1aec', 'Blu-Edition'),
('./assets/plugins/fastclick/fastclick.js', '06cef196733a710e77ad7e386ced6963f092dc55', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.fillbetween.js', '218bf736f39510ee84515d1eb4740d998705cc75', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.navigate.min.js', 'fb2c8bfa06c33323c2656b480fefce8d23aa7d87', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.pie.min.js', '9cbfb4b9213ada6204fdb4d31aa02ab80cfffeae', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.canvas.min.js', '9c34eadcee96dab37ba0f5ec4cfe18710ee93432', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.resize.min.js', 'ca530ffd99cecb0950641ea6820d55b84ca3bccc', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.errorbars.min.js', '0d9f0e3387cfb84e1fbadb2c85bd14e53963bacc', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.selection.min.js', '47337d26eb2e6fc31bc762fbe951db0204443843', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.image.min.js', '4ad6d6d71c9a0099e73cb8996d6e7ac94efec7f5', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.symbol.js', '4e0476b677f928dfd0d2dcc611bfdeb1b2396026', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.symbol.min.js', '6c3a8a2c231a09f20407978445a12a9869d53731', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.crosshair.js', 'a0c0427b95698d8ae32f897c99fa617a4bb407db', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.resize.js', 'd4fd46d7743b0ce475439584d2dd377b30d088b8', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.categories.min.js', '0f8c0e6c869503efa3a239676f462e28ade43351', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.selection.js', '02d28be773b727994939842d1367aa7312dea366', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.image.js', 'c341458da2e6e1d61e2c856a78ccc116528a38ed', 'Blu-Edition'),
('./assets/plugins/flot/excanvas.js', 'a952b1d45fbf85053bb98a6ff83d317b9ad8e81e', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.categories.js', '587bbfe980bcc5f1cfa5e2094321a029ff853cba', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.stack.min.js', '5fda15047703b140a01cde4225317201b7cc44a9', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.min.js', 'a028033c7e459d2f3cd01d79264aa4a978b672b1', 'Blu-Edition'),
('./assets/plugins/flot/jquery.colorhelpers.js', 'ec226ebaaf255d3d1ccd71668537b69f8156e9c4', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.fillbetween.min.js', '093c52d7cf4222a05b0a2d4aeb4d1fa70084606d', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.stack.js', 'f5a9eddb729d69c2528ce15d0bc0477b03d1f07b', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.time.min.js', 'e6234f222c0b30ef4b1774e1d08daa5a51789167', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.threshold.js', 'cfa3baac69af648e48b7087bc49efdae42497cfb', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.js', 'cccfbf71d32e55892f49b45ae92da4c5743a422b', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.crosshair.min.js', '03c919fefeea30e2c1732e0dc010f9f00b29c7a2', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.time.js', '34131a3585ac57c64692079c4926ac8cd2d996ef', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.pie.js', '549382635c71d60ee897346606cab37e395b1b7a', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.navigate.js', 'c2cf985e4a6d9c6095e923e4f9d6725dec165565', 'Blu-Edition'),
('./assets/plugins/flot/excanvas.min.js', 'ae4ce1a2bfb06c82653633191b04a8969a946b6b', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.errorbars.js', 'dce1cb2ad52131eb5191cc9f3be8e70ce0537b8f', 'Blu-Edition'),
('./assets/plugins/flot/jquery.colorhelpers.min.js', '73bcc5e2f8c1dca0e53f852a08e485b777847fd5', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.canvas.js', '4312c5f10d296cc462e12799e61f853fb05ea8b0', 'Blu-Edition'),
('./assets/plugins/flot/jquery.flot.threshold.min.js', '289a70855e120685b8f56ff4b4e2d8bfa109272f', 'Blu-Edition'),
('./assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', '48239511aef6fd2b90ef5869f9c334e7a0145a0f', 'Blu-Edition'),
('./assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js', 'd5dba3be24cec6edb43e19d0a213065fff1282e9', 'Blu-Edition'),
('./assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', 'e3c5709b8ec55b17b5426a65bb071604112625d2', 'Blu-Edition'),
('./assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css', 'fe68a3b73996751831c706195717226a6476c583', 'Blu-Edition'),
('./assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', 'cfb12d45109ada73eb1adedfb619f47c7937bd7e', 'Blu-Edition'),
('./assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css', 'e3af63b7f572efcdd2df6de3cf385e581a84f7a8', 'Blu-Edition'),
('./assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', '2d075abee9db8edcd7c2c5834f3940820b75abb4', 'Blu-Edition'),
('./assets/plugins/maskedinput/js/jquery.maskedinput.min.js', 'db884486ad1d0fccb6bcbf793a21833b97df1e27', 'Blu-Edition'),
('./assets/plugins/maskedinput/js/jquery.maskedinput.js', '3c3a99e68168ad235a9e8dd0b6cf4258d322bb95', 'Blu-Edition'),
('./assets/plugins/fuelux/fonts/fuelux.woff', 'b5c140c6c75bd3f66fd7681a6e79f7b865c10624', 'Blu-Edition'),
('./assets/plugins/fuelux/fonts/fuelux.svg', '157cd51b6d0052b29429c4908200439d72a6bcb0', 'Blu-Edition'),
('./assets/plugins/fuelux/fonts/fuelux.ttf', '8045e8d6c49c09eecab73ac93cbd522e00a84b10', 'Blu-Edition'),
('./assets/plugins/fuelux/fonts/fuelux.eot', 'fd6cdebe00087910b65ebe4d85a45ba37024c254', 'Blu-Edition'),
('./assets/plugins/fuelux/css/fuelux.css', '0c61b85bf1e3ec0d13981d8dd7441bd2d1d517da', 'Blu-Edition'),
('./assets/plugins/fuelux/css/fuelux.min.css', '7c0b2f999115ad3a5632a82a7b8ccb0b28eaf2ae', 'Blu-Edition'),
('./assets/plugins/fuelux/css/fuelux.css.map', '1464b4368d4e2f5ee0705112a86a4132747140a2', 'Blu-Edition'),
('./assets/plugins/fuelux/js/fuelux.min.js', 'b9550d069bec17af67ac64d547e65a82b5f5ec9e', 'Blu-Edition'),
('./assets/plugins/fuelux/js/wizard.js', '81b617be3545e5b49f5b002f261e539ca761f06f', 'Blu-Edition'),
('./assets/plugins/fuelux/js/fuelux.js', '8106810e094b0cf6d509a58d55f77231783d6961', 'Blu-Edition'),
('./assets/plugins/ckeditor/contents.css', 'f68463839ec5ead4b1b9cee277571edeae889704', 'Blu-Edition'),
('./assets/plugins/ckeditor/CHANGES.md', 'a1537f4b242f0fba5011db79e113dc8cfb7dc80f', 'Blu-Edition'),
('./assets/plugins/ckeditor/LICENSE.md', '03dfb297ddfe8f489804ccac9d8e602be0a760c3', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/zh-cn.js', 'f1a74b2e7811b2f03a070e6285b94e7e2d51f53c', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ug.js', '697869de6cbddcf438a3031b4181632151759225', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/da.js', '61a88ddb684dd1b6815f439a6bab5489fe706100', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/bn.js', '7db92d4fc9f445cacf457b136334a550d6c10963', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/hi.js', '74f30450b944ca5ab528c5e61306dafbc764e11f', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/fo.js', 'c2d7453cd1b1c632a1c881e04706e295a4a17957', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/pl.js', 'f8212e5133bbf5fd2e86a7548b1078b9b4060984', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/lv.js', 'cda3b7e96c29c35f8cd8e019987c5d023fc5aeb1', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/th.js', '8a3e869a574f4c60e60a57455e21c22bb6f11b50', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/fi.js', 'ba51efba83e287af69f532fa6c67c0ef7222e166', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/mk.js', 'd4a0a8efc35bed1b674304c04e5df7e3392bde5d', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ko.js', '59f4838d70b027331925ac2246ba214e821377c7', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/mn.js', '392d8cc8a894b7bb2fa2fc5b5e35a1085b577811', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/id.js', 'db4f1d240bbad1e16d2ffe01dd611cd362399ddb', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./assets/plugins/ckeditor/lang/sl.js', '904fe37f4cf7b6229f2d24d12c55739cc34724a5', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/hr.js', '5f4de82c325a6877fd8b5a771b2c83767576438b', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/en.js', '00d57340a1cf1fb28b1355ebda61d4ede258da81', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/es.js', '40a09f767209ef67f2b063ece4fc34ca660e01c2', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/gl.js', '6fb3592b51ada778bf2e93cc932cdd72ee3ca5e6', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/bs.js', '31bc281d36a3ffbcd0b11da44c0f0655a888cc09', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/eu.js', '2e78ba2a1b52944f3ca21e264547aee1c519572e', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ca.js', '81961eccf513909c55a983bca74ccaa4ced50395', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/is.js', '4890e3790751a6e63bcc89c6613ee17c0b668558', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/he.js', 'cbe51a432d00d55696d12e8b02a4252eb7f8632a', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/si.js', '723da0e0a62a03037683fef1331780061849c9f0', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/nb.js', 'f8204721eb993ae89339e3716e3cce3af15a76fc', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/sr-latn.js', '061d1c2254e25ece82243f3199e54f8c77f9e5d3', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/zh.js', '4d4ed4c45fc19fb45b105fb8ca7628034ec2befb', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/it.js', '09d1bad276bc4e80419d6ffb4524461e2238c4c6', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/el.js', '481863eec430cbe2b14a652db3559987ae4fb0eb', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/tr.js', '1d01c12b7927c5313a872e36b1392b862a729dc9', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ja.js', 'a99ec8eccd7f3f05b7ed54bf5bf82ccd1ad39720', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/sk.js', 'c306a8b1c5bfbe45cf0911a1052bb15bca965179', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ka.js', 'd51971720f41b87e48c49f9a47380f45f4a93637', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ms.js', '5aeaccc8ef66b0a918d2a15fced5ecba4a45fa0f', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ku.js', '694327d5d087b7d94bcc8fb4d131bdbb255ae896', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/et.js', '64e82fc99ee6ca1717eaecaa169ed9e0f835311c', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/gu.js', 'ccabb81f9e651afa4ca155e41a74d375b1fcfb63', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/cy.js', '5ac0636c4a8269e4ea0402d79110645256d7a247', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ar.js', 'e07c4a3925595bb1218b811963147c9ca804fb84', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/fr.js', 'dc348b8d4d835c64e7189d706f6b42889a249d3e', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/pt.js', 'a1c7f142be4fe24ebefc9dfaf34e857bf49ec126', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/eo.js', 'c8b29cd6fc47ae02a4cd2f7595d20f3b08d154d2', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/bg.js', '8f00bcb2a9c362dabf0f903af6bc1564f1f45cb1', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/nl.js', 'dcf91ca451d533e1c964b0f94ab5931bdd420c6b', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/no.js', '6463967fb2e46e6faba26583128547742d0eb794', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/fa.js', 'f7554733b456d31af30aad3eca60e3b1645dd32c', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/en-au.js', '68d1a7f093492ffdfe00d820a10ef767ef78acd2', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/km.js', '28b3066ad82a124117dcf9e5ac500e4d429bd6a3', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/en-ca.js', 'a6cbf96f9f0c44b96ea521649e34612b1d703746', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/hu.js', '216b98a51201379b0b98390793579efb9edcf5bb', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ru.js', 'b3588cd6d95bd3302f91a33f61b99dfcf498a6ee', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/de.js', 'acd14d230ed4f55116cd9e12cd8a274349e2d62a', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/ro.js', '10617e716ce35f772ba84cdf2d83f5d9bfe5437e', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/pt-br.js', '45ad8a37d8c7ca6131053f1d466e85519cd7b184', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/sq.js', 'f10bfe156677e434c5b326c8c586eeaf94dcaa5e', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/sv.js', '041eaa5b0b7357224436408d79b62bde0d7d61ef', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/fr-ca.js', '30300b81735fb180d3ada760776626c39106b8ed', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/vi.js', '4961ee02477f236b5eb3c110f6ded6a1cfdb22f3', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/sr.js', 'f6146f8edd410b031a3138a9b4544efeda8d52a2', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/af.js', '0adeaea18bba2c67cf83ab88b3055e59d6a124d7', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/en-gb.js', 'cc71cba59e9aa239821d94b4e586766c36cbc4ef', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/lt.js', '1a14c7213403f40e5087244efb87e12639829718', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/cs.js', '8a570446e6d8a5edcdb518684b70b865ae950ef7', 'Blu-Edition'),
('./assets/plugins/ckeditor/lang/uk.js', '9e6ae7c34b37c1f07acfac5ecfc288322c450b49', 'Blu-Edition'),
('./assets/plugins/ckeditor/README.md', '9baae53dd8c6400c497e63275f809334dab8ff28', 'Blu-Edition'),
('./assets/plugins/ckeditor/styles.js', '6c75dc1e38de9d6e18417da84910850d6a895857', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/dialog_iequirks.css', '609bb9ff026f6bafcc2e8300bad1f9d86e8e161c', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/editor_ie8.css', '8ab52031485cdef6f1863e3c06d5d96e67097043', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/dialog_opera.css', '475202928407cbc6cb263b1d1a902046816cb949', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/editor_ie.css', '085f92ed857b801f21b9acb64bd22e71a3280637', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/dialog_ie8.css', '6a0b7a9aa308ff1e62d041718ba6a07b4552035e', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/readme.md', '2e40ad8d0d55a842bc90adab9654fa0ccf45bd5b', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/dialog_ie.css', '83e0e0e3dc082aa5b201b25ab73043f2e2bcf815', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/editor_gecko.css', '39cd1d8cbcf93aadb462c4893b0804f2f69f8460', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/editor_iequirks.css', '6b87a2b4f8c68b12e7773f77d2611f90343d29e1', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/editor_ie7.css', 'ef2141a58722be99bfb0a0b5ac2d9cfb22408c27', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/editor.css', '5cf7ea72fa9926d844c6c27ec5840a2ff519a2e9', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/dialog_ie7.css', '4cdda4a307e67856bc6e9b97176187bcc533a865', 'Blu-Edition'),
('./assets/plugins/ckeditor/skins/moono/dialog.css', 'ed910fe0241ec17beaf43a208d1bf7ac893f8536', 'Blu-Edition'),
('./assets/plugins/ckeditor/plugins/wsc/LICENSE.md', '539a2a3b02107b2e19f4c92919a285fb5345b5c7', 'Blu-Edition'),
('./assets/plugins/ckeditor/plugins/wsc/README.md', 'b6d3b84088f77f8c4f067aec5e4b05f294780687', 'Blu-Edition'),
('./assets/plugins/ckeditor/plugins/scayt/LICENSE.md', '3c432a78be5de93f457954bed4a836a844f2a956', 'Blu-Edition'),
('./assets/plugins/ckeditor/plugins/scayt/README.md', 'ba01d7828e34237c81a7fb517ab6bb2d3ce85d97', 'Blu-Edition'),
('./assets/plugins/ckeditor/plugins/dialog/dialogDefinition.js', '93469fe9b398670df7517f971f6d3676782114ba', 'Blu-Edition'),
('./assets/plugins/ckeditor/build-config.js', '39cb7638c45b0b3d40547f3030a9b076ca0a07ab', 'Blu-Edition'),
('./assets/plugins/ckeditor/config.js', '74fb0bf553b28a4a85aec2d538c13c640acc7c53', 'Blu-Edition'),
('./assets/plugins/ckeditor/adapters/jquery.js', 'f2168126c362811fe30319191d2d4089c518742c', 'Blu-Edition'),
('./assets/plugins/ckeditor/ckeditor.js', '1db1e388cf50f7e6e41e5f461259ef045e285899', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.fa.js', 'cb45067be58a506bb8ae2eb12a9e3d392e93ddbb', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.rs-latin.js', 'a446e47ffc869541f988cd3eccbd60f163e9520e', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.bg.js', 'f5078baf0cc976ab7625532595a4a5255126e36f', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.cs.js', 'ff5838f3a89b90954cf420cd6fa65894542de5d0', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ka.js', '8667d182dab218542e7148f8d9c6775de4425564', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.kk.js', '49318bca42ec1e396c0d6bbf4af3d82f3c82456d', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.rs.js', 'b6da348ab4aa1133e9cdfb5945dc0f8adbc1d747', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.nl-BE.js', '34934c0e0c8245ffae5762eda2da274dc5146f5b', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.sv.js', '2ae3416354069bb4b88ec470155b9a788534d044', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.de.js', '69cac0319550a1befadf48b7fc83273ac000c6c0', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.fr.js', '93684d03664ec3bbc0af67eddc0043b270b84163', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.da.js', 'e8fc5453d5ef334d8054318b7108e4000bde87ca', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.fi.js', '266d55e6e3218443fa2f7ee1400a15ae78b11d85', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.et.js', 'de8d162e99dce995e7b098ca3bafcefe2a277c96', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.es.js', '6b1a84793775db56e9f17d180b8174d7a3c381ba', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js', '2df25ea0acf74c10f7d9f2689e44e73acf66287a', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.el.js', 'a38aa106e07a262739c2e0f684347f9a5c2f73cb', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.hr.js', '9384c0452edfb945b022498d3154a55da2902af1', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.tr.js', 'dbadcdafa621ee45268cac0cda38830f15a0ae7e', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.cy.js', 'd222de3849c947fdeb89c6956eda3d72dbb92f5a', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.zh-TW.js', 'e7031236795c369d2245dc65164eeb3b56400c8c', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.th.js', '26142ded8e7b3e5b96906fa25bd448cd72641633', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.az.js', 'ec44e0bbbaddd065bda0ce458c1697779b543dcd', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.sw.js', '3613b34430e45a5fee9d9618d998a700757ffbc5', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.pl.js', '70bc49589ce9fef59bc1592f2141b2547264cce2', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.nl.js', '671559ecfd24ed6e2a321686a12ff55aae98c3d6', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.no.js', 'ee2ff8b16f2095307bc22fff219adb5ba9775988', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.nb.js', 'b90d8c14d0a2fb596b2053434ac0ad7c36ef5353', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ms.js', 'a177a2cee8af7a2788b761f2f74770dabdb1d8a7', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.it.js', '1ea03eb6aaeaf7a48ba0a91f62367488e452a31f', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ro.js', 'e17125c7482306c11009e68ea4fc9d939fdc2303', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.sq.js', 'bace33c008f0e010ffeb74af44a91b1d136bdf51', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.gl.js', '5405da0119a42e96f652eea3e6f48e096e8ee2fd', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.lt.js', '3f2f770854f6b2678f8982bc910686bac4341a27', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ja.js', '54818258199493e5fef24c65fee98e80492586be', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.is.js', 'f540ca9eb8d0b358531562ed9ade8eebb22add12', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ua.js', 'a90b108ae225b788249dd7c2cf98aaaf701bcddb', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js', '09d67dedeff4dbb98bd1772a2e5ff2ece32efcec', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.hu.js', 'ee27d00a3952645d2b568b3094542c4a48bcc4eb', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.sl.js', '3ae0d6eb97e5837528f8a25945fc6783a259671f', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ca.js', 'fa01ed0fb9229d7b8786dd8fa27f7eeb4484c7bd', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ar.js', '3416fc2aebe14b265bda00535fe2f0ebcd213996', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.id.js', '59a1963de822e5d151fceb3f4f499909ea60095b', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.ru.js', '9a26e0b6b9ad7c4615d4375c604996fc8c937e8d', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.he.js', '99407ce5abe210037a36f49b40c7a11d2718b03d', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.vi.js', 'f3644ba603bab13df87b45522b96cfab48484c76', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.lv.js', 'c1f2c9b67729fed040c015b0986a4b9aca1099e4', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.pt.js', '480b09ea20e71a00e6b0b3ca2fa36ee05e9b9338', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.kr.js', '21be916373d3ad946d79d010b701e68af1ad8b02', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.sk.js', 'ac3ef1c7d41b531efcf91c88bef7ff2533f1b308', 'Blu-Edition'),
('./assets/plugins/datepicker/locales/bootstrap-datepicker.mk.js', '73d298164a41143f4b0cdaa6d336515a3bc88a75', 'Blu-Edition'),
('./assets/plugins/datepicker/datepicker3.css', 'e656abb52f27cec11a257f5fa048014c82952bb5', 'Blu-Edition'),
('./assets/plugins/datepicker/bootstrap-datepicker.js', '0d3375e841471d11edca86c3952811d02b8baf1e', 'Blu-Edition'),
('./assets/plugins/sparkline/jquery.sparkline.min.js', '7e3cc75c9facc4ef22dc14002ee79e0976cc0130', 'Blu-Edition'),
('./assets/plugins/sparkline/jquery.sparkline.js', '5bdadbf3f555341c5507059df20f67770df7f15a', 'Blu-Edition'),
('./assets/plugins/ionslider/ion.rangeSlider.css', 'a06387f61d62b376e842fb606423a34c9710cea5', 'Blu-Edition'),
('./assets/plugins/ionslider/ion.rangeSlider.min.js', 'd0c469ad24b3d886f8de3bb8509ef20c64def526', 'Blu-Edition'),
('./assets/plugins/ionslider/ion.rangeSlider.skinFlat.css', 'eb6fd4590d00c8053df91f6c4f44fd224aabc48d', 'Blu-Edition'),
('./assets/plugins/ionslider/ion.rangeSlider.skinNice.css', 'aefc9a4a274bb02c818967d6ea13cc73cdc2c919', 'Blu-Edition'),
('./assets/plugins/timepicker/bootstrap-timepicker.min.js', '716915a88d6facc148f44667b050c2828b72c961', 'Blu-Edition'),
('./assets/plugins/timepicker/bootstrap-timepicker.min.css', '51c9f4a45341db8d7903f8844e03b9531ae0eaaf', 'Blu-Edition'),
('./assets/plugins/timepicker/bootstrap-timepicker.js', 'bb7eb04b37fab5ebddc9de40b24824dbc43187ad', 'Blu-Edition'),
('./assets/plugins/timepicker/bootstrap-timepicker.css', 'f8c5d1525fdd57ba1a88659924838093f5b7e0d9', 'Blu-Edition'),
('./assets/plugins/slider/css/slider.css', 'dd71d6f198dc529ebe18f737aebcd2d8e462f31d', 'Blu-Edition'),
('./assets/plugins/slider/js/bootstrap-slider.js', '2076ec887334360a4681e92a4564479a052e55b4', 'Blu-Edition'),
('./assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css', '01b6fdfdaa4ba7aafae3cc9540cc787d6ef88f31', 'Blu-Edition'),
('./assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css', '894cc9fa1dc08a154ba3306cfb63a5683eff4fd8', 'Blu-Edition'),
('./assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js', '1a5ec3fa42997fcc8f33d0cf13c2011c4e09c195', 'Blu-Edition'),
('./assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js', '0202e7cf50700f5e7426d664de16e6917797482e', 'Blu-Edition'),
('./assets/plugins/bootstrap-daterangepicker-master/css/daterangepicker-bs3.css', '82186fa18bba063e69fdbdfc298014ec951bd61b', 'Blu-Edition'),
('./assets/plugins/bootstrap-daterangepicker-master/js/moment.js', 'e41ccd86285c314005a459d4331e6adb88adef3b', 'Blu-Edition'),
('./assets/plugins/bootstrap-daterangepicker-master/js/moment.min.js', 'b50a487fd9375c2e82ae0ce97ec2ae2d22ebb24f', 'Blu-Edition'),
('./assets/plugins/bootstrap-daterangepicker-master/js/daterangepicker.js', 'bb938c8e1f375fee0d3d45aeea902707730a5634', 'Blu-Edition'),
('./assets/plugins/bootstrap-slider/slider.css', 'f3afc0ee93d802bec9915688107f5f7ae9ed88a3', 'Blu-Edition'),
('./assets/plugins/bootstrap-slider/bootstrap-slider.js', 'b7db4ff7065dd9f4a5ebd10bd85950b2fa3b42a7', 'Blu-Edition'),
('./assets/plugins/morris/morris.js', 'e953ff39cc7a41e3cc7e57d97094b4895685c925', 'Blu-Edition'),
('./assets/plugins/morris/morris.min.js', 'f40a80188a0422041f59284940c46d86c163a279', 'Blu-Edition'),
('./assets/plugins/morris/morris.css', '4a6aa5dedb6b8a229332f58e3ceb1ecebb1fd4be', 'Blu-Edition'),
('./assets/plugins/pace/pace.js', '1d6f79b5757de7cc40dcfded7cfdb067a90810d3', 'Blu-Edition'),
('./assets/plugins/iCheck-master/js/icheck.js', 'e39cd439a90d0ab41945a0a3819580190526be10', 'Blu-Edition'),
('./assets/plugins/iCheck-master/js/icheck.min.js', '4a1f2abaf3bc1b4aec31d199b6b236112106ad32', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/yellow.css', 'b9338134e943df760e46d0c6928853b39c7742dc', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/flat.css', '5e89d68c8a6bd3739a7ce414a56ced7e26e9c07d', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/aero.css', '90ecd0876e79547698db70bcd1bc5620766aa031', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/purple.css', '3d072e65834dc33186a1f89d274927c47c4bd4b9', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/green.css', '3a4435db1d13a27065dc6de0a743fbc88d7cf1fe', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/blue.css', '53edcb68b036550a9c141fb98f0a81390daccd25', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/red.css', '2380c62cc2f60975a212ecfcbdeff11b1bd114c9', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/grey.css', '30394f44cc84c86d78fb57b6ecda2889856bd552', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/_all.css', '84152c7f40981aa79d60ad0fea1d4cf4f6f8bb35', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/orange.css', 'c3fd44e8ac57011440c6b144bcb2740e3b33fb34', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/flat/pink.css', '502ec3689bbaf037e8bfe50aca65c1995a8b7b68', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/all.css', '9569852a3acb017552ecb6484d7ab2a2392a6fb0', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/yellow.css', 'cc8d2e887d0e5041fe8521d19727817517611a80', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/square.css', '8577309cbc22cefdd849e42a3f040eeb556404fe', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/aero.css', '0c08397427256d2c029cb1d6166103805faa69fc', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/purple.css', 'fcef468e1dd97a24907ed65051c0050180ea6769', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/green.css', 'f52ae1d1d73be3205752e28a3e4177a53bfe8135', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/blue.css', 'e8e03734e64570ccc8972baef26e6ce3582331f5', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/red.css', 'cb97b3ec6ee07f663418bb099b957bb1b00508eb', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/grey.css', 'fad3794d949a6f5abce0443f5530780b725699a1', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/_all.css', '76805afa7f9c15946a9d85dd9fdb284c6b68e2f7', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/orange.css', '618a3242e48026e234ad46a96ec850f44655a63b', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/square/pink.css', 'f96e03cc6ce201e394aa143931f8ca38183b5f58', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/yellow.css', '6f90df8a59803f2023def2a137ce30acd692306d', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/aero.css', 'd2c6fd30e80bf8cc29aafdd5d6cc26ce6c734dbc', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/purple.css', 'd6bf1f76527b9a3ac2dcdc14637b0738211a0444', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/green.css', 'eb310c99eb43ff283105623aedb95b8b2a0d39e6', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/minimal.css', '27607853728332be41031e509a551c708e339054', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/blue.css', '097501e9534d6d151700bce0801c72fb4f3ba68a', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/red.css', '64d72d93b95dd9ffd8a905846f5e7b8dbe875d5b', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/grey.css', '168244eb9af94b889209140e419195944ff3930c', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/_all.css', '07ed7eb8a2b1ca662a7a3bab9d6aa5c0568dcc74', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/orange.css', '4ac5735d5bfae0136502f1ee565eb6e66274ace4', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/minimal/pink.css', '122ca4954c44e52eea8b50a6ee9898c2682efeff', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/polaris/polaris.css', '79c688d837bffe652027e2803c2c82167e6cc2d7', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/futurico/futurico.css', '093bdecd6e85b86ab07f80cb37b752d4c78c78f9', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/yellow.css', '04a7eb635a46fe3bc935959720babdbccab17d43', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/line.css', '5737be7042ea0c5763234dd2f7ee955b6181640d', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/aero.css', '2d71a420f96b7af3cd951f9df0a9ff44569b7aad', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/purple.css', '1af0b3128cfd159682933f866bcdef6a80eb8270', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/green.css', '5f51a158648fde9e99e4a9610344da00f9287b53', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/blue.css', '76f7d3051608b54fe7e887821b45c6db083f3047', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/red.css', '558a28f70c0de0f92e39ceec1b1ac3e87aa0f9de', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/grey.css', 'fc88dae0d3435815cfb0af817ef47f2dedf7f499', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/_all.css', '17a59de82806a9c38be27bc40747fc7295d9ef70', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/orange.css', 'fa55e838c8ca1307d8f226ecff43ac924f9194b0', 'Blu-Edition'),
('./assets/plugins/iCheck-master/skins/line/pink.css', '5e169a1942acc64cde2a89ad63828bc314ee85a0', 'Blu-Edition'),
('./assets/plugins/select2/select2.min.css', '5bece56a93a9da46180fbdb4adfcd1ca0c9ca285', 'Blu-Edition'),
('./assets/plugins/select2/select2.full.min.js', 'a4955ce00888b8b0ba3d4aae6819af5ec9d4ba37', 'Blu-Edition'),
('./assets/plugins/select2/i18n/da.js', '0bcbf55f4ed53c247680ac2f5b55f592b1cf8de5', 'Blu-Edition'),
('./assets/plugins/select2/i18n/hi.js', 'c334ae396ed445bf4e65654f052f326a462f407e', 'Blu-Edition'),
('./assets/plugins/select2/i18n/pl.js', 'a27617f77f894b26e94c927fba686bb387d4999f', 'Blu-Edition'),
('./assets/plugins/select2/i18n/lv.js', 'c854cb05aede15308ab7f7ed79a797f651512136', 'Blu-Edition'),
('./assets/plugins/select2/i18n/th.js', '147b76476fbc10707d4c799736ae7c5c9719be2f', 'Blu-Edition'),
('./assets/plugins/select2/i18n/fi.js', '0ea6e6d5a66f45267e62cf9b268af92cc4ab49db', 'Blu-Edition'),
('./assets/plugins/select2/i18n/mk.js', 'fa563ad77424ba63b5faf84ee11bb6a10d929a32', 'Blu-Edition'),
('./assets/plugins/select2/i18n/zh-TW.js', '6ba1988ac1f006e4f3b62b91f962f2377a48f7aa', 'Blu-Edition'),
('./assets/plugins/select2/i18n/ko.js', '3ae6b6a9cd5ee3a19699c93f8f4383aa9372d6eb', 'Blu-Edition'),
('./assets/plugins/select2/i18n/id.js', '6cf41014847f256e0a68350a2302f41b38ed057f', 'Blu-Edition'),
('./assets/plugins/select2/i18n/hr.js', 'f7c969fa017ecca2a0fc564d1b69c9bcc7d4eef0', 'Blu-Edition'),
('./assets/plugins/select2/i18n/en.js', '9f77e56efbbc804af157d6d09c7a03d61c82a130', 'Blu-Edition'),
('./assets/plugins/select2/i18n/es.js', '59268a2b0204d4f3c34145ba8b3368fe7094c19b', 'Blu-Edition'),
('./assets/plugins/select2/i18n/gl.js', '546870d0846ed1e6d15d11a8ade7bc2779727782', 'Blu-Edition'),
('./assets/plugins/select2/i18n/eu.js', '04ab5b84048aa0770f4c77d8342466345dc87137', 'Blu-Edition'),
('./assets/plugins/select2/i18n/ca.js', '09a427d4c7cb523ddbb5ec5f463f92ed568c1827', 'Blu-Edition'),
('./assets/plugins/select2/i18n/is.js', '74cb71b11dba21be7f6fcc04e445df280e4c6ddb', 'Blu-Edition'),
('./assets/plugins/select2/i18n/he.js', '1cdbfc4a4ef7fa4c72709928a54cc1668be0634b', 'Blu-Edition'),
('./assets/plugins/select2/i18n/nb.js', '2d1ac239670466a839839b22bb012e05013341a2', 'Blu-Edition'),
('./assets/plugins/select2/i18n/az.js', '6b0cbc2639dbcdf6ac8b139837cbb72bdc7c337e', 'Blu-Edition'),
('./assets/plugins/select2/i18n/it.js', '2491699d5e4c2769fab637eba85a88c7d1c1b738', 'Blu-Edition'),
('./assets/plugins/select2/i18n/tr.js', '9586639f54d0284f4ec2fc64720652cd304c59ac', 'Blu-Edition'),
('./assets/plugins/select2/i18n/sk.js', '166100ab69ed987161a3334d7df5676cb9df5982', 'Blu-Edition'),
('./assets/plugins/select2/i18n/et.js', '152d07fc642f9cb26fce9de3f33e255bfc30a09f', 'Blu-Edition'),
('./assets/plugins/select2/i18n/fr.js', '2409d021cac5558f96500b29faa8b76989abb7e7', 'Blu-Edition'),
('./assets/plugins/select2/i18n/pt.js', 'd5f8b0e4284206018937a5bbe8a6dbfb43e1cbc8', 'Blu-Edition'),
('./assets/plugins/select2/i18n/zh-CN.js', '70d5c84a8b071d6affc5570b074ca68dc88d1e28', 'Blu-Edition'),
('./assets/plugins/select2/i18n/bg.js', 'e50b804f8dd8a4605791e3865c330608383bc3f3', 'Blu-Edition'),
('./assets/plugins/select2/i18n/nl.js', 'f8267700cf1ddff1799dafcaab0ff0b7feaa9fd8', 'Blu-Edition'),
('./assets/plugins/select2/i18n/pt-BR.js', '02c362494bcffec77883b4acdf7fd287649adcbc', 'Blu-Edition'),
('./assets/plugins/select2/i18n/fa.js', '1bc722ceb5ca751a4c283b99531c8bcba665fd86', 'Blu-Edition'),
('./assets/plugins/select2/i18n/hu.js', '2b9800159d7ff55b8ab57b9a76398a1668b01a3f', 'Blu-Edition'),
('./assets/plugins/select2/i18n/ru.js', '68358bdbec455d13801e88301319ed4e5957b90f', 'Blu-Edition'),
('./assets/plugins/select2/i18n/de.js', '0155ed101d4ead4f73a3316116c2ef8ca45dee73', 'Blu-Edition'),
('./assets/plugins/select2/i18n/ro.js', '2ac78926b0b35597b65f4e0af1c8dc675b5f56b3', 'Blu-Edition'),
('./assets/plugins/select2/i18n/sv.js', 'a69f3bbd71b3e0794866e19a0ab2b42515ff4d32', 'Blu-Edition'),
('./assets/plugins/select2/i18n/vi.js', 'ee236e21fdc6e52da520df78cf83a91cba31828a', 'Blu-Edition'),
('./assets/plugins/select2/i18n/sr.js', '9130a96f76591bc19312b99265660e5749dbf743', 'Blu-Edition'),
('./assets/plugins/select2/i18n/lt.js', 'e69c85196d73d7f964054ecdd35d6f1cfa4eaeb2', 'Blu-Edition'),
('./assets/plugins/select2/i18n/cs.js', '89b0d9d9b6310510ba2dc9b74ebb99fdeee1648d', 'Blu-Edition'),
('./assets/plugins/select2/i18n/uk.js', '04deb12120b9e1c627516bf1225a52baca26eabc', 'Blu-Edition'),
('./assets/plugins/select2/select2.css', 'e96ecbaffa6ddf7d7cb28eee053f8ac8a516014e', 'Blu-Edition'),
('./assets/plugins/select2/select2.js', '7a072976e6f6405c83e2ed26e63ebd7114df2e44', 'Blu-Edition'),
('./assets/plugins/select2/select2.full.js', '28dfa6673ccd2dc2019617968a5536af1ebb0a37', 'Blu-Edition'),
('./assets/plugins/select2/select2.min.js', '154e2d61636b7b66e914f970c45dca0d965e2d4b', 'Blu-Edition'),
('./assets/plugins/fullcalendar/fullcalendar.js', '3bfefad59aadd03ec4907409727ffbd1008f8ac3', 'Blu-Edition'),
('./assets/plugins/fullcalendar/fullcalendar.min.js', '1ae4a50827c98492bf23f5dc6392a4f492c737ad', 'Blu-Edition'),
('./assets/plugins/fullcalendar/fullcalendar.css', 'f1bf1d1ec30f7f99a9d81beef6f5994a215d72c8', 'Blu-Edition'),
('./assets/plugins/fullcalendar/fullcalendar.print.css', 'b577d4828af068282b440ca6eff2a813fe488127', 'Blu-Edition'),
('./assets/plugins/fullcalendar/fullcalendar.min.css', '77d88a4dd6c873d31ff5967ebf490afa610fb921', 'Blu-Edition'),
('./assets/plugins/daterangepicker/moment.js', 'a699249676eb4903f241fac9b029dcc0a72834f4', 'Blu-Edition'),
('./assets/plugins/daterangepicker/daterangepicker-bs3.css', '182ba97e456fc6cf6fe02b859e97119c8cf6dea4', 'Blu-Edition'),
('./assets/plugins/daterangepicker/moment.min.js', '851e2df2acd5f0bc4ef10fcf2f50c17f7aa09c1f', 'Blu-Edition'),
('./assets/plugins/daterangepicker/daterangepicker.js', '68501db475784d818ea6a07ab26f002e29193e86', 'Blu-Edition'),
('./assets/plugins/input-mask/jquery.inputmask.extensions.js', 'abcf110c2ef15af2fada743cae4ad4494c4853d4', 'Blu-Edition'),
('./assets/plugins/input-mask/jquery.inputmask.regex.extensions.js', '40402e0680fba07e5bab41b1d91bbd20a8d9f425', 'Blu-Edition'),
('./assets/plugins/input-mask/jquery.inputmask.numeric.extensions.js', '029ce94b5b34e103d93b28eb8407fad9a61c4df5', 'Blu-Edition'),
('./assets/plugins/input-mask/jquery.inputmask.date.extensions.js', '2775b2c127bcf44f3de16273dfb76415a60d4337', 'Blu-Edition'),
('./assets/plugins/input-mask/jquery.inputmask.phone.extensions.js', '42c0a463dada660843637927ca2180cf096fd3a9', 'Blu-Edition'),
('./assets/plugins/input-mask/phone-codes/readme.txt', '02b3843967662841ab910aff73efaf985d977815', 'Blu-Edition'),
('./assets/plugins/input-mask/phone-codes/phone-codes.json', '4494adfed7a8dd38d85397406f84e8078299f253', 'Blu-Edition'),
('./assets/plugins/input-mask/phone-codes/phone-be.json', 'd5c20e75dfb117b83e28f495c95bbed773d3d808', 'Blu-Edition'),
('./assets/plugins/input-mask/jquery.inputmask.js', '30b0c50e10f499633f8f1a3c482bb500218c295d', 'Blu-Edition'),
('./assets/plugins/Nestable-master/css/nestable.css', '350da254daffa0e84219cc372823c9c97ab960b8', 'Blu-Edition'),
('./assets/plugins/Nestable-master/js/jquery.nestable.js', '1b8884f65f7d4d725767b65140cb103bbb1cd6dd', 'Blu-Edition'),
('./assets/plugins/jQuery/jQuery-2.1.4.min.js', '43dc554608df885a59ddeece1598c6ace434d747', 'Blu-Edition'),
('./assets/plugins/knob/jquery.knob.js', '34ca4279ce65d67b0aa132de67718988f2445130', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css', '122f43fb614d52d280cf8748af2ff47bd1f21fa3', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/css/jasny-bootstrap.css.map', '3445b5515ff32f43dcec1a31cb7a2f36fb68017f', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/css/jasny-bootstrap.css', '7429136b79981b8288c4fbcfa8f3936f92cc5b9a', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/js/fileinput.js', '7b887e127eb43f63c0f8056257bc88e423813983', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/js/jasny-bootstrap.js', '43939cf1095261aeaeb3f74b1899512a513170a6', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/js/offcanvas.js', '2fd1a68cbcdfe241a826b496e5155323474fe441', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js', '3b91927b66571cc006866078ab268e37259b3a79', 'Blu-Edition'),
('./assets/plugins/jasny-bootstrap/js/inputmask.js', '970ca28258334f63ff76986bdda565882caa7697', 'Blu-Edition'),
('./assets/plugins/colorpicker/bootstrap-colorpicker.min.js', 'edafb19f8ecb0ad9c33b28707dbdcf92b18fb9ba', 'Blu-Edition'),
('./assets/plugins/colorpicker/bootstrap-colorpicker.css', '0e00a80d8f02b62819ac14c2f95b469089e9392f', 'Blu-Edition'),
('./assets/plugins/colorpicker/bootstrap-colorpicker.min.css', '08871a1f00771f3622537940e5d3b61744eb6c9c', 'Blu-Edition'),
('./assets/plugins/colorpicker/bootstrap-colorpicker.js', 'f6972311554bcea759eee3a5a06791fe20211340', 'Blu-Edition'),
('./assets/plugins/bootstrap-multiselect-master/css/bootstrap-multiselect.css', '45d7f230d6a378b1f110abf810e2abd2f76e232d', 'Blu-Edition'),
('./assets/plugins/bootstrap-multiselect-master/css/prettify.css', 'daa3bd8f52d61e176064b897d13a372298d36c50', 'Blu-Edition'),
('./assets/plugins/bootstrap-multiselect-master/js/bootstrap-multiselect.js', '8c2a20fd1ed0e7101059e56c61b5ec2d79929faf', 'Blu-Edition'),
('./assets/plugins/bootstrap-multiselect-master/js/prettify.js', 'a4e5934397f97f79b8066984475c90af8a970a36', 'Blu-Edition'),
('./assets/plugins/slimScroll/jquery.slimscroll.js', '67d0a45015c77e0eadd2df45d09a656dce1bda8d', 'Blu-Edition'),
('./assets/plugins/slimScroll/jquery.slimscroll.min.js', 'c41ab928b9e7386545fb8228290d38d14f25c6c3', 'Blu-Edition'),
('./assets/plugins/jQueryUI/jquery-ui.js', '3efaf11e60ea8c541b6dc26f0ef09f195732587a', 'Blu-Edition'),
('./assets/plugins/jQueryUI/jquery-ui.min.js', '7f650ee30c6a4d3eea04032039b20ff72997559b', 'Blu-Edition'),
('./assets/plugins/cpuload/action.php', '60f7492b6650ec2bc37e19e5e2ca031147c473c3', 'Blu-Edition'),
('./assets/plugins/cpuload/plugin.info', 'd2960e52e4370cf138bd2f38e78b19cf21448de9', 'Blu-Edition'),
('./assets/plugins/cpuload/init.js', '6b6a3a35fd5c657df01f6f03ee14f4793eac4ac1', 'Blu-Edition'),
('./assets/plugins/cpuload/cpu.php', '90c309dca8b6688cf197bc4098f7c6b789ced033', 'Blu-Edition'),
('./assets/plugins/cpuload/conf.php', '0377430b0074901cb898f53126e830a7b5e0519d', 'Blu-Edition'),
('./assets/plugins/cpuload/cpuload.css', '3b27dbc4b44c97cb2b8855d688d241775e28d905', 'Blu-Edition'),
('./assets/plugins/chartjs/Chart.min.js', 'd1c451a96a4ac5942b33a763d64fb9c21076103e', 'Blu-Edition'),
('./assets/plugins/chartjs/Chart.js', '77abd01d36692aea497f93d163825db11fd54495', 'Blu-Edition'),
('./assets/plugins/bootstrap-colorpicker-master/css/bootstrap-colorpicker.css', '34a0c48960f1e6aa21c653895f9e1f3e7a622188', 'Blu-Edition'),
('./assets/plugins/bootstrap-colorpicker-master/css/bootstrap-colorpicker.min.css', '9b5ec223d43e4cae983ce46d63ecdb2201783279', 'Blu-Edition'),
('./assets/plugins/bootstrap-colorpicker-master/js/bootstrap-colorpicker.min.js', '8e1c4691e045cedf66fd831debd11eaed76df1d9', 'Blu-Edition'),
('./assets/plugins/bootstrap-colorpicker-master/js/bootstrap-colorpicker.js', '1a060bcdd8e4d63ce7360c601383926f3f797132', 'Blu-Edition'),
('./assets/plugins/alertify/css/alertify.bootstrap.css', '57f987aaa6eae70cd66778a484f561b500f17c0f', 'Blu-Edition'),
('./assets/plugins/alertify/css/alertify.core.css', '99bf1cf281ab370947ba877e6a6e29f559ae0852', 'Blu-Edition'),
('./assets/plugins/alertify/css/alertify.default.css', 'd3744b0ab3714aa1cf6ec5b8743c1911a6879617', 'Blu-Edition'),
('./assets/plugins/alertify/js/alertify.js', '886ff433e3d029dba873b9aba61663bfa27b4e23', 'Blu-Edition'),
('./assets/plugins/alertify/js/alertify.min.js', '4d6cb041cd12fc4e4e6dea44c9d6ae7bed49d783', 'Blu-Edition'),
('./assets/plugins/datatables/jquery.dataTables_themeroller.css', 'f7b4b315a4f6afe4244fd8a0a6148818266159a3', 'Blu-Edition'),
('./assets/plugins/datatables/dataTables.bootstrap.js', '154bad4eb3c006ff81dc75599b2da17781dd5a06', 'Blu-Edition'),
('./assets/plugins/datatables/jquery.dataTables.min.css', '2fbd0f211ed81abd8e4d3aeca8ff34559a1e459d', 'Blu-Edition'),
('./assets/plugins/datatables/dataTables.bootstrap.css', 'c6d28fbc668c253e86412e104dbfe76ec5c9e4e5', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/TableTools/Readme.md', '47c78771a3da28c3b32914a51b70ef931f90cda6', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/ColReorder/License.txt', '41633068f3d8543b7c81d4cbe54bb487f0975721', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/ColReorder/Readme.md', '5928e793afce2bb08318d3b09db05d28baeb6d07', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/Responsive/License.txt', '184d85a2d457a357e4af19f236823fcee986758a', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/Responsive/Readme.md', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/AutoFill/Readme.txt', 'd24a2c8ee90b0eedb69516474e281da26cd3f499', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/Scroller/Readme.txt', 'cefa8e4609a4ae88f05a93d8aa5150a91f591325', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/KeyTable/Readme.txt', '3b77f7cb1a2875337f0ae0a06e5bf9ffaf8c38da', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/FixedHeader/Readme.txt', 'd1a2a30c5526dc94770f7db70fd8cc5e5afc3dcf', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/FixedColumns/License.txt', '41633068f3d8543b7c81d4cbe54bb487f0975721', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/FixedColumns/Readme.md', 'e94b81b56c451cdc5e556fe876ad49aeda94acdb', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/ColVis/License.txt', '41633068f3d8543b7c81d4cbe54bb487f0975721', 'Blu-Edition'),
('./assets/plugins/datatables/extensions/ColVis/Readme.md', '6dd4bdd6d84b126e11ffb97f9ad1d981391e87a1', 'Blu-Edition'),
('./assets/plugins/datatables/jquery.dataTables.min.js', '416ef565967a30984e8f3688632db38ccacbab73', 'Blu-Edition'),
('./assets/plugins/datatables/jquery.dataTables.css', '23b3f12275d7a6df0c7682e3131f5e47d4981439', 'Blu-Edition'),
('./assets/plugins/datatables/jquery.dataTables.js', 'fd9c456abaab7659ce60599cc12fb8574d3d59f8', 'Blu-Edition'),
('./assets/plugins/datatables/dataTables.bootstrap.min.js', 'bd9605cccc6d77ee26c19e1dc4ab044ef178e731', 'Blu-Edition'),
('./images/userbar/digits.ini', '3f7d8af56b2609de5249724deac2b486d5e9f45a', 'Blu-Edition'),
('./images/smilies/index.php', '32ee218e1ea28cebad135a67b21a6ecc83bbe8ee', 'Blu-Edition'),
('./images/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./images/default_fanart.psd', 'd792222fdefc11dee4ea88c83bce0929aef38237', 'Blu-Edition'),
('./images/flag/index.htm', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./images/thetvdb/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./images/thetvdb/rating_images/index.php', 'e95eaedbb91104e407892a954f75ca9c02c2fbb0', 'Blu-Edition'),
('./paypal_secure.php', '356188928c3fb97e093455f8ad097af842925ec5', 'Blu-Edition'),
('./smf/Upload_SMF_Here.txt', '84126adb1df765e7533bf1eb56d70a6887fce74a', 'Blu-Edition'),
('./smf/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./lottery.php', '2039fb71a764e59e0fd496153900b5602e5bc3c3', 'Blu-Edition'),
('./bet_odds.php', '520aab487831bec30073a37ccdf1d72ad959403b', 'Blu-Edition'),
('./thanks.php', '0f7e3155bd5226707e89c60ef48302ca91e56452', 'Blu-Edition'),
('./rss_torrents.php', 'e95679e15dff491fdb8c28fcd5a0e23d3173a7c0', 'Blu-Edition'),
('./pz.php', '49ce0fe8d3c3b2eda07b5c0791089f465feb55eb', 'Blu-Edition'),
('./news.php', '4f82e51cdfb852995f6684e44a9a10aca9d123b5', 'Blu-Edition'),
('./login.php', '490339a9412b27c8c0a0ab5ccdf3106bda6ba724', 'Blu-Edition'),
('./torrentimg/index.php', '8079e4c4c9de0da1dc2c4c87a4596c68824e17f4', 'Blu-Edition'),
('./torrentimg/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./getimdb.php', '51cbf2f66a983be3ade0c2881b8bd691d1f3ba93', 'Blu-Edition'),
('./apply.php', '57c5e541d8efd26e9190d1b4181bb861d1d55bcf', 'Blu-Edition'),
('./refresh_peers.php', 'd3cc5c66d44fcd6609d7ca155966a3b724effc99', 'Blu-Edition'),
('./reencodeb.php', 'a43bf3f01685ed99c4db308fb235ce11e93289c8', 'Blu-Edition'),
('./lottery.winners.php', '7b00d9514eb8ea90fa9422e1b5a49c7332fab00f', 'Blu-Edition'),
('./watchdel.php', 'd2af61b99a69301cae38ffa63a1a4702c0883aa2', 'Blu-Edition'),
('./takedelreport.php', '0c0b909ef5854e4a6e7798b437dcf3999fc9a2bd', 'Blu-Edition'),
('./ipb_import.php', 'aee15a733c1ad36e037aee14ef6343dabe45fab1', 'Blu-Edition'),
('./teams-view.php', 'c9615b7296ff5316c77ba93b1a2b70ae32755d2e', 'Blu-Edition'),
('./nfo/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./nfo/nfogen.php', 'da8e904d79506d6962d58d30d63a58d70549cd0c', 'Blu-Edition'),
('./nfo/rep/5421d1aec30b4adbdd9f03f0059046e69c1d0b64.nfo', '15ff2e93d749ba2ce2960a77d509bca309aa53dd', 'Blu-Edition'),
('./nfo/rep/a2739fae3392ca7ff21ab91f780275dfe96a301c.nfo', 'f915dd49a5cc9ab8e17b8a01af5d361e9a635398', 'Blu-Edition'),
('./nfo/rep/021294a86d89690bb6dd6de2a42c0ec87b03d0f1.nfo', '04eb03645d9f45c8d972e3662d84927900474040', 'Blu-Edition'),
('./nfo/rep/be963209f78889b436f2740b5e7d944cbee29951.nfo', '551681d08f1eb36d15ebef72e9b28508f7b7b108', 'Blu-Edition'),
('./nfo/rep/7a5a7a80c3ad6742e4f00fe9aaa015778f359f17.nfo', '1cb2cfb022beda87d5458973772df3787a301cde', 'Blu-Edition'),
('./nfo/rep/49afd2dc6004630c7679edb3f6fed7763b63a15b.nfo', 'd231039c68cd621bd157417116f5426922734372', 'Blu-Edition'),
('./nfo/rep/37a3c3707fe4ccc38ab6f2e7e9f9e81dd014e298.nfo', 'dfb6409667b1a35910b3f80afc253f210737e9ea', 'Blu-Edition'),
('./nfo/rep/7d09d52fcc878c7e6e32906b0b3b0e024edbe032.nfo', 'b1b6224da633a0c7f829b170f4f6427de9f88c17', 'Blu-Edition'),
('./nfo/rep/e09f5ac550f760bc9f16bdd6f9a5e1dc3f4f777a.nfo', '9135b5be966efa44b66a62207f2c6fd227dd0ff2', 'Blu-Edition'),
('./nfo/rep/0742dede393bd0af349b5a47b173fe5e88c9cfd1.nfo', '5501526b1e053bceaaaa4bd4ff5d6f69a41ef50d', 'Blu-Edition'),
('./nfo/rep/6393adfcca9451fb3d25ae257cd82b2c3f43627c.nfo', '2c60377b4144251e6fab0f27aba09a35c28f0df8', 'Blu-Edition'),
('./nfo/rep/f19feb71326bf80bf8e3fa08c7af77a0d9ad6050.nfo', '7e4ebf10ed2df5364686ca06513806c870851e2c', 'Blu-Edition'),
('./nfo/rep/87ec921ada3c1e2c1ee475cc85838ff6b2bd68f2.nfo', '5e9f9f5a43ddbe8a3607a81418a776bacd6dde51', 'Blu-Edition'),
('./nfo/rep/d5787fbee4a684ab990ca04b1a76e4a9c511b58a.nfo', '2ff79b97fc158014944be33c7a5a777801184c06', 'Blu-Edition'),
('./nfo/rep/e03294442dd22442fb702fa5d89d8fb4b2a9070e.nfo', '0e50c796558e52b20e1eb4c91a9ece3e4476044e', 'Blu-Edition'),
('./nfo/rep/a8c6b3fda6e7188d6c8b300ead60ed3d6096d8e6.nfo', 'e3b305f3a2f8235f813663087ca0eea114865e50', 'Blu-Edition'),
('./nfo/rep/4fcd436cbbb459d9d879f3e847ccf87e55c1ceb3.nfo', 'af0f0f7ee53b262b153357284fbee6f0ae028544', 'Blu-Edition'),
('./nfo/rep/1a9885807937710744e7bd6e506bd31e3b6a82c8.nfo', '457400d16c9138665eb605622f01fba356da363f', 'Blu-Edition'),
('./nfo/rep/9b8d7738881ac0cff66da4ffefc43aa60daf4965.nfo', '06e4921dea414cbd64cfc38e6a5029ebbb471f99', 'Blu-Edition'),
('./nfo/rep/992cda36a57264515c9874be144a56f87a48810b.nfo', '778a783a10f8bcd28ca4e030324865a70b2c107c', 'Blu-Edition'),
('./nfo/rep/632fe4a6517678de9b03a64da563ab455e2c5f86.nfo', '7f8cbee76101fc9c3e57df97e3a3e1c16bbe13fc', 'Blu-Edition'),
('./nfo/rep/769612e7991e6960dbd7669936e89bce572a82a1.nfo', '6adfaff5bc76bb63edfde6ad2232f65e55dca91e', 'Blu-Edition'),
('./nfo/rep/9e5e7e552c214cac9b6923d24079d9828cb492bc.nfo', '34eb612cf99c7d6cdd104d146ab1d8497d791abe', 'Blu-Edition'),
('./nfo/rep/52ee8eb968c6b839bbc7ae33946b0393d459113d.nfo', 'c4d0246fb915d0826df28fb6a4993c4ba208727c', 'Blu-Edition'),
('./nfo/rep/ffe760e7df9ebd576d7abd72a6ef4fde724fdaba.nfo', '7698fb834f88fb0e48a7ece3e89365684cca21a5', 'Blu-Edition'),
('./nfo/rep/7ac55c9ce209f77b4c9093ae83a7100237b4f4bc.nfo', '55ae750f8925e61464a3c841cdcdbfa553dd2946', 'Blu-Edition'),
('./nfo/rep/c4ae26018ecb8270e9b19150f2c7a2010e78264e.nfo', '4d5c3d01f7d87f41515ec6ca49222345408d05ed', 'Blu-Edition'),
('./nfo/rep/6e9b22574ed6f0f9bcfd629747f0c7ec68e4e0db.nfo', '1fa6a83efe9b36bef0a0b29a8f0d09fd86b87af9', 'Blu-Edition'),
('./nfo/rep/57a2773d842f2b8e50e090edf4b68c9f10c71390.nfo', '9869bbcea746beab7e08acf8014d65679b6ddb1e', 'Blu-Edition'),
('./nfo/rep/db963f69253ec9a38089e34d62187996054bfc81.nfo', '5690716f96eb5fbea37f6afc029605089f753901', 'Blu-Edition'),
('./nfo/rep/402dccbbd53e23a03f8a799fab330ccbea04c70b.nfo', '3d8d0866fdb210b5ae3b6b519a798b3910548f66', 'Blu-Edition'),
('./nfo/rep/ad8aea866fc5ba36b72a5bde86cd6ce74b4416b3.nfo', 'ff62afb37213d46f50a1082bc44dcd1cf12c7ee7', 'Blu-Edition'),
('./nfo/rep/89e372d2a4a82f4bf524fba84647410884a1efa4.nfo', '5693b17bfcdcee8919eb5934eb3bfd3a75a280da', 'Blu-Edition'),
('./nfo/rep/73697aafa08eb2fe0d02f48cc385f98162f6a78e.nfo', 'f5132b271790b48e4c4949bf1231290b41666a0c', 'Blu-Edition'),
('./nfo/rep/e5da1e118a8dda20f0ba0236c60e7e4109c08c92.nfo', 'cca496e536c99d68348821cae0a3df1345f3694b', 'Blu-Edition'),
('./nfo/rep/882aa1eb8fbfe3b80c2336f4b9deab7337b0b533.nfo', '24a60e19abe51f4baae7d3e709aafcb28b8779e9', 'Blu-Edition'),
('./nfo/rep/513b956297e39270ce9a4cca8359800cf9d4ea99.nfo', '6949829748081c61b5d60faef41acbeac2f1c5f5', 'Blu-Edition'),
('./nfo/rep/43b1bbb0dde5d42ed719c5c7f170f79cdb2ea2fb.nfo', 'b056a890b7d38cb3943f1deef79fc73aa3a5e63f', 'Blu-Edition'),
('./nfo/rep/1bfef25330cc99f3fa3fe068db3012d60a4e9089.nfo', '10795938dda8b827c404750e0c54a42830f61dc0', 'Blu-Edition'),
('./nfo/rep/d1714ab05ceafb9e19b3dcd8d938814e10b2ba51.nfo', 'a18cb668bfb18547766b52c22d73825915804b1c', 'Blu-Edition'),
('./nfo/rep/3876dbd1b93bdbe482c0933b02480270d956c6f1.nfo', '088db772f6acd8d4eae2eeeb456b165bbe9d995c', 'Blu-Edition'),
('./nfo/rep/7075a6055ec78e0948b67c8810b5c273bf5819ce.nfo', '6cc2a71ac52408dad637defcac754829e08fcf5a', 'Blu-Edition'),
('./nfo/rep/23fef4fec3479e03100f7a9b14d04b399d95aa8f.nfo', '80ddb103b08b05e098ffd981c309700ce347deb0', 'Blu-Edition'),
('./nfo/rep/3f3113bb5586d212e27191c86f9fa8a2a1f0d587.nfo', '24adb42439bb6a1a384bea87aea0c575f8bbe2fa', 'Blu-Edition'),
('./nfo/rep/54af74a4835b826384aad252fb25e3e1531b5ef8.nfo', 'abc3e856dfbae87acf4edae1e1032517c8baa74b', 'Blu-Edition'),
('./nfo/rep/b6b5879083343495e04ef2346a2b6f65a37eaf51.nfo', 'b639b86f9ea12b8ebe29351e36afdf22ce94579d', 'Blu-Edition'),
('./nfo/rep/92fc63994ea70c8133a6e24d93df5b939a3b7827.nfo', '2eaf2848b34956ebaf408603f34c363c9e13fc4f', 'Blu-Edition'),
('./nfo/rep/f3cc44db66dc3c5530bd80ef7b5f5d35c3068a99.nfo', '9a3bc78b2d780f419ebf91ee30bf3673b64c2924', 'Blu-Edition'),
('./nfo/rep/b5e02df6a98be157c63f311ae3eded9e2ce4b8ee.nfo', '9a79659a762b06b0ff7f4cc156a56c0e07351104', 'Blu-Edition'),
('./nfo/rep/2ef5dc7094c1b6f3e1f0a18e2db7635d2de93239.nfo', 'c80dac6dd2b2fbfa01c82ece870613e18528131e', 'Blu-Edition'),
('./nfo/rep/1b8d9334a461cb32d5fcad940afdf55585e9c23d.nfo', '11bd878c4ca6f7cffbc801e7a9ae9287fd523bdc', 'Blu-Edition'),
('./nfo/rep/27e8572f86019acaf8dad52af605a693a5eccdc3.nfo', 'bc1190cac80286e30d8e964ffc973fd73389c929', 'Blu-Edition'),
('./nfo/rep/edac5118b0de4a8feee49295f6e514842abde781.nfo', '39f232ff10c76163c65a3e89b581f41dbd63c442', 'Blu-Edition'),
('./nfo/rep/a0fa562318ffad842ec5cead214f4807ee48df02.nfo', 'f8586eb3f5e1227abdf2d214a1497b2677e8c5fd', 'Blu-Edition'),
('./nfo/rep/39293debdf27f659ee9fdfbe2e7540b44b43d436.nfo', '829946c084d1b6138b8eca144a1c6fc4246be6f4', 'Blu-Edition'),
('./nfo/rep/6b087383bdfe93be10c7040a2fa88e4e7edff311.nfo', 'e0e84380e9180f17656e3fcf79f2bc4ce1aff73b', 'Blu-Edition'),
('./nfo/rep/f513408a75e1339af85e69221e8afea587ce3c7e.nfo', 'a50e84bd093c90bcd4e8f892bd500a87e4337738', 'Blu-Edition'),
('./nfo/rep/715d2f46cc0645da7b5f4c7942ac62b6f135d58e.nfo', '403a961f312130c32f2a37165e2aeb0572a44bcf', 'Blu-Edition'),
('./nfo/rep/8abc993a4c96e0ca9ef585788c51b34edd601a6a.nfo', 'f6798a20eba06aa3bb19a5f5dea5e4ed63e21044', 'Blu-Edition'),
('./nfo/rep/bad192f5c1b517e03eef8d57e956f53bab00478c.nfo', 'ea3d4e9e51b00f4b01c38a748711a3ac779e97d5', 'Blu-Edition'),
('./nfo/rep/9d581b8dfa548ad8c11f575dfc37697a33afac8c.nfo', 'df0a75c4501767de62c83cf79f00148ed6aed98e', 'Blu-Edition'),
('./nfo/rep/2c4ef9020b251bc18322427b76e2d3ac4ab850b9.nfo', 'a1599f919352193dbf5616d9aad36152f8ab80b0', 'Blu-Edition'),
('./nfo/rep/30a2bfe80f59b03c2c93a4268f6f785521ce3c79.nfo', '8cb0efb7f845aee1cd5fe65ea976f7295471bf6c', 'Blu-Edition'),
('./nfo/rep/8ba1b32f6951f2564568fe9abf0e94fe3a320b2a.nfo', 'a88d1b449094d7be097b22330053f9736666e6a8', 'Blu-Edition'),
('./nfo/rep/888bee4478cff4ea851faa4ebdce58ce14eb3c40.nfo', 'c2ecc07d6ce3d2e54b1d6ce99aca4e6457cc8655', 'Blu-Edition'),
('./nfo/rep/b40b5e9d55ce4428715c813089ef40a2270f58fb.nfo', '7a0de61e005dc1d03e241ba6bb4d4d69582c6db1', 'Blu-Edition'),
('./nfo/rep/96c95c6a33576a1b7c3757a8fa55c644151fb244.nfo', 'c660b3a1a2871029b7b036cdc1a31576289098ee', 'Blu-Edition'),
('./nfo/rep/ff8eeb22abe52358d70a65a7c31addf5180bf5ee.nfo', 'eb2e3ca168419d80e6910001fb025ba61966606b', 'Blu-Edition'),
('./nfo/rep/f5d1715361b3f8c14ec1e2ea5f2961e4b2dcd341.nfo', '81c4cea89ff47b694268a320b3a2982eabbe4106', 'Blu-Edition'),
('./nfo/rep/02f764ecf1e97b1d7ef537565fb1dd810110aa6b.nfo', '2cbb911fc7b807789bbee6f38e1f2fbcd524c4f0', 'Blu-Edition'),
('./nfo/rep/fccd8ad6a691daf1bff1e89dcd5a917c7ab0a7c9.nfo', '7892ef418467a387c76909cd7e6de7d75b8addc9', 'Blu-Edition'),
('./nfo/rep/9c33ae8c9d2d73c8dd82b961cb7f80816822d127.nfo', '7ab74e23c3e4d6b728ad56b5429d627788e3dbd5', 'Blu-Edition'),
('./nfo/rep/fdd637042321ef18a52a684ce40735a307b093cc.nfo', 'ee094689f9687d191357a672dbf496b98b6af7cd', 'Blu-Edition'),
('./nfo/rep/64e9ef03fb919811cd9d6543a096a073db6a0c20.nfo', 'b31977dc8a59a1ed2fdb7d74d3797d2cc788e121', 'Blu-Edition'),
('./nfo/rep/b46bbcf73f4032d16f02ac83e3ff12e0d2fd388d.nfo', 'b924c6c7287428819cdf2fc75b874f3a3cb377d7', 'Blu-Edition'),
('./nfo/rep/6679a4ecd594104c6473759fafd9823cc4c8083a.nfo', '1bf0881503497253dd92bf4a9204d95886d486fc', 'Blu-Edition'),
('./nfo/rep/660e3467a6d9ed008255b4c936f42d349592dedd.nfo', 'b03b21d30ca1ce3aba9d3d7e2985390a03835cf7', 'Blu-Edition'),
('./nfo/rep/4df2f8a08e15003b6570abe38903a4e16977ee26.nfo', 'd47c899c67b41e368f0cf915297f7b1602e017b7', 'Blu-Edition'),
('./nfo/rep/ffe51ea9584cfa903e2bc3f1fd2a860826c67621.nfo', '2e9fa6889d5dbbdde00720f1b4c46692be5e6d8b', 'Blu-Edition'),
('./nfo/rep/ad5a32d797225c67d88d8c61f03da5ec2b0a01b0.nfo', 'c332c18ee98afaff9849fb7a0b180a4177d6bc43', 'Blu-Edition'),
('./nfo/rep/acecfb85fb630ef8c4b6f247cb2bcc920068bbe5.nfo', '0ce6abeea91f7b695d020cbc83090336b0e7caf3', 'Blu-Edition'),
('./nfo/rep/678679f7bc1e8f24c6d0b614b9ea9679d06f00fc.nfo', '1575a9497f0ea345388eb5da279cfae770bf401c', 'Blu-Edition'),
('./nfo/rep/6fb85db6a0367871b971b93ef89e31fb3d98ed08.nfo', 'b41fc5190bba7c2f5987ab731701f680f91c6aeb', 'Blu-Edition'),
('./nfo/rep/9e4ac14d3134ffafcd672e69f5330ab7f2e1d061.nfo', 'b2962a995e662ee9fd31999b8b57ee271c25db06', 'Blu-Edition'),
('./nfo/rep/4ea32be37cfe727ed9e50fc3705ca2349fe16c9e.nfo', '7b12d9afab34dff5edaa1ee8896af0e0c4d57d5a', 'Blu-Edition'),
('./nfo/rep/eeff3deeb6207bb8a9783ad10836bbf685c51738.nfo', 'b3e4643b39c44ea8f26b4613d6336796b7e36048', 'Blu-Edition'),
('./nfo/rep/877bd04933d34854d8721d514a9622683dcd1fe2.nfo', 'd5ac39d0571a22f2da300c8bde2a677398b77ec2', 'Blu-Edition'),
('./nfo/rep/79ccf2de51c279049fb771b8319347f647ad3bf0.nfo', '4d7004651ec7fa5fbc685b79fb059cf9b52e154f', 'Blu-Edition'),
('./nfo/rep/ba26c4561e986d5bac808110f0e4f7799f63cc6d.nfo', 'e6fe0a56f091cae5052be9af407940e30b59e7c1', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./nfo/rep/7fcafbad81156d16547a6eba831a11fc014ce970.nfo', 'fada1a5cc6a59030ed1cbb674801b18b6edacee2', 'Blu-Edition'),
('./nfo/rep/19396921545390c97bd349c14142c6fb1cc3a89c.nfo', '8cdc1ecb6a901ce15152720d13d431465b8d6b75', 'Blu-Edition'),
('./nfo/rep/97ad27d43073cad5411951c4fc73565ab3898d0c.nfo', '9f6ca31b42ac4aa21cfdc6e2fda72b18931e2f40', 'Blu-Edition'),
('./nfo/rep/b8e1cfab7150ca1a8db6d04d84f865930203896d.nfo', 'b2b8f1a535fce2ba4badde2b5dc85a3b45b3b1db', 'Blu-Edition'),
('./nfo/rep/a60e49e48a80c9ecbcd52c65bfd2d00651e9008f.nfo', 'df9a3ab5463ef99e36d53bcb9712e61421a7693f', 'Blu-Edition'),
('./nfo/rep/d642051a521e9b21e5c74dd2d94324a93fc61e47.nfo', 'b10d0ad8d93da160d13b61a2fdd49b1d96e3dbca', 'Blu-Edition'),
('./nfo/rep/b3f42bb427c0bf0defea15839f79d62d1bb788dd.nfo', '56403b7475e4b12d7c8b1e73681ff9a8191fa5e0', 'Blu-Edition'),
('./nfo/rep/94c70b746ddeeb32779314a7ffa8335f9f60e5a3.nfo', '0240ec93697a2a832fc9f2ab07e87c28c4d4a9b6', 'Blu-Edition'),
('./nfo/rep/74ad017d098bb7d87848ca81ffe8e77d16c44d2d.nfo', '60214e2bb23f0aab3272029c47d22cfe2eddadc6', 'Blu-Edition'),
('./nfo/rep/a8913b2329f5ba184141c1f98bf1891409e4dcc4.nfo', '791385961f809b21a10cf19185f255241fa9212c', 'Blu-Edition'),
('./nfo/rep/e4e7eb3bfe82c3b9ef91518a536221f7d8573352.nfo', 'dcba51d8ec90410ab81d0510adb03551344c363f', 'Blu-Edition'),
('./nfo/rep/32114ba1ab36a806b32bebcf5bf0216e19d6cfdb.nfo', 'c57a6e695e28ca99554e3015270354ace33d96a1', 'Blu-Edition'),
('./nfo/rep/6b151cfb5be147d1cf2ac1cd116477b86bbcf1a7.nfo', '0f3e85958cf47d6ee56d3f9a04c2b484b6155b80', 'Blu-Edition'),
('./nfo/rep/5f35b81ea1bde20dd8a98363c37379033d64ae5a.nfo', 'ecfba25f7558c3fbd4e001c3d0ae218e54da2813', 'Blu-Edition'),
('./nfo/rep/44d27fdd4f6e35c88440f856d96c0f01c5a27499.nfo', '977333bd966dd91295db03a4d859a191c458aac9', 'Blu-Edition'),
('./nfo/rep/d192ad0c75771814785ee742d1ebe374a17f2683.nfo', '6467ee3d3249e49739574c48be5ad7c011ea17ce', 'Blu-Edition'),
('./nfo/rep/47f623e5f9663deb72258b6b1a1d8abbb5fa1379.nfo', '36cfab5768fbf93fc27f0a6cefef8eb1f7361765', 'Blu-Edition'),
('./nfo/rep/dc3d143ed1edc5190a2ce7fd6ced569ad5e41903.nfo', '8e904e0613fdfafe84ccc85aaf8b3b6a050bb976', 'Blu-Edition'),
('./nfo/rep/7d3bfff2eef20db1bb897555dcbf07b608525823.nfo', '6aaec85fe1a92e281f81040078a81eb9ad68b536', 'Blu-Edition'),
('./nfo/rep/72228e37b266ebc2b225c906423ec5b6cf01e23c.nfo', '48f8e33eb656e437759c622dba632ae79df1da92', 'Blu-Edition'),
('./nfo/rep/fa7fbc985ba64cf3476d430ab13ce206dcbb3d20.nfo', 'c2b6325294118a68c0ac4b97bae27f3d23bbccf8', 'Blu-Edition'),
('./nfo/rep/79bda87e9d3319e040e989eb948ad781b057bf86.nfo', 'f5a259f510830fb9506e01ad46e972126d5282b1', 'Blu-Edition'),
('./nfo/rep/90ec79b7288644577e001708dbb9786271d27cd6.nfo', 'cb7eedb60314a88f5620f5dff9acf1f7efb1f335', 'Blu-Edition'),
('./nfo/rep/960d79676c3e2ea51725b3bf9a1d2b6b5d081efb.nfo', 'c20ad3605e7cc6d7c0783c18ffe5634e23515006', 'Blu-Edition'),
('./nfo/rep/29e2b5622c4f5944d01ff9853b517e6852be50c6.nfo', 'bee8080e9b5da004e2f8f0edab329822e6242928', 'Blu-Edition'),
('./nfo/rep/83ea20171b84ea7488956402796860837997d70d.nfo', 'b5e32d41ced25ce72060dd3604c7f6fa688efdf7', 'Blu-Edition'),
('./nfo/rep/7ee01f3a0f9ba9fb31b908f5d4c146f3996e646d.nfo', 'd1fa58b5d9bf2c5f314bb08214bc35e02e88ee30', 'Blu-Edition'),
('./nfo/rep/9f17727bc75edd82d175012888af22fbe261ddb4.nfo', 'e84843fc04230551e9f2ea38d6e7723d596c1694', 'Blu-Edition'),
('./nfo/rep/1bd7b2363f0a89b1116109d91ee4e256d81185d5.nfo', 'cae46e5d254ec54ccf1d0fd95e47d63493d14d42', 'Blu-Edition'),
('./nfo/rep/ab6c2676a984022a3f2748101f31a8374950bb5e.nfo', '0ea34b438f30754b814d64ddebd813b6f654c3f0', 'Blu-Edition'),
('./nfo/rep/9bade8fa5499ac1739d348efa4415b41b20f9770.nfo', 'a5eeefd8970b55848969e304b0ed49fa89410476', 'Blu-Edition'),
('./nfo/rep/2611da216079cc6d05f8ad52ce5ae737573e2d1a.nfo', '838805f018bb7d74e4e503766ee5b40d96d108e5', 'Blu-Edition'),
('./nfo/rep/9827af15135ae8633c6d4b68e3317ad1bde8090f.nfo', '4beeb2d34320524c5ff3011125c638df9213f8ab', 'Blu-Edition'),
('./nfo/rep/110644c5c7439a6de9bd102e71013a8bb20b2f50.nfo', 'e25b07b2093bc9e3c102bbce54225e0c09dfc1d4', 'Blu-Edition'),
('./nfo/rep/23d984051568471bc3142f871fcdb93e6f887efb.nfo', '3bcbde82e02ce3ba0f39a7605d6b0143a40ae05a', 'Blu-Edition'),
('./nfo/rep/fce8afb845dc8dca5b5aa3eae1fc8fb3b6e7abb1.nfo', 'b0b8f950081c5393912b46d4e782f7419c422b79', 'Blu-Edition'),
('./nfo/rep/03bd2c97a1e1e5d46c27697c30f77397049cdf69.nfo', '4f6bc3fe5b3e5d687539a95b9653a787a92a53ce', 'Blu-Edition'),
('./nfo/rep/fe10ef5772adbff1271534ec0e30e49feb87c289.nfo', 'd022c8365353be0bb1f1000e4ceaa5e51733ba5a', 'Blu-Edition'),
('./nfo/rep/4fb5ec56c09a72b4f7a5e98d25f84b2f63b77fed.nfo', '02b1b03845a1b4539d2f74856f5a82289bacd005', 'Blu-Edition'),
('./nfo/rep/9a9a50d13312b5f7cf1196ae2c2c998d6a3afbc5.nfo', '25974d58c335a4b856250e2d8f2d76ac39c3d309', 'Blu-Edition'),
('./nfo/rep/5c9d0851a4385ef311128add38c066b11f22d5fb.nfo', '511574806af7b387345f58613a30d87d1be801f3', 'Blu-Edition'),
('./nfo/rep/a451845b12014e8ba77f10c81af327eb1d8d899d.nfo', 'b0d906a3ca301be1ed6a2ecb0cef0bc2a8eacc78', 'Blu-Edition'),
('./nfo/rep/3994ed2bb523cf0bd39ada80936f9dc67333203a.nfo', '1003d516a20faa009a56686c15d4e8b3bf240701', 'Blu-Edition'),
('./nfo/rep/74e2f56d612fc03b2eaf239c8173cac085c58d66.nfo', '650b26190c68da6fc1409260c2fe8d70efd7142e', 'Blu-Edition'),
('./nfo/rep/3f630c1668a71ff82d8a82ad42c1979b4de5f8c7.nfo', '811a044ce48f33b68dbcb74b80d58e5165917ed9', 'Blu-Edition'),
('./nfo/rep/d149c1e57062e630e92dd4e675e190118308ed32.nfo', '068656996958bed8cf02e698c7529f351213e3a1', 'Blu-Edition'),
('./nfo/rep/d3bc9ad3c89cc18d383b3b4c9353b7854e2ceeb3.nfo', 'a94fc3ac5302b0a51d32570d17385ad0b30382ad', 'Blu-Edition'),
('./nfo/rep/314fc8a17fadb9075a0b98fa539b91d58e15c099.nfo', 'a772ac3986a15fa97a3f358aaa4b778274faae1d', 'Blu-Edition'),
('./nfo/rep/989dfe4622e05e11f2a80eed5ccd0364f8d3bc64.nfo', '358a7b654abdbfb75c2d13acc2357fe5aa8935cf', 'Blu-Edition'),
('./nfo/rep/45c29e22d133f69fc9cae2b70c557df156ce1f35.nfo', '0e655fcdb1abc40101804e6be017796d24950ac0', 'Blu-Edition'),
('./nfo/rep/01d45b894b45cac752b022daabb1755056286192.nfo', 'e6ec20866cdc3d1fe1084f1948a18002f66aec2f', 'Blu-Edition'),
('./nfo/rep/d60045e9fbb6dd118f31fef4c9f89a55b1c54dd2.nfo', '2eb0d5ee741aaef33f5d3d9d2bef0542d40683a5', 'Blu-Edition'),
('./nfo/rep/6db645e212e5093a9fec1f27a310019cb9303efa.nfo', '56e600f3e22df38b6211f1ea530ed58717125e43', 'Blu-Edition'),
('./nfo/rep/f3efaf9d9aaf81798c95f4fffcf02f4436b859de.nfo', 'baa1e12b145e56cf1459d641aa8167929b96a104', 'Blu-Edition'),
('./nfo/rep/93a8ba7add4b9d518d08063ce6d0414f1964bc48.nfo', '7231df67650f7de688ced2381848100c5ab00d4f', 'Blu-Edition'),
('./nfo/rep/52aa1b08221c47e61ea04ceecae9968dc052f69d.nfo', '4996a1b6ba45700910d9ce163850ff3b2c76eeea', 'Blu-Edition'),
('./nfo/rep/31287eeae9e8f5bc57e8aef689b9ab17b97c53c1.nfo', '7dec478f4d97a6c39fdc36debff0e03465db1a25', 'Blu-Edition'),
('./nfo/rep/b2aeb51a7157017bdc09e0025299353b90b006e2.nfo', '73cd2b87d12d2f00e93fb325431256d9c7fb4eb1', 'Blu-Edition'),
('./nfo/rep/3492bcfe3a8356c7db2a4167cda2fbd39e3d7afb.nfo', '703534ad32e9142dfae06d0351340450b0a618ef', 'Blu-Edition'),
('./nfo/rep/618e383b9b19de22cbefce56ec086e7adc9f53e3.nfo', '04c767c9ed4ac8ebbfd4b2e0bfee8a25f3b42209', 'Blu-Edition'),
('./nfo/rep/853516bc20f64265fe9eee5b768cbea1222cc343.nfo', 'ffc7c118bf64c41a20581a1d8e571816e01b9285', 'Blu-Edition'),
('./nfo/rep/f471a1d719d6465a0ab3e9bdc7db5ee88e8eacb2.nfo', '2bdbd128894e95e214795750472a0e60b5d3f967', 'Blu-Edition'),
('./nfo/rep/b182aee1df235951edd0ebc652a087177bc8b17b.nfo', 'afd21bd5972b611bb47aac8a26581c268f63c3a6', 'Blu-Edition'),
('./nfo/rep/b941535ba7462a9046989628a5b31e881cd64384.nfo', '670775f3ee408ffe6826023296c5f131ae38e8fc', 'Blu-Edition'),
('./nfo/rep/9f241fb334d7b2819853857c07c454341afb837d.nfo', 'c2116897b7894f964694f33bffd5c95ac00f7a54', 'Blu-Edition'),
('./nfo/rep/7ba0e252d7641ddd7644ee7fb916b360f3e5950b.nfo', '2a2ff896ea41d1b5dd2d63d8c2257028d0fd392b', 'Blu-Edition'),
('./nfo/rep/be7dccd29f94ec5c92719599ec5df46452f91189.nfo', 'a6c1d99f3f3a64e51450e0b2df74492a262cfb52', 'Blu-Edition'),
('./nfo/rep/a16bd12c24f78fbc8441b5fca4fb8df75f44b88e.nfo', 'a68281b2185d66241453511f6ffaf3f821a69e95', 'Blu-Edition'),
('./nfo/rep/efb8949ff1344a8348589c22ea480669ac2b2f6a.nfo', '0ecf2d76368d95ade402264b7e850aa7235529c1', 'Blu-Edition'),
('./nfo/rep/5806a11535f4226b0b4ac8cb42fc3bd75d089992.nfo', '633a0fe9241278eebc94a5d22d04d2ef682e2126', 'Blu-Edition'),
('./nfo/rep/d782395c324ba67246b03658a4652b1035d8512b.nfo', 'f10176c5d894fcf7bbeb019b935a475d6d160b26', 'Blu-Edition'),
('./nfo/rep/66f52e738074905f6750109eda4e7f368b49a671.nfo', 'bd8e2f855992fdfc12b9e96cf30d149b528d94aa', 'Blu-Edition'),
('./nfo/rep/d7e0ef6de207e9cb20ed3c0e82cfe70a8b01a721.nfo', 'b7a98bbbc02743a2f2abbf6d162fa959bac68ef9', 'Blu-Edition'),
('./nfo/rep/52f67efcabe93b98638b26eaa55f5340bac19cb4.nfo', '20114a07550635935e5e03ce9c27c09d3052095f', 'Blu-Edition'),
('./nfo/rep/23b149ee472c1de1599e07749acafb7bb38af626.nfo', '9f9c3bcb503f34c46acf2a6689aeff06bdad22c0', 'Blu-Edition'),
('./nfo/rep/06f14cb385446e18f2fd14f724141a63afe67e23.nfo', '054c51c5aa12957a0db60475cc14d1ec4d03294e', 'Blu-Edition'),
('./nfo/rep/50ebf6328000976a9e52c6e31df0b3023fcb315d.nfo', '1a352ae673e53468bb468e0950f647a96d104f3f', 'Blu-Edition'),
('./nfo/rep/cd97f7dfce7e838afb6355c760c0949e168be9e4.nfo', '004ef00b7f661b93074c3d5d79489adad745a6a6', 'Blu-Edition'),
('./nfo/rep/3d27dda16a827c61644468e063de6d11b3543e5f.nfo', 'f8932f7991b98ad4e6209184e2e0069418fba47c', 'Blu-Edition'),
('./nfo/rep/8d4bdc0bbdae20e9936fef5f9a0b55c8994232a1.nfo', 'c9b7d8e67d997834555d43ada32c0ceb281272e9', 'Blu-Edition'),
('./nfo/rep/9354b1bad71700c6ecfa762a5d9feac59bcda43e.nfo', '66fc37664a4cdc0dd305405d4cef7aa3e5981a33', 'Blu-Edition'),
('./nfo/rep/698c72f7aa4c56fd483f4945fcfaf04751ebe876.nfo', '57513e20fc02b8c8263d73003ac54eaf85673dd8', 'Blu-Edition'),
('./nfo/rep/9243faf1c8ffec92a88a911ba9996a10627b479a.nfo', '18a87018074afa72c83985a4acf784870d9fcab3', 'Blu-Edition'),
('./nfo/rep/57e65b1c83c0dae21ccda5057d44b6b3217fe694.nfo', 'ca163ebe418b6994ae5a39f021f19deea147aff9', 'Blu-Edition'),
('./nfo/rep/5cac8ef4c70d8db681f6ba650cd91744fd11b4e3.nfo', '7a03b07f5ef19476c74d2fbd16a25c195876408b', 'Blu-Edition'),
('./nfo/rep/67aae474c81fe8096388affc321b94855413b5de.nfo', 'a67903d40cc9005400c40e97b9fde163d52eb3ef', 'Blu-Edition'),
('./nfo/rep/f51baf52f195bf8184790aa3233bc546df7a4471.nfo', '8332ec67041c8e93fc58faa89d60466592b30c6e', 'Blu-Edition'),
('./nfo/rep/c7ed0edb5026c61f729ed8605d1e8bd224c636ed.nfo', 'd28452698d64d0319586c3dff9156374f80dc4a4', 'Blu-Edition'),
('./nfo/rep/9e04bd32d6005426ac0cc19fb4c80f145631ead8.nfo', 'a883f907ca4537308a4d504521dce0fff9bacf76', 'Blu-Edition'),
('./nfo/rep/44127ab50822f7bb507a82454f570aaf2377ed8d.nfo', 'c62ab854d33334629d0826a583a43f86074df378', 'Blu-Edition'),
('./nfo/rep/906a9aadb9c71ed1c887ba9985a73471f32926a5.nfo', '2b54c7df405fb22db97d67fa0c178afe2e2fab1b', 'Blu-Edition'),
('./nfo/rep/1e4310ddee27a5479308d4b8741dbf81cc692405.nfo', 'b10be83e3dbb1a3dc611c0a06d2d4b0e30fdd3af', 'Blu-Edition'),
('./nfo/rep/a47897dc7c910afc1aa479c4bd57ffc70549198c.nfo', 'a96d65df8002534c54a37dc33feb0802ce83c10c', 'Blu-Edition'),
('./nfo/rep/5f0ccfbe61ed306300382312bb768be1449fea92.nfo', 'f8715b9cfbcd89a4513c77e0546285771a9035af', 'Blu-Edition'),
('./nfo/rep/faff8f4137c92eac8606548296c22f3d6bcce4f0.nfo', '3d94634a48dfe705da260bb77b9f74aa156e5708', 'Blu-Edition'),
('./nfo/rep/0c8b5fb913189efc32f7d0f452bf46e57fdab3e5.nfo', '8adf4becea0eeb3b2da0ad4b4819ff5adc7010f4', 'Blu-Edition'),
('./nfo/rep/e47a8331af7b1012fba0ab6cb7e34068928fd1ff.nfo', '6c36305ef012d8291b2c3099067727a8674a25c3', 'Blu-Edition'),
('./nfo/rep/750e417ec5a016e98f62e09d16c1ebb0eca023f7.nfo', '138b8637b48ef75943c5e09a81642845a65cbe0b', 'Blu-Edition'),
('./nfo/rep/9f9161b514089f940f282f0b214030896439a5c5.nfo', 'f2140ec72cccb47b164e875f3ed3e94cfaec4703', 'Blu-Edition'),
('./nfo/rep/db0934024d19b33ad6a3208e7046002cce1f1dc5.nfo', '6c860aea080f796b05931601821838dcb0ccb510', 'Blu-Edition'),
('./nfo/rep/b027d50ce60dcff3e8f9b1a79689f9f7fbce6430.nfo', '96e92fb643a914e4191188b4430d9dca636300a2', 'Blu-Edition'),
('./nfo/rep/6bbf17311b14f3ea3de2d90ba5052d6e9e2bf653.nfo', '41703ee7e92c47572e2f4c06c11e31e14d2e0422', 'Blu-Edition'),
('./nfo/rep/47bf6142a68fea858a80f4585d66762a52eead64.nfo', '9db01c5058d855caf72f0016328887f1a52167d3', 'Blu-Edition'),
('./nfo/rep/881367cfdcd44ae835ea7ab4a82e929b4d550453.nfo', '1582b98cb6d44085ae170465e0028241b45d07e8', 'Blu-Edition'),
('./nfo/rep/2d65653c5c5b9d756f56139e562a8659ccdb482b.nfo', '3e98c270e88cea1b43e2b98110e48e71037507df', 'Blu-Edition'),
('./nfo/rep/6b465275bbb194a56606aeaff077ca0e137dcaa2.nfo', 'cee724cbe9a25afcf655466399eb11441e953706', 'Blu-Edition'),
('./nfo/rep/ab793fdf2616921deec0e6bf632c53bb102b2e59.nfo', '9535d5401cfcef3bbb769cbc2f7bc68c3de8c4b1', 'Blu-Edition'),
('./nfo/rep/ddb1ca7580987979bb10ba2c9f5b050aa0ef460c.nfo', 'b4f82d35c04d62582d9a56c65a1e1e7e13ceaf17', 'Blu-Edition'),
('./nfo/rep/dc5548e1f13c2b1ed1975c53feaad2a420783d04.nfo', 'eecf8f68c779e9f8dbaa484dd1f34aa2711d2435', 'Blu-Edition'),
('./nfo/rep/cffb7443b7ca50d3589831591e8a05eb172a1e2a.nfo', '30c80392f703c7a77383b2c71b7e0d2b0f5ac0b1', 'Blu-Edition'),
('./nfo/rep/0655596205d944ee2e11b82d06770efd495b7859.nfo', 'f21756b88afa70b4595eca853949e335bb12fc4e', 'Blu-Edition'),
('./nfo/rep/cc831b1b4837697f3eea225e21c8c6a0d8185d2a.nfo', 'f12f5c18ea1661b8696de30520332c0ef610a80e', 'Blu-Edition'),
('./nfo/rep/1bf6688ba7dc443d57d09adc65503ae95eef72af.nfo', '49f27da3e6bcf210e735421fdcf39f6f7350b3ee', 'Blu-Edition'),
('./nfo/rep/0dc6d846087bf7b53d88c28fe4d76d1efa10e098.nfo', '0c2495c6ad0670f8b459d6fd99417360d6b23e82', 'Blu-Edition'),
('./nfo/rep/ac802587f6e2229eb8583dbd8879b1fdf4d3eb2b.nfo', '62cb92f99b509a95f0f1ee4505e12958d945115a', 'Blu-Edition'),
('./nfo/rep/6b024fd92fabbceabac33acb2592114323b944be.nfo', 'f8b8f114e586561c634de39bfd0f0851ba07d6e1', 'Blu-Edition'),
('./nfo/rep/adc23c45c0fae8dec7de63ff7bc6edce36da62be.nfo', 'bda5ac973aa20c9b1c93ed5c805bfbe16e2d819d', 'Blu-Edition'),
('./nfo/rep/58c4b8dc7ea6827e816167e7c6ef69dc84d87159.nfo', 'bb00a6132358fdebab03a63bef84f9a1ffdf11c8', 'Blu-Edition'),
('./nfo/rep/c529dcd48a19e5f7a06bf62cae20f190dc196de6.nfo', '0a2ef1510b4c0ff5f66bdad4685d3bcb7e49f798', 'Blu-Edition'),
('./nfo/rep/94f6a4ceb5caee895c4a2857230e2cedc56a49a7.nfo', '39dee360115f5c2d969f38a4fefe413241b72456', 'Blu-Edition'),
('./nfo/rep/d044b6e19f65b0ab87948d6eaa743caf158cfe65.nfo', '2712d1186f169485c71fbb47808152174ab9ad97', 'Blu-Edition'),
('./nfo/rep/f0e059da0fdc3cfeb226b812fc6b67665aef68b8.nfo', '4a05dbe572c3aea977a2c73cbce27bf9f0afc96c', 'Blu-Edition'),
('./nfo/rep/89096c73874b1cc86e0bb5bc4f6c070dc2b5b6fe.nfo', '9d0b9bbaeb3228d015e86ff87b955dfb79591167', 'Blu-Edition'),
('./nfo/rep/47e4323a8c97c9c7fb84c4287195a8a57891c973.nfo', 'c9a0b20aa0a1cd9360aecaf5886e381e7d84f294', 'Blu-Edition'),
('./nfo/rep/0408f2c88dbd44a30c5f9811440d4720db7bea0f.nfo', 'fa7882136926d4f31c809c0e14283818e4d40ec2', 'Blu-Edition'),
('./nfo/rep/14ca7ee8fe40afc7704ae9c43ab29addcb24417e.nfo', '594eb2d3e75c59684b9d164f89402168f81edc0b', 'Blu-Edition'),
('./nfo/rep/290ef2278a805a3a2eff9d7aa5f7ea9d0fbf6b13.nfo', 'cecad291a9737888ba38ae96491d450fa6330428', 'Blu-Edition'),
('./nfo/rep/4fb1d02c100f8ac682a988c6b4a968f8be78a11f.nfo', '89128b32d25d9ff2e915b5db046a403c401b4eee', 'Blu-Edition'),
('./nfo/rep/c6adbfa221a0476820d3784a86fba3e951d6f200.nfo', 'a37e1063471d9b6df638840b0a027e249a4e4a2a', 'Blu-Edition'),
('./nfo/rep/816ae941866906d58e689c0589e36b2cea22c16a.nfo', 'b3839650bab0203bc6fbbec01221933c6967e50d', 'Blu-Edition'),
('./nfo/rep/af35cb30ef563e0fed0353f9231af274999486d4.nfo', 'b895a85344d3b7c54e14265a28eea4148168f736', 'Blu-Edition'),
('./nfo/rep/4698d5e64f4eec3eb4bc902d0b2895fddad03910.nfo', '566739a8e00ac07a60b0353c06d2d398b80a3c51', 'Blu-Edition'),
('./nfo/rep/dfdfc95e6580f89f08704990c854c0f0824bd83e.nfo', '4e972b6dee5fd8214811443c8691e9bc2912f5b0', 'Blu-Edition'),
('./nfo/rep/4616128fc13a449605004bdd7acf2984e49125a3.nfo', '44725ca6412158dfa7338a4df166f71bba7fca9d', 'Blu-Edition'),
('./nfo/rep/1f174fff41a1fdd6ae5a57a5f59cb72ab369cb05.nfo', 'b89a8a362957d99f81b921f49fe1abd65f73fe8f', 'Blu-Edition'),
('./nfo/rep/2fe3609acb8bd4f90c0032412040333f6f451516.nfo', '2b7956ae34b4458a191c36202167894871f45087', 'Blu-Edition'),
('./nfo/rep/a47e844ef01f7dd6215a561563c12ca5b05eb8ca.nfo', '47cb8229488fb9ee993690f8b3698b30f9d9d778', 'Blu-Edition'),
('./nfo/rep/5dd11f2a99ce7455c95a7f37200ecbd4db167f1f.nfo', 'd3d21f677407f0b7577d66a11760b9728ba41394', 'Blu-Edition'),
('./nfo/rep/b423f3c22d5c2eb0b8af3c8bd7a7dd4d682689a0.nfo', 'dc03b5f76fa30afaefe05212be8b43bf7a95a180', 'Blu-Edition'),
('./nfo/rep/73f929b93495ecc535f82b45859fee09e2ddcaa5.nfo', '1b0962f8924c4b0b1c4cf05d5a020e05b0fa0726', 'Blu-Edition'),
('./nfo/rep/41e8ddb3b647ad3960cee40f0bcaaba1f0e601c9.nfo', '6af13f1232cf1dfe4d281ca87a41e1cbe126586c', 'Blu-Edition'),
('./nfo/rep/d08c7130ffb7654caaaa57782685720cf678e82f.nfo', '86f24901c333f367a379cae034c1eae41bfc0a85', 'Blu-Edition'),
('./nfo/rep/c7386ba3189c2e00fbbab57fff11e570d88a0dc7.nfo', '5a31ef5f1e071208c7534353b69c5c0c021ca2f7', 'Blu-Edition'),
('./nfo/rep/4ddfc80b417a3c739005cab7636d7db03dbf32f2.nfo', '1a3d0a19ee990580b5b6408afebdef47583b99c0', 'Blu-Edition'),
('./nfo/rep/d13b15ee6d92b7d76788f20a8b9660126473aad1.nfo', '81261cb7bc81f55099ffc91b2c785312a96f9f58', 'Blu-Edition'),
('./nfo/rep/e16a88ff4c80a1b57470d66c6548720ea1843a70.nfo', '3d2997f5b0c8632668358bfc27492d21b30ea09a', 'Blu-Edition'),
('./nfo/rep/1a4dc143cbddc687b7d61b5adec64b7ae5db91e5.nfo', '8e224ebd94976b469ab0a812d07bc2f93a7c497a', 'Blu-Edition'),
('./nfo/rep/3836f345158922a8925e97d79e06a76c2ac47f92.nfo', '72a98f53a6eea17ec6869fee3886e83d83c30b3f', 'Blu-Edition'),
('./nfo/rep/2fa526d6ff3b2d6312e0feb0e0993ec6b9fbf44c.nfo', '7e5a67b39f5ae69af9d849eb44e80b327b374d43', 'Blu-Edition'),
('./nfo/rep/7e5a6573d407d7f0735dbf051431b32b4e641e79.nfo', 'aa58c83188b1519160a575819e491ae63f5ff6a7', 'Blu-Edition'),
('./nfo/rep/30e551c6214339c42a4c219620c4a7ee167ad7c5.nfo', '41e0402b5ac1f54739655acc110fea0b78b4c0e3', 'Blu-Edition'),
('./nfo/rep/1121a6cd8a3b44c72fecb8dc331d4c1cf327d9a7.nfo', 'c3f409be42b94f054d1f22fa06151774558f8ceb', 'Blu-Edition'),
('./nfo/rep/e93c49dcb2b30c978d2ec1d3153ac5c098abf4ac.nfo', '3fb13e89806a01f23b45433d22e46219529a3e41', 'Blu-Edition'),
('./nfo/rep/3d826e01c8fa4a0567f9221b6bc7c5010f0e9f28.nfo', '64466e609d3b3d8e77f107224b9af9fe58deff2a', 'Blu-Edition'),
('./nfo/rep/1e5ef62bd087f7c1226ea66df0642b5a18ec8deb.nfo', 'd3768229c88ec61b8fd6bc3502ba6c0ce0b2a890', 'Blu-Edition'),
('./nfo/rep/1e3e7db832d6da6b52283e13e6459ebe80ee7149.nfo', 'ee36971a78980f12b42e135dd77a71be45b63570', 'Blu-Edition'),
('./nfo/rep/b347d02d8d54c05ff118299c2aee71b733dfcf1a.nfo', 'c50345dc14fc9ca4415c263e963a22a6fdbc0f9a', 'Blu-Edition'),
('./nfo/rep/119fe88309bb656b1cdd7542a8d7af9fb2196239.nfo', '23821304a0887827ebdd08a05c8d55afc5f97bbf', 'Blu-Edition'),
('./nfo/rep/973d66b0178a7ff569ffaefade5bc846a544332e.nfo', '5be7843e3e925958e8c0b1aae9a3fd2618d28bd8', 'Blu-Edition'),
('./nfo/rep/4c2aab3cec76ad2aeb73ea956092c2bc7082f29c.nfo', '45e8d3afbfb4d95791137855d5cc9e89d91a4118', 'Blu-Edition'),
('./nfo/rep/bff27d61fd204084d5ffd97840813390472dbc2a.nfo', '70db55d3928cf67fe189e9760b68d905cde7df85', 'Blu-Edition'),
('./nfo/rep/5295094a301c134557c5f042f3bfdc7df15207de.nfo', 'bda2f72bb2dde17ce993c37cf3da60f2e7cb2acc', 'Blu-Edition'),
('./nfo/rep/296fff0abc7022ac2b77787258374d7d4584a5c4.nfo', 'a90998c0092f0cea76aa475db8dce9e9f2f6a7de', 'Blu-Edition'),
('./nfo/rep/02ff227ea273e1085aa320fa3cf64ec8f4887b52.nfo', 'aae82d72aa760e1b656c51777eafac66cf54c4b8', 'Blu-Edition'),
('./nfo/rep/4b04df999633a914f85bde3e418ea609c6293e4e.nfo', 'db746a6b926be836fd0437f67c8a98ebf62c8817', 'Blu-Edition'),
('./nfo/rep/0522b4bc8af4a0dc904e61406579f0929cfce406.nfo', '0b2e582186f730d7c0e6ba7aa36d8af17502d371', 'Blu-Edition'),
('./nfo/rep/305b1d28a5079b40bc2117e546b625a61722ff31.nfo', '483c7ae13e13c71234eaf07ecdf5fa43c598134c', 'Blu-Edition'),
('./nfo/rep/faee88e56db400b9b59ae971e1d211a01db71868.nfo', '71f9f4269f22668e1d4ea52f19b4c66fc484dcbb', 'Blu-Edition'),
('./nfo/rep/1b313e7109996acea22a5f13d125ef749d488530.nfo', '4c04eec574d84d1938b11e989e27d5a05bef4632', 'Blu-Edition'),
('./nfo/rep/6c99649715b37fc6a93e85c46198f59e28c57c2f.nfo', 'f82bf1eff23da28753e4c139aecb8bdad124a796', 'Blu-Edition'),
('./nfo/rep/42c274a45cbabccf5a66a6f517a3aa98648ef69e.nfo', '733fd1a6a8ad8c238f14cab477992a5c5ddb9719', 'Blu-Edition'),
('./nfo/rep/d47668a04d3c61156c3728c0dabbb8aeb9f8f3f5.nfo', '17b0711a8fe11652ad1773e461c55c577b4e0d79', 'Blu-Edition'),
('./nfo/rep/6ddc1cb9ff2e9063151a01be2e255467a22cbda3.nfo', 'ca9bdcf64a1aed671e1a99eb417041a81bb09ba7', 'Blu-Edition'),
('./nfo/rep/f67af0ee3911600115d32149cc0932c79e3d9d0e.nfo', 'b0db5110dd5a847a486df383be2095b897eb05a4', 'Blu-Edition'),
('./nfo/rep/20a9fb642e93290cfc25a8e768d04ad282ef3e63.nfo', '1f87283c5ae25d79a5030886368d92fcb12d2805', 'Blu-Edition'),
('./nfo/rep/e16d3d1090a111c326a4fec81abeae40896b1c05.nfo', 'a5dad55145bfa2ded1060de8938516af81174a83', 'Blu-Edition'),
('./nfo/rep/62e9256e382e3c0d050ef1e85935ddf092a01840.nfo', '0a750db2cdd9356b27b410b1521cced37abaac8d', 'Blu-Edition'),
('./nfo/rep/8c1ab87f183f58e19382679a1837bd6a48a4a43f.nfo', '16da879082e3395c35be07157d4f66db8e895e92', 'Blu-Edition'),
('./nfo/rep/5da5e13469c84f0ac337fd3a6ea44ece7d6e8cc0.nfo', 'ff0c1c5ad5c28a6f6ca3a9f5b06018105d763f55', 'Blu-Edition'),
('./nfo/rep/4d88086b3a22630c7c6b890ca4fb51a21a6bbc65.nfo', '7da063a685dc4b1f46ef368d9d47a1eeb3ab9810', 'Blu-Edition'),
('./nfo/rep/bc09a7d10c9be5befe2ab2a339f3dcc20f5e03f8.nfo', 'cf147fa81e67f98ff89515f15ac21f7502b0428b', 'Blu-Edition'),
('./nfo/rep/71f4e3d85318dd4f1b0633d67e1a977b0bea7d41.nfo', '0519fc7a092672f85df1948d8f5bf0089073e3ca', 'Blu-Edition'),
('./nfo/rep/0f6f830bf198b9207a95a06405fcff751f71c2d4.nfo', '9fc6f4c8f88e5ab4b649cdece75aa7f9bcc997fa', 'Blu-Edition'),
('./nfo/rep/312fe85b0e226f2fa87671d02a3199d29e7fdd67.nfo', 'ad0d9978f73b7a3eeb2aeea20ced468c95280cf2', 'Blu-Edition'),
('./nfo/rep/5f59416a5cc2ad4c0c3970c7a3e1d80bac86cf54.nfo', '8d8ae0bf86d5c934194a4d51e897306c5baf5fc9', 'Blu-Edition'),
('./nfo/rep/be317e411d33fb80614277059271f55900319bd3.nfo', '7d3d8392108533fcf187aef206e847c45e5e3edf', 'Blu-Edition'),
('./nfo/rep/f25252867f24540017a3e40efb76da68dcdde93d.nfo', 'efb066d40954cd4d16320c9c4b76991f7475d87d', 'Blu-Edition'),
('./nfo/rep/6b5d0ef0ca13db8fa21debf86ec776451af3356c.nfo', '8bf39e5eda67a70e3bea071b11dfc85db0be3e07', 'Blu-Edition'),
('./nfo/rep/4daee39e9d170bb5fdd4ccbe66b7e5839eefef2a.nfo', 'ba60c9716db9168a91848bf3003a999f434c1a89', 'Blu-Edition'),
('./nfo/rep/6c214dfa1d478b196ffedfe9ca691c6751c928fe.nfo', '6a22550a07fe061d6c231185f424ea01729f59ac', 'Blu-Edition'),
('./nfo/rep/860ba3bb1152a1ba7895aad952a7726703e443d0.nfo', '9136fc79f152ea41d6d854882a21a3ed97ed803b', 'Blu-Edition'),
('./nfo/rep/5e1727bb0c59e1b25dd230dd69951cdf1037dcd0.nfo', '154bc64e7bc9cbc16625f600f29b913550536604', 'Blu-Edition'),
('./nfo/rep/9ff67c23d17418307a6c8ef9b479d1e5c969e056.nfo', '6d1cdd5096369b204b1ffb80ff06459e063b15c0', 'Blu-Edition'),
('./nfo/rep/b821ea16d2315a5bcc21f176ff86190d853b12b3.nfo', '350b5162f332963330d68f1ae848a79b6312d5ec', 'Blu-Edition'),
('./nfo/rep/8ca1d41b6e00aa2f76af06df6828448f1431b601.nfo', '182f9244851d419643f5ea35595db9d69c30e204', 'Blu-Edition'),
('./nfo/rep/f3909f031c6adfa3679578c497ecada3005db53b.nfo', '8fece7d04977f5d08751ab82c263651fe4568415', 'Blu-Edition'),
('./nfo/rep/3f640f489516bbe8f658354864287f5a92fe12f6.nfo', 'eeb5c97a26fe2cf9ae023ce83810129123782b78', 'Blu-Edition'),
('./nfo/rep/8753bf8264ea34b5f0678419a8730ee114967c81.nfo', '132d09f9dea429c96ab742b732511aeb25223441', 'Blu-Edition'),
('./nfo/rep/3c154ea3e83b6aae5b3dd7279b0f015fb9f0f47d.nfo', '10078c37070975ab610821dac183e138e8e8b57d', 'Blu-Edition'),
('./nfo/rep/2e2b6951612d22fca2e981bbf23d23130b4eb5f0.nfo', '234a2b3dc495457ffb3cf2c6dbccba61c9901a64', 'Blu-Edition'),
('./nfo/rep/836a22acc44db4f59fdaf458104b22fdcc82ea8f.nfo', '86924cd8745af69128623c7d8cd8e6a32ba6d98a', 'Blu-Edition'),
('./nfo/rep/4ce4f9728b7d8e0f983806652a4339a5246c6a35.nfo', '6c3f9f25762af2023c79c13aa3c779d72e2018a5', 'Blu-Edition'),
('./nfo/rep/25191aa30b561f60dce233c46e4d7ac28e90bf7f.nfo', 'c0c4daddb964fdab32d4bd460c5fe1ed0bc9fb3a', 'Blu-Edition'),
('./nfo/rep/61eb6c0c55a379c5ec141e5d027ca9bdc24e9959.nfo', 'e05928724d7e00ad0d7fec731a9ba50ece39c6ca', 'Blu-Edition'),
('./nfo/rep/236f181bc7901783563bbfc884dbe09dc1dac5f0.nfo', '10d7c49f1c96215aca0d7e28fcc3cc3924bd2c61', 'Blu-Edition'),
('./nfo/rep/70c0be6a0a7c35cd0997fc1735a47e6f60ea7268.nfo', '99d3aff13e3326f78b0c20eaabb27e455177cd71', 'Blu-Edition'),
('./nfo/rep/b4840b0ca182d905c51d4224adfa259177928901.nfo', 'da5fe76112f4cc2e1d0acaa1109978b0336dd20e', 'Blu-Edition'),
('./nfo/rep/9f7d2e3b8791a6034f3f93b20be150761f5d96ce.nfo', '44c142fa3e383fbf9888da90cb3cc0dada2733f6', 'Blu-Edition'),
('./nfo/rep/4304a021aee95aa96e5a58849fb16831b8190c12.nfo', 'fd7d4fe28047b36b593c6c9ec287f054ab61f0ca', 'Blu-Edition'),
('./nfo/rep/5baa90c2059192772625baf29163bd8b67542ece.nfo', '894d4ca71ec366e4d53e308f4c16855dd7c58ded', 'Blu-Edition'),
('./nfo/rep/cac335ff77cbe63a1996b6718fcf150b6b3aac61.nfo', '41c712d71dcacb595534b62e801e658edcc6fca8', 'Blu-Edition'),
('./nfo/rep/b553e1dbc52cd033ef0ccfa56ded8b0cbc97a16b.nfo', '784eb77ba3b7d8a82602154836d03fceb0d6ec92', 'Blu-Edition'),
('./nfo/rep/e62856d965e2a0973cd6d8cfb947f122b83ffb98.nfo', '2a2f8a7b5b52ebaf9dadf72407211315a28b2216', 'Blu-Edition'),
('./nfo/rep/5a61335489f326ba3414c3d4ebe19e674a351b5c.nfo', 'ef90130ef3026ccad1d9eb5f6c2aa3073427ea64', 'Blu-Edition'),
('./nfo/rep/cd8a2691d9b8589527b73d1d70fa6bc1f8176220.nfo', 'c5b90988d4e8c976bf14e461bda2a7b9ea69b0c0', 'Blu-Edition'),
('./nfo/rep/e743914069625110e75143969373a522fe66a5a0.nfo', '8d3c732553d1e709a178891ab97de6c0bcc4b6d4', 'Blu-Edition'),
('./nfo/rep/9a910d6bba3fb6ced48b00a4d2f314bef161f369.nfo', 'dee0e779b6742c54c7f1595cc7c14db35189697a', 'Blu-Edition'),
('./nfo/rep/f9bc4e7cda6c3a74125718a99a5fd3b37cbe14c8.nfo', '91f859815835b40ee1c7c5d6ad35d9db0853157d', 'Blu-Edition'),
('./nfo/rep/899ec90f0c398fb6df1aa806e6fa29eca85c7df6.nfo', 'c29941ef2b42eb27ce5a186139038bd2a18578b1', 'Blu-Edition'),
('./nfo/rep/9c3e387de65242cf9d414e99d0b3c527baf98105.nfo', 'b4664ea113b2c02d4fbebf1932f84f3c4383df8c', 'Blu-Edition'),
('./nfo/rep/fd0c7d3c23f756fcd37b2d9c78c97e11da581682.nfo', '2d011de81b26d83b725dd9a1ee2de26881ace720', 'Blu-Edition'),
('./nfo/rep/956ab0e2531d555f0663e9faf4d29230b6acf9f8.nfo', '68f2c36fe6c1b4ae80bf4220995c6d79c61933ba', 'Blu-Edition'),
('./nfo/rep/9ac18165b5bd13b633139ed83e9fa2e0f5441a40.nfo', 'c8d84567ebd7fc91ca1cb13d1e89b3d0697d75ed', 'Blu-Edition'),
('./nfo/rep/5baf8169119e078d4953773c8026c61b30685372.nfo', 'e3a0261e71b354e45b903c2afc44cdadd55a108c', 'Blu-Edition'),
('./nfo/rep/8fa1ab06198caee219fb11ed2d0ef928634d37f3.nfo', 'b114928bf28337b3e3022f2acacc890a1f20299b', 'Blu-Edition'),
('./nfo/rep/20bb4ed379ee2773c23f09d16ba1c036f9ac250e.nfo', '3e46b384d9f30402c08f8801be12efdb039229f9', 'Blu-Edition'),
('./nfo/rep/b10def422dfe383e4748e54e1651909cb1d9e489.nfo', '8bb3aecde6abeaef362153d0b19dbc165f8a83a4', 'Blu-Edition'),
('./nfo/rep/9c99f15ea30180f3622b8f6d86d29252cd12e5eb.nfo', 'eff0ce3ef5db3c23d424fd0429c08b2a485e4f8c', 'Blu-Edition'),
('./nfo/rep/1eb07876ddb31f089f63a2324b05ae698d057949.nfo', '30bf492b1cd8ba0a3860f3706161423f948d1d8e', 'Blu-Edition'),
('./nfo/rep/c2e5518f88742fbd8b5b893dada99a470f0cae0b.nfo', '65ca25e76a4dcea1e20daf999e79141731e12a24', 'Blu-Edition'),
('./nfo/rep/bccc4735e419b36a3f9100f2e4678188dd0a4995.nfo', 'f301b55e61a9b47a8ea9f04b984c31d744dc0624', 'Blu-Edition'),
('./nfo/rep/180e09921af54432084628c7cf84ef85d5211ad1.nfo', '476054ec99db0cad5d282b91f5a1dd2510ec7016', 'Blu-Edition'),
('./nfo/rep/5dbeaf19fe1ce07faabc17c9a293377c1ecf20a7.nfo', '5135ecf4df96c0275ff3f7a66453b3c0cdfcae4e', 'Blu-Edition'),
('./nfo/rep/1a5bfae3ff86c98c4940747fa87ef7a269002683.nfo', 'af140b85978d7f771e459103f36dc325fb34ffa5', 'Blu-Edition'),
('./nfo/rep/d2f0d9c9b317f654105faa66c865ee7379b75708.nfo', 'c57b8dd3712133aaaf38fb48ed4adbdc080c7521', 'Blu-Edition'),
('./nfo/rep/05ba5a926f55f2eeba9d2496df32321c8df813b8.nfo', 'd435e7d1cbfca03a87c8c1a1a0097c5585102dd4', 'Blu-Edition'),
('./nfo/rep/3dad68d69d58a1f84eeb9587f0686c5d870f3814.nfo', '4540c778b6a8de5272d101c607af30c99e465ccc', 'Blu-Edition'),
('./nfo/rep/d7020636e36aa06d54891d60dbccbd1a3a86bb19.nfo', 'a5b7c354e99bcb56f8cf911b4dfe6cf043d3961c', 'Blu-Edition'),
('./nfo/rep/aaddc4b4f4799e9c83f5bd9040f40987fe480912.nfo', '2db9272fc5811226ff72fca9fdb0338088ccabda', 'Blu-Edition'),
('./nfo/rep/79e84b310abde7ac0a4394320857589fb163cb16.nfo', '7b8455b86568e0163aa345399857de65f2fea465', 'Blu-Edition'),
('./nfo/rep/c416a8d4221f6bcd723496d8d171bc4881590679.nfo', '01a5fd1c3c618d30c571ea53fa30963574618dab', 'Blu-Edition'),
('./nfo/rep/a354bb2c2e9e8a85d6383f2c29662dcb3d31d933.nfo', '12cc0c07d1a8b9707e67f414cf26a9dab0b5bc7c', 'Blu-Edition'),
('./nfo/rep/5338146b6ed073fab0637ac2843703f035785b95.nfo', '883bee5ec5943bfb49c687485f42a6b0012c3892', 'Blu-Edition'),
('./nfo/rep/e8ad9f8046cd0335930a5b20babfce5a61f7aa96.nfo', 'c51efc8ceb288bfa3b190856fcbf0399dd54db7e', 'Blu-Edition'),
('./nfo/rep/261730d21895ccdb409fad21d0d5ac8fb4ff906c.nfo', 'b9f3296fe51f76797592aa40f7d6aa4c42a5ef81', 'Blu-Edition'),
('./nfo/rep/9f5f5edb5d8dcdc6746f29a668c571f93100c72c.nfo', 'c635b1044af78fe952b29528e560bd7d1b22b508', 'Blu-Edition'),
('./nfo/rep/91337545e2dbfa5757f9f79679c3d0595c0be78d.nfo', 'deec4982d06f75bb1da087a93e44003a0369a055', 'Blu-Edition'),
('./nfo/rep/7be7c4699352709a77f196bed3a32433dc6195fe.nfo', '9a0a467b12ef81b9d70d871fce925667768613d1', 'Blu-Edition'),
('./nfo/rep/55f520025390ed28970166a71fe585a3517c9db7.nfo', '6fec87857164720190e4ae0155c15c69045b09c6', 'Blu-Edition'),
('./nfo/rep/ff49ad14eed92914427c3c20ea2dc947479084fd.nfo', '3d22cc7e3b58c0e8039747620e986c9e29ec55c1', 'Blu-Edition'),
('./nfo/rep/eb4a6694c8a9f907247837c59f2573d13e8c7574.nfo', '9d0acb18bc929c3a205d3cc052ee6ca8887b99f1', 'Blu-Edition'),
('./nfo/rep/ca14b120e23f186dd37cd185f79b6d11d73e5e81.nfo', 'ab65e53ffaafd57fbc366c402612d6b479e38e15', 'Blu-Edition'),
('./nfo/rep/ed8b84e35342667de6718d50946a4a2beeb6fe80.nfo', '1c7f01f6453584771979a91472f4dbcc07f2005b', 'Blu-Edition'),
('./nfo/rep/556c3cbe78325caa0569799aad3e1d55e28a6300.nfo', '9f9da3ac77737c92f1048153e76f5c73500895fa', 'Blu-Edition'),
('./nfo/rep/5f1b7ffee304aae25edacb36ba46b2c70932e9cd.nfo', '2e549cfc868c349f4d47f1c32eb69d0ac56113ed', 'Blu-Edition'),
('./nfo/rep/439b74af8036e9af17c0df5a57f02b5cb217387e.nfo', 'e04f7f6e8a02c7309ed407088f0a1f05e1994067', 'Blu-Edition'),
('./nfo/rep/f6fb029c4031ac4a3d6a6f142d90c3459b9d82f7.nfo', '9145c84824fbc3d7bda0641223d4ddc51a764de3', 'Blu-Edition'),
('./nfo/rep/5b623582ba2426672130e1a191644b7803c8ac83.nfo', 'f7df9bc212eb10b22accfd1d8ebcd423793666ea', 'Blu-Edition'),
('./nfo/rep/7d6a9d28aec1a9fd27c331c99cb862e204381ba1.nfo', '68f6cc3318a37fc8c4e6584e6972b5099b303d99', 'Blu-Edition'),
('./nfo/rep/f0116bf0000e6dcb7f5f96c356798ee94be0f0d0.nfo', 'b66b2c74183a3b0baafe85ad8af7a86f40a45982', 'Blu-Edition'),
('./nfo/rep/05f1ab314322e8b96cb6ed414a89c9be16e313b7.nfo', 'f2abae5ebacae80c214504c0d2484b249fc78928', 'Blu-Edition'),
('./nfo/rep/281e637e6a87b4addd7988848ec1359196051f07.nfo', 'fdc8e564d4352b766bc54d6ebf061d439bd946ed', 'Blu-Edition'),
('./nfo/rep/9ff622eb53a870bc6fdf2094fa72cc2b3566e1c9.nfo', 'be272a80e48b5f3dbd4689aa28762a9e0a7a8806', 'Blu-Edition'),
('./nfo/rep/df9adbd0cf8aedf1ddc205d845b91c4b0e74ef26.nfo', '22915b0c5dbf1f0cfb51add1ea3a77aed901d4f6', 'Blu-Edition'),
('./nfo/rep/de67af2f6e98823693b39b8d3a3df5980c9465e1.nfo', '6bfca22ede4d9565e39833d2bc59da30920e9cce', 'Blu-Edition'),
('./nfo/rep/e1b95e71bd2af4fce59bbba3432ebb292cd43684.nfo', '46866b0fcab3c3a9df7b4f32c77fba9b7bd6296d', 'Blu-Edition'),
('./nfo/rep/12bb8c04a67991ae6798e022b1a6bfdea2f687b5.nfo', 'd190c2d749e56c4eab664069224ba87fb2d4d557', 'Blu-Edition'),
('./nfo/rep/0f48a007ba518d339a0945c3f5ddadd300d08dcd.nfo', '41c170cbd2afae5592ae80336418b7010ac152d9', 'Blu-Edition'),
('./nfo/rep/e7d90ca1d6b8d1fb9219c12d25b4007514ef55d2.nfo', '4b8fcb4e1c34777cc1a0c8d38c42f77575206f30', 'Blu-Edition'),
('./nfo/rep/94b2512cef44464039db40827e1221bd191b4f7c.nfo', '8e6ab6c2d17323d5c133f1103045b8b612a66f32', 'Blu-Edition'),
('./nfo/rep/4740e2cc6e9a82ed9f9585e9cc6ed9e4799915a2.nfo', '01b6f58ca039da9e8c2bcfcd0ff9e070d6f94f39', 'Blu-Edition'),
('./nfo/rep/530e68989ab0d65994fe38cf04a9f4f7df0c4a87.nfo', '508fe14fa5504e228eec19bb146c2901b571225a', 'Blu-Edition'),
('./nfo/rep/7c7c7e426b7d2c9096949f61a390b65543b50af5.nfo', '4011b5c9b6a1c95353d0a65a52534f2445fd6059', 'Blu-Edition'),
('./nfo/rep/6fb1e659500d5739f0bdbd5bd817a6a49712e17b.nfo', '6c9309d422ceb5219209396fb27d883a55dfad99', 'Blu-Edition'),
('./nfo/rep/1856c55c7ad215f119822708ec3437d4cd9f01b8.nfo', '8619dfaba5c664748b666c536693f2142efe3e35', 'Blu-Edition'),
('./nfo/rep/51d4938d5022d1e515fe7380d87c45637184db09.nfo', '84c1572dd9e98dd4356224fbe02840051eef7b72', 'Blu-Edition'),
('./nfo/rep/4c959f043f86a386efc99864ad1ec57bb3757099.nfo', 'f6b1024eb9465ff434f0d13ddd2f99df9fc24759', 'Blu-Edition'),
('./nfo/rep/e2311401a6016d4d6397fc151e11adb252badae2.nfo', 'eccd39a116c124d1cc8cc530a69e0df9d20129d0', 'Blu-Edition'),
('./nfo/rep/00ab3ae49af9ce3f070959c3817be21db948294f.nfo', 'edf55cfc450ce13133d870e73a60afe5fde7416f', 'Blu-Edition'),
('./nfo/rep/f26dcd9277aa0a2861571e6428acb41acce5d321.nfo', '09f632f2aec128f56a08a8045c3e7d3d8b896777', 'Blu-Edition'),
('./nfo/rep/bae4f8b58e2d741a4ebc7d35589beaaf3aec6d94.nfo', '95e975cb584c88210a3e14349ed440a0892465d8', 'Blu-Edition'),
('./nfo/rep/d5e02d506e3f8d44440451b35b7e26c0836febd8.nfo', '79c0cf02267ef05a7f06b2eb81a76eb15c4a88f2', 'Blu-Edition'),
('./nfo/rep/90f144dac50444d7d05cd4697fe27576de340c51.nfo', '02df097e00c8eaa1330491ebdb181849d7059ffe', 'Blu-Edition'),
('./nfo/rep/301076755cc0ad9db48bf7afebabb65d91d99084.nfo', 'f3708844839dc2c480fa34effabcdec4db5da412', 'Blu-Edition'),
('./nfo/rep/653f6a1bd4f8cab184f069afc018f2115b70c022.nfo', 'eb332371d792a5b6052bfdca29858c315d5ad0f6', 'Blu-Edition'),
('./nfo/rep/c7164d20fa7dbdfd54587ffc634698e2b236c8f3.nfo', 'ea38214dba53f80f07fdb38fb2ea4da3c5d69f85', 'Blu-Edition'),
('./nfo/rep/62444a95d07711041d913e40f3ec0584645b8936.nfo', '4013ffcc48ce8773875fcedbbfc304b518a147bd', 'Blu-Edition'),
('./nfo/rep/4ab65aa5e3a505f36ef87190aedc6e19f77eb858.nfo', 'bf73574e36635aa450bbf59b70972fe83d35a3cb', 'Blu-Edition'),
('./nfo/rep/600a3ff3ebfd3659bdc2e9cfa9887b1c58212783.nfo', '21f652c59f438c57531527669ba8f5de67ca24de', 'Blu-Edition'),
('./nfo/rep/51a410669858829237d75c226cddde8115e62b1b.nfo', '71fcb1dd2955fbc7f1f77de5220983a4c1dfbc3e', 'Blu-Edition'),
('./nfo/rep/1936baa51a75f13c042b6f1e7b0eafdc04ed065e.nfo', 'e3c4027a14ae7a69bbaf26367a1ca2b92009104d', 'Blu-Edition'),
('./nfo/rep/b055030e28a8e33340a5b687a9c51a95dfd843f8.nfo', '6a962840d1a84bdb944c50266cc017a11c912a9d', 'Blu-Edition'),
('./nfo/rep/b4f9e8c357b1852e6f98138393533939c241561a.nfo', '8a8ac48ab91f78f84affbed72bf88ceb1936aa3c', 'Blu-Edition'),
('./nfo/rep/a3c34abe6ed972a75cf26024fe90ea8f4ae4539f.nfo', '68debacea54e5ac6b80d56da5754165a97baefc5', 'Blu-Edition'),
('./nfo/rep/c0d801187c6cc98f3bd2cce7628cef0888e9b596.nfo', 'c3da222f1547a1fb88b85ea60ce0ffbfa7007d32', 'Blu-Edition'),
('./nfo/rep/f7c8def84da439218cbdd0ff1e3e8bfcf41f152a.nfo', '9b2020e59c0bb4c1e8bf0e7184613ebf4690e336', 'Blu-Edition'),
('./nfo/rep/0f1f29cff1c95df8fa6fae1fc74b296e62633907.nfo', 'f3c9b2aab8250a8107290c3b9e5aaa5d05f000f8', 'Blu-Edition'),
('./nfo/rep/baf5b40711ffb622643b17b1d7297b1491c2fa01.nfo', '6c81a5f2a912baaeef5eea64da8fd58c027ea5ba', 'Blu-Edition'),
('./nfo/rep/69baf6f7624be4c87c852c3a1123597bb78e2ba9.nfo', 'cd6592eb1813d2e2babe29201245c9b7927b5654', 'Blu-Edition'),
('./nfo/rep/8a079f06c82ff8c19b3c43166cba3ebd722bdccd.nfo', '41fa64439d23f1a8285fc92c9b66713afebda15a', 'Blu-Edition'),
('./nfo/rep/ecd2c5523ad981c2bc855ccb9017a123459b09df.nfo', '58f3aa7168dd3c3100f2b2b697aae3e692cebc7f', 'Blu-Edition'),
('./nfo/rep/aac838ab5ce7bf25f96d18a39775836ebe999606.nfo', '77a199fb49482afc40e300b80634807c95387c3c', 'Blu-Edition'),
('./nfo/rep/b64cd937ffaea31cd6a5e9d9d1057e6cb252b87d.nfo', '95f377bf51d26ce6aba805f32bd007f9c8ff40ec', 'Blu-Edition'),
('./nfo/rep/daded236eeb4432be7b929936d5c7af86fd00168.nfo', 'd961e388f103877de228be099ebab817cf971f28', 'Blu-Edition'),
('./nfo/rep/b4648618b7c04c618a56086b969c7296dfb119e2.nfo', 'a936d4a2be662804664e41028776232d77019a6e', 'Blu-Edition'),
('./nfo/rep/20c5ade6707009de047d9d58006be43fe2373021.nfo', '1edc940831244f8bfb7186ec2018b94c4c1e631e', 'Blu-Edition'),
('./nfo/rep/9569adf34782c3ea06987b56f75efc9792952aa9.nfo', '263447c063f6c8d0ff2af383f43b782d0204aced', 'Blu-Edition'),
('./nfo/rep/aefac89ec7183c2efe7ee39927cf748f48f3edee.nfo', 'ad2a7ca1f05d7d577255d1eac33d52fd4ec76d7b', 'Blu-Edition'),
('./nfo/rep/f01b197a1328b97af076a85332d9e22f648b3eef.nfo', '1d25e6c0b1bd6fb2a8fc8eb03ba9114ad333b036', 'Blu-Edition'),
('./nfo/rep/9695cfa9002a354bd699844eaf0ae188a1a415c4.nfo', '0a889bc81cef773a630e52823db5183cb5b6bca5', 'Blu-Edition'),
('./nfo/rep/ae79720c67b9fb1d47d61650ce8ecf55063db88b.nfo', '48d3ffb08190552848f7f5d0d124dc70db247cc1', 'Blu-Edition'),
('./nfo/rep/f3811b443d0a4bcbdf3b2937bf61d83498700802.nfo', 'ef05cf98fe71e28a41e2d4ca5b1f4619e628f417', 'Blu-Edition'),
('./nfo/rep/33147d1e6558a023901f2391985c26c345e6cf35.nfo', '5041600f97741103e1403d19300b7fa713bbcbba', 'Blu-Edition'),
('./nfo/rep/bd739322a2ec4b8d0cf50d483324e19c3769cc47.nfo', '5d6890f1843431bd6eeb22f3738db8c68239dfbf', 'Blu-Edition'),
('./nfo/rep/d31aa4b677cc82de13b49c99fe33c748b36254fa.nfo', 'd69617340c2e9d407673075666dcca76ae2fac3d', 'Blu-Edition'),
('./nfo/rep/a67bd717e22980e0a5e7df8fe1c370d543447522.nfo', '0888134e477a2921a1950a398c651a9259e08cd4', 'Blu-Edition'),
('./nfo/rep/c3968b4344ed85162c2f2b47eb537e698cff29de.nfo', '307d38df101e5b8cc6fd734aa20c5ee44856a610', 'Blu-Edition'),
('./nfo/rep/1996454f95381f45dc7379368be91d8bc67c53ec.nfo', '7c15bec2c7b073ba63e7e89f680acf70ef81b531', 'Blu-Edition'),
('./nfo/rep/e22783e41514159832bc51c946360f8829a7addb.nfo', 'cc2714cb918aacbde0ab43810eb8edddbdfd34f7', 'Blu-Edition'),
('./nfo/rep/f15c7d2513985ee55688e406821d7218c3d7c1de.nfo', '625ee55293d2c1c452926e2bc6a366bf9ac905c0', 'Blu-Edition'),
('./nfo/rep/ac8ba09ae37bf88cb4b83365f60473de3e14929d.nfo', 'cd0b1a7a983a8dbefedeb26681a50f0a6e1e2414', 'Blu-Edition'),
('./nfo/rep/2a75db7097187ac1f67d7333ba62a2d260ef3227.nfo', '373a34f8b67c261d682675146b9f98ba456746cb', 'Blu-Edition'),
('./nfo/rep/a187d555e9ca5a5073e42950ffbcb9652d800465.nfo', '76c0ada34d1faae97f057cf2a51f3d9c0a7292ff', 'Blu-Edition'),
('./nfo/rep/3f8df788160aaf3dc3b0a9d846c970596c02352c.nfo', '1c4dad09ff97111cad1a8b836576e3ec104f82ea', 'Blu-Edition'),
('./nfo/rep/c3876e085aa90c0f36e37ddc1c01039c99ae9aec.nfo', '4db47c01d85a76c20b8a2ad796cd63d955a03962', 'Blu-Edition'),
('./nfo/rep/99ad23b7e6360e7607044ec9984afe5a3d00f558.nfo', 'd484b6236654fb7cf4ee4360c92f6018c24dbbbc', 'Blu-Edition'),
('./nfo/rep/c346361056dcdb356d76a4ebf73cd0956b3a4e45.nfo', '3822981ed2a717c1ec5d7d289244bce829997c86', 'Blu-Edition'),
('./nfo/rep/3ed91b4a0c0440345872762ad50c607e6770331c.nfo', 'ec517393752424543d1075964f21374db822a7df', 'Blu-Edition'),
('./nfo/rep/faf36450d3c71b954ddd46c044e37e1e8fa4c83a.nfo', '66ac133886b9da23f2a2495475af5714792c94a5', 'Blu-Edition'),
('./nfo/rep/cd51e5246ce223eeb033d436e379086c585d7874.nfo', 'f55909433f56e60b46e8a7f59750f7c8bb098b7e', 'Blu-Edition'),
('./nfo/rep/6572b3562273d9a2ef8766095c78583ed4db17ef.nfo', 'c49dc41d9b7a05a69d0318baeac0136e639602bb', 'Blu-Edition'),
('./nfo/rep/4baef864ea71f48d59c61b94c3fba0886a938e98.nfo', '530763c7e0ab67ffe616c56f84c255697890ff51', 'Blu-Edition'),
('./nfo/rep/009f59cc05c39e397811c4347edd0b07f59edf90.nfo', '572d89d391b61c83efcd66d66b71f3cec44cd433', 'Blu-Edition'),
('./nfo/rep/88df0c904e05ce44d3e7ba2636a705cd0f3c68c7.nfo', 'c71af042bc24414e1980d72d49f74963c3bd9602', 'Blu-Edition'),
('./nfo/rep/e919824348bbfc7821ca99c7f1ccff5675c63869.nfo', '64b860b9511e6bb2bc654acc91fbd20fa4ddce2e', 'Blu-Edition'),
('./nfo/rep/85dfb8b59af43b2374121ce94291aceb1450fafe.nfo', '158c9c6a9f7257117107e9fa5eb168fc3c733521', 'Blu-Edition'),
('./nfo/rep/d41062837c56bacbc1f71f74973a9c26ac83ccbb.nfo', 'c426d0aa58a54ef66061a453671323f179e9f88b', 'Blu-Edition'),
('./nfo/rep/63154ad6b1a2792e63ddc9973adc6e43dd5e3933.nfo', 'aa258e0b423faa52f71c3ab119fa115dd0a5d43c', 'Blu-Edition'),
('./nfo/rep/b6a906ce930fef020467886ece2ad776b94e8039.nfo', '67d0eece521774dbb2e87da70f35439460f3db5e', 'Blu-Edition'),
('./nfo/rep/90f04f2cdb60ffab96eccb3bcf726152463883f3.nfo', '213ac51d74bb57853e9bd97372c081638dd6ac06', 'Blu-Edition'),
('./nfo/rep/fe11cd7fde214d675fe4ef3519a7f1b7da4a5f8a.nfo', 'dfe2e6100decad521dc69b4770b1546a7e4dd3ab', 'Blu-Edition'),
('./nfo/rep/62f817ff141e0493d54ab0867f7d2d7c7a410dad.nfo', '727356c123b8ffcb8e6bc956d61cb63ab49a6885', 'Blu-Edition'),
('./nfo/rep/1cee182bc44e374a7008fbec9f1ef294406a4663.nfo', '56d520d72161a78d72e0a79373a7018afec8c149', 'Blu-Edition'),
('./nfo/rep/e3c3e1bd652c837aec7a0090ccb7e3d71a07a5c0.nfo', '4261fc2716a4f4cab6698a1ff5ce06a5852b830b', 'Blu-Edition'),
('./nfo/rep/a1c0b43f609931e0bc002f70e70eaba3a7eb2363.nfo', '4b77f0a2efb11ba66b03bac933af261c1e59e53b', 'Blu-Edition'),
('./nfo/rep/0ae12a1333b4562d574bb7994565003b15ce7936.nfo', '29723526bdf90d6324630e24dc4b1ebf38a87427', 'Blu-Edition'),
('./nfo/rep/d591f24d8569adf6db2bcc985b7191e57752336f.nfo', '8dbf06ac7737c8c428a6b614ef2f818568275044', 'Blu-Edition'),
('./nfo/rep/70a1ea74691c0581e9e9997facf172e5b1616745.nfo', 'f6e18b2b6a7ca66bb5d44dd8f160cec75b0afc5c', 'Blu-Edition'),
('./nfo/rep/4a497bcfc99a597474c4de7af4b3852fd0162d50.nfo', 'e95ba0d735b48247a1c33df4e5027e4482340ce7', 'Blu-Edition'),
('./nfo/rep/eb0603ba5a60d3f2cb8f5751cc1de64fb1fd0a69.nfo', '7b2497fbdc00c2cee7349dd87fc665bb7ceea76e', 'Blu-Edition'),
('./nfo/rep/d5f8534d62b46ec64a97c19d112d7689b7c2e2fd.nfo', '3989fd21b2308c524270bff75f6ce0e7c6aced77', 'Blu-Edition'),
('./nfo/rep/c3c792b4fbaa8215ac36fcf1cac2f209a6ca9f55.nfo', '16325ba75723ef687bcc12d9d7673f6e11608b39', 'Blu-Edition'),
('./nfo/rep/5ecd57e58701ddab2439ea56e65dc830c9c2878a.nfo', '31c1b424d315bfc528f04a8d13e65d819c5b8eb0', 'Blu-Edition'),
('./nfo/rep/18958b5a4843fdf29435c5442e7a9d3e88ecae24.nfo', 'd344816e0e58bcd4810bf4170339ce6d5a7dcfbe', 'Blu-Edition'),
('./nfo/rep/db74da93ee6526087c26f05d5cf08db66921e243.nfo', '29f513aae44a882b9f0683f4da4538632f93fbaf', 'Blu-Edition'),
('./nfo/rep/94e14ca59720e65b5b2da3e5b40243b8840a61b1.nfo', '741e7248507e2e72d292f6504210db0b46bdd8af', 'Blu-Edition'),
('./nfo/rep/08ed881af513eb3629dd8da43d815aa5899a32f0.nfo', 'ce427073aca38e262cf63ae149c72c7d4790ff91', 'Blu-Edition'),
('./nfo/rep/92d39ec63a6ef432a72d8a94584ac80450ff9fb2.nfo', '822357e929ca93ea9b1cb55e48ba878394267774', 'Blu-Edition'),
('./nfo/rep/f1713c138bd3d09abde8515940d7e52222e51bff.nfo', '72dabb38f6a6b6ddb89e32e5cacb7580498660ec', 'Blu-Edition'),
('./nfo/rep/9527dd8598707eafcc789d6c95d159cc757b87b5.nfo', '85faf1686368f27db9c5ccb7181fa1c6fc164862', 'Blu-Edition'),
('./nfo/rep/30d4497c1e3524cf61519eb5222bc770e620c985.nfo', '4086d98222effe27c961cb4c4db563dcb45600cc', 'Blu-Edition'),
('./nfo/rep/4c00c42ead32bcb538ebf7ebb1a77c80cb142bb9.nfo', '89ec06ceac4c2a5fef40d3066d508e2895284f1c', 'Blu-Edition'),
('./nfo/rep/ffeb2debc0c23dac62db1527798d882ab18cbf7f.nfo', '00f2ac47e7d591b9e65959b3e677155d80149b1f', 'Blu-Edition'),
('./nfo/rep/f66728e09ff476439d0245dff6e8b4fcb93ee688.nfo', '0b319b155605f2d53e77cd808e009e78221fe561', 'Blu-Edition'),
('./nfo/rep/0047f3290f3ffbd9d908ac2be2e17de1850d458b.nfo', '07bf0b137e1dfdf49592e5969f56a8ba274a5413', 'Blu-Edition'),
('./nfo/rep/f54e6e6da069bd86b2b3b89d0819e91de1b2369c.nfo', '2cbf9fa0cc647d2ba7f5b966666bd3000c9f9d3d', 'Blu-Edition'),
('./nfo/rep/e3977931af4e2829e40552029c68c1f3b4c20381.nfo', '95681ee22cbbefe931e8487ba72e6b15f2624d7c', 'Blu-Edition'),
('./nfo/rep/b069ddcb03517ad70b9651fcb8f93df72b563175.nfo', '761539b94b4542dcb61ab675eb5864a4c2c45536', 'Blu-Edition'),
('./nfo/rep/2d351ee76df09d2e9a99a46ced0916532f7b16ff.nfo', '3d8031aae5179402d66db8f4d9a6072a7d4a1b7b', 'Blu-Edition'),
('./nfo/rep/d43e0bc9cf6dffe52d1bf86137716fc13c8e4d27.nfo', '9912ccd696f672b9dc4cd9d824115fc434680565', 'Blu-Edition'),
('./nfo/rep/94d810c63cad750a02a812e4abaa4ca780348e72.nfo', 'b10c7a818d5e1a63962d433172b4cd9db3d5d414', 'Blu-Edition'),
('./nfo/rep/0ffa0ed42ca8e27baf6ff405dcd557621eedfb8b.nfo', '04fc5dad7acfab8a1371cf86aa5c60f830baa802', 'Blu-Edition'),
('./nfo/rep/e536db2761a4d13a4e80e2057fd71c4c9b9b1d60.nfo', '28e48975ac643419f0d3e1cc1242bd3fd38a3027', 'Blu-Edition'),
('./nfo/rep/bd97e6b2d712a9ef47312356f6ddfae42350bf07.nfo', 'aae9d9d9c602e97d70b68bbc1ea67b4a0cc37a25', 'Blu-Edition'),
('./nfo/rep/89013a5616b2cc0b2077fe12fc5747bb7088c210.nfo', 'ffea99cca545e0b0d4843d6f660d03c6c434e4c1', 'Blu-Edition'),
('./nfo/rep/161cf4181df4b44be81c771535277bae12ea72a2.nfo', '0c2b13825e4459d3a0f9043e96cf018dcc2e1f12', 'Blu-Edition'),
('./nfo/rep/51eede0f5e9dbddbd4fca8115cf9d1466794e753.nfo', 'f2d633964f185aaaf9325d559668e832b124908d', 'Blu-Edition'),
('./nfo/rep/6b9bd74a65bc41adb05bd46f3a97c045541c5328.nfo', '0811d12405898944628c99e99509f334047489e1', 'Blu-Edition'),
('./nfo/rep/bb1adadd0e6462591d404708a4b5e08ccc872bfd.nfo', 'c078c9d14b82bf811dd3878f7f1e0bc4c56a3e45', 'Blu-Edition'),
('./nfo/rep/380498982d16d7e04d906af3c81c3b6ed9ff2bd7.nfo', 'b8be2a21d6e34e1d473bd49df55699486c34e4de', 'Blu-Edition'),
('./nfo/rep/40bf53a707c32cd50260b971760b2c43c8926ba4.nfo', 'eb019242d866de532bb3b09ef052c0aa04be43ed', 'Blu-Edition'),
('./nfo/rep/6d2e5644ad41ba56327ec7f41fa8b37b4a360450.nfo', '276e2c8ca1fe57b2524fd2833a8bdc2d6a7d6ffc', 'Blu-Edition'),
('./nfo/rep/3005fd84fdd4a941255c06f573852dd34bf03d44.nfo', 'a9e17fecade0bb6e52ea8a4ac15bddf6e99bb28b', 'Blu-Edition'),
('./nfo/rep/bb17fb31853f1dd6d9efaed5ea9ef3af921e9bcb.nfo', '583261eaf0c37fa632856ff5894628af83118e24', 'Blu-Edition'),
('./nfo/rep/45a53b07b0d36f8014f6e4999c0d48c350da6287.nfo', 'dd920e3c12adfaca5912458c1e667dd4316c0b3b', 'Blu-Edition'),
('./nfo/rep/971777ee310bf679412431b44994561a49eed0d8.nfo', '817589a8f9e4fb7a12f7a8f19c9230c29ba56ae0', 'Blu-Edition'),
('./nfo/rep/efd62795c4e844d8b286f99253b21d44cc0455b6.nfo', '02162a376182da01406b5949b080c158af64611e', 'Blu-Edition'),
('./nfo/rep/2ee50ed6c579ff8e0dfb470e1c7a25b6866c5f1f.nfo', '50ab658e541af9d15409dc922bdc5e2980be0778', 'Blu-Edition'),
('./nfo/rep/82cbf73a5149b36fdca8aac480638e9f384cd870.nfo', '56a27b74d2a5befb627a75bdda21263920bc8c93', 'Blu-Edition'),
('./nfo/rep/47607133df1512bb1e80bf6649cedbced3e64df8.nfo', '1fec2423cd27c7ea7059a29a115c3865e30fe81f', 'Blu-Edition'),
('./nfo/rep/c6df29570d48f264b2de43a05753b32ea17953e1.nfo', 'ed7468b278570a0a2b4291d3d80a9e8591834046', 'Blu-Edition'),
('./nfo/rep/abb3bf614c015a9f29c4bbb8d27ead038f2e9323.nfo', 'e0ccfa54dd16a660b6cf53dada421588401a089c', 'Blu-Edition'),
('./nfo/rep/61cc7c432a59f302705cbf44187d60bd14934d9d.nfo', '7f40ec8851ccbdb83783e1391707ee6d8ea9f18a', 'Blu-Edition'),
('./nfo/rep/a8ca86aa634d129c9289a022a3b8b137a60013c5.nfo', '3e49acea32762c9dae662c35c81812f15702facd', 'Blu-Edition'),
('./nfo/rep/51cfff293129526f9a47595197f96e7c0c2137a3.nfo', '299cc5a0c006fb5641b76612a967cb92acf5f59c', 'Blu-Edition'),
('./nfo/rep/63df8b224745bd1e1fecaedab0e161915bf4e529.nfo', '69d0731174b93337c753c9e3495fc14441dc29fe', 'Blu-Edition'),
('./nfo/rep/97004e14ee9fca5b433d615988b1548c1fe06031.nfo', '2455a4c1bfbbf541f98665c0ee0c189902910472', 'Blu-Edition'),
('./nfo/rep/aef7e9e3319f6116979cb992d6b86628331767b9.nfo', '0506e43d81db213d91d1c0f6e69ed1e30782db3b', 'Blu-Edition'),
('./nfo/rep/26c42a0aacb9f0368690931f78ece3073da77764.nfo', '4bd6d40825824db9828627375dc77bec2b740326', 'Blu-Edition'),
('./nfo/rep/092ad6ca522edc5ed8bdcbec9708064ed163a6de.nfo', 'c587a95b9e2934dfce810c3a29ac6b7f3258d29f', 'Blu-Edition'),
('./nfo/rep/67a53516d55c3893218a117498df5ae285a81011.nfo', '6e52ae0a8053b77b28a7118ffffceb30bc1ac99c', 'Blu-Edition'),
('./nfo/rep/d996662ce36f6f0d7677bc16bf8399dfda88bfd2.nfo', '2812dc2151103a7197ac219e0c0521483ad45ad1', 'Blu-Edition'),
('./nfo/rep/686a9a0eeab401de14f1c684aea3efe2e07f6cdb.nfo', 'acb69291dc3cf6dc2d55d741c8ac2e59181bd4ff', 'Blu-Edition'),
('./nfo/rep/d9ae29c1790cdc5cb33cde222de6fbf98118b995.nfo', '8c498bb34edd2b33becb83fb7fe2379d181081f9', 'Blu-Edition'),
('./nfo/rep/b8ef24b4c7d3d34d309ef4748abbe6bb7d424da4.nfo', 'c4d4406231c119dfc471b67767799b824edd2b69', 'Blu-Edition'),
('./nfo/rep/e4471b87db9ac30cf2a9a80f5704ec2b514a777c.nfo', 'e16359d2fa1c1807e8fa3ed3589cc101d58d2e79', 'Blu-Edition'),
('./nfo/rep/90516e9cc4f8815cdbf81a1078816400ba4ec5a2.nfo', '95a90bd2c6044d8f8a04c906b42fd43707c9ae71', 'Blu-Edition'),
('./nfo/rep/1494f51513d733fdc74047247e77d24313e968fd.nfo', 'fdf3d68cde2bb954144535d766091af9f33740f6', 'Blu-Edition'),
('./nfo/rep/5ebbbc769b4d5701156563ddcea60b9caf385b85.nfo', '82facc5a703518fadde672f648a14ddfaaac3b78', 'Blu-Edition'),
('./nfo/rep/d6d47e47008a43a6fa25790d70f8e85130ce36c4.nfo', '02d8c538ec56cf9dcbfe5f19d05db3725440f9a3', 'Blu-Edition'),
('./nfo/rep/a09697f606a1cd8f54709727d94348922238a8f6.nfo', '2b578858fb5fcc9f373646c06d2a0348a890c76a', 'Blu-Edition'),
('./nfo/rep/19a41d00390f2332a2bf6730f6ab9c4f19fa5e3b.nfo', '6b6f1c13ece6e55f8dd752cf24963268e696653f', 'Blu-Edition'),
('./nfo/rep/b0fb9b795a0becb09227a65062271d63b01d9193.nfo', '6d943e361216913e346cc88b35fc5b0e00d72e11', 'Blu-Edition'),
('./nfo/rep/a41602c96306191b2d8c4f14ee7460be2ebbf51c.nfo', '8a6a52e473149ad4db751a9f846d1d45ba136ab5', 'Blu-Edition'),
('./nfo/rep/de5d30b8547c766778052b880e4251493a8193fa.nfo', 'e7cd6bed7e56fca58f86c8383c2c4c660493eeb8', 'Blu-Edition'),
('./nfo/rep/21f251855b29c4228ce082390a89cf04b26df92d.nfo', '6d5f5ca4373ed63cc24638b6cb67ecfd156737f4', 'Blu-Edition'),
('./nfo/rep/0243e450b19ccbe5002d9f948118e21e420ad3fc.nfo', '2d10964bd02d3c06a54b97039848f2c58c4a917a', 'Blu-Edition'),
('./nfo/rep/6ed6c165ef40c55fd0dc360a4e99d7d624c6dbaa.nfo', '650b3be454339c4f6cfabf81a42c108d0061a3bd', 'Blu-Edition'),
('./nfo/rep/f9b5e5f17d299faac8aadb3cfea2963dbd537b62.nfo', '6de98441f0da19b0b03e00b8bf559bc051e2424c', 'Blu-Edition'),
('./nfo/rep/1e4589ac0d23fa68741b227ae2f6960eb0e0a627.nfo', '3b07ca580233e5d18c304c55593e2e1c79e4b217', 'Blu-Edition'),
('./nfo/rep/710149ad4f750d3ce38e45aa703d831636b5f1b9.nfo', '0dfcfc4aa51c28a66379c3d4df3e317bf1289016', 'Blu-Edition'),
('./nfo/rep/6aa0fd8843d4479e4bae17840d24542c4e22610e.nfo', '37f2f877eef0233dfe0e4bdeafabf6519e87a2fa', 'Blu-Edition'),
('./nfo/rep/e752a8383ae0c2a741c30021b0553494ec0b4067.nfo', '661ffe1f372061c09df70eee8c6ed0623717812c', 'Blu-Edition'),
('./nfo/rep/cc76c3d8c14ab0f33700e67c3658dbc0496ade38.nfo', '0ad0fa2765aa3246586adcc2623616ed05dc286e', 'Blu-Edition'),
('./nfo/rep/a674ca792662a8e3f7ec443e0ac5f3ba46be9ca7.nfo', '3d9a5afbe6c5d986cc3f1f68e41ce50f3248e81d', 'Blu-Edition'),
('./nfo/rep/2029f29812f1ae487e91077f431ab40fc036a3a3.nfo', 'd5b346c082ec1061cc62906dfe0fe6747e18535e', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./nfo/rep/562d8d18fbd7d8df6fb968e6b8577bdeb89420fd.nfo', 'c3784a9ac5d05387d0710f0b8a1646d4f804c7e8', 'Blu-Edition'),
('./nfo/rep/8239c6719967392caadbc06ba4d28daf046dc0cd.nfo', '07f04afb774f232c793bed58e1a0e4b1081782d9', 'Blu-Edition'),
('./nfo/rep/165e1ee89847e02de132c83f629b74df9ecd74c6.nfo', '7a1f4f443144cd1d30e319fc46bab1042c70937c', 'Blu-Edition'),
('./nfo/rep/b6460b54b7ca309f0956a4b743793ba9a478af20.nfo', '1b3edc1b083ce03424eca37496bec5ec4292f738', 'Blu-Edition'),
('./nfo/rep/087ef2f2bf21c930b095b38ba8aef7b951cf7d3f.nfo', 'e3a30e6dc40fca9c35646c7b6a652409b43fb7a4', 'Blu-Edition'),
('./nfo/rep/5473bce229280f4a805a3ceb0a3dda6424d91162.nfo', '52c8650e9e379aa223c2c5390595a4b5f88e3530', 'Blu-Edition'),
('./nfo/rep/b1e5a1668a8f285922e88b42f90b1a5baae1e48b.nfo', 'b3c2d4c41b6f9eecc93ee156d459e44fdcf2cc53', 'Blu-Edition'),
('./nfo/rep/40cb024db40cc403d38e1f2e4bc699ff09e7fbe2.nfo', '9af8c29b1d0ac5e511fc7f51413817ef79f951a7', 'Blu-Edition'),
('./nfo/rep/d92fb1e759984a7dd3186b520ae483e05a09d2aa.nfo', 'b63c0abe91561a6a0a81551b484e4f7259c2daae', 'Blu-Edition'),
('./nfo/rep/0ceebfa99d7372ba1d43b46af3604e90d09b740a.nfo', 'eee61309dd01abb64c8fedf10609784289b77cac', 'Blu-Edition'),
('./nfo/rep/bb696f0ad46aabbc52b3118825d1083890261972.nfo', '7a2a022108099a28dc9555e9392767c45a7a8ad0', 'Blu-Edition'),
('./nfo/rep/5c492cc6b35e573987a47947db3f7bc8ae168089.nfo', 'fefd2a9ce4321805e3f2632aa65a1cbea1773bc5', 'Blu-Edition'),
('./nfo/rep/baa4a973609a2538b8ec0fb1d19d458eff080755.nfo', '51ebbd8a2a86e9513731d24b9bc5de73c6d3b816', 'Blu-Edition'),
('./nfo/rep/ad5ef1b2be3d3896e171ba18874854222e7eef0b.nfo', '0d8803e21ae34ec17de42d4b88093cdccf1383fb', 'Blu-Edition'),
('./nfo/rep/100a8948c516ce9ef4c1190edcd8db6ee3f2972a.nfo', '47645d2627e98917186f4f97f0ec2406725ea284', 'Blu-Edition'),
('./nfo/rep/2341264729754df58aa83d4d6c538c354d5547de.nfo', '077c97d679b7f1656a454beae18e8de9e0f8f558', 'Blu-Edition'),
('./nfo/rep/c27fb3ecf70d6a67b3b6d0b9e9f9c1e3d1c7cb0b.nfo', 'a72f7ad78e25c9f9195ad6b9b92fd38e92e94082', 'Blu-Edition'),
('./nfo/rep/efb57076d1b8bafee87633f1b011b01083a64774.nfo', '699114f035b9345c47ae6e23f1511c238a433e6f', 'Blu-Edition'),
('./nfo/rep/de4550b1f9b55ef890b5a84625dfd5c9fe7e333b.nfo', '70d4275a6a4d22913761a18ca501b361e0ebc612', 'Blu-Edition'),
('./nfo/rep/ec9762aa3244c3ffe974cf47756fb1b794eb1ece.nfo', 'b311c923567c78c5b12b9043f5e07266103fd407', 'Blu-Edition'),
('./nfo/rep/10987ac52267a358171ab8ad13737e6eb611f008.nfo', '87de9bcb338dc4cf2ec00126250c019d51785a30', 'Blu-Edition'),
('./nfo/rep/a4041b9cd6e7798b8a1dfc1b73f9601e1eb621c8.nfo', 'e36abfb296ef86a20049826b02dd742e5d51c60b', 'Blu-Edition'),
('./nfo/rep/d1784bd429f2e2e8646b88af2197b46155b01ec7.nfo', '5729b6e14e12ddb2fa6e8cf675354479ca25aefc', 'Blu-Edition'),
('./nfo/rep/d526f46529f3256a86b02c9ca3baee9a4ee1c1b4.nfo', 'd637811fad2b6e5d7ead005e33735df7041fd88e', 'Blu-Edition'),
('./nfo/rep/b138b234c41118401812829b1ac4e7a93c6f20f9.nfo', 'ee7484ba51fd7e7a545495d38ef2e41fb83895e6', 'Blu-Edition'),
('./nfo/rep/2b90db36735290a4888b84b27345d8292d2cab6f.nfo', '9b21b68f61c64fe2c8dcbb5630d14a3fe29424f1', 'Blu-Edition'),
('./nfo/rep/32e9d92c5359168a9bacb5a981be4a5c44e11277.nfo', '6ab94f82b92e905b3640d79dce55c864db788274', 'Blu-Edition'),
('./nfo/rep/353cb5160b3d9550589dde91d07fb26bfe923eeb.nfo', '2ddfdcfdee19356c6aed079d0bb4c104c0c1e046', 'Blu-Edition'),
('./nfo/rep/e14b164bef3995686fc14e5a64302dc37f0619bc.nfo', 'd077e01a917b5b8173587fa93598326ff53d246f', 'Blu-Edition'),
('./nfo/rep/5687cfcbd862f392858054052f7f2a1bb3f10beb.nfo', '77af15bcf812e8ac850b07864ec592fd537d7b25', 'Blu-Edition'),
('./nfo/rep/7193b5e5028a1bbc9d069cb531f99c36a381ba77.nfo', '2d5b3f148fd877c021eb2f5d8ac8160f47077829', 'Blu-Edition'),
('./nfo/rep/3686986abf26129e4ea7870afc89112121e2f5f8.nfo', 'f56a9f3b0d845c5d225db4ed4d086c2830b2cbf1', 'Blu-Edition'),
('./nfo/rep/2dbc40c79b6640bfb0a523af26240533dc668b52.nfo', '4fa024566f3d73ea61cbd4189c775a3bc654d42b', 'Blu-Edition'),
('./nfo/rep/461e899ce7b47a8bf959995f7a5ffca5ab94a5c3.nfo', '760626285f4348530d5865025a076556cc0b954a', 'Blu-Edition'),
('./nfo/rep/d7cc9caa086222e47bf2788428b2b2f9b23b4edb.nfo', 'c7cf141512cbd5b987212241963d97689dbaabed', 'Blu-Edition'),
('./nfo/rep/effceba765244f68f9f23db956acca45d45475d3.nfo', '1274627aca714a7b149f49c008a5f64d1aa897ea', 'Blu-Edition'),
('./nfo/rep/078e25df8f67131d3534e8bf4e5f454564f6745a.nfo', '312a6b3bd45d04add5f448a9d963c925dd5adb1e', 'Blu-Edition'),
('./nfo/rep/6ce5b376a5144b328c7ea5e32bc5beef455db751.nfo', 'a2561dc0663ab62c94f62c6c10cceb4b4934bbec', 'Blu-Edition'),
('./nfo/rep/be9363735440def21ecc57a83bc4d61f6fd1ed5b.nfo', 'c6acb88db2208e0268e083fd660576347d4e0da0', 'Blu-Edition'),
('./nfo/rep/71da03abc4e44284d25ef1a3a9cf6a10c7cf4f56.nfo', 'bc024adca3942d2871a8857238a0872b0cb9a230', 'Blu-Edition'),
('./nfo/rep/8cf403fc6aaade33480990eefa782f1dce14146a.nfo', '2e1c8103daf1967eb257b82d6bced640ea8e0f06', 'Blu-Edition'),
('./nfo/rep/555dcfdd51fb84263ae8d151ea800cfa036dd8e1.nfo', '72f99e4f67e0e0161b550b0dda04f46f8344675a', 'Blu-Edition'),
('./nfo/rep/9d62dfed15cdfb5edd70194db60e5fb4f163ef95.nfo', '6e07ac51201c5cb078f8afd310c248ff5c00a427', 'Blu-Edition'),
('./nfo/rep/5de193284db39e33c3c03ba38e71dd15cdca71b4.nfo', '0dea7f4ec5d7005dcb0e51cd3f80735a20eec633', 'Blu-Edition'),
('./nfo/rep/7bb56dd17db1edeb4533cee0ab974c0c3526ea12.nfo', 'b66ed7915ffb740720e328c42cf2681046d9c70f', 'Blu-Edition'),
('./nfo/rep/ad41be7d0db8043a37fe2bd7eeaec47c82d335a4.nfo', '35c10947e65933bc8e5443c8c681ee3863c9cdb3', 'Blu-Edition'),
('./nfo/rep/b2bacdfa75e710e268c46a4e1c62fdf04631e3be.nfo', '15f838e2ff0ad3ef64fd5b61e015f2bbd27927ac', 'Blu-Edition'),
('./nfo/rep/34820c35fcada0432e136ab588cccc8358b8ddfe.nfo', '36c9caa15c45fa1be82257f0324692256e63eaca', 'Blu-Edition'),
('./nfo/rep/ad751f92e453bda75874efd456dc52ad541fc3e6.nfo', '9feb85a63cf93f07794befddffbe6c2cdb3a0450', 'Blu-Edition'),
('./nfo/rep/4a8ea3769f9b7a83f0fc8883b742c8f414008794.nfo', 'b1c2577a4ff78ec0a82bf5c35cbd667ad058e9ab', 'Blu-Edition'),
('./nfo/rep/e2c25b131bacb52181aa4ea459f33501528ecb78.nfo', 'c0ef65ec699ede0c1e434c2678a17130b9dc817f', 'Blu-Edition'),
('./nfo/rep/30d9e8206e095bca2b86808124215b24c328c179.nfo', 'f9d3949a2107d4ec13b36e5695e11195ecb67499', 'Blu-Edition'),
('./nfo/rep/710dbd120f8400a9d2dc5a483c1bf1a89313770e.nfo', '23e66bbbb6580dad650409c317452700bac28c74', 'Blu-Edition'),
('./nfo/rep/32e0d7bf89ad92fc83dc95f3fce4a5255a3c5e37.nfo', 'daa764e5bbc734cb4b04f73c53ea8fed21f4b4f8', 'Blu-Edition'),
('./nfo/rep/f888730c82b56ff41084c3c3aab8bdcaf352c1e2.nfo', '08c779212d55c4f4e5a7742cc9b10ce2f5d8ac77', 'Blu-Edition'),
('./nfo/rep/5d15a6f0f9e2df4da56f58b08f927f31ddd4c9ab.nfo', '44a4880a1622ba3d0554e5f5a771fc1b8e85e4b8', 'Blu-Edition'),
('./nfo/rep/e4308481e1b8217e45d9b44b65ab2bba80efacdd.nfo', 'be8b86c5c211208e768624c3238b2542b034e3aa', 'Blu-Edition'),
('./nfo/rep/d7777acc3a71d750914f150c39fb36420bf4824c.nfo', '14b9be75ffc14983792c04cbb2963074c7fab9e0', 'Blu-Edition'),
('./nfo/rep/c7e675b459bfc58b7757217bf46c5cd8621edc21.nfo', '25d1688256daaa17da6f31634302d2270184ff92', 'Blu-Edition'),
('./nfo/rep/aafb16a905aa55c64be4446ba364c09cda1c9d3b.nfo', 'eac6c64268f88a9bfc32696efa039bdc7fca7a2d', 'Blu-Edition'),
('./nfo/rep/1b06bb003343202ac26e9a3c0a016f3a71f88419.nfo', '675bb7f19989b746605e43f2bfcef45485c6c74d', 'Blu-Edition'),
('./nfo/rep/b38cc1f89bf1702299cf7fb451c432a90907533f.nfo', '67f05745208c3a75c5cb54b26b51ecbd406621e7', 'Blu-Edition'),
('./nfo/rep/1c8e6000f1901100087fb4e78b30e9951cae04c8.nfo', 'd19c0a988769660113397f7f0d657fafd9a78b34', 'Blu-Edition'),
('./nfo/rep/b6a203db8d3a98319dad05e91a959bfa7c027d17.nfo', '891f41d71b0793a7fd6a83ae250a285ac1bb0d67', 'Blu-Edition'),
('./nfo/rep/6cb4e375dd4d6ac7ac8b22fcee39c497ac6c43fd.nfo', '507fc8e2804002bac38775ab889dfee197c0e50a', 'Blu-Edition'),
('./nfo/rep/4c9eb92fccf4b142b37b304d80e01b186943bf8c.nfo', '99e280f2780cb95c77bdf0af7986be879077b3ee', 'Blu-Edition'),
('./nfo/rep/af66b9c5aa7688ebbf3d9becb034a62cb2ca753e.nfo', '6445d01cb311e15c25a67785c5129eb63850cb71', 'Blu-Edition'),
('./nfo/rep/5e2cbe93abb98843f43305e038f97894c10c9082.nfo', '06e13a812c15055a79f25bd1f463d39b44065fcf', 'Blu-Edition'),
('./nfo/rep/8926b62e1fd0d17480c6f577ce63898635fcb331.nfo', 'db6f6f05b1cd0b27ecac0132a1df256421f9c0e3', 'Blu-Edition'),
('./nfo/rep/5ee685d4df8ce20d7968b4b2dac5d62a210524ff.nfo', '4f6d602d6617cfdbfe33223b3b13fb12810161ad', 'Blu-Edition'),
('./nfo/rep/1ef218637ded0d3d8af83a563b09144ab83fcb06.nfo', '8c081e460e699e3bf58aef001f387aff831d986c', 'Blu-Edition'),
('./nfo/rep/355381a77c996dcf68724da6db7e1a0a02c07778.nfo', '01c8de164f00c876056d6be007e66cdcffa6f9e0', 'Blu-Edition'),
('./nfo/rep/c327e67e5331b4e2f4f958b751b0fb4d2ee9d68f.nfo', 'd296c94f9f5b015339ed26934c3cf5ac795cbf3b', 'Blu-Edition'),
('./nfo/rep/db063091f5dfba6a18a5f838500500313afc166b.nfo', '4b649ef3d956de947eaf5be18e9ed13c1f1587e0', 'Blu-Edition'),
('./nfo/rep/268c7aef12b531e0aac1f3df1bfee0667760c524.nfo', 'c4e6bed8e4d4b3d65ac68d80c16e37d95e3978fd', 'Blu-Edition'),
('./nfo/rep/450507d9e9b34e4db5eed774e2b1b4ff9e704c55.nfo', 'c8d20019cb683bec190a85c420b0e2c98a1e3def', 'Blu-Edition'),
('./nfo/rep/d9a181f54c2fedee58f14852144fef97cd6a9198.nfo', '2b68b4daae9219091c128592f187f876194d33c2', 'Blu-Edition'),
('./nfo/rep/5e4904af090bf75617afb6628783947edb2dc3b8.nfo', '2b75a5418f264bfb865748ff80775d46d9bc45f8', 'Blu-Edition'),
('./nfo/rep/60acefe0fc51d03bb3b9d03c2f4c502da6994d03.nfo', 'a8240365cb75d6b2428a8762f0dbfec5e9fd7a5a', 'Blu-Edition'),
('./nfo/rep/6ffa905feea498a0c6f3ddf043b7d19a696b90c5.nfo', 'f0e302259548b782f2c3a4a26e1f1ead6a03d270', 'Blu-Edition'),
('./nfo/rep/dd37e25d2d3e3d9c933b8f12fd9d7b3ec6aecf1f.nfo', '99b17e133d74af4d6d43421059a6bab41396f5ed', 'Blu-Edition'),
('./nfo/rep/6d4f2639d7cae3003a47ff7af4151e05745fb7a7.nfo', 'd22407c3014476ee687ca1aa09a2f809ae1152b0', 'Blu-Edition'),
('./nfo/rep/ca00c7f2da3011e78ef23722f2a93741beda685f.nfo', 'ad804ac620a86362c068c5d0bab25a9a9d197086', 'Blu-Edition'),
('./nfo/rep/060e449ab06316720c70610bd2047b47a6d6f5ed.nfo', '53acf1c3e5d4665cb77d77638316d1917f641228', 'Blu-Edition'),
('./nfo/rep/2d58fd25b667a4574a865de5e4c764d0602ce98f.nfo', 'cd7143674069d93a5633333ef7fffdc881fcb16e', 'Blu-Edition'),
('./nfo/rep/ea1bcc2a43389197fe82fdf0f92bc13c28bb1632.nfo', 'd5abfabed4e66bb18976ade685880661e44ffb18', 'Blu-Edition'),
('./nfo/rep/548a8ae13a96127cb678cd8ee0acf800164cc22b.nfo', 'c7daaf4e654d036b159c878aa1ac78be5dfe4696', 'Blu-Edition'),
('./nfo/rep/51b0a115ddaca06c59c38c98625568c9a84aa67c.nfo', '0bdda15fa5a0a21a8e8b9f40593a4a90a7e23eba', 'Blu-Edition'),
('./nfo/rep/4d1c3f9cd4b432047ece2c69f0fe08c2ea3cf609.nfo', '26efa856d4cfa397df4c9e2e89f56a0c14d7af4e', 'Blu-Edition'),
('./nfo/rep/9be8ab52127ce15199d63dfdb65bc594a3660146.nfo', 'c84e056208d42d659e5627367945ecbe11bf09da', 'Blu-Edition'),
('./nfo/rep/8e0a617bbda30bb4c6007d7ca049d9b825daa0e2.nfo', 'bd4726e61c428948d334fba7b91c927e72743185', 'Blu-Edition'),
('./nfo/rep/ac3572d005d74775faf493138b6dfad41946873b.nfo', '86f71975cba7b7d00a57d2cde3a59a2d53761cd0', 'Blu-Edition'),
('./nfo/rep/528604706e57eb80d8bcde2f975be4c39508f527.nfo', '2081780bbfae1a061a2bf2bc6eff023b0931ca87', 'Blu-Edition'),
('./nfo/rep/7655a764d8190d04001774d646eed3076742c557.nfo', '17180155c6211295edeb680eb1c135332ae3a415', 'Blu-Edition'),
('./nfo/rep/53a241b26eb0ee8910bf2e9838014890c52ce5c7.nfo', '9aabb454518b5b01f2606df05106606b826abb60', 'Blu-Edition'),
('./nfo/rep/9647f189f11cf758ba600e360ce6eee3820773b3.nfo', '9f125f4779a1065567974ad2afed32016f5609cd', 'Blu-Edition'),
('./nfo/rep/60de05823718546bb3a2ff68af58fead179de72d.nfo', '552772c0ee2a193700034583eb69db24a24cc8f0', 'Blu-Edition'),
('./nfo/rep/2e18e7711ac99f8640a0f80a3c5864c5e34bd866.nfo', '66d904853178f80cb3b405c87a0734120e532cc8', 'Blu-Edition'),
('./nfo/rep/c82445243101112b7940d9c7b68b06f35656b462.nfo', '5eec210e4e0835ae67b29b5a7ad36e7ac64cf723', 'Blu-Edition'),
('./nfo/rep/af6337f9516be138204d674eaa7a51ef8d5ed300.nfo', '268f24ee2081dd20182340706cf94d7bfeb7d558', 'Blu-Edition'),
('./nfo/rep/44ac1694170a710cb302bb76264324757dc30e56.nfo', '904409ff70afa460593f845be418c7d4393f16a3', 'Blu-Edition'),
('./nfo/rep/b0167d3ba7ec9eb9379ed2a044da15a1ea1a69aa.nfo', 'e01cf0b750046b836e04e0122c22c0e72bd75e40', 'Blu-Edition'),
('./nfo/rep/0c02c75ab3ff3e54191bf13602556cce17ab399b.nfo', 'a235feea4909144a96609e759e821539fa854710', 'Blu-Edition'),
('./nfo/rep/61f0b691b22ba13b875542cb5c8e930f2c2cf9e1.nfo', 'e6e33e3451c161ee3e63221758674c37440ce5d0', 'Blu-Edition'),
('./nfo/rep/d0096c1424b411871503421e06aa21adc2d7522b.nfo', '77f18abfc28bb23877335bc693323435a00b9ee2', 'Blu-Edition'),
('./nfo/rep/0817ffc6e711ac900611f1ee0ef50d092f80dfc8.nfo', '387207ea1ce1700aa1697a01a8a9205d5ec158fe', 'Blu-Edition'),
('./nfo/rep/4bf4423fc94b9c260ff11ec47b78241683cf02d0.nfo', 'af1d8f575b29237e9cd0fb7f38229f22534e02fa', 'Blu-Edition'),
('./nfo/rep/315e2cb5e508965419c9e5103561204fa5afb269.nfo', '489aee8ceb04accdfb5eee3c4da54db255a497a9', 'Blu-Edition'),
('./nfo/rep/536bb252866b506a5957f2ada7aa9c4ef3545122.nfo', '2b8848797ca6481aea8ed27b024f0e4631b24406', 'Blu-Edition'),
('./nfo/rep/b4d8738b7ce68884b701e4ea949bbcfe9f1e2274.nfo', 'b891f494eaae1867634f22902a86dffc813aaf83', 'Blu-Edition'),
('./nfo/rep/7b8ef35c5032cc10069f60a83944f496030e02e5.nfo', '2b9154c73b7baa3084f7c8b11efeb073ff596eec', 'Blu-Edition'),
('./nfo/rep/5980999165ed51b01466d2f799bf248fa1330ab2.nfo', '7280ebf3d4d7b9f40a9951680f2fef6cb9959e6d', 'Blu-Edition'),
('./nfo/rep/3ef482057e02f136973199bbcf58ea0492025c15.nfo', '6aebf80d27a97de94e24d2e937fecaf838923db4', 'Blu-Edition'),
('./nfo/rep/37190f034a24e74a9d83e59fed62f7afb8f2a181.nfo', 'ac218493eb18a35147e6cbb6351be0801529fec4', 'Blu-Edition'),
('./nfo/rep/dbb7c57ac9cc7946e1d25ff47850fb110681a02f.nfo', '1da45e2456a0816b5f996884e0ae2693f0277acf', 'Blu-Edition'),
('./nfo/rep/66c90c8bcdff1072d89d979b3ada748356a75f04.nfo', 'f3af9d2a8a784636942be911ab6fd1023615049c', 'Blu-Edition'),
('./nfo/rep/f3aec9d56514a013dbbeb6120b97c3868205b6ea.nfo', '8a4433ae603868c76180cfde39c3d99eb25cd18c', 'Blu-Edition'),
('./nfo/rep/04749c9fbc2015797bc9ed33c90e5ac1caac53ce.nfo', 'e4e865f4124d7622db296f4a3be3b6f31660e503', 'Blu-Edition'),
('./nfo/rep/1e65cdcdbba46d56635d10bfd889155b4b36a762.nfo', '3a29a1291654af3eaa4b615127a1b2e625bcff9e', 'Blu-Edition'),
('./nfo/rep/fe777319a3d109f11f7efafbf4a8b5fc103a5ca3.nfo', 'c6c557a648d62d45f7568c7dc836d25b7a72c24a', 'Blu-Edition'),
('./nfo/rep/f9f974b3f7223ff6755d546e23430d53a10bcbc9.nfo', 'ed12607fbac010c8dbbaab7e39d8c4112a8e1cad', 'Blu-Edition'),
('./nfo/rep/a325830bb21ead63e977e82c5b8ed3b66d6d1f27.nfo', '62a5b9f2c0b1db907fcb9d91f41b03d10231dacd', 'Blu-Edition'),
('./nfo/rep/bb06535d8a12e9c717df7b5e72d516ee1e467d72.nfo', '71a98bc64da79ecaf96e44e9be986ee3100e23b3', 'Blu-Edition'),
('./nfo/rep/62f5e0543a92002bb3b50510c7e6574dce2bc5f7.nfo', '92318407fdf494ab0977903c5945c34aa19c32fa', 'Blu-Edition'),
('./nfo/rep/3744eb03f35ef7bad8c8b9cb37f4d160e92902ed.nfo', '05f9c7c1f2cb9804380e323fadc61e60ee16e1ad', 'Blu-Edition'),
('./nfo/rep/a02f469bb7160a6028629b8a9f1cc1daf2d50233.nfo', 'de4d7b8a9f56cef186cfe3e8f7997654880ed951', 'Blu-Edition'),
('./nfo/rep/48c925ffa5214afa7367c04c265c853e918e627e.nfo', '03e9f1000d8edc6d9c33adb162fe80865ce59b43', 'Blu-Edition'),
('./nfo/rep/62fd66e55206743f21a2faaef22fa9365cd3c260.nfo', '0129cf65c1f17bb9f90aeb1157b915066699002e', 'Blu-Edition'),
('./nfo/rep/54493dfcff0d74e5818020cf2d0abb5505b984a4.nfo', 'c87f10c742a3d13930112d7315d3cc3abc45d3b3', 'Blu-Edition'),
('./nfo/rep/a17378c4fd2f6b9f9d7ade15237e0c70af32ed40.nfo', '4a2e582e2271eb22d9f5773f0c78777f51a147e8', 'Blu-Edition'),
('./nfo/rep/ad0f5ee3829ac869b9f51e415dddabd285b4e92b.nfo', 'ada359458eb903341523ca31231abbda607d8123', 'Blu-Edition'),
('./nfo/rep/5ace00fb05db3550b8e72c7b102c699ebfd0719b.nfo', '8166d905ea81c8adc166d26f9ba837e2a769f660', 'Blu-Edition'),
('./nfo/rep/a5cb697168168f9fba3ed4ca01d9bd663b44bba8.nfo', 'f33da6360b5dbd69526c0afc3b00dee832a1faf8', 'Blu-Edition'),
('./nfo/rep/ad7beef0279c059f447870529a3aae108adb3b4c.nfo', '69d234c3aa4f7a0cf8b4c66bcafb2245f54afe02', 'Blu-Edition'),
('./nfo/rep/688c4c6b2a2965bab1ca8feb10ea6b429f01a39d.nfo', 'c2d029b1f90ce9656b2254cf2a8d0e04084088d1', 'Blu-Edition'),
('./nfo/rep/02bfdcc16727590af25d87fd415af5c3237f5fe2.nfo', 'bcbee74685167a8b5e0663ed954721ef70d22c32', 'Blu-Edition'),
('./nfo/rep/a4cf50b06bc6bbc76ccccb6bea580806f72c27bb.nfo', '366d57e4fb9ad2ad3bc2904c92ff0f6b64abde26', 'Blu-Edition'),
('./nfo/rep/81af813eb19fbcbdb2bc2485cba096ed42836b86.nfo', '33555b28fd54d0f0e72c7c1b960888f8f30f933f', 'Blu-Edition'),
('./nfo/rep/71d4aa6e3899996ee37d5702c82e492c85075299.nfo', 'f0b0b32799e46d2dc7b3bc41416be2e7fda43169', 'Blu-Edition'),
('./nfo/rep/8e8c679ae1b8a6d8b79aec175d3befed1332d555.nfo', 'f4b8dd616c4a0de271064659f0716aa5a30bcc28', 'Blu-Edition'),
('./nfo/rep/f58fdc62dea675cfffd1cbf715ae6ed88e87fd52.nfo', 'e0a1cc1f9767944cd963d06f56b8ffb9b0fb0ce6', 'Blu-Edition'),
('./nfo/rep/080a58b65f05af1fbcd2686b810e6f29df6ca9bd.nfo', 'd78a85d0955285f36e33d0ff5f9b54491bf646fb', 'Blu-Edition'),
('./nfo/rep/853b75ecbee2cfc33ff0ab11327e3e5466fd5400.nfo', 'eb175a30970e134c6923e03bc931566557365614', 'Blu-Edition'),
('./nfo/rep/cb01d5d85779b226d22a8b07d2b95f33cc790e9e.nfo', '2cffed1199f698e557634b0725cc78b1243b73d9', 'Blu-Edition'),
('./nfo/rep/dbd0b756c05b987de4cb266ada2dbedb25dda03e.nfo', '4fa7087f193c58b34a498b555513fd689a686e0e', 'Blu-Edition'),
('./nfo/rep/d4cc16312cb3528eaddd4d8e7c5c71581675bad3.nfo', '70d61801523835c38e2ee9979dc247daf3fc857c', 'Blu-Edition'),
('./nfo/rep/3e6e72d2658cf152653d93f8d98e1748b5310363.nfo', '813cfe4a1aa989edb92366d5c6324c77e9f58fc5', 'Blu-Edition'),
('./nfo/rep/2634dce1d0335a0ab514226775501c4453bc936f.nfo', '683e4fcdecc3cfef88833f2bb25d99f65dfb1bc2', 'Blu-Edition'),
('./nfo/rep/7d4cfa75c7360cc831996a921bd2be93924b3063.nfo', '838634f056651b871519660f78d2023be9441af1', 'Blu-Edition'),
('./nfo/rep/ed56dd336b1e900c0a102dc6901b17fb8839fa04.nfo', 'ef9eedb158119cd8f46a1fe4f592fc6d50a36244', 'Blu-Edition'),
('./nfo/rep/d65f0f594d4dbd478766794ae29cd329b2470557.nfo', 'dc56a36637646baacc8c382aec57c81250382af2', 'Blu-Edition'),
('./nfo/rep/28d9339d0a724b147c87f143233a22f49d39c524.nfo', 'a1eba7c3cac685a8e04bde5660aed46846c58092', 'Blu-Edition'),
('./nfo/rep/bd3e70c24bdb93386d8daed9e109850db561c5f3.nfo', '95130308aa8e5e30b790b79c97400d99c004e69e', 'Blu-Edition'),
('./nfo/rep/b95badf9001d85c765b8270cf7dfe63d987ecf35.nfo', '21e7fcef3d58dfd182914e861dbf20966ed383b5', 'Blu-Edition'),
('./nfo/rep/e91873876cfd2bf3ed61f53b5b915be2080f9b62.nfo', '6cc2a71ac52408dad637defcac754829e08fcf5a', 'Blu-Edition'),
('./nfo/rep/7f9610a9697f1110d7be19d9777cfb665ec5c0dd.nfo', 'f36ebe7516b8d5508be47d02f893832a0d459cd7', 'Blu-Edition'),
('./nfo/rep/84b63f619231a74cd6cdb1041ad22c058ca671fa.nfo', '545d7076873dcb5ff23831f7c7a5d0318cb5da36', 'Blu-Edition'),
('./nfo/rep/6b215e0d20d1f7b0f9a0be4deb4cd18f2da456a4.nfo', '8d8cc1736cbccc0cbcebd276aaa7bdd4f578b857', 'Blu-Edition'),
('./nfo/rep/1c219a7071fe8b4eb9ae8830baaca5a41e694c8f.nfo', '0e4d12d48cc4626eebd97c750148b216a2b74dba', 'Blu-Edition'),
('./nfo/rep/afc9ecce8312770cea7ea7549abe6066eb1eef8a.nfo', 'c11609d11c224c6739a16831379f58c03a3516d9', 'Blu-Edition'),
('./nfo/rep/7bc1157df65c61375a9ad1d73bddbc2e7550b013.nfo', '5ec942cbd1f12cd7454de46d5d2dac04d0085304', 'Blu-Edition'),
('./nfo/rep/21167355c756bdf2dd7643fc0711e169b697d35a.nfo', '4e5d54721fb9a39571fa1feb56ae99c33b3fa3b6', 'Blu-Edition'),
('./nfo/rep/dddab10f8235b2acda30ad36f67bb470ebda8bc2.nfo', 'fb8e336dae4147d6f0305527928d86463781d716', 'Blu-Edition'),
('./nfo/rep/1f12799c69f529a05e4d0422a2b6d9fe7e03475c.nfo', '7bb6413abe842d5967d55f9930f567dd55543dcc', 'Blu-Edition'),
('./nfo/rep/413733f61be1f94172ebbfe9d1b35ce137b90457.nfo', '05c9871775fecdfe2828a185442af986cd45c892', 'Blu-Edition'),
('./nfo/rep/8cbd45895828849ebefb5cff1211788d984610de.nfo', '5b6509d700ad610cdeb6df14aa5139eaa8c3fb59', 'Blu-Edition'),
('./nfo/rep/95150ea67b7791a2c86d160a8ffbc62682ddb528.nfo', '74780b8a331f6649595baa6d27d9cca2df6559b1', 'Blu-Edition'),
('./nfo/rep/be964e655fd59bb3ab5d989f80918ecbe3443316.nfo', '8b2bc2e06f13ef66a388ea80abeb5cf1498c22a3', 'Blu-Edition'),
('./nfo/rep/d858c905eb47083a08310930745ba924fbccc6a9.nfo', 'f5b20ff0a43c73fcc95c8c913ac21bda4fc97ed4', 'Blu-Edition'),
('./nfo/rep/72c4361b76b35bc96bff9490eb6a44aded376d47.nfo', '8cc77fbae05b23cb4937dcc21d1f8a7adc3df990', 'Blu-Edition'),
('./nfo/rep/00a9e4b8c280624493f07b8aade5fab597f0f3e3.nfo', '92aa904d378a2062ab2499fc2a32efa6a06d056b', 'Blu-Edition'),
('./nfo/rep/deb162b2e7eb55f118d2772200f9a055f17dc69e.nfo', '2fe9ff32ad6a1af48fbb3515b31a97d8ca4ca079', 'Blu-Edition'),
('./nfo/rep/f942b335fb3bd925422d24d659b7797eb5114c7d.nfo', '0358af625f171ea37d119c016e71d8d618abaf72', 'Blu-Edition'),
('./nfo/rep/1ead0c4d9f5e90292d35ed54c8d368dc8f187097.nfo', '79bd9f46a20fd32435eb6bafa29461e7be0d4c64', 'Blu-Edition'),
('./nfo/rep/f3d975d29568a36dafb44a8b241448810583b599.nfo', '3b5fabce356e44b15863779d48323200df6c7c5f', 'Blu-Edition'),
('./nfo/rep/75367ed0951ed380f21cccbeaacb747936ba272f.nfo', '3962d79a0ede9d6ba6c4de747761ffb76288f8de', 'Blu-Edition'),
('./nfo/rep/b45aed5bec44210ba06405203ece1d5db1002964.nfo', 'dece80ba974ababdc03a2b0f376932645faab003', 'Blu-Edition'),
('./nfo/rep/c1548b6bf6a47c0f9db0159faad5307dbe9f7ed2.nfo', '3716ffd887b389aa44556f4a698ad304923f8a51', 'Blu-Edition'),
('./nfo/rep/dd083c2ff934fc6980f9d06f869265f96bdd25f7.nfo', 'd7af155ccf589ad08a694347a8050533034f4480', 'Blu-Edition'),
('./nfo/rep/2311d970fed0a25215e85a329d1c15792fe059cc.nfo', '38408e255a2e70b8858ce0c2225dfb44f3bf18bf', 'Blu-Edition'),
('./nfo/rep/5389f18171ec49d208ff4b862bb30f5d02e4485f.nfo', '5787c52cdfe66c00e0ce162cf948622d1bab7d22', 'Blu-Edition'),
('./nfo/rep/5b09c612de2e3aa6fcf255f962b95ac6f63e1d5d.nfo', '4459a723653569be929d7da6ec1f88206b9edd67', 'Blu-Edition'),
('./nfo/rep/1b16cdf9b1a40d990ffd96bfc810c38c99d1cc3b.nfo', '4dfd757fedc1b889c36590cbb9b5df150c9ad970', 'Blu-Edition'),
('./nfo/rep/fbdab60c4e2228dcf820fe9fb79d3738015a9237.nfo', 'd649f06124f4b9b89c1a6f8fc6e02056ba3ef0e1', 'Blu-Edition'),
('./nfo/rep/ef7bcfcdefb6a2798354bc803b7b07b39414e3f2.nfo', '341558f02a3a53db97cdf1e6fa7074a81c082ff7', 'Blu-Edition'),
('./nfo/rep/4ff8db246654ff8fbd42ce94c2a085d6984455e1.nfo', '858a88cfd53f318fffd291bb7d9fbee0a5f4d550', 'Blu-Edition'),
('./nfo/rep/1c9d2d40d0d8384cc6708babf0ac74556490e1a4.nfo', '5df48e34e899ee6fedaabab1c9554d96911406cd', 'Blu-Edition'),
('./nfo/rep/9a5a15ce5320df863fdc65b799246570c4413971.nfo', '2d0987f4121a567f15e074dba6114bf9a498cb6b', 'Blu-Edition'),
('./nfo/rep/a57a941eb8833ca4af9c5581dba6026363f99f00.nfo', 'ef01f8aeeb98b133a6968e5642f05a4f724fc659', 'Blu-Edition'),
('./nfo/rep/7a4ca5c3b4d00b429c4c94d44ba0374a20773bd3.nfo', '0bc372e04ea9b42b01a700820484797e546f992f', 'Blu-Edition'),
('./nfo/rep/94cdd5e6475e99fda550d7d8d36923b4ba7c079e.nfo', 'e17c743adbe5a32b7ff188f90504d7d2fdc4f0a0', 'Blu-Edition'),
('./nfo/rep/6f917df25989fd0486416e6d31f685f83c96ce51.nfo', 'e75d7aa0876f57b017224c8a59b814fed9ae7498', 'Blu-Edition'),
('./nfo/rep/b91fb0c8e209d5578497ea19398fc05e4fca9818.nfo', 'b9e03f1029576e80a9c9b3ac20d423281930c57e', 'Blu-Edition'),
('./nfo/rep/34b1bfa12cbcfe5802a80aabbaaf0befd2fba21a.nfo', '64468e3e619b76dee3ffa6794f5ab6768b68a4b0', 'Blu-Edition'),
('./nfo/rep/9012920b604bfebc31f966393a697f4f467283b8.nfo', '60a56c4b8e1bb7f3a7136f06cb26ee9238163060', 'Blu-Edition'),
('./nfo/rep/8cd17cf98ef88289156b327f0bb33540c0682ef3.nfo', '541851956108ba9c89f0c7ec977603dc45ed41d2', 'Blu-Edition'),
('./nfo/rep/aad42c81b0fb8b109f93c053402d065d0c5f94c1.nfo', 'f6c0091f51a509efda34cada3cd01c24c85256be', 'Blu-Edition'),
('./nfo/rep/005fb63f5513cabc9379172402eadd55581e0529.nfo', '7abfb328cf96d464a89db8423ae7ae70450c7dc9', 'Blu-Edition'),
('./nfo/rep/1913c09550e5f1a3bac968f33da19b4a0e9ba573.nfo', 'b04bcb175cd28fcd2da0a185f7e5e78ffabe2dc5', 'Blu-Edition'),
('./nfo/rep/a7a4ef4ea7cf2e239f7e0a71e9be68a916878875.nfo', '9f144cb1704a854c89ea8611cb67420599eacacf', 'Blu-Edition'),
('./nfo/rep/f32842ca84f929c567d7f874766abd9ae826c0f3.nfo', '3b1a8b4bcccdd7763aa59db1fb6cc789a3029514', 'Blu-Edition'),
('./nfo/rep/3df77ef1ca19f60ed57363a4fa097e5d492712c5.nfo', '38c14993372c0aa2fb59e575f2df6c8b6992ae5b', 'Blu-Edition'),
('./nfo/rep/7b9cb838dd72662275d782a2ee88cc62c60ef0d0.nfo', 'eca0d298672abc4ea25c9b17011ce8788bb13bfa', 'Blu-Edition'),
('./nfo/rep/452c19c58a404cdb8d3cb143e27a72140fb58fc3.nfo', '9b59edad97e647bcdce58c9d52db004963ac277c', 'Blu-Edition'),
('./nfo/rep/16389b2bdd2c2d14c5dac40f2e9168e5eab3f888.nfo', '1534b0c159e68f7b6ec1bbe408bdf6f3e4dba73f', 'Blu-Edition'),
('./nfo/rep/4b67c4498839931cdead1cc3c454dd4806a5a414.nfo', 'fa24b110e9fe41319a1797c78856cc17df971a19', 'Blu-Edition'),
('./nfo/rep/8efd9451e5e4433d9e643e0af0e4b353e2017f26.nfo', 'f17289fa032eec6b11f83177977e7c94d1311f67', 'Blu-Edition'),
('./nfo/rep/2ce8f93003c905d67ee2e198955e07f275e6c4cd.nfo', '50d6af1480225caee1cb0fea5c88b2a098c597f4', 'Blu-Edition'),
('./nfo/rep/8e53a7c9e58b94ecc80ada2f9d2c15a48ef29d45.nfo', 'dfc82473e45a2c8d45d492d7f741f04fbf36da2a', 'Blu-Edition'),
('./nfo/rep/6fa92aab1f437877bcf9973bdd15b3fe6fe8da9a.nfo', '101684faff2d36f522c8196bead49c0580ec3753', 'Blu-Edition'),
('./nfo/rep/9ad42b4ad264f7922199f0a177ae0350bdc77a48.nfo', 'c42af94d353bafcaa88f99b9db232fd049152b7c', 'Blu-Edition'),
('./nfo/rep/f6f9488fc5c1d2c6b79bf3187f2da4c1c5baedbf.nfo', 'da0e9f453f04a59232a23b8efb547d43eaed5987', 'Blu-Edition'),
('./nfo/rep/16689481f958113013e9be552df9cf9ae51ee295.nfo', '1f8b4f3f670521293df646fbabba0abadf1a5d8c', 'Blu-Edition'),
('./nfo/rep/d72b0391b91ff337fa1a6c3badd295e527b39469.nfo', 'b22bddb99c24fbc4668ceb6306c6b12bd3f84239', 'Blu-Edition'),
('./nfo/rep/f67f124a1a32010c5756295abb31fb02e7369eda.nfo', '417870e28b7a0b7c83a3795d9eb02ade378286ef', 'Blu-Edition'),
('./nfo/rep/836c25b20b83c3d6cefac45ad45fc16a4633a2c3.nfo', '3a63e65668949a921069906a11f123265affb2dd', 'Blu-Edition'),
('./nfo/rep/38a5c6fb01fc583646fe50635769bfea6ebbc2c0.nfo', '9abb2aeb4938101673c80591b52cc6ff1d51eab6', 'Blu-Edition'),
('./nfo/rep/e6fe0363427ed7336a958cdd66859ab8deff46d9.nfo', 'f8052e5e853e22676d44bf454ad5c60b4d4bdc50', 'Blu-Edition'),
('./nfo/rep/56ffbfe764b9bbccb3d04a1b178ec50d5e55d10d.nfo', '54d4aec6dc4d094859f1366b8dff694ce8228535', 'Blu-Edition'),
('./nfo/rep/f55f9630e71df8bd032b84dcd5a5b3ae7749ca4b.nfo', 'c58b95e73e7f0d7febcf9724ff58412b3a204bea', 'Blu-Edition'),
('./nfo/rep/84f44e885afa7378ff5e296d078c3fe15465f384.nfo', 'fc82d8efc6632f81bbf1237a6435f09932863843', 'Blu-Edition'),
('./nfo/rep/8d36d153e2f95e81f36c476414e3694ba252c706.nfo', '3a7344c0814e29d5f51b1d46d3cc70ec5817f2d9', 'Blu-Edition'),
('./nfo/rep/51a4bb720921f4a0c2be7e1a4cab273765e02422.nfo', 'c553b41af29eb5dddd831933c4a2a4a68571d54a', 'Blu-Edition'),
('./nfo/rep/71405cc8529724cb5f1f9447f4300d118c301527.nfo', '0869560994b10fcd72d1f048e62657d6fadf8161', 'Blu-Edition'),
('./nfo/rep/0474400374852531db84e9106f377a01e9dfdd85.nfo', 'feaac5415ca6365f7b43031633a69da5ba3e4aed', 'Blu-Edition'),
('./nfo/rep/1cbd610101f051b1dfc131b84d1d1dc4e0400deb.nfo', 'af8fa8d29e78d1526250041ab987f39af57d3d75', 'Blu-Edition'),
('./nfo/rep/aac50f56e01aa1948266fa9ba20d5d357c34b13e.nfo', '62956e96a82191e164e958d2c1ea92774bafa404', 'Blu-Edition'),
('./nfo/rep/3c5d8aaee27a6525f230ecd54c88158175d4c58b.nfo', 'dd98c8d8696b15375923de56772d12884a1dd936', 'Blu-Edition'),
('./nfo/rep/7143daa06788ea4355eaa10f8d236e2694e3453f.nfo', '305e5ffe8b80a399e75f97a8a1e919a078a8b6dc', 'Blu-Edition'),
('./nfo/rep/72e9354d970823ed1837c9233d3fe6ccb781fdd3.nfo', '3e029e45df5465f4f911c91c334de8b906cf5e2d', 'Blu-Edition'),
('./nfo/rep/23cadda485e8d462f78a6425eafe7feeb0f1555f.nfo', 'cdf5326d766b42b6b9f38a7bc68ecffcbb565d30', 'Blu-Edition'),
('./nfo/rep/95e8dfd7da5ab8003cd158c49c9fcaeb029d74d0.nfo', '90e6edf75233bb5a6cda1ee44e0efe0774f04404', 'Blu-Edition'),
('./nfo/rep/eee35ebb1e4435042a30a6ad222eab6bbc7c17c3.nfo', '49bf6bcc743b0070eb39e8ee8cbdb5c2f52d0175', 'Blu-Edition'),
('./nfo/rep/ed4cbec18c7e82c64ff75148090cfded5e74efa6.nfo', '9a5570f4d5025df776432425cc6b7dcb5a2691d9', 'Blu-Edition'),
('./nfo/rep/index.php', 'bb9f3d87b88fbcd262d457863f07561aa87a6f2d', 'Blu-Edition'),
('./nfo/rep/21d0253c77d8fc889d8608e455f825273972721d.nfo', 'd5566a89fdfd3cfe066852a80c137225f8783068', 'Blu-Edition'),
('./nfo/rep/5d1c23505051ab111f40ccb9891dfe7c5613cf23.nfo', '803b13806942b92102e0da8db6d273e231707882', 'Blu-Edition'),
('./nfo/rep/3ad964c9f6b8d5a6be2793e0a9cc3018a48c3fd4.nfo', 'de7a035b22c167d12a9becf72369f4b407831de4', 'Blu-Edition'),
('./nfo/rep/c8c2173e531b6e39e5993671446e2b9f2d4bfa65.nfo', '1d671e8d49fbd93d4f7808cdbf63d4caf685ea64', 'Blu-Edition'),
('./nfo/rep/1f3b6e38eb4be110e5d14e3fed54c80c762ee237.nfo', '56496112df526705874099c09e6839503555d35f', 'Blu-Edition'),
('./nfo/rep/89345b3a9e2d13bc2c58c9806e3346b83b02ccf5.nfo', '446247eb2c80b8d7780778131026e8abdd66b3a3', 'Blu-Edition'),
('./nfo/rep/8e296504e3c91d0a9c43d402fde89a5560f47c36.nfo', '73c5c67ac38f4349a7f5c350a017c0cf15257016', 'Blu-Edition'),
('./nfo/rep/df2a79723f9c0de7fc809079d5da67e532cccbf5.nfo', 'e0e12e3d621f22cc881588eacbb11096a7499dc6', 'Blu-Edition'),
('./nfo/rep/ff35c3ac2ea1c039a97312e01acf650d71287439.nfo', 'e650b2ce592545c8353115afca2da8fb70136916', 'Blu-Edition'),
('./nfo/rep/8b08187cc8ba4a26e692cef73ea3628820061174.nfo', '84ca61c7f92bd09329382be6f8bafeac639dfb03', 'Blu-Edition'),
('./nfo/rep/3d5bfd9e5fce542ca046beaf168010890a144572.nfo', '53d2605e5b3a19d1dcbd4c332d129dde3d54eb5a', 'Blu-Edition'),
('./nfo/rep/7abe0628ccabd5f8ea8a516b17a5024210465115.nfo', '7eac30796dcd4a6fbdcc8393093e7a14a9b5afa0', 'Blu-Edition'),
('./nfo/rep/a0bea75b67394a7cc8ef93d9f1ee62d51ba1be8c.nfo', '9dfe68866253e34f6087bec69da40d4fec8f68a8', 'Blu-Edition'),
('./nfo/rep/23f78aebf3be2a1046ba7336757af594e613174d.nfo', 'c9a91bad2aa9a88571a34b2f2e5fe98c15b44b53', 'Blu-Edition'),
('./nfo/rep/b26a171b600bd4c2b2f2c6c53c204665699d3084.nfo', '224379a37548e5e2a4b0d9a5a9af28a2b80a5013', 'Blu-Edition'),
('./nfo/rep/059b4b35b7fe37d9ffd9c9694772a937ca6e3bfc.nfo', '3ea3b5f4fab30e9de9f811f43834657a48108cbc', 'Blu-Edition'),
('./nfo/rep/10179f8309fa39dafe6f6284693d27b718865ada.nfo', 'f7fdb39069a202b47c7875762516468b40c529b6', 'Blu-Edition'),
('./nfo/rep/950932b639af724abbab6a5d5617de2e0549c981.nfo', 'ff8add9750f38d6ef3d8c13290fd557639c4a40d', 'Blu-Edition'),
('./nfo/rep/8f94eec7d386809226e1d61c989723e20d6e3cfe.nfo', 'b9880ae8303337dfd6bf2211f1b9471a62c051db', 'Blu-Edition'),
('./nfo/rep/05226455e338805740def41e0bbdf7049594452e.nfo', '59bec2dd2c887da9278ae12383b83fe0288e7c7c', 'Blu-Edition'),
('./nfo/rep/1e4f80e9ed5dcb9cec1f8724e5f454af5dc8eb8e.nfo', '4e913534c14312a02f29bd9365e53e2cc80f2f47', 'Blu-Edition'),
('./nfo/rep/671450f2a72fbc6d38ae08f1c7beaba5dad1c90b.nfo', 'f1c4d69f2bce86f8668d98a31dac7c98abdb24fd', 'Blu-Edition'),
('./nfo/rep/b8b6402e8ab5918d2f4b006889c39c0dba089956.nfo', 'a780ea4ca6d0333cd75507464e9b0be1f0f26105', 'Blu-Edition'),
('./nfo/rep/470e057ec98832d3a2b203da32050253d0ea0751.nfo', 'e0ffd1eeff0bc4ae9f3c5c0190186bde3d49387b', 'Blu-Edition'),
('./nfo/rep/3d92bc6424e5ff0f7757774d58b7c1b5a9217c73.nfo', 'e6812b29495aecb71865ef69df94edb911ce9d21', 'Blu-Edition'),
('./nfo/rep/c0f50467cec4a1580b79f917c9b83ef4de8e3d63.nfo', '198880dba274d283325a5b80e7a600eef01ee046', 'Blu-Edition'),
('./nfo/rep/4b62f9f9a4c099b18b7be51369da307d99d49b6e.nfo', '937b6d790c704457d5638fa1613cfa82d22c23ea', 'Blu-Edition'),
('./nfo/rep/166dccdea5e420d1efeb0bb0f25276ff0f651fff.nfo', 'ef07a58e4e21b9ad9665708fb6d37d1bd88957d3', 'Blu-Edition'),
('./nfo/rep/f02a9a7b9be96c7b28813d180bfed574903da9c8.nfo', '77e32ddcb3dc338705634725d3b9d429ea8609b2', 'Blu-Edition'),
('./nfo/rep/bc505fa2bcd42aebe397c400184f682f74223a61.nfo', '9c9f501229dde774b33f1c5c6b1d14cd90c0caa8', 'Blu-Edition'),
('./nfo/rep/bba666e8d5fceff87f3b2df3828ef1184594a99f.nfo', 'fd749bbccdf48dc0b98c694e6ddb76471eaef96b', 'Blu-Edition'),
('./nfo/rep/70f5ac43d17038b543dfd2e997ae2fa9b867f12d.nfo', 'f76e637a321450b2c4b230338da837a6ed8f2181', 'Blu-Edition'),
('./nfo/rep/e1785efa1abad4a36e803681bf81ba1cd2b377f5.nfo', '6df89f2bb2f4f7155e6845d064be80b521f465d5', 'Blu-Edition'),
('./nfo/rep/0ceb4320b8976e552af854dd172b541f7ad7156b.nfo', '1099331fa4f11c86d549c2bf03e813c974c33dd3', 'Blu-Edition'),
('./nfo/rep/b962bca00833c8c03b8bb08f07921f5b2af05200.nfo', 'ef77c8087076d9bda9ed99fa7254d39245602522', 'Blu-Edition'),
('./nfo/rep/6e7236762907470adddabfaa2fdd87a3e33e04d3.nfo', '409201524c4f252833b9787af7ebb013a75ab722', 'Blu-Edition'),
('./nfo/rep/b90dcbb6ea6ce815967bc4c60b8559dd1cec3117.nfo', '8dd4ffed03c6c2ab0bc14268de2869ed213d96d2', 'Blu-Edition'),
('./nfo/rep/aec4c74689a51cd07a10e320c213679b2c693651.nfo', '8aa3038b7465667c86f921dac65cdf3de8a53f7c', 'Blu-Edition'),
('./nfo/rep/b345e4bc7cd83813b285e349ed331abfb3ea52c8.nfo', 'ccd187beab4744d87f01dadefbbbfca6f3135be2', 'Blu-Edition'),
('./nfo/rep/d5fddfaa5ef344b3ed98bc86990ea6a0fd2a019c.nfo', 'bb2d5929f6254c0675631ecc92c4d3e9c85f529b', 'Blu-Edition'),
('./nfo/rep/7b5249911b01eaf46ac7dd60ebc803cdc5fe77d4.nfo', '363d317515beab9ad3aa225fa4fa9a72f43f2e80', 'Blu-Edition'),
('./nfo/rep/83ddd71262b2e767f71ec31f877fdf93f429775f.nfo', '3c69adf4e440a6044845d0691f23073717688fb4', 'Blu-Edition'),
('./nfo/rep/9119f7b8decd581bd9cf746827f14fda6af7237a.nfo', '698e79dfe38e206ec8c98626abfe106b68ab3928', 'Blu-Edition'),
('./nfo/rep/6a30131b06f9bb3c8d12339a18c4d8b65c10b9c1.nfo', '6516a556a79eb486a9b3fb68e37bd4df0519730b', 'Blu-Edition'),
('./nfo/rep/b456f8753091ba69184441818ce9d7a342020b17.nfo', '12dd577f7c50db7f1fa8c5c9f6e08ab5228cd363', 'Blu-Edition'),
('./nfo/rep/7358bc786d87fbf3fb1a0973a2dcb79196599308.nfo', '7cef468abae9fa68cb56bc2c60fe3b0ec3fb20e9', 'Blu-Edition'),
('./nfo/rep/f357732b4264eac3ea0d6d45146281d230e16edb.nfo', '99bacf684d507eaca5f5fcfc3b5c10fd85c6a34c', 'Blu-Edition'),
('./nfo/rep/e37d7c22c426fe10d2f26d4d01be0b03d8850e2e.nfo', '9511033ab443729553192f5545c6e1991be18a46', 'Blu-Edition'),
('./nfo/rep/673b6295fa07a7e7e902fb34b30b516074d98961.nfo', 'ec2455b6ce98194d4020aea4db167b90ec89673d', 'Blu-Edition'),
('./nfo/rep/87ddb691c06b6feda04563fc0c893fd6082c8897.nfo', '2dd6333260b189ce38515dfd2ca5307618a0f3c3', 'Blu-Edition'),
('./nfo/rep/a9d153d2be8803dc327cdb3bbd57c9a442422cd7.nfo', '5cb7c326f4922c22ad2a6bd7961e876392805567', 'Blu-Edition'),
('./nfo/rep/5fc84f347adce17a615de1d8a37a244630f69e40.nfo', '1084fe2ecda8c147c48ba662aacb7895968c4a1e', 'Blu-Edition'),
('./nfo/rep/b8f163ce0c895fbc07f5a872fbf89edb43bf7417.nfo', '7f3690d63cbffc3c8ec26f381dc14f3c7a69efe9', 'Blu-Edition'),
('./nfo/rep/d57c3fdd6a0200938f43b81271ef782684f2d9ea.nfo', '69867c9e179bec0877289f02ccfc0aca080ff07c', 'Blu-Edition'),
('./nfo/rep/c3fc5ff92d76541028b898ad50ab970d3a2ad54b.nfo', 'd4f1030c914ef98372820bfdf460d025f2ed5aec', 'Blu-Edition'),
('./nfo/rep/aa846a458c0384f853193cd3b870a8a7248ae6c1.nfo', 'bf3a52912ba4b42e8335b7ac57032eb1cee40b57', 'Blu-Edition'),
('./nfo/rep/24021625cce69388289730e904792dc98ac61a6c.nfo', '17de6f2885b6d88a79e7d50af2a49a900276e431', 'Blu-Edition'),
('./nfo/rep/7218ca156c635c3d3790073a7bc5aa1ceac9ead8.nfo', 'b63784a874e49653e6662936ada9843648b28ecf', 'Blu-Edition'),
('./nfo/rep/4707d665903d98df4ff2dcc23a2369c361f6b13e.nfo', '2f51af698fa5ec4db3b2f518e627491178090fe7', 'Blu-Edition'),
('./nfo/rep/9e18ed80575922cec2074666898f6349ef351a6c.nfo', '36c683666757f4c50e4dfdbe711b56911b1b74c8', 'Blu-Edition'),
('./nfo/rep/730d84a09306f65e0ee7ee0fd85170b553239c7e.nfo', '4338a7d044057373e455d4904857950cd90252b1', 'Blu-Edition'),
('./nfo/rep/156b954478c5ed0db0c601e47aa39e37c6165218.nfo', '5ccde3b35378d66f19dc10429ae99541a76574f0', 'Blu-Edition'),
('./nfo/rep/46e6ab532eae494ea22afccaf22426bafe4ab993.nfo', 'd7c271f1c98f465fc9b57bbd7c066f14f0362306', 'Blu-Edition'),
('./nfo/rep/f1055b908343967ccda189b4580108d4d2d4f356.nfo', 'cc12ec799040baa398465bf7a5d51fccfd02eb44', 'Blu-Edition'),
('./nfo/rep/c7cd9240df64ed91b680dc97a73b4391c2a156d7.nfo', '49187817b2ba4e664ac62f2324e33bb9a6c8338b', 'Blu-Edition'),
('./nfo/rep/7fd1853395e73d9b3f36618459b459fea455c1e6.nfo', '89bfb42940e383e21fe90787592e0cab5ef7bcbe', 'Blu-Edition'),
('./nfo/rep/dd2030933665769b411ab67fff5d4d4d835a0d8b.nfo', '4837be52c8baa101526ba141f1aa919cbc34699e', 'Blu-Edition'),
('./nfo/rep/92fb959414f380b27de5e98e653ab7f500780a97.nfo', '6c88e6f7c7d4bd6b96204f65c388242130be6a0c', 'Blu-Edition'),
('./nfo/rep/8c1d44d361ac5e9a53c6dc6e46d12aac50f034de.nfo', 'e4f1ab77cbd39f27b3a1b722f406749f47c2bcb2', 'Blu-Edition'),
('./nfo/rep/d0df7d3548f60cae6c8e3ecb5deef21964f5f316.nfo', 'b87aad4ee98cbeb1a8a7f55b2cab2d94764f803b', 'Blu-Edition'),
('./nfo/rep/8e3785b9fb89a1fbd0ac59f85a30cfa2d7be4a39.nfo', '99bd33daf8f899a7dfa9a6b6526f9ae971882fec', 'Blu-Edition'),
('./nfo/rep/db2b37e3e31e0a5cf714657856967cd7ab4a43eb.nfo', 'cf1f07f28db1064c47edd189304fa3f7ea84ba86', 'Blu-Edition'),
('./nfo/rep/e0f871bb67407eb72adf64d948c6e987506cbc34.nfo', '09f403a8d00b8fa6d49664c458d366912c1e20c6', 'Blu-Edition'),
('./nfo/rep/16247f6873080b3dff91e88fdf1fc2819b0d2686.nfo', '9a2f89efadaf713914d7e41fb716eb3713197907', 'Blu-Edition'),
('./nfo/rep/a009310f3e2ea14c76ab628c369b89f1f8c2a590.nfo', '739ac02c9ca7e25837f68d2e2d8887f755a38484', 'Blu-Edition'),
('./nfo/rep/950ba74fd9abbefb2fff301f6df0debf94bffd91.nfo', 'e9895019da734cc8c2d1d4ee4895e3ab3b7e643d', 'Blu-Edition'),
('./nfo/rep/1ea4177e8c80591f321b31e399e8acb8ef018162.nfo', 'b147e41155a75a5ab352632f3d75e285f78d856f', 'Blu-Edition'),
('./nfo/rep/0d996243e59cdb19adc42011e0e2312a8090068f.nfo', '4a5af4a89eb0f6f1f544d00d66d0c9969165fc66', 'Blu-Edition'),
('./nfo/rep/dacb097fe5ff48d000d32f561159545a6a990cef.nfo', 'd2c50482ccabb57eb551f18d6af3f50bad897f19', 'Blu-Edition'),
('./nfo/rep/02582e356cd06e8131d468d59fe838ccfc436b96.nfo', 'c3f354b4fe11b34f017691435667bbeb9db9da6c', 'Blu-Edition'),
('./nfo/rep/219f55fe9ba04e95e597275fddf0cda6b80ec49d.nfo', '6c48cf488c70c5418f44a7441eca95357179cdd6', 'Blu-Edition'),
('./nfo/rep/0618138468a3c6e768eaadeed8a7df97274419ec.nfo', '0f4966bd893a9aff11994bd4d1e607b1dee7dca5', 'Blu-Edition'),
('./nfo/rep/a9c1f8e0183728bc4f902bbb9eeb8add3b491d69.nfo', '05103cc79a2a3340c0f0505e8cf700d068a1babb', 'Blu-Edition'),
('./nfo/rep/843b348f86036add176ac759a019769dab1ed385.nfo', 'fbb94a15a1ba1f739f02200a64cfb99c069a0af3', 'Blu-Edition'),
('./nfo/rep/162d64cb7f818df81d459174d0714b02282e5056.nfo', '5c6ab3c3ccd09654171b4c1b10cc78fb82bdb647', 'Blu-Edition'),
('./nfo/rep/61ced85effb472c0c7c3954bbb56bf7010c9de3b.nfo', '37b9135ec3feb0ee687693abb0ee1b3605031418', 'Blu-Edition'),
('./nfo/rep/d753ef618b8da05dc7e1190847ddc611ba09c7d4.nfo', 'bd179004076fb3bc488b7c8cf40574ced58dcbd5', 'Blu-Edition'),
('./nfo/rep/1c7192015952f1c66a00a2aa5d16b0778bf6177d.nfo', '34bcb2affff6cefada2c24741f387cb0f037ee26', 'Blu-Edition'),
('./nfo/rep/9a5584181d0731242b854ef431459ed6ec1bcfbf.nfo', 'fc35eacb00cde369e312c31ccc132835307cd0ea', 'Blu-Edition'),
('./nfo/rep/cdfdff21493c48d515c8ac12422d65b9990c64e1.nfo', '97e7101ebfa2dc2ba6dc453755177a9392a0d1e4', 'Blu-Edition'),
('./nfo/rep/f6d43afa3f43e78aaa799021ee3421ac8da0670e.nfo', '38a76e512aade765e42946be429351a1f9847806', 'Blu-Edition'),
('./nfo/rep/5a1c2a4da258df12c03592e7b11f84675c09ee3c.nfo', '7c79dc0c835c88427d73879b7b3f6f0f8f2beb48', 'Blu-Edition'),
('./nfo/rep/35415ac756900f12c18dba85bf52ecb9fdd19bc9.nfo', '19ac960a4117d8c641f7505104f1bde4b6f7986e', 'Blu-Edition'),
('./nfo/rep/f3d0a876a1023901bc736d4ff4e15b75c1200674.nfo', '947cc594b91fe76f38fb504ab03be20dc9138936', 'Blu-Edition'),
('./nfo/rep/6928d102040d70a6d5a42881ba52a5bd366717af.nfo', '4d911849bc04c561c8c24ffc6a35e9f26849c734', 'Blu-Edition'),
('./nfo/rep/9a1ea6a0c78f657e6398903ca186df5b4ab3bfb8.nfo', '518756094d9ce8abd9570f7f7532223873efaab3', 'Blu-Edition'),
('./nfo/rep/750e99a7c4f304e0d80145a100cf0e3e895ee291.nfo', '041dd3d02903ddb7fc3ff14b286e3b33ec2da6d9', 'Blu-Edition'),
('./nfo/rep/d2d9083d16ef8f586862a0b9fcd5b5b997cd328f.nfo', 'dafaeb40b6c9e399c0da5f6c5a4f76ae8dce30de', 'Blu-Edition'),
('./nfo/rep/8fac703d08abc1709bc3d995a4c79f907c99becc.nfo', 'd382d1f783ddf60fca4826567de11e45ad00cc53', 'Blu-Edition'),
('./nfo/rep/867da6d0626d965b9393f54ca572b25a0ca24b30.nfo', '9ced8d1cd93173bbc9e590385aca8417d819a610', 'Blu-Edition'),
('./nfo/rep/e5c2670de9a7beb30134bf7e44db48f69c7c1bcd.nfo', '0bffa854250d6672e6c197e4f042999423d28246', 'Blu-Edition'),
('./nfo/rep/fd5e880d73d3de408973e76b3cdce76097938c75.nfo', '13cf19cc48e42020957157587eedb3bf84b8661c', 'Blu-Edition'),
('./nfo/rep/02c17b073abd86a175e3cabf547ca301301ddc76.nfo', '7206e949828dc1dd3bf0ae4c0ba017ba6947ec29', 'Blu-Edition'),
('./nfo/rep/b5cf44a4d90acd8b53ea65f4978d3d37fddb341a.nfo', 'a59846ae2be154f334af874162e09bb1b10df377', 'Blu-Edition'),
('./nfo/rep/49e127510006023f3ec21d2ba1ff003cda45d55a.nfo', 'ff234eb314e3e6dd0e1fd539b47a43b371182134', 'Blu-Edition'),
('./nfo/rep/f5a264040a90fe335d2539ae8741082d95fc9e10.nfo', 'ba984000fd5f42022d6a653895c23b8dec360074', 'Blu-Edition'),
('./nfo/rep/a347916a042e738c66bab7a802b02ad67a7ffe3f.nfo', '98f60d9203131bcb466c3c4bc06b5cd1f8d893e2', 'Blu-Edition'),
('./nfo/rep/ff2a3b3ceed972af4d3310d0a5c5c4fa53135a28.nfo', 'ca9e8ee8f3d395c017b025681f6c1dcba7b5d5b8', 'Blu-Edition'),
('./nfo/rep/7b8488ff7a85195669dbb1c05b0c4acdbdbe64a8.nfo', '77705e29bcbd782c9bcadaa1df6180685071a76c', 'Blu-Edition'),
('./nfo/rep/8bd49d4809681d0613f54c00cf94daf9572e8603.nfo', '29105c4d41bd6417ceec62cd9ef5ad8bfc0a9162', 'Blu-Edition'),
('./nfo/rep/1a6336ae3dcf02a0b722637673a3d1d7c9863898.nfo', '3c981d2cf397f0b007a86ddfa59d21a70c095170', 'Blu-Edition'),
('./nfo/rep/5af8d77e315fd693ce597ac03483f867a5999dae.nfo', 'ec9e9952eea16b6b40e1390e1101cb0e9313e86a', 'Blu-Edition'),
('./nfo/rep/aa636a1e19ede15efd157eb4f2ff0987eb5f633f.nfo', '8305d958f719ba10c3f712cf47055068f0287743', 'Blu-Edition'),
('./nfo/rep/1d5eecc398bb42e8fc2bb8c2361f861ab54f07d8.nfo', '3ae667daa103226069665c35d75b96c3f1dd39a3', 'Blu-Edition'),
('./nfo/rep/acb93b6f472a10ab9175122431d650a8cc23f180.nfo', '96962901c1850e4c88d6d9bd8dce508d3ae51237', 'Blu-Edition'),
('./nfo/rep/6fbbe6491b04c27c0839641323c0c024c583e121.nfo', 'eab2ab6c4cb393476440fcf7a1d1e5d9bdf12702', 'Blu-Edition'),
('./nfo/rep/7bcec003d35f6e74d765524ef5a39dc125f5db0d.nfo', '6f5766a281b1e329c25bca93cbb17b8077b7508d', 'Blu-Edition'),
('./nfo/rep/b93fcef85048d33cffdfd19f87207d4110bf1424.nfo', 'c891ced711f74b42dd8d8eae5d68c9caf4f965a5', 'Blu-Edition'),
('./nfo/rep/c00f3f6d1a86e9ea847f330d8f3b119406d6e755.nfo', '3d4c523f0221ffb5f714d0b29d53fe9ab51d5bc7', 'Blu-Edition'),
('./nfo/rep/978c3c8773253e740e59be41506edbc77ae16ba8.nfo', 'bfddb1a8c50d7100ac8657ac173b11220305ca8b', 'Blu-Edition'),
('./nfo/rep/6b49f2375c3d94307c5e0d74d395f2587f810732.nfo', '5fbe776d6f4d4bc72654b441ed26b2ffab0b4989', 'Blu-Edition'),
('./nfo/rep/518568421c5eebcd78a6102056b5719f9289995b.nfo', 'e707ccf1c12c94298ee976d6b9edd82d123b65cd', 'Blu-Edition'),
('./nfo/rep/ce97eab149593a963206249d02f65394f3ab16e5.nfo', '2d1bc65b1d56329bfd31b4055c3ad72be9d6d41d', 'Blu-Edition'),
('./nfo/rep/739e280dddec212bc6ac40a199aec295f96eba9f.nfo', '230cc21988c06e588fd5fb0a254ef36c0b736b96', 'Blu-Edition'),
('./nfo/rep/bfb7d8abdb66deceb84954f9d6e736526d298d88.nfo', 'c1ce536c499aa9223eab03f8d0128a9cf45d8611', 'Blu-Edition'),
('./nfo/rep/f7a85d285673b412d7984140754503fb87e5a399.nfo', '4997fe9a4064a4fde1f22a5b89288afb21d28fe8', 'Blu-Edition'),
('./nfo/rep/19cfbf0ea698a501ab359eac6efaa64bdc35ab75.nfo', '7cc67ba653713b400f7887dd683f300714020564', 'Blu-Edition'),
('./nfo/rep/42f16a34089f5e24202f506444501273aba43ec4.nfo', 'd30194e5c3601475f9772ef1b3d8ddb223ab8af3', 'Blu-Edition'),
('./nfo/rep/115a6ffca44c1cf6b5b1e4c9d117626d0fbf6f23.nfo', '06bc34c225aebeb3a0c244adc19cef19efded2ad', 'Blu-Edition'),
('./nfo/rep/685e58fbea36e46f6761baef9b2a66655579d3d9.nfo', '7adcfab40206beecd0a17fccbe8b6fcdf873d195', 'Blu-Edition'),
('./nfo/rep/369888616f56707c59717548087e3bd119220a5d.nfo', '56785ea3a7f36488d071481217b6db8c6c9e19c1', 'Blu-Edition'),
('./nfo/rep/50435e138471f4496e63d691102ec069510e45f2.nfo', 'd15197f374d2d86fc1f301784b0a938e09b5ed2e', 'Blu-Edition'),
('./nfo/rep/84bf0e879cf5705bcd8f33821e807906d143de68.nfo', 'dcfd9690ccc76b3754f16f2d89402eebb4ddd9ad', 'Blu-Edition'),
('./nfo/rep/b810f4febed4bf56f486cdc3c1bf5ecc4eb4ee35.nfo', 'f005df0f3ce7fede66631f2d58971dbf9200bf5d', 'Blu-Edition'),
('./nfo/rep/f2de4123baa1ea235c0f98501bb079d90e4f1963.nfo', '96cf9b934dc2de93b33b6a57b2d8be259d8d57b0', 'Blu-Edition'),
('./nfo/rep/e7a583b8800dd6a72e1f12544eb35230bd9d7e4e.nfo', '2998e1a8b1377e8f5378ce77a172562d86abd218', 'Blu-Edition'),
('./nfo/rep/0e1ef50a197196a3f62d6489cbf41e665daa309f.nfo', '3011d5d0555faf1c4707adef323a734132dacd1b', 'Blu-Edition'),
('./nfo/rep/bf1a0953f6e20446cc2afcd8fcfdbe4d6585839c.nfo', '8e19f0c0a5b2a3a2cf380ae88d5763be3d3bcd13', 'Blu-Edition'),
('./nfo/rep/f40d167657c1b946932e6109f5683af946a2ca90.nfo', 'b6f0817dc98e0b8f87c481b98dc731ae3769a1f3', 'Blu-Edition'),
('./nfo/rep/999fd83a2b8d4f22dbe0f1982944ad0f1d4e5aaa.nfo', 'c1faffb88db4d38b7cd113f746adc586b72cf35b', 'Blu-Edition'),
('./nfo/rep/23833096ee4be11be54cc9094c73aa68e271d191.nfo', '9a9050d8bcc662803e5ed1a8b332c6042a50a62b', 'Blu-Edition'),
('./nfo/rep/861c78bee84b56edff9124997c7249420753ad5f.nfo', '4d2480ad398f845865e8dc5ba0393a3baba9e428', 'Blu-Edition'),
('./nfo/rep/52c2d209ec5753a62f4a5e72ad4b3d43db3a3266.nfo', '77b70403a1a18bfd1330b9b706c2e18fec5135c9', 'Blu-Edition'),
('./nfo/rep/5fe09bd3ab2eccb91362c7048d4ad7a98f4c6d92.nfo', '0803b1c1ea809276f469470471e20d033bda76bb', 'Blu-Edition'),
('./nfo/rep/5d6483a4ccf35f915c0e95d794a4ad9581858881.nfo', '6ae3fee7d4632bdc0b5209f3586eae2bfabbef1a', 'Blu-Edition'),
('./nfo/rep/9a7b47a4dea21f8749a162550b0ed40348e82a9d.nfo', '0a4d6daeafc473e661f404c978b6efad9f1b692d', 'Blu-Edition'),
('./nfo/rep/b559b4d8a7db7e679929137050d9f652c8c2f427.nfo', 'a3ff0a4968e95f159ce33e6f848e46646da22c91', 'Blu-Edition'),
('./nfo/rep/4625a11d18dff793b46fae0294f20f44cd9cac17.nfo', '32d7d01706be03c10d8b8d977199f3d083ffbbcc', 'Blu-Edition'),
('./nfo/rep/496ee35b5a7f838840e8269e8a4760b3afef95cd.nfo', '455bbc4cee3185462c8acbb9f0938bbb9b48ef94', 'Blu-Edition'),
('./nfo/rep/ecde7c976ccfba8ae6534150e42e0816c88005ee.nfo', 'eed5b5df69fadc9084275e98b9b5fc8aefe11529', 'Blu-Edition'),
('./nfo/rep/142257b83aec4427e539f286765b87e9c7b9ceb4.nfo', '57b61ea1fe26529428da0ee7a010e7b82ac9dcf1', 'Blu-Edition'),
('./nfo/rep/4266d66c7d703d037705ffa8dc7ed42e81f00cf0.nfo', 'd0f10f789ea9d8a22309533c8c1369cbc649b925', 'Blu-Edition'),
('./nfo/rep/be58a56081695ce0ae4032eaacf686c307d55e72.nfo', '6e7bf8e604e60cb12092c311c5f58f2eaa5e863a', 'Blu-Edition'),
('./nfo/rep/575e5d05b39398cb57ccff3b7edd56af3776026a.nfo', '1b34bdd65b63b561d98ca89cd3337c1b1a1164aa', 'Blu-Edition'),
('./nfo/rep/58d305d57758026f9f54073da3ccb9ef8d7ee08e.nfo', 'da95eebfaa661a37577e1f8ed9ecae335efa2acf', 'Blu-Edition'),
('./nfo/rep/ef8100768a2b65bdf02e47185776635bed48bc56.nfo', 'af5cabb900a76cb7833f12207d603b6d5d52741e', 'Blu-Edition'),
('./nfo/rep/66ddecc4d06209940faa851f6dd490e322bbf0e4.nfo', 'd446d4346fdcceed1e69fb7404243f93c6cef07f', 'Blu-Edition'),
('./nfo/rep/d249d1e210cf24d52e1b88d6688236e67c678377.nfo', 'a1041bf4bda14f2783a7ff658ba343405809187c', 'Blu-Edition'),
('./nfo/rep/3638e32b7049b487ebc6ff2902ba894f2011a14e.nfo', 'bc04b4ae408e39aa305589a235af6deb6df39a03', 'Blu-Edition'),
('./nfo/rep/8fcc359a5d4bcab666c094019ded9238b62e96e4.nfo', '734baffd549b6ca3e3f88028d59895102152992f', 'Blu-Edition'),
('./nfo/rep/dedff945140a7c5df27b53fcd8058847baee2c89.nfo', 'e2813715e7f8cf7522c8a911f301809f2fb04d47', 'Blu-Edition'),
('./nfo/rep/f04a66c7aa7b97f66829f08ecc6587b9bbac53af.nfo', '82c9980323982f1ad6e428822012f5c13c37bd41', 'Blu-Edition'),
('./nfo/rep/469a139a2b327e21ee5c8aa5e4ad2326359946be.nfo', 'a84e0fdd92849a29bd0d097a6c11f8d181241d8b', 'Blu-Edition'),
('./nfo/rep/9b236ee383b13cb147f85dbd8ecd117797c0ec31.nfo', 'a8420a7adfead67a173d9d4c11998ce94464278c', 'Blu-Edition'),
('./nfo/rep/43595846a864b95e63b888f00600f90e0e193e2b.nfo', '912b9aeb2d73e7cc5db8e9fb72f1467475e28aa5', 'Blu-Edition'),
('./nfo/rep/97bd977f707a3afce4d10dba421cec6fdfe87096.nfo', 'bbe8e2bd1ab423649c4a3a7e124e68aa9c4dff31', 'Blu-Edition'),
('./nfo/rep/c2891832527f2a63b744533c8b2e87cd05f97aca.nfo', 'bfae1709c984dbb491664eca0fff6f1489ed1713', 'Blu-Edition'),
('./nfo/rep/b217981f0a1019769fa2838966d22e9f9db5f1a9.nfo', 'a86e799310fc912ea348a6237e6d410cd8d0285b', 'Blu-Edition'),
('./nfo/rep/5da1fbc52c5f517f7109225032eb6448ff184f94.nfo', 'd03853bf4896be8ef3ebcca357d6d216b29865ee', 'Blu-Edition'),
('./nfo/rep/ccfe1ae02838520563e5589a94be76aa0291c579.nfo', '0b6e4a713721a236c3ead1085e62ab23ebf9126d', 'Blu-Edition'),
('./nfo/rep/c690d88fd8bf9659010a9e2ab9e477ec7ac0a5bb.nfo', '59fe4c3582b925b5faab66464fd3871976621772', 'Blu-Edition'),
('./nfo/rep/ca87300cd98300e8b90be1c52cc6b1eb7365c499.nfo', 'c7f01552871097b5284865abf7d1b0f1285bde3f', 'Blu-Edition'),
('./nfo/rep/f7827c8363dedf78d8161bf83e67a0d9795c646b.nfo', '3acd7d850247b64c29f2507693fb76059dbb1e92', 'Blu-Edition'),
('./nfo/rep/f1dec0a53371758321fcd7edfc618ba078790cc7.nfo', '77866c5928844031ede1c36b65aa758470687ed6', 'Blu-Edition'),
('./nfo/rep/0af4658e423a1c0610b6890c29b2d5fc8b8aac8d.nfo', 'cd3e0eca8bd737afc808337201df71ddb7e22995', 'Blu-Edition'),
('./nfo/rep/320fa5cae44508b6d21dff59446d01c0f1145821.nfo', 'f332fbba645aeafaa1a8df975138dbfa0262800e', 'Blu-Edition'),
('./nfo/rep/ad767e4a210cbaf21a6d7f7acd0e4754f45fada2.nfo', '9f5c451e459114c5344e2710d9704b830235a35d', 'Blu-Edition'),
('./nfo/rep/d859fcdc74fa5042b83ee73f1bb688d2e600cb39.nfo', 'ace40d9130f68283f5ac036e2b75d2435d68823c', 'Blu-Edition'),
('./nfo/rep/d0d5f1a6b287b104e3d966015d4acade1bdae28a.nfo', 'e86a19f69bd9d3f95487199f324274dd4902cadd', 'Blu-Edition'),
('./nfo/rep/cf0f8f5d6a1c4994597e116f80b4e9b7946a6d15.nfo', 'c729be6ff2a0e3cecd8049ada54bfcc79de3ecaa', 'Blu-Edition'),
('./nfo/rep/9dc0b861586d71b073fe08c584c3948c6ea6285f.nfo', 'eecd53f035a968edc5280c71e12e2a8ad6387dc4', 'Blu-Edition'),
('./nfo/rep/36676eb62d9b21a9bdacdfcd54a7bf53b93fae92.nfo', 'd155af671f5c20f22af9794a02fa5be31ad3483e', 'Blu-Edition'),
('./nfo/rep/8dde040690ae2c971a3420c34ee00dcfd140f297.nfo', '3bc35c5a85fca5e6e751c63a5ec33feafe03db19', 'Blu-Edition'),
('./nfo/rep/778f7631bdba9bcd4df3108376c74d4c8aeb09e1.nfo', '3ab7e3e32c8185c552b2360c83d9ee2e6d8a55c9', 'Blu-Edition'),
('./nfo/rep/4ca5d2ba06bfff3052dd0fb1964634c134f93233.nfo', '2c3eea29e79737129f16e3f45f5c47a14a0a06eb', 'Blu-Edition'),
('./nfo/rep/f26617d8df1cead5a0e0963b1b51e373309ee890.nfo', '9fc23a567f57f40d5ad15b376121bc85585d5559', 'Blu-Edition'),
('./nfo/rep/abcd8807c8cf222a32bf541f6f4008cb6cbe1ffc.nfo', '3f5204eff661673d29a3861922851c3aa527320b', 'Blu-Edition'),
('./nfo/rep/2a6652eb9a625cb835274353351c2522c44178a0.nfo', '786b52b60a661315a128808ddcaa66cca49ad446', 'Blu-Edition'),
('./nfo/rep/117329171e1aa81c1b22097f61ad42dd017b28f8.nfo', '8e1c9a03f3652a9c2fe78995320beabcf2f5233a', 'Blu-Edition'),
('./nfo/rep/ecdcb5d525f441821b125f077743ed7f9713c6df.nfo', '23c99499376c9949d7babac02b0701b8ca526c9d', 'Blu-Edition'),
('./nfo/rep/24060913ecf1d23e93e87dc293e2e6a3f5c20d38.nfo', '342518e6b4e1dd683ce1fba71b834bf8cb453286', 'Blu-Edition'),
('./nfo/rep/85f4ff034c956af8d2f5c198966ca4f21183ea1c.nfo', 'e7717fda501805631c5787e96d1c8b11cfc8ff8a', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./nfo/rep/698c6403afaaeece5e78a144276ff53884481937.nfo', '0509e5883d0bc7ca71be8bbebf5cd94bfc212286', 'Blu-Edition'),
('./nfo/rep/77a6d83626c324e59a6e8222a044db863be54afb.nfo', 'e2d5b68bd04a250731adff7482b068b98a266ee8', 'Blu-Edition'),
('./nfo/rep/7aa29b558d79da1fd7b98fcb377cc0bd5ad0dee9.nfo', 'a2a84bd382fc8201301cca425164889d26d8f533', 'Blu-Edition'),
('./nfo/rep/f2936b8efa7b7d256074c04fe4fa0f6d8f5b2833.nfo', 'e8548a11bb593abd4c8906e85e27b71cbac4f0d4', 'Blu-Edition'),
('./nfo/rep/9f5e8a6b8efaa7ee9a6750f62a5729263e08c32d.nfo', 'a30ed6acb5869935d7f58b7e12a308af41729763', 'Blu-Edition'),
('./nfo/rep/7310cfa7a827f176d943345d64724de076d9f0c8.nfo', '630237e00945d24d267652452c4da6975767118a', 'Blu-Edition'),
('./nfo/rep/c000a157e47a0ea80402c73ebd643203e5f23542.nfo', '243dc1f1c837bb3c4a75cecc8d9ed7be6fd2042e', 'Blu-Edition'),
('./nfo/rep/f92453160f3bc4322ee2f6e6f3f1e85a82ab71bf.nfo', 'b33cf383aad16b47ee0da38255755a715ab04410', 'Blu-Edition'),
('./nfo/rep/797d462cac3bafb1b18bead8b9c95840e6deb135.nfo', '8c9bbfbee7e2380a267510c7ea5e446fc78f36ed', 'Blu-Edition'),
('./nfo/rep/765e169aa0fdd6f28993aafdf3b525b5b5eb143c.nfo', '8ada63898b719256be2fd7377653338bc70301dd', 'Blu-Edition'),
('./nfo/rep/dc3f30d9fbd3bb6673b3a6a7b5bd0e156eb6b0fa.nfo', 'cb74427bf592e4b0b4df7e8904ffa997edf87599', 'Blu-Edition'),
('./nfo/rep/7e8b50eb9d1ec5e496a32611ecc63faaa9adc119.nfo', '8547b9a008027f8edd7240b2d3d8d812942927e0', 'Blu-Edition'),
('./nfo/rep/6e9fe3d5d5ac462b0c42bdd14474d4f2eddba75c.nfo', 'a239d702efa9060f558f7a5d8e18b330df76c6bf', 'Blu-Edition'),
('./nfo/rep/ac92bdafd871623810fc22f1d3424aa5c1b76419.nfo', '3a7ff6d1de6300fd5629b2086b4ced97e9d1be56', 'Blu-Edition'),
('./nfo/rep/7bc0dca5fbd224e3b30af2f72448bf7ac4905af5.nfo', '209afce367e8cb64a6696c2f532aa587a49d1a6e', 'Blu-Edition'),
('./nfo/rep/e90baaab89923ee48657e12937a1f82447f26600.nfo', '27da2bb170f140932ccd8805ed8373141e8fd47d', 'Blu-Edition'),
('./nfo/rep/a2a4d371dbbad3a9061aefb8234f4396a87ce91c.nfo', 'b1e755d6128c8147a1f42480f951efb325cfd0ba', 'Blu-Edition'),
('./nfo/rep/637077c2ce58e48fca7b6bf62bbbd999c8be525f.nfo', 'cb50c5b10166c31039d337d640eb83289aef110c', 'Blu-Edition'),
('./nfo/rep/6ac238bda99a7852821ce2cac9e2cfc831d62839.nfo', '226d3418ae651a46aaddf28c79821d5f8a927e55', 'Blu-Edition'),
('./nfo/rep/7d0a23e1e234d155534a21dfa68f6baba7bc7a21.nfo', '98f8a8ffe16f28e85e41a2ef5f7a2b9b47696897', 'Blu-Edition'),
('./nfo/rep/7ab25fa6627eebf117b0e147ab337dc3a03b0653.nfo', '89ef6c088c2d3013992e9035c3f4bfe94bc8bae3', 'Blu-Edition'),
('./nfo/rep/8178af1c235d4c88a306416909021291526d5115.nfo', '4d70ed0d14cf5d2c35eb6a58e331f786432b9698', 'Blu-Edition'),
('./nfo/rep/553824b29d6e73754d81db1e02a699c9d7c0e1a1.nfo', 'bd1f72a8ddc1900fd6d69dd51694653d161e276a', 'Blu-Edition'),
('./nfo/rep/94f362a7c2eade562bf92767a76b2b5bd39062f5.nfo', 'd7f562cb7afa7bc33015dfa149b53d8a3a3e21f9', 'Blu-Edition'),
('./nfo/rep/4777837747a7a82f48a574449e3c6b901eb787be.nfo', 'fca104caf8a81e399e540803bf6011653f2b7768', 'Blu-Edition'),
('./nfo/rep/9a905fa158ab74cd423c0ad721913689668030cc.nfo', '3e9aa8ff0d574b759cde844f09c71c234b15c91a', 'Blu-Edition'),
('./nfo/rep/86dcef5603cc5fc06c04c5367e1a21df7380d949.nfo', '893a700155eda3d2f19796ce288b03d3d17f5a71', 'Blu-Edition'),
('./nfo/rep/313cb15174fcafe195e0d86d8844181edc8632e3.nfo', '10a1a73b176b6831d64a72164afc75d113a5e483', 'Blu-Edition'),
('./nfo/rep/350d700a9b80fc4e5bc903ad3c1b0405d617e4d0.nfo', '24cdf9f02afd6a48879d3998c66ad614b4b4e6f5', 'Blu-Edition'),
('./nfo/rep/c0355420a26bd32279824cff77630bcf193900f0.nfo', '59a61aad424018c35a3f6821429600429717a9ba', 'Blu-Edition'),
('./nfo/rep/e4b8c5acaefac902b2a09681c8508e8c1c98c63b.nfo', 'b3e259acf173b8e8b3e50fb83acdb06d1cf23136', 'Blu-Edition'),
('./nfo/rep/59f85958323429546d5f1b1fc2bdb0257972e8e9.nfo', '90c8504842429eb8525f1d84bf98776b0bcc7e3c', 'Blu-Edition'),
('./nfo/rep/29b5c5a20574ab1d36db9bf1cc256e9908080b40.nfo', 'bfaaea00537033156696e521e3ad8670a6b4c4d5', 'Blu-Edition'),
('./nfo/rep/ce82f5440797f7a7bcf195102c44bd384c94174b.nfo', 'c5d96e4ceff5a597ea6e170767de57e626111c64', 'Blu-Edition'),
('./nfo/rep/f2f0c1d9b10ce5ec03622097304a0ca25dd86424.nfo', 'a8c39aa2d7909907f7da89be4aed6bf845ef0aa4', 'Blu-Edition'),
('./nfo/rep/1df5854de989204a6b5e43b3b50b943da1b1124d.nfo', 'af7e4b49c4af847438f222ad09c89df6761abaa1', 'Blu-Edition'),
('./nfo/rep/c45a73bf0f51e66e009e7fbe4e568b1f763bd115.nfo', '4ac6976a39a737e499984c5a1cc644599fed20fb', 'Blu-Edition'),
('./nfo/rep/8832025b5271387f1edbadbab149466835235024.nfo', 'd06fded11bbb5564d1511e436249c0d7d70a1aee', 'Blu-Edition'),
('./nfo/rep/f2cd005722b66062e5c6e99f349f2ab50276e409.nfo', '7613e8b013bc6fe7ae2fb1552a390eba8633edbc', 'Blu-Edition'),
('./nfo/rep/287f040862209187b118306240c08e0b6d114a37.nfo', 'b80e1b11792d59548460a796b105e4e3d950b943', 'Blu-Edition'),
('./nfo/rep/527df2251844bbdbbe8a69fe3f58ac71989f2bf8.nfo', 'af3cb46ecfe17eca9e8bd781f618bafa04f790de', 'Blu-Edition'),
('./nfo/rep/ce5dfaf3593ea230fb019ae4e23bd9d05a9e0bce.nfo', '445967768f378f3c06f87d7a211f6c2f616cec66', 'Blu-Edition'),
('./nfo/rep/8dbeb4efb2bad8efa613c138bdf0b943ae887f46.nfo', 'cefc5d6496f97b5269c2db1da94d4d42418494ab', 'Blu-Edition'),
('./nfo/rep/c233a372bc91bb06e9de39ad9b8f20c4e8efae25.nfo', '22fc297792fded541ad50090efef6361843ccf3a', 'Blu-Edition'),
('./nfo/rep/756800dd7ed25a1e57756f16ab4d0b1f7354760e.nfo', 'a5137dd916b438a4bbb4d0f478840d0ce93cf1cd', 'Blu-Edition'),
('./nfo/rep/b07b1fbaa2232cc18f8988da4994ec0351215ea0.nfo', 'c7e1878adba71313fb0a333fa5de91c833670e24', 'Blu-Edition'),
('./nfo/rep/78b7c51c5e1f1f59f52f8e176d01f87630f2d361.nfo', '41000ad506829af6d64c72fef78eb6494094f5cb', 'Blu-Edition'),
('./nfo/rep/4d2c8eb796ffa6bb5917085d2d94a82a5a22ea88.nfo', '43ef9c8f7d2dda49142fa500c29bfc0765c3dc55', 'Blu-Edition'),
('./nfo/rep/57b0b1e85cd49a84752f3bb6d9c66dc335f43cd7.nfo', '64189c837515581d53acd91b09708cf913fc1086', 'Blu-Edition'),
('./nfo/rep/04e1ea91a8a5baab2e8747c673ce58b076e51ec7.nfo', 'd37c1cc6cde9da81cae5fae2127c9cfb8ed91a66', 'Blu-Edition'),
('./nfo/rep/50c07f94bb7292d2dd4add149ac200423438e09d.nfo', 'b053fd67f5cc950f08772cf8e0b6387fedbab34d', 'Blu-Edition'),
('./nfo/rep/ef0f0f03d423dea667a44db2a833183b3e1e59a5.nfo', 'f62289da181486f797b9ae6b7f29810eaadf7c9d', 'Blu-Edition'),
('./nfo/rep/c3572eb3734afdc0a80b2e4840af476af5221dcb.nfo', 'b49ac360c2babb7e439f7447769023752a3637f6', 'Blu-Edition'),
('./nfo/rep/dadf83fcc355f542134d0e37f2fa3db9a46a572a.nfo', 'a81a70ae26af55cdbae3cf7f7aab7df11a2d77c1', 'Blu-Edition'),
('./nfo/rep/682945f8e7c2d136f4c1d9d20304fc4c3c016475.nfo', '7e8e68266ec113fcc00f493ecddcf71f684fda3b', 'Blu-Edition'),
('./nfo/rep/9542d876c71da89d526947cf4082eb68a42ca569.nfo', '70607e33becec668c90cc15a0cd3d3369df9319d', 'Blu-Edition'),
('./nfo/rep/5e6dd7adf5f64d75c78e84d39ad2e69f9458eb12.nfo', 'da599f02e86141dc921d023382a52d4a9349bf0e', 'Blu-Edition'),
('./nfo/rep/a32fd8158f0c309f827d95af3a8d694243c07c5b.nfo', '9f6274cab5432ef199811c62dfd5f8485b40bfeb', 'Blu-Edition'),
('./nfo/rep/7dde8c43b4f866fcc157b06a7b1ab7df15543212.nfo', '4a834cb2e0bf3adb06a7955863597b8d86d1e1f6', 'Blu-Edition'),
('./nfo/rep/c81346a65afcc50aaf47904366a92b85ed89d4ae.nfo', 'ce825a34e4f0915e507871d24284f241e5242eb7', 'Blu-Edition'),
('./nfo/rep/7ab5b7a40a29195fd70757a224ec0ef48ae40557.nfo', '39fe18bb009904aefd3dc3b9de77a808c01ac30d', 'Blu-Edition'),
('./nfo/rep/3cdb1c2c72b6c033e803e4153d15a971ac98f250.nfo', '424057f4f884771c7c626f87c838f658554b5c6f', 'Blu-Edition'),
('./nfo/rep/c2c9860a15f5090c047122c00bd61fa6da979743.nfo', 'c639d0aa4631568b55b18e123cdb5c53b0dcf375', 'Blu-Edition'),
('./nfo/rep/25105fae6d4ec590e47ed0c4defd24667a56503d.nfo', '3c8188d8eefa12ef99995d8f55728a4b806e18b2', 'Blu-Edition'),
('./nfo/rep/f704076d81a44fd50bfb5832ad9c9da498c1f954.nfo', '2293fba52b5c5c89d4c303a3edf54066627f1e2d', 'Blu-Edition'),
('./nfo/rep/dd7a8287b6e48ec91100f445be72c13f45aa9493.nfo', '4aaf312579bd5330426d1fa4f2dcd9cb61930cad', 'Blu-Edition'),
('./nfo/rep/35007bfaa98b753f80086cf1d03f246444ce52a0.nfo', 'e6055e58421020caed473e14080a95825caa6c00', 'Blu-Edition'),
('./nfo/rep/aea406705431a877cac54214671147f315c53bd2.nfo', '4f3033195a9234f2bcb4f25e1b4b34bb25438cda', 'Blu-Edition'),
('./nfo/rep/95b16bcbb334344460cfa46c45441b66c024d07a.nfo', '23cb62701f826200f1bfb636a0828dfae7137a20', 'Blu-Edition'),
('./nfo/rep/f7b37519a553737ba05ed6f63605d19615ee8fb3.nfo', '84b0beab7a0b861c7ca578098b8f8fa0925d0311', 'Blu-Edition'),
('./nfo/rep/4c6e42e9442afd925177008e5346088801e35b90.nfo', '01c5cc05ccc3842a27444ca517a8b81ed323688f', 'Blu-Edition'),
('./nfo/rep/8d096404091ea5b6dca4902857677ad647e2c8af.nfo', '51e9cd357e6af0c66c0e6ed70111b9b5f329e3df', 'Blu-Edition'),
('./nfo/rep/4ca84da3f7310cb5647943604fdc58219dae2879.nfo', '968f76f4c4e05810470c27ce5f7da1019a892036', 'Blu-Edition'),
('./nfo/rep/63cf54616eba79191704479aeae302ccaececd99.nfo', '6cb90539b3ecc481a65b1ad146f321595276dff1', 'Blu-Edition'),
('./nfo/rep/9c1eed4a882059f126a8b5cc17f9c910e5f54096.nfo', '0212f31b65cdf0d6d4287c42b87ab1d595541dbd', 'Blu-Edition'),
('./nfo/rep/c2c0de3eeb6746c0cd43102dcda9e1fbd6cc3029.nfo', '2fc7cc94ba195a1a8341e8c8fb2b37be2402ecd7', 'Blu-Edition'),
('./nfo/rep/245e2fa8f56cf7631ef028804fbe7791727342de.nfo', 'ac159fba92dcfec0d734bae44755faaf47631d6b', 'Blu-Edition'),
('./nfo/rep/bfc7801b8b23cfa038b26b489aaf2dabf450219b.nfo', '4ccf9f6b14d5f7510a2e1ef1847093caa9690b38', 'Blu-Edition'),
('./nfo/rep/d7c848828cb6404f094512ff593a301e42a79eff.nfo', '7b79ec42f152a3736cced1c0dfdc77c0b01f137c', 'Blu-Edition'),
('./nfo/rep/a5fe6fb85ef871a3e9050384919702410ee66897.nfo', 'a58e047fc9d8929dc065e496bfd61c3f6ca73701', 'Blu-Edition'),
('./nfo/rep/190665fc104e066772e407ef4919a5905e966170.nfo', '83727e3ae762d9e7e4323f7d0f8618d4bc2721ba', 'Blu-Edition'),
('./nfo/rep/30dc4d4d1aef500d3637060f8973025012fa6fa7.nfo', '5be8b7cf5b4435a91d7c54f1d4fa5e7b83f53c81', 'Blu-Edition'),
('./nfo/rep/1a132bca541697009e60692abec78b17478ac000.nfo', '3041ee1533f5fa84aeffa0bc2f8e1802df2a4991', 'Blu-Edition'),
('./nfo/rep/006d8aee0d9cd4c0d67127d826fd61a6ff786309.nfo', '826c8688fa7d39cd181637a0a56e9a38e4e3846a', 'Blu-Edition'),
('./nfo/rep/ba04af7b33b7359e371444a7041369a4ea652335.nfo', 'a9673f7a714fcfec4b71cc1636fac61d8c2297c5', 'Blu-Edition'),
('./nfo/rep/320d3c7bc2601704323a5f17d91eaea213cf2079.nfo', '2768d2ab79be55b1f9d36e1fc87a854b56faaa3b', 'Blu-Edition'),
('./nfo/rep/ddcf6d11f8c7c5dae689912cbf300a496c9d3ecf.nfo', 'c6a5b92dce3df6f7d0e6ebc0b0792949043f1d30', 'Blu-Edition'),
('./nfo/rep/251762b45a1fd0ef387d789c360e297101447077.nfo', '0c6480098b934e08d17a85ed525417141af4b533', 'Blu-Edition'),
('./nfo/rep/ea3b92091c6b6bb605d03f5df0e37e26549f048d.nfo', '25289355658f2dccc5ee33615b32763d9660a2ef', 'Blu-Edition'),
('./nfo/rep/bbd12923b972c3a130026ec3a60af20e307c26fd.nfo', '6b6bfd3e69787cb8323a2283f575764a8617b080', 'Blu-Edition'),
('./nfo/rep/cbe3187e657a51e6a39fbc65eb05736d6e6820d8.nfo', '5b9f90908e9fa736b3567900d1262f6367d68c97', 'Blu-Edition'),
('./nfo/rep/adebf2e547eae075d59ae5ffabbe11eee090d633.nfo', '31905eb6b2df78526dea873507b1da3966123871', 'Blu-Edition'),
('./nfo/rep/b2f7c74fefff01d6a64cfabb748d899a902a95a4.nfo', '8b02092c3fb62d21e2e0caefa9f5b6ac5013626a', 'Blu-Edition'),
('./nfo/rep/7a6eb116811451e8e4939b587c53592968306aad.nfo', '20d38ff89a8fece4577efc616d3288c81bcbf5d6', 'Blu-Edition'),
('./nfo/rep/39658ce0d5d80dca9355702f492647228389a097.nfo', '259c9bee8dc21681b028786cd666a1a0e5f5de9c', 'Blu-Edition'),
('./nfo/rep/001c4da158db41ffc1a08c1cb1604a644186b059.nfo', '626843900fefa4eecad0c2efe7cba6de1ca7cd6a', 'Blu-Edition'),
('./nfo/rep/d773f6886639bb0c247845dbc5f6b14895b33e77.nfo', 'f6b4950ca9a51f653b86ab2f133337fc5df133b1', 'Blu-Edition'),
('./nfo/rep/256cd34afbdb75c0be857005024e1ccf648a398c.nfo', '697549f323f5f9e7a3b0d5fbde76ec4666ea618c', 'Blu-Edition'),
('./nfo/rep/606df7f1fd52e0d16b1d8b4b996aa037b7b79a42.nfo', '8487032f80839c80b2e06decd096bfb595287174', 'Blu-Edition'),
('./nfo/rep/9caf980a24c87b5f0b1694261fed53e44ed9b1e7.nfo', '29f26c1e06b4daec14cacdba0e88a6cf049d017b', 'Blu-Edition'),
('./nfo/rep/8c97087c227b5fd8a2afa799f65cde707ba5dff7.nfo', '6a90591f8675acb31d62fd157c7fe467b6216a63', 'Blu-Edition'),
('./nfo/rep/53a7ea5ea55a683b1b0480128b777804419596d2.nfo', '17c994c6c94cc5da9a1726c5734c51e9415cdbca', 'Blu-Edition'),
('./nfo/rep/3374a86de5e67718e374cc71c08941579c2c9ef8.nfo', 'c3b409264a8e4b0ac830f23297a334240426ffa2', 'Blu-Edition'),
('./nfo/rep/471553a8ae1c3a3e01bfb8fae5f73b2c022f3573.nfo', '714fd68f81e0ced68e9a368b40c86316512cdf53', 'Blu-Edition'),
('./nfo/rep/714cbf6b191f845b082919ad75ece53f326029a0.nfo', 'd35cdfd02f9a4f2da85baad45daf4178e5c29e80', 'Blu-Edition'),
('./nfo/rep/77392d60a448a3e79b881f88f20780b654f9b5b5.nfo', '30a89686409594f504ad49fff940e8a0e7e2b81c', 'Blu-Edition'),
('./nfo/rep/a98f67493d855c12d15bb178ad4376d70f7bedc1.nfo', '38f2b541b3484e1415a7fbbe9222c716202dd6b7', 'Blu-Edition'),
('./nfo/rep/26d741b4429f794bbab1961d7be4575c0031a28a.nfo', '81b8d95013d2d88d47be8b49fef40010b8abe8db', 'Blu-Edition'),
('./nfo/rep/be9e7c50ea13803e9770697d1b8a53c9cbbc053e.nfo', 'c263559452fd4ca23deeeea952d5694d6faa611e', 'Blu-Edition'),
('./nfo/rep/319bbfa6707531bf2d9ac99b0de4f7b3ff3f4ef3.nfo', 'd6eb6191a7bae22cca1e46a2c62a2c0618169521', 'Blu-Edition'),
('./nfo/rep/cf5c73c719394dfc3714f998f9abf68c2ed84a24.nfo', 'e0ea219d678975461b387d683571780e4de4c986', 'Blu-Edition'),
('./nfo/rep/de103f7b444e53543e238b8dae0116e0f7e15b09.nfo', '1987ae89a08375ab24fd6d7d15c9de30658d3f22', 'Blu-Edition'),
('./nfo/rep/c14af50c6ff6d13e57d3eb08967ca86d81cc23a6.nfo', 'ef06fbfbd5f751dcea8a503227db0a81b2d4ddfa', 'Blu-Edition'),
('./include/kocs.php', '45284d56d86f6b0b8dcbf4c791142fa79e51123c', 'Blu-Edition'),
('./nfo/rep/9afd17c2ccd7bf2dc11ca78e2e23ed3bd5d31acd.nfo', '558ee9356545717052bc021d99834257e25732e0', 'Blu-Edition'),
('./include/BDecode.php', '42e94a04275a6c3bff4ca36a2e14eb04594d18eb', 'Blu-Edition'),
('./include/recaptchalib.php', '9258658f6e9079ad183a77165656a0ae7b2b1cdc', 'Blu-Edition'),
('./include/class.tvdb.php', '40283c65e12aa2ffcfa54083d72dd91940e191a2', 'Blu-Edition'),
('./include/TAR.php', 'c7a799c31b2ca57fbcc263e98d5638e2aff2bd23', 'Blu-Edition'),
('./include/class.omdb.php', '902923848755cfa15e90a5533f2471c0e97bee8c', 'Blu-Edition'),
('./include/class.rssreader.php', 'de0c9da9ddcbcc2b59fb8e4a88828b89280ca2f9', 'Blu-Edition'),
('./include/phpscraper/README.txt', '51a99e723060bb4063f07b0b5770833ce0adf690', 'Blu-Edition'),
('./include/phpscraper/httptscraper.php', '6a178f3d868edbb993c1ad5a21b3c8f0b0e3c4b4', 'Blu-Edition'),
('./include/phpscraper/lightbenc.php', '933a33bbd124fe02b8146f92ed904e349e1b1e6d', 'Blu-Edition'),
('./include/phpscraper/tscraper.php', '0c49e09b5be154ae607bccbe9be01574c9e3de3f', 'Blu-Edition'),
('./include/check_size.php', 'eb9d3ce7fa453ce4c6c98d899f6408c546d69a97', 'Blu-Edition'),
('./include/phpscraper/udptscraper.php', '08393983938289c3fe291836698c9fe696fda1eb', 'Blu-Edition'),
('./include/shoutcast.class.php', 'b65486fac4617b5883b144a0b6a9903169765779', 'Blu-Edition'),
('./include/phpqrcode/qrrscode.php', '2a7c252942970f5a154209ccc2d02c2d2ddc7cb0', 'Blu-Edition'),
('./include/phpqrcode/qrconfig.php', '2ed77159081cc41a62409bd6b80156bc2cad129e', 'Blu-Edition'),
('./include/phpqrcode/bindings/tcpdf/qrcode.php', '90a5ff87c6230eb872f4cdeec6ccaf55c35ebabd', 'Blu-Edition'),
('./include/phpqrcode/qrconst.php', 'b5e085834583ddba60be2e29c83dc3bd225bcff2', 'Blu-Edition'),
('./include/phpqrcode/README', '1325badc034fa7a1f68c38601849354fc5101680', 'Blu-Edition'),
('./include/phpqrcode/qrimage.php', 'e8f45859449dd1858aa67b0e2f0981aa8fc54ddc', 'Blu-Edition'),
('./include/phpqrcode/INSTALL', '4f185c829e43fb04c317481fab6667d3b53c3870', 'Blu-Edition'),
('./include/phpqrcode/LICENSE', '0f1e10cc93f0c0b99e59010b4fb6a5cb36d9c89a', 'Blu-Edition'),
('./include/phpqrcode/qrlib.php', '87f0e27a1e67902a2848564510d869089ed8f834', 'Blu-Edition'),
('./include/phpqrcode/qrbitstream.php', 'bcbb650d5ab5d141c266546c6772136220584136', 'Blu-Edition'),
('./include/phpqrcode/VERSION', '537b4c29b3b98cce1de62385d760acdfb23e2d1d', 'Blu-Edition'),
('./include/phpqrcode/qrspec.php', 'ec5da58fdb731b2e7c0e45d8e0ee88154b8b8ba0', 'Blu-Edition'),
('./include/phpqrcode/index.php', 'aa7bd1dbeb8e4a645832445f8685e9b66fda25ea', 'Blu-Edition'),
('./include/phpqrcode/qrencode.php', '75255205ba3dafc967cb2e50c56a897112b3c85b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_177_3.dat', '39307437c63be5935936e662b4d5d90f803c5ced', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_38.dat', '0b6feb247a3d1f880792da4d60e1ed236ba1e897', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_65_3.dat', '39a8a5ad9d39206faddc1f57087581918badf6e3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_37_3.dat', 'cd20a19e0fc5967387b1ac4cadd66377b9509004', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_105_3.dat', '49c1f91201fd4647c6ef47c1bb18bbe6a48ac7f2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_149_3.dat', '4501a08f2f72da85db7b712c2dbfde993b211408', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_141_3.dat', '2edd77b0663212f415f89993f7b7909ff1718ea1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_145_3.dat', '292b203835075639ffbafca36a5de67fb3de8100', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_25_3.dat', '590f3ca8692d1b53ce1e55f6b744f1d724c5a622', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_121_3.dat', 'a6963c47f5268aba27803034ad454c11b2147f60', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_93_3.dat', 'b43d61932ebde9b8234f3f61b963ce7538ed63e3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_137_3.dat', '8aaedf480d78dc621c4d8143319ff4031d7f3707', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_161_3.dat', 'e180c64c6b8c2a14d04d578f31ec7ed8d39d83d8', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_53_3.dat', '6a9fb42bad0992d502028456e347e2c5e95ea3dc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_73_3.dat', '1a2eb0817f6a84e3da1a39ad2970286d21436b42', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_165_3.dat', '14685a00dad820881aa745f9426cdc10555ec2a2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_129_3.dat', '4f2f1071812f865a1c85c4a2cfee99e4df12ee19', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_69_3.dat', '7eab7db1ee8bd9603889df54b24c7fe446c98018', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_117_3.dat', 'e1154d668073fffe797ea8dcbaeeb959922c9a30', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_81_3.dat', '61f87197a91f0eb3753a988cc6e92ef7b0d89cb9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_29_3.dat', '895a075959c8ff21cf093cfc81d7914b781c3563', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_33_3.dat', 'e3bad92f954b98d7386630934f714343709cd07f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_97_3.dat', 'edd06d929aad7e2c697c94e356d4bfaf76adee35', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_45_3.dat', '62d9e7cc89962656ae7b9df22078a1e760819030', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_21_3.dat', 'cf288abe2c7d5759b9a67aaff4d35a2d0d54d5c4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_89_3.dat', '354424fed1a668f2628a498476d062f0a26d2688', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_153_3.dat', 'c672aa844c835d042151743e9a23e2550cae6dd4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_125_3.dat', '902c2defc528aa4843d406ac62d2ad2b7b19160a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_169_3.dat', 'bbd9f82177712a172cd3900a387c04b21a551507', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_61_3.dat', '1e5a932706b6874aad236043c99c8d9e758c3748', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_77_3.dat', '7f0178fba6468218f6d6827b0eae79c538ef0a16', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_85_3.dat', 'f98d259f7838fb922183ff3e41d64b4d89bb226e', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_109_3.dat', '59778c8a6d346999cb3274efd1bfe9942ea1c087', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_173_3.dat', '2e8d3b3c7ea55f4781d096732427b1051fdb3aaa', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_101_3.dat', 'e34665f289333cefcef7a0dd1ef0cdbb90e69f1a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_57_3.dat', '551c04acd5fb8b8efc70ca6ee77464cbed2642eb', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_157_3.dat', '738ea30b8f33d597347629201e15fc8a27fbd82a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_49_3.dat', 'e41c283b2386dbd97342ac93455ef4805b4d8a48', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_41_3.dat', '3fa3e49213ff69f973973e07c54cea5146c45501', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_133_3.dat', '0409db8f469a183c4ad57d209db9874f2662e5ce', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_8.dat', '7889856e434dedb73b42b242e995e131f5263c0f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_3/mask_113_3.dat', '4f43390b71a2202c9aa678fcd8c2af333b6736ea', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_53_6.dat', 'ff5b66891842c7b80c633f6a9b79fc0b807fa779', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_65_6.dat', '57e79fabb42d60ffea759a1a33f77813276ac2a1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_85_6.dat', 'd145b3ef16ee36fb3137703e74c422ae106e2400', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_97_6.dat', '7985d78990fa9b68e28a5e357c229c1480492849', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_33_6.dat', '5f7ccca1a8162eda9aed271d7feb34ec30c4b9e6', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_109_6.dat', '3ecf01738eee5b7f4e58c9f0956ad4799329a976', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_149_6.dat', '08edf7a0c021b064460ea66ae5cebe8f7e4de7fe', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_137_6.dat', '179511ce0a60d55a2e0adfae8b6628715ef485d2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_61_6.dat', '85b8699043cc1e6768c8c051e7d1da3566d36027', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_25_6.dat', 'dccfb780c16dab134a2af5d47a3e700d391b2ff3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_117_6.dat', '4541ab772ac29e8630ac95929ffedd005f2b9b09', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_105_6.dat', '681b36f1579da4330263f4cb613d720d4a1732f0', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_113_6.dat', 'e1808ad5ec247e3463ff8d8414f28bd2e6d17404', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_173_6.dat', 'bb7a49053640be20f781d1814e06ed10187399e2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_157_6.dat', '21c21987e257aa4ae0d339e9330b4f04617ae2a3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_121_6.dat', '02796dab28f5bf08e9b975423d604a33ccd22680', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_77_6.dat', '125b54adcd41fe5ccdf5e45c0162dbedcff14ff2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_165_6.dat', '6dfa3304670d181d2227fbc75889237cd645e01f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_29_6.dat', '3bcf921993b315e7cc946d50e05f44b42c595e42', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_49_6.dat', '95b1a739947e7f9392163c250b03dff807c25dfd', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_101_6.dat', '68fb0519010de84b43e853c19ba9b684a5e41cae', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_45_6.dat', 'c6cc3ef4ad9be3d1afd77658801e4e19ea7f138b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_153_6.dat', '7653394615c719cac248886df3b9048b53b7fef2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_73_6.dat', 'f90a65488851e5c922f005070a2ce1a639603833', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_141_6.dat', 'ca991212099c8c1749d7c3a03c9457b947df383f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_89_6.dat', 'd8d58e485ce26da3c5e8e6912d2494bf75d12365', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_81_6.dat', '66c23df128b70ff953e2492dea7d298ed9312304', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_169_6.dat', 'b9d1b59ab595bf6689f3acc4ede07e4801e8fe14', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_57_6.dat', 'e3baae17e0801f4d8bb3f817364a202b1bc59302', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_177_6.dat', '7cdd0e89fd5800aeca517131ac4db3a9503b8a8e', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_161_6.dat', 'b21f4483b818547d82b2b5eac67a844c0b6c0309', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_93_6.dat', '50c55ead380900cbd498ba2ec67fcad56f7552f1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_21_6.dat', 'cbc1639de17ea82d307b87621d3ac7e52c8233b9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_69_6.dat', '7c87abe13f0f665db458f2a17114112f59c2a69a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_37_6.dat', 'd4d115db31ed84d1e3f06dd283e1f2bab4f46ba1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_125_6.dat', '4e95ee4c44de176de5f7d6fbec6525f8eb0df770', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_129_6.dat', 'da0905bf957c28f9789841d1f71a4fbb91777eb3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_133_6.dat', '80c59d1c691b2e222e78e78398e5379b4cf646a3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_41_6.dat', '6a9f817dcd0c451c045a38f5878b73bd9ce7ce6f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_6/mask_145_6.dat', '1e20c1a228a938b96de70be19d05be372c75b35f', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_12.dat', '8a18fbb3c10cb0f5e6fb5724d20a1deeb3fd99bb', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_30.dat', '4f31bc0f35da2d64ee409ec3152cfef84e8c3f82', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_25.dat', '9ea04d10d3b58ecbda68046dc359343ce75c9a62', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_17.dat', 'ef74115fe8f3d1d1d3b618b8f72eee10a88afe6a', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_21.dat', '06ac7902493285b1d3ae70874cec1872eaca6330', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_173_5.dat', '41fa31e110b82459559372289e2cebd8618cf646', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_141_5.dat', '1aa8ec351d81d2b700aa4c1da18e9b19c017d86e', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_85_5.dat', '35777a9bd32c14e322c7fa5e512091480156b289', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_65_5.dat', '9067ca97b351292729029933f49ce8e1298f3092', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_53_5.dat', '5ff45c4725e828cba3411bddc9bc381b76499e87', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_45_5.dat', 'c3ce21372aa5f52fffd2c52bb0f8c62a0c87a4bf', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_49_5.dat', 'dd05c54ef4f26f3e3258989baad0e6acbd252b09', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_121_5.dat', '7dd8adf393e6d07d76bdea1de32cccd139e485d7', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_89_5.dat', '3f9d76ffa82136c6f4102815bad5bd9b59389939', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_125_5.dat', '2f417fa41b7b87a4809d26a07303d867e458ecf0', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_21_5.dat', 'df22a9c35a11283065a2cbeabb1b3475008acc48', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_57_5.dat', '82c7d26b1a70a50dbccd494bb67095ca470ef0b7', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_177_5.dat', '3add30162958770d3c2cc6ecd511b81d8358740f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_93_5.dat', '3778d0a232d655e0c90434c4691b4fd3add7f0ee', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_153_5.dat', '23e5432f4ef892074d524c571110d81a0257153e', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_165_5.dat', '97936968057334ed84df95711ad362c7cdc8c75a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_25_5.dat', 'b728ae78d072f00662b670fd2b2a86cd8d5a8f66', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_81_5.dat', '0ade459fed247a85562c60c18e12c50cfb63b8fd', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_77_5.dat', '7b7c71aaf970eb9571c8b7af114292b174a13e0c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_61_5.dat', 'd73bf38aaaf0d352bf8972ff94a0362d05e3e7af', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_29_5.dat', 'e1ad18d97a97906fb953a7ff71460988d0c53209', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_73_5.dat', '0f160dc2e25e91cb012cc5ac0d3fdd6e8270b217', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_169_5.dat', '4a5d658f62338faa9b5dc4f03ea0e09c9ef20e41', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_117_5.dat', '2e4ba19dea86520b2aaf41ff8a8ef70f8b48152d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_113_5.dat', 'd5e37dd62e51f028f7814662315f48351ffb82e2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_41_5.dat', '72519d80da91e7a6ab8aa36027183e85a4e11b50', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_133_5.dat', 'c3fc96bc3792f69787efbea5cf7695cc770532bc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_97_5.dat', 'a6be66c969b7737332a042e1cb9c321b0cb70ee5', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_109_5.dat', 'bb6f1651e7d319575e929640749176a202cb0337', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_33_5.dat', '8b6828adf2b09953e2655a6bda6c2a174304f49a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_129_5.dat', '016882d6ca7bd422d128968f96f99461df1d49ab', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_145_5.dat', '2ad898bb9f5d1e733e1c88ee1c74507ea3634007', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_161_5.dat', '78f7edc6d28f69c3a1a660586fe6631181859114', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_105_5.dat', '9122080505d3d0529eee864a452c60c7da8fff17', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_149_5.dat', 'bd2f909f5bb94ab4ba6ecd05ca6b2a716911e196', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_101_5.dat', 'd3f104d1ff9311c6099b77ea2e418eb6fb196c05', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_157_5.dat', '0c3d53429fd0646e2d838ff74cdf2335d4adc600', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_137_5.dat', 'e573b130b8dad79b9698eaccda9c62699c99fce8', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_37_5.dat', 'bc0a823419c5bfee31fa7e30c27e259f19cee399', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_5/mask_69_5.dat', 'aafe75dfb0ce877674171f716a29fd381ce8057b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_157_7.dat', 'ffac57dea875ae60ae17ce1200f5229aa786003a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_33_7.dat', 'f6c6719ad42157a0e87eeae8f45dd74a8d0e3f5d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_89_7.dat', '815faa78b179c9adc5faa49a6048e19604823d78', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_41_7.dat', '4bc0a5752882dc24f33de947d0bb3a96a0160b5a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_153_7.dat', '7d843e776d0fe31274dc3a797fe70cca4dd88e0f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_69_7.dat', 'f22075c6d3c91733355d00ee47d4133a1f80e1a4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_77_7.dat', 'ae0ebde8014b789b81ec4f9bd0397792d19c66d2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_25_7.dat', '340ba16a9813933a1f2630e428686f9de990b2c8', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_113_7.dat', 'be84e47f60c3b8ecbc0c80a61321f07c82db8908', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_117_7.dat', '922a5727c259f133c28bac64b18cdc840c8f9546', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_165_7.dat', '4f4947d69634ea62add47d431d7e6f4fb1d1339f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_145_7.dat', '9f7ac5f4f7261fb0716a8213216eb0b954e92047', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_109_7.dat', '89535bc8cc84bae281832a0871bcf814f622d96d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_133_7.dat', '47f1fa8aca7f916a9aad05c8a242b28a5287cabb', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_129_7.dat', '2dadf5b7e5061ac780c5c1541806faa5806a0b6d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_125_7.dat', '096482784bbf0082521a0c1d2d75cb1b20eb4c82', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_81_7.dat', 'ce088f6cd6075e35a7360e126391c99ba750805d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_177_7.dat', '1451c5ad0d94bb964be151237b140c6ec6d70965', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_173_7.dat', '46724411737798ad2ef3f9c6b0557c8bb5b047c1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_141_7.dat', '0ed350cd4bac627a10daf92dbb30cdbd08528e13', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_45_7.dat', '9c0ecc5d2af9e90282b26799a3d9b296f1efece4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_101_7.dat', '300a1650e14799ceb669acf039c8eac359b47fd9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_97_7.dat', '5d882fb32da09478973f0a7aa5b2c07ba1b38ba5', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_121_7.dat', 'f248ae4ef3e9e18ffe6c66992048b72ab73c96ef', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_161_7.dat', 'ede395a0afbfabe1e5ce50dfe746adb764523b20', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_105_7.dat', '01ffd31e6f64dee45273990fe7dba0c980dea923', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_85_7.dat', '880e80d7622dc9e3b89d289dc65d90aa5b46e1b8', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_21_7.dat', '1f41bfb7f3a6e419581f8231cbb42a23f0b7e4ec', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_149_7.dat', '998c2c55b90e9fdabd093eb5fea149dbebb75850', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_37_7.dat', '8b2e71e86f9176ed4bf494b577a71c78fb60e400', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_137_7.dat', 'd8bf1fbc74f2b590290c9f09e8733d872a09bb33', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_169_7.dat', '3f4b4fb2e453d91414744211bdfba3cee9dd184b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_53_7.dat', '01b392d8bc2c6898f356b016f9569ce5c366813c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_49_7.dat', '7e50b0bec4f012bc232d9f7fa043feb032de3e6b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_61_7.dat', '968b1c56b784cd5ca4a2acc88186200eab9c4084', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_29_7.dat', '3f2694623f3a0b243efe07a51ec01bf15f846f3e', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_93_7.dat', 'd1e043d884d698b7770ea221e990b9d3d11bfad6', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_57_7.dat', 'bd4e4c50c4305a454f6aef33c110974b91aeab20', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_73_7.dat', '867bc8694385824266611e38ccf536187b723771', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_7/mask_65_7.dat', 'ff35edd1fc38d9fd7874f5d6880b154bac33ca08', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_27.dat', 'b0eca1fe1eebefc5654652385594b459bdc79852', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_37.dat', 'fdbfcf3dfa29f563aaca8d8109be2e53c885bc50', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_22.dat', '5f021293b789426d65aab8e926279ecb10397cbc', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_40.dat', 'a681aaae1b76ac19a4beb4bd47dcfa4848ba334b', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_11.dat', 'd220c7dde47b629c9e11e62f46e4f427bed32c19', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_32.dat', '65b4aeee82c7e34402aedb7b211408f19244661a', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_19.dat', 'a596ddf4a48bea5d8ac0c5217e37b6b5048d6599', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_6.dat', '1ad563c5175a210ce6379a25ab926c9b45925f04', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_35.dat', 'ec22a25fcad1c3b2cfe67f1a3e1a17ba7d07e2ae', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_39.dat', '275b9445defa2385083e7657bc77dfe62cd6931e', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_2.dat', '5d037167e5ae0c1fafa3122b9ee402bc770bd2d7', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_34.dat', '477932bbe7c62708d1fdcc4f8d4a6da724d55921', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_29_2.dat', 'd8a04920e1c9a6cac8387b64c7cfd80c3f4d88bd', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_161_2.dat', 'e09fd20e5b45caa641a37973e25907c13fe77b53', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_133_2.dat', 'e10b1373780d4ffb6803ad14a5d1b9673279ece1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_177_2.dat', '9de4d108015598ec301680737bdca496acfc41cc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_165_2.dat', '39fb63e21fac4392edad2546bf810e2cf8debf52', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_25_2.dat', 'f5c8efc7e0df8255fb36373de93df0821c052e0a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_49_2.dat', '3f81cb20981eb87c25f2d8ed5a763c1ed0f07b1c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_113_2.dat', '5ea47d3b0386e5e0e037b28d13cf1c40fa7103da', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_129_2.dat', '40607331e1e34566a76aa19e99f5f32d335d0ee0', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_105_2.dat', 'a0541b54c844920357be7babe08d6aa24f299eb0', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_173_2.dat', 'c37b4cc403cc9d98dfb8637082679db2cbaa27fc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_149_2.dat', '4e78f94ffab5ef3883ca2b0c46cfbe46a70a2303', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_77_2.dat', '081f48431a2d36c18749b7c6036191257cba55dd', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_73_2.dat', 'e137e1070d4880b6f9c8c3f1971af5cb9f925301', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_85_2.dat', 'f591b1915d5e569066e6dd97f7f375ff2759d8f2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_69_2.dat', '5ed98123a13970a5b6880e2217a6a87fe779a58f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_57_2.dat', '92be78ce157790009978389ccf6a28b87a0ac36c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_37_2.dat', 'f3cb5cd08e4ece44c98cc8dc8adcd57e304d8426', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_33_2.dat', '2128c010ce725db5374c97fab280a51a9ecfcad3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_121_2.dat', '3535757f097ff15a890e70019a3224f0e47fd5a4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_45_2.dat', '46e15458e852f49a1ce538c1ccfe3b9c5a74aa4d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_117_2.dat', 'dbc80aad9fe0d64d924b0cccc98c53c112663972', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_41_2.dat', '3b0daaf6fae395864235dc62d615089d3f5398d4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_101_2.dat', '53b392cab1f2e6a74c3f8246e28125080f70f6fc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_65_2.dat', '09c4d3b5a9c8c0ed0249b91d70bb1a95292cacad', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_89_2.dat', '337ac787690db94cccab4b9ec0c930c657f0d027', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_21_2.dat', '13e8c2abea3a61fe842e7569ff74f70fc50062d1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_61_2.dat', '501ee4c075716edf67fde8545d6b3ff8fcbf2781', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_141_2.dat', '8b36fc770f670b9192f3bd5f64daf4c4f31f1def', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_97_2.dat', 'b8a90a27aec550ce2f4987c072f0351ae28661f7', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_125_2.dat', 'a566e52eded09510d3b8aded3a0be15aea76c4c8', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_157_2.dat', '7dd7ccf650ff42f737d897468e8dfa1e6c5a897d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_169_2.dat', '36495e329628b2295e3f1e5e4f546fdb4a47bf67', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_109_2.dat', 'dccf13c7b6ac0ed75cc5d75e99ce3a237a23670f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_153_2.dat', '671e1ba0564a3fe1c5caec09279082d60a44e854', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_93_2.dat', '03d1014e15815ca8d9a96f777f35497fc0af902d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_81_2.dat', '96f94929497b04db1b19e22415905997e767361c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_53_2.dat', 'cd5ab7aa9b0ed53d010c44014fa743e50c88a482', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_145_2.dat', '580d1d1b8379de46598a36b9d6ca5b90a459a2c7', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_2/mask_137_2.dat', '9d7111bc4b8f10b9c20cf64788ab7e30aaf7bd4c', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_9.dat', '5527570643221b0a74b567e8dc64dfb0004377be', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_3.dat', '7ca8cc5fa82e2c31d1cf88aa7f11d4593352ac2e', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_31.dat', '1733195fe7a0388dfb81490bf3cce65938563eff', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_77_0.dat', 'cb48b0e6707a789a5951c7ffa271e62f60c22fd8', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_61_0.dat', '57d02132a9fb9d80a18c1ca3a79d665c9d82b2fa', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_101_0.dat', '15a32a9d65de1aa4016d7f4b140143a1b43efc65', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_93_0.dat', '6985f330e84902c618e3439c2020c67d01c2d442', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_81_0.dat', 'c63d39c99fe4dda67e1430f439fba414e2a72197', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_161_0.dat', 'c2de34031b8e27d1461286a8c48a4f50da82f6b4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_65_0.dat', '1162fe02b2ee47c36349db1597e1c53db984c44b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_137_0.dat', 'cb2acf48ba1acf94952b94d189b1f2df5bd399a3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_45_0.dat', '98184ad237d2e00a52e86879b167259928fc9497', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_173_0.dat', '52489fe8faa9ea206c159f695b7237861130db6f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_129_0.dat', 'd8127c33d402a69baa928f7bb9e003c73cb0af16', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_41_0.dat', '618c9b8c8f8a4756ffc5cc1f8b0b60e181b2a404', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_117_0.dat', 'e5a55fbc1aef34f4a48b338cf6f4ab64a969e82a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_113_0.dat', '697d40ef49f3b5e4c05acfaf5856cfa7d90dc6a3', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_141_0.dat', '080fb8167e6b56c1d7ea70c9b80f36f218f937e6', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_177_0.dat', '2f3d26f23c0a07306583632414e5315d5204e152', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_53_0.dat', '7ee238e6e4cc43d5fba4cd8fc293a387037363bd', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_73_0.dat', 'cf45b9d3b3a2f7398c7924930754776d2d1ae424', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_169_0.dat', '38d1b654e47bde52af4468e612cfebe310192d6b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_33_0.dat', 'c077871a316a09efaa4eb2d9def372b491949299', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_109_0.dat', '3323607809cd280c657b6aaff9c0181b344dbd49', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_157_0.dat', '45f008f7685d5b987233013707c1c780c1de7ebc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_57_0.dat', '33b6fa0f11ff1f0a2046a43f513d6e700ce1eb31', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_153_0.dat', '81dfd4c6738edb6a644d221cd3ba86585bc3673f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_29_0.dat', '96e21b3a528879610a12704480dc0e02cbb3370a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_37_0.dat', '6ef1217f5c95575f8272af216edcf4faa708bacc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_149_0.dat', 'db522e570e863ad9e1318792b29a765cdccc7b11', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_125_0.dat', 'c2e2603ce820ba7fe329683b0ff069768d5b992c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_85_0.dat', '4cf5326f092290340848ab0a49911bf6f79c2699', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_69_0.dat', '5fcdc1d81d3ebc2adbfb6906a21729cccc2103b6', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_49_0.dat', 'd446056f0ab53a9f8fb075c043e67b435d53ef9b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_145_0.dat', 'fe5f29be1ee158112634f6c15b0ff5b88a6d5271', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_121_0.dat', 'ac27e0abd05a8a24eb3bc572e16f7639331be883', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_97_0.dat', 'b172c565f15334629c929a3c2a225b94c036f9be', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_25_0.dat', '8ae767879ec2e4f4d2129b8d38c2cf3aba9fbd36', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_89_0.dat', 'ddc8c915c1dcd69ec02f7d2608250a7890c8fd1d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_21_0.dat', '6c9c2a3ec923c2d08f7015632512a375011fff23', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_105_0.dat', '15532f98cf239a11733e68bf3f0cb0f53169e43b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_133_0.dat', '9d95f052f722ce52a6a6a34204ee791313644674', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_0/mask_165_0.dat', '76ea0c060fc9e5a18e81045b0c7b725330abd4cb', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_18.dat', 'c218eca8be921286459ee0cffdcf3460def5fb2e', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_15.dat', '055f8c12c48b97640b080c9f8b6450dc12195228', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_24.dat', '79aab4173cd69dcd90e34fe50497ddeb0d993876', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_16.dat', '948b06af69f38eebf5de4adf54fd0f810837e527', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_5.dat', '92e35f959496591729d374f49fd073b558ffed6c', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_28.dat', 'f0a0350b4ca996dde03d40226fafd0db9a5fcaa1', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_20.dat', 'eb27bb3527c306aa81a2d52d5fcebe5d6e45199d', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_33.dat', 'd7f4b92d29e0b9ed37d4562773f03d95603bfccd', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_23.dat', '0cb4ff95023089e01a5150216edd2c6c9f70d2fa', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_13.dat', 'e2b5e146b22119c92052af8bc68d5d7602c7a9fb', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_85_1.dat', '3778a3bb1d65df95602e0c888b670e8389231e5d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_105_1.dat', 'dda2b44bdf7d69fb750ff2ff7fc393e6262e631c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_65_1.dat', '76cb7eabb1a01c31d93294786daa64964832f045', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_97_1.dat', '81cb1c8f5ff685208eaf1fced7d584ce6785b607', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_173_1.dat', '082fb49ac8919b0ad6ea767357f30023f1fdd1f2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_25_1.dat', 'd30738a72f58a3aaf8b0e0434bb310bc8337e193', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_113_1.dat', '293463182cccf60056e2bed745dc7895bf68de08', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_73_1.dat', 'd419c173e2f05052a38e3334a571fdb83518df54', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_53_1.dat', '1ad8827280bd9ad9916480de27b0170afd7dbcc1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_157_1.dat', '9a94cae7e1da1f6eef613c4ae100983054440639', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_77_1.dat', 'dea964603562cd995e3446d6bb1aabcf3ab6e98a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_101_1.dat', '5fa7d8e1bda548c29ff8c7ed29f46de60c562631', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_29_1.dat', '816139196a2d812b5c799dfdaaea380c0c9e2891', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_109_1.dat', '0fa986d9c92fad3e520e0980d05bd0664a21f578', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_161_1.dat', '02c21d2cf042bf50bf8facaa00933f42723d05ac', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_165_1.dat', '2c0bc0e41e5ffe54f1a9ab979573b39457d76866', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_61_1.dat', '1774a13a0f1b6f0615f32b1eb779edd77919883b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_37_1.dat', '5d900b04c41ffb428e89e6b7b969f843c8adb401', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_129_1.dat', 'c6c330fe9b8e214f629a4d4335b505f9bb9a72c2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_141_1.dat', '3a7fcced90252a2d7e278b80578fd537ec37aab7', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_169_1.dat', 'e38893bbf3d35b4b286d048c206e2506b029c195', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_121_1.dat', '31a5ed879bd629a356bf7fd90c1385f93beca48d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_125_1.dat', '9a24f4ad0396f0740c899cddb8fa268763709875', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_149_1.dat', 'f7c75aabd4408b692665488583a60ae850b55fa2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_33_1.dat', '4a3cf42debc24c91e134e4f3480139c7513ae9b9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_177_1.dat', '6f5d2537df60fecd2fec82f35ed18fb7a65fd42c', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_49_1.dat', '96c52907b99d3e7626db05ee6b34b96cef8bbab1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_41_1.dat', '97c9982208542a2afdf3f4e6b0eb7dfb12a5c35b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_117_1.dat', '1c69ffc51a8f1ecd167fa658b78776bafb6f6915', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_81_1.dat', '0e08549f1e4c5d38cfa2323234a2ea54eb9adf65', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_45_1.dat', 'd5365fbd23713662a42f7a438fab4c1c728cc63d', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_137_1.dat', 'fe408925a991dda05ad2d51c35f927c951224d39', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_153_1.dat', '7bb91f95ad94c1e28962f0de9d3e4c141e3259f4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_93_1.dat', '20a11c6da8c844c89297a7dd59632e11b539814f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_89_1.dat', '92ed4e95c83b0178a67832af428d9d36601b1e0f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_21_1.dat', '7758ebba85f16bc03e497546a893fd13a0a49523', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_69_1.dat', 'd28c3d2fdf268378e582d91bd1ed9387295b84b4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_133_1.dat', '9bf30cdca0ffd22790aafdc541b6bc3be6c663b9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_57_1.dat', '1d4d163092f27c841bb6786fbb493139dd2d260f', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_4.dat', '14e16b02e1ab8cbaf65d922bdb85795d58d68faf', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_1/mask_145_1.dat', '681809b154acbbca55c24ec625ff76d826a7f2d4', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./include/phpqrcode/cache/frame_26.dat', 'e99a5f2dfbe7070511c499cf899cbe530f30069a', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_1.dat', '085dcf73e74cec8cd647e3e1329b05bda7c7f58a', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_29.dat', '86c08700aa5b6de9b9c4ac9102c3db75667ccc04', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_10.dat', '2603a83b0afb5568aa30152ade37d70050b510c6', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_7.dat', '966ed1ba7de3fa9263d74b8d63ee518fb137ebc8', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_36.dat', '1d7649e1a1fff8987c83a86847ec524d21550c74', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_165_4.dat', '061fcf0b808fec7adecc3f23f41682f71de7a216', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_97_4.dat', 'd3cabba858c3b72a524606ed1558efb2674280cd', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_125_4.dat', 'c69a7f6c9aaf4c6e464f95124c0aa4fbb62c8112', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_41_4.dat', '8fc75418e6d6c2ec092408814add99c3e6fc859a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_81_4.dat', '2e7f209ec2a78cf8129a1233bbb2b12b15c6b976', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_53_4.dat', '43107d734911e783dc5bd9267ab54f14ecc5b167', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_69_4.dat', '1e8b22996aeb3c90684de0179acec123de3f8a68', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_133_4.dat', 'e4476513a8c25010c2e3c54a4ddb4d8921ab8af1', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_161_4.dat', '2337fd81a39444d931855652e76d52abfd5e2420', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_173_4.dat', '3704085b1e395df600fd8cc5503d8b5018ebda4b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_109_4.dat', 'c2609a7b8d68dbb64e4a6ca76587d00f8d5d36b2', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_113_4.dat', 'a9e1e4801ff7e93dceee62d1183132459e5ca0b5', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_121_4.dat', 'c0dd6208ec8c69ad1cc73af939f9ca2805197e21', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_101_4.dat', 'b118edda119b8ace0eeb7f82e5ed5a5133df477b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_89_4.dat', '20f927b3abcd68cd7a416d619f21a2312089d9c4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_169_4.dat', 'ded2bcb451c911748ce8b20323ecfb2053fe1be9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_77_4.dat', '2857fca914338f9745c013c0baf769037fa50fba', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_141_4.dat', '9f82f65c5abd656ba29e987847a7fcce7fde748b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_25_4.dat', '89303e5f75def17c830dd3eb294b631ea2dadb59', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_145_4.dat', '3935f437823314174d52e8d5ee8666ea1c1d9ab9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_93_4.dat', 'b5840d872dc04f917b55e224d90a19d9f4b80a58', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_157_4.dat', '9d3a8798666d2f6f87295f3a5dc39e991812c0d9', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_149_4.dat', 'f60af5ab78f441296936523594093e2bed723939', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_137_4.dat', '5e08656216acccf4e43d956503cb5461808f0f3e', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_33_4.dat', '16c1e8cff60a3c8bd3d4bef54b4712666401da67', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_49_4.dat', '868569382250748a79a7616ef38e83d1b4eb6e6b', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_117_4.dat', 'ff7715e6cfeb90d7a9ee9dcd2fcba8d3554b52cc', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_29_4.dat', '53feeba6f5ec3dccdc932341fb5f9af9141570f4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_85_4.dat', '55d5a9154f3bd971d8d469771b0b5c5d8dbfab4a', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_129_4.dat', '763fc8724568a1fd60189f3d23798f644e33a66f', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_21_4.dat', '8be5e261d637b4cc92d4392454031fd24ae46190', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_45_4.dat', 'dd4331b6e994e08b33fdc2ba9e91bd0fef97bad0', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_177_4.dat', '7409d9de8adf14a89a4c033ec399c730113b53ab', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_73_4.dat', '8d9f33f08a02aa1688d1b29a4eee1ce9f5f88feb', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_37_4.dat', 'd20c30bbd8e9d8b711ef8c6a5d1b1415397e8f88', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_153_4.dat', '0ad3a51f4390c35ce6003640432042be5662cde6', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_65_4.dat', 'e1e796c283a13cf969b215bb8387e4bd4909b5e4', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_57_4.dat', '11a5ba9e7936474aab92fd54f67d26acc5ff11ab', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_105_4.dat', 'c277700d0e87228f13afdc6a69e9a6016d172b02', 'Blu-Edition'),
('./include/phpqrcode/cache/mask_4/mask_61_4.dat', 'c025dcd633e983031155bd68d4812cf7744de7ec', 'Blu-Edition'),
('./include/phpqrcode/cache/frame_14.dat', '4ca96df34f4a094a646a2945878251cd46a129cb', 'Blu-Edition'),
('./include/phpqrcode/qrtools.php', '8e32dc68edf84d12c166b605cd6d5192da3eebcc', 'Blu-Edition'),
('./include/phpqrcode/qrmask.php', 'de700c4f11b0198a1d420ba595fff54793e8da74', 'Blu-Edition'),
('./include/phpqrcode/qrsplit.php', '9ae49ba9a0cecf138f127257103327f1576c7f7a', 'Blu-Edition'),
('./include/phpqrcode/CHANGELOG', '93079ebfeed4e0990ab8ba45d119c4c58568fe85', 'Blu-Edition'),
('./include/phpqrcode/phpqrcode.php', '4fd41135e0822b8557943547148da923c4f5f17f', 'Blu-Edition'),
('./include/phpqrcode/tools/merged_header.php', 'd8a0a35b1e34a847b47c2946801629d244b6e8ac', 'Blu-Edition'),
('./include/phpqrcode/tools/merge.sh', '501c8b37a9417f5e3cb6bc518e403ce5e4d2f2f5', 'Blu-Edition'),
('./include/phpqrcode/tools/merge.php', 'd0fc005d3e3c057c86e37f7144a1871fe763e1d2', 'Blu-Edition'),
('./include/phpqrcode/tools/merge.bat', '37cc9237affa2e5283a081fca50cc68f42982da8', 'Blu-Edition'),
('./include/phpqrcode/tools/merged_config.php', '803fc4a4df23b858973cf3689e81bdd840507e27', 'Blu-Edition'),
('./include/settings.php', '9577a5f65fd671fd576c93a11c16142aeb130567', 'Blu-Edition'),
('./include/phpqrcode/qrinput.php', '02d39209825632fe278a539c7c82dc76ea5bc9c9', 'Blu-Edition'),
('./include/MultiCacheMemcache.class.php', '6da3075a688fae93f903be955faeb6801d562f84', 'Blu-Edition'),
('./include/khez.php', 'a3b317d2c03a9d2c66d36ca64fd5134b2fc0585a', 'Blu-Edition'),
('./include/logs/xbtit-errors_02.12.16_.log', 'b729ea926cf8111334830211988ba4876d2fb53a', 'Blu-Edition'),
('./include/BEncode.php', '622ccaf64484ab9372d5d83c5b375b36c3e40e49', 'Blu-Edition'),
('./include/logs/xbtit-errors_11.12.16_.log', 'bcfbceb444a4d296921d0ec7ee46f625b9a367e3', 'Blu-Edition'),
('./include/logs/xbtit-errors_07.12.16_.log', 'c090278df84f785076d7ac7a2a7ee31b2707019a', 'Blu-Edition'),
('./include/logs/xbtit-errors_05.12.16_.log', '341b6c14105c4b389b67cf02592640936fb24b50', 'Blu-Edition'),
('./include/logs/xbtit-errors_04.12.16_.log', '3a56ea98db31e2e413592008cc818cbee13cdfc0', 'Blu-Edition'),
('./include/logs/xbtit-errors_03.12.16_.log', '9e4a961eb3a17a3a78cd9334f8eb24fbdd62a2ce', 'Blu-Edition'),
('./include/logs/.htaccess', 'a559964be71695d0ad57641d4da8302bc936bc78', 'Blu-Edition'),
('./include/logs/xbtit-errors_10.12.16_.log', '650bd7771436f1af62a13cbfc34b116942639f02', 'Blu-Edition'),
('./include/logs/xbtit-errors_29.11.16_.log', '25108f9fa33e80cc6ad78a0ea3034ae88f7c2041', 'Blu-Edition'),
('./include/logs/xbtit-errors_30.11.16_.log', '842e4e5af599db0fefdb6c6d60db027e5eee3796', 'Blu-Edition'),
('./include/logs/xbtit-errors_08.12.16_.log', 'c32adf396f08f0c40a273d2fdc89431224a477d8', 'Blu-Edition'),
('./include/logs/xbtit-errors_06.12.16_.log', '1279364bbfcf5378b52e609ce80171639fce02bf', 'Blu-Edition'),
('./include/logs/xbtit-errors_01.12.16_.log', '1c173ab25206884cb292b59e4b47f3f3cf1101ef', 'Blu-Edition'),
('./include/class.update_hacks.php', '0fc6e6d6b51d68c2764f54dce0e874d5d9bda58c', 'Blu-Edition'),
('./include/logs/xbtit-errors_09.12.16_.log', 'bba16547d341681fc7fa99114e4aae383ca3a14d', 'Blu-Edition'),
('./include/class.archive.php', 'f788a28b890461fa9cd7799bf73597fe9954e38c', 'Blu-Edition'),
('./include/hashscan.php', '115f6299c5c72a19ac0128e44e3f864869a616db', 'Blu-Edition'),
('./include/class.fanart.php', '90ea580210f7e50cd84bc25ddaff1c19e590b223', 'Blu-Edition'),
('./include/sha1lib.php', '7571b2b8a8b8aafdb382ea631ae32e7e6c2e51e4', 'Blu-Edition'),
('./include/jscss.php', '961c6808f3cf6a6eee691b9de7be49e142cfd36f', 'Blu-Edition'),
('./include/functions.php', '00b1cdc8acdbaee3186ed93fd5fdffdd02c0a640', 'Blu-Edition'),
('./include/offset.php', 'c7919dd9a0f4deed31432c0b6aafde4742baad62', 'Blu-Edition'),
('./include/xbtit_version.php', '8ee893f1b67a5ae3c432425ffc329da917a39cda', 'Blu-Edition'),
('./include/getscrape.php', '915459834638479846e5863edf6b8bb6a8adaba5', 'Blu-Edition'),
('./include/class.ajaxpoll.php', 'e07e64cff7fff478cb912e72c48e6a6f7037d8c9', 'Blu-Edition'),
('./include/serverfunctions.php', 'b3785962bac96b06a1e280202753e3060a7ac7ac', 'Blu-Edition'),
('./include/sanity.php', 'd7aef5bf77bf8dfcf4c1a9058e584fe4a15ee5f9', 'Blu-Edition'),
('./include/smilies.php', '0b5bbc63800605c8763588e869f6d7ff03b86759', 'Blu-Edition'),
('./include/sanitize.php', 'da2f5c60d8c9e72fdc992341da0126926aad01cc', 'Blu-Edition'),
('./include/getscrape_multiscrape.php', 'ed2afd86f156f4dbb7102b8a0bbc58e6976f4320', 'Blu-Edition'),
('./include/index.php', '3b6deba82b18deced7d116b6b3944fd79f76d515', 'Blu-Edition'),
('./include/kis.php', 'a8aab572bbe6578218a5f78cc8b1052b1b8974f1', 'Blu-Edition'),
('./include/radio_shout.php', '892429bedcbb19ead94cdd68f9e6cbb44067c292', 'Blu-Edition'),
('./include/conextra.php', '300bccc0d55a05971c449a72b0288f65d30ba1c0', 'Blu-Edition'),
('./include/class.api.php', '919110cd4462f11b8ccc1e1125d6e5da251b55f8', 'Blu-Edition'),
('./include/security_code.php', 'b7900ea42fd00c4ed862f6308ec1f4d940238896', 'Blu-Edition'),
('./include/class.captcha.php', '72a4721498df9475fb00039cd70c6a98805ec4ca', 'Blu-Edition'),
('./include/config.php', 'bc7ddc1a2f86f2d2dcc89006cfa7551838bf2519', 'Blu-Edition'),
('./include/class.bbcode_en.php', '07b5271ed263caa61d89441c61e9b9e961c2e23b', 'Blu-Edition'),
('./include/blocks.php', '588509aaf4689fa8f0837cc6d8f9ac456b92fb67', 'Blu-Edition'),
('./include/common.php', '89a740feb05d9f2b7be2be716931a7373a110663', 'Blu-Edition'),
('./include/key.txt', '53bbb77cd66ea45353d31f454d1d40c6c720674e', 'Blu-Edition'),
('./include/MultiCache.class.php', '3d5f93cb218b29f439137edfa1160a1c67979fb5', 'Blu-Edition'),
('./include/class.bbcode.php', '8ea0f19d9ced0b6726c12a06b45a3deab9cf8fef', 'Blu-Edition'),
('./include/adlibn.ttf', 'ca44a31ffb9c7ec9b7dbe5cb7a5219481f404af8', 'Blu-Edition'),
('./include/crk_protection.php', '56ddd8069c800db1753e5f2ddd5d9e0357d9b95a', 'Blu-Edition'),
('./bet_info.php', '75c91fc5f79f8cecc8254c09b3bccb8b1d7dd9fa', 'Blu-Edition'),
('./imdbImage.php', 'd147a4e5fc21ea5f1c200f3a1fa5011cee9615fe', 'Blu-Edition'),
('./bet_gamefinish2.php', 'ab6625673c6b7b021754afe406196257089c029e', 'Blu-Edition'),
('./recurse.php', '54da1a339612a283147a5e8ac6591d9a05ee5217', 'Blu-Edition'),
('./contact_Download Errors.txt', '53352fea5ba0e507a5d2b641752d98d8da6391d9', 'Blu-Edition'),
('./favicon.ico', 'be3325e0af1b3b90f273931ff976f26b09e4a251', 'Blu-Edition'),
('./bet.php', '4387e3f08f9fe7bbf50200871ec49e98805b3946', 'Blu-Edition'),
('./robots.txt', '63657cbb7d7086c56b0cd4e5c6999bb683664868', 'Blu-Edition'),
('./fav_up_up.php', 'a9de6221bb8fd9dd87c82fdf2b5aac33f99d7794', 'Blu-Edition'),
('./exec.php', '34501fc48ef670a33d013ac98be5590a245b4fc5', 'Blu-Edition'),
('./scrape.php', 'ce19a68c1ed98de5f6706aac789e0b6715898d39', 'Blu-Edition'),
('./index.php', '64e6626abb9c11e487047dcf82de1e7c6067f7dc', 'Blu-Edition'),
('./bitcoin.php', 'af28299e814cf7e4bec82fd52c9c6d3845543007', 'Blu-Edition'),
('./contact_General Support.txt', 'e7654a26f1b81d94e45c5dbbba989ddfd8586329', 'Blu-Edition'),
('./sql/smf2.sql', '939ec4af501fd458c66269a13a86933189d09262', 'Blu-Edition'),
('./sql/ip2country_4.sql', '098f1008fba6e82d5449c02cbb5e0095f9959510', 'Blu-Edition'),
('./sql/ip2country_1.sql', '7d59c2e7fd5e8e7430f2e63d08d45528241ff4ee', 'Blu-Edition'),
('./sql/ip2country_7.sql', '4657408dc0a66355b8fc82013637aa032bcabc9d', 'Blu-Edition'),
('./sql/database.sql', '3c8b184f65fbdb33214267a0680375dc0900b479', 'Blu-Edition'),
('./sql/smf.sql', 'fe8ae20d49496a7f2a8b1fbfab4c7c8cb679886a', 'Blu-Edition'),
('./sql/ip2country_6.sql', 'd0512913fb4cc804bbeefc9d227fc971e57b1cb2', 'Blu-Edition'),
('./sql/ipb.sql', 'ba6433f949585ee2a4a07342eafa8341a2d92ad1', 'Blu-Edition'),
('./sql/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./sql/ip2country_2.sql', '44b7790a5eddaa315c5803d41ba51232613bbe7e', 'Blu-Edition'),
('./sql/ip2country_3.sql', '20f16fbbd88b744f4b31d226da718233194b52e2', 'Blu-Edition'),
('./sql/ip2country_5.sql', 'cfd7f0897a76fa84a65fa3ec76c7629de924e572', 'Blu-Edition'),
('./error/503.html', 'a6e76a8dd796f905e7f47ec9e969f95c66b6d1d5', 'Blu-Edition'),
('./error/400.html', '8cf1f5ab2235de6f1e9b895de5728850bf71aabf', 'Blu-Edition'),
('./error/403.html', 'b6da0294469adceff9b97b94993b1a05e39be88d', 'Blu-Edition'),
('./error/500.html', '6eb4381eb7dea9cf3ca1ec7d267dc6fb86697708', 'Blu-Edition'),
('./error/404.html', 'd8fe354b5cd8edc4d9ef75acec044781014b46ca', 'Blu-Edition'),
('./error/444.html', '5e156999746e87f4e4c3845b1816393e6aad0261', 'Blu-Edition'),
('./error/405.html', '204029675e344bb45d4ec508c3b7d76e31dff385', 'Blu-Edition'),
('./error/502.html', '0fde60c5a9b2c237c45f106d18f9c7593934e360', 'Blu-Edition'),
('./error/style.css', 'a05755f589075c941b8da9988bd8480121ea4cbf', 'Blu-Edition'),
('./error/401.html', 'd11f894d572dfae761b4859b483249e3a43949c9', 'Blu-Edition'),
('./coins.php', '09de770c6d79b44cbeb493968ed4394fc41bd37a', 'Blu-Edition'),
('./users.php', 'c281748d04f584af45a6c3aff1da4d430e06c46e', 'Blu-Edition'),
('./seo.php', 'd9dfbc9dd4e85ed6b95582e7adf2a7827fa26c62', 'Blu-Edition'),
('./bet_nullbet.php', 'ab5da71d74346b3ba1eb86d4060e9f5246048655', 'Blu-Edition'),
('./pp.php', '6b2a307640c387a5e4d83aed4d82e35f9eee1529', 'Blu-Edition'),
('./warnlog.php', '81e08c1be3f6c2d1f7195d637f1ff58f7d6312bb', 'Blu-Edition'),
('./downloadcheck.php', '3179d65628e5ff9edde2f042cbde4619892eabd3', 'Blu-Edition'),
('./user_img.php', '3f0e2989071794aad10d3ffdf9671ec4e6820916', 'Blu-Edition'),
('./moder.php', '83d355d458443489fb5afa0394790adfa8bf77d7', 'Blu-Edition'),
('./index.switch.php', 'd1ecf836e495d9f451ec33863e7db1bd4aa112f5', 'Blu-Edition'),
('./bet_gamefinish.php', '93af6786daa231d3fdfa74ae5f6672701554493f', 'Blu-Edition'),
('./subtitles/[fmovies.to] Sausage Party (16+) - Full.srt', '90fc6bbd27f2042be01fcb51b0adcf9ea527b9e0', 'Blu-Edition'),
('./subtitles/index.php', '8079e4c4c9de0da1dc2c4c87a4596c68824e17f4', 'Blu-Edition'),
('./forum/forum.main.php', '52e1e0a5c6bf15d60b6b29075fbfb3586d79234a', 'Blu-Edition'),
('./forum/forum.viewtopic.php', '8817a9660f6a9dcfac34b7eaf2f6e059f8b11972', 'Blu-Edition'),
('./forum/forum.post.php', '8f4794c7b2fa6c4156021ad1e9dcf658c64572c4', 'Blu-Edition'),
('./forum/forum.unread.php', '736d6b4b68467d788c10d639de45552019960502', 'Blu-Edition'),
('./forum/forum.index.php', '00620a7225169c82a602ccb9113dfcc4ecdbecea', 'Blu-Edition'),
('./forum/forum.search.php', 'd342fe22820e4b85c47f9cc610b254cc4d4da315', 'Blu-Edition'),
('./forum/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./forum/forum.actions.php', 'a548bc0ba60cb40c95d9c850bf76c64fe46a98ad', 'Blu-Edition'),
('./forum/forum.viewforum.php', '6b2e27128dc063fcb114e6ad4c72bf9b99992ac7', 'Blu-Edition'),
('./logout.php', 'b0108bdd9d9699ff2c3092ff241faee4f5a76df3', 'Blu-Edition'),
('./cache/e9e32ea445f6848659225f60cb26bb8c.txt', '414a7ad664a48aca5633a322e67f2fdc388d5de2', 'Blu-Edition'),
('./cache/a02d38958d861915f03bece72f4d54b1.txt', '414a7ad664a48aca5633a322e67f2fdc388d5de2', 'Blu-Edition'),
('./cache/1dafc0fd8e6c9d2fef5acdc9312ff92f.txt', '26cf78eeccd158b5db993717b69c029a693f8805', 'Blu-Edition'),
('./cache/omdb/tt2975590.txt', '068256e97ba2523abb0d8a7fac041a18016bcc2e', 'Blu-Edition'),
('./cache/omdb/tt0083658.txt', '14325a39f9cc8b34d80c801a62be819102746e90', 'Blu-Edition'),
('./cache/omdb/index.php', '786a79a291d5e8202f00fe2a314019127ac1ea1b', 'Blu-Edition'),
('./cache/omdb/.htaccess', '5e74be3a44703a78a1ec7b7d6eb8020dc4b7d969', 'Blu-Edition'),
('./cache/omdb/tt2285752.txt', '90bb9205325ca87f7284516a402975698a6eafa6', 'Blu-Edition'),
('./cache/dab6c5772b366108c6584637ab9cd43b.txt', '4ebc063b6b0f4345a9f0fcc2ae870826d3f6d9e8', 'Blu-Edition'),
('./cache/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./cache/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./cache/f34f2c91c094b3ab417cc09d2a19e99b.txt', 'b05b71d5a8d8b194298856862246cf22c7890aaa', 'Blu-Edition'),
('./addexpected.php', 'acdfef367bf7df308dff83f39974fe67e0c599f8', 'Blu-Edition'),
('./fls.php', '2e073a74edb03e9a12ed6f2608ff9ea441df5d2b', 'Blu-Edition'),
('./server/css/loader.css', 'a9e6ce66c3a6c21ac9a9d948e01283cb7b36fbb0', 'Blu-Edition'),
('./server/css/grid.css', 'f6b62e03de11b0629b9ce0a24e2c6d1118c1baee', 'Blu-Edition'),
('./server/css/style.css', '1a075d70a61ef33302b2c08f6ec3e89220052203', 'Blu-Edition'),
('./server/js/flot-realtime.js', '78773af48326ae50c31d1e5434e760101f3e6ee0', 'Blu-Edition'),
('./server/js/charts.js', '4250d957d0f6008c4b1c6319d76ef27a3a1244bb', 'Blu-Edition'),
('./server/js/clocks.js', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./server/js/script.js', '5f09916d1f78b61aa5425d2ad865fdc6e70b2c8b', 'Blu-Edition'),
('./server/js/jquery.flot.min.js', 'bf40ea433812bcfb00a04b9a1d9b3eb01da2772b', 'Blu-Edition'),
('./server/server_dashboard.php', '4ae9a40260c8d2603b41a3e6b139ed3366773f45', 'Blu-Edition'),
('./server/server_performance_charts.php', 'a67f03f31ac42864d25ca8675c2231ab6802e34a', 'Blu-Edition'),
('./server/ajax/server_location.php', 'bde12457e7f93e3246c6b62060c40719260fd7ff', 'Blu-Edition'),
('./server/ajax/realtime_disk.php', '7935e7a0c7ef3c435bf231266e2e78d02d00dc46', 'Blu-Edition'),
('./server/ajax/realtime_ram.php', 'caecf92cd2d83316c89433b0a4b236582d496c46', 'Blu-Edition'),
('./server/ajax/server_charts.php', '8ecf3ad0357f54a072e477c0e5f7854e93c96bce', 'Blu-Edition'),
('./server/ajax/server_monitor.php', '9017d48b841ebc1a01fd407831e0697b2ef1c0c8', 'Blu-Edition'),
('./server/ajax/server_load.php', '6e859247941e4ce43e70d67828fea24f8a55ff25', 'Blu-Edition'),
('./server/server_dashboard_demo.php', '9f8a43592e4a348864adde29f85f3cf3e2ac416c', 'Blu-Edition'),
('./BluCrew/css/style.css', '64732cf6f8c8baa68f9c772e401931da90e67a78', 'Blu-Edition'),
('./BluCrew/js/index.js', '670906594633d82c5fcbf11280eb07d1faf740b5', 'Blu-Edition'),
('./BluCrew/index.html', 'c9ff4336011ac0c86f6b62696234dfd840db4155', 'Blu-Edition'),
('./userdetails.php', 'd166ab4d2a06a70c7c5f90463ea26cfddf9ef711', 'Blu-Edition'),
('./bet_delgame.php', '9c591b386145aaded957110fe36cc5ec49fd515e', 'Blu-Edition'),
('./grabbed.php', '3f77c9e8a761e8995b18a2c7f874d0c0cf1f2134', 'Blu-Edition'),
('./bet_active.php', '3f322835c14354568172567d1d6d73c90762993d', 'Blu-Edition'),
('./subtitle_add.php', '7a93b91fbfc388c3d4b881a6640dbba690a7d472', 'Blu-Edition'),
('./extra-stats.php', '542d248fdce002e909bca9572157b2e9989b02b6', 'Blu-Edition'),
('./ann.php', '3fbcde7027d5a1b60cd313b103d72873ffeeb686', 'Blu-Edition'),
('./expectedit.php', 'd2e356a245a7c3d01a6885029b0e3d5269bf386c', 'Blu-Edition'),
('./bc.php', '3a3e32dd7b54443f36137937db2a69a5d63132fa', 'Blu-Edition'),
('./contact_Advertising.txt', '04f6bc561008de6d9a9b890b9abed8e69d5d4e9e', 'Blu-Edition'),
('./takeexpectedit.php', 'f49e2c1ab3ce38a903770fc7c267b43fbe17148e', 'Blu-Edition'),
('./ccslider.php', 'f266244cc92a1c03c700a1167a978f4d0334eb3a', 'Blu-Edition'),
('./subtitle_del.php', '68a5ba1f3684933fb0240b491a164750508424cc', 'Blu-Edition'),
('./bookmark.php', '7cc6fe3b64fe0679bd71f9ffd7b1658e789efbf5', 'Blu-Edition'),
('./don_historie.php', 'd03d8b026827e47008305f5e1205a133699ad2bd', 'Blu-Edition'),
('./applysend.php', '414696e5fad1764f9038a68a4b0a011c029e5b58', 'Blu-Edition'),
('./rules.php', '3bb0d271431bba9714669869c297a16a59a5b98d', 'Blu-Edition'),
('./subs_edit.php', 'fee43cda73aba5b54c02632ca40c620d5ef0ca7e', 'Blu-Edition'),
('./bet_takeedit.php', '4c2128028fca166b1d116219d8fb14e4f596a140', 'Blu-Edition'),
('./rpc.php', '61799b1f4462c7e826bce87e85d888bd61a45b5b', 'Blu-Edition'),
('./sendto/Crypt/TripleDES.php', 'ad41622f7e366c7a4472c97ccd7ff77c4eda91ff', 'Blu-Edition'),
('./sendto/Crypt/AES.php', '5f545fccf5f7f84117d70fa9a5f9ef84fc042ab3', 'Blu-Edition'),
('./sendto/Crypt/Random.php', '518615b34903b56a696c583310a80329b309708b', 'Blu-Edition'),
('./sendto/Crypt/RC4.php', 'b60acc848e477cb967a8aaab84d764f1cb58a9ec', 'Blu-Edition'),
('./sendto/Crypt/RSA.php', '3f7d2c4520f1fd829e7682a38c7d7d2c2e518253', 'Blu-Edition'),
('./sendto/Crypt/Hash.php', 'd68efcd8162dc711d080434987355dc4e978d27f', 'Blu-Edition'),
('./sendto/Crypt/DES.php', 'd3a9c9fa8b597c1db18253c7533ca71bc31854f2', 'Blu-Edition'),
('./sendto/Crypt/Rijndael.php', 'a776450d4c6c69aec9ca3ec8fba6dc6af338c6c7', 'Blu-Edition'),
('./sendto/File/X509.php', '796debaae0669228fa7a03b047c9e9e4809aedc0', 'Blu-Edition'),
('./sendto/File/ASN1.php', '9707420cebfaa9756d89ae4b06fb55de721a6ea4', 'Blu-Edition'),
('./sendto/File/ANSI.php', '3dd306c3caf936ed46ef5d95af9c8c8b64d25ab5', 'Blu-Edition'),
('./sendto/Math/BigInteger.php', '7977c6116482c435542a06275e853cc1c58e4da4', 'Blu-Edition'),
('./sendto/Net/SSH2.php', '1896ddb9362912e3f1507008417ad4973d8dede4', 'Blu-Edition'),
('./sendto/Net/SSH1.php', '06ab605d4948b21cb10563dad0a8ce4c0e493b28', 'Blu-Edition'),
('./sendto/Net/SFTP.php', '95ff29fa5cc3aaf550237872caf17de20ea5916b', 'Blu-Edition'),
('./sendto/openssl.cnf', '0b0660d2b7c720cc15cec03c27178b8aa25b2aee', 'Blu-Edition'),
('./torrentbar/digits.ini', '3f7d8af56b2609de5249724deac2b486d5e9f45a', 'Blu-Edition'),
('./torrentbar/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./lottery.tickets.php', 'fe6a5967d4228201beb4e76217b4c51bc8897268', 'Blu-Edition'),
('./bet_takenew.php', 'b408ba52ad97909dade9d491d3c3618727f521cb', 'Blu-Edition'),
('./lottery.purchase.php', 'cbe5ae9aaee8a672a68f2929bc9f140cc8f4b75e', 'Blu-Edition'),
('./edit.php', '197b19f8fbaf882437d2ad9045f00ec49fdd0766', 'Blu-Edition'),
('./imdbrate.php', 'ee31ace7b9d218b4acc8baf636dcabd2aa7f8e5c', 'Blu-Edition'),
('./language/polish/lang_recover.php', '949c95d7ed4bb1100549ab445e4bb6cea726e4ce', 'Blu-Edition'),
('./language/polish/lang_users.php', '2e8b03105be5b07d3e15113a06b445a46083edfe', 'Blu-Edition'),
('./language/polish/lang_upload.php', 'e51ebf0b041f6e9e7639b136408594fb3ead6a3e', 'Blu-Edition'),
('./language/polish/lang_main.php', '6e5d3ff23e8a9c10a3df19a925b774325650a12a', 'Blu-Edition'),
('./language/polish/lang_login.php', '28b7901cde732de8f416a71ac2b4f073413752b5', 'Blu-Edition'),
('./language/polish/lang_userdetails.php', 'aeb08084305f27e118e02933b302dc0e5c028518', 'Blu-Edition'),
('./language/polish/lang_usercp.php', '53c918a47548cb9d1095c7c8b59eca35057fb9fe', 'Blu-Edition'),
('./language/polish/lang_viewnews.php', '9888f5f3b613218ab01684e4a54d1e7a93304c1f', 'Blu-Edition'),
('./language/polish/lang_admin.php', '65532ec1ce9d193dad171b4f56f1f33c149a759d', 'Blu-Edition'),
('./language/polish/lang_history.php', 'f0bc1fd97ae6fd81cec254b19b4169b908cba80a', 'Blu-Edition'),
('./language/polish/lang_forum.php', 'fabf5e68ae43057ab67e302b27c20bf711d51726', 'Blu-Edition'),
('./language/polish/lang_blocks.php', '2c7fd8fed8ec28850b50a2f3f5ae37a7510f4c59', 'Blu-Edition'),
('./language/polish/lang_torrents.php', '1b3fa9008c2e742cbdc07f72c9190056d8485c8d', 'Blu-Edition'),
('./language/polish/lang_polls.php', '24cf7231d6d3edb5dc7b5f8a8aef5eded2952d3d', 'Blu-Edition'),
('./language/polish/lang_news.php', '36641625c577ecbb04b7c6af0a35d7bee96315d7', 'Blu-Edition'),
('./language/polish/lang_peers.php', 'cbf5749e4b8729f7affa4135085886b5e48c557c', 'Blu-Edition'),
('./language/polish/lang_account.php', '7e078501ada71e268a23d558ed545c6b660fdc85', 'Blu-Edition'),
('./language/russian/lang_smf_import.php', '197faeb2c1950d75cd6b53c3479de7f7118be7b6', 'Blu-Edition'),
('./language/russian/lang_recover.php', '601ee737f6b8b9973ee28c03430c79bbf953ac3c', 'Blu-Edition'),
('./language/russian/lang_users.php', '0c3cc3dd6f5aa29ec7d4e323a74a0626f1e4d461', 'Blu-Edition'),
('./language/russian/lang_upload.php', '632b620505a58a58c5307dafaa8e4e8ce59397d4', 'Blu-Edition'),
('./language/russian/lang_main.php', '1570d15ca34221d0c669474efbbee7ecc424ceef', 'Blu-Edition'),
('./language/russian/lang_login.php', '5079d081397c0a9d0872c796e2ac46a7d730f8d5', 'Blu-Edition'),
('./language/russian/lang_userdetails.php', 'd6c88d9041f8bf07fd027ae2b1c1b1296ec4f671', 'Blu-Edition'),
('./language/russian/lang_usercp.php', '1b94cf0b7b567f9b3bd5c4756a2434a05c3aadaa', 'Blu-Edition'),
('./language/russian/lang_viewnews.php', '566b7d91a8fd9fb1696f1d21efd0137e487e041f', 'Blu-Edition'),
('./language/russian/lang_admin.php', '131e0ec9b6b9b06d87b74cf3fc6b4f097263008f', 'Blu-Edition'),
('./language/russian/lang_history.php', '16b895b4544c6eb7400af6bc6f0cd15a24ac96f3', 'Blu-Edition'),
('./language/russian/lang_forum.php', '582c598298f3935879b5747b1b997fb476f7ecfb', 'Blu-Edition'),
('./language/russian/lang_blocks.php', '0434e6e12b53f7ac55ee78608499e13d6c92bc5c', 'Blu-Edition'),
('./language/russian/lang_torrents.php', 'daf6e6b878cb28e649ed65e676610ff528cb499d', 'Blu-Edition'),
('./language/russian/lang_polls.php', '6156ecc3d7efae361a68083ae4a9a6abce793921', 'Blu-Edition'),
('./language/russian/lang_news.php', '18aeb2a0a02e9666e75b2aa7c8b2d29b01c6eeba', 'Blu-Edition'),
('./language/russian/lang_peers.php', '2feaca45c933117d2eca0690ed7b32fc4653d8c1', 'Blu-Edition'),
('./language/russian/lang_account.php', '95883da0b2128f6311e8bf66d5affaaa5345d6f3', 'Blu-Edition'),
('./language/german/lang_smf_import.php', 'e14ba04ac4f8c55dd5662495c4641edf9d994404', 'Blu-Edition'),
('./language/german/lang_recover.php', 'a5833ec54ffe3a5d8b73f4984b1c8737ac45b2d2', 'Blu-Edition'),
('./language/german/lang_users.php', 'f1753b4db15f921af2a3e1f484ab52e1d80e1434', 'Blu-Edition'),
('./language/german/lang_upload.php', '5f6cd0267ae4d9d17bb8790e8c9705aeb3c6da44', 'Blu-Edition'),
('./language/german/lang_main.php', '143ce5fc103c7f9be72bee771de34127d3d4afce', 'Blu-Edition'),
('./language/german/lang_login.php', 'd0db5091ebed2a2b25247a3403a6ecc2cb57ba5a', 'Blu-Edition'),
('./language/german/lang_userdetails.php', '608f827c766293ae9e5bc12c1fedf0b14f4beac7', 'Blu-Edition'),
('./language/german/lang_lottery.php', 'f73987d2a1bf83a6ded9dbd866fc0af3df6493bf', 'Blu-Edition'),
('./language/german/lang_usercp.php', 'a552d33cd0ebbb1e17e42bf943b360a130d4e1f3', 'Blu-Edition'),
('./language/german/lang_viewnews.php', '92f9c1e6ae3899d821979ebc479aa650014e0406', 'Blu-Edition'),
('./language/german/lang_shoutcast.php', '4cdc40d7b03bfb29a7e0195ab6751434d48ff00a', 'Blu-Edition'),
('./language/german/lang_admin.php', '83eff0fd835b577ef980e8143f2fd6273d9ad4f8', 'Blu-Edition'),
('./language/german/lang_history.php', 'a7f5543e8bc68f2eb7d97d820bd75652ba53126e', 'Blu-Edition'),
('./language/german/lang_forum.php', '7cf2ac0e52364ab2f4ba11ee9eddb58354e4e5a6', 'Blu-Edition'),
('./language/german/lang_blocks.php', '9aaf01d4a5caa0266cd33e990062941af712b0f5', 'Blu-Edition'),
('./language/german/lang_torrents.php', '48768f3059315ff561b71188a44022aa9dcc72be', 'Blu-Edition'),
('./language/german/lang_polls.php', '395d503086bd2dba4ee5d9164353826d1600ee52', 'Blu-Edition'),
('./language/german/lang_news.php', '90697a11b7b9d9689c84e5dcc5f83b5c4086854b', 'Blu-Edition'),
('./language/german/lang_peers.php', 'b216200ee88b0dbd3c8ebf089be189362decd3a0', 'Blu-Edition'),
('./language/german/lang_account.php', '71c5733f51a224d46e79e175a9236b6bd8ef9df8', 'Blu-Edition'),
('./language/french/lang_smf_import.php', 'f53170b3acfdd9e95bd8fe537ff4a4dff7ebac80', 'Blu-Edition'),
('./language/french/lang_recover.php', '279c5e262889a4158ccbe5baf328d4b6d7ed63a4', 'Blu-Edition'),
('./language/french/lang_users.php', '2943c93e3d829b0bbdee562a6886d2976d81c6ce', 'Blu-Edition'),
('./language/french/lang_upload.php', 'c7a95d08b680165d3f5b4a8353466db0cc01e1a5', 'Blu-Edition'),
('./language/french/lang_main.php', '537c60f49452d4a4ce404ef99af5e3163bea32ad', 'Blu-Edition'),
('./language/french/lang_login.php', '6647c7e2df155e8308683cfe9ac42e15d238d56f', 'Blu-Edition'),
('./language/french/lang_userdetails.php', 'df66e20b438e35a0607c8eb4a5a27ed60c7d3e59', 'Blu-Edition'),
('./language/french/lang_usercp.php', '94efd8badbf55fcbab17ea255c996d7cc963a58b', 'Blu-Edition'),
('./language/french/lang_viewnews.php', '1f66d9d1e54c1ff6e9ae6d31b65a791981d64d1f', 'Blu-Edition'),
('./language/french/lang_aads.php', '3acf85c41a13db25a2b6b4ec306072ffafc71d4a', 'Blu-Edition'),
('./language/french/lang_admin.php', '063a31dd9e0d809df0b3ab159f6db338c50f29d4', 'Blu-Edition'),
('./language/french/lang_forum.php', '2ad61c62aa4a7553f35b7cd924974a1cea302868', 'Blu-Edition'),
('./language/french/lang_history.php', 'ead839779b381a305b90a1bccdc6b28d63bc029a', 'Blu-Edition'),
('./language/french/lang_blocks.php', '96b11015db57bcae61d9f2fbb973c9129eab4a95', 'Blu-Edition'),
('./language/french/lang_torrents.php', '2065e362495f2d1bd702558a9f9fb4f83326b632', 'Blu-Edition'),
('./language/french/lang_polls.php', '1cf6e5599785a09a3afa5baf36b16e2b1d1aa49a', 'Blu-Edition'),
('./language/french/lang_news.php', '7978bd2f48dc1969f29a2be405e61b7475efd5a1', 'Blu-Edition'),
('./language/french/lang_peers.php', '987a78a8eb2c456fc907e045ec9e5ecd62a03adc', 'Blu-Edition'),
('./language/french/lang_account.php', '5fb5ea21cd5824f80052c8493271ce52354f9861', 'Blu-Edition'),
('./language/french/lisez-moi.txt', '1339b160c125d0504526ea935a33e71bd1a7a054', 'Blu-Edition'),
('./language/spanish/lang_smf_import.php', 'b91eaa3980d47054b0ad74edf17675abe2726c04', 'Blu-Edition'),
('./language/spanish/lang_recover.php', '889a6835e56acf7038fd52b463c5145c0e973b21', 'Blu-Edition'),
('./language/spanish/lang_users.php', 'b2335e0160fad90d405b7b6d2b3b4b1aa5d4aed8', 'Blu-Edition'),
('./language/spanish/lang_main.php', '850bf93fd3dc4b4c1483e3df4b1a72dce82ebada', 'Blu-Edition'),
('./language/spanish/lang_upload.php', '3681c0d6f77b80d50ba1b5258bd0fc9df014307d', 'Blu-Edition'),
('./language/spanish/lang_login.php', 'edaf68301510782d281d02c6905583ade56f739e', 'Blu-Edition'),
('./language/spanish/lang_userdetails.php', 'e95cb3040b7d683bbf4d229548f5e201e472b091', 'Blu-Edition'),
('./language/spanish/lang_usercp.php', '8acb44d4a28349ea4598907ae4e95d6d16be29f1', 'Blu-Edition'),
('./language/spanish/lang_viewnews.php', 'af7bd516663cbd096e27762fbba61ebfa6b18794', 'Blu-Edition'),
('./language/spanish/lang_admin.php', 'a5cc7bd369ac2b026a53e3de09eb29a7f63015b5', 'Blu-Edition'),
('./language/spanish/lang_history.php', 'c479ec96836f3a0686c376dc3531dbf43f9d65bb', 'Blu-Edition'),
('./language/spanish/lang_forum.php', '76aadd00a59fb15681347ea0d3daf403f691429a', 'Blu-Edition'),
('./language/spanish/lang_blocks.php', 'e7eb8fef2cb9eabb5b845e48fc0d129928d90724', 'Blu-Edition'),
('./language/spanish/lang_torrents.php', '6ccd8d832669e7a3964349bbe3ffdbf9ee4eb424', 'Blu-Edition'),
('./language/spanish/lang_polls.php', 'd0c7cef6bb9aabcfc625c53f21e29c6b120cd0eb', 'Blu-Edition'),
('./language/spanish/lang_news.php', '2fd0b3af25a9126e14456d3ba6428d3944141eae', 'Blu-Edition'),
('./language/spanish/lang_peers.php', '996e3705211028ec531032786575b7230c0bb78c', 'Blu-Edition'),
('./language/spanish/lang_account.php', '3f3fd53cb1fa418b3c7dd9c814a305f857bed19f', 'Blu-Edition'),
('./language/install_lang/install.romanian.php', 'b6e109366d8d0a830aab7f54297e4ca11d55ba64', 'Blu-Edition'),
('./language/install_lang/install.spanish.php', '2b01bfe125fd8ef28b016031116b123a2d20b029', 'Blu-Edition'),
('./language/install_lang/install.dutch.php', 'fbb3882b737475d68bdc6e85bf93bf00fb5e686d', 'Blu-Edition'),
('./language/install_lang/install.serbocroatian.php', '4d22817a4995de24311eab43fc7130ac7c950f67', 'Blu-Edition'),
('./language/install_lang/install.portugues-BR.php', 'c424234a3640bf3dd5185e0236642a14ffb9907e', 'Blu-Edition'),
('./language/install_lang/install.hungarian.php', 'cad77c1b549ec28d3708527d51162a967bcf4e52', 'Blu-Edition'),
('./language/install_lang/install.portugues-PT.php', 'fb94ebe3c9c2476c1af33513013209b98836da38', 'Blu-Edition'),
('./language/install_lang/install.greek.php', '8704ecb508b91a81171ec5e406f57f9fa6b917cb', 'Blu-Edition'),
('./language/install_lang/install.french.php', '30f2c40df876b540c99e885b8f54ce6d022337c6', 'Blu-Edition'),
('./language/install_lang/install.arabic.php', 'f890b7552f30824f3294afa2bf6eef8702d24954', 'Blu-Edition'),
('./language/install_lang/install.swedish.php', '5f26be565e2b865f4f1866f0259629190b37bba2', 'Blu-Edition'),
('./language/install_lang/install.ChineseSimplified.php', 'a1874984346efcddf3c0757efc354c8701766daa', 'Blu-Edition'),
('./language/install_lang/install.polish.php', 'a40ff48593bff12e2f5d136730acd61a17035bc1', 'Blu-Edition'),
('./language/install_lang/install.english.php', 'd7f73f90fe9d2f4e02602889fe7def7efc3f812a', 'Blu-Edition'),
('./language/install_lang/install.italiano.php', 'dd1a02ea544bb192bb7bf047ab4b2d5c10666de7', 'Blu-Edition'),
('./language/install_lang/install.russian.php', '9d237b067ee32330b871f46591529257113b2394', 'Blu-Edition'),
('./language/arabic/lang_smf_import.php', '3cf3a8f0a00fed0cd2c493fb005334fc3b390b15', 'Blu-Edition'),
('./language/arabic/lang_recover.php', 'ac264329f3eb5c6c6731a1821660ad4fb6560315', 'Blu-Edition'),
('./language/arabic/lang_users.php', 'cb0c2a528fe464f7e3b14ac6d6963787c554d3dd', 'Blu-Edition'),
('./language/arabic/lang_upload.php', '47a54d10c71600ad0dc459ddd3aea12bfbc80f24', 'Blu-Edition'),
('./language/arabic/lang_login.php', '7043db99ddf3894d7468c7ecdecfa6ed0a282575', 'Blu-Edition'),
('./language/arabic/lang_main.php', '0d27eac5f3e0f83b9c03831e0d09ce2ac5962a1b', 'Blu-Edition'),
('./language/arabic/lang_userdetails.php', 'a25678989a1e1dff6d1b836f16a6d3b12d422c7e', 'Blu-Edition'),
('./language/arabic/lang_usercp.php', 'fb694371c3765467ee0dc9cf3381c46642e7deb7', 'Blu-Edition'),
('./language/arabic/lang_viewnews.php', 'ed0d4f68f825d33dde49034b903b4d56501fb29f', 'Blu-Edition'),
('./language/arabic/lang_admin.php', 'f196664ae0db5a4de503827b2fd087ee6d8adec4', 'Blu-Edition'),
('./language/arabic/lang_history.php', '1a96311d423bc2efba8e046ab3c491836f78173a', 'Blu-Edition'),
('./language/arabic/lang_forum.php', 'af95f9d2450035010d4cc85dfa3b185fa775cca5', 'Blu-Edition'),
('./language/arabic/lang_blocks.php', 'a172e820094518ecfcf5f49b8738f3c9eb98747b', 'Blu-Edition'),
('./language/arabic/lang_torrents.php', 'e9f0aa2c25765acd4085f6dbba7ecae976aae1b9', 'Blu-Edition'),
('./language/arabic/lang_polls.php', 'a307a839d2a98f2a3f4bef2e57b1cad5a1034005', 'Blu-Edition'),
('./language/arabic/lang_news.php', 'c469c0978b47f625a4246d9c76d68eca2aedbf30', 'Blu-Edition'),
('./language/arabic/lang_peers.php', '3dcc176aa2bec683465c823ba6bc1551596fa77a', 'Blu-Edition'),
('./language/arabic/lang_account.php', 'e693bf683b9ace608d4fcb3e5906123a75972a48', 'Blu-Edition'),
('./language/chinese/lang_smf_import.php', '29dfc730b404770feeb2b7b2d5525600cd737231', 'Blu-Edition'),
('./language/chinese/lang_recover.php', '1ea26d7012b730359ebcd1424549295a9320f026', 'Blu-Edition'),
('./language/chinese/lang_users.php', 'da865aa94ba236d96afe7ab800335725b7e8a3ca', 'Blu-Edition'),
('./language/chinese/lang_main.php', 'cc6afaa22611f70dc8ace43276dd26b42c1a5fed', 'Blu-Edition'),
('./language/chinese/lang_upload.php', '17c05398c20952ee9fe7f754247a196a8020b4e6', 'Blu-Edition'),
('./language/chinese/lang_login.php', '75f69e23b87713f3f072f7a24d5f2d80aff59693', 'Blu-Edition'),
('./language/chinese/lang_userdetails.php', 'b323de29747ee8f476b6aceeab303b4137d0873c', 'Blu-Edition'),
('./language/chinese/lang_usercp.php', 'f90613af5ad4729dc57f9c32a1e1fe7038116f76', 'Blu-Edition'),
('./language/chinese/lang_viewnews.php', '54310fe3e6f3581bcd6a8527daa44eadad9359ae', 'Blu-Edition'),
('./language/chinese/lang_admin.php', 'fb5634324682e752122a0802dc23bfbb71261ff1', 'Blu-Edition'),
('./language/chinese/lang_history.php', '858609c1da6bccb8a81cacafca70fe37768bf465', 'Blu-Edition'),
('./language/chinese/lang_forum.php', 'c802cf081e18ee152b9f886dd39ccc96c16117df', 'Blu-Edition'),
('./language/chinese/lang_blocks.php', '21c18cfe30a7fefcf2402705d0480fee19dc0dd7', 'Blu-Edition'),
('./language/chinese/lang_torrents.php', '94569b3f684d872a3a07008e17be7e0f9421adc9', 'Blu-Edition'),
('./language/chinese/lang_polls.php', 'f4242c13976778fd0a7cd5522c28907c49631327', 'Blu-Edition'),
('./language/chinese/lang_news.php', 'd0fa1d02a41f621f0d13b6187adf330b3016f1ef', 'Blu-Edition'),
('./language/chinese/Transtaion Agreement.txt', '3ce486e8e12c4ba571e8485c00fd463446c30b96', 'Blu-Edition'),
('./language/chinese/lang_peers.php', 'a4e53c2bc03dfff5f393b9757966fa77385f37ee', 'Blu-Edition'),
('./language/chinese/lang_account.php', '31ad989cc366c9a22a1ef8a6ef6f54956f21927d', 'Blu-Edition'),
('./language/romanian/lang_recover.php', 'a309146e989403aa661c9d40b16aa371653e8d62', 'Blu-Edition'),
('./language/romanian/lang_users.php', '3e2af1b982101e21a9f328d4840723770d5df674', 'Blu-Edition'),
('./language/romanian/lang_upload.php', '39fcfa15f3b8cec24173180269489e8262119faa', 'Blu-Edition'),
('./language/romanian/lang_main.php', '4d809d552e6f48d888163f660455f31808fc93d9', 'Blu-Edition'),
('./language/romanian/lang_login.php', 'e9579efb79d34290ac45ae432577f385025f542c', 'Blu-Edition'),
('./language/romanian/lang_userdetails.php', 'd4b5ce65a25f557aab1b7fb6c5bd7dd37b4bc9c2', 'Blu-Edition'),
('./language/romanian/lang_usercp.php', '22b03d41b11b08991d1eeda6200ec682f9bfb3f5', 'Blu-Edition'),
('./language/romanian/lang_viewnews.php', 'a46a8d6b18a0be83d00f88cd8ad0bea66d9f7e3b', 'Blu-Edition'),
('./language/romanian/lang_admin.php', '548fb129317288ef2b0ee684f31a06c005b6ea59', 'Blu-Edition'),
('./language/romanian/lang_forum.php', '3145e2503113ed5e656c4b078d2f4d1261168455', 'Blu-Edition'),
('./language/romanian/lang_history.php', '52082309980103238fc7910a342bb3235bab1d71', 'Blu-Edition'),
('./language/romanian/lang_blocks.php', 'f3a2abdfd2a0404ad16860aa362b3768ffacac8a', 'Blu-Edition'),
('./language/romanian/lang_torrents.php', 'fe6910172916a3024477cd1f3f4081efb268bd9c', 'Blu-Edition'),
('./language/romanian/lang_polls.php', 'b3e994c69dec80bb31c06e669926af172ba44151', 'Blu-Edition'),
('./language/romanian/lang_news.php', 'dc9c8afcaf4e4b9a0da63661288a1a3e72b88f48', 'Blu-Edition'),
('./language/romanian/lang_account.php', 'cc71d4580660edf2ce525c6a08173d66115f6956', 'Blu-Edition'),
('./language/romanian/lang_peers.php', 'a15529339f2dd5f40603aea83a61604d9fa5371d', 'Blu-Edition'),
('./language/bulgarian/lang_smf_import.php', 'e14ba04ac4f8c55dd5662495c4641edf9d994404', 'Blu-Edition'),
('./language/bulgarian/lang_recover.php', 'a49fde4a87d05c1a7217f2ffc52927de5c0e6bd1', 'Blu-Edition'),
('./language/bulgarian/lang_users.php', 'b9b1df5070c2b901eb29e7ea4780018991d08b2f', 'Blu-Edition'),
('./language/bulgarian/lang_upload.php', '0f7c260400ee59a6ce928c79c686d046c6b53a98', 'Blu-Edition'),
('./language/bulgarian/lang_login.php', '7c3ec4e3308780918e6211ee0beb03664ae66cc5', 'Blu-Edition'),
('./language/bulgarian/lang_main.php', '0cb6f505d999283fa48da2f3489c0b15eacd2dda', 'Blu-Edition'),
('./language/bulgarian/lang_userdetails.php', 'b79e4a1ac58ce1b57b70cbb904af181285d33333', 'Blu-Edition'),
('./language/bulgarian/lang_usercp.php', '488ae0196ef68f3e4638923fd4a77ec9626a85a0', 'Blu-Edition'),
('./language/bulgarian/lang_viewnews.php', '9be4e853e9317c70876f026008d3f3b09bb4e465', 'Blu-Edition'),
('./language/bulgarian/lang_admin.php', '97159378921cbaf5cbdc0fc3d0ad13ccc037a8ee', 'Blu-Edition'),
('./language/bulgarian/lang_history.php', '896854a774450da460b1d9c0fe670816308f4150', 'Blu-Edition'),
('./language/bulgarian/lang_blocks.php', 'fd83fb667f7a35e60b8aee9e9bf75f7e31fcf2db', 'Blu-Edition'),
('./language/bulgarian/lang_forum.php', '465775b55a9689eace937976e20f386ae4d06825', 'Blu-Edition'),
('./language/bulgarian/lang_torrents.php', 'e5516c3159954bef405f69475023da8cd4945a2a', 'Blu-Edition'),
('./language/bulgarian/lang_polls.php', '9bc6612d7c8859db6638fba48bf16f30b98bd368', 'Blu-Edition'),
('./language/bulgarian/lang_peers.php', '1e1f98d695456e7f916b221f9d6395d2077c41cc', 'Blu-Edition'),
('./language/bulgarian/lang_news.php', 'a91e9f26fd24cd77b1509353ca478aaf6767edc6', 'Blu-Edition'),
('./language/bulgarian/lang_account.php', '0d0c3028149c18e35fad28dcbe376f7bb1327489', 'Blu-Edition'),
('./language/english/lang_kocs.php', '80118597c86fe1cbd1e3c7d401aa9e4a6b9beea8', 'Blu-Edition'),
('./language/english/lang_seo.php', '0d753928da6f88b092b97fcf4c2054f439edd785', 'Blu-Edition'),
('./language/english/lang_featured.php', '9558d6200c78997a3149376ed1e0c07b7875c6ff', 'Blu-Edition'),
('./language/english/lang_smf_import.php', 'b91eaa3980d47054b0ad74edf17675abe2726c04', 'Blu-Edition'),
('./language/english/lang_hnr_sanity.php', 'b4e8397a30efe5c8f242c7034cd0ec630c374a02', 'Blu-Edition'),
('./language/english/lang_fav_up_up.php', '2693b02973d19ab4c0b7f0f3bb6221accaaba131', 'Blu-Edition'),
('./language/english/lang_recover.php', 'f67994edef2c21026be64f7e9b7c7a17c1395a23', 'Blu-Edition'),
('./language/english/lang_users.php', '423c2ef75d2b8218e3d806f97a9d7197eaffd635', 'Blu-Edition'),
('./language/english/lang_upload.php', '235bdf0d5eff45a19b1e3763993f7288fd6190c5', 'Blu-Edition'),
('./language/english/lang_login.php', 'b7daf2f657cebe562b51bd40da4edb60d73c0e4a', 'Blu-Edition'),
('./language/english/lang_main.php', '492dd80f95f9b241d757641d5fad206e625bdbd0', 'Blu-Edition'),
('./language/english/lang_subs.php', '5d0896d2166dd119ce531eb46e1ce3be9e8f418c', 'Blu-Edition'),
('./language/english/lang_userdetails.php', '00f3ef273adb5c25233285f9a79fbe5f1d9d2cbd', 'Blu-Edition'),
('./language/english/lang_usercp.php', '3d0310a77916dda6f769f5f446cc57b15be1f870', 'Blu-Edition'),
('./language/english/lang_lottery.php', 'a07dcdaeb4f3ab506089b6a49fd81da005cf7752', 'Blu-Edition'),
('./language/english/lang_viewnews.php', 'c2a4a6a04188c4fc63851b5d166ff0e8bc2e83b5', 'Blu-Edition'),
('./language/english/lang_xtd.php', 'b5b0be385b25b034e69113ba360ec2930df2cb32', 'Blu-Edition'),
('./language/english/lang_shoutcast.php', 'aa5922e3b34ea1dbcc24272e18922db04d0c451c', 'Blu-Edition'),
('./language/english/lang_aads.php', 'd40e83ce9d5dfa60028096eacf78a27fbb51c36d', 'Blu-Edition'),
('./language/english/lang_admin.php', '6c194403cba5b7630514699fb05e6e603781e891', 'Blu-Edition'),
('./language/english/lang_kis.php', '772c47f667e368447255c70213c595e6e399a034', 'Blu-Edition'),
('./language/english/lang_my_uploads.php', '77d0bc6bab4a9a3ba8996d6df1acb9c10c5a6abe', 'Blu-Edition'),
('./language/english/lang_history.php', 'babde6e02bea8d945ab2c14eda841ff31266d00b', 'Blu-Edition'),
('./language/english/lang_forum.php', 'bce2d1a07a868ae93941a1e8176a7aff7b282eae', 'Blu-Edition'),
('./language/english/gallery_lang.php', '3d130f5db6346a31fb8588e7e250a2e077d6290a', 'Blu-Edition'),
('./language/english/lang_khez.php', '298fb22c456aeb2d1aabeab809fdf8804faa405f', 'Blu-Edition'),
('./language/english/lang_blocks.php', 'ddb70f0ae5291d9d6b12bae89b67ff4a738c361b', 'Blu-Edition'),
('./language/english/lang_requests.php', '5a22f94286ffd133398f8410a3e8bf58ecf7644b', 'Blu-Edition'),
('./language/english/lang_blackjack.php', '073863ca96cc1f80c1ddac651d87ce4c7dae7976', 'Blu-Edition'),
('./language/english/lang_torrents.php', '2c01188973e825323d59e5d502a1b3a788dd2d73', 'Blu-Edition'),
('./language/english/lang_polls.php', '3fefdc188642149c5ac0d5aa678767e50aa9c4a5', 'Blu-Edition'),
('./language/english/lang_news.php', '191bbe8775826f9fd2c47589167d0be6f927d9c0', 'Blu-Edition'),
('./language/english/lang_downloadcheck.php', 'd207b0dcc3e51154ced3a788aa0ef665b57f4123', 'Blu-Edition'),
('./language/english/lang_teams.php', '9f5d3a3ac0a62cf431996c6908ced4d0402944fa', 'Blu-Edition'),
('./language/english/lang_style_lang.php', '27a7aeca1fc2306d0cce59f5ccb003ff649bfdcf', 'Blu-Edition'),
('./language/english/lang_file_hosting.php', 'e8f55fdd877ec82ae970708dc1fb454b5b3e86c9', 'Blu-Edition'),
('./language/english/lang_peers.php', 'cbf8e812de255e5919652e866edf004d30177033', 'Blu-Edition'),
('./language/english/lang_staff_announcements.php', '98e512f254b2806d9bacb63c6f5843db12fce9aa', 'Blu-Edition'),
('./language/english/lang_agree.php', 'b470bb7c8d20352a060fa1817802d55429b241a8', 'Blu-Edition'),
('./language/english/lang_account.php', '15f0b890a657278e9c668744536ea1b37890118c', 'Blu-Edition'),
('./language/english/lang_ipb_import.php', '0ff0fe8bedce82e29173a0e6403ac35f9f23ca24', 'Blu-Edition'),
('./language/english/lang_apply_membership.php', '01bf2f321ae853257d3a586496f825aaadd4f508', 'Blu-Edition'),
('./language/serbocroatian/lang_smf_import.php', 'c933ca0e16b720360b971ddde66d4e302d2a1de5', 'Blu-Edition'),
('./language/serbocroatian/lang_recover.php', '42e01d0b4a8515413fd3ea2d103602ebbcc5ea9b', 'Blu-Edition'),
('./language/serbocroatian/lang_users.php', '088eb2a7f76488a5649e8ea32c3a556300cc0e70', 'Blu-Edition'),
('./language/serbocroatian/lang_upload.php', '273db1f7738bccf4e912aa025afa7ff7893d5ffe', 'Blu-Edition'),
('./language/serbocroatian/lang_main.php', '8f0b7bd91f68b0ff9c1e939ee4152ffc323170e7', 'Blu-Edition'),
('./language/serbocroatian/lang_login.php', '4d4bdf6b4b9a08e749269e7d1883cec07bf88431', 'Blu-Edition'),
('./language/serbocroatian/lang_userdetails.php', 'c267beddf9dff5fe4e09f6f0a7ea82cbc69f20f1', 'Blu-Edition'),
('./language/serbocroatian/lang_usercp.php', 'bb3c1d7b075f63e251fbcbe50cfe58d01e41aaa9', 'Blu-Edition'),
('./language/serbocroatian/lang_admin.php', '79abac64ef8016406b86f75de88e806b1ce58922', 'Blu-Edition'),
('./language/serbocroatian/lang_viewnews.php', 'f7b8d946d613ccc8a35c0dbc498b767630e8f4b6', 'Blu-Edition'),
('./language/serbocroatian/lang_history.php', '2a1d48cbaf35e5d1f3958380deb197449c33fb14', 'Blu-Edition'),
('./language/serbocroatian/lang_forum.php', '7fe1b073a3a0e42bf2bb5d639698b6b32a666da9', 'Blu-Edition'),
('./language/serbocroatian/lang_blocks.php', 'ad413bf0271ee86a097c6446b5f112f3f6da845e', 'Blu-Edition'),
('./language/serbocroatian/lang_torrents.php', 'c9581929a76831e1fb8642d9834d25579537890d', 'Blu-Edition'),
('./language/serbocroatian/lang_polls.php', '7b7c26ea56d1a9faa3789366f2051dbdcd34988c', 'Blu-Edition'),
('./language/serbocroatian/lang_news.php', '1971757ad1e00c3ce7a06a819210b5478a306ffb', 'Blu-Edition'),
('./language/serbocroatian/lang_peers.php', '29c62b517b7eeb3b78d3b6a946174cd5c98cd1a5', 'Blu-Edition'),
('./language/serbocroatian/lang_account.php', 'c0b5562c6d76bf6ea368815b9d6dd540c917ef59', 'Blu-Edition'),
('./language/hungarian/lang_smf_import.php', '314332e228fde112873511477ada022e60bf2346', 'Blu-Edition'),
('./language/hungarian/lang_recover.php', 'd73245a5ee30448ac8f03bb574614b6a1e7732d4', 'Blu-Edition'),
('./language/hungarian/lang_users.php', '6399cdb8a2250817954b5497834d8268946bc816', 'Blu-Edition'),
('./language/hungarian/lang_upload.php', 'c771a1d665d0c1530b1bfc6e93bfb0f11832741e', 'Blu-Edition'),
('./language/hungarian/lang_main.php', '76d2d352c5e580382950d0ca5ec845de3604b047', 'Blu-Edition'),
('./language/hungarian/lang_login.php', '5b7b28b08403cb1430285946294e3edb11465a13', 'Blu-Edition'),
('./language/hungarian/lang_userdetails.php', '85f0b6a73f9982dca941d9dca7734031ee32614d', 'Blu-Edition'),
('./language/hungarian/lang_usercp.php', 'b2a00de72bbc9995aeebe7b74982d79e49916efb', 'Blu-Edition'),
('./language/hungarian/lang_viewnews.php', 'c136ba3fd4712a0e6ee71a8a6b56e3df91dbac91', 'Blu-Edition'),
('./language/hungarian/lang_admin.php', 'b038ee3a393b19c5ce83c30d1405e31d5ac0545a', 'Blu-Edition'),
('./language/hungarian/lang_history.php', 'c677ba7176058a0683732d28ba6a547fcec8d799', 'Blu-Edition'),
('./language/hungarian/lang_forum.php', 'c9e7ff8a7b482f67ada3a63449bda14675fa1edc', 'Blu-Edition'),
('./language/hungarian/lang_blocks.php', '3d6b9ccfc5c5add3622fe1d0389011f1d17a799f', 'Blu-Edition'),
('./language/hungarian/lang_torrents.php', 'ba849dcce4e4317ce5116920c086129455436877', 'Blu-Edition'),
('./language/hungarian/lang_polls.php', 'b36cbd84bc1b33732ddf47a4897067452367b5d4', 'Blu-Edition'),
('./language/hungarian/lang_news.php', 'add0e9fdd6834502d9123ecca640896161ece0fa', 'Blu-Edition'),
('./language/hungarian/lang_peers.php', '886d143748a594db6f0b34baa17c269feb1e6bca', 'Blu-Edition'),
('./language/hungarian/lang_account.php', '84b27e04fc163eb9687d382c6c4b0135fb8bfa60', 'Blu-Edition'),
('./language/swedish/lang_smf_import.php', 'b3854bc5e40286f54c2a3ecaf28bd91384abd57c', 'Blu-Edition'),
('./language/swedish/lang_recover.php', '57b458441ca314847e9c70e8fc487b60925864b1', 'Blu-Edition'),
('./language/swedish/lang_users.php', '4a1c6d7c8e96a4b1a12f6257748829de75ec25d8', 'Blu-Edition'),
('./language/swedish/lang_upload.php', 'f48d729e53f3355ba6898f6b1580f05b77510ab6', 'Blu-Edition'),
('./language/swedish/lang_main.php', 'd63943da56628fa3cae0c132a5d84ecb41bc08e9', 'Blu-Edition'),
('./language/swedish/lang_login.php', '572d5128a3f4ab7c9122942ab11190800903e50f', 'Blu-Edition'),
('./language/swedish/lang_subs.php', '27dd613d4f1ce6f76bef333f8c71e6bbbb2d731b', 'Blu-Edition'),
('./language/swedish/lang_userdetails.php', 'eff2bd32f1f063d047354f4b0b88e73d65554c34', 'Blu-Edition'),
('./language/swedish/lang_lottery.php', 'b6f148121f03287beead0cb32c6e3c48925258b7', 'Blu-Edition'),
('./language/swedish/lang_usercp.php', '7742f98b2eb6f1b75c5d331a0c8a6dbab61f63f1', 'Blu-Edition'),
('./language/swedish/lang_viewnews.php', 'b4903b2d29a5a1c476c802454024f8ee2d8577d5', 'Blu-Edition'),
('./language/swedish/lang_xtd.php', 'bbbcb14ee38969205c31df0d0caae88ddb465028', 'Blu-Edition'),
('./language/swedish/lang_alternate_login.php', '9f6f26227ed495e9afc944d1c05bc8d2b079aba1', 'Blu-Edition'),
('./language/swedish/lang_shoutcast.php', '43ffa788395484ae659984347811b09a3eacf825', 'Blu-Edition'),
('./language/swedish/lang_aads.php', '286d96b97849838868d4b73ca649f1cf75a0d7ce', 'Blu-Edition'),
('./language/swedish/lang_admin.php', 'c852ab2009f9da5b2d8d5ff5b7c6e5c6fd16b199', 'Blu-Edition'),
('./language/swedish/lang_history.php', '31838f0093adfe28727802c60c1cb6af88952983', 'Blu-Edition'),
('./language/swedish/lang_forum.php', '2a2f9988f68db2506c43598a73fa329bbf9f039c', 'Blu-Edition'),
('./language/swedish/gallery_lang.php', 'df97c62fc0dd5ff2ab2a72db1b04e4ef597eb711', 'Blu-Edition'),
('./language/swedish/lang_classic_blackjack.php', '0d89222115a3c400f1c158e77c654702f7250ab1', 'Blu-Edition'),
('./language/swedish/lang_blocks.php', 'ce65ba98f33e4d13dbab90371e4f6cc2a9417bd6', 'Blu-Edition'),
('./language/swedish/lang_khez.php', '512a4405420960dbc2a68b3c678869ffff219bf8', 'Blu-Edition'),
('./language/swedish/Credits.txt', 'f065e603ced19cdd4eed5354ecc699dbda8b6187', 'Blu-Edition');
INSERT INTO `blu_baseline` (`file_path`, `file_hash`, `acct`) VALUES
('./language/swedish/lang_torrents.php', 'ab3a117e58adf68ab267d18821e3eaf6bb3a69af', 'Blu-Edition'),
('./language/swedish/lang_polls.php', '0ed892837086bd3bb87d58fd70eae09af48ad2a2', 'Blu-Edition'),
('./language/swedish/lang_downloadcheck.php', '676abc18b17fd7ab3c0f86c867a9255880d49829', 'Blu-Edition'),
('./language/swedish/lang_news.php', 'cc0242bc14b8d16bc5cf1ce41f0a800cbeb78a70', 'Blu-Edition'),
('./language/swedish/lang_teams.php', 'e33615028677ca43904da094562c244fa752c8cd', 'Blu-Edition'),
('./language/swedish/lang_style_lang.php', 'b635307d4f750993d298ddc6e2e9ec07339f47fb', 'Blu-Edition'),
('./language/swedish/lang_peers.php', '7da7605843192ab0d2f92a03e5e2c697964d5063', 'Blu-Edition'),
('./language/swedish/lang_staff.php', '4b0e807792d08dfedb05dc3def09386051d5f47e', 'Blu-Edition'),
('./language/swedish/lang_account.php', '34ead62d515a3a4de1f0a76751a51af710278265', 'Blu-Edition'),
('./language/swedish/lang_agree.php', 'a310cba774b82304d29b66d4db3f3361fc80e68e', 'Blu-Edition'),
('./language/portuguese-BR/ReadMe.txt', '62534ddf00637487a67a0ab6e5db8d743c710b75', 'Blu-Edition'),
('./language/portuguese-BR/lang_smf_import.php', '152dacab5ed4b357de0988ea077aa256cad6567f', 'Blu-Edition'),
('./language/portuguese-BR/lang_recover.php', '877b116d772a7e70cfb484ae2ef1105e56bf75ad', 'Blu-Edition'),
('./language/portuguese-BR/lang_users.php', 'cecc76afe692f21f166fd04080b733fd6562fc79', 'Blu-Edition'),
('./language/portuguese-BR/lang_upload.php', '8a38eaa313d4c6c680dafe7e8fc895102b1efb0d', 'Blu-Edition'),
('./language/portuguese-BR/lang_main.php', '057acf49befc692d92c39eee98de2c3c1860e0e6', 'Blu-Edition'),
('./language/portuguese-BR/lang_login.php', '6d3ca2ed41e64b5b964d7f31d54a94e918b741e6', 'Blu-Edition'),
('./language/portuguese-BR/lang_subs.php', 'e5f91f1cde42e4fac115b05b9f22c2a48effbe5e', 'Blu-Edition'),
('./language/portuguese-BR/lang_userdetails.php', 'ff9871a2fc62cd23eaa50a2875e93d35759013b1', 'Blu-Edition'),
('./language/portuguese-BR/lang_lottery.php', '65e1692846108a136e7086f7ec33e2cc95c391a4', 'Blu-Edition'),
('./language/portuguese-BR/lang_usercp.php', '26e5a9c43f1ea825344af4d43a1dfe1a1c25004b', 'Blu-Edition'),
('./language/portuguese-BR/lang_viewnews.php', '7e4f0b37065042d11fcdb413f66edbef9ac4b2c3', 'Blu-Edition'),
('./language/portuguese-BR/lang_xtd.php', '63bf9e68692d7cdef073829611ce4964b56ffbac', 'Blu-Edition'),
('./language/portuguese-BR/lang_shoutcast.php', '135cb05146bd56a9d10a42db17ab6eee9c240809', 'Blu-Edition'),
('./language/portuguese-BR/lang_admin.php', 'ee0363cbfc7673ebd2f77d10dd159ed4409251ea', 'Blu-Edition'),
('./language/portuguese-BR/lang_history.php', '13f8beba43155924082a85be4662605daccf322d', 'Blu-Edition'),
('./language/portuguese-BR/lang_forum.php', '44a85868e73454cc28e294713e6a93e5d13a5fcd', 'Blu-Edition'),
('./language/portuguese-BR/lang_blocks.php', '351c1b57b7290a95126b2e3cd79666c17c460dee', 'Blu-Edition'),
('./language/portuguese-BR/lang_khez.php', '72620332f822aa6fd1d8376d72fbf090cef9b3b2', 'Blu-Edition'),
('./language/portuguese-BR/lang_torrents.php', '732ab9751f9263b6ec86b4c4e1b10013a1b6c4c5', 'Blu-Edition'),
('./language/portuguese-BR/lang_polls.php', '1133f47d088e08cbfccb4d7b5a0156e943ef6eb6', 'Blu-Edition'),
('./language/portuguese-BR/lang_downloadcheck.php', '65839e21b490b555ade9dd7c04604e917ef47969', 'Blu-Edition'),
('./language/portuguese-BR/lang_news.php', '20397eb051b32662d8224674488de3ea29caa182', 'Blu-Edition'),
('./language/portuguese-BR/lang_peers.php', '521c204a6461d8e072841799aee176cfb19233c0', 'Blu-Edition'),
('./language/portuguese-BR/lang_account.php', '37aba4c7f5d6ce161275f5e17eb8bfe21ffbbdb2', 'Blu-Edition'),
('./language/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./language/italian/lang_smf_import.php', 'c0361cd6f611862fc3170a1965c4f76f7747d854', 'Blu-Edition'),
('./language/italian/lang_recover.php', 'e817da1f58907a0147d1bb3ed28d1478beee66aa', 'Blu-Edition'),
('./language/italian/lang_users.php', 'e279250e4346d9eba7d4efbcb55206f9dd77db85', 'Blu-Edition'),
('./language/italian/lang_upload.php', '6caea53f3ea19e8457d75c71c65d9d521c7ddb3a', 'Blu-Edition'),
('./language/italian/lang_main.php', 'd77d05bc0a4bbc728ba3348f3eae46ed09316a6d', 'Blu-Edition'),
('./language/italian/lang_login.php', '774b3460b09c400aa66d358c00b0cd868fd72fbf', 'Blu-Edition'),
('./language/italian/lang_userdetails.php', '87b0e484729e72aae172c5909a6efccc3b28c8fa', 'Blu-Edition'),
('./language/italian/lang_usercp.php', '4ea37333025ab95e5732291a0173658e4a90ff3c', 'Blu-Edition'),
('./language/italian/lang_viewnews.php', '600896191e3d9d5664543beac7c39b250fa9f03f', 'Blu-Edition'),
('./language/italian/lang_admin.php', '477a246f5dfed485ef344f7e242ddee4f5489581', 'Blu-Edition'),
('./language/italian/lang_history.php', '2d6a2984f38ccce93031227f647cfe259df70563', 'Blu-Edition'),
('./language/italian/lang_forum.php', '6008463dc4429e6933d67af3ffb2b2de2aabd0fb', 'Blu-Edition'),
('./language/italian/lang_blocks.php', '678a62ab1b331e22861faa27a9bd8a3620893f7a', 'Blu-Edition'),
('./language/italian/lang_torrents.php', '29ef5d1afe3068429743b989a8485871154aead3', 'Blu-Edition'),
('./language/italian/lang_polls.php', '88372241a84e90788e462985be0a7730e8f30d3f', 'Blu-Edition'),
('./language/italian/lang_news.php', 'cfa0896d7156821ea04d156db3f60c774694d3cb', 'Blu-Edition'),
('./language/italian/lang_peers.php', '828ecc2e18ac55a50bc3e37bbfd47ffb132dc6e3', 'Blu-Edition'),
('./language/italian/lang_account.php', '68a10d49f2f8a2a232d732b6def49b68d6ceb29f', 'Blu-Edition'),
('./language/greek/lang_smf_import.php', 'b4c7388feb50d26d3f56809b1e597dffbe355069', 'Blu-Edition'),
('./language/greek/lang_recover.php', 'cb848fa4674b22d2547fefeecdac3c227451e512', 'Blu-Edition'),
('./language/greek/lang_users.php', '636b2f83be734771d70aa0dc081a55fa36b90b73', 'Blu-Edition'),
('./language/greek/lang_upload.php', 'e4928571a2aac1c3e49559df6ab1a8134f772cdf', 'Blu-Edition'),
('./language/greek/lang_main.php', '6820a85121c16b7ceec19dc695f926b60285fdc0', 'Blu-Edition'),
('./language/greek/lang_login.php', '44e6491b644850aeedb65a209603f01db94b8add', 'Blu-Edition'),
('./language/greek/lang_userdetails.php', 'c5131221dc83b147eee9f5e3974eb5a5ac1a4f60', 'Blu-Edition'),
('./language/greek/lang_usercp.php', 'e6b9b9ae0f2e691b99b549594c04145677cb4167', 'Blu-Edition'),
('./language/greek/lang_viewnews.php', 'a54ffd43d3b9d8128720d6504ab28bbde11d3ae9', 'Blu-Edition'),
('./language/greek/lang_admin.php', '93d87f9143e68ed35d81fc6fb9f9e760d80d538b', 'Blu-Edition'),
('./language/greek/lang_history.php', '4e43760d34efca3fc3cb926eedcd0c546b357d98', 'Blu-Edition'),
('./language/greek/lang_forum.php', '01e4604e16c9603cf44b0024ea7d1304b1e5e5da', 'Blu-Edition'),
('./language/greek/lang_blocks.php', '9539227397f3ebb686e199cac7142272de8a12a3', 'Blu-Edition'),
('./language/greek/lang_torrents.php', 'b8f147fdcfade52c3885ead558df843c94647823', 'Blu-Edition'),
('./language/greek/lang_polls.php', '4d852b933bfb05f7f62c143aff4ce2301021bbec', 'Blu-Edition'),
('./language/greek/lang_news.php', '4675b8d10a4c965a33dd3abbef2dfb7e26f9dff9', 'Blu-Edition'),
('./language/greek/lang_peers.php', '34c8ed25dd95ead92736ce144105872770361ab8', 'Blu-Edition'),
('./language/greek/lang_account.php', 'b73d03cd2ca530c906cae9aedd808ed23d6e9499', 'Blu-Edition'),
('./language/vietnamese/lang_smf_import.php', 'b91eaa3980d47054b0ad74edf17675abe2726c04', 'Blu-Edition'),
('./language/vietnamese/lang_recover.php', 'dc3fcafbacd7c952390bd9923429e9376639c6ce', 'Blu-Edition'),
('./language/vietnamese/lang_users.php', '66ef233baefefd367e2ca3792c9926b33afa9908', 'Blu-Edition'),
('./language/vietnamese/lang_upload.php', '06cd58423a5a127d210809319842d8cd41956560', 'Blu-Edition'),
('./language/vietnamese/lang_main.php', 'bd4751d23c4d263d405c2a7a5a8cf27192d760f7', 'Blu-Edition'),
('./language/vietnamese/lang_login.php', '04d1792f2d960785c17778def976fef72c34c85e', 'Blu-Edition'),
('./language/vietnamese/lang_userdetails.php', '972ac53bf1f8f75ad9b7e0861391d25a3762e567', 'Blu-Edition'),
('./language/vietnamese/lang_usercp.php', '58543216be8acd238a1c92e0ff8b6417469ed492', 'Blu-Edition'),
('./language/vietnamese/lang_viewnews.php', '6edf4752e417581a5b7c3b281e73364b63c98a98', 'Blu-Edition'),
('./language/vietnamese/lang_admin.php', 'a8568f8ab6123c8381bee88b24c1c1f91c247129', 'Blu-Edition'),
('./language/vietnamese/lang_history.php', '38778a884249235def51832da5688e2eeacc0cc3', 'Blu-Edition'),
('./language/vietnamese/lang_forum.php', 'ff9ebd9add5c760d826eba2903c0d78d59da2bb7', 'Blu-Edition'),
('./language/vietnamese/lang_blocks.php', 'b584be8387e02783e1bd95bf515febfb36025292', 'Blu-Edition'),
('./language/vietnamese/lang_torrents.php', '684ae61c0969612c79ec8efc904df335b8a5e73d', 'Blu-Edition'),
('./language/vietnamese/lang_polls.php', '828b932cef92d0ee629354e8208b7cbeeac27e62', 'Blu-Edition'),
('./language/vietnamese/lang_news.php', '026a25a53188fe3bf6a655cd9852a17f2a1ff596', 'Blu-Edition'),
('./language/vietnamese/lang_peers.php', 'c61cd89d6217b945cadc155af44c6436c8aeff44', 'Blu-Edition'),
('./language/vietnamese/lang_account.php', 'cce9a87efc99bd6817a744ee4c0100db1d9aa204', 'Blu-Edition'),
('./language/portuguese-PT/lang_smf_import.php', 'df2848ab7bd1a88f1fab326284feee3d36e427dd', 'Blu-Edition'),
('./language/portuguese-PT/lang_recover.php', '14b8bc255e555253b69367452c3728ddac366f8c', 'Blu-Edition'),
('./language/portuguese-PT/lang_users.php', 'c24147f8ffd83565e6f5ad97e14b88943fe1ba98', 'Blu-Edition'),
('./language/portuguese-PT/lang_upload.php', '96ed8c6835f9779c8f5f2b38baf5e9d2c7101418', 'Blu-Edition'),
('./language/portuguese-PT/lang_main.php', 'a4b2a70119f46f63811db238d0c484dba5668e43', 'Blu-Edition'),
('./language/portuguese-PT/lang_login.php', '9822023dc02b97c4de3bd0d6ce0c3b7b5ea7029a', 'Blu-Edition'),
('./language/portuguese-PT/lang_userdetails.php', '25ab044e8c1455eefe0cb68d382ac7840d70b855', 'Blu-Edition'),
('./language/portuguese-PT/lang_usercp.php', '785aca5daf813a55af445debfa249bdea84cc3c3', 'Blu-Edition'),
('./language/portuguese-PT/lang_viewnews.php', '7e4f0b37065042d11fcdb413f66edbef9ac4b2c3', 'Blu-Edition'),
('./language/portuguese-PT/lang_admin.php', 'eff83544ab223ba8c5f80ac2fe440338ceafbde2', 'Blu-Edition'),
('./language/portuguese-PT/lang_history.php', '5e097fc81b3e2e0ddda0de210e5947caab3eb808', 'Blu-Edition'),
('./language/portuguese-PT/lang_forum.php', 'c3aa7642f9e4d62b356e95fc521ffc96c3e5ecc4', 'Blu-Edition'),
('./language/portuguese-PT/lang_blocks.php', '8d505f923d75867d4304c5ae31783b488b539651', 'Blu-Edition'),
('./language/portuguese-PT/lang_torrents.php', 'c7d21d5f10082f09603e0964e66ad7684f14f5dd', 'Blu-Edition'),
('./language/portuguese-PT/lang_polls.php', 'ec2ba433352f35362f9ca7809035fa622ecf3497', 'Blu-Edition'),
('./language/portuguese-PT/lang_news.php', '4baa02090a610b51d1135ef9b9d1df88c6b378b8', 'Blu-Edition'),
('./language/portuguese-PT/lang_peers.php', '78ba1168893907cc507355373f3ddb13f0691cc1', 'Blu-Edition'),
('./language/portuguese-PT/lang_account.php', '137dba79e79a696eace507656b7870e6a8ba259f', 'Blu-Edition'),
('./language/dutch/lang_smf_import.php', '00ab5549df8442acea0dd02f5166cf7c99a4695f', 'Blu-Edition'),
('./language/dutch/lang_recover.php', '9cde14aecc59b14186941afee73a2ff4f65b752c', 'Blu-Edition'),
('./language/dutch/lang_users.php', 'a190d66816a0683ed6760d442695d4726eb99815', 'Blu-Edition'),
('./language/dutch/lang_upload.php', 'e7ef1ebea6083072f75b7366426a0d3a593706ae', 'Blu-Edition'),
('./language/dutch/lang_main.php', 'e2e43eaa8cbde746609003fac5563985de178e20', 'Blu-Edition'),
('./language/dutch/lang_login.php', '6155ca2d41dc0cb4070fdfa9608e011cd767edac', 'Blu-Edition'),
('./language/dutch/lang_userdetails.php', '9a8f91e98ebaba571548ce57c9dec1c69fb418e8', 'Blu-Edition'),
('./language/dutch/lang_usercp.php', '0284971c66fd961d472abde1dac0f2145a7b35b2', 'Blu-Edition'),
('./language/dutch/lang_viewnews.php', '06bc340b022ea99c01b89e2ae2c8f46e6a977276', 'Blu-Edition'),
('./language/dutch/lang_admin.php', '16319e78e1052ce2bc682d11a67ce8434b7818f5', 'Blu-Edition'),
('./language/dutch/lang_history.php', '63bf7a440fc0b2c5ae7cb1056690a0b0865c4640', 'Blu-Edition'),
('./language/dutch/lang_forum.php', 'f78411598539e200787417f0a08b3ff2504cddac', 'Blu-Edition'),
('./language/dutch/lang_blocks.php', 'f10bf1fa7ff8426978c0cd0187372544087a3b7f', 'Blu-Edition'),
('./language/dutch/lang_torrents.php', '7c1c4350a77b8d6af4d839bdf062c46e126bb228', 'Blu-Edition'),
('./language/dutch/lang_polls.php', 'ff0730e512e68bbf21af78de3da01ec98a942ed5', 'Blu-Edition'),
('./language/dutch/lang_news.php', '236f3740a974b6ec9a081720123423ac88149eb1', 'Blu-Edition'),
('./language/dutch/lang_peers.php', 'cec1ccfad3603b2ada1799c5eb5671129cebc8a6', 'Blu-Edition'),
('./language/dutch/lang_account.php', 'd463e0ff404df3f83b13a3968f4e761051506589', 'Blu-Edition'),
('./language/danish/lang_smf_import.php', '1fe6b30bfcf9bb9197bef9ad060d6abbedb504ad', 'Blu-Edition'),
('./language/danish/lang_recover.php', '3903bff4d8b7e808b535d2b1e8dc81727108c98f', 'Blu-Edition'),
('./language/danish/lang_users.php', '190c997cccbb67f9f393dc3e158edb103f495782', 'Blu-Edition'),
('./language/danish/lang_upload.php', '659425a0d81514773bb78c542bdb3ce9b7238843', 'Blu-Edition'),
('./language/danish/lang_main.php', '5ee636d144957375fa2357f7446fedd7f0e7f433', 'Blu-Edition'),
('./language/danish/lang_login.php', 'b62149007b93442b187c3b9832f605d2b9ea13b4', 'Blu-Edition'),
('./language/danish/lang_userdetails.php', '0f44b60f9b39237bd60c4029754fa403aa483360', 'Blu-Edition'),
('./language/danish/lang_usercp.php', '014b1641d26b82d88db7f7df02af4c5501a2e361', 'Blu-Edition'),
('./language/danish/lang_viewnews.php', '8f8e9f12009dda0b0044da610e4154483d2543af', 'Blu-Edition'),
('./language/danish/lang_admin.php', '1c01e23bd191c6a9c3a2ec004a023acff0132887', 'Blu-Edition'),
('./language/danish/lang_history.php', 'f77baf2fa9f487dc9ba740bcd52f17fc285b5a44', 'Blu-Edition'),
('./language/danish/lang_forum.php', '443779e045d37c64a5563431572602bffa2c6b46', 'Blu-Edition'),
('./language/danish/lang_blocks.php', '1cca038f60286765c33060656da3edfa15da8974', 'Blu-Edition'),
('./language/danish/lang_torrents.php', '977dc3e203db34b26e305a7d78d2e42577ccf35d', 'Blu-Edition'),
('./language/danish/lang_polls.php', '95f01e253260933589efa5a6246bcf8cd8e650ba', 'Blu-Edition'),
('./language/danish/lang_downloadcheck.php', 'e985a3193281d9643593ec3b285e4574f5d290bf', 'Blu-Edition'),
('./language/danish/lang_news.php', 'e94821d1c6b87f020c10fd188693f30a049aa2d0', 'Blu-Edition'),
('./language/danish/lang_peers.php', '1a13b268812cb8bac6fdfdf5b234bb7da1cbd23a', 'Blu-Edition'),
('./language/danish/lang_account.php', '71299010dccc3cd5049bcec72f515f98f484cb88', 'Blu-Edition'),
('./language/bangla/lang_smf_import.php', '29dfc730b404770feeb2b7b2d5525600cd737231', 'Blu-Edition'),
('./language/bangla/lang_recover.php', 'b0e302c538922fca788f207a109d3ca67ea191e1', 'Blu-Edition'),
('./language/bangla/lang_users.php', 'e056940b9813692e51c215a275c3fc73104a29a4', 'Blu-Edition'),
('./language/bangla/lang_upload.php', 'dc7aaa96845d27a357f0940c9d25de3370c593fe', 'Blu-Edition'),
('./language/bangla/lang_main.php', '5aaeb30293d14ebca6522faaba8206d7cdfb6445', 'Blu-Edition'),
('./language/bangla/lang_login.php', 'd5d8f878250df005c5d09cf50181b644e2900b58', 'Blu-Edition'),
('./language/bangla/lang_userdetails.php', '18f516340a4202d0b7a636123a42105455ccbf2c', 'Blu-Edition'),
('./language/bangla/lang_usercp.php', 'fe299963a40c5e1d7ad815d6a593cf68912fb014', 'Blu-Edition'),
('./language/bangla/lang_viewnews.php', 'c92a97b3185709a692faaa17fd546efccbf1899d', 'Blu-Edition'),
('./language/bangla/lang_admin.php', 'dcb1af5dc289b38a36f964ad76b81e6a2587ceb8', 'Blu-Edition'),
('./language/bangla/lang_history.php', 'babde6e02bea8d945ab2c14eda841ff31266d00b', 'Blu-Edition'),
('./language/bangla/lang_forum.php', '79cd748760ed9ca878ce528307e9f80d419d34e6', 'Blu-Edition'),
('./language/bangla/lang_blocks.php', '39e672ac1c69df509a1729f5b6a70d1f13984320', 'Blu-Edition'),
('./language/bangla/lang_torrents.php', '4b7ad14f6befd4b9bade0e07da5807aef851ba7a', 'Blu-Edition'),
('./language/bangla/lang_polls.php', 'ba6172d78e57cd6b8beba861cf45fcb3bac2b297', 'Blu-Edition'),
('./language/bangla/lang_news.php', 'a2a397f11bbcb8aa3d8178c2eb80a9b88009c908', 'Blu-Edition'),
('./language/bangla/lang_peers.php', '9284a2a4dc75a1b4ed2a12e092cfb256eeb3a73c', 'Blu-Edition'),
('./language/bangla/lang_account.php', 'c5f61fbadc187da98804bc99125c4ce4cc4361b4', 'Blu-Edition'),
('./language/finnish/lang_smf_import.php', 'e14ba04ac4f8c55dd5662495c4641edf9d994404', 'Blu-Edition'),
('./language/finnish/lang_recover.php', '37d810eed813b58c3307d4dc05f1b4c5022c717c', 'Blu-Edition'),
('./language/finnish/lang_users.php', '6c5dc188a41c54d6dfe9ac59532f37e8a5e90eb2', 'Blu-Edition'),
('./language/finnish/lang_upload.php', 'c3598133e2c5fc78385cc71079914dc7c53d2eb5', 'Blu-Edition'),
('./language/finnish/lang_main.php', 'a2a42cffd0044ac04137aee0004bd2f74e415bff', 'Blu-Edition'),
('./language/finnish/lang_login.php', '13d9b75908a901e091cb8e75d69c4584e920a5a4', 'Blu-Edition'),
('./language/finnish/lang_userdetails.php', 'ae26eb32d3113c61aa9675bc22830aa10b665c71', 'Blu-Edition'),
('./language/finnish/lang_usercp.php', '2d31cac58d02a1aceaf62bd2c1c68358c564ea6f', 'Blu-Edition'),
('./language/finnish/Readme.txt', 'deccc698d5074b8a1acf72d53096fc2ccf3eefda', 'Blu-Edition'),
('./language/finnish/lang_viewnews.php', 'd29df72562005959d592d674b58aead9e31e9b70', 'Blu-Edition'),
('./language/finnish/lang_admin.php', '3d82d4311000166ed29ac29e248a35093e40c7ae', 'Blu-Edition'),
('./language/finnish/lang_history.php', '6281cd8c3c716f096e5842ac9200d21c007515a7', 'Blu-Edition'),
('./language/finnish/lang_forum.php', '13342f80c45db5a7607a0fc4e5ee61a800731a5b', 'Blu-Edition'),
('./language/finnish/lang_blocks.php', '25b850acdf594feefab5ff33e3003029387c7a05', 'Blu-Edition'),
('./language/finnish/lang_torrents.php', 'c8607f992e4519f246fb9770941235e6c0f6f881', 'Blu-Edition'),
('./language/finnish/lang_polls.php', 'bf48dcb61545efb358c79d46caa3cde0b46cc199', 'Blu-Edition'),
('./language/finnish/lang_news.php', '5552bea3e022beeac59d89db07dded84877e165f', 'Blu-Edition'),
('./language/finnish/lang_peers.php', '0bb95e5cb7f9d84ad83a91e6d95bf108f981bca0', 'Blu-Edition'),
('./language/finnish/lang_account.php', 'bbe4823c64e03717bd6cd93d525b0553a203bed7', 'Blu-Edition'),
('./friendlist.php', '7651663020895ed6f8a494729dfb9d3ae28b87b3', 'Blu-Edition'),
('./paypal.php', 'cab4cba20f3faee4afae0e9734a2ad0ed9aa3a0a', 'Blu-Edition'),
('./takeexpect.php', 'ff525f7dc566420847ebd28977e8adf0ad6ad0d5', 'Blu-Edition'),
('./contact_Bug Reports.txt', '4096d2c5f72c87a7921f99d16658f788bea339f1', 'Blu-Edition'),
('./all_torrents.php', '41d6d89471178e0a87b8c2369dde6802be4ae600', 'Blu-Edition'),
('./partners.php', '3e0d0ab45aabae417d9d7292963d10648ab4efeb', 'Blu-Edition'),
('./contact.php', 'eed9b635237bc62a0e53503abcb2d0765770f0f5', 'Blu-Edition'),
('./irc.php', 'add4d3f4a5d6d1cededbcce7c5f1c39dc6d883de', 'Blu-Edition'),
('./account_change.php', 'c85454db4981706dc02818f7b58dc44db5dd8f4a', 'Blu-Edition'),
('./username.php', '223aba43969e37a4fb28f3be1f2a17d4f7a002df', 'Blu-Edition'),
('./bet_odds2.php', 'cb0d5390f6981b654c391d4d09b96e097112de68', 'Blu-Edition'),
('./torrents/index.php', '8079e4c4c9de0da1dc2c4c87a4596c68824e17f4', 'Blu-Edition'),
('./torrents/.htaccess', 'cecd2af742ea6b06371b7b9961bc8fc6ab428dd0', 'Blu-Edition'),
('./team-stats.php', 'c94be97130e1af0def79283f3746bb433514dd4c', 'Blu-Edition'),
('./addons/serverload/index.php', 'e95eaedbb91104e407892a954f75ca9c02c2fbb0', 'Blu-Edition'),
('./addons/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./gift.php', '01f7c505b51c7f9dd29768692da7dc22ce63a21e', 'Blu-Edition'),
('./file_hosting/index.php', 'a509a4d104f5cb1c60f8a3475d2c8839a516521a', 'Blu-Edition'),
('./paypalsynchcp.php', '68465cf1a3b4bb60eae8f66746fdd74e03ef12a4', 'Blu-Edition'),
('./fav_up.php', 'e9c46c80e2bc472f9965d859be99d44795398cbb', 'Blu-Edition'),
('./addrequest.php', '062c508fd2e499a636ca4eb833391678ad8bc3e3', 'Blu-Edition'),
('./seedbonus_exchange.php', '3af033d1e6b3880ec09b0113a5080c26022ab54b', 'Blu-Edition'),
('./seedbox.php', '409f293aed759e0a1fd5487ea69a506f99c020a3', 'Blu-Edition'),
('./bet_coupon.php', 'e20a0a31fb2f75e7f8d145fd7419dbca54927045', 'Blu-Edition'),
('./account.php', '1d084feaed2e362b4890c5d9007e593f8058c8c7', 'Blu-Edition'),
('./login_new.php', '62e11170c975339fd858f8e1dc6f5eef04b56296', 'Blu-Edition'),
('./notepad.php', 'f4794dfb651716b6ef6abbff8fb7317001667b94', 'Blu-Edition'),
('./bet_add1x2.php', 'c07108b6bba15aaf4b1e1b9e9301382eab94f2ab', 'Blu-Edition'),
('./payza.php', '7e3985113cda71795c3dd636e5fbc62879ff1a26', 'Blu-Edition'),
('./uploadrequest2.php', '0730457112a1edc96535ff1b9e058b6b2064af46', 'Blu-Edition'),
('./bet_bonustop.php', '5b2085c0474c504f8f04be5db0319dc604732d7e', 'Blu-Edition'),
('./announcements.php', 'a38d2dd23324d2780d45297f1613ad7202fbe863', 'Blu-Edition'),
('./offer_comment.php', '57e1b57338e69039d36a7d6bc873342421d78ec9', 'Blu-Edition'),
('./bet_gameinfo.php', 'fad9a49c8fcb4c44b0ec13c2efad07fc2522e994', 'Blu-Edition'),
('./chat/js/lang/sk.js', 'c73ef4b1278e7fa09c55190191a2849d8cbd544e', 'Blu-Edition'),
('./chat/js/lang/ja.js', '63b06be292afb9cb36d6aec0c17cd72d391aa7ad', 'Blu-Edition'),
('./chat/js/lang/tr.js', '7f50a073dd60f930d1cb50ca5b9b2966a1bbe1fe', 'Blu-Edition'),
('./chat/js/lang/el.js', 'e8e9e0245042eecc0024aa134e4826517cef69be', 'Blu-Edition'),
('./chat/js/lang/it.js', '873de93cc383e213ab41f0196cdca699c4ccc65c', 'Blu-Edition'),
('./chat/js/lang/zh.js', '2f39e5ddd5e8230ce24277fa36e7e3d4b28b638f', 'Blu-Edition'),
('./chat/js/lang/he.js', 'cc079f0df77d4565a8d36bd92938acb11b3f4453', 'Blu-Edition'),
('./chat/js/lang/nl-be.js', '51d43e8a45fa4e83ba775519c1f440d72f8aa565', 'Blu-Edition'),
('./chat/js/lang/ca.js', '633856190b0c5b3a63eeefba96847011806fcffa', 'Blu-Edition'),
('./chat/js/lang/cz.js', 'e2561afa6a55c100631396be88896d292a6f0ae8', 'Blu-Edition'),
('./chat/js/lang/gl.js', '429fb6380e85d9aa54fadbb83b9dc296311924aa', 'Blu-Edition'),
('./chat/js/lang/es.js', '31dc188fb680200d3a0ddeaca229c3877f02be61', 'Blu-Edition'),
('./chat/js/lang/en.js', '0be9f7c88051200b7e25dcbded965e14617066c0', 'Blu-Edition'),
('./chat/js/lang/hr.js', '7d96c24257dae7a12515dd3354be71461a6ed55f', 'Blu-Edition'),
('./chat/js/lang/sl.js', 'c93725fca6f93bd45d37a9cbe06f8dfe6a2463eb', 'Blu-Edition'),
('./chat/js/lang/mk.js', 'c04c674fe79a5f66957bc31aa0fbb2cb98e121d6', 'Blu-Edition'),
('./chat/js/lang/fi.js', '1240488ddd264dbf1a43f058b5c5b62c07288b14', 'Blu-Edition'),
('./chat/js/lang/th.js', '0b16b0b4dd13a323332c0fde608716fe48bfb836', 'Blu-Edition'),
('./chat/js/lang/pl.js', '2ab85aefd2575b6144b339681bb0dc1423f5341d', 'Blu-Edition'),
('./chat/js/lang/da.js', 'cb7bb9a9048c73e6cc10f7616736769602ae8491', 'Blu-Edition'),
('./chat/js/FABridge.js', 'e784c04e4613bc0a03b4948bd4ab5736934f230d', 'Blu-Edition'),
('./chat/js/shoutbox.js', 'c23a736b413fd67aadc1f2af965f6aaa31136e37', 'Blu-Edition'),
('./chat/js/custom.js', 'b88322e3bc7a74651be3927e19c3e0d4fd10abf1', 'Blu-Edition'),
('./chat/img/license.txt', '1df5f4e04af70ac49dc3da232d0b182bc03b2a70', 'Blu-Edition'),
('./chat/img/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/img/emoticons/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/lib/.htaccess', '9c86436d4e1f7b445c85e3df8921870996cb0b9d', 'Blu-Edition'),
('./chat/lib/config.php', '2a889f898a52c087574f358ff03fe4dcc9a8a202', 'Blu-Edition'),
('./chat/lib/class/CustomAJAXChatInterface.php', '5b4678c192218d90845728ac347d3fb7183dc8d3', 'Blu-Edition'),
('./chat/lib/class/AJAXChatMySQLDataBase.php', '67c4a2f11ec0594c87b507092ef78a89801a3332', 'Blu-Edition'),
('./chat/lib/class/CustomAJAXChat.php', '21718c0f3b8ff0b86c2b7b02765dee6b1ef6471f', 'Blu-Edition'),
('./chat/lib/class/chatbot.php', '6e6b817c63d5f3c6e172cdb7452b9f19b22aa121', 'Blu-Edition'),
('./chat/lib/class/AJAXChatMySQLiQuery.php', 'c2675137fa850587fcc0f86a97ccc8f2d7ce57c8', 'Blu-Edition'),
('./chat/lib/class/AJAXChatMySQLiDataBase.php', '47fcb30473752c837609b0d2590c1f60f97fc533', 'Blu-Edition'),
('./chat/lib/class/AJAXChatLanguage.php', 'f62d20fdd9ba695807e719beef540554988bd1bb', 'Blu-Edition'),
('./chat/lib/class/AJAXChat.php', '20c3bb7a11d428fbb57567649cc750f1037e092c', 'Blu-Edition'),
('./chat/lib/class/AJAXChatHTTPHeader.php', '32718b3c69b1d0542d0247534e012d9f72f0f231', 'Blu-Edition'),
('./chat/lib/class/AJAXChatMySQLQuery.php', '5b7283be424949b1c8015d325daf7cfbfefb88e1', 'Blu-Edition'),
('./chat/lib/class/AJAXChatTemplate.php', 'e48e78838e3ce6670eb98f15416a2f14f5fc915c', 'Blu-Edition'),
('./chat/lib/class/AJAXChatFileSystem.php', '5474a6f3a87a310a67703bd948ae30da0248d9fd', 'Blu-Edition'),
('./chat/lib/class/CustomAJAXChatShoutBox.php', 'c8af974c598195484d1c663518bdb8b52a57d348', 'Blu-Edition'),
('./chat/lib/class/CustomAJAXCommands.php', 'bdff3dca93434cdfb1a35b094e898c194c7a550f', 'Blu-Edition'),
('./chat/lib/class/AJAXChatDataBase.php', '13e1c7458f1dd4e32016c74451754ecefa8e1438', 'Blu-Edition'),
('./chat/lib/class/AJAXChatString.php', '84efc058377c1a9d49b88a3e9143fc2423dde241', 'Blu-Edition'),
('./chat/lib/class/AJAXChatEncoding.php', '4f333e6e6f64f923e138c794cf0d00dcb14d8c03', 'Blu-Edition'),
('./chat/lib/template/loggedIn.html', '97f1824b66ec687a57356cd0c8aa8630980071b0', 'Blu-Edition'),
('./chat/lib/template/loggedOut.html', 'f66686ba40cdd3db46b34e91d48b740d0ffe1a9d', 'Blu-Edition'),
('./chat/lib/template/logs.html', 'b5ffbea677329080c5786efbd7fbb3305b253abf', 'Blu-Edition'),
('./chat/lib/template/shoutbox.html', '8779061d397375fb43dc8f619cc49772e3aaaf4d', 'Blu-Edition'),
('./chat/lib/lang/en.php', '0ba9d9a17f5a131d8d829e515d5a3d7f57adb642', 'Blu-Edition'),
('./chat/lib/lang/pl.php', '42670437f5e6b63827933c380104a8ef1af0434e', 'Blu-Edition'),
('./chat/lib/lang/gl.php', '82c819dd640097d94e2486e60cb069f39639dc34', 'Blu-Edition'),
('./chat/lib/lang/nl-be.php', 'e0a447be60687fed82a2f3a0c602a342e1e55d10', 'Blu-Edition'),
('./chat/lib/lang/cz.php', '18be132678166499c2fedba3cf6224947dbf8afb', 'Blu-Edition'),
('./chat/lib/lang/hu.php', 'd8dc6d412875a8c52c86e288f261a342e04706b8', 'Blu-Edition'),
('./chat/lib/lang/ca.php', 'dc49a19a835d838415524b5510948adf29727ad1', 'Blu-Edition'),
('./chat/lib/lang/in.php', 'eeaa240c5c1e84263cbdb3d3c6af7483a93404e3', 'Blu-Edition'),
('./chat/lib/lang/fi.php', '0c23e72600c33e134e77cd294691cdaf1e8bbf89', 'Blu-Edition'),
('./chat/lib/lang/es.php', 'cb70247db6de4b9f40eb70bc7fca6a8becca2d1d', 'Blu-Edition'),
('./chat/lib/lang/de.php', '5c56ddaa04500e051a1951f74195a7629f3c299c', 'Blu-Edition'),
('./chat/lib/lang/ka.php', 'b57014eab2be6a19b023a6a1b35180e244ca6e32', 'Blu-Edition'),
('./chat/lib/lang/it.php', 'ab8cce3ddd3976d4c4a6a358cf8b436fc1dc0438', 'Blu-Edition'),
('./chat/lib/lang/zh.php', 'f8074f64feef659d0a5ab5665623cf7073ee170a', 'Blu-Edition'),
('./chat/lib/lang/ro.php', 'ce3188f03a92f145ca736a1f7409756110721691', 'Blu-Edition'),
('./chat/lib/lang/el.php', '1092c001b8034b4eeb479e18b346c64f7f8f681d', 'Blu-Edition'),
('./chat/lib/lang/cy.php', 'c190fcad32adaed65ab61fd3b3d867a03580b6b6', 'Blu-Edition'),
('./chat/lib/lang/sr.php', '6fe04400313124576c88db0ad3ec3efeddc367c6', 'Blu-Edition'),
('./chat/lib/lang/mk.php', 'dffe8789a736ad1a4f159a2981e8cd32fe0014c6', 'Blu-Edition'),
('./chat/lib/lang/uk.php', '7f19b3a3820fb65d8fe3a0c5b441dd0258db3eac', 'Blu-Edition'),
('./chat/lib/lang/th.php', '791bb1375cbb5a6e9ebe5bc212a5071df6a8f094', 'Blu-Edition'),
('./chat/lib/lang/nl.php', '0a867ff5d7de31a75201fe59cd9e1db38c80132c', 'Blu-Edition'),
('./chat/lib/lang/tr.php', 'c7c8d9348f6065d7440256485e4ca53c12b2ea71', 'Blu-Edition'),
('./chat/lib/lang/ru.php', 'f11f65c79dd3934c01838b0484c3759e4190edcf', 'Blu-Edition'),
('./chat/lib/lang/sl.php', '50c9c9d7871bd70c164ea2ea7ddc5b189bce9556', 'Blu-Edition'),
('./chat/lib/lang/pt-br.php', 'b5b8c41b2886eff239870d4102b38c798f2146f6', 'Blu-Edition'),
('./chat/lib/lang/he.php', 'eb192ff0bbeae2057a643d0fc8ff13b80dfd4724', 'Blu-Edition'),
('./chat/lib/lang/bg.php', 'eb0ceadc9c6755eae5d1fccb006cc37392bf7bbb', 'Blu-Edition'),
('./chat/lib/lang/ar.php', 'c4c74ee97af0f43aff8a2fd42cea5287d8e4f682', 'Blu-Edition'),
('./chat/lib/lang/pt-pt.php', '2d0e38a1391d85bea8847e02716077d8e92923c0', 'Blu-Edition'),
('./chat/lib/lang/et.php', '952f2fd9fa3126e782145ad3f22694772a2a2b65', 'Blu-Edition'),
('./chat/lib/lang/ja.php', '591f3d2a2af24a3800e2b6a7576d654815654ed2', 'Blu-Edition'),
('./chat/lib/lang/no.php', '51fb3b658bd9c8aae107f9b968d8f888ebe583f7', 'Blu-Edition'),
('./chat/lib/lang/hr.php', 'd9cd16643cd943753dd220b0ba7e1220d0255196', 'Blu-Edition'),
('./chat/lib/lang/da.php', '872d78a8db7d7994890bc675a3147b96caba4950', 'Blu-Edition'),
('./chat/lib/lang/fa.php', '00b298610663d34f759718457278b93cbdc57ae8', 'Blu-Edition'),
('./chat/lib/lang/sk.php', '4f24eff1c91211edcf263d1a1ccac3fc0764447e', 'Blu-Edition'),
('./chat/lib/lang/sv.php', 'f54dbd1ad41173f2e5a9c4d4e5f9d3263fcd3f0b', 'Blu-Edition'),
('./chat/lib/lang/kr.php', 'f4e611a6c72dda8557a45e9f1a128df6ef9dbbd0', 'Blu-Edition'),
('./chat/lib/lang/fr.php', 'af1150b0bc83df19019951235ab3cf089ceabfd9', 'Blu-Edition'),
('./chat/lib/lang/zh-tw.php', '165d60bcccefd41400d37917293677622d4e0d9c', 'Blu-Edition'),
('./chat/lib/data/users.php', 'ca6f0e7c3e02c5ad564ffa7f7cd9a798e99de787', 'Blu-Edition'),
('./chat/lib/data/channels.php', 'ea418b90f53dffa6e60964aae601109627144924', 'Blu-Edition'),
('./chat/lib/classes.php', '9401cd7a09029e3db1aa6b2d352d8d042f9454b5', 'Blu-Edition'),
('./chat/lib/custom.php', 'd0e0fa1ba43080749bd02c1774cd88d3b8fe4130', 'Blu-Edition'),
('./chat/css/MyBB.css', '953269236720a2dce8028ec6915cebe9249589f5', 'Blu-Edition'),
('./chat/css/Uranium.css', '8eb05e662a4b3397c9cc3c4e3a8c08c4e568754d', 'Blu-Edition'),
('./chat/css/ie5-6.css', '9e6324f3007ddaf3987fa9e14174ea5ae2a6e2c9', 'Blu-Edition'),
('./chat/css/Lithium.css', '36eef7700617945803edb6340948aefa14cda93a', 'Blu-Edition'),
('./chat/css/grey.css', '06afd308f0f2650d083985a7c905800ee0bcc194', 'Blu-Edition'),
('./chat/css/Plum.css', '0808b3eba9d7da893eb5b36038fcea761945d27b', 'Blu-Edition'),
('./chat/css/Core.css', '63e7d0fd7e617fa707879cac5c26db9459d56bc4', 'Blu-Edition'),
('./chat/css/beige.css', '1259cf384a6eeacdd8376ae910050afcc761f3a8', 'Blu-Edition'),
('./chat/css/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/css/Cobalt.css', '85f83debc184d8a9197039c299db62b481ba179b', 'Blu-Edition'),
('./chat/css/Sulfur.css', '950cba64540fe565c87d77c72c7d96a3ede206e6', 'Blu-Edition'),
('./chat/css/shoutbox.css', '8850d4bd1b895a7ba39bbaeb8ccd16ed8a1f0d38', 'Blu-Edition'),
('./chat/css/Oxygen.css', 'f8b2d1cf57f59c740e7cf329bb14cb37dea246cf', 'Blu-Edition'),
('./chat/css/subblack2.css', '6d733395bc67dcffa390fd6de1c12f3f69b5fbca', 'Blu-Edition'),
('./chat/css/prosilver.css', 'f790d2462e4d3379bf1536d83b3c54041a78874d', 'Blu-Edition'),
('./chat/css/vBulletin.css', 'f4a21c8e7017ec5393f843c3fdfbb18a33e2df87', 'Blu-Edition'),
('./chat/css/subSilver.css', '118f3ff6a2d0abea813672d43bc9c5e3918e3a64', 'Blu-Edition'),
('./chat/css/fonts.css', '1f8d9d0d6ad4dcd2c2cbd191d28fd85521639a5f', 'Blu-Edition'),
('./chat/css/global.css', 'baa0ed638578deb05589901a0401c28c70d758e6', 'Blu-Edition'),
('./chat/css/Mercury.css', '2bde7066919ba9d06575acf80da91194eb86978a', 'Blu-Edition'),
('./chat/css/print.css', 'e88b484ceff75fc69e2a84a7fd5a42f7dd0bf2f0', 'Blu-Edition'),
('./chat/css/black.css', 'dd3d6b4a40e1dd6a671c48b3a7e3605f382c6d93', 'Blu-Edition'),
('./chat/sounds/sound_6.mp3', '5bedc7049d5ac006053e133795716ea4ace02399', 'Blu-Edition'),
('./chat/sounds/sound_2.mp3', '895c2c40528874c38246f6583b4dfff513e470b1', 'Blu-Edition'),
('./chat/sounds/sound_5.mp3', '6c08f297a72f944d31b1a72a4fdb47f03342b8c1', 'Blu-Edition'),
('./chat/sounds/license.txt', '21633b6c97aff0e9144e560abc31b1181cdf95e7', 'Blu-Edition'),
('./chat/sounds/sound_1.mp3', 'c8acfb0bb23edacd15ae0e575baa789c256f5769', 'Blu-Edition'),
('./chat/sounds/index.html', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Blu-Edition'),
('./chat/sounds/sound_4.mp3', '8a0ae83d227baaf9f45717fa7759d182a1f8c389', 'Blu-Edition'),
('./chat/sounds/sound_3.mp3', 'c947e2b3b24348681be63332ce70e2fe511a1d31', 'Blu-Edition'),
('./viewexpected.php', 'ceddc97af481469e83a815f0e013b7f4eaa475a7', 'Blu-Edition'),
('./warn.php', 'c674f568f112ab7c99ab5bd87afa2b8fba3c4929', 'Blu-Edition'),
('./ajax-poller-cast-vote-php.php', '678c5c8c4ebf00c41208db1cd7649b12fb4af35f', 'Blu-Edition'),
('./install.lock', 'f641a3250a7005807f0231f72016fe2b5bf1d50a', 'Blu-Edition'),
('./index.begin.php', '2dcb7791a6271d5e5caf610c74b272af02a9cc80', 'Blu-Edition'),
('./admin/admin.apply_membership.php', 'e3a3fcaa091734e8d39b6873d20f62221e8219e6', 'Blu-Edition'),
('./admin/admin.don.hist.php', '9ce1d833ef22f2e9dd175b4520ec6f9623f21748', 'Blu-Edition'),
('./admin/admin.whereheard.php', '32b059337d56782a2c9f608894efde242809ba26', 'Blu-Edition'),
('./admin/admin.fls.php', '98b84f8f5442bb75924c2460f2c59db39ab0529a', 'Blu-Edition'),
('./admin/admin.autorank.php', 'c3bce18fe174ed42106b06919a89872e4dd7ce49', 'Blu-Edition'),
('./admin/admin.blocks.php', 'dde83e8e345fe0c4658abf747a5eb55e2099ee5c', 'Blu-Edition'),
('./admin/admin.shout_announce.php', '4479b93c930118d423ecd04ad191bca653e709b5', 'Blu-Edition'),
('./admin/admin.twitter.php', 'd07abeee947a5172c331c509189afe39800a8942', 'Blu-Edition'),
('./admin/admin.module_config.php', '41f646cee4d4b47c07cbb0b7fe9d5f37acefbf40', 'Blu-Edition'),
('./admin/admin.polls.php', '496d2d2542d6b36da78b8a851cb30913824137a5', 'Blu-Edition'),
('./admin/admin.banbutton_user.php', 'ec178e1716901025d9755cbe3cf0a8399687d405', 'Blu-Edition'),
('./admin/admin.mysql_stats.php', '7c05e0bc32e05360bf8b66011ef549f0b9139167', 'Blu-Edition'),
('./admin/admin.rules.categories.php', '4f0e84c7073f6e383aaab65773c3b95deebc8f5b', 'Blu-Edition'),
('./admin/admin.specified_email_domains.php', '53573225ce44a4cb20391dce85f7fadafaddedef', 'Blu-Edition'),
('./admin/admin.featured.php', '0a3db45f0f911456fa39c1c13c7357687b0cde3a', 'Blu-Edition'),
('./admin/admin.pager_type.php', 'a39f1cbdb4ddb85624ebd73da7561be49892da2f', 'Blu-Edition'),
('./admin/admin.massemail.php', '1d724841b7cd8273188145ab11859517f2343a01', 'Blu-Edition'),
('./admin/admin.balloons.php', '0c41c0de667533026295d7ac4b1de74a6bd415ec', 'Blu-Edition'),
('./admin/admin.hide_language.php', '30be0dcb3cff8e83b15f941290807e7db10d24db', 'Blu-Edition'),
('./admin/admin.rep_high_ul.php', '61cc01571c7431289c5fc581724a8024608364c4', 'Blu-Edition'),
('./admin/admin.php_errors_log.php', 'ca3ee16777aea8b8f1b4c7a73731619b149cd6cf', 'Blu-Edition'),
('./admin/admin.img_in_shout.php', 'a6d300ab4736f11683894561a17278814d59800e', 'Blu-Edition'),
('./admin/admin.hide_style.php', 'b3d5ed191cee20951852d8a344e4ed9d4ed1adea', 'Blu-Edition'),
('./admin/admin.search_diff.php', 'a3090b30e3dde9f8ea6f5abf54c233cafa702b9f', 'Blu-Edition'),
('./admin/admin.banbutton.php', '87c4339060424d5d3f043ca3e3e4bfbd84b37226', 'Blu-Edition'),
('./admin/admin.hitrun.block.php', '776f4fc168e4333d19a9b1e0d971a4e79d7c7e1d', 'Blu-Edition'),
('./admin/admin.user_notes.php', 'c30907c764120ab3f9c6f7ba135e8ef10323cf54', 'Blu-Edition'),
('./admin/admin.showporn.php', 'b17037deadb8ea00106fa033093c2b9bc3e0c5a6', 'Blu-Edition'),
('./admin/admin.users.chknew.php', '32e6c522f882bfb4916d6b70afadebac603b7794', 'Blu-Edition'),
('./admin/admin.backup.php', '2b149faa47204bb01cb0fa073449a5bb66de057f', 'Blu-Edition'),
('./admin/admin.booted_users.php', 'f648f78a01d1ba098f5aa9358337674612db68db', 'Blu-Edition'),
('./admin/admin.gifts.php', '7e79f68b885e4806ae4685e81f049ba6caa1f43f', 'Blu-Edition'),
('./admin/admin.sitelog.php', '43b2a6eebfc5e2b9961b3c0bb8d691ebba6eb56f', 'Blu-Edition'),
('./admin/admin.notemod.php', '494c4e1b3d85643848a386fceec79427bbbb1fda', 'Blu-Edition'),
('./admin/admin.birthday.php', '532aaaccc78a658963cf381f5f7c5010e4feceae', 'Blu-Edition'),
('./admin/admin.captcha.php', '573c831e0281a34ee7749a85063adc3d54248e8b', 'Blu-Edition'),
('./admin/admin.categories.php', 'ccc06f2cb5017e76259d4e26f8ef72eed0f519d5', 'Blu-Edition'),
('./admin/admin.don_hist.php', '784c94533b05919f664e365128b837238c6a8d45', 'Blu-Edition'),
('./admin/admin.cats.forum.php', '4795bbde56edf63b38d96d7af51ce598f3baf3d6', 'Blu-Edition'),
('./admin/admin.main.php', '552cf19243e8d1c2c116d63a25e398011c0ac613', 'Blu-Edition'),
('./admin/index.php', '06c226f281846b97e2ae4160fbd7b382c7e5d16f', 'Blu-Edition'),
('./admin/admin.index.php', '9a314764c2c1820ca21841fd34e5ad96d49ca4bd', 'Blu-Edition'),
('./admin/admin.imageflowconf.php', '5f9f4b5a90952293007329ad1a7ed5fb27e3e2f8', 'Blu-Edition'),
('./admin/admin.bonus.php', '6a0c9ff116e53a1a2440364651e273cccf8f2037', 'Blu-Edition'),
('./admin/admin.ratio-editor.php', '4cc2d68cb8c48b0e5e560f07473f0c99472cb893', 'Blu-Edition'),
('./admin/admin.menu.php', '1dbc8c62bf66a4b720a03d0fc32c596eff7ec392', 'Blu-Edition'),
('./admin/admin.prune_users.php', 'a9468b1a8afb1ce986f93f79301491149f4f5c7b', 'Blu-Edition'),
('./admin/admin.kis.award.php', 'c336d4c4dd015e2d932b09f37f666fac4a9115c3', 'Blu-Edition'),
('./admin/admin.uploader_control.php', 'd8891dcda79b5166bb2fedd94d44f65d0de27bf7', 'Blu-Edition'),
('./admin/admin.archive.php', '384faddccd79fd2325fa7c323cf0d17617e0930b', 'Blu-Edition'),
('./admin/admin.welcome_pm.php', '1ef9fa3c80f8af061950566b08fecd43c259e128', 'Blu-Edition'),
('./admin/admin.staff_comm_on_details.php', '6c517935757f8fc3663241888e0ee5cfa9fd849c', 'Blu-Edition'),
('./admin/admin.ban_button.php', '90feee949c384d4254a078fb09c56e38e8af33fe', 'Blu-Edition'),
('./admin/admin.masspm.php', 'a51c8a237ef4db0be1ca94e4c40fafdaeca2a7df', 'Blu-Edition'),
('./admin/admin.ban_client.php', '43f38544e2d78a822341a460b189e537f2fec414', 'Blu-Edition'),
('./admin/admin_db_backup.php', '3a9699d2c1938b086c6ad2d1c0580507435760b9', 'Blu-Edition'),
('./admin/admin.blacklist.php', '4a001c9a97edd2ce916a3c54c3c9ebb78a637ef1', 'Blu-Edition'),
('./admin/admin.chk_tag.php', '4645c5b6beed5fff02adc00d9f6970eefc572a9b', 'Blu-Edition'),
('./admin/admin.reseed.php', '31ebaf1191d4a94fe0c73c1ed8461d93ed95b367', 'Blu-Edition'),
('./admin/admin.tvdb.php', '1a2c5ab3be1a277921edf31056b21a6cde1ec591', 'Blu-Edition'),
('./admin/admin.faq.question.php', 'feb73e833dbdb650662e1d203a82b856dbaeb67f', 'Blu-Edition'),
('./admin/admin.proxy.php', '4101cc3de05dc43a262395a914fa95a6cd886201', 'Blu-Edition'),
('./admin/admin.recommend.php', '8593da55ddef8c4281d5f802db06be104ef6e772', 'Blu-Edition'),
('./admin/admin.styles.php', '492d3f5b2124c8d3772eae189cb8c4fcfb17579b', 'Blu-Edition'),
('./admin/admin.faq.group.php', 'd24de6bb9208ff63b1634ed963f5ae075a5b433c', 'Blu-Edition'),
('./admin/admin.forums.php', '5b3f581abe9eb3e16581b021a4a14745a339d1ee', 'Blu-Edition'),
('./admin/admin.avatar_upload.php', '870fabb658a4092d06e22133e193851d89309eed', 'Blu-Edition'),
('./admin/admin.team.php', '4f6f52d73f670660b1e14c1610194830514fd003', 'Blu-Edition'),
('./admin/admin.kis.stats.php', '239c323741b650afd5edb53395fe91a14328ea20', 'Blu-Edition'),
('./admin/admin.view_tickets.php', 'bcf5e5b0879a681281bace095375239723f8c7a7', 'Blu-Edition'),
('./admin/admin.integrated_forum_poll.php', '9e327319fa7eea1e75eb181f27cdf1b5dfdf51d1', 'Blu-Edition'),
('./admin/admin.protected_usernames.php', '28f988fdff21bc1b24b8f85e87b0641ea59e416a', 'Blu-Edition'),
('./admin/admin.gold.php', 'e65800ba543341090b57a1c4142adf51c8a18814', 'Blu-Edition'),
('./admin/admin.upload_rights.php', 'eb3dd3b602360b26495e7ee10cb395d969d874b3', 'Blu-Edition'),
('./admin/admin.sticky.php', '4104533e038e1b88cdbe98ffa484bab3e0635ec5', 'Blu-Edition'),
('./admin/admin.flush.php', '44656c83632311367f1626356c98ca1b59fe2349', 'Blu-Edition'),
('./admin/admin.teams.php', 'f2c727b447ba04d5a54afe33f4ca03dd321714a1', 'Blu-Edition'),
('./admin/admin.file_hosting.php', 'e477cc978f23c8d2e3ecf2fd1029174b76860349', 'Blu-Edition'),
('./admin/admin.requests.php', 'f2efa020c9c25616911ff14709c5d6e67317983e', 'Blu-Edition'),
('./admin/admin.up_med.php', '86ea59b20d71416b9610a92a966c8513049bc004', 'Blu-Edition'),
('./admin/admin.agree.php', '36df3aa80a0e7bb8cf5bbefde6ec9d49ed321592', 'Blu-Edition'),
('./admin/admin.languages.php', '7b50ff6612f877111d012bada7676d59df5696e1', 'Blu-Edition'),
('./admin/admin.watched_users.php', '55d3e6bb723103c7b81c26a7723b4c485cc2ee14', 'Blu-Edition'),
('./admin/admin.users.tools.php', '2af4d7a04b33b21a34a7263e9398347538c8593c', 'Blu-Edition'),
('./admin/admin.ispy.php', '57cb528409ed15c2273fa129495cff637371ee12', 'Blu-Edition'),
('./admin/admin.intro_before_download.php', 'eb0408e145a1ee0e2d8fefce10db040ad627a59e', 'Blu-Edition'),
('./admin/admin.users.new.php', '8c5629f39ec5d649635de5fc03f76fdd2896d869', 'Blu-Edition'),
('./admin/admin.kis.invites.php', 'b7eaa8fa41af71ae59677c7d99d516cc594c5e96', 'Blu-Edition'),
('./admin/admin.censored.php', '2abdb294aebeea206b0a643ee2453829539efe92', 'Blu-Edition'),
('./admin/admin.lottery.php', '7f92debfd5b9537a749ee21fa09d445ca9a2d74f', 'Blu-Edition'),
('./admin/admin.radioconf.php', '06176281256aadad60bfc9bb413b393b60a49ec4', 'Blu-Edition'),
('./admin/admin.xtd.php', 'b3904583c5cc3eff23fec2f41ef57a995c1c6cfc', 'Blu-Edition'),
('./admin/admin.integrity.php', '45bef77e04dfe358d763e460fdab22f875f4b15e', 'Blu-Edition'),
('./admin/admin.pd-block_cheapmail.php', 'cac8d952978ae833b63867476b86cb9c547d492c', 'Blu-Edition'),
('./admin/admin.lrb.php', 'da6405238f3bffea302c111863fe0f76d48ab9e9', 'Blu-Edition'),
('./admin/admin.duplicates.php', '512b3e211c23f843146c0a7ddbf3b3c52649b331', 'Blu-Edition'),
('./admin/admin.tmod_set.php', 'df0565296a0c7a2b4dba4477bdc4aa64f6d6210c', 'Blu-Edition'),
('./admin/admin.smilies.php', '05d817dbcd9f53397e28b7e089c08c59e01dbe34', 'Blu-Edition'),
('./admin/admin.ip2country_import.php', '0a7b1bb4497e68be62f1bde669b5bcdc8a280737', 'Blu-Edition'),
('./admin/admin.online.php', 'b18bb6688000911b30c3c4020c2c0e27a2a6e9df', 'Blu-Edition'),
('./admin/admin.modpanel.php', '045154ef76b894aa19f0774454079f1b067cfac2', 'Blu-Edition'),
('./admin/admin.banip.php', 'e62aa7c1014325e95376f0c7985c10c2863eb8b6', 'Blu-Edition'),
('./admin/admin.no_columns.php', 'b69d9f0a699a83935f2ef23654c257ec0765a9f3', 'Blu-Edition'),
('./admin/admin.client_clearban.php', '87a8643e31a140e36ad863771840be390ccc6fa8', 'Blu-Edition'),
('./admin/admin.sport_bet.php', '8e78fb668e6dfa34abd469ffd14f52a1ba52b6f6', 'Blu-Edition'),
('./admin/admin.kocs.backup.php', '14e3799f5ca88551d53546b4a6806626e090eb7a', 'Blu-Edition'),
('./admin/admin.warn.php', '12236f581e45e13974b10f651a6f56f5fe157fcb', 'Blu-Edition'),
('./admin/admin.donate.php', '09bc807c13269d33275aecf9ab9a2fc5ef47aef5', 'Blu-Edition'),
('./admin/admin.read_messages.php', '17eb03bb478225a5156579c3aed3489891d6641e', 'Blu-Edition'),
('./admin/admin.toractcou.php', '18f3f8b56946678d3d6899dfdf44a2003ede1656', 'Blu-Edition'),
('./admin/admin.reencode.php', '69d708176adcddfa9846f6026d541a85e1086ac9', 'Blu-Edition'),
('./admin/admin.warned_users.php', '860bca73e9e4d024f87b8d50ea7b21867ecb59ed', 'Blu-Edition'),
('./admin/admin.kis.users.php', 'fb81cea09c0956a41471e7f68da21a4f5e64faef', 'Blu-Edition'),
('./admin/admin.kocs.help.php', '53f42cd192f56f94ad0f34443bbebe0ef16df255', 'Blu-Edition'),
('./admin/admin.ipb_new_member.php', '978b9b3bf2b320003f569754193e4d64fd61b738', 'Blu-Edition'),
('./admin/admin.user_images.php', 'f6626374655aad446f7933a6b5d0dd4f49546574', 'Blu-Edition'),
('./admin/admin.rules.php', '6a8fe47d507d75dd45d3387a8a293b7408a4ff3e', 'Blu-Edition'),
('./admin/admin.signup.bonus.php', '21e672e70f36fffd9713b4860b06f182b6493073', 'Blu-Edition'),
('./admin/admin.dlcheck.php', 'b36861212a3b39c9a58c4af9d33341d92b5c93d6', 'Blu-Edition'),
('./admin/admin.dbutil.php', 'd96e9fc47d274f361b9b15b0686293e95b079043', 'Blu-Edition'),
('./admin/admin.seedbox.use.php', 'd51de10d92b7c0abcce911df845a98f29dc0b0d0', 'Blu-Edition'),
('./admin/admin.freecontrol.php', '1cf3bf3174dd388a91fd78f46ce0151a95543286', 'Blu-Edition'),
('./admin/admin.adv_prune_torrents.php', '176f41f0a395020f44f1465913af539589e0d63d', 'Blu-Edition'),
('./admin/admin.dl_prefix_or_suffix.php', '43d5cf68417d03f0ce22b10238ded12f69e04f17', 'Blu-Edition'),
('./admin/admin.random_reg.php', 'eb52fd839f90e4e1e7852272fb58c64b84fba374', 'Blu-Edition'),
('./admin/admin.seo.php', '4a5ae3b6ce73ed0f868d1ca68258ec0ce080e226', 'Blu-Edition'),
('./admin/admin.warn_settings.php', 'f75dae7fb45e1a4dba46631a0d04ef8c44a8aaf9', 'Blu-Edition'),
('./admin/admin.torofweek.php', 'c222a87191e449590fccd4525418c17e2293a738', 'Blu-Edition'),
('./admin/admin.adv_prune_users.php', '761d02a8985670da866e2f660e50e19547f78429', 'Blu-Edition'),
('./admin/admin.groups.php', 'fd04c12eee825acc21cf0b7644b542b08cd42763', 'Blu-Edition'),
('./admin/admin.security_suite.php', '053cc2a72df349a2381f33233c43b50e3a6cb3e6', 'Blu-Edition'),
('./admin/admin.kocs.php', '446e12ab962beeabbc65e700d4eb3edf56636664', 'Blu-Edition'),
('./admin/admin.style_bridge.php', 'dc82b28aa22a22990c54a9186c64c1fff2392472', 'Blu-Edition'),
('./admin/admin.country_signup.php', '48ecb8c6dedb4f567df38d9eb2f2a034e85eca35', 'Blu-Edition'),
('./admin/admin.prune_torrents.php', 'f6c8d21379df858a008b2552b6aebdaaba4ed8aa', 'Blu-Edition'),
('./admin/admin.loglog.php', 'd42ed6f53ca89e625bbc7219b6cd153ec16ffde7', 'Blu-Edition'),
('./admin/admin.offline.php', '4a01bca8408251f6ecb3242e31bf7b74ca2405fd', 'Blu-Edition'),
('./admin/admin.don_edit.php', 'a53a05c3f2ab076524f3e54151fc5c4c862a974b', 'Blu-Edition'),
('./admin/admin.invitations.php', 'd41e404aa607403c9422639037a935a714456cb6', 'Blu-Edition'),
('./admin/admin.kocs.restore.php', '5c8c57e18029f8d6d66b8836f148f567b98b65ef', 'Blu-Edition'),
('./admin/admin.kis.config.php', '78bb14bd0c3182c10ef2ee69988bfeb04338398b', 'Blu-Edition'),
('./admin/admin.ads.php', 'f408685182d8018c0d91b38eae89b606dd00ee5b', 'Blu-Edition'),
('./admin/admin.kocs.config.php', '0ba7136432207e224bbb410fb5ae213c2a79b43c', 'Blu-Edition'),
('./admin/admin.image.upload.php', '4655b6161fee6c420b7ab26b02bd7d17dc1f7422', 'Blu-Edition'),
('./admin/admin.config.php', '3ee87aca82f7cce8410f2f35adec4e7a412f1498', 'Blu-Edition'),
('./admin/admin.hitrun.php', 'ba32eb2a4b4a9b573c2a59610dc82de261048cc1', 'Blu-Edition'),
('./admin/admin.staff_control.php', '19129f13ec6553776489f0e9d7246ca8def4b8a8', 'Blu-Edition'),
('./admin/admin.kis.php', '2cb66f27c7772fbd77f8dea54fae1a8eaa7fe95d', 'Blu-Edition'),
('./admin/admin.kis.help.php', 'f803292bdfa8c4b2e83764d898913327c3b96b25', 'Blu-Edition'),
('./admin/admin.hacks.php', 'e4847f931ce902a5816feec2c17f836715dc07a2', 'Blu-Edition'),
('./admin/admin.seedip.php', '67833510b9ea8209722d3ce2a01ccc6aac2fc211', 'Blu-Edition'),
('./filee.php', 'bcfb7a6ce9aa8472455af821afd76fc17c773578', 'Blu-Edition'),
('./index.end.php', '1cbeb5e5b09693f7fe39095fc3b29753c9184d34', 'Blu-Edition');

-- --------------------------------------------------------

--
-- Table structure for table `blu_betgames`
--

CREATE TABLE `blu_betgames` (
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
-- Table structure for table `blu_betlog`
--

CREATE TABLE `blu_betlog` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  `bonus` int(11) NOT NULL DEFAULT '0',
  `msg` varchar(150) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_betoptions`
--

CREATE TABLE `blu_betoptions` (
  `id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `text` varchar(100) NOT NULL DEFAULT '',
  `odds` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bets`
--

CREATE TABLE `blu_bets` (
  `id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bettop`
--

CREATE TABLE `blu_bettop` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bitcoin_invoices`
--

CREATE TABLE `blu_bitcoin_invoices` (
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
-- Table structure for table `blu_blackjack`
--

CREATE TABLE `blu_blackjack` (
  `gameid` int(10) UNSIGNED NOT NULL,
  `userid` int(10) NOT NULL,
  `dealerhand` varchar(100) NOT NULL,
  `playerhand` varchar(100) NOT NULL,
  `remaining_cards` text NOT NULL,
  `playerbust` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_blacklist`
--

CREATE TABLE `blu_blacklist` (
  `id` int(11) UNSIGNED NOT NULL,
  `tip` int(11) UNSIGNED DEFAULT NULL,
  `added` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_blocks`
--

CREATE TABLE `blu_blocks` (
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
-- Dumping data for table `blu_blocks`
--

INSERT INTO `blu_blocks` (`blockid`, `content`, `position`, `sortid`, `status`, `title`, `cache`, `minclassview`, `maxclassview`, `use_lro`, `lro_minclassview`, `lro_maxclassview`) VALUES
(1, 'admin', 'l', 2, 1, '', 'no', 6, 8, 'yes', 91, 100),
(2, 'clock', 'l', 0, 0, 'BLOCK_CLOCK', 'no', 1, 8, 'yes', 1, 100),
(3, 'forum', 'l', 4, 1, '', 'no', 3, 8, 'yes', 25, 100),
(4, 'lastmember', 'l', 3, 1, '', 'no', 3, 8, 'yes', 25, 100),
(5, 'poll', 'r', 0, 1, 'BLOCK_POLL', 'no', 3, 8, 'yes', 25, 100),
(6, 'user', 'l', 1, 1, 'UserInfo', 'no', 3, 8, 'yes', 25, 100),
(7, 'online', 'b', 0, 1, '', 'no', 3, 8, 'yes', 25, 100),
(8, 'slider', 'c', 0, 0, 'BLOCK_TOPTORRENTS', 'no', 3, 8, 'yes', 25, 100),
(9, 'featured', 'c', 3, 1, 'BLOCK_LASTTORRENTS', 'no', 3, 8, 'yes', 25, 100),
(10, 'blog', 'c', 1, 1, 'BLOCK_NEWS', 'no', 3, 8, 'yes', 25, 100),
(12, 'welcomeback', 't', 0, 1, 'BLOCK_MAINUSERTOOLBAR', 'no', 3, 8, 'yes', 25, 100),
(13, 'hit_run', 'l', 5, 0, '', 'no', 8, 8, 'yes', 100, 100),
(14, 'disclaimer', 'b', 2, 1, 'BLOCK_DISCALIMER', 'no', 3, 8, 'yes', 25, 100),
(15, 'poller', 'r', 0, 0, 'BLOCK_POLL', 'no', 3, 8, 'yes', 25, 100),
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
(45, 'latest_releases', 'c', 5, 1, 'LATEST_RELEASES', 'no', 3, 8, 'yes', 25, 100),
(47, 'clients', 'b', 1, 1, '', 'no', 3, 8, 'yes', 25, 100);

-- --------------------------------------------------------

--
-- Table structure for table `blu_bonus`
--

CREATE TABLE `blu_bonus` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `points` decimal(10,1) NOT NULL DEFAULT '0.0',
  `traffic` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `gb` int(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_bonus`
--

INSERT INTO `blu_bonus` (`id`, `name`, `points`, `traffic`, `gb`) VALUES
(3, '1', '30.0', 1073741824, 1),
(4, '2', '50.0', 2147483648, 2),
(5, '3', '100.0', 5368709120, 5);

-- --------------------------------------------------------

--
-- Table structure for table `blu_bots`
--

CREATE TABLE `blu_bots` (
  `name` varchar(20) NOT NULL,
  `visit` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bt_clients`
--

CREATE TABLE `blu_bt_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `sort` tinyint(10) NOT NULL DEFAULT '0',
  `image` varchar(150) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_bugs`
--

CREATE TABLE `blu_bugs` (
  `id` int(10) NOT NULL,
  `sender` int(10) NOT NULL DEFAULT '0',
  `added` int(12) NOT NULL DEFAULT '0',
  `priority` enum('low','high','veryhigh') NOT NULL DEFAULT 'low',
  `problem` text NOT NULL,
  `status` enum('fixed','ignored','na') NOT NULL DEFAULT 'na',
  `staff` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_bugs`
--

INSERT INTO `blu_bugs` (`id`, `sender`, `added`, `priority`, `problem`, `status`, `staff`, `title`) VALUES
(1, 12922, 1476572212, 'veryhigh', 'Test', 'fixed', 12922, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `blu_categories`
--

CREATE TABLE `blu_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `sub` int(10) NOT NULL DEFAULT '0',
  `sort_index` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `forumid` int(10) NOT NULL DEFAULT '0',
  `reencode` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_categories`
--

INSERT INTO `blu_categories` (`id`, `name`, `sub`, `sort_index`, `image`, `forumid`, `reencode`) VALUES
(17, 'HDTV 1080p', 14, 5, 'HDTV 1080p.png', 0, 0),
(5, 'Anime', 15, 3, 'Anime.png', 0, 0),
(16, 'HDTV 720p', 14, 6, 'HDTV 720p.png', 0, 0),
(15, 'Movies', 0, 0, '', 0, 0),
(11, '720p', 15, 2, '720p.png', 0, 0),
(14, 'HDTV ', 0, 4, '', 0, 0),
(13, '1080P', 15, 1, '1080p.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blu_categories_perm`
--

CREATE TABLE `blu_categories_perm` (
  `catid` int(10) NOT NULL,
  `levelid` int(11) NOT NULL,
  `viewcat` enum('yes','no') NOT NULL DEFAULT 'yes',
  `viewtorrlist` enum('yes','no') NOT NULL DEFAULT 'yes',
  `viewtorrdet` enum('yes','no') NOT NULL DEFAULT 'yes',
  `downtorr` enum('yes','no') NOT NULL DEFAULT 'yes',
  `ratio` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_chat`
--

CREATE TABLE `blu_chat` (
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
-- Table structure for table `blu_chatfun`
--

CREATE TABLE `blu_chatfun` (
  `msgid` int(10) UNSIGNED NOT NULL,
  `user` varchar(50) NOT NULL DEFAULT '0',
  `message` text,
  `userid` int(8) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_cheapmail`
--

CREATE TABLE `blu_cheapmail` (
  `domain` varchar(100) NOT NULL DEFAULT '',
  `added` int(10) NOT NULL DEFAULT '0',
  `added_by` varchar(40) NOT NULL DEFAULT 'Unknown'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_coins`
--

CREATE TABLE `blu_coins` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `torrentid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `points` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_coins`
--

-- --------------------------------------------------------

--
-- Table structure for table `blu_comments`
--

CREATE TABLE `blu_comments` (
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
-- Table structure for table `blu_contact_system`
--

CREATE TABLE `blu_contact_system` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_countries`
--

CREATE TABLE `blu_countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `flagpic` varchar(50) DEFAULT NULL,
  `domain` char(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_countries`
--

INSERT INTO `blu_countries` (`id`, `name`, `flagpic`, `domain`) VALUES
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
(47, 'Serbia', 'rs.png', 'RS'),
(48, 'Seychelles', 'sc.png', 'SC'),
(49, 'Taiwan', 'tw.png', 'TW'),
(50, 'Puerto Rico', 'pr.png', 'PR'),
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
(100, 'unknown', 'unknown.gif', 'AA'),
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
(150, 'Guyana', 'gy.png', 'GY'),
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
(200, 'French Polynesia', 'pf.png', 'PF'),
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
(244, 'Iran, Islamic Republic of', 'ir.png', 'IR'),
(245, 'Montenegro', 'me.png', 'ME');

-- --------------------------------------------------------

--
-- Table structure for table `blu_covers`
--

CREATE TABLE `blu_covers` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_donors`
--

CREATE TABLE `blu_donors` (
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
-- Table structure for table `blu_don_historie`
--

CREATE TABLE `blu_don_historie` (
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
-- Table structure for table `blu_downloads`
--

CREATE TABLE `blu_downloads` (
  `id` int(5) NOT NULL,
  `uid` int(10) NOT NULL,
  `info_hash` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `updown` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_down_load`
--

CREATE TABLE `blu_down_load` (
  `id` int(10) NOT NULL,
  `pid` varchar(32) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_dox`
--

CREATE TABLE `blu_dox` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` datetime DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `size` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `uppedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_expected`
--

CREATE TABLE `blu_expected` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_faq`
--

CREATE TABLE `blu_faq` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_faq_group`
--

CREATE TABLE `blu_faq_group` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `sort_index` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_fav_uploader`
--

CREATE TABLE `blu_fav_uploader` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `fav_up_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `fav_up_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_featured`
--

CREATE TABLE `blu_featured` (
  `fid` int(5) NOT NULL,
  `torrent_id` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_featured`
--

INSERT INTO `blu_featured` (`fid`, `torrent_id`) VALUES
(1, '389dad4e38536a92acb4b97b6fe93bad80e39e85'),
(2, '3f0dba6366c87b385fd896842091577afe3df3d0'),
(3, 'e60c5c0a636369974de43aeb4059d5eba7713b4d'),
(4, '3f0dba6366c87b385fd896842091577afe3df3d0'),
(5, '3f0dba6366c87b385fd896842091577afe3df3d0'),
(6, 'e60c5c0a636369974de43aeb4059d5eba7713b4d'),
(7, '3f0dba6366c87b385fd896842091577afe3df3d0');

-- --------------------------------------------------------

--
-- Table structure for table `blu_files`
--

CREATE TABLE `blu_files` (
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
  `tag` text NOT NULL,
  `imdb_ignore` enum('yes','no') NOT NULL DEFAULT 'no',
  `release_group` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_files`
--

INSERT INTO `blu_files` (`id`, `info_hash`, `filename`, `url`, `info`, `data`, `size`, `comment`, `category`, `external`, `announce_url`, `uploader`, `lastupdate`, `anonymous`, `lastsuccess`, `dlbytes`, `seeds`, `leechers`, `finished`, `lastcycle`, `lastSpeedCycle`, `speed`, `bin_hash`, `sbonus`, `gold`, `free_expire_date`, `free`, `happy`, `happy_hour`, `image`, `screen1`, `screen2`, `screen3`, `reseed`, `imdb`, `seedbox`, `sticky`, `vip_torrent`, `requested`, `nuked`, `nuke_reason`, `moder`, `shout_announced`, `twitter_announced`, `team`, `lock_comment`, `multiplier`, `topicid`, `forum_announced`, `staff_comment`, `direct_download`, `announces`, `language`, `approved_by`, `viewcount`, `genre`, `bumpdate`, `archive`, `tvdb_id`, `tvdb_extra`, `dead_time`, `magnet`, `points`, `tag`, `imdb_ignore`, `release_group`) VALUES
(7, '3f0dba6366c87b385fd896842091577afe3df3d0', 'Batman v Superman Dawn of Justice (2016) 720Pad BluRay AAC x264-aSOUL@BluRG', 'torrents/3f0dba6366c87b385fd896842091577afe3df3d0.btf', '', '2016-11-09 05:19:27', 3776186671, 'Fearing the actions of a god-like Super Hero left unchecked, Gotham City’s own formidable, forceful vigilante takes on Metropolis’s most revered, modern-day savior, while the world wrestles with what sort of hero it really needs. And with Batman and Superman at war with one another, a new threat quickly arises, putting mankind in greater danger than it’s ever known before.\r\n[pre]\r\nThese are created for "Mobile Device" compatibility but Can be played on "PC\'s" too.\r\n\r\nTested On:\r\nASUS Transformer Prime, HTC Droid Incredible, HTC Thunderbolt,\r\niPad, iPod touch (5th Generation), Microsoft Surface RT, Samsung GalaxyS\r\n\r\nGeneral:\r\nIMDB.......................: http://www.imdb.com/title/tt2975590/\r\nComplete name..............: Batman v Superman Dawn of Justice (2016) 720Pad BluRay AAC x264-aSOUL@BluRG\r\nFormat.....................: MPEG-4\r\nFile size..................: 3.52 GiB\r\nDuration...................: 03:02:34 (H:M:S)\r\nOverall bit rate...........: 2758 Kbps\r\nDXVA Compatible............: Yes\r\nCover......................: Yes\r\nChapters...................: Yes (Named)\r\nEncoder....................: kaotiksoul@BluRG\r\n\r\nVideo:\r\nFormat.....................: AVC\r\nFormat profile.............: High@L3.1, 2pass\r\nBit rate...................: 2569 Kbps\r\nWidth......................: 1280 pixels\r\nHeight.....................: 534 pixels\r\nDisplay aspect ratio.......: 2.40:1\r\nFrame rate.................: 23.976 fps\r\nBit depth..................: 8 bits\r\nBits/(Pixel*Frame).........: 0.157\r\n\r\nAudio:\r\nFormat.....................: AAC\r\nBit rate...................: 192 Kbps\r\nChannel(s).................: 2 channels\r\nSampling rate..............: 48.0 KHz\r\nCompression mode...........: Lossy\r\nLanguage...................: English\r\n\r\nText: *selectable*\r\nFormat.....................: Timed Text\r\nCodec ID...................: tx3g\r\nLanguage...................: English\r\n\r\nSource: Batman v Superman Dawn of Justice 2016 Extended BluRay 1080p AVC Atmos TrueHD7.1-MT (Thanks to orginal source and uploader)[/pre]', 11, 'no', '', 12922, '0000-00-00 00:00:00', 'false', '0000-00-00 00:00:00', 0, 0, 0, 0, 1484504978, 1481587837, 0, 0x3f0dba6366c87b385fd896842091577afe3df3d0, '0.000000', '0', '0000-00-00 00:00:00', 'no', 'no', 'yes', '3f0dba6366c87b385fd896842091577afe3df3d0.jpg', 's13f0dba6366c87b385fd896842091577afe3df3d0.jpg', 's23f0dba6366c87b385fd896842091577afe3df3d0.jpg', 's33f0dba6366c87b385fd896842091577afe3df3d0.png', 0, '2975590', '0', '0', '0', 'false', 'false', '', 'ok', 1, 0, '0', 'no', '3', 0, 0, '', '', '', 1, 12922, 103, NULL, 1478668767, 0, 0, NULL, 0, NULL, 0, '', 'no', 1),
(6, '389dad4e38536a92acb4b97b6fe93bad80e39e85', 'Tears of Steel (2012) 1080p', 'torrents/389dad4e38536a92acb4b97b6fe93bad80e39e85.btf', 'http://www.tearsofsteel.org made with Blender', '2016-10-19 19:34:58', 571346576, 'Project summary\r\n\r\nTears of Steel (2012)\r\nDuration: 12 minutes.\r\nHD and DCP 2.35:1, Dolby 5.1.\r\n\r\nAge: for 12 years and older\r\nLanguage: English spoken\r\nProduction: Blender Institute\r\nProducer: Ton Roosendaal\r\nDirector & Writer: Ian Hubert\r\nDirector of Photography: Joris Kerbosch\r\nComposer: Joram Letwory\r\n\r\nStarring: Derek de Lint, Sergio Hasselbaink, Rogier Schippers, Vanja Rukavina, Denise Rebergen, Jody Bhe. Chris Haley\r\n\r\nCG Crew: Andreas Goralczyk, David Revoy, Francesco Siddi, Jeremy Davidson, Kjartan Tysdal, Nicolo Zubbini, Rob Tuytel, Roman Volodin, Sebastian Koenig, Brecht van Lommel, Campbell Barton, Sergey Sharybin.\r\n\r\nProject funding: Blender Foundation, Netherlands Film Fund, Cinegrid Amsterdam.\r\nPremium Sponsor: Google. Main Sponsors: NVIDIA, Hewlett-Packard Workstations, Camalot AV Services, BlenderGuru.\r\n\r\n“Tears of Steel” is a short film made in Amsterdam the Netherlands by the Blender Institute, well known for realizing the open source short animation movies “Big Buck Bunny” (2008) and “Sintel” (2010). As usual these films get financing by crowd-funding in online communities of 3D artists and animators.\r\nFor “Tears of Steel” the funding target was to explore a complete open source pipeline for producing a high quality visual effect film, with as theme “Science Fiction in Amsterdam”.\r\n\r\nProducer Ton Roosendaal invited young Seattle talent Ian Hubert to come working in Amsterdam for 7 months to write and direct the film – assisted in Blender Institute’s studio by an international team of 3d and vfx artists, and with a Dutch film crew and Dutch actors.\r\n\r\nThe film’s premise is about a group of warriors and scientists, who gathered at the “Oude Kerk” in Amsterdam to stage a crucial event from the past, in a desperate attempt to rescue the world from destructive robots.\r\n\r\nThe film itself – as well as original footage and all the studio files – will be released as free and open content; the Creative Commons Attribution license.', 13, 'no', '', 12922, '0000-00-00 00:00:00', 'false', '0000-00-00 00:00:00', 0, 0, 0, 0, 1484504978, 1480580574, 0, 0x389dad4e38536a92acb4b97b6fe93bad80e39e85, '0.000000', '2', '0000-00-00 00:00:00', 'no', 'no', 'yes', '389dad4e38536a92acb4b97b6fe93bad80e39e85.jpg', '', '', '', 0, '2285752', '0', '0', '0', 'true', 'true', '', 'ok', 1, 0, '0', 'no', '2', 0, 0, 'Test Upload', '', '', 1, 12922, 64, NULL, 1476905698, 0, 0, NULL, 0, NULL, 100, '', 'no', 2),
(8, 'e60c5c0a636369974de43aeb4059d5eba7713b4d', 'Blade Runner 1982  3in1 2XBD25 1XBD50 1080p VC 1 TrueHD 5.1 fleyser@BluRG', 'torrents/e60c5c0a636369974de43aeb4059d5eba7713b4d.btf', 'Blu Forever!!!!!', '2016-11-09 22:10:28', 85263865004, '[center][center][img]http://ultraimg.com/images/new1.png[/img]\r\n\r\n\r\n[b][size=x-large]A BluRG Release Group Production:[/size][/b]\r\n\r\n[color=purple][b][size=x-large]Blade Runner 1982  3in1 2XBD25 1XBD50 1080p VC 1 TrueHD 5.1 fleyser@BluRG[/size][/b][/color][/center]\r\n\r\n\r\n[center]\r\n\r\n[color=teal]Plot[/color]\r\n\r\nA blade runner must pursue and try to terminate four replicants who stole a ship in space and have returned to Earth to find their creator. \r\n\r\n[color=teal]Extras[/color]\r\n\r\n[img]https://images-na.ssl-images-amazon.com/images/I/91FQ9-J%2BXXL._SL1500_.jpg[/img]\r\n\r\n[color=teal]BD Info[/color][/center]\r\n\r\n[code]\r\nDISC INFO:\r\n\r\nDisc Title:     DISC_1_BLADERUNNER_FINAL\r\nDisc Size:      23.317.377.452 bytes\r\nProtection:     AACS\r\nBD-Java:        No\r\nBDInfo:         0.5.8\r\n\r\nPLAYLIST REPORT:\r\n\r\nName:                   00001.MPLS\r\nLength:                 1:57:36.841 (h:m:s.ms)\r\nSize:                   23.156.164.608 bytes\r\nTotal Bitrate:          26,25 Mbps\r\n\r\nVIDEO:\r\n\r\nCodec                   Bitrate             Description     \r\n-----                   -------             -----------     \r\nVC-1 Video              16875 kbps          1080p / 23,976 fps / 16:9 / Advanced Profile 3\r\n\r\nAUDIO:\r\n\r\nCodec                           Language        Bitrate         Description     \r\n-----                           --------        -------         -----------     \r\nDolby Digital Audio             English         640 kbps        5.1 / 48 kHz / 640 kbps / DN -4dB\r\nDolby TrueHD Audio              English         3766 kbps       5.1 / 48 kHz / 3766 kbps / 24-bit (AC3 Embedded: 5.1 / 48 kHz / 640 kbps / DN -4dB)\r\nDolby Digital Audio             French          640 kbps        5.1 / 48 kHz / 640 kbps / DN -4dB\r\nDolby Digital Audio             English         192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB\r\nDolby Digital Audio             English         192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB\r\nDolby Digital Audio             English         192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB\r\n\r\nSUBTITLES:\r\n\r\nCodec                           Language        Bitrate         Description     \r\n-----                           --------        -------         -----------     \r\nPresentation Graphics           English         17,149 kbps                     \r\nPresentation Graphics           French          13,858 kbps                     \r\nPresentation Graphics           Japanese        9,891 kbps                      \r\nPresentation Graphics           Chinese         14,507 kbps                     \r\nPresentation Graphics           Korean          10,695 kbps                     \r\nPresentation Graphics           Spanish         14,277 kbps                     \r\nPresentation Graphics           Portuguese      15,582 kbps                     \r\nPresentation Graphics           Japanese        41,033 kbps                     \r\nPresentation Graphics           Japanese        39,511 kbps                     \r\nPresentation Graphics           Japanese        45,061 kbps                     \r\n[/code]\r\n\r\n\r\n[code]\r\nDISC INFO:\r\n\r\nDisc Title:     DISC_2_BLADE_RUNNER_BRANCH\r\nDisc Size:      24.566.908.302 bytes\r\nProtection:     AACS\r\nBD-Java:        No\r\nBDInfo:         0.5.8\r\n\r\nPLAYLIST REPORT:\r\n\r\nName:                   00002.MPLS\r\nLength:                 1:57:25.496 (h:m:s.ms)\r\nSize:                   23.581.831.488 bytes\r\nTotal Bitrate:          26,78 Mbps\r\n\r\n(*) Indicates included stream hidden by this playlist.\r\n\r\nVIDEO:\r\n\r\nCodec                   Bitrate             Description     \r\n-----                   -------             -----------     \r\nVC-1 Video              23188 kbps          1080p / 23,976 fps / 16:9 / Advanced Profile 3\r\n\r\nAUDIO:\r\n\r\nCodec                           Language        Bitrate         Description     \r\n-----                           --------        -------         -----------     \r\n* Dolby Digital Audio           English         640 kbps        5.1 / 48 kHz / 640 kbps / DN -4dB\r\n* Dolby Digital Audio           English         192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB / Dolby Surround\r\n* Dolby Digital Audio           French          192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB / Dolby Surround\r\nDolby Digital Audio             English         640 kbps        5.1 / 48 kHz / 640 kbps / DN -4dB\r\nDolby Digital Audio             English         192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB / Dolby Surround\r\nDolby Digital Audio             French          192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB / Dolby Surround\r\n\r\nSUBTITLES:\r\n\r\nCodec                           Language        Bitrate         Description     \r\n-----                           --------        -------         -----------     \r\n* Presentation Graphics         English         16,925 kbps                     \r\n* Presentation Graphics         French          13,801 kbps                     \r\n* Presentation Graphics         Spanish         14,332 kbps                     \r\nPresentation Graphics           English         18,312 kbps                     \r\nPresentation Graphics           French          15,517 kbps                     \r\nPresentation Graphics           Spanish         15,968 kbps                     \r\n[/code]\r\n\r\n\r\n[code]\r\nDISC INFO:\r\n\r\nDisc Title:     DISC_3_BLADE_RUNNER_30TH_CE\r\nDisc Size:      37.379.579.250 bytes\r\nProtection:     AACS\r\nBD-Java:        Yes\r\nBDInfo:         0.5.8\r\n\r\nPLAYLIST REPORT:\r\n\r\nName:                   00100.MPLS\r\nLength:                 1:50:05.599 (h:m:s.ms)\r\nSize:                   17.766.715.392 bytes\r\nTotal Bitrate:          21,52 Mbps\r\n\r\n(*) Indicates included stream hidden by this playlist.\r\n\r\nVIDEO:\r\n\r\nCodec                   Bitrate             Description     \r\n-----                   -------             -----------     \r\nMPEG-4 AVC Video        15904 kbps          1080p / 23,976 fps / 16:9 / High Profile 4.1\r\n\r\nAUDIO:\r\n\r\nCodec                           Language        Bitrate         Description     \r\n-----                           --------        -------         -----------     \r\nDTS-HD Master Audio             English         3799 kbps       5.1 / 48 kHz / 3799 kbps / 24-bit (DTS Core: 5.1 / 48 kHz / 1509 kbps / 24-bit)\r\nDolby Digital Audio             English         192 kbps        2.0 / 48 kHz / 192 kbps / DN -4dB / Dolby Surround\r\n\r\nSUBTITLES:\r\n\r\nCodec                           Language        Bitrate         Description     \r\n-----                           --------        -------         -----------     \r\n* Presentation Graphics         Japanese        9,694 kbps                      \r\nPresentation Graphics           English         17,519 kbps                     \r\n* Presentation Graphics         Japanese        43,243 kbps                     \r\nPresentation Graphics           French          14,009 kbps                     \r\nPresentation Graphics           German          16,807 kbps                     \r\nPresentation Graphics           Italian         16,216 kbps                     \r\nPresentation Graphics           Spanish         14,166 kbps                     \r\nPresentation Graphics           Chinese         14,289 kbps                     \r\nPresentation Graphics           Spanish         14,577 kbps                     \r\nPresentation Graphics           Portuguese      16,117 kbps                     \r\nPresentation Graphics           Croatian        15,360 kbps                     \r\nPresentation Graphics           Czech           15,054 kbps                     \r\nPresentation Graphics           Greek           15,742 kbps                     \r\nPresentation Graphics           Hebrew          11,325 kbps                     \r\nPresentation Graphics           Polish          15,610 kbps                     \r\nPresentation Graphics           Portuguese      16,865 kbps                     \r\nPresentation Graphics           Serbian         14,436 kbps                     \r\nPresentation Graphics           Slovenian       13,683 kbps                     \r\nPresentation Graphics           Turkish         16,735 kbps                     \r\nPresentation Graphics           Chinese         50,671 kbps                     \r\n\r\n[/code]\r\n\r\n\r\n[center][b]This is an internal release so please respect site rule 104.[/b]\r\n\r\n[b][color=orange]Rule 104: All Blu-Torrents BluRG Internal releases uploaded to other sites MUST have the full title, description and TAG left intact! Also all BluRG uploads will be exclusive to Blu-Torrents for 1 day / 24 hours before it can be uploaded to another Private Tracker. (Failure to follow this rule will result in a BAN) (Please don\'t upload our Internals to Public Trackers!!!!).[/color][/b][/center]', 13, 'no', '', 23027, '0000-00-00 00:00:00', 'false', '0000-00-00 00:00:00', 84903154860, 1, 0, 1, 1484504978, 1484504692, 0, 0xe60c5c0a636369974de43aeb4059d5eba7713b4d, '0.000000', '2', '0000-00-00 00:00:00', 'no', 'no', 'yes', 'e60c5c0a636369974de43aeb4059d5eba7713b4d.jpg', '', '', '', 0, '0083658', '0', '0', '0', 'false', 'false', '', 'ok', 1, 0, '0', 'no', '1', 0, 0, '', '', '', 1, 23027, 82, NULL, 1478729428, 0, 79349, NULL, 0, NULL, 1000, '', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blu_files_reencode`
--

CREATE TABLE `blu_files_reencode` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_files_reencodeb`
--

CREATE TABLE `blu_files_reencodeb` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_files_thanks`
--

CREATE TABLE `blu_files_thanks` (
  `infohash` char(40) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_flashscores`
--

CREATE TABLE `blu_flashscores` (
  `ID` int(11) NOT NULL,
  `game` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_forums`
--

CREATE TABLE `blu_forums` (
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
-- Dumping data for table `blu_forums`
--

INSERT INTO `blu_forums` (`sort`, `id`, `name`, `description`, `minclassread`, `minclasswrite`, `postcount`, `topiccount`, `minclasscreate`, `id_parent`, `category`) VALUES
(0, 1, 'XBTIT Blu-Edition', '', 3, 3, 0, 0, 3, 0, 'yes'),
(2, 3, 'Welcome ', '', 1, 1, 1, 1, 1, 0, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `blu_free_leech_req`
--

CREATE TABLE `blu_free_leech_req` (
  `info_hash` varchar(40) NOT NULL,
  `count` int(10) NOT NULL DEFAULT '1',
  `approved` enum('yes','no','undecided') NOT NULL DEFAULT 'undecided',
  `requester_ids` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_friendlist`
--

CREATE TABLE `blu_friendlist` (
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
-- Table structure for table `blu_gold`
--

CREATE TABLE `blu_gold` (
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
-- Dumping data for table `blu_gold`
--

INSERT INTO `blu_gold` (`id`, `level`, `gold_picture`, `silver_picture`, `bronze_picture`, `active`, `date`, `gold_description`, `silver_description`, `bronze_description`, `classic_description`, `gold_percentage`, `silver_percentage`, `bronze_percentage`) VALUES
(1, 5, 'gold.gif', 'silver.gif', 'bronze.gif', '1', '0000-00-00', '100% free', '50% free', '25% free', '0% free', 0, 50, 75);

-- --------------------------------------------------------

--
-- Table structure for table `blu_hacks`
--

CREATE TABLE `blu_hacks` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `version` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  `added` int(11) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `prerequisite` varchar(200) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_hacks`
--

INSERT INTO `blu_hacks` (`id`, `title`, `version`, `author`, `added`, `folder`, `prerequisite`) VALUES
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
(20, 'fmhack_rules_with_groups', '1.0 (FM)', 'Losmi', 1434749313, '', 'no'),
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
(44, 'fmhack_enhanced_wait_time', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
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
(55, 'fmhack_twitter_update', '1.0 (FM)', 'mcangeli & DiemThuy', 1434749313, '', 'no'),
(56, 'fmhack_torrent_moderation', '1.2 (FM)', 'Losmi & Petr1fied', 1434749313, '', 'no'),
(57, 'fmhack_uploader_medals', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(58, 'fmhack_NFO_uploader_-_viewer', '1.1 (FM)', 'miskotes', 1434749313, '', 'no'),
(60, 'fmhack_balloons_on_mouseover', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(61, 'fmhack_teams', '1.1 (FM)', 'cooly & Petr1fied', 1434749313, '', 'no'),
(63, 'fmhack_blu_->_SMF_style_bridge', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(65, 'fmhack_lock_comments', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(66, 'fmhack_account_parked', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(67, 'fmhack_low_ratio_ban_system', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(69, 'fmhack_hide_online_status', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(70, 'fmhack_upload_multiplier', '1.1 (FM)', 'DiemThuy & Petr1fied', 1434749313, '', 'no'),
(72, 'fmhack_allow_and_disallow_users_to_up_and_download', '1.0 (FM)', 'linux198', 1434749313, '', 'fmhack_detect_and_blacklist_proxy'),
(73, 'fmhack_detect_and_blacklist_proxy', '1.0 (FM)', 'DiemThuy', 1434749313, '', 'no'),
(74, 'fmhack_view_edit_delete_preview_shoutBox_comments', '1.0 (FM)', 'miskotes', 1434749313, '', 'fmhack_comments_layout'),
(75, 'fmhack_comments_layout', '1.0 (FM)', 'Real_ptr', 1434749313, '', 'no'),
(76, 'fmhack_faq_with_groups', '1.0 (FM)', 'Losmi', 1434749313, '', 'fmhack_forced_FAQ'),
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
(98, 'fmhack_forced_FAQ', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
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
(116, 'fmhack_addthis', '1.0 (FM)', 'signo', 1434749313, '', 'no'),
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
(137, 'fmhack_ads_system', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(138, 'fmhack_default_cat_browse', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(139, 'fmhack_welcome_pm', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(140, 'fmhack_logical_rank_ordering', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(141, 'fmhack_freeleech_slots', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(142, 'fmhack_torrent_of_the_week', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(143, 'fmhack_profile_torrent_sorting', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(144, 'fmhack_comment_captcha', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(145, 'fmhack_pM_notification_on_torrent_comment', '1.0 (FM)', 'Liroy (Original author:gAnDo)', 1434749313, '', 'no'),
(146, 'fmhack_no_columns_display', '1.1 (FM)', 'cooly', 1434749313, '', 'no'),
(147, 'fmhack_protected_usernames', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
(148, 'fmhack_multi_delete_torrents', '1.0 (FM)', 'cooly', 1434749313, '', 'no'),
(149, 'fmhack_poll_from_integrated_forum', '1.0 (FM)', 'Petr1fied', 1434749313, '', 'no'),
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
(168, 'fmhack_ccslider', '1.0 (Blu)', 'HDVinnie', 1434749313, '', 'no'),
(169, 'fmhack_torrent_list_switch', '1.0 (Blu', 'HDVinnie', 1434749313, '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `blu_helpdesk`
--

CREATE TABLE `blu_helpdesk` (
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
-- Table structure for table `blu_history`
--

CREATE TABLE `blu_history` (
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
-- Table structure for table `blu_hnr`
--

CREATE TABLE `blu_hnr` (
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
-- Dumping data for table `blu_hnr`
--

INSERT INTO `blu_hnr` (`id_level`, `method`, `min_seed_hours`, `min_ratio`, `tolerance_hours`, `dl_trig_bytes`, `block_leech`, `forum_post`) VALUES
(3, 'seed_only', 168, 0, 72, 1073741824, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blu_ignore`
--

CREATE TABLE `blu_ignore` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ignore_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ignore_name` varchar(250) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_imdb`
--

CREATE TABLE `blu_imdb` (
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
-- Table structure for table `blu_invalid_logins`
--

CREATE TABLE `blu_invalid_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` bigint(11) DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `failed` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `remaining` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_invitations`
--

CREATE TABLE `blu_invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `inviter` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `invitee` varchar(80) NOT NULL DEFAULT '',
  `hash` varchar(32) NOT NULL DEFAULT '',
  `time_invited` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmed` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_ip2country`
--

CREATE TABLE `blu_ip2country` (
  `ip_from` double NOT NULL DEFAULT '0',
  `ip_to` double NOT NULL DEFAULT '0',
  `country_code2` char(2) NOT NULL DEFAULT '',
  `country_code3` char(3) NOT NULL DEFAULT '',
  `country_name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_iplog`
--

CREATE TABLE `blu_iplog` (
  `ipid` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uid` varchar(5) NOT NULL DEFAULT '',
  `uipid` char(1) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_khez_configs`
--

CREATE TABLE `blu_khez_configs` (
  `key` varchar(30) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_khez_configs`
--

INSERT INTO `blu_khez_configs` (`key`, `value`) VALUES
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
-- Table structure for table `blu_kis_sent`
--

CREATE TABLE `blu_kis_sent` (
  `token` varchar(190) NOT NULL,
  `time` int(20) NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `used` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blu_kis_users`
--

CREATE TABLE `blu_kis_users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `invites` int(5) UNSIGNED NOT NULL,
  `joined` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blu_kis_users`
--

INSERT INTO `blu_kis_users` (`uid`, `invites`, `joined`) VALUES
(12922, 1, 0),
(23027, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blu_language`
--

CREATE TABLE `blu_language` (
  `id` int(10) NOT NULL,
  `language` varchar(20) NOT NULL DEFAULT '',
  `language_url` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_language`
--

INSERT INTO `blu_language` (`id`, `language`, `language_url`) VALUES
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
-- Table structure for table `blu_logs`
--

CREATE TABLE `blu_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` int(10) DEFAULT NULL,
  `txt` text,
  `type` varchar(10) NOT NULL DEFAULT 'add',
  `user` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_lottery_config`
--

CREATE TABLE `blu_lottery_config` (
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
-- Table structure for table `blu_lottery_tickets`
--

CREATE TABLE `blu_lottery_tickets` (
  `id` int(4) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_lottery_winners`
--

CREATE TABLE `blu_lottery_winners` (
  `id` int(4) NOT NULL,
  `win_user` varchar(20) NOT NULL DEFAULT '',
  `windate` varchar(20) NOT NULL DEFAULT '',
  `price` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_low_ratio_ban`
--

CREATE TABLE `blu_low_ratio_ban` (
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
-- Table structure for table `blu_low_ratio_ban_settings`
--

CREATE TABLE `blu_low_ratio_ban_settings` (
  `id` varchar(4) NOT NULL DEFAULT '1',
  `wb_sys` enum('true','false') NOT NULL DEFAULT 'false',
  `wb_text_one` varchar(255) NOT NULL,
  `wb_text_two` varchar(255) NOT NULL,
  `wb_text_fin` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_low_ratio_ban_settings`
--

INSERT INTO `blu_low_ratio_ban_settings` (`id`, `wb_sys`, `wb_text_one`, `wb_text_two`, `wb_text_fin`) VALUES
('1', 'false', 'Message for first warning here', 'Message for second warning here', 'Message for final warning here');

-- --------------------------------------------------------

--
-- Table structure for table `blu_messages`
--

CREATE TABLE `blu_messages` (
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
-- Table structure for table `blu_moderate_reasons`
--

CREATE TABLE `blu_moderate_reasons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `ordering` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_modules`
--

CREATE TABLE `blu_modules` (
  `id` mediumint(3) NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `activated` enum('yes','no') NOT NULL DEFAULT 'yes',
  `type` enum('staff','misc','torrent','style') NOT NULL DEFAULT 'misc',
  `changed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_modules`
--

INSERT INTO `blu_modules` (`id`, `name`, `activated`, `type`, `changed`, `created`) VALUES
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
-- Table structure for table `blu_mostonline`
--

CREATE TABLE `blu_mostonline` (
  `amount` int(4) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL DEFAULT '2008-11-24 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_news`
--

CREATE TABLE `blu_news` (
  `id` int(11) NOT NULL,
  `news` blob NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_news`
--

INSERT INTO `blu_news` (`id`, `news`, `user_id`, `date`, `title`) VALUES
(1, 0x57656c636f6d6520546f20584254495420426c752d45646974696f6e20627920426c7543726577, 12922, '2016-10-14 19:19:05', 'Welcome');

-- --------------------------------------------------------

--
-- Table structure for table `blu_notes`
--

CREATE TABLE `blu_notes` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_offer_comments`
--

CREATE TABLE `blu_offer_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `ori_text` text NOT NULL,
  `user` varchar(20) NOT NULL DEFAULT '',
  `offer_id` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_online`
--

CREATE TABLE `blu_online` (
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
-- Table structure for table `blu_partner`
--

CREATE TABLE `blu_partner` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `addedby` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_paypal_settings`
--

CREATE TABLE `blu_paypal_settings` (
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
-- Table structure for table `blu_peers`
--

CREATE TABLE `blu_peers` (
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
-- Table structure for table `blu_poller`
--

CREATE TABLE `blu_poller` (
  `ID` int(11) NOT NULL,
  `startDate` int(10) NOT NULL DEFAULT '0',
  `endDate` int(10) NOT NULL DEFAULT '0',
  `pollerTitle` varchar(255) DEFAULT NULL,
  `starterID` mediumint(8) NOT NULL DEFAULT '0',
  `active` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_poller`
--

INSERT INTO `blu_poller` (`ID`, `startDate`, `endDate`, `pollerTitle`, `starterID`, `active`) VALUES
(1, 1473607258, 0, 'How would you rate this script?', 2, 'no'),
(2, 1479757060, 0, 'Do you like Blu-Edition?', 12922, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `blu_poller_option`
--

CREATE TABLE `blu_poller_option` (
  `ID` int(11) NOT NULL,
  `pollerID` int(11) DEFAULT NULL,
  `optionText` varchar(255) DEFAULT NULL,
  `pollerOrder` int(11) DEFAULT NULL,
  `defaultChecked` char(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_poller_option`
--

INSERT INTO `blu_poller_option` (`ID`, `pollerID`, `optionText`, `pollerOrder`, `defaultChecked`) VALUES
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
-- Table structure for table `blu_poller_vote`
--

CREATE TABLE `blu_poller_vote` (
  `ID` int(11) NOT NULL,
  `pollerID` int(11) NOT NULL DEFAULT '0',
  `optionID` int(11) DEFAULT NULL,
  `ipAddress` bigint(11) DEFAULT '0',
  `voteDate` int(10) NOT NULL DEFAULT '0',
  `memberID` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_poller_vote`
--

INSERT INTO `blu_poller_vote` (`ID`, `pollerID`, `optionID`, `ipAddress`, `voteDate`, `memberID`) VALUES
(1, 1, 1, 1203528291, 1476472223, 12922),
(2, 1, 1, 3702229767, 1477147334, 23027),
(3, 2, 8, 1232081911, 1479758046, 12922);

-- --------------------------------------------------------

--
-- Table structure for table `blu_polls`
--

CREATE TABLE `blu_polls` (
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
-- Table structure for table `blu_poll_voters`
--

CREATE TABLE `blu_poll_voters` (
  `vid` int(10) NOT NULL,
  `ip` varchar(16) NOT NULL DEFAULT '',
  `votedate` int(10) NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `memberid` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_pool`
--

CREATE TABLE `blu_pool` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(10) NOT NULL,
  `poolid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_pool_settings`
--

CREATE TABLE `blu_pool_settings` (
  `id` int(10) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `pot` int(11) NOT NULL,
  `complete` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_pool_settings`
--

INSERT INTO `blu_pool_settings` (`id`, `start`, `end`, `pot`, `complete`) VALUES
(1, '2016-12-31 00:00:00', NULL, 15000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blu_posts`
--

CREATE TABLE `blu_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `topicid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `body` mediumtext,
  `editedby` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `editedat` int(10) DEFAULT '0',
  `sbonus` decimal(12,6) NOT NULL DEFAULT '0.000000'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_profile_status`
--

CREATE TABLE `blu_profile_status` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL DEFAULT '0',
  `last_status` varchar(140) NOT NULL,
  `last_update` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_profile_status`
--

INSERT INTO `blu_profile_status` (`id`, `userid`, `last_status`, `last_update`) VALUES
(1, 12922, ':wave:', 1476552401);

-- --------------------------------------------------------

--
-- Table structure for table `blu_quiz`
--

CREATE TABLE `blu_quiz` (
  `qid` int(5) UNSIGNED NOT NULL,
  `Question` text,
  `opt1` text,
  `opt2` text,
  `opt3` text,
  `opt4` text,
  `woptcode` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_rank`
--

CREATE TABLE `blu_rank` (
  `userid` int(11) NOT NULL,
  `old_rank` int(11) NOT NULL,
  `new_rank` int(11) NOT NULL,
  `byt` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `undone` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_ratings`
--

CREATE TABLE `blu_ratings` (
  `infohash` char(40) NOT NULL DEFAULT '',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `added` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_readposts`
--

CREATE TABLE `blu_readposts` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `topicid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastpostread` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_recommended`
--

CREATE TABLE `blu_recommended` (
  `id` int(11) NOT NULL,
  `info_hash` varchar(40) NOT NULL DEFAULT '',
  `user_name` varchar(40) NOT NULL DEFAULT 'anonymous'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_reports`
--

CREATE TABLE `blu_reports` (
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
-- Table structure for table `blu_reputation`
--

CREATE TABLE `blu_reputation` (
  `reputationid` int(11) UNSIGNED NOT NULL,
  `whoadded` int(10) NOT NULL DEFAULT '0',
  `dateadd` int(10) NOT NULL DEFAULT '0',
  `userid` mediumint(8) NOT NULL DEFAULT '0',
  `updown` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_reputation_settings`
--

CREATE TABLE `blu_reputation_settings` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_reputation_settings`
--

INSERT INTO `blu_reputation_settings` (`id`, `rep_is_online`, `rep_adminpower`, `rep_minpost`, `rep_default`, `rep_userrates`, `rep_rdpower`, `rep_pcpower`, `rep_kppower`, `rep_minrep`, `rep_hit`, `rep_maxperday`, `rep_repeat`, `rep_undefined`, `best_level`, `good_level`, `no_level`, `bad_level`, `worse_level`, `rep_upload`, `rep_en_sys`, `rep_pr_id`, `rep_dm_id`, `rep_pr`, `rep_dm`, `rep_pm_text`, `rep_dm_text`) VALUES
('1', 'false', '5', '10', '0', '1', '1', '1', '0', '5', '5', '24', '', '1', 'Outstanding Reputation', 'Good Reputation', 'No Reputation', 'Bad Reputation', 'Terrable Reputation', '3', 'false', '5', '3', '1000', '-1000', 'promote text', 'demote text'),
('1', 'false', '5', '10', '0', '1', '1', '1', '0', '5', '5', '24', '', '1', 'Outstanding Reputation', 'Good Reputation', 'No Reputation', 'Bad Reputation', 'Terrable Reputation', '3', 'false', '5', '3', '1000', '-1000', 'promote text', 'demote text');

-- --------------------------------------------------------

--
-- Table structure for table `blu_requests`
--

CREATE TABLE `blu_requests` (
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
-- Dumping data for table `blu_requests`
--

INSERT INTO `blu_requests` (`id`, `reqname`, `category`, `requester`, `dateadded`, `description`, `views`, `imdb`, `tvdb`, `jobtakenby`, `jobtakenwhen`, `uploadedby`, `uploadedwhen`, `infohash`) VALUES
(3, 'The Matrix 1999 1080p AAC 5.1 MP4', 13, 12922, '2016-10-28 12:02:32', 'The Matrix 1999 1080p AAC 5.1 MP4', 40, 133093, 0, 0, NULL, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `blu_requests_bounty`
--

CREATE TABLE `blu_requests_bounty` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `addedby` smallint(5) UNSIGNED NOT NULL,
  `seedbonus` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `req_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_requests_comments`
--

CREATE TABLE `blu_requests_comments` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `req_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `addedby` smallint(5) UNSIGNED NOT NULL,
  `addedwhen` datetime DEFAULT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_rules`
--

CREATE TABLE `blu_rules` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `sort_index` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_rules_group`
--

CREATE TABLE `blu_rules_group` (
  `id` int(11) NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `sort_index` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_sb`
--

CREATE TABLE `blu_sb` (
  `id` int(5) NOT NULL,
  `what` varchar(20) NOT NULL,
  `gb` varchar(20) NOT NULL,
  `points` int(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_searchcloud`
--

CREATE TABLE `blu_searchcloud` (
  `id` int(10) UNSIGNED NOT NULL,
  `searchedfor` varchar(50) NOT NULL,
  `howmuch` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_seedboxip`
--

CREATE TABLE `blu_seedboxip` (
  `id` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `host` varchar(200) NOT NULL,
  `peers` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_seo`
--

CREATE TABLE `blu_seo` (
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
-- Dumping data for table `blu_seo`
--

INSERT INTO `blu_seo` (`id`, `activated`, `activated_user`, `str`, `strto`, `cano`, `use_meta`, `metakeyword`, `metadesc`, `copyright`, `author`, `robots`, `revisitafter`, `analytic_active`, `ggwebmaster_active`, `analytic`, `ggwebmaster`, `maxurl`, `namemap`, `active_map`, `abs_path`) VALUES
('1', 'true', 'true', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ {}[]', 'abcdefghijklmnopqrstuvwxyz-----', 'true', 'true', 'Meta Keyword for xbtit team', 'Meta description for xbtit team', 'your Meta Copyright', 'your Meta Author', 'index, follow', '12 days', 'true', 'true', 'analytict', 'testee', '3', 'sitemap.xml', 'true', '/var/www/');

-- --------------------------------------------------------

--
-- Table structure for table `blu_settings`
--

CREATE TABLE `blu_settings` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_settings`
--

INSERT INTO `blu_settings` (`key`, `value`) VALUES
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
('announce', 'a:1:{i:0;s:49:"http://URL/announce.php";}'),
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
('cache_version', '1'),
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
('email', ''),
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
('fmhack_blu_->_SMF_style_bridge', 'disabled'),
('fmhack_bonus_system', 'enabled'),
('fmhack_bon_pool', 'enabled'),
('fmhack_booted', 'enabled'),
('fmhack_bump_torrents', 'enabled'),
('fmhack_CBT_(Coolys_Backup_Tools)', 'enabled'),
('fmhack_ccslider', 'enabled'),
('fmhack_comments_layout', 'enabled'),
('fmhack_comment_captcha', 'disabled'),
('fmhack_custom_smileys', 'enabled'),
('fmhack_custom_title', 'enabled'),
('fmhack_default_cat_browse', 'enabled'),
('fmhack_detect_and_blacklist_proxy', 'disabled'),
('fmhack_direct_download', 'disabled'),
('fmhack_disable_user_registration_with_duplicate_IP', 'enabled'),
('fmhack_display_new_torrents_since_last_Visit', 'enabled'),
('fmhack_donation_history', 'enabled'),
('fmhack_downloaded_torrents', 'enabled'),
('fmhack_download_prefix_or_suffix', 'enabled'),
('fmhack_download_ratio_checker', 'enabled'),
('fmhack_download_requires_introduction', 'enabled'),
('fmhack_duplicate_accounts', 'enabled'),
('fmhack_enhanced_wait_time', 'disabled'),
('fmhack_faq_with_groups', 'enabled'),
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
('fmhack_group_colours_overall', 'enabled'),
('fmhack_helpdesk', 'enabled'),
('fmhack_hide_language', 'enabled'),
('fmhack_hide_online_status', 'enabled'),
('fmhack_hide_style', 'enabled'),
('fmhack_high_UL_speed_report', 'enabled'),
('fmhack_integrated_forum_display', 'enabled'),
('fmhack_invitation_system', 'disabled'),
('fmhack_IP_to_country', 'enabled'),
('fmhack_language_in_torrent_list_and_details', 'enabled'),
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
('fmhack_online_timeout', 'enabled'),
('fmhack_only_allow_specified_email_domains', 'disabled'),
('fmhack_pager_type_select', 'enabled'),
('fmhack_partners_page', 'enabled'),
('fmhack_permissions_for_external_torrents', 'disabled'),
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
('fmhack_rules_with_groups', 'enabled'),
('fmhack_search_all_sub-categories', 'enabled'),
('fmhack_SEO_panel', 'disabled'),
('fmhack_shoutbox_banned', 'enabled'),
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
('fmhack_torrents_limit', 'enabled'),
('fmhack_torrent_activity_colouring', 'enabled'),
('fmhack_torrent_bookmark', 'enabled'),
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
('online_timeout', '600'),
('pager_type', 'new'),
('peercaching', 'false'),
('persist', 'false'),
('php_log_path', ''),
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
('radio_pass', ''),
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
('smtp_password', ''),
('smtp_port', '25'),
('smtp_server', ''),
('smtp_username', ''),
('snatched_prefixcolor', '<span style=\'color:#0096B8;\'>'),
('snatched_suffixcolor', '</span>');
INSERT INTO `blu_settings` (`key`, `value`) VALUES
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
('multie', '3'),
('cl_on', 'false'),
('cl_te', 'Powered By Blu-Edition'),
('cache_duration', '90');

-- --------------------------------------------------------

--
-- Table structure for table `blu_shitlist`
--

CREATE TABLE `blu_shitlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `shit_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `shit_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_shoutcastdj`
--

CREATE TABLE `blu_shoutcastdj` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `activedays` char(30) NOT NULL DEFAULT '',
  `activetime` char(11) NOT NULL DEFAULT '',
  `genre` char(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_signup_ip_block`
--

CREATE TABLE `blu_signup_ip_block` (
  `id` int(10) NOT NULL,
  `first_ip` double NOT NULL DEFAULT '0',
  `last_ip` double NOT NULL DEFAULT '0',
  `added` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `addedby` varchar(50) NOT NULL DEFAULT '',
  `comment` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_sitemap`
--

CREATE TABLE `blu_sitemap` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `nb` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_smilies`
--

CREATE TABLE `blu_smilies` (
  `key` varchar(200) NOT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_smilies`
--

INSERT INTO `blu_smilies` (`key`, `value`) VALUES
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
-- Table structure for table `blu_sticky`
--

CREATE TABLE `blu_sticky` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#bce1ac;',
  `level` int(11) NOT NULL DEFAULT '3'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_sticky`
--

INSERT INTO `blu_sticky` (`id`, `color`, `level`) VALUES
(1, '#1E1E1E;', 6);

-- --------------------------------------------------------

--
-- Table structure for table `blu_stream`
--

CREATE TABLE `blu_stream` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_stream_porn`
--

CREATE TABLE `blu_stream_porn` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_stream_servers`
--

CREATE TABLE `blu_stream_servers` (
  `sid` int(5) NOT NULL,
  `server_url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_stream_users`
--

CREATE TABLE `blu_stream_users` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `streamid` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_style`
--

CREATE TABLE `blu_style` (
  `id` int(10) NOT NULL,
  `style` varchar(20) NOT NULL DEFAULT '',
  `style_url` varchar(100) NOT NULL DEFAULT '',
  `style_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_style`
--

INSERT INTO `blu_style` (`id`, `style`, `style_url`, `style_type`) VALUES
(11, 'Dark', 'style/xbtit_default', 3),
(31, 'Light (Beta)', 'style/light', 3);

-- --------------------------------------------------------

--
-- Table structure for table `blu_style_bridge`
--

CREATE TABLE `blu_style_bridge` (
  `id` int(10) NOT NULL,
  `blu_style` int(10) NOT NULL DEFAULT '0',
  `smf_style` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_subtitles`
--

CREATE TABLE `blu_subtitles` (
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

-- --------------------------------------------------------

--
-- Table structure for table `blu_tasks`
--

CREATE TABLE `blu_tasks` (
  `task` varchar(20) NOT NULL DEFAULT '',
  `last_time` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_tasks`
--

INSERT INTO `blu_tasks` (`task`, `last_time`) VALUES
('radio', 1434749313),
('rreg', 1436279225),
('sanity', 1484504978),
('update', 1484504978);

-- --------------------------------------------------------

--
-- Table structure for table `blu_teams`
--

CREATE TABLE `blu_teams` (
  `id` int(10) NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `owner` int(10) NOT NULL DEFAULT '0',
  `info` text,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_tested`
--

CREATE TABLE `blu_tested` (
  `tested` datetime NOT NULL,
  `acct` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_tested`
--

INSERT INTO `blu_tested` (`tested`, `acct`) VALUES
('2016-12-09 20:08:52', 'Blu-Edition'),
('2016-12-09 20:09:06', 'Blu-Edition'),
('2016-12-11 00:43:28', 'Blu-Edition');

-- --------------------------------------------------------

--
-- Table structure for table `blu_timestamps`
--

CREATE TABLE `blu_timestamps` (
  `info_hash` char(40) NOT NULL DEFAULT '',
  `sequence` int(10) UNSIGNED NOT NULL,
  `bytes` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `delta` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_timestamps`
--

INSERT INTO `blu_timestamps` (`info_hash`, `sequence`, `bytes`, `delta`) VALUES
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6420, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6428, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6436, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6444, 0, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8465, 84903154860, 1800),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7219, 0, 1802),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7215, 0, 1965),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8468, 84903154860, 1802),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8461, 84903154860, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6525, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6517, 0, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8455, 84903154860, 1802),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8453, 84903154860, 1802),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8464, 84903154860, 1802),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8454, 84903154860, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7268, 0, 65535),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6619, 0, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8466, 84903154860, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8460, 84903154860, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8451, 84903154860, 1800),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6404, 0, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8467, 84903154860, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7221, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6610, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6601, 0, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7198, 0, 1969),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7204, 0, 1954),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7196, 0, 1952),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7213, 0, 1955),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6541, 0, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7226, 0, 1800),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7211, 0, 1962),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6574, 0, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8459, 84903154860, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8463, 84903154860, 1800),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6557, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6549, 0, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8458, 84903154860, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7208, 0, 1955),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7217, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6565, 0, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7200, 0, 1958),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8462, 84903154860, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8456, 84903154860, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7194, 0, 1966),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6509, 0, 18737),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8457, 84903154860, 1802),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6533, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6583, 0, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7237, 0, 17196),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7223, 0, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7224, 0, 1369),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8470, 84903154860, 35728),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7202, 0, 1962),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7206, 0, 1968),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8452, 84903154860, 1801),
('e60c5c0a636369974de43aeb4059d5eba7713b4d', 8469, 84903154860, 1800),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6412, 0, 1801),
('389dad4e38536a92acb4b97b6fe93bad80e39e85', 6592, 0, 1801),
('3f0dba6366c87b385fd896842091577afe3df3d0', 7239, 0, 1793);

-- --------------------------------------------------------

--
-- Table structure for table `blu_timezone`
--

CREATE TABLE `blu_timezone` (
  `difference` varchar(4) NOT NULL DEFAULT '0',
  `timezone` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_timezone`
--

INSERT INTO `blu_timezone` (`difference`, `timezone`) VALUES
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
-- Table structure for table `blu_topics`
--

CREATE TABLE `blu_topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `subject` varchar(75) DEFAULT NULL,
  `locked` enum('yes','no') NOT NULL DEFAULT 'no',
  `forumid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastpost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sticky` enum('yes','no') NOT NULL DEFAULT 'no',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_t_rank`
--

CREATE TABLE `blu_t_rank` (
  `userid` int(11) NOT NULL,
  `old_rank` int(11) NOT NULL,
  `new_rank` int(11) NOT NULL,
  `byt` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `undone` enum('yes','no') NOT NULL DEFAULT 'no',
  `enddate` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_userbars`
--

CREATE TABLE `blu_userbars` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `img` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_username`
--

CREATE TABLE `blu_username` (
  `uid` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `org` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_users`
--

CREATE TABLE `blu_users` (
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
-- Dumping data for table `blu_users`
--

INSERT INTO `blu_users` (`id`, `username`, `password`, `salt`, `pass_type`, `dupe_hash`, `id_level`, `random`, `email`, `language`, `style`, `joined`, `lastconnect`, `lip`, `downloaded`, `uploaded`, `avatar`, `pid`, `flag`, `topicsperpage`, `postsperpage`, `torrentsperpage`, `cip`, `time_offset`, `temp_email`, `smf_fid`, `invitations`, `invited_by`, `invitedate`, `custom_title`, `seedbonus`, `smf_postcount`, `donor`, `rank_switch`, `old_rank`, `timed_rank`, `warn`, `warnreason`, `warnadded`, `warns`, `warnaddedby`, `booted`, `whybooted`, `addbooted`, `whobooted`, `sbox`, `dlrandom`, `custom_torr_limit`, `php_cust_torr_limit`, `custom_wait_time`, `php_cust_wait_time`, `ban`, `ban_added`, `ban_added_by`, `ban_comment`, `up_med`, `team`, `pchat`, `block_comment`, `is_parked`, `warn_lev`, `warn_last`, `hnr_count`, `rat_warn_level`, `rat_warn_time`, `bandt`, `invisible`, `allowdownload`, `allowupload`, `proxy`, `ipb_fid`, `ipb_postcount`, `dob`, `birthday_bonus`, `pmbanned`, `user_notes`, `sig`, `syncsig`, `syncav`, `country_name`, `country_flag`, `avatar_upload`, `avatar_upload_name`, `viewed_faq`, `user_images`, `about_me`, `IS_WATCHED`, `force_ssl`, `showporn`, `profileview`, `signature`, `tot_on`, `custom_rss`, `vipfl_down`, `vipfl_date`, `catins`, `freeleech_slots`, `freeleech_slot_hashes`, `commentpm`, `prune_last_warn`, `prune_level`, `previous_names`, `made_intro`, `announce_read`, `trophy`, `reputation`, `connectable`, `clientinfo`, `gotgift`, `browser`, `torrent_style`) VALUES
(1, 'Guest', '', '', '1', '', 1, 0, 'none', 1, 11, '2014-02-19 05:44:31', '2014-02-19 05:44:31', 0, 0, 67645734912, NULL, '00000000000000000000000000000000', 0, 10, 10, 15, '127.0.0.2', '0', '', -1, 0, 0, '0000-00-00 00:00:00', NULL, '0.000000', 0, 'no', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', '', '', '0000-00-00 00:00:00', '', 'no', '0', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'no', 'no', 'no', 0, 0, '0000-00-00', 0, 'no', '', '', 'false', 'false', 'unknown', 'unknown', 'no', '', 0, '', '', 'no', 'yes', 'no', 0, '', 0, '', 0, 0, '', 0, '', 'false', 0, 0, '', 1, 'yes', '0', '0', 'unknown', '', 'yes', 'unknown', 'new'),
(2, 'AutoSystem', '5b13ef42a3bda83300f90991fc7b5ca1', '', '1', '2f8aff4bd03618914e5d', 7, 575005, 'none@none', 1, 11, '2012-06-23 13:10:18', '2014-05-31 01:46:16', 3567209673, 0, 19877674080967, '', 'e5cac7bd480617dc6fda9a412ca6a82b', 12, 15, 15, 55, '127.0.0.2', '0', '', 0, 0, 0, '0000-00-00 00:00:00', 'AutoSeed', '0.000000', 0, 'no', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '0', 'no', '0', 'no', 0, 'no', 0, 'no', '0', '0', '', 0, 0, '', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'yes', 'yes', 'no', 0, 0, '1990-01-01', 0, 'no', '', '', 'false', 'false', 'United Kingdom', 'gb.png', 'no', '', 0, '', '', 'no', 'yes', 'no', 0, '', 0, '', 0, 0, '', 5, '', 'true', 0, 0, '', 1, 'no', '0', '0', 'unknown', '', 'no', 'unknown', 'new'),
(12922, 'Admin', 'e714f5e09b26f37bb36f63f24789a3b5', '', '1', 'ed76b891ee652b00eede', 8, 545360, 'non@none', 1, 11, '2010-08-14 06:20:43', '2017-01-24 14:59:06', 1616026046, -1990116046275, 28991029248, '', '72cd5740c0c683b4bb8121f253039c15', 2, 15, 15, 55, '96.82.153.190', '-5', 'none@none', 0, 129, 0, '0000-00-00 00:00:00', 'Test1', '333074.686342', 0, 'yes', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '', 'no', '1d066ec0', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '91586', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'yes', 'yes', 'yes', 'no', 0, 0, '1990-01-01', 0, 'no', 'a:5:{i:0;s:148:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl01MDAwWy9iXSBib251cyBwb2ludHMgb24gdGhlIGN1c3RvbSB0aXRsZSBvZiBbYl0nVGVzdDEnWy9iXTwrPjA8Kz5TeXN0ZW08Kz4xNDc3MDg3NzUz";i:1;s:148:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl01MDAwWy9iXSBib251cyBwb2ludHMgb24gdGhlIGN1c3RvbSB0aXRsZSBvZiBbYl0nZG9vbSdbL2JdPCs+MDwrPlN5c3RlbTwrPjE0NzcwODc3NTg=";i:2;s:144:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl0xMDBbL2JdIGJvbnVzIHBvaW50cyBvbiBbYl01LjAwIEdCWy9iXSBvZiB1cGxvYWQgY3JlZGl0LjwrPjA8Kz5TeXN0ZW08Kz4xNDc4OTUyNTg0";i:3;s:144:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl0xMDBbL2JdIGJvbnVzIHBvaW50cyBvbiBbYl01LjAwIEdCWy9iXSBvZiB1cGxvYWQgY3JlZGl0LjwrPjA8Kz5TeXN0ZW08Kz4xNDc4OTUyNTg1";i:4;s:144:"W2JdVGVzdDFbL2JdIGhhcyBzcGVudCBbYl0xMDBbL2JdIGJvbnVzIHBvaW50cyBvbiBbYl01LjAwIEdCWy9iXSBvZiB1cGxvYWQgY3JlZGl0LjwrPjA8Kz5TeXN0ZW08Kz4xNDc4OTUyNTg2";}', '', 'false', 'false', 'United States of America', 'us.png', 'yes', '', 1, '', 'test', 'no', 'yes', 'yes', 1, '', 1258160, '', 0, 1484367799, '', 58, '', 'true', 0, 0, '', 1, 'yes', '0', '768', 'unknown', '', 'yes', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0.1 Safari/602.2.14', 'new'),
(23027, 'Demo', '0a5953444dc4aae6d30f1a92beb33758', '', '1', 'bd08e9dd58d58a4c4a3f', 5, 476318, 'non@none', 1, 11, '2011-03-01 16:07:10', '2017-01-24 14:56:02', 3573275451, 370561507041, 20215898751400, '', '52af35f9c16e4cd1112a04c80a45f02f', 12, 25, 25, 55, '212.251.219.59', '-7', 'none@none', 0, 11, 0, '0000-00-00 00:00:00', 'Test', '77153.057843', 0, 'yes', 'no', '3', '0000-00-00 00:00:00', 'no', '', '0000-00-00 00:00:00', 0, '', 'no', '', '0000-00-00 00:00:00', '', 'no', 'aa45232b', 'no', 0, 'no', 0, 'no', '', '', '', 0, 0, '21865', 'no', 'no', 0, 0, 0, '0', '0000-00-00 00:00:00', 'no', 'no', 'yes', 'yes', 'no', 0, 0, '1990-01-01', 0, 'no', 'a:32:{i:0;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTA=";i:1;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTM=";i:2;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTQ=";i:3;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTQ=";i:4;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:5;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:6;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:7;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:8;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTU=";i:9;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTY=";i:10;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTc=";i:11;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTc=";i:12;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTg=";i:13;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTg=";i:14;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTg=";i:15;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTk=";i:16;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUxOTk=";i:17;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUyMDA=";i:18;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUyMDA=";i:19;s:144:"W2JdRGVtb1svYl0gaGFzIHNwZW50IFtiXTEwMFsvYl0gYm9udXMgcG9pbnRzIG9uIFtiXTUuMDAgR0JbL2JdIG9mIHVwbG9hZCBjcmVkaXQuPCs+MDwrPlN5c3RlbTwrPjE0NzY0NzUyMDE=";i:20;s:208:"RGVtbyBoYXMgYmVlbiBiYW5uZWQgdmlhIHRoZSBCYW4gQnV0dG9uIGZvciBbYl10ZXN0MlsvYl08Kz4xMjkyMjwrPjxzcGFuIHN0eWxlPSJjb2xvcjojRkY2NjAwOyB0ZXh0LXNoYWRvdzogMHB4IDBweCA1cHggI0ZGNjYwMDsiPlRlc3QxPC9zcGFuPjwrPjE0Nzk5Mzg1NDQ=";i:21;s:192:"RGVtbyBpcyBubyBsb25nZXIgYmFubmVkIHZpYSB0aGUgQmFuIEJ1dHRvbjwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ3OTkzODg3Ng==";i:22;s:236:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSBib290ZWQgdW50aWwgW2JdMjAxNi0xMS0yNCAyMjowODoyOVsvYl0gZm9yIFtiXXRlc3RbL2JdPCs+MTI5MjI8Kz48c3BhbiBzdHlsZT0iY29sb3I6I0ZGNjYwMDsgdGV4dC1zaGFkb3c6IDBweCAwcHggNXB4ICNGRjY2MDA7Ij5UZXN0MTwvc3Bhbj48Kz4xNDc5OTM4OTA5";i:23;s:176:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSB1bmJvb3RlZDwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ3OTk1ODQ5NQ==";i:24;s:116:"V2FybiBMZXZlbCBpbmNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0Nzk5OTQ3OTU=";i:25;s:116:"V2FybiBMZXZlbCBkZWNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0ODAwMjkzNTI=";i:26;s:208:"RGVtbyBoYXMgYmVlbiBiYW5uZWQgdmlhIHRoZSBCYW4gQnV0dG9uIGZvciBbYl10ZXN0MlsvYl08Kz4xMjkyMjwrPjxzcGFuIHN0eWxlPSJjb2xvcjojRkY2NjAwOyB0ZXh0LXNoYWRvdzogMHB4IDBweCA1cHggI0ZGNjYwMDsiPlRlc3QxPC9zcGFuPjwrPjE0ODAwMjkzNjc=";i:27;s:236:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSBib290ZWQgdW50aWwgW2JdMjAxNi0xMS0yNSAyMzoxNjozNVsvYl0gZm9yIFtiXXRlc3RbL2JdPCs+MTI5MjI8Kz48c3BhbiBzdHlsZT0iY29sb3I6I0ZGNjYwMDsgdGV4dC1zaGFkb3c6IDBweCAwcHggNXB4ICNGRjY2MDA7Ij5UZXN0MTwvc3Bhbj48Kz4xNDgwMDI5Mzk1";i:28;s:116:"V2FybiBMZXZlbCBpbmNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0ODAwMjk4MTc=";i:29;s:116:"V2FybiBMZXZlbCBkZWNyZWFzZWQsIHJlZmVyIHRvIHRoZSBXYXJuIExvZyBmb3IgbW9yZSBkZXRhaWxzPCs+MDwrPlN5c3RlbTwrPjE0ODAwMjk4NTI=";i:30;s:176:"RGVtbyBoYXMgYmVlbiBtYW51YWxseSB1bmJvb3RlZDwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ4MDAyOTkyMg==";i:31;s:192:"RGVtbyBpcyBubyBsb25nZXIgYmFubmVkIHZpYSB0aGUgQmFuIEJ1dHRvbjwrPjEyOTIyPCs+PHNwYW4gc3R5bGU9ImNvbG9yOiNGRjY2MDA7IHRleHQtc2hhZG93OiAwcHggMHB4IDVweCAjRkY2NjAwOyI+VGVzdDE8L3NwYW4+PCs+MTQ4MDAyOTkzOQ==";}', '', 'false', 'false', 'Norway', 'no.png', 'yes', '', 1, '', '', 'no', 'yes', 'no', 1, '', 1505352, '', 370561507041, 1484370380, '', 6, '', 'true', 0, 0, '', 1, 'yes', '0', '60', 'unknown', '', 'yes', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36 OPR/42.0.2393.137', 'new');
-- --------------------------------------------------------

--
-- Table structure for table `blu_users_level`
--

CREATE TABLE `blu_users_level` (
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
-- Dumping data for table `blu_users_level`
--

INSERT INTO `blu_users_level` (`id`, `id_level`, `level`, `view_torrents`, `edit_torrents`, `delete_torrents`, `view_users`, `edit_users`, `delete_users`, `view_news`, `edit_news`, `delete_news`, `can_upload`, `can_download`, `view_forum`, `edit_forum`, `delete_forum`, `predef_level`, `can_be_deleted`, `admin_access`, `prefixcolor`, `suffixcolor`, `WT`, `autorank_state`, `autorank_position`, `autorank_min_upload`, `autorank_minratio`, `smf_group_mirror`, `ipb_group_mirror`, `bypass_dlcheck`, `torrents_limit`, `trusted`, `moderate_trusted`, `sel_team`, `all_teams`, `delete_comments`, `edit_comments`, `view_comments`, `delete_shout`, `edit_shout`, `view_shout`, `view_peers`, `view_history`, `view_userdetails_torrents`, `view_nfo`, `view_reencode`, `add_request`, `add_ddl`, `view_ddl`, `freeleech`, `can_hide`, `see_hidden`, `bump_torrents`, `set_multi`, `view_multi`, `view_new`, `up_new`, `down_new`, `view_arc`, `up_arc`, `down_arc`, `logical_rank_order`, `can_boot`, `down_req_intro`, `external_upload`, `external_refresh`, `can_stream`) VALUES
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
-- Table structure for table `blu_videos`
--

CREATE TABLE `blu_videos` (
  `title` text,
  `category` text,
  `id` varchar(11) DEFAULT NULL,
  `number` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_warn_logs`
--

CREATE TABLE `blu_warn_logs` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `contact` enum('none','pm') NOT NULL DEFAULT 'none',
  `date_added` int(10) NOT NULL DEFAULT '0',
  `type` enum('inc','dec') NOT NULL DEFAULT 'inc',
  `added_by` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_warn_reasons`
--

CREATE TABLE `blu_warn_reasons` (
  `id` int(11) NOT NULL,
  `active` enum('-1','0','1') NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '12'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_warn_reasons`
--

INSERT INTO `blu_warn_reasons` (`id`, `active`, `title`, `text`, `level`) VALUES
(1, '1', 'Corrupt File', 'It has been reported that this upload contains one or more corrupted files. Please reupload a proper version.', 12);

-- --------------------------------------------------------

--
-- Table structure for table `blu_watched_users`
--

CREATE TABLE `blu_watched_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(40) NOT NULL DEFAULT '',
  `cip` varchar(15) DEFAULT NULL,
  `location` text,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blu_welcome_msg`
--

CREATE TABLE `blu_welcome_msg` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blu_welcome_msg`
--

INSERT INTO `blu_welcome_msg` (`key`, `value`) VALUES
('fm_welcome_msg', '[left][color=silver]Welcome to SITNAME[/color]\r\n\r\nSITENAME has a strong community, and is a feature rich site. We hope you enjoy it, and join in the fun!\r\n\r\nBe sure to read the rules and FAQ before you start using the site.\r\n\r\nWe\'ve started you off with 50GB upload credit, and hope to see you on the forums and chat!\r\n\r\nWe are a strong friendly community and we hope you agree with us that SITNAME is so much more then just torrents!\r\n\r\ncheers[/left]'),
('fm_welcome_sub', 'Welcome To SITENAME');

-- --------------------------------------------------------

--
-- Table structure for table `blu_wishlist`
--

CREATE TABLE `blu_wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `torrent_id` varchar(40) NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Indexes for table `blu_addedexpected`
--
ALTER TABLE `blu_addedexpected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pollid` (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `blu_addedexpectedmin`
--
ALTER TABLE `blu_addedexpectedmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pollid` (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `blu_adminpanel`
--
ALTER TABLE `blu_adminpanel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_ads`
--
ALTER TABLE `blu_ads`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `blu_allowedclient`
--
ALTER TABLE `blu_allowedclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peer_id` (`peer_id`),
  ADD KEY `peer_id_ascii` (`peer_id_ascii`),
  ADD KEY `user_agent` (`user_agent`);

--
-- Indexes for table `blu_announcement`
--
ALTER TABLE `blu_announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added` (`added`);

--
-- Indexes for table `blu_announcements`
--
ALTER TABLE `blu_announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `blu_anti_hit_run`
--
ALTER TABLE `blu_anti_hit_run`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `blu_anti_hit_run_tasks`
--
ALTER TABLE `blu_anti_hit_run_tasks`
  ADD PRIMARY KEY (`last_time`);

--
-- Indexes for table `blu_bannedclient`
--
ALTER TABLE `blu_bannedclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peer_id` (`peer_id`),
  ADD KEY `peer_id_ascii` (`peer_id_ascii`),
  ADD KEY `user_agent` (`user_agent`);

--
-- Indexes for table `blu_bannedip`
--
ALTER TABLE `blu_bannedip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_last` (`first`,`last`);

--
-- Indexes for table `blu_baseline`
--
ALTER TABLE `blu_baseline`
  ADD PRIMARY KEY (`file_path`);

--
-- Indexes for table `blu_betgames`
--
ALTER TABLE `blu_betgames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_betlog`
--
ALTER TABLE `blu_betlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `userid_2` (`userid`,`bonus`);

--
-- Indexes for table `blu_betoptions`
--
ALTER TABLE `blu_betoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameid` (`gameid`);

--
-- Indexes for table `blu_bets`
--
ALTER TABLE `blu_bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameid` (`gameid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `blu_bettop`
--
ALTER TABLE `blu_bettop`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `blu_bitcoin_invoices`
--
ALTER TABLE `blu_bitcoin_invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `tracker_id` (`tracker_id`),
  ADD KEY `secret` (`secret`);

--
-- Indexes for table `blu_blackjack`
--
ALTER TABLE `blu_blackjack`
  ADD PRIMARY KEY (`gameid`);

--
-- Indexes for table `blu_blacklist`
--
ALTER TABLE `blu_blacklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tip` (`tip`);

--
-- Indexes for table `blu_blocks`
--
ALTER TABLE `blu_blocks`
  ADD PRIMARY KEY (`blockid`);

--
-- Indexes for table `blu_bonus`
--
ALTER TABLE `blu_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_bt_clients`
--
ALTER TABLE `blu_bt_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_bugs`
--
ALTER TABLE `blu_bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_categories`
--
ALTER TABLE `blu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_chat`
--
ALTER TABLE `blu_chat`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blu_chatfun`
--
ALTER TABLE `blu_chatfun`
  ADD PRIMARY KEY (`msgid`),
  ADD KEY `msgid` (`msgid`);

--
-- Indexes for table `blu_cheapmail`
--
ALTER TABLE `blu_cheapmail`
  ADD KEY `domain` (`domain`);

--
-- Indexes for table `blu_coins`
--
ALTER TABLE `blu_coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_comments`
--
ALTER TABLE `blu_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_hash` (`info_hash`);

--
-- Indexes for table `blu_contact_system`
--
ALTER TABLE `blu_contact_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_countries`
--
ALTER TABLE `blu_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_covers`
--
ALTER TABLE `blu_covers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `blu_donors`
--
ALTER TABLE `blu_donors`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blu_don_historie`
--
ALTER TABLE `blu_don_historie`
  ADD PRIMARY KEY (`don_id`);

--
-- Indexes for table `blu_downloads`
--
ALTER TABLE `blu_downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`uid`);

--
-- Indexes for table `blu_down_load`
--
ALTER TABLE `blu_down_load`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `hash` (`hash`);

--
-- Indexes for table `blu_dox`
--
ALTER TABLE `blu_dox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_expected`
--
ALTER TABLE `blu_expected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `blu_faq`
--
ALTER TABLE `blu_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_faq_group`
--
ALTER TABLE `blu_faq_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_fav_uploader`
--
ALTER TABLE `blu_fav_uploader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blu_featured`
--
ALTER TABLE `blu_featured`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `blu_files`
--
ALTER TABLE `blu_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `info_hash` (`info_hash`),
  ADD KEY `filename` (`filename`),
  ADD KEY `category` (`category`),
  ADD KEY `uploader` (`uploader`),
  ADD KEY `bin_hash` (`bin_hash`(20)),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `dead_time` (`dead_time`);

--
-- Indexes for table `blu_files_reencode`
--
ALTER TABLE `blu_files_reencode`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `blu_files_reencodeb`
--
ALTER TABLE `blu_files_reencodeb`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `blu_files_thanks`
--
ALTER TABLE `blu_files_thanks`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `blu_flashscores`
--
ALTER TABLE `blu_flashscores`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blu_forums`
--
ALTER TABLE `blu_forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sort` (`sort`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `blu_free_leech_req`
--
ALTER TABLE `blu_free_leech_req`
  ADD UNIQUE KEY `info_hash` (`info_hash`);

--
-- Indexes for table `blu_friendlist`
--
ALTER TABLE `blu_friendlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `blu_gold`
--
ALTER TABLE `blu_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_hacks`
--
ALTER TABLE `blu_hacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_helpdesk`
--
ALTER TABLE `blu_helpdesk`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blu_history`
--
ALTER TABLE `blu_history`
  ADD UNIQUE KEY `uid` (`uid`,`infohash`);

--
-- Indexes for table `blu_hnr`
--
ALTER TABLE `blu_hnr`
  ADD UNIQUE KEY `id_level` (`id_level`);

--
-- Indexes for table `blu_ignore`
--
ALTER TABLE `blu_ignore`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blu_imdb`
--
ALTER TABLE `blu_imdb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imdb` (`imdb`),
  ADD KEY `genre1` (`genre1`);

--
-- Indexes for table `blu_invalid_logins`
--
ALTER TABLE `blu_invalid_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_invitations`
--
ALTER TABLE `blu_invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inviter` (`id`);

--
-- Indexes for table `blu_ip2country`
--
ALTER TABLE `blu_ip2country`
  ADD KEY `country_code2` (`country_code2`);

--
-- Indexes for table `blu_iplog`
--
ALTER TABLE `blu_iplog`
  ADD PRIMARY KEY (`ipid`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `blu_khez_configs`
--
ALTER TABLE `blu_khez_configs`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `blu_kis_sent`
--
ALTER TABLE `blu_kis_sent`
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `blu_kis_users`
--
ALTER TABLE `blu_kis_users`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `blu_language`
--
ALTER TABLE `blu_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_logs`
--
ALTER TABLE `blu_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added` (`added`);

--
-- Indexes for table `blu_lottery_config`
--
ALTER TABLE `blu_lottery_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_lottery_tickets`
--
ALTER TABLE `blu_lottery_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_lottery_winners`
--
ALTER TABLE `blu_lottery_winners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_low_ratio_ban`
--
ALTER TABLE `blu_low_ratio_ban`
  ADD UNIQUE KEY `wb_rank` (`wb_rank`);

--
-- Indexes for table `blu_messages`
--
ALTER TABLE `blu_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `blu_moderate_reasons`
--
ALTER TABLE `blu_moderate_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_modules`
--
ALTER TABLE `blu_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `blu_news`
--
ALTER TABLE `blu_news`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blu_notes`
--
ALTER TABLE `blu_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_offer_comments`
--
ALTER TABLE `blu_offer_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `blu_online`
--
ALTER TABLE `blu_online`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blu_partner`
--
ALTER TABLE `blu_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_paypal_settings`
--
ALTER TABLE `blu_paypal_settings`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blu_peers`
--
ALTER TABLE `blu_peers`
  ADD PRIMARY KEY (`infohash`,`peer_id`),
  ADD UNIQUE KEY `sequence` (`sequence`),
  ADD KEY `pid` (`pid`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `blu_poller`
--
ALTER TABLE `blu_poller`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blu_poller_option`
--
ALTER TABLE `blu_poller_option`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blu_poller_vote`
--
ALTER TABLE `blu_poller_vote`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blu_polls`
--
ALTER TABLE `blu_polls`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `blu_poll_voters`
--
ALTER TABLE `blu_poll_voters`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `blu_pool`
--
ALTER TABLE `blu_pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_pool_settings`
--
ALTER TABLE `blu_pool_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_posts`
--
ALTER TABLE `blu_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topicid` (`topicid`),
  ADD KEY `userid` (`userid`);
ALTER TABLE `blu_posts` ADD FULLTEXT KEY `body` (`body`);

--
-- Indexes for table `blu_profile_status`
--
ALTER TABLE `blu_profile_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `blu_quiz`
--
ALTER TABLE `blu_quiz`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `blu_rank`
--
ALTER TABLE `blu_rank`
  ADD KEY `old_rank` (`old_rank`),
  ADD KEY `byt` (`byt`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `blu_ratings`
--
ALTER TABLE `blu_ratings`
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `blu_readposts`
--
ALTER TABLE `blu_readposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topicid` (`topicid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `blu_recommended`
--
ALTER TABLE `blu_recommended`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_hash` (`info_hash`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `blu_reports`
--
ALTER TABLE `blu_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_reputation`
--
ALTER TABLE `blu_reputation`
  ADD PRIMARY KEY (`reputationid`),
  ADD KEY `dateadd` (`dateadd`),
  ADD KEY `multi` (`userid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `whoadded` (`whoadded`);

--
-- Indexes for table `blu_requests`
--
ALTER TABLE `blu_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester` (`requester`),
  ADD KEY `category` (`category`),
  ADD KEY `uploadedby` (`uploadedby`),
  ADD KEY `jobtakenby` (`jobtakenby`),
  ADD KEY `infohash` (`infohash`);

--
-- Indexes for table `blu_requests_bounty`
--
ALTER TABLE `blu_requests_bounty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addedby` (`addedby`),
  ADD KEY `id` (`req_id`);

--
-- Indexes for table `blu_requests_comments`
--
ALTER TABLE `blu_requests_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_id` (`req_id`),
  ADD KEY `addedby` (`addedby`);

--
-- Indexes for table `blu_rules`
--
ALTER TABLE `blu_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_rules_group`
--
ALTER TABLE `blu_rules_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_searchcloud`
--
ALTER TABLE `blu_searchcloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_seedboxip`
--
ALTER TABLE `blu_seedboxip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_seo`
--
ALTER TABLE `blu_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_settings`
--
ALTER TABLE `blu_settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `blu_shitlist`
--
ALTER TABLE `blu_shitlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blu_shoutcastdj`
--
ALTER TABLE `blu_shoutcastdj`
  ADD KEY `id` (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `blu_signup_ip_block`
--
ALTER TABLE `blu_signup_ip_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_sitemap`
--
ALTER TABLE `blu_sitemap`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `url` (`url`);

--
-- Indexes for table `blu_smilies`
--
ALTER TABLE `blu_smilies`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `blu_sticky`
--
ALTER TABLE `blu_sticky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_stream`
--
ALTER TABLE `blu_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_stream_porn`
--
ALTER TABLE `blu_stream_porn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_stream_servers`
--
ALTER TABLE `blu_stream_servers`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `blu_stream_users`
--
ALTER TABLE `blu_stream_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_style`
--
ALTER TABLE `blu_style`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_style_bridge`
--
ALTER TABLE `blu_style_bridge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blu_style` (`blu_style`);

--
-- Indexes for table `blu_subtitles`
--
ALTER TABLE `blu_subtitles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`);

--
-- Indexes for table `blu_tasks`
--
ALTER TABLE `blu_tasks`
  ADD PRIMARY KEY (`task`);

--
-- Indexes for table `blu_teams`
--
ALTER TABLE `blu_teams`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blu_tested`
--
ALTER TABLE `blu_tested`
  ADD PRIMARY KEY (`tested`);

--
-- Indexes for table `blu_timestamps`
--
ALTER TABLE `blu_timestamps`
  ADD PRIMARY KEY (`sequence`),
  ADD KEY `sorting` (`info_hash`);

--
-- Indexes for table `blu_timezone`
--
ALTER TABLE `blu_timezone`
  ADD PRIMARY KEY (`difference`);

--
-- Indexes for table `blu_topics`
--
ALTER TABLE `blu_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `subject` (`subject`),
  ADD KEY `lastpost` (`lastpost`);

--
-- Indexes for table `blu_userbars`
--
ALTER TABLE `blu_userbars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_users`
--
ALTER TABLE `blu_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `pid` (`pid`),
  ADD KEY `cip` (`cip`),
  ADD KEY `smf_fid` (`smf_fid`),
  ADD KEY `ipb_fid` (`ipb_fid`),
  ADD KEY `avatar_upload` (`avatar_upload`);

--
-- Indexes for table `blu_users_level`
--
ALTER TABLE `blu_users_level`
  ADD UNIQUE KEY `base` (`id`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `smf_group_mirror` (`smf_group_mirror`),
  ADD KEY `ipb_group_mirror` (`ipb_group_mirror`);

--
-- Indexes for table `blu_videos`
--
ALTER TABLE `blu_videos`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `blu_warn_logs`
--
ALTER TABLE `blu_warn_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_warn_reasons`
--
ALTER TABLE `blu_warn_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blu_watched_users`
--
ALTER TABLE `blu_watched_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cip` (`cip`);

--
-- Indexes for table `blu_welcome_msg`
--
ALTER TABLE `blu_welcome_msg`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `blu_wishlist`
--
ALTER TABLE `blu_wishlist`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1861;
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
-- AUTO_INCREMENT for table `blu_addedexpected`
--
ALTER TABLE `blu_addedexpected`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_addedexpectedmin`
--
ALTER TABLE `blu_addedexpectedmin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_adminpanel`
--
ALTER TABLE `blu_adminpanel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `blu_allowedclient`
--
ALTER TABLE `blu_allowedclient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_announcement`
--
ALTER TABLE `blu_announcement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_announcements`
--
ALTER TABLE `blu_announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `blu_bannedclient`
--
ALTER TABLE `blu_bannedclient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_bannedip`
--
ALTER TABLE `blu_bannedip`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_betgames`
--
ALTER TABLE `blu_betgames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_betlog`
--
ALTER TABLE `blu_betlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_betoptions`
--
ALTER TABLE `blu_betoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_bets`
--
ALTER TABLE `blu_bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_bitcoin_invoices`
--
ALTER TABLE `blu_bitcoin_invoices`
  MODIFY `invoice_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_blackjack`
--
ALTER TABLE `blu_blackjack`
  MODIFY `gameid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_blacklist`
--
ALTER TABLE `blu_blacklist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_blocks`
--
ALTER TABLE `blu_blocks`
  MODIFY `blockid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `blu_bonus`
--
ALTER TABLE `blu_bonus`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `blu_bt_clients`
--
ALTER TABLE `blu_bt_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_bugs`
--
ALTER TABLE `blu_bugs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_categories`
--
ALTER TABLE `blu_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `blu_chat`
--
ALTER TABLE `blu_chat`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_chatfun`
--
ALTER TABLE `blu_chatfun`
  MODIFY `msgid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_coins`
--
ALTER TABLE `blu_coins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blu_comments`
--
ALTER TABLE `blu_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `blu_contact_system`
--
ALTER TABLE `blu_contact_system`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blu_countries`
--
ALTER TABLE `blu_countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `blu_covers`
--
ALTER TABLE `blu_covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_donors`
--
ALTER TABLE `blu_donors`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_downloads`
--
ALTER TABLE `blu_downloads`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_down_load`
--
ALTER TABLE `blu_down_load`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_dox`
--
ALTER TABLE `blu_dox`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_expected`
--
ALTER TABLE `blu_expected`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_faq`
--
ALTER TABLE `blu_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_faq_group`
--
ALTER TABLE `blu_faq_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_fav_uploader`
--
ALTER TABLE `blu_fav_uploader`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_featured`
--
ALTER TABLE `blu_featured`
  MODIFY `fid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `blu_files`
--
ALTER TABLE `blu_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blu_flashscores`
--
ALTER TABLE `blu_flashscores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_forums`
--
ALTER TABLE `blu_forums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blu_friendlist`
--
ALTER TABLE `blu_friendlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_gold`
--
ALTER TABLE `blu_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_hacks`
--
ALTER TABLE `blu_hacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `blu_helpdesk`
--
ALTER TABLE `blu_helpdesk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_ignore`
--
ALTER TABLE `blu_ignore`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_imdb`
--
ALTER TABLE `blu_imdb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_invalid_logins`
--
ALTER TABLE `blu_invalid_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_invitations`
--
ALTER TABLE `blu_invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;
--
-- AUTO_INCREMENT for table `blu_iplog`
--
ALTER TABLE `blu_iplog`
  MODIFY `ipid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_language`
--
ALTER TABLE `blu_language`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `blu_logs`
--
ALTER TABLE `blu_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `blu_lottery_tickets`
--
ALTER TABLE `blu_lottery_tickets`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_lottery_winners`
--
ALTER TABLE `blu_lottery_winners`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_messages`
--
ALTER TABLE `blu_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `blu_moderate_reasons`
--
ALTER TABLE `blu_moderate_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_modules`
--
ALTER TABLE `blu_modules`
  MODIFY `id` mediumint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `blu_news`
--
ALTER TABLE `blu_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_notes`
--
ALTER TABLE `blu_notes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_offer_comments`
--
ALTER TABLE `blu_offer_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_partner`
--
ALTER TABLE `blu_partner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_peers`
--
ALTER TABLE `blu_peers`
  MODIFY `sequence` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;
--
-- AUTO_INCREMENT for table `blu_poller`
--
ALTER TABLE `blu_poller`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blu_poller_option`
--
ALTER TABLE `blu_poller_option`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blu_poller_vote`
--
ALTER TABLE `blu_poller_vote`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blu_polls`
--
ALTER TABLE `blu_polls`
  MODIFY `pid` mediumint(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_poll_voters`
--
ALTER TABLE `blu_poll_voters`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_pool`
--
ALTER TABLE `blu_pool`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_pool_settings`
--
ALTER TABLE `blu_pool_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_posts`
--
ALTER TABLE `blu_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `blu_profile_status`
--
ALTER TABLE `blu_profile_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_quiz`
--
ALTER TABLE `blu_quiz`
  MODIFY `qid` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_readposts`
--
ALTER TABLE `blu_readposts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `blu_recommended`
--
ALTER TABLE `blu_recommended`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_reports`
--
ALTER TABLE `blu_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_reputation`
--
ALTER TABLE `blu_reputation`
  MODIFY `reputationid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_requests`
--
ALTER TABLE `blu_requests`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blu_requests_bounty`
--
ALTER TABLE `blu_requests_bounty`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blu_requests_comments`
--
ALTER TABLE `blu_requests_comments`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blu_rules`
--
ALTER TABLE `blu_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_rules_group`
--
ALTER TABLE `blu_rules_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_searchcloud`
--
ALTER TABLE `blu_searchcloud`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_seedboxip`
--
ALTER TABLE `blu_seedboxip`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_shitlist`
--
ALTER TABLE `blu_shitlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_shoutcastdj`
--
ALTER TABLE `blu_shoutcastdj`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_signup_ip_block`
--
ALTER TABLE `blu_signup_ip_block`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blu_sitemap`
--
ALTER TABLE `blu_sitemap`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_stream`
--
ALTER TABLE `blu_stream`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_stream_porn`
--
ALTER TABLE `blu_stream_porn`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_stream_servers`
--
ALTER TABLE `blu_stream_servers`
  MODIFY `sid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_stream_users`
--
ALTER TABLE `blu_stream_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_style`
--
ALTER TABLE `blu_style`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `blu_style_bridge`
--
ALTER TABLE `blu_style_bridge`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_subtitles`
--
ALTER TABLE `blu_subtitles`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blu_teams`
--
ALTER TABLE `blu_teams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_timestamps`
--
ALTER TABLE `blu_timestamps`
  MODIFY `sequence` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8471;
--
-- AUTO_INCREMENT for table `blu_topics`
--
ALTER TABLE `blu_topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blu_userbars`
--
ALTER TABLE `blu_userbars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_users`
--
ALTER TABLE `blu_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58876;
--
-- AUTO_INCREMENT for table `blu_users_level`
--
ALTER TABLE `blu_users_level`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blu_videos`
--
ALTER TABLE `blu_videos`
  MODIFY `number` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blu_warn_logs`
--
ALTER TABLE `blu_warn_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blu_warn_reasons`
--
ALTER TABLE `blu_warn_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blu_watched_users`
--
ALTER TABLE `blu_watched_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;
--
-- AUTO_INCREMENT for table `blu_wishlist`
--
ALTER TABLE `blu_wishlist`
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
