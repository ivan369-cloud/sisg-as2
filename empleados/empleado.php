<?php
$conn = new mysqli("localhost", "root", "", "sisg");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['id_empleado'])) {
    $id_empleado = $_GET['id_empleado'];
    $sql = "SELECT * FROM empleados WHERE id_empleado = $id_empleado";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Empleado no encontrado"]);
    }
    $conn->close();
    exit;
}

$sql = "SELECT id_empleado, nombre, apellido, area FROM empleados";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<option value='nuevo'>Nuevo empleado</option>";
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_empleado'] . "'>" . $row['id_empleado'] . " - " . $row['nombre'] . ' ' . $row['apellido'] . ' - ' . $row['area'] . "</option>";
    }
} else {
    echo "<option>No hay empleados</option>";
}

$conn->close();
