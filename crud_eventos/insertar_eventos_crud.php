<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];
    $user_id = $_SESSION['employee']->id;

    $array_eventos = ConexionDB::SemanaActual(0,$conexion_db,$user_id);
    $periodo = array(" de la Semana Actual", " de la Quincena de Pago", " de la Quincena Pasada", " de la Quincena Antepasada");
    $indice_periodo = 0;
    if (isset($_POST['quincena'])) {
      switch ($_POST['quincena']) {
        case '0':
          $array_eventos = ConexionDB::SemanaActual(0,$conexion_db,$user_id);
          $indice_periodo = 0;
          break;
        case '1':
          $array_eventos = ConexionDB::Quincena(0,$conexion_db,$user_id);
          $indice_periodo = 1;
          break;
        case '2':
          $array_eventos = ConexionDB::Quincena(1,$conexion_db,$user_id);
          $indice_periodo = 2;
          break;
        case '3':
          $array_eventos = ConexionDB::Quincena(2,$conexion_db,$user_id);
          $indice_periodo = 3;
          break;
        }
    }
    $total_pago = 0.0;
    $total_hrs = 0.0;

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
  <div class="main">
    <section>
    <center>
      <!-- Imprime el nombre del trabajador -->
      <h2 class="title">Bienvenido</h2>
      <?php echo "<h3> $employee->name </h3>"; ?>
       <!-- Selector de semana -->
       <form action="insertar_eventos_crud.php" method="post">
      <p>Selecciona el intervalo deseado</p>
       <select class="semana" name="quincena" >
           <option value='0'>Semana Actual</option>
           <option value='1'>Quincena de Pago</option>
           <option value='2'>Quincena Pasada</option>
           <option value='3'>Quincena Antepasada</option>
       </select>
       <input type='submit' value="Ver" >
     </form>

    <table width="100%" align="center">
    <tr >
      <td colspan="8" width="100%" class="primera_fila">Registros <?php echo $periodo[$indice_periodo]; ?></td>
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
        <a href="registro_horas.php"><input class='btn_principal' type='button' value='Nuevo Registro'></a>
        <a href="../cerrar_session.php"><input id="logout" type='button' value='Salir'></a>
        <a href="formulario_config.php"><input type='button' value='Configuración'></a>
    </center>
    </section>

  </div>




</body>
</html>
