<?php
include "db.php";

function showAlert($message, $type = 'warning') {
    echo "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
            $message
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
}

if (!empty($_POST["dpi"]) && !empty($_POST["primer_nombre"]) && !empty($_POST["segundo_nombre"]) && 
    !empty($_POST["primer_apellido"]) && !empty($_POST["segundo_apellido"]) && !empty($_POST["edad"]) && 
    !empty($_POST["genero"]) && !empty($_POST["correopaciente"]) && !empty($_POST["fecha_nac"]) &&
    !empty($_POST["direpaciente"]) && !empty($_POST["telepaciente"]) && !empty($_POST["obspaciente"]) && 
    !empty($_POST["medicoencargado"])) {

    $dpi = $_POST["dpi"];
    $primer_nombre = $_POST["primer_nombre"];
    $segundo_nombre = $_POST["segundo_nombre"];
    $primer_apellido = $_POST["primer_apellido"];
    $segundo_apellido = $_POST["segundo_apellido"];
    $edad = $_POST["edad"];
    $genero = $_POST["genero"];
    $correo = $_POST["correopaciente"];
    $fecha_nac = $_POST["fecha_nac"];
    $direccion = $_POST["direpaciente"];
    $telefono = $_POST["telepaciente"];
    $observaciones = $_POST["obspaciente"];
    $medico = $_POST["medicoencargado"];

    if (!preg_match('/^\d{1,13}$/', $dpi)) {
        showAlert('El DPI debe contener solo números y ser máximo 13 caracteres.', 'danger');
        exit;
    }

    if (!preg_match('/^\d{1,10}$/', $telefono)) {
        showAlert('El número de teléfono debe contener solo números y ser máximo 10 caracteres.', 'danger');
        exit;
    }

    $fecha_actual = date('Y-m-d');
    if ($fecha_nac > $fecha_actual) {
        showAlert('La fecha de nacimiento no puede ser posterior a la fecha actual.', 'danger');
        exit;
    }

    $name_pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/';
    if (!preg_match($name_pattern, $primer_nombre) || 
        !preg_match($name_pattern, $segundo_nombre) || 
        !preg_match($name_pattern, $primer_apellido) || 
        !preg_match($name_pattern, $segundo_apellido)) {
        showAlert('Los nombres y apellidos deben contener solo letras.', 'danger');
        exit;
    }

    $dpi = $conexion->real_escape_string($dpi);
    $primer_nombre = $conexion->real_escape_string($primer_nombre);
    $segundo_nombre = $conexion->real_escape_string($segundo_nombre);
    $primer_apellido = $conexion->real_escape_string($primer_apellido);
    $segundo_apellido = $conexion->real_escape_string($segundo_apellido);
    $edad = $conexion->real_escape_string($edad);
    $genero = $conexion->real_escape_string($genero);
    $correo = $conexion->real_escape_string($correo);
    $fecha_nac = $conexion->real_escape_string($fecha_nac);
    $direccion = $conexion->real_escape_string($direccion);
    $telefono = $conexion->real_escape_string($telefono);
    $observaciones = $conexion->real_escape_string($observaciones);
    $medico = $conexion->real_escape_string($medico);

    $sql = "INSERT INTO pacientes (dpi, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, edad, genero, email, fecha_nacimiento, direccion, telefono, observaciones, id_medico) 
            VALUES ('$dpi', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$edad', '$genero', '$correo', '$fecha_nac', '$direccion', '$telefono', '$observaciones', '$medico')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
                alert('Paciente ingresado con éxito.');
                window.location.href = 'URDpacientes.php';
              </script>";
    } else {
        $error = $conexion->error;
        echo "<script>
                alert('Error al insertar el paciente: $error');
                window.location.href = 'URDpacientes.php';
              </script>";
    }

} else {
    showAlert('Alguno de los campos está vacío', 'warning');
}
?>