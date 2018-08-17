<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $sql = "SELECT * FROM sites";
    $array_usuarios = $conexion_db->ConsultaArray($sql);
?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title>Sanvan Modify Places</title>
  <link rel="stylesheet" href="../css/events.css">
</head>
<body>
  <div class="main">
    <table  align="center">
      <h3>Sites Panel</h3>
      <thead>
        <tr>
          <th>Site</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($array_usuarios as $elemento): ?>
       	<tr>
          <td> <?php echo $elemento->site ?></td>
          <td><a href="crud_lugares_borrar.php?Id=<?php echo $elemento->id ?>"><input type='button' name='borrar'  value='Borrar'></td></a>
        </tr>
        <?php endforeach ?>
      </tbody>
      <tfoot>
        <form action="crud_lugares_insertar.php" method="post">
          <td><input class="textbox" type='text' name='lugar' required="required"  placeholder="Place"></td>
          <td class="btn-crud"><input class="btn_principal" type='submit'  name='insertar'  value='Agregar'></td>
        </form>
      </tfoot>
    </table>
   <div class="btn_inf">
    <a href="main_admin.php"><input class="btn_principal" type='button' value='Main Menu'></a>
   	<a href="../cerrar_session.php"><input type='button' value='Log out'></a>
  </div>
 </div>
</body>
</html>
