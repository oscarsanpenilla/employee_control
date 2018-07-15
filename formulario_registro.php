<?php
    include("funtions.php");
    include("employee.php");


    $conexion_db = new ConexionDB();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/events.css">
    <title>Registro</title>
</head>
<body>
    <form action="registro_empleado.php" method="post" ><br>
        <h3>Registro</h3>
        <p>Nombre Completo:*</p>
        <input type="text" name="name" required="required">
        <p>Usuario:*</p>
        <input type="text" name="user"  required="required">
        <p>Contraseña:*</p>
        <input type="text" name="password" required="required">
        <p>$/hora:*</p>
        <input type="text" name="employee_rate"  required="required">
        <p>Pay Week:*</p>
        <select class="semana" name="pay_week" required="required" >
            <option value='A'>A</option>
            <option value='B'>B</option>
            <option value='C'>C</option>
        </select>
        <p>Ocupation:*</p>
        <select class="semana" name="ocupation"  required="required" >
            <option value='Labour'>Labour</option>
            <option value='Cement Finisher'>Cement Finisher</option>
            <option value='Skill Labour'>Skill Labour</option>
            <option value='Carpenter'>Carpenter</option>
            <option value='Carpenter Helper'>Carpenter Helper</option>
            <option value='Otro'>Otro</option>

        </select>
        <p>Phone:*</p>
        <input type="text" name="phone" required="required">
        <p>Tipo:*</p>
        <select class="semana" name="paid_by" >
            <option value='Rafael'>1</option>
            <option value='Carlos'>2</option>
            <option value='Cristian'>3</option>
        </select>
        <p>Bank info:</p>
        <input type="text" name="bank_info" >

        <input type="submit"  value="Enviar" >
        <a href="index.php"><input  type="button" value="Regresar"></a>
    </form>
</body>
</html>
