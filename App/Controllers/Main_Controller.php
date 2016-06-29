<?php

namespace App\Controllers;


abstract class Main_Controller
{

    protected $params;
    protected $controller;
    protected $page;


    protected function input($params = array()){
        //будет определана в классах наследниках
    }

    protected function output(){
        //будет определана в классах наследниках
    }

    protected function request($params = array()){
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

    protected function render($vars = array(),$path){
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

}