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




	//Devuelve el total de la quincena seleccionada,
	// 0 quincena actual
	// -1 quincena pasada
	// -2 quincena antepasada
	public static function Quincena($quincena,$conexion_db,$user_id)
	{
		$today = date("Y-m-d");
		if ($quincena == 1) {
			$sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 1";
	    $fechas = $conexion_db->ConsultaArray($sql);
	    $end_date = $fechas[0]->week_end;
	    $end_date = date('Y-m-d', strtotime($end_date));
	    $sql = "SELECT * FROM events WHERE id=$user_id AND date >'$end_date' ORDER BY date";
	    return $conexion_db->ConsultaArray($sql);
		}else {
			$sql = "SELECT * FROM week_a WHERE week_end<='$today' ORDER BY id DESC LIMIT 3";
	    $fechas = $conexion_db->ConsultaArray($sql);
			$start_date = $fechas[abs($quincena)]->week_start;
	    $end_date = $fechas[abs($quincena)]->week_end;
	    $sql = "SELECT * FROM events WHERE id='$user_id' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
	    return $conexion_db->ConsultaArray($sql);
		}



	}





}












?>
