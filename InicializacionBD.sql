/*Script que sirve para introducir datos de prueba en la aplicación
18/12/2017 por IU SPARTANS*/

INSERT INTO GRUPO (
            IdGrupo,
            NombreGrupo,
            DescripGrupo)
            VALUES (
            'Admin',
            'Administrador',
            'Grupo con permisos totales dentro de la aplicacion'
            );
/*Insercion del grupo de alumnos*/
INSERT INTO GRUPO (
            IdGrupo,
            NombreGrupo,
            DescripGrupo)
            VALUES (
            'Alumnos',
            'Alumnos',
            'El usuario mas basico de la aplicacion, con permisos muy limitados'
            );
/*Insercion de un usuario admin por defecto para poder manipular la configuracion de la aplicacion*/
INSERT INTO USUARIO (
					login,
					password,
					DNI,
					Nombre,
					Apellidos,
					Correo,
					Direccion,
					Telefono)
						VALUES (
							'admin',
					'e25d7c6cd66f11492b040391ea0b895a',
							'12345678Z',
							'Admin',
							'Admin',
							'admin@admin.com',
							'adminitracion',
							'666666666');
/*Insercion de usuario admin en el grupo de adminitradores*/
INSERT INTO USU_GRUPO
                                            (
                                            login,
                                            IdGrupo)
                                            VALUES (
                                            'admin',
                                            'Admin');

/*Insercion de Funcionalidades*/
INSERT INTO FUNCIONALIDAD
                        (
                        IdFuncionalidad,
                        NombreFuncionalidad,
                        DescripFuncionalidad)
                        VALUES
('User','Gestion Usuarios','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Usuarios'),
('Perm','Gestion de Permisos','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Permisos'),
('Jobs','Gestion de Trabajos','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Trabajos'),
('Group','Gestion de Grupos','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Grupos'),
('UsuGru','Gestion de Usuarios por Grupo','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con la asignacion de usuarios a grupos'),
('Action','Gestion de Acciones','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Acciones'),
('Func','Gestion de Funcionalidades','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Funcionalides'),
('Hist','Gestion de Historias','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Historias'),
('Nota','Gestion de Notas','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Notas'),
('Eval','Gestion de Evaluaciones','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Evaluaciones'),
('Entre','Gestion de Entregas','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Entregas'),
('FunAct','Gestion de Funcion_Accion','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con los pares Funcionalidad_accion');

/*Insercion de Acciones*/


INSERT INTO ACCION(IdAccion,NombreAccion,DescripAccion)
  VALUES
('Add','Añadir','Esta Accion es la encargada de añadir las entidades asociadas a la funcionalidad'),
('Edit','Editar','Esta Accion es la encargada de editar las entidades asociadas a la funcionalidad'),
('Delete','Borrar','Esta Accion es la encargada de borrar las entidades asociadas a la funcionalidad'),
('Show','Visualizar','Esta Accion es la encargada de visualizar las entidades asociadas a la funcionalidad'),
('Search','Buscar','Esta Accion es la encargada de buscar las entidades especificadas asociadas a la funcionalidad'),
('Gest','Gestionar','Esta Accion es la encargada de gestionar las entidades especificadas asociadas a la funcionalidad');

/*edit de entregas/
showall de entregas(solo sus entregas)/
showall de notas(sus)/
showall de resultados(suyos)/
showall y edit de las evaluaciones que tiene que corregir
*/

INSERT INTO `PERMISO` (IdGrupo,IdFuncionalidad,IdAccion) VALUES
('Alumnos','Entre','Show'),
('Alumnos','Notas','show'),
('Alumnos','ResEt','Show'),
('Alumnos','ResQa','Show'),
('Alumnos','Eval','Show'),
('Alumnos','Eval','Edit');

INSERT INTO `FUNC_ACCION` (IdFuncionalidad, IdAccion) VALUES

('ResEt','Show'),
('ResQa','Show'),

('FunAct', 'Add'),
('FunAct', 'Gest'),

('Asig_Qa', 'Add'),
('Asig_Qa', 'Delete'),
('Asig_Qa', 'Edit'),
('Asig_Qa', 'Search'),
('Asig_Qa', 'Show'),

('Action', 'Add'),
('Action', 'Delete'),
('Action', 'Edit'),
('Action', 'Search'),
('Action', 'Show'),

('Entre', 'Add'),
('Entre', 'Delete'),
('Entre', 'Edit'),
('Entre', 'Search'),
('Entre', 'Show'),

('Eval', 'Add'),
('Eval', 'Delete'),
('Eval', 'Edit'),
('Eval', 'Search'),
('Eval', 'Show'),

