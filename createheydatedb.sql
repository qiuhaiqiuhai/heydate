create database heydatedb;
use heydatedb;
create table users_account 
(	userID int unsigned not null auto_increment primary key,
	name varchar(20) not null, 
    password varchar(40) not null,
    email varchar(100) not null,   
    birthdate date not null,
    gender set('Male','Female') not null,
    city varchar(30) not null
);

insert into users_account values
 	(NULL, 'Beauty', md5('Beauty'), 'beauty@beauty.com','2000-01-01','Female', 'Singapore');


create table users_profile_photo
( 	photoID int unsigned not null auto_increment primary key,
	userID int unsigned not null,
	photo varchar(50) DEFAULT NULL
);

insert into users_profile_photo values
 	(NULL, 1, '1.jpg');


create table users_relationship
( 	relationID int unsigned not null auto_increment primary key,
	userID1 int unsigned not null,
	userID2 int unsigned not null,
	status varchar(50) DEFAULT NULL
);