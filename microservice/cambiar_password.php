<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="../css/microservice.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .password-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .submit-btn {
            padding: 10px;
            background-color: #2980b9;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            width: 48%;
        }

        .submit-btn:hover {
            background-color: #3498db;
        }

        .cancel-btn {
            padding: 10px;
            background-color: #7f8c8d; /* Color gris */
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            width: 48%;
        }

        .cancel-btn:hover {
            background-color: #95a5a6;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .close-btn {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    session_start();

    // Verificar si el nombre del usuario está almacenado en la sesión
    if (isset($_SESSION['idCargo'])) {
        $idCargo = $_SESSION['idCargo'];
    } else {
        $idCargo = ''; // Valor predeterminado si no hay sesión activa
    }

    $returnUrl = '#'; // URL por defecto

    // Determinar URL de redirección según el id_cargo
    if ($idCargo == 1 || $idCargo == 2) {
        $returnUrl = '../admin.php';
    } elseif ($idCargo == 3) {
        $returnUrl = '../vista_empleado.php';
    } elseif ($idCargo == 4) {
        $returnUrl = '../vista_medico.php';
    }
    ?>

    <div class="password-form">
        <h1>Cambiar Contraseña</h1>
        <form id="passwordForm" method="POST">
            <div class="form-group">
                <label for="current_password">Contraseña Actual:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="button-group">
                <button type="submit" class="submit-btn">Actualizar</button>
                <button type="button" class="cancel-btn" onclick="location.href='<?php echo $returnUrl; ?>'">Cancelar</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <button class="close-btn" onclick="closeModal()">Cerrar</button>
        </div>
    </div>

    <script>
        const form = document.getElementById('passwordForm');
        const modal = document.getElementById('errorModal');
        const modalMessage = document.getElementById('modalMessage');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch('procesar_cambio_password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '<?php echo $returnUrl; ?>';
                } else {
                    showModal(data.message);
                }
            })
            .catch(error => {
                showModal('Verifica tu contraseña actual.');
            });
        });

        function showModal(message) {
            modalMessage.textContent = message;
            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }
    </script>
</body>

</html>
