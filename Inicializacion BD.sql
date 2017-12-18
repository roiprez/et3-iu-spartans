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
                        VALUES (
('User','Gestion Usuarios','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Usuarios'),
('Perm','Gestion de Permisos','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Permisos'),
('Jobs','Gestion de Trabajos','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Trabajos'),
('Group','Gestion de Grupos','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Grupos'),
('Action','Gestion de Acciones','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Acciones'),
('Func','Gestion de Funcionalidades','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Funcionalides'),
('Hist','Gestion de Historias','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Historias'),
('Nota','Gestion de Notas','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Notas'),
('Eval','Gestion de Evaluaciones','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Evaluaciones'),
('Entre','Gestion de Entregas','Esta funcionalidad es la encargada de la gestion de todo lo relacionado con Entregas'));

/*Insercion de Acciones*/
INSERT INTO ACCION(
                  IdAccion,
                  
                  )
                  Values()

