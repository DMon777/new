<?php

namespace App\Controllers;


use App\Models\User_Model;

abstract class Main_Controller
{

    protected $params;
    protected $controller;
    protected $page;


    protected function input($params = []){

    }

    protected function output(){
        //будет определана в классах наследниках
    }

    protected function request($params = []){
        $this->input($params);
        $this->output();
        $this->show_page();
    }

    public function route(){
        if(class_exists($this->controller)){
            $controller = new $this->controller();
            $controller->request($this->params);
        }
        else{
            throw new Controller_Exception();
        }
    }

    protected function render($vars = [],$path){
        if(count($vars) > 0){
            extract($vars);
        }
        ob_start();

        if(!require_once $path.'.php'){
            throw new Controller_Exception();
        }

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function show_page(){
        echo $this->page;
    }

    protected function clean_str($str){
        return htmlspecialchars(trim($str));
    }

    protected function redirect($path = false){
        if($path){
            $redirect = $path;
        }
        else{
            $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_NAME;
        }
        header("Location: $redirect");
    }



}