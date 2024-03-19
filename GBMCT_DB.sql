USE gbmct_db;

SELECT * FROM InventarioCintas;
SELECT * FROM UserDB;

DROP TABLE InventarioCintas;

CREATE TABLE InventarioCintas 
(
    NumeroCinta	INT,
    NombreCliente VARCHAR(512),
    TipoCinta VARCHAR(512),
    Descripcion	VARCHAR(512),
    CodigoCinta	VARCHAR(512),
    EnCintoteca	VARCHAR(512)
);

CREATE TABLE UserDB 
(
    UserID	INT,
    UserName VARCHAR(512),
    Pssw VARCHAR(512)
);

INSERT INTO UserDB (UserID, UserName, Pssw) VALUES
	('1', 'Operador', 'Odc4321');

INSERT INTO InventarioCintas (NumeroCinta, NombreCliente, TipoCinta, Descripcion, CodigoCinta, EnCintoteca) VALUES
	('1', 'BAC', 'Universal Cleaning Cartridge', 'CINTA DE LIMPIEZA', 'CINTA BAC - 01', 'Y'),
	('2', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CINTA BAC - 02', 'Y'),
	('3', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CINTA BAC - 03', 'Y'),
	('4', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CINTA BAC - 04', 'Y'),
	('5', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CINTA BAC - 05', 'Y'),
	('6', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00111092018LTO6498', 'Y'),
	('7', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00111092018LTO6499', 'Y'),
	('8', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00112092018LTO6500', 'Y'),
	('9', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00112092018LTO6501', 'Y'),
	('10', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00113092018LTO6502', 'Y'),
	('11', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00113092018LTO6503', 'Y'),
	('12', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00114092018LTO6505', 'Y'),
	('13', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00114092018LTO6506', 'Y'),
	('14', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00114092018LTO6507', 'Y'),
	('15', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'CLI00114092018LTO6508', 'Y'),
	('16', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO410', 'Y'),
	('17', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO411', 'Y'),
	('18', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO412', 'Y'),
	('19', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO413', 'Y'),
	('20', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO414', 'Y'),
	('21', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO42', 'Y'),
	('22', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO46', 'Y'),
	('23', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO47', 'Y'),
	('24', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO48', 'Y'),
	('25', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00914082019LTO49', 'Y'),
	('26', 'BAC', 'LTO 4', 'CINTA LTO 4 / 1.6TB', 'CLI00921082019LTO415', 'Y'),
	('27', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('28', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('29', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('30', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('31', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('32', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('33', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('34', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.50TB', 'NONE', 'Y'),
	('35', 'BAC', 'LTO 6 ', 'CINTA LTO 6 / 6.25TB', 'U61441', 'Y'),
	('36', 'BAC', 'LTO 6 ', 'CINTA LTO 6 / 6.25TB', 'U61442', 'Y'),
	('37', 'BAC', 'LTO 6 ', 'CINTA LTO 6 / 6.25TB', 'U61558', 'Y'),
	('38', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U61714', 'Y'),
	('39', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U61716', 'Y'),
	('40', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U61804', 'Y'),
	('41', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62094', 'Y'),
	('42', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62094', 'Y'),
	('43', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62096', 'Y'),
	('44', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62098', 'Y'),
	('45', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62101', 'Y'),
	('46', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62313', 'Y'),
	('47', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62519', 'Y'),
	('48', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62520', 'Y'),
	('49', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62521', 'Y'),
	('50', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62606', 'Y'),
	('51', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62779', 'Y'),
	('52', 'BAC', 'LTO 6', 'CINTA LTO 6 / 6.25TB', 'U62780', 'Y'),
	('53', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70108', 'Y'),
	('54', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70146', 'Y'),
	('55', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70147', 'Y'),
	('56', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70148', 'Y'),
	('57', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70149', 'Y'),
	('58', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70150', 'Y'),
	('59', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70154', 'Y'),
	('60', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70156', 'Y'),
	('61', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70157', 'Y'),
	('62', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70158', 'Y'),
	('63', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70160', 'Y'),
	('64', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70316', 'Y'),
	('65', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70317', 'Y'),
	('66', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70318', 'Y'),
	('67', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70320', 'Y'),
	('68', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70321', 'Y'),
	('69', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70322', 'Y'),
	('70', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70323', 'Y'),
	('71', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70324', 'Y'),
	('72', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70325', 'Y'),
	('73', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70326', 'Y'),
	('74', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70328', 'Y'),
	('75', 'BAC', 'LTO 7', 'CINTA LTO 7 / 15TB', 'U70329', 'Y'),
	('76', 'CISA', 'LTO 7', 'CINTA LTO 7 / 15TB', 'SEM3BFULL', 'Y'),
	('77', 'CISA', 'LTO 7', 'CINTA LTO 7 / 15TB', 'SEM5BFULL', 'Y'),
	('78', 'ELCATEX', 'LTO 8', 'CINTA LTO 8 / 12TB', 'BACKUP ELCATEX FULL 2023/12/23', 'Y'),
	('79', 'ELCATEX', 'LTO 8', 'CINTA LTO 8 / 12TB', 'BACKUP_Elcatex_Full_20231229', 'Y'),
	('80', 'ELCATEX', 'LTO 5', 'CINTA LTO 5 / 3TB', 'BAKUP ELCATEX AS400 22NOV2016', 'Y'),
	('81', 'ELCATEX', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'CINTA USADA BACKUP', 'Y'),
	('82', 'ELCATEX', 'LTO 7', 'CINTA LTO 7 / 6TB', 'ELCATEX 20/08/2023', 'Y'),
	('83', 'ELCATEX', 'LTO 5', 'CINTA LTO 5 / 3TB', 'Elcatex 617 lib', 'Y'),
	('84', 'ELCATEX', 'LTO 8', 'CINTA LTO 8 / 12TB', 'FULL BACKUP ELCATEX 2024/02/10', 'Y'),
	('85', 'ELCATEX', 'LTO 8', 'CINTA LTO 8 / 12TB', 'INCREMENTAL #1', 'Y'),
	('86', 'ELCATEX', 'LTO 8', 'CINTA LTO 8 / 12TB', 'INCREMENTAL #2', 'Y'),
	('87', 'ELCATEX', 'LTO 8', 'CINTA LTO 8 / 12TB', 'REPLICA OP21 17/7/2022', 'Y'),
	('88', 'ELCATEX', 'LTO 5', 'CINTA LTO 5 / 3000GB', 'TIENE UNA NOTA', 'Y'),
	('89', 'FICENSA', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'FICENSA -1', 'Y'),
	('90', 'FICENSA', 'LTO 6', 'CINTA LTO 6 / 2.5TB', 'FICENSA -2', 'Y'),
	('91', 'FICENSA', 'LTO 8', 'CINTA LTO 8 / 12TB', 'Savsys DS 2024', 'Y'),
	('92', 'FICENSA', 'LTO 8', 'CINTA LTO 8 / 12TB', 'Ficensa Desarrollo', 'Y'),
	('93', 'FICENSA', 'LTO 8', 'CINTA LTO 8 / 12TB', 'NONE', 'Y'),
	('94', 'GILDAN', 'LTO 8', 'CINTA LTO 8 / 12TB', 'HOND02L8', 'Y'),
	('95', 'GILDAN', 'LTO 8', 'CINTA LTO 8 / 12TB', 'HOND09L8', 'Y'),
	('96', 'GILDAN', 'LTO 8', 'CINTA LTO 8 / 12TB', 'HOND11L8', 'Y'),
	('97', 'GILDAN', 'LTO 8', 'CINTA LTO 8 / 12TB', 'HOND19L8', 'Y'),
	('98', 'GILDAN', 'LTO 8', 'CINTA LTO 8 / 12TB', 'HOND20L8', 'Y'),
	('99', 'GILDAN', 'LTO 8', 'CINTA LTO 8 / 12TB', 'HOND21L8', 'Y'),
	('100', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ022', 'Y'),
	('101', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ023', 'Y'),
	('102', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ024', 'Y'),
	('103', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ025', 'Y'),
	('104', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ028', 'Y'),
	('105', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ029', 'Y'),
	('106', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ030', 'Y'),
	('107', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJ031', 'Y'),
	('108', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ032', 'Y'),
	('109', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ033', 'Y'),
	('110', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ034', 'Y'),
	('111', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ035', 'Y'),
	('112', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ036', 'Y'),
	('113', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ037', 'Y'),
	('114', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ038', 'Y'),
	('115', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ039', 'Y'),
	('116', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'INJ040', 'Y'),
	('117', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJJRN', 'Y'),
	('118', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJS01', 'Y'),
	('119', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJSVS02', 'Y'),
	('120', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 01', 'Y'),
	('121', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 02', 'Y'),
	('122', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 03', 'Y'),
	('123', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 04', 'Y'),
	('124', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 05', 'Y'),
	('125', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 06', 'Y'),
	('126', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 07', 'Y'),
	('127', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 08', 'Y'),
	('128', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 09', 'Y'),
	('129', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 10', 'Y'),
	('130', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 11', 'Y'),
	('131', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 12', 'Y'),
	('132', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 13', 'Y'),
	('133', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 14', 'Y'),
	('134', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 15', 'Y'),
	('135', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 16', 'Y'),
	('136', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 17', 'Y'),
	('137', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 18', 'Y'),
	('138', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 19', 'Y'),
	('139', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 20', 'Y'),
	('140', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'INJUPEMP 21', 'Y'),
	('141', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'NONE', 'Y'),
	('142', 'INJUPEMP', 'LTO 5', 'CINTA LTO 5 / 3TB', 'SVS012024', 'Y'),
	('143', 'ODEF', 'LTO 8', 'CINTA LTO 8 / 12TB', 'CINTA PRESTAMO', 'Y'),
	('144', 'SEGCON', 'LTO 5', 'CINTA LTO 5 / 1.5TB', 'SEGCON 24/12/2023', 'Y');
