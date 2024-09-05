<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Datos para enviar al microservicio
    $data = [
        'username' => $username,
        'password' => $password
    ];

    // Convertir los datos a formato JSON
    $jsonData = json_encode($data);

    // Inicializar cURL
    $ch = curl_init('https://microservice-users-production-81bc.up.railway.app/login');

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
        // Redirigir a admin.php en caso de inicio de sesión exitoso
        header('Location: ../admin.php');
        exit(); // Importante para detener la ejecución del script después de la redirección
    }

    // Cerrar la conexión cURL
    curl_close($ch);
}
?>

