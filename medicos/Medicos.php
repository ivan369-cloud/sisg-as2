<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/registros.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Médicos</title>
</head>
<body>
    <form id="form-medicos">
        <div class="img"></div>
            <div class="text">
                <font face="snubnose demo">
                   <h1>¡Registro Médico!</h1>
                </font>
                <label>Nombre: </label>
                <input type="text" placeholder="Ingrese nombre" name="nombre"><br> <br>

                <label>Apellido: </label>
                <input type="text" placeholder="Ingrese apellido" name="apellido"><br><br>
                        
                <label for="especialidad">Especialidad médica:</label>
                <select id="especialidad" name="especialidad">
                    <option value="Cardiologia">Cardiología</option>
                    <option value="Pediatria">Pediatría</option>
                    <option value="Dermatologia">Dermatología</option>
                    <option value="Neurologia">Neurología</option>
                    <option value="Ginecologia">Ginecología</option>
                    <option value="Urologia">Urología</option>
                    <option value="Oftalmologia">Oftalmología</option>
                    <option value="Psiquiatria">Psiquiatría</option>
                    <option value="Traumatologia">Traumatología</option>
                    <option value="Oncologia">Oncología</option>
                </select><br><br>

                <label>Colegiado: </label>
                <input type="text" placeholder="No. de colegiado" name="colegiado"><br><br>
                
                <label>DPI: </label>
                <input type="text" placeholder="Ingrese No. DPI" name="dpimedico"><br> <br>
                
                <label>Correo Electrónico: </label>
                <input type="email" placeholder="Ingrese correo" name="correomedico"><br><br>

                <label>Teléfono: </label>
                <input type="tel" placeholder="Ingrese Teléfono" name="telamedico"><br> <br>
                
                <label>Dirección: </label>
                <input type="text" placeholder="Ingrese dirección" name="diremedico"><br><br>
                
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo">
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select><br><br>
                    
                <label>Fecha de Nacimiento: </label>
                <input type="date" name="fecha_nac"><br><br>

                <button type="submit" name="btnregistrar" value="ok">Registrar</button>

            </div>

            <div id="alert-container"></div> <!-- Contenedor para las alertas -->

            <div class="franja">
                <a href="Menumedicos.html" id="Regreso">
                    <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
                </a>
            </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#form-medicos").on("submit", function(event) {
                event.preventDefault(); // Evitar el envío tradicional del formulario

                var formData = $(this).serialize();

                $.ajax({
                    url: "regmedicos.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // Mostrar la respuesta del servidor en el contenedor de alertas
                        $("#alert-container").html(response);
                    },
                    error: function() {
                        $("#alert-container").html('<div class="alert alert-danger">Ocurrió un error al enviar los datos.</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
