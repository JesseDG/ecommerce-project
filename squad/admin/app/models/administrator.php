<?php

/**
 * Created by PhpStorm.
 * User: Cyclon
 * Date: 2016-11-09
 * Time: 9:03 PM
 */
class administrator extends PDOLayer
{

    public $admin_name;
    public $password;

    public function __construct()
    {
        PDOLayer::__construct();
    }
}

?>