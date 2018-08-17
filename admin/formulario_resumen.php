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
    <h3>Resume</h3>
    <form action="resumen.php" method="post">
      <section id="form_date">
        <p  class="p_form">Desde:</p>
        <input type="date" required="required" name="fecha_inicio" value="<?php echo $start_date?>">
        <p class="p_form">Hasta:</p>
        <input type="date" required="required" name="fecha_fin" value="<?php echo $end_date?>">
      </section>
      <section id="form_site">
        <p class="p_form">Site:</p>
        <div class="checkbox">
          <input
          type="checkbox"
          name="site_checkbox[]"
          value="any"
          id="btn_any_site"
          checked>
          <label for="btn_any_site">Cualquiera</label>
        </div>
        <div id="checkbox_options_site">
          <?php foreach($arreglo_lugares as $elemento): ?>
            <div class="checkbox">
              <input
              type="checkbox"
              name="site_checkbox[]"
              value="<?php echo $elemento->site;?>"
              id="<?php echo $elemento->site; ?>">
              <label for="<?php echo $elemento->site; ?>">
                <?php echo $elemento->site; ?>
              </label>
            </div>
          <?php endforeach ?>
        </div>
      </section>
      <section id="form_paid_by">
        <p class="p_form">Pagado por:</p>
        <div class="checkbox">
          <input
          type="checkbox"
          name="paid_by_checkbox[]"
          value="any"
          id="btn_any_paid_by"
          checked>
          <label for="btn_any_paid_by">Cualquiera</label><br>
        </div>
        <div id="checkbox_options_paid_by">
          <div class="checkbox">
            <input type="checkbox" name="paid_by_checkbox[]" value="Rafael" id="A">
            <label for="A">Rafael</label><br>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="paid_by_checkbox[]" value="Cristian" id="B">
            <label for="B">Cristian</label><br>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="paid_by_checkbox[]" value="Carlos" id="C">
            <label for="C">Carlos</label><br>
          </div>
        </div>
      </section>
      <section id="form_ocupation">
        <p class="p_form">Ocupación</p>
        <div class="checkbox">
          <input type="checkbox" name="ocupation_checkbox[]"
          value="any"
          id="btn_any_ocup"
          checked>
          <label for="btn_any_ocup">Cualquiera</label>
        </div>
        <div id="checkbox_options_ocup">
          <?php foreach($arreglo_ocupation as $elemento): ?>
            <div class="checkbox">
              <input type="checkbox" name="ocupation_checkbox[]"
              value="<?php echo $elemento->ocupation;?>"
              id="<?php echo $elemento->ocupation; ?>">
              <label for="<?php echo $elemento->ocupation; ?>"><?php echo $elemento->ocupation; ?></label>
            </div>
          <?php endforeach ?>
        </div>
      </section>
      <input class="btn_principal" type="submit" name="enviar" value="Enviar">
    </form>
    <div class="btn_inf">
      <a href="main_admin.php"> <input type="button" value="Main Menu"> </a>
    </div>
  </div>
  <script src="../js/jQuery.js"></script>
  <script src="../js/script_resume.js"></script>


</body>

</html>
