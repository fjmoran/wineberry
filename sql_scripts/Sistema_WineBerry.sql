/*
 Navicat Premium Data Transfer

 Source Server         : zhi
 Source Server Type    : MySQL
 Source Server Version : 50544
 Source Host           : www.zhi.cl
 Source Database       : Sistema_WineBerry

 Target Server Type    : MySQL
 Target Server Version : 50544
 File Encoding         : utf-8

 Date: 09/26/2015 21:54:51 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `Cliente`
-- ----------------------------
DROP TABLE IF EXISTS `Cliente`;
CREATE TABLE `Cliente` (
  `idCliente` int(10) unsigned NOT NULL,
  `nombreCliente` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'en caso de persona se compone de nombres+Apellido1+Apellido2',
  `nombresCliente` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Para personas son los nombres, para la empresa es la razón social.',
  `Apellido1Cliente` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Apellido2Cliente` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rutCliente` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `telefonoCliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `faxCliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `emailCliente` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `webCliente` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `giroCiente` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activoCliente` tinyint(1) NOT NULL DEFAULT '1',
  `tipoCliente` set('EMPRESA','PERSONA') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'EMPRESA',
  `Usuario_idUsuario` int(10) unsigned NOT NULL,
  `Direccion_idDireccion` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `idCliente_UNIQUE` (`idCliente`),
  UNIQUE KEY `nombreCliente_UNIQUE` (`nombreCliente`),
  UNIQUE KEY `rutCliente_UNIQUE` (`rutCliente`),
  KEY `fk_Cliente_Usuario1_idx` (`Usuario_idUsuario`),
  KEY `fk_Cliente_Direccion1_idx` (`Direccion_idDireccion`),
  CONSTRAINT `fk_Cliente_Direccion1` FOREIGN KEY (`Direccion_idDireccion`) REFERENCES `Direccion` (`idDireccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Se guardan los datos del cliente.';

-- ----------------------------
--  Table structure for `Comuna`
-- ----------------------------
DROP TABLE IF EXISTS `Comuna`;
CREATE TABLE `Comuna` (
  `idComuna` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreComuna` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `codeComuna` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'código de las comunas según gobierno',
  `activoComuna` tinyint(1) NOT NULL DEFAULT '1',
  `Region_idRegion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idComuna`),
  UNIQUE KEY `idComuna_UNIQUE` (`idComuna`),
  KEY `fk_Comuna_Region1_idx` (`Region_idRegion`),
  CONSTRAINT `fk_Comuna_Region1` FOREIGN KEY (`Region_idRegion`) REFERENCES `Region` (`idRegion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Listado de Comunas';

-- ----------------------------
--  Records of `Comuna`
-- ----------------------------
BEGIN;
INSERT INTO `Comuna` VALUES ('1', 'Las Condes', '13114', '1', '13'), ('2', 'Puerto Montt', '10101', '1', '10'), ('3', 'Chonchi', '10203', '1', '10'), ('4', 'Punta Arenas', '12101', '1', '12'), ('5', 'Laguna Blanca', '12102', '1', '12'), ('6', 'RÃ­o Verde', '12103', '1', '12'), ('7', 'San Gregorio', '12104', '1', '12'), ('8', 'Cabo de Hornos', '12201', '1', '12'), ('9', 'AntÃ¡rtica', '12202', '1', '12'), ('10', 'Porvenir', '12301', '1', '12'), ('11', 'Primavera', '12302', '1', '12'), ('12', 'Timaukel', '12303', '1', '12'), ('13', 'Natales', '12401', '1', '12'), ('14', 'Torres del Paine', '12402', '1', '12'), ('15', 'Arica', '15101', '1', '15'), ('18', 'Camarones', '15102', '1', '15'), ('19', 'Putre', '15201', '1', '15'), ('20', 'General Lagos', '15202', '1', '15'), ('21', 'Iquique', '01101', '1', '1'), ('22', 'Alto Hospicio', '01102', '1', '1'), ('23', 'Pozo Almonte', '01401', '1', '1'), ('24', 'CamiÃ±a', '01402', '1', '1'), ('25', 'Colchane', '01403', '1', '1'), ('26', 'Huara', '01404', '1', '1'), ('27', 'Pica', '01405', '1', '1'), ('28', 'Antofagasta', '02101', '1', '2'), ('29', 'Mejillones', '02102', '1', '2'), ('30', 'Sierra Gorda', '02103', '1', '2'), ('31', 'Taltal', '02104', '1', '2'), ('32', 'Calama', '02201', '1', '2'), ('33', 'OllagÃ¼e', '02202', '1', '2'), ('34', 'San Pedro de Atacama', '02203', '1', '2'), ('35', 'Tocopilla', '02301', '1', '2'), ('36', 'MarÃ­a Elena', '02302', '1', '2'), ('37', 'CopiapÃ³', '03101', '1', '3'), ('38', 'Caldera', '03102', '1', '3'), ('39', 'Tierra Amarilla', '03103', '1', '3'), ('41', 'ChaÃ±aral', '03201', '1', '3'), ('42', 'Diego de Almagro', '03202', '1', '3'), ('43', 'Vallenar', '03301', '1', '3'), ('44', 'Alto del Carmen', '03302', '1', '3'), ('45', 'Freirina', '03303', '1', '3'), ('46', 'Huasco', '03304', '1', '3'), ('47', 'La Serena', '04101', '1', '4'), ('48', 'Coquimbo', '04102', '1', '4'), ('49', 'Andacollo', '04103', '1', '4'), ('50', 'La Higuera', '04104', '1', '4'), ('51', 'Paiguano', '04105', '1', '4'), ('52', 'VicuÃ±a', '04106', '1', '4'), ('53', 'Illapel', '04201', '1', '4'), ('54', 'Canela', '04202', '1', '4'), ('55', 'Los Vilos', '04203', '1', '4'), ('56', 'Salamanca', '04204', '1', '4'), ('57', 'Ovalle', '04301', '1', '4'), ('58', 'CombarbalÃ¡', '04302', '1', '4'), ('59', 'Monte Patria', '04303', '1', '4'), ('60', 'Punitaqui', '04304', '1', '4'), ('61', 'RÃ­o Hurtado', '04305', '1', '4'), ('62', 'ValparaÃ­so', '05101', '1', '5'), ('63', 'Casablanca', '05102', '1', '5'), ('64', 'ConcÃ³n', '05103', '1', '5'), ('65', 'Juan FernÃ¡ndez', '05104', '1', '5'), ('66', 'PuchuncavÃ­', '05105', '1', '5'), ('67', 'Quintero', '05107', '1', '5'), ('68', 'ViÃ±a del Mar', '05109', '1', '5'), ('69', 'Isla de Pascua', '05201', '1', '5'), ('70', 'Los Andes', '05301', '1', '5'), ('71', 'Calle Larga', '05302', '1', '5'), ('72', 'Rinconada', '05303', '1', '5'), ('73', 'San Esteban', '05304', '1', '5'), ('74', 'La Ligua', '05401', '1', '5'), ('75', 'Cabildo', '05402', '1', '5'), ('76', 'Papudo', '05403', '1', '5'), ('77', 'Petorca', '05404', '1', '5'), ('78', 'Zapallar', '05405', '1', '5'), ('79', 'Quillota', '05501', '1', '5'), ('80', 'Calera', '05502', '1', '5'), ('81', 'Hijuelas', '05503', '1', '5'), ('82', 'La Cruz', '05504', '1', '5'), ('83', 'Nogales', '05506', '1', '5'), ('84', 'San Antonio', '05601', '1', '5'), ('85', 'Algarrobo', '05602', '1', '5'), ('86', 'Cartagena', '05603', '1', '5'), ('87', 'El Quisco', '05604', '1', '5'), ('88', 'El Tabo', '05605', '1', '5'), ('89', 'Santo Domingo', '05606', '1', '5'), ('90', 'San Felipe', '05701', '1', '5'), ('91', 'Catemu', '05702', '1', '5'), ('92', 'Llaillay', '05703', '1', '5'), ('93', 'Panquehue', '05704', '1', '5'), ('94', 'Putaendo', '05705', '1', '5'), ('95', 'Santa MarÃ­a', '05706', '1', '5'), ('96', 'QuilpuÃ©', '05801', '1', '5'), ('97', 'Limache', '05802', '1', '5'), ('98', 'OlmuÃ©', '05803', '1', '5'), ('99', 'Villa Alemana', '05804', '1', '5'), ('100', 'Rancagua', '06101', '1', '6'), ('101', 'Codegua', '06102', '1', '6'), ('102', 'Coinco', '06103', '1', '6'), ('103', 'Coltauco', '06104', '1', '6'), ('104', 'DoÃ±ihue', '06105', '1', '6'), ('105', 'Graneros', '06106', '1', '6'), ('106', 'Las Cabras', '06107', '1', '6'), ('107', 'MachalÃ­', '06108', '1', '6'), ('108', 'Malloa', '06109', '1', '6'), ('109', 'Mostazal', '06110', '1', '6'), ('110', 'Olivar', '06111', '1', '6'), ('111', 'Peumo', '06112', '1', '6'), ('112', 'Pichidegua', '06113', '1', '6'), ('113', 'Quinta de Tilcoco', '06114', '1', '6'), ('114', 'Rengo', '06115', '1', '6'), ('115', 'RequÃ­noa', '06116', '1', '6'), ('116', 'San Vicente', '06117', '1', '6'), ('117', 'Pichilemu', '06201', '1', '6'), ('118', 'La Estrella', '06202', '1', '6'), ('119', 'Litueche', '06203', '1', '6'), ('120', 'Marchihue', '06204', '1', '6'), ('121', 'Navidad', '06205', '1', '6'), ('122', 'Paredones', '06206', '1', '6'), ('123', 'San Fernando', '06301', '1', '6'), ('124', 'ChÃ©pica', '06302', '1', '6'), ('125', 'Chimbarongo', '06303', '1', '6'), ('126', 'Lolol', '06304', '1', '6'), ('127', 'Nancagua', '06305', '1', '6'), ('128', 'Palmilla', '06306', '1', '6'), ('129', 'Peralillo', '06307', '1', '6'), ('130', 'Placilla', '06308', '1', '6'), ('131', 'Pumanque', '06309', '1', '6'), ('132', 'Santa Cruz', '06310', '1', '6'), ('133', 'Talca', '07101', '1', '7'), ('134', 'ConstituciÃ³n', '07102', '1', '7'), ('135', 'Curepto', '07103', '1', '7'), ('136', 'Empedrado', '07104', '1', '7'), ('137', 'Maule', '07105', '1', '7'), ('138', 'Pelarco', '07106', '1', '7'), ('139', 'Pencahue', '07107', '1', '7'), ('140', 'RÃ­o Claro', '07108', '1', '7'), ('141', 'San Clemente', '07109', '1', '7'), ('142', 'San Rafael', '07110', '1', '7'), ('143', 'Cauquenes', '07201', '1', '7'), ('144', 'Chanco', '07202', '1', '7'), ('145', 'Pelluhue', '07203', '1', '7'), ('146', 'CuricÃ³', '07301', '1', '7'), ('147', 'HualaÃ±Ã©', '07302', '1', '7'), ('148', 'LicantÃ©n', '07303', '1', '7'), ('149', 'Molina', '07304', '1', '7'), ('150', 'Rauco', '07305', '1', '7'), ('151', 'Romeral', '07306', '1', '7'), ('152', 'Sagrada Familia', '07307', '1', '7'), ('153', 'Teno', '07308', '1', '7'), ('154', 'VichuquÃ©n', '07309', '1', '7'), ('155', 'Linares', '07401', '1', '7'), ('156', 'ColbÃºn', '07402', '1', '7'), ('157', 'LongavÃ­', '07403', '1', '7'), ('158', 'Parral', '07404', '1', '7'), ('159', 'Retiro', '07405', '1', '7'), ('160', 'San Javier', '07406', '1', '7'), ('161', 'Villa Alegre', '07407', '1', '7'), ('162', 'Yerbas Buenas', '07408', '1', '7'), ('163', 'ConcepciÃ³n', '08101', '1', '8'), ('164', 'Coronel', '08102', '1', '8'), ('165', 'Chiguayante', '08103', '1', '8'), ('166', 'Florida', '08104', '1', '8'), ('167', 'Hualqui', '08105', '1', '8'), ('168', 'Lota', '08106', '1', '8'), ('169', 'Penco', '08107', '1', '8'), ('170', 'San Pedro de la Paz', '08108', '1', '8'), ('171', 'Santa Juana', '08109', '1', '8'), ('172', 'Talcahuano', '08110', '1', '8'), ('173', 'TomÃ©', '08111', '1', '8'), ('174', 'HualpÃ©n', '08112', '1', '8'), ('175', 'Lebu', '08201', '1', '8'), ('176', 'Arauco', '08202', '1', '8'), ('177', 'CaÃ±ete', '08203', '1', '8'), ('178', 'Contulmo', '08204', '1', '8'), ('179', 'Curanilahue', '08205', '1', '8'), ('180', 'Los Ãlamos', '08206', '1', '8'), ('181', 'TirÃºa', '08207', '1', '8'), ('182', 'Los Ãngeles', '08301', '1', '8'), ('183', 'Antuco', '08302', '1', '8'), ('184', 'Cabrero', '08303', '1', '8'), ('185', 'Laja', '08304', '1', '8'), ('186', 'MulchÃ©n', '08305', '1', '8'), ('187', 'Nacimiento', '08306', '1', '8'), ('188', 'Negrete', '08307', '1', '8'), ('189', 'Quilaco', '08309', '1', '8'), ('190', 'Quilleco', '08309', '1', '8'), ('191', 'San Rosendo', '08310', '1', '8'), ('192', 'Santa BÃ¡rbara', '08311', '1', '8'), ('193', 'Tucapel', '08312', '1', '8'), ('194', 'Yumbel', '08313', '1', '8'), ('195', 'Alto BiobÃ­o', '08314', '1', '8'), ('196', 'ChillÃ¡n', '08401', '1', '8'), ('197', 'Bulnes', '08402', '1', '8'), ('198', 'Cobquecura', '08403', '1', '8'), ('199', 'Coelemu', '08404', '1', '8'), ('200', 'Coihueco', '08405', '1', '8'), ('201', 'ChillÃ¡n Viejo', '08406', '1', '8'), ('202', 'El Carmen', '08407', '1', '8'), ('203', 'Ninhue', '08408', '1', '8'), ('204', 'Ã‘iquÃ©n', '08409', '1', '8'), ('205', 'Pemuco', '08410', '1', '8'), ('206', 'Pinto', '08411', '1', '8'), ('207', 'Portezuelo', '08412', '1', '8'), ('208', 'QuillÃ³n', '08413', '1', '8'), ('209', 'Quirihue', '08414', '1', '8'), ('210', 'RÃ¡nquil', '08415', '1', '8'), ('211', 'San Carlos', '08416', '1', '8'), ('212', 'San FabiÃ¡n', '08417', '1', '8'), ('213', 'San Ignacio', '08418', '1', '8'), ('214', 'San NicolÃ¡s', '08419', '1', '8'), ('215', 'Treguaco', '08420', '1', '8'), ('216', 'Yungay', '08421', '1', '8'), ('217', 'Temuco', '09101', '1', '9'), ('218', 'Carahue', '09102', '1', '9'), ('219', 'Cunco', '09103', '1', '9'), ('220', 'Curarrehue', '09104', '1', '9'), ('221', 'Freire', '09105', '1', '9'), ('222', 'Galvarino', '09106', '1', '9'), ('223', 'Gorbea', '09107', '1', '9'), ('224', 'Lautaro', '09108', '1', '9'), ('225', 'Loncoche', '09109', '1', '9'), ('226', 'Melipeuco', '09110', '1', '9'), ('227', 'Nueva Imperial', '09111', '1', '9'), ('228', 'Padre las Casas', '09112', '1', '9'), ('229', 'Perquenco', '09113', '1', '9'), ('230', 'PitrufquÃ©n', '09114', '1', '9'), ('231', 'PucÃ³n', '09115', '1', '9'), ('232', 'Saavedra', '09116', '1', '9'), ('233', 'Teodoro Schmidt', '09117', '1', '9'), ('234', 'ToltÃ©n', '09118', '1', '9'), ('235', 'VilcÃºn', '09119', '1', '9'), ('236', 'Villarrica', '09120', '1', '9'), ('237', 'Cholchol', '09121', '1', '9'), ('238', 'Angol', '09201', '1', '9'), ('239', 'Collipulli', '09202', '1', '9'), ('240', 'CuracautÃ­n', '09203', '1', '9'), ('241', 'Ercilla', '09204', '1', '9'), ('242', 'Lonquimay', '09205', '1', '9'), ('243', 'Los Sauces', '09206', '1', '9'), ('244', 'Lumaco', '09207', '1', '9'), ('245', 'PurÃ©n', '09208', '1', '9'), ('246', 'Renaico', '09209', '1', '9'), ('247', 'TraiguÃ©n', '09210', '1', '9'), ('248', 'Victoria', '09211', '1', '9'), ('249', 'Valdivia', '14101', '1', '14'), ('250', 'Corral', '14102', '1', '14'), ('251', 'Lanco', '14103', '1', '14'), ('252', 'Los Lagos', '14104', '1', '14'), ('253', 'MÃ¡fil', '14105', '1', '14'), ('254', 'Mariquina', '14106', '1', '14'), ('255', 'Paillaco', '14107', '1', '14'), ('256', 'Panguipulli', '14108', '1', '14'), ('257', 'La UniÃ³n', '14201', '1', '14'), ('258', 'Futrono', '14202', '1', '14'), ('259', 'Lago Ranco', '14203', '1', '14'), ('260', 'RÃ­o Bueno', '14204', '1', '14'), ('261', 'Calbuco', '10102', '1', '10'), ('262', 'CochamÃ³', '10103', '1', '10'), ('263', 'Fresia', '10104', '1', '10'), ('264', 'Frutillar', '10105', '1', '10'), ('265', 'Los Muermos', '10106', '1', '10'), ('266', 'Llanquihue', '10107', '1', '10'), ('267', 'MaullÃ­n', '10108', '1', '10'), ('268', 'Puerto Varas', '10109', '1', '10'), ('269', 'Castro', '10201', '1', '10'), ('270', 'Ancud', '10202', '1', '10'), ('271', 'Curaco de VÃ©lez', '10204', '1', '10'), ('272', 'Dalcahue', '10205', '1', '10'), ('273', 'PuqueldÃ³n', '10206', '1', '10'), ('274', 'QueilÃ©n', '10207', '1', '10'), ('275', 'QuellÃ³n', '10208', '1', '10'), ('276', 'Quemchi', '10209', '1', '10'), ('277', 'Quinchao', '10210', '1', '10'), ('278', 'Osorno', '10301', '1', '10'), ('279', 'Puerto Octay', '10302', '1', '10'), ('280', 'Purranque', '10303', '1', '10'), ('281', 'Puyehue', '10304', '1', '10'), ('282', 'RÃ­o Negro', '10305', '1', '10'), ('283', 'San Juan de la Costa', '10306', '1', '10'), ('284', 'San Pablo', '10307', '1', '10'), ('285', 'ChaitÃ©n', '10401', '1', '10'), ('286', 'FutaleufÃº', '10402', '1', '10'), ('287', 'HualaihuÃ©', '10403', '1', '10'), ('288', 'Palena', '10404', '1', '10'), ('289', 'Coihaique', '11101', '1', '11'), ('290', 'Lago Verde', '11102', '1', '11'), ('291', 'AisÃ©n', '11201', '1', '11'), ('292', 'Cisnes', '11202', '1', '11'), ('293', 'Guaitecas', '11203', '1', '11'), ('294', 'Cochrane', '11301', '1', '11'), ('295', 'O\'Higgins', '11302', '1', '11'), ('296', 'Tortel', '11303', '1', '11'), ('297', 'Chile Chico', '11401', '1', '11'), ('298', 'RÃ­o IbÃ¡Ã±ez', '11402', '1', '11'), ('299', 'Santiago', '13101', '1', '13'), ('300', 'Cerrillos', '13102', '1', '13'), ('301', 'Cerro Navia', '13103', '1', '13'), ('302', 'ConchalÃ­', '13104', '1', '13'), ('303', 'El Bosque', '13105', '1', '13'), ('304', 'EstaciÃ³n Central', '13106', '1', '13'), ('305', 'Huechuraba', '13107', '1', '13'), ('306', 'Independencia', '13108', '1', '13'), ('307', 'La Cisterna', '13109', '1', '13'), ('308', 'La Florida', '13110', '1', '13'), ('309', 'La Granja', '13111', '1', '13'), ('310', 'La Pintana', '13112', '1', '13'), ('311', 'La Reina', '13113', '1', '13'), ('312', 'Lo Barnechea', '13115', '1', '13'), ('313', 'Lo Espejo', '13116', '1', '13'), ('314', 'Lo Prado', '13117', '1', '13'), ('315', 'Macul', '13118', '1', '13'), ('316', 'MaipÃº', '13119', '1', '13'), ('317', 'Ã‘uÃ±oa', '13120', '1', '13'), ('318', 'Pedro Aguirre Cerda', '13121', '1', '13'), ('319', 'PeÃ±alolÃ©n', '13122', '1', '13'), ('320', 'Providencia', '13123', '1', '13'), ('321', 'Pudahuel', '13124', '1', '13'), ('322', 'Quilicura', '13125', '1', '13'), ('323', 'Quinta Normal', '13126', '1', '13'), ('324', 'Recoleta', '13127', '1', '13'), ('325', 'Renca', '13128', '1', '13'), ('326', 'San JoaquÃ­n', '13129', '1', '13'), ('327', 'San Miguel', '13130', '1', '13'), ('328', 'San RamÃ³n', '13131', '1', '13'), ('329', 'Vitacura', '13132', '1', '13'), ('330', 'Puente Alto', '13201', '1', '13'), ('331', 'Pirque', '13202', '1', '13'), ('332', 'San JosÃ© de Maipo', '13203', '1', '13'), ('333', 'Colina', '13301', '1', '13'), ('334', 'Lampa', '13302', '1', '13'), ('335', 'Tiltil', '13303', '1', '13'), ('336', 'San Bernardo', '13401', '1', '13'), ('337', 'Buin', '13402', '1', '13'), ('338', 'Calera de Tango', '13403', '1', '13'), ('339', 'Paine', '13404', '1', '13'), ('340', 'Melipilla', '13501', '1', '13'), ('341', 'AlhuÃ©', '13502', '1', '13'), ('342', 'CuracavÃ­', '13503', '1', '13'), ('343', 'MarÃ­a Pinto', '13504', '1', '13'), ('344', 'San Pedro', '13505', '1', '13'), ('345', 'Talagante', '13601', '1', '13'), ('346', 'El Monte', '13602', '1', '13'), ('347', 'Isla de Maipo', '13603', '1', '13'), ('348', 'Padre Hurtado', '13604', '1', '13'), ('349', 'PeÃ±aflor', '13605', '1', '13');
COMMIT;

-- ----------------------------
--  Table structure for `Contacto`
-- ----------------------------
DROP TABLE IF EXISTS `Contacto`;
CREATE TABLE `Contacto` (
  `idContacto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreContacto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `telefonoContacto` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celularContacto` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoContacto` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rutContacto` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `webContacto` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `linkedInContacto` varchar(400) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `twitterContacto` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `facebookContacto` varchar(400) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Direccion_idDireccion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idContacto`),
  UNIQUE KEY `idContacto_UNIQUE` (`idContacto`),
  UNIQUE KEY `nombreContacto_UNIQUE` (`nombreContacto`),
  KEY `fk_Contacto_Direccion1_idx` (`Direccion_idDireccion`),
  CONSTRAINT `fk_Contacto_Direccion1` FOREIGN KEY (`Direccion_idDireccion`) REFERENCES `Direccion` (`idDireccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='son los contactos que tiene la empresa.';

-- ----------------------------
--  Table structure for `ContactoCliente`
-- ----------------------------
DROP TABLE IF EXISTS `ContactoCliente`;
CREATE TABLE `ContactoCliente` (
  `Cliente_idCliente` int(10) unsigned NOT NULL,
  `Contacto_idContacto` int(10) unsigned NOT NULL,
  `TipoContacto_idTipoContacto` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Cliente_idCliente`,`Contacto_idContacto`),
  KEY `fk_ContactoCliente_Contacto1_idx` (`Contacto_idContacto`),
  KEY `fk_ContactoCliente_TipoContacto1_idx` (`TipoContacto_idTipoContacto`),
  CONSTRAINT `fk_ContactoCliente_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `Cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContactoCliente_Contacto1` FOREIGN KEY (`Contacto_idContacto`) REFERENCES `Contacto` (`idContacto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContactoCliente_TipoContacto1` FOREIGN KEY (`TipoContacto_idTipoContacto`) REFERENCES `TipoContacto` (`idTipoContacto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='se guarda las relaciones de los contactos con los clientes.';

-- ----------------------------
--  Table structure for `Direccion`
-- ----------------------------
DROP TABLE IF EXISTS `Direccion`;
CREATE TABLE `Direccion` (
  `idDireccion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calleDireccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `numeroDireccion` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `ofDireccion` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigopostalDireccion` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activoDireccion` tinyint(1) NOT NULL DEFAULT '1',
  `Comuna_idComuna` int(10) unsigned DEFAULT NULL,
  `Pais_idPais` int(10) unsigned NOT NULL,
  `Region_idRegion` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idDireccion`),
  UNIQUE KEY `idDireccion_UNIQUE` (`idDireccion`),
  KEY `fk_Direccion_Comuna1_idx` (`Comuna_idComuna`),
  KEY `fk_Direccion_Pais1_idx` (`Pais_idPais`),
  KEY `fk_Direccion_Region1_idx` (`Region_idRegion`),
  CONSTRAINT `fk_Direccion_Comuna1` FOREIGN KEY (`Comuna_idComuna`) REFERENCES `Comuna` (`idComuna`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Direccion_Pais1` FOREIGN KEY (`Pais_idPais`) REFERENCES `Pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Direccion_Region1` FOREIGN KEY (`Region_idRegion`) REFERENCES `Region` (`idRegion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Tabla de direcciones tanto para clientes como para contactos';

-- ----------------------------
--  Table structure for `EstadoFactura`
-- ----------------------------
DROP TABLE IF EXISTS `EstadoFactura`;
CREATE TABLE `EstadoFactura` (
  `idEstadoFactura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreEstadoFactura` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionEstadoFactura` text COLLATE utf8_spanish2_ci,
  PRIMARY KEY (`idEstadoFactura`),
  UNIQUE KEY `idEstadoFactura_UNIQUE` (`idEstadoFactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Describe los distintos estados en que se encuentra una factu';

-- ----------------------------
--  Table structure for `Factura`
-- ----------------------------
DROP TABLE IF EXISTS `Factura`;
CREATE TABLE `Factura` (
  `idFactura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fechaFactura` date NOT NULL,
  `montoFactura` float NOT NULL,
  `fechainicioFactura` date NOT NULL,
  `fechafinFactura` date NOT NULL,
  `tasacambioFactura` float NOT NULL,
  `EstadoFactura_idEstadoFactura` int(10) unsigned NOT NULL,
  `Cliente_idCliente` int(10) unsigned NOT NULL,
  `Moneda_idMoneda` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idFactura`),
  UNIQUE KEY `idFactura_UNIQUE` (`idFactura`),
  KEY `fk_Factura_EstadoFactura1_idx` (`EstadoFactura_idEstadoFactura`),
  KEY `fk_Factura_Cliente1_idx` (`Cliente_idCliente`),
  KEY `fk_Factura_Moneda1_idx` (`Moneda_idMoneda`),
  CONSTRAINT `fk_Factura_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `Cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_EstadoFactura1` FOREIGN KEY (`EstadoFactura_idEstadoFactura`) REFERENCES `EstadoFactura` (`idEstadoFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Moneda1` FOREIGN KEY (`Moneda_idMoneda`) REFERENCES `Moneda` (`idMoneda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='facturas realizadas';

-- ----------------------------
--  Table structure for `Feriado`
-- ----------------------------
DROP TABLE IF EXISTS `Feriado`;
CREATE TABLE `Feriado` (
  `idFeriado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fechaFeriado` date NOT NULL,
  `tipoFeriado` set('COMPLETO','MEDIODIA') COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionFeriado` text COLLATE utf8_spanish2_ci,
  `activoFeriado` tinyint(1) NOT NULL DEFAULT '1',
  `Pais_idPais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idFeriado`),
  UNIQUE KEY `idFeriados_UNIQUE` (`idFeriado`),
  KEY `fk_Feriados_Pais1_idx` (`Pais_idPais`),
  CONSTRAINT `fk_Feriados_Pais1` FOREIGN KEY (`Pais_idPais`) REFERENCES `Pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='tabla de feriados legales';

-- ----------------------------
--  Table structure for `Input`
-- ----------------------------
DROP TABLE IF EXISTS `Input`;
CREATE TABLE `Input` (
  `idInput` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreInput` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionInput` text COLLATE utf8_spanish2_ci,
  `activoInput` tinyint(1) NOT NULL DEFAULT '1',
  `ocultoInput` tinyint(1) NOT NULL DEFAULT '0',
  `sololecturaInput` tinyint(1) NOT NULL DEFAULT '0',
  `Pagina_idPagina` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idInput`),
  UNIQUE KEY `idConcepto_UNIQUE` (`idInput`),
  KEY `fk_Input_Pagina1_idx` (`Pagina_idPagina`),
  CONSTRAINT `fk_Input_Pagina1` FOREIGN KEY (`Pagina_idPagina`) REFERENCES `Pagina` (`idPagina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Se describen los conceptos del sistema, como usuario, client';

-- ----------------------------
--  Table structure for `Label`
-- ----------------------------
DROP TABLE IF EXISTS `Label`;
CREATE TABLE `Label` (
  `idLabel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreLabel` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `despliegueLabel` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `classLabel` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idLabel`),
  UNIQUE KEY `idLabel_UNIQUE` (`idLabel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='listado de label que deben ser cambiados al momento de carga';

-- ----------------------------
--  Table structure for `Menu`
-- ----------------------------
DROP TABLE IF EXISTS `Menu`;
CREATE TABLE `Menu` (
  `idMenu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreMenu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'nombre a desplegar de la opción.',
  `nivelMenu` int(11) NOT NULL DEFAULT '1' COMMENT 'indique que nivel tiene',
  `activoMenu` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'indica si la opción esta activa para ser desplegada.',
  `posicionMenu` int(10) unsigned NOT NULL DEFAULT '0',
  `spanclassMenu` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Pagina_idPagina` int(10) unsigned DEFAULT NULL,
  `Menu_idMenu` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idMenu`),
  UNIQUE KEY `idMenu_UNIQUE` (`idMenu`),
  KEY `fk_Menu_Pagina1_idx` (`Pagina_idPagina`),
  KEY `fk_Menu_Menu1_idx` (`Menu_idMenu`),
  CONSTRAINT `fk_Menu_Menu1` FOREIGN KEY (`Menu_idMenu`) REFERENCES `Menu` (`idMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Menu_Pagina1` FOREIGN KEY (`Pagina_idPagina`) REFERENCES `Pagina` (`idPagina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Despliegue del Menu con URL.';

-- ----------------------------
--  Records of `Menu`
-- ----------------------------
BEGIN;
INSERT INTO `Menu` VALUES ('1', 'Inicio', '0', '1', '1', 'glyphicon glyphicon-home', '1', null), ('2', 'Informes', '0', '0', '2', 'glyphicon glyphicon-file', '2', null), ('3', 'AdministraciÃ³n', '0', '1', '3', 'glyphicon glyphicon-wrench', '3', null), ('4', 'Salir', '0', '1', '4', 'glyphicon glyphicon-off', '4', null), ('5', 'Mantenedores', '1', '1', '1', '', null, '3'), ('6', 'Usuarios', '1', '1', '2', 'glyphicon glyphicon-chevron-right', '5', '3'), ('7', 'Roles', '1', '1', '3', 'glyphicon glyphicon-chevron-right', '6', '3'), ('8', 'Permisos por rol', '1', '1', '4', 'glyphicon glyphicon-chevron-right', '7', '3'), ('9', 'Tipos de contacto', '1', '1', '5', 'glyphicon glyphicon-chevron-right', '8', '3'), ('10', 'Materias', '1', '1', '6', 'glyphicon glyphicon-chevron-right', '9', '3'), ('11', 'Tipos de materia', '1', '1', '7', 'glyphicon glyphicon-chevron-right', '10', '3'), ('12', 'Tarifas por materia', '1', '1', '8', 'glyphicon glyphicon-chevron-right', '11', '3'), ('13', 'Estados de factura', '1', '1', '9', 'glyphicon glyphicon-chevron-right', '12', '3'), ('14', 'Tipos de moneda', '1', '1', '10', 'glyphicon glyphicon-chevron-right', '13', '3'), ('15', 'Tipos de abono', '1', '1', '11', 'glyphicon glyphicon-chevron-right', '14', '3'), ('16', 'Tipo de gasto', '1', '1', '12', 'glyphicon glyphicon-chevron-right', '15', '3'), ('17', 'Feriados legales', '1', '1', '13', 'glyphicon glyphicon-chevron-right', '16', '3'), ('18', 'ParÃ¡metros', '1', '1', '14', '', null, '3'), ('19', 'PaÃ­ses', '1', '1', '15', 'glyphicon glyphicon-chevron-right', '17', '3'), ('20', 'Regiones', '1', '1', '16', 'glyphicon glyphicon-chevron-right', '18', '3'), ('21', 'Comunas', '1', '1', '17', 'glyphicon glyphicon-chevron-right', '19', '3'), ('22', 'Labels', '1', '1', '18', 'glyphicon glyphicon-chevron-right', '20', '3'), ('23', 'MenÃº', '1', '1', '19', 'glyphicon glyphicon-chevron-right', '21', '3'), ('24', 'PÃ¡ginas', '1', '1', '20', 'glyphicon glyphicon-chevron-right', '22', '3'), ('25', 'ParÃ¡metros Globales', '1', '1', '21', 'glyphicon glyphicon-chevron-right', '23', '3'), ('26', 'InformaciÃ³n del Sistema', '1', '1', '23', 'glyphicon glyphicon-chevron-right', null, '3'), ('27', 'VersiÃ³n', '1', '1', '24', 'glyphicon glyphicon-chevron-right', '24', '3'), ('28', 'Licencia', '1', '1', '25', 'glyphicon glyphicon-chevron-right', '25', '3'), ('29', 'Mapa de pÃ¡ginas', '1', '1', '22', 'glyphicon glyphicon-chevron-right', '66', '3');
COMMIT;

-- ----------------------------
--  Table structure for `Moneda`
-- ----------------------------
DROP TABLE IF EXISTS `Moneda`;
CREATE TABLE `Moneda` (
  `idMoneda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreMoneda` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionMoneda` text COLLATE utf8_spanish2_ci,
  `activoMoneda` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idMoneda`),
  UNIQUE KEY `idMoneda_UNIQUE` (`idMoneda`),
  UNIQUE KEY `nombreMoneda_UNIQUE` (`nombreMoneda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='Guarda las distintas monedas con que se trabajaran.';

-- ----------------------------
--  Table structure for `Pagina`
-- ----------------------------
DROP TABLE IF EXISTS `Pagina`;
CREATE TABLE `Pagina` (
  `idPagina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `urlPagina` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'url de la pagina directorio+pagina',
  `nombrePagina` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'solo la pagina, sin directorios',
  `descripcionPagina` text COLLATE utf8_spanish2_ci COMMENT 'descripcion de la pagina',
  `activoPagina` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'indica si la pagina esta activa para ser desplegada.',
  PRIMARY KEY (`idPagina`),
  UNIQUE KEY `idPagina_UNIQUE` (`idPagina`),
  UNIQUE KEY `urlPagina_UNIQUE` (`urlPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='pagina con listado de la paginas que existen en el sistema.';

-- ----------------------------
--  Records of `Pagina`
-- ----------------------------
BEGIN;
INSERT INTO `Pagina` VALUES ('1', 'index.php', 'index.php', 'Inicio (MenÃº Superior)', '1'), ('2', 'informes.php', 'informes.php', 'Informes (MenÃº Superior)', '1'), ('3', 'admin.php', 'admin.php', 'AdministraciÃ³n (MenÃº Superior)', '1'), ('4', 'login.php', 'login.php', 'Login (MenÃº Superior)', '1'), ('5', '#usr_mod', 'pages_admin/usr_mod.php', 'Lista de Usuarios', '1'), ('6', '#roles_mod', 'pages_admin/roles_mod.php', 'Lista de Roles', '1'), ('7', '#roles_perm_mod', 'pages_admin/roles_perm_mod.php', 'Permisos por rol', '1'), ('8', '#cto_tipo_mod', 'pages_admin/cto_tipo_mod.php', 'Lista de Tipos de contacto', '1'), ('9', '#mat_mod', 'pages_admin/mat_mod.php', 'Lista de Materias', '1'), ('10', '#mat_tipo_mod', 'pages_admin/mat_tipo_mod.php', 'Lista de Tipos de materia', '1'), ('11', '#mat_tar_mod', 'pages_admin/mat_tar_mod.php', 'Lista de Tarifas por materia', '1'), ('12', '#fact_estdo_mod', 'pages_admin/fact_estdo_mod.php', 'Lista de Estados de factura', '1'), ('13', '#mon_mod', 'pages_admin/mon_mod.php', 'Lista de Tipos de moneda', '1'), ('14', '#tipo_abono_mod', 'pages_admin/tipo_abono_mod.php', 'Lista de Tipos de abono', '1'), ('15', '#tipo_gasto_mod', 'pages_admin/tipo_gasto_mod.php', 'Lista de Tipos de gasto', '1'), ('16', '#feriados_mod', 'pages_admin/feriados_mod.php', 'Lista de Feriados legales', '1'), ('17', '#pais_mod', 'pages_admin/pais_mod.php', 'Lista de PaÃ­ses', '1'), ('18', '#region_mod', 'pages_admin/region_mod.php', 'Lista de Regiones', '1'), ('19', '#comuna_mod', 'pages_admin/comuna_mod.php', 'Lista de Comunas', '1'), ('20', '#label_mod', 'pages_admin/label_mod.php', 'Lista de Labels', '1'), ('21', '#menu_mod', 'pages_admin/menu_mod.php', 'Lista de Items de menÃº', '1'), ('22', '#paginas_mod', 'pages_admin/paginas_mod.php', 'Lista de PÃ¡ginas del sistema', '1'), ('23', '#param_mod', 'pages_admin/param_mod.php', 'Lista de ParÃ¡metros globales', '1'), ('24', '#version', 'pages_admin/version.php', 'VersiÃ³n del sistema', '1'), ('25', '#licencia', 'pages_admin/licencia.php', 'Licencia (EULA)', '1'), ('26', 'act_desact.php', 'pages_admin/act_desact.php', 'Activar o desactivar registro de una grilla', '1'), ('27', 'comuna_crear.php', 'pages_admin/comuna_crear.php', 'CreaciÃ³n de Comuna', '1'), ('28', 'comuna_editar.php', 'pages_admin/comuna_editar.php', 'EdiciÃ³n de Comuna', '1'), ('29', 'cto_tipo_crear.php', 'pages_admin/cto_tipo_crear.php', 'CreaciÃ³n de Tipo contacto', '1'), ('30', 'cto_tipo_editar.php', 'pages_admin/cto_tipo_editar.php', 'EdiciÃ³n de Tipo contacto', '1'), ('31', 'fact_estdo_crear.php', 'pages_admin/fact_estdo_crear.php', 'CreaciÃ³n de Estados factura', '1'), ('32', 'fact_estdo_editar.php', 'pages_admin/fact_estdo_editar.php', 'EdiciÃ³n de Estados factura', '1'), ('33', 'feriados_crear.php', 'pages_admin/feriados_crear.php', 'CreaciÃ³n de Feriado legal', '1'), ('34', 'feriados_editar.php', 'pages_admin/feriados_editar.php', 'EdiciÃ³n de Feriado legal', '1'), ('35', 'label_crear.php', 'pages_admin/label_crear.php', 'CreaciÃ³n de Label', '1'), ('36', 'label_editar.php', 'pages_admin/label_editar.php', 'EdiciÃ³n de Label', '1'), ('37', 'mat_crear.php', 'pages_admin/mat_crear.php', 'CreaciÃ³n de Materia', '1'), ('38', 'mat_editar.php', 'pages_admin/mat_editar.php', 'EdiciÃ³n de Materia', '1'), ('39', 'mat_tar_crear.php', 'pages_admin/mat_tar_crear.php', 'CreaciÃ³n de Tarifa por materia', '1'), ('40', 'mat_tar_editar.php', 'pages_admin/mat_tar_editar.php', 'EdiciÃ³n de Tarifa por materia', '1'), ('41', 'mat_tipo_crear.php', 'pages_admin/mat_tipo_crear.php', 'CreaciÃ³n de Tipo de materia', '1'), ('42', 'mat_tipo_editar.php', 'pages_admin/mat_tipo_editar.php', 'EdiciÃ³n de Tipo de materia', '1'), ('43', 'menu_crear.php', 'pages_admin/menu_crear.php', 'CreaciÃ³n Item de menÃº', '1'), ('44', 'menu_editar.php', 'pages_admin/menu_editar.php', 'EdiciÃ³n Item de menÃº', '1'), ('45', 'mon_crear.php', 'pages_admin/mon_crear.php', 'CreaciÃ³n de Tipo de moneda', '1'), ('46', 'mon_editar.php', 'pages_admin/mon_editar.php', 'EdiciÃ³n de Tipo de moneda', '1'), ('47', 'paginas_crear.php', 'pages_admin/paginas_crear.php', 'CreaciÃ³n de PÃ¡gina del sistema', '1'), ('48', 'paginas_editar.php', 'pages_admin/paginas_editar.php', 'EdiciÃ³n de PÃ¡gina del sistema', '1'), ('49', 'pais_crear.php', 'pages_admin/pais_crear.php', 'CreaciÃ³n de PaÃ­s', '1'), ('50', 'pais_editar.php', 'pages_admin/pais_editar.php', 'EdiciÃ³n de PaÃ­s', '1'), ('51', 'param_crear.php', 'pages_admin/param_crear.php', 'CreaciÃ³n de ParÃ¡metro global', '1'), ('52', 'param_editar.php', 'pages_admin/param_editar.php', 'EdiciÃ³n de ParÃ¡metro Global', '1'), ('53', 'region_crear.php', 'pages_admin/region_crear.php', 'CreaciÃ³n de RegiÃ³n', '1'), ('54', 'region_editar.php', 'pages_admin/region_editar.php', 'EdiciÃ³n de RegiÃ³n', '1'), ('55', 'roles_crear.php', 'pages_admin/roles_crear.php', 'CreaciÃ³n de Rol', '1'), ('56', 'roles_editar.php', 'pages_admin/roles_editar.php', 'EdiciÃ³n de Rol', '1'), ('57', 'tipo_abono_crear.php', 'pages_admin/tipo_abono_crear.php', 'CreaciÃ³n de Tipo de abono', '1'), ('58', 'tipo_abono_editar.php', 'pages_admin/tipo_abono_editar.php', 'EdiciÃ³n de Tipo de abono', '1'), ('59', 'tipo_gasto_crear.php', 'pages_admin/tipo_gasto_crear.php', 'CreaciÃ³n de Tipo de gasto', '1'), ('60', 'tipo_gasto_editar.php', 'pages_admin/tipo_gasto_editar.php', 'EdiciÃ³n de Tipo de gasto', '1'), ('61', 'usr_clave_mod.php', 'pages_admin/usr_clave_mod.php', 'ModificaciÃ³n de clave', '1'), ('62', 'usr_crear.php', 'pages_admin/usr_crear.php', 'CreaciÃ³n de Usuario', '1'), ('63', 'usr_editar.php', 'pages_admin/usr_editar.php', 'EdiciÃ³n de Usuario', '1'), ('64', 'usr_mi_perfil.php', 'pages_admin/usr_mi_perfil.php', 'EdiciÃ³n de Perfil del usuario', '1'), ('65', 'usr_tar_mod.php', 'pages_admin/usr_tar_mod.php', 'EdiciÃ³n de Tarifa del usuario', '1'), ('66', '#paginas_paginas_mod', 'pages_admin/paginas_paginas_mod.php', 'Relaciones entre pÃ¡ginas del sistema', '1');
COMMIT;

-- ----------------------------
--  Table structure for `PaginaenPagina`
-- ----------------------------
DROP TABLE IF EXISTS `PaginaenPagina`;
CREATE TABLE `PaginaenPagina` (
  `idPaginaenPagina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Pagina_idPagina` int(10) unsigned NOT NULL,
  `Pagina_idPagina1` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idPaginaenPagina`),
  KEY `fk_Pagina_has_Pagina1_Pagina2_idx` (`Pagina_idPagina1`),
  KEY `fk_Pagina_has_Pagina1_Pagina1_idx` (`Pagina_idPagina`),
  CONSTRAINT `fk_Pagina_has_Pagina1_Pagina1` FOREIGN KEY (`Pagina_idPagina`) REFERENCES `Pagina` (`idPagina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pagina_has_Pagina1_Pagina2` FOREIGN KEY (`Pagina_idPagina1`) REFERENCES `Pagina` (`idPagina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `Pais`
-- ----------------------------
DROP TABLE IF EXISTS `Pais`;
CREATE TABLE `Pais` (
  `idPais` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombrePais` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `intcodePais` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'código del país (ver que ocupar el de aviación u otro.',
  `activoPais` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPais`),
  UNIQUE KEY `idPais_UNIQUE` (`idPais`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='tabla de paises';

-- ----------------------------
--  Records of `Pais`
-- ----------------------------
BEGIN;
INSERT INTO `Pais` VALUES ('1', 'Chile', 'CHI', '1'), ('2', 'Argentina', 'ARG', '1'), ('3', 'Estados Unidos de Norte AmÃ©rica', 'USA', '1'), ('4', 'PerÃº', 'PER', '1'), ('5', 'IrÃ¡n', 'IRA', '0');
COMMIT;

-- ----------------------------
--  Table structure for `Parametro`
-- ----------------------------
DROP TABLE IF EXISTS `Parametro`;
CREATE TABLE `Parametro` (
  `idParametro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreParametro` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `valorParametro` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `activoParametro` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idParametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='tabla de parámetros estándar del sistema';

-- ----------------------------
--  Table structure for `ParametroUsuario`
-- ----------------------------
DROP TABLE IF EXISTS `ParametroUsuario`;
CREATE TABLE `ParametroUsuario` (
  `idParametroUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreParametroUsuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `valorParametroUsuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `Usuario_idUsuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idParametroUsuario`,`Usuario_idUsuario`),
  UNIQUE KEY `idParametroUsuario_UNIQUE` (`idParametroUsuario`),
  KEY `fk_ParametroUsuario_Usuario1_idx` (`Usuario_idUsuario`),
  CONSTRAINT `fk_ParametroUsuario_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='listado de parámetros por usuario.';

-- ----------------------------
--  Table structure for `Perfil`
-- ----------------------------
DROP TABLE IF EXISTS `Perfil`;
CREATE TABLE `Perfil` (
  `idPerfil` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombrePerfil` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionPerfil` text COLLATE utf8_spanish2_ci,
  `activoPerfil` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPerfil`),
  UNIQUE KEY `idPerfil_UNIQUE` (`idPerfil`),
  UNIQUE KEY `nombrePerfil_UNIQUE` (`nombrePerfil`),
  KEY `nombrePerfil_idx` (`nombrePerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='perfil de usuario para poder establecer a que áreas del sis';

-- ----------------------------
--  Records of `Perfil`
-- ----------------------------
BEGIN;
INSERT INTO `Perfil` VALUES ('1', 'Administrador', 'Perfil de Administrador con permisos sobre todo', '1');
COMMIT;

-- ----------------------------
--  Table structure for `PermisoPagina`
-- ----------------------------
DROP TABLE IF EXISTS `PermisoPagina`;
CREATE TABLE `PermisoPagina` (
  `Perfil_idPerfil` int(10) unsigned NOT NULL,
  `idPermisoPagina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PaginaenPagina_idPaginaenPagina` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idPermisoPagina`,`Perfil_idPerfil`,`PaginaenPagina_idPaginaenPagina`),
  KEY `fk_PermisoPagina_PaginaenPagina1_idx` (`PaginaenPagina_idPaginaenPagina`),
  KEY `fk_PermisoPagina_Perfil1` (`Perfil_idPerfil`),
  CONSTRAINT `fk_PermisoPagina_PaginaenPagina1` FOREIGN KEY (`PaginaenPagina_idPaginaenPagina`) REFERENCES `PaginaenPagina` (`idPaginaenPagina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PermisoPagina_Perfil1` FOREIGN KEY (`Perfil_idPerfil`) REFERENCES `Perfil` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='permisos de las pagina.';

-- ----------------------------
--  Table structure for `Region`
-- ----------------------------
DROP TABLE IF EXISTS `Region`;
CREATE TABLE `Region` (
  `idRegion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreRegion` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `codeRegion` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'codigo de las regiones según gobierno',
  `activoRegion` tinyint(1) NOT NULL DEFAULT '1',
  `Pais_idPais` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idRegion`),
  UNIQUE KEY `idRegion_UNIQUE` (`idRegion`),
  KEY `fk_Region_Pais1_idx` (`Pais_idPais`),
  CONSTRAINT `fk_Region_Pais1` FOREIGN KEY (`Pais_idPais`) REFERENCES `Pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='listado de regiones';

-- ----------------------------
--  Records of `Region`
-- ----------------------------
BEGIN;
INSERT INTO `Region` VALUES ('1', 'TarapacÃ¡', '01', '1', '1'), ('2', 'Antofagasta', '02', '1', '1'), ('3', 'Atacama', '03', '1', '1'), ('4', 'Coquimbo', '04', '1', '1'), ('5', 'ValparaÃ­so', '05', '1', '1'), ('6', 'Libertador Gral. Bernardo Oâ€™Higgins', '06', '1', '1'), ('7', 'Maule', '07', '1', '1'), ('8', 'BiobÃ­o', '08', '1', '1'), ('9', 'AraucanÃ­a', '09', '1', '1'), ('10', 'Los Lagos', '10', '1', '1'), ('11', 'AisÃ©n del Gral. Carlos IbÃ¡Ã±ez del Campo', '11', '1', '1'), ('12', 'Magallanes y de la AntÃ¡rtica Chilena', '12', '1', '1'), ('13', 'Metropolitana de Santiago', '13', '1', '1'), ('14', 'Los RÃ­os', '14', '1', '1'), ('15', 'Arica y Parinacota', '15', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `TipoContacto`
-- ----------------------------
DROP TABLE IF EXISTS `TipoContacto`;
CREATE TABLE `TipoContacto` (
  `idTipoContacto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreTipoContacto` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionTipoContacto` text COLLATE utf8_spanish2_ci,
  PRIMARY KEY (`idTipoContacto`),
  UNIQUE KEY `idTipoContacto_UNIQUE` (`idTipoContacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='relaciones de los contactos con los clientes, por ejemplo co';

-- ----------------------------
--  Table structure for `Usuario`
-- ----------------------------
DROP TABLE IF EXISTS `Usuario`;
CREATE TABLE `Usuario` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `userUsuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `claveUsuario` varchar(40) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'se considera que la clave será almacenada en SHA1',
  `correoUsuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `telefonoUsuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celularUsuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Tabla de usuario del sistema',
  `lastloginUsuario` date DEFAULT NULL,
  `activoUsuario` tinyint(1) NOT NULL DEFAULT '1',
  `Perfil_idPerfil` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreUsuario_UNIQUE` (`nombreUsuario`),
  UNIQUE KEY `userUsuario_UNIQUE` (`userUsuario`),
  UNIQUE KEY `idUsuario_UNIQUE` (`idUsuario`),
  UNIQUE KEY `correoUsuario_UNIQUE` (`correoUsuario`),
  KEY `nombreUsuario_idx` (`nombreUsuario`),
  KEY `userUsuario_idx` (`userUsuario`),
  KEY `fk_Usuario_Perfil_idx` (`Perfil_idPerfil`),
  CONSTRAINT `fk_Usuario_Perfil` FOREIGN KEY (`Perfil_idPerfil`) REFERENCES `Perfil` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT COMMENT='usuarios del sistema.';

-- ----------------------------
--  Records of `Usuario`
-- ----------------------------
BEGIN;
INSERT INTO `Usuario` VALUES ('1', 'Administrador', 'root', '0553a463d0fe226e64d8dba14c4e8033dc81ce23', 'root@localhost.localdomain', null, null, null, '1', '1');
COMMIT;

-- ----------------------------
--  Triggers structure for table Usuario
-- ----------------------------
CREATE TRIGGER `Usuario_BINS` BEFORE INSERT ON `Usuario` FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
SET NEW.claveUsuario = SHA1(NEW.claveUsuario);

SET FOREIGN_KEY_CHECKS = 1;
