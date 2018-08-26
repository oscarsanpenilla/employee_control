<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];
    $id = $_POST["id"];
    $work_for = $_POST["work_for"];
    $name= $_POST["name"];
    $user= $_POST["user"];
    $password= $_POST["password"];
    $employee_rate= $_POST["employee_rate"];
    $work_for_rate = $_POST["work_for_rate"];
    $pay_week= $_POST["pay_week"];
    $status= $_POST["status"];
    $ocupation= $_POST["ocupation"];
    $phone= $_POST["phone"];
    $paid_by= $_POST["paid_by"];
    $bank_info= $_POST["bank_info"];
    $fecha_inicio =  $_POST["fecha_inicio"];
    $fecha_fin =  $_POST["fecha_fin"];
    $sql = "UPDATE users
            SET work_for='$work_for', name='$name', user='$user', password='$password',
                employee_rate='$employee_rate', work_for_rate='$work_for_rate',
                phone='$phone', paid_by='$paid_by', bank_info='$bank_info',
                active='$status', phone='$phone', paid_by='$paid_by',
                bank_info='$bank_info'
                WHERE id = '$id'";
    $conexion_db->Prepare($sql);
    //var_dump($_POST);
    if (isset($_POST["date_checkbox"])) {

      $sql = "UPDATE events
              SET work_for='$work_for', employee_rate='$employee_rate',
                  work_for_rate='$work_for_rate', pay_week='$pay_week',
                  phone='$phone', paid_by='$paid_by', bank_info='$bank_info',
                  ocupation='$ocupation'
                  WHERE id = '$id' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin'";
      $conexion_db->Prepare($sql);
    }

    header("Location:crud_empleados.php");
?>
