<?php
  include("../funtions.php");
  include("../employee.php");
  include("../validar_inicio_sesion.php");

  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];

  $resume = new ResumeTimesheet($_POST);
  $array_resume = $resume->resume();
  //$ocupations = $resume->getOcupations();
  $results = $resume->getEvents();
  $bank_results = $resume->bankResume();
  $cash_results = $resume->cashResume();
  $hrs = 0.0;
  $paid = 0.0;

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/resumen.css">
     <title></title>
   </head>
   <body>
      <div class="contenedor"> <!--table main resume -->
       <h3>Final Resume</h3>
       <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
       <table>
         <thead>
           <tr>
             <th>Site</th>
             <th>Ocupation</th>
             <th>Hours</th>
             <th>Work for Paid</th>
           </tr>
         </thead>
         <tbody> <!-- body main resume  -->
           <?php $i = 0 ; foreach($array_resume as $row): ?>
            <tr>
              <td><?php echo $row->site; ?></td>
              <td><?php echo $row->ocupation; ?></td>
              <td class="td_center"><?php echo $row->hours; ?> </td>
              <td class="td_money"><?php echo $row->total_ocupation;?></td>
            </tr>
            <?php
              $hrs += $row->hours;
              $paid += $row->total_ocupation;
             ?>
           <?php endforeach; ?>
         </tbody>
         <tfoot> <!-- footer main resume  -->
           <tr>
             <td colspan="2">Totals</td>
             <td class="td_center"><strong><?php echo $hrs; ?></strong></td>
             <td class="td_money"><strong><?php echo $paid; ?></strong></td>
           </tr>
         </tfoot>
       </table>
     </div>
     <div class="contenedor">
       <h3>Total Employees</h3>
       <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
       <table><!-- table Total employees  -->
         <thead>
           <tr>
             <th>Site</th>
             <th>Ocupation</th>
             <th>Name</th>
             <th>Work for Rate</th>
             <th>Total hrs</th>
             <th>Total</th>
           </tr>
         </thead>
         <tbody> <!-- body Total employees  -->
           <?php
            $hrs = 0.0;
            $paid = 0.0;
            ?>
           <?php foreach ($results as $row):?>
             <tr>
               <td><?php echo $row->site ?> </td>
               <td><?php echo $row->ocupation ?> </td>
               <td><?php echo $row->name ?> </td>
               <td class="td_money"><?php echo $row->work_for_rate ?> </td>
               <td class="td_center"><?php echo $row->hours ?> </td>
               <td class="td_money"><?php echo $row->total ?> </td>
             </tr>
             <?php
             $hrs += $row->hours;
             $paid += $row->total;
             ?>
           <?php endforeach; ?>
         </tbody>
         <tfoot> <!-- footer Total employees  -->
           <tr>
             <td>Totals</td>
             <td></td>
             <td class="td_center"><?php echo sizeof($results) ?></td><td></td>
             <td class="td_center"><strong><?php echo $hrs; ?></strong></td>
             <td class="td_money"><strong><?php echo $paid; ?></strong></td>
           </tr>
         </tfoot>
       </table>
     </div>
     <div class="second_table">
       <div class="contenedor">
         <h3>TD Bank Deposits</h3>
         <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
         <table><!-- table TD Bank Deposits  -->
           <thead>
             <tr>
               <th>Name</th>
               <th class="td_center">Bank Info</th>
               <th>Amount</th>
             </tr>
           </thead>
           <tbody><!-- body TD Bank Deposits  -->
             <?php $paid = 0.0 ?>
             <?php foreach ($bank_results as $row):?>
               <tr>
                 <td><?php echo $row->name ?> </td>
                 <td class="td_center"><?php echo $row->bank_info ?> </td>
                 <td class="td_money"><?php echo $row->total ?> </td>
                 <?php $paid += $row->total ?>
               </tr>
             <?php endforeach; ?>
           </tbody>
           <tfoot><!-- footer TD Bank Deposits  -->
             <tr>
               <td>Total</td>
               <td></td>
               <td class="td_money" ><strong><?php echo $paid; ?></strong></td>
             </tr>
           </tfoot>
         </table><!-- table end TD Bank Deposits  -->
       </div><!-- TD Bank Deposits  -->
     </div><!-- second table  -->
     <div class="second_table">
       <div class="contenedor">
         <h3>No Bank Information</h3>
         <p><strong><?php echo $fecha_inicio; ?></strong> to <strong><?php echo $fecha_fin; ?></strong></p>
         <table><!-- table no bank info  -->
           <thead>
             <tr>
               <th>Name</th>
               <th>Amount</th>
             </tr>
           </thead>
           <tbody><!-- body bank info  -->
             <?php $paid = 0.0 ?>
             <?php foreach ($cash_results as $row):?>
               <tr>
                 <td><?php echo $row->name ?> </td>
                 <td class="td_money"><?php echo $row->total ?> </td>
                 <?php $paid += $row->total ?>
               </tr>
             <?php endforeach; ?>
           </tbody>
           <tfoot><!-- footer bank info  -->
             <tr>
               <td>Total</td>
               <td class="td_money" ><strong><?php echo $paid; ?></strong></td>
             </tr>
           </tfoot>
         </table><!-- table end bank info  -->
       </div><!-- TD Bank bank info  -->
     </div><!-- second table  -->
     <br>
   </body>
 </html>
