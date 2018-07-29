<?php
    require "../conexion.php";
    include("../validar_inicio_sesion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="../css/events.css">
    <title>Sanvan Manager</title>
</head>
<body>
  <div class="main">
    <form action=""><br>
        <a href="crud_lugares.php"><input  type="button" value="Editar Sites"></a>
        <a href="../crud_employees/crud_empleados.php"><input  type="button" value="Editar Empleados"></a>
        <a href="crud_empleados_eliminados.php"><input  type="button" value="Empleados Borrados"></a>
        <a href="formulario_timesheet.php"><input  type="button" value="Timesheet"></a>
        <a href="formulario_resumen.php"><input  type="button" value="Resumen"></a>
        <a  href="../cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>
    </form>
  </div>

</body>
</html>
