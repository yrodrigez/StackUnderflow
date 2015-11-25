create table users
(
	id integer auto_increment primary key,
	username varchar(20) unique,
	password varchar(50) not null,
	email varchar(255) not null,
	foto varchar(255),
	descripcion text,
	tipo smallint not null
);
create table posts
(
	id integer primary key auto_increment,
	titulo varchar(40) not null,
	user_id integer not null,
	cuerpo text not null,
	numvisitas integer not null,
	created datetime default null,
	contestada smallint not null,
	foreign key (user_id) references users(id)
);
create table respuestas
(
	id integer primary key auto_increment,
	user_id integer not null,
	idpost integer not null,
	cuerpo text not null,
	created datetime default null,
	foreign key (user_id) references users(id),
	foreign key (idpost) references posts(id)
);
create table tags
(
	id integer primary key auto_increment,
	tag varchar(20)
);

create table post_tag
(

	tag_id integer,
	post_id integer,
	foreign key (post_id) references posts(id),
	foreign key (tag_id) references tags(id)
);

insert into users(id, username, password, email, foto, descripcion, tipo) values (0,"yonyon", "yonyon", "yonyon@gmail.com", "path", "soy un rogue", 1);
insert into posts(id, titulo, user_id, cuerpo, numvisitas, created, modified, contestada) values (0,"a title", 0, "cuerpo del post", 10, 20150124, 0);
insert into respuestas(id, user_id, idpost, cuerpo, created, modified) values (0,"yonyon", 1, "cuerpo de la respuesta", 20150124);
insert into tags(id, tag) values (0, "c++");
insert into post_tag(tag_id, post_id) values (0, 0);