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
        <p><?php echo 'Bienvenido: '.$nombreUsuario; ?></p>
    </div>

    <!-- Menú de navegación -->
    <nav>
        <ul class="menu">
            <li><a href="index.html">Salir</a></li>
            <li><a href="./citas/agendar_cita.html">Citas</a></li>
            <li><a href="empleados/empleado.html">Empleados</a></li>
            <li><a href="empleados/empleado.html">Medicos</a></li>
            <li><a href="empleados/empleado.html">Pacientes</a></li>
            <li><a href="empleados/empleado.html">Recetas</a></li>
            <li><a href="empleados/empleado.html">Usuarios</a></li>
            <!-- <li><a href="microservice/profile.php">Perfil de usario</a></li> 
            <li><a href="public/usuarios.html">Agregar usuarios</a></li>  -->
        </ul>
    </nav>

</body>

</html>