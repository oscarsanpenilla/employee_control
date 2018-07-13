<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];
    $id = $employee->id;
    $sql= "SELECT site FROM sites ORDER by site";
    $arreglo_lugares = $conexion_db->ConsultaArray($sql);
    $sql= "SELECT employee_rate FROM users WHERE id = '$id'";
    $arreglo_precio = $conexion_db->ConsultaArray($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/estilos.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta charset="UTF-8">
    <title>Sanvan Construction</title>
</head>
<body>
    <form action="insertar_eventos.php" method="post" >
        <?php echo "<h2> Trabajador: " . $employee->name . "</h2>"; ?>
        <p>Site: </p><br>
        <select  name="lugar" required="required">
            <?php foreach($arreglo_lugares as $elemento): ?>
                    <option value="<?php echo $elemento->site;?>"> <?php echo $elemento->site;   ?>  </option>
            <?php endforeach ?>
        </select><br><br>
        <p>Fecha: </p><br>
        <input type="date" name="fecha" required="required" value="<?php echo date("Y-m-d");?>"><br>
        <p>Horas Trabajadas</p> <br>
        <select name="horas" required="required">
            <?php
            echo "<option value='8'>8</option>";
            for ($i=0; $i < 24; $i++) echo "<option value='$i'>$i</option>";   ?>
        </select>
        <span> . </span>
        <select name="frac_hrs" required="required">
            <option value='0.00'>00</option>
            <option value='0.25'>25</option>
            <option value='0.50'>50</option>
            <option value='0.75'>75</option>
        </select>
        <br><br>
        <p>Comentarios:</p> <br>
        <input type="text" name="comentario" ><br><br>
        <input type="submit" name="enviar" value="Agregar">
        <a href="cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>
    </form>
</body>
</html>
