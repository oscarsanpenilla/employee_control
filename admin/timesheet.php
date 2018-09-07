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
$employees = $resume->getUsersActive();





$total_hrs = 0.0;
$info_num = 1;
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/resumen.css">
  <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
  <title>Timesheet</title>
</head>
<body>
  <div class="contenedor">
    <div class="logo">
      <img id="logo" src="../img/logo.png" alt="sanvan_logo">
    </div>
    <div class="center">
      <?php include("encabezado_filtro.php"); ?>
    </div>
    <section id="timesheet">
      <h3>Timesheet</h3>
      <p>Site:
        <?php foreach ($sites as $key=>$site): ?>
          <strong><?php echo $site->site." / "; ?> </strong>
        <?php endforeach; ?>
      </p>
      <p>Period: <strong><?php echo $fecha_inicio ?></strong> to <strong><?php echo $fecha_fin ?></strong></p>
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
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($names as $key=>$name):?>
            <tr id="fila<?php echo($key + 1); ?>">
              <td><?php echo $key + 1; ?></td>
              <td id="site" class="center"><?php echo $name->site; ?></td>
              <td><?php echo $name->ocupation; ?></td>
              <td><?php echo $name->name; ?></td>
              <!-- Eventos -->
              <?php foreach ($dates as $date):?>
                <td class="center event_edit" id="fila_edit<?php echo($key + 1); ?>" value="<?php echo $date; ?>">
                  <?php
                  foreach ($hours_day as $event){
                    if ($date == $event->date && $name->id == $event->id && $name->site == $event->site)  echo $event->hours_day;
                  }
                  ?>
                </td>
              <?php endforeach; ?>

              <!-- total de horas -->
              <td class="center">
                <?php
                foreach ($total_hours as $total) {
                  if ($name->id == $total->id && $name->site == $total->site) {
                    echo $total->total;
                    $total_hrs += $total->total;
                  }
                }
                ?>
              </td>
              <td>
                <button class="btn_edit" id="btn_edit<?php echo($info_num);?>" type="button" name="button">edit</button>
                <input id="employee_id<?php echo($info_num); $info_num++;?>" type="hidden" name="id" value="<?php echo $name->id;  ?>">
              </td>
            </tr>
          <?php endforeach; ?>
          <!-- agregar eventos -->
          <div id="row_add_event">
            <form name="insertar_hours" method="post" action="editar_timesheet.php">
              <tr id="fila_new_event">
                <td id="td_new_id"> <input id="new_id" type="hidden" name="id" value=""> </td>
                <td>
                  <select class="select" name="site" required id="new_site">
                    <?php foreach ($sites as $key => $site):?>
                      <option value= "<?php echo $site->site;?>" selected > <?php echo $site->site;?> </option>
                    <?php endforeach; ?>

                  </select>
                </td>
                <td id="new_ocupation"></td>
                <td id="new_name"></td>
                <?php foreach ($dates as $key => $date) :?>
                  <td>
                    <input type="number" class="hours" name="<?php echo $date; ?>" id="<?php echo $date; ?>" value="">
                  </td>
                <?php endforeach; ?>
                <td></td>
                <td><input id="btn_submit" type="submit" name="add" value="+"></td>
              </tr>
            </form>
          </div>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="<?php echo count($dates)+4; ?>">Total</td>
            <td class="center"><?php echo $total_hrs; ?></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </section>
    <div class="btn_center">
      <button type="button" name="btn_agregar_eventos" id="btn_agregar_eventos">Add</button>
      <button type="button" name="btn_editar_eventos" id="btn_editar_eventos">Edit</button>
    </div>
    <br>
  </div>
</body>
<script src="../js/jQuery.js"></script>
<script src="../js/timesheet.js"></script>
</html>
