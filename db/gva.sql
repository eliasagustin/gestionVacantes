CREATE TABLE `vacante` (
  `vacante_id` int(20) NOT NULL,
  `vacante_nombre_puesto` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `vacante_descripcion_puesto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `vacante_fecha_apertura` date NOT NULL,
  `vacante_fecha_cierre_estipulada` date NOT NULL,
  `vacante_fecha_cierre` date NOT NULL,
  `vacante_fecha_orden_merito` date NOT NULL,
  `materia_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `materia` (
  `materia_id` int(7) NOT NULL,
  `materia_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `materia_descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `postulacion` (
  `postulacion_id` int(20) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `vacante_id` int(20) NOT NULL,
  `postulacion_fecha` date NOT NULL,
  `postulacion_adjunto` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `postulacion_puntaje` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `rol` (
  `rol_id` int(2) NOT NULL,
  `rol_descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `rol_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `materia` (`materia_id`, `materia_nombre`, `materia_descripcion`) VALUES (1, 'Algebra', 'Introduccion a la matematica ...');
INSERT INTO `materia` (`materia_id`, `materia_nombre`, `materia_descripcion`) VALUES (2, 'Analisis de Sistemas', 'Diseño de sistemas ....');
INSERT INTO `materia` (`materia_id`, `materia_nombre`, `materia_descripcion`) VALUES (3, 'Entornos Graficos', 'Catedra orientada a entornos ....');
INSERT INTO `materia` (`materia_id`, `materia_nombre`, `materia_descripcion`) VALUES (4, 'Calculo', 'Introduccion a la matematica ...');

INSERT INTO `rol` (`rol_id`, `rol_descripcion`) VALUES (1, 'Administrador');
INSERT INTO `rol` (`rol_id`, `rol_descripcion`) VALUES (2, 'Jefe de Catedra');
INSERT INTO `rol` (`rol_id`, `rol_descripcion`) VALUES (3, 'Responsable Administrativo');
INSERT INTO `rol` (`rol_id`, `rol_descripcion`) VALUES (4, 'Postulante');

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`,`rol_id`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', '',1);
INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`,`rol_id`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', '',2);
INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`,`rol_id`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', '',3);

--
-- Indices de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  ADD PRIMARY KEY (`postulacion_id`),
  ADD KEY `vacante_id` (`vacante_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `vacante`
--
ALTER TABLE `vacante`
  ADD PRIMARY KEY (`vacante_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);


-- AUTO_INCREMENT de la tabla `vacante`
--
ALTER TABLE `vacante`
  MODIFY `vacante_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY  `materia_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  MODIFY  `postulacion_id` int(20) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  
--
-- Restricciones para tablas volcadas
--

ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);


ALTER TABLE `vacante`
  ADD CONSTRAINT `vacante_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`materia_id`);

  
ALTER TABLE `postulacion`
  ADD CONSTRAINT `postulacion_ibfk_1` FOREIGN KEY (`vacante_id`) REFERENCES `vacante` (`vacante_id`),
  ADD CONSTRAINT `postulacion_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);


COMMIT;