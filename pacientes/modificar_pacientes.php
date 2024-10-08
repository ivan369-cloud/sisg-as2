<?php
include "../db.php";

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

        if (strlen($dpi) > 13) {
            showAlert('El DPI no puede ser más largo de 13 caracteres.', 'danger');
        } elseif (strlen($telefono) > 10) {
            showAlert('El número de teléfono no puede ser más largo de 10 caracteres.', 'danger');
        } else {

            $sql_update = $conexion->query("UPDATE pacientes SET primer_nombre = '$primer_nombre', segundo_nombre = '$segundo_nombre', primer_apellido = '$primer_apellido', segundo_apellido = '$segundo_apellido', edad = '$edad', genero = '$genero', email = '$email', fecha_nacimiento = '$fecha_nac', direccion = '$direccion', telefono = '$telefono', observaciones = '$observaciones', dpi = '$dpi', id_medico = '$id_medico' WHERE id_paciente = $id");

            if ($sql_update) {
                echo "<script>
                        alert('Paciente actualizado con éxito.');
                        window.location.href = 'URDpacientes.php'; // Cambia por la URL a la que quieras redirigir
                      </script>";
            } else {
                $error = $conexion->error;
                showAlert('Error al actualizar el paciente: ' . $error, 'danger');
            }
        }
    } else {
        echo "ID no proporcionado.";
    }
}
?>