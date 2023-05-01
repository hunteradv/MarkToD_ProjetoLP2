create database marktodo2;

use marktodo2;

create table users (
	userId int auto_increment,
    name varchar(100) not null,
	role varchar(100),
	password varchar (30) not null,
	email varchar(30) not null,
    primary key (userId)
);

create table environments(
	environmentId int auto_increment,
    name varchar(50) not null,
    head int,
    primary key (environmentId),
    foreign key (head) references users(userId)
);

create table users_in_environments(
	uEnvId int auto_increment,
	environmentId int,
	userId int not null,

	primary key (uEnvId),
    FOREIGN key (environmentId) REFERENCES environments(environmentId),
    FOREIGN KEY (userId) REFERENCES users(userId)
);
    
    
create table teams (
	teamId int auto_increment,
    name varchar(50) not null,
    obs varchar(255),
    teamHead int,
	idEnvironment int not null,
    primary key (teamId),
    foreign key (teamHead) references users(userId),
	foreign key (idEnvironment) references environments(environmentId)
    ); 

create table taskCategories (
	taskCategoryId int auto_increment,
    name varchar(50),
    primary key (taskCategoryId)
    );
	
create table tasks(
	taskId int auto_increment, 
    category int not null,
    title varchar(50) not null,
    obs varchar(255),
    dateAdd datetime default current_timestamp,
    dueDate datetime not null,
	finishedDate datetime,
    owner int,
    status int default 1 ,-- status 1=Aberta, status 2=Fechada
    primary key (taskId),
    foreign key (category) references taskCategories(taskCategoryId),
    foreign key (owner) references users(userId)
    );