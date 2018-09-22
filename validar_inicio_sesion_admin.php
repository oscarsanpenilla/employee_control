<?php
include_once("../../employee.php");
session_start();

if(!isset($_SESSION['employee'])){
	header("location: /sanvan_system/index.php");
}

if ($_SESSION['employee']->admin != 1) {
  header("location: http://sanvancontracting.com/");
}


?>
