<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/registros.css">
    <title>Editar Medico</title>
</head>
<body>

<form id="form-medicos" method="POST" action="">
        <div class="img"></div>
            <div class="text">
                <font face="snubnose demo">
                   <h1>¡Editar Médico!</h1> 
                </font>

                <?php
                    include "../db.php";
                    $id = $_GET["id"];
                    $sql=$conexion->query(" select * from medicos where ID_med = $id ");

                    include "modificar_medico.php";

                    if ($sql) {
                        while ($datos = $sql->fetch_object()) {?>
                            
                            <input type="hidden" name="id" value="<?= $id ?>">
                            
                            <label>Nombre: </label>
                            <input type="text" placeholder="Ingrese nombre" name="nombre" value="<?= $datos->nombre_med?>"><br> <br>

                            <label>Apellido: </label>
                            <input type="text" placeholder="Ingrese apellido" name="apellido" value="<?= $datos->apellido_med?>"><br><br>
                                    
                            <label for="especialidad">Especialidad médica:</label>
                            <select id="especialidad" name="especialidad">
                                <option value="Cardiologia" <?= $datos->especialidad == 'Cardiologia' ? 'selected' : '' ?>>Cardiología</option>
                                <option value="Pediatria" <?= $datos->especialidad == 'Pediatria' ? 'selected' : '' ?>>Pediatría</option>
                                <option value="Dermatologia" <?= $datos->especialidad == 'Dermatologia' ? 'selected' : '' ?>>Dermatología</option>
                                <option value="Neurologia" <?= $datos->especialidad == 'Neurologia' ? 'selected' : '' ?>>Neurología</option>
                                <option value="Ginecologia" <?= $datos->especialidad == 'Ginecologia' ? 'selected' : '' ?>>Ginecología</option>
                                <option value="Urologia" <?= $datos->especialidad == 'Urologia' ? 'selected' : '' ?>>Urología</option>
                                <option value="Oftalmologia" <?= $datos->especialidad == 'Oftalmologia' ? 'selected' : '' ?>>Oftalmología</option>
                                <option value="Psiquiatria" <?= $datos->especialidad == 'Psiquiatria' ? 'selected' : '' ?>>Psiquiatría</option>
                                <option value="Traumatologia" <?= $datos->especialidad == 'Traumatologia' ? 'selected' : '' ?>>Traumatología</option>
                                <option value="Oncologia" <?= $datos->especialidad == 'Oncologia' ? 'selected' : '' ?>>Oncología</option>
                            </select><br><br>

                            <label>Colegiado: </label>
                            <input type="text" placeholder="No. de colegiado" name="colegiado" value="<?= $datos->colegiado?>"><br><br>
                            
                            <label>DPI: </label>
                            <input type="text" placeholder="Ingrese No. DPI" name="dpimedico" value="<?= $datos->dpi?>"><br> <br>
                            
                            <label>Correo Electrónico: </label>
                            <input type="email" placeholder="Ingrese correo" name="correomedico" value="<?= $datos->correo?>"><br><br>

                            <label>Teléfono: </label>
                            <input type="tel" placeholder="Ingrese Teléfono" name="telamedico" value="<?= $datos->telefono?>"><br> <br>
                            
                            <label>Dirección: </label>
                            <input type="text" placeholder="Ingrese dirección" name="diremedico" value="<?= $datos->direccion?>"><br><br>
                            
                            <label for="sexo">Sexo:</label>
                            <select id="sexo" name="sexo">
                                <option value="Femenino" <?= $datos->sexo == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                                <option value="Masculino" <?= $datos->sexo == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                            </select><br><br>
                                
                            <label>Fecha de Nacimiento: </label>
                            <input type="date" name="fecha_nac" value="<?= $datos->fecha_nacimiento?>"><br><br>

                            <button type="submit" name="btnactualizar" value="ok">Actualizar</button> 
                        <?php        
                        }
                        
                    }else {
                            echo "Error en la consulta SQL: " . $conexion->error;
                        }
                ?>

            </div>

            <div class="franja">
                <a href="URDmedicos.php" id="Regreso">
                    <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
                </a>
            </div>
    </form>
</body>
</html>
