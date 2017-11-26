-- jrodeiro - 7/10/2017
-- script de creación de la bd, usuario, asignación de privilegios a ese usuario sobre la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `IU_USUARIO`;
CREATE DATABASE `IU_USUARIO` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `IU_USUARIO`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `useriu`@`localhost`;
	DROP USER `useriu`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `useriu`@`localhost` IDENTIFIED BY 'passiu';
GRANT USAGE ON *.* TO `useriu`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `IU_USUARIO`.* TO `useriu`@`localhost` WITH GRANT OPTION;
--
-- Estructura de tabla para la tabla `datos`
--
CREATE TABLE IF NOT EXISTS `USUARIO` (

`login` varchar(15) NOT NULL,

`password` varchar(128) NOT NULL,

`DNI` varchar(9) NOT NULL,

`Nombre` varchar(30) NOT NULL,

`Apellidos` varchar(50) NOT NULL,

`Correo` varchar(60) NOT NULL,

`Direccion` varchar(120) NOT NULL,

`Telefono` varchar(11) NOT NULL,

PRIMARY KEY (`login`),

UNIQUE KEY `DNI` (`DNI`),

UNIQUE KEY `Correo` (`Correo`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `GRUPO` (

`IdGrupo` varchar(15) NOT NULL,

`NombreGrupo` varchar(20) NOT NULL,

`DescripGrupo` varchar(50) NOT NULL,

PRIMARY KEY (`IdGrupo`),

UNIQUE KEY `DNI` (`NombreGrupo`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `USUARIO` (`login`,`password`,`DNI`, `Nombre`, `Apellidos`, `Correo`, `Direccion`, `Telefono`) 
VALUES ('admin', 'admin', '60137338C', 'admin', 'admin', 'admin@admin.com', 'Calle del Administrador nº 1', '612612612');

INSERT INTO `GRUPO` (`IdGrupo`,`NombreGrupo`,`DescripGrupo`) 
VALUES ('1234', 'IU SPARTANS', 'aljksdfhajklsdfh');

