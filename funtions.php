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

	public function ConsultaArray($sql)
	{

		$sentencia = $this->conexion_db->prepare($sql);
	  $sentencia->execute();
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;

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

/**
 *
 */
class Events
{

	public static function PeriodoPago()
	{
		$conexion_db = new ConexionDB();
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT *
						FROM week_a
						WHERE week_start<='$today' AND week_end>='$today'";
		$fechas = $conexion_db->ConsultaArray($sql);
		$fecha_id = $fechas[0]->id;
		$id_quincena_pago = $fecha_id - 1;

		$sql = "SELECT * FROM week_a WHERE id='$id_quincena_pago'";
		return $conexion_db->ConsultaArray($sql);
	}

	public static function getActualPeriodDates($week){
		$conexion_db = new ConexionDB();
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT *
						FROM $week
						WHERE week_start<='$today' AND week_end>='$today'";
		$fechas = $conexion_db->ConsultaArray($sql);
		return $fechas;
	}

	public static function SemanaActual($employee)
	{
		$conexion_db = new ConexionDB();
		$user_id = $employee->id;
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT *
						FROM week_a
						WHERE week_start<='$today' AND week_end>='$today'";
		$fechas = $conexion_db->ConsultaArray($sql);
		$start_date = $fechas[0]->week_start;
		$end_date = $fechas[0]->week_end;
		$fecha_media = date('Y-m-d', strtotime("$end_date -6 day"));
		if ($today <= $fecha_media && $today >= $start_date) {
			$sql = "SELECT *
							FROM events WHERE id='$user_id' AND date BETWEEN '$start_date' AND '$fecha_media'
							ORDER BY date";
			return $conexion_db->ConsultaArray($sql);
		}else {
			$sql = "SELECT *
							FROM events
							WHERE id='$user_id' AND date > '$fecha_media' AND  date <= '$end_date'
							ORDER BY date";
			return $conexion_db->ConsultaArray($sql);
		}

	}

	public static function QuincenaPago($employee,$quincena)
	{
		$conexion_db = new ConexionDB();
		$user_id = $employee->id;
		date_default_timezone_set("America/Vancouver");
		$today = date('Y-m-d');
		$sql = "SELECT *
						FROM week_a
						WHERE week_start<='$today' AND week_end>='$today'";
		$fechas = $conexion_db->ConsultaArray($sql);
		$fecha_id = $fechas[0]->id;
		$id_quincena_pago = $fecha_id + $quincena;

		$sql = "SELECT *
						FROM week_a
						WHERE id='$id_quincena_pago'";
		$fechas = $conexion_db->ConsultaArray($sql);
		$start_date = $fechas[0]->week_start;
    $end_date = $fechas[0]->week_end;
		$sql = "SELECT *
						FROM events
						WHERE id='$user_id' AND date BETWEEN '$start_date' AND '$end_date'
						ORDER BY date";
		return $conexion_db->ConsultaArray($sql);

	}




}




class ResumeTimesheet
{
	private $conexion_db;
	private $sql;
	private $fecha_inicio;
	private $fecha_fin;
	private $paid_by;
	private $site;
	private $ocupation;
	private $POST;


	function __construct($POST){
		$this->conexion_db = new ConexionDB();
		$this->POST = $POST;
		$this->fecha_inicio = $POST['fecha_inicio'];
		$this->fecha_fin = $POST['fecha_fin'];
		$this->paid_by = $POST['paid_by_checkbox'];
		$this->site = $POST['site_checkbox'];
		$this->ocupation = $POST['ocupation_checkbox'];
	}



	private function filter($criteria_array,$criteria){
		$checkbox = $criteria_array;
		$validate = True;
		$length = count($checkbox);
		$sql = "";
		foreach ($checkbox as $p) {
			if ($p == "any") $validate = False;
		}
		if ($validate) {
			$sql .= " AND ( ";
			for ($i=0; $i < $length - 1; $i++){
				$sql .= " $criteria='$checkbox[$i]' OR ";
			}
		  $sql .= "$criteria='$checkbox[$i]'";
			$sql .= "  )";
		}
		return $sql;
	}

	private function getArrayFilter($criteria_array,$criteria){
		$checkbox = $criteria_array;
		$validate = True;
		$length = count($checkbox);
		$arreglo = [];
		foreach ($checkbox as $key=>$p) {
			if ($p == "any"){
				$arreglo[] = "Cualquiera";
			}else {
				$arreglo[$key] = $p;
			}
		}
		return $arreglo;
	}


	public function resume()
	{
		$sql = "SELECT site,ocupation,SUM(hours_day) AS hours, SUM(hours_day*work_for_rate) AS total_ocupation
		 				FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin'";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");

		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY site,ocupation ORDER BY site,ocupation";

		$resume = $this->conexion_db->ConsultaArray($sql);
		return $resume;
	}



	public function getOcupations(){
		$sql = "SELECT DISTINCT ocupation
		 				FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin'";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");

		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;

		$ocupations = $this->conexion_db->ConsultaArray($sql);
		return $ocupations;
	}

	public function getEvents(){
		$sql = "SELECT site,ocupation,name, SUM(hours_day) AS hours, work_for_rate, SUM(hours_day)*work_for_rate AS total
						FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin'";

		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY site,ocupation,name ORDER BY site,ocupation,name";

		$results = $this->conexion_db->ConsultaArray($sql);
		return $results;
	}

	public function bankResume(){
		$sql = "SELECT users.name,users.bank_info,SUM(hours_day)*events.work_for_rate AS total
						FROM events
						JOIN users ON events.id = users.id
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' AND users.bank_info!='' ";

		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"events.paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"events.ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY users.bank_info";


		$results = $this->conexion_db->ConsultaArray($sql);
		return $results;
	}

	public function cashResume(){
		$sql = "SELECT users.name,users.bank_info,SUM(hours_day)*events.work_for_rate AS total
						FROM events
						JOIN users ON events.id = users.id
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' AND users.bank_info=''";

		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"users.paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"events.ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY name ORDER BY users.name";

		$results = $this->conexion_db->ConsultaArray($sql);
		return $results;
	}

	//Seccion de Timesheets
	public function datesTimesheet(){
		$sql = "SELECT DISTINCT date
						FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " ORDER BY date";
		$dates = $this->conexion_db->ConsultaArray($sql);
		return $dates;

	}

	public function datesCompleteTimesheet(){
		$dates = [];
		$start = date('Y-m-d',strtotime($this->fecha_inicio));
		$end = date('Y-m-d',strtotime($this->fecha_fin));
		$i =0;
		while ( $start <= $end) {
		  $dates[] = $start;
		  $start = date('Y-m-d',strtotime ( '+1 day' , strtotime ( $start ) )) ;
		  $i++;
		}
		return $dates;
	}

	public function siteOcupationName(){
		$sql = "SELECT id,site,ocupation,name
						FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY site,id ORDER BY site,ocupation,name";
		$consulta = $this->conexion_db->ConsultaArray($sql);
		return $consulta;
	}

	public function siteOcupationNameResume(){
		$sql = "SELECT id,work_for,ocupation,name
						FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY id ORDER BY work_for,ocupation,name";
		$consulta = $this->conexion_db->ConsultaArray($sql);
		return $consulta;
	}

	public function sitesTimesheet(){
		$sql = "SELECT DISTINCT site
					  FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " ORDER BY site ASC";
		$sites = $this->conexion_db->ConsultaArray($sql);
		return $sites;
	}

	public function nameTimesheet(){
		$sql = "SELECT DISTINCT id,name
					  FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " ORDER BY name";
		$names = $this->conexion_db->ConsultaArray($sql);
		return $names;
	}

	public function ocupationTimesheet(){
		$sql = "SELECT DISTINCT ocupation
					  FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " ORDER BY ocupation ASC ";
		$ocupation = $this->conexion_db->ConsultaArray($sql);
		return $ocupation;
	}



	public function hoursDayTimesheet(){
		$sql = "SELECT site,name,date,hours_day,id
						FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$hours_day = $this->conexion_db->ConsultaArray($sql);
		return $hours_day;
	}

	public function totalHoursTimesheet(){
		$sql = "SELECT site,name,id, SUM(hours_day) AS total
					  FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY site,id ORDER BY site,ocupation,name";
		$total_hours = $this->conexion_db->ConsultaArray($sql);
		return $total_hours;
	}

	public function totalHoursTimesheetResume(){
		$sql = "SELECT ocupation,work_for,name,id, SUM(hours_day) AS total
					  FROM events
						WHERE date BETWEEN '$this->fecha_inicio' AND '$this->fecha_fin' ";
		$sql_site = ResumeTimesheet::filter($this->site,"site");
		$sql_paid_by = ResumeTimesheet::filter($this->paid_by,"paid_by");
		$sql_ocupation = ResumeTimesheet::filter($this->ocupation,"ocupation");
		$sql .= $sql_site.$sql_paid_by.$sql_ocupation;
		$sql .= " GROUP BY id ORDER BY work_for,ocupation,name";
		$total_hours = $this->conexion_db->ConsultaArray($sql);
		return $total_hours;
	}


}










?>
