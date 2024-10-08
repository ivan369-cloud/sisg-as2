<?php
include "../db.php";

if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["especialidad"]) && 
    !empty($_POST["colegiado"]) && !empty($_POST["dpimedico"]) && !empty($_POST["correomedico"]) &&
    !empty($_POST["telamedico"]) && !empty($_POST["diremedico"]) && !empty($_POST["sexo"]) && 
    !empty($_POST["fecha_nac"])) {

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $especialidad = $_POST["especialidad"];
    $colegiado = $_POST["colegiado"];
    $dpi = $_POST["dpimedico"];
    $correo = $_POST["correomedico"];
    $telefono = $_POST["telamedico"];
    $direccion = $_POST["diremedico"];
    $sexo = $_POST["sexo"];
    $fecha_nac = $_POST["fecha_nac"];

    // Escapa las variables para evitar inyecciones SQL
    $nombre = $conexion->real_escape_string($nombre);
    $apellido = $conexion->real_escape_string($apellido);
    $especialidad = $conexion->real_escape_string($especialidad);
    $colegiado = $conexion->real_escape_string($colegiado);
    $dpi = $conexion->real_escape_string($dpi);
    $correo = $conexion->real_escape_string($correo);
    $telefono = $conexion->real_escape_string($telefono);
    $direccion = $conexion->real_escape_string($direccion);
    $sexo = $conexion->real_escape_string($sexo);
    $fecha_nac = $conexion->real_escape_string($fecha_nac);

    $sql = "INSERT INTO medicos (nombre_med, apellido_med, especialidad, colegiado, dpi, correo, telefono, direccion, sexo, fecha_nacimiento) 
            VALUES ('$nombre', '$apellido', '$especialidad', '$colegiado', '$dpi', '$correo', '$telefono', '$direccion', '$sexo', '$fecha_nac')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
                alert('Médico Ingresado con éxito.');
                window.location.href = 'URDmedicos.php'; // Cambia por la URL a la que quieras redirigir
              </script>";
    } else {
        $error = $conexion->error;
        echo "<script>
                alert('Error al actualizar el médico: $error');
                window.location.href = 'URDmedicos.php'; // O redirige a una página de error si prefieres
              </script>";
    }

} else {
    echo '<div class="alert alert-warning">Alguno de los campos está vacío</div>';
}
?>
