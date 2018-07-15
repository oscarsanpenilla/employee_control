<?php
    include("conexion.php");
    session_start();

        
    if(!isset($_SESSION['usuario'])){
        header("location:index.php");
    }
           
    $sql= "SELECT nombre, ID FROM usuarios_pass";
    $sentencia = $conexion_db->prepare($sql);

    $sentencia->execute();
    $arreglo_trabajadores = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sql = " SELECT * FROM lugares ";
    $sentencia = $conexion_db->prepare($sql);
    $sentencia->execute();
    $arreglo_lugares = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Document</title>
</head>
<body>
   <form action="resumen_trabajadores.php" method="post">
     
      <h2>Period of time</h2><br>
      <h3>From:</h3>
       <input type="date" required="required" name="fecha_inicio" value="<?php echo date("Y-m-d",strtotime('-15 day'))?>">
        <h3>To:</h3>
       <input type="date" required="required" name="fecha_fin" value="<?php echo date("Y-m-d")?>"><br><br>
       
       
        
        <input type="submit" name="enviar" value="Send">
  
   </form>
    
</body>
</html>