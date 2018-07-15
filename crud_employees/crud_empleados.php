<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $sql = "SELECT * FROM users";
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
      <h3>Workers Panel</h3>
      <tr >
        <td>Id</td>
        <td>Name</td>
        <td>User</td>
        <td>Password</td>
        <td>$/hour</td>
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
              <td> <?php echo $elemento->name ?></td>
              <td> <?php echo $elemento->user ?></td>
              <td> <?php echo $elemento->password ?></td>
              <td> <?php echo $elemento->employee_rate ?></td>
              <td> <?php echo $elemento->pay_week ?></td>
              <td> <?php echo $elemento->active ?></td>
              <td> <?php echo $elemento->ocupation ?></td>
              <td> <?php echo $elemento->phone ?></td>
              <td> <?php echo $elemento->paid_by ?></td>
              <td> <?php echo $elemento->bank_info ?></td>
        <td class="btn-crud"><a href="crud_borrar.php?Id=<?php echo $elemento->id ?>"><input type='button' name='borrar' value='Borrar'></td></a>
        <td class="btn-crud"><a href="crud_formulario_actualizar.php?Id=<?php echo $elemento->id ?>"><input type='button' name='Actualizar' value='Update'></td></a>
      </tr>
      <?php endforeach ?>
      <tr>
        <td>#</td>
        <form action="crud_insertar.php" method="post">
            <td><input type='text' required="required" name='nombre' size='20' class='centrado' placeholder="Name"></td>
            <td><input type='text' required="required" name='usuario' size='20' class='centrado' placeholder="User"></td>
            <td><input type='text' required="required" name='contra' size='20' class='centrado' placeholder="Password"></td>
            <td><input type='text' required="required" name='precio_hora' size='10' class='centrado' placeholder="Price/hour"></td>
            <td><input type='text' required="required" name='payment_week' size='10' class='centrado' placeholder="Week of Payment"></td>
            <td><input type='text' required="required" name='status' size='10' class='centrado' placeholder="Status"></td>
            <td><input type='text' required="required" name='task' size='10' class='centrado' placeholder="Ocupation"></td>
            <td><input type='text' required="required" name='phone' size='10' class='centrado' placeholder="Phone"></td>
            <td><input type='text' required="required" name='paid_by' size='10' class='centrado' placeholder="Paid by"></td>
            <td><input type='text' required="required" name='bank_info' size='10' class='centrado' placeholder="Bank info"></td>
            <td colspan="2"><input type='submit' name='insertar'  value='Nuevo'></td>
        </form>
      </tr>
    </table>
    <div class="contenedor-btn">
        <a href="../admin/main_admin.php"><input type='button' value='Main Menu'></a>
        <a href="../cerrar_session.php"><input type='button'value='Log Out'></a>
    </div>
  </div>


</body>
</html>
