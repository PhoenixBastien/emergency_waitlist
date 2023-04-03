DROP SCHEMA IF EXISTS emergency_waitlist;
CREATE SCHEMA emergency_waitlist;

USE emergency_waitlist;

CREATE TABLE user (
	user_id SERIAL NOT NULL UNIQUE,
  	username VARCHAR(50) NOT NULL UNIQUE,
  	user_password VARCHAR(255) NOT NULL,
  	email VARCHAR(100) NOT NULL UNIQUE,
	user_role VARCHAR(7) NOT NULL,
	arrival_time TIMESTAMP,
	severity INT,
    PRIMARY KEY (user_id)
);