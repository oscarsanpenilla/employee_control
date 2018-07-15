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
    <link rel="stylesheet" href="../css/registro_horas.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta charset="UTF-8">
    <title>Sanvan Construction</title>
</head>
<body>
    <form action="insertar_eventos.php" method="post" >
        <?php echo "<h3> Registro Horas </h3>"; ?>
        <p>Site: </p>
        <select  name="lugar" required="required">
            <?php foreach($arreglo_lugares as $elemento): ?>
                    <option value="<?php echo $elemento->site;?>"> <?php echo $elemento->site;   ?>  </option>
            <?php endforeach ?>
        </select>
        <p>Fecha: </p>
        <input type="date" name="fecha" required="required" value="<?php echo date("Y-m-d");?>">
        <p>Horas Trabajadas</p>
        <select name="horas" required="required">
            <?php
            echo "<option value='8'>8</option>";
            for ($i=0; $i < 24; $i++) echo "<option value='$i'>$i</option>";   ?>
        </select>
        <p>Minutos</p>
        <select name="frac_hrs" required="required">
            <option value='0.00'>0</option>
            <option value='0.25'>15</option>
            <option value='0.50'>30</option>
            <option value='0.75'>45</option>
        </select>
        <p>Comentarios:</p>
        <input type="text" name="comentario" >
        <input class="btn_principal" type="submit" name="enviar" value="Agregar">

        <a href="cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>

    </form>

</body>
</html>
