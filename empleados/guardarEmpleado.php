<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "sisg","33065");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $dpi = $_POST['dpi'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $area = $_POST['area'];

    $sql = "INSERT INTO empleados (dpi, nombre, apellido, edad, sexo, email, telefono, area) 
            VALUES ('$dpi', '$nombre', '$apellido', '$edad', '$sexo', '$email', '$telefono', '$area')";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado guardado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
