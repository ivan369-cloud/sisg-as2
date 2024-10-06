<?php
include "db.php";

$query = "SELECT ID_med, nombre_med, apellido_med FROM medicos";
$result = $conexion->query($query);
$medicos = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $medicos[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/registros.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <title>Pacientes</title>
</head>
<body>
    <form id="form-pacientes">
        <div class="img"></div>
            <div class="text">
                <font face="snubnose demo">
                   <h1>¡Registro Pacientes!</h1>
                </font>

                <label>DPI: </label>
                <input type="text" placeholder="Ingrese No. DPI" name="dpi"><br> <br>

                <label>Primer Nombre: </label>
                <input type="text" placeholder="Ingrese el primer nombre" name="primer_nombre"><br> <br>

                <label>Segundo Nombre: </label>
                <input type="text" placeholder="Ingrese el segundo nombre" name="segundo_nombre"><br> <br>

                <label>Primer Apellido: </label>
                <input type="text" placeholder="Ingrese el primer apellido" name="primer_apellido"><br><br>

                <label>Segundo Apellido: </label>
                <input type="text" placeholder="Ingrese el segundo apellido" name="segundo_apellido"><br><br>

                <label>Edad: </label>
                <input type="number" placeholder="Ingrese la edad del paciente" name="edad"><br> <br>
                        
                <label for="genero">Genero:</label>
                <select id="genero" name="genero">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select><br><br>

                <label>Correo Electrónico: </label>
                <input type="email" placeholder="Ingrese el correo electronico" name="correopaciente"><br><br>

                <label>Fecha de Nacimiento: </label>
                <input type="date" name="fecha_nac"><br><br>

                <label>Dirección: </label>
                <input type="text" placeholder="Ingrese dirección" name="direpaciente"><br><br>

                <label>Teléfono: </label>
                <input type="tel" placeholder="Ingrese Teléfono" name="telepaciente"><br><br>

                <label>Observaciones: </label>
                <input type="text" placeholder="Ingrese dirección" name="obspaciente"><br><br>

                <label>Médico Encargado: </label>
                <select name="medicoencargado">
                    <option value="">Seleccione un médico</option>
                    <?php foreach ($medicos as $medico): ?>
                        <option value="<?php echo $medico['ID_med']; ?>">
                            <?php echo $medico['ID_med'] . ' ' . $medico['nombre_med'] . ' ' . $medico['apellido_med'];?>
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

                <button type="submit" name="btnregistrar" value="ok">Registrar</button>

            </div>

            <div id="alert-container"></div>

            <div class="franja">         
                <a href="MenuPacientes.html" id="Regreso">
                    <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
                </a>
            </div>

            
    </form>

    <script>
        $(document).ready(function() {
            $("#form-pacientes").on("submit", function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "regPacientes.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {

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
