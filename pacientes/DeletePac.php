<?php
    include "../db.php";
    $id = $_GET["id"];

    if (is_numeric($id)) {
        $sql = $conexion->query("DELETE FROM pacientes WHERE id_paciente = $id");

        if ($sql) {
            echo "<script>
                    alert('Paciente eliminado con éxito.');
                    window.location.href = 'URDpacientes.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al eliminar el paciente: " . $conexion->error . "');
                    window.location.href = 'URDpacientes.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('ID no válido.');
                window.location.href = 'URDpacientes.php'; 
              </script>";
    }
?>
