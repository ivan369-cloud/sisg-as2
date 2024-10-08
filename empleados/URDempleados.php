<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Empleados</title>
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
  h1 {
    color: #007BFF;
    font-size: 3em;
    margin-bottom: 2rem;
    text-align: center;
  }
  table {
    background-color: white;
  }
  .imgRegreso {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 40px;
    height: auto;
  }
  #Regreso {
    text-decoration: none;
  }
</style>

<h1><b>Empleados Registrados</b></h1>
<div class="tablam">
  <div class="container">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>DPI</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Edad</th>
          <th>Sexo</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Área</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "../db.php";  
        $sql = $conexion->query("SELECT * FROM empleados");  
        while($datos = $sql->fetch_object()) {  
        ?>
          <tr>
            <td><?= $datos->id_empleado ?></td>
            <td><?= $datos->dpi ?></td>
            <td><?= $datos->nombre ?></td>
            <td><?= $datos->apellido ?></td>
            <td><?= $datos->edad ?></td>
            <td><?= $datos->sexo ?></td>
            <td><?= $datos->email ?></td>
            <td><?= $datos->telefono ?></td>
            <td><?= $datos->area ?></td>
            <td>
              <a href="Editaremp.php?id=<?= $datos->id_empleado ?>"><img src="Img/Icons/edit.png" alt="Editar" width="30" height="30"></a>
              <a href="Deleteemp.php?id=<?= $datos->id_empleado ?>" onclick="return confirm('¿Desea eliminar el registro?')">
                <img src="Img/Icons/delete.png" alt="Eliminar" width="30" height="30">
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  
  <a href="Menuempleados.html" id="Regreso">
    <img src="img/Icons/izquierda2.png" alt="Regresar" class="imgRegreso">
  </a>
</div>
</body>
</html>

<style>
  h1 {
    margin: 0 auto;
    width: 100%;
    text-align: center;
    padding: 3rem;
  }
  body {
    font-family: 'Century Gothic';
  }
</style>

