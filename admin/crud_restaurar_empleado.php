<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $id = $_GET["Id"];
    $sql= "SELECT * FROM deleted_users WHERE id= '$id'";
    $consulta =  $conexion_db->ConsultaSQL($sql);

    $id=$consulta->id;
    $work_for=$consulta->work_for;
    $name=$consulta->name;
    $user=$consulta->user;
    $password=$consulta->password;
    $employee_rate=$consulta->employee_rate;
    $work_for_rate=$consulta->work_for_rate;
    $ocupation=$consulta->ocupation;
    $phone=$consulta->phone;
    $pay_week=$consulta->pay_week;
    $active=$consulta->active;
    $paid_by=$consulta->paid_by;
    $bank_info=$consulta->bank_info;
    $admin=$consulta->admin;

    $sql= "INSERT INTO `users` (`id`,`work_for`, `name`, `user`, `password`, `employee_rate`,`work_for_rate`,`ocupation`,`phone`,`pay_week`,`active`,`paid_by`,`bank_info`,`admin`) ";
    $sql.= "VALUES ('$id','$work_for', '$name', '$user', '$password', '$employee_rate','$work_for_rate','$ocupation','$phone','$pay_week','$active','$paid_by','$bank_info','$admin')";
    $conexion_db->Prepare($sql);

    $sql = "DELETE FROM deleted_users WHERE id = '$id'";
    $conexion_db->Prepare($sql);

    header("Location:crud_empleados_eliminados.php");
?>
