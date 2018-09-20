<?php
include_once("../../funtions.php");
include_once("../../employee.php");
include_once("../../funtions.php");

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

<table id="timesheet">
  <thead>
    <tr>
      <th>&nbsp</th>
      <th>Site</th>
      <th class="ocupation">Ocupation</th>
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
    <tr class="fila_evento">
      <td class="number center"><?php echo $key + 1; ?></td>
      <td class="site center"><?php echo $name->site; ?></td>
      <td class="ocupation"><?php echo $name->ocupation; ?></td>
      <td class="employee_name"><?php echo $name->name; ?></td>
      <!-- Eventos -->
      <?php foreach ($dates as $date):?>
      <td class="center event_edit" value="<?php echo $date; ?>">
      <?php
      foreach ($hours_day as $event){
        if ($date == $event->date && $name->id == $event->id && $name->site == $event->site)  echo $event->hours_day;
      }
      ?>
      </td>
      <?php endforeach; ?>

      <!-- total de horas -->
      <td class="total_horas center">
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
        <input class="update" type="button" name="button" value="update">
        <input class="employee_id" type="hidden" name="id" value="<?php echo $name->id;?>">
      </td>
    </tr>
    <?php $info_num++; ?>
    <?php endforeach; ?>
    <!-- agregar eventos -->
    <tr class="nueva_fila">
      <td class="number center"></td>
      <td class="site center">
        <select class="select" name="site" required>
          <?php foreach ($sites as $key => $site):?>
          <option value= "<?php echo $site->site;?>"> <?php echo $site->site;?> </option>
          <?php endforeach; ?>
        </select>
      </td>
      <td class="ocupation">  </td>
      <td class="employee_name">
       <input list="names" id="search_employee" placeholder="Search...">
       <datalist id="names">
         <?php foreach($employees as $employee): ?>
         <option value="<?php echo $employee->name; ?>">
         <?php endforeach; ?>
       </datalist>
      </td>
      <?php foreach ($dates as $key => $date) :?>
      <td  class="center event_edit" >
        <input class="edit_hours" id="<?php echo $date; ?>" type="number" name="" value="">
      </td>
      <?php endforeach; ?>
      <td class="total_horas center"></td>
      <td>
        <input id="add_new" type="submit" name="add" value="+">
        <input class="employee_id" type="hidden" name="id" value="">
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="<?php echo count($dates)+4; ?>">Total</td>
      <td id="total_tabla" class="center"><?php echo $total_hrs; ?></td>
      <td></td>
    </tr>
  </tfoot>
</table>
