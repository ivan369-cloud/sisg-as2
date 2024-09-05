<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../css/microservice.css">
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="register.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Registrar</button>
        <a href="login.html">Iniciar Sesion</a>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $data = [
            'username' => $username,
            'password' => $password,
            'email' => $email
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents('https://microservice-users-production-81bc.up.railway.app/register', false, $context);

        if ($result === FALSE) {
            echo "<p>Error al registrar el usuario.</p>";
        } else {
            echo "<p>Usuario registrado exitosamente.</p>";
        }
    }
    ?>
</body>
</html>
