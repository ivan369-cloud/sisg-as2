<?php
    include "../db.php";

    // Si el formulario fue enviado, procesamos el POST
    if (isset($_POST["btnactualizar"])) {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];

            $nombre = $conexion->real_escape_string($_POST["nombre"]);
            $apellido = $conexion->real_escape_string($_POST["apellido"]);
            $especialidad = $conexion->real_escape_string($_POST["especialidad"]);
            $colegiado = $conexion->real_escape_string($_POST["colegiado"]);
            $dpi = $conexion->real_escape_string($_POST["dpimedico"]);
            $correo = $conexion->real_escape_string($_POST["correomedico"]);
            $telefono = $conexion->real_escape_string($_POST["telamedico"]);
            $direccion = $conexion->real_escape_string($_POST["diremedico"]);
            $sexo = $conexion->real_escape_string($_POST["sexo"]);
            $fecha_nac = $conexion->real_escape_string($_POST["fecha_nac"]);

            $sql_update = $conexion->query("UPDATE medicos SET nombre_med = '$nombre', apellido_med = '$apellido', especialidad = '$especialidad', colegiado = '$colegiado', dpi = '$dpi', correo = '$correo', telefono = '$telefono', direccion = '$direccion', sexo = '$sexo', fecha_nacimiento = '$fecha_nac' WHERE ID_med = $id");

            if ($sql_update) {
                echo "<script>
                        alert('Médico actualizado con éxito.');
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
            echo "ID no proporcionado.";
        }
    } else {
        // Si no se ha enviado el formulario, obtenemos el ID por GET
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $sql = $conexion->query("SELECT * FROM medicos WHERE ID_med = $id");
        } else {
            echo "ID no proporcionado.";
            exit;
        }
    }
?>
