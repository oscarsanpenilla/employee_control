<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $id = $_POST["id"];
    $work_for = $_POST["work_for"];
    $name= $_POST["nombre"];
    $user= $_POST["usuario"];
    $password= $_POST["contra"];
    $rate_hour= $_POST["rate_hour"];
    $work_for_rate = $_POST["work_for_rate"];
    $payment_week= $_POST["payment_week"];
    $status= $_POST["status"];
    $task= $_POST["task"];
    $phone= $_POST["phone"];
    $paid_by= $_POST["paid_by"];
    $bank_info= $_POST["bank_info"];
    $sql = "UPDATE users SET work_for='$work_for',name='$name', user='$user', password='$password', employee_rate='$rate_hour',work_for_rate='$work_for_rate', phone='$phone', paid_by='$paid_by', bank_info='$bank_info'";
    $sql .= ",active='$status', ocupation='$task', phone='$phone', paid_by='$paid_by', bank_info='$bank_info' WHERE id = '$id'";
    $conexion_db->Prepare($sql);
    header("Location:crud_empleados.php");
?>
