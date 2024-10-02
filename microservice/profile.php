<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <!-- <link rel="stylesheet" href="css/microservice.css"> -->
    <link rel="stylesheet" href="../css/microservice.css">
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <form action="profile.php" method="GET">
        <label for="user_id">ID de Usuario:</label>
        <input type="number" id="user_id" name="user_id" required>
        <button type="submit">Consultar Perfil</button>
        <a href="../admin.php">Regresar</a>
    </form>

    <?php
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];

        // $result = file_get_contents("https://microservice-users-production-81bc.up.railway.app/profile/$userId");
        $result = file_get_contents("http://localhost:3000/profile/$userId");

        if ($result === FALSE) {
            echo "<p>Error al consultar el perfil.</p>";
        } else {
            $user = json_decode($result, true);
            echo "<h2>Información del Usuario</h2>";
            echo "<p>Nombres: " . htmlspecialchars($user['nombre']) . "</p>";
            echo "<p>Usuario: " . htmlspecialchars($user['usuario']) . "</p>";
            echo "<p>ID Cargo: " . htmlspecialchars($user['id_cargo']) . "</p>";
        }
    }
    ?>
</body>
</html>
