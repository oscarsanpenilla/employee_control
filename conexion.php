<?php



require "config.php";


function Conexion()
{
	try
	{

	$conexion_db = new PDO("mysql:host=". DB_HOST ."; dbname=".DB_NOMBRE ,DB_USUARIO,DB_CONTRA);

    $conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion_db->exec("SET CHARACTER SET utf8");

    return $conexion_db;

    }
    catch(EXCEPTION $e)
    {

    echo "Error en la linea: " . $e->getLine() . "<br>";

    echo "Error: " . $e->getMessage();

    }
}


        

        

   



?>