<?php

class brand extends PDOLayer
{

    public $brand_name;

    public function __construct(){
        PDOLayer::__construct();
    }

    public function isEmpty(){

        return (!empty($this->brand_name));
    }
}