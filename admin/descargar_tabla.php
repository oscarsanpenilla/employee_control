    <?php

    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");



  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];

  $file_name = "sanvan_registros_".$fecha_inicio."-".$fecha_fin."-".date(Ymd);
  // output headers so that the file is downloaded rather than displayed
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename='.$file_name.'.csv');



    $conexion_db = new ConexionDB();
    $sql = " SELECT * FROM events WHERE date BETWEEN '$fecha_inicio' AND '$fecha_fin' ";
    $result = $conexion_db->ConsultaArray($sql);



    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    fputcsv($output, array('id', 'work_for', 'paid_by','site','ocupation','name',
                          'date','hours_day','total_day','employee_rate','work_for_rate',
                          'bank_info','phone','note','pay_week','event_id'));


    if(count($result) > 0)
     {
       // output the column headings


          foreach($result as $row)
          {
            $line_data = array($row->id,$row->work_for,$row->paid_by,$row->site,
                              $row->ocupation,$row->name,$row->date,$row->hours_day,
                              $row->total_day,$row->employee_rate,$row->work_for_rate,
                              $row->bank_info,$row->phone,$row->note,$row->pay_week,
                              $row->event_id,"/n");
            fputcsv($output,$line_data);


         }



        //  drupal_set_header("Content-type: text/csv; charset=utf-8");







     }


     ?>
