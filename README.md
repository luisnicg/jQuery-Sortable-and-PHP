#jQuery Sortable - Saving order into a database

This is the table

CREATE TABLE `bookmarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Índice de la tabla',
  `url` varchar(555) DEFAULT NULL COMMENT 'Contiene la dirección URL del bookmark',
  `fecha` datetime DEFAULT NULL COMMENT 'Fecha en que se guardo el bookmark',
  `orden` int(4) DEFAULT NULL COMMENT 'Orden en que se va a mostrar el registro',
  `estado` varchar(1) DEFAULT NULL COMMENT '1: Activo 0: Inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;