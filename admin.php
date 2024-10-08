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
</head>
<body>
    <!-- Menú de navegación -->
    <nav>
        <ul class="menu">            
            <li><a href="empleados/Menuempleados.html">Empleados</a></li>
            <li><a href="medicos/Menumedicos.html">Médicos</a></li>
            <li><a href="pacientes/Menupacientes.html">Pacientes</a></li>
            <li><a href="01-citas/menu_citas.html">Citas</a></li>
            <li><a href="./user/menu_users.html">Usuarios</a></li>
            <li><a href="index.html">Cerrar Sesión</a></li>
            <?php
            session_start(); // Iniciar la sesión para acceder a las variables de sesión

            // Verificar si el nombre del usuario está almacenado en la sesión
            if (isset($_SESSION['nombreUsuario'])) {
                $nombreUsuario = $_SESSION['nombreUsuario'];
            } else {
                $nombreUsuario = 'Usuario'; // Valor predeterminado si no hay sesión activa
            }
            ?>
            <!-- Mostrar el nombre del usuario debajo de "Usuarios" -->
            <div class="nombre-usuario">
                <i class="fas fa-user"></i> <!-- Ícono de usuario -->
                <p><?php echo $nombreUsuario; ?></p>
            </div>
        </ul>
    </nav>
    <img src="IMG/LogoSinFondo2.png" alt="SISG" style="width: 30%; vertical-align: middle; margin-right: 8px;">
</body>
</html>