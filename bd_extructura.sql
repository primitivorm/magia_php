-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2016 at 12:22 PM
-- Server version: 5.5.49-0+deb8u1
-- PHP Version: 5.6.22-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `_contenido`
--

CREATE TABLE IF NOT EXISTS `_contenido` (
`id` int(11) NOT NULL,
  `frase` varchar(250) COLLATE utf8_bin NOT NULL,
  `contexto` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `_grupos`
--

CREATE TABLE IF NOT EXISTS `_grupos` (
`id` int(11) NOT NULL,
  `grupo` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `_grupos`
--

INSERT INTO `_grupos` (`id`, `grupo`) VALUES
(7, 'administradores'),
(9, 'invitados'),
(6, 'root'),
(8, 'usuarios');

-- --------------------------------------------------------

--
-- Table structure for table `_idiomas`
--

CREATE TABLE IF NOT EXISTS `_idiomas` (
`id` int(11) NOT NULL,
  `idioma` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_menu`
--

CREATE TABLE IF NOT EXISTS `_menu` (
`id` int(11) NOT NULL,
  `ubicacion` int(11) NOT NULL,
  `padre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_paginas`
--

CREATE TABLE IF NOT EXISTS `_paginas` (
`id` int(11) NOT NULL,
  `pagina` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `_permisos`
--

CREATE TABLE IF NOT EXISTS `_permisos` (
`id` int(11) NOT NULL,
  `grupo` varchar(50) COLLATE utf8_bin NOT NULL,
  `pagina` varchar(50) COLLATE utf8_bin NOT NULL,
  `permiso` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `_traducciones`
--

CREATE TABLE IF NOT EXISTS `_traducciones` (
`id` int(11) NOT NULL,
  `contenido_id` int(11) NOT NULL,
  `idioma` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `traduccion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_usuarios`
--

CREATE TABLE IF NOT EXISTS `_usuarios` (
`id` int(11) NOT NULL,
  `grupo` varchar(50) COLLATE utf8_bin NOT NULL,
  `nombres` varchar(100) COLLATE utf8_bin NOT NULL,
  `usuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `clave` varchar(50) COLLATE utf8_bin NOT NULL,
  `estatus` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `_usuarios`
--

INSERT INTO `_usuarios` (`id`, `grupo`, `nombres`, `usuario`, `clave`, `estatus`) VALUES
(1, 'administradores', 'admin', 'admin', 'admin', 1),
(2, 'invitados', 'invitado', 'invitado', 'invitado', 1),
(3, 'root', 'root', 'root', 'root', 1),
(4, 'usuarios', 'usuario', 'usuario', 'usuario', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_contenido`
--
ALTER TABLE `_contenido`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `frase_UNIQUE` (`frase`,`contexto`);

--
-- Indexes for table `_grupos`
--
ALTER TABLE `_grupos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `grupo_UNIQUE` (`grupo`), ADD UNIQUE KEY `grupo` (`grupo`);

--
-- Indexes for table `_idiomas`
--
ALTER TABLE `_idiomas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idioma` (`idioma`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `_menu`
--
ALTER TABLE `_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_paginas`
--
ALTER TABLE `_paginas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `pagina_UNIQUE` (`pagina`);

--
-- Indexes for table `_permisos`
--
ALTER TABLE `_permisos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `grupo_pagina` (`grupo`,`pagina`), ADD KEY `fk_permisos_paginas_idx` (`pagina`), ADD KEY `fk_permisos_grupos_idx` (`grupo`);

--
-- Indexes for table `_traducciones`
--
ALTER TABLE `_traducciones`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `contenido_id` (`contenido_id`,`idioma`), ADD KEY `fk_traduccion_idioma_idx` (`idioma`);

--
-- Indexes for table `_usuarios`
--
ALTER TABLE `_usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_contenido`
--
ALTER TABLE `_contenido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_grupos`
--
ALTER TABLE `_grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `_idiomas`
--
ALTER TABLE `_idiomas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `_menu`
--
ALTER TABLE `_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_paginas`
--
ALTER TABLE `_paginas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `_permisos`
--
ALTER TABLE `_permisos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_traducciones`
--
ALTER TABLE `_traducciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_usuarios`
--
ALTER TABLE `_usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;