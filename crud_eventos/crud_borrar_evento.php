<?php



    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();

    $event_id = $_GET['num'];



    $sql = "DELETE FROM events WHERE event_id ='$event_id'";

    $conexion_db->Prepare($sql);



    header("Location:insertar_eventos_crud.php");







?>
