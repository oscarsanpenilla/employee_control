<?php
    include("funtions.php");
    include("employee.php");
    $conexion_db = new ConexionDB();


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="css/estilos_main.css">
    <title>Sanvan Contracting</title>
</head>
<body>
    <form action="crud_actualizar.php" method="post" >
        <h1>Sanvan</<h1></h1>
        <h2>Nuevo Registro</h2>
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="user" placeholder="Usuario" >
        <input type="text" name="password" placeholder="Constraseña" >
        <input type="text" name="task" placeholder="Trabajo a Realizar" >
        <br>
        <?php
        $employee = new Employee();
        ?>
        <input type="submit"  value="enviar">
    </form>
</body>
</html>
