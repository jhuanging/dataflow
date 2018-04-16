-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ver` smallint(6) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `short_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `summary` text CHARACTER SET utf8mb4 NOT NULL,
  `body` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `source` varchar(255) NOT NULL DEFAULT '',
  `source_id` varchar(64) NOT NULL DEFAULT '',
  `source_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `article_zh`;
CREATE TABLE `article_zh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ver` smallint(6) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `short_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `summary` text CHARACTER SET utf8mb4 NOT NULL,
  `body` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `source` varchar(255) NOT NULL DEFAULT '',
  `source_id` varchar(64) NOT NULL DEFAULT '',
  `source_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `article_en`;
CREATE TABLE `article_en` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ver` smallint(6) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `short_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `summary` text CHARACTER SET utf8mb4 NOT NULL,
  `body` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `source` varchar(255) NOT NULL DEFAULT '',
  `source_id` varchar(64) NOT NULL DEFAULT '',
  `source_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `coin_market_cap`;
CREATE TABLE `coin_market_cap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `oid`    varchar(64) NOT NULL DEFAULT '',
  `name`   varchar(64) NOT NULL DEFAULT '',
  `symbol` varchar(64) NOT NULL DEFAULT '',
  `rank`   varchar(64) NOT NULL DEFAULT '',
  `price_usd` varchar(64) NOT NULL DEFAULT '',
  `price_btc` varchar(64) NOT NULL DEFAULT '',
  `24h_volume_usd` varchar(64) NOT NULL DEFAULT '',
  `market_cap_usd` varchar(64) NOT NULL DEFAULT '',
  `available_supply` varchar(64) NOT NULL DEFAULT '',
  `total_supply` varchar(64) NOT NULL DEFAULT '',
  `max_supply` varchar(64) NOT NULL DEFAULT '',
  `percent_change_1h` varchar(64) NOT NULL DEFAULT '',
  `percent_change_24h` varchar(64) NOT NULL DEFAULT '',
  `percent_change_7d` varchar(64) NOT NULL DEFAULT '',
  `last_updated` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for spider
-- ----------------------------
DROP TABLE IF EXISTS `spider`;
CREATE TABLE `spider` (
  `job` varchar(255) NOT NULL,
  `task_id` varchar(64) NOT NULL DEFAULT '',
  `lang` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spider
-- ----------------------------
INSERT INTO `spider` VALUES ('36kr', '', 'zh');
INSERT INTO `spider` VALUES ('cointelegraph', '', 'en');
INSERT INTO `spider` VALUES ('jinse', '', 'zh');
