<?php

namespace App\Controllers;


class Route_Controller extends Main_Controller
{

    protected static $instance;
    public static function instance(){
        if(self::$instance instanceof Route_Controller){
            return self::$instance;
        }
        else return self::$instance = new Route_Controller();
    }
    protected function __construct()
    {
        $query_string = $_SERVER['REQUEST_URI'];
        $query_string = substr($query_string, 1, strlen($query_string));
        $query_string = rtrim($query_string, '/');
        $query_array = explode('/', $query_string);
        $controller = !empty($query_array[0]) ? ucfirst($query_array[0]) : 'Index';
        $this->controller = "App\\Controllers\\" . $controller . "_Controller";

        if(!class_exists($this->controller)){
            throw new Controller_Exception();
        }

        if (!empty($query_array[1])) {
            $key = array();
            $value = array();
            for ($i = 1; $i < count($query_array); $i++) {
                if ($i % 2 !== 0) {
                    $key[] = $query_array[$i];
                } else {
                    $value[] = $query_array[$i];
                }
            }
            if(!$this->params=array_combine($key,$value)){
                throw new Controller_Exception();
            }

        }

    }




}