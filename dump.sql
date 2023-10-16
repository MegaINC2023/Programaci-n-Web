create database Megainc;
use Megainc;

Create table Chofer(
cedula int (10) not null primary key, 
licencia varchar (10) not null,
nombre varchar (50) not null, 
apellido varchar (50) not null
);

Create table Vehiculo (
matricula varchar (10) not null primary key,
licencia varchar (10),
estado varchar (50) not null,
peso_max varchar (10)
); 

Create table Camion (
matricula varchar (10) not null primary key,
peso_max varchar (10)
);

Alter table Camion 
Add Constraint fk_matricula 
FOREIGN Key (matricula) references Vehiculo (matricula);

Create table Camioneta (
matricula varchar (10) not null primary key,
peso_max varchar (10)
);

Alter table Camioneta 
Add Constraint fk_Ccammatricula 
FOREIGN Key (matricula) references Vehiculo (matricula);

Create table Paquete (
id_paquete int (10) not null primary key,
estado varchar (50) not null,
fecha_registro date not null,
tipo varchar (20),
fragil varchar (2) not null
);

create table Direccion (
id_paquete int (10) not null primary key,
calle varchar (20) not null,
numero int (10) not null,
localidad varchar (20) not null
);

Alter table Direccion 
Add Constraint fk_Didpaquete 
FOREIGN Key (id_paquete) references Paquete (id_paquete);

Alter table Direccion 
Add Constraint fk_Dilocalidad
FOREIGN Key (localidad) references Localidad (localidad);

create table Localidad (
localidad varchar (20) not null,
departamento varchar (20) not null
);

Alter table Localidad 
add Primary key (localidad, departamento);


Create table Empresa (
id_empresa int (10) not null,
empresa varchar (20) not null
);

Alter table Empresa 
add Primary key (id_empresa);

Create table Almacen (
id_almacen int (10) not null,
id_empresa int (10) not null,
calle varchar (50) not null,
numero int (10) not null,
localidad varchar (50) not null
);

Alter table Almacen 
add Primary key (id_almacen);

Alter table Almacen 
Add Constraint fk_empresa 
FOREIGN Key (id_empresa) references Empresa (id_empresa);

Create table Lote (
id_lote int (10) not null,
estado varchar (20) not null,
peso varchar (20) not null
);

Alter table Lote
add Primary key (id_lote);

Create table Trayecto (
id_trayecto int (10) not null,
origen varchar (100) not null,
destino varchar (100) not null,
distancia varchar (30) not null
);

Alter table Trayecto
add Primary key (id_trayecto);

Create table Login (
id_usuario int (10) not null,
tipo_de_usuario varchar (15),
cedula int (10),
contraseña varchar (20) not null
);

Alter table Login
add Primary key (id_usuario);

Alter table Login
add Constraint unique (cedula);

/*************************/
/*tabla de relaciones*/

Create table Maneja (
cedula int (10) not null,
matricula varchar (10) not null
);

Alter table Maneja 
add Primary key (cedula, matricula);

Create table Entrega (
id_paquete int (10) not null,
matricula int (10) not null,
fecha_entrega date,
hora_entrega time
);

Alter table Entrega
add Primary key (id_paquete);

Create table Pertenece (
id_paquete int (10) not null,
id_lote int (10) not null
);

Alter table Pertenece 
add Primary key (id_paquete);

Alter table Pertenece 
Add Constraint fk_Plote 
FOREIGN Key (id_lote) references Lote (id_lote);

Create table Viaja (
id_lote int (10) not null,
id_almacen int (10) not null,
id_trayecto int (10) not null,
fecha_llegada date,
hora_llegada time
);

Alter table Viaja 
add Primary key (id_lote, id_almacen, id_trayecto);

Alter table Viaja 
Add Constraint fk_Valmacen
FOREIGN Key (id_almacen) references Almacen (id_almacen);

Create table Realiza (
id_lote int (10) not null,
id_almacen int (10) not null,
id_trayecto int (10) not null,
matricula varchar (10) not null
);

Alter table Realiza 
add Primary key (id_lote, id_almacen, id_trayecto);

