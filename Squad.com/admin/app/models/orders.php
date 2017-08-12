<?php

class orders extends PDOLayer {

    public $item_id;
    public $quantity;
    public $sale_id;
    public $bought_price;
    public $status;

    public function __construct()
    {
        PDOLayer::__construct();
    }

}

?>