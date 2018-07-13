<?php

    include("funtions.php");
    $conexion_db = new ConexionDB();
    session_start();



        

    if(!isset($_SESSION['user_id'])){

        header("location:index.php");

    }

    $user_id = $_SESSION['user_id'];



    $contra_vieja = $_POST['contra_vieja'];

    $contra_nueva = $_POST['contra_nueva'];

    //$sql = "UPDATE usuarios_pass SET nombre='$nombre', USUARIOS='$usuario', PASS='$contra', precio_hora='$precio_hora' WHERE ID = '$ID'";



    $sql = "UPDATE users SET password='$contra_nueva' WHERE password = '$contra_vieja' AND user_id= '$user_id'";

    $conexion_db->Prepare($sql);

    

    

    header("Location:insertar_eventos_crud.php");





?>