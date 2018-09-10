<?php
include_once '../../funtions.php';

$conexion_db = new ConexionDB();
$type = $_POST['type'];



if ($type == "name") {
  $nombre = $_POST['busqueda'];
  $sql = "SELECT * FROM users WHERE name LIKE '%".$nombre."%'";
  $r = $conexion_db->ConsultaArray($sql);
  if (count($r)>0) {
    echo json_encode($r);
  }else if ($nombre = "") {
    $r = array('name' => 'No coincidences' );
    echo json_encode($r);
  }else {
    $r = array('name' => 'No coincidences' );
    echo json_encode($r);
  }

}

if ($type == "site") {
  $sql = 'SELECT site FROM sites ';
  $r = $conexion_db->ConsultaArray($sql);
}

if ($type == "edit") {
  $eventos = $_POST['eventos'];
  $id_empleado = $_POST['id_empleado'];

  $sql = "SELECT * FROM users WHERE id= $id_empleado";
  $r = $conexion_db->ConsultaSQL($sql);
  $repuesta = array();

  // Insertamos, Acualizamos o eleminamos los eventos
  foreach ($eventos as $key => $evento) {
    $id = $r->id;
    $work_for = $r->work_for;
    $paid_by = $r->paid_by;
    $site = $evento['site'];
    $ocupation = $r->ocupation;
    $name = $r->name;
    $employee_rate = $r->employee_rate;
    $work_for_rate = $r->work_for_rate;
    $date = $evento['date'];
    $hours_day = $evento['hours_day'];
    $total_day = $evento['hours_day'] * $work_for_rate;
    $bank_info = $r->bank_info;
    $phone = $r->phone;
    $pay_week = $r->pay_week;

    // Buscamos si hay registros en la tabla Eventos
    $sql = "SELECT * FROM events WHERE id='$id' AND site='$site' AND date='$date'";
    $obj = $conexion_db->ConsultaArray($sql);


    if (count($obj) > 0) {
      // Hay registros

      if ($evento['hours_day'] != '') {
        // hay horas,  por lo que actualizamos el registro
        $sql = "UPDATE events
        SET work_for='$work_for', paid_by='$paid_by', ocupation='$ocupation', hours_day='$hours_day', total_day='$total_day', employee_rate='$employee_rate', work_for_rate='$work_for_rate', bank_info='$bank_info', phone='$phone', pay_week='$pay_week'
        WHERE id='$id' AND date='$date' AND site='$site'";
        $conexion_db->Prepare($sql);
        //echo "update";
      }else{
        // no hay horas por lo que eliminamos el registros
        $sql = "DELETE FROM events WHERE id='$id' AND date='$date' AND site='$site'";
        $conexion_db->Prepare($sql);
        //echo "borrar";
      }

    }else{
      // No hay regristos
      if ($evento['hours_day'] != '') {
        // hay horas,  por lo que insertamos el registro
        $note = "";
        $sql = "INSERT INTO events (id,work_for,paid_by,site,ocupation,name,date,hours_day,total_day,employee_rate,work_for_rate,bank_info,phone,pay_week,note)
        VALUES ('$id','$work_for','$paid_by','$site','$ocupation','$name','$date','$hours_day','$total_day','$employee_rate','$work_for_rate','$bank_info','$phone','$pay_week','$note')";
        $conexion_db->Prepare($sql);
        //echo "insertar";
      }else{
        // No tomamos accion
        //echo "nada";
      }
    }
  }// end foreach




} // end if editar




?>
