-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 juin 2018 à 09:00
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tastet`
--

-- --------------------------------------------------------

--
-- Structure de la table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Un commentateur WordPress', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2018-06-08 17:25:56', '2018-06-08 15:25:56', 'Bonjour, ceci est un commentaire.\nPour débuter avec la modération, la modification et la suppression de commentaires, veuillez visiter l’écran des Commentaires dans le Tableau de bord.\nLes avatars des personnes qui commentent arrivent depuis <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=310 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/firstwordpress', 'yes'),
(2, 'home', 'http://localhost/firstwordpress', 'yes'),
(3, 'blogname', 'Tastet', 'yes'),
(4, 'blogdescription', 'Un site utilisant WordPress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'chestermandimby67@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'j F Y', 'yes'),
(24, 'time_format', 'G \\h i \\m\\i\\n', 'yes'),
(25, 'links_updated_date_format', 'j F Y G \\h i \\m\\i\\n', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:113:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:36:\"vehicule/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:46:\"vehicule/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:66:\"vehicule/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"vehicule/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"vehicule/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:42:\"vehicule/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:25:\"vehicule/([^/]+)/embed/?$\";s:45:\"index.php?wpcm_vehicle=$matches[1]&embed=true\";s:29:\"vehicule/([^/]+)/trackback/?$\";s:39:\"index.php?wpcm_vehicle=$matches[1]&tb=1\";s:37:\"vehicule/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?wpcm_vehicle=$matches[1]&paged=$matches[2]\";s:44:\"vehicule/([^/]+)/comment-page-([0-9]{1,})/?$\";s:52:\"index.php?wpcm_vehicle=$matches[1]&cpage=$matches[2]\";s:33:\"vehicule/([^/]+)(?:/([0-9]+))?/?$\";s:51:\"index.php?wpcm_vehicle=$matches[1]&page=$matches[2]\";s:25:\"vehicule/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:35:\"vehicule/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:55:\"vehicule/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"vehicule/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"vehicule/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:31:\"vehicule/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:45:\"marque/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?wpcm_make_model=$matches[1]&feed=$matches[2]\";s:40:\"marque/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?wpcm_make_model=$matches[1]&feed=$matches[2]\";s:21:\"marque/(.+?)/embed/?$\";s:48:\"index.php?wpcm_make_model=$matches[1]&embed=true\";s:33:\"marque/(.+?)/page/?([0-9]{1,})/?$\";s:55:\"index.php?wpcm_make_model=$matches[1]&paged=$matches[2]\";s:15:\"marque/(.+?)/?$\";s:37:\"index.php?wpcm_make_model=$matches[1]\";s:52:\"équipement/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?wpcm_features=$matches[1]&feed=$matches[2]\";s:47:\"équipement/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?wpcm_features=$matches[1]&feed=$matches[2]\";s:28:\"équipement/([^/]+)/embed/?$\";s:46:\"index.php?wpcm_features=$matches[1]&embed=true\";s:40:\"équipement/([^/]+)/page/?([0-9]{1,})/?$\";s:53:\"index.php?wpcm_features=$matches[1]&paged=$matches[2]\";s:22:\"équipement/([^/]+)/?$\";s:35:\"index.php?wpcm_features=$matches[1]\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:3:{i:0;s:36:\"contact-form-7/wp-contact-form-7.php\";i:1;s:23:\"ml-slider/ml-slider.php\";i:2;s:33:\"wp-car-manager/wp-car-manager.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', 'a:3:{i:0;s:75:\"C:\\wamp64\\www\\firstwordpress/wp-content/themes/vw-automobile-lite/style.css\";i:1;s:76:\"C:\\wamp64\\www\\firstwordpress/wp-content/themes/vw-automobile-lite/header.php\";i:3;s:0:\"\";}', 'no'),
(40, 'template', 'ShaftThemes', 'yes'),
(41, 'stylesheet', 'ShaftThemes', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:3:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;i:3;a:4:{s:5:\"title\";s:7:\"Contact\";s:4:\"text\";s:56:\"[contact-form-7 id=\"22\" title=\"Formulaire de contact 1\"]\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;}}', 'yes'),
(80, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', 'Europe/Paris', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'initial_db_version', '38590', 'yes'),
(93, 'wp_user_roles', 'a:6:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:79:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:19:\"manage_car_listings\";b:1;s:16:\"edit_car_listing\";b:1;s:16:\"read_car_listing\";b:1;s:18:\"delete_car_listing\";b:1;s:17:\"edit_car_listings\";b:1;s:24:\"edit_others_car_listings\";b:1;s:20:\"publish_car_listings\";b:1;s:25:\"read_private_car_listings\";b:1;s:19:\"delete_car_listings\";b:1;s:27:\"delete_private_car_listings\";b:1;s:29:\"delete_published_car_listings\";b:1;s:26:\"delete_others_car_listings\";b:1;s:25:\"edit_private_car_listings\";b:1;s:27:\"edit_published_car_listings\";b:1;s:24:\"manage_car_listing_terms\";b:1;s:22:\"edit_car_listing_terms\";b:1;s:24:\"delete_car_listing_terms\";b:1;s:24:\"assign_car_listing_terms\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:10:\"car_seller\";a:2:{s:4:\"name\";s:10:\"Car Seller\";s:12:\"capabilities\";a:3:{s:4:\"read\";b:1;s:10:\"edit_posts\";b:0;s:12:\"delete_posts\";b:0;}}}', 'yes'),
(94, 'fresh_site', '0', 'yes'),
(95, 'WPLANG', 'fr_FR', 'yes'),
(96, 'widget_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(97, 'widget_recent-posts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-comments', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_archives', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_meta', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'sidebars_widgets', 'a:9:{s:19:\"wp_inactive_widgets\";a:0:{}s:17:\"sidebar_default_r\";a:1:{i:0;s:6:\"text-3\";}s:17:\"sidebar_default_l\";a:0:{}s:10:\"header_ads\";a:0:{}s:8:\"footer_1\";a:0:{}s:8:\"footer_2\";a:0:{}s:8:\"footer_3\";a:0:{}s:8:\"footer_4\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(102, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'cron', 'a:6:{i:1529054756;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1529076356;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1529076391;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1529076979;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1529107260;a:1:{s:21:\"wpcm_crob_set_expired\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(112, 'theme_mods_twentyseventeen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1528471726;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}', 'yes'),
(125, 'can_compress_scripts', '1', 'no'),
(308, '_site_transient_timeout_theme_roots', '1529053478', 'no'),
(309, '_site_transient_theme_roots', 'a:5:{s:11:\"ShaftThemes\";s:7:\"/themes\";s:13:\"twentyfifteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:13:\"twentysixteen\";s:7:\"/themes\";s:18:\"vw-automobile-lite\";s:7:\"/themes\";}', 'no'),
(123, '_site_transient_timeout_browser_4d90fb766c3b51de57fa42e860c03217', '1529076372', 'no'),
(124, '_site_transient_browser_4d90fb766c3b51de57fa42e860c03217', 'a:10:{s:4:\"name\";s:7:\"Firefox\";s:7:\"version\";s:4:\"60.0\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:24:\"https://www.firefox.com/\";s:7:\"img_src\";s:44:\"http://s.w.org/images/browsers/firefox.png?1\";s:11:\"img_src_ssl\";s:45:\"https://s.w.org/images/browsers/firefox.png?1\";s:15:\"current_version\";s:2:\"56\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(265, 'category_children', 'a:0:{}', 'yes'),
(305, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1529051680;s:7:\"checked\";a:5:{s:19:\"akismet/akismet.php\";s:5:\"4.0.7\";s:36:\"contact-form-7/wp-contact-form-7.php\";s:5:\"5.0.2\";s:9:\"hello.php\";s:3:\"1.7\";s:23:\"ml-slider/ml-slider.php\";s:5:\"3.8.1\";s:33:\"wp-car-manager/wp-car-manager.php\";s:5:\"1.3.5\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:5:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"4.0.7\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.4.0.7.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}}s:36:\"contact-form-7/wp-contact-form-7.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:28:\"w.org/plugins/contact-form-7\";s:4:\"slug\";s:14:\"contact-form-7\";s:6:\"plugin\";s:36:\"contact-form-7/wp-contact-form-7.php\";s:11:\"new_version\";s:5:\"5.0.2\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/contact-form-7/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/contact-form-7.5.0.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:66:\"https://ps.w.org/contact-form-7/assets/icon-256x256.png?rev=984007\";s:2:\"1x\";s:66:\"https://ps.w.org/contact-form-7/assets/icon-128x128.png?rev=984007\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/contact-form-7/assets/banner-1544x500.png?rev=860901\";s:2:\"1x\";s:68:\"https://ps.w.org/contact-form-7/assets/banner-772x250.png?rev=880427\";}s:11:\"banners_rtl\";a:0:{}}s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907\";s:2:\"1x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:65:\"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342\";}s:11:\"banners_rtl\";a:0:{}}s:23:\"ml-slider/ml-slider.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:23:\"w.org/plugins/ml-slider\";s:4:\"slug\";s:9:\"ml-slider\";s:6:\"plugin\";s:23:\"ml-slider/ml-slider.php\";s:11:\"new_version\";s:5:\"3.8.1\";s:3:\"url\";s:40:\"https://wordpress.org/plugins/ml-slider/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/ml-slider.3.8.1.zip\";s:5:\"icons\";a:3:{s:2:\"2x\";s:62:\"https://ps.w.org/ml-slider/assets/icon-256x256.png?rev=1837669\";s:2:\"1x\";s:54:\"https://ps.w.org/ml-slider/assets/icon.svg?rev=1837669\";s:3:\"svg\";s:54:\"https://ps.w.org/ml-slider/assets/icon.svg?rev=1837669\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:65:\"https://ps.w.org/ml-slider/assets/banner-1544x500.png?rev=1837669\";s:2:\"1x\";s:64:\"https://ps.w.org/ml-slider/assets/banner-772x250.png?rev=1837669\";}s:11:\"banners_rtl\";a:0:{}}s:33:\"wp-car-manager/wp-car-manager.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:28:\"w.org/plugins/wp-car-manager\";s:4:\"slug\";s:14:\"wp-car-manager\";s:6:\"plugin\";s:33:\"wp-car-manager/wp-car-manager.php\";s:11:\"new_version\";s:5:\"1.3.5\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/wp-car-manager/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/wp-car-manager.1.3.5.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/wp-car-manager/assets/icon-256x256.png?rev=1217694\";s:2:\"1x\";s:67:\"https://ps.w.org/wp-car-manager/assets/icon-128x128.png?rev=1217694\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:69:\"https://ps.w.org/wp-car-manager/assets/banner-772x250.png?rev=1217694\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no'),
(303, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/fr_FR/wordpress-4.9.6.zip\";s:6:\"locale\";s:5:\"fr_FR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/fr_FR/wordpress-4.9.6.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.9.6\";s:7:\"version\";s:5:\"4.9.6\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1529051674;s:15:\"version_checked\";s:5:\"4.9.6\";s:12:\"translations\";a:0:{}}', 'no'),
(284, 'theme_mods_ShaftThemes', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:1:{s:18:\"Primary_Navigation\";i:2;}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(144, 'current_theme', 'ShaftThemes', 'yes'),
(145, 'theme_mods_vw-automobile-lite', 'a:6:{i:0;b:0;s:18:\"nav_menu_locations\";a:1:{s:7:\"primary\";i:2;}s:18:\"custom_css_post_id\";i:-1;s:12:\"header_image\";s:13:\"remove-header\";s:16:\"background_image\";s:0:\"\";s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1528880457;s:4:\"data\";a:8:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:1:{i:0;s:6:\"text-3\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}s:8:\"footer-1\";a:0:{}s:8:\"footer-2\";a:0:{}s:8:\"footer-3\";a:0:{}s:8:\"footer-4\";a:0:{}}}}', 'yes'),
(146, 'theme_switched', '', 'yes'),
(149, 'recently_activated', 'a:0:{}', 'yes'),
(180, 'wpcf7', 'a:2:{s:7:\"version\";s:5:\"5.0.2\";s:13:\"bulk_validate\";a:4:{s:9:\"timestamp\";d:1528479645;s:7:\"version\";s:5:\"5.0.2\";s:11:\"count_valid\";i:1;s:13:\"count_invalid\";i:0;}}', 'yes'),
(188, 'ms_hide_all_ads_until', '1529682713', 'yes'),
(189, 'metaslider_systemcheck', 'a:2:{s:16:\"wordPressVersion\";b:0;s:12:\"imageLibrary\";b:0;}', 'no'),
(190, 'ml-slider_children', 'a:0:{}', 'yes'),
(191, 'metaslider_tour_cancelled_on', 'step_add_slide', 'yes'),
(154, 'wpcm_current_version', '1.3.5', 'yes'),
(155, 'wpcm_currency', 'USD', 'yes'),
(156, 'wpcm_currency_pos', 'left', 'yes'),
(157, 'wpcm_decimal_separator', '.', 'yes'),
(158, 'wpcm_thousand_separator', ',', 'yes'),
(159, 'wpcm_distance_unit', 'miles', 'yes'),
(160, 'wpcm_date_format', 'm-Y', 'yes'),
(161, 'wpcm_listings_hide_sold', '', 'yes'),
(162, 'wpcm_listings_ppp', '10', 'yes'),
(163, 'wpcm_account_creation', '1', 'yes'),
(164, 'wpcm_account_username', '1', 'yes'),
(165, 'wpcm_account_role', 'car_seller', 'yes'),
(166, 'wpcm_moderate_new_listings', '1', 'yes'),
(167, 'wpcm_listing_duration', '30', 'yes'),
(168, 'wpcm_contact_email', 'chestermandimby67@gmail.com', 'yes'),
(169, 'wpcm_contact_phone', '', 'yes'),
(170, 'wpcm_page_submit', '0', 'yes'),
(171, 'wpcm_page_dashboard', '0', 'yes'),
(172, 'wpcm_page_listings', '2', 'yes'),
(181, 'nav_menu_options', 'a:1:{s:8:\"auto_add\";a:0:{}}', 'yes'),
(182, 'wpcm_make_model_children', 'a:0:{}', 'yes'),
(187, 'widget_metaslider_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(304, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1529051680;s:7:\"checked\";a:5:{s:11:\"ShaftThemes\";s:3:\"1.0\";s:13:\"twentyfifteen\";s:3:\"2.0\";s:15:\"twentyseventeen\";s:3:\"1.6\";s:13:\"twentysixteen\";s:3:\"1.5\";s:18:\"vw-automobile-lite\";s:7:\"1.0.4.9\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(285, 'ST_SETTINGS_OPTION', 'a:53:{s:15:\"page_full_boxed\";s:1:\"b\";s:6:\"layout\";s:1:\"2\";s:8:\"page_rtl\";s:1:\"n\";s:9:\"sidebar_l\";s:0:\"\";s:9:\"sidebar_r\";s:17:\"sidebar_default_r\";s:14:\"sidebar_search\";s:0:\"\";s:18:\"show_footer_widget\";s:1:\"y\";s:15:\"show_footer_nav\";s:1:\"y\";s:9:\"site_logo\";s:84:\"http://localhost/firstwordpress/wp-content/themes/ShaftThemes/assets/images/logo.png\";s:16:\"logo_padding_top\";s:2:\"20\";s:19:\"logo_padding_bottom\";s:2:\"20\";s:14:\"enable_favicon\";s:1:\"y\";s:12:\"site_favicon\";s:74:\"http://localhost/magazon/magazon-wp/wp-content/uploads/2013/02/favicon.ico\";s:8:\"sidebars\";a:2:{i:0;a:2:{s:5:\"title\";s:10:\"Contact Us\";s:2:\"id\";s:15:\"id1360136022582\";}i:1;a:2:{s:5:\"title\";s:16:\"Reviews Category\";s:2:\"id\";s:15:\"id1361426253157\";}}s:9:\"body_font\";a:5:{s:9:\"font-size\";s:2:\"12\";s:14:\"font-size-unit\";s:2:\"px\";s:11:\"line-height\";s:2:\"22\";s:16:\"line-height-unit\";s:2:\"px\";s:11:\"font-family\";s:76:\"http://fonts.googleapis.com/css?family=Droid+Sans:regular%2C700&subset=latin\";}s:12:\"heading_font\";a:3:{s:11:\"font-family\";s:76:\"http://fonts.googleapis.com/css?family=Droid+Sans:regular%2C700&subset=latin\";s:10:\"font-style\";s:6:\"normal\";s:11:\"font-weight\";s:6:\"normal\";}s:20:\"archive_heading_font\";a:3:{s:11:\"font-family\";s:90:\"http://fonts.googleapis.com/css?family=Oswald:300%2Cregular%2C700&subset=latin%2Clatin-ext\";s:10:\"font-style\";s:6:\"normal\";s:11:\"font-weight\";s:6:\"normal\";}s:17:\"predefined_colors\";s:6:\"16A1E7\";s:25:\"enable_custom_global_skin\";s:1:\"n\";s:18:\"custom_global_skin\";s:6:\"800a80\";s:8:\"bg_color\";s:6:\"CCCCCC\";s:6:\"bg_img\";s:75:\"http://demo.smooththemes.com/magazon/wp-content/uploads/2013/02/body_bg.jpg\";s:10:\"bg_positon\";s:2:\"cc\";s:10:\"bg_repreat\";s:1:\"n\";s:8:\"bg_fixed\";s:1:\"y\";s:18:\"enable_share_entry\";s:1:\"y\";s:18:\"enable_author_desc\";s:1:\"y\";s:12:\"enable_re_re\";s:1:\"y\";s:15:\"disable_s_thumb\";s:1:\"n\";s:20:\"disable_single_media\";s:1:\"n\";s:25:\"disable_single_categories\";s:1:\"n\";s:30:\"display_single_author_metadata\";s:1:\"y\";s:28:\"display_single_date_metadata\";s:1:\"y\";s:31:\"display_single_comment_metadata\";s:1:\"y\";s:8:\"facebook\";s:1:\"#\";s:7:\"twitter\";s:1:\"#\";s:11:\"google_plus\";s:1:\"#\";s:8:\"linkedin\";s:1:\"#\";s:9:\"pinterest\";s:0:\"\";s:18:\"social_link_target\";s:6:\"_blank\";s:16:\"footer_copyright\";s:129:\"&copy; 2012. All Rights Reserved. Created with love by <a target=\\\"_blank\\\" href=\\\"http://www.smooththemes.com\\\">SmoothThemes</a>\";s:14:\"flex_animation\";s:4:\"fade\";s:17:\"flex_smoothHeight\";s:5:\"false\";s:18:\"flex_animationLoop\";s:4:\"true\";s:14:\"flex_slideshow\";s:4:\"true\";s:19:\"flex_slideshowSpeed\";s:4:\"7000\";s:19:\"flex_animationSpeed\";s:4:\"6000\";s:18:\"flex_pauseOnAction\";s:4:\"true\";s:17:\"flex_pauseOnHover\";s:4:\"true\";s:15:\"flex_controlNav\";s:4:\"true\";s:14:\"flex_randomize\";s:5:\"false\";s:21:\"headder_tracking_code\";s:0:\"\";s:20:\"footer_tracking_code\";s:0:\"\";}', 'yes'),
(286, 'widget_stpopularposts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(287, 'widget_strelatedposts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(288, 'widget_strecentposts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(289, 'widget_strecentcomments', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(290, 'widget_sttabscontent', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(291, 'widget_stflickrwidget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(292, 'widget_stsocialsconnect', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(293, 'widget_st_widget_125', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(294, 'st_framework_version', '1.0', 'yes');

-- --------------------------------------------------------

--
-- Structure de la table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 5, '_wp_attached_file', '2018/06/slider3.jpg'),
(4, 5, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1700;s:6:\"height\";i:400;s:4:\"file\";s:19:\"2018/06/slider3.jpg\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"slider3-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"slider3-300x71.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:71;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:19:\"slider3-768x181.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:181;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:20:\"slider3-1024x241.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:241;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:19:\"slider3-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(5, 5, '_wp_attachment_is_custom_background', 'vw-automobile-lite'),
(6, 6, '_wp_attached_file', '2018/06/slider3-1.jpg'),
(7, 6, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1700;s:6:\"height\";i:400;s:4:\"file\";s:21:\"2018/06/slider3-1.jpg\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:21:\"slider3-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"slider3-1-300x71.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:71;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:21:\"slider3-1-768x181.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:181;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"slider3-1-1024x241.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:241;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:21:\"slider3-1-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(8, 7, '_wp_attached_file', '2018/06/cropped-slider3-1.jpg'),
(9, 7, '_wp_attachment_context', 'custom-header'),
(10, 7, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:1600;s:6:\"height\";i:400;s:4:\"file\";s:29:\"2018/06/cropped-slider3-1.jpg\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:29:\"cropped-slider3-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:28:\"cropped-slider3-1-300x75.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:75;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:29:\"cropped-slider3-1-768x192.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:192;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:30:\"cropped-slider3-1-1024x256.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:256;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:29:\"cropped-slider3-1-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}s:17:\"attachment_parent\";i:6;}'),
(131, 44, '_edit_last', '1'),
(132, 44, '_edit_lock', '1528884089:1'),
(130, 1, '_edit_lock', '1528878512:1'),
(13, 8, '_edit_lock', '1528472031:1'),
(14, 8, '_wp_trash_meta_status', 'publish'),
(15, 8, '_wp_trash_meta_time', '1528472055'),
(16, 9, '_edit_last', '1'),
(17, 9, '_edit_lock', '1528803930:1'),
(18, 10, '_wp_attached_file', '2018/06/W100947386.jpg'),
(19, 10, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:22:\"2018/06/W100947386.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"W100947386-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"W100947386-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"W100947386-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:22:\"W100947386-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:22:\"W100947386-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:22:\"W100947386-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:22:\"W100947386-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(20, 11, '_wp_attached_file', '2018/06/W100947386_1.jpg'),
(21, 11, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_1.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_1-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_1-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_1-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(22, 12, '_wp_attached_file', '2018/06/W100947386_2.jpg'),
(23, 12, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_2.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_2-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_2-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_2-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_2-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(24, 13, '_wp_attached_file', '2018/06/W100947386_3.jpg'),
(25, 13, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_3.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_3-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_3-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_3-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_3-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_3-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_3-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_3-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(26, 14, '_wp_attached_file', '2018/06/W100947386_4.jpg'),
(27, 14, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_4.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_4-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_4-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_4-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_4-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_4-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_4-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_4-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(28, 15, '_wp_attached_file', '2018/06/W100947386_5.jpg'),
(29, 15, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_5.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_5-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_5-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_5-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_5-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_5-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_5-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_5-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(30, 16, '_wp_attached_file', '2018/06/W100947386_6.jpg'),
(31, 16, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_6.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_6-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_6-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_6-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_6-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_6-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_6-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_6-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(32, 17, '_wp_attached_file', '2018/06/W100947386_7.jpg'),
(33, 17, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_7.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_7-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_7-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_7-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_7-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_7-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_7-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_7-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(34, 18, '_wp_attached_file', '2018/06/W100947386_8.jpg'),
(35, 18, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_8.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_8-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_8-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_8-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_8-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_8-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_8-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_8-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(36, 19, '_wp_attached_file', '2018/06/W100947386_9.jpg'),
(37, 19, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:24:\"2018/06/W100947386_9.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_9-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:24:\"W100947386_9-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:24:\"W100947386_9-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:24:\"W100947386_9-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:24:\"W100947386_9-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:24:\"W100947386_9-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:24:\"W100947386_9-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(38, 20, '_wp_attached_file', '2018/06/W100947386_12.jpg'),
(39, 20, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:852;s:6:\"height\";i:639;s:4:\"file\";s:25:\"2018/06/W100947386_12.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:25:\"W100947386_12-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:25:\"W100947386_12-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:25:\"W100947386_12-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:25:\"W100947386_12-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:25:\"W100947386_12-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:25:\"W100947386_12-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:25:\"W100947386_12-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(129, 9, '_thumbnail_id', '11'),
(41, 9, 'wpcm_expiration', ''),
(42, 9, 'wpcm_sold', '0'),
(43, 9, 'wpcm_condition', 'used'),
(44, 9, 'wpcm_make', '0'),
(45, 9, 'wpcm_model', '0'),
(46, 9, 'wpcm_frdate', '2018-06-08'),
(47, 9, 'wpcm_price', '121221'),
(48, 9, 'wpcm_mileage', '45'),
(49, 9, 'wpcm_fuel_type', 'Diesel'),
(50, 9, 'wpcm_color', 'gris metal'),
(51, 9, 'wpcm_body_style', ''),
(52, 9, 'wpcm_transmission', 'manual'),
(53, 9, 'wpcm_doors', '5'),
(54, 9, 'wpcm_engine', '11'),
(55, 9, 'wpcm_power_kw', ''),
(56, 9, 'wpcm_power_hp', ''),
(57, 9, '_car_gallery', '10,11,12,13,14,15,16,17,18,19,20'),
(58, 22, '_form', '<label> Votre nom (obligatoire)\n    [text* your-name] </label>\n\n<label> Votre adresse de messagerie (obligatoire)\n    [email* your-email] </label>\n\n<label> Objet\n    [text your-subject] </label>\n\n<label> Votre message\n    [textarea your-message] </label>\n\n[submit \"Envoyer\"]'),
(59, 22, '_mail', 'a:8:{s:7:\"subject\";s:23:\"Tastet \"[your-subject]\"\";s:6:\"sender\";s:41:\"[your-name] <chestermandimby67@gmail.com>\";s:4:\"body\";s:198:\"De : [your-name] <[your-email]>\nObjet : [your-subject]\n\nCorps du message :\n[your-message]\n\n-- \nCet e-mail a été envoyé via le formulaire de contact de Tastet (http://localhost/firstwordpress)\";s:9:\"recipient\";s:27:\"chestermandimby67@gmail.com\";s:18:\"additional_headers\";s:22:\"Reply-To: [your-email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),
(60, 22, '_mail_2', 'a:9:{s:6:\"active\";b:0;s:7:\"subject\";s:23:\"Tastet \"[your-subject]\"\";s:6:\"sender\";s:36:\"Tastet <chestermandimby67@gmail.com>\";s:4:\"body\";s:140:\"Corps du message :\n[your-message]\n\n-- \nCet e-mail a été envoyé via le formulaire de contact de Tastet (http://localhost/firstwordpress)\";s:9:\"recipient\";s:12:\"[your-email]\";s:18:\"additional_headers\";s:37:\"Reply-To: chestermandimby67@gmail.com\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),
(61, 22, '_messages', 'a:8:{s:12:\"mail_sent_ok\";s:45:\"Merci pour votre message. Il a été envoyé.\";s:12:\"mail_sent_ng\";s:102:\"Une erreur s’est produite lors de l’envoi de votre message. Veuillez essayer à nouveau plus tard.\";s:16:\"validation_error\";s:88:\"Un ou plusieurs champs contiennent une erreur. Veuillez vérifier et essayer à nouveau.\";s:4:\"spam\";s:102:\"Une erreur s’est produite lors de l’envoi de votre message. Veuillez essayer à nouveau plus tard.\";s:12:\"accept_terms\";s:77:\"Vous devez accepter les termes et conditions avant d’envoyer votre message.\";s:16:\"invalid_required\";s:25:\"Ce champ est obligatoire.\";s:16:\"invalid_too_long\";s:23:\"Le champ est trop long.\";s:17:\"invalid_too_short\";s:24:\"Le champ est trop court.\";}'),
(62, 22, '_additional_settings', NULL),
(63, 22, '_locale', 'fr_FR'),
(64, 23, '_wp_trash_meta_status', 'publish'),
(65, 23, '_wp_trash_meta_time', '1528472740'),
(66, 24, '_menu_item_type', 'custom'),
(67, 24, '_menu_item_menu_item_parent', '0'),
(68, 24, '_menu_item_object_id', '24'),
(69, 24, '_menu_item_object', 'custom'),
(70, 24, '_menu_item_target', ''),
(71, 24, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(72, 24, '_menu_item_xfn', ''),
(73, 24, '_menu_item_url', 'http://localhost/firstwordpress/'),
(74, 24, '_menu_item_orphaned', '1528472825'),
(75, 25, '_menu_item_type', 'post_type'),
(76, 25, '_menu_item_menu_item_parent', '0'),
(77, 25, '_menu_item_object_id', '2'),
(78, 25, '_menu_item_object', 'page'),
(79, 25, '_menu_item_target', ''),
(80, 25, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(81, 25, '_menu_item_xfn', ''),
(82, 25, '_menu_item_url', ''),
(83, 25, '_menu_item_orphaned', '1528472825'),
(84, 27, '_menu_item_type', 'post_type'),
(85, 27, '_menu_item_menu_item_parent', '0'),
(86, 27, '_menu_item_object_id', '2'),
(87, 27, '_menu_item_object', 'page'),
(88, 27, '_menu_item_target', ''),
(89, 27, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(90, 27, '_menu_item_xfn', ''),
(91, 27, '_menu_item_url', ''),
(92, 26, '_wp_trash_meta_status', 'publish'),
(93, 26, '_wp_trash_meta_time', '1528472877'),
(94, 2, '_edit_lock', '1528472914:1'),
(95, 2, '_edit_last', '1'),
(96, 30, 'ml-slider_settings', 'a:36:{s:4:\"type\";s:4:\"flex\";s:6:\"random\";s:5:\"false\";s:8:\"cssClass\";s:0:\"\";s:8:\"printCss\";s:4:\"true\";s:7:\"printJs\";s:4:\"true\";s:5:\"width\";s:4:\"1700\";s:6:\"height\";s:3:\"400\";s:3:\"spw\";i:7;s:3:\"sph\";i:5;s:5:\"delay\";s:4:\"3000\";s:6:\"sDelay\";i:30;s:7:\"opacity\";d:0.69999999999999996;s:10:\"titleSpeed\";i:500;s:6:\"effect\";s:4:\"fade\";s:10:\"navigation\";s:5:\"false\";s:5:\"links\";s:4:\"true\";s:10:\"hoverPause\";s:4:\"true\";s:5:\"theme\";s:7:\"default\";s:9:\"direction\";s:10:\"horizontal\";s:7:\"reverse\";s:5:\"false\";s:14:\"animationSpeed\";s:3:\"600\";s:8:\"prevText\";s:8:\"Previous\";s:8:\"nextText\";s:4:\"Next\";s:6:\"slices\";i:15;s:6:\"center\";s:5:\"false\";s:9:\"smartCrop\";s:4:\"true\";s:12:\"carouselMode\";s:5:\"false\";s:14:\"carouselMargin\";s:1:\"5\";s:16:\"firstSlideFadeIn\";s:4:\"true\";s:6:\"easing\";s:6:\"linear\";s:8:\"autoPlay\";s:4:\"true\";s:11:\"thumb_width\";i:150;s:12:\"thumb_height\";i:100;s:9:\"fullWidth\";s:5:\"false\";s:10:\"noConflict\";s:4:\"true\";s:12:\"smoothHeight\";s:5:\"false\";}'),
(97, 31, '_wp_attached_file', '2018/06/slider1.jpg'),
(98, 31, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1700;s:6:\"height\";i:400;s:4:\"file\";s:19:\"2018/06/slider1.jpg\";s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"slider1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"slider1-300x71.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:71;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:19:\"slider1-768x181.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:181;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:20:\"slider1-1024x241.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:241;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:19:\"slider1-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:19:\"slider1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:19:\"slider1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:19:\"slider1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-700x300\";a:4:{s:4:\"file\";s:19:\"slider1-700x300.jpg\";s:5:\"width\";i:700;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-620x266\";a:4:{s:4:\"file\";s:19:\"slider1-620x266.jpg\";s:5:\"width\";i:620;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-400x171\";a:4:{s:4:\"file\";s:19:\"slider1-400x171.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:171;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(99, 32, '_wp_attached_file', '2018/06/slider2.jpg'),
(100, 32, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1700;s:6:\"height\";i:400;s:4:\"file\";s:19:\"2018/06/slider2.jpg\";s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"slider2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"slider2-300x71.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:71;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:19:\"slider2-768x181.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:181;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:20:\"slider2-1024x241.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:241;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:19:\"slider2-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:19:\"slider2-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:19:\"slider2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:19:\"slider2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-700x300\";a:4:{s:4:\"file\";s:19:\"slider2-700x300.jpg\";s:5:\"width\";i:700;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-620x266\";a:4:{s:4:\"file\";s:19:\"slider2-620x266.jpg\";s:5:\"width\";i:620;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-400x171\";a:4:{s:4:\"file\";s:19:\"slider2-400x171.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:171;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(101, 33, '_wp_attached_file', '2018/06/slider3-2.jpg'),
(102, 33, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1700;s:6:\"height\";i:400;s:4:\"file\";s:21:\"2018/06/slider3-2.jpg\";s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:21:\"slider3-2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"slider3-2-300x71.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:71;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:21:\"slider3-2-768x181.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:181;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"slider3-2-1024x241.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:241;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:33:\"vw-automobile-lite-homepage-thumb\";a:4:{s:4:\"file\";s:21:\"slider3-2-240x145.jpg\";s:5:\"width\";i:240;s:6:\"height\";i:145;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:19:\"wpcm_vehicle_single\";a:4:{s:4:\"file\";s:21:\"slider3-2-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:22:\"wpcm_vehicle_thumbnail\";a:4:{s:4:\"file\";s:21:\"slider3-2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:26:\"wpcm_vehicle_listings_item\";a:4:{s:4:\"file\";s:21:\"slider3-2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-700x300\";a:4:{s:4:\"file\";s:21:\"slider3-2-700x300.jpg\";s:5:\"width\";i:700;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-620x266\";a:4:{s:4:\"file\";s:21:\"slider3-2-620x266.jpg\";s:5:\"width\";i:620;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:27:\"meta-slider-resized-400x171\";a:4:{s:4:\"file\";s:21:\"slider3-2-400x171.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:171;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(103, 34, '_thumbnail_id', '31'),
(104, 34, 'ml-slider_type', 'image'),
(105, 34, 'ml-slider_inherit_image_caption', '1'),
(106, 34, 'ml-slider_inherit_image_title', '1'),
(107, 34, 'ml-slider_inherit_image_alt', '1'),
(108, 35, '_thumbnail_id', '32'),
(109, 35, 'ml-slider_type', 'image'),
(110, 35, 'ml-slider_inherit_image_caption', '1'),
(111, 35, 'ml-slider_inherit_image_title', '1'),
(112, 35, 'ml-slider_inherit_image_alt', '1'),
(113, 36, '_thumbnail_id', '33'),
(114, 36, 'ml-slider_type', 'image'),
(115, 36, 'ml-slider_inherit_image_caption', '1'),
(116, 36, 'ml-slider_inherit_image_title', '1'),
(117, 36, 'ml-slider_inherit_image_alt', '1'),
(118, 31, '_wp_attachment_backup_sizes', 'a:3:{s:15:\"resized-700x300\";a:5:{s:4:\"path\";s:72:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider1-700x300.jpg\";s:4:\"file\";s:19:\"slider1-700x300.jpg\";s:5:\"width\";i:700;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:15:\"resized-620x266\";a:5:{s:4:\"path\";s:72:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider1-620x266.jpg\";s:4:\"file\";s:19:\"slider1-620x266.jpg\";s:5:\"width\";i:620;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:15:\"resized-400x171\";a:5:{s:4:\"path\";s:72:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider1-400x171.jpg\";s:4:\"file\";s:19:\"slider1-400x171.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:171;s:9:\"mime-type\";s:10:\"image/jpeg\";}}'),
(119, 32, '_wp_attachment_backup_sizes', 'a:3:{s:15:\"resized-700x300\";a:5:{s:4:\"path\";s:72:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider2-700x300.jpg\";s:4:\"file\";s:19:\"slider2-700x300.jpg\";s:5:\"width\";i:700;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:15:\"resized-620x266\";a:5:{s:4:\"path\";s:72:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider2-620x266.jpg\";s:4:\"file\";s:19:\"slider2-620x266.jpg\";s:5:\"width\";i:620;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:15:\"resized-400x171\";a:5:{s:4:\"path\";s:72:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider2-400x171.jpg\";s:4:\"file\";s:19:\"slider2-400x171.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:171;s:9:\"mime-type\";s:10:\"image/jpeg\";}}'),
(120, 33, '_wp_attachment_backup_sizes', 'a:3:{s:15:\"resized-700x300\";a:5:{s:4:\"path\";s:74:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider3-2-700x300.jpg\";s:4:\"file\";s:21:\"slider3-2-700x300.jpg\";s:5:\"width\";i:700;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:15:\"resized-620x266\";a:5:{s:4:\"path\";s:74:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider3-2-620x266.jpg\";s:4:\"file\";s:21:\"slider3-2-620x266.jpg\";s:5:\"width\";i:620;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:15:\"resized-400x171\";a:5:{s:4:\"path\";s:74:\"C:wamp64wwwfirstwordpress/wp-content/uploads/2018/06/slider3-2-400x171.jpg\";s:4:\"file\";s:21:\"slider3-2-400x171.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:171;s:9:\"mime-type\";s:10:\"image/jpeg\";}}'),
(121, 34, 'ml-slider_crop_position', 'center-center'),
(122, 34, '_wp_attachment_image_alt', ''),
(123, 35, 'ml-slider_crop_position', 'center-center'),
(124, 35, '_wp_attachment_image_alt', ''),
(125, 36, 'ml-slider_crop_position', 'center-center'),
(126, 36, '_wp_attachment_image_alt', ''),
(127, 37, '_wp_trash_meta_status', 'publish'),
(128, 37, '_wp_trash_meta_time', '1528473381'),
(133, 44, '_wp_page_template', 'page-template/page-with-right-sidebar.php'),
(134, 46, '_menu_item_type', 'post_type'),
(135, 46, '_menu_item_menu_item_parent', '0'),
(136, 46, '_menu_item_object_id', '44'),
(137, 46, '_menu_item_object', 'page'),
(138, 46, '_menu_item_target', ''),
(139, 46, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(140, 46, '_menu_item_xfn', ''),
(141, 46, '_menu_item_url', '');

-- --------------------------------------------------------

--
-- Structure de la table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2018-06-08 17:25:56', '2018-06-08 15:25:56', 'Bienvenue sur WordPress. Ceci est votre premier article. Modifiez-le ou supprimez-le, puis lancez-vous !', 'Bonjour tout le monde !', '', 'publish', 'open', 'open', '', 'bonjour-tout-le-monde', '', '', '2018-06-08 17:25:56', '2018-06-08 15:25:56', '', 0, 'http://localhost/firstwordpress/?p=1', 0, 'post', '', 1),
(2, 1, '2018-06-08 17:25:56', '2018-06-08 15:25:56', '[wpcm_cars]', 'Page d’exemple', '', 'publish', 'closed', 'open', '', 'page-d-exemple', '', '', '2018-06-08 17:50:14', '2018-06-08 15:50:14', '', 0, 'http://localhost/firstwordpress/?page_id=2', 0, 'page', '', 0),
(29, 1, '2018-06-08 17:50:14', '2018-06-08 15:50:14', '[wpcm_cars]', 'Page d’exemple', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2018-06-08 17:50:14', '2018-06-08 15:50:14', '', 2, 'http://localhost/firstwordpress/2-revision-v1/', 0, 'revision', '', 0),
(30, 1, '2018-06-08 17:51:59', '2018-06-08 15:51:59', '', 'Slideshow1', '', 'publish', 'closed', 'closed', '', 'new-slideshow', '', '', '2018-06-08 17:53:22', '2018-06-08 15:53:22', '', 0, 'http://localhost/firstwordpress/?post_type=ml-slider&#038;p=30', 0, 'ml-slider', '', 0),
(31, 1, '2018-06-08 17:52:34', '2018-06-08 15:52:34', '', 'slider1', '', 'inherit', 'open', 'closed', '', 'slider1', '', '', '2018-06-08 17:52:34', '2018-06-08 15:52:34', '', 0, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/slider1.jpg', 0, 'attachment', 'image/jpeg', 0),
(32, 1, '2018-06-08 17:52:35', '2018-06-08 15:52:35', '', 'slider2', '', 'inherit', 'open', 'closed', '', 'slider2', '', '', '2018-06-08 17:52:35', '2018-06-08 15:52:35', '', 0, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/slider2.jpg', 0, 'attachment', 'image/jpeg', 0),
(33, 1, '2018-06-08 17:52:36', '2018-06-08 15:52:36', '', 'slider3', '', 'inherit', 'open', 'closed', '', 'slider3-3', '', '', '2018-06-08 17:52:36', '2018-06-08 15:52:36', '', 0, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/slider3-2.jpg', 0, 'attachment', 'image/jpeg', 0),
(34, 1, '2018-06-08 17:52:39', '2018-06-08 15:52:39', '', 'Slider 30 - image', '', 'publish', 'closed', 'closed', '', 'slider-30-image', '', '', '2018-06-08 17:53:22', '2018-06-08 15:53:22', '', 0, 'http://localhost/firstwordpress/?post_type=ml-slide&#038;p=34', 0, 'ml-slide', '', 0),
(35, 1, '2018-06-08 17:52:39', '2018-06-08 15:52:39', '', 'Slider 30 - image', '', 'publish', 'closed', 'closed', '', 'slider-30-image-2', '', '', '2018-06-08 17:53:22', '2018-06-08 15:53:22', '', 0, 'http://localhost/firstwordpress/?post_type=ml-slide&#038;p=35', 1, 'ml-slide', '', 0),
(3, 1, '2018-06-08 17:25:56', '2018-06-08 15:25:56', '<h2>Qui sommes-nous ?</h2><p>L’adresse de notre site Web est : http://localhost/firstwordpress.</p><h2>Utilisation des données personnelles collectées</h2><h3>Commentaires</h3><p>Quand vous laissez un commentaire sur notre site web, les données inscrites dans le formulaire de commentaire, mais aussi votre adresse IP et l’agent utilisateur de votre navigateur sont collectés pour nous aider à la détection des commentaires indésirables.</p><p>Une chaîne anonymisée créée à partir de votre adresse de messagerie (également appelée hash) peut être envoyée au service Gravatar pour vérifier si vous utilisez ce dernier. Les clauses de confidentialité du service Gravatar sont disponibles ici : https://automattic.com/privacy/. Après validation de votre commentaire, votre photo de profil sera visible publiquement à coté de votre commentaire.</p><h3>Médias</h3><p>Si vous êtes un utilisateur ou une utilisatrice enregistré·e et que vous téléversez des images sur le site web, nous vous conseillons d’éviter de téléverser des images contenant des données EXIF de coordonnées GPS. Les visiteurs de votre site web peuvent télécharger et extraire des données de localisation depuis ces images.</p><h3>Formulaires de contact</h3><h3>Cookies</h3><p>Si vous déposez un commentaire sur notre site, il vous sera proposé d’enregistrer votre nom, adresse de messagerie et site web dans des cookies. C’est uniquement pour votre confort afin de ne pas avoir à saisir ces informations si vous déposez un autre commentaire plus tard. Ces cookies expirent au bout d’un an.</p><p>Si vous avez un compte et que vous vous connectez sur ce site, un cookie temporaire sera créé afin de déterminer si votre navigateur accepte les cookies. Il ne contient pas de données personnelles et sera supprimé automatiquement à la fermeture de votre navigateur.</p><p>Lorsque vous vous connecterez, nous mettrons en place un certain nombre de cookies pour enregistrer vos informations de connexion et vos préférences d’écran. La durée de vie d’un cookie de connexion est de deux jours, celle d’un cookie d’option d’écran est d’un an. Si vous cochez « Se souvenir de moi », votre cookie de connexion sera conservé pendant deux semaines. Si vous vous déconnectez de votre compte, le cookie de connexion sera effacé.</p><p>En modifiant ou en publiant un article, un cookie supplémentaire sera enregistré dans votre navigateur. Ce cookie ne comprend aucune donnée personnelle. Il indique simplement l’identifiant de l’article que vous venez de modifier. Il expire au bout d’un jour.</p><h3>Contenu embarqué depuis d’autres sites</h3><p>Les articles de ce site peuvent inclure des contenus intégrés (par exemple des vidéos, images, articles…). Le contenu intégré depuis d’autres sites se comporte de la même manière que si le visiteur se rendait sur cet autre site.</p><p>Ces sites web pourraient collecter des données sur vous, utiliser des cookies, embarquer des outils de suivis tiers, suivre vos interactions avec ces contenus embarqués si vous disposez d’un compte connecté sur leur site web.</p><h3>Statistiques et mesures d’audience</h3><h2>Utilisation et transmission de vos données personnelles</h2><h2>Durées de stockage de vos données</h2><p>Si vous laissez un commentaire, le commentaire et ses métadonnées sont conservés indéfiniment. Cela permet de reconnaître et approuver automatiquement les commentaires suivants au lieu de les laisser dans la file de modération.</p><p>Pour les utilisateurs et utilisatrices qui s’enregistrent sur notre site (si cela est possible), nous stockons également les données personnelles indiquées dans leur profil. Tous les utilisateurs et utilisatrices peuvent voir, modifier ou supprimer leurs informations personnelles à tout moment (à l’exception de leur nom d’utilisateur·ice). Les gestionnaires du site peuvent aussi voir et modifier ces informations.</p><h2>Les droits que vous avez sur vos données</h2><p>Si vous avez un compte ou si vous avez laissé des commentaires sur le site, vous pouvez demander à recevoir un fichier contenant toutes les données personnelles que nous possédons à votre sujet, incluant celles que vous nous avez fournies. Vous pouvez également demander la suppression des données personnelles vous concernant. Cela ne prend pas en compte les données stockées à des fins administratives, légales ou pour des raisons de sécurité.</p><h2>Transmission de vos données personnelles</h2><p>Les commentaires des visiteurs peuvent être vérifiés à l’aide d’un service automatisé de détection des commentaires indésirables.</p><h2>Informations de contact</h2><h2>Informations supplémentaires</h2><h3>Comment nous protégeons vos données</h3><h3>Procédures mises en œuvre en cas de fuite de données</h3><h3>Les services tiers qui nous transmettent des données</h3><h3>Opérations de marketing automatisé et/ou de profilage réalisées à l’aide des données personnelles</h3><h3>Affichage des informations liées aux secteurs soumis à des régulations spécifiques</h3>', 'Politique de confidentialité', '', 'draft', 'closed', 'open', '', 'politique-de-confidentialite', '', '', '2018-06-08 17:25:56', '2018-06-08 15:25:56', '', 0, 'http://localhost/firstwordpress/?page_id=3', 0, 'page', '', 0),
(4, 1, '2018-06-08 17:26:12', '0000-00-00 00:00:00', '', 'Brouillon auto', '', 'auto-draft', 'open', 'open', '', '', '', '', '2018-06-08 17:26:12', '0000-00-00 00:00:00', '', 0, 'http://localhost/firstwordpress/?p=4', 0, 'post', '', 0),
(5, 1, '2018-06-08 17:32:45', '2018-06-08 15:32:45', '', 'slider3', '', 'inherit', 'open', 'closed', '', 'slider3', '', '', '2018-06-08 17:32:45', '2018-06-08 15:32:45', '', 0, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/slider3.jpg', 0, 'attachment', 'image/jpeg', 0),
(6, 1, '2018-06-08 17:33:20', '2018-06-08 15:33:20', '', 'slider3', '', 'inherit', 'open', 'closed', '', 'slider3-2', '', '', '2018-06-08 17:33:20', '2018-06-08 15:33:20', '', 0, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/slider3-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(7, 1, '2018-06-08 17:33:28', '2018-06-08 15:33:28', '', 'cropped-slider3-1.jpg', '', 'inherit', 'open', 'closed', '', 'cropped-slider3-1-jpg', '', '', '2018-06-08 17:33:28', '2018-06-08 15:33:28', '', 0, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/cropped-slider3-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(8, 1, '2018-06-08 17:34:14', '2018-06-08 15:34:14', '{\n    \"vw-automobile-lite::header_image\": {\n        \"value\": \"http://localhost/firstwordpress/wp-content/uploads/2018/06/cropped-slider3-1.jpg\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:33:47\"\n    },\n    \"vw-automobile-lite::header_image_data\": {\n        \"value\": {\n            \"url\": \"http://localhost/firstwordpress/wp-content/uploads/2018/06/cropped-slider3-1.jpg\",\n            \"thumbnail_url\": \"http://localhost/firstwordpress/wp-content/uploads/2018/06/cropped-slider3-1.jpg\",\n            \"timestamp\": 1528472008284,\n            \"attachment_id\": 7,\n            \"width\": 1600,\n            \"height\": 400\n        },\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:33:47\"\n    },\n    \"vw-automobile-lite::background_image\": {\n        \"value\": \"\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:33:47\"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'adae7ffe-cbad-4d9c-b35d-44ab3d421ec6', '', '', '2018-06-08 17:34:14', '2018-06-08 15:34:14', '', 0, 'http://localhost/firstwordpress/?p=8', 0, 'customize_changeset', '', 0),
(9, 1, '2018-06-08 17:39:44', '2018-06-08 15:39:44', '<h2>Options &amp; Equipements</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\"></div>\r\n</div>\r\nessai', 'daba 1', 'short description', 'publish', 'closed', 'closed', '', 'daba-1', '', '', '2018-06-12 13:45:29', '2018-06-12 11:45:29', '', 0, 'http://localhost/firstwordpress/?post_type=wpcm_vehicle&#038;p=9', 0, 'wpcm_vehicle', '', 0),
(10, 1, '2018-06-08 17:37:40', '2018-06-08 15:37:40', '', 'W100947386', '', 'inherit', 'open', 'closed', '', 'w100947386', '', '', '2018-06-08 17:37:40', '2018-06-08 15:37:40', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386.jpg', 0, 'attachment', 'image/jpeg', 0),
(11, 1, '2018-06-08 17:37:41', '2018-06-08 15:37:41', '', 'W100947386_1', '', 'inherit', 'open', 'closed', '', 'w100947386_1', '', '', '2018-06-08 17:37:41', '2018-06-08 15:37:41', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_1.jpg', 0, 'attachment', 'image/jpeg', 0),
(12, 1, '2018-06-08 17:37:42', '2018-06-08 15:37:42', '', 'W100947386_2', '', 'inherit', 'open', 'closed', '', 'w100947386_2', '', '', '2018-06-08 17:37:42', '2018-06-08 15:37:42', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_2.jpg', 0, 'attachment', 'image/jpeg', 0),
(13, 1, '2018-06-08 17:37:42', '2018-06-08 15:37:42', '', 'W100947386_3', '', 'inherit', 'open', 'closed', '', 'w100947386_3', '', '', '2018-06-08 17:37:42', '2018-06-08 15:37:42', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_3.jpg', 0, 'attachment', 'image/jpeg', 0),
(14, 1, '2018-06-08 17:37:43', '2018-06-08 15:37:43', '', 'W100947386_4', '', 'inherit', 'open', 'closed', '', 'w100947386_4', '', '', '2018-06-08 17:37:43', '2018-06-08 15:37:43', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_4.jpg', 0, 'attachment', 'image/jpeg', 0),
(15, 1, '2018-06-08 17:37:44', '2018-06-08 15:37:44', '', 'W100947386_5', '', 'inherit', 'open', 'closed', '', 'w100947386_5', '', '', '2018-06-08 17:37:44', '2018-06-08 15:37:44', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_5.jpg', 0, 'attachment', 'image/jpeg', 0),
(16, 1, '2018-06-08 17:37:45', '2018-06-08 15:37:45', '', 'W100947386_6', '', 'inherit', 'open', 'closed', '', 'w100947386_6', '', '', '2018-06-08 17:37:45', '2018-06-08 15:37:45', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_6.jpg', 0, 'attachment', 'image/jpeg', 0),
(17, 1, '2018-06-08 17:37:46', '2018-06-08 15:37:46', '', 'W100947386_7', '', 'inherit', 'open', 'closed', '', 'w100947386_7', '', '', '2018-06-08 17:37:46', '2018-06-08 15:37:46', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_7.jpg', 0, 'attachment', 'image/jpeg', 0),
(18, 1, '2018-06-08 17:37:47', '2018-06-08 15:37:47', '', 'W100947386_8', '', 'inherit', 'open', 'closed', '', 'w100947386_8', '', '', '2018-06-08 17:37:47', '2018-06-08 15:37:47', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_8.jpg', 0, 'attachment', 'image/jpeg', 0),
(19, 1, '2018-06-08 17:37:48', '2018-06-08 15:37:48', '', 'W100947386_9', '', 'inherit', 'open', 'closed', '', 'w100947386_9', '', '', '2018-06-08 17:37:48', '2018-06-08 15:37:48', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_9.jpg', 0, 'attachment', 'image/jpeg', 0),
(20, 1, '2018-06-08 17:37:49', '2018-06-08 15:37:49', '', 'W100947386_12', '', 'inherit', 'open', 'closed', '', 'w100947386_12', '', '', '2018-06-08 17:37:49', '2018-06-08 15:37:49', '', 9, 'http://localhost/firstwordpress/wp-content/uploads/2018/06/W100947386_12.jpg', 0, 'attachment', 'image/jpeg', 0),
(21, 1, '2018-06-08 17:38:09', '2018-06-08 15:38:09', 'test 1', 'daba 1', '', 'inherit', 'closed', 'closed', '', '9-revision-v1', '', '', '2018-06-08 17:38:09', '2018-06-08 15:38:09', '', 9, 'http://localhost/firstwordpress/2018/06/08/9-revision-v1/', 0, 'revision', '', 0),
(22, 1, '2018-06-08 17:40:45', '2018-06-08 15:40:45', '<label> Votre nom (obligatoire)\n    [text* your-name] </label>\n\n<label> Votre adresse de messagerie (obligatoire)\n    [email* your-email] </label>\n\n<label> Objet\n    [text your-subject] </label>\n\n<label> Votre message\n    [textarea your-message] </label>\n\n[submit \"Envoyer\"]\nTastet \"[your-subject]\"\n[your-name] <chestermandimby67@gmail.com>\nDe : [your-name] <[your-email]>\nObjet : [your-subject]\n\nCorps du message :\n[your-message]\n\n-- \nCet e-mail a été envoyé via le formulaire de contact de Tastet (http://localhost/firstwordpress)\nchestermandimby67@gmail.com\nReply-To: [your-email]\n\n0\n0\n\nTastet \"[your-subject]\"\nTastet <chestermandimby67@gmail.com>\nCorps du message :\n[your-message]\n\n-- \nCet e-mail a été envoyé via le formulaire de contact de Tastet (http://localhost/firstwordpress)\n[your-email]\nReply-To: chestermandimby67@gmail.com\n\n0\n0\nMerci pour votre message. Il a été envoyé.\nUne erreur s’est produite lors de l’envoi de votre message. Veuillez essayer à nouveau plus tard.\nUn ou plusieurs champs contiennent une erreur. Veuillez vérifier et essayer à nouveau.\nUne erreur s’est produite lors de l’envoi de votre message. Veuillez essayer à nouveau plus tard.\nVous devez accepter les termes et conditions avant d’envoyer votre message.\nCe champ est obligatoire.\nLe champ est trop long.\nLe champ est trop court.', 'Formulaire de contact 1', '', 'publish', 'closed', 'closed', '', 'formulaire-de-contact-1', '', '', '2018-06-08 17:40:45', '2018-06-08 15:40:45', '', 0, 'http://localhost/firstwordpress/?post_type=wpcf7_contact_form&p=22', 0, 'wpcf7_contact_form', '', 0),
(23, 1, '2018-06-08 17:45:40', '2018-06-08 15:45:40', '{\n    \"sidebars_widgets[sidebar-1]\": {\n        \"value\": [\n            \"text-3\"\n        ],\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:45:40\"\n    },\n    \"widget_text[3]\": {\n        \"value\": {\n            \"encoded_serialized_instance\": \"YTo0OntzOjU6InRpdGxlIjtzOjc6IkNvbnRhY3QiO3M6NDoidGV4dCI7czo1NjoiW2NvbnRhY3QtZm9ybS03IGlkPSIyMiIgdGl0bGU9IkZvcm11bGFpcmUgZGUgY29udGFjdCAxIl0iO3M6NjoiZmlsdGVyIjtiOjE7czo2OiJ2aXN1YWwiO2I6MTt9\",\n            \"title\": \"Contact\",\n            \"is_widget_customizer_js_value\": true,\n            \"instance_hash_key\": \"e4d0f955a62fd02db83143dd8176945d\"\n        },\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:45:40\"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'feafb571-52fe-43bf-9062-1d4f0b1a576a', '', '', '2018-06-08 17:45:40', '2018-06-08 15:45:40', '', 0, 'http://localhost/firstwordpress/2018/06/08/feafb571-52fe-43bf-9062-1d4f0b1a576a/', 0, 'customize_changeset', '', 0),
(24, 1, '2018-06-08 17:47:05', '0000-00-00 00:00:00', '', 'Accueil', '', 'draft', 'closed', 'closed', '', '', '', '', '2018-06-08 17:47:05', '0000-00-00 00:00:00', '', 0, 'http://localhost/firstwordpress/?p=24', 1, 'nav_menu_item', '', 0),
(25, 1, '2018-06-08 17:47:05', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2018-06-08 17:47:05', '0000-00-00 00:00:00', '', 0, 'http://localhost/firstwordpress/?p=25', 1, 'nav_menu_item', '', 0),
(26, 1, '2018-06-08 17:47:57', '2018-06-08 15:47:57', '{\n    \"vw-automobile-lite::nav_menu_locations[primary]\": {\n        \"value\": -101468933,\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:47:57\"\n    },\n    \"nav_menu[-101468933]\": {\n        \"value\": {\n            \"name\": \"menu\",\n            \"description\": \"\",\n            \"parent\": 0,\n            \"auto_add\": false\n        },\n        \"type\": \"nav_menu\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:47:57\"\n    },\n    \"nav_menu_item[-97985860]\": {\n        \"value\": {\n            \"object_id\": 2,\n            \"object\": \"page\",\n            \"menu_item_parent\": 0,\n            \"position\": 1,\n            \"type\": \"post_type\",\n            \"title\": \"Page d\\u2019exemple\",\n            \"url\": \"http://localhost/firstwordpress/page-d-exemple/\",\n            \"target\": \"\",\n            \"attr_title\": \"\",\n            \"description\": \"\",\n            \"classes\": \"\",\n            \"xfn\": \"\",\n            \"status\": \"publish\",\n            \"original_title\": \"Page d\\u2019exemple\",\n            \"nav_menu_term_id\": -101468933,\n            \"_invalid\": false,\n            \"type_label\": \"Page\"\n        },\n        \"type\": \"nav_menu_item\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:47:57\"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '8e4f2ccb-7039-4990-838b-c165581578ad', '', '', '2018-06-08 17:47:57', '2018-06-08 15:47:57', '', 0, 'http://localhost/firstwordpress/8e4f2ccb-7039-4990-838b-c165581578ad/', 0, 'customize_changeset', '', 0),
(27, 1, '2018-06-08 17:47:57', '2018-06-08 15:47:57', ' ', '', '', 'publish', 'closed', 'closed', '', '27', '', '', '2018-06-13 10:32:08', '2018-06-13 08:32:08', '', 0, 'http://localhost/firstwordpress/27/', 2, 'nav_menu_item', '', 0),
(28, 1, '2018-06-08 17:50:03', '2018-06-08 15:50:03', '[wpcm_cars]', 'Page d’exemple', '', 'inherit', 'closed', 'closed', '', '2-autosave-v1', '', '', '2018-06-08 17:50:03', '2018-06-08 15:50:03', '', 2, 'http://localhost/firstwordpress/2-autosave-v1/', 0, 'revision', '', 0),
(36, 1, '2018-06-08 17:52:39', '2018-06-08 15:52:39', '', 'Slider 30 - image', '', 'publish', 'closed', 'closed', '', 'slider-30-image-3', '', '', '2018-06-08 17:53:22', '2018-06-08 15:53:22', '', 0, 'http://localhost/firstwordpress/?post_type=ml-slide&#038;p=36', 2, 'ml-slide', '', 0),
(37, 1, '2018-06-08 17:56:21', '2018-06-08 15:56:21', '{\n    \"vw-automobile-lite::header_image\": {\n        \"value\": \"remove-header\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:56:21\"\n    },\n    \"vw-automobile-lite::header_image_data\": {\n        \"value\": \"remove-header\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-06-08 15:56:21\"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '2b14d2b3-9247-4bbf-9338-0f428034ea83', '', '', '2018-06-08 17:56:21', '2018-06-08 15:56:21', '', 0, 'http://localhost/firstwordpress/2b14d2b3-9247-4bbf-9338-0f428034ea83/', 0, 'customize_changeset', '', 0),
(40, 1, '2018-06-08 18:20:32', '2018-06-08 16:20:32', '<h2>Options &amp; Equipements</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\">\r\n<div class=\"w50\"><span style=\"font-weight: 300;\">[row]</span></div>\r\n</div>\r\n</div>\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Antivol</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">alarme</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Confort</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">Bluetooth</span></li>\r\n 	<li> <span class=\"vMiddle\">système d\'entrée sans clef</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Exterieur Et Chassis</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">aide parking av/ar</span></li>\r\n 	<li> <span class=\"vMiddle\">aide parking avec caméra de recul</span></li>\r\n 	<li> <span class=\"vMiddle\">hayon électrique</span></li>\r\n 	<li> <span class=\"vMiddle\">jantes alu 18\"</span></li>\r\n 	<li> <span class=\"vMiddle\">lave-phares</span></li>\r\n 	<li> <span class=\"vMiddle\">peinture métallisée</span></li>\r\n 	<li> <span class=\"vMiddle\">projecteurs xénon</span></li>\r\n 	<li> <span class=\"vMiddle\">radar de recul</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseurs rabattables électriquement</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseurs électriques</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseurs électriques et dégivrants</span></li>\r\n 	<li> <span class=\"vMiddle\">toit ouvrant panoramique</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Interieur</span>\r\n<ul>\r\n 	<li> <span class=\"vMiddle\">4 vitres électriques</span></li>\r\n 	<li> <span class=\"vMiddle\">accoudoir central arrière</span></li>\r\n 	<li> <span class=\"vMiddle\">accoudoir central avant</span></li>\r\n 	<li> <span class=\"vMiddle\">boite 6 vitesses</span></li>\r\n 	<li> <span class=\"vMiddle\">cache bagages</span></li>\r\n 	<li> <span class=\"vMiddle\">caméra de recul</span></li>\r\n 	<li> <span class=\"vMiddle\">climatisation automatique multi zone</span></li>\r\n 	<li> <span class=\"vMiddle\">couvre bagages</span></li>\r\n 	<li> <span class=\"vMiddle\">direction assistée</span></li>\r\n 	<li> <span class=\"vMiddle\">démarrage sans clef</span></li>\r\n 	<li> <span class=\"vMiddle\">fermeture électrique automatique</span></li>\r\n 	<li> <span class=\"vMiddle\">GPS</span></li>\r\n 	<li> <span class=\"vMiddle\">grille séparation coffre</span></li>\r\n 	<li> <span class=\"vMiddle\">intérieur cuir</span></li>\r\n 	<li> <span class=\"vMiddle\">lunette arrière ouvrante</span></li>\r\n 	<li> <span class=\"vMiddle\">ordinateur de bord</span></li>\r\n</ul>\r\n[/col]\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Interieur (Suite)</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">ouverture du coffre électrique</span></li>\r\n 	<li> <span class=\"vMiddle\">pack alu</span></li>\r\n 	<li> <span class=\"vMiddle\">pack black-line</span></li>\r\n 	<li> <span class=\"vMiddle\">pack cuir</span></li>\r\n 	<li> <span class=\"vMiddle\">pack luxe</span></li>\r\n 	<li> <span class=\"vMiddle\">pack multimédia</span></li>\r\n 	<li> <span class=\"vMiddle\">prise audio mini USB</span></li>\r\n 	<li> <span class=\"vMiddle\">prises audio auxiliaires</span></li>\r\n 	<li> <span class=\"vMiddle\">régulateur limiteur de vitesse</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseur int. jour/nuit auto</span></li>\r\n 	<li> <span class=\"vMiddle\">sièges chauffants</span></li>\r\n 	<li> <span class=\"vMiddle\">sièges électrique à mémoire</span></li>\r\n 	<li> <span class=\"vMiddle\">sièges électriques</span></li>\r\n 	<li> <span class=\"vMiddle\">système audio CD</span></li>\r\n 	<li> <span class=\"vMiddle\">tapis de sol</span></li>\r\n 	<li> <span class=\"vMiddle\">volant cuir</span></li>\r\n 	<li> <span class=\"vMiddle\">volant multifonctions</span></li>\r\n 	<li> <span class=\"vMiddle\">volant réglable en hauteur et profondeur</span></li>\r\n 	<li> <span class=\"vMiddle\">éclairage intérieur temporisé</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Securite</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">affichage tête haute</span></li>\r\n 	<li> <span class=\"vMiddle\">airbags front. + lat.</span></li>\r\n 	<li> <span class=\"vMiddle\">alerte franchissement ligne</span></li>\r\n 	<li> <span class=\"vMiddle\">contrôle de pression des pneus</span></li>\r\n 	<li> <span class=\"vMiddle\">feux ar. à LED</span></li>\r\n 	<li> <span class=\"vMiddle\">feux et essuie-glaces automatiques</span></li>\r\n 	<li> <span class=\"vMiddle\">fixations ISOFIX</span></li>\r\n 	<li> <span class=\"vMiddle\">kit téléphone main libre bluetooth</span></li>\r\n 	<li> <span class=\"vMiddle\">phares av. de jour à LED</span></li>\r\n 	<li> <span class=\"vMiddle\">projecteurs antibrouillard</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Autre</span>\r\n<ul>\r\n 	<li> <span class=\"vMiddle\">carnet d\'entretien</span></li>\r\n 	<li> <span class=\"vMiddle\">contrat entretien</span></li>\r\n 	<li> <span class=\"vMiddle\">non fumeur</span></li>\r\n 	<li> <span class=\"vMiddle\">système Start &amp; Stop</span></li>\r\n</ul>\r\n[/col]\r\n[/row]\r\n\r\n[divider]\r\n<h2 class=\"title clear\">Données complémentaires<sup>1</sup></h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\">\r\n<div class=\"w50\"><span style=\"font-weight: 300;\">[row]</span></div>\r\n</div>\r\n</div>\r\n[row]\r\n[col width=\"six\"]\r\n\r\nPuissance DIN :190 ch\r\nVolume de coffre :560 L\r\n\r\n[/col]\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Emission de C02 :127 g/km</span>\r\n<span class=\"f15 bold block mB5 capitalize\">Consommation mixte :4.8 L/100 km</span>\r\n\r\n[/col]\r\n[/row]\r\n\r\n[divider]\r\n<h2 class=\"title clear\">Réparations</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\">\r\n<div class=\"w50\"><span style=\"font-weight: 300;\">[row]</span></div>\r\n</div>\r\n</div>\r\n[row]\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Pneus</span>\r\n\r\n[/col]\r\n[col width=\"six\"]\r\n\r\n[/col]\r\n[/row]', 'daba 1', '', 'inherit', 'closed', 'closed', '', '9-autosave-v1', '', '', '2018-06-08 18:20:32', '2018-06-08 16:20:32', '', 9, 'http://localhost/firstwordpress/9-autosave-v1/', 0, 'revision', '', 0),
(42, 1, '2018-06-12 13:44:58', '2018-06-12 11:44:58', '<h2>Options &amp; Equipements</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\"></div>\r\n</div>\r\nessai', 'daba 1', '', 'inherit', 'closed', 'closed', '', '9-revision-v1', '', '', '2018-06-12 13:44:58', '2018-06-12 11:44:58', '', 9, 'http://localhost/firstwordpress/9-revision-v1/', 0, 'revision', '', 0),
(43, 1, '2018-06-12 13:45:29', '2018-06-12 11:45:29', '<h2>Options &amp; Equipements</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\"></div>\r\n</div>\r\nessai', 'daba 1', 'short description', 'inherit', 'closed', 'closed', '', '9-revision-v1', '', '', '2018-06-12 13:45:29', '2018-06-12 11:45:29', '', 9, 'http://localhost/firstwordpress/9-revision-v1/', 0, 'revision', '', 0),
(44, 1, '2018-06-13 10:31:37', '2018-06-13 08:31:37', '<p style=\"color:red\">Voici l\'acceuil de notre site</p>', 'Acceuil', '', 'publish', 'closed', 'closed', '', 'acceuil', '', '', '2018-06-13 10:35:22', '2018-06-13 08:35:22', '', 0, 'http://localhost/firstwordpress/?page_id=44', 0, 'page', '', 0),
(45, 1, '2018-06-13 10:31:37', '2018-06-13 08:31:37', 'Voici l\'acceuil de notre site', 'Acceuil', '', 'inherit', 'closed', 'closed', '', '44-revision-v1', '', '', '2018-06-13 10:31:37', '2018-06-13 08:31:37', '', 44, 'http://localhost/firstwordpress/44-revision-v1/', 0, 'revision', '', 0),
(46, 1, '2018-06-13 10:32:08', '2018-06-13 08:32:08', ' ', '', '', 'publish', 'closed', 'closed', '', '46', '', '', '2018-06-13 10:32:08', '2018-06-13 08:32:08', '', 0, 'http://localhost/firstwordpress/?p=46', 1, 'nav_menu_item', '', 0),
(47, 1, '2018-06-13 10:35:10', '2018-06-13 08:35:10', '<p style=\"\">Voici l\'acceuil de notre site</p>', 'Acceuil', '', 'inherit', 'closed', 'closed', '', '44-autosave-v1', '', '', '2018-06-13 10:35:10', '2018-06-13 08:35:10', '', 44, 'http://localhost/firstwordpress/44-autosave-v1/', 0, 'revision', '', 0),
(48, 1, '2018-06-13 10:35:22', '2018-06-13 08:35:22', '<p style=\"color:red\">Voici l\'acceuil de notre site</p>', 'Acceuil', '', 'inherit', 'closed', 'closed', '', '44-revision-v1', '', '', '2018-06-13 10:35:22', '2018-06-13 08:35:22', '', 44, 'http://localhost/firstwordpress/44-revision-v1/', 0, 'revision', '', 0),
(41, 1, '2018-06-08 18:20:52', '2018-06-08 16:20:52', '<h2>Options &amp; Equipements</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\">\r\n<div class=\"w50\"><span style=\"font-weight: 300;\">[row]</span></div>\r\n</div>\r\n</div>\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Antivol</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">alarme</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Confort</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">Bluetooth</span></li>\r\n 	<li> <span class=\"vMiddle\">système d\'entrée sans clef</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Exterieur Et Chassis</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">aide parking av/ar</span></li>\r\n 	<li> <span class=\"vMiddle\">aide parking avec caméra de recul</span></li>\r\n 	<li> <span class=\"vMiddle\">hayon électrique</span></li>\r\n 	<li> <span class=\"vMiddle\">jantes alu 18\"</span></li>\r\n 	<li> <span class=\"vMiddle\">lave-phares</span></li>\r\n 	<li> <span class=\"vMiddle\">peinture métallisée</span></li>\r\n 	<li> <span class=\"vMiddle\">projecteurs xénon</span></li>\r\n 	<li> <span class=\"vMiddle\">radar de recul</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseurs rabattables électriquement</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseurs électriques</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseurs électriques et dégivrants</span></li>\r\n 	<li> <span class=\"vMiddle\">toit ouvrant panoramique</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Interieur</span>\r\n<ul>\r\n 	<li> <span class=\"vMiddle\">4 vitres électriques</span></li>\r\n 	<li> <span class=\"vMiddle\">accoudoir central arrière</span></li>\r\n 	<li> <span class=\"vMiddle\">accoudoir central avant</span></li>\r\n 	<li> <span class=\"vMiddle\">boite 6 vitesses</span></li>\r\n 	<li> <span class=\"vMiddle\">cache bagages</span></li>\r\n 	<li> <span class=\"vMiddle\">caméra de recul</span></li>\r\n 	<li> <span class=\"vMiddle\">climatisation automatique multi zone</span></li>\r\n 	<li> <span class=\"vMiddle\">couvre bagages</span></li>\r\n 	<li> <span class=\"vMiddle\">direction assistée</span></li>\r\n 	<li> <span class=\"vMiddle\">démarrage sans clef</span></li>\r\n 	<li> <span class=\"vMiddle\">fermeture électrique automatique</span></li>\r\n 	<li> <span class=\"vMiddle\">GPS</span></li>\r\n 	<li> <span class=\"vMiddle\">grille séparation coffre</span></li>\r\n 	<li> <span class=\"vMiddle\">intérieur cuir</span></li>\r\n 	<li> <span class=\"vMiddle\">lunette arrière ouvrante</span></li>\r\n 	<li> <span class=\"vMiddle\">ordinateur de bord</span></li>\r\n</ul>\r\n[/col]\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Interieur (Suite)</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">ouverture du coffre électrique</span></li>\r\n 	<li> <span class=\"vMiddle\">pack alu</span></li>\r\n 	<li> <span class=\"vMiddle\">pack black-line</span></li>\r\n 	<li> <span class=\"vMiddle\">pack cuir</span></li>\r\n 	<li> <span class=\"vMiddle\">pack luxe</span></li>\r\n 	<li> <span class=\"vMiddle\">pack multimédia</span></li>\r\n 	<li> <span class=\"vMiddle\">prise audio mini USB</span></li>\r\n 	<li> <span class=\"vMiddle\">prises audio auxiliaires</span></li>\r\n 	<li> <span class=\"vMiddle\">régulateur limiteur de vitesse</span></li>\r\n 	<li> <span class=\"vMiddle\">rétroviseur int. jour/nuit auto</span></li>\r\n 	<li> <span class=\"vMiddle\">sièges chauffants</span></li>\r\n 	<li> <span class=\"vMiddle\">sièges électrique à mémoire</span></li>\r\n 	<li> <span class=\"vMiddle\">sièges électriques</span></li>\r\n 	<li> <span class=\"vMiddle\">système audio CD</span></li>\r\n 	<li> <span class=\"vMiddle\">tapis de sol</span></li>\r\n 	<li> <span class=\"vMiddle\">volant cuir</span></li>\r\n 	<li> <span class=\"vMiddle\">volant multifonctions</span></li>\r\n 	<li> <span class=\"vMiddle\">volant réglable en hauteur et profondeur</span></li>\r\n 	<li> <span class=\"vMiddle\">éclairage intérieur temporisé</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Securite</span>\r\n<ul class=\"pB15\">\r\n 	<li> <span class=\"vMiddle\">affichage tête haute</span></li>\r\n 	<li> <span class=\"vMiddle\">airbags front. + lat.</span></li>\r\n 	<li> <span class=\"vMiddle\">alerte franchissement ligne</span></li>\r\n 	<li> <span class=\"vMiddle\">contrôle de pression des pneus</span></li>\r\n 	<li> <span class=\"vMiddle\">feux ar. à LED</span></li>\r\n 	<li> <span class=\"vMiddle\">feux et essuie-glaces automatiques</span></li>\r\n 	<li> <span class=\"vMiddle\">fixations ISOFIX</span></li>\r\n 	<li> <span class=\"vMiddle\">kit téléphone main libre bluetooth</span></li>\r\n 	<li> <span class=\"vMiddle\">phares av. de jour à LED</span></li>\r\n 	<li> <span class=\"vMiddle\">projecteurs antibrouillard</span></li>\r\n</ul>\r\n<span class=\"f15 bold block mB5 capitalize\">Autre</span>\r\n<ul>\r\n 	<li> <span class=\"vMiddle\">carnet d\'entretien</span></li>\r\n 	<li> <span class=\"vMiddle\">contrat entretien</span></li>\r\n 	<li> <span class=\"vMiddle\">non fumeur</span></li>\r\n 	<li> <span class=\"vMiddle\">système Start &amp; Stop</span></li>\r\n</ul>\r\n[/col]\r\n[/row]\r\n\r\n[divider]\r\n<h2 class=\"title clear\">Données complémentaires<sup>1</sup></h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\">\r\n<div class=\"w50\"><span style=\"font-weight: 300;\">[row]</span></div>\r\n</div>\r\n</div>\r\n[row]\r\n[col width=\"six\"]\r\n\r\nPuissance DIN :190 ch\r\nVolume de coffre :560 L\r\n\r\n[/col]\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Emission de C02 :127 g/km</span>\r\n<span class=\"f15 bold block mB5 capitalize\">Consommation mixte :4.8 L/100 km</span>\r\n\r\n[/col]\r\n[/row]\r\n\r\n[divider]\r\n<h2 class=\"title clear\">Réparations</h2>\r\n<div class=\"list2ColsContainer\">\r\n<div class=\"list2Cols\">\r\n<div class=\"w50\"><span style=\"font-weight: 300;\">[row]</span></div>\r\n</div>\r\n</div>\r\n[row]\r\n[col width=\"six\"]\r\n\r\n<span class=\"f15 bold block mB5 capitalize\">Pneus</span>\r\n\r\n[/col]\r\n[col width=\"six\"]\r\n\r\n[/col]\r\n[/row]', 'daba 1', '', 'inherit', 'closed', 'closed', '', '9-revision-v1', '', '', '2018-06-08 18:20:52', '2018-06-08 16:20:52', '', 9, 'http://localhost/firstwordpress/9-revision-v1/', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
CREATE TABLE IF NOT EXISTS `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Non classé', 'non-classe', 0),
(2, 'menu', 'menu', 0),
(3, '30', '30', 0);

-- --------------------------------------------------------

--
-- Structure de la table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(27, 2, 0),
(34, 3, 0),
(35, 3, 0),
(36, 3, 0),
(46, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'nav_menu', '', 0, 2),
(3, 3, 'ml-slider', '', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy,theme_editor_notice'),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"a285432e6152441574d4fcbdeb12010a7e7bbb7527d1d9b8b834f74391843e57\";a:4:{s:10:\"expiration\";i:1529681170;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:78:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0\";s:5:\"login\";i:1528471570;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '4'),
(18, 1, 'wp_user-settings', 'libraryContent=browse&editor=html'),
(19, 1, 'wp_user-settings-time', '1528878918'),
(20, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),
(21, 1, 'metaboxhidden_nav-menus', 'a:3:{i:0;s:26:\"add-post-type-wpcm_vehicle\";i:1;s:12:\"add-post_tag\";i:2;s:15:\"add-post_format\";}'),
(22, 1, 'nav_menu_recently_edited', '2');

-- --------------------------------------------------------

--
-- Structure de la table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BeXjOOsBHWDKjOPZ0ongy/nQ5Hhxyn0', 'admin', 'chestermandimby67@gmail.com', '', '2018-06-08 15:25:56', '', 0, 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
