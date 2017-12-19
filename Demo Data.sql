INSERT INTO `USUARIO` (`login`, `password`, `DNI`, `Nombre`, `Apellidos`, `Correo`, `Direccion`, `Telefono`) VALUES
('Usu1', 'e25d7c6cd66f11492b040391ea0b895a', '62698744P', 'Usu1', 'Usu1', 'Usu1@Usu1.com', 'Dir-Usu1', '666666666'),
('Usu10', 'e25d7c6cd66f11492b040391ea0b895a', '32615542R', 'Usu10', 'Usu10', 'Usu10@Usu10.com', 'Dir-Usu10', '666666666'),
('Usu11', 'e25d7c6cd66f11492b040391ea0b895a', '94860322L', 'Usu11', 'Usu11', 'Usu11@Usu11.com', 'Dir-Usu11', '666666666'),
('Usu12', 'e25d7c6cd66f11492b040391ea0b895a', '16178576P', 'Usu12', 'Usu12', 'Usu12@Usu12.com', 'Dir-Usu12', '666666666'),
('Usu13', 'e25d7c6cd66f11492b040391ea0b895a', '30835964W', 'Usu13', 'Usu13', 'Usu13@Usu13.com', 'Dir-Usu13', '666666666'),
('Usu14', 'e25d7c6cd66f11492b040391ea0b895a', '29829283P', 'Usu14', 'Usu14', 'Usu14@Usu14.com', 'Dir-Usu14', '666666666'),
('Usu15', 'e25d7c6cd66f11492b040391ea0b895a', '73375715B', 'Usu15', 'Usu15', 'Usu15@Usu15.com', 'Dir-Usu15', '666666666'),
('Usu16', 'e25d7c6cd66f11492b040391ea0b895a', '60243472D', 'Usu16', 'Usu16', 'Usu16@Usu16.com', 'Dir-Usu16', '666666666'),
('Usu17', 'e25d7c6cd66f11492b040391ea0b895a', '87693394Y', 'Usu17', 'Usu17', 'Usu17@Usu17.com', 'Dir-Usu17', '666666666'),
('Usu18', 'e25d7c6cd66f11492b040391ea0b895a', '71575286E', 'Usu18', 'Usu18', 'Usu18@Usu18.com', 'Dir-Usu18', '666666666'),
('Usu19', 'e25d7c6cd66f11492b040391ea0b895a', '67206277R', 'Usu19', 'Usu19', 'Usu19@Usu19.com', 'Dir-Usu19', '666666666'),
('Usu2', 'e25d7c6cd66f11492b040391ea0b895a', '31028902Q', 'Usu2', 'Usu2', 'Usu2@Usu2.com', 'Dir-Usu2', '666666666'),
('Usu20', 'e25d7c6cd66f11492b040391ea0b895a', '08544326X', 'Usu20', 'Usu20', 'Usu20@Usu20.com', 'Dir-Usu20', '666666666'),
('Usu21', 'e25d7c6cd66f11492b040391ea0b895a', '98310559A', 'Usu21', 'Usu21', 'Usu21@Usu21.com', 'Dir-Usu21', '666666666'),
('Usu22', 'e25d7c6cd66f11492b040391ea0b895a', '57624654V', 'Usu22', 'Usu22', 'Usu22@Usu22.com', 'Dir-Usu22', '666666666'),
('Usu23', 'e25d7c6cd66f11492b040391ea0b895a', '21391393J', 'Usu23', 'Usu23', 'Usu23@Usu23.com', 'Dir-Usu23', '666666666'),
('Usu24', 'e25d7c6cd66f11492b040391ea0b895a', '93679340H', 'Usu24', 'Usu24', 'Usu24@Usu24.com', 'Dir-Usu24', '666666666'),
('Usu25', 'e25d7c6cd66f11492b040391ea0b895a', '86897287K', 'Usu25', 'Usu25', 'Usu25@Usu25.com', 'Dir-Usu25', '666666666'),
('Usu26', 'e25d7c6cd66f11492b040391ea0b895a', '43486252Z', 'Usu26', 'Usu26', 'Usu26@Usu26.com', 'Dir-Usu26', '666666666'),
('Usu27', 'e25d7c6cd66f11492b040391ea0b895a', '80872941L', 'Usu27', 'Usu27', 'Usu27@Usu27.com', 'Dir-Usu27', '666666666'),
('Usu28', 'e25d7c6cd66f11492b040391ea0b895a', '70433372N', 'Usu28', 'Usu28', 'Usu28@Usu28.com', 'Dir-Usu28', '666666666'),
('Usu29', 'e25d7c6cd66f11492b040391ea0b895a', '35437504R', 'Usu29', 'Usu29', 'Usu29@Usu29.com', 'Dir-Usu29', '666666666'),
('Usu3', 'e25d7c6cd66f11492b040391ea0b895a', '37846864L', 'Usu3', 'Usu3', 'Usu2@Usu3.com', 'Dir-Usu3', '666666666'),
('Usu30', 'e25d7c6cd66f11492b040391ea0b895a', '52395384G', 'Usu30', 'Usu30', 'Usu30@Usu30.com', 'Dir-Usu30', '666666666');

/*Insercion dde un trabajo*/
INSERT INTO TRABAJO (IdTrabajo,NombreTrabajo,FechaIniTrabajo,FechaFinTrabajo,PorcentajeNota)
						VALUES (
							'ET1',
							'Entrega 1',
							'20/08/2017',
							'21/08/2017',
							'20');
/*Insercion de Entregas de Prueba*/
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu1',
							'ET1',
							'A',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu2',
							'ET1',
							'B',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu3',
							'ET1',
							'C',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu4',
							'ET1',
							'D',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu5',
							'ET1',
							'E',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu6',
							'ET1',
							'F',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu7',
							'ET1',
							'G',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu8',
							'ET1',
							'H',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu9',
							'ET1',
							'I',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu10',
							'ET1',
							'J',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu11',
							'ET1',
							'k',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu12',
							'ET1',
							'L',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu13',
							'ET1',
							'M',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu14',
							'ET1',
							'N',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu15',
							'ET1',
							'NH',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu16',
							'ET1',
							'O',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu17',
							'ET1',
							'P',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu18',
							'ET1',
							'Q',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu19',
							'ET1',
							'R',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu20',
							'ET1',
							'S',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu21',
							'ET1',
							'T',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu22',
							'ET1',
							'U',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu23',
							'ET1',
							'V',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu24',
							'ET1',
							'W',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu25',
							'ET1',
							'X',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu26',
							'ET1',
							'Y',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu27',
							'ET1',
							'Z',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu28',
							'ET1',
							'AA',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu29',
							'ET1',
							'AB',
							'20','ruta');
INSERT INTO ENTREGA (login,IdTrabajo,
					Alias,Horas,Ruta)
						VALUES (
							'Usu30',
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