create database f35im;
use f35im;
create table users_account 
(	userID int unsigned not null auto_increment primary key,
	name varchar(20) not null, 
    password varchar(40) not null,
    email varchar(100) not null,   
    birthdate date not null,
    gender set('Male','Female') not null,
    city varchar(30) not null,
    height int unsigned not null,
    education varchar(20) not null, 
    profilePhoto varchar(50) DEFAULT NULL
);

insert into users_account values
 	(NULL, 'Beauty', md5('Beauty'), 'Beauty@gmail.com','2000-01-01','Female', 'Singapore', 170,'MBA', '1.jpg'),
 	(NULL, 'Noah', md5('Noah'), 'Noah@gmail.com','2000-01-01','Female', 'Singapore', 170,'MBA', '2.jpg'),
 	(NULL, 'James', md5('James'), 'James@gmail.com','2000-01-01','Female', 'Singapore', 170,'MBA', '3.jpg'),
 	(NULL, 'Zhao', md5('Zhao'), 'Zhao@gmail.com','2000-01-01','Female', 'Singapore', 170,'MBA', '4.jpg'),
 	(NULL, 'Ethan', md5('Ethan'), 'Ethan@gmail.com','2000-01-01','Female', 'Singapore', 170,'MBA', '5.jpg'),
 	(NULL, 'David', md5('David'), 'David@gmail.com','2000-01-01','Male', 'Singapore', 170,'MBA', '6.jpg'),
 	(NULL, 'Lucas', md5('Lucas'), 'Lucas@gmail.com','2000-01-01','Male', 'Singapore', 170,'MBA', '7.jpg'),
 	(NULL, 'Leon', md5('Leon'), 'Leon@gmail.com','2000-01-01','Male', 'Singapore', 170,'MBA', '8.jpg'),
 	(NULL, 'Zoey', md5('Zoey'), 'Zoey@gmail.com','2000-01-01','Male', 'Singapore', 170,'MBA', '9.jpg'),
 	(NULL, 'Model', md5('Model'), 'Model@gmail.com','2000-01-01','Male', 'Singapore', 170,'MBA', '10.jpg');


-- create table users_profile_photo
-- ( 	photoID int unsigned not null auto_increment primary key,
-- 	userID int unsigned not null,
-- 	photo varchar(50) DEFAULT NULL
-- );

-- insert into users_profile_photo values
--  	(NULL, 1, '1.jpg');

create table users_photo
( 	photoID int unsigned not null auto_increment primary key,
	userID int unsigned not null,
	photo varchar(50) DEFAULT NULL
);

insert into users_photo values
 	(NULL, 1, '1_1.jpg'),
 	(NULL, 1, '1_2.jpg'),
 	(NULL, 1, '1_3.jpg'),
 	(NULL, 2, '2_1.jpg');


create table users_description
( 	descriptionID int unsigned not null auto_increment primary key,
	userID int unsigned not null,
	description text,
	type set('Intro','Mate_Criteria','Life_Style') not null,
);

insert into users_description values
 	(NULL, 1, "I'm pretty"),
 	(NULL, 2, "I'm sexy"),
 	(NULL, 5, "I'm handsome"),
 	(NULL, 6, "I'm rich");




create table users_relationship
( 	relationID int unsigned not null auto_increment primary key,
	userID1 int unsigned not null,
	userID2 int unsigned not null,
	status set('Viewed','Like') not null,
	statusTime TIMESTAMP NOT NULL
);

create table users_message
( 	mesageID int unsigned not null auto_increment primary key,
	senderID int unsigned not null,
	receiverID int unsigned not null,
	message text,
	time TIMESTAMP NOT NULL
);



