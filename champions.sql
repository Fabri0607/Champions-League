-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-06-2024 a las 19:33:09
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `champions`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `Nombre` varchar(50) NOT NULL,
  `Clave` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`Nombre`, `Clave`) VALUES
('Fabri', '827ccb0eea8a706c4c34a16891f84e7b'),
('usuario', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones`
--

DROP TABLE IF EXISTS `clasificaciones`;
CREATE TABLE IF NOT EXISTS `clasificaciones` (
  `Grupo` char(1) NOT NULL,
  `Equipo` varchar(50) NOT NULL,
  `PJ` int DEFAULT NULL,
  `G` int DEFAULT NULL,
  `E` int DEFAULT NULL,
  `P` int DEFAULT NULL,
  `GF` int DEFAULT NULL,
  `GC` int DEFAULT NULL,
  `DG` int DEFAULT NULL,
  `PTS` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasificaciones`
--

INSERT INTO `clasificaciones` (`Grupo`, `Equipo`, `PJ`, `G`, `E`, `P`, `GF`, `GC`, `DG`, `PTS`) VALUES
('B', 'Rangers ', 0, 0, 0, 0, 0, 0, 0, 0),
('D', 'Celtic ', 0, 0, 0, 0, 0, 0, 0, 0),
('C', 'Braga ', 0, 0, 0, 0, 0, 0, 0, 0),
('F', 'Sporting de Lisboa', 0, 0, 0, 0, 0, 0, 0, 0),
('H', 'Benfica ', 0, 0, 0, 0, 0, 0, 0, 0),
('D', 'Porto ', 0, 0, 0, 0, 0, 0, 0, 0),
('G', 'AZ Alkmaar', 0, 0, 0, 0, 0, 0, 0, 0),
('E', 'Feyenoord ', 0, 0, 0, 0, 0, 0, 0, 0),
('F', 'PSV Eindhoven', 0, 0, 0, 0, 0, 0, 0, 0),
('H', 'Ajax ', 0, 0, 0, 0, 0, 0, 0, 0),
('D', 'Liverpool ', 0, 0, 0, 0, 0, 0, 0, 0),
('G', 'Lyon ', 0, 0, 0, 0, 0, 0, 0, 0),
('G', 'Lille', 0, 0, 0, 0, 0, 0, 0, 0),
('B', 'Marsella ', 0, 0, 0, 0, 0, 0, 0, 0),
('G', 'Paris Saint-Germain', 0, 0, 0, 0, 0, 0, 0, 0),
('E', 'AC Milan', 0, 0, 0, 0, 0, 0, 0, 0),
('B', 'Inter de Milán', 0, 0, 0, 0, 0, 0, 0, 0),
('C', 'Juventus', 0, 0, 0, 0, 0, 0, 0, 0),
('C', 'Bayer Leverkusen', 0, 0, 0, 0, 0, 0, 0, 0),
('C', 'RB Leipzig', 0, 0, 0, 0, 0, 0, 0, 0),
('F', 'Borussia Dortmund', 0, 0, 0, 0, 0, 0, 0, 0),
('A', 'Bayern de Múnich', 6, 3, 0, 3, 9, 7, 2, 9),
('B', 'Sevilla', 0, 0, 0, 0, 0, 0, 0, 0),
('D', 'Barcelona ', 0, 0, 0, 0, 0, 0, 0, 0),
('F', 'Real Madrid', 0, 0, 0, 0, 0, 0, 0, 0),
('A', 'Shakhtar Donetsk', 6, 1, 2, 3, 5, 8, -3, 5),
('E', 'Dynamo Kiev', 0, 0, 0, 0, 0, 0, 0, 0),
('H', 'Roma', 0, 0, 0, 0, 0, 0, 0, 0),
('A', 'Chelsea ', 6, 1, 3, 2, 6, 9, -3, 6),
('H', 'Atlético de Madrid', 0, 0, 0, 0, 0, 0, 0, 0),
('A', 'Manchester City', 6, 3, 3, 0, 10, 6, 4, 12),
('E', 'Manchester United', 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE IF NOT EXISTS `equipos` (
  `ID_EQUIPO` int NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
  `PAIS` varchar(50) NOT NULL,
  `GRUPO` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_EQUIPO`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`ID_EQUIPO`, `NOMBRE`, `PAIS`, `GRUPO`) VALUES
(1, 'Real Madrid', 'España', 'F'),
(2, 'Barcelona ', 'España', 'D'),
(3, 'Sevilla', 'España', 'B'),
(4, 'Bayern de Múnich', 'Alemania', 'A'),
(5, 'Borussia Dortmund', 'Alemania', 'F'),
(6, 'RB Leipzig', 'Alemania', 'C'),
(7, 'Bayer Leverkusen', 'Alemania', 'C'),
(8, 'Juventus', 'Italia', 'C'),
(9, 'Inter de Milán', 'Italia', 'B'),
(10, 'AC Milan', 'Italia', 'E'),
(11, 'Paris Saint-Germain', 'Francia', 'G'),
(12, 'Marsella ', 'Francia', 'B'),
(13, 'Lille', 'Francia', 'G'),
(14, 'Lyon ', 'Francia', 'G'),
(15, 'Liverpool ', 'Inglaterra', 'D'),
(16, 'Ajax ', 'Países Bajos', 'H'),
(17, 'PSV Eindhoven', 'Países Bajos', 'F'),
(18, 'Feyenoord ', 'Países Bajos', 'E'),
(19, 'AZ Alkmaar', 'Países Bajos', 'G'),
(20, 'Porto ', 'Portugal', 'D'),
(21, 'Benfica ', 'Portugal', 'H'),
(22, 'Sporting de Lisboa', 'Portugal', 'F'),
(23, 'Braga ', 'Portugal', 'C'),
(24, 'Celtic ', 'Escocia', 'D'),
(25, 'Rangers ', 'Escocia', 'B'),
(26, 'Shakhtar Donetsk', 'Ucrania', 'A'),
(27, 'Dynamo Kiev', 'Ucrania', 'E'),
(28, 'Roma', 'Italia', 'H'),
(29, 'Chelsea ', 'Inglaterra', 'A'),
(30, 'Atlético de Madrid', 'España', 'H'),
(31, 'Manchester City', 'Inglaterra', 'A'),
(32, 'Manchester United', 'Inglaterra', 'E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_partidos`
--

DROP TABLE IF EXISTS `resultados_partidos`;
CREATE TABLE IF NOT EXISTS `resultados_partidos` (
  `ID_PARTIDO` int NOT NULL,
  `EQUIPO_LOCAL` varchar(50) NOT NULL,
  `GOLES_LOCAL` int DEFAULT NULL,
  `EQUIPO_VISITANTE` varchar(50) NOT NULL,
  `GOLES_VISITANTE` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resultados_partidos`
--

INSERT INTO `resultados_partidos` (`ID_PARTIDO`, `EQUIPO_LOCAL`, `GOLES_LOCAL`, `EQUIPO_VISITANTE`, `GOLES_VISITANTE`) VALUES
(1, 'Bayern de Múnich', 1, 'Shakhtar Donetsk', 0),
(2, 'Shakhtar Donetsk', 2, 'Bayern de Múnich', 0),
(3, 'Bayern de Múnich', 3, 'Chelsea ', 1),
(4, 'Chelsea ', 0, 'Bayern de Múnich', 3),
(5, 'Bayern de Múnich', 1, 'Manchester City', 2),
(6, 'Manchester City', 2, 'Bayern de Múnich', 1),
(7, 'Shakhtar Donetsk', 1, 'Chelsea ', 3),
(8, 'Chelsea ', 0, 'Shakhtar Donetsk', 0),
(9, 'Shakhtar Donetsk', 1, 'Manchester City', 1),
(10, 'Manchester City', 3, 'Shakhtar Donetsk', 1),
(11, 'Chelsea ', 2, 'Manchester City', 2),
(12, 'Manchester City', 0, 'Chelsea ', 0),
(13, 'Sevilla', NULL, 'Inter de Milán', NULL),
(14, 'Inter de Milán', NULL, 'Sevilla', NULL),
(15, 'Sevilla', NULL, 'Marsella ', NULL),
(16, 'Marsella ', NULL, 'Sevilla', NULL),
(17, 'Sevilla', NULL, 'Rangers ', NULL),
(18, 'Rangers ', NULL, 'Sevilla', NULL),
(19, 'Inter de Milán', NULL, 'Marsella ', NULL),
(20, 'Marsella ', NULL, 'Inter de Milán', NULL),
(21, 'Inter de Milán', NULL, 'Rangers ', NULL),
(22, 'Rangers ', NULL, 'Inter de Milán', NULL),
(23, 'Marsella ', NULL, 'Rangers ', NULL),
(24, 'Rangers ', NULL, 'Marsella ', NULL),
(25, 'RB Leipzig', NULL, 'Bayer Leverkusen', NULL),
(26, 'Bayer Leverkusen', NULL, 'RB Leipzig', NULL),
(27, 'RB Leipzig', NULL, 'Juventus', NULL),
(28, 'Juventus', NULL, 'RB Leipzig', NULL),
(29, 'RB Leipzig', NULL, 'Braga ', NULL),
(30, 'Braga ', NULL, 'RB Leipzig', NULL),
(31, 'Bayer Leverkusen', NULL, 'Juventus', NULL),
(32, 'Juventus', NULL, 'Bayer Leverkusen', NULL),
(33, 'Bayer Leverkusen', NULL, 'Braga ', NULL),
(34, 'Braga ', NULL, 'Bayer Leverkusen', NULL),
(35, 'Juventus', NULL, 'Braga ', NULL),
(36, 'Braga ', NULL, 'Juventus', NULL),
(37, 'Barcelona ', NULL, 'Liverpool ', NULL),
(38, 'Liverpool ', NULL, 'Barcelona ', NULL),
(39, 'Barcelona ', NULL, 'Porto ', NULL),
(40, 'Porto ', NULL, 'Barcelona ', NULL),
(41, 'Barcelona ', NULL, 'Celtic ', NULL),
(42, 'Celtic ', NULL, 'Barcelona ', NULL),
(43, 'Liverpool ', NULL, 'Porto ', NULL),
(44, 'Porto ', NULL, 'Liverpool ', NULL),
(45, 'Liverpool ', NULL, 'Celtic ', NULL),
(46, 'Celtic ', NULL, 'Liverpool ', NULL),
(47, 'Porto ', NULL, 'Celtic ', NULL),
(48, 'Celtic ', NULL, 'Porto ', NULL),
(49, 'AC Milan', NULL, 'Feyenoord ', NULL),
(50, 'Feyenoord ', NULL, 'AC Milan', NULL),
(51, 'AC Milan', NULL, 'Dynamo Kiev', NULL),
(52, 'Dynamo Kiev', NULL, 'AC Milan', NULL),
(53, 'AC Milan', NULL, 'Manchester United', NULL),
(54, 'Manchester United', NULL, 'AC Milan', NULL),
(55, 'Feyenoord ', NULL, 'Dynamo Kiev', NULL),
(56, 'Dynamo Kiev', NULL, 'Feyenoord ', NULL),
(57, 'Feyenoord ', NULL, 'Manchester United', NULL),
(58, 'Manchester United', NULL, 'Feyenoord ', NULL),
(59, 'Dynamo Kiev', NULL, 'Manchester United', NULL),
(60, 'Manchester United', NULL, 'Dynamo Kiev', NULL),
(61, 'Real Madrid', NULL, 'Borussia Dortmund', NULL),
(62, 'Borussia Dortmund', NULL, 'Real Madrid', NULL),
(63, 'Real Madrid', NULL, 'PSV Eindhoven', NULL),
(64, 'PSV Eindhoven', NULL, 'Real Madrid', NULL),
(65, 'Real Madrid', NULL, 'Sporting de Lisboa', NULL),
(66, 'Sporting de Lisboa', NULL, 'Real Madrid', NULL),
(67, 'Borussia Dortmund', NULL, 'PSV Eindhoven', NULL),
(68, 'PSV Eindhoven', NULL, 'Borussia Dortmund', NULL),
(69, 'Borussia Dortmund', NULL, 'Sporting de Lisboa', NULL),
(70, 'Sporting de Lisboa', NULL, 'Borussia Dortmund', NULL),
(71, 'PSV Eindhoven', NULL, 'Sporting de Lisboa', NULL),
(72, 'Sporting de Lisboa', NULL, 'PSV Eindhoven', NULL),
(73, 'Paris Saint-Germain', NULL, 'Lille', NULL),
(74, 'Lille', NULL, 'Paris Saint-Germain', NULL),
(75, 'Paris Saint-Germain', NULL, 'Lyon ', NULL),
(76, 'Lyon ', NULL, 'Paris Saint-Germain', NULL),
(77, 'Paris Saint-Germain', NULL, 'AZ Alkmaar', NULL),
(78, 'AZ Alkmaar', NULL, 'Paris Saint-Germain', NULL),
(79, 'Lille', NULL, 'Lyon ', NULL),
(80, 'Lyon ', NULL, 'Lille', NULL),
(81, 'Lille', NULL, 'AZ Alkmaar', NULL),
(82, 'AZ Alkmaar', NULL, 'Lille', NULL),
(83, 'Lyon ', NULL, 'AZ Alkmaar', NULL),
(84, 'AZ Alkmaar', NULL, 'Lyon ', NULL),
(85, 'Ajax ', NULL, 'Benfica ', NULL),
(86, 'Benfica ', NULL, 'Ajax ', NULL),
(87, 'Ajax ', NULL, 'Roma', NULL),
(88, 'Roma', NULL, 'Ajax ', NULL),
(89, 'Ajax ', NULL, 'Atlético de Madrid', NULL),
(90, 'Atlético de Madrid', NULL, 'Ajax ', NULL),
(91, 'Benfica ', NULL, 'Roma', NULL),
(92, 'Roma', NULL, 'Benfica ', NULL),
(93, 'Benfica ', NULL, 'Atlético de Madrid', NULL),
(94, 'Atlético de Madrid', NULL, 'Benfica ', NULL),
(95, 'Roma', NULL, 'Atlético de Madrid', NULL),
(96, 'Atlético de Madrid', NULL, 'Roma', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
