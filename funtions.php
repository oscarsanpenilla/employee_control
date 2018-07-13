<?php
require "config.php";
/**
* 
*/
class ConexionDB
{
	var $conexion_db;
	
	function __construct()
	{
		try
		{
			$this->conexion_db = new PDO("mysql:host=". DB_HOST ."; dbname=".DB_NOMBRE ,DB_USUARIO,DB_CONTRA);
			$this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	$this->conexion_db->exec("SET CHARACTER SET utf8");
	
		}
		catch(EXCEPTION $e)
	    {

	    echo "Error en la linea: " . $e->getLine() . "<br>";

	    echo "Error: " . $e->getMessage();

	    }
	}





	function ConsultaSQL($sql)
	{
		
		$sentencia = $this->conexion_db->prepare($sql);
	    $sentencia->execute();   

	    return $sentencia->fetch(PDO::FETCH_OBJ);
	    
	}

	function ConsultaArray($sql)
	{
		
		$sentencia = $this->conexion_db->prepare($sql);
	    $sentencia->execute();   

	    return $sentencia->fetchAll(PDO::FETCH_OBJ);
	    
	}

	function ConsultaAssoc($sql)
	{
		
		$sentencia = $this->conexion_db->prepare($sql);
	    $sentencia->execute();   

	    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
	    
	}

	function ConsultaLogin($sql)
	{
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute();
		if ($sentencia->rowCount()==1) {
			return 1;
		}
		else
		{
			return 0;
		}
		
	}

	function Prepare($sql)
	{
		$this->conexion_db->prepare($sql)->execute();
	}

	static function RegistroNuevoUsuario()
	{

	}
	




}












?>