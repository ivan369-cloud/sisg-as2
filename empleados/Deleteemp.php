<?php 
    include "db.php";
    $id = $_GET["id"];

    // Si el formulario fue enviado por POST
    if (is_numeric($id)) {
        $sql = $conexion->query("DELETE FROM empleados WHERE id_empleado = $id");

        if ($sql) {
            echo "<script>
                    alert('Empleado eliminado con éxito.');
                    window.location.href = 'URDempleados.php'; // Cambia por la URL a la que quieras redirigir
                  </script>";
        } else {
            echo "<script>
                    alert('Error al eliminar el empleado: " . $conexion->error . "');
                    window.location.href = 'URDempleados.php'; // Redirigir en caso de error
                  </script>";
        }
    } else {
        echo "<script>
                alert('ID no válido.');
                window.location.href = 'URDempleados.php'; 
                  </script>";
    }
?>
