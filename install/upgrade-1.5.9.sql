#A bit of optimizing never hurt anyone... (added v1.5.6)
OPTIMIZE TABLE `%TICKET_TABLE%`;
OPTIMIZE TABLE `%TICKET_PREFIX%answers`;
OPTIMIZE TABLE `%TICKET_PREFIX%attachments`;
OPTIMIZE TABLE `%TICKET_PREFIX%banlist`;
OPTIMIZE TABLE `%TICKET_PREFIX%categories`;
OPTIMIZE TABLE `%TICKET_PREFIX%config`;
OPTIMIZE TABLE `%TICKET_PREFIX%groups`;
OPTIMIZE TABLE `%TICKET_PREFIX%messages`;
OPTIMIZE TABLE `%TICKET_PREFIX%privmsg`;
OPTIMIZE TABLE `%TICKET_PREFIX%reps`;

#Added settings table to replace mostly settings in settings.php/automail-settings.pl and eventually the config table
#<1.5.6:
CREATE TABLE IF NOT EXISTS `%TICKET_PREFIX%settings`(
  `ID` int(5) NOT NULL auto_increment,
  `group` varchar(255) NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `GROUP` (`GROUP`),
  KEY `VALUE` (`KEY`)
);

ALTER TABLE `%TICKET_PREFIX%categories` ADD `reply_method` VARCHAR( 7 ) NOT NULL DEFAULT 'url'; 
ALTER TABLE `%TICKET_TABLE%` CHANGE `status` `status` enum('new', 'onhold', 'custreplied', 'awaitingcustomer', 'reopened', 'closed') NOT NULL DEFAULT 'new';
ALTER TABLE `%TICKET_TABLE%` CHANGE `timestamp` `timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `%TICKET_PREFIX%groups` ADD `db` INT(1) NOT NULL DEFAULT '0' AFTER `banlist`;
UPDATE `%TICKET_PREFIX%groups` SET `db` = '1' WHERE `ID` = 1;
ALTER TABLE `%TICKET_TABLE%` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%answers` COMMENT = '1.7.3'; 
ALTER TABLE `%TICKET_PREFIX%attachments` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%banlist` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%categories` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%groups` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%messages` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%privmsg` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%reps` COMMENT = '1.7.3';
ALTER TABLE `%TICKET_PREFIX%settings` COMMENT = '1.7.3';