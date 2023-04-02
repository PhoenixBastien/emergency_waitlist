DROP SCHEMA IF EXISTS phplogin;
CREATE SCHEMA phplogin;

USE phplogin;

CREATE TABLE user (
	user_id SERIAL NOT NULL,
  	username varchar(50) NOT NULL,
  	user_password varchar(255) NOT NULL,
  	email varchar(100) NOT NULL,
	user_role varchar(7) NOT NULL,
	arrival_time TIMESTAMP,
	severity int,
    PRIMARY KEY (user_id)
);