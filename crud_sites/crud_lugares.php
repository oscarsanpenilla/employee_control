<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();
    $sql = "SELECT * FROM sites";
    $array_usuarios = $conexion_db->ConsultaArray($sql);
?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <title>Sanvan Modify Places</title>
  <link rel="stylesheet" type="text/css" href="../css/style_crud.css">
</head>
<body>
  <center>
    <table  align="center">
      <tr >
        <td  class="primera_fila" colspan="2">Places Panel</td>
      </tr>
    	<?php foreach($array_usuarios as $elemento): ?>
     	<tr>
        <td> <?php echo $elemento->site ?></td>
        <td><a href="crud_lugares_borrar.php?Id=<?php echo $elemento->id ?>"><input class="box" type='button' name='borrar'  value='Delate'></td></a>
      </tr>
      <?php endforeach ?>
    	<tr>
    	  <form action="crud_lugares_insertar.php" method="post">
          <td><input class="box" type='text' name='lugar' required="required" size='20' class="box" placeholder="Place"></td>
          <td ><input  type='submit'  name='insertar'  value='Add'></td>
        </form>
      </tr>
    </table>
   <ul>
    <li><a href="../main_admin.php">Main Menu</a></li>
   	<li><a href="../cerrar_session.php">Log Out</a></li>
   </ul>
  </center>
</body>
</html>
