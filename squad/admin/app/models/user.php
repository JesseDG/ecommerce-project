<?php

/**
 * Created by PhpStorm.
 * User: Cyclon
 * Date: 2016-11-09
 * Time: 9:07 PM
 */
class user extends PDOLayer
{

    public $email;
    public $password;

    public function __construct()
    {
        PDOLayer::__construct();
    }
}