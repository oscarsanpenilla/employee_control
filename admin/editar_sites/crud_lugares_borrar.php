<?php
    include("../../funtions.php");
    $conexion_db = new ConexionDB();
    $site_id = $_GET["Id"];
    $sql = "DELETE FROM sites WHERE id = '$site_id'";
    $sentencia = $conexion_db->Prepare($sql);
    header("Location:crud_lugares.php");
?>
