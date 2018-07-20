<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="../css/events.css">
    <title>Sanvan</title>
</head>
<body>
   <form action="descargar_tabla.php" method="post">
      <h3>Periodo de Tiempo</h3>
      <p>Desde:</p>
       <input type="date" required="required" name="fecha_inicio" value="<?php echo date("Y-m-d",strtotime('-15 day'))?>">
        <p>Hasta:</p>
       <input type="date" required="required" name="fecha_fin" value="<?php echo date("Y-m-d")?>">
       <input type="submit" name="enviar" value="Enviar">
   </form>
</body>
</html>
