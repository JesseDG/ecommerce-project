<?php

class category extends PDOLayer {
    
	public $category_name;
    public $status;

    public function __construct(){
		PDOLayer::__construct();
	}

    public function isEmpty(){

        return ( !empty($this->category_name) && !empty($this->status));
    }
}
?>