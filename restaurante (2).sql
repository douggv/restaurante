-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2026 a las 02:46:51
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
(2, 'gustavo', '123123213', 'gustavo@gmail.com', '2026-01-12 00:46:14', '$2y$10$XkAytx9AknUStSCuWdSmaunJ.3cSmQTLBILEucx.I5ACucn17GOM6'),
(3, 'gustavo', 'afsdfsdf', 'gustavo222@gmail.com', '2026-01-16 22:14:36', '$2y$10$2LV1Y5KOvKbOlqdkh8Ct9uyNWjPK25BzvqVQ3MLOD3W8VS004TZU6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `resena` text DEFAULT NULL,
  `fecha_comentario` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_cliente_fk`, `id_usuario_fk`, `puntuacion`, `resena`, `fecha_comentario`) VALUES
(1, 2, 2, 5, 'muy rico y muy buen trato', '2026-02-22 01:26:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE `control` (
  `id_control` int(11) NOT NULL,
  `id_pedido_fk` varchar(255) DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `platos` text DEFAULT NULL,
  `total_pagar` decimal(10,2) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`id_control`, `id_pedido_fk`, `id_usuario_fk`, `platos`, `total_pagar`, `fyh_creacion`) VALUES
(1, '1-2026-02-21 12:22:47', 2, 'Brownie con Helado, Café Espresso, Brownie con Helado', 16.50, '2026-02-21 12:22:47'),
(2, '2-2026-02-21 12:26:41', 2, 'Alitas BBQ, asdasd', 10010.00, '2026-02-21 12:26:41'),
(3, '1-2026-02-21 12:22:47', 2, 'Brownie con Helado, Café Espresso, Brownie con Helado', 16.50, '2026-02-21 12:22:47'),
(4, '2-2026-02-21 13:00:22', 4, 'Brownie con Helado, Brownie con Helado', 14.00, '2026-02-21 13:00:22');

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
(1, 'Hamburguesa Clásicaaaa', 'Plato Fuerte', 'Comida Rápida', 12.50, 'Carne de res, queso, lechuga y tomate', 0),
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
(20, 'Café Espresso', 'Bebida', 'Calientes', 2.50, 'Café intenso de grano seleccionado', 1),
(21, 'asdasd', 'asdasd', 'Comida Rápida', 10000.00, 'wqwqeqw', 1);

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

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `nro_mesa`, `sillas`, `tipo`, `estado`) VALUES
(1, 1, 4, 'Basica', 'OCUPADA'),
(2, 2, 10, 'Basica', 'OCUPADA'),
(3, 3, 4, 'Premiun', 'disponible'),
(4, 4, 10, 'Basica', 'disponible'),
(5, 6, 2, 'Basica', 'disponible'),
(6, 7, 2, 'premium', 'disponible'),
(7, 8, 9, 'basica', 'disponible');

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

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `id_cliente_fk`, `texto`, `leido`, `fecha_creacion`) VALUES
(2, 2, 'Tu reserva ha sido negada. Motivo: lo sentimos por motivos de mantenimiento esta reserva no puede llevarse acabo, solicite en otro dia ', 0, '2026-02-19 20:09:19'),
(3, 2, 'Tu reserva ha sido negada. Motivo: asdasd', 0, '2026-02-19 20:10:37'),
(4, 2, 'Tu reserva ha sido negada. Motivo: dsfsdsdgdsfds', 0, '2026-02-19 21:33:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_mesa_fk` int(11) DEFAULT NULL,
  `id_cliente_fk` int(11) DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_menu_fk` int(11) DEFAULT NULL,
  `descripcion_pedido` text DEFAULT NULL,
  `cantidad` int(11) DEFAULT 1,
  `total_pagar` decimal(10,2) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT current_timestamp(),
  `estado_pedido` enum('pendiente','preparando','entregado','cancelado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_mesa_fk`, `id_cliente_fk`, `id_usuario_fk`, `id_menu_fk`, `descripcion_pedido`, `cantidad`, `total_pagar`, `fyh_creacion`, `estado_pedido`) VALUES
