<?php
	class Employee{
		var $id;
		var $work_for;
		var $paid_by;
		var $user;
		var $password;
		var $work_for_rate;
		var $name;
		var $employee_rate;
		var $ocupation;
		var $pay_week;
		var $active;
		var $bank_info;
		var $phone;
		var $admin;



		function __construct($consulta)		{
			$this->user = $consulta->user;
			$this->id = $consulta->id;
			$this->work_for = $consulta->work_for;
			$this->password = $consulta->password;
			$this->work_for_rate = $consulta->work_for_rate;
			$this->name = $consulta->name;
			$this->employee_rate = $consulta->employee_rate;
			$this->ocupation = $consulta->ocupation;
			$this->pay_week = $consulta->pay_week;
			$this->active = $consulta->active;
			$this->bank_info = $consulta->bank_info;
			$this->phone = $consulta->phone;
			$this->paid_by = $consulta->paid_by;
			$this->admin = $consulta->admin;

		}


	}
?>
