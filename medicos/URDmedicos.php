<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Médicos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<style>
  body {
    font-family: 'Century Gothic';
    justify-content: center;
    align-items: center;
  }
  h1{
    color: #007BFF;
    font-size: 3em;
    margin-bottom: 2rem;
  }
  table{
    background-color:white;
  }
</style>

  <h1><b>Médicos Registrados</b></h1>
    <div class="tablam">
      <div class="container">
      <table class="table table-striped table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Especialidad</th>
                <th>Colegiado</th>
                <th>DPI</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Sexo</th>
                <th>Fecha de Nacimiento</th>
              </tr>
            </thead>
            <tbody>

                <?php
                include "db.php";  
                $sql = $conexion->query("SELECT * FROM medicos");  
                while($datos = $sql->fetch_object()) {  
                ?>
                  <tr>
                    <td><?= $datos->ID_med ?></td>
                    <td><?= $datos->nombre_med ?></td>
                    <td><?= $datos->apellido_med ?></td>
                    <td><?= $datos->especialidad ?></td>
                    <td><?= $datos->colegiado ?></td>
                    <td><?= $datos->dpi ?></td>
                    <td><?= $datos->correo ?></td>
                    <td><?= $datos->telefono ?></td>
                    <td><?= $datos->direccion ?></td>
                    <td><?= $datos->sexo ?></td>
                    <td><?= $datos->fecha_nacimiento ?></td>
                    <td>
                      <a href="Editarmed.php?id=<?= $datos->ID_med ?>"><img src="Img/Icons/edit.png" alt="Editar" width="30" height="30"></a>
                       
                      <a href="Deletemed.php?id=<?= $datos->ID_med ?>"><img src="Img/Icons/delete.png" alt="Eliminar" width="30" height="30"></a>
                    </td>
                  </tr>
                <?php } ?>
            </tbody>
          </table>
      </div>
        
    </div>
</body>
</html>

<style>
  h1{
    margin: 0 auto;
    width: 100%;
    text-align: center;
    padding: 3rem;
  }

  body{
    font-family: 'Century Gothic';
  }
</style>