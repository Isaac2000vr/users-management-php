-- ========================================================
-- BD: crud_usuarios
-- Guía: CRUD de Usuarios y Entidades de Negocio (Hexagonal, DDD, CQRS)
-- Estudiante: Isaac David Vasquez Ramos
-- Entidad 31: ReservaHotel
-- ========================================================

CREATE DATABASE IF NOT EXISTS crud_usuarios
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE crud_usuarios;

-- --------------------------------------------------------
-- 1. Tabla de roles
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS roles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO roles (id, name) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Estudiante');

-- --------------------------------------------------------
-- 2. Tabla de usuarios (entidad común)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'ADMIN',
    status VARCHAR(20) DEFAULT 'ACTIVE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuario Administrador por defecto (admin@crud.com / admin123)
INSERT IGNORE INTO users (id, name, email, password, role, status, created_at, updated_at)
VALUES (
    '11111111-1111-1111-1111-111111111111',
    'Administrador',
    'admin@crud.com',
    '$2y$10$LrA1wVpWTvjddh4JctXCyecqgI9JsJ2ddY7pRAYmN850VZT0baUuq',
    'ADMIN',
    'ACTIVE',
    NOW(),
    NOW()
);

-- --------------------------------------------------------
-- 3. Tabla de reservas de hotel (Ejercicio 31: ReservaHotel)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS reservas_hotel (
    id VARCHAR(36) PRIMARY KEY,
    fecha DATE NOT NULL,
    hotel VARCHAR(150) NOT NULL,
    huesped VARCHAR(150) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    valor DECIMAL(12, 2) NOT NULL,
    habitacion VARCHAR(50) NOT NULL,
    num_acompanantes INT NOT NULL DEFAULT 0,
    pais VARCHAR(100) NOT NULL,
    departamento VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100) NOT NULL,
    hora_checkin VARCHAR(10) NOT NULL,
    hora_checkout VARCHAR(10) NOT NULL,
    empleado_atiende VARCHAR(150) NOT NULL,
    empleado_despide VARCHAR(150) NOT NULL,
    descripcion TEXT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'PENDING',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reserva de ejemplo inicial
INSERT IGNORE INTO reservas_hotel (
    id,
    fecha,
    hotel,
    huesped,
    fecha_inicio,
    fecha_fin,
    valor,
    habitacion,
    num_acompanantes,
    pais,
    departamento,
    ciudad,
    hora_checkin,
    hora_checkout,
    empleado_atiende,
    empleado_despide,
    descripcion,
    status,
    created_at,
    updated_at
) VALUES (
    '22222222-2222-2222-2222-222222222222',
    '2026-11-09',
    'Hotel Caribe Plaza',
    'Isaac David Vasquez Ramos',
    '2026-12-01',
    '2026-12-05',
    450000.00,
    'Suite 405',
    2,
    'Colombia',
    'Bolívar',
    'Cartagena',
    '15:00',
    '11:00',
    'Carlos Mendoza',
    'Laura Gómez',
    'Reserva turística con vista panorámica y desayuno incluido',
    'CONFIRMED',
    NOW(),
    NOW()
);