Alter table Realiza 
Add Constraint fk_Rcamion 
FOREIGN Key (matricula) references Camion (matricula);

Create table Tiene (
id_trayecto int (10) not null,
id_almacen int (10) not null,
posicion varchar (20)
);

Alter table Tiene 
add Primary key (id_trayecto, id_almacen);


/*Datos de Prueba*/

insert into Chofer (cedula, licencia, nombre, apellido)  values ('54897452', 'D', 'Jose', 'Gonzales');
insert into Chofer (cedula, licencia, nombre, apellido)  values ('17438941', 'C , D', 'Sofia', 'Ramirez');
insert into Chofer (cedula, licencia, nombre, apellido)  values ('29848642', 'D', 'Mario', 'Ramirez');

insert into Vehiculo (matricula, estado, licencia, peso_max)  values ('ZTP 5139', 'Disponible', 'D', '31 ton');
insert into Vehiculo (matricula, estado, licencia, peso_max)  values ('CTP 5974', 'Transportando', 'D', '31 ton');
insert into Vehiculo (matricula, estado, licencia, peso_max)  values ('HTP 2681', 'No disponible', 'D', '25 ton');
insert into Vehiculo (matricula, estado, licencia, peso_max)  values ('JTP 4458', 'Transportando', 'D','23 ton');
insert into Vehiculo (matricula, estado, licencia, peso_max)  values ('HTP 2681', 'No disponible', 'C', '5 ton');
insert into Vehiculo (matricula, estado, licencia, peso_max)  values ('HTP 8542', 'En Viaje', 'C', '5 ton');

insert into Camion (matricula, peso_max)  values ('ZTP 5139', '31 ton');
insert into Camion (matricula, peso_max)  values ('CTP 5974', '31 ton');
insert into Camion (matricula, peso_max)  values ('JTP 4458', '23 ton');

insert into Camioneta (matricula, peso_max)  values ('HTP 2681', '5 ton');
insert into Camioneta (matricula, peso_max)  values ('HTP 8542', '5 ton');

insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('432551', 'En viaje', '2023-08-31', 'Electronico', 'si');
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('543678', 'Entregado', '2023-06-20', 'Indumentaria', 'no');
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('413255', 'En viaje', '2023-09-04', 'Mueble', 'no');
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('543264', 'En viaje', '2023-08-20', 'Mueble', 'no');
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('154662', 'En espera', '2023-09-04', 'Electronico', 'si' );
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('652466', 'Entregado', '2023-08-20', 'Electronico', 'si');
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('614436', 'Entregado', '2023-09-06', 'Mueble', 'si');
insert into Paquete (id_paquete, estado, fecha_registro, tipo, fragil) values ('124556', 'Entregado', '2023-09-11', 'Mueble', 'no');

insert into Direccion (id_paquete, calle, numero, localidad) values ('432551', 'Diego Lamas', '1172', 'Rivera');
insert into Direccion (id_paquete, calle, numero, localidad) values ('543678', 'Agraciada', '810', 'Rivera');
insert into Direccion (id_paquete, calle, numero, localidad) values ('413255', 'Av. Sarandi', '1102', 'Rivera');
insert into Direccion (id_paquete, calle, numero, localidad) values ('543264', '25 de agosto', '808', 'Pando');
insert into Direccion (id_paquete, calle, numero, localidad) values ('154662', 'Lorenzo Latorre', '16', 'Empalme olmos',);
insert into Direccion (id_paquete, calle, numero, localidad) values ('652466', 'Artigas', '2268', 'Salto');
insert into Direccion (id_paquete, calle, numero, localidad) values ('614436', '19 de abril', '651', 'Salto');
insert into Direccion (id_paquete, calle, numero, localidad) values ('124556', 'Jose pedro varela', '688', 'Melo');

insert into Localidad (localidad, departamento) values ('Rivera', 'Rivera');
insert into Localidad (localidad, departamento) values ('Pando', 'Canelones');
insert into Localidad (localidad, departamento) values ('Empalme olmos', 'Canelones');
insert into Localidad (localidad, departamento) values ('Salto', 'Salto');
insert into Localidad (localidad, departamento) values ('Melo', 'Cerro Largo');


