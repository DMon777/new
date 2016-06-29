<?php

namespace App\Models;


abstract class Abstract_Model
{

    protected static $db;

    protected function __construct(){
        self::$db = Database_Model::instance();
    }


}