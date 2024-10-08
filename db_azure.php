<?php
$servername = "serverbd.mysql.database.azure.com";
$username = "myadmin";
$password = "azure2024*";
$dbname = "db_sisg";

// Crear conexión usando SSL sin verificación de certificado
$conn = new mysqli($servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa usando SSL sin verificación de certificado";
?>
