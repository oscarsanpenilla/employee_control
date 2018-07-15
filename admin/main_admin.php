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
        <a href="crud_lugares.php"><input  type="button" value="Modify places"></a>
        <a href="../crud_employees/crud_empleados.php"><input  type="button" value="Modify workers"></a>
        <a  href="../cerrar_session.php" class="logout"><input  type="button" value="Log out"></a>
    </form>
</body>
</html>