insert into Empresa (id_empresa, empresa) values ('1', 'quick carry');
insert into Empresa (id_empresa, empresa) values ('2', 'crecom');

insert into Almacen (id_almacen, id_empresa, calle, numero, localidad)  values ('444', '1', '8 de octubre', '2054', 'Montevideo');
insert into Almacen (id_almacen, id_empresa, calle, numero, localidad)  values ('445', '2', '18 de Julio', '344', 'Montevideo');
insert into Almacen (id_almacen, id_empresa, calle, numero, localidad)  values ('130', '1', 'Independencia', '2532', 'Pando');
insert into Almacen (id_almacen, id_empresa, calle, numero, localidad)  values ('234', '1', 'Paysandu', '1542', 'Rivera');
insert into Almacen (id_almacen, id_empresa, calle, numero, localidad)  values ('34', '1', 'Brasil', '652', 'Salto');

insert into Lote (id_lote, estado, peso)  values ('53151', 'Entregado', '200 kg');
insert into Lote (id_lote, estado, peso)  values ('44512', 'En viaje', '134 kg');
insert into Lote (id_lote, estado, peso)  values ('23452', 'En viaje', '100 kg');
insert into Lote (id_lote, estado, peso)  values ('65312', 'En espera', '30 kg');

insert into Trayecto (id_Trayecto, origen, destino, distancia)  values ('101','444','234','506km'); 
insert into Trayecto (id_Trayecto, origen, destino, distancia)  values ('102','444','34','491km');

insert into Maneja (cedula, matricula) values ('54897452', 'ZTP 5139');
insert into Maneja (cedula, matricula) values ('17438941', 'JTP 4458');
insert into Maneja (cedula, matricula) values ('29848642', 'CTP 5974');

insert into Entrega (id_paquete, matricula, fecha_entrega, hora_entrega) values ('652466', 'HTP 2681', '2023-09-05' ,'13:30');
insert into Entrega (id_paquete, matricula, fecha_entrega, hora_entrega) values ('614436', 'HTP 2681', '2023-05-05' ,'15:30');
insert into Entrega (id_paquete, matricula, fecha_entrega, hora_entrega) values ('543264', 'HTP 2681', '2023-09-05' ,'15:30');
insert into Entrega (id_paquete, matricula, fecha_entrega, hora_entrega) values ('432551', 'HTP 8542', '', '');
insert into Entrega (id_paquete, matricula, fecha_entrega, hora_entrega) values ('413255', 'HTP 8542', '' ,'');

insert into Viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) values ('53151', '34',  '102', '2023-09-01', '08:35');
insert into Viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) values ('53151', '130', '102', '2023-08-28', '17:00');
insert into Viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) values ('44512', '130', '101','', '');
insert into Viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) values ('44512', '234', '','', '');
insert into Viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) values ('23452', '234', '','', '');


/*Salto*/
insert into Pertenece (id_paquete, id_lote) values ('652466','53151');
insert into Pertenece (id_paquete, id_lote) values ('614436','53151');

/*Rivera*/
insert into Pertenece (id_paquete, id_lote) values ('413255','23452');
insert into Pertenece (id_paquete, id_lote) values ('432551','44512');

/*Pando*/
insert into Pertenece (id_paquete, id_lote) values ('543264','44512');

insert into Realiza (id_lote, id_almacen, id_trayecto, matricula) values ('23452', '234', '101', 'JTP 4458');
insert into Realiza (id_lote, id_almacen, id_trayecto, matricula) values ('44512', '130', '102', 'ZTP 5139');
insert into Realiza (id_lote, id_almacen, id_trayecto, matricula) values ('53151', '34', '102', 'CTP 5974');

insert into Tiene (id_trayecto, id_almacen, posicion) value ('101', '444', 'origen');
insert into Tiene (id_trayecto, id_almacen, posicion) value ('101', '130', 'trasbordo');
insert into Tiene (id_trayecto, id_almacen, posicion) value ('101', '234', 'destino');

