<?php

	class account extends Controller
	{
		public function index()
		{
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
			$ccardexp = '';

			$pr_st='';
			if(isset($_SESSION['user']))
			{
				$user = $this->model('user');
				

				$query = $user->where(['email'=>$_SESSION['user']]);
				$email = $query[0]->email;
				$user_id = $query[0]->user_id;

				$user_info = $this->model('user_info');
				$query = $user_info->where(['user_id'=>$user_id]);
				$fname = $query[0]->first_name;
				$lname = $query[0]->last_name;
				$address = $query[0]->address;
				$p_number = $query[0]->phone_nmb;
				$city = $query[0]->city;
				$pr_st = $query[0]->province_state;

				$payment_method = $this->model('payment_method');
				$query = $payment_method->where(['user_id'=>$user_id]);
				$ccardexp = $query[0]->exp_date;
				$nameholder = $query[0]->name_holder;
				$ccard = $query[0]->card_type;

				
			}
			

			$this->view('account', ['pr_st' => $pr_st, 'email' => $email, 'password' => $password, 'password2' => $password2, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'p_number' => $p_number, 'city' => $city, 'ccard' => $ccard, 'ccv' => $ccv, 'nameholder' => $nameholder, 'ccardexp' => $ccardexp, 'ccNumber' => $ccNumber]);
		}
		public function changePassword()
		{
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			
			if($password == $password2)
			{
				
				$user = $this->model('user');
				$query = $user->where(['email'=>$_SESSION['user']]);
				$user = $query[0];
//				$user_id = $query[0]->user_id;
				$hashedPW = password_hash($password, PASSWORD_BCRYPT);
				$user->password = $hashedPW;
				$user->email = $_SESSION['user'];
				//var_dump($user);
				$query = $user->prepare("update user set password = :password, email = :email where user_id = :user_id");
				//var_dump($query);
				$data = $user->toArray();

				$query->execute($data);
			}
			header('location: ../account');
			//$this->view('../account/registration', []);
			//doesnt work
			
		}
		public function changeInfo()
		{
			if((strlen($_POST['address']) >= 3) && is_string($_POST['city']) && strlen($_POST['city']) >= 2 && (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['p_number']) && strlen($_POST['pr_st']) >= 3))
			{
				
				$user_info = $this->model('user_info');
				$user_info->first_name = $_POST['fname'];
				$user_info->last_name = $_POST['lname'];
				$user_info->address = $_POST['address'];
				$user_info->phone_nmb = $_POST['p_number'];
				$user_info->city = $_POST['city'];
				$user_info->province_state = $_POST['pr_st'];
				$user = $this->model('user');
				$query = $user->where(['email'=>$_SESSION['user']]);
				$user_id = $query[0]->user_id;
				$user_info->user_id = $user_id;
				
				$query = $user_info->prepare("update user_info SET first_name = :first_name, last_name = :last_name, address = :address, phone_nmb = :phone_nmb, city = :city, province_state = :province_state where user_id = :user_id");
				$query->execute($user_info->toArray());			
				} //doesnt work
				header('location: ../account');
		}
		public function changeBilling()
		{
			if(is_numeric($_POST['ccv']) && strlen($_POST['ccv']) == 3 && ($this->validateCNUM($_POST['ccard'], $_POST['ccNumber'])) && is_string($_POST['nameholder']))
			{
				//378282246310005
				$user = $this->model('user');
				$query = $user->where(['email'=>$_SESSION['user']]);
				$user_id = $query[0]->user_id;
				$payment_method = $this->model('payment_method');
				$payment_method->user_id = $user_id;
    			$payment_method->card_nmb = $_POST['ccNumber'];
    			$payment_method->ccv = $_POST['ccv'];
    			$payment_method->exp_date = $_POST['ccardmonth'] . '/' . $_POST['ccardyear'];
    			$payment_method->name_holder = $_POST['nameholder'];
    			$payment_method->card_type = $_POST['ccard'];

    			$query = $payment_method->prepare("update payment_method SET card_nmb = :card_nmb, ccv = :ccv, exp_date = :exp_date, name_holder = :name_holder, card_type = :card_type where user_id = :user_id");
    			$query->execute($payment_method->toArray());


			}
			header('location: ../account');
			
		}
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
	}
	
?>