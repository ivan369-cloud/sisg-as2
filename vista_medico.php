<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/nom_user.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos para el botón de perfil */
        .profile-button {
            background-color: #007BFF;
            /* Color de fondo */
            color: white;
            /* Color del texto */
            border: none;
            /* Sin borde */
            border-radius: 5px;
            /* Bordes redondeados */
            padding: 10px 15px;
            /* Espaciado interno */
            font-size: 16px;
            /* Tamaño de fuente */
            cursor: pointer;
            /* Cambiar el cursor al pasar el mouse */
            transition: background-color 0.3s;
            /* Efecto de transición al cambiar el color de fondo */
            margin-top: 10px;
            /* Espacio arriba del botón */
        }

        .profile-button:hover {
            background-color: #0056b3;
            /* Color de fondo al pasar el mouse */
        }

        /* Ajuste de la clase nombre-usuario para centrar contenido */
        .nombre-usuario {
            display: flex;
            flex-direction: column;
            /* Cambiar a columna */
            align-items: center;
            /* Centrar horizontalmente */
            margin: 10px;
            /* Espacio alrededor del contenedor */
        }
    </style>
</head>

<body>
    <!-- Menú de navegación -->
    <nav>
        <ul class="menu">
            <!-- <li><a href="empleados/Menuempleados.php">Empleados</a></li> -->
            <!-- <li><a href="medicos/Menumedicos.html">Médicos</a></li> -->
            <!-- <li><a href="medicos/menu_medico.php">Médicos</a></li> -->
            <!-- <li><a href="pacientes/menu_paciente.php">Pacientes</a></li> -->
            <!-- <li><a href="pacientes/Menupacientes.html">Pacientes</a></li> -->
            <li><a href="01-citas/menu_citas.php">Citas</a></li>
            <li><a href="index.html">Cerrar sesión</a></li>
            <?php
            session_start(); // Iniciar la sesión para acceder a las variables de sesión

            // Verificar si el nombre del usuario está almacenado en la sesión
            if (isset($_SESSION['nombreUsuario'])) {
                $nombreUsuario = $_SESSION['nombreUsuario'];
            } else {
                $nombreUsuario = 'Usuario'; // Valor predeterminado si no hay sesión activa
            }
            ?>
            <!-- Mostrar solo el nombre del usuario -->
            <div class="nombre-usuario">
                <i class="fas fa-user"></i> <!-- Ícono de usuario -->
                <p><?php echo $nombreUsuario; ?></p>
                <!-- Botón para redirigir a profile.php, pasando el ID de usuario en la URL -->
                <button onclick="window.location.href='./microservice/profile.php?user_id=<?php echo $_SESSION['idUsuario'] ?? ''; ?>'" class="profile-button">Ver Perfil</button>
            </div>
        </ul>
    </nav>

    <img src="IMG/LogoSinFondo2.png" alt="SISG" style="width: 30%; vertical-align: middle; margin-right: 8px;">
</body>

</html>