insert into Tiene (id_trayecto, id_almacen, posicion) value ('102', '444', 'origen');
insert into Tiene (id_trayecto, id_almacen, posicion) value ('102', '130', 'trasbordo');
insert into Tiene (id_trayecto, id_almacen, posicion) value ('102', '34', 'destino');

/*Sentencia de creacion de usuarios*/

CREATE USER 'Administrador'@'localhost' IDENTIFIED BY 'admin_2023';
CREATE USER 'BackOffice'@'localhost' IDENTIFIED BY 'BackOffice_2023';
CREATE USER 'Almacenero'@'localhost' IDENTIFIED BY 'almacenero_2023';
CREATE USER 'Chofer'@'localhost' IDENTIFIED BY 'chofer_2023';
CREATE USER 'PerAdmin_Almacen'@'localhost' IDENTIFIED BY 'peradmin_2023';

/*Sentencia asignacion de permisos*/
GRANT ALL PRIVILEGES ON * . * TO 'Administrador'@'localhost';

GRANT INSERT (id_almacen, id_empresa, calle, numero, localidad) ON Almacen TO BackOffice;
GRANT SELECT (id_almacen, id_empresa, calle, numero, localidad) ON Almacen TO BackOffice;
GRANT UPDATE (id_almacen, id_empresa, calle, numero, localidad) ON Almacen TO BackOffice;

GRANT SELECT (id_almacen, id_empresa, calle, numero, localidad) ON Almacen TO Almacenero;
GRANT SELECT (calle, numero, localidad) ON Almacen TO Chofer;
GRANT SELECT (calle, numero, localidad) ON Almacen TO PerAdmin_Almacen;

GRANT INSERT (id_lote, estado, peso) ON Lote TO BackOffice;
GRANT SELECT (id_lote, estado, peso) ON Lote TO BackOffice;
GRANT UPDATE (id_lote, estado, peso) ON Lote TO BackOffice;

GRANT SELECT (id_lote, estado) ON Lote TO Almacenero;
GRANT UPDATE (id_lote, estado) ON Lote TO Almacenero;
GRANT SELECT (Peso) ON Lote TO Almacenero;
GRANT SELECT (id_lote, estado, peso) ON Lote TO Chofer;
GRANT SELECT (id_lote) ON Lote TO PerAdmin_Almacen;
GRANT UPDATE (id_lote) ON Lote TO PerAdmin_Almacen;
GRANT SELECT (Estado, Peso) ON Lote TO PerAdmin_Almacen;

GRANT SELECT (id_Trayecto, origen, destino, distancia) ON Trayecto TO BackOffice;
GRANT SELECT (id_Trayecto, origen, destino, distancia) ON Trayecto TO BackOffice;
GRANT UPDATE (id_Trayecto, origen, destino, distancia) ON Trayecto TO BackOffice;
GRANT SELECT (id_Trayecto, origen, destino, distancia) ON Trayecto TO Chofer;
GRANT SELECT (id_Trayecto, origen, destino, distancia) ON Trayecto TO PerAdmin_Almacen;
GRANT UPDATE (id_Trayecto, origen, destino, distancia) ON Trayecto TO PerAdmin_Almacen;

GRANT INSERT (id_paquete, estado, fecha_registro, tipo, fragil) ON Paquete TO BackOffice;
GRANT SELECT (id_paquete, estado, fecha_registro, tipo, fragil) ON Paquete TO BackOffice;
GRANT UPDATE (id_paquete, estado, fecha_registro, tipo, fragil) ON Paquete TO BackOffice;
GRANT SELECT (id_paquete, estado, fecha_registro, tipo, fragil) ON Paquete TO Almacenero;
GRANT SELECT (tipo, fragil) ON Paquete TO Chofer;
GRANT INSERT (fecha_registro) ON Paquete TO PerAdmin_Almacen;
GRANT SELECT (id_paquete, estado, tipo, fragil) ON Paquete TO PerAdmin_Almacen;
GRANT UPDATE (estado) ON Paquete TO PerAdmin_Almacen; 

