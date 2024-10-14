<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['idUsuario'];
$currentPassword = $_POST['current_password'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$response = ['success' => false, 'message' => ''];

if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
    $response['message'] = 'Por favor, completa todos los campos.';
    echo json_encode($response);
    exit();
}

if ($newPassword !== $confirmPassword) {
    $response['message'] = 'Las nuevas contraseñas no coinciden.';
    echo json_encode($response);
    exit();
}

$data = [
    'user_id' => $userId,
    'current_password' => $currentPassword,
    'new_password' => $newPassword
];

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    ]
];

$context  = stream_context_create($options);
$result = file_get_contents("http://localhost:3000/update_password", false, $context);

if ($result === FALSE) {
    $response['message'] = 'Error al actualizar la contraseña. Intenta de nuevo más tarde.';
    echo json_encode($response);
    exit();
}

$responseData = json_decode($result, true);
if (isset($responseData['success']) && $responseData['success'] === true) {
    $response['success'] = true;
    $response['message'] = 'Contraseña actualizada exitosamente.';
    echo json_encode($response);
    exit();
} else {
    $response['message'] = htmlspecialchars($responseData['message'] ?? 'No se pudo actualizar la contraseña.');
    echo json_encode($response);
}

?>
