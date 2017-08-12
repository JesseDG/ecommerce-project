<?php 


class item extends PDOLayer {
    
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
    
    public function isEmpty(){

        return( !empty($this->item_name)            && 
                !empty($this->item_description)     && 
                !empty($this->item_picture)         && 
                !empty($this->item_price)           && 
                !empty($this->item_stock)           &&
                !empty($this->bought_date)          &&
                !empty($this->category_id)          &&
                !empty($this->brand_id)             &&
                !empty($this->status_item) );
    }

    public function checkImage($image){

        $checkImg = getimagesize($image);
        return($checkImg == true);
    }
}

?>