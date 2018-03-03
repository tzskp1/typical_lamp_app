create database BBS;
use BBS;
create table topic (
                   id int auto_increment not null,
                   length int not null,
                   name varchar(300) not null,
                   primary key(id)
                   ) engine=InnoDB;
create table comment (
                     number int not null,
                     user varchar(50) not null,
                     topic int not null,
                     content varchar(4000),
                     primary key(number,topic),
                     foreign key(topic) references topic(id)
                     ) engine=InnoDB;
use mysql;
grant all privileges on `BBS`.topic to 'BBS'@'%';
grant all privileges on `BBS`.comment to 'BBS'@'%';
