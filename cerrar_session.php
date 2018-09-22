<?php
include("employee.php");
    session_start();
    if($_SESSION['employee']->admin == 1){
      //header("Location: ./admin/main_admin.php");
      echo "<script type='text/javascript'> window.close(); </script>";
    }else{
      session_destroy();
      header("Location: index.php");
    }


?>