GRANT INSERT (id_paquete, calle, numero, localidad) ON Direccion TO BackOffice;
GRANT SELECT (id_paquete, calle, numero, localidad) ON Direccion TO BackOffice;
GRANT UPDATE (id_paquete, calle, numero, localidad) ON Direccion TO BackOffice;
GRANT SELECT (id_paquete, calle, numero, localidad) ON Direccion TO Chofer;
GRANT SELECT (id_paquete, calle, numero, localidad) ON Direccion TO PerAdmin_Almacen;
GRANT UPDATE (calle, numero, localidad) ON Direccion TO PerAdmin_Almacen; 

GRANT INSERT (localidad, departamento) ON Localidad TO BackOffice;
GRANT SELECT (localidad, departamento) ON Localidad TO BackOffice;
GRANT UPDATE (localidad, departamento) ON Localidad TO BackOffice;
GRANT SELECT (localidad, departamento) ON Localidad TO Chofer;
GRANT SELECT (localidad, departamento) ON Localidad TO PerAdmin_Almacen;
GRANT UPDATE (localidad, departamento) ON Localidad TO PerAdmin_Almacen; 

GRANT INSERT (id_recorrido, origen, destino) ON Recorrido TO BackOffice;
GRANT SELECT (id_recorrido, origen, destino) ON Recorrido TO BackOffice;
GRANT UPDATE (id_recorrido, origen, destino) ON Recorrido TO BackOffice;
GRANT SELECT (origen, destino) ON Recorrido TO Chofer;
GRANT SELECT (origen, destino) ON Recorrido TO PerAdmin_Almacen;
GRANT UPDATE (origen, destino) ON Recorrido TO PerAdmin_Almacen;

GRANT INSERT (matricula, estado, licencia) ON Vehiculo TO BackOffice;
GRANT SELECT (matricula, estado, licencia) ON Vehiculo TO BackOffice;
GRANT UPDATE (matricula, estado, licencia) ON Vehiculo TO BackOffice;
GRANT SELECT (matricula) ON Vehiculo TO Almacenero;
GRANT SELECT (matricula, estado, licencia) ON Vehiculo TO Chofer;
GRANT UPDATE (estado) ON Vehiculo TO Chofer;
GRANT SELECT (estado, licencia) ON Vehiculo TO PerAdmin_Almacen;

GRANT INSERT (matricula, peso_max) ON Camion TO BackOffice;
GRANT SELECT (matricula, peso_max) ON Camion TO BackOffice;
GRANT UPDATE (matricula, peso_max) ON Camion TO BackOffice;
GRANT SELECT (matricula) ON Camion TO Almacenero;
GRANT SELECT (matricula, peso_max) ON Camion TO Almacenero;
GRANT SELECT (matricula, peso_max) ON Camion TO Chofer;
GRANT UPDATE (estado) ON Camion TO Chofer;
GRANT SELECT (matricula) ON Camion TO PerAdmin_Almacen;

GRANT INSERT (matricula, peso_max) ON Camioneta TO BackOffice;
GRANT SELECT (matricula, peso_max) ON Camioneta TO BackOffice;
GRANT UPDATE (matricula, peso_max) ON Camioneta TO BackOffice;
GRANT SELECT (matricula) ON Camioneta TO Almacenero;
GRANT SELECT (matricula, peso_max) ON Camioneta TO Almacenero;
GRANT SELECT (matricula, peso_max) ON Camioneta TO Chofer;
GRANT UPDATE (estado) ON Camioneta TO Chofer;
GRANT SELECT (matricula) ON Camioneta TO PerAdmin_Almacen;

GRANT INSERT (cedula, licencia, nombre, apellido) ON Chofer TO BackOffice;
GRANT SELECT (cedula, licencia, nombre, apellido) ON Chofer TO BackOffice;
GRANT UPDATE (cedula, licencia, nombre, apellido) ON Chofer TO BackOffice;
GRANT SELECT (licencia) ON Chofer TO Chofer;
GRANT SELECT (cedula, licencia, nombre, apellido) ON Chofer TO PerAdmin_Almacen;

GRANT INSERT (cedula, matricula) ON Maneja TO BackOffice;
GRANT SELECT (cedula, matricula) ON Maneja TO BackOffice;
GRANT UPDATE (cedula, matricula) ON Maneja TO BackOffice;
GRANT SELECT (cedula, matricula) ON Maneja TO Chofer;
GRANT SELECT (cedula, matricula) ON Maneja TO PerAdmin_Almacen;

