CREATE DATABASE crud;

use crud;

CREATE TABLE task(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(20) NOT NULL,
  apellido VARCHAR(20),
  tipo VARCHAR(25),
  contrasena VARCHAR(20),
  cedula VARCHAR(8)

);

DESCRIBE task;