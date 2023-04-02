USE phplogin;

INSERT INTO user (user_id, username, user_password, email, user_role) VALUES (DEFAULT, 'test', 'test', 'test@test.com', 'admin');
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'joe', 'patient', 'joe@patient.com', 'patient', TIME'18:00', 5);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'sam', 'patient', 'sam@patient.com', 'patient', TIME'17:00', 5);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'max', 'patient', 'max@patient.com', 'patient', TIME'18:00', 1);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'pho', 'patient', 'pho@patient.com', 'patient', TIME'19:00', 2);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'mel', 'patient', 'mel@patient.com', 'patient', TIME'17:00', 3);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'jay', 'patient', 'jay@patient.com', 'patient', TIME'16:00', 1);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'jon', 'patient', 'jon@patient.com', 'patient', TIME'16:00', 2);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'ron', 'patient', 'ron@patient.com', 'patient', TIME'16:00', 3);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'don', 'patient', 'don@patient.com', 'patient', TIME'16:00', 4);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'ray', 'patient', 'ray@patient.com', 'patient', TIME'16:00', 5);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'kev', 'patient', 'kev@patient.com', 'patient', TIME'21:00', 4);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'zak', 'patient', 'zak@patient.com', 'patient', current_time(), 5);