GRANT INSERT (id_paquete, id_lote) ON Pertenece TO BackOffice;
GRANT SELECT (id_paquete, id_lote) ON Pertenece TO BackOffice;
GRANT UPDATE (id_paquete, id_lote) ON Pertenece TO BackOffice;
GRANT SELECT (id_paquete, id_lote) ON Pertenece TO Almacenero; 
GRANT SELECT (id_paquete, id_lote) ON Pertenece TO Chofer;
GRANT INSERT (id_paquete, id_lote) ON Pertenece TO PerAdmin_Almacen;
GRANT SELECT (id_paquete, id_lote) ON Pertenece TO PerAdmin_Almacen;
GRANT UPDATE (id_paquete, id_lote) ON Pertenece TO PerAdmin_Almacen;

GRANT INSERT (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) ON Viaja TO BackOffice;
GRANT SELECT (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) ON Viaja TO BackOffice;
GRANT UPDATE (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) ON Viaja TO BackOffice;
GRANT SELECT (id_lote, id_almacen, id_trayecto) ON Viaja TO Almacenero;
GRANT SELECT (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) ON Viaja TO Chofer;
GRANT INSERT (fecha_llegada, hora_llegada) ON Viaja TO Chofer;
GRANT SELECT (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) ON Viaja TO PerAdmin_Almacen;
GRANT UPDATE (fecha_llegada, hora_llegada) ON Viaja TO PerAdmin_Almacen;
 
GRANT INSERT, SELECT, UPDATE (id_lote, id_trayecto, id_almacen, matricula) ON Realiza TO BackOffice;
GRANT SELECT (id_lote, id_trayecto, id_almacen, matricula) ON Realiza TO Chofer;
GRANT SELECT (id_lote, id_trayecto, id_almacen, matricula) ON Realiza TO PerAdmin_Almacen;
GRANT UPDATE (id_lote, id_trayecto, id_almacen, matricula) ON Realiza TO PerAdmin_Almacen;

GRANT INSERT (id_trayecto, id_almacen, posicion) ON Tiene TO BackOffice;
GRANT SELECT (id_trayecto, id_almacen, posicion) ON Tiene TO BackOffice;
GRANT UPDATE (id_trayecto, id_almacen, posicion) ON Tiene TO BackOffice;
GRANT SELECT (id_trayecto, id_almacen, posicion) ON Tiene TO Chofer;
GRANT UPDATE (posicion) ON Tiene TO Chofer;
GRANT SELECT (id_trayecto, id_almacen, posicion) ON Tiene TO PerAdmin_Almacen;
GRANT UPDATE (id_trayecto, id_almacen) ON Tiene TO PerAdmin_Almacen;

GRANT INSERT (id_usuario, tipo_de_usuario, cedula, contraseña) ON Login TO BackOffice;
GRANT SELECT (id_usuario, tipo_de_usuario, cedula, contraseña) ON Login TO BackOffice;
GRANT UPDATE (id_usuario, tipo_de_usuario, cedula, contraseña) ON Login TO BackOffice;

/*Descripcion de Transacciones*/

Start transaction;
insert into Chofer (cedula, licencia, nombre, apellido)
value ('48513269', 'C',	'Ricardo', 'Martinez');
commit;

Start transaction;
insert into Camion (matricula, estado, licencia, peso_max) 
value ('ZTX 5129', 'Disponible', '', '31 ton');
rollback;

Start transaction;
insert into Paquete (id_paquete, estado, calle, numero, localidad, departamento, fecha_registro, tipo, fragil)
values ('432551', 'Entregado', 'Diego Lamas', '1172', 'Rivera', 'Rivera', '2023-09-18', 'electronico', 'no');
rollback;

Start transaction;
insert into Empresa (id_empresa, empresa) 
value ('1', 'crecom');
rollback;

Start transaction;
insert into Almacen (id_almacen, id_empresa, calle, numero, localidad)  
values ('445', '1', 'Jose Belloni', '1234', 'Montevideo');
commit;

