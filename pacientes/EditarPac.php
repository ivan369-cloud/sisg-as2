<?php
include "db.php";

$id = $_GET["id"];
$sql_paciente = $conexion->query("SELECT * FROM pacientes WHERE id_paciente = $id");

$sql_medicos = $conexion->query("SELECT ID_med, nombre_med, apellido_med FROM medicos");

$medicos = [];
if ($sql_medicos) {
    while ($row = $sql_medicos->fetch_assoc()) {
        $medicos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/registros.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Editar Pacientes</title>
</head>
<body>

<form id="form-medicos" method="POST" action="">
    <div class="img"></div>
    <div class="text">
        <font face="snubnose demo">
            <h1>¡Editar Pacientes!</h1>
        </font>

        <?php
            include "db.php";
            $id = $_GET["id"];
            $sql = $conexion->query("SELECT * FROM pacientes WHERE id_paciente = $id");
            include "modificar_pacientes.php";

            if ($sql) {
                while ($datos = $sql->fetch_object()) { ?>
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <label>DPI: </label>
                    <input type="number" placeholder="Ingrese DPI" name="dpi" value="<?= $datos->dpi ?>"><br><br>

                    <label>Primer Nombre: </label>
                    <input type="text" placeholder="Ingrese nombre" name="primer_nombre" value="<?= $datos->primer_nombre ?>"><br><br>

                    <label>Segundo Nombre: </label>
                    <input type="text" placeholder="Ingrese nombre" name="segundo_nombre" value="<?= $datos->segundo_nombre ?>"><br><br>

                    <label>Primer Apellido: </label>
                    <input type="text" placeholder="Ingrese apellido" name="primer_apellido" value="<?= $datos->primer_apellido ?>"><br><br>

                    <label>Segundo Apellido: </label>
                    <input type="text" placeholder="Ingrese apellido" name="segundo_apellido" value="<?= $datos->segundo_apellido ?>"><br><br>

                    <label>Edad: </label>
                    <input type="number" placeholder="Ingrese la edad" name="edad" value="<?= $datos->edad ?>"><br><br>

                    <label for="genero">Genero:</label>
                    <select id="genero" name="genero">
                        <option value="Masculino" <?= $datos->genero == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="Femenino" <?= $datos->genero == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                    </select><br><br>

                    <label>Email: </label>
                    <input type="email" placeholder="Ingrese el correo" name="correopaciente" value="<?= $datos->email ?>"><br><br>

                    <label>Fecha de Nacimiento: </label>
                    <input type="date" name="fecha_nac" value="<?= $datos->fecha_nacimiento ?>"><br><br>

                    <label>Dirección: </label>
                    <input type="text" placeholder="Ingrese dirección" name="direpaciente" value="<?= $datos->direccion ?>"><br><br>

                    <label>Teléfono: </label>
                    <input type="tel" placeholder="Ingrese Teléfono" name="telepaciente" value="<?= $datos->telefono?>"><br> <br>

                    <label>Observaciones: </label>
                    <input type="text" placeholder="Ingrese observaciones" name="obspaciente" value="<?= $datos->observaciones ?>"><br><br>

                    <label>Médico Encargado: </label>
                    <select name="medicoencargado">
                        <option value="">Seleccione un médico</option>
                        <?php foreach ($medicos as $medico): ?>
                            <option value="<?= $medico['ID_med'] ?>" <?= $datos->id_medico == $medico['ID_med'] ? 'selected' : '' ?>>
                                <?= $medico['ID_med'] . ' ' . $medico['nombre_med'] . ' ' . $medico['apellido_med'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <button type="submit" name="btnactualizar" value="ok">Actualizar</button>
                <?php }
            } else {
                echo "Error en la consulta SQL: " . $conexion->error;
            }
        ?>
    </div>

    <div id="alert-container"></div>

    <div class="franja">
        <a href="URDpacientes.php" id="Regreso">
            <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
        </a>
    </div>
</form>
</body>
</html>