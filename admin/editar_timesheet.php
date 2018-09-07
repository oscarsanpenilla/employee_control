<?php
include '../funtions.php';
$conexion_db = new ConexionDB();
$eventos = $_POST['data'];
// var_dump($eventos);
try {
  foreach ($eventos as $key => $evento) {
    $id = $evento['id'];
    $work_for = $evento['work_for'];
    $paid_by = $evento['paid_by'];
    $site = $evento['site'];
    $ocupation = $evento['ocupation'];
    $name = $evento['name'];
    $date = $evento['date'];
    $hours_day = $evento['hours_day'];
    $total_day = $evento['total_day'];
    $employee_rate = $evento['employee_rate'];
    $work_for_rate = $evento['work_for_rate'];
    $bank_info = $evento['bank_info'];
    $phone = $evento['phone'];
    $note = $evento['note'];
    $pay_week = $evento['pay_week'];
    $sql = "INSERT INTO events (id,work_for,paid_by,site,ocupation,name,date,hours_day,total_day,employee_rate,work_for_rate,bank_info,phone,note,pay_week)
            VALUES ('$id','$work_for','$paid_by','$site','$ocupation','$name','$date','$hours_day','$total_day','$employee_rate','$work_for_rate','$bank_info','$phone','$note','$pay_week')";

      $conexion_db->Prepare($sql);
      $arrayName = array('respuesta' => 'ok' );
      echo(json_encode($eventos));
    }
  }catch (Exception $e) {
    $arrayName = array(
      'error' => $e->getMessage()
    );
    echo(json_encode($arrayName));
  }





  //header("Location:timesheet.php");




  ?>
