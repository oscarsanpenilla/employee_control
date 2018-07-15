<?php
    include("funtions.php");
    include("employee.php");

    $conexion_db = new ConexionDB();
    $user= addslashes($_POST['user']);
    $password= addslashes($_POST['password']);

    $sql= "SELECT * FROM users WHERE user= '$user' AND password= '$password'";
    $numero_registro = $conexion_db->ConsultaLogin($sql);

    if($numero_registro)
    {
        $consulta = $conexion_db->ConsultaSQL($sql);
        $employee = new Employee($consulta->user,
                                  $consulta->id,
                                  $consulta->password,
                                  $consulta->name,
                                  $consulta->employee_rate,
                                  $consulta->ocupation,
                                  $consulta->pay_week,
                                  $consulta->active,
                                  $consulta->bank_info,
                                  $consulta->phone,
                                  $consulta->paid_by,
                                  $consulta->admin);
        session_start();
        $_SESSION['employee'] = $employee;
        if ($_SESSION['employee']->admin == 1)
        {
            header("location:admin/main_admin.php");
        }else{header("location:crud_eventos/insertar_eventos_crud.php");}
    }else{header("location:index.php"); }

?>
