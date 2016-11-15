CREATE DATABASE db_block;
CREATE TABLE users
(
  user_ID INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password CHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  premissions INT NOT NULL, -- 1- User / 2- Domoupravitel / 3- Admin
  etaj INT NOT NULL,
  apartament INT NOT NULL,
  PRIMARY KEY (user_ID)
);

CREATE TABLE vhod 
(
  taksa_asansior DECIMAL NOT NULL,
  taksa_vhod DECIMAL NOT NULL,
  taska_pet DECIMAL NOT NULL,
  taska_chistachka DECIMAL NOT NULL,
  taksa_dop DECIMAL NOT NULL,
  vhod_pari DECIMAL NOT NULL,
);
