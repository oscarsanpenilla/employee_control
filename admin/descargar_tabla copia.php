<?php
//export.php

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$sql = " SELECT * FROM events WHERE date BETWEEN '$fecha_inicio' AND '$fecha_fin' ";

$connect = mysqli_connect("localhost", "root", "", "sanvan_db");
$output = '';

 $sql = "SELECT * FROM events";
 $result = mysqli_query($connect, $sql);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">
                    <tr>
                         <th> id </th>
                         <th> paid_by </th>
                         <th> site </th>
                         <th> ocupation </th>
                         <th> name </th>
                         <th> date </th>
                         <th> hours_day </th>
                         <th> total_day </th>
                         <th> employee_rate </th>
                         <th> bank_info </th>
                         <th> phone </th>
                         <th> note </th>
                         <th> pay_week </th>
                         <th> event_id </th>

                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>
                         <td>'.$row["id"].'</td>
                         <td>'.$row["paid_by"].'</td>
                         <td>'.$row["site"].'</td>
                         <td>'.$row["ocupation"].'</td>
                         <td>'.$row["name"].'</td>
                         <td>'.$row["date"].'</td>
                         <td>'.$row["hours_day"].'</td>
                         <td>'.$row["total_day"].'</td>
                         <td>'.$row["employee_rate"].'</td>
                         <td>'.$row["bank_info"].'</td>
                         <td>'.$row["phone"].'</td>
                         <td>'.$row["note"].'</td>
                         <td>'.$row["pay_week"].'</td>
                         <td>'.$row["event_id"].'</td>

    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }

?>
