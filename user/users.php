<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Century Gothic';
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            color: #007BFF;
            font-size: 3em;
            margin-bottom: 2rem;
            text-align: center;
        }
        table {
            background-color: white;
            margin-top: 20px;
            width: 80%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-regresar {
            position: absolute;
            top: 10px;
            left: 10px;
            text-decoration: none;
        }
        .imgRegreso {
            width: 40px;
            height: auto;
        }
        .action-icons img {
            cursor: pointer; /* Cambia el cursor a puntero para mejor usabilidad */
        }
    </style>
</head>
<body>
    <h1>Gestión de Usuarios</h1>
    <div class="container">
        <table class="table table-striped table-hover" id="usuarios-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>ID Cargo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos de los usuarios se insertarán aquí -->
            </tbody>
        </table>
    </div>

    <a href="menu_users.html" class="btn-regresar">
        <img src="../01-citas/Img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
    </a>

    <script>
        // Función para cargar los usuarios
        async function cargarUsuarios() {
            try {
                const response = await fetch('http://localhost:3000/usuarios');
                const usuarios = await response.json();
                
                const tableBody = document.getElementById('usuarios-table').getElementsByTagName('tbody')[0];

                usuarios.forEach(usuario => {
                    const row = tableBody.insertRow();
                    row.insertCell(0).innerText = usuario.id;
                    row.insertCell(1).innerText = usuario.nombre;
                    row.insertCell(2).innerText = usuario.usuario;
                    row.insertCell(3).innerText = usuario.id_cargo;

                    // Columna de acciones
                    const actionsCell = row.insertCell(4);
                    actionsCell.className = 'action-icons'; // Clase para aplicar estilos
                    actionsCell.innerHTML = `
                        <a href="update.php?id=${usuario.id}">
                            <img src="../01-citas/Img/Icons/edit.png" alt="Editar" width="30" height="30">
                        </a>                       
                    `;
                });
            } catch (error) {
                console.error('Error al cargar usuarios:', error);
            }
        }

        // Llamar a la función para cargar los usuarios al cargar la página
        document.addEventListener('DOMContentLoaded', cargarUsuarios);
    </script>
</body>
</html>

