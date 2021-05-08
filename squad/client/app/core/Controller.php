<?php
class Controller
{
    const admin = 9935;
    const replied = 1;
    const notReplied = 0;
    const pending = "pending";
    const paid = "paid";
    const cancelled = "cancelled";
    const shipped = "shipped";
    const cancellationCompleted = "Cancellation Completed";
    const cancellationProcess = "Cancellation Process";
    const available = "Available";
    const unavailable = "Unavailable";


	public function model($model)
	{
		require_once '../app/models/' . $model . '.php';
		return new $model();
		
	}
	public function view($view, $data = [])
	{
		require_once '../app/views/header.php';
		require_once '../app/views/' . $view . '.php';
		//require_once '../app/views/footer.php';
	}
}	
?>