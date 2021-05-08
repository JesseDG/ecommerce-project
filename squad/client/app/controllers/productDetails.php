<?php

	class productDetails extends Controller
	{
		public function index($productID)
		{
			
			require_once 'home.php';
			$SideBar = new Home();

			$str2 = $SideBar->displayBrand();
			$str3 = $SideBar->displayCategory();
			$item = $this->model('item');
			$query = $item->where(['item_id'=>$productID]);
			$str = '';

			if(count($query) > 0)
			{
				$item = $query[0];
				$str .= '<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="data:image/jpg;base64,' . base64_encode($item->item_picture) .'" style="max-width:700px;height:500%; overflow: hidden;"/>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2>' . $item->item_name . '</h2>
								<span>
									<span style="font-size:30px;">Price: ' . $item->item_price .'$</span>
								</span>
								
								<span>
									
									<label style="width:150px;font-size:17px;">Quantity in stock:</label>
									<input type="text" value="' . $item->item_stock . '" />
									
								</span>
								<span>
									<label style="width:150px;font-size:16px;">Item Description:</label>
									'. $item->item_description .'
								</span>
								<span>
									<button  href="" class="addToCart btn btn-default" value="'.$item->item_id.'">Add to cart</button>
									<button  href="" class="addToWishlist btn btn-default" value="'.$item->item_id.'">Add to wishlist</button>
								</span>
								
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->';
				$item = $query[0];
				$item_id = $item->item_id;
				


			}


			

			$this->view('productDetails', ['str'=>$str, 'str2'=>$str2 ,'str3'=>$str3]);
		}
		
	}
?>