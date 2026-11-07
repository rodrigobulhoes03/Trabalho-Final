create database if not exists gestao_bolsas;
use gestao_bolsas;

create table utilizadores (
    id            int unsigned auto_increment primary key,
    username      varchar(50)  not null unique,
    password_hash varchar(255) not null,
    perfil        enum('candidato', 'tecnico') not null default 'candidato',
    nome          varchar(100) not null,
    email         varchar(100) not null unique,
    morada        varchar(200) null,
    telefone      varchar(20)  null,
    nif char(9)      null,
    criado_em     datetime     not null default current_timestamp,
    constraint ck_nif check (nif is null or nif regexp '^[0-9]{9}$')
);

create table bolsas (
    id int unsigned auto_increment primary key,
    designacao  varchar(150) not null,
    tipo_apoio  varchar(80)   not null,
    area_estudo varchar(80)   not null,
    requisitos  text          not null,
    montante    decimal(10,2) not null,
    prazo       date          not null,
    constraint ck_montante check (montante >= 0)
);

create table candidaturas (
    id                  int unsigned auto_increment primary key,
    utilizador_id       int unsigned not null,
    bolsa_id            int unsigned not null,
    tecnico_id          int unsigned null,
    instituicao         varchar(150)  not null,
    curso               varchar(150)  not null,
    rendimento_agregado decimal(10,2) not null,
    iban                varchar(34)   not null,
    estado enum('submetida', 'em_analise', 'aprovada', 'rejeitada','a_aguardar_documentacao', 'cancelada')not null default 'submetida',
    criada_em           datetime not null default current_timestamp,
    atualizada_em       datetime not null default current_timestamp
                        on update current_timestamp,
    unique key uq_candidato_bolsa (utilizador_id, bolsa_id),
    foreign key (utilizador_id) references utilizadores(id),
    foreign key (bolsa_id)      references bolsas(id),
    foreign key (tecnico_id)    references utilizadores(id),
    constraint ck_rendimento check (rendimento_agregado >= 0)
);

create table documentos (
    id             int unsigned auto_increment primary key,
    candidatura_id int unsigned not null,
    nome_original  varchar(255) not null,
    nome_ficheiro  varchar(64)  not null unique,
    tipo_mime      varchar(100) not null,
    tamanho        int unsigned not null,
    enviado_em     datetime not null default current_timestamp,
    foreign key (candidatura_id) references candidaturas(id) on delete cascade,
    constraint ck_tamanho check (tamanho > 0)
);

create table mensagens (
    id             int unsigned auto_increment primary key,
    candidatura_id int unsigned not null,
    autor_id       int unsigned not null,
    tipo           enum('esclarecimento', 'resposta', 'observacao') not null,
    texto          text not null,
    criada_em      datetime not null default current_timestamp,
    foreign key (candidatura_id) references candidaturas(id) on delete cascade,
    foreign key (autor_id)       references utilizadores(id)
);

create table historico_estados (
    id              int unsigned auto_increment primary key,
    candidatura_id  int unsigned not null,
    estado_anterior varchar(30) null,
    estado_novo     varchar(30) not null,
    alterado_por    int unsigned not null,
    alterado_em     datetime not null default current_timestamp,
    foreign key (candidatura_id) references candidaturas(id) on delete cascade,
    foreign key (alterado_por)   references utilizadores(id)
);