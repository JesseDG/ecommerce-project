<?php 


class item extends PDOLayer{

    public $item_name;
    public $item_description;
    public $item_picture;
    public $item_price;
    public $item_stock;
    public $category_id;
    public $brand_id;
    public $bought_date;
    public $status_item;
    

    public function __construct(){
		PDOLayer::__construct();
	}
    
    
}

?>