CREATE DATABASE db_block;
CREATE TABLE users
(
	users_ID		INT		NOT NULL AUTO_INCREMENT,
	users_username 		VARCHAR(50) 	NOT NULL,
	users_password 		VARCHAR(50) 	NOT NULL,
	users_email 		VARCHAR(50) 	NOT NULL,
	users_first_name 	VARCHAR(50) 	NOT NULL,
	users_last_name 	VARCHAR(50) 	NOT NULL,
	users_adress 		VARCHAR(100) 	NOT NULL,
	users_premissions 	INT 		NOT NULL, 
	users_etaj 		INT 		NOT NULL,
	users_apartament 	INT 		NOT NULL,
	users_tel_nomer		VARCHAR(20)	NOT NULL,
	
	PRIMARY KEY (users_ID)
);

CREATE TABLE vhod 
(
	vhod_domoupraviteli	VARCHAR(90)	NOT NULL,
	vhod_taksa_asansior 	DECIMAL 	NULL,
	vhod_taksa_vhod 	DECIMAL 	NULL,
	vhod_taska_pet 		DECIMAL 	NULL,
	vhod_taska_chistachka 	DECIMAL 	NULL,
	vhod_taksa_dop 		DECIMAL 	NULL,
	vhod_pari 		DECIMAL 	NULL,
	vhod_taska_elec 	DECIMAL 	NULL 
);

CREATE TABLE appartament
(
	app_ID 				INT 	NOT NULL AUTO_INCREMENT,  
	app_etaj 			INT 	NOT NULL,
	app_people 			INT 	NOT NULL,
	app_nachDataPolzvane 		DATE 	NOT NULL,
	app_vreme_na_nepolzvane_START 	DATE 	NULL,
	app_vreme_na_nepolzvane_END 	DATE 	NULL,
	app_other_info			TEXT 	NULL,
	
	PRIMARY KEY (app_ID)
);

CREATE TABLE msg 
(
	msg_ID 			INT 		NOT NULL AUTO_INCREMENT,   
	msg_type 		VARCHAR(20) 	NOT NULL,
	msg_text 		TEXT 		NOT NULL,
	PRIMARY KEY (msg_ID)
);
  
