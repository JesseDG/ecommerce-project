<?php
	class wishlist extends PDOLayer
	{
		public $user_id;
		public $item_id;
		public $quantity;
		
		public function __construct()
    	{
        	PDOLayer::__construct();
    	}
	}
	
?>