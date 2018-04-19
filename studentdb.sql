/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : studentdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-19 13:51:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sections`
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sections
-- ----------------------------
INSERT INTO `sections` VALUES ('1', 'team sawi', '2018-04-13 10:04:21', null);
INSERT INTO `sections` VALUES ('2', 'friendzone', '2018-04-13 10:04:24', null);

-- ----------------------------
-- Table structure for `students`
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_number` varchar(15) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('1', '92697', 'Cedrick', 'Blas', '1', '2018-04-13 10:04:29', null);
INSERT INTO `students` VALUES ('5', '81395', 'Sam Pinto', 'Blas', '2', '2018-04-13 10:04:29', '2018-04-16 18:07:38');
INSERT INTO `students` VALUES ('8', '21637', 'Bella', 'Padilla', '2', '2018-04-13 10:04:29', null);
INSERT INTO `students` VALUES ('10', '80042', 'Phalcon', 'Poop', '1', '2018-04-13 10:04:29', '2018-04-19 13:50:27');
INSERT INTO `students` VALUES ('11', '55473', 'Laravel', 'Poop', '2', '2018-04-13 10:04:29', '2018-04-15 14:08:54');
