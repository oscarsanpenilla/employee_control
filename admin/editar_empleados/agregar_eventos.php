<?php
include("../../funtions.php");
include("../../employee.php");

$conexion = new ConexionDB();
$id = $_GET['Id'];
$sql= "SELECT * FROM users WHERE id= '$id' ";;
$consulta = $conexion->ConsultaArray($sql);
echo $id;
var_dump($consulta);
$employee = new Employee($consulta[0]->user,
$consulta[0]->id,
$consulta[0]->work_for,
$consulta[0]->password,
$consulta[0]->work_for_rate,
$consulta[0]->name,
$consulta[0]->employee_rate,
$consulta[0]->ocupation,
$consulta[0]->pay_week,
$consulta[0]->active,
$consulta[0]->bank_info,
$consulta[0]->phone,
$consulta[0]->paid_by,
$consulta[0]->admin);

session_start();

$_SESSION['employee'] = $employee;
header("location:../../crud_eventos/insertar_eventos_crud.php");


?>
