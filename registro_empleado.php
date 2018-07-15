<?php
    include("funtions.php");
    include("employee.php");

    $conexion_db = new ConexionDB();

    $name= $_POST['name'];
    $user= $_POST['user'];
    $password= $_POST['password'];
    $employee_rate= $_POST['employee_rate'];
    $pay_week= $_POST['pay_week'];
    $ocupation= $_POST['ocupation'];
    $phone= $_POST['phone'];
    $paid_by= $_POST['paid_by'];
    $bank_info= $_POST['bank_info'];

    $sql= "INSERT INTO `users` (`name`, `user`, `password`, `employee_rate`, `pay_week`, `ocupation`, `phone`,`paid_by`,`bank_info`) ";
    $sql.= "VALUES ('$name','$user','$password','$employee_rate','$pay_week','$ocupation','$phone','$paid_by','$bank_info')";
    $conexion_db->Prepare($sql);
    header("Location:index.php");
?>
