<?php
// Credenciales de la base de datos
$servername = "localhost";
$username = "root"; // Generalmente es 'root' en XAMPP
$password = "";     // Generalmente no tiene contraseña en XAMPP
$dbname = "zoo_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>