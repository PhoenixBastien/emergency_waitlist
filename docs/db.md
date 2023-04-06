# Emergency Waitlist Database

## user table

|Field|Type|Null|Key|Default|Extra|
|:----|:----|:----|:----|:----|:----|
|user_id|bigint unsigned|NO|PRI|NULL|auto_increment|
|username|varchar(50)|NO|UNI|NULL| |
|user_password|varchar(255)|NO| |NULL| |
|email|varchar(100)|NO|UNI|NULL| |
|user_role|varchar(7)|NO| |NULL| |
|arrival_time|timestamp|YES| |NULL| |
|severity|int|YES| |NULL| |
|appt_time|timestamp|YES|UNI|NULL| |
