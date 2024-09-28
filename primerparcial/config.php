<?php
$host = 'localhost';
$dbname = 'sistema_login'; 
$username = 'root'; 
$password = ''; 

// Línea que establece la conexión con la BBDD
$conn = new mysqli($host, $username, $password, $dbname);

// Línea de comprobación de la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
