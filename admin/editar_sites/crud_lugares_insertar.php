<?php
    include("../../funtions.php");
    $conexion_db = new ConexionDB();
    $lugar = $_POST["lugar"];
    $sql = "INSERT INTO sites (site) VALUES('$lugar')";
    $conexion_db->Prepare($sql);
    header("Location:crud_lugares.php");
?>
