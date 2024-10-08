<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Century Gothic';
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .btn-secondary {
            margin-left: 10px;
            background-color: #d3d3d3; /* Fondo gris claro */
            border: none; /* Quitar el borde predeterminado */
            color: #000; /* Cambiar el color del texto si es necesario */
        }
        .btn-secondary:hover {
            background-color: #b0b0b0; /* Cambiar el color de fondo en hover */
        }
        .btn-danger {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Editar Usuario</h2>
    <form id="editUserForm">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="id_cargo">Cargo:</label>
            <select id="id_cargo" name="id_cargo" class="form-control" required>
                <option value="">Seleccione un cargo</option>
                <!-- Opciones de cargo llenadas dinámicamente -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>        
        <button type="button" class="btn btn-danger" onclick="eliminarUsuario()">Eliminar</button>
        <a href="users.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('id');

    async function cargarDatosUsuario() {
        try {
            const response = await fetch(`http://localhost:3000/profile/${userId}`);
            const userData = await response.json();

            document.getElementById('nombre').value = userData.nombre;
            document.getElementById('usuario').value = userData.usuario;
            document.getElementById('id_cargo').value = userData.id_cargo;
        } catch (error) {
            console.error('Error al cargar los datos del usuario:', error);
            alert('Hubo un problema al cargar los datos del usuario.');
        }
    }

    async function cargarOpcionesCargos() {
        try {
            const response = await fetch('http://localhost:3000/cargos');
            const cargos = await response.json();

            const selectCargo = document.getElementById('id_cargo');
            cargos.forEach(cargo => {
                const option = document.createElement('option');
                option.value = cargo.id;
                option.textContent = cargo.cargos;
                selectCargo.appendChild(option);
            });
        } catch (error) {
            console.error('Error al cargar los cargos:', error);
            alert('Hubo un problema al cargar los cargos.');
        }
    }

    cargarOpcionesCargos().then(cargarDatosUsuario);

    async function actualizarUsuario(event) {
        event.preventDefault();

        const id_cargo = document.getElementById('id_cargo').value;

        try {
            const response = await fetch(`http://localhost:3000/usuarios/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_cargo })
            });

            if (response.ok) {
                alert('Usuario actualizado exitosamente');
                window.location.href = 'users.php';
            } else {
                const errorText = await response.text();
                alert(`Error al actualizar el usuario: ${errorText}`);
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
            alert('Hubo un problema con la solicitud.');
        }
    }

    async function eliminarUsuario() {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
            try {
                const response = await fetch(`http://localhost:3000/usuarios/${userId}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    alert('Usuario eliminado exitosamente');
                    window.location.href = 'users.php';
                } else {
                    const errorText = await response.text();
                    alert(`Error al eliminar el usuario: ${errorText}`);
                }
            } catch (error) {
                console.error('Error en la solicitud:', error);
                alert('Hubo un problema con la solicitud.');
            }
        }
    }

    document.getElementById('editUserForm').addEventListener('submit', actualizarUsuario);
</script>
</body>
</html>


