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

if (isset($_POST["btnactualizar"])) {
    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        $dpi = $conexion->real_escape_string($_POST["dpi"]);
        $primer_nombre = $conexion->real_escape_string($_POST["primer_nombre"]);
        $segundo_nombre = $conexion->real_escape_string($_POST["segundo_nombre"]);
        $primer_apellido = $conexion->real_escape_string($_POST["primer_apellido"]);
        $segundo_apellido = $conexion->real_escape_string($_POST["segundo_apellido"]);
        $edad = $conexion->real_escape_string($_POST["edad"]);
        $genero = $conexion->real_escape_string($_POST["genero"]);
        $email = $conexion->real_escape_string($_POST["correopaciente"]);
        $fecha_nac = $conexion->real_escape_string($_POST["fecha_nac"]);
        $telefono = $conexion->real_escape_string($_POST["telepaciente"]);
        $direccion = $conexion->real_escape_string($_POST["direpaciente"]);
        $observaciones = $conexion->real_escape_string($_POST["obspaciente"]);
        $id_medico = $conexion->real_escape_string($_POST["medicoencargado"]);

        if (!preg_match('/^\d{1,13}$/', $dpi)) {
            showAlert('El DPI debe contener solo números y ser máximo 13 caracteres.', 'danger');
        } 

        elseif (!preg_match('/^\d{1,10}$/', $telefono)) {
            showAlert('El número de teléfono debe contener solo números y ser máximo 10 caracteres.', 'danger');
        } 

        else {
            $fecha_actual = date('Y-m-d');
            if ($fecha_nac > $fecha_actual) {
                showAlert('La fecha de nacimiento no puede ser posterior a la fecha actual.', 'danger');
                exit;
            }
        }

        $name_pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/';
        if (!preg_match($name_pattern, $primer_nombre) || 
            !preg_match($name_pattern, $segundo_nombre) || 
            !preg_match($name_pattern, $primer_apellido) || 
            !preg_match($name_pattern, $segundo_apellido)) {
            showAlert('Los nombres y apellidos deben contener solo letras.', 'danger');
            exit;
        }

        $sql_update = $conexion->query("UPDATE pacientes SET 
            primer_nombre = '$primer_nombre', 
            segundo_nombre = '$segundo_nombre', 
            primer_apellido = '$primer_apellido', 
            segundo_apellido = '$segundo_apellido', 
            edad = '$edad', 
            genero = '$genero', 
            email = '$email', 
            fecha_nacimiento = '$fecha_nac', 
            direccion = '$direccion', 
            telefono = '$telefono', 
            observaciones = '$observaciones', 
            dpi = '$dpi', 
            id_medico = '$id_medico' 
            WHERE id_paciente = $id");

        if ($sql_update) {
            echo "<script>
                    alert('Paciente actualizado con éxito.');
                    window.location.href = 'URDpacientes.php'; // Cambia por la URL a la que quieras redirigir
                  </script>";
        } else {
            $error = $conexion->error;
            showAlert('Error al actualizar el paciente: ' . $error, 'danger');
        }
    } else {
        echo "ID no proporcionado.";
    }
}
?>