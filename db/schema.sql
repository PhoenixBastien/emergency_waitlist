DROP SCHEMA IF EXISTS emergency_waitlist;
CREATE SCHEMA emergency_waitlist;

USE emergency_waitlist;

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