create database if not exists lista
default character set utf8
default collate utf8_general_ci;

use lista;

create table if not exists contatos(
	`id` int not null auto_increment,
	`nome` varchar(30),
	`telefone` varchar(20),
    primary key (`id`)
) default charset = utf8;

INSERT INTO contatos VALUES (DEFAULT, 'cbr', '992');

