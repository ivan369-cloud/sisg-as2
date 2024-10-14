<?php
// Cargar configuración
$config = include('config.php');

// Iniciar sesión
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Datos para enviar al microservicio
    $data = [
        'usuario' => $username,
        'contraseña' => $password
    ];

    // Convertir los datos a formato JSON
    $jsonData = json_encode($data);

    // URL del microservicio desde la configuración
    $microserviceUrl = $config['microservice_url'];

    // Inicializar cURL
    $ch = curl_init($microserviceUrl);

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Ejecutar la solicitud
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verificar si hubo un error
    if (curl_errno($ch)) {
        echo "<p>Error al conectar con el servicio: " . curl_error($ch) . "</p>";
    } elseif ($httpCode >= 400) {
        // Manejar errores HTTP
        echo "<p>Error al iniciar sesión: Código de respuesta $httpCode</p>";
    } else {
        // Decodificar la respuesta JSON
        $responseData = json_decode($response, true);

        // Verificar si los campos 'id', 'id_cargo' y 'usuario' están presentes en la respuesta
        if (isset($responseData['id'], $responseData['id_cargo'], $responseData['usuario'])) {
            $idUsuario = $responseData['id'];
            $idCargo = $responseData['id_cargo'];
            $nombreUsuario = $responseData['usuario'];

            // Almacenar el nombre e ID del usuario en la sesión
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $_SESSION['idUsuario'] = $idUsuario;
            $_SESSION['idCargo'] = $idCargo;

            // Redirigir según el rol
            if ($idCargo == 1 || $idCargo == 2) {
                header("Location: ../admin.php");
            } elseif ($idCargo == 3) {
                header("Location: ../vista_empleado.php");
            } elseif ($idCargo == 4) {
                header("Location: ../vista_medico.php");
            } else {
                echo "<p>Rol no autorizado</p>";
            }
            exit(); // Detener la ejecución después de la redirección
        } else {
            echo "<p>Error al iniciar sesión: Respuesta inesperada del servidor</p>";
        }
    }

    // Cerrar la conexión cURL
    curl_close($ch);
}
?>