(1, 1, 2, 2, 12, 'adsasd', 1, 16.50, '2026-02-21 12:22:47', 'entregado'),
(2, 1, 2, 2, 20, 'dasdasd', 1, 16.50, '2026-02-21 12:22:47', 'entregado'),
(3, 1, 2, 2, 12, 'asdads', 1, 16.50, '2026-02-21 12:22:47', 'entregado'),
(4, 2, NULL, 2, 17, 'asd', 1, 10010.00, '2026-02-21 12:26:41', 'entregado'),
(5, 2, NULL, 2, 21, 'asd', 1, 10010.00, '2026-02-21 12:26:41', 'entregado'),
(6, 2, 3, 4, 12, 'asdasd', 1, 14.00, '2026-02-21 13:00:22', 'entregado'),
(7, 2, 3, 4, 12, 'asdasd', 1, 14.00, '2026-02-21 13:00:22', 'entregado'),
(8, 2, 2, 2, 12, 'asdasd', 1, 15.50, '2026-02-21 18:26:21', 'pendiente'),
(9, 2, 2, 2, 4, 'asdasd', 1, 15.50, '2026-02-21 18:26:21', 'pendiente');

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

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_cliente_fk`, `id_mesa_fk`, `titulo_evento`, `fecha_reserva`, `hora_inicio`, `hora_fin`, `estado_reserva`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(2, 2, 1, 'cena de aniversario', '2026-02-03', '14:00:00', '16:00:00', 'Negada', '2026-02-01 22:45:35', '2026-02-19 20:09:19'),
(3, 2, 1, 'sadad', '2026-02-02', '14:00:00', '16:00:00', 'Negada', '2026-02-01 22:46:53', '2026-02-19 20:10:37'),
(4, 2, 1, 'sada', '2026-02-02', '14:00:00', '16:00:00', 'Negada', '2026-02-01 22:48:10', '2026-02-19 21:33:05'),
(5, 2, 1, 'asdd', '2026-02-11', '18:00:00', '20:00:00', 'Pendiente', '2026-02-01 22:49:22', '2026-02-01 22:49:22'),
(6, 2, 2, 'asdads', '2026-02-02', '20:00:00', '22:00:00', 'Pendiente', '2026-02-01 22:49:59', '2026-02-01 22:49:59'),
(7, 2, 2, 'asd', '2026-02-04', '14:00:00', '16:00:00', 'Pendiente', '2026-02-01 22:51:29', '2026-02-01 22:51:29'),
(8, 2, 1, 'adasd', '2026-02-04', '18:00:00', '20:00:00', 'Pendiente', '2026-02-01 22:55:08', '2026-02-01 22:55:08'),
(9, 2, 3, 'asdad', '2026-02-04', '14:00:00', '16:00:00', 'Pendiente', '2026-02-01 22:57:00', '2026-02-01 22:57:00'),
(10, 2, 4, 'aniversario', '2026-02-02', '14:00:00', '16:00:00', 'Pendiente', '2026-02-02 13:50:06', '2026-02-02 13:50:06'),
(11, 2, 3, 'asdasdasd', '2026-02-02', '14:00:00', '16:00:00', 'Pendiente', '2026-02-02 13:51:52', '2026-02-02 13:51:52'),
(12, 2, 1, 'asdasda', '2026-02-02', '14:00:00', '16:00:00', 'Pendiente', '2026-02-02 13:52:06', '2026-02-02 13:52:06'),
(13, 2, 1, 'Czfcaf', '2026-02-02', '14:00:00', '16:00:00', 'Pendiente', '2026-02-02 13:52:41', '2026-02-02 13:52:41'),
(14, 2, 6, 'aniversario', '2026-02-03', '12:00:00', '14:00:00', 'Pendiente', '2026-02-02 15:39:30', '2026-02-02 15:39:30'),
(15, 2, 1, 'aniversario', '2026-02-01', '12:00:00', '14:00:00', 'Pendiente', '2026-02-18 18:38:00', '2026-02-18 18:38:00'),
(16, 2, 2, 'cumpeaños', '2026-02-20', '14:00:00', '16:00:00', 'Pendiente', '2026-02-19 20:25:01', '2026-02-19 20:25:01'),
(17, 2, 1, 'hsadlsadsa', '2026-02-20', '14:00:00', '16:00:00', 'Pendiente', '2026-02-19 21:36:42', '2026-02-19 21:36:42'),
(18, 2, 1, 'cumpleaños', '2026-02-21', '20:00:00', '22:00:00', 'Pendiente', '2026-02-21 15:48:08', '2026-02-21 15:48:08');

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
  `password` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol_fk`, `nombre`, `email`, `password`, `imagen`, `telefono`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 1, 'gustavo', 'gustavo@gmail.com', '$2y$10$.JopWlCIrIYSjP1JyzEW.Oddi1Av.TYXK2nlOFYjnftoNw6GHbKAS', NULL, NULL, '2026-02-21 13:40:27', '2026-02-21 13:40:27'),
(2, 2, 'marianaaa', 'mariana@gmail.com', '$2y$10$lkJZCCJwelMy8RC3oOVkvO.vRpWzU6WC3oGktC6CJIWZJ3jynoVIa', '2026-02-21-09-54-44-mesera1.jpg', '04231923929', '2026-02-21 14:01:02', '2026-02-21 14:25:22'),
(4, 2, 'Juan', 'juan@gmail.com', '$2y$10$h7qTZGoh5Hb5emeqwT8kQuV4eet2Gfc4LIzl6yZLWU2SW0ZfykRL6', '2026-02-21-e4af1-mesero2.webp', '12312321312', '2026-02-21 15:24:08', '2026-02-21 15:24:08');

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
  ADD KEY `id_cliente_fk` (`id_cliente_fk`),
  ADD KEY `fk_comentario_usuario` (`id_usuario_fk`);

--
-- Indices de la tabla `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

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
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_mesa_fk` (`id_mesa_fk`),
  ADD KEY `id_cliente_fk` (`id_cliente_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_menu_fk` (`id_menu_fk`);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `control`
--
ALTER TABLE `control`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_cliente_fk`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `control_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`);

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
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_mesa_fk`) REFERENCES `mesas` (`id_mesa`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_cliente_fk`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`id_menu_fk`) REFERENCES `menu` (`id_comida`);

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
