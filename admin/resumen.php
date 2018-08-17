<?php
include("../funtions.php");
include("../employee.php");
include("../validar_inicio_sesion.php");

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$resume = new ResumeTimesheet($_POST);

$results = $resume->getEvents();
$array_resume = $resume->resume();
$cash_results = $resume->cashResume();
try {
  $bank_results = $resume->bankResume();
} catch (\Exception $e) {
  var_dump($bank_results);
}




$hrs = 0.0;
$paid = 0.0;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/resumen.css">
  <title></title>
</head>
<body>
  <div class="contenedor"> <!--table main resume -->
    <section id="main_resume">
      <h3>Final Resume</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
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
              <td class="td_center"><?php echo $row->hours; ?> </td>
              <td class="td_money"><?php echo $row->total_ocupation;?></td>
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
            <td class="td_center"><strong><?php echo $hrs; ?></strong></td>
            <td class="td_money"><strong><?php echo $paid; ?></strong></td>
          </tr>
        </tfoot>
      </table>
    </section>
    <section id="total_employee">
      <h3>Total Employees</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
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
              <td class="td_center"><?php echo $key + 1; ?></td>
              <td><?php echo $row->site ?> </td>
              <td><?php echo $row->ocupation ?> </td>
              <td><?php echo $row->name ?> </td>
              <td class="td_money"><?php echo $row->work_for_rate ?> </td>
              <td class="td_center"><?php echo $row->hours ?> </td>
              <td class="td_money"><?php echo $row->total ?> </td>
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
            <td class="td_center"><strong><?php echo $hrs; ?></strong></td>
            <td class="td_money"><strong><?php echo $paid; ?></strong></td>
          </tr>
        </tfoot>
      </table>
    </section>
    <section id="td_bank_deposits">
      <h3>TD Bank Deposits</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
      <table><!-- table TD Bank Deposits  -->
        <thead>
          <tr>
            <th>&nbsp</th>
            <th>Name</th>
            <th class="td_center">Bank Info</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody><!-- body TD Bank Deposits  -->
          <?php $paid = 0.0 ?>
          <?php foreach ($bank_results as $key=>$row):?>
            <tr>
              <td class="td_center"><?php echo $key + 1; ?></td>
              <td><?php echo $row->name ?> </td>
              <td class="td_center"><?php echo $row->bank_info ?> </td>
              <td class="td_money"><?php echo $row->total ?> </td>
              <?php $paid += $row->total ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot><!-- footer TD Bank Deposits  -->
          <tr>
            <td colspan="3">Total</td>
            <td class="td_money" ><strong><?php echo $paid; ?></strong></td>
          </tr>
        </tfoot>
      </table><!-- table end TD Bank Deposits  -->
    </section>
    <section id="no_bank_info">
      <h3>No Bank Information</h3>
      <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
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
              <td class="td_center"><?php echo $key + 1; ?></td>
              <td><?php echo $row->name ?> </td>
              <td class="td_money"><?php echo $row->total ?> </td>
              <?php $paid += $row->total ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot><!-- footer bank info  -->
          <tr>
            <td colspan="2">Total</td>
            <td class="td_money" ><strong><?php echo $paid; ?></strong></td>
          </tr>
        </tfoot>
      </table><!-- table end bank info  -->
    </section>
    <section id="timesheet">
      <?php
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

  </section>
  <br>
</body>
</html>
