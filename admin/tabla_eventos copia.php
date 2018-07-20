<?php

    include("../funtions.php");
    include("../validar_inicio_sesion.php");

    // Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
    mb_internal_encoding('UTF-8');

    // Esto le dice a PHP que generaremos cadenas UTF-8
    mb_http_output('UTF-8');

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $conexion_db = new ConexionDB();
    $sql = " SELECT * FROM events WHERE date BETWEEN '$fecha_inicio' AND '$fecha_fin' ";
    $consulta = $conexion_db->ConsultaArray($sql);


?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sanvan Employees</title>
  <link rel="stylesheet" type="text/css" href="../css/">
</head>
<body>
  <div class="contenedor">

    <table>
      <thead>
          <tr >
            <th>Id ,</th>
             <th>Work_for ,</th>
             <th>Paid_by ,</th>
             <th>Site ,</th>
             <th>Ocupation ,</th>
             <th>Name ,</th>
             <th>Date ,</th>
             <th>Hours_day ,</th>
             <th>Total_day ,</th>
             <th>Employee Rate ,</th>
             <th>Work for Rate ,</th>
             <th>Bank info ,</th>
             <th>Phone ,</th>
             <th>Note ,</th>
             <th>Pay_week ,</th>
             <th>Event_id ,</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach($consulta as $elemento): ?>
        <tr>
                <td> <?php echo $elemento->id ?> ,</td>
                <td> <?php echo $elemento->work_for ?> ,</td>
                <td> <?php echo $elemento->paid_by ?> ,</td>
                <td> <?php echo $elemento->site ?> ,</td>
                <td> <?php echo $elemento->ocupation ?> ,</td>
                <td> <?php echo $elemento->name?> ,</td>
                <td> <?php echo $elemento->date?> ,</td>
                <td> <?php echo $elemento->hours_day?> ,</td>
                <td> <?php echo $elemento->total_day?> ,</td>
                <td> <?php echo $elemento->employee_rate ?> ,</td>
                <td> <?php echo $elemento->work_for_rate ?> ,</td>
                <td> <?php echo $elemento->bank_info ?> ,</td>
                <td> <?php echo $elemento->phone ?> ,</td>
                <td> <?php echo $elemento->note ?> ,</td>
                <td> <?php echo $elemento->pay_week ?> ,</td>
                <td> <?php echo $elemento->event_id ?> ,</td>


        </tr>
        <?php endforeach ?>

      </tbody>

    </table>

  </div>


</body>
</html>
