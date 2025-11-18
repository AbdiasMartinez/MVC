#  Proyecto MVC Simple: WebNova - Gestión de Usuarios y Productos

##  Descripción General

Este proyecto implementa un sistema básico de gestión de usuarios (Administradores) y productos (Usuarios) utilizando el patrón de arquitectura **Modelo-Vista-Controlador (MVC)** en PHP.

El objetivo principal es demostrar la correcta aplicación del patrón MVC y la separación de responsabilidades, enfocándose en la lógica de filtrado de datos basada en la sesión del usuario.

**Nivel Académico:** Proyecto de demostración centrado en la arquitectura, simplificando intencionalmente los aspectos de seguridad (uso de contraseñas en texto plano) para enfocar el estudio en la estructura MVC.

---

## 🛠️ Requisitos del Sistema

Para ejecutar este proyecto, necesitas un entorno de desarrollo web:

* **Servidor Web:** Apache (generalmente incluido en XAMPP/WAMP/MAMP).
* **Lenguaje:** PHP 7.4 o superior.
* **Base de Datos:** MySQL/MariaDB.
* **Módulo PHP:** Extensión PDO (para la conexión a la base de datos).

---

##  Guía de Instalación y Configuración

Sigue estos pasos para poner el proyecto en funcionamiento:

### 1. Clonar o Descargar el Proyecto

Coloca la carpeta principal (`MVC/`) dentro del directorio raíz de tu servidor web (e.g., `C:\xampp\htdocs\`).

### 2. Configuración de la Base de Datos

1.  Abre tu gestor de base de datos (phpMyAdmin, DBeaver, etc.).
2.  Crea una nueva base de datos llamada `mvc`.
3.  Ejecuta el siguiente script SQL para crear las tablas y el usuario administrador inicial:

```sql
-- SQL Script Completo
CREATE DATABASE IF NOT EXISTS mvc;
USE mvc;

CREATE TABLE IF NOT EXISTS administradores (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nic_name VARCHAR(50) NOT NULL UNIQUE,
    cedula VARCHAR(20),
    password VARCHAR(255) NOT NULL, 
    modulos TEXT,
    id_ai INT
);

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    cod VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    cedula VARCHAR(20),
    modulos TEXT,
    id_ai INT,
    id_creador INT, 
    FOREIGN KEY (id_creador) REFERENCES administradores(id_admin)
);

CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    serial VARCHAR(50) NOT NULL UNIQUE,
    id_ai INT,
    id_creador INT, 
    FOREIGN KEY (id_creador) REFERENCES usuarios(id_usuario)
);

INSERT INTO administradores (nic_name, cedula, password, modulos, id_ai) VALUES
('admin', '1234567890', '12345678', 'Login,Crear Usuario,Listar Usuario', 1)
ON DUPLICATE KEY UPDATE password='12345678';
