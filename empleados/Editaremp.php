<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/registros.css">
    <title>Editar Empleado</title>
</head>
<body>

<form id="form-empleados" method="POST" action="">
        <div class="img"></div>
            <div class="text">
                <font face="snubnose demo">
                   <h1>¡Editar Empleado!</h1> 
                </font>

                <?php
                    include "../db.php";
                    $id = $_GET["id"];
                    $sql = $conexion->query("SELECT * FROM empleados WHERE id_empleado = $id");

                    include "modificar_empleado.php";

                    if ($sql) {
                        while ($datos = $sql->fetch_object()) { ?>
                            
                            <input type="hidden" name="id" value="<?= $id ?>">
                            
                            <label>DPI: </label>
                            <input type="text" placeholder="Ingrese No. DPI" name="dpi" value="<?= $datos->dpi ?>"><br> <br>

                            <label>Nombre: </label>
                            <input type="text" placeholder="Ingrese nombre" name="nombre" value="<?= $datos->nombre ?>"><br> <br>

                            <label>Apellido: </label>
                            <input type="text" placeholder="Ingrese apellido" name="apellido" value="<?= $datos->apellido ?>"><br><br>

                            <label>Edad: </label>
                            <input type="text" placeholder="Ingrese edad" name="edad" value="<?= $datos->edad ?>"><br><br>
                            
                            <label for="sexo">Sexo:</label>
                            <select id="sexo" name="sexo">
                                <option value="Femenino" <?= $datos->sexo == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                                <option value="Masculino" <?= $datos->sexo == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                            </select><br><br>
                            
                            <label>Correo Electrónico: </label>
                            <input type="email" placeholder="Ingrese correo" name="email" value="<?= $datos->email ?>"><br><br>

                            <label>Teléfono: </label>
                            <input type="tel" placeholder="Ingrese Teléfono" name="telefono" value="<?= $datos->telefono ?>"><br> <br>
                            
                            <label>Área: </label>
                            <input type="text" placeholder="Ingrese área" name="area" value="<?= $datos->area ?>"><br><br>

                            <button type="submit" name="btnactualizar" value="ok">Actualizar</button> 
                        <?php        
                        }
                    } else {
                        echo "Error en la consulta SQL: " . $conexion->error;
                    }
                ?>
            </div>

            <div class="franja">
                <a href="Menuempleados.html" id="Regreso">
                    <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
                </a>
            </div>
    </form>
</body>
</html>
