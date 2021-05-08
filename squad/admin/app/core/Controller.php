<?php

Class Controller{

    const admin = 9935;
    const replied = 1;
    const notReplied = 0;
    const pending = "pending";
    const paid = "paid";
    const cancelled = "cancelled";
    const shipped = "shipped";
    const cancellationCompleted = "Cancellation Completed";
    const cancellationProcess = "Cancellation Process";

	public function model($model){

		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	public function view($view = 'login', $data=[]){

        if(isset($_SESSION['admin'])){
            require_once '../app/views/header.php';
            require_once '../app/views/' . $view . '.php';
            require_once '../app/views/footer.php';
        }
        else{
            require_once '../app/views/' . $view . '.php';
        }

	}
    
    public function viewService($view, $data=[]){

        require_once '../app/services/' . $view . '.php';

	}

    public function getBrand($id){

        $brandModel = self::model('brand');
        $query = $brandModel->where(['brand_id'=>$id]);
        $brandName = $query[0]->brand_name;
        return $brandName;

    }

    public function getCategory($id){

        $catModel = self::model('category');
        $query = $catModel->where(['category_id'=>$id]);
        $catName = $query[0]->category_name;
        return $catName;
    }
    
}
?>