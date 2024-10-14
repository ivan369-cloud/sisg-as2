<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/microservice.css">
    <style>
        /* Estilos generales para el body */
        body {
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
            align-items: center;
            /* Centra verticalmente */
            height: 100vh;
            /* Ocupa toda la altura de la ventana */
            background-color: #f2f2f2;
            /* Color de fondo */
            font-family: Arial, sans-serif;
            /* Fuente por defecto */
        }

        /* Estilo para el formulario */
        .profile-form {
            background-color: #fff;
            /* Fondo blanco para el formulario */
            padding: 20px;
            /* Espaciado interno */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            /* Sombra */
            width: 350px;
            /* Ancho fijo del formulario */
        }

        /* Estilo para el título del formulario */
        h1 {
            text-align: center;
            /* Centra el título */
            color: #333;
            /* Color del título */
        }

        /* Ocultar el label y el campo de ID de usuario */
        #user_id_label,
        #user_id {
            display: none;
            /* Ocultar el label y el campo */
        }

        /* Estilos para la información del usuario */
        .user-info {
            margin: 20px 0;
            /* Margen vertical */
            padding: 15px;
            /* Espaciado interno */
            border: 1px solid #ccc;
            /* Borde alrededor de la información */
            border-radius: 5px;
            /* Bordes redondeados */
            background-color: #f9f9f9;
            /* Fondo suave */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Sombra sutil */
        }

        .user-info p {
            font-size: 18px;
            /* Tamaño de fuente */
            color: #333;
            /* Color del texto */
            margin: 20px 0;
            /* Espaciado entre párrafos */
        }

        h2 {
            color: #2c3e50;
            /* Color del título */
            margin-bottom: 15px;
            /* Espaciado debajo del título */
        }

        /* Estilos del enlace de regreso */
        a {
            display: inline-block;
            /* Permitir margen */
            margin-top: 15px;
            /* Espaciado encima */
            text-decoration: none;
            /* Sin subrayado */
            color: #2980b9;
            /* Color del enlace */
        }

        a:hover {
            text-decoration: underline;
            /* Subrayar en hover */
        }
    </style>
</head>
<body>
    <div class="profile-form">
        <h1>Perfil de Usuario</h1>
        <?php
        session_start();

        // Recuperar el ID del usuario desde el parámetro de la URL
        $userId = isset($_GET['user_id']) ? $_GET['user_id'] : '';
        $redirectUrl = '#'; // URL por defecto

        if (!empty($userId)) {
            // Consultar el perfil del usuario en el microservicio
            $result = file_get_contents("http://localhost:3000/profile/$userId");

            if ($result === FALSE) {
                echo "<p>Error al consultar el perfil.</p>";
            } else {
                $user = json_decode($result, true);
                echo "<div class='user-info'>";
                echo "<h2>Información del Usuario</h2>";
                echo "<p>Nombres: " . htmlspecialchars($user['nombre']) . "</p>";
                echo "<p>Usuario: " . htmlspecialchars($user['usuario']) . "</p>";
                echo "<p>Cargo: " . htmlspecialchars($user['nombre_cargo']) . "</p>"; // Muestra el nombre del cargo
                echo "</div>";

                // Determinar URL de redirección según el cargo
                if ($user['nombre_cargo'] === 'Admin' || $user['nombre_cargo'] === 'SuperAdmin') {
                    $redirectUrl = '../admin.php';
                } elseif ($user['nombre_cargo'] === 'Empleado') {
                    $redirectUrl = '../vista_empleado.php';
                } elseif ($user['nombre_cargo'] === 'Medico') {
                    $redirectUrl = '../vista_medico.php';
                }
            }
        }
        ?>

        <form action="profile.php" method="GET">
            <label id="user_id_label" for="user_id">ID de Usuario:</label>
            <input type="number" id="user_id" name="user_id" value="<?php echo htmlspecialchars($userId); ?>" readonly>
            <a href="<?php echo $redirectUrl; ?>">Regresar</a>
            <a href="cambiar_password.php">Cambiar contraseña</a>
        </form>
    </div>
</body>
</html>
