--
-- base de donn�es: 'baseavion'
--
create database if not exists baseligue default character set utf8 collate utf8_general_ci;
use baseligue;
-- --------------------------------------------------------
-- creation des tables

set foreign_key_checks =0;

-- table equipe
drop table if exists equipe;
create table equipe (
	eq_id int not null auto_increment primary key,
	eq_nom varchar(50) not null,
	eq_point int
)engine=innodb;

-- table rencontre
drop table if exists rencontre;
create table rencontre (
	re_id int not null auto_increment primary key,
	re_equipe1 int not null,
	re_equipe2 int not null,
	re_numero int,
	re_but1 int,
	re_but2 int,
	unique key renc_equipe (re_equipe1,re_equipe2)
)engine=innodb; 


-- contraintes
alter table rencontre add constraint cs1 foreign key (re_equipe1) references equipe(eq_id);
alter table rencontre add constraint cs2 foreign key (re_equipe2) references equipe(eq_id);

set foreign_key_checks = 1;

-- jeu de données

