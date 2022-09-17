-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla iglesia.actividades
CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla actividades',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre de la activiadad',
  `descripcion` text COMMENT 'Descripcion de la activiadad',
  `status` tinyint(1) NOT NULL COMMENT 'Status de la actividad',
  `tipo_actividad_id` bigint(11) NOT NULL COMMENT 'Clavde foranea de la tabla tipo actividad',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.actividades: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.actividades_horarios
CREATE TABLE IF NOT EXISTS `actividades_horarios` (
  `actividad_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla actividad',
  `horario_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla horarios',
  PRIMARY KEY (`actividad_id`,`horario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.actividades_horarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `actividades_horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividades_horarios` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.amigos
CREATE TABLE IF NOT EXISTS `amigos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla amigos',
  `cedula` varchar(13) DEFAULT NULL COMMENT 'Cedula del amigo',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del amigo',
  `apellido` varchar(100) DEFAULT NULL COMMENT 'Apellido del amigo',
  `sexo` tinyint(4) DEFAULT NULL COMMENT 'Sexo del amigo',
  `direccion` varchar(200) DEFAULT NULL COMMENT 'Direccion del amigo',
  `telefono` varchar(14) DEFAULT NULL COMMENT 'Telefono del amigo',
  `fecha_nacimiento` datetime DEFAULT NULL COMMENT 'Fecha de nacimiento del amigo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.amigos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `amigos` DISABLE KEYS */;
/*!40000 ALTER TABLE `amigos` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla asistencias',
  `actividad_id` bigint(11) NOT NULL COMMENT 'Clave foranea de  la tabla actividad',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.asistencias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla cargos',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'Nombre de cargo',
  `red_ministerial_id` bigint(11) NOT NULL COMMENT 'Clave foranea de red ministerial',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.cargos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` (`id`, `nombre`, `red_ministerial_id`) VALUES
	(1, 'Pastor', 2),
	(2, 'Supervisores', 1),
	(3, 'Lideres', 3),
	(4, 'Asistentes', 4),
	(5, 'Aspirantes', 5),
	(6, 'miembros', 5);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.donaciones
CREATE TABLE IF NOT EXISTS `donaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla donaciones',
  `detalles` varchar(200) NOT NULL COMMENT 'Detalle de la donacion',
  `cantidad` bigint(20) DEFAULT NULL COMMENT 'Cantidad de la donacion',
  `donante_id` bigint(20) NOT NULL COMMENT 'Clave foranea la tabla miembro',
  `tipo_donacion_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla tipo donacion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.donaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `donaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `donaciones` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.grupos_familiares
CREATE TABLE IF NOT EXISTS `grupos_familiares` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla grupos familiares',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre de grupos familiares',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.grupos_familiares: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `grupos_familiares` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupos_familiares` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.grupo_familiare_miembro
CREATE TABLE IF NOT EXISTS `grupo_familiare_miembro` (
  `miembro_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla miembro',
  `grupos_familiares_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla  grupo familiar',
  PRIMARY KEY (`miembro_id`,`grupos_familiares_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.grupo_familiare_miembro: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo_familiare_miembro` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_familiare_miembro` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla horarios',
  `hora` time NOT NULL COMMENT 'Hora de la actividad',
  `fecha` date NOT NULL COMMENT 'Fecha de la actividad',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.horarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.membresias
CREATE TABLE IF NOT EXISTS `membresias` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla membresias',
  `nombre` varchar(15) DEFAULT NULL COMMENT 'Nombre de la actividad',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.membresias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `membresias` DISABLE KEYS */;
/*!40000 ALTER TABLE `membresias` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.miembros
CREATE TABLE IF NOT EXISTS `miembros` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla miembros',
  `fecha_paso_de_fe` datetime DEFAULT NULL COMMENT 'Fecha que realizo el paso de fe',
  `fecha_bautismo` datetime DEFAULT NULL COMMENT 'Fecha de bautismo dentro de la iglesia',
  `membresia_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla membresias',
  `cargo_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla cargo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.miembros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `miembros` DISABLE KEYS */;
/*!40000 ALTER TABLE `miembros` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.miembros_actividades
CREATE TABLE IF NOT EXISTS `miembros_actividades` (
  `miembro_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla miembros',
  `actividad_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla actividades',
  PRIMARY KEY (`miembro_id`,`actividad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.miembros_actividades: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `miembros_actividades` DISABLE KEYS */;
/*!40000 ALTER TABLE `miembros_actividades` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.observacion_actividad
CREATE TABLE IF NOT EXISTS `observacion_actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla observacion actividades',
  `descripcion` text NOT NULL COMMENT 'Descricion de la observacion de la actividad',
  `amigo_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla amigo',
  `actividad_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la la tabla actividad',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.observacion_actividad: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `observacion_actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `observacion_actividad` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.observacion_donacion
CREATE TABLE IF NOT EXISTS `observacion_donacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla observacion donaciones',
  `descripcion` text COMMENT 'Descripcion de la observacion',
  `cantidad` varchar(10) DEFAULT NULL COMMENT 'Cantidad de la donacion',
  `donacion_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla donacion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.observacion_donacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `observacion_donacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `observacion_donacion` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla perfiles',
  `cedula` varchar(11) NOT NULL COMMENT 'Cedula del miembro',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'Nombre del miembro',
  `apellido` varchar(80) DEFAULT NULL COMMENT 'Apellido del miembro',
  `fecha_nacimiento` datetime DEFAULT NULL COMMENT 'Fecha de nacimiento del miembro',
  `telefono` varchar(14) DEFAULT NULL COMMENT 'Telefono del miembro',
  `direccion` varchar(200) DEFAULT NULL COMMENT 'Direccion del miembro',
  `disponibilidad` tinyint(4) DEFAULT NULL COMMENT 'Disponibilidad del miembro',
  `grado_instruccion` varchar(100) DEFAULT NULL COMMENT 'Grado de instrucion del miembro',
  `sexo` tinyint(1) DEFAULT NULL COMMENT 'Sexo del miembro',
  `vehiculo` tinyint(1) DEFAULT NULL COMMENT 'Vehiculo del miembro',
  `miembro_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla miembros',
  `profesion_id` bigint(11) DEFAULT NULL COMMENT 'Clave foranea de la tabla profesiones',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.perfiles: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.profesiones
CREATE TABLE IF NOT EXISTS `profesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla profesion',
  `nombre` varchar(200) DEFAULT NULL COMMENT 'Nombre de la profesion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.profesiones: ~91 rows (aproximadamente)
/*!40000 ALTER TABLE `profesiones` DISABLE KEYS */;
INSERT INTO `profesiones` (`id`, `nombre`) VALUES
	(1, 'Actividades de apoyo a la explotación de minas'),
	(2, 'Actividades de arquitectura e ingeniería; ensayos y análisis técnicos'),
	(3, 'Actividades de arte y entretenimiento y creatividad'),
	(4, 'Actividades de asociaciones u organizaciones'),
	(5, 'Actividades de impresión y reproducción de grabaciones'),
	(6, 'Actividades de investigación y seguridadModel'),
	(7, 'Actividades de juego y apuestas'),
	(8, 'Actividades de la tecnología de información y del servicio informativo'),
	(9, 'Actividades de las agencias de viajes, operadores turisticos y otros servicios de reserva'),
	(10, 'Actividades de los hogares en calidad de empleadores de personal doméstico'),
	(11, 'Actividades de oficinas centrales (sociedades de carteras), actividades de administración de empresas y de consultoría sobre administración de empresas'),
	(12, 'Actividades de organizaciones y órganos extraterritoriales'),
	(13, 'Actividades de producción de películas, de video de programas de televisión, grabación y publicación de música y sonido'),
	(14, 'Actividades de publicación'),
	(15, 'Actividades de saneamiento y otros servicios de gestión de desechos'),
	(16, 'Actividades del alquiler y arrendamiento'),
	(17, 'Actividades del servicio informativo'),
	(18, 'Actividades deportivas, de diversión y esparcimiento'),
	(19, 'Actividades en el campo del empleo'),
	(20, 'Actividades especializadas de la construcción'),
	(21, 'Actividades indiferenciadas de producción de bienes y servicios de los hogares privados para uso propio'),
	(22, 'Actividades inmobiliarias'),
	(23, 'Actividades jurídicas y de contabilidad'),
	(24, 'Actividades relacionadas con la salud humana'),
	(25, 'Actividades veterinarias'),
	(26, 'Administración pública y la defensa; planes de seguridadModel social de afiliación obligatoria'),
	(27, 'Agricultura, ganaderia, caza y actividades de servicio conexas'),
	(28, 'Alcantarillado'),
	(29, 'Alojamiento'),
	(30, 'Bibliotecas, archivos, museos y otras actividades culturales'),
	(31, 'Captación, tratamiento y suministro de agua'),
	(32, 'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas'),
	(33, 'Comercio al por mayor, excepto de los vehículos de motor y las motocicletas'),
	(34, 'Comercio al por menor, excepto el comercio de vehículos automotores y motocicletas'),
	(35, 'Construcción de edificios'),
	(36, 'Correo y servicios de mensajería'),
	(37, 'Doctor de la salud'),
	(38, 'Depósito y actividades de transporte complementarias'),
	(39, 'Difusión y programación'),
	(40, 'Elaboración de bebidas'),
	(41, 'Elaboración de productos alimenticios'),
	(42, 'Elaboración de productos de tabaco'),
	(43, 'Enseñanza'),
	(44, 'Enfermera(o)'),
	(45, 'Explotación de otras minas y canteras'),
	(46, 'Extracción de carbón y lignito, extracción de turba'),
	(47, 'Extracción de minerales metalíferos'),
	(48, 'Extracción de petróleo crudo y gas natural'),
	(49, 'Fabricación de coque y de productos de la refinación del petróleo'),
	(50, 'Fabricación de productos de caucho y plástico'),
	(51, 'Fabricación de productos derivados del metal, excepto maquinaria y equipo'),
	(52, 'Fabricación de cueros y productos conexos'),
	(53, 'Fabricación de equipo eléctrico'),
	(54, 'Fabricación de la maquinaria y equipo n.c.p'),
	(55, 'Fabricación de los productos informáticos, electrónicos y ópticos'),
	(56, 'Fabricación de metales comunes'),
	(57, 'Fabricación de muebles'),
	(58, 'Fabricación de otros productos minerales no metálicos'),
	(59, 'Fabricación de otros tipos de equipo de transporte'),
	(60, 'Fabricación de papel y de los productos de papel'),
	(61, 'Fabricación de prendas de vestir'),
	(62, 'Fabricación de productos farmacéuticos, sustancias químicas medicinales y de productos botánicos'),
	(63, 'Fabricación de productos textiles'),
	(64, 'Fabricación de sustancias y productos químicos'),
	(65, 'Fabricación de vehículos automotores, remolques y semirremolques'),
	(66, 'Ingeniería Civil'),
	(67, 'Instituciones residenciales de cuidado'),
	(68, 'Investigación y desarrollo científicos'),
	(69, 'Otras actividades de servicios'),
	(70, 'Otras actividades financieras'),
	(71, 'Otras actividades profesionales, científicas y técnicas'),
	(72, 'Otras industrias manufactureras'),
	(73, 'Otras'),
	(74, 'Pesca y Acuicultura'),
	(75, 'Producción de madera y fabricación de productos de madera y corcho, excepto muebles; fabricación de artículos de paja y de materiales trenzables'),
	(76, 'Publicidad e investigación de mercados'),
	(77, 'Recolección, tratamiento y eliminación de desechos, recuperación de materiales'),
	(78, 'Reparación de computadoras y enseres de uso personal y doméstico'),
	(79, 'Reparación e instalación de la maquinaria y equipo'),
	(80, 'Seguros, reaseguros y fondos de pensiones, excepto los planes de seguridadModel social de afiliaciónobligatoria'),
	(81, 'Servicio de alimento y bebida'),
	(82, 'Servicios de apoyo administrativo de oficinas, empresas y otros negocios'),
	(83, 'Servicios financieros, excepto seguros y fondos de pensiones'),
	(84, 'Servicios para edificios y actividades de jardinería'),
	(85, 'Servicios sociales sin alojamiento'),
	(86, 'Silvicultura y extracción de madera'),
	(87, 'Suministro de electricidad, gas, vapor y aire acondicionad'),
	(88, 'Telecomunicaciones'),
	(89, 'Transporte por vía acuática'),
	(90, 'Transporte por vía aérea'),
	(91, 'Transporte por vía terrestre; transporte por tuberías');
/*!40000 ALTER TABLE `profesiones` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.red_ministerial
CREATE TABLE IF NOT EXISTS `red_ministerial` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la red ministerial',
  `nombre` varchar(80) NOT NULL COMMENT 'Nombre de la red ministerial',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.red_ministerial: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `red_ministerial` DISABLE KEYS */;
INSERT INTO `red_ministerial` (`id`, `nombre`) VALUES
	(1, 'Adoracion y alabanza'),
	(2, 'Evangelistico'),
	(3, 'Infantil'),
	(4, 'Juvenil'),
	(5, 'Servicio'),
	(6, 'Radio y television');
/*!40000 ALTER TABLE `red_ministerial` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.tipo_actividad
CREATE TABLE IF NOT EXISTS `tipo_actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla tipo actividad',
  `nombre` varchar(150) NOT NULL COMMENT 'Nombre del tipo actividad',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.tipo_actividad: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_actividad` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.tipo_donacion
CREATE TABLE IF NOT EXISTS `tipo_donacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla tipo donacion',
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre  tipo donacion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.tipo_donacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_donacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_donacion` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.users
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primario de la tabla usuario',
  `username` varchar(20) NOT NULL COMMENT 'Username del usuario',
  `email` varchar(60) NOT NULL COMMENT 'Email del usuario',
  `password` varchar(200) NOT NULL COMMENT 'Password del usuario',
  `miembro_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla miembros',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla iglesia.zonas
CREATE TABLE IF NOT EXISTS `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de la tabla zona',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre de la zona',
  `cargo_id` bigint(11) NOT NULL COMMENT 'Clave foranea de la tabla cargo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla iglesia.zonas: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` (`id`, `nombre`, `cargo_id`) VALUES
	(1, 'JACINTO LARA', 2),
	(2, 'LAS VILLAS', 2),
	(3, 'CENTRO', 2),
	(4, 'BOLIVAR', 2),
	(5, 'TOSTADO', 2),
	(6, 'BATALLA-MORROCOY', 2),
	(7, 'VILLA ROSA-ASOPRADO', 2),
	(8, 'QUIBOR', 2);
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
