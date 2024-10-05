<?php
//Desarrollo
include('db.php');
//Produccion 
// include('db_azure.php');
// Consulta para obtener las citas
$sql = "SELECT citas.id, pacientes.nombre AS paciente, medicos.nombre AS medico, horario.hora_inicio, horario.hora_fin, citas.fecha
        FROM citas
        JOIN pacientes ON citas.id_paciente = pacientes.id
        JOIN medicos ON citas.id_medico = medicos.id
        JOIN horario ON citas.id_horario = horario.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<style>
  body {
    font-family: 'Century Gothic';
    justify-content: center;
    align-items: center;
  }
  h1{
    color: #007BFF;
    font-size: 3em;
    margin-bottom: 2rem;
  }
  table{
    background-color:white;
  }
</style>
<div class="container">
    <h2 class="mt-4">Gestión de Citas</h2>
    <a href="menu_citas.html" class="btn btn-secondary">Salir</a><br>
    <table class="table table-bordered">
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
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
