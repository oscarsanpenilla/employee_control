<?php
    include("../../funtions.php");
    include("../../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();


    $work_for = $_POST["work_for"];
    $nombre = $_POST["name"];
    $usuario = $_POST["user"];
    $contra = $_POST["password"];
    $work_for = $_POST["work_for"];
    $work_for_rate = $_POST["work_for_rate"];
    $precio_hora = $_POST["employee_rate"];
    $pay_week = $_POST["pay_week"];
    $status = 1;
    $task = $_POST["ocupation"];
    $phone = $_POST["phone"];
    $paid_by = $_POST["paid_by"];
    $bank_info = $_POST["bank_info"];



    //var_dump($_POST);

    $sql = "INSERT INTO users (work_for,user,password,name,employee_rate,work_for_rate,pay_week,active,ocupation,phone,paid_by,bank_info) ";
    $sql .= "VALUES('$work_for','$usuario','$contra','$nombre','$precio_hora','$work_for_rate','$pay_week','$status','$task','$phone','$paid_by','$bank_info')";
    $conexion_db->Prepare($sql);

    header("Location:crud_empleados.php");







?>
