<?php
    include("../../funtions.php");
    include("../../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $id = $_GET["Id"];
    $sql = "DELETE FROM deleted_users WHERE id = '$id'";
    $conexion_db->Prepare($sql);

    $sql = "UPDATE users
            SET active = 1
            WHERE id = $id";
    $conexion_db->Prepare($sql);

    header("Location:crud_empleados_eliminados.php");
?>
