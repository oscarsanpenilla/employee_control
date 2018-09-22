<?php
include("../../funtions.php");
include("../../validar_inicio_sesion_admin.php");
$conexion_db = new ConexionDB();
$sql = "SELECT *
FROM users
WHERE active=1
ORDER BY work_for,ocupation,name";
$array_usuarios = $conexion_db->ConsultaArray($sql);

$sql = "SELECT work_for,count(id) as count
FROM users
WHERE active=1
GROUP BY work_for";
$array_conteo = $conexion_db->ConsultaArray($sql);
//var_dump($array_conteo);
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <title>Sanvan Employees</title>
  <link rel="stylesheet" type="text/css" href="../../css/events.css">
  <link rel="shortcut icon" type="image/png" href="../../img/favicon.ico">
</head>
<body>
  <div class="main">
    <div class="top">
      <h1>Employees</h1>
      <select class="selector" name="" id="filtro">
        <option value="last_periods">Last Periods</option>
        <option value="Sanvan">Sanvan</option>
        <option value="Tolin">Tolin</option>
        <option value="Global Contact">Global Contact</option>
      </select>
      <div class="busqueda">
        <input id="busqueda" type="text" name="" value="" placeholder="Search...">
        <div class="" id="resultado_busqueda">

        </div>
      </div>
    </div>
    <div class="middle table" id="tabla_empleados">
    </div>
    <div class="bottom contenedor-btn">
      <a href="../nuevo_empleado/formulario_nuevo_empleado.php"><input class="btn_principal" type='button' value='New Employee'></a>
      <a href="../main_admin.php"><input type='button' value='Main Menu'></a>
      <a href="../../cerrar_session.php"><input type='button'value='Log Out'></a>
    </div>
  </div>


</body>
<script src="../../js/jQuery.js"> </script>
<script src="../../js/script_editar_empleados.js">

</script>
</html>
