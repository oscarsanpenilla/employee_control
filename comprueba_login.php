<?php
    include("funtions.php");
    include("employee.php");
    echo "en mantenimiento";
    $conexion = new ConexionDB();
    $user= addslashes($_POST['user']);
    $password= addslashes($_POST['password']);

    $sql= "SELECT * FROM users WHERE user= '$user' AND password= '$password'";;
    $numero_registro = $conexion->ConsultaArray($sql);

    if($numero_registro){
        $consulta = $conexion->ConsultaSQL($sql);
        $employee = new Employee($consulta);

        setcookie("cookie","$consulta->user",time() + 86400);
        session_start();
        $_SESSION['cookie'] = $consulta->user;
        $_SESSION['employee'] = $employee;
        if ($_SESSION['employee']->admin == 1)
        {
            header("location:admin/main_admin.php");
        }else{header("location:crud_eventos/insertar_eventos_crud.php");}
    }else{header("location:http://sanvancontracting.com/"); }

?>
