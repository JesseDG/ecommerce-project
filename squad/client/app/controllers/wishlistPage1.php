<?php

	class wishlistPage extends Controller
	{
		public function index()
		{
			if(isset($_SESSION['user']))
			{
				$user = $this->model('user');
				$query = $user->where(['email'=>$_SESSION['user']]);
				$user = $query[0];
				$user_id = $user->user_id;
				$wishlist = $this->model('wishlist');
				$wishlistObject = $wishlist->where(['user_id'=>$user_id]);
				$counter = 0;
				$str = '';
				foreach ($wishlistObject as $wishlistItem) {
					$item = $this->model('item');
					$item_id = $wishlistItem->item_id;
					$query = $item->where(['item_id'=>$item_id]);
					$item = $query[0];
					$str .= '<tr id="row' . $wishlistItem->ID . '""><td class="cart_product">
								<a href=""><img src="data:image/jpg;base64,' . base64_encode($item->item_picture) . '" alt="" width="150" height="150"></a>
							</td>
							<td class="cart_description">
								<h4><a href="" style="display: block;vertical-align: middle;">' . $item->item_name . '</a></h4>
							</td>
							<td class="cart_price" colspan="4">
								<input class="price' . $wishlistItem->ID .'"value="' . $item->item_price . '" type="text" style="display: block;vertical-align: middle;" disabled>
							</td>
							
							<td class="cart_delete" colspan="3">
							<div style="display: block;vertical-align: middle;">
								<button  href="" class="btn wishlist_quantity_delete" value="'.$wishlistItem->ID .'">X</button>
							</div>
							</td>
							<td class="cart_transfer" colspan="2">
							<div style="display: block;vertical-align: middle;">
								<button  href="" class="wishlist_transfer" value="'.$wishlistItem->ID .'">Transfer to Cart</button>
							</div>
							</td>
							<tr/>';

				}
				
				$this->view('wishlistPage', ['str' => $str]);
			}
			else
			{
				$this->view('login', []);
			}
			
			


		}
		public function addToWishlist($item_id)
		{

			
			$user = $this->model('user');
			$query = $user->where(['email'=>$_SESSION['user']]);
			$user = $query[0];
			
			$user_id = $user->user_id;
			$wishlist = $this->model('wishlist');

			$query = $wishlist->where(['user_id'=>$user_id, 'item_id'=>$item_id]);
			
			if(count($query[0]) == 0)
			{
				$wishlist->user_id = $user_id;
				$wishlist->item_id = $item_id;
				$wishlist->quantity = 1;
				
				$wishlist->insert();
			}
			
			
		}

		public function deleteFromWishlist($wishlistID)
		{
			$wishlist = $this->model('wishlist');
			$query = $wishlist->where(['ID'=>$wishlistID]);

			$wishlist = $query[0];

			$wishlist->delete();


		}
		public function transferToCart($wishlistID)
		{
			require_once 'cart.php';
			$cartAdding = new cart();

			$user = $this->model('user');
			$query = $user->where(['email'=>$_SESSION['user']]);
			$user = $query[0];
			
			$user_id = $user->user_id;
			$wishlist = $this->model('wishlist');
			$query = $wishlist->where(['ID'=>$wishlistID]);
			$wishlist = $query[0];

			$item_id = $wishlist->item_id;
			$cartAdding->addToCart($item_id);
			
			
			self::deleteFromWishlist($wishlistID);


		}


	}
?>