<?php
//Desarrollo
include('../db.php');
//Produccion 
// include('db_azure.php');

// Consultar los pacientes
$sql_pacientes = "SELECT id_paciente, primer_nombre, primer_apellido FROM pacientes ";
$result_pacientes = $conexion->query($sql_pacientes);
if (!$result_pacientes) {
    die("Error en consulta de pacientes: " . $conexion->error);
}

// Consultar los médicos
$sql_medicos = "SELECT ID_med, nombre_med, apellido_med FROM medicos";
$result_medicos = $conexion->query($sql_medicos);
if (!$result_medicos) {
    die("Error en consulta de médicos: " . $conexion->error);
}

// Consultar los horarios disponibles
$sql_horarios = "SELECT id, hora_inicio, hora_fin FROM horario";
$result_horarios = $conexion->query($sql_horarios);
if (!$result_horarios) {
    die("Error en consulta de horarios: " . $conexion->error);
}

// Consultar los motivos
$sql_motivos = "SELECT id, descripcion FROM motivo";
$result_motivos = $conexion->query($sql_motivos);
if (!$result_motivos) {
    die("Error en consulta de motivos: " . $conexion->error);
}

// Inicializar variables para mantener los valores seleccionados
$selected_paciente = '';
$selected_medico = '';
$selected_horario = '';
$selected_motivo = '';

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_paciente = $_POST['id_paciente'];
    $id_medico = $_POST['id_medico'];
    $id_horario = $_POST['id_horario'];
    $fecha = $_POST['fecha'];
    $id_motivo = $_POST['id_motivo'];  // Capturar el motivo seleccionado

    // Comprobar si el paciente, médico, horario y motivo existen
    $sql_check = "SELECT * FROM pacientes WHERE id_paciente = '$id_paciente'";
    $resultado_check = $conexion->query($sql_check);
    if ($resultado_check->num_rows === 0) {
        die("El paciente no existe.");
    }

    $sql_check_medico = "SELECT * FROM medicos WHERE ID_med = '$id_medico'";
    $resultado_check_medico = $conexion->query($sql_check_medico);
    if ($resultado_check_medico->num_rows === 0) {
        die("El médico no existe.");
    }

    $sql_check_horario = "SELECT * FROM horario WHERE id = '$id_horario'";
    $resultado_check_horario = $conexion->query($sql_check_horario);
    if ($resultado_check_horario->num_rows === 0) {
        die("El horario no existe.");
    }

    $sql_check_motivo = "SELECT * FROM motivo WHERE id = '$id_motivo'";
    $resultado_check_motivo = $conexion->query($sql_check_motivo);
    if ($resultado_check_motivo->num_rows === 0) {
        die("El motivo no existe.");
    }

    // Comprobar si el horario ya está ocupado para ese médico en la misma fecha
    $sql_verificacion = "SELECT * FROM citas WHERE id_medico = '$id_medico' AND id_horario = '$id_horario' AND fecha = '$fecha'";
    $resultado_verificacion = $conexion->query($sql_verificacion);

    // Guardar los valores seleccionados
    $selected_paciente = $id_paciente;
    $selected_medico = $id_medico;
    $selected_horario = $id_horario;
    $selected_motivo = $id_motivo;

    if ($resultado_verificacion->num_rows > 0) {
        // Si ya existe una cita con ese médico, horario y fecha
        echo "<div class='alert alert-danger'>Este horario ya está ocupado. Por favor, selecciona otro u otra fecha.</div>";
    } else {
        // Si no está ocupado, proceder con la inserción
        $sql = "INSERT INTO citas (id_paciente, id_medico, id_horario, fecha, id_estado, id_motivo)
                VALUES ('$id_paciente', '$id_medico', '$id_horario', '$fecha', 1, '$id_motivo')";

        if ($conexion->query($sql) === TRUE) {
            header("Location: menu_citas.html");
            exit(); // Asegúrate de salir después de redirigir
        } else {
            die("Error: " . $sql . "<br>" . $conexion->error); // Cambiado para mostrar errores
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agendar Cita</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
</head>

<body>
    <div class="container">
        <h1>Agendar Cita</h1>
        <form action="" method="POST">
            <!-- Lista desplegable para Pacientes -->
            <div class="form-group">
                <label for="id_paciente">Paciente:</label>
                <select id="id_paciente" name="id_paciente" class="form-control" required>
                    <option value="">Seleccione un paciente</option>
                    <?php while ($paciente = $result_pacientes->fetch_assoc()): ?>
                        <option value="<?php echo $paciente['id_paciente']; ?>" <?php echo ($paciente['id_paciente'] == $selected_paciente) ? 'selected' : ''; ?>>
                            <?php echo $paciente['primer_nombre'] . ' ' . $paciente['primer_apellido']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Lista desplegable para Médicos -->
            <div class="form-group">
                <label for="id_medico">Médico:</label>
                <select id="id_medico" name="id_medico" class="form-control" required>
                    <option value="">Seleccione un médico</option>
                    <?php while ($medico = $result_medicos->fetch_assoc()): ?>
                        <option value="<?php echo $medico['ID_med']; ?>" <?php echo ($medico['ID_med'] == $selected_medico) ? 'selected' : ''; ?>>
                            <?php echo $medico['nombre_med'] . ' ' . $medico['apellido_med']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Lista desplegable para Horarios -->
            <div class="form-group">
                <label for="id_horario">Horario:</label>
                <select id="id_horario" name="id_horario" class="form-control" required>
                    <option value="">Seleccione un horario</option>
                    <?php while ($horario = $result_horarios->fetch_assoc()): ?>
                        <option value="<?php echo $horario['id']; ?>" <?php echo ($horario['id'] == $selected_horario) ? 'selected' : ''; ?>>
                            <?php echo $horario['hora_inicio'] . ' - ' . $horario['hora_fin']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Lista desplegable para Motivo -->
            <div class="form-group">
                <label for="id_motivo">Motivo:</label>
                <select id="id_motivo" name="id_motivo" class="form-control" required>
                    <option value="">Seleccione un motivo</option>
                    <?php while ($motivo = $result_motivos->fetch_assoc()): ?>
                        <option value="<?php echo $motivo['id']; ?>" <?php echo ($motivo['id'] == $selected_motivo) ? 'selected' : ''; ?>>
                            <?php echo $motivo['descripcion']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Campo de Fecha -->
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input id="fecha" type="date" name="fecha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="menu_citas.html" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>