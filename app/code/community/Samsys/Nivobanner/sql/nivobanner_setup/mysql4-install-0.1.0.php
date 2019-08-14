<?php

/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
$installer = $this;

$installer->startSetup();

$installer->run("

 DROP TABLE IF EXISTS {$this->getTable('nivobanner')};
CREATE TABLE {$this->getTable('nivobanner')} (
  `banner_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `banner_content` text NOT NULL default '',
  `show_title` ENUM('0','1') ,
  `show_content` ENUM('0','1') ,
  `status` smallint(6) NOT NULL default '0',
  `link_target` TINYINT( 4 ) NOT NULL DEFAULT '0' COMMENT '1=>New Window, 0=> Self',
  `sort_order` int(11) NOT NULL default '0',
  `created_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('nivobanner')} (`banner_id`, `title`, `filename`, `link`, `banner_content`,`show_title`, `show_content`, `status`, `link_target`, `sort_order`, `created_time`, `update_time`) VALUES
(1, 'Banner 1', 'nivo/banner/nemo.jpg', 'http://www.google.com/', '', '1', '1', 1, 0, 0, '2011-03-16 06:22:53', '2011-03-16 06:22:53'),
(2, 'Banner 2', 'nivo/banner/toystory.jpg', '', '', '1', '0', 1, 0, 0, '2011-03-16 06:23:04', '2011-03-16 06:23:04'),
(3, 'Banner 3', 'nivo/banner/up.jpg', '', '', '0', '0', 1, 0, 0, '2011-03-16 06:23:16', '2011-03-16 06:23:16'),
(4, 'Banner 4', 'nivo/banner/walle.jpg', '', '', '1', '0', 1, 0, 0, '2011-03-16 06:23:28', '2011-03-16 06:23:28');

 
 DROP TABLE IF EXISTS {$this->getTable('nivobannergroup')};
CREATE TABLE {$this->getTable('nivobannergroup')} (
 `group_id` int(11) unsigned NOT NULL auto_increment,
 `group_name` varchar(255) NOT NULL default '',
 `group_code` varchar(255) NOT NULL default '',
 `banner_width` SMALLINT( 4 ) NOT NULL DEFAULT '0',
 `banner_height` SMALLINT( 4 ) NOT NULL DEFAULT '0',
 `banner_effects` varchar(255) NOT NULL default '',
 `animation_speed` int(11) unsigned  NULL,
 `pause_time` int(11) unsigned  NULL,
 `image_nav` ENUM('0','1') default '0',
 `image_pagi` ENUM('0','1') default '0',
 `hover_pause` ENUM('0','1') default '0',
 `autoplay` ENUM('0','1') default '0',
 `theme` varchar(255) NOT NULL default '',
 `banner_ids` varchar(255) NOT NULL default '',
 `status` smallint(6) NOT NULL default '0',
 `created_time` DATETIME NULL,
 `update_time` DATETIME NULL,
 PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('nivobannergroup')} (`group_id`, `group_name`, `group_code`, `banner_width`, `banner_height`, `banner_effects`, `animation_speed`, `pause_time`, `image_nav`,`image_pagi`, `hover_pause`, `autoplay`, `theme`, `banner_ids`, `status`, `created_time`, `update_time`) VALUES
(1, 'Home Banner', 'home_banner', 620, 200, 'random', '500', '3000', '0','0', '0', '1',  'dark', '1,2,3,4',  1, '2011-03-16 06:25:57', '2011-03-16 06:25:57'),
(2, 'Left Banner', 'left_banner', 620, 200, 'boxRainGrow', '500', '3000', '0','0', '0', '1',  'default', '1,2,3,4', 1, '2011-03-16 07:11:12', '2011-03-16 07:11:12');
");
$installer->endSetup();