start transaction;
insert into Lote (id_lote, estado, peso) 
values ('23452', 'Entregado', '100 kg');
rollback;

Start transaction;
insert into Trayecto (id_Trayecto, origen, destino, distancia)  
values ('151','444','445','20km');
commit;

Start transaction;
insert into Maneja (cedula, matricula) 
values ('48090345', 'ZTP 5139');
rollback;

Start transaction;
insert into Entrega (id_paquete, id_recorrido, fecha_entrega, hora_entrega) 
values ('6144363', '345', '2023-05-16' ,'');	
rollback;

Start transaction;
insert into Viaja (id_lote, id_almacen, fecha_llegada, hora_llegada) 
values ('548712', '34', '2023-09-015', '09:45');
commit;

Start transaction;
insert into Pertenece (id_paquete, id_lote) 
values ('614236','53151');
rollback;

Start transaction;
insert into Realiza (id_lote, matricula) values ('45513', 'ZTP 5139');
rollback;

Start transaction;
insert into Tiene (id_trayecto, id_almacen, posicion) 
value ('101', '445', 'trasbordo');
commit;

/*Consultas*/

SELECT p.id_paquete, p.fecha_registro
FROM paquete p
INNER JOIN entrega e ON p.id_paquete = e.id_paquete
INNER JOIN recorrido r ON e.id_recorrido = r.id_recorrido
INNER JOIN almacen a ON r.destino = a.localidad
WHERE DATE_FORMAT(e.fecha_entrega, '%Y-%m') = '2023-05' AND a.localidad = 'Melo';

SELECT a.id_almacen, a.calle, a.numero, a.localidad, COUNT(p.id_paquete) AS cantidad_paquetes
FROM almacen a
LEFT JOIN recorrido r ON a.localidad = r.destino
LEFT JOIN entrega e ON r.id_recorrido = e.id_recorrido
LEFT JOIN paquete p ON e.id_paquete = p.id_paquete
WHERE YEAR(e.fecha_entrega) = 2023
GROUP BY a.id_almacen, a.calle, a.numero, a.localidad
ORDER BY cantidad_paquetes DESC;

SELECT c.matricula, c.estado, r.origen, r.destino
FROM camion c
LEFT JOIN hace h ON c.matricula = h.matricula
LEFT JOIN recorrido r ON h.id_recorrido = r.id_recorrido
WHERE c.estado = 'En Servicio';

CREATE TEMPORARY TABLE Camiones_Visitantes AS
SELECT Matrícula, Id_Almacen
FROM Realiza;
SELECT *
FROM Camiones_Visitantes
WHERE Fecha_Llegada >= '2023-06-01' AND Fecha_Llegada <= '2023-06-30' AND Id_Almacen = 1;

SELECT Paquetes.Id_Paquetes, Paquetes.Id_Lote, Paquetes.Id_Almacen, Paquetes.Matrícula
FROM Paquetes
JOIN Entrega ON Paquetes.Id_Paquetes = Entrega.Id_Paquete
JOIN Recorrido ON Entrega.Id_Recorrido = Recorrido.Id_Recorrido;

SELECT Id_Paquetes, Id_Lote, Matrícula, Id_Almacen, Dirección_Final, Estado
FROM Paquetes
WHERE Fecha_Registro < (current_date - 3);

SELECT Id_Paquetes, Fecha_Registro
FROM (Paquetes LEFT JOIN Paquetes_Pertenece_Lotes ON Paquetes.Id_Paquetes = Paquetes_Pertenece_Lotes.Id_Paquetes);

SELECT Matrícula
FROM Camión
WHERE Estado = 'Fuera de Servicio';

SELECT Matrícula, Estado
FROM Camión
WHERE Matrícula NOT IN (SELECT Matrícula FROM Chofer);

SELECT Almacén.Id_Almacen
FROM Almacén
INNER JOIN Trayecto_Tiene_Almacen ON Almacén.Id_Almacen = Trayecto_Tiene_Almacen.Id_Almacen
INNER JOIN Trayecto ON Trayecto_Tiene_Almacen.Id_Trayecto = Trayecto.Id_Trayecto;





