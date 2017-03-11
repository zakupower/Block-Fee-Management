CREATE TABLE IF NOT EXISTS `apps`
(
	`app_ID`							INT 	NOT NULL AUTO_INCREMENT,
	`app_floor` 						INT 	NOT NULL,
	`app_people` 						INT 	NOT NULL,
	`app_nachDataPolzvane` 				DATE 	NOT NULL,
	`app_unique_ID`						VARCHAR NULL,
	`app_other_info`					TEXT 	NULL,

	PRIMARY KEY (app_ID)
) AUTO_INCREMENT=1;
-- NOT FINISHED
