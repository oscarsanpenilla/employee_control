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
    <title>Sanvan Modify Places</title>
  <link rel="stylesheet" href="../css/crud_lugares.css">
</head>
<body>
  <div class="contenedor">
    <table  align="center">
      <h3>Sites Panel</h3>
      <?php foreach($array_usuarios as $elemento): ?>
     	<tr>
        <td> <?php echo $elemento->site ?></td>
        <td><a href="crud_lugares_borrar.php?Id=<?php echo $elemento->id ?>"><input type='button' name='borrar'  value='Borrar'></td></a>
      </tr>
      <?php endforeach ?>

    	  <form action="crud_lugares_insertar.php" method="post">
          <td><input class="textbox" type='text' name='lugar' required="required" size='20' placeholder="Place"></td>
          <td ><input  type='submit'  name='insertar'  value='Agregar'></td>
        </form>

    </table>
   <div class="contenedor-btn">
    <a href="main_admin.php"><input type='button' value='Main Menu'></a>
   	<a href="../cerrar_session.php"><input type='button' value='Log out'></a>
  </div>
 </div>
</body>
</html>
