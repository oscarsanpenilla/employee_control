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
    <form action="crud_actualizar.php" method="post" >
        <h3>Modify</h3><br>
        <p>Work for:</p>
        <select class="semana" name="work_for"  required="required" >
            <option selected='selected'> <?php echo $elemento->work_for?> </option>
            <option value='Sanvan'>Sanvan</option>
            <option value='Tolin'>Tolin</option>
            <option value='Global Contact'>Global Contact</option>
        </select>
        <p>Name:</p>
        <input type="text" name="nombre" value="<?php echo $elemento->name?>">
        <p>User:</p>
        <input type="text" name="usuario" value="<?php echo $elemento->user ?>" >
        <p>Password:</p>
        <input type="text" name="contra" value="<?php echo $elemento->password ?>" >
        <p>Employee Rate:</p>
        <input type="text" name="rate_hour" value="<?php echo $elemento->employee_rate ?>" >
        <p>Work for Rate:</p>
        <input type="text" name="work_for_rate" value="<?php echo $elemento->work_for_rate ?>" >
        <p>Pay Week:</p>
        <select class="semana" name="pay_week" required="required" >
            <option selected='selected'> <?php echo $elemento->pay_week ?> </option>
            <option value='A'>A</option>
            <option value='B'>B</option>
        </select>
        <p>Active:</p>
        <input type="text" name="status" value="<?php echo $elemento->active?>" >
        <p>Ocupation:</p>
        <select class="semana" name="task"  required="required" >
            <option selected='selected'> <?php echo $elemento->ocupation?> </option>
            <option value='Labour'>Labour</option>
            <option value='Cement Finisher'>Cement Finisher</option>
            <option value='Skill Labour'>Skill Labour</option>
            <option value='Carpenter'>Carpenter</option>
            <option value='Carpenter Helper'>Carpenter Helper</option>
            <option value='Otro'>Otro</option>
        </select>
        <p>Phone:</p>
        <input type="text" name="phone" value="<?php echo $elemento->phone?>" >
        <p>Paid by:</p>
        <select class="semana" name="paid_by" >
          <option selected='selected'> <?php echo $elemento->paid_by?> </option>
            <option value='Rafael'>1 Rafael</option>
            <option value='Carlos'>2 Carlos</option>
            <option value='Cristian'>3 Cristian</option>
        </select>
        <p>Bank info:</p>
        <input type="text" name="bank_info" value="<?php echo $elemento->bank_info?>" >
        <input type="hidden" name="id" value="<?php echo $id ?>"><br>
        <input type="submit"  value="enviar">
        <a href="crud_empleados.php"><input  type="button" value="Return"></a>
    </form>
</body>
</html>
