create database if not exists gestao_bolsas;
use gestao_bolsas;

create table utilizadores(
    id int unsigned auto_increment primary key,
    username varchar(50)  not null unique,
    password_hash varchar(255) not null,
    perfil enum('candidato', 'tecnico') not null default 'candidato',
    nome varchar(100) not null,
    email varchar(100) not null unique,
    morada varchar(200) null,
    telefone varchar(20)  null,
    nif char(9) null,
    criado_em datetime not null default current_timestamp,
    constraint ck_nif check (nif is null or nif regexp '^[0-9]{9}$')
);

create table bolsas(
    id int unsigned auto_increment primary key,
    designacao varchar(150) not null,
    tipo_apoio varchar(80) not null,
    area_estudo varchar(80) not null,
    requisitos text not null,
    montante decimal(10,2) not null,
    prazo date not null,
    constraint ck_montante check (montante >= 0)
);

create table candidaturas(
  id int unsigned auto_increment primary key,
  id_candidato int unsigned not null,
  id_bolsa int unsigned not null,
  id_tecnico int unsigned null,
  instituicao varchar(150) not null,
  curso varchar(150) not null,
  rendimento_agregado decimal(10,2) not null,
  iban varchar(34) not null,
  estado enum('submetida','em_analise','aprovada','rejeitada', 'aguarda_documentacao','cancelada')  not null default 'submetida',
  data_submissao datetime not null default current_timestamp,
  unique (id_candidato, id_bolsa),
  foreign key (id_candidato) references utilizadores(id),
  foreign key (id_bolsa) references bolsas(id),
  foreign key (id_tecnico) references utilizadores(id),
  constraint ck_rendimento check (rendimento_agregado >= 0)
);

create table documentos(
  id int unsigned auto_increment primary key,
  id_candidatura int unsigned not null,
  nome_original varchar(255) not null,
  nome_ficheiro varchar(100) not null unique,
  tipo_mime varchar(100) not null,
  data_upload datetime not null default current_timestamp,
  foreign key (id_candidatura) references candidaturas(id) on delete cascade
);

create table esclarecimentos (
  id int unsigned auto_increment primary key,
  id_candidatura int unsigned not null,
  id_tecnico int unsigned not null,
  pergunta text not null,
  resposta text null,
  data_pedido datetime not null default current_timestamp,
  data_resposta datetime null,
  foreign key (id_candidatura) references candidaturas(id) on delete cascade,
  foreign key (id_tecnico) references utilizadores(id)
);

create table observacoes(
  id int unsigned auto_increment primary key,
  id_candidatura int unsigned not null,
  id_tecnico int unsigned not null,
  texto text not null,
  data_registo datetime not null default current_timestamp,
  foreign key (id_candidatura) references candidaturas(id) on delete cascade,
  foreign key (id_tecnico) references utilizadores(id)
);

create table historico_estados(
  id int unsigned auto_increment primary key,
  id_candidatura int unsigned not null,
  estado_anterior varchar(30) null,
  estado_novo varchar(30) not null,
  id_utilizador int unsigned not null,
  data_alteracao datetime not null default current_timestamp,
  foreign key (id_candidatura) references candidaturas(id) on delete cascade,
  foreign key (id_utilizador)  references utilizadores(id)
);