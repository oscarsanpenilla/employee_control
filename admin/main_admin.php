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
    <form action=""><br>
        <a href="crud_lugares.php"><input  type="button" value="Editar Sites"></a>
        <a href="../crud_employees/crud_empleados.php"><input  type="button" value="Editar Empleados"></a>
          <a href="crud_empleados_eliminados.php"><input  type="button" value="Empleados Borrados"></a>
        <a href="formulario_descarga.php"><input  type="button" value="Descargar Tabla"></a>
        <a  href="../cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>
    </form>
</body>
</html>
