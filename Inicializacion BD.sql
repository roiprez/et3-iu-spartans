/*Insercion del Grupo de Adminitradores*/
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