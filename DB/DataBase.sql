/**
 * Author:  Marc
 * Created: 18-jun-2016
 */
DROP DATABASE IF EXISTS tienda_marc;
CREATE database IF NOT EXISTS tienda_marc;
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_spanish_ci;
USE tienda_marc;

CREATE TABLE IF NOT EXISTS productos (
num_producto SMALLINT UNSIGNED NOT NULL UNIQUE KEY,
codigo_producto BIGINT(10) ZEROFILL UNSIGNED NOT NULL UNIQUE KEY,
grupo CHAR(30) NOT NULL,
division CHAR(40) NOT NULL,
familia CHAR(40) NOT NULL,
subfamilia CHAR(41) NOT NULL,
nombre_producto CHAR(60) NOT NULL,
precio DECIMAL(8,3) UNSIGNED NOT NULL,
descuento DECIMAL(5,2) UNSIGNED,
oferta DECIMAL(8,3) UNSIGNED,
precio_compra DECIMAL(8,3) UNSIGNED NOT NULL,
pvp DECIMAL(8,3) UNSIGNED NOT NULL,
pvp_incrementado DECIMAL(8,3) UNSIGNED NOT NULL,
imagen CHAR(8) NOT NULL,
descripcion TEXT ,
ref_proveedor CHAR(35) NOT NULL,
ecotasa DECIMAL(5,2) UNSIGNED ,
peso SMALLINT(6) UNSIGNED,
ancho SMALLINT(6) UNSIGNED,
alto SMALLINT(6) UNSIGNED,
profundo SMALLINT(6) UNSIGNED,
INDEX idx_codigo_producto (codigo_producto),
PRIMARY KEY (codigo_producto)
);

DELETE FROM productos;

