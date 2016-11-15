CREATE DATABASE db_block;
CREATE TABLE users
(
  user_ID INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password CHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  pet INT NOT NULL, -- 0 - nqma 1- ima 
  premissions INT NOT NULL -- 1- User / 2- Domoupravitel / 3- Admin
);

CREATE TABLE vhod 
(
  taksa_asansior DECIMAL NOT NULL,
  taksa_vhod DECIMAL NOT NULL,
  taska_chistachka DECIMAL NOT NULL,
  taksa_dop DECIMAL NOT NULL,
  vhod_pari DECIMAL NOT NULL,
);
