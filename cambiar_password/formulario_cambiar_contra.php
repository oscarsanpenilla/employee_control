<?php
    include("../validar_inicio_sesion.php");
?>

<!DOCTYPE html>
<html lang_"es">
    <head>
        <title>Sanvan Construction</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="../css/estilos.css">
    </head>
    <body>
        <form action="cambiar_contra.php" method="post">
            <h2>Cambiar Contraseña</h2>
            <input type="password" placeholder="Password" name="contra_vieja" ><br>
            <input type="text" placeholder="New Password" name="contra_nueva"><br>
            <input type="submit" value="Change">
        </form>
    </body>
</html>
