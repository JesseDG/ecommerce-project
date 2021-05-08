<?php

	class orderHistory extends Controller
	{
			public function index(){
			if(isset($_SESSION['user']))
			{
				$user = $this->model('user');
					

				$query = $user->where(['email'=>$_SESSION['user']]);
				$user = $query[0];
		        $ordersObj = $this->model('orders');
		        $saleObj = $this->model('sale');
		        $itemObj = $this->model('item');

		        $allorders = array();
		        $querySale = $saleObj->where(['user_id'=>$user->user_id]);
		        foreach ($querySale as $saleObj) 
		        {
		        	$queryOrders = $ordersObj->where(['sale_id'=>$saleObj->sale_id]);
		        	foreach ($queryOrders as $currentOrder) {

			            //order id
			            $orderID = $currentOrder->ID;
			                $itemId = $currentOrder->item_id;
			                $queryItem = $itemObj->where(['item_id'=>$itemId]);
			            
			            //item name
			            $itemName = $queryItem[0]->item_name;
			            
			            //quantity
			            $qty = $currentOrder->quantity;
			            
			            //price
			            $price = $currentOrder->bought_price;
			            
			            //order status
			            $ordersStatus = $currentOrder->status;
			            
			            //sale id
			            $saleID = $currentOrder->sale_id;
			            $querySale = $saleObj->where(['sale_id'=>$saleID]);

			            //checkout date
			            $checkout = $querySale[0]->checkout_date;
			            if($checkout == "")
			                $checkout = 'N/A';

			            //total sale
			            $total = $querySale[0]->total;


			            $assoc = array('orderID'=>$orderID,'itemName'=>$itemName,'qty'=>$qty,'price'=>$price,'checkout'=>$checkout,'total'=>$total, 'status'=>$ordersStatus); //".$order['status']."
			            $allorders[] = $assoc;
			        }
		        }
		       

		            

		        
		        $this->view('orderHistory',['allOrders'=>$allorders]);
	    	}
	    	else
	    	{
	    		$this->view('index', []);
	    	}

	    }
	    public function cancelOrder($orderID)
	    {
	    	$orders = $this->model('orders');
			$query = $orders->where(['ID'=> $orderID]);
			if(count($query) > 0)
			{
				$orders = $query[0];
				$orders->status = Controller::cancelled;
				$query = $orders->prepare("update orders SET item_id = :item_id, quantity = :quantity, sale_id = :sale_id, bought_price = :bought_price, status = :status where ID = :ID");
    			$query->execute($orders->toArray());
    			
    			/*
    			$sale_id = $orders->sale_id;
    			$price = $orders->bought_price;

    			$sale = $this->model('sale');
    			$query = $sale->where(['sale_id'=>$sale_id]);
    			$sale = $query[0];
    			$sale->total = $sale->total - $price;
    			$query = $sale->prepare("update sale set total = :total, payment_id = :payment_id, checkout_date = :checkout_date, user_id = :user_id, status = :status where sale_id = :sale_id");
    			$query->execute($sale->toArray());

    			var_dump($sale);
    			*/


			}
	    }
	}
?>
