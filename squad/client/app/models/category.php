<?php

class category extends PDOLayer {
    
	public $category_name;
    public $status;

    public function __construct(){
		PDOLayer::__construct();
	}
}
?>