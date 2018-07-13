<?php
			class Employee
			{
				var $user;
				var $id;
				var $paid_by;
				var $password;
				var $name;
				var $employee_rate;
				var $ocupation;
				var $type_of_payment;
				var $payment_week;
				var $active;
				var $pay_week;
				var $bank_info;
				var $phone;

				function __construct($user,$id,$password,$name,$employee_rate,$ocupationt,$pay_week,$active)
				{
					$this->user = $user;
					$this->id = $id;
					$this->password = $password;
					$this->name = $name;
					$this->employee_rate = $employee_rate;
					$this->ocupation = $ocupation;
					$this->type_of_payment;
					$this->pay_week;
					$this->active = $active;
				}
			}
?>
