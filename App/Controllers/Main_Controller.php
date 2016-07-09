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

    protected function translate_russian_words($str){
        $rus = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];
        $lat = ['A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya'];
        return str_replace($rus, $lat, $str);
    }



}