<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "sisg", "33065");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if (isset($_POST['id_empleado']) && $_POST['id_empleado'] !== 'nuevo') {
        $id_empleado = $_POST['id_empleado'];
        $dpi = $_POST['dpi'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $area = $_POST['area'];

        $sql = "UPDATE empleados SET dpi='$dpi', nombre='$nombre', apellido='$apellido', edad='$edad', sexo='$sexo', 
                email='$email', telefono='$telefono', area='$area' WHERE id_empleado='$id_empleado'";

        if ($conn->query($sql) === TRUE) {
            echo "Empleado modificado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Seleccione un empleado para modificar";
    }

    $conn->close();
}
