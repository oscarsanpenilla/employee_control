<?php

    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT * FROM week_a WHERE week_start<='$today' ORDER BY id DESC LIMIT 4";
		$fechas = $conexion_db->ConsultaArray($sql);
		$start_date = $fechas[0]->week_start;
		$end_date = $fechas[0]->week_end;

    $sql= "SELECT site FROM sites ORDER by site";
    $arreglo_lugares = $conexion_db->ConsultaArray($sql);


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

  <div class="main">
    <form action="timesheet.php" method="post">
      <h3>Periodo de Tiempo</h3>
      <p  class="p_form">Desde:</p>
      <input type="date" required="required" name="fecha_inicio" value="<?php echo $start_date?>">
      <p class="p_form">Hasta:</p>
      <input type="date" required="required" name="fecha_fin" value="<?php echo $end_date?>">
      <p class="p_form">Site:</p>

      <select class="semana" name="site">
        <?php foreach($arreglo_lugares as $elemento): ?>
                <option value="<?php echo $elemento->site;?>"> <?php echo $elemento->site;   ?>  </option>
        <?php endforeach ?>
      </select>
      <input type="submit" name="enviar" value="Enviar">
      </form>
  </div>


</body>

</html>
