<?php
include "../db.php"; 

if (!empty($_POST["dpi"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) &&
    !empty($_POST["edad"]) && !empty($_POST["sexo"]) && !empty($_POST["email"]) &&
    !empty($_POST["telefono"]) && !empty($_POST["area"])) {

    $dpi = $_POST["dpi"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $area = $_POST["area"];

    // Escapa las variables para evitar inyecciones SQL
    $dpi = $conexion->real_escape_string($dpi);
    $nombre = $conexion->real_escape_string($nombre);
    $apellido = $conexion->real_escape_string($apellido);
    $edad = $conexion->real_escape_string($edad);
    $sexo = $conexion->real_escape_string($sexo);
    $email = $conexion->real_escape_string($email);
    $telefono = $conexion->real_escape_string($telefono);
    $area = $conexion->real_escape_string($area);

    // SQL para insertar los datos
    $sql = "INSERT INTO empleados (dpi, nombre, apellido, edad, sexo, email, telefono, area) 
            VALUES ('$dpi', '$nombre', '$apellido', '$edad', '$sexo', '$email', '$telefono', '$area')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
                alert('Empleado guardado exitosamente.');
                window.location.href = 'URDempleados.php'; // Cambia por la URL a la que quieras redirigir
              </script>";
    } else {
        $error = $conexion->error;
        echo "<script>
                alert('Error al guardar el empleado: $error');
                window.location.href = 'URDempleados.php'; // O redirige a una página de error si prefieres
              </script>";
    }

} else {
    echo '<div class="alert alert-warning">Alguno de los campos está vacío</div>';
}
?>
