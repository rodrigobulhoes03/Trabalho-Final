create database if not exists gestao_bolsas;
use gestao_bolsas;

create table utilizadores (
    id int unsigned auto_increment primary key,
    username varchar(50)  not null unique,
    password_hash varchar(255) not null,
    perfil enum('candidato', 'tecnico') not null default 'candidato',
    nome varchar(100) not null,
    email varchar(100) not null unique,
    morada varchar(200) null,
    telefone varchar(20)  null,
    nif char(9) null
);