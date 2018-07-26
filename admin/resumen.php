<?php
  include("../funtions.php");
  include("../employee.php");
  include("../validar_inicio_sesion.php");

  $conexion_db = new ConexionDB();
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $paid_by = $_POST['paid_by'];
  $site = $_POST['site'];
  $ocupation = $_POST['ocupation'];
  $sql = "SELECT site,ocupation,name, SUM(hours_day) AS hours, work_for_rate, SUM(hours_day)*work_for_rate AS total
          FROM events ";
  $sql .= "WHERE date BETWEEN '$fecha_inicio' AND '$fecha_fin'";
  if ($paid_by != "any") { $sql .= " AND paid_by='$paid_by'";  }
  if ($site != "any") { $sql .= " AND site='$site'"; }
  if ($ocupation != "any") { $sql .= " AND ocupation='$ocupation'"; }
  $sql .= " GROUP BY name ORDER BY site,ocupation,name";
  $results = $conexion_db->ConsultaArray($sql);
  $sql = "SELECT name,bank_info,SUM(hours_day)*work_for_rate AS total FROM events ";
  $sql .= "WHERE date BETWEEN '$fecha_inicio' AND '$fecha_fin'";
  if ($paid_by != "any") { $sql .= " AND paid_by='$paid_by'";  }
  if ($site != "any") { $sql .= " AND site='$site'"; }
  if ($ocupation != "any") { $sql .= " AND ocupation='$ocupation'"; }
  $sql .= " GROUP BY name ORDER BY name";
  $results_bank = $conexion_db->ConsultaArray($sql);
  echo $sql;



 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <div class="main">
       <table>
         <thead>
           <tr>
             <th>Site</th>
             <th>Ocupation</th>
             <th>Name</th>
             <th>work_for_rate</th>
             <th>Total hrs</th>
             <th>Total</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($results as $row):?>
             <tr>
               <td><?php echo $row->site ?> </td>
               <td><?php echo $row->ocupation ?> </td>
               <td><?php echo $row->name ?> </td>
               <td><?php echo $row->work_for_rate ?> </td>
               <td><?php echo $row->hours ?> </td>
               <td><?php echo $row->total ?> </td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     </div>
     <div class="">
       <table>
         <thead>
           <tr>
             <th>Name</th>
             <th>Bank Info</th>
             <th>Amount</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($results_bank as $row):?>
             <tr>
               <td><?php echo $row->name ?> </td>
               <td><?php echo $row->bank_info ?> </td>
               <td><?php echo $row->total ?> </td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     </div>
     <pre>
       <?php //var_dump($results); ?>

     </pre>
   </body>
 </html>
