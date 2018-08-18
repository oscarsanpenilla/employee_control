<?php
include("../funtions.php");
include("../validar_inicio_sesion.php");
$conexion_db = new ConexionDB();
$id = $_GET["Id"];
$sql = "SELECT * FROM users WHERE id = '$id'";
$arreglo_usuarios = $conexion_db->ConsultaArray($sql);
foreach($arreglo_usuarios as $elemento){
  $nombre = $elemento->name;
  $usuario = $elemento->user;
  $contra = $elemento->password;
  $precio_hora = $elemento->employee_rate;
}
$fechas = Events::PeriodoPago();
$start_date = $fechas[0]->week_start;
$end_date = $fechas[0]->week_end;

$arr_fechas = Events::PeriodoPago();
$fecha_min = $arr_fechas[0]->week_start;
date_default_timezone_set("America/Vancouver");
$today = date('Y-m-d');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <link rel="stylesheet" href="../css/events.css">
  <title>Sanvan Update Worker</title>
</head>
<body>
  <div class="main">
    <form action="crud_actualizar.php" method="post">

      <h1>Modify</h1>
      <p class="p_form">Work for:</p>
      <select class="semana" name="work_for"  required="required" >
        <option selected='selected'> <?php echo $elemento->work_for?> </option>
        <option value='Sanvan'>Sanvan</option>
        <option value='Tolin'>Tolin</option>
        <option value='Global Contact'>Global Contact</option>
      </select>
      <p class="p_form">Name:</p>
      <input type="text" name="name" value="<?php echo $elemento->name?>">
      <p class="p_form">User:</p>
      <input type="text" name="user" value="<?php echo $elemento->user ?>" >
      <p class="p_form">Password:</p>
      <input type="text" name="password" value="<?php echo $elemento->password ?>" >
      <p class="p_form">Employee Rate:</p>
      <input type="text" name="employee_rate" value="<?php echo $elemento->employee_rate ?>" >
      <p class="p_form">Work for Rate:</p>
      <input type="text" name="work_for_rate" value="<?php echo $elemento->work_for_rate ?>" >
      <p class="p_form">Pay Week:</p>
      <select class="semana" name="pay_week" required="required" >
        <option selected='selected'> <?php echo $elemento->pay_week ?> </option>
        <option value='A'>A</option>
        <option value='B'>B</option>
      </select>
      <p class="p_form">Active:</p>
      <input type="text" name="status" value="<?php echo $elemento->active?>" >
      <p class="p_form">Ocupation:</p>
      <select class="semana" name="ocupation"  required="required" >
        <option selected='selected'> <?php echo $elemento->ocupation?> </option>
        <option value='Labour'>Labour</option>
        <option value='Cement Finisher'>Cement Finisher</option>
        <option value='Skill Labour'>Skill Labour</option>
        <option value='Carpenter'>Carpenter</option>
        <option value='Carpenter Helper'>Carpenter Helper</option>
        <option value='Otro'>Otro</option>
      </select>
      <p class="p_form">Phone:</p>
      <input type="text" name="phone" value="<?php echo $elemento->phone?>" >
      <p class="p_form">Paid by:</p>
      <select class="semana" name="paid_by" >
        <option selected='selected'> <?php echo $elemento->paid_by?> </option>
        <option value='Rafael'>1 Rafael</option>
        <option value='Carlos'>2 Carlos</option>
        <option value='Cristian'>3 Cristian</option>
      </select>
      <p class="p_form">Bank info:</p>
      <input type="text" name="bank_info" value="<?php echo $elemento->bank_info?>" >
      <input type="hidden" name="id" value="<?php echo $id ?>">



      <div class="checkbox">
        <input type="checkbox" name="date_checkbox[]" value="true" id="date_checkbox" >
        <label for="date_checkbox"> <h3>Deseas actualizar los eventos?</h3> </label><br>
      </div>




      <section id="periodo">
        <h1>Selecciona el Periodo Deseado</h1>
        <p  class="p_form">Desde:</p>
        <input type="date" required="required" name="fecha_inicio" min= '<?php echo $fecha_min; ?>' max='<?php echo $today; ?>' value="<?php echo $start_date?>">
        <p class="p_form">Hasta:</p>
        <input type="date" required="required" name="fecha_fin" min= '<?php echo $fecha_min; ?>' max='<?php echo $today; ?>' value="<?php echo $end_date?>">
      </section><br>
      <input class="btn_principal" id="btn_modify" type="submit"  value="Modify">
      <a href="crud_empleados.php"><input  type="button" value="Return"></a>

    </form>
  </div>
</body>
<script src="../js/jQuery.js"></script>
<script src="../js/script_crud_formulario_actualizar.js"></script>
</html>
