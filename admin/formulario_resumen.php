<?php

    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();

		$fechas = Events::PeriodoPago();
		$start_date = $fechas[0]->week_start;
		$end_date = $fechas[0]->week_end;

    $sql= "SELECT site FROM sites ORDER by site";
    $arreglo_lugares = $conexion_db->ConsultaArray($sql);

    $sql= "SELECT DISTINCT ocupation FROM events ORDER BY ocupation";
    $arreglo_ocupation = $conexion_db->ConsultaArray($sql);
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
    <form action="resumen.php" method="post">
      <h3>Resume</h3>
      <p  class="p_form">Desde:</p>
      <input type="date" required="required" name="fecha_inicio" value="<?php echo $start_date?>">
      <p class="p_form">Hasta:</p>
      <input type="date" required="required" name="fecha_fin" value="<?php echo $end_date?>">
      <p class="p_form">Site:</p>
      <div class="checkbox">
        <input type="checkbox" name="site_checkbox[]"
              value="any"
              id="any_site"
              checked>
              <label for="any_site">Cualquiera</label>
      </div>
      <?php foreach($arreglo_lugares as $elemento): ?>
        <div class="checkbox">
          <input type="checkbox" name="site_checkbox[]"
                value="<?php echo $elemento->site;?>"
                id="<?php echo $elemento->site; ?>">
                <label for="<?php echo $elemento->site; ?>"><?php echo $elemento->site; ?></label>
        </div>
      <?php endforeach ?>

      <p class="p_form">Pagado por:</p>
      <div class="checkbox">
        <input type="checkbox" name="paid_by_checkbox[]" value="any" id="D" checked><label for="D">Cualquiera</label><br>
      </div>
      <div class="checkbox">
        <input type="checkbox" name="paid_by_checkbox[]" value="Rafael" id="A"><label for="A">Rafael</label><br>
      </div>
      <div class="checkbox">
        <input type="checkbox" name="paid_by_checkbox[]" value="Cristian" id="B"><label for="B">Cristian</label><br>
      </div>
      <div class="checkbox">
        <input type="checkbox" name="paid_by_checkbox[]" value="Carlos" id="C"><label for="C">Carlos</label><br>
      </div>





      <!-- </div> -->
      <p class="p_form">Ocupación</p>
      <div class="checkbox">
        <input type="checkbox" name="ocupation_checkbox[]"
              value="any"
              id="any_ocup"
              checked>
              <label for="any_ocup">Cualquiera</label>
      </div>
      <?php foreach($arreglo_ocupation as $elemento): ?>
        <div class="checkbox">
          <input type="checkbox" name="ocupation_checkbox[]"
                value="<?php echo $elemento->ocupation;?>"
                id="<?php echo $elemento->ocupation; ?>">
                <label for="<?php echo $elemento->ocupation; ?>"><?php echo $elemento->ocupation; ?></label>
        </div>
      <?php endforeach ?>


      <a href="main_admin.php"> <input type="button" value="Main Menu"> </a>
      <input class="btn_principal" type="submit" name="enviar" value="Enviar">
      </form>
  </div>


</body>

</html>
