<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();


    $work_for = $_POST["work_for"];
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];
    $work_for = $_POST["work_for"];
    $work_for_rate = $_POST["work_for_rate"];
    $precio_hora = $_POST["precio_hora"];
    $payment_week = $_POST["payment_week"];
    $status = $_POST["status"];
    $task = $_POST["task"];
    $phone = $_POST["phone"];
    $paid_by = $_POST["paid_by"];
    $bank_info = $_POST["bank_info"];

    if ($status == 'on')
    {
      $status = 1;
    }else {
      $status = 0;
    }

    //var_dump($_POST);

    $sql = "INSERT INTO users (work_for,user,password,name,employee_rate,work_for_rate,pay_week,active,ocupation,phone,paid_by,bank_info) ";
    $sql .= "VALUES('$work_for','$usuario','$contra','$nombre','$precio_hora','$work_for_rate','$payment_week','$status','$task','$phone','$paid_by','$bank_info')";
    $conexion_db->Prepare($sql);

    header("Location:crud_empleados.php");







?>
