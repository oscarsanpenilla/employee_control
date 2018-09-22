<?php
include("../../funtions.php");
include("../../employee.php");
include("../../validar_inicio_sesion_admin.php");

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$datos = array('fechas' => array($fecha_inicio , $fecha_fin),
               'paid_by_checkbox' => $_POST['paid_by_checkbox'],
               'ocupation_checkbox' => $_POST['ocupation_checkbox'],
               'site_checkbox' => $_POST['site_checkbox']);

$resume = new ResumeTimesheet($datos);

$results = $resume->getEvents();
$array_resume = $resume->resume();
$cash_results = $resume->cashResume();
try {
  $bank_results = $resume->bankResume();
} catch (Exception $e) {
  var_dump($bank_results);
}

$hrs = 0.0;
$paid = 0.0;

?>

<!-- //Timesheet -->
<?php
$resume = new ResumeTimesheet($datos);

$dates = $resume->datesCompleteTimesheet();
$names = $resume->siteOcupationNameResume();
$hours_day = $resume->hoursDayTimesheet();
$total_hours = $resume->totalHoursTimesheetResume();
$sites = $resume->sitesTimesheet();
$notes = $resume->getComments();
$total_hrs = 0.0;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../css/resumen.css">
  <link rel="shortcut icon" type="image/png" href="../../img/favicon.ico">
  <title>Resume</title>
</head>
<body>
  <div class="contenedor"> <!--table main resume -->
    <div class="logo">
      <img id="logo" src="../../img/logo.png" alt="sanvan_logo">
    </div>

    <div class="center">
      <?php include("../inc/encabezado_filtro.php"); ?>
    </div>
    <section id="main_resume">
      <h3>Final Resume</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
      <div class="table">
        <table>
          <thead>
            <tr>
              <th>Site</th>
              <th>Ocupation</th>
              <th>Hours</th>
              <th>Work for Paid</th>
            </tr>
          </thead>
          <tbody> <!-- body main resume  -->
            <?php $i = 0 ; foreach($array_resume as $row): ?>
              <tr>
                <td><?php echo $row->site; ?></td>
                <td><?php echo $row->ocupation; ?></td>
                <td class="center"><?php echo $row->hours; ?> </td>
                <td class="money"><?php echo $row->total_ocupation;?></td>
              </tr>
              <?php
              $hrs += $row->hours;
              $paid += $row->total_ocupation;
              ?>
            <?php endforeach; ?>
          </tbody>
          <tfoot> <!-- footer main resume  -->
            <tr>
              <td colspan="2">Totals</td>
              <td class="center"><strong><?php echo $hrs; ?></strong></td>
              <td class="money"><strong><?php echo $paid; ?></strong></td>
            </tr>
          </tfoot>
        </table>
      </div>

    </section>
    <section id="total_employee">
      <h3>Total Employees</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
      <div class="table">
        <table><!-- table Total employees  -->
          <thead>
            <tr>
              <th>&nbsp</th>
              <th>Site</th>
              <th>Ocupation</th>
              <th>Name</th>
              <th>Work for Rate</th>
              <th>Total hrs</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody> <!-- body Total employees  -->
            <?php
            $hrs = 0.0;
            $paid = 0.0;
            ?>
            <?php foreach ($results as $key=>$row):?>
              <tr>
                <td class="center"><?php echo $key + 1; ?></td>
                <td><?php echo $row->site ?> </td>
                <td><?php echo $row->ocupation ?> </td>
                <td><?php echo $row->name ?> </td>
                <td class="money"><?php echo $row->work_for_rate ?> </td>
                <td class="center"><?php echo $row->hours ?> </td>
                <td class="money"><?php echo $row->total ?> </td>
              </tr>
              <?php
              $hrs += $row->hours;
              $paid += $row->total;
              ?>
            <?php endforeach; ?>
          </tbody>
          <tfoot> <!-- footer Total employees  -->
            <tr>
              <td colspan="5">Totals</td>
              <td class="center"><strong><?php echo $hrs; ?></strong></td>
              <td class="money"><strong><?php echo $paid; ?></strong></td>
            </tr>
          </tfoot>
        </table>
      </div>

    </section>
    <section id="td_bank_deposits">
      <h3>TD Bank Deposits</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
      <div class="table">
        <table><!-- table TD Bank Deposits  -->
          <thead>
            <tr>
              <th>&nbsp</th>
              <th>Name</th>
              <th class="center">Bank Info</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody><!-- body TD Bank Deposits  -->
            <?php $paid = 0.0 ?>
            <?php foreach ($bank_results as $key=>$row):?>
              <tr>
                <td class="center"><?php echo $key + 1; ?></td>
                <td><?php echo $row->name ?> </td>
                <td class="center"><?php echo $row->bank_info ?> </td>
                <td class="money"><?php echo $row->total ?> </td>
                <?php $paid += $row->total ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot><!-- footer TD Bank Deposits  -->
            <tr>
              <td colspan="3">Total</td>
              <td class="money" ><strong><?php echo $paid; ?></strong></td>
            </tr>
          </tfoot>
        </table><!-- table end TD Bank Deposits  -->
      </div>
    </section>
    <section id="no_bank_info">
      <h3>No Bank Information</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
      <div class="table">
        <table><!-- table no bank info  -->
          <thead>
            <tr>
              <th>&nbsp</th>
              <th>Name</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody><!-- body bank info  -->
            <?php $paid = 0.0 ?>
            <?php foreach ($cash_results as $key=>$row):?>
              <tr>
                <td class="center"><?php echo $key + 1; ?></td>
                <td><?php echo $row->name ?> </td>
                <td class="money"><?php echo $row->total ?> </td>
                <?php $paid += $row->total ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot><!-- footer bank info  -->
            <tr>
              <td colspan="2">Total</td>
              <td class="money" ><strong><?php echo $paid; ?></strong></td>
            </tr>
          </tfoot>
        </table><!-- table end bank info  -->
      </div>
    </section>
    <section id="timesheet">
      <h3>Timesheets Merged</h3>
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
              <th>Work for</th>
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
                <td><?php echo $name->work_for; ?></td>
                <td><?php echo $name->ocupation; ?></td>
                <td><?php echo $name->name; ?></td>
                <?php foreach ($dates as $date):?>
                  <td class="center">
                    <?php

                    foreach ($hours_day as $event){
                      if ($date == $event->date && $name->id == $event->id){
                        echo $event->hours_day." ";
                      }
                    }
                    ?>
                  </td>
                <?php endforeach; ?>
                <td class="center">
                  <?php
                  foreach ($total_hours as $total) {
                    if ($name->id == $total->id) {
                      echo $total->total;
                      $total_hrs += $total->total;
                    }
                  }
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="<?php echo count($dates)+4; ?>">Total</td>
              <td class="center"><?php echo $total_hrs; ?></td>
            </tr>
          </tfoot>
        </table>
    </section>
    <section id="comentarios">
      <h3>Comments and Notes</h3>
      <div class="table">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Site</th>
              <th>Name</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($notes as $key => $value):?>
              <tr>
                <td class="center"><?php echo date('D d M',strtotime($value->date)); ?></td>
                <td class="center"><?php echo $value->site ?></td>
                <td ><?php echo $value->name ?></td>
                <td ><?php echo $value->note ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </section><br><br>
  </body>
  </html>
