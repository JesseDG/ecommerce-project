<?php

/**
 * Created by PhpStorm.
 * User: Cyclon
 * Date: 2016-11-09
 * Time: 9:09 PM
 */
class payment_method extends PDOLayer
{

    public $user_id;
    public $card_nmb;
    public $ccv;
    public $exp_date;
    public $name_holder;
    public $card_type;

    public function __construct()
    {
        PDOLayer::__construct();
    }
}