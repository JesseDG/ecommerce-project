<?php

	class cart extends Controller
	{
		

		public function index()
		{
			$user = $this->model('user');
			$query = $user->where(['email'=>$_SESSION['user']]);
			$user = $query[0];
			$user_id = $user->user_id;
			$sale = $this->model('sale');
			$query = $sale->where(['user_id'=>$user_id, 'status'=>Controller::pending]);
			
			$str = '';
			$checkoutTotal = 0;
			$sale_id = 0;
			if(count($query) > 0)
			{
				$sale_id = $query[0]->sale_id;
				$total = $query[0]->total;
				$orders = $this->model('orders');
				$ordersList = $orders->where(['sale_id'=>$sale_id, 'status'=>Controller::pending]);
				$counter = 0;
				foreach ($ordersList as $order_item) {
					$item = $this->model('item');
					$item_id = $order_item->item_id;
					$query = $item->where(['item_id'=>$item_id]);
					$counter++;
					$item = $query[0];
					$str .= '<tr id="row' . $order_item->ID .'" class="rowToDelete">
							<td class="cart_product">
								<img src="data:image/jpg;base64,' . base64_encode($item->item_picture) . '" width="150" height="150" style="margin-right:20px;vertical-align: middle;" />
							</td>
							<td class="cart_description" >
								<h4><a href="" style="display: block; vertical-align: middle;">' . $item->item_name . '</a></h4>
							</td>
							<td class="cart_price">
								<input class="price' . $order_item->ID .'"value="' . $item->item_price . '$" type="text" style="width:70px;display:block;vertical-align: middle;" disabled>
							</td>
							<td class="cart_quantity" >
								<div class="cart_quantity_button" style="vertical-align: middle;display: block; ">
									<button class="up cart_quantity_up" href="" value="' . $order_item->ID .'"> + </button>
									<input class="qty' . $order_item->ID .'" type="text" name="quantity' . $order_item->ID . '" value="' . $order_item->quantity .'" autocomplete="off" size="2">
									<button class="down cart_quantity_down" href="" value="' . $order_item->ID .'"> - </button>
								</div>
							</td>
							<td class="cart_total" >
							<div>
								<input style="width:70px;display: block;vertical-align: middle;" class="total' . $order_item->ID .'"value="' . $order_item->bought_price * $order_item->quantity . '$" type="text" disabled>
							</div>
							</td>
							<td class="cart_delete"  ">
							<div style="vertical-align: middle;display: block;">
								<button  href="" class="btn cart_quantity_delete" value="'.$order_item->ID.'" >X</button>
							</div>
							</td>
							<td class="cart_transfer" colspan="2" >
								<button  href="" class="wishlist_transfer" style="vertical-align: middle;display: block;" value="'. $order_item->ID .'">Transfer to Wishlist</button>
							</td>
							
						</tr>';


						

						
				}
				$checkoutTotal = $total . '$';

			}

			//self::displayTotal();
			//echo $checkoutTotal;
			$this->view('cart', ['str' => $str, 'checkoutTotal' => $checkoutTotal, 'sale_id' => $sale_id]);
			
		}

		

		public function addToCart($item_id)
		{
			if(isset($_SESSION['user']))
			{
				$user = $this->model('user');
				$query = $user->where(['email'=>$_SESSION['user']]);
				$user = $query[0];
				$sale = $this->model('sale');
				$user_id = $user->user_id;
				$query = $sale->where(['user_id'=>$user_id, 'status'=>Controller::pending]);
				$saleUpdate = $this->model('sale');
				if(count($query) == 0)
				{
					
					$payment_method = $this->model('payment_method');
					$query = $payment_method->where(['user_id'=>$user_id]);
					$payment_id = $query[0]->payment_id;

					$sale->user_id = $user_id;
					$sale->payment_id = $payment_id;
					$sale->checkout_date = null;
					$sale->total = 0;
					$sale->status = Controller::pending;
					$sale->insert();
					$sale_id = $sale->lastIndex();
					
					$query = $sale->where(['sale_id'=>$sale_id]);
					$saleUpdate = $query[0];

				}
				else
				{
					$sale_id = $query[0]->sale_id;
					$saleUpdate = $query[0];
				}


				$orders = $this->model('orders');
				$query = $orders->where(['item_id'=> $item_id, 'sale_id'=>$sale_id, 'status'=>Controller::pending]);
				if(count($query) == 0)
				{
					$orders->item_id = $item_id;
					$orders->quantity = 1;
					$orders->sale_id = $sale_id;
					$orders->status = Controller::pending;
		
					$item = $this->model('item');
					$query = $item->where(['item_id'=> $item_id]);
		
					$orders->bought_price = $query[0]->item_price;
		
					$orders->insert();
					
					$saleUpdate->total = $saleUpdate->total + $orders->bought_price;

					$query = $saleUpdate->prepare("update sale set total = :total, payment_id = :payment_id, checkout_date = :checkout_date, user_id = :user_id, status = :status where sale_id = :sale_id");
					var_dump($saleUpdate);
					$data = $saleUpdate->toArray();

					//var_dump($data);
					$query->execute($data);

					
				}
			}
			


			
		}
		public function deleteFromCart($orderID)
		{
		
			
			$orders = $this->model('orders');
			$query = $orders->where(['ID'=> $orderID]);
			if(count($query) > 0)
			{
				$orders = $query[0];
				$price = $query[0]->bought_price;
				$sale_id = $query[0]->sale_id;
				$orders->delete();
				
				$sale = $this->model('sale');
				
				$query = $sale->where(['sale_id'=>$sale_id]);
				$sale = $query[0];
				
				$sale->total = $sale->total - $price;

				$query = $sale->prepare("update sale set total = :total, payment_id = :payment_id, checkout_date = :checkout_date, user_id = :user_id, status = :status where sale_id = :sale_id");
					//var_dump($sale);
				$data = $sale->toArray();

					//var_dump($data);
				$query->execute($data);
				echo $sale->total;
			}
			
			//header('location: ../cart');

		}
		
		public function decreaseQuantity($ID)
		{
			$orders = $this->model('orders');
			$query = $orders->where(['ID'=> $ID]);
			$orders = $query[0];
			if($orders->quantity <= 1)
			{
				$orders->quantity = 1;
			}
			else
			{
				$orders->quantity = $orders->quantity - 1;
			}
			
			$query = $orders->prepare("update orders SET item_id = :item_id, quantity = :quantity, sale_id = :sale_id, bought_price = :bought_price, status = :status where ID = :ID");
    		$query->execute($orders->toArray());
    		//var_dump($orders->quantity);
    		

		}
		public function increaseQuantity($ID)
		{
			$orders = $this->model('orders');
			$query = $orders->where(['ID'=> $ID]);
			$orders = $query[0];
			
			$orders->quantity = $orders->quantity + 1;
			
			
			$query = $orders->prepare("update orders SET item_id = :item_id, quantity = :quantity, sale_id = :sale_id, bought_price = :bought_price, status = :status where ID = :ID");
    		$query->execute($orders->toArray());
    		 
		}
		public function transferToWishlist($orderID)
		{
			echo $orderID;
			require_once 'wishlistPage.php';
			$wishlistAdding = new wishlistPage();
			$orders = $this->model('orders');
			$query = $orders->where(['ID'=>$orderID]);
			var_dump($query);
			$orders = $query[0];
			$item_id = $orders->item_id;

			$wishlistAdding->addToWishlist($item_id);

			self::deleteFromCart($orderID);
		}
		public function checkOut($sale_id)
		{
			$orders = $this->model('orders');
			$ordersObj = $orders->where(['sale_id'=>$sale_id, 'status'=>Controller::pending]);
			$query = $orders->prepare("update orders SET item_id = :item_id, quantity = :quantity, sale_id = :sale_id, bought_price = :bought_price, status = :status where ID = :ID");
			foreach($ordersObj as $ordersItem)
			{
				$ordersItem->status = Controller::paid;
				$query->execute($ordersItem->toArray());
			}
			$sale = $this->model('sale');
			$query = $sale->where(['sale_id'=>$sale_id]);
			$saleObj = $query[0];
			var_dump($saleObj);
			$query = $saleObj->prepare("update sale set total = :total, payment_id = :payment_id, checkout_date = :checkout_date, user_id = :user_id, status = :status where sale_id = :sale_id");
			$saleObj->status = Controller::paid;
			$saleObj->checkout_date = date("Y-m-d H:i:s");



			$query->execute($saleObj->toArray());
		}
		

		
	}
?>