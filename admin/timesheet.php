<?php
  include("../funtions.php");
  include("../employee.php");
  include("../validar_inicio_sesion.php");

  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $site = $_POST['site'];
  $ocupation = $_POST['ocupation'];

  $conexion_db = new ConexionDB();

  if ($ocupation != "any") {
    $sql = "SELECT DISTINCT date
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin' AND ocupation='$ocupation'
            ORDER BY date";
    $dates = $conexion_db->ConsultaArray($sql);
    $sql = "SELECT DISTINCT name,ocupation
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin' AND ocupation='$ocupation'
            ORDER BY ocupation,name";
    $names = $conexion_db->ConsultaArray($sql);
    $sql = "SELECT name, date,hours_day
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin' AND ocupation='$ocupation'";
    $hours_day = $conexion_db->ConsultaArray($sql);
    $sql = "SELECT name, SUM(hours_day) AS total
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin' AND ocupation='$ocupation'
            GROUP BY name";
    $total_hours = $conexion_db->ConsultaArray($sql);
  }else{
    $sql = "SELECT DISTINCT date
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin'
            ORDER BY date";
    $dates = $conexion_db->ConsultaArray($sql);
    $sql = "SELECT DISTINCT name,ocupation
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin'
            ORDER BY ocupation,name";
    $names = $conexion_db->ConsultaArray($sql);
    $sql = "SELECT name, date,hours_day
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    $hours_day = $conexion_db->ConsultaArray($sql);
    $sql = "SELECT name, SUM(hours_day) AS total
            FROM events
            WHERE site='$site' AND date BETWEEN '$fecha_inicio' AND '$fecha_fin'
            GROUP BY name";
    $total_hours = $conexion_db->ConsultaArray($sql);

  }



  $total_hrs = 0.0;
 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/resumen.css">
     <title></title>
   </head>
   <body>
     <div class="contenedor">
       <div class="info">
         <p>Site: <strong><?php echo $site; ?> </strong></p>
         <p>Period: <strong><?php echo $fecha_inicio ?></strong> to <strong><?php echo $fecha_fin ?></strong></p>
       </div>
       <table>
         <thead>
           <tr>
             <th>Ocupation</th>
             <th>Name</th>
             <?php foreach ($dates as $date):?>
               <th><?php echo date_format(date_create($date->date),"D d")?></th>
             <?php endforeach; ?>
             <th>Total hours</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($names as $name):?>
             <tr>
               <td><?php echo $name->ocupation; ?></td>
               <td><?php echo $name->name; ?></td>
               <?php foreach ($dates as $date):?>
                 <td class="td_center">
                   <?php
                    foreach ($hours_day as $event)
                    {
                      if ($date->date == $event->date && $name->name == $event->name) {
                        echo $event->hours_day;
                      }
                    }
                    ?>
                </td>

               <?php endforeach; ?>
               <td class="td_center">
                 <?php
                 foreach ($total_hours as $total) {

                   if ($name->name == $total->name) {
                     echo $total->total;
                     $total_hrs += $total->total;
                   }
                 }
                 ?>
               </td>
             </tr>
           <?php endforeach; ?>

         </tbody>
       </table>
       <div class="div_total">
         <p>Total hours: <strong><?php echo $total_hrs; ?></strong></p>
       </div>
       <br>
     </div>

   </body>
 </html>
