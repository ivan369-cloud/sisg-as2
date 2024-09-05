document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = 'http://localhost:3000/api/users';
    const addUserForm = document.getElementById('addUserForm');
    const updateUserForm = document.getElementById('updateUserForm');
    const usersTableBody = document.querySelector('#usersTable tbody');
    const resultDiv = document.getElementById('result');

    // Función para cargar y mostrar los usuarios
    async function loadUsers() {
        try {
            const response = await fetch(apiUrl);
            const users = await response.json();

            usersTableBody.innerHTML = ''; // Limpiar la tabla antes de actualizar

            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.username}</td>
                    <td class="actions">
                        <button class="deleteBtn" data-id="${user.id}">Eliminar</button>
                    </td>
                `;
                // Añadir evento de clic para seleccionar el usuario en el formulario de actualización
                row.addEventListener('click', () => fillUpdateForm(user));
                usersTableBody.appendChild(row);
            });
        } catch (error) {
            resultDiv.textContent = `Error al cargar los usuarios: ${error.message}`;
        }
    }

    // Función para llenar el formulario de actualización con los datos del usuario seleccionado
    function fillUpdateForm(user) {
        document.getElementById('updateUserId').value = user.id;
        document.getElementById('updateUsername').value = user.username;
        document.getElementById('updatePassword').value = ''; // Deja la contraseña en blanco por seguridad
    }

    // Función para eliminar un usuario con confirmación
    async function deleteUser(id) {
        const confirmation = window.confirm('¿Está seguro de que desea eliminar este usuario?');
        if (confirmation) {
            try {
                const response = await fetch(`${apiUrl}/${id}`, {
                    method: 'DELETE',
                });

                const data = await response.json();

                if (response.ok) {
                    resultDiv.textContent = data.message || 'Usuario eliminado correctamente';
                    loadUsers(); // Recargar la lista de usuarios
                } else {
                    resultDiv.textContent = `Error: ${data.message || 'Usuario no encontrado'}`;
                }
            } catch (error) {
                resultDiv.textContent = `Error: ${error.message}`;
            }
        } else {
            resultDiv.textContent = 'Eliminación cancelada';
        }
    }

    // Añadir manejador para el botón de eliminar
    usersTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('deleteBtn')) {
            e.stopPropagation(); // Evita que el evento se propague al hacer clic en el botón "Eliminar"
            const userId = e.target.getAttribute('data-id');
            deleteUser(userId); // Llamar a la función deleteUser con el ID del usuario
        }
    });

    // Manejar la adición de un nuevo usuario
    addUserForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username, password }),
            });

            const data = await response.json();

            if (response.ok) {
                resultDiv.textContent = `Usuario agregado con ID: ${data.id}`;
                addUserForm.reset();
                loadUsers(); // Recargar la lista de usuarios
            } else {
                resultDiv.textContent = `Error: ${data.error}`;
            }
        } catch (error) {
            resultDiv.textContent = `Error: ${error.message}`;
        }
    });

    // Manejar la actualización de un usuario
    updateUserForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('updateUserId').value;
        const username = document.getElementById('updateUsername').value;
        const password = document.getElementById('updatePassword').value;

        try {
            const response = await fetch(`${apiUrl}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username, password }),
            });

            const data = await response.json();

            if (response.ok) {
                resultDiv.textContent = `Usuario actualizado correctamente`;
                updateUserForm.reset();
                loadUsers(); // Recargar la lista de usuarios
            } else {
                resultDiv.textContent = `Error: ${data.error}`;
            }
        } catch (error) {
            resultDiv.textContent = `Error: ${error.message}`;
        }
    });

    // Cargar los usuarios al cargar la página
    loadUsers();
});
