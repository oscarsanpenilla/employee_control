<?php
include("../funtions.php");
include("../validar_inicio_sesion.php");
$conexion_db = new ConexionDB();
$sql = "SELECT *
FROM users
WHERE active=1
ORDER BY work_for,ocupation,name";
$array_usuarios = $conexion_db->ConsultaArray($sql);

$sql = "SELECT work_for,count(id) as count
FROM users
WHERE active=1
GROUP BY work_for";
$array_conteo = $conexion_db->ConsultaArray($sql);
//var_dump($array_conteo);
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <title>Sanvan Employees</title>
  <link rel="stylesheet" type="text/css" href="../css/events.css">
</head>
<body>
  <div class="contenedor">
    <section>
      <h3>Editar Empleados</h3>
      <p class="p_header">
        <strong>Total Empleados</strong><br>
        <?php foreach ($array_conteo as $key => $value){
          echo $value->work_for. ": ".$value->count."<br>";
        } ?>
      </p>
    </section>
    <table>
      <thead>
        <tr >
          <!-- <th>Id</th> -->
          <th></th>
          <th>Work for</th>
          <th>Ocupation</th>
          <th>Name</th>
          <!-- <th>User</th> -->
          <!-- <th>Password</th> -->
          <!-- <th>Employee Rate</th> -->
          <th>Work for Rate</th>
          <!-- <th>Week</th> -->
          <!-- <th>Status</th> -->

          <!-- <th>Phone</th> -->
          <!-- <th>Paid by</th> -->
          <!-- <th>Bank info</th> -->
        </tr>
      </thead>
      <tbody>
        <?php foreach($array_usuarios as $elemento): ?>
          <tr>
            <td class="btn-crud"><a href="crud_borrar.php?Id=<?php echo $elemento->id ?>"><input type='button' name='borrar' value='Borrar'></td></a>
            <!-- <td> <?php //echo $elemento->id ?></td> -->
            <td> <?php echo $elemento->work_for ?></td>
            <td> <?php echo $elemento->ocupation ?></td>
            <td> <?php echo $elemento->name ?></td>
            <!-- <td> <?php //echo $elemento->user ?></td> -->
            <!-- <td> <?php //echo $elemento->password ?></td> -->
            <!-- <td> <?php //echo $elemento->employee_rate ?></td> -->
            <td> <?php echo $elemento->work_for_rate ?></td>
            <!-- <td> <?php //echo $elemento->pay_week ?></td> -->
            <!-- <td> <?php //echo $elemento->active ?></td> -->

            <!-- <td> <?php //echo $elemento->phone ?></td> -->
            <!-- <td> <?php //echo $elemento->paid_by ?></td> -->
            <!-- <td> <?php //echo $elemento->bank_info ?></td> -->

            <td class="btn-crud"><a href="crud_formulario_actualizar.php?Id=<?php echo $elemento->id ?>"><input type='button' name='Actualizar' value='Update'></td></a>
            <td class="btn-crud"><a href="agregar_eventos.php?Id=<?php echo $elemento->id ?>" target="_blank"><input type='button' name='add' value='Add'></td></a>
          </tr>
        <?php endforeach ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
    <div class="contenedor-btn">
      <a href="../admin/formulario_nuevo_empleado.php"><input class="btn_principal" type='button' value='New Employee'></a>
      <a href="../admin/main_admin.php"><input type='button' value='Main Menu'></a>
      <a href="../cerrar_session.php"><input type='button'value='Log Out'></a>
    </div>
  </div>


</body>
</html>
