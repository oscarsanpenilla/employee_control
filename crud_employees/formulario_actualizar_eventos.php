<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <link rel="stylesheet" href="../css/events.css">
  <title>Sanvan</title>
</head>
<body>
  <div class="main">
    <h1>Actualizar Eventos</h1>
    <form action="resumen.php" method="post">
      <section id="form_date">
        <p  class="p_form">Desde:</p>
        <input type="date" required="required" name="fecha_inicio" value="<?php echo $start_date?>">
        <p class="p_form">Hasta:</p>
        <input type="date" required="required" name="fecha_fin" value="<?php echo $end_date?>">
      </section>
      <input class="btn_principal" type="submit" name="enviar" value="Enviar">
    </form>
    <div class="btn_inf">
      <a href="main_admin.php"> <input type="button" value="Main Menu"> </a>
    </div>
  </div>
  <script src="../js/jQuery.js"></script>
  <script src="../js/script_resume.js"></script>


</body>

</html>
