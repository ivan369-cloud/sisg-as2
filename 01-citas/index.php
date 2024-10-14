<?php
// Desarrollo
include('../db.php');
// Producción 
// include('db_azure.php');

// Consulta para obtener las citas
$sql = "SELECT citas.id, pacientes.primer_nombre AS paciente, medicos.nombre_med AS medico, horario.hora_inicio, horario.hora_fin, citas.fecha
        FROM citas
        JOIN pacientes ON citas.id_paciente = pacientes.id_paciente
        JOIN medicos ON citas.id_medico = medicos.ID_med
        JOIN horario ON citas.id_horario = horario.id";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Century Gothic';
            justify-content: center;
            align-items: center;
        }
        h1 {
            color: #007BFF;
            font-size: 3em;
            margin-bottom: 2rem;
            text-align: center;
        }
        table {
            background-color: white;
        }
        .btn-regresar {
            position: absolute;
            top: 10px;
            left: 10px;
            text-decoration: none;
        }
        .imgRegreso {
            width: 40px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Gestión de Citas</h1>
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['paciente']; ?></td>
                    <td><?php echo $row['medico']; ?></td>
                    <td><?php echo $row['hora_inicio'] . ' - ' . $row['hora_fin']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>"><img src="Img/Icons/edit.png" alt="Editar" width="30" height="30"></a>
                        <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">
                            <img src="Img/Icons/delete.png" alt="Eliminar" width="30" height="30">
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <a href="menu_citas.php" class="btn-regresar">
        <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
    </a>

    <!-- Modal de confirmación -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmación de Eliminación</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar esta cita?</p>
                </div>
                <div class="modal-footer">
                    <a id="confirmDeleteBtn" class="btn btn-danger">Confirmar</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            // Configura el enlace del botón de confirmación con el ID de la cita
            document.getElementById("confirmDeleteBtn").href = "delete.php?id=" + id;
            // Muestra el modal de confirmación
            $('#confirmModal').modal('show');
        }
    </script>
</body>
</html>


