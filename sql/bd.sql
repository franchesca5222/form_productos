-- Crear la base de datos
CREATE DATABASE formulario_productos;
USE formulario_productos;
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(15) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    bodega_id INT NOT NULL,
    sucursal_id INT NOT NULL,
    moneda_id INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT NOT NULL
);

CREATE TABLE monedas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    moneda_id VARCHAR(20) NOT NULL
);

CREATE TABLE bodegas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bodega_id VARCHAR(50) NOT NULL
);

CREATE TABLE sucursales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sucursal_id VARCHAR(50) NOT NULL
);

CREATE TABLE producto_materiales (
    producto_id INT AUTO_INCREMENT ,
    material ENUM('Plástico', 'Metal', 'Madera', 'Vidrio', 'Textil') NOT NULL
);
