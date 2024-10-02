<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "sisg","33065");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $id_empleado = $_POST['id_empleado'];

    $sql = "DELETE FROM empleados WHERE id_empleado='$id_empleado'";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado eliminado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

