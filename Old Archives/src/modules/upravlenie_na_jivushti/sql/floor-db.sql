CREATE TABLE IF NOT EXISTS `floors`
(
	`floor_ID`							INT 	NOT NULL AUTO_INCREMENT,
	`floor_apps` 						INT 	NOT NULL,
	`floor_info`					    TEXT 	NULL,

	PRIMARY KEY (floor_ID)
) AUTO_INCREMENT=1;
