<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos</title>
    <link rel="stylesheet" href="css/stylemenu.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php
    session_start();

    // Verificar si el nombre del usuario está almacenado en la sesión
    if (isset($_SESSION['idCargo'])) {
        $idCargo = $_SESSION['idCargo'];
    } else {
        $idCargo = ''; // Valor predeterminado si no hay sesión activa
    }

    // echo "<p>Nombre de id cargo es: $idCargo</p>";

    $returnUrl = '#'; // URL por defecto

    // Determinar URL de redirección según el id_cargo
    if ($idCargo == 1 || $idCargo == 2) {
        $returnUrl = '../admin.php';
    } elseif ($idCargo == 3) {
        $returnUrl = '../vista_empleado.php';
    }
    ?>

    <div class="fondo"></div>
    <div class="container">
        <div class="form-container">
            <img src="img/logo.png" alt="Logo del Hospital" class="logo">
            <h1>Pacientes</h1>
            <div class="button-container">
                <button class="animated-button" onclick="location.href='Pacientes.php'">
                    <img src="img/registrar.gif" alt="Registrar" class="button-icon">
                    <span>Registrar</span>
                </button>
                <button class="animated-button" onclick="location.href='URDpacientes.php'">
                    <img src="img/ver.gif" alt="Ver" class="button-icon">
                    <span>Ver</span>
                </button>
                <!-- Botón dinámico para regresar -->
                <button class="animated-button" onclick="location.href='<?php echo $returnUrl; ?>'">
                    <i class="fas fa-arrow-circle-left button-icon"></i>
                    <span>Regresar</span>
                </button>
            </div>
        </div>
    </div>
</body>

</html>