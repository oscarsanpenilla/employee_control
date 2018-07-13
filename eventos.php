<?php

class Event
{
	var $date;
  var $site;
  var $task;
  var $user_name;
  var $hours_day;
	var $rate_hour;
	var $total_day;
	var $comentary;
	var $payment_week;
	var $type_of_payment;
	var $user_id;

	function __construct($employee,$hours_day,$comentario,$fecha,$lugar)
	{

		$this->hours_day = $hours_day;
		$this->comentary = $comentario;
		$this->date = $fecha;
		$this->site = $lugar;
		$this->user_name = $employee->name;

	}

	static function CreateHour($entrada_horas,$entrada_minutos)
	{
		return $entrada_horas.":".$entrada_minutos.":00";
	}


	static function HoursDay($entrada_horas,$entrada_minutos,$salida_horas,$salida_minutos)
	{
		return round(($salida_horas*3600 - $entrada_horas*3600 + $salida_minutos*60 - $entrada_minutos*60)/3600,2);
	}
}





?>
