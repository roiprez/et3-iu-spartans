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
('Entre','Gestion de Entregas','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Entregas');

/*Insercion de Acciones*/


INSERT INTO ACCION(IdAccion,NombreAccion,DescripAccion)
  VALUES
('Add','Añadir','Esta Accion es la encargada de añadir las entidades asociadas a la funcionalidad'),
('Edit','Editar','Esta Accion es la encargada de editar las entidades asociadas a la funcionalidad'),
('Delete','Borrar','Esta Accion es la encargada de borrar las entidades asociadas a la funcionalidad'),
('Show','Visualizar','Esta Accion es la encargada de visualizar las entidades asociadas a la funcionalidad'),
('Search','Buscar','Esta Accion es la encargada de buscar las entidades especificadas asociadas a la funcionalidad');

INSERT INTO `FUNC_ACCION` (`IdFuncionalidad`, `IdAccion`) VALUES
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
('Perm', 'Delete'),
('Perm', 'Edit'),
('Perm', 'Search'),
('Perm', 'Show'),
('User', 'Add'),
('User', 'Delete'),
('User', 'Edit'),
('User', 'Search'),
('User', 'Show');