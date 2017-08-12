<?php

	class login extends Controller
	{
		public function index()
		{
			$this->view('login', []);
		}

		public function clientLogin()
		{
			$user = $this->model('user');
        	if(isset($_POST['submit'])){

	            $user->email = $_POST['email'];
	            $user->password = $_POST['password'];

	            $query = $user->where(['email'=>$user->email]);
	            if(count($query) > 0)
	            {
		            $hash_pass = $query[0]->password;
		            
		            if(password_verify($user->password, $hash_pass) ) {
		                $_SESSION['user'] = $user->email;
		                
		                header('location: ../index');
		                //die();
		                //$this->view('login', []);
		            }
		            else
		            {
		            	echo 'Password is invalid! Try again.';
		            	$this->view('login', []);
		            }
	            }
	            else
	            {
	            	echo 'Email is invalid! Try again.';
	            }
        	}
			
			$this->view('login', []);
		}

		public function logout()
		{
			session_unset();
			header('location: ../index');
		}
		
	}
?>