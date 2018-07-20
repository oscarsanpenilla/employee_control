<?php
    include("funtions.php");
    include("employee.php");

    $conexion_db = new ConexionDB();

    $work_for= $_POST['work_for'];
    $name= $_POST['name'];
    $user= $_POST['user'];
    $password= $_POST['password'];
    $employee_rate= $_POST['employee_rate'];
    $work_for_rate = $employee_rate;
    $pay_week= $_POST['pay_week'];
    $ocupation= $_POST['ocupation'];
    $phone= $_POST['phone'];
    $paid_by= $_POST['paid_by'];
    $bank_info= $_POST['bank_info'];

    $sql= "INSERT INTO `users` (`work_for`,`name`, `user`, `password`, `employee_rate`,
                                `work_for_rate`,`pay_week`, `ocupation`, `phone`,`paid_by`,
                                `bank_info`) ";
    $sql.= "VALUES ('$work_for','$name','$user','$password','$employee_rate','$work_for_rate',
                    '$pay_week','$ocupation','$phone','$paid_by','$bank_info')";
    $conexion_db->Prepare($sql);
    header("Location:registro_exitoso.php");
?>
