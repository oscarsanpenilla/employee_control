<?php
include_once("../employee.php");
session_start();

if(!isset($_SESSION['employee'])){
	header("location: /sanvan_system/index.php");
}
// $condicion = $_SESSION['employee']->admin;
// if ($condicion) {
// 	echo "string";
// }else{
// 	header("location: /sanvan_system/index.php");
// }
//var_dump($_SESSION['employee']);

?>
