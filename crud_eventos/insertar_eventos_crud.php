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

    <p class="txt_anterior_tabla">Registros <?php echo $periodo[$indice_periodo]; ?></p>
    <table width="100%" align="center">
    <thead>
      <tr>
              <th class="col_fecha">Fecha</th>
              <th class="col_site">Site</th>
              <th class="col_hrs">Horas</th>
              <th class="col_rate">Rate</th>
              <th class="col_dia">$/día</th>
              <th class="col_btn"> </th>
      </tr>
    </thead>
    <tbody>
          <?php foreach($array_eventos as $elemento): ?>
          <tr>
                  <td class="first_col"> <?php echo date_format(date_create($elemento->date),"D d/M/y") ?></td>
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

    </tbody>
    </table>
    <div class="totales">
      <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
      <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
    </div>

    <div class="btn_inf">
        <a href="registro_horas.php"><input class='btn_principal' type='button' value='Nuevo Registro'></a>
        <a href="../cerrar_session.php"><input id="logout" type='button' value='Salir'></a>
        <a href="formulario_config.php"><input type='button' value='Configuración'></a>
    </div>


  </div>




</body>
</html>
