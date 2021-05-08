<?php

	class register extends Controller
	{
		
		function validateCNUM($ccard, $ccNumber)
	{
		$regex = "";
		switch($ccard)
		{
			case "amex":
			$regex = "(3[47]\d{13})";
			break;
			case "master":
			$regex = "(5[1-5]\d{14})";
			break;
			case "visa":
			$regex = "(4\d{12}(?:\d{3})?)";
			break;

		}


		return preg_match($regex, $ccNumber, $matches);
	}

	public function valid()
	{
		return $valid;
	}

	public function index()
	{

		$str = "";
		$email 		= '';
		$password 	= '';
		$password2 	= '';
		$fname 		= '';
		$lname 		= '';
		$address 	= '';
		$p_number 	= '';
		$city 		= '';
		$pr_st 		= '';
		$ccard 		= '';
		$ccNumber 	= '';
		$ccv 		= '';
		$nameholder = '';
		$ccardmonth = '';
		$ccardyear 	= '';
		$valid = true;
		$pr_st='';
		if(isset($_POST["submit"]))
		{
			$email = $_POST["email"];
			$password = $_POST["password"];
			$password2 = $_POST["password2"];
			$fname = $_POST["fname"];
			$lname = $_POST["lname"];
			$address = $_POST["address"];
			$p_number = $_POST["p_number"];
			$city = $_POST["city"];
			$pr_st = $_POST["pr_st"];
			$ccard = $_POST["ccard"];
			$ccNumber = $_POST["ccNumber"];
			$ccv = $_POST["ccv"];
			$nameholder = $_POST["nameholder"];
			$ccardmonth = $_POST["ccardmonth"];
			$ccardyear = $_POST["ccardyear"];


			if(strlen($password) < 8)
			{
				$str .= "The password must contain 8 characters. <br>";
				$valid = false;
			}
			if($password != $password2)
			{
				$str .= "The passwords must match! <br>";
				$valid = false;
			}
			if(strlen($address) < 3)
			{
				$str .= "The address must be valid (at least 3 characters) <br>";
				$valid = false;
			}
			if(is_string($city) && strlen($city) < 2)
			{
				$str .= "The city must be valid string containing atleast 2 characters <br>";
				$valid = false;
			}
			if(is_numeric($ccv) && strlen($ccv) != 3)
			{
				$str .= "The verification number must have 3 numbers <br>";
				$valid = false;
			}
			if(!($this->validateCNUM($ccard, $ccNumber)))
			{
				$str .= "The given credit card number is invalid! <br>";
				$valid = false;
			}
			if(!(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $p_number)))
			{
				$str .= "The phone number is invalid! Format ###-###-#### <br>";
				$valid = false;
			}
			$str .= "the post of card type is $ccard<br>";
			if($valid)
			{
				$data = array('returnStr' => $str, 'valid' => $valid, 'pr_st' => $pr_st, 'email' => $email, 'password' => $password, 'password2' => $password2, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'p_number' => $p_number, 'city' => $city, 'ccard' => $ccard, 'ccv' => $ccv, 'nameholder' => $nameholder, 'ccardmonth' => $ccardmonth, 'ccardyear' => $ccardyear, 'ccNumber' => $ccNumber);
				register::addClientInfo($data);
				//unset($_POST);
				$str = "<h1 style='background-color:green'>You have been registered!</h1>";
			}
			
			$this->view('register', ['returnStr' => $str, 'valid' => $valid, 'pr_st' => $pr_st, 'email' => $email, 'password' => $password, 'password2' => $password2, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'p_number' => $p_number, 'city' => $city, 'ccard' => $ccard, 'ccv' => $ccv, 'nameholder' => $nameholder, 'ccardmonth' => $ccardmonth, 'ccardyear' => $ccardyear, 'ccNumber' => $ccNumber]);
			//http://stackoverflow.com/questions/174730/what-is-the-best-way-to-validate-a-credit-card-in-php
			//https://www.paypalobjects.com/en_US/vhelp/paypalmanager_help/credit_card_numbers.htm

	    }else{

			$this->view('register', ['returnStr' => $str, 'valid' => $valid, 'pr_st' => $pr_st, 'email' => $email, 'password' => $password, 'password2' => $password2, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'p_number' => $p_number, 'city' => $city, 'ccard' => $ccard, 'ccv' => $ccv, 'nameholder' => $nameholder, 'ccardmonth' => $ccardmonth, 'ccardyear' => $ccardyear, 'ccNumber' => $ccNumber]);

	    }
		
	}
	public function test()
	{
		echo 'test';
	}
	public function addClientInfo($data)
	{
		$user = $this->model('user');
		$user->email = $data['email'];

		$password = $data['password'];

		$hashedPW = password_hash($password, PASSWORD_BCRYPT);
		$user->password = $hashedPW;

		$user->insert();

		$lastUserIndex = $user->lastIndex();

		$user_info = $this->model('user_info');
		$user_info->first_name = $data['fname'];
		$user_info->last_name = $data['lname'];
		$user_info->address = $data['address'];
		$user_info->phone_nmb = $data['p_number'];
		$user_info->city = $data['city'];
		$user_info->province_state = $data['pr_st'];
		$user_info->user_id = $lastUserIndex;
		$user_info->insert();

		$payment_method = $this->model('payment_method');
		$payment_method->card_nmb = $data['ccNumber'];
		$payment_method->ccv = $data['ccv'];
		$payment_method->exp_date = $data['ccardmonth'] . "/" . $data['ccardyear'];
		$payment_method->name_holder = $data['nameholder'];
		$payment_method->card_type = $data['ccard'];
		$payment_method->user_id = $lastUserIndex;
		$payment_method->insert();

		header("Location: ../registered");
		die();

		
    

	}
	}
?>