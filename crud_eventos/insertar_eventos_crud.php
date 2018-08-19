<?php
include("../funtions.php");
include("../employee.php");
include("../validar_inicio_sesion.php");

$conexion_db = new ConexionDB();
$employee = $_SESSION['employee'];
$user_id = $_SESSION['employee']->id;

$arr_sem_actual = Events::SemanaActual($employee);
$arr_quin_pago = Events::QuincenaPago($employee,-1);
$arr_quin_pasada = Events::QuincenaPago($employee,-2);
$arr_quin_ante = Events::QuincenaPago($employee,-3);
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
  <title>Sanvan Contracting</title>
  <link rel="stylesheet" href="../css/events.css">
  <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
</head>
<body>
  <div class="main">
    <h2 class="title">Bienvenido</h2>
    <?php echo "<h3> $employee->name </h3>"; ?>
    <div id="insertar_eventos_crud">
      <p id='p_intervalo'>Selecciona el intervalo deseado</p>
      <select id='intervalo' class="semana" name="quincena" >
        <option id='ambos' selected>Quincena de Pago y Semana Actual</option>
        <option id='sem_actual'>Semana Actual</option>
        <option id='quin_pago' >Quincena de Pago</option>
        <option id='quin_pasada' >Quincena Pasada</option>
        <option id='quin_antepasada' >Quincena Antepasada</option>
      </select>
      <section id="quin_pago">
        <p class="txt_anterior_tabla">Registros Quincena de Pago</p>
        <?php
        $total_pago = 0.0;
        $total_hrs = 0.0;
        ?>
        <table>
          <thead>
            <tr>
              <th class="col_fecha">Fecha</th>
              <th class="col_site">Site</th>
              <th class="col_hrs">Horas</th>
              <th class="col_rate">Rate</th>
              <th class="col_dia">$/día</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($arr_quin_pago as $elemento): ?>
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
                <td ><a  href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"><input type='button' name='borrar' value='Borrar'></td></a>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <section id="sem_actual">
        <p class="txt_anterior_tabla">Registros Semana Actual</p>
        <?php
        $total_pago = 0.0;
        $total_hrs = 0.0;
        ?>
        <table >
          <thead>
            <tr>
              <th class="col_fecha">Fecha</th>
              <th class="col_site">Site</th>
              <th class="col_hrs">Horas</th>
              <th class="col_rate">Rate</th>
              <th class="col_dia">$/día</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach($arr_sem_actual as $elemento): ?>
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
                <td ><a  href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"><input type='button' name='borrar' value='Borrar'></td></a>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <section id="quin_pasada">
        <p class="txt_anterior_tabla">Registros Quincena Pasada</p>
        <?php
        $total_pago = 0.0;
        $total_hrs = 0.0;
        ?>
        <table>
          <thead>
            <tr>
              <th class="col_fecha">Fecha</th>
              <th class="col_site">Site</th>
              <th class="col_hrs">Horas</th>
              <th class="col_rate">Rate</th>
              <th class="col_dia">$/día</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($arr_quin_pasada as $elemento): ?>
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
                <td ><a  href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"><input type='button' name='borrar' value='Borrar'></td></a>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
      <section id="quin_antepasada">
        <p class="txt_anterior_tabla">Registros Quincenca Antepasada</p>
        <?php
        $total_pago = 0.0;
        $total_hrs = 0.0;
        ?>
        <table width="100%" align="center">
          <thead>
            <tr>
              <th class="col_fecha">Fecha</th>
              <th class="col_site">Site</th>
              <th class="col_hrs">Horas</th>
              <th class="col_rate">Rate</th>
              <th class="col_dia">$/día</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($arr_quin_ante as $elemento): ?>
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
                <td ><a  href="crud_borrar_evento.php?num=<?php echo $elemento->event_id ?>"><input type='button' name='borrar' value='Borrar'></td></a>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="totales">
          <p> Total Horas: <strong><?php echo $total_hrs; ?></strong></p>
          <p> Total  Pago: <strong>$<?php echo $total_pago; ?> </strong></p>
        </div>
      </section>
    </div>
    <div class="btn_inf">
      <a href="formulario_registro_horas.php"><input class='btn_principal' type='button' value='Nuevo Registro'></a>
      <a href="../cerrar_session.php"><input id="logout" type='button' value='Salir'></a>
      <a href="formulario_config.php"><input type='button' value='Configuración'></a>
    </div>
  </div>
</body>
<script src="../js/jQuery.js"></script>
<script src="../js/insertarEventos.js"></script>
</html>
