<?php
  require "../conexion.php";
  include_once("../employee.php");
  session_start();
  if(!isset($_SESSION['employee'])){
  	header("location: /sanvan_system/index.php");
  }
  if ($_SESSION['employee']->admin != 1) {
    header("location: http://sanvancontracting.com/");
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="../css/events.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
    <title>Sanvan Manager</title>
</head>
<body>
  <div class="main">
    <form action=""><br>
        <a href="./editar_sites/crud_lugares.php" target="_blank"><input  type="button" value="Editar Sites"></a>
        <a href="./nuevo_empleado/formulario_nuevo_empleado.php" target="_blank"><input  type="button" value="Nuevo Empleado"></a>
        <a href="./editar_empleados/crud_empleados.php" target="_blank"><input  type="button" value="Editar Empleados"></a>
        <a href="./empleados_borrados/crud_empleados_eliminados.php" target="_blank"><input  type="button" value="Empleados Borrados"></a>
        <a href="./timesheets/formulario_timesheet.php" target="_blank"><input  type="button" value="Timesheet"></a>
        <a href="./resumen/formulario_resumen.php" target="_blank"><input class="btn_principal" type="button" value="Resumen"></a>
        <a  href="../cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>
    </form>
  </div>

</body>
</html>
