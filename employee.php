<?php
			class Employee
			{
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

				function __construct($user,$id,$work_for,$password,$work_for_rate,$name,$employee_rate,$ocupation,$pay_week,$active,$bank_info,$phone,$paid_by,$admin)
				{
					$this->user = $user;
					$this->id = $id;
					$this->work_for = $work_for;
					$this->password = $password;
					$this->work_for_rate = $work_for_rate;
					$this->name = $name;
					$this->employee_rate = $employee_rate;
					$this->ocupation = $ocupation;
					$this->pay_week = $pay_week;
					$this->active = $active;
					$this->bank_info = $bank_info;
					$this->phone = $phone;
					$this->paid_by = $paid_by;
					$this->admin = $admin;
				}
			}
?>
