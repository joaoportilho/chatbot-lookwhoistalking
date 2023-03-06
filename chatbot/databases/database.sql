CREATE DATABASE chatbot;

CREATE table users(
	user_id int PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(55) not null,
    user_pass varchar(255) not null,
    user_email varchar(100) not null,
    user_level int not null default 0,
    is_active int default 0
)ENGINE=INNODB;

insert into users(user_name, user_pass, user_email, user_level, is_active)
 values ('admin', '21232f297a57a5a743894a0e4a801fc3', 'seuemail@email.com', 10, 1);

CREATE TABLE prompts(
	id_prompt int,
    question text not null,
    response text not null,
    reaction varchar(25),
    dt_hr_prompt DATETIME not null,
    dt_hr_atualizacao DATETIME not null,
    usr_id integer not null,
   	primary key(id_prompt)
)ENGINE=INNODB;