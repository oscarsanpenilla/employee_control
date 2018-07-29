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

	function Consulta($sql)
	{

		$sentencia = $this->conexion_db->prepare($sql);
	    $sentencia->execute();

	    return $sentencia->fetchAll();

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
	// 0 semana actual
	// -1 quincena actual
	// -2 quincena pasada
	// -3 quincena antepasada
	public static function Quincena($quincena,$conexion_db,$user_id)
	{
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT * FROM week_a WHERE week_start<='$today' ORDER BY id DESC LIMIT 4";
		$fechas = $conexion_db->ConsultaArray($sql);
		$start_date = $fechas[$quincena]->week_start;
    $end_date = $fechas[$quincena]->week_end;
		$sql = "SELECT * FROM events WHERE id='$user_id' AND date BETWEEN '$start_date' AND '$end_date' ORDER BY date";
		return $conexion_db->ConsultaArray($sql);

	}

	public static function Periodo_Tipo_A()
	{
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT * FROM week_a WHERE week_start<='$today' ORDER BY id DESC LIMIT 4";
		$fechas = $conexion_db->ConsultaArray($sql);
		$start_date = $fechas[0]->week_start;
		$end_date = $fechas[0]->week_end;
	}

	public static function SemanaActual($quincena,$conexion_db,$user_id)
	{
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT * FROM week_a WHERE week_start<='$today' ORDER BY id DESC LIMIT 4";
		$fechas = $conexion_db->ConsultaArray($sql);
		$start_date = $fechas[0]->week_start;
		$end_date = $fechas[0]->week_end;
		$fecha_media = date('Y-m-d', strtotime("$end_date -6 day"));
		if ($today <= $fecha_media && $today >= $start_date) {
			$sql = "SELECT * FROM events WHERE id='$user_id' AND date BETWEEN '$start_date' AND '$fecha_media' ORDER BY date";
			return $conexion_db->ConsultaArray($sql);
		}else {
			$sql = "SELECT * FROM events WHERE id='$user_id' AND date > '$fecha_media' AND  date <= '$end_date' ORDER BY date";
			return $conexion_db->ConsultaArray($sql);
		}

	}
}

/**
 *
 */
class ResumeFunctions
{

	public static function get_sites($start_date,$end_date,$conexion_db)
	{
		$sql = "SELECT DISTINCT sites FROM events WHERE date BETWEEN '$start_date' AND '$end_date' ";
		return $conexion_db->prepare($sql);
	}

	public static function get_ocupation($array_eventos)
	{
		$array = array();
		foreach ($array_eventos as $evento) {
			$array[] = $evento->ocupation;
		}
		$array = array_unique($array);
		return $array;
	}

	public static function get_names($array_eventos)
	{
		$array = array();
		foreach ($array_eventos as $evento) {
			$array[] = $evento->name;
		}
		$array = array_unique($array);
		return $array;
	}

}











?>
