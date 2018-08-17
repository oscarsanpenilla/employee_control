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
    $sql= "SELECT site,date FROM events WHERE id = '$id' ORDER BY event_id";
    $ultimo_evento = $conexion_db->ConsultaArray($sql);
    $ultimo_evento = end($ultimo_evento);
    $arr_fechas = Events::PeriodoPago();
    //var_dump($arr_fechas);
    $fecha_min = $arr_fechas[0]->week_start;
    date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/events.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta charset="UTF-8">
    <title>Sanvan Construction</title>
</head>
<body>
  <div class="main">
    <form action="insertar_eventos.php" method="post" >
        <h3> Registro de Horas </h3>
        <p class="p_info">Aquí podras regristrar tus horas, si te equivocas en el registro solamente borralo y agrega uno nuevo. Los registros se guardan automáticamente.</p>
        <p class="p_form">Site: </p>
        <select  class="semana" name="lugar" required="required">
          <option selected='selected' value="<?php echo $ultimo_evento->site;?>"><?php echo $ultimo_evento->site;?></option>
            <?php foreach($arreglo_lugares as $elemento): ?>
                    <option value="<?php echo $elemento->site;?>"> <?php echo $elemento->site;   ?>  </option>
            <?php endforeach ?>
        </select>
        <p class="p_form">Fecha: </p>
        <input min= '<?php echo $fecha_min; ?>' max='<?php echo $today; ?>' type="date" name="fecha" required="required" value="<?php echo date('Y-m-d', strtotime($ultimo_evento->date. ' + 1 days'));?>">
        <p class="p_form">Horas Trabajadas</p>
        <select class="semana" name="horas" required="required">
            <?php
            for ($i=0; $i < 24; $i++){
              if ($i == 8) {
                echo "<option value='$i'selected>$i</option>";
              }else {
                echo "<option value='$i'>$i</option>";
              }
            }    ?>
        </select>
        <p class="p_form">Minutos</p>
        <select class="semana" name="frac_hrs" required="required">
            <option value='0.00'>0</option>
            <option value='0.25'>15</option>
            <option value='0.50'>30</option>
            <option value='0.75'>45</option>
        </select>
        <p class="p_form">Comentarios:</p>
        <input type="text" name="comentario" >

        <div class="btn_inf">
          <input class="btn_principal" type="submit" name="enviar" value="Agregar">
          <a href="insertar_eventos_crud.php"><input type='button' value='Regresar'></a>
          <a href="../cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>
        </div>


    </form>
  </div>
</body>
</html>
