USE emergency_waitlist;

INSERT INTO user (user_id, username, user_password, email, user_role) VALUES (DEFAULT, 'test', 'test', 'test@test.com', 'admin');
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'joe', 'joe', 'joe@patient.com', 'patient', TIMESTAMP'2023-04-02 18:00:00', 5);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'sam', 'sam', 'sam@patient.com', 'patient', TIMESTAMP'2023-04-02 17:00:00', 5);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'max', 'max', 'max@patient.com', 'patient', TIMESTAMP'2023-04-02 18:00:00', 1);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'pho', 'pho', 'pho@patient.com', 'patient', TIMESTAMP'2023-04-02 19:00:00', 2);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'mel', 'mel', 'mel@patient.com', 'patient', TIMESTAMP'2023-04-02 17:00:00', 3);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'jay', 'jay', 'jay@patient.com', 'patient', TIMESTAMP'2023-04-02 16:00:00', 1);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'jon', 'jon', 'jon@patient.com', 'patient', TIMESTAMP'2023-04-02 16:00:00', 2);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'ron', 'ron', 'ron@patient.com', 'patient', TIMESTAMP'2023-04-02 16:00:00', 3);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'don', 'don', 'don@patient.com', 'patient', TIMESTAMP'2023-04-02 16:00:00', 4);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'ray', 'ray', 'ray@patient.com', 'patient', TIMESTAMP'2023-04-02 16:00:00', 5);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'kev', 'kev', 'kev@patient.com', 'patient', TIMESTAMP'2023-04-04 21:00:00', 4);
INSERT INTO user (user_id, username, user_password, email, user_role, arrival_time, severity) VALUES (DEFAULT, 'zak', 'zak', 'zak@patient.com', 'patient', current_time(), 5);