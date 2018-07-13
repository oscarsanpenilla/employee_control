<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];
    $nombre = $_POST["nombre"];
    $precio_hora = $_POST["precio_hora"];
    $payment_week = $_POST["payment_week"];
    $status = $_POST["status"];
    $task = $_POST["task"];
    $phone = $_POST["phone"];
    $paid_by = $_POST["paid_by"];
    $bank_info = $_POST["bank_info"];
    $sql = "INSERT INTO users (user,password,name,employee_rate,pay_week,active,ocupation,phone,paid_by,bank_info) ";
    $sql .= "VALUES('$usuario','$contra','$nombre','$precio_hora','$payment_week','$status','$task','$phone','$paid_by','$bank_info')";
    $conexion_db->Prepare($sql);

    header("Location:crud_empleados.php");







?>
