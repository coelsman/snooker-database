CREATE DATABASE `snooker_db`;

USE `snooker_db`;

DROP TABLE IF EXISTS `snk_seasons`;
CREATE TABLE `snk_seasons` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`uuid` varchar(64) NOT NULL,
	`name` varchar(1024)
) charset=utf8 engine=MyISAM;

DROP TABLE IF EXISTS `snk_tournament_types`;
CREATE TABLE `snk_tournament_types` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` varchar(1024)
) charset=utf8 engine=MyISAM;

INSERT INTO `snk_tournament_types` VALUES 
	(1, 'Ranking Event'),
	(2, 'Minor-Ranking Event'),
	(3, 'Non-Ranking Event'),
	(4, 'Variant Event');


DROP TABLE IF EXISTS `snk_tournaments`;
CREATE TABLE `snk_tournaments` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`uuid` varchar(64) NOT NULL,
	`name` varchar(1024)
) charset=utf8 engine=MyISAM;

DROP TABLE IF EXISTS `snk_tournaments_seasons`;
CREATE TABLE `snk_tournaments_seasons` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`tournament_id` int NOT NULL,
	`season_id` int NOT NULL DEFAULT 0,
	`tournament_type` int NOT NULL DEFAULT 0,
	`alias` varchar(1024),
	`venue` longtext,
	`prize_funds` longtext
) charset=utf8 engine=MyISAM;

DROP TABLE IF EXISTS `snk_players`;
CREATE TABLE `snk_players` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`uuid` varchar(64) NOT NULL,
	`full_name` varchar(1024),
	`avatar` longtext
) charset=utf8 engine=MyISAM;

DROP TABLE IF EXISTS `snk_player_profiles`;
CREATE TABLE `snk_player_profiles` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`player_id` int NOT NULL,
	`nationality` int NOT NULL DEFAULT 0,
	`year_of_birth` int,
	`year_of_death` int,
	`place_of_birth` longtext,
	`highest_ranking` int,
	`century_breaks` int,
	`retired_year` int,
	`career_status` enum('Professional', 'Amateur', 'Retired')
) charset=utf8 engine=MyISAM;

DROP TABLE IF EXISTS `snk_rankings`;
CREATE TABLE `snk_rankings` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` varchar(1024),
	`alias` varchar(8)
) charset=utf8 engine=MyISAM;

INSERT INTO `snk_rankings` VALUES 
	(1, 'Winner', 'W'),
	(2, 'Finalist', 'F'),
	(3, 'Semi-finalist', 'SF'),
	(4, 'Quarter-finalist', 'QF'),
	(5, '4th Round', '4R'),
	(6, '3rd Round', '3R'),
	(7, '2nd Round', '2R'),
	(8, '1st Round', '1R'),
	(9, 'Wildcard Round', 'WR'),
	(10, 'Round Robin', 'RR'),
	(11, 'Lost Qualifier', 'LQ'),
	(12, 'Withdrew', 'WD'),
	(13, 'Did not participate', 'A');

DROP TABLE IF EXISTS `snk_players_tournaments`;
CREATE TABLE `snk_players_tournaments` (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`player_id` int NOT NULL,
	`tournament_season_id` int NOT NULL,
	`ranking_id` int NOT NULL,
	`prize_fund` int
) charset=utf8 engine=MyISAM;