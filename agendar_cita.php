<?php
// Función para redirigir con un mensaje
function redirigirConMensaje($mensaje, $tipo) {
    echo "<script>
            alert('$mensaje');
            window.location.href = 'index.html';
          </script>";
    exit();
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $doctor = $_POST['doctor'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Configurar la URL del microservicio
    $url = 'https://microservicio-production.up.railway.app/agendar_cita';

    // Preparar los datos para enviar como JSON
    $data = array(
        'nombre' => $nombre,
        'especialidad' => $especialidad,
        'doctor' => $doctor,
        'fecha' => $fecha,
        'hora' => $hora
    );

    // Configurar la petición cURL
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);

    // Enviar la solicitud al microservicio
    $result = file_get_contents($url, false, $context);

    // Verificar la respuesta
    if ($result === FALSE) {
        redirigirConMensaje('Error al agendar la cita', 'error');
    } else {
        redirigirConMensaje('Cita agendada exitosamente.', 'success');
    }
}
?>

