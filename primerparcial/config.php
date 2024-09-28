<?php
// Datos de conexión
$host = 'localhost';
$dbname = 'sistema_login'; // Nombre de la base de datos
$username = 'root'; // Usuario de PhpMyAdmin
$password = ''; // Contraseña (por defecto en XAMPP no hay)

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
