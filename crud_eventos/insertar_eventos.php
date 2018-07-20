<?php
    include("../funtions.php");
    include("../employee.php");
    include("../eventos.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];

    $id = $employee->id;
    $sql= "SELECT * FROM users WHERE id= '$id'";
    $consulta =  $conexion_db->ConsultaSQL($sql);

    $horas = $_POST['horas'];
    $frac_hrs = $_POST['frac_hrs'];
    $hours_day = $horas + $frac_hrs;
    $note = $_POST['comentario'];
    $date = $_POST['fecha'];
    $site = $_POST['lugar'];
    //$event = new Event($employee,$frac_hrs,$note,$date,$site);
    $work_for=$employee->work_for;
    $user=$employee->user;
    $name=$employee->name;
    $employee_rate=$employee->employee_rate;
    $work_for_rate=$employee->work_for_rate;
    $ocupation=$employee->ocupation;
    $pay_week=$employee->pay_week;
    $bank_info = $employee->bank_info;
    $phone = $employee->phone;
    $paid_by = $employee->paid_by;
    $total_day = $hours_day * $employee_rate;

    $sql= "INSERT INTO `events` (`id`,`work_for`, `paid_by`, `site`, `ocupation`, `name`, `date`, `hours_day`, `total_day`,`employee_rate`,`work_for_rate`,`bank_info`,`phone`,`note`,`pay_week`) ";
    $sql.= "VALUES ('$id','$work_for','$paid_by','$site','$ocupation','$name','$date','$hours_day','$total_day','$employee_rate','$work_for_rate','$bank_info','$phone','$note','$pay_week')";
    $conexion_db->Prepare($sql);

    header("Location:insertar_eventos_crud.php");
?>
