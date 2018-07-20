<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $sql = "SELECT * FROM deleted_users ORDER BY event_id";
    $array_usuarios = $conexion_db->ConsultaArray($sql);
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  
  <title>Sanvan Employees</title>
  <link rel="stylesheet" type="text/css" href="../css/crud_trabajadores.css">
</head>
<body>
  <div class="contenedor">
    <table>
      <h3>Empleados Eliminados</h3>
      <tr >
        <td>Id</td>
        <td>Work for</td>
        <td>Name</td>
        <td>User</td>
        <td>Password</td>
        <td>Employee Rate</td>
        <td>Work for Rate</td>
        <td>Week</td>
        <td>Status</td>
        <td>Ocupation</td>
        <td>Phone</td>
        <td>Paid by</td>
        <td>Bank info</td>
      </tr>
      <?php foreach($array_usuarios as $elemento): ?>
      <tr>
              <td> <?php echo $elemento->id ?></td>
              <td> <?php echo $elemento->work_for ?></td>
              <td> <?php echo $elemento->name ?></td>
              <td> <?php echo $elemento->user ?></td>
              <td> <?php echo $elemento->password ?></td>
              <td> <?php echo $elemento->employee_rate ?></td>
              <td> <?php echo $elemento->work_for_rate ?></td>
              <td> <?php echo $elemento->pay_week ?></td>
              <td> <?php echo $elemento->active ?></td>
              <td> <?php echo $elemento->ocupation ?></td>
              <td> <?php echo $elemento->phone ?></td>
              <td> <?php echo $elemento->paid_by ?></td>
              <td> <?php echo $elemento->bank_info ?></td>
        <td class="btn-crud"><a href="crud_restaurar_empleado.php?Id=<?php echo $elemento->id ?>"><input type='button' name='Actualizar' value='Restaurar'></td></a>
      </tr>
      <?php endforeach ?>

    </table>
    <div class="contenedor-btn">
        <a href="../admin/main_admin.php"><input type='button' value='Main Menu'></a>
        <a href="../cerrar_session.php"><input type='button'value='Log Out'></a>
    </div>
  </div>


</body>
</html>
