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
    $phone= $_POST["phone"];
    $bank_info= $_POST["bank_info"];

    $sql = "UPDATE users
            SET name='$name', user='$user', password='$password', phone='$phone',
            bank_info='$bank_info'
            WHERE id = '$id'";
    $conexion_db->Prepare($sql);

    header("Location:insertar_eventos_crud.php");
?>
