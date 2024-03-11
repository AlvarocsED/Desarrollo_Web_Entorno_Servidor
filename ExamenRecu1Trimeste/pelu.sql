drop database if exists peluqueria;
create database peluqueria;
use peluqueria;

create table cliente(
	codigo int auto_increment primary key,
    nombre varchar(100) not null,
    nif varchar(9) null unique,
    numTinte int null,
    telefono varchar(9) not null,
    email varchar(320) null
)engine Innodb;
insert into cliente values
	(null, 'Paco Pérez','11111111A',null,'123456789', null),
    (null, 'Nuria Roca',null,12,'234567890', 'nuriaroca@gmail.com'),
    (null, 'Pablo Motos',null,10,'345678912', 'pablomotos@gmail.com'),
    (null, 'Mónica Madina','22222222B',null,'456789123', null),
    (null, 'Esther Gómez',null,null,'567891234', null),
    (null, 'Pedro Picapiedra',null,5,'678912345', null),
    (null, 'Bilma Picapiedra',null,3,'789123456', null);
create table tipoServicio(
	codigo varchar(3) primary key,
    clase enum('Corte','Tinte','Barbería','Lavado') not null,
    descripcion varchar(255) not null,
    precio float not null,
    tiempo float not null default 60.0
)engine Innodb;
insert into tipoServicio(codigo, clase,descripcion,precio) values
	('C1','Corte', 'Corte Caballero', 7.0),
	('C2','Corte', 'Corte Señora Melena Larga', 15.0),
    ('C3','Corte', 'Corte Señora Melena Media', 13.0),
    ('C4','Corte', 'Corte Señora Melena Corta', 10.0),
    ('T1','Tinte', 'Tinte Pelo Corto', 25.0),
    ('T2','Tinte', 'Tinte Melena', 35.0),
	('T3','Tinte', 'Mechas', 70.0),
    ('L1','Lavado', 'Lavado sin mascarilla', 15.0),
    ('L2','Lavado', 'Lavado con mascarilla', 20.0),
    ('B1','Barbería', 'Arreglo Barba', 23.0),
    ('B2','Barbería', 'Arreglo Perilla', 12.0),
    ('B3','Barbería', 'Afeitado', 10.0);
    
create table cita(
	id int auto_increment primary key,
    cliente int not null,
    fechaHora datetime not null,
    tiempoEstimado int not null default 0,
    importe float not null default 0,
    pagado boolean not null default false,
    foreign key (cliente) references cliente(codigo) on update cascade on delete restrict
)engine Innodb;

/*insert into cita(id,cliente,fechahora,pagado) values
	(null, 1, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 2, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 3, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 4, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 5, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 1, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 2, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 3, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 1, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 2, subdate(curdate() , interval floor(rand()*1000000) minute), true),
    (null, 3, 20220601103000, default),
    (null, 4, 20220530170000, default),
    (null, 5, 20220514090000, default);*/
    -- INSERT INTO cita VALUES (1,1,'2020-08-25 15:01:00',60,1),(2,2,'2022-03-25 05:28:00',120,1),(3,3,'2021-03-10 22:14:00',60,1),(4,4,'2020-10-07 20:07:00',60,1),(5,5,'2021-10-10 07:13:00',60,1),(6,1,'2020-06-19 02:22:00',60,1),(7,2,'2020-05-28 22:09:00',60,1),(8,3,'2022-02-22 05:00:00',60,1),(9,1,'2021-06-29 22:30:00',60,1),(10,2,'2020-08-22 12:12:00',60,1),(11,3,'2022-06-01 10:30:00',120,0),(12,4,'2022-05-30 17:00:00',60,0),(13,5,'2022-05-14 09:00:00',60,0);
create table servicioRealizado(
	cita int,
    tipoServicio varchar(3),    
    importe float not null,
    primary key (cita, tipoServicio),
    foreign key (cita) references cita(id) on update cascade on delete restrict,
    foreign key (tipoServicio) references tipoServicio(codigo) on update cascade on delete restrict
)engine Innodb;
/*insert into servicioRealizado values
	(1,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (2,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (3,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (4,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (5,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (6,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (7,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (8,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (9,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (10,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (11,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (12,'L1',(select precio from tiposervicio where codigo = 'L1')),
    (1,'C1',(select precio from tiposervicio where codigo = 'C1')),
    (2,'C2',(select precio from tiposervicio where codigo = 'C2')),
    (2,'T3',(select precio from tiposervicio where codigo = 'T3')),
    (3,'T1',(select precio from tiposervicio where codigo = 'C1')),
    (8,'B2',(select precio from tiposervicio where codigo = 'B2')),
    (4,'T2',(select precio from tiposervicio where codigo = 'T2')),
    (5,'C3',(select precio from tiposervicio where codigo = 'C3')),
    (6,'B1',(select precio from tiposervicio where codigo = 'B1')),
    (7,'T3',(select precio from tiposervicio where codigo = 'T3')),
    (12,'C2',(select precio from tiposervicio where codigo = 'C2')),
    (11,'T2',(select precio from tiposervicio where codigo = 'T2'));*/
-- INSERT INTO `serviciorealizado` VALUES (1,'C1',7),(1,'L1',15),(2,'C2',15),(2,'L1',15),(2,'T3',70),(3,'L1',15),(3,'T1',7),(4,'L1',15),(4,'T2',35),(5,'C3',13),(5,'L1',15),(6,'B1',23),(6,'L1',15),(7,'L1',15),(7,'T3',70),(8,'B2',12),(8,'L1',15),(9,'L1',15),(10,'L1',15),(11,'L1',15),(11,'T2',35),(12,'C2',15),(12,'L1',15);    

delimiter //
create procedure crearCita(cliente int, fecha date, hora time)
begin
    insert into cita values(default, cliente, STR_TO_DATE(CONCAT(fecha, ' ', hora), '%Y-%m-%d %H:%i:%s'),0,0, false);
    select last_insert_id();
end//
delimiter ;
call crearCita(1,'2024-03-12','10:00');