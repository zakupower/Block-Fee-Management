CREATE DATABASE db_block;
CREATE TABLE users
(
  users_ID INT NOT NULL AUTO_INCREMENT,
  users_username VARCHAR(50) NOT NULL,
  users_password CHAR(50) NOT NULL,
  users_email VARCHAR(50) NOT NULL,
  users_first_name VARCHAR(50) NOT NULL,
  users_last_name VARCHAR(50) NOT NULL,
  users_premissions INT NOT NULL, -- 1- User / 2- Domoupravitel / 3- Admin
  users_etaj INT NOT NULL,
  users_apartament INT NOT NULL,
  PRIMARY KEY (users_ID)
);

CREATE TABLE vhod 
(
  vhod_taksa_asansior DECIMAL NOT NULL,
  vhod_taksa_vhod DECIMAL NOT NULL,
  vhod_taska_pet DECIMAL NOT NULL,
  vhod_taska_chistachka DECIMAL NOT NULL,
  vhod_taksa_dop DECIMAL NOT NULL,
  vhod_pari DECIMAL NOT NULL,
);

CREATE TABLE msg -- za nqkvi sabraniq i etc da se poqvqva nai otgore na raotite
(
  msg_ID INT NOT NULL AUTO_INCREMENT,   
  msg_type VARCHAR(20) NOT NULL,
  msg_text TEXT NOT NULL
);
  
