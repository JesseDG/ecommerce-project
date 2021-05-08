<?php

class sale extends PDOLayer
{
    public $user_id;
    public $payment_id;
    public $checkout_date;
    public $total;
    public $status;

    public function __construct()
    {
        PDOLayer::__construct();
    }
}