<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];
    $user_id = $_SESSION['employee']->id;
    $start_date = date("Y-m-d",strtotime('-30 day'));
    $end_date = date("Y-m-d",strtotime('+15 day'));
    //$sql = " SELECT * FROM events WHERE id=$user_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
    //$sql = " SELECT * FROM events WHERE id=$user_id AND date<="."'".date("Y-m-d")."'".";";
    $today = date("Y-m-d");


    //Registros y totales de quincena
    $sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 1";
    $fechas = $conexion_db->ConsultaArray($sql);
    $start_date = $fechas[0]->week_start;
    $end_date = $fechas[0]->week_end;
    $sql = "SELECT * FROM events WHERE id=$user_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
    $array_eventos = $conexion_db->ConsultaArray($sql);

    /*

    //Registro y totales de la semana Actualizar
    $sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 1";
    $fechas = $conexion_db->ConsultaArray($sql);
    $end_date = $fechas[0]->week_end;
    $end_date = date('Y-m-d', strtotime($end_date));
    $sql = "SELECT * FROM events WHERE id=$user_id AND date >'$end_date' ORDER BY date";
    $array_eventos = $conexion_db->ConsultaArray($sql);

    //Registro y totales de la quincena -1
    $sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 3";
    $fechas = $conexion_db->ConsultaArray($sql);
    $start_date = $fechas[1]->week_start;
    $end_date = $fechas[1]->week_end;
    $sql = "SELECT * FROM events WHERE id=$user_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
    $array_eventos = $conexion_db->ConsultaArray($sql);

    //Registro y totales de la quincena -2
    $sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 3";
    $fechas = $conexion_db->ConsultaArray($sql);
    $start_date = $fechas[2]->week_start;
    $end_date = $fechas[2]->week_end;
    $sql = "SELECT * FROM events WHERE id=$user_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
    $array_eventos = $conexion_db->ConsultaArray($sql);

    //Registro y totales de la quincena 0
    //$sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 3";
    //$fechas = $conexion_db->ConsultaArray($sql);
  //  $start_date = $fechas[0]->week_start;
  //  $end_date = $fechas[0]->week_end;
  //  $sql = "SELECT * FROM events WHERE id=$user_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";

  */
    $array_eventos = ConexionDB::Quincena(1,$conexion_db,$user_id);

    //$fecha_id =+ -1;
    //$sql = "SELECT * FROM week_a WHERE id='$fecha_id'";
    //$fechas = $conexion_db->ConsultaArray($sql);
    //$start_date = $fechas[0]->week_start;
    //$end_date = $fechas[0]->week_end;
    //$sql = "SELECT * FROM events WHERE id=$user_id AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
    //$array_eventos = $conexion_db->ConsultaArray($sql);




    $total_pago = 0.0;
    $total_hrs = 0.0;
    //echo $fecha_id."   ";
    //echo $sql;
    var_dump($fechas);
    //Selector de Quincena
    //SELECT * FROM week_a WHERE week_end<='2018-07-29' ORDER BY id DESC LIMIT 1

    //Selector semana Actual
    //

?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
<title>Sanvan Contracting</title>
<link rel="stylesheet" href="../css/events.css">
</head>
<body>
<form action="">
    <section>
    <center>
      <!-- Imprime el nombre del trabajador -->
      <h2 class="title">Bienvenido</h2>
      <?php echo "<h3> $employee->name </h3>"; ?>
       <a href="registro_horas.php"><input class='btn_principal' type='button' value='Nuevo Registro'></a>
       <!-- Selector de semana -->

       <select class="semana" name="semana" >
           <option value='0.00'>Semana Actual</option>
           <option value='0.25'>Quincena de pago</option>
           <option value='0.50'>-1 Quincena de Pago</option>
           <option value='0.75'>-2 Quincena de Pago</option>
       </select>
       <a href="actualizar_lista_eventos.php"><input type='button' value='Actualizar'></a>

  <table width="100%" align="center">
    <tr >
      <td colspan="8" width="100%" class="primera_fila">Registros</td>
    </tr>
   <tr>
            <td>Fecha </td>
            <td>Site </td>
            <td>Horas </td>
            <td>Rate</td>
            <td>$/día</td>
            <td></td>
   </tr>


	<?php foreach($array_eventos as $elemento): ?>

   	<tr>
            <td> <?php echo date_format(date_create($elemento->date),"D d/M/y") ?></td>
            <td> <?php echo $elemento->site ?></td>
            <td> <?php echo $elemento->hours_day ?></td>
            <td> <?php echo $elemento->employee_rate ?></td>
            <td> <?php echo $elemento->total_day ?></td>
            <?php
            $total_pago += $elemento->total_day;
            $total_hrs += $elemento->hours_day;

            ?>
            <td class="td_btn" width="100px"><a  href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"><input type='button' name='borrar' id='id_empleado' value='Borrar'></td></a>
    </tr>
    <?php endforeach ?>
    <tr>
            <td><?php echo "Total Horas: ".$total_hrs; ?></td>

    </tr>
    <tr>
            <td><?php echo "Total Pago: $".$total_pago; ?></td>
    </tr>
  </table>
  </center>
  <center>
        <a href="../cerrar_session.php"><input id="logout" type='button' value='Salir'></a>
        <a href="formulario_config.php"><input type='button' value='Configuración'></a>
    </center>
   </section>
</body>
</html>
