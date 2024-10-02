document.addEventListener("DOMContentLoaded", function() {
    cargarEmpleados();

    function cargarEmpleados() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "empleado.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById("empleadoID").innerHTML = xhr.responseText;
            } else {
                console.error("Error al cargar empleados");
            }
        };
        xhr.send();
    }

    document.getElementById("empleadoID").addEventListener("change", function() {
        const id = this.value;

        if (id === "nuevo") {
            resetFormulario(); 
            document.getElementById("guardarBtn").disabled = false;
        } else {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `empleado.php?id_empleado=${id}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const empleado = JSON.parse(xhr.responseText);
                    if (!empleado.error) {
                        document.getElementById("dpi").value = empleado.dpi;
                        document.getElementById("nombre").value = empleado.nombre;
                        document.getElementById("apellido").value = empleado.apellido;
                        document.getElementById("edad").value = empleado.edad;
                        document.getElementById("sexo").value = empleado.sexo;
                        document.getElementById("email").value = empleado.email;
                        document.getElementById("telefono").value = empleado.telefono;
                        document.getElementById("area").value = empleado.area;

                        document.getElementById("guardarBtn").disabled = true; 
                        limpiarErrores();
                    }
                }
            };
            xhr.send();
        }
    });

    function resetFormulario() {
        document.getElementById("empleadoForm").reset(); 
        document.getElementById("empleadoID").value = "nuevo";
        document.getElementById("guardarBtn").disabled = false;
        limpiarErrores();
    }
    
    function limpiarErrores() {
        document.getElementById("errorDPI").textContent = "";
        document.getElementById("errorNombre").textContent = "";
        document.getElementById("errorApellido").textContent = "";
        document.getElementById("errorTelefono").textContent = "";
        document.getElementById("errorEmail").textContent = "";
        document.getElementById("errorEdad").textContent = "";
    }

    function validarFormulario() {
        const dpi = document.getElementById("dpi").value;
        const eDPI = document.getElementById("errorDPI");
        const nombre = document.getElementById("nombre").value;
        const eNombre = document.getElementById("errorNombre");
        const apellido = document.getElementById("apellido").value;
        const eApellido = document.getElementById("errorApellido");
        const telefono = document.getElementById("telefono").value;
        const eTelefono = document.getElementById("errorTelefono");
        const email = document.getElementById("email").value;
        const erEmail = document.getElementById("errorEmail");
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        const edad = document.getElementById("edad").value;
        const erEdad = document.getElementById("errorEdad");
        const area = document.getElementById("area").value;

        let validacion = 0;

        if (dpi.length !== 13 || isNaN(dpi)) {
            eDPI.textContent = "El DPI debe tener 13 dígitos y solo debe contener números.";
        } else { 
            validacion++;
            eDPI.textContent = "";
        }

        if (nombre === "") {
            eNombre.textContent = "Por favor ingrese el nombre del empleado.";
        } else { 
            validacion++;
            eNombre.textContent = "";
        }

        if (apellido === "") {
            eApellido.textContent = "Por favor ingrese el apellido del empleado.";
        } else { 
            validacion++;
            eApellido.textContent = "";
        }

        if (telefono.length < 8 || isNaN(telefono) || telefono.length > 15) {
            eTelefono.textContent = "El teléfono debe tener al menos 8 dígitos y solo debe contener números.";
        } else { 
            validacion++;
            eTelefono.textContent = "";
        }

        if (!emailPattern.test(email)) {
            erEmail.textContent = "¡Dirección de correo electrónico inválida!";
        } else { 
            validacion++;
            erEmail.textContent = "";
        }

        if (edad.length !== 2 || isNaN(edad)) {
            erEdad.textContent = "Por favor ingrese una edad válida (solo 2 dígitos y debe ser un número).";
        } else { 
            validacion++;
            erEdad.textContent = "";
        }

        if (area === "") {
            alert("Debes seleccionar un área.");
        } else { 
            validacion++;
        }

        if (validacion === 7) {
            return true;
        } else {
            return false;
        }
    }


    document.getElementById("guardarBtn").addEventListener("click", function(e) {
        e.preventDefault();
        if (validarFormulario()) {
            guardarEmpleado();
        }
    });

    document.getElementById("modificarBtn").addEventListener("click", function(e) {
        e.preventDefault();
        if (validarFormulario()) {
            modificarEmpleado();
        }
    });

    document.getElementById("eliminarBtn").addEventListener("click", function(e) {
            eliminarEmpleado();
    });

    function guardarEmpleado() {
        const formData = new FormData(document.getElementById("empleadoForm"));
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "guardarEmpleado.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                cargarEmpleados();
                resetFormulario();
            } else {
                alert("Error al guardar el empleado");
            }
        };
        xhr.send(formData);
    }

    function modificarEmpleado() {
        const idEmpleado = document.getElementById("empleadoID").value;
        if (idEmpleado === "nuevo") {
            alert("Debe seleccionar un empleado para modificar.");
            return;
        }

        const formData = new FormData(document.getElementById("empleadoForm"));
        formData.append("id_empleado", idEmpleado);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "modificarEmpleado.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                cargarEmpleados();
                resetFormulario();
            } else {
                alert("Error al modificar el empleado");
            }
        };
        xhr.send(formData);
    }

    function eliminarEmpleado() {
        const idEmpleado = document.getElementById("empleadoID").value;
        if (idEmpleado === "nuevo") {
            alert("Debe seleccionar un empleado para eliminar.");
            return;
        }

        const formData = new FormData();
        formData.append("id_empleado", idEmpleado);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminarEmpleado.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                cargarEmpleados(); 
                resetFormulario();
                limpiarErrores();
            } else {
                alert("Error al eliminar el empleado");
            }
        };
        xhr.send(formData);
    }
});