<?php
$servername = "serverbd.mysql.database.azure.com";
$username = "myadmin";
$password = "azure2024*";
$dbname = "db_sisg";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
