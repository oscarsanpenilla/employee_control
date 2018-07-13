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
    <link rel="stylesheet" href="../css/estilos_main.css">
    <title>Sanvan Update Worker</title>
</head>
<body>
    <form action="crud_actualizar.php" method="post" >
        <h2>Modify</h2><br>
        <h3>Name:</h3>
        <input type="text" name="nombre" value="<?php echo $elemento->name?>"><br>
        <h3>User:</h3>
        <input type="text" name="usuario" value="<?php echo $elemento->user ?>" ><br>
        <h3>Password:</h3>
        <input type="text" name="contra" value="<?php echo $elemento->password ?>" ><br>
        <h3>Employee Rate:</h3>
        <input type="text" name="rate_hour" value="<?php echo $elemento->employee_rate ?>" ><br>
        <h3>Pay Week:</h3><
        <input type="text" name="payment_week" value="<?php echo $elemento->pay_week ?>" ><br>
        <h3>Active:</h3>
        <input type="text" name="status" value="<?php echo $elemento->active?>" ><br>
        <h3>Ocupation:</h3>
        <input type="text" name="task" value="<?php echo $elemento->ocupation?>" ><br>
        <h3>Phone:</h3>
        <input type="text" name="phone" value="<?php echo $elemento->phone?>" ><br>
        <h3>Paid by:</h3>
        <input type="text" name="paid_by" value="<?php echo $elemento->paid_by?>" ><br>
        <h3>Bank info:</h3>
        <input type="text" name="bank_info" value="<?php echo $elemento->bank_info?>" ><br>
        <input type="hidden" name="id" value="<?php echo $id ?>"><br>
        <input type="submit"  value="enviar">
        <a href="crud_empleados.php"><input  type="button" value="Return"></a>
    </form>
</body>
</html>
