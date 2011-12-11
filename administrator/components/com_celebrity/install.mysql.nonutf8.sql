CREATE TABLE IF NOT EXISTS `#__celebrity_address` (
	`id` int(11)  NOT NULL  auto_increment,
	`company` varchar(255)  NULL ,
	`line_1` varchar(255)  NULL ,
	`line_2` varchar(255)  NULL ,
	`city` varchar(255)  NULL ,
	`country_id` int(11)  NULL ,
	`state_id` int(11)  NULL ,
	`zipcode` varchar(255)  NULL ,
	`address_type_id` int(11)  NULL ,
	`source` varchar(255)  NULL ,
	`is_outdated` tinyint(1)  NULL ,
	`is_approved` tinyint(1)  NULL ,
	`approved_by_uid` int(11)  NULL ,
	`start` date  NULL ,
	`end` date  NULL ,
	`date_created` datetime  NULL ,
	`created_by_uid` int(11)  NULL ,
	`outdated_address_comment` int(11)  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_address_type` (
	`id` int(11)  NOT NULL  auto_increment,
	`type` varchar(255)  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_celebrity_address` (
	`id` int(11)  NOT NULL  auto_increment,
	`celebrity_id` int(11)  NULL ,
	`address_id` int(11)  NULL ,
	`date_created` datetime  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_celebrity_profession` (
	`id` int(11)  NOT NULL  auto_increment,
	`celebrity_id` int(11)  NULL ,
	`profession_id` int(11)  NULL ,
	`date_created` datetime  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_country` (
	`id` int(11)  NOT NULL  auto_increment,
	`name` int(11)  NULL ,
	`abbreviation` varchar(255)  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_deceased_comment` (
	`id` int(11)  NOT NULL  auto_increment,
	`created_by_uid` int(11)  NULL ,
	`comment` text  NULL ,
	`date_created` datetime  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_email` (
	`id` int(11)  NOT NULL  auto_increment,
	`address` varchar(255)  NULL ,
	`celebrity_id` int(11)  NULL ,
	`date_created` datetime  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_outdated_address_comment` (
	`id` int(11)  NOT NULL  auto_increment,
	`created_by_uid` int(11)  NULL ,
	`comment` text  NULL ,
	`date_created` datetime  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_profession` (
	`id` int(11)  NOT NULL  auto_increment,
	`name` varchar(255)  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_state` (
	`id` int(11)  NOT NULL  auto_increment,
	`country_id` int(11)  NULL ,
	`name` varchar(255)  NULL ,
	`abbreviation` varchar(255)  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;CREATE TABLE IF NOT EXISTS `#__celebrity_website` (
	`id` int(11)  NOT NULL  auto_increment,
	`url` varchar(255)  NULL ,
	`celebrity_id` int(11)  NULL ,
	`date_created` datetime  NULL ,
	PRIMARY KEY  (`id`)
) Type=MyISAM;