-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2026 a las 02:31:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email_cliente` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono`, `email_cliente`, `fecha_registro`, `password`) VALUES
(1, 'douglas', '123123', 'douglasgv0502@gmail.com', '2026-01-10 17:44:18', '$2y$10$.JopWlCIrIYSjP1JyzEW.Oddi1Av.TYXK2nlOFYjnftoNw6GHbKAS'),
(2, 'gustavo', '123123213', 'gustavo@gmail.com', '2026-01-12 00:46:14', '$2y$10$XkAytx9AknUStSCuWdSmaunJ.3cSmQTLBILEucx.I5ACucn17GOM6'),
(3, 'gustavo', 'afsdfsdf', 'gustavo222@gmail.com', '2026-01-16 22:14:36', '$2y$10$2LV1Y5KOvKbOlqdkh8Ct9uyNWjPK25BzvqVQ3MLOD3W8VS004TZU6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `resena` text DEFAULT NULL,
  `fecha_comentario` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_consumo`
--

CREATE TABLE `detalle_consumo` (
  `id_detalle` int(11) NOT NULL,
  `id_visita_fk` int(11) DEFAULT NULL,
  `id_comida_fk` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT 1,
  `precio_unitario_momento` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_visitas`
--

CREATE TABLE `historial_visitas` (
  `id_visita` int(11) NOT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL,
  `id_reserva_fk` int(11) DEFAULT NULL,
  `total_pagado` decimal(10,2) DEFAULT 0.00,
  `fecha_visita` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_comida` int(11) NOT NULL,
  `nombre_comida` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_comida`, `nombre_comida`, `tipo`, `categoria`, `precio`, `descripcion`, `disponible`) VALUES
(1, 'Hamburguesa Clásica', 'Plato Fuerte', 'Carnes', 12.50, 'Carne de res, queso, lechuga y tomate', 1),
(2, 'Pizza Margherita', 'Plato Fuerte', 'Italiana', 15.00, 'Salsa de tomate, mozzarella y albahaca', 1),
(3, 'Tacos al Pastor', 'Plato Fuerte', 'Mexicana', 9.00, '3 tacos con piña, cebolla y cilantro', 1),
(4, 'Ensalada César', 'Entrada', 'Ensaladas', 8.50, 'Lechuga romana, crotones y aderezo césar', 1),
(5, 'Sopa de Tomate', 'Entrada', 'Sopas', 6.00, 'Sopa cremosa de tomates rostizados', 1),
(6, 'Salmón a la Parrilla', 'Plato Fuerte', 'Pescados', 18.00, 'Filete de salmón con espárragos', 1),
(7, 'Pasta Carbonara', 'Plato Fuerte', 'Italiana', 14.00, 'Pasta con crema, tocino y parmesano', 1),
(8, 'Sushi Roll California', 'Plato Fuerte', 'Japonesa', 11.00, 'Cangrejo, aguacate y pepino', 1),
(9, 'Ceviche de Camarón', 'Entrada', 'Mariscos', 13.00, 'Camarones marinados en limón y ají', 1),
(10, 'Lasagna de Carne', 'Plato Fuerte', 'Italiana', 16.50, 'Capas de pasta con carne y bechamel', 1),
(11, 'Pollo Curry', 'Plato Fuerte', 'India', 13.50, 'Pollo en salsa de curry con arroz basmati', 1),
(12, 'Brownie con Helado', 'Postre', 'Dulces', 7.00, 'Brownie de chocolate caliente con vainilla', 1),
(13, 'Cheesecake de Fresa', 'Postre', 'Dulces', 6.50, 'Pastel de queso con mermelada natural', 1),
(14, 'Limonada Imperial', 'Bebida', 'Fríos', 3.50, 'Limonada fresca con hierbabuena', 1),
(15, 'Vino Tinto Copo', 'Bebida', 'Alcohol', 5.00, 'Copa de vino de la casa', 1),
(16, 'Risotto de Hongos', 'Plato Fuerte', 'Vegetariana', 17.00, 'Arroz cremoso con variedad de setas', 1),
(17, 'Alitas BBQ', 'Entrada', 'Snacks', 10.00, '6 alitas bañadas en salsa barbacoa', 1),
(18, 'Crema de Zapallo', 'Entrada', 'Sopas', 5.50, 'Sopa suave de calabaza y especias', 1),
(19, 'Tiramisú', 'Postre', 'Dulces', 7.50, 'Clásico postre italiano con café', 1),
(20, 'Café Espresso', 'Bebida', 'Calientes', 2.50, 'Café intenso de grano seleccionado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(11) NOT NULL,
  `nro_mesa` int(11) NOT NULL,
  `sillas` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT 'Basica',
  `estado` varchar(100) DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL,
  `texto` text NOT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL,
  `id_mesa_fk` int(11) DEFAULT NULL,
  `titulo_evento` varchar(100) DEFAULT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado_reserva` varchar(100) DEFAULT 'Pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante_info`
--

CREATE TABLE `restaurante_info` (
  `id_restaurante` int(11) NOT NULL,
  `nombre_restaurante` varchar(100) NOT NULL,
  `imagen_logo` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'mesero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol_fk` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol_fk`, `nombre`, `email`, `password`) VALUES
(1, 1, 'gustavo', 'gustavo@gmail.com', '$2y$10$.JopWlCIrIYSjP1JyzEW.Oddi1Av.TYXK2nlOFYjnftoNw6GHbKAS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email_cliente` (`email_cliente`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_cliente_fk` (`id_cliente_fk`);

--
-- Indices de la tabla `detalle_consumo`
--
ALTER TABLE `detalle_consumo`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_visita_fk` (`id_visita_fk`),
  ADD KEY `id_comida_fk` (`id_comida_fk`);

--
-- Indices de la tabla `historial_visitas`
--
ALTER TABLE `historial_visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `id_cliente_fk` (`id_cliente_fk`),
  ADD KEY `id_reserva_fk` (`id_reserva_fk`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_comida`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_mesa`),
  ADD UNIQUE KEY `nro_mesa` (`nro_mesa`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `id_cliente_fk` (`id_cliente_fk`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_cliente_fk` (`id_cliente_fk`),
  ADD KEY `id_mesa_fk` (`id_mesa_fk`);

--
-- Indices de la tabla `restaurante_info`
--
ALTER TABLE `restaurante_info`
  ADD PRIMARY KEY (`id_restaurante`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol_fk` (`id_rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_consumo`
--
ALTER TABLE `detalle_consumo`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_visitas`
--
ALTER TABLE `historial_visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `restaurante_info`
--
ALTER TABLE `restaurante_info`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_cliente_fk`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_consumo`
--
ALTER TABLE `detalle_consumo`
  ADD CONSTRAINT `detalle_consumo_ibfk_1` FOREIGN KEY (`id_visita_fk`) REFERENCES `historial_visitas` (`id_visita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_consumo_ibfk_2` FOREIGN KEY (`id_comida_fk`) REFERENCES `menu` (`id_comida`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_visitas`
--
ALTER TABLE `historial_visitas`
  ADD CONSTRAINT `historial_visitas_ibfk_1` FOREIGN KEY (`id_cliente_fk`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_visitas_ibfk_2` FOREIGN KEY (`id_reserva_fk`) REFERENCES `reservas` (`id_reserva`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_cliente_fk`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_cliente_fk`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_mesa_fk`) REFERENCES `mesas` (`id_mesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol_fk`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
