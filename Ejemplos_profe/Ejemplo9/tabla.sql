#Esta tabla la insertamos desde la interfaz de phpmyadmin
CREATE DATABASE IF NOT EXISTS ejemplo9;
CREATE TABLE USUARIOS (
id int(11) NOT NULL auto_increment PRIMARY KEY,
user varchar(32) NOT NULL,
password varchar(255) NOT NULL, #El tamaño recomendado en el manual de PHP para almacenar el hash de la contraseña
email varchar(32) NOT NULL)
ENGINE=MyISAM DEFAULT CHARSET=utf8;
