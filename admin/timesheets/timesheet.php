<?php
include_once("../../funtions.php");
include_once("../../employee.php");
include_once("../../validar_inicio_sesion_admin.php");


$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$datos = array('fechas' => array($fecha_inicio , $fecha_fin),
               'paid_by_checkbox' => $_POST['paid_by_checkbox'],
               'ocupation_checkbox' => $_POST['ocupation_checkbox'],
               'site_checkbox' => $_POST['site_checkbox']);
//var_dump($datos);
//var_dump($_POST);
$resume = new ResumeTimesheet($datos);
// $dates = $resume->datesCompleteTimesheet();
$sites = $resume->sitesTimesheet();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../css/resumen.css">
  <link rel="shortcut icon" type="image/png" href="../../img/favicon.ico">
  <title>Timesheet</title>
</head>
<body>
  <div class="contenedor">
    <div class="logo">
      <img id="logo" src="../../img/logo.png" alt="sanvan_logo">
    </div>
    <div class="center">
      <?php include("../inc/encabezado_filtro.php"); ?>
    </div>
    <section id="timesheet">
      <h3>Timesheet</h3>
      <p>Site:
        <?php foreach ($sites as $key=>$site): ?>
          <strong><?php echo $site->site." / "; ?> </strong>
        <?php endforeach; ?>
      </p>
      <p>Period: <strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
      <div class="ajax_response">
      </div>
    </section>
    <div class="btn_center">
      <input type="button" id="agregar_eventos" value="Add">
      <input type="button" id="editar_eventos" value="Edit">
    </div>
    <br>
  </div>
</body>
<script src="../../js/jQuery.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script>
  var datos = <?php echo json_encode($datos); ?>;
</script>
<script src="../../js/timesheet.js"> </script>
</html>
