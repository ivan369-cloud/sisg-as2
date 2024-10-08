<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../01-citas/css/styles.css">
    <link rel="stylesheet" href="../css/microservice.css">
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="register.php" method="POST">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="id_cargo">Cargo:</label>
        <select id="id_cargo" name="id_cargo" required>
            <option value="">Cargando cargos...</option>
        </select>
        
        <button type="submit">Registrar</button>        
    </form>

    <script>
        // Llamada AJAX para obtener los cargos desde el microservicio
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost:3000/cargos')
                .then(response => response.json())
                .then(data => {
                    const cargoSelect = document.getElementById('id_cargo');
                    cargoSelect.innerHTML = ''; // Limpiar opciones previas
                    if (data.length > 0) {
                        data.forEach(cargo => {
                            const option = document.createElement('option');
                            option.value = cargo.id;
                            option.textContent = cargo.cargos;
                            cargoSelect.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No hay cargos disponibles';
                        cargoSelect.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error al cargar los cargos:', error);
                    const cargoSelect = document.getElementById('id_cargo');
                    cargoSelect.innerHTML = '<option value="">Error al cargar cargos</option>';
                });
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $id_cargo = intval($_POST['id_cargo']); // Convertimos a entero

        $data = [
            'nombre' => $nombre,
            'usuario' => $usuario,
            'contraseña' => $password,
            'id_cargo' => $id_cargo
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents('http://localhost:3000/register', false, $context);
        if ($result === FALSE) {
            echo "<p>Error al registrar el usuario.</p>";
        } else {
            // echo "<p>Usuario registrado exitosamente.</p>";
            header("Location: ../user/menu_users.html");
        }
    }
    ?>
</body>
</html>

