<?php
include("../funtions.php");
include("../employee.php");
include("../validar_inicio_sesion.php");

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$resume = new ResumeTimesheet($_POST);

$dates = $resume->datesCompleteTimesheet();
$names = $resume->siteOcupationName();
$hours_day = $resume->hoursDayTimesheet();
$total_hours = $resume->totalHoursTimesheet();
$sites = $resume->sitesTimesheet();



$total_hrs = 0.0;
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/resumen.css">
  <title>Timesheet</title>
</head>
<body>
  <div class="contenedor">
    <div class="logo">
      <img id="logo" src="../img/logo.png" alt="sanvan_logo">
    </div>
    <div class="info">
      <p>Site:
        <?php foreach ($sites as $key=>$site): ?>
        <strong><?php echo $site->site." / "; ?> </strong>
        <?php endforeach; ?>
      </p>
      <p>Period: <strong><?php echo $fecha_inicio ?></strong> to <strong><?php echo $fecha_fin ?></strong></p>
    </div>
    <table>
      <thead>
        <tr>
          <th>&nbsp</th>
          <th>Site</th>
          <th>Ocupation</th>
          <th>Name</th>
          <?php foreach ($dates as $date):?>
            <th><?php echo date_format(date_create($date),"D d")?></th>
          <?php endforeach; ?>
          <th>Total hours</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($names as $key=>$name):?>
          <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $name->site; ?></td>
            <td><?php echo $name->ocupation; ?></td>
            <td><?php echo $name->name; ?></td>
            <?php foreach ($dates as $date):?>
              <td class="td_center">
                <?php
                foreach ($hours_day as $event){
                  if ($date == $event->date && $name->id == $event->id && $name->site == $event->site)  echo $event->hours_day;
                }
                ?>
              </td>
            <?php endforeach; ?>
            <td class="td_center">
              <?php
              foreach ($total_hours as $total) {
                if ($name->id == $total->id && $name->site == $total->site) {
                  echo $total->total;
                  $total_hrs += $total->total;
                }
              }
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="div_total">
      <p>Total hours: <strong><?php echo $total_hrs; ?></strong></p>
    </div>
    <br>
  </div>

</body>
</html>
