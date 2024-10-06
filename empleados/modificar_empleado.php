<?php
    include "db.php";

    // Si el formulario fue enviado, procesamos el POST
    if (isset($_POST["btnactualizar"])) {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];

            // Escapamos los datos recibidos para evitar inyecciones SQL
            $dpi = $conexion->real_escape_string($_POST["dpi"]);
            $nombre = $conexion->real_escape_string($_POST["nombre"]);
            $apellido = $conexion->real_escape_string($_POST["apellido"]);
            $edad = $conexion->real_escape_string($_POST["edad"]);
            $sexo = $conexion->real_escape_string($_POST["sexo"]);
            $email = $conexion->real_escape_string($_POST["email"]);
            $telefono = $conexion->real_escape_string($_POST["telefono"]);
            $area = $conexion->real_escape_string($_POST["area"]);

            // Actualizamos los datos del empleado en la tabla correspondiente
            $sql_update = $conexion->query("UPDATE empleados 
                                            SET dpi = '$dpi', 
                                                nombre = '$nombre', 
                                                apellido = '$apellido', 
                                                edad = '$edad', 
                                                sexo = '$sexo', 
                                                email = '$email', 
                                                telefono = '$telefono', 
                                                area = '$area' 
                                            WHERE id_empleado = $id");

            if ($sql_update) {
                echo "<script>
                        alert('Empleado actualizado con éxito.');
                        window.location.href = 'URDempleados.php'; // Cambia por la URL a la que quieras redirigir
                      </script>";
            } else {
                $error = $conexion->error;
                echo "<script>
                        alert('Error al actualizar el empleado: $error');
                        window.location.href = 'URDempleados.php'; // O redirige a una página de error si prefieres
                      </script>";
            }
        } else {
            echo "ID no proporcionado.";
        }
    } else {
        // Si no se ha enviado el formulario, obtenemos el ID por GET
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            // Consulta para obtener los datos del empleado por su ID
            $sql = $conexion->query("SELECT * FROM empleados WHERE id_empleado = $id");
        } else {
            echo "ID no proporcionado.";
            exit;
        }
    }
?>
