<?php
    include "../db.php";
    $id = $_GET["id"];

    // Asegúrate de que el ID sea numérico para evitar inyecciones SQL
    if (is_numeric($id)) {
        $sql = $conexion->query("DELETE FROM medicos WHERE ID_med = $id");

        if ($sql) {
            echo "<script>
                    alert('Médico eliminado con éxito.');
                    window.location.href = 'URDmedicos.php'; // Redirigir después de eliminar
                  </script>";
        } else {
            echo "<script>
                    alert('Error al eliminar el médico: " . $conexion->error . "');
                    window.location.href = 'URDmedicos.php'; // Redirigir en caso de error
                  </script>";
        }
    } else {
        echo "<script>
                alert('ID no válido.');
                window.location.href = 'URDmedicos.php'; 
              </script>";
    }
?>
