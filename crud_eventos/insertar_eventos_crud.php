<?php
include("../funtions.php");
include("../employee.php");
include("../validar_inicio_sesion.php");
//include("registro_horas_copy.php");

$conexion_db = new ConexionDB();
$employee = $_SESSION['employee'];
$user_id = $_SESSION['employee']->id;

$array_eventos = Events::SemanaActual($employee);
$periodo = array(" de la Semana Actual", " de la Quincena de Pago", " de la Quincena Pasada", " de la Quincena Antepasada");
$indice_periodo = 0;
$e_sem = Events::SemanaActual($employee);
$e_quin_pago = Events::QuincenaPago($employee,0);
$e_quin_pasada = Events::QuincenaPago($employee,-1);
$e_quin_antepasada = Events::QuincenaPago($employee,-2);

//Seccion Registro Horas
$sql= "SELECT site FROM sites ORDER by site";
$arreglo_lugares = $conexion_db->ConsultaArray($sql);
$sql= "SELECT employee_rate FROM users WHERE id = '$user_id'";
$arreglo_precio = $conexion_db->ConsultaArray($sql);
$sql= "SELECT site,date FROM events WHERE id = '$user_id' ORDER BY event_id";
$ultimo_evento = $conexion_db->ConsultaArray($sql);
$ultimo_evento = end($ultimo_evento);
$fechas = Events::getActualPeriodDates('week_a');
$week_start = $fechas[0]->week_start;

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
    <div id="registros">
      <!-- Imprime el nombre del trabajador -->
      <h2 class="title">Bienvenido</h2>
      <?php echo "<h3> $employee->name </h3>"; ?>
      <!-- Selector de Registros -->
      <nav>
        <ul><a href="#"><input type="button" id="sem_actual" value="Semana Actual"></a></ul>
        <ul><a href="#"><input type="button" id="quin_pago" value="Quincena de Pago"></a></ul>
        <ul><a href="#"><input type="button" id="quin_pasada" value="Quincena Pasada"></a></ul>
        <ul><a href="#"><input type="button" id="quin_antepasada" value="Quincena Antepasada"></a></ul>
      </nav>
      <!-- Seccion de Registros -->
      <section id="sem_actual">
        <p class="txt_anterior_tabla">Registros <?php echo $periodo[0]; ?></p>
        <table width="100%">
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
            <?php
            $total_pago = 0.0;
            $total_hrs = 0.0;
            ?>
            <?php foreach($e_sem as $elemento): ?>
              <tr>
                <td class="first_col"> <?php echo date_format(date_create($elemento->date),"D d/M/y") ?></td>
                <td> <?php echo $elemento->site ?></td>
                <td> <?php echo $elemento->hours_day ?></td>
                <td> <?php echo $elemento->employee_rate ?></td>
                <td> <?php echo $elemento->total_day?></td>
                <?php
                $total_pago += $elemento->total_day;
                $total_hrs += $elemento->hours_day;
                ?>
                <td width="100px" class="td_btn">
                  <a href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"  >
                    <input type='button' name='borrar'  value='Borrar'>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table><!-- Fin Seccion de Registros -->
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <!-- Seccion de Registros -->
      <section id="quin_pago">
        <p class="txt_anterior_tabla">Registros <?php echo $periodo[1]; ?></p>
        <table width="100%">
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
            <?php
            $total_pago = 0.0;
            $total_hrs = 0.0;
            ?>
            <?php foreach($e_quin_pago as $elemento): ?>
              <tr>
                <td class="first_col"> <?php echo date_format(date_create($elemento->date),"D d/M/y") ?></td>
                <td> <?php echo $elemento->site ?></td>
                <td> <?php echo $elemento->hours_day ?></td>
                <td> <?php echo $elemento->employee_rate ?></td>
                <td> <?php echo $elemento->total_day?></td>
                <?php
                $total_pago += $elemento->total_day;
                $total_hrs += $elemento->hours_day;
                ?>
                <td width="100px" class="td_btn">
                  <a href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"  >
                    <input type='button' name='borrar'  value='Borrar'>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table><!-- Fin Seccion de Registros -->
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <!-- Seccion de Registros -->
      <section id="quin_pasada">
        <p class="txt_anterior_tabla">Registros <?php echo $periodo[2]; ?></p>
        <table width="100%">
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
            <?php
            $total_pago = 0.0;
            $total_hrs = 0.0;
            ?>
            <?php foreach($e_quin_pasada as $elemento): ?>
              <tr>
                <td class="first_col"> <?php echo date_format(date_create($elemento->date),"D d/M/y") ?></td>
                <td> <?php echo $elemento->site ?></td>
                <td> <?php echo $elemento->hours_day ?></td>
                <td> <?php echo $elemento->employee_rate ?></td>
                <td> <?php echo $elemento->total_day?></td>
                <?php
                $total_pago += $elemento->total_day;
                $total_hrs += $elemento->hours_day;
                ?>
                <td width="100px" class="td_btn">
                  <a href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"  >
                    <input type='button' name='borrar'  value='Borrar'>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table><!-- Fin Seccion de Registros -->
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <!-- Seccion de Registros -->
      <section id="quin_antepasada">
        <p class="txt_anterior_tabla">Registros <?php echo $periodo[3]; ?></p>
        <table width="100%">
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
            <?php
            $total_pago = 0.0;
            $total_hrs = 0.0;
            ?>
            <?php foreach($e_quin_antepasada as $elemento): ?>
              <tr>
                <td class="first_col"> <?php echo date_format(date_create($elemento->date),"D d/M/y") ?></td>
                <td> <?php echo $elemento->site ?></td>
                <td> <?php echo $elemento->hours_day ?></td>
                <td> <?php echo $elemento->employee_rate ?></td>
                <td> <?php echo $elemento->total_day?></td>
                <?php
                $total_pago += $elemento->total_day;
                $total_hrs += $elemento->hours_day;
                ?>
                <td width="100px" class="td_btn">
                  <a href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"  >
                    <input type='button' name='borrar'  value='Borrar'>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table><!-- Fin Seccion de Registros -->
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <div class="btn_inf">
        <a href="registro_horas.php"><input class='btn_principal' type='button' value='Nuevo Registro' id="btn_nuevo_registro"></a>
        <a href="../cerrar_session.php"><input id="logout" type='button' value='Salir'></a>
        <a href="formulario_config.php"><input type='button' value='Configuración'></a>
      </div>
    </div>
    <div id="insertar_eventos">
      <section id="registro_horas">
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
          <input type="date" name="fecha" required="required" min="<?php echo $week_start;?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime($ultimo_evento->date. ' + 1 days'));?>">
          <p class="p_form">Horas Trabajadas</p>
          <select class="semana" name="horas" required="required">
            <?php
            echo "<option value='8'>8</option>";
            for ($i=0; $i < 24; $i++) echo "<option value='$i'>$i</option>";   ?>
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

        </form>
      </section>
      <div class="btn_inf">
        <input class="btn_principal" type="submit" name="enviar" value="Agregar" id="btn_agregar">
        <a href="insertar_eventos_crud.php"><input type='button' value='Regresar' id="btn_regresar"></a>
        <a href="../cerrar_session.php" class="logout"><input  type="button" value="Salir"></a>
      </div>
    </div>
  </div>
</body>
<script src="../js/jQuery.js"></script>
<script src="../js/script_insertar_eventos_crud.js"></script>
</html>
