<?php
include("../../funtions.php");
include("../../validar_inicio_sesion_admin.php");
$conexion_db = new ConexionDB();
$sql = "SELECT *
FROM users
WHERE active=0
ORDER BY work_for,ocupation,name";
$array_usuarios = $conexion_db->ConsultaArray($sql);
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

  <title>Sanvan Employees</title>
  <link rel="stylesheet" type="text/css" href="../../css/events.css">
  <link rel="shortcut icon" type="image/png" href="../../img/favicon.ico">
</head>
<body>
  <div class="contenedor">
    <table>
      <thead>
        <tr >
          <td>Work for</td>
          <td>Name</td>
          <td>Work for Rate</td>
          <td>Ocupation</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($array_usuarios as $elemento): ?>
          <tr>
            <td> <?php echo $elemento->work_for ?></td>
            <td> <?php echo $elemento->name ?></td>
            <td> <?php echo $elemento->work_for_rate ?></td>
            <td> <?php echo $elemento->ocupation ?></td>
            <td class="btn-crud"><a href="crud_restaurar_empleado.php?Id=<?php echo $elemento->id ?>"><input type='button' name='Actualizar' value='Restaurar'></td></a>
          </tr>
        <?php endforeach ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
    <div class="btn_inf">
      <a href="../main_admin.php"><input class="btn_principal" type='button' value='Main Menu'></a>
      <a href="../../cerrar_session.php"><input type='button'value='Log Out'></a>
    </div>
  </div>


</body>
</html>
