<?php
    include("../funtions.php");
    include("../employee.php");
    include("../validar_inicio_sesion.php");

    $conexion_db = new ConexionDB();
    $employee = $_SESSION['employee'];
    $id = $_SESSION['employee']->id;

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $arreglo_usuarios = $conexion_db->ConsultaArray($sql);
    foreach($arreglo_usuarios as $elemento){
        $nombre = $elemento->name;
        $usuario = $elemento->user;
        $contra = $elemento->password;
        $precio_hora = $elemento->employee_rate;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="../css/events.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
    <title>Sanvan Config</title>
</head>
<body>
  <div class="main">
    <form action="config_actualizar.php" method="post" >
        <h3>Configuración</h3>
        <p class="p_info">En esta sección puedes actualizar tu información
          como: usuario, contraseña, número de contacto y la información de deposito.</p><br>
        <p class="p_form">Nombre Completo:</p>
        <input type="text" name="name" value="<?php echo $elemento->name?>">
        <p class="p_form">Usuario:</p>
        <input type="text" name="user" value="<?php echo $elemento->user ?>" >
        <p class="p_form">Contraseña:</p>
        <input type="text" name="password" value="<?php echo $elemento->password ?>" >
        <p class="p_form">Rate ($/Hora):</p>
        <input type="text" disabled="true" name="employee_rate" value="<?php echo $elemento->employee_rate ?>" >
        <p class="p_form">Semana de Pago:</p>
        <input type="text" disabled="true"name="pay_week" value="<?php echo $elemento->pay_week ?>" >
        <p class="p_form">Ocupación:</p>
        <input type="text" disabled="true" name="ocupation" value="<?php echo $elemento->ocupation ?>" >
        <p class="p_form">Telefono:</p>
        <input type="text" name="phone" value="<?php echo $elemento->phone?>" >
        <p class="p_info">La siguiente información es la que se debe de proporcionar: <br> Tansit No. &nbsp &nbsp Inst No. &nbsp &nbsp  Account No. <br>  Asegurate de pedirla al abrir tu cuenta.</p>
        <p class="p_info">Ejemplo: 96660 004 77777788</p>
        <p class="p_form">Info. TD Canada Bank:</p>
        <input type="text" name="bank_info" value="<?php echo $elemento->bank_info?>" >
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="btn_inf">
          <a href="insertar_eventos_crud.php"><input type='button' value='Regresar'></a>
        </div>
        <input class="btn_principal" type="submit"  value="Enviar">
    </form>

  </div>


</body>
</html>
