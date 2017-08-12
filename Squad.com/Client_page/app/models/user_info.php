<?php

class user_info extends PDOLayer{
    
    public $first_name;
    public $last_name;
    public $address;
    public $phone_nmb;
    public $city;
    public $province_state;
    public $user_id;
    
    
    public function __construct(){
        PDOLayer::__construct();
    }
}

?>