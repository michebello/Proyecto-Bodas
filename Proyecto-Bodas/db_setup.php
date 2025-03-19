<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bodas_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada correctamente o ya existente<br>";
} else {
    echo "Error al crear la base de datos: " . $conn->error . "<br>";
}

// Seleccionar la base de datos
$conn->select_db($dbname);

// Crear tabla de usuarios
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
tipo_cuenta ENUM('pareja', 'proveedor') NOT NULL,
fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla de usuarios creada correctamente<br>";
} else {
    echo "Error al crear la tabla de usuarios: " . $conn->error . "<br>";
}

// Crear tabla de bodas
$sql = "CREATE TABLE IF NOT EXISTS bodas (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
usuario_id INT(6) UNSIGNED,
nombres_pareja VARCHAR(100) NOT NULL,
fecha_boda DATE NOT NULL,
lugar_ceremonia VARCHAR(255) NOT NULL,
tema VARCHAR(50) NOT NULL,
fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla de bodas creada correctamente<br>";
} else {
    echo "Error al crear la tabla de bodas: " . $conn->error . "<br>";
}

$conn->close();
echo "Configuración completada.";
?>
