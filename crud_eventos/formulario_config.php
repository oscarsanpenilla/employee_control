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
    <link rel="stylesheet" href="../css/events.css">
    <title>Sanvan Update Worker</title>
</head>
<body>
    <form action="config_actualizar.php" method="post" ><br>
        <h3>Configuración</h3>
        <p>Nombre Completo:</p>
        <input type="text" name="name" value="<?php echo $elemento->name?>">
        <p>Usuario:</p>
        <input type="text" name="user" value="<?php echo $elemento->user ?>" >
        <p>Contraseña:</p>
        <input type="text" name="password" value="<?php echo $elemento->password ?>" >
        <p>$/Hora:</p>
        <input type="text" disabled="true" name="employee_rate" value="<?php echo $elemento->employee_rate ?>" >
        <p>Semana de Pago:</p>
        <input type="text" disabled="true"name="pay_week" value="<?php echo $elemento->pay_week ?>" >
        <p>Ocupación:</p>
        <input type="text" disabled="true" name="ocupation" value="<?php echo $elemento->ocupation ?>" >
        <p>Telefono:</p>
        <input type="text" name="phone" value="<?php echo $elemento->phone?>" >
        <p>No. TD Canada Bank:</p>
        <input type="text" name="bank_info" value="<?php echo $elemento->bank_info?>" >
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input class="btn_principal" type="submit"  value="Enviar">

    </form>
</body>
</html>
