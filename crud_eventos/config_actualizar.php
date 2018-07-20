<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];

    $id = $employee->id;
    $name = $_POST["name"];
    $user= $_POST["user"];
    $password= $_POST["password"];
    //$employee_rate= $_POST["employee_rate"];
    //$pay_week= $_POST["pay_week"];
    //$ocupation= $_POST["ocupation"];
    $phone= $_POST["phone"];
    //$paid_by= $_POST["paid_by"];
    $bank_info= $_POST["bank_info"];

    $sql = "UPDATE users SET name='$name', user='$user', password='$password', phone='$phone', bank_info='$bank_info'";
    $sql .= ", ocupation='$task', phone='$phone', bank_info='$bank_info' WHERE id = '$id'";
    $conexion_db->Prepare($sql);

    header("Location:insertar_eventos_crud.php");
?>
