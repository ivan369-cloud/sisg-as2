<?php
include('../db.php');
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_horario = $_POST['id_horario'];
    $fecha = $_POST['fecha'];
    $id_motivo = $_POST['id_motivo']; // Añadir motivo a la actualización
    $id_estado = $_POST['id_estado']; // Añadir estado a la actualización

    // Actualizar solo el horario, la fecha, el motivo y el estado
    $sql = "UPDATE citas SET id_horario = '$id_horario', fecha = '$fecha', id_motivo = '$id_motivo', id_estado = '$id_estado' WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} else {
    // Obtener los datos de la cita incluyendo los nombres del paciente y médico
    $sql = "SELECT citas.*, pacientes.primer_nombre AS paciente_nombre, pacientes.primer_apellido AS paciente_apellidos,
            medicos.nombre_med AS medico_nombre, medicos.apellido_med AS medico_apellidos 
            FROM citas 
            JOIN pacientes ON citas.id_paciente = pacientes.id_paciente 
            JOIN medicos ON citas.id_medico = medicos.ID_med
            WHERE citas.id = $id";
    $result = $conexion->query($sql);
    $cita = $result->fetch_assoc();

    // Obtener los horarios disponibles de la base de datos
    $sql_horarios = "SELECT * FROM horario";
    $result_horarios = $conexion->query($sql_horarios);

    // Obtener los motivos disponibles de la base de datos
    $sql_motivos = "SELECT * FROM motivo"; // Asumiendo que la tabla de motivos se llama 'motivos'
    $result_motivos = $conexion->query($sql_motivos);

    // Obtener los estados disponibles de la base de datos
    $sql_estados = "SELECT * FROM estado_cita"; // Asumiendo que la tabla de estados se llama 'estados'
    $result_estados = $conexion->query($sql_estados);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h2>Editar Cita</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="paciente">Paciente:</label>
            <!-- Mostrar el nombre del paciente, pero deshabilitar el campo para evitar edición -->
            <input type="text" name="paciente" class="form-control" value="<?php echo $cita['paciente_nombre'] . ' ' . $cita['paciente_apellidos']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="medico">Médico:</label>
            <!-- Mostrar el nombre del médico, pero deshabilitar el campo para evitar edición -->
            <input type="text" name="medico" class="form-control" value="<?php echo $cita['medico_nombre'] . ' ' . $cita['medico_apellidos']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="id_horario">Horario:</label>
            <!-- Campo de lista desplegable para los horarios -->
            <select name="id_horario" class="form-control" required>
                <?php
                while ($horario = $result_horarios->fetch_assoc()) {
                    // Si el horario es el mismo que el de la cita actual, lo selecciona por defecto
                    $selected = ($horario['id'] == $cita['id_horario']) ? 'selected' : '';
                    echo "<option value='{$horario['id']}' $selected>{$horario['hora_inicio']} - {$horario['hora_fin']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_motivo">Motivo:</label>
            <!-- Campo de lista desplegable para los motivos -->
            <select name="id_motivo" class="form-control" required>
                <option value="">Seleccione un motivo</option>
                <?php
                while ($motivo = $result_motivos->fetch_assoc()) {
                    // Si el motivo es el mismo que el de la cita actual, lo selecciona por defecto
                    $selected = ($motivo['id'] == $cita['id_motivo']) ? 'selected' : '';
                    echo "<option value='{$motivo['id']}' $selected>{$motivo['descripcion']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_estado">Estado:</label>
            <!-- Campo de lista desplegable para los estados -->
            <select name="id_estado" class="form-control" required>
                <option value="">Seleccione un estado</option>
                <?php
                while ($estado = $result_estados->fetch_assoc()) {
                    // Si el estado es el mismo que el de la cita actual, lo selecciona por defecto
                    $selected = ($estado['id'] == $cita['id_estado']) ? 'selected' : '';
                    echo "<option value='{$estado['id']}' $selected>{$estado['descripcion']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <!-- Campo editable para la fecha -->
            <input type="date" name="fecha" class="form-control" value="<?php echo $cita['fecha']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
