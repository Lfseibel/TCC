CREATE TABLE Calendario (
    ano int,
    periodo int,
    dataLimite date,
    primary key (ano, periodo)
);

CREATE TABLE Horario (
    codigo char(8) primary key,
    horarioInicio time,
    horarioFim time
);

CREATE TABLE Bloco (
    codigo char(8) primary key
);

CREATE TABLE Unidade (
    codigo char(8) primary key,
    nome char(60)
);

CREATE TABLE Usuario (
    email char(50) primary key,
    senha char(60),
    tipo char(20),
    codigoUnidade char(8),
    foreign key (codigoUnidade) references Unidade (codigo)
);

CREATE TABLE Sala (
    codigo char(10),
    capacidade int,
    capReduzida int,
    codigoBloco char(8),
    primary key (codigo),
    foreign key (codigoBloco) references Bloco (codigo)
);

CREATE TABLE Reserva (
    codigo int auto increment,
    sigla char(12),
    turma char(6),
    descricao char(60),
    observacao char(120),
    responsavel char(60),
    status int,
    horarioInicio time,
    horarioFim time,
    codigoSala char(10),
    emailUsuario char(50),
    primary key (codigo),
    foreign key (codigoSala) references Sala (codigo),
    foreign key (emailUsuario) references Usuario (email)
);

CREATE TABLE ControleSala (
    codigoSala char(10),
    codigoUnidade char(8),
    primary key (codigoSala, CodigoUnidade),
    foreign key (codigoSala) references Sala (codigo),
    foreign key (codigoUnidade) references Unidade (codigo)
);

CREATE TABLE DataReserva (
    data date,
    codigoReserva int,
    primary key (data, codigoReserva),
    foreign key (codigoReserva) references Reserva (codigo)
);















