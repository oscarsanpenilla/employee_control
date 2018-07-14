<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];
    $id = $employee->id;
    $sql= "SELECT * FROM users WHERE id= '$id'";
    $consulta =  $conexion_db->ConsultaSQL($sql);
    $password = $consulta->password;
    $contra_vieja = $_POST['contra_vieja'];
    $contra_nueva = $_POST['contra_nueva'];
    if ($password == $contra_vieja) {
      $sql = "UPDATE users SET password='$contra_nueva' WHERE password = '$contra_vieja' AND id= '$id'";
      $conexion_db->Prepare($sql);
      header("Location:../crud_eventos/insertar_eventos_crud.php");
    }else {
      header("Location:formulario_cambiar_contra_incorrecta.php");
    }

?>
