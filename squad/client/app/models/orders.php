<?php

class orders extends PDOLayer {

    public $item_id;
    public $quantity;
    public $sale_id;
    public $status;
    public $bought_price;

    public function __construct()
    {
        PDOLayer::__construct();
    }

}

?>