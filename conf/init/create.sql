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

-- ----------------------------
-- Table structure for spider
-- ----------------------------
DROP TABLE IF EXISTS `spider`;
CREATE TABLE `spider` (
  `job` varchar(255) NOT NULL,
  `task_id` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spider
-- ----------------------------
INSERT INTO `spider` VALUES ('36kr', '');
INSERT INTO `spider` VALUES ('cointelegraph', '');
INSERT INTO `spider` VALUES ('jinse', '');