('Func', 'Add'),
('Func', 'Delete'),
('Func', 'Edit'),
('Func', 'Search'),
('Func', 'Show'),

('Group', 'Add'),
('Group', 'Delete'),
('Group', 'Edit'),
('Group', 'Search'),
('Group', 'Show'),

('Hist', 'Add'),
('Hist', 'Delete'),
('Hist', 'Edit'),
('Hist', 'Search'),
('Hist', 'Show'),

('Jobs', 'Add'),
('Jobs', 'Delete'),
('Jobs', 'Edit'),
('Jobs', 'Search'),
('Jobs', 'Show'),

('Nota', 'Add'),
('Nota', 'Delete'),
('Nota', 'Edit'),
('Nota', 'Search'),
('Nota', 'Show'),

('Perm', 'Add'),
('Perm', 'Search'),
('Perm', 'Show'),

('UsuGru', 'Add'),
('UsuGru', 'Delete'),
('UsuGru', 'Edit'),
('UsuGru', 'Search'),
('UsuGru', 'Show'),

('Usu', 'Add'),
('Usu', 'Delete'),
('Usu', 'Edit'),
('Usu', 'Search'),
('Usu', 'Show');




INSERT INTO `USUARIO` (`login`, `password`, `DNI`, `Nombre`, `Apellidos`, `Correo`, `Direccion`, `Telefono`) VALUES
('usu1', 'e25d7c6cd66f11492b040391ea0b895a', '62698744P', 'usu1', 'usu1', 'usu1@usu1.com', 'Dir-usu1', '666666666'),
('usu10', 'e25d7c6cd66f11492b040391ea0b895a', '32615542R', 'usu10', 'usu10', 'usu10@usu10.com', 'Dir-usu10', '666666666'),
('usu11', 'e25d7c6cd66f11492b040391ea0b895a', '94860322L', 'usu11', 'usu11', 'usu11@usu11.com', 'Dir-usu11', '666666666'),
('usu12', 'e25d7c6cd66f11492b040391ea0b895a', '16178576P', 'usu12', 'usu12', 'usu12@usu12.com', 'Dir-usu12', '666666666'),
('usu13', 'e25d7c6cd66f11492b040391ea0b895a', '30835964W', 'usu13', 'usu13', 'usu13@usu13.com', 'Dir-usu13', '666666666'),
('usu14', 'e25d7c6cd66f11492b040391ea0b895a', '29829283P', 'usu14', 'usu14', 'usu14@usu14.com', 'Dir-usu14', '666666666'),
('usu15', 'e25d7c6cd66f11492b040391ea0b895a', '73375715B', 'usu15', 'usu15', 'usu15@usu15.com', 'Dir-usu15', '666666666'),
('usu16', 'e25d7c6cd66f11492b040391ea0b895a', '60243472D', 'usu16', 'usu16', 'usu16@usu16.com', 'Dir-usu16', '666666666'),
('usu17', 'e25d7c6cd66f11492b040391ea0b895a', '87693394Y', 'usu17', 'usu17', 'usu17@usu17.com', 'Dir-usu17', '666666666'),
('usu18', 'e25d7c6cd66f11492b040391ea0b895a', '71575286E', 'usu18', 'usu18', 'usu18@usu18.com', 'Dir-usu18', '666666666'),
('usu19', 'e25d7c6cd66f11492b040391ea0b895a', '67206277R', 'usu19', 'usu19', 'usu19@usu19.com', 'Dir-usu19', '666666666'),
('usu2', 'e25d7c6cd66f11492b040391ea0b895a', '31028902Q', 'usu2', 'usu2', 'usu2@usu2.com', 'Dir-usu2', '666666666'),
('usu20', 'e25d7c6cd66f11492b040391ea0b895a', '08544326X', 'usu20', 'usu20', 'usu20@usu20.com', 'Dir-usu20', '666666666'),
('usu21', 'e25d7c6cd66f11492b040391ea0b895a', '98310559A', 'usu21', 'usu21', 'usu21@usu21.com', 'Dir-usu21', '666666666'),
('usu22', 'e25d7c6cd66f11492b040391ea0b895a', '57624654V', 'usu22', 'usu22', 'usu22@usu22.com', 'Dir-usu22', '666666666'),
('usu23', 'e25d7c6cd66f11492b040391ea0b895a', '21391393J', 'usu23', 'usu23', 'usu23@usu23.com', 'Dir-usu23', '666666666'),
('usu24', 'e25d7c6cd66f11492b040391ea0b895a', '93679340H', 'usu24', 'usu24', 'usu24@usu24.com', 'Dir-usu24', '666666666'),
('usu25', 'e25d7c6cd66f11492b040391ea0b895a', '86897287K', 'usu25', 'usu25', 'usu25@usu25.com', 'Dir-usu25', '666666666'),
('usu26', 'e25d7c6cd66f11492b040391ea0b895a', '43486252Z', 'usu26', 'usu26', 'usu26@usu26.com', 'Dir-usu26', '666666666'),
('usu27', 'e25d7c6cd66f11492b040391ea0b895a', '80872941L', 'usu27', 'usu27', 'usu27@usu27.com', 'Dir-usu27', '666666666'),
('usu28', 'e25d7c6cd66f11492b040391ea0b895a', '70433372N', 'usu28', 'usu28', 'usu28@usu28.com', 'Dir-usu28', '666666666'),
('usu29', 'e25d7c6cd66f11492b040391ea0b895a', '35437504R', 'usu29', 'usu29', 'usu29@usu29.com', 'Dir-usu29', '666666666'),
('usu3', 'e25d7c6cd66f11492b040391ea0b895a', '37846864L', 'usu3', 'usu3', 'usu2@usu3.com', 'Dir-usu3', '666666666'),
('usu30', 'e25d7c6cd66f11492b040391ea0b895a', '52395384G', 'usu30', 'usu30', 'usu30@usu30.com', 'Dir-usu30', '666666666');


INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu1','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu2','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu3','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu10','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu11','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu12','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu13','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu14','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu15','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu16','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu17','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu18','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu19','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu20','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu21','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu22','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu23','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu24','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu25','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu26','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu27','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu28','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu29','Alumno');
INSERT INTO `USU_GRUPO`(`login`,`IdGrupo`) VALUES ('usu30','Alumno');


/*Insercion dde un trabajo*/
INSERT INTO TRABAJO (IdTrabajo,NombreTrabajo,FechaIniTrabajo,FechaFinTrabajo,PorcentajeNota)
						VALUES (
							'ET1',
							'Entrega uno',
							'2017-08-14',
							'2017-08-21',
							'20');
INSERT INTO TRABAJO (IdTrabajo,NombreTrabajo,FechaIniTrabajo,FechaFinTrabajo,PorcentajeNota)
						VALUES (
							'QA1',
							'QA uno',
							'2017-08-22',
							'2017-08-28',
							'5');
/*Insercion de Entregas de Prueba*/
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu1',
							'ET1',
							'A',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu2',
							'ET1',
							'B',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu3',
							'ET1',
							'C',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu4',
							'ET1',
							'D',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu5',
							'ET1',
							'E',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu6',
							'ET1',
							'F',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu7',
							'ET1',
							'G',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu8',
							'ET1',
							'H',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu9',
							'ET1',
							'I',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu10',
							'ET1',
							'J',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu11',
							'ET1',
							'k',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu12',
							'ET1',
							'L',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu13',
							'ET1',
							'M',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu14',
							'ET1',
							'N',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu15',
							'ET1',
							'NH',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu16',
							'ET1',
							'O',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu17',
							'ET1',
							'P',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu18',
							'ET1',
							'Q',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu19',
							'ET1',
							'R',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu20',
							'ET1',
							'S',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu21',
							'ET1',
							'T',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu22',
							'ET1',
							'U',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu23',
							'ET1',
							'V',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu24',
							'ET1',
							'W',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu25',
							'ET1',
							'X',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu26',
							'ET1',
							'Y',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu27',
							'ET1',
							'Z',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu28',
							'ET1',
							'AA',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu29',
							'ET1',
							'AB',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'usu30',
							'ET1',
							'AC',
							'20','ruta');

/*Insercion Historias de Prueba*/
INSERT INTO HISTORIA (IdTrabajo,IdHistoria,TextoHistoria)
						VALUES (
							'ET1',
							'1',
							'Pedazo Texto 1');
INSERT INTO HISTORIA (IdTrabajo,IdHistoria,TextoHistoria)
						VALUES (
							'ET1',
							'2',
							'Pedazo Texto 2');
INSERT INTO HISTORIA (IdTrabajo,IdHistoria,TextoHistoria)
						VALUES (
							'ET1',
							'3',
							'Pedazo Texto 3');
INSERT INTO HISTORIA (IdTrabajo,IdHistoria,TextoHistoria)
						VALUES (
							'ET1',
							'4',
							'Pedazo Texto 4');
INSERT INTO HISTORIA (IdTrabajo,IdHistoria,TextoHistoria)
						VALUES (
							'ET1',
							'5',
							'Pedazo Texto 5');