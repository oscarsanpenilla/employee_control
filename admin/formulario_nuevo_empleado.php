<?php
    include("../funtions.php");
    include("../validar_inicio_sesion.php");
    $conexion_db = new ConexionDB();

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
  <div class="contenedor">
    <form action="../crud_employees/crud_insertar.php" method="post" >
        <h3>Register of New Employee</h3>
        <p class="p_form">Work for:</p>
        <select class="semana" name="work_for"  required="required" >
            <option value='Sanvan' selected>Sanvan</option>
            <option value='Tolin'>Tolin</option>
            <option value='Global Contact'>Global Contact</option>
        </select>
        <p class="p_form" >Name:</p>
        <input type="text" name="name" required>
        <p class="p_form">User:</p>
        <input type="text" name="user" required >
        <p class="p_form">Password:</p>
        <input type="text" name="password" required>
        <p class="p_form">Employee Rate:</p>
        <input type="number" name="employee_rate" required >
        <p class="p_form">Work for Rate:</p>
        <input type="number" name="work_for_rate" required >
        <p class="p_form">Pay Week:</p>
        <select class="semana" name="pay_week" required="required" >
            <option value='A' selected>A</option>
            <option value='B'>B</option>
        </select>
        <p class="p_form">Ocupation:</p>
        <select class="semana" name="ocupation"  required="required" required >
            <option value='Labour' selected>Labour</option>
            <option value='Cement Finisher'>Cement Finisher</option>
            <option value='Skill Labour'>Skill Labour</option>
            <option value='Carpenter'>Carpenter</option>
            <option value='Carpenter Helper'>Carpenter Helper</option>
            <option value='Otro'>Otro</option>
        </select>
        <p class="p_form">Phone:</p>
        <input type="text" name="phone" required >
        <p class="p_form">Paid by:</p>
        <select class="semana" name="paid_by" required>
            <option value='Rafael'>Rafael</option>
            <option value='Carlos'>Carlos</option>
            <option value='Cristian'>Cristian</option>
        </select>
        <p class="p_form">Bank info:</p>
        <input type="text" name="bank_info"><br>
        <input type="submit"  value="Ok">
        <a href="main_admin.php"><input  type="button" value="Return"></a>
    </form>
  </div>

</body>
</html>
